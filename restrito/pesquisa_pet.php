<?php
session_start();
?>

<?php
date_default_timezone_set('America/Sao_Paulo');
?>

<?php
    $nome = $_POST['nome'] ?? '';
    $sexo = $_POST['sexo'] ?? '';
    $datanasc = $_POST['datanasc'] ?? '';
    $raca = $_POST['raca'] ?? '';
    $especie = $_POST['especie'] ?? '';
    $statuspet = $_POST['statuspet'] ?? '';
    $abrigo = $_POST['abrigo'] ?? '';

    include "conexao.php";

    // Consulta com JOIN para abrigos usando a coluna correta para o relacionamento
    $sql = "SELECT pet.*, abrigo.nome AS abrigo_nome FROM pet 
            JOIN abrigo ON pet.CODabrig = abrigo.CODabrigo
            WHERE 1=1";

    if (!empty($nome)) {
        $sql .= " AND pet.nome LIKE '%$nome%'";
    }

    if (!empty($sexo)) {
        $sql .= " AND pet.sexo = '$sexo'";
    }

    if (!empty($datanasc)) {
        $sql .= " AND pet.datanasc = '$datanasc'";
    }

    if (!empty($raca)) {
        $sql .= " AND pet.raca LIKE '%$raca%'";
    }

    if (!empty($especie)) {
        $sql .= " AND pet.especie LIKE '%$especie%'";
    }

    // Ajuste para status (0 = Disponível, 1 = Adotado)
    if ($statuspet == 'Disponível') {
        $sql .= " AND pet.statuspet = 'Disponível'";
    } elseif ($statuspet == 'Adotado') {
        $sql .= " AND pet.statuspet = 'Adotado'";
    }

    // Tratamento para abrigo
    if (!empty($abrigo)) {
        $sql .= " AND pet.CODabrig = '$abrigo'";
    }

    // Executa a consulta
    $dados = mysqli_query($conn, $sql);
?>




<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Pesquisar Pets</title>
    <style>

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
            display: flex;
            flex-direction: column;
            background-color: #F0F0F0; /* Altere para a cor desejada */
            font-weight: bold; /* Negrito */
            font-family: 'Roboto', sans-serif; /* Define Roboto como a fonte padrão */
        }   

        .content {
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

    .btn-group {
        display: flex;
        justify-content: space-between;
    }

    /* Garante que os botões de "Editar" e "Excluir" fiquem lado a lado e do mesmo tamanho */
    .btn-group .btn {
        flex: 1;
        margin-right: 5px;
    }

    .btn-group .btn:last-child {
        margin-right: 0;
    }

    .btn-edit {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .btn-edit:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
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
      background-color: rgb(239 239 239);
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

    @media (max-width: 1300px) {
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
      /* Caixa cinza */
      .box-gray {
        background-color: rgba(235, 235, 235, 0.7);
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);

      }


</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Adiciona um listener para o evento de envio de formulário
        document.querySelectorAll('form[action="adotar_pet.php"]').forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Evita o envio padrão do formulário

                var formData = new FormData(form);

                fetch('adotar_pet.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert(data.message); // Alerta de sucesso
                        // Atualizar o botão para mostrar que o pet foi adotado
                        form.innerHTML = "<button class='btn btn-adoptado btn-block' disabled>Adotado</button>";
                    } else {
                        alert(data.message); // Alerta de erro
                    }
                })
                .catch(error => {
                    alert('Erro ao adotar o pet: ' + error);
                });
            });
        });
    });
