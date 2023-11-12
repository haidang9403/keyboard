<?php

namespace Controller;

use App\Session as Session;
use Model\UserModel as User;
use Model\OrderModel as Order;

class ProfileController extends BaseController {

    public function __construct(){
        parent::__construct();
        if(isset($this->idUser)){
            redirect("/home");
        } else {
            $this->user = new User();
        }

        $this->type = $_GET["type"] ?? 'user';
        $modelClass = "Model\\".ucfirst($this->type) . "Model";
        
        if(class_exists( $modelClass )) {
            $this->model = new $modelClass;
        }else{
            NOT_FOUND();
        }
    }

    
    public function index() {

        $data = [
            'old' => $this->getSavedFormValues(),
            'errors' => session_get_once('errors')
        ];
        
        return $this->view('frontend.profile.index',[
            'infoUser' => $this->infoUser,
            'type' => $this->type,
            'totalOrder' => $totalOrder,
            'errors' => session_get_once('errors')
        ]);
    }

}

