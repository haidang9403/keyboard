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

    public function find($table, array $condition, array $values, $selection=['*'], $limit = null, $offset = null, $order = null){
        
        $columns = implode(',', $selection);

        $where = $this->string_condition($condition);

        $sql = "SELECT ${columns} FROM ${table}";

        if(isset($where) && !empty($where)){
            $sql .=  " WHERE $where ";
        }

        if(isset($order)){
            $order = str_replace(';', '', $order);
            $sql .= " ORDER BY $order ";
        }

        if(isset($limit)){
            $sql .= " LIMIT :limit ";
            $values[':limit'] = $limit;
        }

        if(isset($offset)){
            $sql .= " OFFSET :offset ";
            $values[':offset'] = $offset;
        }
        
        

        $statement = $this->db->prepare($sql);

        foreach($values as $key => $value){
            if(is_int($value)){
                $statement->bindValue($key, $value, PDO::PARAM_INT);
            }else {
                $statement->bindValue($key, $value);
            }
        }

        $statement->execute();
        $data = [];
        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($data, $row);
        }

        return $data;
    }

    public function save($table, array $data){
        $keys = array_keys($data);
        $keysString = implode(", ", $keys);
        // Tạo mảng mới chứa các tham số
        $parameters = [];
        foreach ($keys as $value) {
            $parameters[] = ":$value";
        }

        // Biến mảng thành chuỗi bằng cách nối các phần tử với dấu phẩy và dấu cách
        $resultParam = '(' . implode(', ', $parameters) . ')';

        $values = [];
        foreach ($data as $key => $value) {
            $values["$key"] = $value;
        }

        $sql = "INSERT INTO ${table} (${keysString}) VALUES  $resultParam";
        $statement = $this->db->prepare($sql);

        foreach($values as $key => $value){
            if(is_int($value)){
                $statement->bindValue($key, $value, PDO::PARAM_INT);
            }else {
                $statement->bindValue($key, $value);
            }
        }

        $statement->execute();
        
    }

    public function join($table, $data, $condition, $valueCondition, $selection = ["*"], $limit = null, $offset = null){
        // selection
        $columns = implode(',', $selection);
        
        $joinArray = [];

        foreach ($data as $table_join => $keys) {
            $joinArray[] = "JOIN $table_join ON $table.{$keys[1]} = $table_join.{$keys[0]}";
        }

        $join = implode(' ', $joinArray);

        // Where
        $where = $this->string_condition($condition);

        $sql = "SELECT $columns FROM $table $join";

        if(isset($where) && !empty($where)){
            $sql .=  " WHERE $where ";
        }

        if(isset($limit)){
            $sql .= " LIMIT :limit ";
            $valueCondition[':limit'] = $limit;
        }

        if(isset($offset)){
            $sql .= " OFFSET :offset ";
            $valueCondition[':offset'] = $offset;
        }

        $statement = $this->db->prepare($sql);

        foreach($valueCondition as $key => $value){
            if(is_int($value)){
                $statement->bindValue($key, $value, PDO::PARAM_INT);
            }else {
                $statement->bindValue($key, $value);
            }
        }

        $statement->execute();

        $data = [];
        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($data, $row);
        }

        return $data;


    }

    public function update($table, $data, $condition, $valueCondition){
        /// SET
        // Tạo mảng mới dạng id = :id,....
        $keys = array_keys($data);
        $parameters = [];
        foreach ($keys as $key) {
            $parameters[] = " $key = :$key ";
        }

        // Biến mảng thành chuỗi bằng cách nối các phần tử với dấu phẩy và dấu cách
        $set = implode(', ', $parameters);

        // WHERE
        $where = $this->string_condition($condition);

        $sql = "UPDATE $table SET $set WHERE $where";

        $statement = $this->db->prepare($sql);

        foreach($valueCondition as $key => $value){
            if(is_int($value)){
                $statement->bindValue($key, $value, PDO::PARAM_INT);
            }else {
                $statement->bindValue($key, $value);
            }
        }

        foreach($data as $key => $value){
            if(is_int($value)){
                $statement->bindValue($key, $value, PDO::PARAM_INT);
            }else {
                $statement->bindValue($key, $value);
            }
        }

        

        $statement->execute();

    }

    public function delete($table, $condition, $valueCondition){
        // WHERE
        $where = $this->string_condition($condition);

        $sql = "DELETE FROM $table WHERE $where";

        $statement = $this->db->prepare($sql);

        foreach($valueCondition as $key => $value){
            if(is_int($value)){
                $statement->bindValue($key, $value, PDO::PARAM_INT);
            }else {
                $statement->bindValue($key, $value);
            }
        }

        $statement->execute();
        
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