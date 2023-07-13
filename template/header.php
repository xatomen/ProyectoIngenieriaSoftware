
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
    <title>
        <?php
            if($url=="http://localhost/ProyectoIngenieriaSoftware/index.php"){echo "Inicio";}
            else{
                if($url=="http://localhost/ProyectoIngenieriaSoftware/quienes_somos.php"){echo "Quiénes somos";}
                else{
                    if($url=="http://localhost/ProyectoIngenieriaSoftware/productos.php"){echo "Productos";}
                    else{
                        if($url=="http://localhost/ProyectoIngenieriaSoftware/preguntas_frecuentes.php"){echo "Preguntas frecuentes";}
                        else{
                            if($url=="http://localhost/ProyectoIngenieriaSoftware/contactanos.php"){echo "Contáctanos";}
                            else{echo "Detalle producto";}
                        }
                    }
                }
            }
        ?>
    </title>
    <link rel="shortcut icon" href="https://i.postimg.cc/NFZSV9cP/individuales-bethel-2.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9ec646ac25.js" crossorigin="anonymous"></script>

    <!-- <script src="../src/max_length_input.js"></script> -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Familjen+Grotesk&family=Indie+Flower&family=Kalam:wght@300;400&family=Pacifico&family=Ubuntu+Condensed&display=swap" rel="stylesheet">

    <style>
        body {
            /* background-color: rgb(0,0,0,0.1); */
            /* background-image: linear-gradient(to right,rgba(75, 27, 222, 0.5),rgba(54, 0, 214, 0.82)); */
            background: linear-gradient(
                43deg,
                rgba(163, 135, 113, 0.42) 0%,
                rgba(145, 189, 204, 0.29) 100%
            );
            background-blend-mode: normal;
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
        .font-pacifico {
            font-family: 'Pacifico', cursive;
        }
        .font-courgette{
            font-family: 'Courgette', cursive;
        }
        .font-familjen-grotesk{
            font-family: 'Familjen Grotesk', sans-serif;
        }
        .font-indie-flower{
            font-family: 'Indie Flower', cursive;
        }
        .font-kalam{
            font-family: 'Kalan', cursive;
        }
        .font-ubuntu-condensed{
            font-family: 'Ubuntu Condensed', sans-serif;
        }
        .text-justify{
            text-align: justify;
        }
    </style>

</head>
<body>

<nav class="navbar navbar-expand-lg <?php if($url=="http://localhost/ProyectoIngenieriaSoftware/index.php"){echo "navbar-dark fixed-top bg-light trn";} else{echo "sitcky-top navbar-light";}?>" style="<?php if($url!="http://localhost/ProyectoIngenieriaSoftware/index.php"){echo "background-color: white";}?>">
  <div class="container-fluid">
    <!-- <a class="navbar-brand" href="index.php"><img src="https://i.postimg.cc/HshmbPXn/individuales-bethel-2.png" style="width:100px;"></a> -->
    <a class="navbar-brand" href="index.php"><img src="https://i.postimg.cc/NFZSV9cP/individuales-bethel-2.png" style="width:100px;"></a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <div class="justify-content-end">
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link <?php if($url=="http://localhost/ProyectoIngenieriaSoftware/index.php"){echo "active";}?>" aria-current="page" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($url=="http://localhost/ProyectoIngenieriaSoftware/quienes_somos.php"){echo "active";}?>" href="quienes_somos.php">Quiénes somos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($url=="http://localhost/ProyectoIngenieriaSoftware/productos.php"){echo "active";}?>" href="productos.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($url=="http://localhost/ProyectoIngenieriaSoftware/preguntas_frecuentes.php"){echo "active";}?>" href="preguntas_frecuentes.php">Preguntas frencuentes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($url=="http://localhost/ProyectoIngenieriaSoftware/contactanos.php"){echo "active";}?>" href="contactanos.php">Contáctanos</a>
                </li>
            </ul>
        </div>
    </div>
  </div>
</nav>

<div class="">
    <!-- <div class="m-5 card shadow p-3 bg-body-tertiary rounded"> -->
    <div class="">