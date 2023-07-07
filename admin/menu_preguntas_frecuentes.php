<?php include("./template/header.php") ?>

<?php

include("./config/bd.php");

$txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
$txtTitulo = (isset($_POST['txtTitulo']))?$_POST['txtTitulo']:"";
$txtDescripcion = (isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
$txtID1 = (isset($_POST['txtID1']))?$_POST['txtID1']:"";
$txtTitulo1 = (isset($_POST['txtTitulo1']))?$_POST['txtTitulo1']:"";
$txtDescripcion1 = (isset($_POST['txtDescripcion1']))?$_POST['txtDescripcion1']:"";
$accion = (isset($_POST['accion']))?$_POST['accion']:"";

switch ($accion){

    case "Activar":
        $sentenciaSQL=$conexion->prepare("UPDATE PREGUNTAS_FRECUENTES SET MOSTRAR_PREGUNTA=1 WHERE ID_PREGUNTA=$txtID");
        $sentenciaSQL->execute();
        break;
        
    case "Desactivar":
        $sentenciaSQL=$conexion->prepare("UPDATE PREGUNTAS_FRECUENTES SET MOSTRAR_PREGUNTA=0 WHERE ID_PREGUNTA=$txtID");
        $sentenciaSQL->execute();
        break;

    case "Subir":
        $sentenciaSQL=$conexion->prepare("UPDATE PREGUNTAS_FRECUENTES SET POSICION_PREGUNTA=POSICION_PREGUNTA+1 WHERE POSICION_PREGUNTA=(SELECT POSICION_PREGUNTA FROM PREGUNTAS_FRECUENTES WHERE ID_PREGUNTA=$txtID)-1");
        $sentenciaSQL->execute();
        $sentenciaSQL=$conexion->prepare("UPDATE PREGUNTAS_FRECUENTES SET POSICION_PREGUNTA=POSICION_PREGUNTA-1 WHERE ID_PREGUNTA=$txtID");
        $sentenciaSQL->execute();
        break;

    case "Bajar":
        $sentenciaSQL=$conexion->prepare("UPDATE PREGUNTAS_FRECUENTES SET POSICION_PREGUNTA=POSICION_PREGUNTA-1 WHERE POSICION_PREGUNTA=(SELECT POSICION_PREGUNTA FROM PREGUNTAS_FRECUENTES WHERE ID_PREGUNTA=$txtID)+1");
        $sentenciaSQL->execute();
        $sentenciaSQL=$conexion->prepare("UPDATE PREGUNTAS_FRECUENTES SET POSICION_PREGUNTA=POSICION_PREGUNTA+1 WHERE ID_PREGUNTA=$txtID");
        $sentenciaSQL->execute();
        break;
    
    case "Seleccionar":
        $sentenciaSQL=$conexion->prepare("SELECT * FROM PREGUNTAS_FRECUENTES WHERE ID_PREGUNTA=:ID_PREGUNTA");
        $sentenciaSQL->bindParam(':ID_PREGUNTA',$txtID);
        $sentenciaSQL->execute();
        $ListaSel=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtID = $ListaSel['ID_PREGUNTA'];
        $txtTitulo = $ListaSel['TITULO_PREGUNTA'];
        $txtDescripcion = $ListaSel['DESCRIPCION_PREGUNTA'];
        break;

    case "Editar":
        $sentenciaSQL = $conexion->prepare("UPDATE PREGUNTAS_FRECUENTES SET DESCRIPCION_PREGUNTA=:DESCRIPCION_PREGUNTA, TITULO_PREGUNTA=:TITULO_PREGUNTA WHERE ID_PREGUNTA=:ID_PREGUNTA");
        $sentenciaSQL->bindParam(':DESCRIPCION_PREGUNTA', $txtDescripcion);
        $sentenciaSQL->bindParam(':TITULO_PREGUNTA', $txtTitulo);
        $sentenciaSQL->bindParam(':ID_PREGUNTA', $txtID);
        $sentenciaSQL->execute();
        $txtID="";
        $txtLinkImagen="";
        $txtDescripcion="";
        break;

    case "Agregar":
        //Obtenemos el último índice y la última posición
        $sentenciaSQL = $conexion->prepare("SELECT MAX(ID_PREGUNTA) AS lastIndex, MAX(POSICION_PREGUNTA) AS lastPos FROM PREGUNTAS_FRECUENTES");
        $sentenciaSQL->execute();
        $resultado = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);
        $lastindex = $resultado['lastIndex']+1;
        $lastpos = $resultado['lastPos']+1;


        $sentenciaSQL = $conexion->prepare("INSERT INTO PREGUNTAS_FRECUENTES (ID_PREGUNTA, DESCRIPCION_PREGUNTA, TITULO_PREGUNTA, MOSTRAR_PREGUNTA, POSICION_PREGUNTA) VALUES (:ID_PREGUNTA, :DESCRIPCION_PREGUNTA, :TITULO_PREGUNTA, 1, :POSICION_PREGUNTA)");
        $sentenciaSQL->bindParam(':ID_PREGUNTA', $lastindex);
        $sentenciaSQL->bindParam(':DESCRIPCION_PREGUNTA', $txtDescripcion1);
        $sentenciaSQL->bindParam(':TITULO_PREGUNTA', $txtTitulo1);
        $sentenciaSQL->bindParam(':POSICION_PREGUNTA', $lastpos);
        $sentenciaSQL->execute();
       
        break;

    case "Eliminar":
        $sentenciaSQL = $conexion->prepare("DELETE FROM PREGUNTAS_FRECUENTES WHERE ID_PREGUNTA=:ID_PREGUNTA");
        $sentenciaSQL->bindParam(":ID_PREGUNTA",$txtID);
        $sentenciaSQL->execute();
        break;

}

