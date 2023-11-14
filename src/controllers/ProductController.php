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

         

        $productId = $_GET['id'] ?? []; 
        if(!empty($productId)){
            $productInfo = $this->product->getById(intval($productId));
            if(empty($productInfo)){
                NOT_FOUND();
            }else{
                $productOffers = $this->product->get(
                    ['id' => ' != :id '],['price' => intval($productInfo['price']), 'id' => $productInfo['id']],['*'],
                    4,
                    null,
                    " ABS( price - :price) "
                );
            }
        }else{
            NOT_FOUND();
        }

        return $this->view('frontend.product.index',[
            'infoUser' => $this->infoUser,
            'productInfo' => $productInfo,
            'productOffers' => $productOffers
        ]);
    }
}