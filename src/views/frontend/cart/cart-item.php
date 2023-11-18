<?php #$cartItem ?>
    
    <div data-id="<?=$cartItem['id']?>" class="cart-product-list__item rounded">
        <a class="product-content" href="/product?id=<?=$cartItem["product_id"]?>">
            <img src="<?= $cartItem['thumbnail']?>" alt="<?= htmlspecialchars($cartItem['title']) ?>">
            <div class="product-name">
                <?= htmlspecialchars($cartItem['title']) ?>
            </div>
        </a>
        
        <div class="product-choose-quantity">

            <div class="quantity-item quantity-number rounded">
                <?= htmlspecialchars($cartItem['num']) ?>
            </div>

        </div>

        <div class="product-price">
            <small>₫</small><?php echo htmlspecialchars(number_format($cartItem['total_money'], 0, ",", "."))?>
        </div>
        <div class="product-delete">
            <i class="bi bi-x-lg"></i>
        </div>
    </div>