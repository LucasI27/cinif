<?php 

require 'conexao.php';

$erros2 = array();
$titulo = '';
$genero = '';
$sinopse = '';
$sucesso = '';


//adicionar a 'catal'



if (isset($_POST['catalogo'])){
    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $sinopse = $_POST['sinopse'];
    $img = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $id = $_POST['id'];
    

    // validacao
    

    if (empty($titulo)){
        $erros2['titulo'] = 'Nunca vi um filme sem título, coloca alguma coisa aí ;)';
    }
    
    if (empty($sinopse)){
        $sinopse = 'não foi fornecido';
    }

    $tituloQuerry = 'SELECT * FROM catal WHERE titulo=? LIMIT 1';
    $stmt = $conexao->prepare($tituloQuerry);
    $stmt->bind_param('s', $titulo);
    $stmt->execute();
    $result = $stmt->get_result();
    $tituloCont = $result->num_rows;
    $stmt->close();

    if ($tituloCont > 0) {
        $erros2['tituloex'] = 'Opa! Esse filme já está cadastrado, qualquer dia ele pode ser exibido, fica ligado.';
    }

    if (empty($sinopse)){
        $sinopse = 'não foi fornecido';
    }





    if (count($erros2) === 0) {
        $sql = "UPDATE catal SET titulo='$titulo', genero='$genero', sinopse='$sinopse', img='$img', exib=0, verif=1 WHERE id='$id';";
        $stmt = $conexao->prepare($sql);
        if (!$conexao->query($sql)) {
            $erros2['bd'] = mysqli_error($conexao);
        }else{
            $sucesso = 'Filme adicionado com sucesso';
        }
    }
}