<?php
require '../control/conexao.php';
require_once '../control/autcontrol.php';
require_once '../control/votecontrol.php';

$sql = "SELECT * FROM controle";
$result = mysqli_query($conexao, $sql);
$controle = mysqli_fetch_assoc($result);
$mens = $controle['mens'];
$voteg = $controle['voteg'];




if ($_SESSION['verif'] == 0) {
    header('location: emailverif.php');
}


if (!isset($_SESSION['id'])) {
    header('location: login.php');
}


foreach ($erros3 as $erros3){
    echo $erros3;
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">   
    <link rel="icon" href="../img/logo2.png">
    <link rel="stylesheet" href="../styles/vote.css">
    <title>CinIF</title>
</head>
<body>
    <div class="flex">

    <table class="header">
        <tr>
            <td style="width: 10vh;"><a href="votef.php"><img src="../img/logo2.png" alt="logo" class="logo"></a></td>
            <td class="titl"><p class="titulo">CinIF</p>
            <?php if ($_SESSION["id"] == 1): ?>
                <a href="adm.php"><img src="../img/gear.png" class="gear" alt="adm config"></a>
            <?php endif; ?>
            </td>
                    <table class="align">
                        <tr class="navbg">
                            <td class="bord"><a href="../back/voteg.php"><button class="navops">Gêneros</button>
                                <div class="seta"></div>
                            </td>
                            <td class="bord"><a href="../back/votef.php"><button class="navop">Filmes</button></td>
                            <td class="bord"><a href="../back/catalogo.php"><button class="navop">Catálogo</button></td>
                        </tr>
                    </table>
                </tr>
            </table>
        <div class="balao">
            <p class="balaot">Os filmes presentes na próxima votação serão do gênero no topo da lista!</p>
        </div>





        <div class="descd">
            <img src="../img/inf.png" class="inf">
            <p><?php echo $mens;?></p>
        </div>

        <div class="descm">
            <p><?php echo $mens;?></p>
        </div>



        <?php if ($controle['voteg'] == 1):?>

            <?php
            $sql = "SELECT * FROM genero WHERE numgenero>2 ORDER BY numvotosg DESC;";
            $result = mysqli_query($conexao, $sql);
            $resultnum = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);
            ?>



            <?php if ($resultnum > 1): ?>
                
            <div class="contcard">
                <form method="POST" action="voteg.php" 
                <?php if ( $row['numvotosg'] < 1) {
                    echo 'class="card"';
                }else
                    echo 'class="cardprim"';?>
                >
                    <input type="hidden" name="nomegenero" value="<?php echo $row['nomegenero'];?>">
                    <button type="submit" alt="votar" name="votar" style="background-color: transparent; border: none;">
                        <img src="../img/botaov.png" class="voteb">
                    </button>
                    <p class="numv"><?php echo $row['numvotosg']; ?></p>
                    <p class="cardt"><?php echo $row['nomegenero'] ?></p>
                </form>
                
                
                <?php while ($row = mysqli_fetch_assoc($result)):?>
                
                    <form method="POST" action="voteg.php" class="card">
                        <input type="hidden" name="nomegenero" value="<?php echo $row['nomegenero'];?>">
                        <button type="submit" alt="votar" name="votar" style="background-color: transparent; border: none;">
                            <img src="../img/botaov.png" class="voteb">
                        </button>
                        <p class="numv"><?php echo $row['numvotosg']; ?></p>
                        <p class="cardt"><?php echo $row['nomegenero'] ?></p>

                    </form>

                <?php endwhile; ?>
            </div>
                
            <?php else:?>

                <div class="nof">
                    <img src="../img/inf.png" class="noimg" alt="">
                    <p>A votação de gêneros só acontece quando há certa diversidade de filmes no cadastrados, vá na aba "Catálogo" para adicionar os filmes de sua preferência.</p>
                </div>
                
            <?php endif;?>
        <?php else:?>

            <div class="nof">
                <img src="../img/inf.png" class="noimg" alt="">
                <p>A votação ainda não começou.</p>
            </div>

        <?php endif;?>
            

    </div>
    
    <form method='POST' class='sair'>
        <input type="submit" name="logout" value="Sair">
        <img src="../img/logout.png" alt="">
    </form>
</body> 
</html>