<?php
date_default_timezone_set('America/Sao_Paulo');
?>

<?php
session_start();
?>
<?php
header('Content-Type: application/json');

if (!isset($_SESSION['adotante_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Você precisa estar logado para adotar um pet.']);
    exit();
}

include 'conexao.php';

$response = ['status' => 'error', 'message' => 'Erro desconhecido'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $CODpet = $_POST['CODpet'];
    $adotante_id = $_SESSION['adotante_id']; // CPF do adotante logado

    // Verificar o status atual do pet
    $sql_status = "SELECT statuspet FROM pet WHERE CODpet = '$CODpet'";
    $result = mysqli_query($conn, $sql_status);
    $pet = mysqli_fetch_assoc($result);

    if ($pet['statuspet'] === 'adotado') {
        $response = ['status' => 'error', 'message' => 'Este pet já foi adotado!'];
    } else {
        // Começar uma transação para garantir a integridade dos dados
        mysqli_begin_transaction($conn);

        try {
            // Atualizar a tabela de pets para definir o status como adotado
            $sql_pet = "UPDATE pet SET statuspet = 'adotado' WHERE CODpet = '$CODpet'";
            if (!mysqli_query($conn, $sql_pet)) {
                throw new Exception("Erro ao atualizar pet");
            }

            // Atualizar a quantidade de pets no cadastro do adotante
            $sql_adotante = "UPDATE adotante SET quantpets = quantpets + 1 WHERE CPF = '$adotante_id'";
            if (!mysqli_query($conn, $sql_adotante)) {
                throw new Exception("Erro ao atualizar adotante");
            }

            // Inserir o registro na tabela adocao
            $dataadocao = date('Y-m-d'); // Obter a data atual
            $sql_adocao = "INSERT INTO adocao (status, dataadocao, CPFadotante, CODpet) 
                           VALUES ('ativo', '$dataadocao', '$adotante_id', '$CODpet')";
            if (!mysqli_query($conn, $sql_adocao)) {
                throw new Exception("Erro ao inserir adoção");
            }

            // Commit da transação
            mysqli_commit($conn);
            $response = ['status' => 'success', 'message' => 'Pet adotado com sucesso!'];

        } catch (Exception $e) {
            // Rollback da transação em caso de erro
            mysqli_rollback($conn);
            $response = ['status' => 'error', 'message' => 'Erro ao adotar o pet: ' . $e->getMessage()];
        }
    }

    mysqli_close($conn);
}

echo json_encode($response);
?>
