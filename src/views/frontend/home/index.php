<?php
partial('header',[
    'pageTitle' => $pageTitle,
    'infoUser' => $infoUser
]);
partial('heading', [
    'infoUser' => $infoUser
]);
?>
<main>
        <div class="container">
        <?php 
            view('frontend.home.introduction',[
                'productIntro' => $productIntro,
                'banner' => './images/banners/banner-home.jpg'
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
                    'banner' => './images/banners/banner-popular.jpg',
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
        </div>
    </main>
    <script>
        $(document).ready(function() {

            // Add cart
            let URL_ADD_CART = '/cart?action=add';
            let dataCart = {};

            $('.product-cart button').on("click", function (e) {
                e.preventDefault();
                if(isLogin != null){ // Đã đăng nhập
                    let idProduct = $(this).data('id');
                    
                    dataCart.idProduct = idProduct;
    
                    callback(URL_ADD_CART, dataCart, renderCart);
                } else { // Chưa đăng nhập
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

                    // Tự động tắt toast sau 3 giây nếu nó vẫn đang hiển thị
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
partial('footer');