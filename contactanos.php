<?php include('template/header.php'); ?>

<script src="https://challenges.cloudflare.com/turnstile/v0/api.js?onload=_turnstileCb" async defer></script>

<div class="container">
    <div class="card p-sm-5 p-3 m-5 shadow">
        <h1 class="title font-pacifico">Contáctanos</h1>
        <hr>
        <p1 class="font-familjen-grotesk fs-4 text-justify">A continuación tienes a disposición un formulario de contacto para enviarnos tus consultas, sugerencias, reclamos, cotizaciones, etc.</p1>
        
        <div class="row">
            <h2 class="text-center">Formulario de contacto</h2>

            <div class="col-xl-2"></div>
            <form action="enviar.php" method="POST">
                <div class="col-sm-12">
                    <div class="card p-3 shadow">
                        <?php if(isset($alerta)){ ?>
                            <div class="alert alert-success text-center" role="alert">
                        <?php } ?>
                        <div class="row">
                            <div class="col-sm col-12">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                                    <!-- <form method="POST"> -->
                                        <input type="text" class="form-control" name="nombre" placeholder="Nombre">
                                    <!-- </form> -->
                                    
                                </div>
                            </div>
                            <div class="col-sm col-12">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Apellido</label>
                                    <!-- <form method="POST"> -->
                                        <input type="text" class="form-control" name="apellido" placeholder="Apellido">
                                    <!-- </form> -->
                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm col-12">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Correo</label>
                                    <!-- <form method="POST"> -->
                                        <input type="email" class="form-control" name="correo" placeholder="name@example.com">
                                    <!-- </form> -->
                                    
                                </div>
                            </div>
                            <div class="col-sm col-12">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Número telefónico</label>
                                    <!-- <form method="POST"> -->
                                        <input type="text" class="form-control" name="telefono" placeholder="+569XXXXXXXX">
                                    <!-- </form> -->
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <!-- <input type="text" maxlength="150"/> -->
                            <label for="exampleFormControlTextarea1" class="form-label">Escriba el mensaje</label>
                            <!-- <form method="POST"> -->
                                <textarea class="form-control" rows="3" maxlength="1500" name="mensaje" id="mensaje"></textarea> 
                            <!-- </form> -->
                            
                            <div id="contador">(0/1500)</div>
                        </div>
                        <div class="text-center checkbox mb-3">
                        <!-- The Turnstile widget will be injected in the following div. -->
                        <div id="myWidget"></div>
                        <!-- end. -->
                        </div>
                        <div class="text-center">
                            <!-- <form method="POST"> -->
                                <button class="btn btn-primary" type="submit">Enviar</button>    
                            <!-- </form> -->
                            
                        </div>
                    </div>
                </div>
            </form>
            

            <script>
                const mensaje = document.getElementById('mensaje');
                console.log(mensaje);
                const contador = document.getElementById('contador');
                mensaje.addEventListener('input', function(e) {
                    const target = e.target;
                    const longitudMax = target.getAttribute('maxlength');
                    const longitudAct = target.value.length;
                    contador.innerHTML = `(${longitudAct}/${longitudMax})`;
                });
            </script>

            <div class="col-xl-2"></div>

            <script>

                function _turnstileCb() {
                    console.debug('_turnstileCb called');

                    turnstile.render('#myWidget', {
                    sitekey: '0x4AAAAAAAHJNJgNxYGfN5G4',
                    theme: 'light',
                    });
                }

            </script>            

        </div>


    </div>

</div>

<?php include('template/footer.php'); ?>