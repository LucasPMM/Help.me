<?php
    ob_start(); // Initiate the output buffer
    require "class_user.inc";
    require "../utils/functions.php";
    require '../doacoes/class_doacao.inc';
    require '../doacoes/class_utils.inc';
    session_start();
    //pega todos os dados, coloca na classe, e coloca a classe na seção.
    armazena_dados_secao();

    $dados = $_SESSION['utils'];
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

			<?php include '../utils/nav.inc' ?>

			<div class="container">

				<div class="row">
					<div class="card-panel">
						<h4>Propostas abertas:</h4>
						<table class="highlight">
							<thead>
								<tr>
									<th>Pedido</th>
									<th>Meta (R$)</th>
									<th>Arrecadado (R$)</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
							<?php
								if(isset($_SESSION['utils'])){
									$dados1 = $dados->doacoes_abertas;
									if (!empty($dados1)) {
										foreach($dados1 as $aux){
											$temp;
											if($aux['aprovado']==0){
												$temp = "Esperando Aprovação";
											}
											else{
												$temp = "Aprovado";
											}

											?>
											<tr>
												<td><?=$aux['finalidade']?></td>
												<td><?=$aux['meta']?></td>
												<td><?=$aux['arrecadado']?></td>
												<td><?=$temp?></td>
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
						<h4>Contribuições Realizadas:</h4>
						<table class="highlight">
								<thead>
									<tr>
										<th>Contribuição (R$)</th>
										<th>Para</th>
									</tr>
								</thead>
								<tbody>
									<?php
										if(isset($_SESSION['utils'])){
											$dados2 = $dados->doacoes_realizadas;
											if (!empty($dados2)) {
												foreach($dados2 as $aux){
												?>
													<tr>
														<td><?=$aux['valor_doado']?></td>
														<td><?=$aux['recebeu_doacao']?></td>
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
						<h4>Contribuições Recebidas:</h4>
						<table class="highlight">
							<thead>
								<tr>
									<th>Contribuição (R$)</th>
									<th>De</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if(isset($_SESSION['utils'])){                    
										$dados3 = $dados->doacoes_recebidas;
										if (!empty($dados3)) {
											foreach($dados3 as $aux){
											?>
												<tr>
													<td><?=$aux['valor_doado']?></td>
													<td><?=$aux['fez_doacao']?></td>
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
						<h4>Propostas Encerradas:</h4>
						<table class="highlight">
							<thead>
								<tr>
									<th>Finalidade</th>
									<th>Motivo</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if(isset($_SESSION['utils'])){
										$dados4 = $dados->doacoes_completadas;
										if (!empty($dados4)) {
											foreach($dados4 as $aux){
											?>
											<tr>
												<td><?=$aux['finalidade']?></td>
												<?php
												if($aux['meta']==$aux['arrecadado']){
												?>
												<td>Meta atingida</td>
												<?php
												}
												else{
												?>
												<td>Data limite alcançada.</td>
												<?php
												}
												?>
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