<?php

namespace Controller;

use Model\OrderModel as Order;
use Model\OrderDetailsModel as OrderDetails;
use Model\ProductModel as Product;

class CartController extends BaseController {
    public $order;
    public $orderDetails;
    public $product;

    public function __construct(){
        parent::__construct();
        $this->order = new Order;
        $this->orderDetails = new OrderDetails;
        $this->product = new Product;
        if(empty($this->infoUser)){
            redirect("/home");
        }
        
    }

    public function index(){
        if(!empty($this->infoUser)){ // Đã đăng nhập
            $condition = [
                'user_id' => ' = :user_id ',
                'status' => ' = :status '
            ];

            $valueCdt = [
                'user_id' => $this->infoUser['id'],
                'status' => 0
            ];

            $_SESSION['fee'] = 12000;

            $fee = $_SESSION['fee'] ?? 12000;

            $orderData = $this->order->findOrderByUser($this->infoUser['id'],0);

            $cartItems = $this->orderDetails->getAllInfo($condition,  $valueCdt , ["order_details.*", "products.thumbnail", "products.title"]);
            
            $total_money = 0;

            foreach($cartItems as $item){
                $total_money += $item['total_money'];
            }

            $_SESSION['total_money'] = $total_money;

            
            return $this->view('frontend.cart.index',[
                'infoUser' => $this->infoUser,
                'pageTitle' => 'Giỏ hàng',
                'cartItems' => $cartItems,
                'total_money' => $total_money,
                'fee' => $fee,
                'total_pay' => $total_money + $fee,
                'orderData' => $orderData,
                'old' => $this->getSavedFormValues(),
                'errors' => session_get_once('errors')
            ]);
        }else { // Chưa đăng nhập
            // Yêu cầu đăng nhập
        }
    }

    public function add(){

        if(!empty($this->infoUser)){//  Đã đăng nhập
            $id_product = $_POST['idProduct'] ?? null;
            $num_product = intval($_POST['numProduct'] ?? 1);
            $id_user = $this->infoUser['id'];
            $data_product = $this->product->getById($id_product);

            $cart = $this->order->findOrderByUser($id_user,0);

            if(empty($cart)){/// giỏ hàng trống
                $this->order->create(['user_id'  => $id_user]);
                $cart = $this->order->findOrderByUser($id_user,0);
            }

            
            $order_info =  $this->orderDetails->getProductInCart($cart['id'],$id_product); // Tìm sản phẩm trong giỏ hàng
            if($num_product <=  intval($data_product['quantity']) - ($order_info['num'] ?? 0)){
                if(empty($order_info))
                { // chưa có sản phẩm trong giỏ hàng
                    $order_data = [
                        'product_id' => $id_product,
                        'order_id' => $cart['id'],
                        'num' => $num_product,
                        'price' => $data_product['price'],
                        'total_money' => $num_product*$data_product['price']
                    ];
    
                    $order_data['product_id'] = $id_product;
                    $this->orderDetails->create($order_data);
                } else { // có sản phẩm
                    #Coding
                    $num =  $order_info["num"];
                    $order_data = [];
                    $condition['product_id'] = " = :product_id ";
                    $valueCondition['product_id'] = $id_product;
                    $order_data['num'] = intval($num) +  $num_product;
                    $order_data['total_money'] = (intval($num) +  $num_product)*intval($data_product['price']);
                    $this->orderDetails->set($order_data, $condition, $valueCondition);
                }
                $total_product = $this->infoUser['num_product'] + $num_product;
        
                echo htmlspecialchars($total_product);
            } else{
                echo json_encode(null);
            }
        }

    }   

