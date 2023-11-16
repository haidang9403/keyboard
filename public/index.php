<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

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

// Kiểm tra xem controller có tồn tại không
if (!class_exists("Controller\\${controllerName}")) {
    NOT_FOUND();
}

// Kiểm tra xem action có tồn tại không
if (!method_exists($className, $actionName)) {
    NOT_FOUND();
}

$controllerObject = new $className;

try {
    $controllerObject->$actionName();
} catch (Exception $e) {
    NOT_FOUND();
}