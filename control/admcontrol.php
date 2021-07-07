<?php 

require 'conexao.php';

$erros3 = array();
$titulo = '';
$genero = '';
$sinopse = '';
$sucesso = '';


//adicionar a 'catal'


if(isset($_POST["catalogo"]) && !empty($_FILES["img"]["name"])){
    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $sinopse = $_POST['sinopse'];
    $id = $_POST['id'];
    $targetDir = "uploads/";
    $img = basename($_FILES["img"]["name"]);
    $targetFilePath = $targetDir . $img;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);


    // validacao
    

    if (empty($titulo)){
        $erros3['titulo'] = 'Nunca vi um filme sem título, coloca alguma coisa aí ;)';
    }
    
    if (empty($sinopse)){
        $sinopse = 'não foi fornecido';
    }

    $tituloQuerry = 'SELECT * FROM catal WHERE valid=1 AND titulo=? LIMIT 1';
    $stmt = $conexao->prepare($tituloQuerry);
    $stmt->bind_param('s', $titulo);
    $stmt->execute();
    $result = $stmt->get_result();
    $tituloCont = $result->num_rows;
    $stmt->close();

    if ($tituloCont > 0) {
        $erros3['tituloex'] = 'Opa! Esse filme já está cadastrado, qualquer dia ele pode ser exibido, fica ligado.';
    }

    if (empty($sinopse)){
        $sinopse = 'não foi fornecido';
    }


    $allowTypes = array('jpg','png','jpeg');
    if(in_array($fileType, $allowTypes)){
    }else{
        $erros3['tipoimg'] = 'Opa! Essa imagem que você inseriu não é valida, as extenções de imagem válidas são .jpg, .png e .jpeg';
    }


    if(move_uploaded_file($_FILES["img"]["tmp_name"], $targetFilePath)){
    }else{
        $erros3['upload'] = 'Parece que houve um erro ao fazer o upload da sua imagem';
    }


    if (count($erros3) === 0) {
        $sql = "UPDATE catal SET titulo='$titulo', genero='$genero', sinopse='$sinopse', img='$img', exib=0, valid=1 WHERE id='$id';";
        $stmt = $conexao->prepare($sql);
        if (!$conexao->query($sql)) {
            $erros3['bd'] = mysqli_error($conexao);
        }else{
            $sucesso = 'Filme validado com sucesso';
        }
        $sql = "UPDATE genero SET numgenero = numgenero+1 WHERE nomegenero='$genero';";
        $stmt = $conexao->prepare($sql);
        if (!$conexao->query($sql)) {
            $erros3['bd'] = mysqli_error($conexao);
        }

    }
}

if (isset($_POST['catalogo']) && empty($_FILES["img"]["name"])){
    $erros3['vazio'] = 'Insira uma imagem para diferenciar o filme de títulos semelhantes ;)';
}


//apagar

if (isset($_POST['apagar'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM catal WHERE id='$id';";
    $stmt = $conexao->prepare($sql);
    if (!$conexao->query($sql)) {
        $erros3['bd'] = mysqli_error($conexao);
    }else{
        $sucesso = 'Filme adicionado com sucesso';
    }
}