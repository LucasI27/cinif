<?php
require '../control/conexao.php';
require_once '../control/autcontrol.php';
require_once '../control/votecontrol.php';

$sql = "SELECT * FROM controle";
$result = mysqli_query($conexao, $sql);
$controle = mysqli_fetch_assoc($result);
$mens = $controle['mens'];


if ($_SESSION['verif'] == 0) {
    header('location: emailverif.php');
}


if (!isset($_SESSION['id'])) {
    header('location: login.php');
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">   
    <link rel="icon" href="../img/logo2.png">
    <link rel="stylesheet" href="../styles/catalogo.css">
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
                        <td><a href="../back/voteg.php"><button class="navop">Gêneros</button></td>
                        <td><a href="../back/votef.php"><button class="navop">Filmes</button></td>
                        <td><a href="../back/catalogo.php"><button class="navops">Catálogo</button>
                            <div class="seta"></div>
                        </td>
                    </tr>
                </table>
            </tr>
        </table>
    <div class="balao">
        <p class="balaot">Aqui você pode conferir todos os filmes disponíveis no nosso catálogo, você pode adicionar seus preferidos!</p>
    </div>




        <div class="descd">
            <a href="add.php"><button class="envb">Adicionar filme</button></a>
        </div>

        <div class="descm">
            <a href="add.php"><button class="envb">Adicionar filme</button></a>
        </div>


        <?php if ($controle['voteg'] == 1): ?>

            <?php
                $sql = "SELECT * FROM catal WHERE valid=1 AND exib=0 ORDER BY titulo;";
                $result = mysqli_query($conexao, $sql);
                if (!$conexao->query($sql)) {
                    echo $erros2['bd'] = mysqli_error($conexao);
                } 
                $resultnum = mysqli_num_rows($result);
                $row = mysqli_fetch_assoc($result);
            ?>



            <?php if ($resultnum > 1): ?>
                
                <div class="contcard">
                    
                    <?php while ($row = mysqli_fetch_assoc($result)):?>
                    
                        <form method="POST" action="votef.php" class="card card-1">
                            <table class="bord">
                                <tr>
                                    <td class="flx">
                                        
                                        <p class="cardt"><?php echo $row['titulo'] ?></p>
                                        
                                        <div class="votos">
                                            
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="button" class="collapsible">
                                            <img src="uploads/<?php echo $row['img'];?>" alt="capa" class="crop">
                                        </button>
                                        <div class="content">
                                            <p>
                                                <span class="titsin">
                                                    Gênero:
                                                </span>
                                                <?php echo $row['genero'];?>
                                                <br>
                                                <span class="titsin">
                                                    Sinopse: 
                                                </span>
                                                <?php echo $row['sinopse'];?>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>

                    <?php endwhile; ?>
                </div>
                
            <?php else:?>

                <div class="nof">
                    <img src="../img/inf.png" class="noimg" alt="">
                    <p>Não há filmes o suficiente no catálogo para acontecer uma votação, vá na aba "Catálogo" para adicionar os filmes de sua preferência.</p>
                </div>

            <?php endif;?>
        <?php else:?>

            <div class="nof">
                <img src="../img/inf.png" class="noimg" alt="">
                <p>A votação ainda não começou.</p>
            </div>

        <?php endif;?>

 
            

    </div>

    <form method='POST' action="votef.php" class='sair'>
        <input type="submit" name="logout" value="Sair">
        <img src="../img/logout.png" alt="">
    </form>


</body>
<script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.maxHeight){
        content.style.maxHeight = null;
        } else {
        content.style.maxHeight = content.scrollHeight + "px";
        } 
    });
    }
</script>
</html>