<?php
 	class Doacao {
 		public $descricao;
 		public $meta;
 		public $autor;
 		public $aprovado;
 		public $valor_acumulado = 0;
 		public $id;

        public $sobre;
        public $data;

 		function __construct($descricao, $meta, $autor, $aprovado, $id) {
 			$this->descricao = $descricao;
 			$this->meta = $meta;
 			$this->autor = $autor;
 			$this->aprovado = $aprovado;
 			$this->id = $id;
 		}
 		function set_arrecadado($arrecadado){
 			$this->valor_acumulado = $arrecadado;
 		}
        function set_sobre($sobre){
            $this->sobre = $sobre;
        }
        function set_data($data){
            $this->data = $data;
        }
 	}

 	function armazena_doacoes_classe($id){

        $arquivo = file_get_contents('../doacoes/doacoes.json');
        $json = json_decode($arquivo);

        foreach($json as $dados){
            if($dados->id == $id){
                
                $finalidade = $dados->finalidade;
                $meta = $dados->meta;
                $autor = $dados->autor;
                $aprovado = $dados->aprovado;
                $arrecadado = $dados->arrecadado;
                $id_arq = $dados->id;
                $sobre = $dados->descricao;
                $data_arq = $dados->data;

                $doacao_atual = new Doacao($finalidade, $meta, $autor, $aprovado, $id_arq);
                $doacao_atual->set_arrecadado($arrecadado);
                $doacao_atual->set_sobre($sobre);
                $doacao_atual->set_data($data_arq);

                $_SESSION["doacao_atual"] = $doacao_atual;
            }
        }
 	}
 ?> 