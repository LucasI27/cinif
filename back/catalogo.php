<?php
require_once '../control/conexao.php';
require_once '../control/autcontrol.php';
require_once '../control/votecontrol.php';
require_once '../control/admcontrol.php';

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

    <div class="header">
            <a href="votef.php">
                <img src="../img/logo2.png" alt="logo" class="logo">
            </a>
            <div class="titl"><p class="titulo">CinIF</p>
                <?php if ($_SESSION["id"] == 1): ?>
                    <a href="adm.php"><img src="../img/gear.png" class="gear" alt="adm config"></a>
                <?php endif; ?>
            </div>
    </div>

    <div class="side">

        <table class="align">
            <tr class="navbg">
                
                <td><a href="../back/voteg.php"><button class="navop">Gêneros</button></td>
                
                <td><a href="../back/votef.php"><button class="navop">Filmes</button></td>
                
                <td>
                    <a href="../back/catalogo.php">
                        <button class="navops">Catálogo
                            <div class="seta"></div>
                        </button>
                    </a>
                </td>
            </tr>
        </table>

        <div class="balao">
            <p class="balaot">Bem vindo ao catálogo, aqui você pode conferir todos os filmes, clique no botão abaixo para adicionar os que você quiser</p>
        </div>




        <div class="descd">
            <a href="add.php"><button class="envb" style="width: 90%;">+ Adicionar filme</button></a>
        </div>

        <div class="descm">
            <a href="add.php"><button class="envb" style="width: 98%;">+ Adicionar filme</button></a>
        </div>

    </div>



            <?php
                $sql = "SELECT * FROM catal WHERE valid=1 AND exib=0 ORDER BY id ;";
                $result = mysqli_query($conexao, $sql);
                $resultnum = mysqli_num_rows($result);
                $row = mysqli_fetch_assoc($result);
            ?>



            <?php if ($resultnum >= 1): ?>
                
                
                <?php while ($row = mysqli_fetch_assoc($result)):?>
                    
                    <div class="contcard">
                        <form method="POST" action="catalogo.php" class="card">
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
                                            <?php if ($_SESSION['id'] == 1):?>
                                                <button type="submit" alt="votar" name="apagar" class="apagar">
                                                    Apagar filme
                                                </button>
                                            <?php endif;?>
                                        </div>
                                        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                                    </td>
                                </tr>
                            </table>
                        </form>

                    </div>
                    <?php endwhile; ?>
                
            <?php else:?>

                <div class="nof">
                    <img src="../img/inf.png" class="noimg" alt="">
                    <p>Não há filmes no Catálogo, clique no botão ao lado para adicionar os de sua preferencia</p>
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