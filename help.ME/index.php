<?php
    ob_start(); // Initiate the output buffer
    require "usuario/class_user.inc";
    require 'doacoes/class_doacao.inc';
    require_once 'doacoes/verifica_data.php';
    require 'utils/functions.php';
    session_start();
    verifica_data();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>help.ME</title>
        <link rel="icon" type="image/png" sizes="96x96" href="css/icon.png">
        <meta charset="utf-8">
      	
        <!--Import Google Icon Font-->
      	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      	<!--Import materialize.css-->
      	<link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
        <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.css">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
<body>
    <main>
        <nav class="navbar default-primary-color hide-on-med-and-down">
            <div class="container center-align">
                <a class="brand-logo" href="index.php"><i class="fa fa-handshake-o" aria-hidden="true"></i></a>
                <?php
                    if(IsLogado("usuario/users.json")){
                        $usuario = $_SESSION['user'];
                    ?>
                        <ul class="right">
                            <li><i class="white-text material-icons prefix">search</i></li>
                            <li>
                                <form action="utils/acha_pesquisa.php" method="post">
                                    <input type="text" placeholder="Buscar" id="autocomplete-input" class="autocomplete white-text" name="procurar">
                                </form>
                            </li> 
                            <li><a href="usuario/pedido.php">Fazer Proposta</a></li>
                            <li><a href="usuario/historico_doacao.php">Histórico</a></li>
                            <li class="dropdown-button" data-activates="dropdown"><a><i class="fa fa-user" aria-hidden="true"></i>&nbsp;<?=$usuario->nome?><i class="material-icons right">arrow_drop_down</i></a></li>
                            <ul id='dropdown' class='dropdown-content'>
                                <li><a href="usuario/carteira.php"><i class="fa fa-money" aria-hidden="true"></i> R$:<?=$usuario->carteira?></a></li>
                                <li><a href="usuario/deslogar.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Sair</a></li>
                            </ul>
                        </ul>
                    <?php
                    }
                    else if(Eh_Admin()){
                    ?>
                        <ul class="right">
                            <li><i class="whithe-text material-icons prefix">search</i></li>
                                <li>
                                    <form action="utils/acha_pesquisa.php" method="post">
                                        <input type="text" placeholder="Buscar" id="autocomplete-input" class="autocomplete black-text" name="procurar">
                                    </form>
                                </li> 
                            <li><a href="admin/historico_doacao_aprovada.php">Histórico de Doações Aprovadas</a></li>
                            <li><a href="usuario/deslogar.php"><span class="glyphicon glyphicon-log-in"></span> Sair</a></li>
                        </ul>

                    <?php
                    }   
                    else{
                        $redirect = "usuario/login.php";
                        header("location:$redirect");
                    }
                    ?>
            </div>
        </nav>

        <?php
        $logado = IsLogado("usuario/users.json");        
        if($logado){
            $usuario = $_SESSION['user'];
        ?>
            <nav class="hide-on-large-only default-primary-color">
            <div class="nav-wrapper">
                <a class="brand-logo center" href="index.php"><i class="fa fa-handshake-o" aria-hidden="true"></i></a>
                
                <div>
                    <ul id="slide-out" class="side-nav show-on-small">
                        <li><a class="teal-text">Bem-vindo <?=$usuario->nome?>!</a></li>
                    
                        <li>
                            <form action="utils/acha_pesquisa.php" method="post">
                                <div class="input-field side-search">
                                    <i class="teal-text material-icons prefix ">search</i>
                                    <input type="text" placeholder="Buscar" id="autocomplete-input" class="autocomplete teal-text" name="procurar">
                                </div>
                            </form>
                        </li> 
                        <li><a class="teal-text" href="usuario/pedido.php"><i class="fa fa-envelope-open teal-text" aria-hidden="true"></i>Fazer Proposta</a></li>
                        <li><a class="teal-text" href="usuario/historico_doacao.php"><i class="fa fa-file-text teal-text" aria-hidden="true"></i>Histórico</a></li>
                        <li><a class="teal-text" href="usuario/carteira.php"><i class="teal-text fa fa-money" aria-hidden="true"></i> R$:<?=$usuario->carteira?></a></li>
                        <li><a class="teal-text" href="usuario/deslogar.php"><i class="teal-text fa fa-sign-out" aria-hidden="true"></i> Sair</a></li>
                    </ul>
        
                    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
                </div>
            </div>
            </nav>
        <?php
        }
        else if(Eh_Admin()){
        ?>
            <nav class="hide-on-large-only default-primary-color">
                <div class="nav-wrapper">
                    <a class="brand-logo center" href="index.php"><i class="fa fa-handshake-o" aria-hidden="true"></i></a>
                    <div>
                        <ul id="slide-out" class="side-nav show-on-small">
                            <li>
                                <form action="utils/acha_pesquisa.php" method="post">
                                    <div class="input-field">
                                        <i class="teal-text material-icons prefix">search</i>
                                        <input type="text" placeholder="Buscar" id="autocomplete-input" class="teal-text autocomplete" name="procurar">
                                    </div>
                                </form>
                            </li> 
                            <li><a class="teal-text" href="admin/historico_doacao_aprovada.php">Histórico de Doações Aprovadas</a></li>
                            <li><a class="teal-text" href="usuario/deslogar.php"><span class="glyphicon glyphicon-log-in"></span> Sair</a></li>
                        </ul>
            
                        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
                    </div>
                </div>
            </nav>
        <?php
        }
        ?>

        
        <div class="container center-align">
            <!--  
                <div class="row">
                <div class="col s16 m16">
                <div class="card large center-align teal lighten-2 z-depth-5">
                    <div class="card-image ">
                        <img src="imagens/help.jpg" width="40px">
                        <span class="card-title">Bem Vindo(a)</span>
                    </div>
                    <div class="card-content teal lighten-2" id="apresentacao">
                    <p class="texto">Está pensando em fazer um super projeto inovador que irá mudar o mundo, mas está sem o incentivo financeiro inicial?
                    Quer comprar um caminhão de balas mas não possui dinheiro o suficiente? Nós podemos te ajudar.
                    O TratoFeito é um site de financiamento coletivo que busca apoiar e incentivar projetos por meio de doações de usuários do site. Crie já sua conta e abra um pedido de doação!</p>
                    </div>
                </div>
                </div>
            </div> 
            -->
            <?php
                if(IsLogado("usuario/users.json")){//printa doações disponíveis no arquivo
                    $arquivo = file_get_contents('doacoes/doacoes.json');
                    $json = json_decode($arquivo);
                    if (filesize('doacoes/doacoes.json') != 0){
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
                                $porcentagem = ($arrecadado/$meta)*100;
                                $porcentagem = number_format($porcentagem, 0);

                                if($aprovado==1){// && $arrecadado<$meta
                                    ?>
                                        <div class="col s12 m6 l4">
                                            <div class="card">
                                                <div class="progress">
                                                        <div class="determinate" style="width: <?=($arrecadado/$meta)*100?>%"><span class="black-text right-align"style="width: <?=($arrecadado/$meta)*200?>%"><?=$porcentagem?>%</span></div>
                                                        
                                                </div> 
                                                <div class="card-content white-text">
                                                    <h4 class="black-text truncate"><?=$descricao?></h4>
                                                    <?php
                                                    $formato = Pega_Formato_Imagem($id,'imagens/imagens.json');
                                                    ?>
                                                    <div class="center">
                                                        <img src="imagens/<?=$id?>.<?=$formato?>" class="circle imagens responsive-img"> 
                                                    </div> 
                                                    <p class="card-subtitle black-text flow-text truncate"><?=$dados->descricao?></p>

                    
                                                </div>
                                                <div class="card-action">
                                                    <form action="usuario/pag_doacoes.php" method="post">
                                                        <input type="hidden" name="id" value=<?=$id?>>
                                                        <input type="submit" class="btn btn-default botao float-text" name="Verificar2" value="Leia mais">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                            <?php
                        }
                    }
                }
                if(Eh_Admin()){
                    $arquivo = file_get_contents('doacoes/doacoes.json');
                    $json = json_decode($arquivo);
                    if (filesize('doacoes/doacoes.json') != 0){
                        if(!empty($json)){
                        ?>
                        <div class="row center-align">
                            <h2>Propostas pendentes</h2>               			
                        <?php
                            foreach($json as $dados){
                                $descricao = $dados->finalidade;
                                $meta = $dados->meta;
                                $autor = $dados->autor;
                                $aprovado = $dados->aprovado;
                                $id = $dados->id;

                                //colocar na classe e na seção.
                                $doacao_pendente = new Doacao($descricao, $meta, $autor, $aprovado, $id);
                                $_SESSION["doacao"] = $doacao_pendente;

                                if($aprovado==0){
                                        ?>
                                        <div class="col s12 m6 l4">
                                            <div class="card">
                                                <div class="card-content white-text">
                                                    <h4 class="black-text text-darken-4 truncate"><?=$descricao?></h4>
                                                    <?php
                                                    $formato = Pega_Formato_Imagem($id,'imagens/imagens.json');
                                                    ?>
                                                    <div class="center">
                                                        <img src="imagens/<?=$id?>.<?=$formato?>" class="imagens responsive-img circle"> 
                                                    </div>
                                                    <p class="card-subtitle grey-text text-darken-2 truncate"><?=$dados->descricao?></p>
                                                    <h6 class="black-text text-darken-4 card-info">&nbsp;Meta: R$ <?=$meta?></h6>
                                                </div>
                                                <div class="card-action">
                                                    <form action="usuario/pag_doacoes.php" method="post">
                                                        <input type="hidden" name="id" value=<?=$id?>>
                                                        <input type="submit" class="btn btn-default botao" name="Verificar2" value="Leia mais">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }
                        }
                    }
                }
            ?>  
        </div>
    </main>
    <script type="text/javascript" src="js/jquery/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>
    <script type="text/javascript">$(".button-collapse").sideNav();</script>
    <script type="text/javascript">
        if("<?php echo $_SESSION['aparece_toast']; ?>" == '1'){
            Materialize.toast('Sucesso!', 3000, 'rounded');
            "<?php $_SESSION['aparece_toast'] = 0; ?>" 
        }
    </script>
    
</body>
<?php include 'utils/footer.inc' ?>
</html>