<?php
session_start(); // Start session

require 'database.php';// Assuming 'conexao.php' sets up the PDO connection

// Check if HTTP Basic Authentication is used
if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
    $email = $_SERVER['PHP_AUTH_USER'];
    $senha = $_SERVER['PHP_AUTH_PW'];

    $sql = "SELECT * FROM usuario WHERE login = :login AND senha = :senha";
    $statement = $conexao->prepare($sql);
    $statement->bindParam(':login', $email);
    $statement->bindParam(':senha', $senha);
    $statement->execute();

    $conexao = $statement->fetch(PDO::FETCH_ASSOC);

    if ($conexao) {
        $_SESSION['id'] = $conexao['id'];
        $_SESSION['nome'] = $conexao['nome'];
        header("Location: /index.html");
        exit;
    }
}

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM usuario WHERE login = :login AND senha = :senha";
        $statement = $conexao->prepare($sql);
        $statement->bindParam(':login', $email);
        $statement->bindParam(':senha', $senha);
        $statement->execute();

        $conexao = $statement->fetch(PDO::FETCH_ASSOC);

        if ($conexao) {
            $_SESSION['id'] = $conexao['id'];
            $_SESSION['nome'] = $conexao['nome'];
            header("Location: /index.html");
            exit;
        } else {
            echo 'Falha ao logar! E-mail ou senha incorretos';
        }
    }
}
?>
