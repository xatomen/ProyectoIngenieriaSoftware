<?php

    session_start();

    include("./admin/config/bd.php");

    $sentenciaSQL= $conexion->prepare("SELECT * FROM credenciales, administrador WHERE credenciales.ID_USUARIO = administrador.ID_USUARIO");
    $sentenciaSQL->execute();
    $listaCredenciales=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

foreach ($listaCredenciales as $credencial){

    $username = "";
    $contrasenia = "";

    if($_POST){
        if($_POST){
            if(($_POST['usuario']==$credencial['USUARIO']) && ($_POST['password']==$credencial['PASSWORD'])){ //Verificamos inicio de sesión
                $_SESSION['usuario'] = "ok";
                $_SESSION['nombreUsuario'] = $credencial['USUARIO'];
                header('Location: ./admin/inicio_admin.php');
            }
            else{
                $mensaje = "Usuario y/o contraseña incorrectos";
            }
            
        }
        else {
            $mensaje = "Usuario y/o contraseña incorrectos";
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="https://i.postimg.cc/NFZSV9cP/individuales-bethel-2.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css"> -->
    <style>
        body{
            background-image: url('https://e1.pxfuel.com/desktop-wallpaper/581/154/desktop-wallpaper-backgrounds-for-login-page-login-page.jpg');
            backdrop-filter: blur(15px);
            background-position: bottom;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
            width: 100%;
        }
    </style>
    <!-- <script src="https://challenges.cloudflare.com/turnstile/v0/api.js?onload=onloadTurnstileCallback" defer></script> -->
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js?onload=_turnstileCb" async defer></script>
</head>
<body>
    <div class="container mt-5 mb-5">

        <div class="row">
            
            <div class="col"></div>

            <div class="col-8 card shadow">
                <div class="row">

                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <img class="img-fluid" src="https://static.vecteezy.com/system/resources/previews/005/637/993/original/man-making-work-concept-in-front-of-computer-with-tutorial-free-vector.jpg">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 p-2">
                        <form method="post">
                            <div class="container text-center">
                                <h1>Bienvenido!</h1>
                                <p1>Ingrese sus credenciales para iniciar sesión</p1>
                                <hr>
                            </div>
                            <div class="mb-3">
                                <?php if(isset($mensaje)) {?>
                                    <div class="alert alert-danger text-center" role="alert">
                                        <?php echo $mensaje; ?>
                                    </div>
                                <?php } ?>
                                <label for="exampleInputEmail1" class="form-label">Usuario</label>
                                <input name="usuario" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                                <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="checkbox mb-3">
                            <!-- The Turnstile widget will be injected in the following div. -->
                            <div id="myWidget"></div>
                            <!-- end. -->
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Ingresar</button>
                                <a class="btn btn-info" href="index.php">Ir al inicio</a>
                            </div>
                            
                        </form>
                    </div>     

                </div>
                
            </div>
            <div class="col"></div>
        </div>
    </div>

    <script>
//         window.onloadTurnstileCallback = function () {
//             alert("Listo");
//             turnstile.render('#example-container', {
//             sitekey: '0x4AAAAAAAHJNJgNxYGfN5G4',
//             callback: function(token) {
//                 alert("Listo");
//                 console.log(`Challenge Success ${token}`);
//             },
//         });
// };

function _turnstileCb() {
    console.debug('_turnstileCb called');

    turnstile.render('#myWidget', {
      sitekey: '0x4AAAAAAAHJNJgNxYGfN5G4',
      theme: 'light',
    });
}

    </script>

</body>
</html>