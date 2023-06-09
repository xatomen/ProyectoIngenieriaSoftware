<?php include("./template/header.php") ?>

<?php

include("./config/bd.php");

$txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
$txtTitulo = (isset($_POST['txtTitulo']))?$_POST['txtTitulo']:"";
$txtDescripcion = (isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
$txtID1 = (isset($_POST['txtID1']))?$_POST['txtID1']:"";
$txtTitulo1 = (isset($_POST['txtTitulo1']))?$_POST['txtTitulo1']:"";
$txtDescripcion1 = (isset($_POST['txtDescripcion1']))?$_POST['txtDescripcion1']:"";
$txtLinkImagen = (isset($_POST['txtLinkImagen']))?$_POST['txtLinkImagen']:"";
$txtID2 = (isset($_POST['txtID2']))?$_POST['txtID2']:"";
$accion = (isset($_POST['accion']))?$_POST['accion']:"";
$accion_imagen = (isset($_POST['accion_imagen']))?$_POST['accion_imagen']:"";

switch ($accion){

    case "Activar":
        $mensaje = "Producto activado satisfactoriamente";
        $sentenciaSQL=$conexion->prepare("UPDATE producto SET MOSTRAR_PRODUCTO=1 WHERE ID_PRODUCTO=$txtID");
        $sentenciaSQL->execute();
        break;
        
    case "Desactivar":
        $mensaje = "Producto desactivado satisfactoriamente";
        $sentenciaSQL=$conexion->prepare("UPDATE producto SET MOSTRAR_PRODUCTO=0 WHERE ID_PRODUCTO=$txtID");
        $sentenciaSQL->execute();
        break;

    case "Subir":
        $mensaje = "Producto subido de puesto satisfactoriamente";
        $sentenciaSQL=$conexion->prepare("UPDATE producto SET POSICION_PRODUCTO=POSICION_PRODUCTO+1 WHERE POSICION_PRODUCTO=(SELECT POSICION_PRODUCTO FROM producto WHERE ID_PRODUCTO=$txtID)-1");
        $sentenciaSQL->execute();
        $sentenciaSQL=$conexion->prepare("UPDATE producto SET POSICION_PRODUCTO=POSICION_PRODUCTO-1 WHERE ID_PRODUCTO=$txtID");
        $sentenciaSQL->execute();
        break;

    case "Bajar":
        $mensaje = "Producto bajado de puesto satisfactoriamente";
        $sentenciaSQL=$conexion->prepare("UPDATE producto SET POSICION_PRODUCTO=POSICION_PRODUCTO-1 WHERE POSICION_PRODUCTO=(SELECT POSICION_PRODUCTO FROM producto WHERE ID_PRODUCTO=$txtID)+1");
        $sentenciaSQL->execute();
        $sentenciaSQL=$conexion->prepare("UPDATE producto SET POSICION_PRODUCTO=POSICION_PRODUCTO+1 WHERE ID_PRODUCTO=$txtID");
        $sentenciaSQL->execute();
        break;
    
    case "Seleccionar":
        $sentenciaSQL=$conexion->prepare("SELECT * FROM producto WHERE ID_PRODUCTO=:ID_PRODUCTO");
        $sentenciaSQL->bindParam(':ID_PRODUCTO',$txtID);
        $sentenciaSQL->execute();
        $ListaSel=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtID = $ListaSel['ID_PRODUCTO'];
        $txtTitulo = $ListaSel['TITULO_PRODUCTO'];
        $txtDescripcion = $ListaSel['DESCRIPCION_PRODUCTO'];
        break;

    case "Editar":
        $mensaje = "Producto editado satisfactoriamente";
        $sentenciaSQL = $conexion->prepare("UPDATE producto SET DESCRIPCION_PRODUCTO=:DESCRIPCION_PRODUCTO, TITULO_PRODUCTO=:TITULO_PRODUCTO WHERE ID_PRODUCTO=:ID_PRODUCTO");
        $sentenciaSQL->bindParam(':DESCRIPCION_PRODUCTO', $txtDescripcion);
        $sentenciaSQL->bindParam(':TITULO_PRODUCTO', $txtTitulo);
        $sentenciaSQL->bindParam(':ID_PRODUCTO', $txtID);
        $sentenciaSQL->execute();
        $txtID="";
        $txtTitulo="";
        $txtDescripcion="";
        break;

    case "Agregar":
        $mensaje = "Producto agregado satisfactoriamente";
        //Obtenemos el último índice y la última posición
        $sentenciaSQL = $conexion->prepare("SELECT MAX(ID_PRODUCTO) AS lastIndex, MAX(POSICION_PRODUCTO) AS lastPos FROM producto");
        $sentenciaSQL->execute();
        $resultado = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);
        $lastindex = $resultado['lastIndex']+1;
        $lastpos = $resultado['lastPos']+1;


        $sentenciaSQL = $conexion->prepare("INSERT INTO producto (ID_PRODUCTO, DESCRIPCION_PRODUCTO, TITULO_PRODUCTO, MOSTRAR_PRODUCTO, POSICION_PRODUCTO) VALUES (:ID_PRODUCTO, :DESCRIPCION_PRODUCTO, :TITULO_PRODUCTO, 1, :POSICION_PRODUCTO)");
        $sentenciaSQL->bindParam(':ID_PRODUCTO', $lastindex);
        $sentenciaSQL->bindParam(':DESCRIPCION_PRODUCTO', $txtDescripcion1);
        $sentenciaSQL->bindParam(':TITULO_PRODUCTO', $txtTitulo1);
        $sentenciaSQL->bindParam(':POSICION_PRODUCTO', $lastpos);
        $sentenciaSQL->execute();
       
        break;

    case "Eliminar":
        $mensaje = "Producto eliminado satisfactoriamente";
        $sentenciaSQL = $conexion->prepare("DELETE FROM producto WHERE ID_PRODUCTO=:ID_PRODUCTO");
        $sentenciaSQL->bindParam(":ID_PRODUCTO",$txtID);
        $sentenciaSQL->execute();
        break;

    }

    switch ($accion_imagen){
        case "Activar":
            $mensaje = "Imágen activada satisfactoriamente";
            $sentenciaSQL=$conexion->prepare("UPDATE imagen_producto SET MOSTRAR_IMAGEN=1 WHERE ID_IMG_PRODUCTO=$txtID2");
            $sentenciaSQL->execute();
            break;
            
        case "Desactivar":
            $mensaje = "Imágen desactivada satisfactoriamente";
            $sentenciaSQL=$conexion->prepare("UPDATE imagen_producto SET MOSTRAR_IMAGEN=0 WHERE ID_IMG_PRODUCTO=$txtID2");
            $sentenciaSQL->execute();
            break;
    
        case "Subir":
            $mensaje = "Imágen subida de puesto satisfactoriamente";
            $sentenciaSQL=$conexion->prepare("UPDATE imagen_producto SET POSICION_IMG=POSICION_IMG+1 WHERE POSICION_IMG=(SELECT POSICION_IMG FROM imagen_producto WHERE ID_IMG_PRODUCTO=$txtID2)-1 AND ID_PRODUCTO=$txtID");
            $sentenciaSQL->execute();
            $sentenciaSQL=$conexion->prepare("UPDATE imagen_producto SET POSICION_IMG=POSICION_IMG-1 WHERE ID_IMG_PRODUCTO=$txtID2 AND ID_PRODUCTO=$txtID");
            $sentenciaSQL->execute();
            break;
    
        case "Bajar":
            $mensaje = "Imágen bajada de puesto satisfactoriamente";
            $sentenciaSQL=$conexion->prepare("UPDATE imagen_producto SET POSICION_IMG=POSICION_IMG-1 WHERE POSICION_IMG=(SELECT POSICION_IMG FROM imagen_producto WHERE ID_IMG_PRODUCTO=$txtID2)+1 AND ID_PRODUCTO=$txtID");
            $sentenciaSQL->execute();
            $sentenciaSQL=$conexion->prepare("UPDATE imagen_producto SET POSICION_IMG=POSICION_IMG+1 WHERE ID_IMG_PRODUCTO=$txtID2 AND ID_PRODUCTO=$txtID");
            $sentenciaSQL->execute();
            break;
        
        case "Eliminar":
            $mensaje = "Imágen eliminada satisfactoriamente";
            $sentenciaSQL = $conexion->prepare("DELETE FROM imagen_producto WHERE ID_IMG_PRODUCTO=:ID_IMG_PRODUCTO");
            $sentenciaSQL->bindParam(":ID_IMG_PRODUCTO",$txtID2);
            $sentenciaSQL->execute();
            break;

        case "Agregar":
            $mensaje = "Imágen agregada satisfactoriamente";
            //Obtenemos el último índice y la última posición
            $sentenciaSQL = $conexion->prepare("SELECT MAX(ID_IMG_PRODUCTO) AS lastIndex FROM imagen_producto");
            $sentenciaSQL->execute();
            $resultado = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);
            $lastindex = $resultado['lastIndex']+1;
            $sentenciaSQL = $conexion->prepare("SELECT MAX(POSICION_IMG) AS lastPos FROM imagen_producto WHERE ID_PRODUCTO = $txtID");
            $sentenciaSQL->execute();
            $resultado = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);
            $lastpos = $resultado['lastPos']+1;


            $sentenciaSQL = $conexion->prepare("INSERT INTO imagen_producto (ID_IMG_PRODUCTO, ID_PRODUCTO, IMAGEN, MOSTRAR_IMAGEN, POSICION_IMG) VALUES (:ID_IMG_PRODUCTO, :ID_PRODUCTO, :IMAGEN, 1, :POSICION_IMG)");
            $sentenciaSQL->bindParam(':ID_IMG_PRODUCTO', $lastindex);
            $sentenciaSQL->bindParam(':ID_PRODUCTO', $txtID);
            $sentenciaSQL->bindParam(':IMAGEN', $txtLinkImagen);
            $sentenciaSQL->bindParam(':POSICION_IMG', $lastpos);
            $sentenciaSQL->execute();
            break;
    }

