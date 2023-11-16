 <div class="row">
        <div class="col-12">
            <a href="/admin?type=product" class="return">
                <i class="bi bi-arrow-return-left"></i>
                <span>Quay lại</span>
            </a>
        </div>
        <div class="col-12">
                <form action="/admin?type=product&action=add" method="post" class="col-md-6 offset-md-3 admin-adding" enctype="multipart/form-data">
                    <h3 class="title-form">Thêm sản phẩm</h3>
                    <!-- Title product -->
                    <div class="form-group">
                        <label for="title">Tên sản phẩm</label>
                        <input type="text" name="title" class="form-control<?= isset($errors['title']) ? ' is-invalid' : '' ?>" maxlen="255" value="<?= isset($old['title']) ? htmlspecialchars($old['title']) : '' ?>" id="title" placeholder="Tên sản phẩm..." />

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
                                <input type="number" name="price" class="form-control<?= isset($errors['price']) ? ' is-invalid' : '' ?>" maxlen="255" value="<?= isset($old['price']) ? htmlspecialchars($old['price']) : '' ?>" id="price" placeholder="Giá sản phẩm..." />

                                <?php if (isset($errors['price'])) : ?>
                                    <span class="invalid-feedback">
                                        <strong><?= $errors['price'] ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                            <div class="col-md-5">
                                <label for="quantity">Số lượng</label>
                                <input type="number" name="quantity" class="form-control<?= isset($errors['quantity']) ? ' is-invalid' : '' ?>" value="<?= isset($old['quantity']) ? htmlspecialchars($old['quantity']) : '' ?>" maxlen="255" id="quantity" placeholder="Số lượng sản phẩm..." />

                                <?php if (isset($errors['quantity'])) : ?>
                                    <span class="invalid-feedback">
                                        <strong><?= $errors['quantity'] ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                            <div class="col-md-2">
                                <label for="category" class="form-label">Danh mục</label>
                                <select id="category" name="category" class="form-select">
                                    <option value="new" selected>Mới</option>
                                    <option value="popular" >Phổ biến</option>
                                    <option value="hot" >Hot</option>
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
                                <div class="preview-thumbnail" style="display:none">
                                    <div class="img-title">Hình ảnh</div>
                                    <img class="img-fluid" id="thumbnail-product" src="">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="layout" class="form-label">Thiết kế</label>
                                <select id="layout" name="layout" class="form-select">
                                    <option value="60%" selected>60%</option>
                                    <option value="65%">65%</option>
                                    <option value="75%">75%</option>
                                    <option value="80%">80%</option>
                                    <option value="87%">87%</option>
                                    <option value="100%">100%</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label for="switch" class="form-label">Switch</label>
                                <input type="text" name="switch" class="form-control" id="switch" value="<?= isset($old['switch']) ? htmlspecialchars($old['switch']) : '' ?>" placeholder="Switch...">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="connect" class="form-label ">Kết nối</label>
                                <input type="text" name="connect" class="form-control <?= isset($errors['connect']) ? ' is-invalid' : '' ?>" id="connect" value="<?= isset($old['connect']) ? htmlspecialchars($old['connect']) : '' ?>" placeholder="Kết nối...">
                            
                                 <?php if (isset($errors['connect'])) : ?>
                                    <span class="invalid-feedback">
                                        <strong><?= $errors['connect'] ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                            <div class="col-md-4">
                                <label for="led" class="form-label">Led</label>
                                <input type="text" name="led" class="form-control" id="led" value="<?= isset($old['connect']) ? htmlspecialchars($old['connect']) : '' ?>" placeholder="Led...">
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" name="submit" class="btn btn-blue"><i class="bi bi-plus-lg icon"></i>Thêm</button>
                </form>
        </div>
    </div>
<script>
    $(document).ready(function(){
        
        $('#thumbnail').on('change', function(event) {
            if (event.target.files.length > 0) {
                
                    var file = event.target.files[0];
                    var reader = new FileReader();

                    reader.onload = function(e) {

                        // Hiển thị ảnh trước khi tải lên
                        $('#thumbnail-product').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(file);

                    $('.preview-thumbnail').show();
                }
        });
    })
</script>