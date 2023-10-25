<body>
     <header class="shadow">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <div class="logo d-flex align-items-center">
                            <h2 class="text-uppercase mb-0">KeyBoard</h2>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tìm kiếm..." aria-label="Recipient's username"
                                    aria-describedby="button-addon">
                                <button class="btn px-4" type="button" id="button-addon">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="action d-flex justify-content-around h-100">
                            <div class="cart d-flex align-items-center">
                                <div class="account-icon">
                                    <i class="fa-solid fa-cart-shopping icon"></i>
                                </div>
                                <div class="cart-title">
                                    <h3 class="title mb-0">Giỏ hàng</h3>
                                </div>
                            </div>
                            <a href="<?= isset($infoUser['id']) ? "#" : "/login" ?>" class="account d-flex align-items-center">
                                <div class="account-icon">
                                    <i class="fa-solid fa-user icon"></i>
                                </div>
                                <div class="account-title ">
                                    <h3 class="title mb-0"><?= htmlspecialchars($infoUser['fullname'] ?? $infoUser['username'] ?? "Đăng nhập")?></h3>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container-xxl">
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <nav class="d-flex">
                            <a href="" class="nav-item"> <i class="fa-solid fa-house icon"></i> Trang chủ</a>
                            |<a href="" class="nav-item"> <i class="fa-solid fa-bag-shopping icon"></i> Danh mục</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>