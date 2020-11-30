<?php
// Variáveis de conexão
$servername = "localhost";
$username = "root";
$password = '';
$dbname = "trabalho";

$conn = new mysqli($servername, $username, $password, $dbname);

$busca = $_POST['busca'];

$query_search = "SELECT * FROM casa WHERE cidade like '%$busca%' OR estado like '%$busca%' OR endereco like '%$busca%'";
$retorno = $conn->query($query_search);

if ($retorno->num_rows > 0) {
    while($row = $retorno->fetch_assoc()) {
        $endereco = $row["endereco"];
        $estado = $row["estado"];
        $cidade = $row["cidade"];
        $area = $row["area"];
        $preco = $row["preco"];
        $numero = $row["numero"];
        $numquartos = $row["numquartos"];
        $numbanheiros = $row["numbanheiros"];
        $descricao = $row["descricao"];
        if ($row["garagem"] == 1) {
            $garagem = "Sim";
        } else {
            $garagem = "Não";
        }
        if ($row["vendaluguel"] == 1) {
            $vendaluguel = "Aluguel";
        } else {
            $vendaluguel = "Venda";
        }
        $mapa_pesquisa = $row["endereco"] . " " . $row["cidade"] . " " . $row["estado"];
    }
} else {
    header("Location: ../index.html", true, 302);
    echo "Página não encontrada.";
}
$conn->close();
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Renan Imóveis</title>
    <link rel="icon" href="../img/logo.png">
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
            <li class="nav-item">
              <a class="nav-link" href="cadastro.html">Anuncie seu imóvel</a>
            </li>
          </ul>
      </div>
    </nav>
    <div id="map"></div>
    <script>
      var geocoder;
var map;
var address = '<?php echo $mapa_pesquisa; ?>';
alert(address)

function initMap() {
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: -27.4317603, lng: -48.4610482 },
    zoom: 12,
    styles: [
      { elementType: "geometry", stylers: [{ color: "#242f3e" }] },
      { elementType: "labels.text.stroke", stylers: [{ color: "#242f3e" }] },
      { elementType: "labels.text.fill", stylers: [{ color: "#746855" }] },
      {
        featureType: "administrative.locality",
        elementType: "labels.text.fill",
        stylers: [{ color: "#d59563" }]
      },
      {
        featureType: "poi",
        elementType: "labels.text.fill",
        stylers: [{ color: "#d59563" }]
      },
      {
        featureType: "poi.park",
        elementType: "geometry",
        stylers: [{ color: "#263c3f" }]
      },
      {
        featureType: "poi.park",
        elementType: "labels.text.fill",
        stylers: [{ color: "#6b9a76" }]
      },
      {
        featureType: "road",
        elementType: "geometry",
        stylers: [{ color: "#38414e" }]
      },
      {
        featureType: "road",
        elementType: "geometry.stroke",
        stylers: [{ color: "#212a37" }]
      },
      {
        featureType: "road",
        elementType: "labels.text.fill",
        stylers: [{ color: "#9ca5b3" }]
      },
      {
        featureType: "road.highway",
        elementType: "geometry",
        stylers: [{ color: "#746855" }]
      },
      {
        featureType: "road.highway",
        elementType: "geometry.stroke",
        stylers: [{ color: "#1f2835" }]
      },
      {
        featureType: "road.highway",
        elementType: "labels.text.fill",
        stylers: [{ color: "#f3d19c" }]
      },
      {
        featureType: "transit",
        elementType: "geometry",
        stylers: [{ color: "#2f3948" }]
      },
      {
        featureType: "transit.station",
        elementType: "labels.text.fill",
        stylers: [{ color: "#d59563" }]
      },
      {
        featureType: "water",
        elementType: "geometry",
        stylers: [{ color: "#17263c" }]
      },
      {
        featureType: "water",
        elementType: "labels.text.fill",
        stylers: [{ color: "#515c6d" }]
      },
      {
        featureType: "water",
        elementType: "labels.text.stroke",
        stylers: [{ color: "#17263c" }]
      }
    ]
  });
  geocoder = new google.maps.Geocoder();
  codeAddress(geocoder, map);

}

      function codeAddress(geocoder, map) {
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
    </script>
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAb5exhyBG7redyEvDWZH4Zow2u6jTXDN4&callback=initMap"></script>
   
    <div class="card border-dark text-white" style="width: 25%; float: left; padding-top: 35px">
      <div class="card-body bg-dark">
        <h3>Casa encontrada!</h3>
        <hr>
        <h6><?php echo $cidade ?>, <?php echo $estado ?>, <?php echo $endereco ?> <?php echo $numero ?></h6>
        <br>
        <h5>Valor: R$<?php echo $preco ?></h5> 
        <br>
        <p><?php echo $numquartos?> Quartos e <?php echo $numbanheiros?> Banheiros</p>
        <br>
        <p> <?php echo $area?> m²</p>
        <p><?php echo $descricao ?></p>
      </div>
    </div>
  </body>
</html>
