<?php
include "../Controller/User.php";
session_start();
session_destroy();
header("Location: ../View/");