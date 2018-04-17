<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/email/phpmail/PHPMailerAutoload.php';

	function sendEmail($email, $id_email_conf, $nome){
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'lukvailox@gmail.com';
		$mail->Password = '34960550.';
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;
		$mail->CharSet = 'UTF-8';
		
		$mail->From = 'lukvailox@gmail.com';
		$mail->FromName = 'Help.me';
		$mail->addAddress($email,"Nome do cara");
		$mail->isHTML(true);
		$link = 'https://help-me-daw.herokuapp.com/email/verifica_email.php?id_email='.$id_email_conf;
		$mail->Subject = 'Valide sua conta';
		$mail->Body    = "<h1>Teste</h1>
						<h2>$nome</h2>
						<a href='$link'>Verifique sua conta.</a>";

		//$mail->Body    = file_get_contents(HTMLEMAILPATH);

		$result = $mail->send(); 
		if(!$result)
			return 'Mailer Error: ' . $mail->ErrorInfo . "\n";
		else 
			return 'done';
	}

	function manda_doacao($email, $nome, $meta){
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'lukvailox@gmail.com';
		$mail->Password = '34960550.';
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;
		$mail->CharSet = 'UTF-8';
		
		$mail->From = 'lukvailox@gmail.com';
		$mail->FromName = 'Help.me';
		$mail->addAddress($email,"Nome do cara");
		$mail->isHTML(true);
		$mail->Subject = 'Nova Doação';
		$mail->Body    = "<h1>$nome</h1>
						<h2>$meta</h2>
						<p>Ajude em nosso site.</p>";

		//$mail->Body    = file_get_contents(HTMLEMAILPATH);

		$result = $mail->send(); 
		if(!$result)
			return 'Mailer Error: ' . $mail->ErrorInfo . "\n";
		else 
			return 'done';
	}

?>