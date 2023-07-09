<?php include('template/header.php'); ?>

<?php

require 'config/config.php';

include("./admin/config/bd.php");

$sentenciaSQL= $conexion->prepare("SELECT * FROM producto ORDER BY POSICION_PRODUCTO");
$sentenciaSQL->execute();
$listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL= $conexion->prepare("SELECT * FROM imagen_producto ORDER BY POSICION_IMG");
$sentenciaSQL->execute();
$listaImagenes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$numero = 1;
$contador = 1;

?>

<div class="container">
    <div class="card p-sm-5 p-3 m-5 shadow">
        <h1 class="title font-pacifico">Productos</h1>
        <hr>
        <p1 class="font-familjen-grotesk fs-4 text-justify">A continuación podrás ver diseños inspiradores llevados a cabo por nosotros para nuestro clientes.</p1>
    
        <div class="container">
            <div class="row justify-content-around">
                <?php foreach($listaProductos as $lista){ if($contador==4){$contador = 1;}if($lista['MOSTRAR_PRODUCTO']==1){ ?>
                    <?php
                        $id_prod = $lista['ID_PRODUCTO'];
                        $sentenciaSQL = $conexion->prepare("SELECT MIN(POSICION_IMG) AS firstPos FROM imagen_producto WHERE MOSTRAR_IMAGEN=1 AND ID_PRODUCTO = $id_prod");
                        $sentenciaSQL->execute();
                        $resultado = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);
                        $firstPos = $resultado['firstPos'];
                    ?>

                    <div class="card col-sm-12 col-md-6 col-lg-4 col-xl-3 m-xl-1 p-2 shadow">
                        <img src="<?php foreach($listaImagenes as $listaimg){ if($listaimg['ID_PRODUCTO']==$lista['ID_PRODUCTO'] && $listaimg['POSICION_IMG']==$firstPos){ echo $listaimg['IMAGEN'];} } ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $lista['TITULO_PRODUCTO'] ?></h5>
                            <p class="card-text"><?php echo $lista['DESCRIPCION_PRODUCTO'] ?></p>
                            <div class="row text-center">
                                <div class="col-1"></div>
                                <div class="col"><a href="detalle_producto.php?id=<?php echo $lista['ID_PRODUCTO']; ?>&token=<?php echo hash_hmac('sha1',$lista['ID_PRODUCTO'],KEY_TOKEN); ?>" class="btn btn-primary">Ver más detalles</a></div>
                                <div class="col-1"></div>
                            </div>
                            
                        </div>
                    </div> 

                <?php } } ?>  
            </div>
            
        </div>

    </div>
</div>

<?php include('template/footer.php'); ?>



