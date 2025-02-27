<?php
// $productInfo
    if(isset($productInfo['category'])){
        $popular = "Phổ biến";
        $new = "Mới";
        $hot = "Hot";

        $state = 'badge--' . $productInfo['category'];
        $textState = ${$productInfo['category']};
    } else {
        $state = '';
        $textState = "Mới";
    }
?>
       <a href="/product?id=<?=$productInfo['id']?>" class="product-item-wrapper rounded">
            <div class="product-item product-item--horizontal gap-3">
                <div class="d-flex flex-column  w-50">
                    <div class="product-state">
                        <span class="badge <?=$state?> rounded text-bg-primary"><?=htmlspecialchars($textState) ?></span>
                    </div>
                    <div class="product-img">
                        <img src="<?=$productInfo['thumbnail']?>" alt="<?=$productInfo['title']?>">
                    </div>
                </div>
                <div class="d-flex flex-column w-50">
                    <div class="product-quantyti">
                        <?php echo htmlspecialchars($productInfo['quantity']) . ' sản phẩm'?>
                    </div>
                    <div class="product-name flex-grow-1">
                        <h3 class="name mb-0">
                            <?= htmlspecialchars($productInfo['title'])?>
                        </h3>
                    </div>
                    <div class="product-cart d-flex justify-content-between">
                        <h4 class="cash mb-0">
                            <small>₫</small><?php echo htmlspecialchars(number_format($productInfo['price'], 0, ",", "."))?>
                        </h4>
                        <button data-id="<?=$productInfo['id']?>" class="btn"><i class="fa-solid fa-cart-plus btn-icon"></i> Thêm</button>
                    </div>
                </div>
            </div>
        </a>