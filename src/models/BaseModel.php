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
    
    public function all($table, $selection = ['*']){
        $columns = implode(',', $selection);
        $sql = "SELECT ${columns} FROM ${table}";

        $statement = $this->db->prepare($sql);
        $statement->execute();

        $data = [];
        while($row = $statement->fetch()){
            array_push($data, $row);
        }
        return $data;
    }

    public function find($table, array $condition, $selection=['*'], $limit = null, $offset = null, $order = null){
        $columns = implode(',', $selection);

        $where = $this->string_condition($condition);

        $sql = "SELECT ${columns} FROM ${table}";

        if(isset($where) && !empty($where)){
            $sql .=  " WHERE $where ";
        }

        if(isset($order)){
            $sql .= " ORDER BY ${order} ";
        }

        if(isset($limit)){
            $sql .= " LIMIT ${limit} ";
        }

        if(isset($offset)){
            $sql .= " OFFSET ${offset} ";
        }
        
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
        $conditions = [];

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $operator = key($value);
                $conditions[] = "($key " . implode(" $operator $key ", $value[$operator]) . ")";
            } else {
                $conditions[] = "$key $value";
            }
        }

        $sqlCondition = implode(' and ', $conditions);

        return $sqlCondition;
    }
}