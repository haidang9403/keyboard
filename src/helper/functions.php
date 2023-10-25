<?php

// Render ra màn hình mã html trong folder partials
function partial($path, array $data = []) {

    foreach($data as $key => $value){
        $$key = $value;
    }

    $path = '../src/partials' . '/' . str_replace('.', '/', $path) . '.php';        
    require ($path);
}

// Render ra màn hình mã html trong folder views
function view($path, array $data = []) {
    
    foreach($data as $key => $value){
        $$key = $value;
    }
    $path = '../src/views' . '/' . str_replace('.', '/', $path) . '.php';        
    require ($path);
}

// Chuyển hướng đến 1 trang
function redirect($location, array $data = [])
{
    foreach ($data as $key => $value) {
        $_SESSION[$key] = $value;
    }

    header('Location: ' . $location, true, 302);
    exit();
}

// Đọc và xóa một biến trong $_SESSION
function session_get_once($name, $default = null)
{
    $value = $default;
    if (isset($_SESSION[$name])) {
        $value = $_SESSION[$name];
        unset($_SESSION[$name]);
    }
    return $value;
}
