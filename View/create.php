<?php
include("header.php");
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

    .icon {
        position: relative;
        /*width: 32px;*/
        /*height: 50px;*/
        font-size: 1vh;
        left: 50%;
    }

    .create_loginbox {
        width: 13vw;
        height: 60vh;
        background: #000;
        color: #fff;
        top: 50%;
        left: 50%;
        position: absolute;
        transform: translate(-50%, -50%);
        box-sizing: border-box;
        padding: 4vh 2vw;
        opacity: 0.8;
        border-radius: 6px;
    }

    h1 {
        position: relative;
        margin: auto;
        /*padding: 0 0 2vh;*/
        text-align: center;
        font-size: 2vh;
    }

    .create_loginbox p {
        position: relative;
        /* padding: 0; */
        font-weight: bold;
        height: 4%;
        /* width: 100%; */
        /*padding-top: 1vh;*/
        font-size: 1.8vh;
        /*margin: 1vh 0 0;*/
    }

    .create_loginbox input {
        position: relative;
        width: 100%;
        margin-bottom: 2vh;
    }

    .create_loginbox input[type="text"], input[type="password"] {
        position: relative;
        border: none;
        border-bottom: 1px solid #fff;
        background: transparent;
        outline: none;
        height: 3vh;
        color: #fff;
        font-size: 1.4vh;
    }

    .create_loginbox input[type="submit"] {
        position: relative;
        border: none;
        outline: none;
        height: 3vh;
        background: #fb2525;
        color: #fff;
        font-size: 2vh;
        border-radius: 2vh;
    }

    .create_loginbox input[type="submit"]:hover {
        position: relative;
        cursor: pointer;
        background: #ffc107;
        color: #000;
    }

    .create_loginbox a {
        position: relative;
        /*text-decoration: none;*/
        font-size: 1vh;
        line-height: 20px;
        color: darkgrey;
    }

    .create_loginbox a:hover {
        color: #ffc107;
    }
</style>
<body>
<?php
if (isset($_SESSION) && !empty($_SESSION['error'])) {
    if ($_SESSION['error'] === 'pw')
        echo '<div id="modal-content">
        <div class="modal-header">
            <h2 style="text-align: center;">Password invalid, require at least one uppercase and lowercase letter, a number and a special character (ex: @#$...)</h2>
        </div>
        <script>
    let modal = document.getElementById(\'modal-content\');

    setTimeout(function() {
        modal.style.display = "none";
    }, 5000);
    </script>' .
            '
            </div>';
    if ($_SESSION['error'] === 'pwl')
        echo '<div id="modal-content">
        <div class="modal-header">
            <h2 style="text-align: center;">Password to short, min 8 characters</h2>
        </div>  
        <script>
    let modal = document.getElementById(\'modal-content\');

    setTimeout(function() {
        modal.style.display = "none";
    }, 5000);
    </script>
            </div>';
    if ($_SESSION['error'] === 'login')
        echo '<div id="modal-content">
        <div class="modal-header">
            <h2 style="text-align: center;">User already exists</h2>
        </div> 
        <script>
    let modal = document.getElementById(\'modal-content\');

    setTimeout(function() {
        modal.style.display = "none";
    }, 5000);
    </script> 
            </div>';
    if ($_SESSION['error'] === 'mail')
        echo '<div id="modal-content">
        <div class="modal-header">
            <h2 style="text-align: center;">E-mail already used or invalid</h2>
        </div> 
        <script>
    let modal = document.getElementById(\'modal-content\');

    setTimeout(function() {
        modal.style.display = "none";
    }, 5000);
    </script> 
            </div>';
    if ($_SESSION['error'] === 'fields')
        echo '<div id="modal-content">
        <div class="modal-header">
            <h2 style="text-align: center;">One or several fields are empty</h2>
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
<div class="create_loginbox">
    <i class="fas fa-user icon"></i>
    <h1>Create Account
        <h1>
            <form action="../Redirection/create_account.php" method="POST">
                <p>Username</p>
                <input type="text" name="login" placeholder="Enter Username">
                <p>E-mail</p>
                <input type="text" name="mail" placeholder="Enter Mail">
                <p>E-mail confirmation</p>
                <input type="text" name="mail2" placeholder="Confirm Mail">
                <p>Password</p>
                <input type="password" name="passwd1" placeholder="Enter Password">
                <p>Password Confirmation</p>
                <input type="password" name="passwd2" placeholder="Confirm Password">
                <input type="submit" name="" value="Create Account"><br>
            </form>

</div>
</body>
</head>
</html>