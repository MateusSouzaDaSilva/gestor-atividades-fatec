
<?php
//Incluindo o arquivo de conexão no banco de dados
require_once("database.php");

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    // Se o usuário não estiver logado, redirecione para a página de login ou faça algo apropriado
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['id']; // Obtém o ID do usuário logado

setlocale(LC_TIME, 'pt_BR');

// Definindo a query para selecionar atividades por user_id
$SQL = "SELECT * FROM atividades WHERE user_id = :user_id";

// Prepara a consulta
$query = $conexao->prepare($SQL);
$query->bindParam(':user_id', $user_id);
$query->execute();

//Guarda a busca no array $resultado
$resultado = $query->fetchAll(PDO::FETCH_OBJ);

//Capturando a quantidade de registros
$quantidade = count($resultado);

if ($quantidade == 0) {
    echo "Não há registros a serem exibidos";
    return;
}



//Percorrendo todos os registros em aberto
while ($linha = $resultado->fetch(PDO::FETCH_OBJ)) {
    if ($linha->status === "aberto") {
        echo '<div class="card" id="tarefa_'. $linha->id . '">';
        echo '<div class="card-body">';
        echo  '<div class="header-card d-flex">';
        echo    '<h5 class="card-title">'. $linha->titulo . '</h5>';
        echo    '<h5 class="offset-md-4 ms-auto">Status: ' . $linha->status . '</h5>';
        echo  '</div>';
        echo  '<div class="card-prazo">';
    
        $timestampIni = strtotime($linha->data_criacao);
        $timestampEnd = strtotime($linha->data_conclusao);
    
        $meses = array(
          1 => 'janeiro', 2 => 'fevereiro', 3 => 'março', 4 => 'abril', 5 => 'maio', 6 => 'junho',
          7 => 'julho', 8 => 'agosto', 9 => 'setembro', 10 => 'outubro', 11 => 'novembro', 12 => 'dezembro'
      );
      
        echo    '<h6 class="card-subtitle mb-2 text-body-secondary">Criada em: ' . $date = date("d \d\e ", $timestampIni) . $meses[date("n", $timestampIni)] . date(" \d\e Y \à\s H:i:s", $timestampIni) . '</h6>';
        echo    '<h6 class="card-subtitle mb-2 text-body-secondary">Expira em: ' . $date = date("d \d\e ", $timestampEnd) . $meses[date("n", $timestampEnd)] . date(" \d\e Y \à\s H:i:s", $timestampEnd) . '</h6>';
        echo  '</div>';
        echo  '<p class="card-text">' . $linha->descricao . '</p>';
        echo '<a href="#" class="card-link btn btn-success alterarStatus" id="alterarStatus'. $linha->id .'"><i class="bi bi-check"></i>Marcar como concluído</a>';
        echo  '<button class="card-link btn btn-danger excluir" id="excluir" data-atividade-id="' . $linha->id . '"><i class="bi bi-trash"></i>Excluir</button>';
        echo  '<a href="#" class="card-link btn btn-secondary atualizar" class="bi bi-pencil-square" id="' . $linha->id . '"  data-atividade-id="' . $linha->id . '"></i>Atualizar</a>';
        echo '</div>';
        echo '</div>';
    } else {
        echo 'Sem atividades abertas!';
    }
} 



//Fechando a conexão com o banco de dados
unset($conexao);
?>
