<?php
namespace Model;

class ProductModel extends BaseModel {
    const TABLE = 'products';

    public function __construct(){
        parent::__construct();
    }

    public function getAll($condition = [],$values = [],$selection = ['*']){
        return $this->all(self::TABLE,$condition,$values, $selection);
    }

    public function getMax($order, $condition = [], $value = [], $selection = ['*']){
        $data = $this->find(self::TABLE, $condition, $value, $selection, 1, null, " $order DESC ");
        return $data[0] ?? [];
    }

    public function getMIN($order, $condition = [], $value = [], $selection = ['*']){
        $data = $this->find(self::TABLE, $condition, $value, $selection, 1, null, " $order ASC ");
        return $data[0] ?? [];
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

    public function store($data){
        return $this->save(self::TABLE, $data);
    }

    public function remove($condition, $valueCondition){
        return $this->delete(self::TABLE, $condition, $valueCondition);
    }

    public function validate($data){
        $errors = [];

        if(!$data['title']){
            $errors['title'] = "Hãy nhập tên sản phẩm!";
        };

        if(!$data['price']){
            $errors['price'] = "Hãy nhập giá tiền!";
        } elseif($data['price'] < 0){
            $errors['price'] = "Giá tiền không nhỏ hơn 0";
        }

        if(!$data['quantity']){
            $errors['quantity'] = "Hãy nhập số lượng";
        } elseif($data['quantity'] < 0){
            $errors['quantity'] = "Số lượng không nhỏ hơn 0";
        }

        if(!$data['connect']){
            $errors['connect'] = "Hãy nhập cách kết nối";
        }

        if(isset($data['thumbnail_file'])){ // Khi update nếu có file ảnh
            if( $data['thumbnail_file']["error"] > 0){
                $errors['thumbnail_file'] = "Hãy chọn file ảnh!";
            } else {
                $targetDir = realpath(__DIR__ . "/../../public/images/uploads/");
                $targetFile = $targetDir . '/' . basename($data["thumbnail_file"]["name"]);
               
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                $extensions = array("jpeg", "jpg", "png", "gif");
        
                // Check if image file is a actual image or fake image
                $check = getimagesize($data["thumbnail_file"]["tmp_name"]);
                if ($check === false) {
                    $errors['thumbnail_file'] = "File không phải là ảnh";
                }elseif (file_exists($targetFile)) { // Check if file already exists
                    $errors["thumbnail_file"] = "File đã tồn tại";
                }elseif ($data["thumbnail_file"]["size"] > 500000) {  // Check file size
                    $errors["thumbnail_file"] = "Kích thước quá lớn";
                } elseif (! in_array($imageFileType, $extensions)) {
                    $errors["thumbnail_file"] = "Chỉ chấp nhập file JPG, JPEG, PNG & GIF";
                } else {
                    $_SESSION['targetFile'] = $targetFile;
                }
            }
        }

        return $errors;
    }
}

// INSERT INTO `products`(`category`, `title`, `quantity`, `price`, `thumbnail_file`, `layout`, `connect`, `led`, `switch`) VALUES ('popular','Ducky One 2 Mini', 54 , 2800000, './images/uploads/proudct-1.webp', '68%', 'USB Type Cs, Bluetooth 5.0, Wireless 2.4Ghz', 'RGB', 'AKKO CS Switch Jelly Pink');