</script>
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


    <div class="container-fluid mt-5 content"> 
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-26"> <!-- Aumentei a largura da coluna -->
            <div class="box-gray"> <!-- Caixa cinza adicionada -->
                <h1 class="text-center">Pesquisar Pet</h1>
                <nav class="navbar navbar-light bg-light justify-content-center">
                <form class="form-inline" action="pesquisa_pet.php" method="POST">
                  <input class="form-control mr-sm-2" type="search" placeholder="Nome" aria-label="Search" name='nome' autofocus>
                  
                  <select class="form-control mr-sm-2" name="sexo">
                      <option value="">Sexo</option>
                      <option value="Macho">Macho</option>
                      <option value="Fêmea">Fêmea</option>
                  </select>

                  <input class="form-control mr-sm-2" type="date" placeholder="Data de Nascimento" aria-label="Search" name='datanasc'>
                  
                  <input class="form-control mr-sm-2" type="search" placeholder="Raça" aria-label="Search" name='raca'>
                  
                  <input class="form-control mr-sm-2" type="search" placeholder="Espécie" aria-label="Search" name='especie'>
                  
                  <select class="form-control mr-sm-2" name="statuspet">
                      <option value="">Status</option>
                      <option value="Disponível">Disponivel</option>
                      <option value="Adotado">Adotado</option>
                  </select>
                  
                  <select class="form-control mr-sm-2" name="abrigo">
                      <option value="">Abrigo</option>
                      <option value="1">PetCenter</option>
                      <option value="2">PetDeTodos</option>
                  </select>

                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                </form>

                </nav>
            <div class="table-responsive">
                <table class="table table-bordered table-hover mt-0">
                    <thead>
                        <tr>
                            <th>Código do pet</th>
                            <th>Nome</th>
                            <th>Sexo</th>
                            <th>Data de Nascimento</th>
                            <th>Raça</th>
                            <th>Espécie</th>
                            <th>Status</th>
                            <th>Abrigo</th>
                            <?php if (isset($_SESSION['adotante_id']) || isset($_SESSION['cuidador_id'])): ?>
                                <th>Ações</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($linha = mysqli_fetch_assoc($dados)) {
                            $CODpet = $linha['CODpet'];
                            $nome = $linha['nome'];
                            $sexo = $linha['sexo'];
                            $datanasc = mostra_data($linha['datanasc']);
                            $raca = $linha['raca'];
                            $especie = $linha['especie'];
                            $statuspet = $linha['statuspet'];
                            $CODabrig = $linha['CODabrig'];

                            // Definir o nome do abrigo
                            if ($CODabrig == 1) {
                                $abrigo_nome = "PetCenter";
                            } elseif ($CODabrig == 2) {
                                $abrigo_nome = "PetDeTodos";
                            } else {
                                $abrigo_nome = "Abrigo Desconhecido";
                            }

                            // Definir o botão de adoção baseado no status do pet
                            if ($statuspet === 'Adotado' or $statuspet === 'adotado') {
                                $adotar_botao = "<button class='btn btn-adoptado btn-block' disabled>Adotado</button>";
                            } else {
                                if (isset($_SESSION['adotante_id'])) {
                                    $adotar_botao = "<form action='adotar_pet.php' method='POST' style='margin: 0;'>
                                                        <input type='hidden' name='CODpet' value='$CODpet'>
                                                        <button type='submit' class='btn btn-success btn-block'>Adotar</button>
                                                      </form>";
                                } else {
                                    $adotar_botao = ""; // Não exibe o botão se o adotante não estiver logado
                                }
                            }

                            echo "<tr>
                                    <td>$CODpet</td>
                                    <td>$nome</td>
                                    <td>$sexo</td>
                                    <td>$datanasc</td>
                                    <td>$raca</td>
                                    <td>$especie</td>
                                    <td>$statuspet</td>
                                    <td>$abrigo_nome</td>";

                                  if (isset($_SESSION['adotante_id']) || isset($_SESSION['cuidador_id'])) {
                                      echo "<td>
                                              <div class='btn-group-vertical'>
                                                  $adotar_botao
                                                  " . (isset($_SESSION['cuidador_id']) ? "<a href='editar_pet.php?CODpet=$CODpet' class='btn btn-primary btn-sm'>Editar</a>
                                                      <a href='excluir_pet.php?CODpet=$CODpet' class='btn btn-danger btn-sm' onclick='return confirm(\"Tem certeza que deseja excluir este pet?\");'>Excluir</a>" : "") . "
                                              </div>
                                            </td>";
                                  }

                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>


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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
