<?php

namespace Controller;

use Model\ProductModel as Product;

class CategoryController extends BaseController {
    public $product;
    const LIMIT = 15;

    public function __construct(){
        parent::__construct();
        $this->product = new Product;
    }

    public function index(){
        // Reset filter
        $_SESSION['condition'] = null;
        $_SESSION['sort'] = null;
        $_SESSION['layout'] = null;

        $allProduct = $this->product->getAll();
        $total_product = count($allProduct);
        $limit = self::LIMIT;
        $current_page = 1;
        $total_page = ceil( $total_product/$limit);
        $offset = ($current_page - 1)*$limit;


        $page_array = pagination($total_page, $current_page);

        $products = $this->product->get([],["*"],$limit, $offset);

        return $this->view('frontend.category.index',[
            'infoUser' => [
                'id' => $this->currentUser['id'] ?? null,
                'fullname' => $this->currentUser['fullname'] ?? null,
                'username' => $this->currentUser['username'] ?? null
            ],
            'products' => $products,
            'page_array' => $page_array,
            'current_page' => $current_page
        ]);
    }

    public function paginate(){
        $condition = $_SESSION['condition'] ?? []; // Lấy filter từ sesion
        $order = $_SESSION['sort'] ?? null;
        $layout = $_SESSION['layout'] ?? null;
        $limit_layout = $layout == 'horizontal' ? self::LIMIT + 1 : self::LIMIT;
        $allProduct = $this->product->get($condition);
        $total_product = count($allProduct);
        $limit = $limit_layout;
        $current_page = $_POST['page'] ?? 1;
        $total_page = ceil( $total_product/$limit);
        $offset = ($current_page - 1)*$limit;


        $page_array = pagination($total_page, $current_page);

        $products = $this->product->get($condition,["*"],$limit, $offset, $order);
        echo  partial("product-list",[
                    'products' => $products,
                    'layout' => $layout,
                    'page_array' => $page_array,
                    'current_page' => $current_page
                ]);
    }

    public function filter(){
        $condition = []; $order = null; $layout = null;

        if ($priceMax = $_POST['priceMax'] ?? null) {
            $condition['price']['and'][] = '<= '.$priceMax;
        }

        if ($priceMin = $_POST['priceMin'] ?? null) {
            $condition['price']['and'][] = '>= '.$priceMin;
        }

        if($sizeJSON = $_POST['size'] ?? []){
            $sizes = json_decode($sizeJSON, true);
            if(empty($sizes)){
                $condition['layout'] = "LIKE '%'";
            }else{
                foreach ($sizes as $size) {
                    $condition['layout']['or'][] = "LIKE '$size'";
                }
            }
        }

        if($stateJSON = $_POST['state'] ?? []){
            $states = json_decode($stateJSON, true);
            if(empty($states)){
                $condition['category'] = "LIKE '%'";
            }else{
                foreach ($states as $state) {
                    $condition['category']['or'][] = "= '$state'";
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

        $allProduct = $this->product->get($condition,["*"]);
        $total_product = count($allProduct);
        $limit = $limit_layout;
        $current_page = $_POST['page'] ?? 1;
        $total_page = ceil( $total_product/$limit);
        $offset = ($current_page - 1)*$limit;


        $page_array = pagination($total_page, $current_page);

        $products = $this->product->get($condition,["*"],$limit, $offset, $order);
        $_SESSION['condition'] = $condition;
        $_SESSION['sort'] = $order;
        $_SESSION['layout'] = $layout;
        echo  partial("product-list",[
                    'products' => $products,
                    'layout' => $layout,
                    'page_array' => $page_array,
                    'current_page' => $current_page
                ]);
    }
}