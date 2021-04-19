<?php
session_start();
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Camagru</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../Style/header.css"/>
    <!--    <link rel="stylesheet" type="text/css" href="../Style/create.css"/>-->
    <!--    <link rel="stylesheet" type="text/css" href="../Style/nw_pw.css"/>-->
</head>
<body>
<header class="main_header">
    <nav>
        <ul>
            <li class="left"><a href="../View/">Accueil</a>
            </li>
            <li class="left"><a href="gallery.php?page=1">Gallery</a>
                <ul class="submenu">
                    <?php
                    if (isset($categories) && !empty($categories)) {
                        foreach ($categories as $key => $value) {
                            echo "<li><a href='articles.php?categorie={$key}'>{$key}</a></li>";
                        }
                    }
                    ?>
                </ul>
            </li>
            <li class="right"><?php
                if (isset($_SESSION['login']) && !empty($_SESSION['login'])) {
                    echo "<a href='../Redirection/disconnect.php'>Disconnection</a>";
                } else
                    echo "<a href=\"../View/login.php\">Identification</a>" ?>
                <ul class="submenu">
                </ul>
            </li>
            <li class="right"><?php
                if (isset($_SESSION['login']) && !empty($_SESSION['login']))
                    echo "<a href='../Redirection/delete_account.php'>Delete Account</a>";
                ?>
            </li>
            <li class="right"><?php
                if (isset($_SESSION['login']) && !empty($_SESSION['login']))
                    echo "<a href='../View/modif_account.php'>Modif Account</a>";
                ?>
            </li>
            <?php
            if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
                echo "<li class='poisson'><a href='admin.php'>Administration page</a></li>";
            }
            ?>
        </ul>
    </nav>
</header>
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    /* Modal Content */
    #modal-content {
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        border: 1px solid #888;
        width: 40%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.5s;
    }

    /* Add Animation */
    @-webkit-keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }
        to {
            top: 0;
            opacity: 1
        }
    }

    @keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }
        to {
            top: 0;
            opacity: 1
        }
    }

    .modal-header {
        padding: 2px 16px;
        background-color: lightskyblue;
        color: white;
    }

</style>


<?php
if (isset($_SESSION['error']) && !empty($_SESSION['error'] && $_SESSION['error'] === 'account')) {
    echo '<div id="modal-content">
    <div class="modal-header">
      <h2 style="text-align: center;">This account does not exists</h2>
    </div>
    <script>
    let modal = document.getElementById(\'modal-content\');

    setTimeout(function() {
        modal.style.display = "none";
    }, 5000);
    </script>
  </div>';
    unset($_SESSION['error']);
}
?>


