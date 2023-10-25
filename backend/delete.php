<?php

// Dados mockados
// $codigo = "14";

//Incluindo o arquivo de conexão no banco de dados
try {
require_once("database.php");

// Verifica se o ID a ser excluído foi passado na URL
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



// Verifica se o ID a ser excluído foi passado na URL
if (isset($_GET["excluir"])) {
    // Obtém o ID do registro a ser apagado
    $id_para_apagar = $_GET["excluir"];

    // Define a instrução SQL DELETE
    $sql = "DELETE FROM atividades WHERE id = :id";

    // Prepara a consulta
    $statement = $conexao->prepare($sql);

    // Vincula o parâmetro ID
    $statement->bindParam(':id', $id_para_apagar, PDO::PARAM_INT);

    // Executa a consulta
    $statement->execute();

    echo "Registro apagado com sucesso.";
}
} catch (PDOException $e) {
echo "Erro ao apagar o registro: " . $e->getMessage();
}


//Fechando a conexão com o banco de dados
unset($conexao);
?>

