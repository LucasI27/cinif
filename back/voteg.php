<?php
require_once '../control/conexao.php';
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
                <td class="bord"><img src="../img/logo2.png" alt="logo" class="logo"></td>
                <td><p class="titulo">CinIF - Votação</p></td>
                <td class="navbg">
                    <table>
                    <tr>
                    <td class="bord"><a href="../back/voteg.php"><button class="navops">Gêneros</button>
                    <div class="seta"></div>
                    </td>
                    <td class="bord"><a href="../back/votef.php"><button class="navop">Filmes</button></td>
                    <td class="bord"><a href="../back/catalogo.php"><button class="navop">Catálogo</button></td>
                    </tr>
                    </table>

                </td>
            </tr>
        </table>
        <div class="balao">
            <p class="balaot">Os filmes presentes na próxima votação serão do gênero no topo da lista!</p>
        </div>

        <?php
        $sql = "SELECT * FROM genero WHERE numerogenero>0 ORDER BY numerovotosg DESC;";
        $result1 = mysqli_query($conexao, $sql);
        $resultnum = mysqli_num_rows($result1);
        $row = mysqli_fetch_assoc($result1)
        ?>



        <?php if ($resultnum > 0): ?>
        <div class="contcard">
            
            <form method="POST" action="voteg.php" class="cardprim">
                <img src="../img/botaov.png" class="voteb" alt="votar">
                <p class="numv"><?php echo $row['numerovotog']; ?></p>
                <p class="cardt"><?php echo $row['nomegenro']; ?></p>
            </form>
            
            
            <?php while ($row = mysqli_fetch_assoc($result1)):?>
            
                <form method="POST" action="voteg.php" class="card">
                    <img src="../img/botaov.png" class="voteb" alt="votar">
                    <p class="numv"><?php echo $i; ?></p>
                    <p class="cardt">texto aaaaaaaaa</p>
                </form>
            <?php endwhile; ?>
        <?php else:?>
            <div class="nof">
                <img src="../img/inf.png" class="noimg" alt="">
                <p>Nenhum filme foi sugerido recentemente</p>
            </div>
        <?php endif;?>
         </div>






    </div>
</body>
</html>