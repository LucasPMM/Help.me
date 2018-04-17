<?php
 	class dados_admin {

 		public $doacoes_aprovadas;
 		public $doacoes_recusadas;

 		function armazena_doacoes_aprovadas($dado){
 			$this->doacoes_aprovadas = $dado;
 		}
 		function armazena_doacoes_recusadas($dado){
 			$this->doacoes_recusadas = $dado;
 		}

	}


	function recebe_armazena_acoes(){
		$armazena = new dados_admin;

	    if (filesize('aprovadas.json') != 0){
 			$usuario_logado = $_SESSION['user'];

		    $jsonString = file_get_contents('aprovadas.json');
		    $data = json_decode($jsonString, true);

		    $dados1 = array();
            if (!empty($data)) {
			    foreach ($data as $key => $entry) {
			        array_push($dados1, $data[$key]);
			    }
			}
		    $armazena->armazena_doacoes_aprovadas($dados1);
		}

	    if (filesize('recusadas.json') != 0){
 			$usuario_logado = $_SESSION['user'];

		    $jsonString = file_get_contents('recusadas.json');
		    $data = json_decode($jsonString, true);

		    $dados2 = array();
            if (!empty($data)) {
			    foreach ($data as $key => $entry) {
			        array_push($dados2, $data[$key]);
			    }
			}
		    $armazena->armazena_doacoes_recusadas($dados2);
		}

		$_SESSION['dados_admin'] = $armazena;

	}

 ?> 