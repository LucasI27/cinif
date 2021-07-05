<?php require_once '../control/admcontrol.php'; ?> 
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
                <td class="bord"><img src="../img/logo2.png" alt="logo" class="logo"></td>
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
            <p class="balaot">Adicione um filme ao nosso catálogo, ele pode aparecer futuramente nas votações</p>
            </div>
        <?php endif; ?>


        <?php 
        $sql = 'SELECT * FROM catal WHERE valid=0;';
        $result = mysqli_query($conexao, $sql);
        $resultnum = mysqli_num_rows($result);
        ?>
        
        <?php if ($resultnum > 0): ?>
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
                        
                        
                        
                        <option value="romance"
                        <?php if ($row["genero"] === "romance"){
                            echo "selected";
                        } ?>
                        >Romance</option>



                        <option value="suspense" 
                        <?php if ($row["genero"] === "suspense"){
                            echo "selected";
                        } ?>
                        >Suspense</option>



                        <option value="terror" 
                        <?php if ($row["genero"] === "terror"){
                            echo "selected";
                        } ?>
                        >Terror</option>



                        <option value="drama" 
                        <?php if ($row["genero"] === "drama"){
                            echo "selected";
                        } ?>
                        >Drama</option>



                        <option value="comédia"
                        <?php if ($row["genero"] === "comédia"){
                            echo "selected";
                        } ?>
                        >Comédia</option>



                        <option value="musical"
                        <?php if ($row["genero"] === "musical"){
                            echo "selected";
                        } ?>
                        >Musical</option>



                        <option value="animaçao" 
                        <?php if ($row["genero"] === "animaçao"){
                            echo "selected";
                        } ?>
                        >Animação</option>



                        <option value="ficcao" 
                        <?php if ($row["genero"] === "ficcao"){
                            echo "selected";
                        } ?>
                        >Ficção</option>



                        <option value="documentario" 
                        <?php if ($row["genero"] === "documentario"){
                            echo "selected";
                        } ?>
                        >Documentário</option>



                        <option value="acao" 
                        <?php if ($row["genero"] === "acao"){
                            echo "selected";
                        } ?>
                        >ação</option>
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
            <div class="nof">
                <img src="../img/inf.png" class="noimg" alt="">
                <p>Nenhum filme foi sugerido recentemente</p>
            </div>
        <?php endif; 
        ?>




    </div>
</body>
</html>
 