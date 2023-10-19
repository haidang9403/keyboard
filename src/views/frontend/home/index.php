<?php
partial('header',[
    'pageTitle' => $pageTitle
]);
?>
<main>
        <div class="container">
        <?php 
            view('frontend.home.introduction',[
                'productIntro' => $productIntro
            ]);

            view('frontend.home.service');

            view('frontend.home.size');

            view('frontend.home.category',[
                'modify' => 'discount',
                'products' => $productDiscounts,
                'layout' => 'horizontal'
            ]);

            view('frontend.home.category',[
                'introduce' => [
                    'banner' => './images/banners/banner-blog.jpg',
                    'productIntro' => $productIntro
                ],
                'modify' => 'popular',
                'products' => $productPopulars
            ]);

            view('frontend.home.advertise');

            view('frontend.home.category',[
            'modify' => 'new',
            'products' => $productNews

            ]);

            view('frontend.home.blog');

            view('frontend.home.form-discount');
        ?>
        </div>
    </main>

<?php
partial('footer');