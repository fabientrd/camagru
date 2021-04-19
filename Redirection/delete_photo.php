<?php
include '../Controller/Canvas.php';
session_start();
delete_picture($_GET['pic']);
unlink($_GET['pic']);
header('Location: ../View/');