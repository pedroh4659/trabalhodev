<?php
// Variáveis de conexão
$servername = "localhost";
$username = "root";
$password = '';
$dbname = "trabalho";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "conectado";

// Variáveis para inserir na tabela
$endereco = $_POST['endereco'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$valor = $_POST['valor'];
$numquartos = $_POST['numquartos'];
$numbanheiros = $_POST['numbanheiros'];
$area = $_POST['area'];
$garagem = $_POST['garagem'];
$vendaluguel = $_POST['vendaluguel'];
$descricao = $_POST['descricao'];

$inserir_casa = "insert into casa (endereco, estado, cidade, preco, area, numbanheiros, numquartos, garagem, vendaluguel, descricao) VALUES('$endereco', '$estado', '$cidade', $valor, $area, $numbanheiros, $numquartos, $garagem, $vendaluguel, '$descricao')";

// Inserir imagem
//$target_dir = "img/";
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//$uploadOk = 1;
//$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


if ($conn->query($inserir_casa) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $inserir_casa . "<br>" . $conn->error;
}

$conn->close();

?>