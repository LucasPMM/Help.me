<?php
	$id = $_GET['id_email'];

	$arquivo = file_get_contents('emails_verificados.json');
	$json = json_decode($arquivo);

	foreach($json as $temp){
		if($temp->id_email_conf == $id){
			$temp->verificado = 1;
		}
	}

	$dados_json = json_encode($json, JSON_PRETTY_PRINT);
	$arquivo = fopen("emails_verificados.json", "w");
	fwrite($arquivo, $dados_json);
	fclose($arquivo);

    $redirect = "../index.php";
    header("location:$redirect");
?>