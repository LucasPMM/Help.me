<?php
    ob_start(); // Initiate the output buffer
    require 'class_user.inc';
    require '../utils/functions.php';
    session_start();


    $valor = $_POST['valor'];
    $usuario = $_SESSION['user'];
/*
        ESCRITA
*/
    if($valor < 0)
        Armazena_Erro('valor_negativo', "carteira.php");
    
    else if($valor == 0)
        Armazena_Erro('zero', "carteira.php");  
    
    else{
        $jsonString = file_get_contents('users.json');
        $data = json_decode($jsonString, true);

        foreach ($data as $key => $entry) {
            if ($entry['login']==$usuario->login) {
                $data[$key]['carteira'] += $valor;
                $usuario->carteira+=$valor;
                $_SESSION['user'] = $usuario;
            }
        }


        $dados_json = json_encode($data, JSON_PRETTY_PRINT);
        $arquivo = fopen("users.json", "w");
        fwrite($arquivo, $dados_json);
        fclose($arquivo);


        $redirect = "../utils/sucesso.php";
        header("location:$redirect");
    }
?>