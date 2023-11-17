<?php
namespace DB;

use PDO;

class Database{
    private $connect;

    public function connect(){
        $dsn = "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset=utf8mb4";
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        $dbuser = $_ENV['DB_USER'];
        $dbpass = $_ENV['DB_PASS'];

        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

        try{
            $this->connect = new PDO($dsn, $dbuser, $dbpass, $options);
        } catch (Exception $ex) {
            echo 'Không thể kết nối đến MySQL,
                kiểm tra lại username/password đến MySQL.<br>';
            exit("<pre>${ex}</pre>");
        }
        return $this->connect;
    }
}