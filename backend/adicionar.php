<?php
require_once("database.php");

session_start(); // Iniciar a sessão

if ($_SESSION['id']) {
    $user_id = $_SESSION['id'];

    $dadosJSON = json_decode(file_get_contents("php://input"));

    // Verifica se os campos esperados estão definidos no JSON
    if (isset($dadosJSON->titulo) && isset($dadosJSON->descricao) && isset($dadosJSON->data_conclusao)) {
        // Prepara a consulta SQL com parâmetros nomeados
        $statement = $conexao->prepare('INSERT INTO atividades (user_id, titulo, descricao, data_conclusao) VALUES (:user_id, :titulo, :descricao, :data_conclusao)');

        // Associa os valores do objeto JSON aos parâmetros da consulta
        $titulo = $dadosJSON->titulo;
        $descricao = $dadosJSON->descricao;
        $data_conclusao = $dadosJSON->data_conclusao;

        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindParam(':titulo', $titulo, PDO::PARAM_STR);
        $statement->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $statement->bindParam(':data_conclusao', $data_conclusao, PDO::PARAM_STR);

        // Executa a consulta preparada
        if ($statement->execute()) {
            // Inserção bem-sucedida
            echo json_encode(array("mensagem" => "Atividade inserida com sucesso"));
        } else {
            // Tratamento de erro
            echo json_encode(array("erro" => "Falha na inserção da atividade"));
        }
    } else {
        // Campos obrigatórios ausentes
        echo json_encode(array("erro" => "Campos obrigatórios ausentes"));
    }
} else {
    // Se o usuário não estiver logado
    echo json_encode(array("erro" => "Usuário não autenticado"));
}

unset($conexao);
?>
