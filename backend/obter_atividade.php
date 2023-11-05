<?php
// Arquivo: obter_atividade.php

// Verifica se o ID da atividade foi recebido corretamente
if (isset($_GET['id'])) {
    $atividadeId = $_GET['id'];

 
    try {
        require_once('database.php');

        // Consulta para obter os detalhes da atividade
        $query = "SELECT id, titulo, descricao, data_conclusao FROM atividades WHERE id = :atividadeId";
        $statement = $conexao->prepare($query);
        $statement->bindParam(':atividadeId', $atividadeId);
        $statement->execute();

        // Verifica se a consulta retornou resultados
        if ($statement->rowCount() > 0) {
            $detalhesAtividade = $statement->fetch(PDO::FETCH_ASSOC);

            // Converte os detalhes da atividade para formato JSON
            $jsonDetalhesAtividade = json_encode($detalhesAtividade);

            // Define o cabeçalho para indicar que o conteúdo é JSON
            header('Content-Type: application/json');

            // Retorna os detalhes da atividade em formato JSON para a requisição AJAX
            echo $jsonDetalhesAtividade;
        } else {
            // Se nenhuma atividade for encontrada com o ID especificado
            http_response_code(404); // Código de erro 404 - Não encontrado
            echo json_encode(['error' => 'Atividade não encontrada.']);
        }
    } catch (PDOException $e) {
        // Em caso de falha na conexão ou consulta, você pode tratar o erro aqui
        http_response_code(500); // Código de erro 500 - Erro interno do servidor
        echo json_encode(['error' => 'Erro ao buscar detalhes da atividade: ' . $e->getMessage()]);
    }
} else {
    // Se o ID da atividade não foi recebido corretamente, retorna uma resposta de erro
    http_response_code(400); // Código de erro 400 - Solicitação incorreta
    echo json_encode(['error' => 'ID de atividade não recebido corretamente.']);
}
?>
