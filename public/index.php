<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

////////////// Route
//$controllerName = ucfirst($_REQUEST['controller'] ?? 'Home') . 'Controller'; // lấy tên controller
//$actionName = ($_REQUEST['action'] ?? 'index');// Lấy tên action

//$fullClassName = "Controller\\Frontend\\${controllerName}"; // Lấy tên lớp

//$controllerObject = new $fullClassName(); // Tạo đối tượng controller

//$controllerObject->$actionName(); // Truy cập phương thức yêu cầu trả về kết quả

session_start();

// Lấy tên Controller
$current_uri = $_SERVER['REQUEST_URI'];
$parts = explode('?', $current_uri);
$curent_name = $parts[0];
if($curent_name == "/") $curent_name = "/home";
$curent_name = trim($curent_name, '/');
$controllerName = ucfirst($curent_name) . "Controller";

// Lấy tên Action
$actionName = ($_REQUEST['action'] ?? 'index');

// Trả về kết quả
$className = "Controller\\${controllerName}";
$controllerObject = new $className;
$controllerObject -> $actionName();