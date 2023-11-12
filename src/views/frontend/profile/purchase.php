<?php if(empty($totalOrder)):# render ra hình ảnh chưa có đơn hàng?>
    <!-- Render đơn hàng trống -->
<?php else: ?>
    <?php foreach($totalOrder as $data): ?>
        <div class="accordion filter-content">
                <div class="accordion-item border-0 shipping-order">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseOne">
                            Đơn hàng#1 - 
                            12/10/2023 - 
                            Tổng tiền đ120.000
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <div data-id="" class="cart-product-list__item rounded">
                                <a class="product-content" href="">
                                    <img src="">
                                    <div class="product-name">
                                        Sản phẩm 1
                                    </div>
                                </a>
            
                                <div class="product-choose-quantity">
                                    <div class="quantity-item quantity-number rounded">
                                        12   
                                    </div>
                                </div>
    
                                <div class="product-price">
                                    <small>₫</small>120.000
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php endforeach ?>
<?php endif ?>
