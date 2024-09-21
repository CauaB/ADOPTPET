<?php
session_start();
session_destroy();
header("Location: ../index.php"); // Redireciona para a página inicial
exit;
?>
