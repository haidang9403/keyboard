 <div class="wrapper">
    <div class="user-list m-top-40">
        <table class="table">
            <thead >
                <tr class="table-heading">
                    <th class="table-item" scope="col">Họ và tên</th>
                    <th class="table-item" scope="col">Tên tài khoản</th>
                    <th class="table-item" scope="col">Mật khẩu</th>
                    <th class="table-item" scope="col">Email</th>
                    <th class="table-item" scope="col">Ngày tạo</th>
                    <th class="table-item" scope="col">Cập nhật</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($array_data as $data): ?>
                    <tr class="table-row">
                        <td class="table-item"><?=htmlspecialchars($data['fullname'])?></td>
                        <td class="table-item"><?=htmlspecialchars($data['username'])?></td>
                        <td class="table-item"><?=htmlspecialchars($data['password'])?></td>
                        <td class="table-item"><?=empty($data['email']) ? "Chưa đăng ký" : htmlspecialchars($data['email'])?></td>
                        <?php 
                            $dateNoTime = strtotime($data['created_at']);
                            $dateCreated = date("d-m-Y", $dateNoTime);
                            $dateNoTime = strtotime($data['updated_at']);
                            $dateUpdate = date("d-m-Y", $dateNoTime);
                        ?>
                        <td class="table-item"><?=htmlspecialchars($dateCreated)?></td>
                        <td class="table-item"><?=htmlspecialchars($dateUpdate)?></td>
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

    <script>
        // Pagition
        $(document).ready(function() {
            let URL_PAGINATE = '/admin?type=<?=$type?>&action=paginate';
            $(".page-link").on("click", function (e) {
                e.preventDefault();
                let page = $(this).attr("page");
                callback(URL_PAGINATE,{
                    page: page
                }, renderProductManager);
            });

            function renderProductManager(response){
                $('.wrapper').replaceWith(response);
                $('html, body').animate({scrollTop: 0}, 300);
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