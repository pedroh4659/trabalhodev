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
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Renan Imóveis</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Playfair+Display+SC:ital@1&display=swap" rel="stylesheet">  
    </head>

  <body class="bg-dark">
    
    <nav class="navbar navbar-expand-lg navbar-dark shadow fixed-top" style="background-color: #1b262c">
      <div class="container">
        <a class="navbar-brand" href="../index.html">Renan Imóveis</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="../index.html">Home</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">Busca
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Sobre</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cadastro.html">Anuncie seu imóvel</a>
            </li>
          </ul>
      </div>
    </nav>
    <div id="map"></div>
    <script src="../js/script.js"></script>
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAb5exhyBG7redyEvDWZH4Zow2u6jTXDN4&callback=initMap"></script>
   
    <div class="card border-dark text-white" style="width: 25%; float: left; height: 100%;">
      <div class="card-body bg-dark">
        <form action="../php/search.php" method="GET"></form>
        <p> Endereço: <?php echo $endereco ?></p>
      </div>
    </div>
  </body>
</html>