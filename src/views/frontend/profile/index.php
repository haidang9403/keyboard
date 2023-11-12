<?php
    partial('header',[
        'pageTitle' => "Thông tin cá nhân"
    ]);

    partial('heading',[
        'infoUser' => $infoUser
    ]);
?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="profile-nav">
                    <nav class="navbar p-0">
                        <div class="navlist">
                            <a href="/profile?type=user" class="nav-item rounded <?=$type == 'user' ? " active " : ''?>">
                                <div class="nav-link d-flex align-item-center">
                                    <i class="bi bi-person-circle nav-link__icon"></i>
                                    <div class="nav-link__text">
                                        Thông tin tài khoản
                                    </div>
                                </div>
                            </a>
                            <a href="/profile?type=order" class="nav-item rounded <?=$type == 'order' ? " active " : ''?>">
                                <div class="nav-link d-flex align-item-center">
                                    <i class="fa-solid fa-truck-fast nav-link__icon"></i>
                                    <div class="nav-link__text">
                                        Đang vận chuyển
                                    </div>
                                </div>
                            </a>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-9">
                <div class="profile-content">
                    <?php
                        switch($type){
                            case 'user':
                                view('frontend.profile.profile-user',[
                                    'infoUser' => $infoUser
                                ]);
                                break;
                            case 'order':
                                view('frontend.profile.purchase',[
                                    'totalOrder' => $totalOrder
                                ]);
                                break;
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>


<?php
    partial('footer');
?>