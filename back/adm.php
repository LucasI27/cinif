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
            <?php 
                $form ='';
                while ($row = mysqli_fetch_assoc($result)){
                $form .= '<form action="adm.php" method="POST"  class="form" enctype="multipart/form-data">
                    
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



                        <option value="romance"';
                        
                        if ($row["genero"] === "romance"){
                        $form .= "selected";
                        }
                        $form .= '>romance</option>';



                        $form .= '<option value="suspense" ';
                        if ($row["genero"] === "suspense"){
                            $form .= "selected";
                        }
                        $form .= '>suspense</option>';



                        $form .= '<option value="terror" ';
                        if ($row["genero"] === "terror"){
                            $form .= "selected";
                        }
                        $form .= '>terror</option>';



                        $form .= '<option value="drama" ';
                        if ($row["genero"] === "drama"){
                            $form .= "selected";
                        }
                        $form .= '>drama</option>';



                        $form .= '<option value="comédia"';
                        if ($row["genero"] === "comédia"){
                            $form .= "selected";
                        }
                        $form .= '>comédia</option>';



                        $form .= '<option value="musical"';
                        if ($row["genero"] === "musical"){
                            $form .= "selected";
                        }
                        $form .= '>musical</option>';



                        $form .= '<option value="animaçao" ';
                        if ($row["genero"] === "animaçao"){
                            $form .= "selected";
                        }
                        $form .= '>animação</option>';



                        $form .= '<option value="ficcao" ';
                        if ($row["genero"] === "ficcao"){
                            $form .= "selected";
                        }
                        $form .= '>ficção</option>';



                        $form .= '<option value="documentario" ';
                        if ($row["genero"] === "documentario"){
                            $form .= "selected";
                        }
                        $form .= '>documentário</option>';



                        $form .= '<option value="acao" ';
                        if ($row["genero"] === "acao"){
                            $form .= "selected";
                        }
                        $form .= '>ação</option>



                        </select>
                    </div>
                    
                    <div>
                        <label class="label" for="sinopse">Sinopse(opcional)</label>
                        <br>            
                        <textarea name="sinopse" class="campo" cols="30" rows="5">'. $row["sinopse"] .'</textarea>
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
                
        }
            
        echo $form;
            ?> 
        <?php else: ?>
            <p>Nenhum filme foi sugerido recentemente</p>
        <?php endif; 
        ?>




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