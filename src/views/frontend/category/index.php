<?php
partial("header", [
    'pageTitle' => "Danh mục bàn phím"
]);
partial('heading', [
    'infoUser' => $infoUser
]);
?>
    <main>
        <div class="container">
        <?php
            partial('breadcrumb');
        ?>
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
                                <?php
                                    view("frontend.category.toolbar-product");
                                ?>
                                <div class="product-list-wrapper">
                                    <?php
                                        partial("product-list",[
                                            'products' => $products,
                                            'layout' => 'vertical',
                                            'page_array'=> $page_array,
                                            'current_page' => $current_page
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