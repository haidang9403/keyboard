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

// Lỗi 404
function NOT_FOUND(){
    header("HTTP/1.0 404 Not Found");
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

function pagination($total_page, $page): array
{
    $page_array = [];
    if($total_page > 6){
        if($page <= 4){
            for($i = 1; $i <= 5; $i++){
                $page_array[] = $i;
            }
            $page_array[] = '...';
            $page_array[] = $total_page;
        } else {
            $end_limit = $total_page - 4;
            if($page > $end_limit){
                $page_array[] = 1;
                $page_array[] = '...';
                for($i = $end_limit; $i <= $total_page; $i++){
                    $page_array[] = $i;
                }
            } else {
                $page_array[] = 1;
                $page_array[] = '...';
                for($i = $page - 1; $i <= $page + 1; $i++){
                    $page_array[] = $i;
                }
                $page_array[] = '...';
                $page_array[] = $total_page;
            }
        }
    } else if ($total_page > 1) {
        for($i = 1; $i <= $total_page; $i++){
            $page_array[] = $i;
        }
    }

    return $page_array;
}
