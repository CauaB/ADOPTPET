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

        /* Botões com tamanho igual */
        .btn-custom {
            width: 100%;
            margin-top: 10px;
        }
              /* Botões do mesmo tamanho */
      .btn-container {
        display: flex;
        flex-direction: column;
        gap: 15px; /* Espaço entre os botões */
      }
        .box-gray {
        background-color: #EBEBEB; /* Cinza claro */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);

      }

      /* Caixa estilizada para o formulário */
      .form-container {
        background-color: rgba(235, 235, 235, 0.7);
        border-radius: 10px; /* Bordas arredondadas */
        padding: 30px; /* Espaçamento interno */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
      }

      /* Botões com tamanho igual */
      .btn-custom {
        width: 100%;
        margin-top: 10px;
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

    <!-- Formulário de Cadastro -->
    <div class="container mt-5 content">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="form-container">
                    <h1 class="text-center">Cadastro Adotante</h1>
                    <form action="processacadastro_adotante.php" method="POST">
                        <div class="form-group">
                            <label for="CPF">CPF:</label>
                            <input type="text" class="form-control" name="CPF" required>
                        </div>
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone:</label>
                            <input type="text" class="form-control" name="telefone" required>
                        </div>
                        <div class="form-group">
                            <label for="sexo">Sexo:</label>
                            <select class="form-control" name="sexo">
                                <option value="masculino">Masculino</option>
                                <option value="feminino">Feminino</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="endereco">Endereço:</label>
                            <input type="text" class="form-control" name="endereco" required>
                        </div>
                        <div class="form-group">
                            <label for="quantpets">Quantidade de Pets:</label>
                            <input type="text" class="form-control" name="quantpets" required>
                        </div>
                        <div class="form-group">
                            <label for="datanasc">Data de Nascimento:</label>
                            <input type="date" class="form-control" name="datanasc" required>
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha:</label>
                            <input type="password" class="form-control" name="senha" required>
                        </div>
                        <div class="form-group text-center">
                        <div class="btn-container">
                          <input type="submit" class="btn btn-success" value="Cadastrar">
                          <a href="../index.php" class="btn btn-primary">Voltar para o início</a>
                        </div>
                    </div>
                    </form>
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

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
