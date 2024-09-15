<?php
session_start();
include "conexao.php";
?>

<?php
date_default_timezone_set('America/Sao_Paulo');
?>

<?php
// Conexão com o banco de dados
$conn = mysqli_connect("localhost", "root", "", "adoptpetv1");

if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Consulta para contar pets por espécie
$sqlEspecie = "SELECT especie, COUNT(*) as quantidade FROM pet GROUP BY especie";
$resultadoEspecie = mysqli_query($conn, $sqlEspecie);
$especies = [];
$quantidadeEspecies = [];

while ($row = mysqli_fetch_assoc($resultadoEspecie)) {
    $especies[] = $row['especie'];
    $quantidadeEspecies[] = $row['quantidade'];
}

// Consulta para contar adotantes por endereço
$sqlAdotantesEndereco = "
    SELECT 
        CASE 
            WHEN endereco LIKE '%Loanda%' THEN 'Loanda'
            WHEN endereco LIKE '%Carneirinhos%' THEN 'Carneirinhos'
            WHEN endereco LIKE '%Cruzeiro%' THEN 'Cruzeiro'
            WHEN endereco LIKE '%Bau%' THEN 'Bau'
            ELSE 'Outros'
        END AS bairro, 
        COUNT(*) AS quantidade 
    FROM adotante 
    GROUP BY bairro
";
$resultadoAdotantesEndereco = mysqli_query($conn, $sqlAdotantesEndereco);
$bairrosAdotantes = [];
$quantidadeAdotantesEndereco = [];

// Processa os resultados da consulta
while ($row = mysqli_fetch_assoc($resultadoAdotantesEndereco)) {
    $bairrosAdotantes[] = $row['bairro'];
    $quantidadeAdotantesEndereco[] = $row['quantidade'];
}
//




// Inicializa variáveis
$mes = isset($_GET['mes']) ? $_GET['mes'] : date('m'); // Pega o mês da query string ou usa o mês atual
$ano = isset($_GET['ano']) ? $_GET['ano'] : date('Y'); // Pega o ano da query string ou usa o ano atual

// Consulta para contar pets por raça
$sqlRaca = "SELECT raca, COUNT(*) as quantidade FROM pet GROUP BY raca";
$resultadoRaca = mysqli_query($conn, $sqlRaca);
$racas = [];
$quantidadeRacas = [];

while ($row = mysqli_fetch_assoc($resultadoRaca)) {
    $racas[] = $row['raca'];
    $quantidadeRacas[] = $row['quantidade'];
}
//
$sqlIdade = "
    SELECT 
        CASE 
            WHEN TIMESTAMPDIFF(YEAR, datanasc, CURDATE()) <= 1 THEN '0-1 anos'
            WHEN TIMESTAMPDIFF(YEAR, datanasc, CURDATE()) <= 3 THEN '1-3 anos'
            WHEN TIMESTAMPDIFF(YEAR, datanasc, CURDATE()) <= 6 THEN '3-6 anos'
            ELSE '6+ anos'
        END AS faixa_etaria, 
        COUNT(*) as quantidade 
    FROM pet 
    GROUP BY faixa_etaria
";
$resultadoIdade = mysqli_query($conn, $sqlIdade);
$faixasEtarias = [];
$quantidadeIdades = [];

while ($row = mysqli_fetch_assoc($resultadoIdade)) {
    $faixasEtarias[] = $row['faixa_etaria'];
    $quantidadeIdades[] = $row['quantidade'];
}

// Consulta SQL para obter a quantidade de adotantes por faixa etária
$sqlAdotantesIdade = "
    SELECT 
        CASE 
            WHEN TIMESTAMPDIFF(YEAR, datanasc, CURDATE()) BETWEEN 0 AND 17 THEN 'Até 17 anos'
            WHEN TIMESTAMPDIFF(YEAR, datanasc, CURDATE()) BETWEEN 18 AND 30 THEN '18-30 anos'
            WHEN TIMESTAMPDIFF(YEAR, datanasc, CURDATE()) BETWEEN 31 AND 45 THEN '31-45 anos'
            WHEN TIMESTAMPDIFF(YEAR, datanasc, CURDATE()) BETWEEN 46 AND 60 THEN '46-60 anos'
            ELSE '60+ anos'
        END AS faixa_etaria, 
        COUNT(*) as quantidade 
    FROM adotante 
    GROUP BY faixa_etaria
";
$resultadoAdotantesIdade = mysqli_query($conn, $sqlAdotantesIdade);
$faixasEtariasAdotantes = [];
$quantidadeAdotantes = [];
// Processa os resultados da consulta
while ($row = mysqli_fetch_assoc($resultadoAdotantesIdade)) {
    $faixasEtariasAdotantes[] = $row['faixa_etaria'];
    $quantidadeAdotantes[] = $row['quantidade'];
}

// Inicializa variáveis
$mes = isset($_GET['mes']) ? $_GET['mes'] : date('m'); // Pega o mês da query string ou usa o mês atual
$ano = isset($_GET['ano']) ? $_GET['ano'] : date('Y'); // Pega o ano da query string ou usa o ano atual

