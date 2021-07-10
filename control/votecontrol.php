<?php

require_once '../control/conexao.php';


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

?>