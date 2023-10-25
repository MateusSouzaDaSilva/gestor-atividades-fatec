<?php

    require_once("database.php");

    $user_id = 1;

    $data = [
        'user_id' => $user_id,
        'titulo' => $_POST['nome'],
        'descricao' => $_POST['descricao'],
        'data_conclusao' => $_POST['conclusao'],
    ];

    $statement = $conexao->prepare('INSERT INTO atividades (user_id, titulo, descricao, data_conclusao) VALUES (:user_id, :titulo, :descricao, :data_conclusao)');

    try {
        $conexao->beginTransaction();
        $statement->execute($data);
        $conexao->commit();
        echo 'Registro salvo com sucesso';

        
    } catch (Exception $e) {
        $conexao->rollback();
        throw $e;
    }

    //Incluindo o arquivo de conexão no banco de dados
    

    //Definindo a query
    

    //Fechando a conexão com o banco de dados
    unset($conexao);
    ?>

    