<?php
session_start();
include "conexao.php";

$CODpet = $_GET['CODpet'] ?? '';

if ($CODpet) {
    $sql = "DELETE FROM pet WHERE CODpet='$CODpet'";
    mysqli_query($conn, $sql);
}

header("Location: pesquisa_pet.php");
exit();
?>

<?php
date_default_timezone_set('America/Sao_Paulo');
?>