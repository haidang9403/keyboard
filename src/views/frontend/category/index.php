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
                                            'layout' => 'vertical'
                                        ]);
                                    ?>
                                </div>
                            </div>
                            <nav aria-label="Page navigation" class="d-flex justify-content-center">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                                    <li class="page-item"><a class="page-link" href="#">9</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
    partial('footer');
?>