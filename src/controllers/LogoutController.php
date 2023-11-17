<?php

namespace Controller;

use App\Session as Session;

class LogoutController{

    public function index() {

        $_SESSION['user_id'] = null;
        if(isset($_SERVER['HTTP_REFERER']) && !strpos($_SERVER['HTTP_REFERER'],'/admin')){
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect('/home');
        }
    }
}

