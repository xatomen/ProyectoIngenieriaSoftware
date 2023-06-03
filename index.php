<?php include('template/header.php'); ?>

<?php

include("./admin/config/bd.php");

$sentenciaSQL= $conexion->prepare("SELECT * FROM IMAGEN_CARRUSEL");
$sentenciaSQL->execute();
$listaImagenes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>



<div class="box m-5">
    <h1 class="title">Inicio</h1>
    <hr>
    <p1>hola Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo id iure, quam fuga illum iusto optio neque deserunt tempora distinctio eum corrupti? Ratione fugiat maxime atque harum aliquam unde! Et. hola</p1>
        

    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

        <!-- ACÁ DEBEMOS PONER EL PHP CODE -->
        <?php foreach($listaImagenes as $link_imagen) { ?>
            <div class= "<?php if($link_imagen['ID_IMG_CARRUSEL']==1){echo "carousel-item active";}else{echo "carousel-item";}?>">
                <img src="<?php echo $link_imagen['IMAGEN_CARRUSEL'] ?>" class="d-block w-100" alt="...">
            </div>
        <?php } ?>


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

<script>
    const carousel = new bootstrap.Carousel('#carouselExample')
</script>

<?php include('template/footer.php'); ?>