<?php
include("./header.php");
include("../config/database.php");
include('../Redirection/newpic.php');

function htmldump($variable, $height = "300px")
{
    echo "<pre style=\"border: 1px solid #000; height: {$height}; overflow: auto; margin: 0.5em;\">";
    var_dump($variable);
    echo "</pre>\n";
}

?>

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

    /* The Close Button */
    .close {
        color: white;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-header {
        padding: 2px 16px;
        background-color: lightskyblue;
        color: white;
    }

</style>

<body>
<?php
if (isset($_SESSION['co']) && !empty($_SESSION['co'] && $_SESSION['active'] == 1))
    echo " <div id='modal-content'>
    <div class='modal-header'>
      <h2 style='text-align: center;'>You are now logged as " . $_SESSION['co'] . "</h2>
    </div>
    <script>
    let modal = document.getElementById('modal-content');

    setTimeout(function() {
        modal.style.display = \"none\";
    }, 5000);
    </script>
  </div>";
else if (isset($_SESSION['co']) && !empty($_SESSION['co'] && $_SESSION['active'] == 0))
    echo " <div id='modal-content'>
    <div class='modal-header'>
      <h2 style='text-align: center;'>Your account is not verified yet, please check your mail</h2>
    </div>  
    <script>
    let modal = document.getElementById('modal-content');

    setTimeout(function() {
        modal.style.display = \"none\";
    }, 5000);
    </script>  
  </div>";
unset ($_SESSION['co']);
?>

<?php
if (!empty($_GET['save']))
    add_picture();
if (isset($_SESSION['login']) && isset($_SESSION['active']) && isset($_SESSION['id']) && $_SESSION['active'] == 1) {
    $snap = '../Image/snap.png';
    $snap2 = '../Image/snap2.png';
    echo "<article style='height: 95%; background: white;'>
    <div class='leftside side'>
    <div class='upside'>
    <form method=\"post\" accept-charset=\"utf-8\" name=\"form1\">
    <input name=\"hidden_data\" id='hidden_data' type=\"hidden\"/>
    </form>";
    if (!empty($_GET['upload']))
        echo "<input type=\"file\" id=\"imageLoader\" name=\"imageLoader\"/>";
    else
        echo "<input type='hidden' id=\"imageLoader\" name=\"imageLoader\"/>";
    echo "</div>
    <div class='filter'><img src='../Image/snap.png' class='filter' id='snap1'  onClick='drawFilter(this.id)' alt=''></div>
    <div class='filter'><img src='../Image/snap2.png' class='filter' id='snap2' onClick='drawFilter(this.id)' alt=''></div>
    <div class='filter'><img src='../Image/snap3.png' class='filter' id='snap3' onClick='drawFilter(this.id)' alt=''></div>
    <div class='filter'><img src='../Image/snap4.png' class='filter' id='snap4' onClick='drawFilter(this.id)' alt=''></div>
    <div class='filter'><img src='../Image/snap5.png' class='filter' id='snap5' onClick='drawFilter(this.id)' alt=''></div>
    </div>
    <div id='midDiv'>
        <div id=\"video-container\">";
    if (empty($_GET['upload']))
        echo "<video id=\"camera-stream\" autoplay></video>";
    echo "
        <canvas class='canvas-stream' id='canvas-stream1'></canvas>
        <canvas class='canvas-stream' id='canvas-filter'></canvas>        
        <canvas class='canvas-stream' id='canvas-stream2'></canvas>
        </div>
         <div id='buttonDiv'>
         <input type='button' value='TAKE PICTURE' id='takeBut'>    
         <input type='button' value='SAVE PICTURE' id='saveBut'>
         <input type='button' value='UPLOAD FILE' name=\"file\" id='uploadBut'>
         </div>
    </div>
    <div class='side' id='rightside'>";
    $db = new CanvasDB();
    $array = $db->canvas_array_id($_SESSION['id']);
    foreach ($array as $k => $v)
        echo '<div class="rightpic">
                 <img src="' . $v['picture'] . '" alt="">
                 <i class="far fa-trash-alt" id="trash" onClick=del("' . $v['picture'] . '")></i>
              </div>';
    echo "</div>
    </article>
    <script src=\"../JS/script.js\"></script>";
} else
    echo "<link rel=\"stylesheet\" href=\"https://www.w3schools.com/w3css/4/w3.css\">
                <div class=\"w3-panel w3-pale-blue w3-border w3-card-4\">
                    <h2>Welcome on the projet Camagru !</h2>
                    <p>You must be logged in to use the application</p>
                </div>
              <img src='../Image/Screenshot.png' id='apercu' alt='apercu'>";
?>

</body>
