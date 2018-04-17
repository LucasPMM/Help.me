<?php
    ob_start(); // Initiate the output buffer
    require 'class_doacao.inc';
    require '../utils/functions.php';
    require '../usuario/class_user.inc';
    session_start();

    $controle = $_POST['id'];
    $valor = $_POST['valor_doacao'];
    $senha = $_POST['senha'];


    $jsonString = file_get_contents('doacoes.json');
    $data = json_decode($jsonString, true);

    $usuario = $_SESSION["user"];

    foreach ($data as $key => $entry) {
        if ($entry['id']==$controle) {

            if($valor < 0)
                Armazena_Erro('valor_negativo', "../usuario/doar.php");

            else if($data[$key]['arrecadado']+$valor > $data[$key]['meta'])
                Armazena_Erro('valor_excede_limite', "../usuario/doar.php");

            else if($valor == 0)
                Armazena_Erro('zero', "../usuario/doar.php");  
            
            else if($usuario->senha!=$senha)
                Armazena_Erro('senha', "../usuario/doar.php");

            else if($usuario->carteira<$valor)
                Armazena_Erro('saldo_insuficiente', "../usuario/doar.php");

            else if($data[$key]['arrecadado']+$valor <= $data[$key]['meta'] && $valor > 0) {//realiza a doação
                $data[$key]['arrecadado'] += $valor;
                $usuario->carteira -= $valor;
                $_SESSION['user'] = $usuario;

//Escreve o novo saldo no arquivo.


                $json = file_get_contents('../usuario/users.json');
                $dados = json_decode($json, true);

                foreach ($dados as $chave => $aux) {
                    if ($aux['login']==$usuario->login) {
                        $dados[$chave]['carteira'] = $usuario->carteira;
                    }
                }


                $escrever = json_encode($dados, JSON_PRETTY_PRINT);
                $file = fopen("../usuario/users.json", "w");
                fwrite($file, $escrever);
                fclose($file);


                $dados_json = json_encode($data, JSON_PRETTY_PRINT);
                $arquivo = fopen("doacoes.json", "w");
                fwrite($arquivo, $dados_json);
                fclose($arquivo);

//--------------------------------------------------------------------------------
                //escreve no arquivo a doação que você fez

                $fez_doacao = $usuario->login; //quem fez a doação 
                $recebeu_doacao = $data[$key]['autor'];//quem recebeu a doação

                //valor doado e o id a doação. 

                $arquivo = file_get_contents('../usuario/movimento_Capital.json');
                $json = json_decode($arquivo);

                $json[] = array('valor_doado'=>$valor, 'para_quem' => $controle, 'fez_doacao'=>$fez_doacao,'recebeu_doacao'=>$recebeu_doacao, 'login_doador'=>$usuario->login);

            
                $dados_json = json_encode($json, JSON_PRETTY_PRINT);
                $arquivo = fopen("../usuario/movimento_Capital.json", "w");
                fwrite($arquivo, $dados_json);
                fclose($arquivo);

                $redirect = "../utils/sucesso.php";
                header("location:$redirect");
//--------------------------------------------------------------------------------
            }

            if($data[$key]['arrecadado'] == $data[$key]['meta']) {
                $finalidade = $data[$key]['finalidade'];
                $meta = $data[$key]['meta'];
                $autor = $data[$key]['autor'];
                $aprovado = $data[$key]['aprovado'];
                $arrecadado = $data[$key]['arrecadado'];
                $id = $data[$key]['id'];
                $sobre = $data[$key]['descricao'];
                $data_arq = $data[$key]['data'];

//-----------------------------------------------------------------
//exclui o pedido de doação.

                $arquivo = fopen("auxx.json", "w");
                fwrite($arquivo, "");

                $jsonString = file_get_contents('doacoes.json');
                $data = json_decode($jsonString, true);

                foreach ($data as $key => $entry) {
                    if ($entry['meta']!=$entry['arrecadado']) {
                        $dados = file_get_contents('auxx.json');
                        $json = json_decode($dados);

                        $json[] = array('finalidade'=>$entry['finalidade'], 'meta'=>$entry['meta'], 'autor'=>$entry['autor'], 'aprovado'=>$entry['aprovado'], 'arrecadado'=>$entry['arrecadado'], 'id'=>$entry['id'], 'descricao'=>$entry['descricao'], 'data'=>$entry['data']); 


                        $dados_json = json_encode($json, JSON_PRETTY_PRINT);
                        $arquivo = fopen("auxx.json", "w");
                        fwrite($arquivo, $dados_json);
                        fclose($arquivo);

                    }
                }

                $jsonString = file_get_contents('auxx.json');
                $data = json_decode($jsonString, true);

                $dados_json = json_encode($data, JSON_PRETTY_PRINT);
                $arquivo = fopen("doacoes.json", "w");
                fwrite($arquivo, $dados_json);
                fclose($arquivo);

//-----------------------------------------------------------------
//armazena em um arquivo que contem somente as doações finalizadas.

                $arquivo = file_get_contents('doacoes_finalizadas.json');
                $json = json_decode($arquivo);

                $json[] = array('finalidade'=>$finalidade, 'meta'=>$meta, 'autor'=>$autor, 'aprovado'=>$aprovado, 'arrecadado'=>$arrecadado, 'id'=>$id, 'descricao'=>$sobre, 'data'=>$data_arq); 

            
                $dados_json = json_encode($json, JSON_PRETTY_PRINT);
                $arquivo = fopen("doacoes_finalizadas.json", "w");
                fwrite($arquivo, $dados_json);
                fclose($arquivo);              
                $redirect = "../utils/sucesso.php";
                header("location:$redirect");
            }
        }
    }
?>