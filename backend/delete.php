<?php
// Verifica se a requisição é do tipo POST e se existe um parâmetro 'id'
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // Parâmetro vindo da requisição AJAX
    $tarefaId = $_POST['id'];


    // Tente realizar a exclusão
    try {
        // Conexão com o banco de dados usando PDO
        require_once('database.php');

        // Prepara a consulta SQL para excluir a tarefa (substitua 'sua_tabela' pelo nome da tabela)
        $query = "DELETE FROM atividades WHERE id = :id";

        // Prepara e executa a declaração
        $statement = $conexao->prepare($query);
        $statement->bindParam(':id', $tarefaId, PDO::PARAM_INT);
        $statement->execute();

        // Verifica se a exclusão foi bem-sucedida
        if ($statement->rowCount() > 0) {
            // Se ao menos uma linha foi afetada, a exclusão foi realizada com sucesso
            echo "Tarefa excluída com sucesso";
        } else {
            // Caso contrário, a tarefa com o ID especificado não foi encontrada
            echo "Nenhuma tarefa encontrada com o ID especificado";
        }
    } catch (PDOException $e) {
        // Em caso de erro, captura a exceção e exibe a mensagem de erro
        echo "Erro ao excluir a tarefa: " . $e->getMessage();
    }
} else {
    // Responde caso o ID não seja fornecido na requisição ou a requisição seja inválida
    echo "ID da tarefa não fornecido ou requisição inválida";
}

unset($conexao);
?>
