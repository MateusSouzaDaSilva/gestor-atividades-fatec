<?php
// Verifique se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    require_once('database.php');

    // Receba os dados enviados via POST do formulário de atualização
    $novoTitulo = $_POST['atualizarTitulo'];
    $novaDescricao = $_POST['atualizarDescricao'];
    $novaConclusao = $_POST['atualizarConclusao'];
    $atividadeId = $_POST['atividadeId']; // Supondo que você tenha o ID da atividade a ser atualizada
    $status = $_POST['status'];

    // Atualize a atividade no banco de dados
    $statement = $conexao->prepare("UPDATE atividades SET titulo = ?, descricao = ?, data_conclusao = ?, status = ? WHERE id = ?");
    $statement->execute([$novoTitulo, $novaDescricao, $novaConclusao, $status, $atividadeId]);

    // Verifique se a atualização foi bem-sucedida
    if ($statement) {
        echo 'Atividade atualizada com sucesso!';
    } else {
        echo 'Erro ao atualizar a atividade.';
    }
}
?>
