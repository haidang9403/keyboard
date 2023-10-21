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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
    <div class="section login">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                        <input type="checkbox" hidden class="checkbox" name="reg-log" id="reg-log">
                        <h6 class="mb-0 pb-3 label-text-log">
                            <label class="label-log" for="reg-log">Đăng nhập</label>
                            <label class="label-reg" for="reg-log">Đăng ký</label>
                        </h6>
                        <label class="reg-log" for="reg-log"></label>
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <form class="card-front">
                                    <div class="close-login"><i class="close-icon bi bi-x-lg"></i></div>
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Đăng nhập</h4>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-style" id="username" placeholder="Tên tài khoản" autocomplete="off">
                                            <i class="input-icon bi bi-person"></i>
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="password" name="password" id="password" class="form-style" placeholder="Nhập mật khẩu" autocomplete="off">
                                            <i class="input-icon bi bi-lock"></i>
                                        </div>
                                        <button href="#" class="btn btn-login mt-4">Đăng nhập</button>
                                        
                                        <p class="mb-0 mt-4 text-center">
                                            <a href="" class="link">Quên mật khẩu?</a>
                                        </p>
                                    </div>
                                </form>
                                <form class="card-back">
                                    <div class="close-login"><i class="close-icon bi bi-x-lg"></i></div>
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Đăng ký</h4>
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="text" name="signup-username" class="form-style" id="signup-username" placeholder="Tên tài khoản" autocomplete="off">
                                            <i class="input-icon bi bi-person"></i>
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="password" name="signup-password" id="signup-password" class="form-style" placeholder="Nhập mật khẩu" autocomplete="off">
                                            <i class="input-icon bi bi-lock"></i>
                                        </div>
                                         <div class="form-group mt-2">
                                            <input type="password" name="re-password" id="re-password" class="form-style" placeholder="Nhập mật khẩu" autocomplete="off">
                                            <i class="input-icon bi bi-repeat"></i>
                                        </div>
                                        <button href="#" class="btn btn-login mt-4">Đăng ký</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
</body>
</html>