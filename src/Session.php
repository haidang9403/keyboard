<?php

namespace App;

use Model\UserModel as User;

class Session
{
    protected $user;

    public static function login($username, $password) {
        $user = new User();
        $dataUser = $user->findUser($username, $password);
        $_SESSION['user_id'] = $dataUser['id'] ?? null;
        return isset($_SESSION['user_id']);
    }

    public static function isUserLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }
}
