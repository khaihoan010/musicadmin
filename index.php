<?php
    include("includes/connection.php");
	include("language/language.php");

	if(isset($_SESSION['admin_name'])){
		header("Location:home.php");
		exit;
	}
?>
<!doctype html>
<html class="no-js " lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="icon" href="images/<?php echo APP_LOGO;?>" sizes="32x32">
    <link rel="icon" href="images/<?php echo APP_LOGO;?>" sizes="192x192">
    <link rel="apple-touch-icon-precomposed" href="images/<?php echo APP_LOGO;?>">
    <meta name="msapplication-TileImage" content="images/<?php echo APP_LOGO;?>">
    <title>:: <?php echo APP_NAME;?></title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Custom Css -->
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/style.min.css"> 
</head>

<script src="assets/js/login.js" type="text/javascript"></script>
<body class="theme-blush">
    <div class="authentication">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <form action="login_db.php" method="post"  class="card auth_form">
                        <div class="header">
                            <img class="logo" src="images/<?php echo APP_LOGO;?>"  alt="">
                            <h5>Log in</h5>
                        </div>
                        <div class="body">
                            <?php if(isset($_SESSION['msg'])){?>
                            <div class="alert alert-danger  alert-dismissible" role="alert"> <?php echo $client_lang[$_SESSION['msg']]; ?> </div>
                            <?php unset($_SESSION['msg']);}?>
                            <div class="input-group mb-3">
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                                <div class="input-group-append">
                                    <span class="input-group-text"><img src="assets/images/user2.png"></i></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-describedby="basic-addon2">
                                <div class="input-group-append">                                
                                    <span class="input-group-text"><a href="forgot-password.html" class="forgot" title="Forgot Password"><img src="assets/images/pass2.png"></a></span>
                                </div>                            
                            </div>
                            <div class="checkbox">
                                <input id="remember_me" type="checkbox">
                                <label for="remember_me">Remember Me</label>
                            </div>
                            <input type="submit" class="btn btn-primary btn-block waves-effect waves-light" value="Login">
                        </div>
                    </form>
                    <div class="copyright text-center">
                        &copy;
                        <script>document.write(new Date().getFullYear())</script>,
                        <span>Designed by <a href="https://nemosofts.com/" target="_blank">Nemosofts</a></span>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <img src="assets/images/signin.svg" alt="Sign In"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>