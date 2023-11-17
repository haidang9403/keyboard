<body>
     <header class="shadow">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <a href="/home" class="logo d-flex align-items-center">
                            <img src="./images/logo/logo-litekeys.svg" class="img-fluid" alt="">
                        </a>
                    </div>
                    <div class="col-5 d-flex align-items-center">
                        <div class="search w-100">
                            <div class="input-group">
                                <input type="text" id="searchInput" name="search" class="form-control" placeholder="Tìm kiếm..." aria-label="Recipient's username"
                                    aria-describedby="searchButton">
                                <button class="btn px-4" type="button" id="searchButton">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="action d-flex justify-content-around h-100">
                            <a href="<?= isset($infoUser['id']) ? "/cart" : "/login" ?>" class="cart d-flex align-items-center">
                                <div class="cart-icon">
                                    <i class="fa-solid fa-cart-shopping icon"></i>
                                    <?php if(isset($infoUser['id'])): ?>
                                    <div class="num-product"><?=htmlspecialchars($infoUser['num_product'])?></div>
                                    <?php endif ?>
                                </div>
                                <div class="cart-title">
                                    <h3 class="title mb-0">Giỏ hàng</h3>
                                </div>
                            </a>
                            <div class="account-wrapper d-flex align-items-center">
                                <a href="<?= isset($infoUser['id']) ? "/profile" : "/login" ?>" class="account d-flex align-items-center">
                                <div class="account-icon">
                                    <i class="fa-solid fa-user icon"></i>
                                </div>
                                <div class="account-title ">
                                    <h3 class="title mb-0"><?= htmlspecialchars($infoUser['fullname'] ?? $infoUser['username'] ?? "Đăng nhập")?></h3>
                                </div>
                                </a>
                                <?php if(isset($infoUser['id'])) :?>
                                <div class="menu-user shadow">
                                    <a class="menu-item" href="/profile">
                                        Thông tin tài khoản
                                    </a>
                                    <a class="menu-item" href="/profile?type=order">
                                        Đang vận chuyển
                                    </a>
                                    <a class="menu-item" href="/logout">
                                        Đăng xuất
                                    </a>
                                </div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <nav class="d-flex">
                            <a href="/" class="nav-item"> <i class="fa-solid fa-house icon"></i> Trang chủ</a>
                            |<a href="/category" class="nav-item"> <i class="fa-solid fa-bag-shopping icon"></i> Danh mục</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>