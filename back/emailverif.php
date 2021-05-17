<?php require_once '../control/autcontrol.php';?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">   
    <link rel="icon" href="../img/logo2.png">
    <link rel="stylesheet" href="../styles/emailverif.css">
    <title>CinIF</title>
</head>
<body>
    <div class="flex">

        <table class="header">
            <tr>
                <td class="bord"><img src="../img/logo2.png" alt="logo" class="logo"></td>
                <td><p class="titulo">CinIF</p></td>



            </tr>
        </table>

        <?php if ($_SESSION['verif']):?>    
            <div class="balao">
                <p class="balaot">Não feche essa guia, foi enviado um email de confirmação para <?php echo $_SESSION['email']; ?></p>
            </div>
        <?php endif;?>

    </div>
    <div class="aln">
        <?php if (!$_SESSION['verif']):?>
            <td><a href="login.php"><button class="verifb">Verificado</button></a></td>
            <img class="em_v" src="../img/em_v.png">
            <?php else: ?>
            <p class="descm"><?php echo $_SESSION['msg']; ?></p>
            <img class="em_x" src="../img/em_x.png">
        <?php endif;?>        
    </div>

        
</body>
</html>