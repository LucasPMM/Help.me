<?php
    ob_start(); 
    require "../usuario/class_user.inc";    
    require '../doacoes/class_doacao.inc';    
    require '../utils/functions.php';
    session_start();    
    $procura = $_POST["procurar"];
    $contador = 0;
    $arquivo = file_get_contents('../doacoes/doacoes.json');
    $json = json_decode($arquivo);
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
<body class="divider-color entrar">
<main>
    <script type="text/javascript" src="../js/jquery/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="../js/materialize.js"></script>
<?php include 'nav.inc';?>
    <div class="container center-align">
<?php
    echo "<h3>Resultados Encontrados:</h3>";
    if (filesize('../doacoes/doacoes.json') != 0){
        if (!empty($json)) {
        ?>
        <div class="row center-align">			
        <?php
            foreach($json as $dados){
                $descricao = $dados->finalidade;
                $meta = $dados->meta;
                $autor = $dados->autor;
                $aprovado = $dados->aprovado;
                $arrecadado = $dados->arrecadado;
                $id = $dados->id;
                $link = $descricao;
                $termo = $procura;
                $link = strtolower($link);
                $termo = strtolower($termo);
                $pattern = '/'.$termo.'/';
                $porcentagem = ($arrecadado/$meta)*100;
                $porcentagem = number_format($porcentagem, 0);

                if(preg_match($pattern,$link) && $aprovado ==1 && !Eh_admin()){
                    $contador++;
                    ?>
                        <div class="col s12 m6 l4">
                            <div class="card">
                                <div class="progress">

                                    <div class="determinate" style="width: <?=($arrecadado/$meta)*100?>%"><span class="black-text right-align"style="width: <?=($arrecadado/$meta)*200?>%"><?=$porcentagem?>%</span></div>
                                    

                                </div>
                                <div class="card-content white-text">
                                    <h4 class="black-text truncate"><?=$descricao?></h4>
                                    <?php
                                    $formato = Pega_Formato_Imagem($id,'../imagens/imagens.json');
                                    ?>
                                    <div class="center">
                                        <img src="../imagens/<?=$id?>.<?=$formato?>" class="circle imagens responsive-img"> 
                                    </div>
                                    <p class="card-subtitle black-text flow-text truncate"><?=$dados->descricao?></p>
                                  

                                </div>
                                <div class="card-action">
                                    <form action="../usuario/pag_doacoes.php" method="post">
                                        <input type="hidden" name="id" value=<?=$id?>>
                                        <input type="submit" class="btn btn-default botao float-text" name="Verificar2" value="Leia mais">
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                else if(Eh_admin() && preg_match($pattern,$link) && $aprovado ==0){
                    $contador++;                    
                    ?>
                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content white-text">
                                <h4 class="black-text text-darken-4 truncate"><?=$descricao?></h4>
                                <?php
                                $formato = Pega_Formato_Imagem($id,'../imagens/imagens.json');
                                ?>
                                <div class="center">
                                    <img src="../imagens/<?=$id?>.<?=$formato?>" class="imagens responsive-img circle"> 
                                </div>
                                <p class="card-subtitle grey-text text-darken-2 truncate"><?=$dados->descricao?></p>
                                <h6 class="black-text text-darken-4 card-info">&nbsp;Meta: R$ <?=$meta?></h6>
                            </div>
                            <div class="card-action">
                                <form action="../usuario/pag_doacoes.php" method="post">
                                    <input type="hidden" name="id" value=<?=$id?>>
                                    <input type="submit" class="btn btn-default botao" name="Verificar2" value="Leia mais">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php                }
            }
            ?>
        </div>
            <?php
        }
    }

    if ($contador==0) {
        $redirect = "erro.php";
        header("location:$redirect");
    } 
?>
    </div>
</main>
</body>
<?php include 'footer.inc' ?>
<script type="text/javascript">$(".button-collapse").sideNav();</script>
</html>