<?php require_once '../control/autcontrol.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">   
    <link rel="icon" href="../img/logo2.png">
    <link rel="stylesheet" href="../styles/regis.css">
    <title>Cadastro</title>
</head>
<body>
    <div class="flex">

        <table class="header">
            <tr>
                <td class="bord"><img src="../img/logo2.png" alt="logo" class="logo"></td>
                <td><p class="titulo">CinIF</p></td>
                <td class="bord"><a href="login.php"><button class="loginb">Login</button></a></td>
            </tr>
        </table>
        <?php if (count($erros) > 0): ?>
            <div class="erro">
                <?php foreach($erros as $erros): ?>
                    <li class="errot"><?php echo $erros; ?></li>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="seta"></div>
            <div class="balao">
                <p class="balaot">Já tem uma conta? Entre por aqui!</p>
            </div>
        <?php endif; ?>


        <div class="i">

            <form action="regis.php" method="post" class="form">
                <h2 class="tituloform">Cadastro</h3>
                <div>
                    <label class="label" for="user">Nome de usuário</label>
                    <br>
                    <input type="text" name="user" value="<?php echo $user; ?>" class="campo">
                </div>
                
                <div>
                <label class="label" for="email">Email</label>
                <br>
                <input type="email" name="email" class="campo">
            </div>
            
            <div>
                <label class="label" for="password">Senha</label>
                <br>            
                <input type="password" name="password" class="campo">
            </div>
            
            <div>
                <label class="label" for="confpassword">Confirme sua senha</label>
                <br>        
                <input type="password" name="confpassword" class="campo">
            </div>
            
            <div>
                <button type="submit" name="cadb" class="envb">Enviar</button>
            </div>
        </form>
        
    </div>
        
    </div>
</body>
</html>