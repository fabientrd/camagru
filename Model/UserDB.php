<?php

include('../config/database.php');

class UserDB
{

    private $_db;

    function __construct()
    {
        $this->_db = database_connect();
        return $this->_db;
    }

    public function database_select_create($username, $val)
    {
        $array = [];
        $query = "select username, mail from user";
        $stmt = $this->_db->prepare($query);
        $stmt->execute();
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($array, $data);
        }
        if (isset($array)) {
            foreach ($array as $k => $v) {
                echo $k;
                foreach ($v as $key => $value) {
                    if ($username === $value || $val === $value) {
                        if ($username === $value)
                            return 1;
                        else if ($val === $value)
                            return 2;
                    }
                }
            }
            return 0;
        }
        $stmt->closeCursor();
    }

    public function database_find_id($log)
    {
        $query = "SELECT id FROM user WHERE username LIKE :log";
        $stmt = $this->_db->prepare($query);
        $stmt->execute(array(":log" => $log));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($data['id']);
    }

    public function database_find_notif($log)
    {
        echo $log;
        $query = "SELECT notif FROM user WHERE username LIKE :log";
        $stmt = $this->_db->prepare($query);
        $stmt->execute(array(":log" => $log));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($data['notif']);
    }

    public function database_create_account($log, $mail, $mdp)
    {
        $cle = md5(microtime(TRUE) * 100000);
        $query = "INSERT INTO user (username, mail, passwd, cle) VALUES (:log, :mail, :mdp, :cle)";
        $stmt = $this->_db->prepare($query);

        $stmt->execute(array(":log" => $log, ":mail" => $mail, ":mdp" => $mdp, ":cle" => $cle));
        $_SESSION['login'] = $log;
        echo 'SESSION' . $_SESSION['login'];
        $_SESSION['passwd'] = $mdp;
        $_SESSION['mail'] = $mail;
        $_SESSION['cle'] = $cle;
        $_SESSION['active'] = 0;
        $_SESSION['co'] = $log;
        $_SESSION['id'] = $this->database_find_id($log);
        $_SESSION['notif'] = 1;
        $stmt->closeCursor();
    }

    public function database_confirmation_account($log, $cle)
    {
        $array = [];
//        $db = database_connect();
        $query = "SELECT username, cle FROM user WHERE username LIKE :log";
        $stmt = $this->_db->prepare($query);
        $stmt->execute(array(":log" => $log));
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
            array_push($array, $data);
        var_dump($array);
        echo $_SESSION['cle'];
        foreach ($array as $k => $v) {
            if ($v['username'] === $log && $v['cle'] === $cle) {
                echo "\nok\n";
                $query = "UPDATE user SET active=1 WHERE username LIKE :log";
                $stmt = $this->_db->prepare($query);
                $stmt->execute(array(":log" => $log));
                $_SESSION['co'] = $log;
                $_SESSION['active'] = 1;
            }
        }
    }

    public function database_select_login($username, $val)
    {
        $array = [];
        $query = "select * from user where username like :log";
        $stmt = $this->_db->prepare($query);
        $stmt->execute(array(":log" => $username));
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($array, $data);
        }
        if (isset($array)) {
            foreach ($array as $k => $v) {
                if ($v['username'] === $username && $v['passwd'] === hash("whirlpool", $val)) {
                    $_SESSION['login'] = $username;
                    $_SESSION['mail'] = $v['mail'];
                    $_SESSION['active'] = $v['active'];
                    $_SESSION['cle'] = $v['cle'];
                    $_SESSION['passwd'] = $v['passwd'];
                    $_SESSION['co'] = $username;
                    $_SESSION['id'] = $this->database_find_id($username);
                    $_SESSION['notif'] = $this->database_find_notif($username);
                    return 1;
                }
            }
            return 0;
        }
        $stmt->closeCursor();
    }

    public function database_new_pw($log, $mail, $new)
    {
        $array = [];
        $query = "SELECT username, mail FROM user WHERE username LIKE :log";
        $stmt = $this->_db->prepare($query);
        $stmt->execute(array(":log" => $log));
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
            array_push($array, $data);
        var_dump($array);
        foreach ($array as $k => $v) {
            if ($v['username'] === $log && $v['mail'] === $mail) {
                $stmt = $this->_db->prepare($query);
                $stmt->execute(array(":new" => hash('whirlpool', $new), ":log" => $log));
                return 1;
            }
        }
        return 0;
    }

    public function database_modif_data($array)
    {
        $login = htmlspecialchars($array['login'], ENT_QUOTES, 'UTF-8');
        echo htmlspecialchars($login, ENT_QUOTES, 'UTF-8');
        if (!empty($array['login']))
            $new_log = htmlspecialchars($login, ENT_QUOTES, 'UTF-8');
        else
            $new_log = $_SESSION['login'];
        if (!empty($array['mail']))
            $new_mail = $array['mail'];
        else
            $new_mail = $_SESSION['mail'];
        if (!empty($array['passwd1']))
            $new_pw = hash('whirlpool', $array['passwd1']);
        else
            $new_pw = $_SESSION['passwd'];
        if (isset($array['Notifications']))
            $new_notif = 1;
        else
            $new_notif = 0;
        echo $new_log;
//        $db = database_connect();
        $query = "UPDATE user SET username=:username, mail=:mail, passwd=:pw, notif=:notif WHERE username LIKE :login";
        $stmt = $this->_db->prepare($query);
        $stmt->execute(array(":username" => $new_log, ":mail" => $new_mail, ":pw" => $new_pw, ":notif" => $new_notif, ":login" => $_SESSION['login']));
        $_SESSION['login'] = $new_log;
        $_SESSION['passwd'] = $new_pw;
        $_SESSION['mail'] = $new_mail;
        $_SESSION['notif'] = $new_notif;
        echo $new_notif;
        $stmt->closeCursor();
    }

    public function database_delete_table($login)
    {
        $query = 'DELETE FROM user WHERE username LIKE :login';
        $stmt = $this->_db->prepare($query);
        $stmt->execute(array(":login" => $login));
        $stmt->closeCursor();
    }
}