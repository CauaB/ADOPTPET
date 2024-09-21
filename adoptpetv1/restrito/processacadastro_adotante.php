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
            $CPF = $_POST['CPF'];
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $sexo = $_POST['sexo'];
            $endereco = $_POST['endereco'];
            $quantpets = $_POST['quantpets'];
            $datanasc = $_POST['datanasc'];
            $senha = $_POST['senha'];
                // Preparar a consulta SQL
            $sql = "INSERT INTO adotante (CPF, nome, telefone, sexo, endereco, quantpets, datanasc, senha) 
            VALUES ('$CPF','$nome','$telefone','$sexo','$endereco','$quantpets','$datanasc',md5('$senha'))";

        // Executar a consulta
        if( $conn = mysqli_query($conn, $sql)){
            mensagem("$nome cadastrado com sucesso!",'success');
        } else {
            mensagem("$nome Erro! Não cadastrado!",'danger');
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