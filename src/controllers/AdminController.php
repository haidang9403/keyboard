<?php
namespace Controller;

use Model\UserModel as User;
use App\Session as Session;

class AdminController extends BaseController {
    private $user;
    public $currentUser;

    public function __construct(){
        $this->user = new User;
        if(Session::isUserLoggedIn()){
            $this->$currentUser = $this->user->findUserById($_SESSION['user_id']);
            if($this->$currentUser['role'] != 'admin'){
                header("HTTP/1.1 403 Forbidden");
                exit();
            }
        } else {
            header("HTTP/1.1 403 Forbidden");
            exit();
        }
    }

    // private function 

    public function index() {
        return $this->view("admin.index",[
            "infoUser" => $this->$currentUser,
            "dataType" => "user",
            "data" => $allUsers
        ]);
    }

    public function product() {

    }

    public function order(){

    }
}