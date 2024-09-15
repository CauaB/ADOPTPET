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

        // Obter dados do formulário
        $CPF = $_POST['CPF'];   
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $senha = $_POST['senha'];
        $CODabri = $_POST['CODabri'];
        
        // Insere o cuidador no banco de dados
        $sql = "INSERT INTO cuidador (CPF, nome, telefone, senha, CODabri) VALUES ('$CPF','$nome','$telefone', md5('$senha'),'$CODabri')";

        // Executar a consulta
        if (mysqli_query($conn, $sql)) {
            // Se o cuidador foi cadastrado com sucesso, insere na tabela 'trabalhar'
            $sql_trabalhar = "INSERT INTO trabalhar (CODabrigo, CPFcuidador) VALUES ('$CODabri', '$CPF')";

            if (mysqli_query($conn, $sql_trabalhar)) {
                mensagem("$nome cadastrado e vinculado ao abrigo com sucesso!", 'success');
            } else {
                mensagem("Erro ao vincular $nome ao abrigo!", 'danger');
            }
        } else {
            mensagem("$nome Erro! Não cadastrado!", 'danger');
        }
    }
?>

        <a href="../index.php" class="btn btn-primary">Voltar para o início</a>
      
    </div> 
</div>
    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>