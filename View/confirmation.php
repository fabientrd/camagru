<?php

include "header.php";
//include "../config/database.php";
require_once ('../Model/UserDB.php');


if (isset($_GET) && !empty($_GET['log']) && !empty($_GET['cle']) && $_SESSION['cle'] === $_GET['cle']){
    $db = new UserDB();
    echo $_SESSION['login'];
    $db->database_confirmation_account($_SESSION['login'], $_GET['cle']);
    header("Location: ../View/");
}