<?php

require_once __DIR__ . "/../vendor/autoload.php";

////////////// Route
$controllerName = ucfirst($_REQUEST['controller'] ?? 'Home') . 'Controller'; // lấy tên controller
$actionName = ($_REQUEST['action'] ?? 'index');// Lấy tên action

$fullClassName = "Controller\\Frontend\\${controllerName}"; // Lấy tên lớp

$controllerObject = new $fullClassName(); // Tạo đối tượng controller

$controllerObject->$actionName(); // Truy cập phương thức yêu cầu trả về kết quả


