<?php
session_start();
?>

<?php
date_default_timezone_set('America/Sao_Paulo');
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

    <title>ADOPT PET</title>

    <style>
      /* Jumbotron with background image */
      .jumbotron-bg {
        background-image: url('img/dog_cat.jpg'); /* Adicione o caminho da sua imagem */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: white;
        margin: 0;
        min-height: 600px; /* Define a altura mínima do jumbotron */
        display: flex;
        align-items: center; /* Centraliza o conteúdo verticalmente */
        justify-content: center; /* Centraliza o conteúdo horizontalmente */
      }

      .jumbotron-bg h1, .jumbotron-bg p {
        color: white;
      }

      html, body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
        background-image: url('img/wallpaper1.png'); /* Substitua pelo caminho da sua imagem */
        background-size: cover; /* Faz com que a imagem cubra a tela inteira */
        background-position: center; /* Centraliza a imagem */
        background-repeat: no-repeat; /* Impede a repetição da imagem */
        background-attachment: fixed; /* Faz a imagem ficar fixa ao rolar a página */
      }

      body {
        background-color: #F0F0F0; /* Altere para a cor desejada */
        flex: 1;
        font-weight: bold; /* Negrito */
        font-family: 'Roboto', sans-serif; /* Define Roboto como a fonte padrão */
      }

      .container {
        flex: 1;
      }
      /* Estilo da Navbar */
      .navbar-custom {
        background-color: rgba(235, 235, 235, 0.7);
        color: grey;
        padding: 2rem 1.5rem; /* Ajuste o padding para aumentar a altura */
        box-shadow: 0 4px 9px rgba(20, 5, 10, 0.8); /* Sombra sutil na parte inferior */
        font-size: 18px; 

      }

      .navbar-brand {
        color: #0B3861; 
        font-size: 30px; /* Ajuste o tamanho da fonte conforme necessário */
      }

      /* Ajuste do botão de login */
      .navbar-custom .btn {
        margin-top: 0.2rem; /* Ajusta a margem para alinhar verticalmente */
        font-size: 14px; /* Ajuste o tamanho da fonte conforme necessário */
        margin-right: 10px;
        border-radius: 10px;        
      }

      @media (max-width: 768px) {
        .navbar-toggler-icon {
          border-left: 8px solid transparent; /* Ajuste o tamanho da seta */
          border-right: 8px solid transparent; /* Ajuste o tamanho da seta */
          border-top: 8px solid grey; /* Cor da seta */
        }
      }
      .navbar-toggler-icon {
        width: 0;
        height: 0;
        border-left: 15px solid transparent;
        border-right: 15px solid transparent;
        border-top: 15px solid grey; /* Cor da seta */
        background-color: transparent;
      }


      /* Ajuste do footer */
      footer {
        background-color: #353535;
        color: white;
        padding: 120px 100px; /* Aumenta o padding para dar mais espaço interno */
        margin-top: 300px;
        position: relative;
        bottom: 0;
        width: 100%;
        text-align: center;
        box-shadow: 0 -4px 15px rgba(10, 5, 10, 0.8); /* Sombra sutil na parte inferior */      
      }

      footer .footer-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
      }

      footer .footer-content .left,
      footer .footer-content .right {
        margin: 0;
      }

      footer hr {
        border-color: grey;
        margin-top: 20px; /* Aumenta a margem para mais espaço */
        margin-bottom: 20px; /* Aumenta a margem para mais espaço */
      }


  /* Estilização dos botões */
      /* Estilização dos botões */
      .btn-edit {
        background-color: #007bff; /* Azul */
        color: white;
        height: 40px; /* Altura fixada */
        width: 90px;
        line-height: 40px; /* Alinha o texto verticalmente */
        font-size: 16px; /* Tamanho da fonte ajustado */
        display: flex; /* Usa flexbox para centralização */
        align-items: center; /* Centraliza o texto verticalmente */
        justify-content: center; /* Centraliza o texto horizontalmente */
        border: none; /* Remove bordas */
        border-radius: .25rem .25rem .25rem .25rem; /* Arredondamento somente nos cantos direito */
        margin: 1; /* Espaçamento horizontal entre os botões */
      }

      .btn-delete {
        background-color: #dc3545; /* Vermelho */
        color: white;
        height: 40px; /* Altura fixada */
        width: 90px;
        line-height: 40px; /* Alinha o texto verticalmente */
        font-size: 16px; /* Tamanho da fonte ajustado */
        display: flex; /* Usa flexbox para centralização */
        align-items: center; /* Centraliza o texto verticalmente */
        justify-content: center; /* Centraliza o texto horizontalmente */
        border: none; /* Remove bordas */
        border-radius: .25rem .25rem .25rem .25rem; /* Arredondamento somente nos cantos esquerdo */
        margin-left: 10px;
      }

      /* Estilização para hover */
      .btn-edit:hover {
        background-color: #0056b3; /* Azul escuro */
      }

      .btn-delete:hover {
        background-color: #c82333; /* Vermelho escuro */
      }

      /* Estilização do grupo de botões */
      .btn-group-custom {
        display: flex;
        justify-content: center; /* Centraliza os botões horizontalmente */
        margin-top: auto; /* Faz com que o grupo de botões fique no fundo do card */
      }

      /* Caixa cinza */
      .box-gray {
        background-color: rgba(235, 235, 235, 0.7);
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);

      }
      table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
      font-size: 15px;
      text-align: left;
      border: 1px solid #bbb; /* Borda ao redor da tabela */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra ao redor da tabela */
    }

    th {
      background-color: #F0F0F0; /* Cor de fundo diferente para os títulos */
      color: #333; /* Cor do texto dos títulos */
      padding: 12px 15px;
      border: 1px solid #ddd; /* Borda das células de título */
      text-transform: uppercase;
    }

    td {
      background-color: rgba(235, 235, 235, 0.7);
      padding: 12px 15px;
      border: 1px solid #ddd; /* Borda das células de dados */
    }

    tr {
      border-bottom: 1px solid #ddd;
    }

    @media (max-width: 1200px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }

      th {
        position: absolute;
        top: -9999px;
        left: -9999px;
      }

      tr {
        margin-bottom: 15px;
      }

      td {
        border: none;
        position: relative;
        padding-left: 50%;
        text-align: right;
      }

      td:before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 50%;
        padding-left: 15px;
        font-weight: bold;
        text-align: left;
      }
    }
    .btn-group-vertical {
      display: flex;
      flex-direction: column;
    }

    .btn-group-vertical .btn {
      margin-bottom: 5px; /* Espaço entre os botões */
      width: 100%; /* Faz os botões ocuparem toda a largura disponível */
    }

    .btn-group-vertical .btn:last-child {
      margin-bottom: 0; /* Remove a margem inferior do último botão */
    }
    </style>
  </head>
  <body>
 <!-- Navbar -->
 <nav class="navbar navbar-expand-lg navbar-custom">
      <a class="navbar-brand" href="../index.php">
      <img src="img/iconpet.png" style="height: 75px;">
        <b><i>ADOPT PET</i></b></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Página Inicial</a>
          </li>
          <?php if (isset($_SESSION['cuidador_id'])): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPesquisar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pesquisar
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownPesquisar">
                <a class="dropdown-item" href="pesquisa_adotante.php">Pesquisar Adotante</a>
                <a class="dropdown-item" href="pesquisa_cuidador.php">Pesquisar Cuidador</a>
              </div>
            </li>
          <?php endif; ?>
          
          <!-- Cadastro Nav Item - Aparece apenas se o usuário não for um adotante -->
          <?php if (!isset($_SESSION['adotante_id'])): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCadastro" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Cadastro
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownCadastro">
                <a class="dropdown-item" href="cadastro_adotante.php">Cadastro Adotante</a>
                <?php if (isset($_SESSION['cuidador_id'])): ?>
                  <a class="dropdown-item" href="cadastro_cuidador.php">Cadastro Cuidador</a>
                <?php endif; ?>
              </div>
            </li>
          <?php endif; ?>
          
          <?php if ((isset($_SESSION['adotante_id']) || isset($_SESSION['cuidador_id']))): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAdotarPet" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pets
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownAdotarPet">
                <a class="dropdown-item" href="pesquisa_pet.php">Lista de Pets</a>
              </div>
            </li>
          <?php endif; ?>
          <?php if (isset($_SESSION['cuidador_id'])): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownDoarPet" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Incluir Pet
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownDoarPet">
                <a class="dropdown-item" href="cadastro_pet.php">Inserir pet para adoção</a>
              </div>
            </li>
          <?php endif; ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownSobre" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Abrigos
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownSobre">
              <a class="dropdown-item" href="abrigos.php">Lista de Abrigos</a>
            </div>
          </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownSobre" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dashboard
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownSobre">
              <a class="dropdown-item" href="dashboard.php">Dashboard</a>
            </div>
          </li>
        </ul>
        
        <?php if (isset($_SESSION['adotante_id']) || isset($_SESSION['cuidador_id'])): ?>
          <a class="btn btn-primary ml-md-3" href="logout.php">Sair</a>
        <?php else: ?>
          <div class="btn-group ml-md-3">
            <a class="btn btn-primary" href="login_adotante.php">Login Adotante</a>
            <a class="btn btn-primary" href="login_cuidador.php">Login Cuidador</a>
          </div>
        <?php endif; ?>
        
      </div>
    </nav>

    <?php
        $CPF = $_POST['CPF'] ?? '';
        $nome = $_POST['nome'] ?? '';
        $telefone = $_POST['telefone'] ?? '';
        $sexo = $_POST['sexo'] ?? '';
        $endereco = $_POST['endereco'] ?? '';
        $quantpets = $_POST['quantpets'] ?? '';
        $datanasc = $_POST['datanasc'] ?? '';

        include "conexao.php";

        // Condições dinâmicas para a pesquisa
        $sql = "SELECT * FROM adotante WHERE 1=1"; // Inicia com condição sempre verdadeira
        if (!empty($CPF)) {
            $sql .= " AND CPF LIKE '%$CPF%'";
        }
        if (!empty($nome)) {
            $sql .= " AND nome LIKE '%$nome%'";
        }
        if (!empty($telefone)) {
            $sql .= " AND telefone LIKE '%$telefone%'";
        }
        if (!empty($sexo)) {
          $sql .= " AND sexo = '$sexo'";
        }
        if (!empty($endereco)) {
            $sql .= " AND endereco LIKE '%$endereco%'";
        }

        if (!empty($quantpets)) {
            $sql .= " AND quantpets = $quantpets";
        }

        if (!empty($datanasc)) {
            $sql .= " AND datanasc = '$datanasc'";
        }

        // Executa a consulta
        $dados = mysqli_query($conn, $sql);
