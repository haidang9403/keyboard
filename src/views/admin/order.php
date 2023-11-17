 <div class="wrapper">
    <div class="order-list m-top-40">
        <table class="table">
            <thead >
                <tr class="table-heading">
                    <th class="table-item" scope="col">ID</th>
                    <th class="table-item" scope="col">Tài khoản</th>
                    <th class="table-item" scope="col">Tên người nhận</th>
                    <th class="table-item" scope="col">SĐT</th>
                    <th class="table-item" scope="col">Địa chỉ</th>
                    <th class="table-item" scope="col">Lời nhắn</th>
                    <th class="table-item" scope="col">Ngày đặt hàng</th>
                    <th class="table-item" scope="col">Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($array_data as $data): ?>
                    <tr class="table-row">
                        <td class="table-item"><?=htmlspecialchars($data['id'])?></td>
                        <td class="table-item"><?=htmlspecialchars($data['username'])?></td>
                        <td class="table-item"><?=htmlspecialchars($data['fullname'])?></td>
                        <td class="table-item"><?=htmlspecialchars($data['phone_number'])?></td>
                        <td class="table-item"><?=htmlspecialchars($data['address'])?></td>
                        <td class="table-item"><?=empty($data['note']) ? "Không có" : htmlspecialchars($data['note'])?></td>
                        <?php 
                            $dateNoTime = strtotime($data['order_date']);
                            $date = date("d-m-Y", $dateNoTime);
                        ?>
                        <td class="table-item"><?=htmlspecialchars($date)?></td>
                        <td class="table-item"><small>₫</small><?php echo htmlspecialchars(number_format($data['total_money'], 0, ",", "."))?></td>
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
                let type = '<?=$type?>';
                callback(URL_PAGINATE,{
                    page: page,
                    type: type
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