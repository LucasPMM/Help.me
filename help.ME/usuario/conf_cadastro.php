 <?php
    require $_SERVER['DOCUMENT_ROOT'] . '/email/phpmail/PHPMailerAutoload.php';
    function sendEmail($email, $id_email_conf, $nome, $senha){

        $mail = new PHPMailer;
        //Enable SMTP debugging. 
        $mail->SMTPDebug = 3;                               
        //Set PHPMailer to use SMTP.
        $mail->isSMTP();            
        //Set SMTP host name                          
        $mail->Host = "smtp.gmail.com";
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = true;                          
        //Provide username and password     
        $mail->Username = "lukvailox@gmail.com";                 
        $mail->Password = "34960550.";                           
        //If SMTP requires TLS encryption then set it
        $mail->SMTPSecure = "tls";                           
        //Set TCP port to connect to 
        $mail->Port = 587;                                   

        $mail->From = "lukvailox@gmail.com";
        $mail->FromName = "Help.me"; 
        $mail->CharSet = 'UTF-8';


        $mail->addAddress($email, $nome);

        $mail->isHTML(true);
        $link = 'localhost/email/verifica_email.php?id_email='.$id_email_conf;

        $mail->Subject = "Subject Text";
        $mail->Body = "<h1>Verificação</h1>
                        <h2>Usuario: $nome</h2>
                        <h2>Senha:   $senha</h2>
                        <a href='$link'>Verifique sua conta.</a>";
        $mail->AltBody = "This is the plain text version of the email content";

        if(!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } 
        else {
            echo "Message has been sent successfully";
        }
    }
    ob_start(); // Initiate the output buffer
    require "class_user.inc";
    require "../utils/functions.php";
    //require "../email/manda_email.php";
    session_start();
    $login = $_POST["nome"];
    $senha = $_POST["senha"];
    $nome = $_POST["name"];
    $email = $_POST["email"];
    if($login!="admin"){
        $arquivo = file_get_contents('users.json');
        $json = json_decode($arquivo);
        $existe = 0;
        foreach($json as $user){
            if($user->login == $login){
                Armazena_Erro('existe', "cadastro.php");
                $existe = 1;
            }
        }
        if($existe == 0){
            $id_email_conf = mt_rand();
            $retorno = sendEmail($email, $id_email_conf, $login, $senha);
            $dados = file_get_contents('users.json');
            $json = json_decode($dados);
            $json[] = array('login'=>$login, 'senha'=>$senha, 'nome'=>$nome, 'email'=>$email, 'carteira'=>0);
            $dados_json = json_encode($json, JSON_PRETTY_PRINT);
            $arquivo = fopen("users.json", "w");
            fwrite($arquivo, $dados_json);
            fclose($arquivo);
            setcookie("checa_cadastro",true); 
            $_COOKIE['checa_cadastro'] = true;
            //Escreve no arquivo informando que o email ainda não foi verificado;
            $dados = file_get_contents('../email/emails_verificados.json');
            $json = json_decode($dados);
            $json[] = array('login'=>$login, 'email'=>$email, 'id_email_conf'=>$id_email_conf, 'verificado'=>0);
            $dados_json = json_encode($json, JSON_PRETTY_PRINT);
            $arquivo = fopen("../email/emails_verificados.json", "w");
            fwrite($arquivo, $dados_json);
            fclose($arquivo);
            echo "<br>".$retorno;
            $redirect = "../index.php";
            header("location:$redirect");
        }
    }
    else
        Armazena_Erro('admin', "cadastro.php");
?>