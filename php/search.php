<?php
// Variáveis de conexão
$servername = "localhost";
$username = "root";
$password = '';
$dbname = "trabalho";

$conn = new mysqli($servername, $username, $password, $dbname);

$busca = $_POST['busca'];

$query_search = "SELECT * FROM casa where id=$busca";
$retorno = $conn->query($query_search);

if ($retorno->num_rows > 0) {
    while($row = $retorno->fetch_assoc()) {
        $endereco = $row["endereco"];
    }
} else {
    echo "Nenhum resultado encontrado.";
}
$conn->close();

?>

<html>
    <p><?php echo $endereco ?></p>
</html>