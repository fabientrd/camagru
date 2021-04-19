<?php
include("./header.php");
require_once('../Model/CanvasDB.php');

function htmldump($variable, $height = "300px")
{
    echo "<pre style=\"border: 1px solid #000; height: {$height}; overflow: auto; margin: 0.5em;\">";
    var_dump($variable);
    echo "</pre>\n";
}

$db = new CanvasDB();
$arr = $db->canvas_array();
$array = [];
foreach ($arr as $k => $v)
    array_push($array, $v['picture']);
$nb_page = ceil(sizeof($arr) / 5);
$limit = 5 * $_GET['page'] - 1; ?>
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
<body>
<script src="../JS/scriptgallery.js"></script>
<?php

echo '<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <div class="w3-panel w3-pale-blue w3-border w3-card-4" id="gallery-text">
         <h2 id="write">Photo Gallery</h2>
      </div>';
$i = ($_GET['page'] - 1) * 5;
echo '<div class=gallery>';
for ($i; $i <= $limit && isset($array[$i]); $i++) {
    echo '<div>
             <img src="' . $array[$i] . '"></br>';
    if (isset($_SESSION) && !empty($_SESSION['login'])) {
        $db = new CanvasDB();
        $like = $db->canvas_like($array[$i], $_SESSION['id']);
        echo '<textarea rows="4" cols="30" name="com" placeholder="Enter Comment Here" id="comarea" form="comform' . $i . '"></textarea>
             <form action="../Redirection/comment.php" method="POST" id="comform' . $i . '">
             <p style="text-align: right;">Dislike Like</p>
             <label class="switch" id="like">
                    <input type="checkbox" name="like"';
        if ($like === 1)
            echo 'checked';
        echo '>
                    <span class="slider round"></span>
             </label>
                <input type="submit" name="" value="Submit Changes" id="comBut">
                <input type="hidden" name="picname" value="' . $array[$i] . '">
                
             </form>';
    }
    echo '</div>';
}
echo '</div>';
echo '</br><div id="page">';
for ($i = 1; $i <= $nb_page; $i++)
    echo '<div>
             <input id="pages" type="button" value="' . $i . '" onClick="chPage(this.value)">
          </div>';
echo '</div>';
?>
</body>