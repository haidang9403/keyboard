<?php
partial('header',[
    'pageTitle' => $pageTitle
]);
partial('heading', [
    'infoUser' => $infoUser
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

            partial('sub-category',[
                'modify' => 'hot',
                'products' => $productDiscounts,
                'layout' => 'horizontal'
            ]);

            partial('sub-category',[
                'introduce' => [
                    'banner' => './images/banners/banner-blog.jpg',
                    'productIntro' => $productIntro
                ],
                'modify' => 'popular',
                'products' => $productPopulars
            ]);

            view('frontend.home.advertise');

            partial('sub-category',[
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