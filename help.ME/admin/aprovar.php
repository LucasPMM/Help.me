<?php
    ob_start(); // Initiate the output buffer
    require '../doacoes/class_doacao.inc';
    require $_SERVER['DOCUMENT_ROOT'] . '/email/manda_email.php';
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

    $jsonString = file_get_contents('../doacoes/doacoes.json');
    $data = json_decode($jsonString, true);

    foreach ($data as $key => $entry) {
        if ($entry['id']==$controle) {
            $data[$key]['aprovado'] = 1;
   
            $dados = file_get_contents('aprovadas.json');
            $json = json_decode($dados);
            
            $json[] = array('finalidade'=>$data[$key]['finalidade'], 'meta'=>$data[$key]['meta'], 'autor'=>$data[$key]['autor'], 'aprovado'=>$data[$key]['aprovado'], 'arrecadado'=>$data[$key]['arrecadado'], 'id'=>$data[$key]['id'], 'descricao'=>$data[$key]['descricao'], 'data'=>$data[$key]['data']); 

            $dados_json = json_encode($json, JSON_PRETTY_PRINT);
            $arquivo = fopen("aprovadas.json", "w");
            fwrite($arquivo, $dados_json);
            fclose($arquivo);
        }
    }

    $dados_json = json_encode($data, JSON_PRETTY_PRINT);
    $arquivo = fopen("../doacoes/doacoes.json", "w");
    fwrite($arquivo, $dados_json);
    fclose($arquivo);

/*Send email
    $emails_verificados = file_get_contents('../email/emails_verificados.json');
    $email_json = json_decode($emails_verificados);
    $emails = array();

    foreach ($email_json as $temp) {
        array_push($emails, $temp->email);
    }

    for($i = 0; i < count($emails); $i++){
        echo "string";
        $retorno = manda_doacao($emails[$i], $descricao, $meta);
    }
*/

    $redirect = "../index.php";
    header("location:$redirect");
?>