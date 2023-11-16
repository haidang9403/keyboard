$(document).ready(function () {

    // searching
    // Lắng nghe sự kiện khi người dùng nhấn Enter trong ô input
    $('#searchInput').keypress(function (event) {
        if (event.which === 13) { // Kiểm tra phím Enter
            search();
        }
    });

    // Lắng nghe sự kiện khi người dùng nhấn nút tìm kiếm
    $('#searchButton').click(function () {
        search();
    });

    // Hàm thực hiện tìm kiếm và chuyển hướng đến URL mới
    function search() {
        var keyword = $('#searchInput').val();
        if (keyword.trim() !== "") {
            var url = '/category?keyword=' + encodeURIComponent(keyword);
            window.location.href = url;
        }
    }

    // Lấy string query
    let urlParam = function (name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        return results !== null ? results[1] || 0 : false;
    }

    ////// Login
    $(".label-log").click(function () {
        if (!$(".login .checkbox").prop("checked")) {
            $(".login .checkbox").prop("checked", true);
        }
    });

    $(".label-reg").click(function () {
        if ($(".login .checkbox").prop("checked")) {
            $(".login .checkbox").prop("checked", false);
        }
    });


    ////////////////// Filter
    const priceInput = $('.input-group .filter-price')
    const rangeInput = $('.range-group .range');
    const progress = $('.slider .progress');

    let priceGap = parseInt(rangeInput.attr('step'));

    rangeInput.on('input', function () {
        let minVal = parseInt(rangeInput[0].value),
            maxVal = parseInt(rangeInput[1].value);

        if (maxVal - minVal < priceGap) {
            if ($(this).hasClass('range-min')) {
                rangeInput[0].value = maxVal - priceGap;
            } else {
                rangeInput[1].value = minVal + priceGap;
            }
        } else {
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            progress.css('left', `${(minVal / rangeInput[0].max) * 100}%`);
            progress.css('right', `${100 - ((maxVal / rangeInput[1].max) * 100)}%`);
        }

    });

    priceInput.on('input', function () {
        let minVal = parseInt(priceInput[0].value),
            maxVal = parseInt(priceInput[1].value);

        if ((maxVal - minVal >= priceGap) && (maxVal <= $(this).attr('max'))) {
            if ($(this).hasClass('price-min')) {
                rangeInput[0].value = minVal;
                progress.css('left', `${(minVal / rangeInput[0].max) * 100}%`);
            } else {
                rangeInput[1].value = maxVal;
                progress.css('right', `${100 - ((maxVal / rangeInput[1].max) * 100)}%`);
            }
        }
    });

    // Filter price
    let keyword = urlParam('keyword') ? '&keyword=' + urlParam('keyword') : '';
    const URL_FILTER = `/category?action=filter${keyword}`;
    let dataFilter = {}; // Lưu dữ liệu filter dạng oject
    let isInputting = false;

    let priceMin, priceMax;
    $('.range-max').on('input', function () {
        isInputting = true;
    })

    $('.range-min').on('input', function () {
        isInputting = true;
    })

    $(document).on('mouseup', () => {
        if (isInputting) {
            priceMax = $('.range-max').val();
            priceMin = $('.range-min').val();

            dataFilter.priceMax = priceMax;
            dataFilter.priceMin = priceMin;

            ajax(URL_FILTER, dataFilter, renderProduct);

            isInputting = false;
        }
    })

    $('input.is-invalid').on('input', function () {
        let input = $(this);
        input.removeClass('is-invalid');

        input.siblings('.is-invalid').removeClass('is-invalid');
        let $invalidFeedback = input.nextAll('.invalid-feedback');
        $invalidFeedback.remove();
    })


    // Filter size
    let sizeValues = [], size = {};
    $('.size-check').on('click', function () {
        // Lấy các giá trị của checkbox
        sizeValues = [];
        $('.size-check:checked').each(function () {
            sizeValues.push($(this).attr('value'));
        });

        size = JSON.stringify(sizeValues);

        dataFilter.size = size;

        ajax(URL_FILTER, dataFilter, renderProduct);
    });

    // Filter check
    let stateValues = [], state = {};
    $('.state-check').on('click', function () {
        // Lấy các giá trị của checkbox
        stateValues = [];
        $('.state-check:checked').each(function () {
            stateValues.push($(this).attr('value'));
        });

        state = JSON.stringify(stateValues);
        dataFilter.state = state;

        ajax(URL_FILTER, dataFilter, renderProduct);
    });

    let sort;
    $('.form-select').on('change', function () {
        sort = ($(this).val()).toUpperCase();
        dataFilter.sort = sort;

        ajax(URL_FILTER, dataFilter, renderProduct);
    });

    let layout;
    $('.layout-item').on("click", function () {
        $('.layout-item').removeClass('active');
        $(this).addClass('active');
        layout = ($(this).attr("value"));

        dataFilter.layout = layout;

        ajax(URL_FILTER, dataFilter, renderProduct);
    });

    // Function success filter
    function renderProduct(response) {
        $('.product-list-wrapper').html(response);
    }

    // Add product in page product details
    const URL_ADD_CART = '/cart?action=add';


    $('.product-detail__info .product-cart button').on("click", function (e) {
        e.preventDefault();
        if (isLogin != null) {
            let dataCart = {};
            let idProduct = $(this).data('id');
            let quantity = parseInt($('.product-cart .quantity-number').text());

            dataCart.idProduct = idProduct;
            dataCart.numProduct = quantity;

            ajax(URL_ADD_CART, dataCart, renderCart);
        } else {
            let myModal = new bootstrap.Modal(document.getElementById('notify-login'), {
                backdrop: 'static'
            });
            myModal.show();
            $('#modal-login').one('click',
                function () {
                    window.location.href = '/login';
                });
        }
    });


    let isToastVisible = false;
    function renderCart(response) {
        if (response != 'null') {
            $('.cart .num-product').html(response);
        } else {
            if (!isToastVisible) {
                $('.toast').show();
                isToastVisible = true;

                $('.toast .btn-close').on('click', function () {
                    $('.toast').hide();
                    isToastVisible = false;
                });

                // Tự động tắt toast sau 5 giây nếu nó vẫn đang hiển thị
                setTimeout(function () {
                    if (isToastVisible) {
                        $('.toast').hide();
                        isToastVisible = false;
                    }
                }, 5000);
            }
        }
    }

    // Ajax
    function ajax(url, data, success) {
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (response) {
                // Xử lý dữ liệu nhận được từ AJAX response
                success(response);
            },
            error: function (error) {
                console.error('Error:', error);
            }
        })
    }

    ////// Increase - Decrease number product
    $('.product-detail__info .quantity-increase').on("click", function () {
        let quantityElement = $(this).siblings('.quantity-number');
        let currentQuantity = parseInt(quantityElement.text());
        quantityElement.text(currentQuantity + 1);
    });

    $('.product-detail__info .quantity-decrease').on("click", function () {
        let quantityElement = $(this).siblings('.quantity-number');
        let currentQuantity = parseInt(quantityElement.text());
        if (currentQuantity > 1) {
            quantityElement.text(currentQuantity - 1);
        }
    });

    //// Method Delivery
    $('input[name=fees]').change(function () {
        var fee = $('input[name=fees]:checked').val();

        ajax('/cart?action=charge', { fee: fee }, renderPay);
    });

    function renderPay(jsonData) {
        let data = $.parseJSON(jsonData);
        $('.fee-delivery .value').html(data.fee);
        $('.total-price-cart .value').html(data.totalPay);
        $('.total-price-cart input').val(data.totalPayValue);
    }


    // Hide header bottom
    let lastScrollTop = 0;
    let headerBottomHeight = $('.header-bottom').outerHeight();

    $(window).scroll(function (event) {
        let st = $(this).scrollTop();

        if (st > lastScrollTop && st > headerBottomHeight) {
            $('.header-bottom').addClass('hide');
        } else {
            if (st + $(window).height() >= headerBottomHeight) {
                $('.header-bottom').removeClass('hide');
            }
        }

        lastScrollTop = st;
    });

    // validate password in change password
    $('.profile-info #password ').on('input', function () {
        let password = $(this).val();

        ajax('/profile?type=user&action=checkPass', { password }, handleInputPass);
    })

    function handleInputPass(dataJSON) {
        let data
    }
})