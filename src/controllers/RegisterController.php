<?php

namespace Controller;

use App\Session as Session;
use Model\UserModel as User;

class RegisterController extends BaseController {
    private $user;
    public function __construct(){
        parent::__construct();
        if(Session::isUserLoggedIn()){
            redirect("/home");
        } else {
            $this->user = new User;
        }
    }

    
    public function index() {
        // Lưu giá trị của form vào session trừ password khi bị lỗi
        $this->saveFormValues($_POST, ['signup-password'],['confirm-password']);

        $data = $this->filterUserData($_POST);
        $model_errors = $this->user->validate($data);
        if(empty($model_errors)){ // Thành công
             $this->createUser($data);
        }

        // Dữ liệu không hợp lệ...
        redirect('/login', ['errors' => $model_errors]);
    }

    protected function filterUserData(array $data)
    {
        return [
            'signup-username' => $data['signup-username'] ?? null,
            'signup-password' => $data['signup-password'] ?? null,
            'confirm-password' => $data['confirm-password'] ?? null
        ];
    }

    protected function createUser($data)
    {      
        // Tạo thành công User
        // Lưu id User vào sesion
        // Chuyển đến home
        // redirect('/home');
        $randomNumber = date("YmdHis"); // Lấy ngày, tháng, và giờ hiện tại dưới dạng số
        $fullname = "User" . $randomNumber;
        $this->user->store([
            'fullname' => $fullname,
            'username' => $data['signup-username'],
            'password' => $data['signup-password'],
            'role' => 'user'
            // 'password' => password_hash($data['signup-password'], PASSWORD_DEFAULT)
        ]);
        Session::login($data['signup-username'],$data['signup-password']);
        redirect("/home");
    }
}

