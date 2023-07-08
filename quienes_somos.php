<?php include('template/header.php'); ?>

<?php

include("./admin/config/bd.php");

$sentenciaSQL = $conexion->prepare("SELECT * FROM QUIENES_SOMOS ORDER BY POSICION");
$sentenciaSQL->execute();
$listaInicio = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">

    <div class="card p-sm-5 p-3 m-5 shadow">
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
    <!-- <h1 class="title">Quienes somos</h1>
    <hr>
    <p1>hola Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo id iure, quam fuga illum iusto optio neque deserunt tempora distinctio eum corrupti? Ratione fugiat maxime atque harum aliquam unde! Et. hola</p1> -->
        
    

 </div>


<?php include('template/footer.php'); ?>