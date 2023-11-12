<?php
    view("admin.header",[
        "pageTitle" => $pageTitle,
        "infoUser" => $infoUser
    ]);

    // view("admin.${type}",[
    //     'data' => $data
    // ]);
?>
    <main class="admin">
        <!-- <div class="container"> -->
            <div class="row g-3">
                <div class="col-2">
                    <nav class="navbar p-0">
                        <div class="navlist">
                            <a href="/admin?type=user" class="nav-item rounded <?=$type == 'user' ? " active " : ''?>">
                                <div class="nav-link d-flex align-item-center">
                                    <i class="bi bi-people nav-link__icon"></i>
                                    <div class="nav-link__text">
                                        Người dùng
                                    </div>
                                </div>
                            </a>
                            <a href="/admin?type=product" class="nav-item rounded <?=$type == 'product' ? " active " : ''?>">
                                <div class="nav-link d-flex align-item-center">
                                    <i class="bi bi-box-seam nav-link__icon"></i>
                                    <div class="nav-link__text">
                                        Sản phẩm
                                    </div>
                                </div>
                            </a>
                            <a href="/admin?type=order" class="nav-item rounded <?=$type == 'order' ? " active " : ''?>">
                                <div class="nav-link d-flex align-item-center">
                                    <i class="bi bi-cart4 nav-link__icon"></i>
                                    <div class="nav-link__text">
                                        Đơn hàng
                                    </div>
                                </div>
                            </a>
                        </div>
                    </nav>
                </div>
                <div class="col-10">
                    <div class="wrapper">
                        <?php
                            switch($action){
                                case 'add':
                                    view("admin.product-action.add",[
                                        "type" => strval($type),
                                        'old' => $old,
                                        'errors' => $errors
                                    ]);
                                    break;
                                case 'edit':
                                    view("admin.product-action.edit",[
                                        "type" => strval($type),
                                        "data" => $data,
                                        'errors' => $errors
                                    ]);
                                    break;
                                default:
                                    NOT_FOUND();
                            }
                        ?>
                    </div>
                </div>
            </div>
        <!-- </div> -->
    </main>
<?php

    view("admin.footer",);
?>