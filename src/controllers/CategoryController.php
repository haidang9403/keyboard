<?php

namespace Controller;

use Model\ProductModel as Product;

class CategoryController extends BaseController {
    public $product;
    public $keyword;
    const LIMIT = 15;

    public function __construct(){
        parent::__construct();
        $this->product = new Product;

        $this->keyword = $_GET['keyword'] ?? null;
    }

    public function index(){
        // Reset filter
        $_SESSION['condition'] = null;
        $_SESSION['value'] = null;
        $_SESSION['sort'] = null;
        $_SESSION['layout'] = null;

        // Tìm kiếm
        $condition = []; $valueCdt = [];
        if($this->keyword){
            $condition = [
                'LOWER(title)' => " LIKE LOWER(:keyword) "
            ];
    
            $valueCdt = [
                ':keyword' => "%$this->keyword%"
            ];
        }

        $allProduct = $this->product->getAll($condition, $valueCdt);
        $total_product = count($allProduct);
        $limit = self::LIMIT;
        $current_page = 1;
        $total_page = ceil( $total_product/$limit);
        $offset = ($current_page - 1)*$limit;


        $page_array = pagination($total_page, $current_page);

        $products = $this->product->get($condition,$valueCdt,["*"],$limit, $offset);

        return $this->view('frontend.category.index',[
            'infoUser' => $this->infoUser,
            'products' => $products,
            'page_array' => $page_array,
            'current_page' => $current_page,
            'keyword' => $this->keyword
        ]);
    }

    public function paginate(){
        $condition = $_SESSION['condition'] ?? []; // Lấy filter từ sesion
        $order = $_SESSION['sort'] ?? null;
        $layout = $_SESSION['layout'] ?? null;
        $value = $_SESSION['value'] ?? [];

        if($this->keyword){
            $condition['LOWER(title)'] = " LIKE LOWER(:keyword) ";
            $value['keyword'] = "%$this->keyword%";
        }

        $limit_layout = $layout == 'horizontal' ? self::LIMIT + 1 : self::LIMIT;
        $allProduct = $this->product->get($condition, $value);
        $total_product = count($allProduct);
        $limit = $limit_layout;
        $current_page = $_POST['page'] ?? 1;
        $total_page = ceil( $total_product/$limit);
        $offset = ($current_page - 1)*$limit;

        $page_array = pagination($total_page, $current_page);

        $products = $this->product->get($condition, $value ,["*"],$limit, $offset, $order);
        echo  partial("product-list",[
                    'products' => $products,
                    'layout' => $layout,
                    'page_array' => $page_array,
                    'current_page' => $current_page
                ]);
    }

    public function filter(){
        $condition = []; $order = null; $layout = null;
        $value = []; // Lưu giá trị cho câu truy vấn

        if($this->keyword){
            $condition['LOWER(title)'] = " LIKE LOWER(:keyword) ";
            $value['keyword'] = "%$this->keyword%";
        }

        if ($priceMax = $_POST['priceMax'] ?? null) {
            $condition['price']['and'][] = ' <= :priceMax ';
            $value['priceMax'] = $priceMax;
        }

        if ($priceMin = $_POST['priceMin'] ?? null) {
            $condition['price']['and'][] = ' >= :priceMin ';
            $value['priceMin'] = $priceMin;
        }

        if($sizeJSON = $_POST['size'] ?? []){
            $sizes = json_decode($sizeJSON, true);
            if(empty($sizes)){
                $condition['layout'] = " LIKE :allLayout ";
                $value['allLayout'] = '%';
            }else{
                $i = 0;
                foreach ($sizes as $size) {
                    $condition['layout']['or'][] = " LIKE :size${i} ";
                    $value["size${i}"] = $size;
                    $i++;
                }
            }
        }

        if($stateJSON = $_POST['state'] ?? []){
            $states = json_decode($stateJSON, true);
            if(empty($states)){
                $condition['category'] = " LIKE :allCategory ";
                $value['allCategory'] = "%";
            }else{
                $i = 0;
                foreach ($states as $state) {
                    $condition['category']['or'][] = "= :state$i ";
                    $value["state$i"] = $state;
                    $i++;
                }
            }
        }

        if($sort = $_POST['sort'] ?? null){
            if($sort != 'NONE'){
                $order = " price " . $sort;
            } else {
                $order = null;
            }
        }
        
        $layout = $_POST['layout'] ?? null;
        $limit_layout = $layout == 'horizontal' ? self::LIMIT + 1 : self::LIMIT;

        $allProduct = $this->product->get($condition,$value,["*"]);
        $total_product = count($allProduct);
        $limit = $limit_layout;
        $current_page = $_POST['page'] ?? 1;
        $total_page = ceil( $total_product/$limit);
        $offset = ($current_page - 1)*$limit;

        $page_array = pagination($total_page, $current_page);

        $products = $this->product->get($condition,$value,["*"],$limit, $offset, $order);
        $_SESSION['condition'] = $condition;
        $_SESSION['sort'] = $order;
        $_SESSION['layout'] = $layout;
        $_SESSION['value'] = $value;
        echo  partial("product-list",[
                    'products' => $products,
                    'layout' => $layout,
                    'page_array' => $page_array,
                    'current_page' => $current_page
                ]);
    }
}