<?php include('template/header.php'); ?>

<?php

include("./admin/config/bd.php");

require 'config/config.php';
// $db = new Database();
// $con = $db->conectar();

$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

echo $id;
    // echo $token;
    echo " ";

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

?>

<div class="container">
    <div class="card p-5 m-5 shadow">
        
        <!-- AÑADIR CARRUSEL DE IMÁGENES!!!!!!!!!!!!!!!! -->
        <div class="container">
        <?php foreach($listaProductos as $lista){ if($lista['MOSTRAR_PRODUCTO']==1){ ?>
            <div class="row">
                <div class="col">
                    <img src="<?php foreach($listaImagenes as $listaimg){ if($listaimg['ID_PRODUCTO']==$lista['ID_PRODUCTO']){ echo $listaimg['IMAGEN']; } } ?>" class="card-img-top" alt="...">
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


<?php include('template/footer.php'); ?>