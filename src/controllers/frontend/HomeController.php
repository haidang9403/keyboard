<?php
namespace Controller\Frontend;

class HomeController extends BaseController {

    public function index() {
        $productIntro = [
            'id' => 1,
            'title' => 'Ducky One 2 Mini',
            'category' => 'popular',
            'thubnail' => './images/uploads/proudct-1.webp',
            'quantity' => 12,
            'price' => 2800000
        ];

        $productPopulars = [
             [
                'id' => 1,
                'title' => 'Ducky One 2 Mini',
                'category' => 'popular',
                'thubnail' => './images/uploads/proudct-1.webp',
                'quantity' => 12,
                'price' => 2800000
            ],
            [
                'id' => 1,
                'title' => 'Ducky One 2 Mini',
                'category' => 'popular',
                'thubnail' => './images/uploads/proudct-1.webp',
                'quantity' => 12,
                'price' => 2800000
            ],
             [
                'id' => 1,
                'title' => 'Ducky One 2 Mini',
                'category' => 'popular',
                'thubnail' => './images/uploads/proudct-1.webp',
                'quantity' => 12,
                'price' => 2800000
            ],
            [
                'id' => 1,
                'title' => 'Ducky One 2 Mini',
                'category' => 'popular',
                'thubnail' => './images/uploads/proudct-1.webp',
                'quantity' => 12,
                'price' => 2800000
            ]
        ];

        $productDiscounts = [
            [
                'id' => 1,
                'title' => 'Ducky One 2 Mini',
                'category' => 'discount',
                'thubnail' => './images/uploads/proudct-1.webp',
                'quantity' => 12,
                'price' => 2800000
            ],
            [
                'id' => 1,
                'title' => 'Ducky One 2 Mini',
                'category' => 'discount',
                'thubnail' => './images/uploads/proudct-1.webp',
                'quantity' => 12,
                'price' => 2800000
            ]
        ];

        $productNews = [
                         [
                'id' => 1,
                'title' => 'Ducky One 2 Mini',
                'category' => 'new',
                'thubnail' => './images/uploads/proudct-1.webp',
                'quantity' => 12,
                'price' => 2800000
            ],
            [
                'id' => 1,
                'title' => 'Ducky One 2 Mini',
                'category' => 'new',
                'thubnail' => './images/uploads/proudct-1.webp',
                'quantity' => 12,
                'price' => 2800000
            ],
             [
                'id' => 1,
                'title' => 'Ducky One 2 Mini',
                'category' => 'new',
                'thubnail' => './images/uploads/proudct-1.webp',
                'quantity' => 12,
                'price' => 2800000
            ],
            [
                'id' => 1,
                'title' => 'Ducky One 2 Mini',
                'category' => 'new',
                'thubnail' => './images/uploads/proudct-1.webp',
                'quantity' => 12,
                'price' => 2800000
            ]
        ];

        return $this->view('frontend.home.index',[
            'pageTitle' => 'Trang chủ',
            'productIntro' => $productIntro,
            'productPopulars' => $productPopulars,
            'productDiscounts' => $productDiscounts,
            'productNews' => $productNews
        ]);
    }

    public function show() {
        echo __METHOD__;
    }
}