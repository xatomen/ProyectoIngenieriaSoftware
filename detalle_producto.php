<?php include('template/header.php'); ?>

<?php

include("./admin/config/bd.php");

require 'config/config.php';
// $db = new Database();
// $con = $db->conectar();

$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if($id == ' ' || $token == ' '){
    // echo $id;
    // echo $token;
    echo " ";
    echo 'Error 1';
    exit;
}
else{
    $token_tmp = hash_hmac('sha1',$id,KEY_TOKEN);
    // echo $token_tmp;
    if($token == $token_tmp){

        $sentenciaSQL= $conexion->prepare("SELECT COUNT(ID_PRODUCTO) FROM PRODUCTO WHERE ID_PRODUCTO=$id");
        $sentenciaSQL->execute();
        if($sentenciaSQL->fetchColumn()>0){
            $sentenciaSQL= $conexion->prepare("SELECT * FROM PRODUCTO WHERE ID_PRODUCTO=?");
            $sentenciaSQL->execute([$id]);
            $listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
            
            $sentenciaSQL= $conexion->prepare("SELECT * FROM IMAGEN_PRODUCTO ORDER BY POSICION_IMG");
            $sentenciaSQL->execute();
            $listaImagenes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        }

    }
    else{
        echo 'Error 2';
        exit;
    }
}

$sentenciaSQL = $conexion->prepare("SELECT MIN(POSICION_IMG) AS firstPos FROM IMAGEN_PRODUCTO WHERE MOSTRAR_IMAGEN=1 AND ID_PRODUCTO = $id");
$sentenciaSQL->execute();
$resultado = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);
$firstPos = $resultado['firstPos'];

?>

<div class="container">
    <div class="card p-5 m-5 shadow">
        
        <!-- AÑADIR CARRUSEL DE IMÁGENES!!!!!!!!!!!!!!!! -->
        <div class="container">
        <?php foreach($listaProductos as $lista){ if($lista['MOSTRAR_PRODUCTO']==1){ ?>
            <div class="row">
                <div class="col">
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner img-carrusel carousel-centrar shadow position-relative">

                        <!-- ACÁ DEBEMOS PONER EL PHP CODE -->
                        <?php foreach($listaImagenes as $listaimg) { if($listaimg['MOSTRAR_IMAGEN']==1 && $listaimg['ID_PRODUCTO']==$lista['ID_PRODUCTO']){?>
                            <div class= "<?php if($listaimg['POSICION_IMG']==$firstPos){echo "carousel-item active shadow"; $firstPos=0;}else{echo "carousel-item shadow";}?>">
                                <img src="<?php echo $listaimg['IMAGEN'] ?>" class="d-block w-100" alt="...">
                            </div>
                        <?php } } ?>

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

                <div class="col">
                    <h1 class="title font-pacifico"><?php echo $lista['TITULO_PRODUCTO'] ?></h1>
                    <hr>
                    <p1 class="font-familjen-grotesk fs-4 text-justify"><?php echo $lista['DESCRIPCION_PRODUCTO'] ?></p1>
                </div>

            </div>
        <?php } }?>  
            
        </div>

    </div>
</div>

<script>
    const carousel = new bootstrap.Carousel('#carouselExample')
</script>

<?php include('template/footer.php'); ?>