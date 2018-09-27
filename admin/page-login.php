<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Dessimmo1 Sàrl</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="images/logo.png" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form id="myForm">
                        <input type="hidden" name="login_action" value="login">
                        <input type="hidden" name="login_hash" value="" id="hash">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" placeholder="Email" name="login_mail">
                        </div>
                        <div class="form-group">
                            <label>Mot de passe</label>
                            <input type="password" class="form-control" placeholder="Password" id="login_pass">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Se souvenir de moi
                            </label>
                            <label class="pull-right">
                                <a href="#">Mot de passe oublié?</a>
                            </label>

                        </div>
                        <button type="button" class="btn btn-success btn-flat m-b-30 m-t-30" onclick="generateHash()">Se connecter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="../vendor/sha256/sha256.min.js"></script>
    <script>
    function generateHash() {
        if(document.getElementById("login_pass").value != "") {
            document.getElementById("hash").value = sha256(document.getElementById("login_pass").value);
            document.getElementById("myForm").submit();  
        } else {
            alert("Mot de passe vide !");
        }
    }
    </script>

    <?php

    if(isset($_GET['login_action'])) {
        require_once "../vendor/script/db_connect.php";
        session_start();
        $hash = hash('sha256', $_GET['login_hash']."l0rdç$!");

        $check_login = $bdd->query("SELECT * from agent WHERE mail LIKE '".$_GET['login_mail']."' AND hash LIKE '".$hash."'");
        if ($check_login->rowCount() > 0) {
            $_SESSION['is_logged'] = "#çl0rd$!#ç2";
            header('Location: index.php');
        } else {
            echo "<script>alert('Login incorrect')</script>";
        }
    }
    ?>
</body>
</html>
