<?php

require_once '../control/conexao.php';
require_once '../control/autcontrol.php';


$erros3 = array();


if (isset($_POST['votar'])) {
    $nomegenero = $_POST['nomegenero'];
    $id = $_POST['id'];

    $sql = "SELECT numvg FROM users WHERE id='$id'";
    $result = mysqli_query($conexao, $sql);
    $numv = mysqli_fetch_assoc($result);

    if ($numv['numvg'] == 1) {
        $sql = "UPDATE genero SET numvotosg = numvotosg+1 WHERE nomegenero='$nomegenero';";
        $stmt = $conexao->prepare($sql);
        if (!$conexao->query($sql)) {
            $erros3['bd'] = mysqli_error($conexao);
        }
    
        $sql = "UPDATE users SET numvg = 0 WHERE id='$id';";
        $stmt = $conexao->prepare($sql);
        if (!$conexao->query($sql)) {
            $erros3['bd'] = mysqli_error($conexao);
        }
    }
}





if (isset($_POST['votarf'])) {
    $id = $_SESSION['id'];
    $idf = $_POST['idf'];

    $sql = "SELECT numvf FROM users WHERE id='$id'";
    $result = mysqli_query($conexao, $sql);
    $numv = mysqli_fetch_assoc($result);

    if ($numv['numvf'] == 1) {
        $sql = "UPDATE catal SET numvotosf = numvotosf+1 WHERE id='$idf';";
        $stmt = $conexao->prepare($sql);
        if (!$conexao->query($sql)) {
            echo $erros3['bd'] = mysqli_error($conexao);
        }
    
        $sql = "UPDATE users SET numvf = 0 WHERE id='$id';";
        $stmt = $conexao->prepare($sql);
        if (!$conexao->query($sql)) {
            echo $erros3['bd'] = mysqli_error($conexao);
        }
    }
}

?>