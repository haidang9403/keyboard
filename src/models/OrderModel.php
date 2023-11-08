<?php

namespace Model;

class OrderModel extends BaseModel {
    const TABLE = 'orders';

    public function __construct(){
        parent::__construct();
    }

    public function getAll($selection){
        return $this->all(self::TABLE, $selection);
    }

    public function getById($id, $selection = ['*']){
        return $this->find(self::TABLE,['id' => " = :id "],['id' => $id], $selection);
    }

    public function findOrderByUser($user_id, $status){
        $data = $this->find(self::TABLE, ['user_id' => "= :user_id", 'status' => "= :status"],['user_id' => $user_id, 'status' => $status]);
        return $data[0] ?? [];
    }

    public function create($data){
        return $this->save(self::TABLE, $data);
    }

    public function set($data, $condition, $valueCondition){
        return $this->update(self::TABLE,$data, $condition, $valueCondition);
    }

    public function validate(array $data){
        $errors = [];

        if(!$data['fullname']){ // Không nhập tên
            $errors['fullname'] = "Hãy nhập tên người nhận";
        };

        if(!$data['address']){ // Không nhập địa chỉ
            $errors['address'] = "Hãy nhập địa chỉ nhận hàng";
        } elseif(!$this->isValidAddress($data['address'])){ // Địa chỉ không hợp lệ
            $errors['address'] = "Địa chỉ không hợp lệ";
        }

        if(!$data['phone']){
            $errors['phone'] = "Hãy nhập số điện thoại";
        } elseif(!$this->isValidPhoneNumber($data['phone'])){
            $errors['phone'] = "Số điện thoại không hợp lệ";
        }

        return $errors;
    }

    private function isValidAddress($address) {
        // Kiểm tra xem địa chỉ có ít nhất 5 ký tự không bao gồm dấu cách hay không
        if (strlen(trim($address)) < 5) {
            return false;
        }

        // Kiểm tra xem địa chỉ có chứa các ký tự đặc biệt không hợp lệ hay không
        /*if (preg_match('/[\'^£$%&*()}{@#~?><>,|=+¬]/', $address)) {
            return false;
        }*/

        // Kiểm tra xem địa chỉ có ký tự số và chữ cái không bao gồm ký tự đặc biệt hay không
        // if (!preg_match('/^[A-Za-z0-9 ]+$/', $address)) {
        //     return false;
        // }

        // Nếu không có điều gì không hợp lệ, địa chỉ được coi là hợp lệ
        return true;
    }

    private function isValidPhoneNumber($phone) {
        // Loại bỏ các ký tự không phải số
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Kiểm tra xem số điện thoại có đúng độ dài và định dạng không
        if (strlen($phone) == 10 && preg_match('/^[0-9]{10}$/', $phone)) {
            return true;
        }

        return false;
    }

    // public function delete(){

    // }
}