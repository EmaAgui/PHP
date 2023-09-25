<?php
include("../../bd.php");

if(isset($_GET['txtId'])){
    $txtId = (isset($_GET['txtId']) ? $_GET['txtId'] : "");
    
    $sentencia = $conexion->prepare("SELECT * FROM `artista` WHERE `idArtista` = :id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $nombreArtista = $registro["nombre"];
} 

if($_POST){
   
    // Recolección de datos del formulario mediante el método POST
    $txtId = (isset($_POST['txtId']) ? $_POST['txtId'] : "");
    $nombreArtista = (isset($_POST["nombreArtista"]) ? $_POST["nombreArtista"] : "");

    // Preparación de la actualización de datos
    $sentencia = $conexion->prepare("UPDATE artista SET nombre = :nombre WHERE idArtista = :id");

    // Asignación de valores a los parámetros de la sentencia
    $sentencia->bindParam(":nombre", $nombreArtista);
    $sentencia->bindParam(":id", $txtId);

    // Ejecución de la sentencia
    $sentencia->execute();

    $mensaje = "Registro Actualizado";
    header("Location: index.php?mensaje=".$mensaje);
}

?>


<?php include("../../templates/header.php"); ?>
<br>
<div class="card">
    <div class="card-header">
        Artista
    </div>
    <div class="card-body">
        
        <form action="" method="post" enctype="multipart/form-data">
           <div class="mb-3">
                <label for="txtId" class="form-label">ID:</label>
                <input type="text"
                value="<?php echo $txtId; ?>"
                class="form-control" readonly name="txtId" id="txtId" placeholder="ID">
            </div> 
            <div class="mb-3">
                <label for="nombreArtista" class="form-label">Nombre del artista:</label>
                <input type="text"
                value="<?php echo $nombreArtista; ?>"
                class="form-control" name="nombreArtista" id="nombreArtista" placeholder="Nombre del artista">
            </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    
</div>
<?php include("../../templates/footer.php"); ?>
