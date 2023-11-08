<?php # $page_array, $current_page, $products ?>

<div class="product-list">
    <div class="row g-3">
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
    <script>
        // Pagition
        $(document).ready(function() {
            let URL_PAGINATE = '/category?action=paginate';
            $(".page-link").on("click", function (e) {
                e.preventDefault();
                var page = $(this).attr("page");
                callback(URL_PAGINATE,{
                    page: page
                }, renderProductList);
            });

            function renderProductList(response){
                $('.product-list-wrapper').html(response);
            }


            // Add cart

            let URL_ADD_CART = '/cart?action=add';
            let dataCart = {};

            $('.product-cart button').on("click", function (e) {
                e.preventDefault();
                let idProduct = $(this).data('id');
                
                dataCart.idProduct = idProduct;

                callback(URL_ADD_CART, dataCart, renderCart);
            });

            function renderCart(response) {
                 $('.cart .num-product').html(response);
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
</div>