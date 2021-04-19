<?php
//include '../Controller/Canvas.php';
//include '../Model/CanvasDB.php';

if (isset($_POST['hidden_data'])) {
    $upload_dir = "../upload/";
    $img = $_POST['hidden_data'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = $upload_dir . $_SESSION['loggued_on_user'] . date('Y-m-d_g:i:s') . ".png";
    $collage = $_SESSION['loggued_on_user'] . date('Y-m-d_g:i:s');;
    $success = file_put_contents($file, $data);

//    $user = New user(array(
//        "login" => $_SESSION['loggued_on_user'],
//        "picture" => $collage,
//        "likes" => 0
//    ));
//    $user->addCollage();
//    unset($_POST['hidden_data']);
}