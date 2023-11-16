<div class="profile-purchase">

    <h3 class="profile-title">Đơn hàng đang vận chuyển</h3>
    <?php if(empty($totalOrder)):?>
        <img class="no-purchase" src="./images/emptys/no-shipping.png" alt="">
    <?php else: ?>
        <?php $index = 0 ?>
        <?php foreach($totalOrder as $data): ?>
            <div class="accordion order">
                    <div class="accordion-item border-0 shipping-order">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne<?=$index?>" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseOne">
                                Đơn hàng#<?=htmlspecialchars($data['order_id'])?> - 
                                <?=htmlspecialchars($data['order_date'])?> - 
                                Tổng tiền: ₫<?php echo htmlspecialchars(number_format($data['total_pay'], 0, ",", "."))?>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne<?=$index?>" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <?php foreach($data['items'] as $item): ?>
                                <div class="cart-product-list__item rounded">
                                    <div class="product-content">
                                        <img src="<?=htmlspecialchars($item['thumbnail'])?>">
                                        <div class="product-name">
                                            <?=htmlspecialchars($item['title'])?>
                                        </div>
                                    </div>
                
                                    <div class="product-choose-quantity">
                                        <div class="quantity-item quantity-number rounded">
                                            <?=htmlspecialchars($item['num'])?>  
                                        </div>
                                    </div>
        
                                    <div class="product-price">
                                        <small>₫</small><?php echo htmlspecialchars(number_format($item['total_money'], 0, ",", "."))?>
                                    </div>
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
                 <?php $index++ ?>
        <?php endforeach ?>
    <?php endif ?>
    <div class="profile-footer">
        Vận chuyển bởi Keyfast
    </div>
</div>
