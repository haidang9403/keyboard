<?php

namespace Model;

class OrderDetailsModel extends BaseModel {
    const TABLE = 'order_details';

    public function __construct(){
        parent::__construct();
    }

    public function getAll($selection){
        return $this->all(self::TABLE, $selection);
    }

    public function getById($id, $selection = ['*']){
        return $this->find(self::TABLE,['id' => " = :id "],['id' => $id], $selection);
    }

    public function getByOrderId($order_id){
        return $this->find(self::TABLE,['order_id' => " = :order_id "], ['order_id' => $order_id]);
    }

    public function getProductInCart($order_id, $product_id){
        $data = $this->find(self::TABLE,['order_id' => ' = :order_id ' , 'product_id' => ' = :product_id'],
        ['order_id' => $order_id, 'product_id' => $product_id]);
        return $data[0] ?? [];
    }

    public function getAllInfo($condition, $value , $selection = ["*"]){
        return $this->join(self::TABLE, ['orders' => ['id', 'order_id'], 'products' => ['id', 'product_id']],
                            $condition, $value , $selection);
    }

    public function create($data){
        return $this->save(self::TABLE, $data);
    }

    public function set($data, $condition, $valueCondition){
        return $this->update(self::TABLE, $data, $condition, $valueCondition );
    }

    public function remove($condition, $valueCondition){
        return $this->delete(self::TABLE, $condition, $valueCondition);
    }
}