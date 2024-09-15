
<?php
$server = "localhost"; 
$user = "root";
$pass = "";
$bd = "adoptpetv1";


// Cria conexão
if( $conn = mysqli_connect($server, $user, $pass, $bd) ){
    //echo "Conexão realizada com sucesso! ";
} else 
    echo "Erro ao conectar! ";
    function mensagem($texto, $tipo) {
        echo "<div class='alert alert-$tipo' role='alert'>
            $texto
            </div>";
    }

    function mostra_data($datanasc) {
        $d = explode('-', $datanasc);
        $escreve = $d[2] . "/" . $d[1] . "/" . $d[0];
        return $escreve;
    }

?>