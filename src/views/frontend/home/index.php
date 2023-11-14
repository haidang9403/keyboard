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
                'products' => $productHots,
                'layout' => 'horizontal'
            ]);

            partial('sub-category',[
                'introduce' => [
                    'banner' => './images/banners/banner-blog.jpg',
                    'productIntro' => $productPopulars[0]
                ],
                'modify' => 'popular',
                'products' => array_slice($productPopulars, 1) // lấy từ phẩn tử thứ 2
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