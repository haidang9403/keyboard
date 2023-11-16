<?php
partial("header", [
    'pageTitle' => "Danh mục bàn phím",
    'infoUser' => $infoUser
]);
partial('heading', [
    'infoUser' => $infoUser
]);
?>
    <main>
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 text-white">
                    <li class="breadcrumb-item fs-5 text-white"><a href="/">Trang chủ</a></li>
                    <li class="breadcrumb-item fs-5 text-white" aria-current="page">Danh mục</li>
                </ol>
            </nav>
            <div class="category">
                <div class="title title--lg">Danh mục</div>
                <div class="category-product">
                    <div class="row g-3">
                        <div class="col-3">
                            <?php
                                view('frontend.category.filter');
                            ?>
                        </div>
                        <div class="col-9">
                            <div class="wrapper position-relative">
                                <?php if($keyword): ?>
                                    <div class="search-keyword">
                                        <p class="mb-0">Từ khóa tìm kiếm "<strong><?=htmlspecialchars($keyword)?></strong>"</p>
                                        <a href="/category" class="search-close"><i class="bi bi-x"></i></a>
                                    </div>
                                <?php endif ?>
                                <?php
                                    view("frontend.category.toolbar-product");
                                ?>
                                <div class="product-list-wrapper">
                                    <?php

                                        partial("product-list",[
                                            'products' => $products,
                                            'layout' => 'vertical',
                                            'page_array'=> $page_array,
                                            'current_page' => $current_page,
                                            'infoUser' => $infoUser
                                        ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
    partial('footer');
?>