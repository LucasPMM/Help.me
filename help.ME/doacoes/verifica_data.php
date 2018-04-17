<?php

	function verifica_data(){
		$controle=0;
	    date_default_timezone_set('America/Sao_Paulo');
	    $data_atual = date("d/m/Y");

        $arquivo = fopen("doacoes/auxx.json", "w");
	    fwrite($arquivo, "");

	    $jsonString = file_get_contents('doacoes/doacoes.json');
	    $data = json_decode($jsonString, true);

		$today = date("Y-m-d");
	    if(filesize('doacoes/doacoes.json')!=0 && isset($data)){
		    foreach ($data as $key => $entry) {

		        if ($today > $entry['data']){
		        	$controle = 1;
		            $dados = file_get_contents('doacoes/vencidas.json');
		            $json = json_decode($dados);

		            $json[] = array('finalidade'=>$entry['finalidade'], 'meta'=>$entry['meta'], 'autor'=>$entry['autor'], 'aprovado'=>$entry['aprovado'], 'arrecadado'=>$entry['arrecadado'], 'id'=>$entry['id'], 'descricao'=>$entry['descricao'], 'data'=>$entry['data']); 


		            $dados_json = json_encode($json, JSON_PRETTY_PRINT);
		            $arquivo = fopen("doacoes/vencidas.json", "w");
		            fwrite($arquivo, $dados_json);
		            fclose($arquivo);

		            $dados2 = file_get_contents('doacoes/doacoes_finalizadas.json');
		            $json2 = json_decode($dados2);

		            $json2[] =  array('finalidade'=>$entry['finalidade'], 'meta'=>$entry['meta'], 'autor'=>$entry['autor'], 'aprovado'=>$entry['aprovado'], 'arrecadado'=>$entry['arrecadado'], 'id'=>$entry['id'], 'descricao'=>$entry['descricao'], 'data'=>$entry['data']);

		            $dados_json2 = json_encode($json2, JSON_PRETTY_PRINT);
		            $arquivo2 = fopen("doacoes/doacoes_finalizadas.json", "w");
		            fwrite($arquivo2, $dados_json2);
		            fclose($arquivo2);
		        }
		        else{
		            $dados = file_get_contents('doacoes/auxx.json');
		            $json = json_decode($dados);

		            $json[] = array('finalidade'=>$entry['finalidade'], 'meta'=>$entry['meta'], 'autor'=>$entry['autor'], 'aprovado'=>$entry['aprovado'], 'arrecadado'=>$entry['arrecadado'], 'id'=>$entry['id'], 'descricao'=>$entry['descricao'], 'data'=>$entry['data']); 


		            $dados_json = json_encode($json, JSON_PRETTY_PRINT);
		            $arquivo = fopen("doacoes/auxx.json", "w");
		            fwrite($arquivo, $dados_json);
		            fclose($arquivo);
		        }
		    }
		    if($controle==1){
		    	$controle=0;
			    $jsonString = file_get_contents('doacoes/auxx.json');
			    $data = json_decode($jsonString, true);

			    $dados_json = json_encode($data, JSON_PRETTY_PRINT);
			    $arquivo = fopen("doacoes/doacoes.json", "w");
			    fwrite($arquivo, $dados_json);
			    fclose($arquivo);
			}
		}
	}
?>