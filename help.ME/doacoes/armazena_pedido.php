<?php
    ob_start(); // Initiate the output buffer
    require '../doacoes/class_doacao.inc';
    require "../usuario/class_user.inc";
    require "../utils/functions.php";
    session_start();

    $finalidade = htmlspecialchars($_POST["finalidade"]);
    $meta = htmlspecialchars($_POST["meta"]);
    $descricao = htmlspecialchars($_POST['descricao']);
    $id = mt_rand();

    $data_atual = date("d/m/Y");
    $dia_atual = $data_atual[0].$data_atual[1];
    $mes_atual = $data_atual[3].$data_atual[4];
    $ano_atual = $data_atual[6].$data_atual[7].$data_atual[8].$data_atual[9];

    $data = htmlspecialchars($_POST['data']);
    $ano_inserido = $data[0].$data[1].$data[2].$data[3];
    $mes_inserido = $data[5].$data[6];
    $dia_inserido = $data[8].$data[9];

    if($ano_inserido<$ano_atual)
        Armazena_Erro('ano', "../usuario/pedido.php");

    else if($ano_inserido==$ano_atual && $mes_inserido<$mes_atual)
        Armazena_Erro('mes', "../usuario/pedido.php");

    else if($ano_inserido==$ano_atual && $mes_inserido==$mes_atual && $dia_inserido<$dia_atual)
        Armazena_Erro('dia', "../usuario/pedido.php");

    else if($ano_inserido==$ano_atual && $mes_inserido==$mes_atual && $dia_inserido==$dia_atual)
        Armazena_Erro('igual', "../usuario/pedido.php");

    else{

        $target_dir = "";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                Armazena_Erro('nao_imagem', "../usuario/pedido.php");
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            Armazena_Erro('jpg', "../usuario/pedido.php");
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                rename( $_FILES["fileToUpload"]["name"], '../imagens/'.$id.".".$imageFileType);

                $imagens = file_get_contents('../imagens/imagens.json');
                $json = json_decode($imagens);
                
                $json[] = array('id'=>$id, 'formato'=>$imageFileType); 

                $dados_json = json_encode($json, JSON_PRETTY_PRINT);
                $arquivo = fopen("../imagens/imagens.json", "w");
                fwrite($arquivo, $dados_json);
                fclose($arquivo);                

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        $dados = file_get_contents('doacoes.json');
        $json = json_decode($dados);

        $usuario = $_SESSION["user"];
        
        $json[] = array('finalidade'=>$finalidade, 'meta'=>$meta, 'autor'=>$usuario->nome, 'aprovado'=>0, 'arrecadado'=>0, 'id'=>$id, 'descricao'=>$descricao, 'data'=>$data); 


        $dados_json = json_encode($json, JSON_PRETTY_PRINT);
        $arquivo = fopen("doacoes.json", "w");
        fwrite($arquivo, $dados_json);
        fclose($arquivo);
        
        $redirect = "../utils/sucesso.php";
        header("location:$redirect");
    }
?>