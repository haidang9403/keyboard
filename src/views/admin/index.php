<?php
    view("admin.header",[
        "pageTitle" => "Quản lý",
        "infoUser" => $infoUser
    ]);

    view("admin.${dataType}",[
        'data' => $data
    ]);

    view("admin.footer",);
?>