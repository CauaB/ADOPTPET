<?php
session_start();
?>

<?php
date_default_timezone_set('America/Sao_Paulo');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ADOPT PET</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

    <style>
      /* Custom Navbar */

      html, body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
        background-image: url('restrito/img/wallpaper1.png'); /* Substitua pelo caminho da sua imagem */
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

      @media (max-width: 1000px) {
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

      /* Jumbotron with background image */
      .jumbotron-bg {
        background-image: url('restrito/img/dog_cat.jpg'); /* Adicione o caminho da sua imagem */
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

      /* Estilo para as imagens dos cards */
      .card-img-top {
        height: 450px; /* Aumenta a altura das imagens */
        object-fit: cover;
      }

      /* Garantir que os cards ocupem o mesmo tamanho */
      .card {
        display: flex;
        flex-direction: column;
        height: 100%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        transition: transform 0.3s ease, box-shadow 0.3s ease
      }
      .card:hover {
      transform: scale(1.05); /* Aumenta o tamanho do card em 5% */
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* Aumenta a sombra quando o mouse está sobre o card */
      }

      .card-body {
        flex: 1 0 auto;
      }
      .sobre-nos {
        margin-top: 50px; /* Espaçamento entre os cards e a seção "Sobre Nós" */
        padding: 12px;
        background-color: rgba(235, 235, 235, 0.29);        
        border-radius: 10px; /* Bordas arredondadas */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
    }

    .sobre-nos h3 {
        text-align: center;
        font-size: 28px;
        margin-bottom: 20px;
        color: rgba(54, 54, 54, 0.8);

        
    }

    .sobre-nos p {
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 15px;
        text-align: justify;
        color: rgba(54, 54, 54, 0.7);
    }

    </style>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
      <a class="navbar-brand" href="index.php">
      <img src="restrito/img/iconpet.png" style="height: 75px;">
        <b><i>ADOPT PET</i></b></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Página Inicial</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href='#sobre-nos'>Sobre</a>
          </li>
          <?php if (isset($_SESSION['cuidador_id'])): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPesquisar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pesquisar
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownPesquisar">
                <a class="dropdown-item" href="restrito/pesquisa_adotante.php">Pesquisar Adotante</a>
                <a class="dropdown-item" href="restrito/pesquisa_cuidador.php">Pesquisar Cuidador</a>
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
                <a class="dropdown-item" href="restrito/cadastro_adotante.php">Cadastro Adotante</a>
                <?php if (isset($_SESSION['cuidador_id'])): ?>
                  <a class="dropdown-item" href="restrito/cadastro_cuidador.php">Cadastro Cuidador</a>
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
                <a class="dropdown-item" href="restrito/pesquisa_pet.php">Lista de Pets</a>
              </div>
            </li>
          <?php endif; ?>
          <?php if (isset($_SESSION['cuidador_id'])): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownDoarPet" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Incluir Pet
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownDoarPet">
                <a class="dropdown-item" href="restrito/cadastro_pet.php">Inserir pet para adoção</a>
              </div>
            </li>
          <?php endif; ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownSobre" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Abrigos
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownSobre">
              <a class="dropdown-item" href="restrito/abrigos.php">Lista de Abrigos</a>
            </div>
          </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownSobre" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dashboard
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownSobre">
              <a class="dropdown-item" href="restrito/dashboard.php">Dashboard</a>
            </div>
          </li>
        </ul>
        
        <?php if (isset($_SESSION['adotante_id']) || isset($_SESSION['cuidador_id'])): ?>
          <a class="btn btn-primary ml-md-3" href="restrito/logout.php">Sair</a>
        <?php else: ?>
          <div class="btn-group ml-md-3">
            <a class="btn btn-primary" href="restrito/login_adotante.php">Login Adotante</a>
            <a class="btn btn-primary" href="restrito/login_cuidador.php">Login Cuidador</a>
          </div>
        <?php endif; ?>
        
      </div>
    </nav>

    <!-- Jumbotron -->
    <div class="jumbotron jumbotron-bg text-center">
      <div class="container">
        <h1 class="display-4"><b>ADOPT PET</b></h1>
        <p class="lead"></p>
      </div>
    </div>

    <!-- Pets Section -->
    <div class="container">
      <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <font color="#FFFFFF"><h1 class="display-4"><b>PETS ADOTADOS</b></h1></font>
      <font color="#FFFFFF"><p class="lead"><b>Uma breve lista dos pets já adotados.</b></p></font>
      </div>

      <div class="card-deck mb-3 text-center">
        <div class="card mb-4 box-shadow">
          <img src="restrito/img/dog1.jpeg" class="card-img-top" alt="Jack">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Jack</h4>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <img src="restrito/img/dog2.jpg" class="card-img-top" alt="Thor">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Thor</h4>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <img src="restrito/img/cat1.jpg" class="card-img-top" alt="Steve">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Steve</h4>
          </div>
        </div>
      </div>
    </div>  

    <!-- Seção Sobre Nós -->
    <div class="container">
      <section id="sobre-nos" class="sobre-nos">
        <h3>SOBRE</h3>
        <p>Bem-vindo(a) ao ADOPT PET, um espaço dedicado a conectar animais que precisam de um lar com pessoas que estão prontas para adotá-los na cidade de João Monlevade. Nosso propósito é simples: transformar a vida dos animais, oferecendo uma chance de encontrar famílias que possam lhes proporcionar cuidado e carinho.</p>
        
        <p>Trabalhamos com abrigos e cuidadores comprometidos para garantir que cada adoção seja feita de forma segura, responsável e com acompanhamento contínuo, garantindo a melhor experiência tanto para os adotantes quanto para os animais.</p>

        <p>No ADOPT PET, oferecemos uma plataforma fácil de usar para que você possa encontrar o pet ideal, com filtros por espécie, raça e nascimento. Além disso, oferecemos informações importantes e úteis para nossos adotantes e cuidadores no nosso Dashboard, para auxiliar cada vez mais nos processos de adoção.</p>

        <p>Venha fazer parte da nossa missão e ajude a mudar vidas, adotando um pet e oferecendo a ele um futuro repleto de felicidade!</p>
      </section>
    </div>

  <footer>
    <div class="footer-content">
        <div class="left">
            <p>&copy; 2024 ADOPT PET</p>          
        </div>
    </div>
    <div class="footer-content">
        <div class="left">
        <font color="grey"><p style = 'font-size:14px'>Desenvolvido por: Cauã Bandeira, Ryan Oliveira e Zeca Manuel.</p></font>           
        </div>
    </div>
    <hr>
    <div class="footer-bottom">
        <br>
        <h3><b>ADOPT PET</b></h3>
        <br>
        <img src="restrito/img/iconpet.png" alt="Icone Pet" style="height: 150px; width: auto;">
    </div>
    </footer>

    <!-- Bootstrap e JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </body>
</html>
