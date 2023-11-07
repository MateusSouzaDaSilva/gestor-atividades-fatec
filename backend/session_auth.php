<?php
session_start(); // Start session

require 'database.php'; // Assuming 'conexao.php' sets up the PDO connection

// Check if HTTP Basic Authentication is used
if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
    $email = $_SERVER['PHP_AUTH_USER'];
    $senha = $_SERVER['PHP_AUTH_PW'];

    $query = "SELECT * FROM usuario WHERE login = :login";
    $statement = $conexao->prepare($query);
    $statement->bindParam(':login', $email);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verifica se a senha está hashada
        if (password_verify($senha, $user['senha'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['nome'] = $user['nome'];
            header("Location: /index.html");
            exit;
        }
    }
}

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $query = "SELECT * FROM usuario WHERE login = :login";
        $statement = $conexao->prepare($query);
        $statement->bindParam(':login', $email);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verifica se a senha está hashada
            if (password_verify($senha, $user['senha'])) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['nome'] = $user['nome'];
                header("Location: /index.html");
                exit;
            } else {
                echo 'Falha ao logar! E-mail ou senha incorretos';
            }
        } else {
            echo 'Falha ao logar! E-mail ou senha incorretos';
        }
    }
}
?>
