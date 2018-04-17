<?php
 	class User {
 		public $nome;
 		public $email;
 		public $login;
 		public $senha;
		public $carteira = 0;

 		function __construct($nome, $email, $login, $senha, $carteira) {
 			$this->nome = $nome;
 			$this->email = $email;
 			$this->login = $login;
 			$this->senha = $senha;
 			$this->carteira = $carteira;
 		}
 	}
?> 