    public function delete(){
        $id = $_POST['orderDetailId'] ?? null;

        $cdtRemove = [
            'id' => " = :id "
        ];

        $valueCdtRemove = [
            'id' => $id
        ];

        $this->orderDetails->remove($cdtRemove,  $valueCdtRemove);

        $condition = [
                'user_id' => ' = :user_id ',
                'status' => ' = :status '
            ];

        $valueCdt = [
            'user_id' => $this->infoUser['id'],
            'status' => 0
        ];

        $orderData = $this->order->findOrderByUser($_SESSION['user_id'],0);
        $cartUser = $this->orderDetails->getByOrderId($orderData['id']);
        $numProduct = 0;
        foreach($cartUser as $item){
            ['num' => $num] = $item;

            $numProduct += $num;
        }

        $cartItems = $this->orderDetails->getAllInfo($condition,  $valueCdt, ["order_details.*", "products.thumbnail", "products.title"]);

        ob_start();
        $this->view('frontend.cart.cart-list',[
                'cartItems' => $cartItems
        ]);
        $cartList = ob_get_clean();

        $total_money = 0;
        foreach($cartItems as $item){
            $total_money += $item['total_money'];
        }
        
        $_SESSION['total_money'] = $total_money;

        $fee = intval($_SESSION['fee'] ?? 12000);

        $total_money_html = "<small>₫</small>" .htmlspecialchars(number_format($total_money, 0, ",", "."));

        $total_pay = $total_money + $fee;

        $total_pay_html = "<small>₫</small>" .htmlspecialchars(number_format($total_pay , 0, ",", "."));
        
        echo json_encode([
            'numProduct' => $numProduct,
            'cartList' => $cartList,
            'totalMoney' => $total_money_html,
            'totalPay' => $total_pay_html,
            'totalPayValue' =>  $total_pay,
            'totalMoney' => $total_money
        ]);
    }

    public function charge(){
        $fee = $_POST['fee'] ?? 12000;

        $_SESSION['fee'] = $fee;
         
        $total_money = intval($_SESSION['total_money'] ?? 0);

        $fee_html = "<small>₫</small>" .htmlspecialchars(number_format($fee, 0, ",", "."));

        $total_pay_html = "<small>₫</small>" .htmlspecialchars(number_format($total_money + $fee, 0, ",", "."));

        echo json_encode([
            'fee' => $fee_html,
            'totalPay' => $total_pay_html,
            'totalPayValue' => $total_money + $fee
        ]);
    }

    public function order(){

        
        $data = $this->filterOrderData($_POST);
        $model_errors = $this->order->validate($data);
        
        if(empty($model_errors)){ // Không có lỗi
            // Lưu dữ liệu vào data order và set status = 1
            $this->setOrder($data);
        }
        
        // Nếu có lỗi
        // Lưu dữ liệu vào session nếu bị lỗi
        $this->saveFormValues($_POST);
        redirect('/cart', ['errors' => $model_errors]);
        
    }

    private function setOrder($data){
        $orderData = $this->order->findOrderByUser($this->infoUser['id'],0);
        $this->order->set([
            'fullname' => $data['fullname'],
            'address' => $data['address'],
            'phone_number' => $data['phone'],
            'note' => $data['note'],
            'total_money' => intval($data['total_pay']),
            'status' => 1
        ],["id" => " = :id "], ["id" => $orderData['id']]);

        //Giảm số lượng sp trong products
        $products = $this->orderDetails->getByOrderId($orderData['id']);

        foreach($products as $product){
            $thisProduct = $this->product->getById($product['product_id']);
            $quantity = intval($thisProduct['quantity']) - intval($product['num']);

            if($quantity >= 0){
                $this->product->set([
                    'quantity' => $quantity
                ], ["id" => " = :id "], ["id" =>  $product['product_id']]);
            }
        }

        redirect('/home');
    }

    protected function filterOrderData(array $data){
        return [
            'fullname' => $data['fullname'] ?? NULL,
            'address' => $data["address"] ?? NULL,
            'phone' => $data['phone'] ?? NULL,
            'note' => $data['note'] ?? NULL,
            'total_pay' => $data['total_pay'] ?? NULL
        ];
    }
}