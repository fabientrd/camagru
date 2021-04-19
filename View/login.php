<?php
include("header.php");
if (isset($_SESSION["login"])) {
    header("Location: ./index.php");
}
?>
<style>
    body {font-family: Arial, Helvetica, sans-serif;}

    /* Modal Content */
    #modal-content {
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        border: 1px solid #888;
        width: 40%;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.5s;
    }

    /* Add Animation */
    @-webkit-keyframes animatetop {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
    }

    @keyframes animatetop {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
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

    .user{
        width: 3vw;
        height: 3vh;
        position: relative;
        color: #fff;
        left: 50%;
        transform: translate(-50%,-50%);
        box-sizing: border-box;
        padding: 70px 30px;
    }

    .icon {
        position: relative;
        /*width: 32px;*/
        /*height: 50px;*/
        font-size: 1vh;
        left: 50%;
    }

    .create_loginbox .icon {
        position: absolute;
        top: 10%;
    }

    .loginbox{
        width: 13vw;
        height: 45vh;
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

    .loginbox p{
        position: relative;
        /* padding: 0; */
        font-weight: bold;
        /* height: 4%; */
        /* width: 100%; */
        /*padding-top: 1vh;*/
        font-size: 1.8vh;
        margin: 1vh 0 0;
    }

    .loginbox input{
        position: relative;
        width: 100%;
        margin-bottom: 2vh;
    }

    .loginbox input[type="text"], input[type="password"]
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

    .loginbox input[type="submit"]
    {
        position: relative;
        border: none;
        outline: none;
        height: 3vh;
        background: #fb2525;
        color: #fff;
        font-size: 2vh;
        border-radius: 2vh;
    }

    .loginbox input[type="submit"]:hover
    {
        position: relative;
        cursor: pointer;
        background: #ffc107;
        color: #000;
    }

    .loginbox a{
        position: relative;
        text-decoration: none;
        font-size: 1vh;
        height: 3vh;
        /*line-height: 20px;*/
        color: darkgrey;
    }

    .loginbox a:hover
    {
        color: #ffc107;
    }
</style>
<body>
<?php
if (isset($_SESSION) && !empty($_SESSION['error']))
    echo ' <div id="modal-content">
    <div class="modal-header">
      <h2 style="text-align: center;">Username or password incorrect</h2>
    </div>  
    <script>
    let modal = document.getElementById(\'modal-content\');

    setTimeout(function() {
        modal.style.display = "none";
    }, 5000);
    </script> 
  </div>';
unset($_SESSION['error']);
?>
<div class="loginbox">
    <i class="fas fa-user icon"></i>
    <h1>Login Here<h1>
            <form action="../Redirection/login.php" method="POST">
                <p>Username</p>
                <input type="text" name="login" placeholder="Enter Username">
                <p>Password</p>
                <input type="password" name="passwd" placeholder="Enter Password">
                <input type="submit" name="" value="Login">
                <a href="create.php">Create an account</a><br/>
                <a href="nw_pw.php">Forgot password ?</a>
            </form>

</div>
</body>
</head>
</html>