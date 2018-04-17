<?php
    ob_start(); // Initiate the output buffer
    require "class_user.inc";
    require '../doacoes/class_doacao.inc';
    require '../doacoes/verifica_data.php';
    require '../utils/functions.php';
    session_start();
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

            <div class="container">
                <div class="row">
                    <div class="card-panel">
                    <h3 class="titulo">Proposta</h3>
                        <form action="../doacoes/armazena_pedido.php" method="post" enctype="multipart/form-data">

                            <div class="input-field">
                                <input type="text"name="finalidade" required>
                                <label>Finalidade</label>                        
                            </div>

                            <div class="input-field inline">
                                <input type="number" name="meta" required>
                                <label>Meta</label>                        
                            </div>

                            <div class="input-field">
                                <input type="date" class="datepicker" name="data" required>
                            </div>
                            <label id="label">*Data de encerramento</label>

                            <div class="input-field">
                                <textarea name="descricao" class="materialize-textarea"></textarea>
                                <label for="descricao">Descrição</label>                        
                            </div>

                            <div class="file-field input-field">
                                <div class="btn waves-effect waves-light">
                                    <span>Imagem</span>
                                    <input type="file" name="fileToUpload" id="fileToUpload" required>
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                            </div>

                            <div class=" center-align">
                                <input type="submit" name="Mandar" class="btn waves-effect waves-light">
                            </div>
                        </form>
                    </div>
                </div>
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
        </main>
        <?php include '../utils/footer.inc' ?>
    </body>
</html>