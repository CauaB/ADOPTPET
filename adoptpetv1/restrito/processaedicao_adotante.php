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
    $sexo = $_POST['sexo'];
    $endereco = $_POST['endereco'];
    $quantpets = $_POST['quantpets'];
    $datanasc = $_POST['datanasc'];

    // Preparar a consulta SQL
    $sql = "UPDATE adotante SET nome = '$nome', telefone = '$telefone', sexo = '$sexo', endereco = '$endereco', quantpets = '$quantpets', datanasc = '$datanasc' WHERE CPF = '$id'";

    // Executar a consulta
    if ($conn = mysqli_query($conn, $sql)) {
        // Redireciona para a página de pesquisa de adotantes
        header('Location: pesquisa_adotante.php');
        exit(); // Encerra o script para garantir que o redirecionamento seja feito corretamente
    } else {
        // Exibe uma mensagem de erro
        mensagem("$nome Erro! Não alterado!", 'danger');
    }
}
?>
