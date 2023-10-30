<?php
namespace Model;

class ProductModel extends BaseModel {
    const TABLE = 'products';

    public function __construct(){
        parent::__construct();
    }

    public function getAll($selection = ['*'], $limit = 15){
        return $this->all(self::TABLE, $selection, $limit);
    }

    public function getProduct($condition, $selection=['*']){
        return $this->find(self::TABLE, $condition, $selection);
    }

    public function getProductById($id, $selection = ['*']){
        $data = $this->find(self::TABLE, ['id' => " = ${id}"], $selection);
        return $data[0] ?? [];
    }

    public function getProductByCategory($category, $selection = ['*'], $limit = 16){
        return 0;
    }

    public function getProductOffers(){
        
    }
}

// INSERT INTO `products`(`category`, `title`, `quantity`, `price`, `thumbnail`, `layout`, `connect`, `led`, `switch`) VALUES ('popular','Ducky One 2 Mini', 54 , 2800000, './images/uploads/proudct-1.webp', '68%', 'USB Type Cs, Bluetooth 5.0, Wireless 2.4Ghz', 'RGB', 'AKKO CS Switch Jelly Pink');