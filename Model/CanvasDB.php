<?php
require_once '../config/database.php';

class CanvasDB
{

    private $_db;

    function __construct()
    {
        $this->_db = database_connect();
        return $this->_db;
    }

    function canvas_check($pic)
    {
        $array = [];
        $query = 'SELECT picture FROM data';
        $stmt = $this->_db->prepare($query);
        $stmt->execute();
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
            array_push($array, $data);
        if (!empty($array)) {
            foreach ($array as $k => $v) {
                if ($v['picture'] === $pic)
                    return 0;
            }
        }
        return 1;
    }

    function canvas_add($pic)
    {
        $query = 'INSERT INTO data (id_user, picture) VALUE (:id, :pic)';
        $stmt = $this->_db->prepare($query);
        $stmt->execute(array(":id" => intval($_SESSION['id']), ":pic" => $pic));
        $stmt->closeCursor();
    }

    function canvas_del($pic)
    {
        $query = 'DELETE FROM data WHERE picture LIKE :pic';
        $stmt = $this->_db->prepare($query);
        $stmt->execute(array(":pic" => $pic));
    }

    function canvas_array()
    {
        $array = [];
        $query = 'SELECT picture FROM data ORDER BY id desc ';
        $stmt = $this->_db->prepare($query);
        $stmt->execute();
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
            array_push($array, $data);
        $stmt->closeCursor();
        return ($array);
    }

    function canvas_array_id($id)
    {
        $array = [];
        $query = 'SELECT picture FROM data WHERE id_user LIKE :id ORDER BY id desc ';
        $stmt = $this->_db->prepare($query);
        $stmt->execute(array(":id" => $id));
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
            array_push($array, $data);
        $stmt->closeCursor();
        return ($array);
    }

    function canvas_idpic($picname)
    {
        $array = [];
        $query = 'SELECT id FROM data WHERE picture LIKE :pic';
        $stmt = $this->_db->prepare($query);
        $stmt->execute(array(":pic" => $picname));
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
            array_push($array, $data);
        $array = $array[0];
        $stmt->closeCursor();
        return ($array['id']);
    }

    function canvas_idusr($picname)
    {
        $array = [];
        $query = 'SELECT id_user FROM data WHERE picture LIKE :pic';
        $stmt = $this->_db->prepare($query);
        $stmt->execute(array(":pic" => $picname));
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
            array_push($array, $data);
        $array = $array[0];
        $stmt->closeCursor();
        return ($array['id_user']);
    }

    function canvas_comment($com, $id, $id_pic)
    {
        $query = 'INSERT INTO comment (id_pic, id_user, com) VALUES (:id_pic, :id, :com)';
        $stmt = $this->_db->prepare($query);
        $stmt->execute(array(":id_pic" => $id_pic, ":id" => $id, ":com" => $com));
        $stmt->closeCursor();
    }

    function find_mail($id_usr)
    {
        $array = [];
        $query = 'SELECT mail FROM user WHERE id LIKE :id_usr';
        $stmt = $this->_db->prepare($query);
        $stmt->execute(array(":id_usr" => $id_usr));
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
            array_push($array, $data);
        $array = $array[0];
        $stmt->closeCursor();
        return $array['mail'];
    }

    function canvas_delcom($id)
    {
        $query = 'DELETE FROM comment WHERE id_pic LIKE :id';
        $stmt = $this->_db->prepare($query);
        $stmt->execute(array(":id" => $id));
        $query = 'DELETE FROM likes WHERE id_photo LIKE :id';
        $stmt = $this->_db->prepare($query);
        $stmt->execute(array(":id" => $id));

        $stmt->closeCursor();
    }

    function canvas_like($pic, $id)
    {
        $arr = [];
        $query = 'SELECT id_user FROM likes WHERE id_photo LIKE :pic';
        $id_pic = $this->canvas_idpic($pic);
        $stmt = $this->_db->prepare($query);
        $stmt->execute(array(":pic" => $id_pic));
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
            array_push($arr, $data);
        foreach ($arr as $k => $v) {
            if ($v['id_user'] === $id)
                return 1;
        }
        return 0;
    }

    function canvas_modif_like($like, $pic){
        if ($like === 0){
            $query = 'DELETE FROM likes WHERE id_photo LIKE :pic';
            $id_pic = $this->canvas_idpic($pic);
            $stmt = $this->_db->prepare($query);
            $stmt->execute(array(":pic" => $id_pic));
        }
        else{
            $query = 'INSERT INTO likes (id_user, id_photo) VALUES (:id, :pic)';
            $id_pic = $this->canvas_idpic($pic);
            $stmt = $this->_db->prepare($query);
            $stmt->execute(array(":id" => $_SESSION['id'], ":pic" => $id_pic));
        }
    }

    function canvas_notif($id){
        $arr =[];
        $query = 'SELECT notif FROM user WHERE id LIKE :id';
        $stmt = $this->_db->prepare($query);
        $stmt->execute(array(":id" => $id));
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
            array_push($arr, $data);
        $arr = $arr[0];
        return (intval($arr['notif']));

    }

    function canvas_findid($log){
        $arr  = [];
        $query = 'SELECT id FROM user WHERE username LIKE :log';
        $stmt = $this->_db->prepare($query);
        $stmt->execute(array(":log" => $log));
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
            array_push($arr, $data);
        $arr = $arr[0];
        return $arr['id'];
    }
}
