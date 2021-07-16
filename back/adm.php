<?php
require_once '../control/autcontrol.php';
 require_once '../control/admcontrol.php';
 require_once '../control/conexao.php';
 $sql = "SELECT voteg FROM controle;";
 $result = mysqli_query($conexao, $sql);
 $row = mysqli_fetch_assoc($result);  

 
if (!isset($_SESSION['id']) or $_SESSION['id'] !== 1) {
    header('location: login.php');
}

if ($_SESSION['verif'] == 0) {
    header('location: emailverif.php');
}




?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">   
    <link rel="icon" href="../img/logo2.png">
    <link rel="stylesheet" href="../styles/regis.css">
    <title>Administração</title>
</head>
<body>
    <div class="flex">
        <table class="header">
            <tr>
                <td style="width: 10vh;"><a href="votef.php"><img src="../img/logo2.png" alt="logo" class="logo"></a></td>
                <td><p class="titulo">CinIF</p></td>
            </tr>
        </table>
        <?php if (count($erros3) > 0): ?>
            <div class="erro">
                <?php foreach($erros3 as $erros3): ?>
                    <li class="errot"><?php echo $erros3; ?></li>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="balao">
            <p class="balaot">Os filmes ao lado foram sugeridos pelo usuário, valide-os para serem adicionados ao catálogo</p>
            </div>
        <?php endif;?>




        <form class="contcontrol" method="POST" action="adm.php">
            <div class="tside">
                <label class="label" for="sinopse">Data e local</label>
                <textarea name="mens" class="mens" cols="30" rows="8" style="resize: none;" <?php if ($row['voteg'] == 1) {
                    echo 'disabled';
                }?>></textarea>
            </div>
            <div class="bside">
                <button type="submit" name="voteini" class="controlb" <?php if ($row['voteg'] == 1) {
                    echo 'disabled';
                }?>>Iniciar votação</button>
                <button type="submit" name="voteter" class="controlb" <?php if ($row['voteg'] == 0) {
                    echo 'disabled';
                }?>>Terminar votação</button>
            </div>
        </form>




        <?php 
        $sql = 'SELECT * FROM catal WHERE valid=0 ORDER BY RAND();';
        $result = mysqli_query($conexao, $sql);
        $resultnum = mysqli_num_rows($result);
        ?>
        
        <?php if ($resultnum > 0): ?>
        <div class="i">
            <?php while ($row = mysqli_fetch_assoc($result)):?>

            <form action="adm.php" method="POST"  class="form" enctype="multipart/form-data">
                    
                    <h2 class="tituloform">Valide o filme</h2>
                    <div>
                        <label class="label" for="titulo">Título</label>
                        <br>
                        <input type="text" name="titulo" class="titulof" value="<?php echo $row["titulo"]; ?> ">
                        <a target="blank" href="https://www.google.com/search?q=<?php echo $row['titulo']; ?>">
                            <img src="../img/pesq.png" class="pesq">
                        </a>
                    </div>
            

                    <br>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <div>
                        <label class="label" for="genero" class="select">Gênero</label>
                        <br>
                        <select name="genero" class="dropdown-select">
                        
                        
                        
                        <option value="Romance"
                        <?php if ($row["genero"] === "Romance"){
                            echo "selected";
                        } ?>
                        >Romance</option>



                        <option value="Suspense" 
                        <?php if ($row["genero"] === "Suspense"){
                            echo "selected";
                        } ?>
                        >Suspense</option>



                        <option value="Terror" 
                        <?php if ($row["genero"] === "Terror"){
                            echo "selected";
                        } ?>
                        >Terror</option>



                        <option value="Drama" 
                        <?php if ($row["genero"] === "Drama"){
                            echo "selected";
                        } ?>
                        >Drama</option>



                        <option value="Comédia"
                        <?php if ($row["genero"] === "Comédia"){
                            echo "selected";
                        } ?>
                        >Comédia</option>



                        <option value="Musical"
                        <?php if ($row["genero"] === "Musical"){
                            echo "selected";
                        } ?>
                        >Musical</option>



                        <option value="Animação" 
                        <?php if ($row["genero"] === "Animação"){
                            echo "selected";
                        } ?>
                        >Animação</option>



                        <option value="Ficção" 
                        <?php if ($row["genero"] === "Ficção"){
                            echo "selected";
                        } ?>
                        >Ficção</option>



                        <option value="Documentário" 
                        <?php if ($row["genero"] === "Documentário"){
                            echo "selected";
                        } ?>
                        >Documentário</option>



                        <option value="Ação" 
                        <?php if ($row["genero"] === "Ação"){
                            echo "selected";
                        } ?>
                        >Ação</option>
                        </select>
                    </div>
                    

                    <br>


                    <div>
                        <label class="label" for="sinopse">Sinopse(opcional)</label>
                        <br>            
                        <textarea name="sinopse" class="campo" cols="30" rows="5" style="resize: none;"><?php echo $row["sinopse"]; ?></textarea>
                    </div>
                    

                    <br>
                    
 
                    <div>
                        <label for="img" class="label">Imagem</label>
                        <br>
                        <input type="file" name="img" id="image" class="img" />
                    </div>


                    <br>


                    <div>
                        <button type="submit" name="catalogo" class="envb">Validar</button>
                        <button type="submit" name="apagar" class="apagarb" >Apagar</button>
                    </div>

                </form> 
                
                <hr class="linha">

        <?php endwhile; ?>
        <?php else: ?>
        </div>
            <div class="nof">
                <img src="../img/inf.png" class="noimg" alt="">
                <p>Nenhum filme foi sugerido recentemente</p>
            </div>
        <?php endif; 
        ?>




    </div>
</body>
</html>
 