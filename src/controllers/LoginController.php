<?php

namespace Controller;

use App\Session as Session;
use Model\UserModel as User;

class LoginController extends BaseController {
    public $user, $product;
    public function __construct(){
        parent::__construct();
        if(!empty($this->infoUser)){
            redirect("/home");
        } else {
            $this->user = new User();
        }
    }

    
    public function index() {
        if(!isset($_SESSION['pre_url'])){
            $_SESSION['pre_url'] = $_SERVER['HTTP_REFERER'];
        }

        $data = [
            'old' => $this->getSavedFormValues(),
            'errors' => session_get_once('errors')
        ];
        
        return $this->view('frontend.auth.index', $data);
    }
    
    public function login() {
        $errors = [];
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        if($username && $password){
            $isValidUsername = $this->user->findUsername($username);
            if($isValidUsername){ // Tài khoản tồn tại
                if(Session::login($username,$password)){ // Đăng nhập thành công
                    if(isset($_SESSION['pre_url'])){
                        redirect(session_get_once('pre_url'));
                    }else {
                        redirect("/home");
                    }
                }else { // Sai mật khẩu
                    $errors['password'] ="Sai mật khẩu";
                }
            } else { // Không tìm thấy tài khoản
                $errors['username'] = "Tài khoản không tồn tại";
            }
        } else { // Thiếu username hoặc password
            if(!$username){
                $errors['username'] = "Vui lòng nhập tên tài khoản";
            } else {
                $errors['password'] = "Vui lòng nhập mật khẩu";
            }
        }

        // Lưu giá trị của form vào session trừ password khi bị lỗi
        $this->saveFormValues($_POST, ['password']);
        redirect("/login", [
            'errors' => $errors
        ]);
    }
}

