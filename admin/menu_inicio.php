<?php include("./template/header.php") ?>

<?php

include("./config/bd.php");

$txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
$txtTexto = (isset($_POST['txtTexto']))?$_POST['txtTexto']:"";
$txtTipoTexto = (isset($_POST['txtTipoTexto']))?$_POST['txtTipoTexto']:"";
$txtID1 = (isset($_POST['txtID1']))?$_POST['txtID1']:"";
$txtTexto1 = (isset($_POST['txtTexto1']))?$_POST['txtTexto1']:"";
$txtTipoTexto1 = (isset($_POST['txtTipoTexto1']))?$_POST['txtTipoTexto1']:"";
$accion = (isset($_POST['accion']))?$_POST['accion']:"";

switch ($accion){

    case "Activar":
        $sentenciaSQL=$conexion->prepare("UPDATE INICIO SET MOSTRAR=1 WHERE ID_INICIO=$txtID");
        $sentenciaSQL->execute();
        break;
        
    case "Desactivar":
        $sentenciaSQL=$conexion->prepare("UPDATE INICIO SET MOSTRAR=0 WHERE ID_INICIO=$txtID");
        $sentenciaSQL->execute();
        break;

    case "Subir":
        $sentenciaSQL=$conexion->prepare("UPDATE INICIO SET POSICION=POSICION+1 WHERE POSICION=(SELECT POSICION FROM INICIO WHERE ID_INICIO=$txtID)-1");
        $sentenciaSQL->execute();
        $sentenciaSQL=$conexion->prepare("UPDATE INICIO SET POSICION=POSICION-1 WHERE ID_INICIO=$txtID");
        $sentenciaSQL->execute();
        break;

    case "Bajar":
        $sentenciaSQL=$conexion->prepare("UPDATE INICIO SET POSICION=POSICION-1 WHERE POSICION=(SELECT POSICION FROM INICIO WHERE ID_INICIO=$txtID)+1");
        $sentenciaSQL->execute();
        $sentenciaSQL=$conexion->prepare("UPDATE INICIO SET POSICION=POSICION+1 WHERE ID_INICIO=$txtID");
        $sentenciaSQL->execute();
        break;
    
    case "Seleccionar":
        $sentenciaSQL=$conexion->prepare("SELECT * FROM INICIO WHERE ID_INICIO=:ID_INICIO");
        $sentenciaSQL->bindParam(':ID_INICIO',$txtID);
        $sentenciaSQL->execute();
        $ListaSel=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtID = $ListaSel['ID_INICIO'];
        $txtTexto = $ListaSel['TEXTO'];
        $txtTipoTexto = $ListaSel['TIPO_TEXTO'];
        break;

    case "Editar":
        $sentenciaSQL = $conexion->prepare("UPDATE INICIO SET TIPO_TEXTO=:TIPO_TEXTO, TEXTO=:TEXTO WHERE ID_INICIO=:ID_INICIO");
        $sentenciaSQL->bindParam(':TIPO_TEXTO', $txtTipoTexto);
        $sentenciaSQL->bindParam(':TEXTO', $txtTexto);
        $sentenciaSQL->bindParam(':ID_INICIO', $txtID);
        $sentenciaSQL->execute();
        $txtID="";
        $txtTexto="";
        $txtTipoTexto="";
        break;

    case "Agregar":
        //Obtenemos el último índice y la última posición
        $sentenciaSQL = $conexion->prepare("SELECT MAX(ID_INICIO) AS lastIndex, MAX(POSICION) AS lastPos FROM INICIO");
        $sentenciaSQL->execute();
        $resultado = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);
        $lastindex = $resultado['lastIndex']+1;
        $lastpos = $resultado['lastPos']+1;


        $sentenciaSQL = $conexion->prepare("INSERT INTO INICIO (ID_INICIO, TIPO_TEXTO, TEXTO, MOSTRAR, POSICION) VALUES (:ID_INICIO, :TIPO_TEXTO, :TEXTO, 1, :POSICION)");
        $sentenciaSQL->bindParam(':ID_INICIO', $lastindex);
        $sentenciaSQL->bindParam(':TIPO_TEXTO', $txtTipoTexto1);
        $sentenciaSQL->bindParam(':TEXTO', $txtTexto1);
        $sentenciaSQL->bindParam(':POSICION', $lastpos);
        $sentenciaSQL->execute();
       
        break;

    case "Eliminar":
        $sentenciaSQL = $conexion->prepare("DELETE FROM INICIO WHERE ID_INICIO=:ID_INICIO");
        $sentenciaSQL->bindParam(":ID_INICIO",$txtID);
        $sentenciaSQL->execute();
        break;

}

