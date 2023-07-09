<?php include('template/header.php'); ?>

<?php

include("./admin/config/bd.php");

$sentenciaSQL = $conexion->prepare("SELECT MIN(POSICION_IMG) AS firstPos FROM imagen_carrusel WHERE MOSTRAR_IMG_CARRUSEL=1");
$sentenciaSQL->execute();
$resultado = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);
$firstPos = $resultado['firstPos'];

$sentenciaSQL= $conexion->prepare("SELECT * FROM imagen_carrusel ORDER BY POSICION_IMG");
$sentenciaSQL->execute();
$listaImagenes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL = $conexion->prepare("SELECT * FROM inicio ORDER BY POSICION");
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
            <a class="btn bg-warning p-4 rounded-pill bg-opacity-75 text-black border-dark shadow font-indie-flower fs-4" href="./productos.php">Ver más diseños aquí</a>
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
    <div class="card p-sm-5 p-3 m-5 shadow">
        <!-- <h1 class="title">Inicio</h1>
        <hr> -->
        <?php foreach($listaInicio as $inicio){ if($inicio['MOSTRAR']==1){?>

            <?php if($inicio['TIPO_TEXTO']==1){ ?>
                <div class="row">
                    <div class="col"><h1 class="font-pacifico"><?php echo $inicio['TEXTO'];?></h1></div>
                    <hr>
                </div>
            <?php } ?>

            <?php if($inicio['TIPO_TEXTO']==2){ ?>
                <div class="row">
                    <!-- <div class="col"></div> -->
                    <div class="col mx-xl-5"><p class="font-familjen-grotesk fs-4 text-justify"><?php echo $inicio['TEXTO'];?></p></div>
                </div>
            <?php } ?>

            <?php if($inicio['TIPO_TEXTO']==3){ ?>
                <div class="row mt-5">
                    <!-- <div class="col"></div> -->
                    <div class="col mx-10 text-center"><p class="font-indie-flower fs-4"><?php echo $inicio['TEXTO'];?></p></div>
                </div>
            <?php } ?>

        <?php } } ?>
    </div>
</div>

<script>
    const carousel = new bootstrap.Carousel('#carouselExample')
</script>

<?php include('template/footer.php'); ?>