<?php

session_start();
if(!isset($_SESSION['usuario'])){
    header("Location:../inicio_sesion.php");
}
else{
    if($_SESSION['usuario']=="ok"){
        $nombreUsuario=$_SESSION["nombreUsuario"];
    }
}

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php if($url=="http://localhost/ProyectoIngenieriaSoftware/admin/inicio_admin.php"){echo "Inicio";}?>
        <?php if($url=="http://localhost/ProyectoIngenieriaSoftware/admin/menu_inicio.php"){echo "Menú inicio";}?>
        <?php if($url=="http://localhost/ProyectoIngenieriaSoftware/admin/menu_quienes_somos.php"){echo "Menú quiénes somos";}?>
        <?php if($url=="http://localhost/ProyectoIngenieriaSoftware/admin/menu_carrusel.php"){echo "Menú carrusel";}?>
        <?php if($url=="http://localhost/ProyectoIngenieriaSoftware/admin/menu_preguntas_frecuentes.php"){echo "Menú preguntas frecuentes";}?>
        <?php if($url=="http://localhost/ProyectoIngenieriaSoftware/admin/menu_productos.php"){echo "Menú productos";}?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <style>
        body {
            /* background-image: url('https://i.pinimg.com/originals/da/7d/35/da7d355e9d3453c9fc63dbfafdeec17b.jpg'); */
            background-image: url('https://e1.pxfuel.com/desktop-wallpaper/581/154/desktop-wallpaper-backgrounds-for-login-page-login-page.jpg');
            backdrop-filter: blur(15px);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            <?php if($url=="http://localhost/ProyectoIngenieriaSoftware/admin/inicio_admin.php"){echo "height: 100vh;";}?>
            /* width: 100%; */
        }
    </style>
</head>


<body>
    <div class="row m-2">
        <div class="col-lg-2 col-12">
            <div class="card m-1 p-3 text-bg-dark">
                <span class="fs-4 text-center">Sistema</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="inicio_admin.php" class="nav-link text-white <?php if($url=="http://localhost/ProyectoIngenieriaSoftware/admin/inicio_admin.php"){echo "active";}?>">
                        Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="menu_inicio.php" class="nav-link text-white <?php if($url=="http://localhost/ProyectoIngenieriaSoftware/admin/menu_inicio.php"){echo "active";}?>">
                        Menú inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="menu_quienes_somos.php" class="nav-link text-white <?php if($url=="http://localhost/ProyectoIngenieriaSoftware/admin/menu_quienes_somos.php"){echo "active";}?>">
                        Menú quiénes somos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="menu_carrusel.php" class="nav-link text-white <?php if($url=="http://localhost/ProyectoIngenieriaSoftware/admin/menu_carrusel.php"){echo "active";}?>">
                        Menú carrusel
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="menu_preguntas_frecuentes.php" class="nav-link text-white <?php if($url=="http://localhost/ProyectoIngenieriaSoftware/admin/menu_preguntas_frecuentes.php"){echo "active";}?>">
                        Menú preguntas frecuentes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="menu_productos.php" class="nav-link text-white <?php if($url=="http://localhost/ProyectoIngenieriaSoftware/admin/menu_productos.php"){echo "active";}?>">
                        Menú productos
                        </a>
                    </li>
                    
                </ul>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="salir.php" class="nav-link text-white bg-danger">
                        Cerrar sesión y salir
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <script src="../../src/sidebars.js"></script>
        <div class="col-md col-12">
            <div class="card m-1 p-3">
