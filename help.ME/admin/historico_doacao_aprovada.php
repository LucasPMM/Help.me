<?php
    ob_start(); // Initiate the output buffer
    require "../usuario/class_user.inc";
    require '../doacoes/class_doacao.inc';
    require 'class_dados_admin.inc';
    require '../utils/functions.php';
    session_start();

    recebe_armazena_acoes();

    $dados = $_SESSION['dados_admin'];
?>

<!DOCTYPE html>
<html>

    <head>
        <title>help.ME</title>
        <link rel="icon" type="image/png" sizes="96x96" href="../css/icon.png">
        <meta charset="utf-8">
        
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
                        <h4>Propostas Aprovadas:</h4>
                        <table class="highlight">
                            <thead>
                                <tr>
                                    <th>Pedido</th>
                                    <th>Autor</th>
                                    <th>ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($_SESSION['dados_admin'])){
                                        $dados1 = $dados->doacoes_aprovadas;
                                        if (!empty($dados1)) {
                                            foreach($dados1 as $aux){
                                            ?>
                                                    <tr>
                                                        <td><?=$aux['finalidade']?></td>
                                                        <td><?=$aux['autor']?></td>
                                                        <td><?=$aux['id']?></td>
                                                    </tr>
                                            <?php
                                            }
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="card-panel">
                        <h4>Propostas Recusadas:</h4>
                        <table class="highlight">
                            <thead>
                                <tr>
                                    <th>Pedido</th>
                                    <th>Autor</th>
                                    <th>ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($_SESSION['dados_admin'])){
                                        $dados2 = $dados->doacoes_recusadas;
                                        if (!empty($dados2)) {
                                            foreach($dados2 as $aux){
                                            ?>
                                                <tr>
                                                    <td><?=$aux['finalidade']?></td>
                                                    <td><?=$aux['autor']?></td>
                                                    <td><?=$aux['id']?></td>
                                                </tr>
                                            <?php
                                            }
                                        }
                                    }
                                    ?>
                            </tbody>
                        </table>				
                    </div>
                </div>
            </div>

        </main>
        <?php include '../utils/footer.inc' ?>            
    </body>
</html>