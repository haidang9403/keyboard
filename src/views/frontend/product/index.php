<?php
partial("header", [
    'pageTitle' => $productInfo['title']
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
                    <li class="breadcrumb-item fs-5 text-white"><a href="/category">Danh mục</a></li>
                    <li class="breadcrumb-item fs-5 text-white active" aria-current="page"><?= htmlspecialchars($productInfo['title'] ?? "Sản phẩm")?></li>
                </ol>
            </nav>

            <div class="product-detail">
                <div class="title title-lg"><?=htmlspecialchars($productInfo['title'])?></div>
                <div class="row">
                    <div class="col-6">
                        <img src="<?=$productInfo['thumbnail']?>" alt="<?=$productInfo['title']?>" class="product-detail__img rounded">
                    </div>
                    <div class="col-6">
                        <div class="product-detail__info rounded">
                            <div class="product-quantyti">
                                Trong kho
                            </div>

                            <div class="product-detail-info__item product-layout">
                                <div class="row">
                                    <div class="col">
                                        <div class="title"> Thiết kế</div>
                                    </div>
                                    <div class="col">
                                        <div class="content"><?=htmlspecialchars($productInfo['layout'])?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-detail-info__item product-led">
                                <div class="row">
                                    <div class="col">
                                        <div class="title"> LED</div>
                                    </div>
                                    <div class="col">
                                        <div class="content"><?=htmlspecialchars($productInfo['led'])?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-detail-info__item product-switch">
                                <div class="row">
                                    <div class="col">
                                        <div class="title"> Switch</div>
                                    </div>
                                    <div class="col">
                                        <div class="content"><?=htmlspecialchars($productInfo['switch'])?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-detail-info__item product-connect">
                                <div class="row">
                                    <div class="col">
                                        <div class="title"> Kết nối</div>
                                    </div>
                                    <div class="col">
                                        <div class="content"><?=htmlspecialchars($productInfo['connect'])?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-cart">
                                <div class="d-flex align-items-end h-100">
                                        <div class="product-price">
                                            <?php echo htmlspecialchars(number_format($productInfo['price'], 0, ",", ".")) . " VNĐ"?>
                                        </div>
                                        <div class="product-choose-quantity">
                                            <div class="quantity-item quantity-decrease">
                                                <i class="bi bi-dash"></i>
                                            </div>
                                            <div class="quantity-item quantity-number rounded">
                                                1
                                            </div>
                                            <div class="quantity-item quantity-increase">
                                                <i class="bi bi-plus"></i>
                                            </div>
                                        </div>
                                    <button data-id="<?= $productInfo['id'] ?>" class="btn"><i class="fa-solid fa-cart-plus btn-icon"></i> Thêm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <script>

     </script>
            <?php
                partial('sub-category',[
                    'products' => $productOffers,
                    'title' => 'Sản phẩm khác',
                    'modify' => 'offer'
                ])
            ?>
        </div>
    </main>
<?php
partial("footer");
?>

