<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>
        <?= $pageTitle ?? "E Commerce Keyboard";
        ?>
    </title>
</head>
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
                            <div class="account d-flex align-items-center">
                                <div class="account-icon">
                                    <i class="fa-solid fa-user icon"></i>
                                </div>
                                <div class="account-title ">
                                    <h3 class="title mb-0">Đăng nhập</h3>
                                </div>
                            </div>
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