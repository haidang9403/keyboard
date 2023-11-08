<?php
namespace Controller;

use Model\UserModel as User;
use Model\ProductModel as Product;

class HomeController extends BaseController {
    private $product;

    public function __construct(){
        parent::__construct();
        $this->product = new Product;
    }

    public function index() {
        $productIntro = [
            'id' => 1,
            'title' => 'Ducky One 2 Mini',
            'category' => 'popular',
            'thumbnail' => './images/uploads/product-1.webp',
            'quantity' => 12,
            'price' => 2800000
        ];

        $productPopulars = [
             [
                'id' => 1,
                'title' => 'Ducky One 2 Mini',
                'category' => 'popular',
                'thumbnail' => './images/uploads/product-1.webp',
                'quantity' => 12,
                'price' => 2800000
            ],
            [
                'id' => 1,
                'title' => 'Ducky One 2 Mini',
                'category' => 'popular',
                'thumbnail' => './images/uploads/product-1.webp',
                'quantity' => 12,
                'price' => 2800000
            ],
             [
                'id' => 1,
                'title' => 'Ducky One 2 Mini',
                'category' => 'popular',
                'thumbnail' => './images/uploads/product-1.webp',
                'quantity' => 12,
                'price' => 2800000
            ],
            [
                'id' => 1,
                'title' => 'Ducky One 2 Mini',
                'category' => 'popular',
                'thumbnail' => './images/uploads/product-1.webp',
                'quantity' => 12,
                'price' => 2800000
            ]
        ];

        $productDiscounts = [
            [
                'id' => 1,
                'title' => 'Ducky One 2 Mini',
                'category' => 'discount',
                'thumbnail' => './images/uploads/product-1.webp',
                'quantity' => 12,
                'price' => 2800000
            ],
            [
                'id' => 1,
                'title' => 'Ducky One 2 Mini',
                'category' => 'discount',
                'thumbnail' => './images/uploads/product-1.webp',
                'quantity' => 12,
                'price' => 2800000
            ]
        ];

        $productNews = [
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

        return $this->view('frontend.home.index',[
            'pageTitle' => 'Trang chủ',
            'productIntro' => $productIntro,
            'productPopulars' => $productPopulars,
            'productDiscounts' => $productDiscounts,
            'productNews' => $productNews,
            'infoUser' => $this->infoUser
        ]);
    }

    public function show() {
        echo __METHOD__;
    }
}