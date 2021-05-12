<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">   
    <link rel="icon" href="img/logo2.png">
    <link rel="stylesheet" href="../styles/regis.css">
    <title>Login</title>
</head>
<body>
    <div class="flex">

        <table class="header">
            <tr>
                <td class="bord"><img src="../img/logo2.png" alt="logo" class="logo"></td>
                <td><p class="titulo">CinIF</p></td>
                <td class="bord"><a href="regis.php"><button class="loginb">Registre</button></a></td>
            </tr>
        </table>
        <div class="seta"></div>
        <div class="balao">
            <p class="balaot">Ainda não tem uma conta? Faça seu cadastro aqui!</p>
        </div>
    </div>
        <form action="login.php" method="post" class="form">
            <h2 class="tituloform">Login</h3>
            <div>
                <label class="label" for="user">Nome de usuário ou email</label>
                <br>
                <input type="text" name="user" class="campo">
            </div>

            <div>
                <label class="label" for="password">Senha</label>
                <br>            
                <input type="password" name="password" class="campo">
            </div>
      
            <div>
            <button type="submit">Enviar</button>
            </div>
        </form>
</body>
</html>