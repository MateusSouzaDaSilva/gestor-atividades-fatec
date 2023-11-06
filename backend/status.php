<?php
// Criar a conexão com o banco de dados usando PDO
require_once('database.php'); // Certifique-se de que seu arquivo 'database.php' contém a conexão PDO

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idAtividade']) && isset($_POST['novoStatus'])) {
    $novoStatus = $_POST['novoStatus'];
    $idAtividade = $_POST['idAtividade'];

    try {
        // Consulta SQL para atualizar o status na tabela 'atividades'
        $query = "UPDATE atividades SET status = :novoStatus WHERE id = :id";

        // Preparar a declaração
        $statement = $conexao->prepare($query);

        // Substituir parâmetros e executar a atualização
        $statement->bindParam(':novoStatus', $novoStatus);
        $statement->bindParam(':id', $idAtividade);
        $statement->execute();

        // Resposta de sucesso
        echo "Status alterado com sucesso!";
    } catch(PDOException $e) {
        // Em caso de erro, capturamos a exceção e exibimos uma mensagem de erro
        echo "Erro ao alterar o status: " . $e->getMessage();
    }
} else {
    // Se os dados esperados não forem recebidos, exiba uma mensagem de erro
    echo "Erro: Dados ausentes ou requisição inválida.";
}

// Fechar a conexão
unset($conexao);
?>
