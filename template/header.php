
<?php
$uri = $_SERVER['REQUEST_URI'];
// echo $uri; // Outputs: URI
 
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
 
$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
// echo $url; // Outputs: Full URL
 
$query = $_SERVER['QUERY_STRING'];
// echo $query; // Outputs: Query String
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <style>
        body {
        background-color: rgb(0,0,0,0.1);
        }
        .bg-light{
            background-color: transparent !important;
        }
        .trn {
            background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5));
            z-index: 99;
        }
        .img-carrusel {
            max-height:800px; /* Ajusta aquí la altura máxima deseada */
            object-fit: contain;
        }
        .carousel-centrar{
            display:flex;
            align-items:center;
        }
    </style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark <?php if($url=="http://localhost/ProyectoIngenieriaSoftware/index.php"){echo "fixed-top bg-ligth trn";} else{echo "sitcky-top bg-ligth trn";}?>">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img src="https://i.postimg.cc/HshmbPXn/individuales-bethel-2.png" style="width:100px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <div class="justify-content-end">
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="quienes_somos.php">Quienes somos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="productos.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="preguntas_frecuentes.php">Preguntas frencuentes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contactanos.php">Contáctanos</a>
                </li>
            </ul>
        </div>
      
    </div>
  </div>
</nav>

<div class="">
    <!-- <div class="m-5 card shadow p-3 bg-body-tertiary rounded"> -->
    <div class="">