<?php
session_start();
require "../devsiFiles/includes/functions.php";
$devsi = new Devsi();
$devsi->checkifLoggedIn();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quick Service Restaurant | LogIn</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="banners/favicon.ico">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery 2.2.3 -->
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <style type="text/css">
        @font-face{
            font-family: flower;
            src: url('lovelyfonts/Fflowers-v5.03-9797E33C501E135A76041110B3FD885E.ttf');
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="row" style="background-color: #3c8dbc;">
    <h3 style="text-align: center; color: #fff; font-family: flower; font-size: 25px; font-weight: bold;">QUICK SERVICE RESTAURANT</h3>
</div>
<div class="login-box">
    <div class="login-logo">
        <!--<img src="banners/food.jpg" style="width: 120px; height: 80px; border-radius: 30px;
        -webkit-border-radius: 30px; -moz-border-radius: 30px;"/>-->
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <p style="text-align: center;" id="displayRes"></p>
        <p><center><img src="banners/logo.png" style="width: 80px; height: 80px;"/></center></p>
        <?php
        if(isset($_POST['loginBtn'])){
            $devsi->verifyLogin($_POST['username'],$_POST['password']);
        }
        ?>
        <form action="#" method="post">
            <div class="form-group has-feedback">
                <input type="text" name="username" class="form-control" placeholder="Username" autofocus required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">

                <center>
                    <button type="submit" name="loginBtn" class="btn btn-primary btn-sm btn-flat"><span class="glyphicon glyphicon-log-in"></span> &nbsp;Sign In</button>
                </center>
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</body>
</html>
