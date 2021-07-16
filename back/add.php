<?php
 require_once '../control/addcontrol.php';
 require_once '../control/autcontrol.php';

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
    <link rel="stylesheet" href="../styles/regis.css">
    <script src="slct.js"></script>
    <title>Adicionar</title>
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
            </tr>
        </table>
        <?php if (count($erros2) > 0 AND !isset($erros2['sucesso'])): ?>
            <div class="erro">
                <?php foreach($erros2 as $erros2): ?>
                    <li class="errot"><?php echo $erros2; ?></li>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <?php if (isset($erros2['sucesso'])): ?>
                <div class="balao">
                    <p class="balaot"><?php echo $erros2['sucesso']?></p>
                </div>
            <?php else: ?>    
            <div class="balao">
                <p class="balaot">Adicione um filme ao nosso catálogo, ele pode aparecer futuramente nas votações</p>
            </div>
            <?php endif; ?>
        <?php endif; ?>
        

        

        <div class="descd">
            <img src="../img/inf.png" class="inf">
            <p>Os filmes adicionados passam por uma validação e análise humana antes de serem adicionadas ao catálogo</p>
        </div>

        <div class="descm">
            <p>Os filmes adicionados passam por uma validação e análise humana antes de serem adicionadas ao catálogo</p>
        </div>



        <div class="i">
        <form action="add.php" method="post" enctype="multipart/form-data" class="form">
            <h2 class="tituloform">Adicione um filme no catálogo</h3>
            <div>
                <label class="label" for="titulo">Título</label>
                <br>
                <input type="text" name="titulo" class="campo">
            </div>
            <br>
            <div class="container">
                <label class="label" for="genero" class="dropdown-select">Gênero</label>
                <br>
                <select name="genero" class="dropdown-select" >
                <option value="NULL" selected>Selecione um genero</option>
                <option value="Romance" class="select">Romance</option>
                <option value="Suspense">Suspense</option>
                <option value="Terror">Terror</option>
                <option value="Drama">Drama</option>
                <option value="Comédia">Comédia</option>
                <option value="Musical">Musical</option>
                <option value="Animação">Animação</option>
                <option value="Ficção">Ficção</option>
                <option value="Documentário">Documentário</option>
                <option value="Ação">Ação</option>
                </select>
            </div>
            
            <br>

            <div>
                <label class="label" for="sinopse">Sinopse(opcional)</label>
                <br>            
                <textarea name="sinopse" class="campo" cols="30" rows="5" style="resize: none;"></textarea>
            </div>
            

            <div>
                <button type="submit" name="tempb" class="envb">Enviar</button>
            </div>
        </form> 
        </div>
    </div>
    <form method='POST' action="votef.php" class='sair'>
        <input type="submit" name="logout" value="Sair">
        <img src="../img/logout.png" alt="">
    </form>
</body>
</html>