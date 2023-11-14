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
        $productIntro = $this->product->getMAX('id');

        $productPopulars = $this->product->get(
            ['category' => " = :category "],
            ['category' => 'popular'],
            ['*'],
            5,
            null,
            " price DESC "
        );

        $productHots = $this->product->get(
            ['category' => " = :category "],
            ['category' => 'hot'],
            ['*'],
            2,
            null,
            " price DESC "
        );

        $productNews = $this->product->get(
            ['category' => " = :category "],
            ['category' => 'new'],
            ['*'],
            4,
            null,
            " price DESC "
        );

        return $this->view('frontend.home.index',[
            'pageTitle' => 'Trang chủ',
            'productIntro' => $productIntro,
            'productPopulars' => $productPopulars,
            'productHots' => $productHots,
            'productNews' => $productNews,
            'infoUser' => $this->infoUser
        ]);
    }

    public function show() {
        echo __METHOD__;
    }
}