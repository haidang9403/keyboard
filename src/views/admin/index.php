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
                            <a href="/admin?type=profile" class="nav-item rounded <?=$type == 'profile' ? " active " : ''?>">
                                <div class="nav-link d-flex align-item-center">
                                    <i class="bi bi-person-circle nav-link__icon"></i>
                                    <div class="nav-link__text">
                                        Thông tin
                                    </div>
                                </div>
                            </a>
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
                    <?php
                        view("admin.$type",[
                            "array_data" => $data,
                            "page_array" => $page_array,
                            "current_page" => $current_page,
                            "type" => strval($type),
                            'infoUser' => $infoUser,
                            'errors' => $errors
                        ]);
                    ?>
                </div>
            </div>
        <!-- </div> -->
    </main>
<?php

    view("admin.footer",);
?>