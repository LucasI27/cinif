<?php 

session_start();

require '../back/conexao.php';

$erros = array();
$user = '';
$email = '';

if (isset($_POST['cadb'])){
    $user = $_POST['user'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confpassword = $_POST['confpassword'];


    // verificação
    if (empty($user)){
        $erros['username'] = 'Nome de usuário necessário';
    }

    if (empty($email)){
        $erros['email'] = 'Email necessário';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $erros['email'] = 'Email invalido';
    }

      if (empty($password)){
        $erros['password'] = 'Senha necessária';
    }

    if ($password !== $confpassword){
        $erros['confpassword'] = 'Senhas diferentes';
    }

    $emailQuerry = 'SELECT * FROM users WHERE email=? LIMIT 1';
    $stmt = $conexao->prepare($emailQuerry);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $userCont = $result->num_rows;
    $stmt->close();

    if ($userCont > 0) {
        $erros['email'] = 'Ei! Esse email já está cadastrado';
    }

    if (count($erros) === 0) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $token = bin2hex(random_bytes(50));
        $verif = false;
        $sql = 'INSERT INTO users (user, email, verif, token, password) VALUES (?, ?, ?, ?, ?)';
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssbss', $user, $email, $verif, $token, $password);
        
        if ($stmt->execute()){
            // loguei amem
            $user_id = $conexao->$insert_id;
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['verif'] = $verif;

            $_SESSION['msg'] = 'Opa, iae! Bem vindo';
            $_SESSION['alert_class'] = 'sucesso esso';
            header('location: home.php');
            exit();
        } else {
                $erros['db_error'] = 'molhou tudo ai no bd';
        }

    }
    
}

