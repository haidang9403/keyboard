<?php

namespace Controller;

use App\Session as Session;
use Model\UserModel as User;
use Model\OrderModel as Order;
use Model\OrderDetailsModel as OrderDetails;

class ProfileController extends BaseController {
    public $orderDetails;

    public function __construct(){
        parent::__construct();

        if(empty($this->infoUser)){
            redirect('/login');
        }

        $this->orderDetails = new OrderDetails;

        $this->type = $_GET["type"] ?? 'user';
        $modelClass = "Model\\".ucfirst($this->type) . "Model";
        
        if(class_exists( $modelClass )) {
            $this->model = new $modelClass;
        }else{
            NOT_FOUND();
        }
    }

    
    public function index() {

        $condition = [
                'user_id' => ' = :user_id ',
                'status' => ' = :status '
            ];
        
        // Các sản phẩm có trạng thái 0 là đang đặt hàng, trạng thái 1 là đang giao hàng
        $valueCdt = [
            'user_id' => $this->infoUser['id'],
            'status' => 1
        ];

        // lấy tổng sản phẩm giỏ hàng
        $totalOrderDetail = $this->orderDetails->getAllInfo($condition,  $valueCdt , ["order_details.*", "products.thumbnail", "products.title", "orders.total_money AS total_pay", "orders.order_date"]);
        
        $totalOrder = array();

        // Nhóm sản phẩm lại theo ID order
        foreach ($totalOrderDetail as $item) {
            $orderId = $item['order_id'];
            $orderDate = date("d/m/Y", strtotime($item['order_date']));
            $orderMoney = $item['total_pay'];
            // Nếu order_id chưa tồn tại trong mảng kết quả, tạo một phần tử mới
            if (!isset($totalOrder[$orderId])) {
                $totalOrder[$orderId] = array(
                    'order_id' => $orderId,
                    'order_date' => $orderDate,
                    'total_pay' => $orderMoney,
                    'items' => array(),
                );
            }

            // Thêm mục vào mảng phần tử của order_id
            $totalOrder[$orderId]['items'][] = $item;
        }

        usort($totalOrder, function ($a, $b) {
            // Sắp xếp theo ID giảm dần
            return $b['order_id'] - $a['order_id'];
        });

        return $this->view('frontend.profile.index',[
            'infoUser' => $this->infoUser,
            'type' => $this->type,
            'totalOrder' => $totalOrder,
            'errors' => session_get_once('errors')
        ]);
    }


    public function edit(){
        if($this->type == 'user'){
            $data = $this->filterUserData($_POST);
        }

        $model_errors = $this->model->validateInfo($data);
        if(empty($model_errors)){ // Thành công
            $this->update($data);
        }

        redirect("/profile?type=$this->type", ['errors' => $model_errors]);
    }

    protected function filterUserData($data){
        return [
            'fullname' => $data['fullname'] ?? null,
            'email' => $data['email'] ?? null
        ];
    }

    protected function update(array $data){
        $this->model->set($data,['id' => ' = :id '], ['id' => $this->infoUser['id']]);
        redirect("/profile?type=$this->type");
    }
}

