<?php

namespace Controller;

use Model\ProductModel as Product;

class ProductController extends BaseController {
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

         $productOffers = [
                         [
                'id' => 1,
                'title' => 'Ducky One 2 Mini',
                'category' => 'new',
                'thumbnail' => './images/uploads/product-1.webp',
                'quantity' => 12,
                'price' => 2800000
            ],
            [
                'id' => 1,
                'title' => 'Ducky One 2 Mini',
                'category' => 'new',
                'thumbnail' => './images/uploads/product-1.webp',
                'quantity' => 12,
                'price' => 2800000
            ],
             [
                'id' => 1,
                'title' => 'Ducky One 2 Mini',
                'category' => 'new',
                'thumbnail' => './images/uploads/product-1.webp',
                'quantity' => 12,
                'price' => 2800000
            ],
            [
                'id' => 1,
                'title' => 'Ducky One 2 Mini',
                'category' => 'new',
                'thumbnail' => './images/uploads/product-1.webp',
                'quantity' => 12,
                'price' => 2800000
            ]
        ];

        $productId = $_GET['id'] ?? []; 
        if(!empty($productId)){
            $productInfo = $this->product->getProductById(intval($productId));
            if(empty($productInfo)){
                NOT_FOUND();
            }else{
                // lấy các sản phẩm đề xuất
                // Dựa trên các tiêu chí sau
                // + Cùng layout
                // + Giá gần bằng giá sản phẩm nhất
                // + Cùng danh mục (không bắt buộc)
            }
        }else{
            NOT_FOUND();
        }

        return $this->view('frontend.product.index',[
            'productInfo' => $productInfo,
            'infoUser' => [
                'id' => $this->currentUser['id'] ?? null,
                'fullname' => $this->currentUser['fullname'] ?? null,
                'username' => $this->currentUser['username'] ?? null
            ],
            'productOffers' => $productOffers
        ]);
    }
}