<?php

    session_start();

    include("./admin/config/bd.php");

    $sentenciaSQL= $conexion->prepare("SELECT * FROM credenciales");
    $sentenciaSQL->execute();
    $listaCredenciales=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

    foreach ($listaCredenciales as $credencial)

    // $username = $_POST['usuario'];
    // $contrasenia = $_POST['contrasenia'];


    if($_POST){
        if($_POST){
            if($_POST['usuario']<>$credencial['usuario'] && $_POST['contrasenia']<>$credencial['contrasenia']){ //Verificamos inicio de sesión
                
            }
            else{
                $_SESSION['usuario'] = "ok";
                $_SESSION['nombreUsuario'] = "usuario";
                header('Location: ./admin/inicio_admin.php');
            }
            
        }
        else {
            $mensaje = "Usuario y/o contraseña incorrectos";
            echo $mensaje;
        }
    }

    $username = "";
    $contrasenia = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css"> -->
</head>
<body>
    
    <div class="container">
        <div class="columns m-6">
            <form method="post" class="box column is-4 is-offset-4" >
                <h1 class="title has-text-centered">Bienvenido!</h1>
                <div class="container has-text-centered">
                    <p1 class="">Ingrese sus credenciales para iniciar sesión en el sistema</p1>
                </div>
                
                <div class="field">
                    <label class="label">Usuario</label>
                    <div class="control">
                    <input class="input" type="text" placeholder="Usuario" name="usuario">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Contraseña</label>
                    <div class="control">
                        <input class="input" type="password" placeholder="Contraseña" name="contrasenia">
                    </div>
                </div>
                <div class="column is-centered is-offset-4">
                    <button class="button is-primary">Inciar sesión</button>
                </div>
                
            </form>
        </div>
        
    </div>

</body>
</html>