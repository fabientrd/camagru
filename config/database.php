<?php

function database_connect()
{
    $DB_DSN = "172.18.0.2";
    $DB_USER = "root";
    $DB_PASSWORD = "root";
    $DB_NAME = "camagru";

    $conn = new PDO("mysql:host=$DB_DSN", $DB_USER, $DB_PASSWORD);
    $conn->exec('CREATE DATABASE IF NOT EXISTS `camagru` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;');
    try {
        $db_conn = new PDO("mysql:host=$DB_DSN;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
        // set the PDO error mode to exception
        $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        {
//            echo "Connected successfully" . "<br>";
            return ($db_conn);
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit();
    }
}

//function database_select_create($username, $val)
//{
//    $array = [];
//    $db = database_connect();
//    $query = "select username, mail from user";
//    $stmt = $db->prepare($query);
//    $stmt->execute();
//
//    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)){
//        array_push($array, $data);
//    }
//    htmldump($array);
//    echo "USERNAME = " . $username . "<br/>";
//
//    if (isset($array)) {
//        foreach ($array as $k => $v) {
//            echo $k;
//            foreach ($v as $key => $value){
//                if ($username === $value || $val === $value) {
//                    if ($username === $value)
//                        return 1;
//                    else if ($val === $value)
//                        return 2;
//                }
//            }
//        }
//        return 0;
//    }
//    $stmt->closeCursor();
//}

//function database_confirmation_account($log, $cle){
//    $array = [];
//    $db = database_connect();
//    $query = "SELECT username, cle FROM user WHERE username LIKE :log";
//    $stmt = $db->prepare($query);
//    $stmt->execute(array(":log" => $log));
//    while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
//        array_push($array, $data);
//    var_dump($array);
//    echo $_SESSION['cle'];
//    foreach ($array as $k => $v){
//        if ($v['username'] === $log && $v['cle'] === $cle){
//            echo "\nok\n";
//            $query = "UPDATE user SET active=1 WHERE username LIKE :log";
//            $stmt = $db->prepare($query);
//            $stmt->execute(array(":log" => $log));
//            $_SESSION['co'] = $log;
//            $_SESSION['active'] = 1;
//        }
//    }
//}

//function database_new_pw($log, $mail, $new){
//    $array = [];
//    $db = database_connect();
//    $query = "SELECT username, mail FROM user WHERE username LIKE :log";
//    $stmt = $db->prepare($query);
//    $stmt->execute(array(":log" => $log));
//    while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
//        array_push($array, $data);
//    var_dump($array);
//    foreach ($array as $k => $v){
//        if ($v['username'] === $log && $v['mail'] === $mail){
//            echo "\nok\n";
//            $query = "UPDATE user SET passwd=:new WHERE username LIKE :log";
//            $stmt = $db->prepare($query);
//            $stmt->execute(array(":new" => hash('whirlpool', $new), ":log" => $log));
////            $_SESSION['co'] = $log;
//            return 1;
//        }
//    }
//    return 0;
//}

//function database_select_login($username, $val)
//{
//    $array = [];
//    $db = database_connect();
//    $query = "select * from user where username like :log";
//    $stmt = $db->prepare($query);
//    $stmt->execute(array(":log" => $username));
//
//    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)){
//        array_push($array, $data);
//    }
//   if (isset($array)) {
//        foreach ($array as $k => $v) {
//            if ($v['username'] === $username && $v['passwd'] === hash("whirlpool", $val)){
//                $_SESSION['login'] = $username;
//                $_SESSION['mail'] = $v['mail'];
//                $_SESSION['active'] = $v['active'];
//                $_SESSION['cle'] = $v['cle'];
//                $_SESSION['co'] = $username;
//                return 1;
//            }
//        }
//        return 0;
//    }
//    $stmt->closeCursor();
//}

//function database_create_account($post){
//
//    $db = database_connect();
//    $log = $post['login'];
//    $mail = $post['mail'];
//    $mdp = hash("whirlpool", $post['passwd1']);
//    $cle = md5(microtime(TRUE)*100000);
//    echo $mdp;
//    $query = "INSERT INTO user (username, mail, passwd, cle) VALUES (:log, :mail, :mdp, :cle)";
//    $stmt = $db->prepare($query);
//    $stmt->execute(array(":log" => $log, ":mail" => $mail, ":mdp" => $mdp, ":cle" => $cle));
//    $_SESSION['login'] = $log;
//    $_SESSION['passwd'] = $mdp;
//    $_SESSION['mail'] = $mail;
//    $_SESSION['cle'] = $cle;
//    $_SESSION['active'] = 0;
//    $_SESSION['co'] = $log;
//    $stmt->closeCursor();
//}

//function database_delete_table($login){
//    $db = database_connect();
//    $query = 'DELETE FROM user WHERE username LIKE :login';
//    $stmt = $db->prepare($query);
//    $stmt->execute(array(":login" => $login));
//    $stmt->closeCursor();
//}

//function database_modif_data($array){
//    if (!empty($array['login']))
//        $new_log = $array['login'];
//    else
//        $new_log = $_SESSION['login'];
//    if (!empty($array['mail']))
//        $new_mail = $array['mail'];
//    else
//        $new_mail = $_SESSION['mail'];
//    if (!empty($array['passwd1']))
//        $new_pw = hash('whirlpool', $array['passwd1']);
//    else
//        $new_pw = $_SESSION['passwd'];
//    $db = database_connect();
//    $query = "UPDATE user SET username=:username, mail=:mail, passwd=:pw WHERE username LIKE :login";
//    $stmt = $db->prepare($query);
//    $stmt->execute(array(":username" => $new_log, ":mail" => $new_mail, ":pw" => $new_pw, ":login" => $_SESSION['login']));
//    $_SESSION['login'] = $new_log;
//    $_SESSION['passwd'] = $new_pw;
//    $_SESSION['mail'] = $new_mail;
//    $stmt->closeCursor();
//}
