<?php
require_once("database.php");

// Verifica se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $data_nascimento = $_POST['data_nascimento'];
    $login = $_POST['login'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Você deve armazenar a senha de forma segura, aqui usamos a função password_hash()

    // Insere os dados no banco de dados
    $query = "INSERT INTO usuario (nome, sobrenome, data_nascimento, login, senha) VALUES (?, ?, ?, ?, ?)";
    $statement = $conexao->prepare($query);
    $statement->execute([$nome, $sobrenome, $data_nascimento, $login, $senha]);

    // Verifica se o registro foi inserido com sucesso
    if ($statement->rowCount() > 0) {
        echo 'Usuário cadastrado com sucesso!';
        header('Location: /frontend/login.html');
    } else {
        echo 'Houve um problema ao cadastrar o usuário.';
    }
}

unset($conexao);
?>
