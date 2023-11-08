<?php

namespace Controller;

use Model\UserModel as User;
use Model\OrderDetailsModel as OrderDetails;
use Model\OrderModel as Order;
use App\Session as Session;

class BaseController {
    const VIEW_FOLDER_NAME = '../src/views';
    private $user;
    private $orderDetails;
    private $order;
    private $currentUser;
    public $infoUser;

    public function __construct(){
        $this->user = new User;
        $this->order = new Order;
        $this->orderDetails = new OrderDetails;
        if(Session::isUserLoggedIn()){
            $currentUser = $this->user->findUserById($_SESSION['user_id']);
            if($currentUser['role'] == 'user'){
                $orderData = $this->order->findOrderByUser($_SESSION['user_id'],0);
                $numProduct = 0;
                if(!empty($orderData)){
                    $cartUser = $this->orderDetails->getByOrderId($orderData['id']);
                    foreach($cartUser as $item){
                        ['num' => $num] = $item;
        
                        $numProduct += $num;
                    }
                }
    
                $this->infoUser = [
                    'id' => $currentUser['id'] ?? null,
                    'fullname' => $currentUser['fullname'] ?? null,
                    'username' => $currentUser['username'] ?? null,
                    'num_product' => $numProduct
                ];
            } elseif ($currentUser['role'] == 'admin') {
                redirect("/admin");
            }
        } else {
            $this->infoUser = [];
        }
    }

    protected function view($path, array $data = [])
    {
        foreach($data as $key => $value){
            $$key = $value;
        }
        
        $path = self::VIEW_FOLDER_NAME . '/' . str_replace('.', '/', $path) . '.php';        
        require ($path);
    }

    protected function saveFormValues(array $data, array $except = [])
    {
        $form = [];
        foreach ($data as $key => $value) {
            if (!in_array($key, $except, true)) {
                $form[$key] = $value;
            }
        }
        $_SESSION['form'] = $form;
    }

    protected function getSavedFormValues()
    {
        return session_get_once('form', []);
    }
}