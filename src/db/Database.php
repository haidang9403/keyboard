<?php
namespace DB;

use PDO;

class Database{
    const DB_HOST = "localhost";
    const DB_NAME = "ct275_project";
    const DB_USER = "root";
    Const DB_PASS = "";
    private $connect;

    public function connect(){
        $dsn = "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset=utf8mb4";
        // $dsn = "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME . ";charset=utf8mb4";
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        $dbuser = $_ENV['DB_USER'];
        $dbpass = $_ENV['DB_PASS'];
        // $dbuser = self::DB_USER;
        // $dbpass = self::DB_PASS;

        // $dsn = "mysql:host={$dbhost};dbname={$dbname};charset=utf8mb4";
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