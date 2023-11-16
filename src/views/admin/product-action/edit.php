<?php #$data ?>
<div class="row">
        <div class="col-12">
            <a href="/admin?type=product" class="return">
                <i class="bi bi-arrow-return-left"></i>
                <span>Quay lại</span>
            </a>
        </div>
        <div class="col-12">
            <form action="/admin?type=product&action=edit" method="post" class="col-md-6 offset-md-3 admin-editing" enctype="multipart/form-data">
                    <h3 class="title-form">Chỉnh sửa thông tin</h3>
                    <input type="number" name="id" hidden value="<?=htmlspecialchars($data['id'])?>">
                    <!-- Title product -->
                    <div class="form-group">
                        <label for="title">Tên sản phẩm</label>
                        <input type="text" name="title" class="form-control<?= isset($errors['title']) ? ' is-invalid' : '' ?>" maxlen="255" value="<?=htmlspecialchars($data['title'])?>" id="title" placeholder="Tên sản phẩm..." />

                        <?php if (isset($errors['title'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['title'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <!-- Price and quantity -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="price">Giá tiền</label>
                                <input type="number" name="price" class="form-control<?= isset($errors['price']) ? ' is-invalid' : '' ?>" maxlen="255" value="<?=htmlspecialchars($data['price'])?>" id="price" placeholder="Giá sản phẩm..." />

                                <?php if (isset($errors['price'])) : ?>
                                    <span class="invalid-feedback">
                                        <strong><?= $errors['price'] ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                            <div class="col-md-4">
                                <label for="quantity">Số lượng</label>
                                <input type="number" name="quantity" class="form-control<?= isset($errors['quantity']) ? ' is-invalid' : '' ?>" value="<?=htmlspecialchars($data['quantity'])?>" maxlen="255" id="quantity" placeholder="Số lượng sản phẩm..." />

                                <?php if (isset($errors['quantity'])) : ?>
                                    <span class="invalid-feedback">
                                        <strong><?= $errors['quantity'] ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                            <div class="col-md-3">
                                <label for="category" class="form-label">Danh mục</label>
                                <select id="category" name="category" class="form-select">
                                    <option value="new" <?=$data['category'] == 'new' ? 'selected' : ''?>>Mới</option>
                                    <option value="popular" <?=$data['category'] == 'popular' ? 'selected' : ''?> >Phổ biến</option>
                                    <option value="hot" <?=$data['category'] == 'hot' ? 'selected' : ''?>>Hot</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Thumbnail -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="thumbnail">Chọn ảnh</label>
                                <input type="file" name="thumbnail" class="form-control<?= isset($errors['thumbnail_file']) ? ' is-invalid' : '' ?>" id="thumbnail"/>
                                <?php if (isset($errors['thumbnail_file'])) : ?>
                                    <span class="invalid-feedback">
                                        <strong><?= $errors['thumbnail_file'] ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                            <div class="col-md-6">
                                <div class="img-title">Hình ảnh</div>
                                <input type="text" hidden name="thumbnail_old" value="<?=htmlspecialchars($data['thumbnail'])?>">
                                <div class="text-center" id="loading" style="display: none;">
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <p>Đang tải...</p>
                                </div>
                                <img class="img-fluid" id="thumbnail-product" src="<?=$data['thumbnail']?>" alt="<?=htmlspecialchars($data['title'])?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="layout" class="form-label">Thiết kế</label>
                                <select id="layout" name="layout" class="form-select" >
                                    <option value="60%" <?=$data['layout'] == '60%' ? 'selected' : ''?>>60%</option>
                                    <option value="68%" <?=$data['layout'] == '68%' ? 'selected' : ''?>>68%</option>
                                    <option value="75%" <?=$data['layout'] == '75%' ? 'selected' : ''?>>75%</option>
                                    <option value="80%" <?=$data['layout'] == '80%' ? 'selected' : ''?>>80%</option>
                                    <option value="87%" <?=$data['layout'] == '87%' ? 'selected' : ''?>>87%</option>
                                    <option value="100%" <?=$data['layout'] == '100%' ? 'selected' : ''?>>100%</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label for="switch" class="form-label">Switch</label>
                                <input type="text" name="switch" class="form-control" id="switch" value="<?=htmlspecialchars($data['switch'])?>" placeholder="Switch...">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="connect" class="form-label ">Kết nối</label>
                                <input type="text" name="connect" class="form-control <?= isset($errors['connect']) ? ' is-invalid' : '' ?>" id="connect" value="<?=htmlspecialchars($data['connect'])?>" placeholder="Kết nối...">
                            
                                 <?php if (isset($errors['connect'])) : ?>
                                    <span class="invalid-feedback">
                                        <strong><?= $errors['connect'] ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                            <div class="col-md-4">
                                <label for="led" class="form-label">Led</label>
                                <input type="text" name="led" class="form-control" id="led" value="<?=htmlspecialchars($data['led'])?>" placeholder="Led...">
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" name="submit" class="btn btn-blue">Chỉnh sửa</button>
                </form>
        </div>
    </div>
<script>
    $(document).ready(function(){
        
        $('#thumbnail').on('change', function(event) {
            if (event.target.files.length > 0) {
                // Hiện loading
                $('#loading').show();
                
                    var file = event.target.files[0];
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        // Ẩn animation loading
                        $('#loading').hide();

                        // Hiển thị ảnh trước khi tải lên
                        $('#thumbnail-product').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(file);
                }
        });
    })
</script>