<?php
 	class Utils {

 		public $doacoes_abertas;			//doacoes.json   				var autor
 		public $doacoes_realizadas;			//movimento_capital.json 		var fez_doacao
 		public $doacoes_recebidas;			//movimento_capital.json 		var recebeu doacao
 		public $doacoes_completadas;		//doacoes_finalizadas.json 		var autor

 		function armazena_doacoes_abertas($dado){
			$this->doacoes_abertas = $dado;
 		}
 		function armazena_doacoes_realizadas($dado){
			$this->doacoes_realizadas = $dado;
 		}
 		function armazena_doacoes_recebidas($dado){
			$this->doacoes_recebidas = $dado;
 		}
 		function armazena_doacoes_completadas($dado){
			$this->doacoes_completadas = $dado;
 		}
 	}

 	function armazena_dados_secao(){
	    $armazenar = new Utils;

	    if (filesize('../doacoes/doacoes.json') != 0){
 			$usuario_logado = $_SESSION['user'];

		    $jsonString = file_get_contents('../doacoes/doacoes.json');
		    $data = json_decode($jsonString, true);

		    $dados1 = array();
            if (!empty($data)) {
			    foreach ($data as $key => $entry) {
			        if ($entry['autor']==$usuario_logado->login) {
			        	array_push($dados1, $data[$key]);
			        }
			    }
			}
		    $armazenar->armazena_doacoes_abertas($dados1);
		}

		if (filesize('../usuario/movimento_Capital.json') != 0){
		    $jsonString = file_get_contents('../usuario/movimento_Capital.json');
		    $data = json_decode($jsonString, true);

		    $dados2 = array();
            if (!empty($data)) {
			    foreach ($data as $key => $entry) {
			        if ($entry['fez_doacao']==$usuario_logado->login) {
			        	array_push($dados2, $data[$key]);
			        }
			    }
			}
		    $armazenar->armazena_doacoes_realizadas($dados2);
		}

		if (filesize('../usuario/movimento_Capital.json') != 0){
		    $jsonString = file_get_contents('../usuario/movimento_Capital.json');
		    $data = json_decode($jsonString, true);

		    $dados3 = array();
            if (!empty($data)) {
			    foreach ($data as $key => $entry) {
			        if ($entry['recebeu_doacao']==$usuario_logado->login) {
			        	array_push($dados3, $data[$key]);
			        }
			    }
			}
		    $armazenar->armazena_doacoes_recebidas($dados3);
		}

		if (filesize('../doacoes/doacoes_finalizadas.json') != 0){
		    $jsonString = file_get_contents('../doacoes/doacoes_finalizadas.json');
		    $data = json_decode($jsonString, true);

		    $dados4 = array();
            if (!empty($data)) {
			    foreach ($data as $key => $entry) {
			        if ($entry['autor']==$usuario_logado->login) {
			        	array_push($dados4, $data[$key]);
			        }
			    }
			}
		    $armazenar->armazena_doacoes_completadas($dados4);
		}
		
	    $_SESSION['utils'] = $armazenar;
 	}
 ?> 