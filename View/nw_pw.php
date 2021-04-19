<?php
include("header.php");

?>
<style>
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
        height: 30vh;
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
        /*height: 3vh;*/
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
        font-size: 1.5vh;
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
        /*height: 3vh;*/
        /*line-height: 20px;*/
        color: darkgrey;
    }

    .loginbox a:hover
    {
        color: #ffc107;
    }
</style>
<body>
<div class="loginbox">
    <i class="fas fa-user icon"></i>
    <h1>Forget Password<h1>
            <form action="../Redirection/nw_pw.php" method="POST">
                <p>Username</p>
                <input type="text" name="login" placeholder="Enter Username">
                <p>Mail</p>
                <input type="text" name="mail" placeholder="Enter Email">
                <input type="submit" name="" value="Send New Password">
            </form>

</div>

</body>
</head>
</html>