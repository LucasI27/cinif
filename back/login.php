<?php require_once '../control/autcontrol.php';

if (isset($_SESSION['id'])) {
    header('location: votef.php');
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
    <title>Login</title>
</head>
<body>
    <div class="flex">

        <div class="header">
            <a href="votef.php"><img src="../img/logo2.png" alt="logo" class="logo"></a>
            <p class="titulo">CinIF</p>
            <div>
                <a href="regis.php"><button class="loginb">Registre</button></a>
            </div>
        </div>
        <div class="side">
            <?php if (count($erros) > 0): ?>
                <div class="erro">
                    <?php foreach($erros as $erros): ?>
                        <li class="errot"><?php echo $erros; ?></li>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="seta"></div>
                <div class="balao">
                    <p class="balaot">Ainda não tem uma conta? Registre-se aqui!</p>
                </div>
            <?php endif; ?>
            

            <div class="descd">
                <img src="../img/inf.png" class="inf">
                <p>Assim como o CinIF é um evento que ocorre exclusivamente para os alunos internos, este site é feito exclusivamente para ajuda-los</p>
            </div>

            <div class="descm">
                <p>Assim como o CinIF é um evento que ocorre exclusivamente para os alunos internos, este site é feito exclusivamente para ajuda-los</p>
            </div>
        </div>

    <div class="i">
        <form action="login.php" method="post" class="form">
            <h2 class="tituloform">Login</h3>
            <div>
                <label class="label" for="user">Nome de usuário ou email</label>
                <br>
                <input type="text" name="user" value="<?php echo $user; ?>" class="campo">
            </div>
            
            <div>
                <label class="label" for="password">Senha</label>
                <br>            
                <input type="password" name="password" class="campo">
            </div>
            
            <div class="envb">
                <button name="loginb"  type="submit">Enviar</button>
            </div>
        </form>
    </div>
</body>
</html>