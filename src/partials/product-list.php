<?php # $page_array, $current_page, $products, $total_num ?>

<div class="product-list">
    <div class="row g-3">
        <?php if(!empty($products)) : ?>
            <?php
            $layout = $layout ?? 'vertical';
            $classCol = $layout == "horizontal" ? "col-6" : "col-4";
            foreach($products as $product){
                echo "<div class=\"" .$classCol . "\">";
                partial("product-" . $layout,[
                    'productInfo' => $product
                ]);

                echo "</div>";

            }
            ?>
        <?php else: ?>
            <div class="no-result rounded">
                <img src="./images/emptys/no-search.png" alt="">
                <p>Không tìm thấy kết quả!</p>
            </div>
        <?php endif ?>
    </div>
</div>
    <?php if(isset($page_array)):?>
    <nav aria-label="Page navigation" class="d-flex justify-content-center">
        <ul class="pagination">
            <?php if(count($page_array) > 1): ?>
                <li class="page-item <?= ($current_page == 1)? 'disable' : ''?>">
                    <span class="page-link" page="<?= ($current_page - 1)  ?>" href="#" aria-label="Previous">
                        <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                    </span>
                </li>
           
                <?php foreach($page_array as $page){
                    switch($page){
                        case $current_page:
                            echo "<span class=\"page-item active\"><span class=\"page-link\" page=\"$page\" href=\"#\">$page</span></span>";
                            break;
                        case '...':
                            echo "<span class=\"page-item disable\"><span class=\"page-link\" href=\"#\">...</span></span>";
                            break;
                        default:
                            echo "<span class=\"page-item\"><span class=\"page-link\" page=\"$page\" href=\"#\">$page</span></span>";
                    }
                }
                ?>

            <li class="page-item <?= ($current_page == end($page_array))? 'disable' : ''?>">
                <span class="page-link" href="#" page="<?= ($current_page + 1)  ?>"aria-label="Next">
                    <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                </span>
            </li>
            <?php endif ?>
        </ul>
    </nav>
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
    <script>
        $(document).ready(function() {

            let urlParam = function (name) {
                var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
                return results !== null ? results[1] || 0 : false;
            }
                    
            let keyword = urlParam('keyword') ? '&keyword=' + urlParam('keyword') : '';
            let URL_PAGINATE = '/category?action=paginate' + keyword;
            $(".page-link").on("click", function (e) {
                e.preventDefault();
                var page = $(this).attr("page");
                callback(URL_PAGINATE,{
                    page: page
                }, renderProductList);
            });

            function renderProductList(response){
                $('.product-list-wrapper').html(response);
                $('html, body').animate({scrollTop: 0}, 300);
            }

            let URL_ADD_CART = '/cart?action=add';
            let dataCart = {};

            $('.product-cart button').on("click", function (e) {
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
    <?php endif ?>