$(document).ready(function () {
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

    // $(".close-login").click(function () {
    //     $(".login .checkbox").prop("checked", false)
    //     $(".login.section").hide();
    // });

    // $(".action .account").click(function () {
    //     $(".login.section").show();
    // })

    // $(".login.section").mouseup(function (e) {
    //     if (e.button == 0) { // Nếu là chuột trái
    //         console.log()
    //         var container = $(".login.section");
    //         if (!$(".label-log").is(e.target) && !$(".label-reg").is(e.target) && !$(".reg-log").is(e.target)
    //             && !$(".card-3d-wrap").is(e.target) && !$(".card-3d-wrap *").is(e.target)) {
    //             $(".login .checkbox").prop("checked", false)
    //             container.hide();
    //         }
    //     }
    // });

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
    let isInputting = false;

    let priceMin, priceMax;
    $('.range-max').on('input', function () {
        isInputting = true;
    })

    $('.range-min').on('input', function () {
        isInputting = true;
    })

    let sizeValues = [], size;

    $('.size-check').on('click', function () {
        // Lấy các giá trị của checkbox
        sizeValues = [];
        $('.size-check:checked').each(function () {
            sizeValues.push($(this).attr('value'));
        });

        size = JSON.stringify(sizeValues);

        console.log(size)
        filterAjax({
            priceMax: priceMax,
            priceMin: priceMin,
            size: size
        })
    });

    $(document).on('mouseup', () => {
        if (isInputting) {
            priceMax = $('.range-max').val();
            priceMin = $('.range-min').val();

            filterAjax({
                priceMax: priceMax,
                priceMin: priceMin,
                size: size
            })

            isInputting = false;
        }
    })


    // Filter size

    // Ajax function to filter
    function filterAjax(data) {
        $.ajax({
            url: '/category?action=filter',
            type: 'POST',
            data: data,
            success: function (response) {
                // Xử lý dữ liệu nhận được từ AJAX response
                $('.product-list-wrapper').html(response);
            },
            error: function (error) {
                console.error('Error:', error);
            }
        })
    }
})