// Consulta para obter pets adotados no mês e ano especificados
$sql = "
    SELECT p.raca, p.especie, a.CPF, ad.dataadocao
    FROM adocao ad
    JOIN pet p ON ad.CODpet = p.CODpet
    JOIN adotante a ON ad.CPFadotante = a.CPF
    WHERE MONTH(ad.dataadocao) = $mes AND YEAR(ad.dataadocao) = $ano
    ORDER BY ad.dataadocao DESC
";
$resultado = mysqli_query($conn, $sql);

$adocoes = [];

while ($row = mysqli_fetch_assoc($resultado)) {
    $adocoes[] = $row;
}

mysqli_close($conn);

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Pets</title>
    <!-- Incluindo a biblioteca Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Bootstrap para estilização básica -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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


        /* Caixa estilizada para o formulário */
        .form-container {
            background-color: #EBEBEB; /* Cinza claro */
            border-radius: 10px; /* Bordas arredondadas */
            padding: 30px; /* Espaçamento interno */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        /* Botões com tamanho igual */
        .btn-custom {
            width: 100%;
            margin-top: 10px;
        }

      /* Ajuste do footer */
      footer {
        background-color: #353535;
        color: white;
        padding: 120px 100px; /* Aumenta o padding para dar mais espaço interno */
        margin-top: 50px;
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

        /* Incluindo os estilos aqui */
        .box-gray {
        background-color: rgba(235, 235, 235, 0.7);
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        margin-bottom: 30px;
        margin-top: 50px; /* Adiciona espaço acima da caixa cinza */

      }

        .dashboard-section {
            padding: 20px;
        }
        .dashboard-section .col-md-6,
        .dashboard-section .col-md-12 {
          margin-bottom: 60px; /* Ajuste o valor conforme necessário */
      }

        canvas {
            max-width: 100% !important;
            max-height: 200px !important; /* Ajusta a altura dos gráficos para mais compactos */
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

  <div class="content container box-gray">
  <div class="container">
    <h3 class="d-flex justify-content-center">Dashboard</h3>
    <br>
    <h5>Pesquisa de Pets Adotados</h5>
    <form method="GET" action="">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="mes">Selecione o Mês:</label>
                <select class="form-control" id="mes" name="mes">
                    <option value="1" <?php echo $mes == 1 ? 'selected' : ''; ?>>Janeiro</option>
                    <option value="2" <?php echo $mes == 2 ? 'selected' : ''; ?>>Fevereiro</option>
                    <option value="3" <?php echo $mes == 3 ? 'selected' : ''; ?>>Março</option>
                    <option value="4" <?php echo $mes == 4 ? 'selected' : ''; ?>>Abril</option>
                    <option value="5" <?php echo $mes == 5 ? 'selected' : ''; ?>>Maio</option>
                    <option value="6" <?php echo $mes == 6 ? 'selected' : ''; ?>>Junho</option>
                    <option value="7" <?php echo $mes == 7 ? 'selected' : ''; ?>>Julho</option>
                    <option value="8" <?php echo $mes == 8 ? 'selected' : ''; ?>>Agosto</option>
                    <option value="9" <?php echo $mes == 9 ? 'selected' : ''; ?>>Setembro</option>
                    <option value="10" <?php echo $mes == 10 ? 'selected' : ''; ?>>Outubro</option>
                    <option value="11" <?php echo $mes == 11 ? 'selected' : ''; ?>>Novembro</option>
                    <option value="12" <?php echo $mes == 12 ? 'selected' : ''; ?>>Dezembro</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="ano">Selecione o Ano:</label>
                <select class="form-control" id="ano" name="ano">
                    <?php
                    $currentYear = date('Y');
                    for ($i = $currentYear; $i >= $currentYear - 10; $i--) {
                        echo "<option value=\"$i\" " . ($ano == $i ? 'selected' : '') . ">$i</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <table class="table mt-3">
    <thead class="table-header">
        <tr>
            <th>Raça</th>
            <th>Espécie</th>
            <th>CPF do Adotante</th>
            <th>Data da Adoção</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($adocoes)): ?>
            <tr>
                <td colspan="4">Nenhum registro encontrado.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($adocoes as $adocao): ?>
                <?php
                // Formatar a data
                $dataFormatada = (new DateTime($adocao['dataadocao']))->format('d/m/Y');
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($adocao['raca']); ?></td>
                    <td><?php echo htmlspecialchars($adocao['especie']); ?></td>
                    <td><?php echo htmlspecialchars($adocao['CPF']); ?></td>
                    <td><?php echo htmlspecialchars($dataFormatada); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

  </div>
  <br>
    <div class="dashboard-section">
      <div class="row">
        <div class="col-md-6">
          <h5>Gráfico de Pets por Espécie</h5>
          <canvas id="graficoEspecie"></canvas>
        </div>
        <div class="col-md-6">
          <h5>Gráfico de Pets por Raça</h5>
          <canvas id="graficoRaca"></canvas>
        </div>
        <div class="col-md-12">
          <h5>Gráfico de Pets por Idade</h5>
          <canvas id="graficoIdade"></canvas>
        </div>
        <div class="col-md-12">
          <h5>Gráfico de Adotantes por Idade</h5>
          <canvas id="graficoAdotantesIdade"></canvas>
        </div>
        <div class="col-md-12">
          <h5>Gráfico de Adotantes por Endereço</h5>
          <canvas id="graficoAdotantesEndereco"></canvas>
        </div>
        <br>
      </div>
    </div>
  </div>

  
    
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<script>
    // Gráfico de Pets por Espécie
    var ctxEspecie = document.getElementById('graficoEspecie').getContext('2d');
    var graficoEspecie = new Chart(ctxEspecie, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($especies); ?>,
            datasets: [{
                label: 'Quantidade de Pets por Espécie',
                data: <?php echo json_encode($quantidadeEspecies); ?>,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.4)',
                    'rgba(153, 102, 255, 0.4)',
                    'rgba(255, 159, 64, 0.4)',
                    'rgba(255, 99, 132, 0.4)',
                    'rgba(54, 162, 235, 0.4)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                },
                datalabels: {
                    color: '#fff',
                    formatter: function(value, context) {
                        let total = 0;
                        context.chart.data.datasets[0].data.forEach((data) => {
                            total += data;
                        });
                        let percentage = (value / total * 100).toFixed(2) + '%';
                        return percentage;
                    },
                    display: true,
                    anchor: 'end',
                    align: 'top'
                }
            }
        }
    });

    // Gráfico de Pets por Raça
    var ctxRaca = document.getElementById('graficoRaca').getContext('2d');
    var graficoRaca = new Chart(ctxRaca, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($racas); ?>,
            datasets: [{
                label: 'Quantidade de Pets por Raça',
                data: <?php echo json_encode($quantidadeRacas); ?>,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.4)',
                    'rgba(153, 102, 255, 0.4)',
                    'rgba(255, 159, 64, 0.4)',
                    'rgba(255, 99, 132, 0.4)',
                    'rgba(54, 162, 235, 0.4)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                },
                datalabels: {
                    color: '#fff',
                    formatter: function(value, context) {
                        let total = 0;
                        context.chart.data.datasets[0].data.forEach((data) => {
                            total += data;
                        });
                        let percentage = (value / total * 100).toFixed(2) + '%';
                        return percentage;
                    },
                    display: true,
                    anchor: 'end',
                    align: 'top'
                }
            }
        }
    });

  // Gráfico de Pets por Idade
  var ctx = document.getElementById('graficoIdade').getContext('2d');
  var graficoIdade = new Chart(ctx, {
      type: 'bar', // ou 'pie', dependendo do tipo de gráfico que preferir
      data: {
          labels: <?php echo json_encode($faixasEtarias); ?>,
          datasets: [{
              label: 'Quantidade de Pets por Idade',
              data: <?php echo json_encode($quantidadeIdades); ?>,
              backgroundColor: 'rgba(75, 192, 192, 0.4)', // Cor única para todas as barras
              borderColor: 'rgba(75, 192, 192, 1)', 
              borderWidth: 1
          }]
      },
      options: {
          responsive: true, // Faz com que o gráfico seja responsivo
          maintainAspectRatio: false, // Permite que o gráfico use toda a área do contêiner
          scales: {
              y: {
                  beginAtZero: true,
                  ticks: {
                      callback: function(value, index, values) {
                          // Arredonda o valor e garante que seja um número inteiro
                          return Math.round(value);
                      },
                      stepSize: 1 // Define o intervalo entre os ticks
                  }
              }
          }
      }
  });

       // Gráfico de Adotantes por Idade
       var ctx = document.getElementById('graficoAdotantesIdade').getContext('2d');
        var graficoAdotantesIdade = new Chart(ctx, {
            type: 'bar', // ou 'pie', dependendo do tipo de gráfico que preferir
            data: {
                labels: <?php echo json_encode($faixasEtariasAdotantes); ?>,
                datasets: [{
                    label: 'Quantidade de Adotantes por Idade',
                    data: <?php echo json_encode($quantidadeAdotantes); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.4)', // Cor única para todas as barras
                    borderColor: 'rgba(54, 162, 235, 1)', 
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return Math.round(value);
                            },
                            stepSize: 1 // Define o intervalo entre os ticks
                        }
                    }
                }
            }
        });

// Gráfico de Adotantes por Endereço
var ctx = document.getElementById('graficoAdotantesEndereco').getContext('2d');
    var graficoAdotantesEndereco = new Chart(ctx, {
        type: 'bar', // Você pode trocar por 'pie' ou outro tipo de gráfico
        data: {
            labels: <?php echo json_encode($bairrosAdotantes); ?>, // Bairros
            datasets: [{
                label: 'Quantidade de Adotantes por Endereço',
                data: <?php echo json_encode($quantidadeAdotantesEndereco); ?>, // Quantidade de adotantes por bairro
                backgroundColor: 'rgba(255, 159, 64, 0.4)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0 // Para garantir números inteiros
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                }
            }
        }
    });

</script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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

</body>
</html>

