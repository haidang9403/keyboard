<body>
    <div class="section login">
         <div class="container">
             <div class="row full-height justify-content-center">
                 <div class="col-12 text-center align-self-center py-5">
                     <div class="section pb-5 pt-5 pt-sm-2 text-center">
                         <input type="checkbox" hidden class="checkbox" name="reg-log" id="reg-log" checked>
                         <h6 class="mb-0 pb-3 label-text-log">
                             <label class="label-log" for="reg-log">Đăng nhập</label>
                             <label class="label-reg" for="reg-log">Đăng ký</label>
                         </h6>
                         <label class="reg-log" for="reg-log"></label>
                         <div class="card-3d-wrap mx-auto">
                             <div class="card-3d-wrapper">
                                 <form class="card-front" action="/login?action=login" method="POST">
                                     <div class="center-wrap">
                                         <div class="section text-center">
                                             <h4 class="mb-4 pb-3">Đăng nhập</h4>
                                         </div>
                                         <div class="form-group">
                                             <input type="text" name="username" class="form-style form-control <?= isset($errors['username']) ? ' is-invalid' : '' ?>" id="username"  value="<?= isset($old['username']) ? htmlspecialchars($old['username']) : '' ?>" placeholder="Tên tài khoản">
                                             <i class="input-icon bi bi-person<?= isset($errors['username']) ? ' is-invalid' : '' ?>"></i>
                                            <?php if (isset($errors['username'])) : ?>
                                                <span class="invalid-feedback">
                                                    <strong><?= htmlspecialchars($errors['username']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                         </div>
                                         <div class="form-group mt-3">
                                             <input type="password" name="password" id="password" class="form-style form-control <?= isset($errors['password']) ? ' is-invalid' : '' ?>" placeholder="Nhập mật khẩu">
                                             <i class="input-icon bi bi-lock <?= isset($errors['password']) ? ' is-invalid' : '' ?>"></i>
                                              <?php if (isset($errors['password'])) : ?>
                                                <span class="invalid-feedback">
                                                    <strong><?= htmlspecialchars($errors['password']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                         </div>
                                         <button href="#" class="btn btn-login mt-4">Đăng nhập</button>
                                         
                                         <p class="mb-0 mt-4 text-center">
                                             <a href="" class="link">Quên mật khẩu?</a>
                                         </p>
                                     </div>
                                 </form>
                                 <form class="card-back" action="/register" method="post">
                                     <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Đăng ký</h4>
                                        </div>
                                        <div class="form-group mt-3">
                                            <input type="text" name="signup-username" class="form-style form-control  <?= isset($errors['signup-username']) ? ' is-invalid' : '' ?>" id="signup-username"  value="<?= isset($old['signup-username']) ? htmlspecialchars($old['signup-username']) : '' ?>" placeholder="Tên tài khoản" autocomplete="off">
                                            <i class="input-icon bi bi-person <?= isset($errors['signup-username']) ? ' is-invalid' : '' ?>"></i>
                                            <?php if (isset($errors['signup-username'])) : ?>
                                                <span class="invalid-feedback">
                                                    <strong><?= htmlspecialchars($errors['signup-username']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>
                                        <div class="form-group mt-3">
                                            <input type="password" name="signup-password" id="signup-password" class="form-style  form-control <?= isset($errors['signup-password']) ? ' is-invalid' : '' ?>" placeholder="Nhập mật khẩu" autocomplete="off">
                                            <i class="input-icon bi bi-lock <?= isset($errors['signup-password']) ? ' is-invalid' : '' ?>"></i>
                                            <?php if (isset($errors['signup-password'])) : ?>
                                                <span class="invalid-feedback">
                                                    <strong><?= htmlspecialchars($errors['signup-password']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>
                                        <div class="form-group mt-3">
                                            <input type="password" name="confirm-password" id="confirm-password" class="form-style form-control <?= isset($errors['confirm-password']) ? ' is-invalid' : '' ?>" placeholder="Nhập mật khẩu" autocomplete="off">
                                            <i class="input-icon bi bi-repeat <?= isset($errors['confirm-password']) ? ' is-invalid' : '' ?>"></i>
                                            <?php if (isset($errors['confirm-password'])) : ?>
                                                <span class="invalid-feedback">
                                                    <strong><?= htmlspecialchars($errors['confirm-password']) ?></strong>
                                                </span>
                                            <?php endif ?>
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