<?php

namespace Controller;

use Model\ProductModel as Product;

class CategoryController extends BaseController {
    public $product;

    public function __construct(){
        parent::__construct();
        $this->product = new Product;
    }

    public function index(){

        // $productInfo = [
        //     'id' => 1,
        //     'title' => 'Ducky One 2 Mini',
        //     'category' => 'popular',
        //     'thubnail' => './images/uploads/proudct-1.webp',
        //     'quantity' => 12,
        //     'price' => 2800000,
        //     'layout' => '68%',
        //     'led' => 'RGB',
        //     'switch' => 'AKKO CS Switch Jelly Pink',
        //     'connect' => 'USB Type Cs, Bluetooth 5.0, Wireless 2.4Ghz'
        // ];

        //  $productOffers = [
        //                  [
        //         'id' => 1,
        //         'title' => 'Ducky One 2 Mini',
        //         'category' => 'new',
        //         'thubnail' => './images/uploads/proudct-1.webp',
        //         'quantity' => 12,
        //         'price' => 2800000
        //     ],
        //     [
        //         'id' => 1,
        //         'title' => 'Ducky One 2 Mini',
        //         'category' => 'new',
        //         'thubnail' => './images/uploads/proudct-1.webp',
        //         'quantity' => 12,
        //         'price' => 2800000
        //     ],
        //      [
        //         'id' => 1,
        //         'title' => 'Ducky One 2 Mini',
        //         'category' => 'new',
        //         'thubnail' => './images/uploads/proudct-1.webp',
        //         'quantity' => 12,
        //         'price' => 2800000
        //     ],
        //     [
        //         'id' => 1,
        //         'title' => 'Ducky One 2 Mini',
        //         'category' => 'new',
        //         'thubnail' => './images/uploads/proudct-1.webp',
        //         'quantity' => 12,
        //         'price' => 2800000
        //     ]
        // ];

        $allProduct =  $this->product->getAll();

        return $this->view('frontend.category.index',[
            'infoUser' => [
                'id' => $this->currentUser['id'] ?? null,
                'fullname' => $this->currentUser['fullname'] ?? null,
                'username' => $this->currentUser['username'] ?? null
            ],
            'products' => $allProduct
        ]);
    }

    public function filter(){
        $condition = [];

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

        $products = $this->product->getProduct($condition);
        echo  partial("product-list",[
                    'products' => $products,
                    'layout' => 'vertical'
                ]);
    }
}