$sentenciaSQL= $conexion->prepare("SELECT * FROM INICIO ORDER BY POSICION");
$sentenciaSQL->execute();
$listaTexto=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

    <h1 class="">
        Menú inicio
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
                    <h4 class="text-center">Agregar texto</h4>
                    <hr>
                    <form method="POST">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="txtTexto" class="form-label">Texto</label>
                                    <input type="text" class="form-control" name="txtTexto1" id="txtTexto1" placeholder="Ingrese el texto">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <!-- <label for="txtTipoTexto1" class="form-label">Tipo texto</label>
                                <input class="form-control" name="txtTipoTexto1" id="txtTipoTexto1" placeholder="Ingrese el tipo de texto"></input> -->
                                <select for="txtTipoTexto1" class="form-control" id="txtTipoTexto1" name="txtTipoTexto1" aria-label="Seleccione el tipo de texto">
                                        <option selected>Seleccione el tipo de texto</option>
                                        <option value="1">Texto</option>
                                        <option value="2">Párrafo</option>
                                        <option value="3">Frase</option>
                                </select>
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
                    <h4 class="text-center">Editar texto</h4>
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
                                    <label for="txtTexto" class="form-label">Texto</label>
                                    <input type="text" class="form-control" name="txtTexto" id="txtTexto" value="<?php echo $txtTexto?>" placeholder="Ingrese el texto">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <!-- <label for="txtTipoTexto" class="form-label">Tipo texto</label>
                                <input class="form-control" name="txtTipoTexto" id="txtTipoTexto" value="<?php echo $txtTipoTexto?>" placeholder="Ingrese el tipo de texto"></input> -->
                                <select for="txtTipoTexto" class="form-control" id="txtTipoTexto" name="txtTipoTexto" aria-label="Seleccione el tipo de texto">
                                        <option selected>Seleccione el tipo de texto</option>
                                        <option value="1">Texto</option>
                                        <option value="2">Párrafo</option>
                                        <option value="3">Frase</option>
                                </select>
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
            <h4 class="p-2">Listado de textos en página de inicio</h4>
        </div>
        <div class="row">
            <div class="col-1 border">Posición</div>
            <div class="col-1 border">ID</div>
            <div class="col-2 border">Texto</div>
            <div class="col-2 border">Tipo texto</div>
            <div class="col-1 border">Mostrar</div>
            <div class="col border">Editar elemento</div>
        </div>
        <?php foreach($listaTexto as $lista) {?>
            <div class="row">
                <div class="col-1 border"><?php echo $lista['POSICION'] ?></div>
                <div class="col-1 border"><?php echo $lista['ID_INICIO'] ?></div>
                <div class="col-2 border"><?php echo $lista['TEXTO'] ?></div>
                <div class="col-2 border">
                    <?php if($lista['TIPO_TEXTO']==1){ ?> <p class="rounded-pill text-white bg-primary text-center"><?php echo "Título";  ?></p> <?php } ?>
                    <?php if($lista['TIPO_TEXTO']==2){ ?> <p class="rounded-pill bg-warning text-center"><?php echo "Párrafo"; ?></p> <?php } ?>
                    <?php if($lista['TIPO_TEXTO']==3){ ?> <p class="rounded-pill bg-info text-center"><?php echo "Frase";   ?></p> <?php } ?>
                </div>
                <div class="col-1 border">
                    <?php if($lista['MOSTRAR']==0){ ?> <p class="bg-danger text-white text-center rounded-pill"> <?php echo "No"; ?></p> <?php }?>
                    <?php if($lista['MOSTRAR']==1){ ?> <p class="bg-success text-white text-center rounded-pill"> <?php echo "Si"; ?></p> <?php }?>
                </div>
                <div class="col border">
                    <form method="POST">
                        <div class="row border">
                            
                            <div class="col-3"></div>
                            <div class="col">
                                <div class="row m-1"><input type="hidden" name="txtID" id="txtID" value="<?php echo $lista['ID_INICIO'] ?>"></input></div>
                                <div class="row m-1"><input type="submit" name="accion" value="Activar" class="btn btn-success" <?php if($lista['MOSTRAR']==1){echo "disabled";}?>></input></div>
                                <div class="row m-1"><input type="submit" name="accion" value="Desactivar" class="btn btn-success" <?php if($lista['MOSTRAR']==0){echo "disabled";}?>></input></div>
                                <div class="row m-1"><input type="submit" name="accion" value="Subir" class="btn btn-primary" <?php if($lista['POSICION']==1){echo "disabled";}?>></input></div>
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