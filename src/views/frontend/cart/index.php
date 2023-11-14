<?php #$pageTitle , $cartItems, $infoUser , $order
?>

<?php
    partial('header',[
        'pageTitle' => $pageTitle
    ]);

    partial('heading',[
        'infoUser' => $infoUser
    ]);
?>
    <main>
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 text-white">
                    <li class="breadcrumb-item fs-5 text-white"><a href="index.html">Trang chủ</a></li>
                    <li class="breadcrumb-item fs-5 text-white active" aria-current="page">Giỏ hàng</li>
                </ol>
            </nav>
            <div class="cart">
                <div class="title--lg title">
                    Giỏ hàng
                </div>
                <div class="cart-content">
                    <?php if(!empty($cartItems)): ?>
                        <?php view('frontend.cart.cart-list',[
                            'cartItems' => $cartItems
                        ]);
                        ?>
                    <?php else: ?>
                        <div class="cart-empty rounded">
                            <p class="mb-0">Giỏ hàng hiện đang trống!</p>
                            <img src="./images/emptys/cart-empty.png" alt="">
                        </div>
                    <?php endif ?>
                    <form class="cart-form" action="/cart?action=order" method="POST">
                        <div class="row">
                            <div class="col-8">
                                <div class="cart-info rounded">
                                    <div class="info-address">
                                        <div class="title">Thông tin giao hàng</div>
                                        <div class="mb-3">
                                            <label for="inputFullname" class="form-label">Họ và tên người nhận </label>
                                            <input type="text" name="fullname" class="form-control <?= isset($errors['fullname']) ? ' is-invalid' : '' ?>" id="inputFullname" value="<?= isset($old['fullname']) ? htmlspecialchars($old['fullname']) : '' ?>" placeholder="Nhập họ và tên...">
                                            <?php if (isset($errors['fullname'])) : ?>
                                                <span class="invalid-feedback">
                                                    <strong><?= htmlspecialchars($errors['fullname']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Địa chỉ</label>
                                            <input type="text" name="address" class="form-control <?= isset($errors['address']) ? ' is-invalid' : '' ?>" id="address" value="<?= isset($old['address']) ? htmlspecialchars($old['address']) : '' ?>" placeholder="Số nhà, tên đường...">
                                             <?php if (isset($errors['address'])) : ?>
                                                <span class="invalid-feedback">
                                                    <strong><?= htmlspecialchars($errors['address']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputPhone" class="form-label">Số điện thoại</label>
                                            <input type="text" name="phone" class="form-control <?= isset($errors['phone']) ? ' is-invalid' : '' ?>" id="inputPhone" value="<?= isset($old['phone']) ? htmlspecialchars($old['phone']) : '' ?>" placeholder="(+84) 123 456 789"> 
                                             <?php if (isset($errors['phone'])) : ?>
                                                <span class="invalid-feedback">
                                                    <strong><?= htmlspecialchars($errors['phone']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="info-delivery-method">
                                        <div class="title"> Giao hàng</div>
                                        <input type="radio" class="btn-check" name="fees" id="fee1" autocomplete="off" value="12000" checked>
                                        <label class="btn btn-radio" for="fee1">
                                            Giao hàng tiết kiệm
                                            <p class="subcontent mb-0">&#8363;12.000( 3 - 5 ngày)</p>
                                        </label>

                                        <input type="radio" class="btn-check" name="fees" id="fee2" value="25000" autocomplete="off">
                                        <label class="btn btn-radio" for="fee2">
                                            Giao hàng nhanh
                                            <p class="subcontent mb-0">&#8363;25.000( 1 - 2 ngày)</p>
                                        </label>
                                    </div>
                                    <div class="info-pay-method">
                                        <div class="title"> Phương thức thanh toán</div>
                                        <input type="radio" class="btn-check" name="pay-method" id="cash-method" value="cash" autocomplete="off" checked>
                                        <label class="btn btn-radio" for="cash-method">
                                            Thanh toán khi nhận hàng
                                            <p class="subcontent mb-0">bằng tiền mặt</p>
                                        </label>
                                        
                                        <input type="radio" class="btn-check" name="pay-method" id="bank-method" value="bank" autocomplete="off">
                                        <!-- <label class="btn btn-radio" for="bank-method">
                                            Thanh toán online
                                            <p class="subcontent mb-0">qua thẻ tín dụng, visa,...</p>
                                        </label> -->
                                    </div>
                                    <div class="info-note">
                                        <div class="mb-3">
                                            <label for="noteCart" class="form-label">Lưu ý cho người bán</label>
                                            <textarea class="form-control" name="note" id="noteCart" rows="4" placeholder="Viết gì đó..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="cart-pay rounded">
                                    <div class="title">Thanh toán đơn hàng</div>
                                    <div class="total-price-product cart-pay__item">
                                        <div class="title">Tổng tiền hàng:</div>
                                        <div class="value"><small>₫</small><?php echo htmlspecialchars(number_format($total_money, 0, ",", "."))?></div>
                                    </div>
                                    <div class="fee-delivery cart-pay__item">
                                        <div class="title">Phí vận chuyển:</div>
                                        <div class="value"><small>₫</small><?php echo htmlspecialchars(number_format($fee, 0, ",", "."))?></div>
                                    </div>
                                    <div class="total-price-cart cart-pay__item">
                                        <div class="title">Tổng thanh toán:</div>
                                        <input type="number" hidden name="total_pay" value="<?=$total_pay?>" >
                                        <div class="value"><small>₫</small><?php echo htmlspecialchars(number_format($total_pay, 0, ",", "."))?></div>
                                    </div>
                                    <button type="submit" id="submitCart" class="btn <?= $total_money == 0 ? 'disabled' : ''?> btn-white"> Đặt hàng</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </main>
<?php
    partial('footer');
?>