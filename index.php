<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciador de atividades</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

  <!-- Option 1: Include in HTML -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

  <link rel="stylesheet" href="../frontend/css/style.css">
</head>

<body>

  <header
    class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <div class="col-md-3 mb-2 mb-md-0">
      <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
        <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap">
          <use xlink:href="#bootstrap"></use>
        </svg>
      </a>
    </div>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
      <li><a class="nav-link px-2" data-bs-toggle="modal" data-bs-target="#criarAtividadeModal">Adicionar atividade</a>
      </li>
      <li><a class="nav-link px-2" data-bs-toggle="modal" data-bs-target="#creditosModal">Créditos</a></li>
    </ul>

    <div class="col-md-3 text-end">
      <button type="button" class="btn btn-primary">Sair</button>
    </div>
  </header>

  <div class="alert" id="alert" role="alert"></div>

  <div class="lista-atividades-todas d-flex justify-content-center align-items-center">
    <div class="lista-atividades-andamento">
      <p>Em andamento</p>

       <!-- <div class="card">
        <div class="card-body">
          <div class="header-card d-flex">
            <h5 class="card-title">Nome da tarefa</h5>
            <h5 class="offset-md-4 ms-auto">Status: Em aberto</h5>
          </div>
          <div class="card-prazo">
            <h6 class="card-subtitle mb-2 text-body-secondary">Criada em: </h6>
            <h6 class="card-subtitle mb-2 text-body-secondary">Expira em:</h6>
          </div>
          <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum laboriosam assumenda
            incidunt! Ab sunt animi distinctio quis dolore sapiente, nam cumque consectetur et! Tempora autem blanditiis
            ipsum praesentium, ut dolores.</p>
          <a href="#" class="card-link btn btn-success"><i class="bi bi-check"></i>Marcar como concluído</a>
          <a href="#" class="card-link btn btn-danger"><i cla1ss="bi bi-trash"></i>Excluir</a>
          <a href="#" class="card-link btn btn-secondary"><i class="bi bi-pencil-square"></i>Atualizar</a>
        </div>
      </div>  -->

      <?php

      //Incluindo o arquivo de conexão no banco de dados
      require_once("backend/database.php");

      setlocale(LC_TIME, 'pt_BR');

      //Definindo a query
      $SQL = "SELECT * FROM atividades";

      //Guarda a busca no array $resultado
      $resultado = $conexao->query($SQL);

      //Capturando a quantidade de registros
      $quantidade = $resultado->rowCount();

      if ($quantidade == 0) {
        echo "Não há registros a serem exibidos";
        return;
      }



      //Percorrendo todos os registros
      while ($linha = $resultado->fetch(PDO::FETCH_OBJ)) {

        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<div class="header-card d-flex">';
        echo '<h5 class="card-title">' . $linha->titulo . '</h5>';
        echo '<h5 class="offset-md-4 ms-auto">Status: Em aberto</h5>';
        echo '</div>';
        echo '<div class="card-prazo">';

        $timestampIni = strtotime($linha->data_criacao);
        $timestampEnd = strtotime($linha->data_conclusao);

        $meses = array(
          1 => 'janeiro',
          2 => 'fevereiro',
          3 => 'março',
          4 => 'abril',
          5 => 'maio',
          6 => 'junho',
          7 => 'julho',
          8 => 'agosto',
          9 => 'setembro',
          10 => 'outubro',
          11 => 'novembro',
          12 => 'dezembro'
        );

        echo '<h6 class="card-subtitle mb-2 text-body-secondary">Criada em: ' . $date = date("d \d\e ", $timestampIni) . $meses[date("n", $timestampIni)] . date(" \d\e Y \à\s H:i:s", $timestampIni) . '</h6>';
        echo '<h6 class="card-subtitle mb-2 text-body-secondary">Expira em: ' . $date = date("d \d\e ", $timestampEnd) . $meses[date("n", $timestampEnd)] . date(" \d\e Y \à\s H:i:s", $timestampEnd) . '</h6>';
        echo '</div>';
        echo '<p class="card-text">' . $linha->descricao . '</p>';
        echo '<a href="#" class="card-link btn btn-success"><i class="bi bi-check"></i>Marcar como concluído</a>';
        echo '<a href="backend/delete.php" class="card-link btn btn-danger" id="excluir"><i class="bi bi-trash"></i>Excluir</a>';
        echo '<a href="#" class="card-link btn btn-secondary"><i class="bi bi-pencil-square"></i>Atualizar</a>';
        echo '</div>';
        echo '</div>';
      }



      //Fechando a conexão com o banco de dados
      // $conexao = null;
      unset($conexao);
      ?>

    </div>

    <div class="lista-atividades-concluidas">
      <p>Concluídas</p>

      <div class="card">
        <div class="card-body">
          <div class="header-card d-flex">
            <h5 class="card-title">Nome da tarefa</h5>
            <h5 class="offset-md-4 ms-auto">Status: Concluída</h5>
          </div>
          <div class="card-prazo">
            <h6 class="card-subtitle mb-2 text-body-secondary">Criada em: </h6>
            <h6 class="card-subtitle mb-2 text-body-secondary">Expira em:</h6>
          </div>

          <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum laboriosam assumenda
            incidunt! Ab sunt animi distinctio quis dolore sapiente, nam cumque consectetur et! Tempora autem blanditiis
            ipsum praesentium, ut dolores.</p>
          <a href="#" class="card-link btn btn-success"><i class="bi bi-check"></i>Concluído</a>
          <a href="#" class="card-link btn btn-danger"><i class="bi bi-trash"></i>Excluir</a>
          <a href="#" class="card-link btn btn-secondary"><i class="bi bi-pencil-square"></i>Atualizar</a>
        </div>
      </div>

    </div>
  </div>

  <!-- Créditos -->
  <div class="modal fade" id="creditosModal" tabindex="-1" aria-labelledby="creditosLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="creditosLabel">Créditos</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Desenvolvido por: </p>
          <p>Éverton Simplício da Silva</p>
          <p>Lucas Vinicius Pisciotta</p>
          <p>Mateus Souza da Silva</p>
          <p>Maxwel Barbosa Silva</p>
          <p>Pedro Lucas Louzada</p>
          <p>Renan Souza de Oliveira</p>
          <p>Yago Giraud da Fonseca</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Atividades  -->
  <div class="modal fade" id="criarAtividadeModal" tabindex="-1" aria-labelledby="criarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="criarModalLabel">Criar atividade</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="POST" id="adicionarForm">
        <div class="modal-body">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nome" placeholder="nome" name="nome">
            <label for="floatingInput">Nome da atividade</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="descricao" placeholder="descricao" name="descricao">
            <label for="descricao">Descrição</label>
          </div>
          <div class="form-group">
            <label for="date" id="data-atividade">Dia da conclusão:</label>
            <input type="date" class="form-control" id="conclusao" name="conclusao" value="">
          </div>

          <!-- <p>Status:</p>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="0" checked>
            <label class="form-check-label" for="gridRadios1">
              Em aberto
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="1">
            <label class="form-check-label" for="gridRadios2">
              Concluída
            </label> -->
        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="fechar">Fechar</button>
          <input type="button" class="btn btn-primary" id="cadastrar" name="cadastrar">Salvar</input>
        </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function(){
      $('#cadastrar').click(function(){
        var _nome = $('#nome').val(); 
        var _descricao = $('#descricao').val();
        var _conclusao = $('#conclusao').val(); 

        $('#alert').html('');
			if (nome == '') {
				$('#alert').html('Preencher o nome.');
				$('#alert').addClass("alert-danger");
				return false;				
			}

			$('#alert').html('');
			if (descricao == '') {
				$('#alert').html('Preencher a descricao.');
				$('#alert').addClass("alert-danger");
				return false;
			}

			$('#alert').html('');
			if (conclusao == '') {
				$('#alert').html('Preencher a data de conclusao.');
				$('#alert').addClass("alert-danger");
				return false;
			}

			$('#alert').html('');

     

      $.ajax({
        method: 'POST',
        url: 'backend/adicionar.php',
        data: {
          nome:_nome,
          descricao:_descricao,
          conclusao:_conclusao
        },
        success: function(result) {
          $('form').trigger("reset");
					$('#alert').addClass("alert-success");
					$('#alert').fadeIn().html(result);
          

          setTimeout(function(){
            $('#alert').fadeOut('Slow');
          },3000);
          
            // Suponha que o servidor retorne a atividade inserida em formato JSON
          var atividade = JSON.parse(result);
          
          // Crie um elemento HTML para exibir a atividade na tela
          var atividadeHTML = '<div class="card">';
          atividadeHTML +=  '<div class="card-body">';
          atividadeHTML +=  '<div class="header-card d-flex">';
          atividadeHTML += '<h5 class="card-title">' + atividade.nome + '</h5>';
          atividadeHTML += '<h5 class="offset-md-4 ms-auto">Status: Em aberto</h5>';
          atividadeHTML += '</div>';
          atividadeHTML += '<div class="card-prazo">';
          atividadeHTML += '<h6 class="card-subtitle mb-2 text-body-secondary">Criada em: </h6>';
          atividadeHTML += '<h6 class="card-subtitle mb-2 text-body-secondary">Expira em:</h6>';
          atividadeHTML += '</div>';
          atividadeHTML += '<p class="card-text">' + atividade.descricao + '</p>';
          atividadeHTML += '<a href="#" class="card-link btn btn-success"><i class="bi bi-check"></i>Marcar como concluído</a>';
          atividadeHTML += '<a href="backend/delete.php" class="card-link btn btn-danger" id="excluir"><i class="bi bi-trash"></i>Excluir</a>';
          atividadeHTML += '<a href="#" class="card-link btn btn-secondary"><i class="bi bi-pencil-square"></i>Atualizar</a>';
          atividadeHTML += '</div>';
          atividadeHTML += '</div>'; 

          $('#lista-atividades-andamento').append(atividadeHTML);
          
        }
      })
      })
    })
      
    
  </script>




</body>

</html>