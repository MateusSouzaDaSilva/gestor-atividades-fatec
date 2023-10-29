<?php

require_once('database.php');

// $codigo = trim($_GET['id']);

// // Dados mockados
// // $codigo = "14";

// if ($codigo == "") {
//     echo "Código não encontrado!";
//     return;
// }

// //Incluindo o arquivo de conexão no banco de dados
// require_once("database.php");

// //Definindo a query
// $SQL = "DELETE FROM atividades " .
// " WHERE id = :id ";

// $statement = $conexao->prepare($SQL);
// $statement->bindParam(':id', $codigo);
// if ($statement->execute()){
//     echo "Registro removido com sucesso";
// }
// else{
//     echo "Falha ao remover o registro";
// }

// Verifica se a solicitação foi feita por método POST e se o ID da atividade foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['atividade_id'])) {
    $atividade_id = $_POST['atividade_id'];

    // Prepara e executa a query para deletar a atividade do banco de dados
    $sql = "DELETE FROM atividades WHERE id = :atividade_id";
    $statement = $conexao->prepare($sql);

    try {
        $statement->execute(['atividade_id' => $atividade_id]);
        echo "Atividade deletada com sucesso";
    } catch (PDOException $e) {
        echo "Erro ao deletar a atividade: " . $e->getMessage();
    }
} else {
    echo "Requisição inválida";
}

//Fechando a conexão com o banco de dados
unset($conexao);

?>