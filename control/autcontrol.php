<?php 

session_start();


require 'conexao.php';
require_once 'emailcontrol.php';

$erros = array();
$user = '';
$email = '';

// CADASTRO

if (isset($_POST['cadb'])){
    $user = $_POST['user'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confpassword = $_POST['confpassword'];


    // verificação
    if (empty($user)){
        $erros['user'] = 'Eita, parece que você esqueceu de colocar seu nome de usuário';
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $erros['email'] = 'Esse email aí não tem precedência nenhuma';
    }

    if (empty($email)){
        $erros['email'] = 'Puts, parece que você deixou passar o campo de email';
    }

      if (empty($password)){
        $erros['password'] = 'Não esquece da senha';
    }

    if ($password !== $confpassword){
        $erros['confpassword'] = 'As senhas estão diferentes';
    }

    $emailQuerry = 'SELECT * FROM users WHERE email=? LIMIT 1';
    $stmt = $conexao->prepare($emailQuerry);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $userCont = $result->num_rows;
    $stmt->close();

    if ($userCont > 0) {
        $erros['email'] = 'Opa! Esse email já está cadastrado, clica no botão de login aí em cima se quiser entrar com ele';
    }

    if (count($erros) === 0) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $token = bin2hex(random_bytes(50));
        $verif = false;
        $sql = 'INSERT INTO users (user, email, verif, token, password) VALUES (?, ?, ?, ?, ?)';
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param('ssbss', $user, $email, $verif, $token, $password);
        
        if ($stmt->execute()){
            // loguei amem
            $user_id = $conexao->$insert_id;
            $_SESSION['id'] = $user_id;
            $_SESSION['user'] = $user;
            $_SESSION['email'] = $email;
            $_SESSION['verif'] = $verif;

            verificar_email($email, $token);

            $_SESSION['msg'] = 'Opa, iae! Bem vindo, antes de qualquer coisa, dê uma checada no seu email e volte aqui depois';
            header('location: votef.php');
            exit();
        } else {
            $erros['db_error'] = 'molhou tudo ai no bd';
        }

    }
    
}

//LOGIN

if (isset($_POST['loginb'])) {
    $user = $_POST['user'];
    $password = $_POST['password'];

    //validação
    if (empty($user)){
        $erros['user'] = 'Eita, parece que você esqueceu de colocar seu nome de usuário';
    }
    if (empty($password)){
        $erros['password'] = 'Não esquece da senha';
    }

    if (count($erros) === 0) {
        $sql = "SELECT * FROM users WHERE email=? OR user=? LIMIT 1";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param('ss', $user, $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();
    
        if (password_verify($password, $usuario['password'])) {
            //loguei é nos
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['user'] = $usuario['user'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['verif'] = $usuario['verif'];
    
            $_SESSION['msg'] = 'Opa, iae! Bem vindo, antes de qualquer coisa, dê uma checada no seu email e volte aqui depois';
            header('location: votef.php');
            exit();
        }else{
            $erros['errologin'] = 'tem alguma coisa errada aí';
       }        
    }

    
}


function verifUser($token){

    global $conexao;
    $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
    $result = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);
        $update_querry = "UPDATE users SET verif=1 WHERE token='$token'";
        
        if (mysqli_query($conexao, $update_querry)) {
            // o pai logou
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['user'] = $usuario['user'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['verif'] = 1;
    
            $_SESSION['msg'] = 'Verificado!';
            header('location: votef.php');
            exit();
        }
    }else{
        echo 'Usuário não encontrado.';
    }
}