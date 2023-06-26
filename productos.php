<?php include('template/header.php'); ?>

<?php

require 'config/config.php';

include("./admin/config/bd.php");

$sentenciaSQL= $conexion->prepare("SELECT * FROM PRODUCTO ORDER BY POSICION_PRODUCTO");
$sentenciaSQL->execute();
$listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL= $conexion->prepare("SELECT * FROM IMAGEN_PRODUCTO ORDER BY POSICION_IMG");
$sentenciaSQL->execute();
$listaImagenes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$numero = 1;
$contador = 1;

?>

<div class="container">
    <div class="card p-5 m-5 shadow">
        <h1 class="title font-pacifico">Productos</h1>
        <hr>
        <p1 class="font-familjen-grotesk fs-4 text-justify">A continuación podrás ver diseños inspiradores llevados a cabo por nosotros para nuestro clientes.</p1>
    
        <div class="container">
            <!-- <div class="row"> -->
                <?php foreach($listaProductos as $lista){ if($contador==4){$contador = 1;}if($lista['MOSTRAR_PRODUCTO']==1){ ?>
                    
                    <?php if($contador==1){?>
                
                        <div class="row">

                    <?php } ?>
                    
                    <div class="card col m-3 p-2 shadow">
                        <img src="<?php foreach($listaImagenes as $listaimg){ if($listaimg['ID_PRODUCTO']==$lista['ID_PRODUCTO']){ echo $listaimg['IMAGEN']; } } ?>" class="card-img-top" alt="...">
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

                    <?php if($contador==3){?>
                
                        </div>

                    <?php } ?>

                <?php }$contador = $contador + 1; } ?>
                
                <?php if($contador==2){ ?>
                    <div class="col m-3"></div>
                    <div class="col m-3"></div>
                <?php } ?>  
                <?php if($contador==3){ ?>
                    <div class="col m-3"></div>
                <?php } ?>  
            <!-- </div> -->
            
        </div>

    </div>
</div>

<?php include('template/footer.php'); ?>



