<?php
partial("header", [
    'pageTitle' => $productInfo['title'],
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
                                <?php echo "Còn lại " . htmlspecialchars($productInfo['quantity']) . " sản phẩm"?>
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
                                            <small>₫</small><?php echo htmlspecialchars(number_format($productInfo['price'], 0, ",", "."))?>
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
            <?php
                partial('sub-category',[
                    'products' => $productOffers,
                    'title' => 'Sản phẩm khác',
                    'modify' => 'offer'
                ])
            ?>
        </div>
         <div class="toast linear align-items-center text-bg-warning border-0 " role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex align-items-center justify-content-between">
                <div class="toast-body">
                    Bạn đã thêm vượt quá số lượng
                </div>
                <button type="button" class="btn-close  me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <div class="modal" id="notify-login" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Chưa đăng nhập</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Đăng nhập để tiếp tục thao tác</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" id='modal-login'>Đăng nhập</button>
                </div>
            </div>
        </div>
    </div>
    </main>
    <script>
        $(document).ready(function() {

            let URL_ADD_CART = '/cart?action=add';
            let dataCart = {};

            $('.product-list .product-cart button').on("click", function (e) {
                e.preventDefault();
                if(isLogin != null){
                    let idProduct = $(this).data('id');
                    
                    dataCart.idProduct = idProduct;
    
                    callback(URL_ADD_CART, dataCart, renderCart);
                } else {
                    let myModal = new bootstrap.Modal(document.getElementById('notify-login'), {
                        backdrop: 'static'
                    });
                    myModal.show();
                    $('#modal-login').one('click',
                        function() {
                             window.location.href = '/login';
                    });
                }
            });

            function renderCart(response) {
                if(response != 'null'){
                    $('.cart .num-product').html(response);
                } else{
                    $('.toast').show();
                    let isToastVisible = true;
                    $('.toast .btn-close').on('click', function () {
                        $('.toast').hide();
                        isToastVisible = false;
                    });

                    setTimeout(function () {
                        if (isToastVisible) {
                            $('.toast').hide();
                            isToastVisible = false;
                        }
                    }, 5000);
                }
            }

            function callback(url,data,success) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    success: success,
                    error: function (error) {
                        console.error('Error:', error);
                    }
                })
            }
        });


    </script>
<?php
partial("footer");
?>

