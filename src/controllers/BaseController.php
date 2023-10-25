<?php

namespace Controller;

use Model\UserModel as User;
use App\Session as Session;

class BaseController {
    const VIEW_FOLDER_NAME = '../src/views';
    private $user;
    public $currentUser;

    public function __construct(){
        $this->user = new User();
        if(Session::isUserLoggedIn()){
            $this->currentUser = $this->user->findUserById($_SESSION['user_id']);
        } else {
            $this->currentUser = [];
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