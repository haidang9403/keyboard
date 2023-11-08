<?php
namespace Model;

class ProductModel extends BaseModel {
    const TABLE = 'products';

    public function __construct(){
        parent::__construct();
    }

    public function getAll($selection = ['*']){
        return $this->all(self::TABLE, $selection);
    }

    public function get($condition, $value, $selection=['*'], $limit = null, $offset = null, $order = null){
        return $this->find(self::TABLE, $condition, $value, $selection, $limit, $offset, $order);
    }


    public function getById($id, $selection = ['*']){
        $data = $this->find(self::TABLE, ['id' => " = :id "],['id' => $id], $selection);
        return $data[0] ?? [];
    }

    public function getProductByCategory($category, $selection = ['*'], $limit = 16){
        return $data = $this->find(self::TABLE, ['category' => " = :category "],['category' => $category], $selection, $limit);
    }

    public function set($data, $condition, $valueCondition){
        return $this->update(self::TABLE,$data, $condition, $valueCondition);
    }

    public function getProductOffers(){
        
    }
}

// INSERT INTO `products`(`category`, `title`, `quantity`, `price`, `thumbnail`, `layout`, `connect`, `led`, `switch`) VALUES ('popular','Ducky One 2 Mini', 54 , 2800000, './images/uploads/proudct-1.webp', '68%', 'USB Type Cs, Bluetooth 5.0, Wireless 2.4Ghz', 'RGB', 'AKKO CS Switch Jelly Pink');