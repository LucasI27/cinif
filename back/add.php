<?php
 require_once '../control/addcontrol.php';
?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">   
    <link rel="icon" href="../img/logo2.png">
    <link rel="stylesheet" href="../styles/regis.css">
    <title>Adicionar</title>
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



        <form action="add.php" method="post" enctype="multipart/form-data" class="form">
            <h2 class="tituloform">Adicione um filme no catálogo</h3>
            <div>
                <label class="label" for="titulo">Título</label>
                <br>
                <input type="text" name="titulo" class="campo">
            </div>
            
            <div>
                <label class="label" for="genero" class="select">Gênero</label>
                <br>
                <select name="genero">
                <option value="romance" class="select">romance</option>
                <option value="suspense">suspense</option>
                <option value="terror">terror</option>
                <option value="drama">drama</option>
                <option value="comédia">comédia</option>
                <option value="musical">musical</option>
                <option value="animaçao">animação</option>
                <option value="ficcao">ficção</option>
                <option value="documentario">documentário</option>
                <option value="acao">ação</option>

                </select>
            </div>
            
            <div>
                <label class="label" for="sinopse">Sinopse(opcional)</label>
                <br>            
                <textarea name="sinopse" class="campo" cols="30" rows="5"></textarea>
            </div>
            

            <div>
                <button type="submit" name="tempb" class="envb">Enviar</button>
            </div>
        </form> 
    </div>
</body>
</html>
