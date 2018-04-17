<?php
    function IsLogado($caminho){
        if(isset($_SESSION["user"])){
            $usuario = $_SESSION["user"];
            if($usuario->login!="admin"){
                $arquivo = file_get_contents($caminho);
                $json = json_decode($arquivo);
                foreach($json as $user){
                    if($user->login == $usuario->login && $user->senha == $usuario->senha){
                        return true;
                    }
                }
                return false;
            }
        }   
    }

    function Eh_Admin(){
        if(isset($_SESSION['user'])){
            if($_SESSION['user']->login == "admin")
                return true;
            else
                return false;
        }
        else
            return false;
    }

    function Analisa_Erro($erro){
        if($erro == "ano")
            return "Ano inválido.";
        else if($erro == "mes")
            return "Mês inválido.";
        else if($erro == "dia")
            return "Dia inválido.";
        else if($erro == "igual")
            return  "Você não pode inserir a data atual.";
        else if($erro == "nao_imagem")
            return "Arquivo selecionado não é uma imagem.";
        else if($erro == "imagem_grande")
            return "Arquivo selecionado é muito grande.";
        else if($erro == "jpg")
            return "Apenas arquivos JPG, JPEG e PNG são permitidos.";
        else if($erro == "valor_negativo")
            return "Você não pode inserir um valor negativo!.";
        else if($erro == "zero")
            return "Você não pode inserir esse valor!.";
        else if($erro == "invalido")
            return "Login ou Senha incorreto(s)";
        else if($erro == "admin")
            return "Não é possível criar uma conta com login igual a admin.";
        else if($erro == "existe")
            return "Login já exite.";
        else if($erro == "valor_excede_limite")
            return "O valor está acima do limite!";
        else if($erro == "senha")
            return "Senha incorreta";
        else if($erro == "saldo_insuficiente")
            return "Saldo insuficiente! Adicione dinheiro a sua carteira.";
        else if($erro == "nao_verificado")
            return "Seu email ainda não foi verificado / Ou usuário inexistente.";
    }

    function Errors(){
        $resposta;
        if(isset($_SESSION['error'])){
            if($_SESSION['error']=="valido"){
                return null;
            }
            $resposta = Analisa_Erro($_SESSION['error']);
            return $resposta;
        }
        else
            return null;
    }

    function Armazena_Erro($erro, $caminho){
        $_SESSION['error'] = $erro;
        $redirect = $caminho;
        header("location:$redirect");
    }

    function checa_logado(){
        if(isset($_SESSION["user"])){
            $usuario = $_SESSION["user"];
            if($usuario->login!="admin"){
                $arquivo = file_get_contents("../usuario/users.json");
                $json = json_decode($arquivo);
                foreach($json as $user){
                    if($user->login == $usuario->login && $user->senha == $usuario->senha){
                        $redirect = "../index.php";
                        header("location:$redirect");
                    }
                }
            }
        }           
    }

    function Retorna_Limite($id){
        $jsonString = file_get_contents('../doacoes/doacoes.json');
        $data = json_decode($jsonString, true);

        foreach ($data as $key => $entry) {
            if ($entry['id']==$id) {
                $valor_permitido = $entry['meta'] - $entry['arrecadado'];
                return $valor_permitido;
            }
        }
    }

    function Pega_Formato_Imagem($id, $caminho){
        $arquivo = file_get_contents($caminho);
        $json = json_decode($arquivo);

        foreach($json as $dados){
            if($dados->id == $id){
                return $dados->formato;
            }
        }

    }

 	function Guarda_Doacao($id){

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