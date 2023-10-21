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

    $(".close-login").click(function () {
        $(".login .checkbox").prop("checked", false)
        $(".login.section").hide();
    });

    $(".action .account").click(function () {
        $(".login.section").show();
    })

    $(".login.section").mouseup(function (e) {
        if (e.button == 0) { // Nếu là chuột trái
            console.log()
            var container = $(".login.section");
            if (!$(".label-log").is(e.target) && !$(".label-reg").is(e.target) && !$(".reg-log").is(e.target)
                && !$(".card-3d-wrap").is(e.target) && !$(".card-3d-wrap *").is(e.target)) {
                $(".login .checkbox").prop("checked", false)
                container.hide();
            }
        }
    });
})