<?php
    if(isset($productInfo['category'])){
        $popular = "Phổ biến";
        $new = "Mới";
        $discount = "Giảm giá";

        $state = 'badge--' . $productInfo['category'];
        $textState = ${$productInfo['category']};
    } else {
        $state = '';
        $textState = "Mới";
    }
?>
 <div class="product-item-wrapper rounded">
    <div class="product-item d-flex flex-column">
        <div class="info d-flex justify-content-between">
            <div class="product-state">
                <span class="badge <?=$state?> rounded text-bg-primary"><?= htmlspecialchars($textState)?></span>
            </div>
            <div class="product-quantyti">
                 <?php 
                    echo 'Còn lại ' . htmlspecialchars(($productInfo['quantity']) . "")
                 ?>
            </div>
        </div>
        <div class="product-img">
            <img src="./images/uploads/product-1.webp" alt="">
        </div>
        <div class="product-name">
            <h3 class="name mb-0">
                Ducky One 2 Mini
            </h3>
        </div>
        <div class="product-cart d-flex justify-content-between align-items-end flex-grow-1">
            <h4 class="cash mb-0">
                2.800.000 VNĐ
            </h4>
            <button class="btn"><i class="fa-solid fa-cart-plus btn-icon"></i> Thêm</button>
        </div>
    </div>
</div>