$sentenciaSQL= $conexion->prepare("SELECT * FROM PREGUNTAS_FRECUENTES ORDER BY POSICION_PREGUNTA");
$sentenciaSQL->execute();
$listaPreguntas=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>


<div class="">
    <h1 class="">
        Menú preguntas frecuentes
    </h1>
    <hr>
    <p>
        En este menú se pueden modificar las preguntas frecuentes.
    </p>

    <div class="row">
        
        <div class="col"></div>
        <div class="col">
            <div class="col">
                <div class="card p-3 shadow">
                    <h4 class="text-center">Agregar pregunta</h4>
                    <hr>
                    <form method="POST">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="txtTitulo" class="form-label">Título pregunta</label>
                                    <input type="text" class="form-control" name="txtTitulo1" id="txtTitulo1" placeholder="Ingrese el título">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="txtDescripcion1" class="form-label">Descripción pregunta</label>
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
                    <h4 class="text-center">Editar pregunta</h4>
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
                                    <label for="txtTitulo" class="form-label">Título pregunta</label>
                                    <input type="text" class="form-control" name="txtTitulo" id="txtTitulo" value="<?php echo $txtTitulo?>" placeholder="Ingrese la pregunta">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="txtDescripcion" class="form-label">Descripción pregunta</label>
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
            <h4 class="p-2">Listado de preguntas frecuentes</h4>
        </div>
        <div class="row">
            <div class="col-1 border">Posición</div>
            <div class="col-1 border">ID</div>
            <div class="col-2 border">Título</div>
            <div class="col-2 border">Descripción</div>
            <div class="col-1 border">Mostrar</div>
            <div class="col border">Editar elemento</div>
        </div>
        <?php foreach($listaPreguntas as $lista) {?>
            <div class="row">
                <div class="col-1 border"><?php echo $lista['POSICION_PREGUNTA'] ?></div>
                <div class="col-1 border"><?php echo $lista['ID_PREGUNTA'] ?></div>
                <div class="col-2 border"><?php echo $lista['TITULO_PREGUNTA'] ?></div>
                <div class="col-2 border"><?php echo $lista['DESCRIPCION_PREGUNTA'] ?></div>
                <div class="col-1 border">
                    <?php if($lista['MOSTRAR_PREGUNTA']==0){ ?> <p class="bg-danger text-white text-center rounded-pill"> <?php echo "No"; ?></p> <?php }?>
                    <?php if($lista['MOSTRAR_PREGUNTA']==1){ ?> <p class="bg-success text-white text-center rounded-pill"> <?php echo "Si"; ?></p> <?php }?>
                </div>
                <div class="col border">
                    <form method="POST">
                        <div class="row border">
                            
                            <div class="col-3"></div>
                            <div class="col">
                                <div class="row m-1"><input type="hidden" name="txtID" id="txtID" value="<?php echo $lista['ID_PREGUNTA'] ?>"></input></div>
                                <div class="row m-1"><input type="submit" name="accion" value="Activar" class="btn btn-success" <?php if($lista['MOSTRAR_PREGUNTA']==1){echo "disabled";}?>></input></div>
                                <div class="row m-1"><input type="submit" name="accion" value="Desactivar" class="btn btn-success" <?php if($lista['MOSTRAR_PREGUNTA']==0){echo "disabled";}?>></input></div>
                                <div class="row m-1"><input type="submit" name="accion" value="Subir" class="btn btn-primary" <?php if($lista['POSICION_PREGUNTA']==1){echo "disabled";}?>></input></div>
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