<?php

namespace Controller;

use App\Session as Session;

class LogoutController {

    public function index() {

        $_SESSION['user_id'] = null;
        
        redirect('/home');
    }
}

