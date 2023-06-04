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

<div class="box m-5">
    <h1 class="title">Preguntas frecuentes</h1>
    <hr>
    <p1>hola Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo id iure, quam fuga illum iusto optio neque deserunt tempora distinctio eum corrupti? Ratione fugiat maxime atque harum aliquam unde! Et. hola</p1>

    <div class="accordion" id="accordionPanelsStayOpenExample">
        <?php foreach ($listaPreguntas as $pregunta) { if($pregunta['MOSTRAR_PREGUNTA']==1){?>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?php echo $pregunta['ID_PREGUNTA'] ?>" aria-expanded="false" aria-controls="panelsStayOpen-collapse<?php echo $pregunta['ID_PREGUNTA'] ?>">
                <?php echo $pregunta['TITULO_PREGUNTA'] ?>
                </button>
                </h2>
                <div id="panelsStayOpen-collapse<?php echo $pregunta['ID_PREGUNTA'] ?>" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <?php echo $pregunta['DESCRIPCION_PREGUNTA'] ?>
                    </div>
                </div>
            </div>
        <?php } } ?>
    </div>

<script>
    
</script>


</div>

<?php include('template/footer.php'); ?>