<?php
    ob_start(); // Initiate the output buffer
	require '../utils/functions.php';
	require "../usuario/class_user.inc";    	
	session_start();

	checa_logado()
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
		<script src='https://www.google.com/recaptcha/api.js'></script>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	    <script>
	        $(document).ready(function() {
	            $('#send').prop('disabled', true);//desativa o botão enviar
	            $('.g-recaptcha').hide();//esconde o captcha
	            validate();
	            $('#inputEmail, #inputPassword').change(validate);
	        });
	        function validate() {
	            if ($('#inputEmail').val().length > 10) {//enquanto o campo de email nao tiver menos que 10 caracteres, não ativa o reCaptcha
	                $('.g-recaptcha').show();//exibe o reCaptcha
	            }else{//se mudar de ideia e reduzir o campo pra menos de 10 caracteres...
	                $('.g-recaptcha').hide();//o reCaptcha se esconde novmanete
	            }
	        }
	        function enableSend() {
	            $('#send').prop('disabled', false);//quando o captcha é confirmado, ativa o botao enviar
	        }
	    </script>
		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" type="text/css" href="../css/style.css">

	</head>

	<body>
		<main>

			<?php include '../utils/nav.inc' ?>

			<div class="container center-align">
				<div class="row">
					<div class="card col s12 m6 offset-m3 l6 offset-l3" id="login">
						<div class="card-content">
							<div>
								<i class="fa fa-handshake-o large" aria-hidden="true"></i><h5 class="right-align inline">help.ME</h5>
							</div>
							<h5 class="left-align">Cadastrar-se</h5>
							<form action="conf_cadastro.php" method="post" enctype="multipart/form-data">

								<div class="input-field">
									<input type="text" name="name" required>
									<label>Nome</label>                        
								</div>

								<div class="input-field">
									<input id="inputEmail" type="email" name="email" required>
									<label id="label">Email</label>
								</div>

								<div class="input-field">
									<input type="text" name="nome" required>
									<label>Login</label>                        
								</div>

								<div class="input-field">
									<input id="inputPassword" class="inputPassword" type="password" name="senha" required>
									<label id="label">Senha</label>
								</div>
																				
								<div class="g-recaptcha" data-sitekey="6LflCDAUAAAAANbMvyUGeKZJB7HRqDt0yyF9f-Kk" data-callback="enableSend"></div>

								<div class="right-align">
									<input type="submit" id="send" name="Enviar" class="btn waves-effect waves-light">
								</div>
							</form>
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
		</main>
		<script type="text/javascript" src="../js/jquery/jquery-3.2.1.js"></script>
		<script type="text/javascript" src="../js/materialize.js"></script>
	</body>
</html>