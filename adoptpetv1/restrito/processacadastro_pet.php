<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Cadastro</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <?php
            // Verifica se o formulário foi enviado
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Inclua a função conectarBancoDados do seu arquivo PHP original
                include 'conexao.php';

                // Conectar ao banco de dados
                //$conn = conectarBancoDados();

                // Obter dados do formulário
                $CODpet = $_POST['CODpet'];  
                $nome = $_POST['nome'];
                $sexo = $_POST['sexo'];
                $datanasc = $_POST['datanasc'];
                $raca = $_POST['raca'];
                $especie = $_POST['especie'];
                $CODabrig = $_POST['abrigo'];  // Nome correto da coluna para a chave estrangeira

                // Preparar a consulta SQL
                $sql = "INSERT INTO pet (CODpet, nome, sexo, datanasc, raca, especie, CODabrig, statuspet) 
                        VALUES ('$CODpet','$nome','$sexo','$datanasc','$raca','$especie','$CODabrig', 'Disponivel')";


                // Executar a consulta
                if (mysqli_query($conn, $sql)) {
                    mensagem("$CODpet cadastrado com sucesso!", 'success');
                } else {
                    mensagem("$CODpet Erro! Não cadastrado: " . mysqli_error($conn), 'danger');
                }

                // Fechar a conexão
                mysqli_close($conn);
            }   
            ?>
            <a href="../index.php" class="btn btn-primary">Voltar para o início</a>
        </div> 
    </div>
    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>
