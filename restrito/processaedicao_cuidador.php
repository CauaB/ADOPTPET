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
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $CODabri = $_POST['CODabri'];
                // Preparar a consulta SQL
// Preparar a consulta SQL
            $sql = "UPDATE cuidador SET nome = '$nome', telefone = '$telefone', CODabri = '$CODabri' WHERE CPF = '$id'";


    // Executar a consulta
    if ($conn = mysqli_query($conn, $sql)) {
        // Redireciona para a página de pesquisa de adotantes
        header('Location: pesquisa_cuidador.php');
        exit(); // Encerra o script para garantir que o redirecionamento seja feito corretamente
    } else {
        // Exibe uma mensagem de erro
        mensagem("$nome Erro! Não alterado!", 'danger');
    }
}
?>
    

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