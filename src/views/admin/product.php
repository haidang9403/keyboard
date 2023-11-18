 <div class="wrapper">
        <div class="d-flex justify-content-end">
            <!-- <div class="search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Tìm kiếm..." aria-label="Recipient's username"
                        aria-describedby="button-addon">
                    <button class="btn px-4" type="button" id="button-addon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div> -->
    
            <a data-add="<?=$type?>-action" href="/admin?type=product&action=addView" class="add-item">
                <i class="bi bi-plus-lg icon"></i>
                <div class="text">
                    Thêm
                </div>
            </a>
        </div>
        <div class="product-manager-list m-top-40">
            <table class="table">
                <thead >
                    <tr class="table-heading">
                        <th class="table-item" scope="col">ID</th>
                        <th class="table-item" scope="col">Tên sản phẩm</th>
                        <th class="table-item" scope="col">Hình ảnh</th>
                        <th class="table-item" scope="col">Giá</th>
                        <th class="table-item" scope="col">Danh mục</th>
                        <th class="table-item" scope="col">Thông tin</th>
                        <th class="table-item" scope="col">Số lượng</th>
                        <th class="table-item" scope="col">Ngày tạo</th>
                        <th class="table-item" scope="col">Cập nhật</th>
                        <th class="table-item" scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($array_data as $data): ?>
                        <?php 
                            $dateNoTime = strtotime($data['created_at']);
                            $dateCreated = date("d-m-Y", $dateNoTime);
                            $dateNoTime = strtotime($data['update_at']);
                            $dateUpdate = date("d-m-Y", $dateNoTime);
    
                            if(isset($data['category'])){
                                $popular = "Phổ biến";
                                $new = "Mới";
                                $hot = "Hot";
                                $textState = ${$data['category']};
                            } else {
                                $state = '';
                                $textState = "Mới";
                            }
                        ?>
                        <tr class="table-row">
                            <td class="table-item"><?=htmlspecialchars($data['id'])?></td>
                            <td class="table-item"><?=htmlspecialchars($data['title'])?></td>
                            <td class="table-item"><img src="<?=htmlspecialchars($data['thumbnail'])?>" alt="<?=htmlspecialchars($data['title'])?>"></td>
                            <td class="table-item">
                                <small>₫</small><?php echo htmlspecialchars(number_format($data['price'], 0, ",", "."))?>
                            </td>
                            <td class="table-item"><?=htmlspecialchars($textState)?></td>
                            <td class="table-item"><?php 
                                echo 'Layout: ' . htmlspecialchars($data['layout']) . '<br>' .
                                'Switch: ' .  htmlspecialchars($data['switch']) . '<br>' .
                                'Led: ' .  htmlspecialchars($data['led']) . '<br>' .
                                'Kết nối: ' .  htmlspecialchars($data['connect']);
                            ?></td>
                            <td class="table-item"><?=htmlspecialchars($data['quantity'])?></td>
                            <td class="table-item"><?=htmlspecialchars($dateCreated)?></td>
                            <td class="table-item"><?=htmlspecialchars($dateUpdate)?></td>
                            <td class="table-item">
                                <a href="/admin?type=product&action=editView&id=<?=$data['id']?>">
                                    <i class="bi bi-pencil-square action-item edit"></i>
                                </a>
                                <i data-bs-toggle="modal" data-bs-target="#delete-confirm" data-id="<?=$data['id']?>" class="bi bi-trash3 action-item delete"></i>
                            </td>
                        </tr>                         
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if(isset($page_array)):?>
        <div class="pagination-wrapper">
            <nav aria-label="Page navigation" class="d-flex justify-content-center">
                <ul class="pagination">
                    <?php if(count($page_array) > 1): ?>
                        <li class="page-item <?= ($current_page == 1)? 'disable' : ''?>">
                            <span class="page-link" page="<?= ($current_page - 1)  ?>" href="#" aria-label="Previous">
                                <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                            </span>
                        </li>
                    
                        <?php foreach($page_array as $page){
                            switch($page){
                                case $current_page:
                                    echo "<span class=\"page-item active\"><span class=\"page-link\" page=\"$page\" href=\"#\">$page</span></span>";
                                    break;
                                case '...':
                                    echo "<span class=\"page-item disable\"><span class=\"page-link\" href=\"#\">...</span></span>";
                                    break;
                                default:
                                    echo "<span class=\"page-item\"><span class=\"page-link\" page=\"$page\" href=\"#\">$page</span></span>";
                            }
                        }
                        ?>
    
                    <li class="page-item <?= ($current_page == end($page_array))? 'disable' : ''?>">
                        <span class="page-link" href="#" page="<?= ($current_page + 1)  ?>"aria-label="Next">
                            <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                        </span>
                    </li>
                    <?php endif ?>
                </ul>
            </nav>
        </div>

        <div class="modal fade" id="delete-confirm" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="delete-confirm-label">Lưu ý</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Bạn có chắc muốn xóa sản phầm này không?
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="delete" class="btn btn-danger">Xóa</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Pagition
            $(document).ready(function() {
                const URL_PAGINATE = '/admin?type=<?=$type?>&action=paginate';
                $(".page-link").on("click", function (e) {
                    e.preventDefault();
                    let page = $(this).attr("page");
                    let type = '<?=$type?>';
                    callback(URL_PAGINATE,{
                        page: page
                    }, renderWrapper);
                });

                function renderWrapper(response){
                    $('.wrapper').replaceWith(response);
                     $('html, body').animate({scrollTop: 0}, 300);
                }

                $(".action-item.delete").on("click", function(){
                    let id = $(this).data('id');

                    $('#delete-confirm')
                    .modal({
                        backdrop: 'static', keyboard: false
                    })
                    .one(
                        'click',
                        '#delete',
                        function() {
                            callback('/admin?type=product&action=delete',{
                                id
                            },reloadPage);
                    });
                });

                function reloadPage() {

                    location.reload();
                }
    
                function callback(url,data,success) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: data,
                        success: success,
                        error: function (error) {
                            console.error('Error:', error);
                        }
                    })
                }
            });
        </script>
        <?php endif ?>

</div>