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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
                <div class="d-flex justify-content-between">
                    <a href="/" class="logo d-flex align-items-center">
                        <h2 class="text-uppercase mb-0">KeyBoard</h2>
                    </a>
                    <div class="action d-flex justify-content-around h-100">
                        <div class="account-wrapper">
                            <a href="<?= isset($infoUser['id']) ? "/admin?type=profile" : "/login" ?>" class="account d-flex align-items-center">
                                <div class="account-icon">
                                    <i class="fa-solid fa-user icon"></i>
                                </div>
                                <div class="account-title ">
                                    <h3 class="title mb-0"><?= htmlspecialchars($infoUser['fullname'] ?? $infoUser['username'] ?? "Đăng nhập")?></h3>
                                </div>
                            </a>
                            <?php if(isset($infoUser['id'])) :?>
                                        <div class="menu-user shadow">
                                            <a class="menu-item" href="/admin?type=profile">
                                                Thông tin tài khoản
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
    </header>