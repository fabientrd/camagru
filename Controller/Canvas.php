<?php
require_once('../Model/CanvasDB.php');


function add_picture()
{
    $arr = scandir('../upload');
    foreach ($arr as $k => $v) {
        if ($v[0] !== '.') {
            $db = new CanvasDB();
            $pic = '../upload/' . $v;
            if ($db->canvas_check($pic) === 1)
                $db->canvas_add($pic);
        }
    }
}

function delete_picture($pic)
{
    $db = new CanvasDB();
    $id_pic = $db->canvas_idpic($pic);
    $db->canvas_delcom($id_pic);
    $db->canvas_del($pic);
}

function add_comment($arr)
{
    $db = new CanvasDB();
    $id_pic = $db->canvas_idpic($arr['picname']);
    $com = htmlspecialchars($arr['com'], ENT_QUOTES, 'UTF-8');
    $db->canvas_comment(htmlspecialchars($com, ENT_QUOTES, 'UTF-8'), $_SESSION['id'], $id_pic);
}

function send_comment_mail($mail)
{
    $sujet = "Nouveau commentaire";
    $entete = "From: camagru@projet101.com";

// Le lien d'activation est composé du login(log) et de la clé(cle)
    $message = 'Vous avez un nouveau commentaire sur une de vos photos

---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';


    mail($mail, $sujet, $message, $entete); // Envoi du mail
}


function notify_comment($arr)
{
    echo 'ok';
    $db = new CanvasDB();
    $id_usr = $db->canvas_idusr($arr['picname']);
    echo $id_usr;
    $mail = $db->find_mail($id_usr);
    echo $mail;
    send_comment_mail($mail);
}

function check_like($pic, $id)
{
    $db = new CanvasDB();
    $like = $db->canvas_like($pic, $id);
    return $like;

}

function modif_like($arr)
{
    $like = isset($_POST['like']) ? 1 : 0;
    echo $like;
    $db = new CanvasDB();
    $db->canvas_modif_like($like, $arr['picname']);
}

function find_notif($pic)
{
    $db = new CanvasDB();
    $id_user = $db->canvas_idusr($pic);
    $notify = $db->canvas_notif($id_user);
    echo $id_user;
    return $notify;
}

function get_pic_arr($log){
    $db = new CanvasDB();
    $id = $db->canvas_findid($log);
    $arr = $db->canvas_array_id($id);
    return $arr;
}