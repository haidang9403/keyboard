<?php

namespace Model;

class UserModel extends BaseModel {
    const TABLE = 'users';

    public function __construct(){
        parent::__construct();
    }

    public function getAll($selection, $limit){
        return $this->all(self::TABLE, $selection, $limit);
    }

    public function findById($id, $selection = ['*']){
        return $this->find(self::TABLE,['id' => " = :id "],['id' => $id], $selection);
    }

    public function findUsername($username, $selection = ['*']){
        $data = $this->find(self::TABLE,['username' => " = :username "],['username' => $username] , $selection);
        return !empty($data);
    }

    public function findUser($username, $password)
    {
        $data = $this->find(self::TABLE,['username' => " = :username ", 'password' => "= :password "],['username' => $username, 'password' => $password]);
        return $data[0];
    }

    public function findUserById($id, $selection = ["*"]){
        $data = $this->find(self::TABLE,['id' => " = :id "], ['id' => $id], $selection);
        return $data[0];
    }

    public function validate(array $data)
    {
        $errors = [];

        if (!$data['signup-username']) {
            $errors['signup-username'] = 'Hãy nhập tên tài khoản';
        } elseif ($this->findUsername($data['signup-username'])) {
            $errors['signup-username'] = 'Tên tài khoản đã tồn tại';
        }

        if (strlen($data['signup-password']) < 6) {
            $errors['signup-password'] = 'Ít nhất 6 ký tự';
        } elseif ($data['signup-password'] != $data['confirm-password']) {
            $errors['confirm-password'] = 'Xác nhận mật khẩu không chính xác';
        }

        return $errors;
    }

    public function store($data){
        return $this->save(self::TABLE, $data);
    }

    // public function update(){

    // }

    // public function delete(){

    // }
}