?>




<!-- Formulário de Pesquisa -->
<div class="container-fluid mt-5 content"> 
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-26"> <!-- Aumentei a largura da coluna -->
            <div class="box-gray"> <!-- Caixa cinza adicionada -->
                <h1 class="text-center">Pesquisar Adotante</h1>
                <nav class="navbar navbar-light bg-light justify-content-center mb-0"> <!-- Removi a margem inferior (mb-0) -->
                <form class="form-inline" action="pesquisa_adotante.php" method="POST">
                  <!-- Campo de pesquisa para o CPF -->
                  <input class="form-control mr-sm-2" type="text" placeholder="CPF" aria-label="Search" name='CPF'>
                  <!-- Campo de pesquisa para o nome -->
                  <input class="form-control mr-sm-2" type="search" placeholder="Nome" aria-label="Search" name='nome' autofocus>
                  
                  <input class="form-control mr-sm-2" type="search" placeholder="Telefone" aria-label="Search" name='telefone'>

                  <select class="form-control mr-sm-2" name="sexo">
                      <option value="">Sexo</option>
                      <option value="Masculino">Masculino</option>
                      <option value="Feminino">Feminino</option>
                  </select>

                  <!-- Campo de pesquisa para o endereço -->
                  <input class="form-control mr-sm-2" type="search" placeholder="Endereço" aria-label="Search" name='endereco'>
                  <!-- Campo de pesquisa para a quantidade de pets -->
                  <input class="form-control mr-sm-2" type="number" placeholder="Quantidade de Pets" aria-label="Search" name='quantpets'>

                  <input class="form-control mr-sm-2" type="date" placeholder="Data de Nascimento" aria-label="Search" name='datanasc'>

                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                </form>


                </nav>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mt-0"> <!-- Removi a margem superior (mt-0) -->
                        <thead class="thead-light">
                            <tr>
                                <th>CPF</th>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>Sexo</th>
                                <th>Endereço</th>
                                <th>Quantidade de Pets</th>
                                <th>Data de Nascimento</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                          while ($linha = mysqli_fetch_assoc($dados)) {
                              $CPF = $linha['CPF'];
                              $nome = $linha['nome'];
                              $telefone = $linha['telefone'];
                              $sexo = $linha['sexo'];
                              $endereco = $linha['endereco'];
                              $quantpets = $linha['quantpets'];
                              $datanasc = $linha['datanasc'];

                              // Tenta criar um objeto DateTime a partir do formato fornecido, se não for válido, mantém a data original
                              $datanascFormatada = $datanasc;
                              try {
                                  $data = DateTime::createFromFormat('Y-m-d', $datanasc); // Ajuste o formato conforme o formato real da data
                                  if ($data) {
                                      $datanascFormatada = $data->format('d/m/Y');
                                  }
                              } catch (Exception $e) {
                                  // Se ocorrer um erro, mantém a data original
                              }
                          ?>
                            <tr>
                                <td><?php echo htmlspecialchars($CPF); ?></td>
                                <td><?php echo htmlspecialchars($nome); ?></td>
                                <td><?php echo htmlspecialchars($telefone); ?></td>
                                <td><?php echo htmlspecialchars($sexo); ?></td>
                                <td><?php echo htmlspecialchars($endereco); ?></td>
                                <td><?php echo htmlspecialchars($quantpets); ?></td>
                                <td><?php echo htmlspecialchars($datanascFormatada); ?></td>
                                <td>
                                    <div class='btn-group-vertical'>
                                    <a href='editar_adotante.php?id=<?php echo urlencode($CPF); ?>' class='btn btn-sm btn-primary'>Editar</a>
                                    <a href='#' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#modalExcluir' onclick="setExclusaoLink('<?php echo urlencode($CPF); ?>', '<?php echo htmlspecialchars($nome); ?>')">Excluir</a>
                                    </div>
                                  </td>
                            </tr>
                            
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div> <!-- Fim da caixa cinza -->
        </div>
    </div>
</div>



    <!-- Modal -->
    <div class="modal" tabindex="-1" role="dialog" id="modalExcluir">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirmação de Exclusão</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="excluir_adotante.php" method="POST">
              <p>Deseja realmente excluir <strong id="modalNome"></strong>?</p>
              <input type="hidden" name="id" id="id_adotante" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
            <input type="hidden" name="nome" id="id_adotante1" value="">
            <button type="submit" class="btn btn-danger">Sim, quero excluir</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- JavaScript -->
    <script type="text/javascript">
      function setExclusaoLink(CPF, nome) {
        document.getElementById('modalNome').innerText = nome;
        document.getElementById('id_adotante1').value = nome;
        document.getElementById('id_adotante').value = CPF;
      }
    </script>
    <footer>
    <div class="footer-content">
        <div class="left">
            <p>&copy; 2024 ADOPT PET</p>
        </div>
    </div>
    <hr>
    <div class="footer-bottom">
        <br>
        <h3><b>ADOPT PET</b></h3>
        <br>
        <img src="img/iconpet.png" alt="Icone Pet" style="height: 150px; width: auto;">
    </div>
    </footer>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
