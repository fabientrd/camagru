<?php
include("../Controller/User.php");
include '../Controller/Canvas.php';
session_start();
session_destroy();
$pic = get_pic_arr($_SESSION['login']);
foreach ($pic as $k => $v) {
    delete_picture($v['picture']);
    unlink($v['picture']);
}
delete_account($_SESSION['login']);
header("Location: ../View/");