<?php
partial('header', [
    'pageTitle' => 'Đăng nhập'
]);
view('frontend.auth.login', [
    'errors' => $errors,
    'old' => $old
]);
?>