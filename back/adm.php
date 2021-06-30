<?php require_once '../control/addcontrol.php'; ?> 
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
        <?php if (count($erros2) > 0): ?>
            <div class="erro">
                <?php foreach($erros2 as $erros2): ?>
                    <li class="errot"><?php echo $erros2; ?></li>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="balao">
                  <?php if (isset($sucesso)) ?>
                  <p class="balaot"><?php echo $sucesso; ?></p>
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
                <?php echo '<form action="adm.php" method="post"  class="form" enctype="multipart/form-data">
                    
                    <h2 class="tituloform">Valide o filme</h2>
                    <div>
                        <label class="label" for="titulo">Título</label>
                        <br>
                        <input type="text" name="titulo" class="campo" value="'. $row["titulo"]. '">
                    </div>
                    
                    <?php 
                    $_POST["id"] = $row["id"];
                    echo $_POST["id"];
                    ?>

                    <div>
                        <label class="label" for="genero" class="select">Gênero</label>
                        <br>
                        <select name="genero">



                        <option value="romance"
                        <?php if ($row["genero"] === "romance"){
                            echo "selected";
                        }?>>romance</option>



                        <option value="suspense" 
                        <?php if ($row["genero"] === "suspense"){
                            echo "selected";
                        }?>>suspense</option>



                        <option value="terror" 
                        <?php if ($row["genero"] === "terror"){
                            echo "selected";
                        }?>>terror</option>



                        <option value="drama" 
                        <?php if ($row["genero"] === "drama"){
                            echo "selected";
                        }?>>drama</option>



                        <option value="comédia"
                        <?php if ($row["genero"] === "comédia"){
                            echo "selected";
                        }?>>comédia</option>



                        <option value="musical"
                        <?php if ($row["genero"] === "musical"){
                            echo "selected";
                        }?>>musical</option>



                        <option value="animaçao" 
                        <?php if ($row["genero"] === "animaçao"){
                            echo "selected";
                        }?>>animação</option>



                        <option value="ficcao" 
                        <?php if ($row["genero"] === "ficcao"){
                            echo "selected";
                        }?>>ficção</option>



                        <option value="documentario" 
                        <?php if ($row["genero"] === "documentario"){
                            echo "selected";
                        }?>>documentário</option>



                        <option value="acao" 
                        <?php if ($row["genero"] === "acao"){
                            echo "selected";
                        }?>>ação</option>



                        </select>
                    </div>
                    
                    <div>
                        <label class="label" for="sinopse">Sinopse(opcional)</label>
                        <br>            
                        <textarea name="sinopse" class="campo" cols="30" rows="5"><?php echo $row["sinopse"]?></textarea>
                    </div>
                    
                    
 
                    <div>
                        <input type="file" name="img" id="image" accept="image/*" onchange="document.getElementById("blah").src = window.URL.createObjectURL(this.files[0])" />
                    </div>
                    <div>
                        <img id="blah" width="100" height="auto" />
                    </div>

                    <div>
                        <button type="submit" name="catalogo" class="envb">Validar</button>
                    </div>

                </form> ';
                ?>
            <?php endwhile ?>    
        <?php else: ?>
            <p>Nenhum filme foi sugerido recentemente</p>
        <?php endif; ?>




    </div>
</body>
</html>
<script>  
 $(document).ready(function(){  
      $('#insert').click(function(){  
           var image_name = $('#image').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script>  