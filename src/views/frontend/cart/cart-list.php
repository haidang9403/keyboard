<?php #cartItems ?>
            

<div class="cart-produt-list">
        <?php
        if(!empty($cartItems)){
            foreach($cartItems as $item){
                view('frontend.cart.cart-item',[
                    'cartItem' => $item
                ]);
            }
        }
        else {
            // in ra giỏ hàng rỗng
        }
        ?>
    <script>
        $(document).ready(function (){
                // Delete product in cart
            let URL_DELETE_CART = '/cart?action=delete';

            $('.cart-product-list__item .product-delete').on('click', function () {
                let data = {};
                var orderDetailId = $(this).closest('.cart-product-list__item').data('id');
                data.orderDetailId = orderDetailId;
                ajax(URL_DELETE_CART, data, renderCart);
            })

                    // Ajax
            function ajax(url, data, success){
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

            function renderCart(jsonData) {
                let data = $.parseJSON(jsonData);
                $('.cart .num-product').html(data.numProduct);
                $('.cart-produt-list').replaceWith(data.cartList);
                $('.total-price-product .value').html(data.totalMoney);
                $('.total-price-cart .value').html(data.totalPay);
                $('.total-price-cart input').val(data.totalPayValue);

                if(data.totalMoney == 0){
                    $('#submitCart').addClass('disabled');
                }

                if(data.totalMoney > 0){
                    $('#submitCart').removeClass('disabled');
                }
            }
        });

    </script>

</div>