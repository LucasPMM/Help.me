<?php
    ob_start(); // Initiate the output buffer
    require '../doacoes/class_doacao.inc';
    session_start();

    $doacao = $_SESSION['doacao'];

    $descricao = $doacao->descricao;
    $meta = $doacao->meta;
    $autor = $doacao->autor;
    $aprovado = $doacao->aprovado;

    $controle = $_POST['controle'];

/*
        ESCRITA
*/
    $arquivo = fopen("../doacoes/auxx.json", "w");
    fwrite($arquivo, "");

    $jsonString = file_get_contents('../doacoes/doacoes.json');
    $data = json_decode($jsonString, true);

    foreach ($data as $key => $entry) {
        if ($entry['id']!=$controle) {
            $dados = file_get_contents('../doacoes/auxx.json');
            $json = json_decode($dados);

            $json[] = array('finalidade'=>$entry['finalidade'], 'meta'=>$entry['meta'], 'autor'=>$entry['autor'], 'aprovado'=>$entry['aprovado'], 'arrecadado'=>$entry['arrecadado'], 'id'=>$entry['id'], 'descricao'=>$entry['descricao'], 'data'=>$entry['data']); 


            $dados_json = json_encode($json, JSON_PRETTY_PRINT);
            $arquivo = fopen("../doacoes/auxx.json", "w");
            fwrite($arquivo, $dados_json);
            fclose($arquivo);
        }
        else{//armazena no arquivo de reprovadas

            $dados = file_get_contents('recusadas.json');
            $json = json_decode($dados);
            
            $json[] = array('finalidade'=>$data[$key]['finalidade'], 'meta'=>$data[$key]['meta'], 'autor'=>$data[$key]['autor'], 'aprovado'=>$data[$key]['aprovado'], 'arrecadado'=>$data[$key]['arrecadado'], 'id'=>$data[$key]['id'], 'descricao'=>$entry['descricao'], 'data'=>$entry['data']); 

            $dados_json = json_encode($json, JSON_PRETTY_PRINT);
            $arquivo = fopen("recusadas.json", "w");
            fwrite($arquivo, $dados_json);
            fclose($arquivo);
        }
    }

    $jsonString = file_get_contents('../doacoes/auxx.json');
    $data = json_decode($jsonString, true);

    $dados_json = json_encode($data, JSON_PRETTY_PRINT);
    $arquivo = fopen("../doacoes/doacoes.json", "w");
    fwrite($arquivo, $dados_json);
    fclose($arquivo);

    $redirect = "../index.php";
    header("location:$redirect");
?>