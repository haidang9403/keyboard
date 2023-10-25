<?php
namespace Model;

use PDO;

use DB\Database as Database;

class BaseModel extends Database{

    protected static $table;
    public $db;

    public function __construct(){
        $this->db = $this->connect();
    }
    
    public function all($table, $selection = ['*'], $limit = 15){
        $columns = implode(',', $selection);
        $sql = "SELECT ${columns} FROM ${table} LIMIT ${limit}";

        $statement = $connection->prepare($sql);
        $statement = $connection->execute();

        $data = [];
        while($row = $statement->fetch()){
            array_push($data, $row);
        }
        return $data;
    }

    public function find($table, array $condition, $selection=['*']){
        $columns = implode(',', $selection);

        $where = $this->string_condition($condition);

        $sql = "SELECT ${columns} FROM ${table} WHERE $where";

        $statement = $this->db->prepare($sql);
        $statement->execute();

        $data = [];
        while($row = $statement->fetch()){
            array_push($data, $row);
        }
        return $data;
    }

    public function save($table, array $data){
        $keys = array_keys($data);
        $keysString =implode(", ", $keys);

        $values = [];
        foreach ($data as $value) {
            $values[] = is_string($value) ? "'$value'" : $value;
        }

        $valuesString = implode(', ', $values);
        $sql = "INSERT INTO ${table} (${keysString}) VALUES (${valuesString})";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        
    }

    public function update(){

    }

    public function delete(){

    }

    private function string_condition(array $data)
    {
        $result = [];

        foreach ($data as $key => $value) {
            $result[] = $key . ' = \'' . $value . '\'';
        }

        $result_string = implode(' and ', $result);

        return $result_string;
    }
}