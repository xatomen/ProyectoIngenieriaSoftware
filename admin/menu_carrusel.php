<?php include("./template/header.php") ?>

<?php

include("./config/bd.php");

$txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
$txtLinkImagen = (isset($_POST['txtLinkImagen']))?$_POST['txtLinkImagen']:"";
$txtDescripcion = (isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
$txtID1 = (isset($_POST['txtID1']))?$_POST['txtID1']:"";
$txtLinkImagen1 = (isset($_POST['txtLinkImagen1']))?$_POST['txtLinkImagen1']:"";
$txtDescripcion1 = (isset($_POST['txtDescripcion1']))?$_POST['txtDescripcion1']:"";
$accion = (isset($_POST['accion']))?$_POST['accion']:"";

switch ($accion){

    case "Activar":
        $sentenciaSQL=$conexion->prepare("UPDATE IMAGEN_CARRUSEL SET MOSTRAR_IMG_CARRUSEL=1 WHERE ID_IMG_CARRUSEL=$txtID");
        $sentenciaSQL->execute();
        break;
        
    case "Desactivar":
        $sentenciaSQL=$conexion->prepare("UPDATE IMAGEN_CARRUSEL SET MOSTRAR_IMG_CARRUSEL=0 WHERE ID_IMG_CARRUSEL=$txtID");
        $sentenciaSQL->execute();
        break;

    case "Subir":
        $sentenciaSQL=$conexion->prepare("UPDATE IMAGEN_CARRUSEL SET POSICION_IMG=POSICION_IMG+1 WHERE POSICION_IMG=(SELECT POSICION_IMG FROM IMAGEN_CARRUSEL WHERE ID_IMG_CARRUSEL=$txtID)-1");
        $sentenciaSQL->execute();
        $sentenciaSQL=$conexion->prepare("UPDATE IMAGEN_CARRUSEL SET POSICION_IMG=POSICION_IMG-1 WHERE ID_IMG_CARRUSEL=$txtID");
        $sentenciaSQL->execute();
        break;

    case "Bajar":
        $sentenciaSQL=$conexion->prepare("UPDATE IMAGEN_CARRUSEL SET POSICION_IMG=POSICION_IMG-1 WHERE POSICION_IMG=(SELECT POSICION_IMG FROM IMAGEN_CARRUSEL WHERE ID_IMG_CARRUSEL=$txtID)+1");
        $sentenciaSQL->execute();
        $sentenciaSQL=$conexion->prepare("UPDATE IMAGEN_CARRUSEL SET POSICION_IMG=POSICION_IMG+1 WHERE ID_IMG_CARRUSEL=$txtID");
        $sentenciaSQL->execute();
        break;
    
    case "Seleccionar":
        $sentenciaSQL=$conexion->prepare("SELECT * FROM IMAGEN_CARRUSEL WHERE ID_IMG_CARRUSEL=:ID_IMG_CARRUSEL");
        $sentenciaSQL->bindParam(':ID_IMG_CARRUSEL',$txtID);
        $sentenciaSQL->execute();
        $ListaSel=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtID = $ListaSel['ID_IMG_CARRUSEL'];
        $txtLinkImagen = $ListaSel['IMAGEN_CARRUSEL'];
        $txtDescripcion = $ListaSel['DESCRIPCION_IMG_CARRUSEL'];
        break;

    case "Editar":
        $sentenciaSQL = $conexion->prepare("UPDATE IMAGEN_CARRUSEL SET DESCRIPCION_IMG_CARRUSEL=:DESCRIPCION_IMG_CARRUSEL, IMAGEN_CARRUSEL=:IMAGEN_CARRUSEL WHERE ID_IMG_CARRUSEL=:ID_IMG_CARRUSEL");
        $sentenciaSQL->bindParam(':DESCRIPCION_IMG_CARRUSEL', $txtDescripcion);
        $sentenciaSQL->bindParam(':IMAGEN_CARRUSEL', $txtLinkImagen);
        $sentenciaSQL->bindParam(':ID_IMG_CARRUSEL', $txtID);
        $sentenciaSQL->execute();
        $txtID="";
        $txtLinkImagen="";
        $txtDescripcion="";
        break;

    case "Agregar":
        //Obtenemos el último índice y la última posición
        $sentenciaSQL = $conexion->prepare("SELECT MAX(ID_IMG_CARRUSEL) AS lastIndex, MAX(POSICION_IMG) AS lastPos FROM IMAGEN_CARRUSEL");
        $sentenciaSQL->execute();
        $resultado = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);
        $lastindex = $resultado['lastIndex']+1;
        $lastpos = $resultado['lastPos']+1;


        $sentenciaSQL = $conexion->prepare("INSERT INTO IMAGEN_CARRUSEL (ID_IMG_CARRUSEL, DESCRIPCION_IMG_CARRUSEL, IMAGEN_CARRUSEL, MOSTRAR_IMG_CARRUSEL, POSICION_IMG) VALUES (:ID_IMG_CARRUSEL, :DESCRIPCION_IMG_CARRUSEL, :IMAGEN_CARRUSEL, 1, :POSICION_IMG)");
        $sentenciaSQL->bindParam(':ID_IMG_CARRUSEL', $lastindex);
        $sentenciaSQL->bindParam(':DESCRIPCION_IMG_CARRUSEL', $txtDescripcion1);
        $sentenciaSQL->bindParam(':IMAGEN_CARRUSEL', $txtLinkImagen1);
        $sentenciaSQL->bindParam(':POSICION_IMG', $lastpos);
        $sentenciaSQL->execute();
       
        break;

    case "Eliminar":
        $sentenciaSQL = $conexion->prepare("DELETE FROM IMAGEN_CARRUSEL WHERE ID_IMG_CARRUSEL=:ID_IMG_CARRUSEL");
        $sentenciaSQL->bindParam(":ID_IMG_CARRUSEL",$txtID);
        $sentenciaSQL->execute();
        break;

}

