<?php
    ob_start(); 
    require "../usuario/class_user.inc";
    require '../doacoes/class_doacao.inc';
    require 'functions.php';
    session_start();

    $_SESSION['aparece_toast'] = 1;
    $redirect = "../index.php";
    header("location:$redirect");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>help.ME</title>
    <link rel="icon" type="image/png" sizes="96x96" href="../css/icon.png">
    <!--Import Google Icon Font-->
  	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  	<!--Import materialize.css-->
  	<link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<main>
    <?php include 'nav.inc';?>

    <div class="container center-align">
        <div class="row center-align">			

            <div class="card-panel">
                <h3>Sucesso!!</h3>
                <a href="../index.php" class="waves-effect waves-light btn">CONTINUAR</a>
            </div>
        </div>
    </div>
</main>

    <script type="text/javascript" src="../js/jquery/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="../js/materialize.js"></script>
    <script type="text/javascript">$(".button-collapse").sideNav();</script>

</body>
</html>