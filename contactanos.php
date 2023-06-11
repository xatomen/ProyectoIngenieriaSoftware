<?php include('template/header.php'); ?>

<div class="container">
    <div class="card p-5 m-5 shadow">
        <h1 class="title font-pacifico">Contáctanos</h1>
        <hr>
        <p1 class="font-familjen-grotesk fs-4 text-justify">hola Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo id iure, quam fuga illum iusto optio neque deserunt tempora distinctio eum corrupti? Ratione fugiat maxime atque harum aliquam unde! Et. hola</p1>
        
        <div class="row">
            <h2 class="text-center">Formulario de contacto</h2>

            <div class="col-2"></div>

            <div class="col">
                <div class="card p-3 shadow">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Apellido">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Número telefónico</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="+569XXXXXXXX">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Escriba el mensaje</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">Enviar</button>
                    </div>
                </div>
            </div>

            <div class="col-2"></div>

        </div>

    </div>

</div>

<?php include('template/footer.php'); ?>