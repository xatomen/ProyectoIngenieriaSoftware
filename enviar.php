<?php
                // echo "hola";
                // print_r($_POST);
                // echo $_POST['enviar'];
                if(isset($_POST['correo'])){
                    // echo $_POST['nombre'];
                    if(!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['correo']) && !empty($_POST['telefono']) && !empty($_POST['mensaje'])){
                    // if(1){
                        $nombre = $_POST['nombre'];
                        $apellido = $_POST['apellido'];
                        $correo = $_POST['correo'];
                        $telefono = $_POST['telefono'];
                        $mensaje = $_POST['mensaje'];
                        $asunto = "Contacto";
                        $header = "From: noreply@individualesbethel.infinityfreeapp.com" . "\r\n";
                        $header.= "Reply-to: " . $correo . "\r\n";
                        $header.= "X-Mailer: PHP/". phpversion();
                        $alerta = "¡Mensaje enviado satisfactoriamente!";
                        $MensajeFinal = "Nombre: " . $nombre . "\n" . "Apellido: " . $apellido . "\n" . "Correo: ". $correo . "\n" . "Telefono: " . $telefono . "\n" . "Mensaje: \n" . $mensaje;
                        // echo $alerta;
                        $CorreoEmpresarial = "contactanos@individualesbethel.infinityfreeapp.com";
                        $mail = mail($CorreoEmpresarial,$asunto,$MensajeFinal,$header);
                        
                        $asunto2 = "Copia mensaje - Individuales Bethel";
                        $header = "From: noreply@individualesbethel.infinityfreeapp.com" . "\r\n";
                        $header.= "Reply-to: contactanos@individualesbethel.infinityfreeapp.com" . "\r\n";
                        $header.= "X-Mailer: PHP/". phpversion();
                        $mail2 = mail($correo,$asunto2,$MensajeFinal,$header);
                        // echo $mail;
                        if($mail){
                            $alerta = "¡Mensaje enviado satisfactoriamente! Recibirás una copia del mensaje en el correo proporcionado (Si no aparece, recuerda revisar en spam)";
                        }
                        // header("Location:../contactanos.php");
                        // exit();
                    }
                    else{
                        // echo "error";
                        $error = "Se ha producido un error, verifique sus datos e inténtelo nuevamente";
                    }
                }
?>

<?php
    include("./template/header.php");
?>

<div class="container">
    <div class="card p-sm-5 p-3 m-5 shadow">
        <h1 class="title font-pacifico">Contáctanos</h1>
        <hr>
        <p1 class="font-familjen-grotesk fs-4 text-justify">A continuación tienes a disposición un formulario de contacto para enviarnos tus consultas, sugerencias, reclamos, cotizaciones, etc.</p1>
        
        <div class="row">
            <h2 class="text-center">Formulario de contacto</h2>

            <div class="col-xl-2"></div>

                    <div class="card p-3 shadow text-center">
                        <?php if(isset($alerta)){ ?>
                            <div class="alert alert-success text-center" role="alert"><?php echo $alerta; ?></div>
                        <?php } ?>
                        <?php if(isset($error)){ ?>
                            <div class="alert alert-danger text-center" role="alert"><?php echo $error; ?></div>
                        <?php } ?>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-4">
                                <a class="btn btn-primary" href="https://individualesbethel.000webhostapp.com/index.php">Volver al inicio</a>
                            </div>
                            <div class="col"></div>
                        </div>
                        
                        
                    </div>
         
            <div class="col-xl-2"></div>

        </div>


    </div>

</div>

<?php
    include("./template/footer.php");
?>