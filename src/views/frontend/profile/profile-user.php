<div class="profile-info">
    <div class="row">
        <div class="col-12">
            <div class="avatar d-flex align-items-center flex-column">
                <img src="./images/avatar/person-circle.svg" class="rounded-circle mb-3" style="width: 150px;"
                alt="Avatar" />

                <h3 class="mb-2 name"><strong><?=htmlspecialchars($infoUser['fullname'])?></strong> <span class="badge bg-primary">Khách hàng</span></h3>
                <p class="username">Tên tài khoản: <?=htmlspecialchars($infoUser['username'])?></p>
            </div>
        </div>
        <div class="offset-2 col-8">
            <form action="/profile?type=user&action=edit" method="POST">
                <div class="row mb-5">
                    <label for="fullname" class="col-sm-3 col-form-label">Họ và tên</label>
                    <div class="col-sm-9">
                        <input type="text" name="fullname" class="form-control <?= isset($errors['fullname']) ? ' is-invalid' : '' ?>" value="<?=htmlspecialchars($infoUser['fullname'])?>" id="fullname" placeholder="Nhập họ và tên...">
                        <?php if (isset($errors['fullname'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['fullname'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>
                </div>
                <div class="row mb-5">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" name="email" class="form-control <?= isset($errors['email']) ? ' is-invalid' : '' ?>"   <?= isset($infoUser['email']) ? 'value="'. htmlspecialchars($infoUser['email']).'"' : ''?> id="email" placeholder="Nhập email...">
                        <?php if (isset($errors['email'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['email'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Thay đổi</button>
            </form>
        </div>
    </div>
</div>