$sentenciaSQL= $conexion->prepare("SELECT * FROM IMAGEN_CARRUSEL ORDER BY POSICION_IMG");
$sentenciaSQL->execute();
$listaImagenes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="">
    <h1 class="">
        Menú carrusel
    </h1>
    <hr>
    <p>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Pariatur dolor non, optio molestias adipisci modi aspernatur, laudantium sunt autem vitae nihil enim iusto ea. Doloribus eum eos eveniet voluptate dolorem.
    </p>

    <div class="row">
        
        <div class="col"></div>
        <div class="col">
            <div class="col">
                <div class="card p-3 shadow">
                    <h4 class="text-center">Agregar imágen al carrusel</h4>
                    <hr>
                    <form method="POST">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="txtLinkImagen1" class="form-label">Link imágen</label>
                                    <input type="text" class="form-control" name="txtLinkImagen1" id="txtLinkImagen1" placeholder="Ingrese URL">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="txtDescripcion1" class="form-label">Descripción imágen</label>
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
        <div class="col">
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
                                    <label for="txtLinkImagen" class="form-label">Link imágen</label>
                                    <input type="text" class="form-control" name="txtLinkImagen" id="txtLinkImagen" value="<?php echo $txtLinkImagen?>" placeholder="Ingrese URL">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="txtDescripcion" class="form-label">Descripción imágen</label>
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
        <div class="col"></div>

    </div>

    <div class="card row m-5 shadow">
        <div class="row">
            <h4 class="p-2">Listado de imágenes</h4>
        </div>
        <div class="row">
            <div class="col-1 border">Posición</div>
            <div class="col-1 border">ID</div>
            <div class="col-2 border">Link imágen</div>
            <div class="col-2 border">Descripción</div>
            <div class="col border">Previsualización</div>
            <div class="col-1 border">Mostrar</div>
            <div class="col border">Editar elemento</div>
        </div>
        <?php foreach($listaImagenes as $lista) {?>
            <div class="row">
                <div class="col-1 border"><?php echo $lista['POSICION_IMG'] ?></div>
                <div class="col-1 border"><?php echo $lista['ID_IMG_CARRUSEL'] ?></div>
                <div class="col-2 border"><?php echo $lista['IMAGEN_CARRUSEL'] ?></div>
                <div class="col-2 border"><?php echo $lista['DESCRIPCION_IMG_CARRUSEL'] ?></div>
                <div class="col border"><img src="<?php echo $lista['IMAGEN_CARRUSEL'] ?>" style="max-width:250px;"></div>
                <div class="col-1 border">
                    <?php if($lista['MOSTRAR_IMG_CARRUSEL']==0){ ?> <p class="bg-danger text-white text-center rounded-pill"> <?php echo "No"; ?></p> <?php }?>
                    <?php if($lista['MOSTRAR_IMG_CARRUSEL']==1){ ?> <p class="bg-success text-white text-center rounded-pill"> <?php echo "Si"; ?></p> <?php }?>
                </div>
                <div class="col border">
                    <form method="POST">
                        <div class="row border">
                            
                            <div class="col-3"></div>
                            <div class="col">
                                <div class="row m-1"><input type="hidden" name="txtID" id="txtID" value="<?php echo $lista['ID_IMG_CARRUSEL'] ?>"></input></div>
                                <div class="row m-1"><input type="submit" name="accion" value="Activar" class="btn btn-success" <?php if($lista['MOSTRAR_IMG_CARRUSEL']==1){echo "disabled";}?>></input></div>
                                <div class="row m-1"><input type="submit" name="accion" value="Desactivar" class="btn btn-success" <?php if($lista['MOSTRAR_IMG_CARRUSEL']==0){echo "disabled";}?>></input></div>
                                <div class="row m-1"><input type="submit" name="accion" value="Subir" class="btn btn-primary" <?php if($lista['POSICION_IMG']==1){echo "disabled";}?>></input></div>
                                <div class="row m-1"><input type="submit" name="accion" value="Bajar" class="btn btn-primary"></input></div>
                                <div class="row m-1"><input type="submit" name="accion" value="Seleccionar" class="btn btn-info"></input></div>
                                <div class="row m-1"><input type="submit" name="accion" value="Eliminar" class="btn btn-danger"></input></div>
                            </div>
                            <div class="col-3"></div>
                        </div>
                    </form>
                </div>
            </div>
                    
        <?php } ?>
    </div>

<?php include("./template/footer.php") ?>
