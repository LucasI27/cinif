<?php 

require 'conexao.php';

$erros2 = array();
$titulo = '';
$genero = '';
$sinopse = '';

// adicionar à catal_temp

if (isset($_POST['tempb'])){
    $titulo = mysqli_real_escape_string($conexao, $_POST['titulo']);
    $genero = $_POST['genero'];
    $sinopse = mysqli_real_escape_string($conexao, $_POST['sinopse']);
    $valid = 0;
    $exib = 0;

    
    // verificação
    

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


    if ($genero === 'NULL') {
        $erros2['genero'] = 'Nosso site precisa de um gênero para separar os filmes em categorias.';
    }


    if (count($erros2) === 0) {
        $sql = "INSERT INTO catal (titulo, genero, sinopse, exib, valid) VALUES ('$titulo', '$genero', '$sinopse', '$exib', '$valid')";
        $stmt1 = $conexao->prepare($sql);
        if (!$conexao->query($sql)) {
            $erros2['bd'] = mysqli_error($conexao);
        }else{
            $erros2['sucesso'] = 'Filme adicionado com sucesso';
        }
    }
}


