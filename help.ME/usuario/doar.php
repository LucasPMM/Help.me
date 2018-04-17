<?php
    ob_start(); // Initiate the output buffer
    require "../usuario/class_user.inc";
    require "../utils/functions.php";
    require '../doacoes/class_doacao.inc';
    session_start();

    $controle;

    if(isset($_SESSION['controle'])){
        $controle = $_SESSION['controle'];
    }

    if(isset($_POST['id'])){
        $controle = $_POST['id'];
        $_SESSION['controle'] = $controle;
    }
    Guarda_Doacao($controle);
    $dados_da_doacao = $_SESSION["doacao_atual"];
    $formato = Pega_Formato_Imagem($controle, '../imagens/imagens.json');

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

    <script type="text/javascript" src="../js/jquery/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="../js/materialize.js"></script>

    <?php include_once '../utils/nav.inc' ?>

    <div class="container">

        <div class="row">
            <div class="card col s12 m8 offset-m2 l8 offset-l2" id="card-doacao">
                <h3 class="conteudo truncate"><?=$dados_da_doacao->descricao?></h3>
                <div class="card-image center-align">
                    <img src="../imagens/<?=$dados_da_doacao->id?>.<?=$formato?>" id="img-doacao" class="imagens circle responsive-img center"> 
                </div>
                <div class="card-content">
                    <h5>Arrecadado:</h5>
                    <p class="flow-text card-subtitle grey-text text-darken-2"><?=$dados_da_doacao->valor_acumulado?></p>
                    <h5>Meta:</h5>
                    <p class="flow-text card-subtitle grey-text text-darken-2"><?=$dados_da_doacao->meta?></p>
                    <h5>Autor:</h5>
                    <p class="flow-text card-subtitle grey-text text-darken-2"><?=$dados_da_doacao->autor?></p>
                </div>
            </div>
        </div>    

        <div class="row">
            <div class="col s12">
                <form action="../doacoes/conf_doacao.php" method="post">

                    <div class="input-field">
                        <input type="number" class="form-control" name="valor_doacao">
                        <label>Valor que deseja doar:</label>                        
                    </div>

                    <div class="input-field">
                        <input type="password" class="form-control" name="senha">
                        <label>Senha:</label>                        
                    </div>
                    
                    <input type="hidden" name="id" value=<?=$controle?>>
                    <input type="submit" class="btn btn-default" name="Verificar">
                </form>

                <?php
                    $limite = Retorna_Limite($controle);
                ?>
                    <div class="card-panel yellow lighten-4">
                        <span>Limite de doação: <?=$limite?></span>
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
        </div>
    </div>
</body>
<?php include '../utils/footer.inc' ?>
</html>