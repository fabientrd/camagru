<?php
session_start();
include("../Controller/Canvas.php");

$notify = find_notif($_POST['picname']);
if (!empty($_POST['com'])) {
    add_comment($_POST);
    echo $notify;
    if ($notify === 1)
        notify_comment($_POST);
}
$like = check_like($_POST['picname'], $_SESSION['id']);
if ($like === 0 && isset($_POST['like']) || ($like === 1 && !isset($_POST['like'])))
    modif_like($_POST);
header('Location: ../View/gallery.php?page=1');