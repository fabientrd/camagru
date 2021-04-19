<?php
session_start();
require_once ('../Model/UserDB.php');
//include ('../config/database.php');

// Fonction d'affichage de tableau //

function htmldump($variable, $height = "300px")
{
    echo "<pre style=\"border: 1px solid #000; height: {$height}; overflow: auto; margin: 0.5em;\">";
    var_dump($variable);
    echo "</pre>\n";
}

// Fonction pour checker les mail (similaires et valides) //

function check_mail($mail, $mail2){
    if ($mail != $mail2 || !filter_var($mail, FILTER_VALIDATE_EMAIL))
        return 0;
    return 1;
}

// Fonction pour checker la securite du mdp (longueur et securite) //

function check_passwd($pw, $pw2){
    $i = strlen($pw);
    if ($pw != $pw2 || $i < 8) {
        $_SESSION['error'] = 'pwl';
        return 0;
    }
    if (!preg_match("/\d/", $pw))
    {
        $_SESSION['error'] = 'pw';
        return 0;
    }
    if (!preg_match("/[A-Z]/", $pw)) {
        $_SESSION['error'] = 'pw';
        return 0;
    }
    if (!preg_match("/[a-z]/", $pw)) {
        $_SESSION['error'] = 'pw';
        return 0;
    }
    if (!preg_match("/\W/", $pw)) {
        $_SESSION['error'] = 'pw';
        return 0;
    }
    if (preg_match("/\s/", $pw)) {
        $_SESSION['error'] = 'pw';
        return 0;
    }
    return 1;
}

// Fonction d'envoi de mail pour confirmation d'inscription //

function confirm_mail($log, $mail){
    $sujet = "Activer votre compte" ;
    $entete = "From: camagru@projet101.com" ;

// Le lien d'activation est composé du login(log) et de la clé(cle)
    $message = 'Bienvenue sur CAMAGRU,
 
Pour activer votre compte, veuillez cliquer sur le lien ci dessous
ou copier/coller dans votre navigateur internet.
 
http://localhost:8100/camagru/View/confirmation.php?log='.urlencode($log).'&cle='.urlencode($_SESSION['cle']).'
 
 
---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';


    mail($mail, $sujet, $message, $entete) ; // Envoi du mail
}


function create_account($post){
    if (!empty($post['login'] && !empty($post['mail']) && !empty($post['mail2']) && !empty($post['passwd1'])
        && !empty($post['passwd2']))){
        $log = htmlspecialchars($post["login"], ENT_QUOTES, 'UTF-8');
        $mail = htmlspecialchars($post['mail'], ENT_QUOTES, 'UTF-8');
        $mail2 = htmlspecialchars($post['mail2'], ENT_QUOTES, 'UTF-8');
        $pw = $post['passwd1'];
        $pw2 = $post['passwd2'];
        echo $log;
        if (!check_mail(htmlspecialchars($mail), htmlspecialchars($mail2))) {
            $_SESSION['error'] = "mail";
            header("Location: ../View/create.php");
            exit;
        }
        else if (!check_passwd($pw, $pw2)) {

                        header("Location: ../View/create.php");
            exit;
        }
        else{
            $db = new UserDB;
            if ($i = $db->database_select_create($log, $mail)) {
                if ($i === 1)
                    $_SESSION['error'] = "login";
                else if ($i === 2)
                    $_SESSION['error'] = "mail";
                header("Location: ../View/create.php");
                exit ;
            }
            else {
                $db->database_create_account(htmlspecialchars($log), htmlspecialchars($mail), hash("whirlpool", $pw));
                confirm_mail(htmlspecialchars($log, ENT_QUOTES, 'UTF-8'), $mail);
                header("Location: ../View/");
                exit ;
            }
        }
    }
    $_SESSION['error'] = 'fields';
    header("Location: ../View/create.php");
}

// Gere la suppression de compte //

function delete_account($login){
    $db = new UserDB();
    $db->database_delete_table($login);
}

// Gere le login en fonction des comptes de la db //

function login($array){
    $log = htmlspecialchars($array['login'], ENT_QUOTES, 'UTF-8');
//    echo htmlspecialchars($log);
    if (isset($array) && !empty($array)){
//        htmldump($array);
        $db = new UserDB;
        if ($db->database_select_login(htmlspecialchars($log), $array['passwd']) === 1){
            header("Location: ../View/");
            exit ;
        }
        $_SESSION['error'] = 'account';
        header("Location: ../View/login.php");
    }
}

// Gere la modification de compte //

function modif_account($array){
    $mail = htmlspecialchars($array['mail'], ENT_QUOTES);
    $mail2 = htmlspecialchars($array['mail2'], ENT_QUOTES);
    if (isset($array) && !empty($array)){
        if (!empty($array)) {
            if (!empty($array['mail'] || !empty($array['mail2']))){
                if (!check_mail(htmlspecialchars($mail), htmlspecialchars($mail2))){
                    echo "ouimec";
                    $_SESSION['error'] = "mail";
                    header("Location: ../View/modif_account.php");
                    exit ;
                }
            }
            if (!empty($array['passwd1'] || !empty($array['passwd2']))){
                if (!check_passwd($array['passwd1'], $array['passwd2'])){
                    $_SESSION['error'] = "pw";
                    header("Location: ../View/modif_account.php");
                    exit ;
                }
            }
            $db = new UserDB();
            $db->database_modif_data($array);
            header("Location: ../View");
        }
    }
}

//generates a random password of length minimum 8
//contains at least one lower case letter, one upper case letter,
// one number and one special character,
//not including ambiguous characters like iIl|1 0oO
function randomPassword($len = 8) {

    //enforce min length 8
    if($len < 8)
        $len = 8;

    //define character libraries - remove ambiguous characters like iIl|1 0oO
    $sets = array();
    $sets[] = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
    $sets[] = 'abcdefghjkmnpqrstuvwxyz';
    $sets[] = '23456789';
    $sets[]  = '~!@#$%^&*(){}[],./?';

    $password = '';

    //append a character from each set - gets first 4 characters
    foreach ($sets as $set) {
        $password .= $set[array_rand(str_split($set))];
    }

    //use all characters to fill up to $len
    while(strlen($password) < $len) {
        //get a random set
        $randomSet = $sets[array_rand($sets)];

        //add a random char from the random set
        $password .= $randomSet[array_rand(str_split($randomSet))];
    }

    //shuffle the password string before returning!
    return str_shuffle($password);
}

function send_new_mail($mail, $new){
    $sujet = "Reinitialisation de votre mot de passe" ;
    $entete = "From: camagru@projet101.com" ;

// Le lien d'activation est composé du login(log) et de la clé(cle)
    $message = "Votre nouveau mot de passe est $new
---------------
Ceci est un mail automatique, Merci de ne pas y répondre.";


    mail($mail, $sujet, $message, $entete) ; // Envoi du mail
}

function new_pw($array){
    $new = randomPassword(8);
    htmldump($array);
    echo $new;
    $db = new UserDB();
    if ($db->database_new_pw($array['login'], $array['mail'], $new)){
        send_new_mail($array['mail'], $new);
        header("Location: ../View");
    }
    else{
        $_SESSION['error'] = 'account';
        header("Location: ../View");
    }
}