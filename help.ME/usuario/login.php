<?php
    ob_start(); // Initiate the output buffer
    require "../usuario/class_user.inc";    
    require "../utils/functions.php";
    session_start();

    checa_logado();
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
        <script type="text/javascript" src="../js/jquery/jquery-3.2.1.js"></script>
        <script type="text/javascript" src="../js/materialize.js"></script>

        <?php include '../utils/nav.inc';?>

        <div class="container center-align">
            <div class="row">
                <div class="card col s12 m6 offset-m3 l6 offset-l3" id="login">
                    <div class="card-content">
                        <div>
                            <i class="fa fa-handshake-o large" aria-hidden="true"></i><h5 class="right-align inline">help.ME</h5>
                        </div>

                        <h5 class="left-align">Entrar</h5>


                        <div id="teste">
                            <?php require "../utils/login_automatico.php"; ?> 
                        </div>



                        <form action="conf_login.php" method="post" enctype="multipart/form-data">

                            <div class="input-field">
                                <input id="usuario" type="text" name="nome" required>
                                <label>Login</label>                        
                            </div>

                            <div class="input-field">
                                <input id="user_password" type="password" name="senha" required>
                                <label>Senha</label>                        
                            </div>

                            <div>
                                <p>Não tem uma conta? <a href="cadastro.php" class="blue-text">Crie uma!</a></p>
                            </div>

                            <div class="right-align input-field">
                                <input type="submit" name="Enviar" class="btn waves-effect waves-light">
                            </div>

                        </form>

                        <?php
                            if(Errors()){
                                $resposta = Errors();
                                $_SESSION['error'] = "valido";
                            ?>
                                <div class="card-panel red lighten-4">
                                    <span><?=$resposta?></span>
                                </div>
                            <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript">
        if(localStorage.getItem('login') === null){
            document.getElementById("teste").style.display = "none";
        }
        else{
            document.getElementById("teste").style.display = "block";
        }
    </script>
</body>
</html>