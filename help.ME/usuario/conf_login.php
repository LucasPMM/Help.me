<?php
    ob_start(); // Initiate the output buffer
    session_start();
    require 'class_user.inc';
    require '../utils/functions.php';
    $login = $_POST["nome"];
    $senha = $_POST["senha"];
    $permissao = 0;
    $verificado = 0;
    $_SESSION['aparece_toast'] = 0;

/*
        LEITURA
*/

    if($login == "admin"){
        $arquivo = file_get_contents('../admin/admin.json');
        $json = json_decode($arquivo);

        foreach($json as $admin){
            if($admin->login == $login && $admin->senha == $senha){
             
                $permissao = 1;

                $login_arq = $admin->login;
                $senha_arq = $admin->senha;
                $nome_arq = $admin->nome;
                $email_arq = $admin->email;

                $usuario = new User($nome_arq, $email_arq, $login_arq, $senha_arq,null);

                $_SESSION['user'] = $usuario;
            }
        }
    }

    else{
        $arquivo = file_get_contents('users.json');
        $json = json_decode($arquivo);

        $emails_verificados = file_get_contents('../email/emails_verificados.json');
        $email_json = json_decode($emails_verificados);

        foreach ($email_json as $temp) {
            if($login == $temp->login && $temp->verificado == 1)
                $verificado = 1;
        }

        foreach($json as $user){
            if($user->login == $login && $user->senha == $senha && $verificado == 1){
             
                $permissao = 1;

                $login_arq = $user->login;
                $senha_arq = $user->senha;
                $nome_arq = $user->nome;
                $email_arq = $user->email;
                $carteira_arq = $user->carteira;
                $usuario = new User($nome_arq, $email_arq, $login_arq, $senha_arq, $carteira_arq);
                $_SESSION['user'] = $usuario;
                $_SESSION['login_store'] = $login;
                $_SESSION['senha_store'] = $senha;
/*
                file_put_contents("../utils/usuario_logado.json", "");
                $usuario_logado = file_get_contents('../utils/usuario_logado.json');
                $dados = json_decode($usuario_logado);

                $dados[] = array('login'=>$login_arq, 'senha'=>$senha_arq);

                $dados_json = json_encode($dados, JSON_PRETTY_PRINT);
                $usuario_logado = fopen("../utils/usuario_logado.json", "w");
                fwrite($usuario_logado, $dados_json);
                fclose($usuario_logado);
*/
            }
        }
    }

    if ($permissao == 1) {
        if($login!="admin"){
        ?>
            <script>
                localStorage.setItem('login', '<?php echo $_SESSION['login_store'];?>');  
                localStorage.setItem('senha', '<?php echo $_SESSION['senha_store'];?>');
                window.location = '../index.php';
            </script>
        <?php
        }
        else{
            $redirect = "../index.php";
            header("location:$redirect");
        }
    } 
    else if($verificado == 0)
        Armazena_Erro('nao_verificado', "login.php");
    else 
        Armazena_Erro('invalido', "login.php");

?>