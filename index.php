<?php include('template/header.php'); ?>

<?php

include("./admin/config/bd.php");

$sentenciaSQL = $conexion->prepare("SELECT MIN(POSICION_IMG) AS firstPos FROM IMAGEN_CARRUSEL WHERE MOSTRAR_IMG_CARRUSEL=1");
$sentenciaSQL->execute();
$resultado = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);
$firstPos = $resultado['firstPos'];

$sentenciaSQL= $conexion->prepare("SELECT * FROM IMAGEN_CARRUSEL ORDER BY POSICION_IMG");
$sentenciaSQL->execute();
$listaImagenes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL = $conexion->prepare("SELECT * FROM INICIO ORDER BY POSICION");
$sentenciaSQL->execute();
$listaInicio = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="">


    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner img-carrusel carousel-centrar shadow position-relative">

        <!-- ACÁ DEBEMOS PONER EL PHP CODE -->
        <?php foreach($listaImagenes as $link_imagen) { if($link_imagen['MOSTRAR_IMG_CARRUSEL']==1){?>
            <div class= "<?php if($link_imagen['POSICION_IMG']==$firstPos){echo "carousel-item active shadow"; $firstPos=0;}else{echo "carousel-item shadow";}?>">
                <img src="<?php echo $link_imagen['IMAGEN_CARRUSEL'] ?>" class="d-block w-100" alt="...">
            </div>
        <?php } } ?>

        <div class="position-absolute top-50 start-50 translate-middle">
            <a class="btn btn-warning border-dark shadow" href="./productos.php">Ver más diseños aquí</a>
        </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

 </div>

<div class="container">
    <div class="card p-3 m-5 shadow">
        <h1 class="title">Inicio</h1>
        <hr>
        <?php foreach($listaInicio as $inicio){ ?>

            <?php if($inicio['TIPO_TEXTO']==1){ ?><h1><?php echo $inicio['TEXTO'];}?></h1>
            <?php if($inicio['TIPO_TEXTO']==2){ ?><p><?php echo $inicio['TEXTO'];}?></p>

        <?php } ?>
    </div>
</div>

<script>
    const carousel = new bootstrap.Carousel('#carouselExample')
</script>

<?php include('template/footer.php'); ?>