$sentenciaSQL= $conexion->prepare("SELECT * FROM producto ORDER BY POSICION_PRODUCTO");
$sentenciaSQL->execute();
$listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL= $conexion->prepare("SELECT * FROM imagen_producto ORDER BY POSICION_IMG");
$sentenciaSQL->execute();
$listaImagenes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="">
    <h1 class="">
        Menú productos
    </h1>
    <hr>
    <p>
        En este menú se pueden modificar los productos que se muestran en la sección de productos.
    </p>
    <?php if(isset($mensaje)) {?>
        <div class="alert alert-success text-center" role="alert">
            <?php echo $mensaje; ?>
        </div>
    <?php } ?>
    <div class="row justify-content-around">
        
        <div class="col-xl"></div>
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
            <div class="col">
                <div class="card p-3 shadow">
                    <h4 class="text-center">Agregar producto</h4>
                    <hr>
                    <form method="POST">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="txtTitulo1" class="form-label">Título producto</label>
                                    <input type="text" class="form-control" name="txtTitulo1" id="txtTitulo1" placeholder="Ingrese el título">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="txtDescripcion1" class="form-label">Descripción producto</label>
                                <input class="form-control" name="txtDescripcion1" id="txtDescripcion1" placeholder="Ingrese la descripción"></input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-center">
                                <input class="btn btn-warning" type="submit" value="Agregar" name="accion">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
            <div class="col">
                <div class="card p-3 shadow">
                    <h4 class="text-center">Editar elemento seleccionado</h4>
                    <hr>
                    <form method="POST">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="txtID" class="form-label">ID</label>
                                    <input type="text" class="form-control" name="txtID" id="txtID" value="<?php echo $txtID?>" placeholder="ID">
                                </div>
                            </div>
                            <div class="col"></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="txtTitulo" class="form-label">Título producto</label>
                                    <input type="text" class="form-control" name="txtTitulo" id="txtTitulo" value="<?php echo $txtTitulo?>" placeholder="Ingrese el título">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="txtDescripcion" class="form-label">Descripción producto</label>
                                <input class="form-control" name="txtDescripcion" id="txtDescripcion" value="<?php echo $txtDescripcion?>" placeholder="Ingrese la descripción"></input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-center">
                                <input class="btn btn-warning" type="submit" value="Editar" name="accion">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl"></div>

    </div>

    <div class="card row m-5 shadow overflow-scroll">
        <table class="table table-bordered">
            <thead>
                <h4 class="p-2">Listado de productos</h4>
            </thead>
            <tbody>
                <tr>
                    <td>Posición</td>
                    <td>ID</td>
                    <td>Titulo</td>
                    <td>Descripción</td>
                    <td>Imágenes</td>
                    <td>Mostrar</td>
                    <td>Editar elemento</td>
                </tr>
                <?php foreach($listaProductos as $lista){?>
                <tr>
                    <td><?php echo $lista['POSICION_PRODUCTO'] ?></td>
                    <td><?php echo $lista['ID_PRODUCTO'] ?></td>
                    <td><?php echo $lista['TITULO_PRODUCTO'] ?></td>
                    <td><?php echo $lista['DESCRIPCION_PRODUCTO'] ?></td>
                    <td>
                        <?php foreach($listaImagenes as $lista2) { if($lista2['ID_PRODUCTO']==$lista['ID_PRODUCTO']){?>
                            <div class="row border">
                                <div class="col">
                                    <img src="<?php echo $lista2['IMAGEN'] ?>" style="max-width:200px;">
                                </div>
                                <div class="col">
                                    <div class="dropdown">
                                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                                        <ul class="dropdown-menu">
                                            <form method="POST">
                                                <div class="row m-1"><input type="hidden" name="txtID2" id="txtID2" value="<?php echo $lista2['ID_IMG_PRODUCTO'] ?>"></input></div>
                                                <div class="row m-1"><input type="hidden" name="txtID" id="txtID" value="<?php echo $lista2['ID_PRODUCTO'] ?>"></input></div>
                                                <div class="row m-1"><input type="submit" name="accion_imagen" value="Activar" class="btn btn-success" <?php if($lista2['MOSTRAR_IMAGEN']==1){echo "disabled";}?>></input></div>
                                                <div class="row m-1"><input type="submit" name="accion_imagen" value="Desactivar" class="btn btn-success" <?php if($lista2['MOSTRAR_IMAGEN']==0){echo "disabled";}?>></input></div>
                                                <div class="row m-1"><input type="submit" name="accion_imagen" value="Subir" class="btn btn-primary" <?php if($lista2['POSICION_IMG']==1){echo "disabled";}?>></input></div>
                                                <div class="row m-1"><input type="submit" name="accion_imagen" value="Bajar" class="btn btn-primary"></input></div>
                                                <div class="row m-1"><input type="submit" name="accion_imagen" value="Seleccionar" class="btn btn-info"></input></div>
                                                <div class="row m-1"><input type="submit" name="accion_imagen" value="Eliminar" class="btn btn-danger"></input></div>
                                            </form>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php } } ?>
                            <div class="dropdown text-center">
                                <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Agregar imágen</a>
                                <ul class="dropdown-menu">
                                    <div class="card p-3 shadow">
                                        <h4 class="text-center">Agregar imágen</h4>
                                        <hr>
                                        <form method="POST">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $lista['ID_PRODUCTO'] ?>"></input>
                                                        <label for="txtLinkImagen" class="form-label">Link imágen</label>
                                                        <input type="text" class="form-control" name="txtLinkImagen" id="txtLinkImagen" placeholder="Ingrese el link">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="text-center">
                                                    <input class="btn btn-warning" type="submit" value="Agregar" name="accion_imagen">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php if($lista['MOSTRAR_PRODUCTO']==0){ ?> <p class="bg-danger text-white text-center rounded-pill"> <?php echo "No"; ?></p> <?php }?>
                        <?php if($lista['MOSTRAR_PRODUCTO']==1){ ?> <p class="bg-success text-white text-center rounded-pill"> <?php echo "Si"; ?></p> <?php }?>
                    </td>
                    <td>
                        <form method="POST">
                            <div class="row border">
                                <!-- <div class="col-3"></div> -->
                                <div class="col">
                                    <div class="row m-1"><input type="hidden" name="txtID" id="txtID" value="<?php echo $lista['ID_PRODUCTO'] ?>"></input></div>
                                    <div class="row m-1"><input type="submit" name="accion" value="Activar" class="btn btn-success" <?php if($lista['MOSTRAR_PRODUCTO']==1){echo "disabled";}?>></input></div>
                                    <div class="row m-1"><input type="submit" name="accion" value="Desactivar" class="btn btn-success" <?php if($lista['MOSTRAR_PRODUCTO']==0){echo "disabled";}?>></input></div>
                                    <div class="row m-1"><input type="submit" name="accion" value="Subir" class="btn btn-primary" <?php if($lista['POSICION_PRODUCTO']==1){echo "disabled";}?>></input></div>
                                    <div class="row m-1"><input type="submit" name="accion" value="Bajar" class="btn btn-primary"></input></div>
                                    <div class="row m-1"><input type="submit" name="accion" value="Seleccionar" class="btn btn-info"></input></div>
                                    <div class="row m-1"><input type="submit" name="accion" value="Eliminar" class="btn btn-danger"></input></div>
                                </div>
                                <!-- <div class="col-3"></div> -->
                            </div>
                        </form>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>

<?php include("./template/footer.php") ?>