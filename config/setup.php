<?php
require_once("database.php");
include('../View/header.php');
try {
    $db = database_connect();
    $sql_create_data_tbl = <<<EOSQL
CREATE TABLE data (
  id int(11) NOT NULL AUTO_INCREMENT,
  id_user INT NOT NULL,
  picture text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE=utf8_unicode_ci
EOSQL;

    $sql_create_user_db_tbl = <<<EOSQL
CREATE TABLE user 
( `id` INT NOT NULL AUTO_INCREMENT,
`username` VARCHAR(255) NOT NULL,
`mail` VARCHAR(255) NOT NULL,
`passwd` VARCHAR(255) NOT NULL,
`active` binary(1) NOT NULL default '0',
`cle` VARCHAR(255) NOT NULL,
`notif` binary(1) NOT NULL default '1',
PRIMARY KEY (`id`))
ENGINE = InnoDB;
EOSQL;

    $sql_create_comment_db_tbl = <<<EOSQL
CREATE TABLE comment
( `id` INT NOT NULL AUTO_INCREMENT,
`id_pic` INT NOT NULL,
`id_user` INT NOT NULL,
`com` VARCHAR(255),
PRIMARY KEY (`id`))
ENGINE = InnoDB;
EOSQL;

    $sql_create_like_db_tbl = <<<EOSQL
CREATE TABLE likes
( `id` INT NOT NULL AUTO_INCREMENT,
`id_user` INT NOT NULL,
`id_photo` INT NOT NULL,
PRIMARY KEY (`id`))
ENGINE = InnoDB;
EOSQL;



    $msg = '';

    $r = $db->exec($sql_create_data_tbl);
    $r = $db->exec($sql_create_user_db_tbl);
    $r = $db->exec($sql_create_comment_db_tbl);
    $r = $db->exec($sql_create_like_db_tbl);

    if ($r !== false) {
        $msg = "Tables are created successfully!." . "<br>";
        header('Location: ../View');
    } else {
        $msg = "Error creating tables." . "<br>";
    }
    // display the message
    if ($msg != '')
        echo $msg . "\n";

} catch (PDOException $e) {
    echo "<br>" . $e->getMessage();
}

if (!file_exists('../uplaod'))
    mkdir('../upload');



