<?php
    ob_start(); // Initiate the output buffer
?>

<?php
    session_start();
    session_destroy();
    $redirect = "../index.php";
    header("location:$redirect");
?>