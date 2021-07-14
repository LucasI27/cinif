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






if (isset($_POST['voteini'])) {

    if (empty($_POST['mens'])) {
        $erros3['mens'] = 'Insira uma mensagem para iniciar a votação, de preferência o local e hora de exibição';
    }
    

    
    if (count($erros3) === 0){
 

        
        
        $mens = $_POST['mens'];
        $sql = "UPDATE users SET numvg = 1, numvf = 1;";
        $stmt = $conexao->prepare($sql);
        if (!$conexao->query($sql)) {
            $erros3['bd'] = mysqli_error($conexao);
        }
        $sql = "UPDATE controle SET voteg=1, votef=1, mens='$mens';";
        $stmt1 = $conexao->prepare($sql);
        if (!$conexao->query($sql)) {
            $erros3['bd'] = mysqli_error($conexao);

        }  

        $sql = "UPDATE genero SET numvotosg=0";
        $stmt1 = $conexao->prepare($sql);
        if (!$conexao->query($sql)) {
            $erros3['bd'] = mysqli_error($conexao);

        } 

        $sql = "UPDATE catal SET numvotosf=0";
        $stmt1 = $conexao->prepare($sql);
        if (!$conexao->query($sql)) {
            $erros3['bd'] = mysqli_error($conexao);

        } 


    }

}





if (isset($_POST['voteter'])) {



    //GENERO VENCEDOR
    $sql = "SELECT * FROM genero WHERE numvotosg = (SELECT MAX(numvotosg) FROM GENERO LIMIT 1) LIMIT 1;";
    $result = mysqli_query($conexao, $sql);
    $maxg = mysqli_fetch_assoc($result);
    $nomevencedorg = $maxg['nomegenero'];

    $sql = "SELECT numvotosg FROM genero;";
    $result = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_assoc($result);
    while ($row = mysqli_fetch_assoc($result)){
        if ($row['numvotosg'] > 0) {            
            $sql = "UPDATE genero SET vencedor=1 WHERE nomegenero='$nomevencedorg';";
            $stmt1 = $conexao->prepare($sql);
            if (!$conexao->query($sql)) {
                $erros3['bd'] = mysqli_error($conexao);
            } 
        }
    }

    //------------------------------------------

    //FILME VENCEDOR
    $sql = "SELECT * FROM catal WHERE numvotosf = (SELECT MAX(numvotosf) FROM catal LIMIT 1) LIMIT 1;";
    $result = mysqli_query($conexao, $sql);
    if (!$conexao->query($sql)) {
        $erros3['bd'] = mysqli_error($conexao);
    }

    $maxf = mysqli_fetch_assoc($result);
    $nomevencedorf = $maxf['titulo'];

    $sql = "UPDATE catal SET exib=1 WHERE titulo='$nomevencedorf';";
    $stmt1 = $conexao->prepare($sql);
    if (!$conexao->query($sql)) {
        $erros3['bd'] = mysqli_error($conexao);
    } 

    $sql = "UPDATE genero SET numgenero=numgenero-1 WHERE nomegenero=(SELECT genero FROM catal WHERE titulo='$nomevencedorf' LIMIT 1);";
    $stmt1 = $conexao->prepare($sql);
    if (!$conexao->query($sql)) {
        $erros3['bd'] = mysqli_error($conexao);
    } 
    //-------------------------------------------



    $sql = "SELECT mens FROM controle;";
    $result = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_assoc($result);
    if (!$conexao->query($sql)) {
       echo $erros3['bd'] = mysqli_error($conexao);
    } 

    $mens = $row['mens'];
    $mens .= " As votações já terminaram, o filme exibido será $nomevencedorf";


    $sql = "UPDATE controle SET voteg=0, votef=0, mens='$mens'";
    $stmt1 = $conexao->prepare($sql);
    if (!$conexao->query($sql)) {
        $erros3['bd'] = mysqli_error($conexao);

    }

    
    $sql = "UPDATE controle SET vencedorg=(SELECT nomegenero FROM genero WHERE vencedor=1);";
    $stmt1 = $conexao->prepare($sql);
    if (!$conexao->query($sql)) {
        $erros3['bd'] = mysqli_error($conexao);
    }

    $sql = "UPDATE genero SET vencedor=0;";
    $stmt1 = $conexao->prepare($sql);
    if (!$conexao->query($sql)) {
        $erros3['bd'] = mysqli_error($conexao);
    } 





}

