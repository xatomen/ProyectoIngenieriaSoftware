<?php include('template/header.php'); ?>

<?php

include("./admin/config/bd.php");

$sentenciaSQL = $conexion->prepare("SELECT MIN(POSICION_PREGUNTA) AS firstPos FROM PREGUNTAS_FRECUENTES WHERE MOSTRAR_PREGUNTA=1");
$sentenciaSQL->execute();
$resultado = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);
$firstPos = $resultado['firstPos'];

$sentenciaSQL= $conexion->prepare("SELECT * FROM PREGUNTAS_FRECUENTES ORDER BY POSICION_PREGUNTA");
$sentenciaSQL->execute();
$listaPreguntas=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container">
    <div class="card p-sm-5 p-3 m-5 shadow">
        <h1 class="title font-pacifico">Preguntas frecuentes</h1>
        <hr>
        <p1 class="font-familjen-grotesk fs-4 text-justify">A continuación podrás encontrar las preguntas frecuentes realizadas por nuestros clientes, para que no quedes con ninguna duda.</p1>
        <p1 class="font-familjen-grotesk fs-4 text-justify">En caso de tener alguna duda o querer cotizar con nosotros, no olvides contactarnos mediante el formulario de contacto el la sección de contáctanos.</p1>
        <br>
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <?php foreach ($listaPreguntas as $pregunta) { if($pregunta['MOSTRAR_PREGUNTA']==1){?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed font-ubuntu-condensed fs-3" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?php echo $pregunta['ID_PREGUNTA'] ?>" aria-expanded="false" aria-controls="panelsStayOpen-collapse<?php echo $pregunta['ID_PREGUNTA'] ?>">
                    <?php echo $pregunta['TITULO_PREGUNTA'] ?>
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapse<?php echo $pregunta['ID_PREGUNTA'] ?>" class="accordion-collapse collapse">
                        <div class="accordion-body text-justify font-ubuntu-condensed fs-5">
                            <?php echo $pregunta['DESCRIPCION_PREGUNTA'] ?>
                        </div>
                    </div>
                </div>
            <?php } } ?>
        </div>
    </div>
    

<script>
    
</script>


</div>

<?php include('template/footer.php'); ?>