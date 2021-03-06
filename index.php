<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login - srtdash</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <!-- <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" /> -->
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<?php
    include 'controller/controller.php';
    include 'library/oop.php';
    $perintah = new oop();
    $table = "petugas";
    @$username = $_POST['username'];
    @$password = $_POST['password'];
    @$levels = $_POST['level'];

    @$where = "username = '$username' && password = '$password' && id_level = '$levels'";
    if(isset($_POST['login'])){
        if($_POST['level'] == "none"){
            echo "<script>alert('Harap Pilih level')</script>";
        }else if($levels == "1" || $levels == "2"){
            $form = "peminjaman .php";
            $perintah->loginPetugas($con,$table,$where,$form);
        }
    }
?>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area">
        <div class="container">
                <div class="login-box ">
                    <form method="post">
                        <div class="login-form-head">
                            <h4>Sign In</h4>
                            <p>Hello there, Sign in and start managing your Things</p>
                        </div>
                        <div class="login-form-body">
                            <div class="form-gp">
                                <label for="exampleInputEmail1">Username</label>
                                <input name="username" required type="text" id="exampleInputEmail1">
                                <i class="ti-user"></i>
                            </div>
                            <div class="form-gp">
                                <label for="exampleInputPassword1">Password</label>
                                <input name="password" type="password" id="exampleInputPassword1">
                                <i class="ti-lock"></i>
                            </div>
                            <div class="form-group">
                                <select name="level" class="form-control">
                                    <option value="none">Select</option>
                                    <option value="1">Administrator</option>
                                    <option value="2">Operator</option>
                                </select>
                            </div>
                            <div class="submit-btn-area">
                                <button id="form_submit" required  name="login" type="submit">Submit <i
                                        class="ti-arrow-right"></i></button>
                                <center><I>-OR-</I></center>
                                <br>
                                <a class="fb-login" id="form_submit" href="login_pegawai.php">Log in as Worker</i></a>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>