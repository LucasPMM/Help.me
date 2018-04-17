<?php
    ob_start(); // Initiate the output buffer
    require "../utils/functions.php";
    require "class_user.inc";
    require '../doacoes/class_doacao.inc';
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
            
            <?php include_once '../utils/nav.inc' ?>
            
            <div class="container">
				<div class="row">
					<div class="card center-align col s12 col l6 offset-l3">
						<div class="card-content">
							<i class="fa fa-credit-card-alt small left-align" aria-hidden="true"></i><h4>Depósito (R$)</h4>
							<form action="deposita.php" method="post">
								<div class="input-field">
									<input type="number" class="form-control" name="valor">
									<label>Valor</label>
								</div>
								<input type="submit" class="btn btn-default" name="Verificar" value="Depositar">
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
        <?php include '../utils/footer.inc' ?>
    </body>

</html>