<?php
include("header.php");
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    /* Popup container - can be anything you want */
    .popup {
        position: relative;
        display: inline-block;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* The actual popup */
    .popup .popuptext {
        visibility: hidden;
        width: 160px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 8px 0;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        margin-left: -80px;
    }

    /* Popup arrow */
    .popup .popuptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
    }

    /* Toggle this class - hide and show the popup */
    .popup .show {
        visibility: visible;
        -webkit-animation: fadeIn 1s;
        animation: fadeIn 1s;
    }

    /* Add animation (fade in the popup) */
    @-webkit-keyframes fadeIn {
        from {opacity: 0;}
        to {opacity: 1;}
    }

    @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity:1 ;}
    }

    .icon {
        position: relative;
        /*width: 32px;*/
        /*height: 50px;*/
        font-size: 1vh;
        left: 50%;
    }

    .create_loginbox{
        width: 13vw;
        height: 65vh;
        background: #000;
        color: #fff;
        top: 50%;
        left: 50%;
        position: absolute;
        transform: translate(-50%,-50%);
        box-sizing: border-box;
        padding: 4vh 2vw;
        opacity: 0.8;
        border-radius: 6px;
    }

    h1{
        position: relative;
        margin: auto;
        /*padding: 0 0 2vh;*/
        text-align: center;
        font-size: 2vh;
    }

    .create_loginbox p{
        position: relative;
        /* padding: 0; */
        font-weight: bold;
        height: 4%;
        /* width: 100%; */
        /*padding-top: 1vh;*/
        font-size: 1.8vh;
        /*margin: 1vh 0 0;*/
    }

    .create_loginbox input{
        position: relative;
        width: 100%;
        margin-bottom: 2vh;
    }

    .create_loginbox input[type="text"], input[type="password"]
    {
        position: relative;
        border: none;
        border-bottom: 1px solid #fff;
        background: transparent;
        outline: none;
        height: 3vh;
        color: #fff;
        font-size: 1.4vh;
    }

    .create_loginbox input[type="submit"]
    {
        position: relative;
        border: none;
        outline: none;
        /*height: 3vh;*/
        background: #fb2525;
        color: #fff;
        font-size: 2vh;
        border-radius: 2vh;
    }

    .create_loginbox input[type="submit"]:hover
    {
        position: relative;
        cursor: pointer;
        background: #ffc107;
        color: #000;
    }

    .create_loginbox a{
        position: relative;
        /*text-decoration: none;*/
        font-size: 1vh;
        line-height: 20px;
        color: darkgrey;
    }

    .create_loginbox a:hover
    {
        color: #ffc107;
    }

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
<?php
if (isset($_SESSION['error'])){
    echo "<div class='popup'>
            <span class='popuptext' id='myPopup'>" . $_SESSION['error'] ."</span>
        </div>";
}
echo '<div class="create_loginbox" style="height: 65vh;">
    <i class="fas fa-user icon"></i>
    <h1>Modif Account<h1>
            <p style="font-size: 1vh;color:darkred;">Complete only if you want to change info</p>
            <form action="../Redirection/modif_account.php" method="POST">
                <p>Username</p>
                <input type="text" name="login" placeholder="Enter New Username">
                <p>E-mail</p>
                <input type="text" name="mail" placeholder="Enter New Mail">
                <p>E-mail confirmation</p>
                <input type="text" name="mail2" placeholder="Confirm New Mail">
                <p>Password</p>
                <input type="password" name="passwd1" placeholder="Enter New Password">
                <p>Password Confirmation</p>
                <input type="password" name="passwd2" placeholder="Confirm New Password">
                <p>Notifications</p>
                <label class="switch">
                    <input type="checkbox" name="Notifications"';
if ($_SESSION['notif'] == 1)
    echo 'checked';
echo '><span class="slider round"></span>
                </label></br></br>

                <input type="submit" name="" value="Modif Account"><br>
            </form>

</div>

</body>
</head>
</html>';