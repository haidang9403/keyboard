<div class="profile-info">
                        <div class="row">
                            <div class="col-12">
                                <div class="avatar d-flex align-items-center flex-column">
                                    <img src="./images/avatar/person-circle.svg" class="rounded-circle mb-3" style="width: 150px;"
                                    alt="Avatar" />

                                    <h3 class="mb-2 name"><strong><?=htmlspecialchars($infoUser['fullname'])?></strong> <span class="badge bg-primary">Khách hàng</span></h3>
                                    <p class="username"><?=htmlspecialchars($infoUser['username'])?></p>
                                </div>
                            </div>
                            <div class="offset-2 col-8">
                                <form>
                                    <div class="row mb-5">
                                        <label for="fullname" class="col-sm-2 col-form-label">Họ và tên</label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?=htmlspecialchars($infoUser['fullname'])?>" id="fullname" placeholder="Nhập họ và tên...">
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                        <input type="email" class="form-control" <?=isset($infoUser['email']) ? htmlspecialchars($infoUser['email']) : ''?> id="email" placeholder="Nhập email...">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Thay đổi</button>
                                </form>
                            </div>
                        </div>
                    </div>