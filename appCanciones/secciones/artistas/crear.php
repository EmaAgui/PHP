<?php
include("../../bd.php");

if ($_POST) {
    $nombreArtista = isset($_POST["nombreArtista"]) ? $_POST["nombreArtista"] : "";

    $sentencia = $conexion->prepare("INSERT INTO artista (nombre) VALUES (:nombre)");
    $sentencia->bindParam(":nombre", $nombreArtista);
    $sentencia->execute();

    $mensaje = "Registro Creado";
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
                <label for="nombreArtista" class="form-label">Nombre del artista:</label>
                <input type="text" class="form-control" name="nombreArtista" id="nombreArtista" placeholder="Nombre del artista">
            </div>

            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>
