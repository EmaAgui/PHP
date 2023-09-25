<?php
include("../../bd.php");

if (isset($_GET['txtId'])) {
    $txtId = $_GET['txtId'];

    $sentencia = $conexion->prepare("SELECT c.*, a.nombre AS nombreArtista FROM canciones c INNER JOIN artista a ON c.idArtista = a.idArtista WHERE c.idCancion = :id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);
    $nombreArtista = $registro["nombreArtista"];
    $nombreCancion = $registro["nombreCancion"];
    $encuentro = $registro["encuentro"] ? 'Sí' : 'No';
    $santaCena = $registro["santaCena"] ? 'Sí' : 'No';
    $link = $registro["link"];
    $pdf = $registro["pdf"];
    $artistaIdAnterior = $registro["idArtista"];
}

if ($_POST) {
    $txtId = $_POST['txtId'];
    $artistaIdAnterior = $_POST["nombreArtista"];
    $nombreCancion = $_POST["nombreCancion"];
    $encuentro = $_POST["encuentro"] == 'Sí' ? true : false;
    $santaCena = $_POST["santaCena"] == 'Sí' ? true : false;
    $link = $_POST["link"];

    // Verificar si se seleccionó un nuevo archivo PDF
    if ($_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
        $pdfFile = $_FILES['pdf']['tmp_name'];
        $pdfDestination = '../pdf/' . $_FILES['pdf']['name'];

        // Eliminar el archivo PDF anterior
        if (!empty($pdf) && file_exists($pdf)) {
            unlink($pdf);
        }

        move_uploaded_file($pdfFile, $pdfDestination);
        $pdf = $pdfDestination;
    }

    $sentencia = $conexion->prepare("UPDATE canciones SET idArtista = :idArtista, encuentro = :encuentro, nombreCancion = :nombreCancion, santaCena = :santaCena, link = :link, pdf = :pdf WHERE idCancion = :id");
    $sentencia->bindParam(":idArtista", $artistaIdAnterior);
    $sentencia->bindParam(":encuentro", $encuentro, PDO::PARAM_BOOL);
    $sentencia->bindParam(":nombreCancion", $nombreCancion);
    $sentencia->bindParam(":santaCena", $santaCena, PDO::PARAM_BOOL);
    $sentencia->bindParam(":link", $link);
    $sentencia->bindParam(":pdf", $pdf);
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();

    $mensaje = "Registro Actualizado";
    header("Location: index.php?mensaje=" . $mensaje);
}

$sentencia = $conexion->prepare("SELECT * FROM `artista`");
$sentencia->execute();
$lista_artistas = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../templates/header.php"); ?>
<br>
<div class="card">
    <div class="card-header">
        Canciones
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="txtId" class="form-label">ID:</label>
                <input type="text" value="<?php echo $txtId; ?>" class="form-control" readonly name="txtId" id="txtId" aria-describedby="helpId" placeholder="ID">
            </div>
            <div class="mb-3">
                <label for="idArtista" class="form-label">Artista:</label>
                <select name="nombreArtista" id="nombreArtista" class="form-control">
                    <?php foreach($lista_artistas as $artista) { ?>
                        <option value="<?php echo $artista['idArtista']; ?>" <?php if($artista['idArtista'] == $artistaIdAnterior) echo 'selected'; ?>><?php echo $artista['nombre']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="nombreCancion" class="form-label">Nombre de la Canción:</label>
                <input type="text" value="<?php echo $nombreCancion; ?>" class="form-control" name="nombreCancion" id="nombreCancion" aria-describedby="helpId" placeholder="Nombre de la Canción">
            </div>
            <div class="mb-3">
                <label for="encuentro" class="form-label">Encuentro:</label>
                <select name="encuentro" id="encuentro" class="form-control">
                    <option value="Sí" <?php if ($encuentro == 'Sí') echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($encuentro == 'No') echo 'selected'; ?>>No</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="santaCena" class="form-label">Santa Cena:</label>
                <select name="santaCena" id="santaCena" class="form-control">
                    <option value="Sí" <?php if ($santaCena == 'Sí') echo 'selected'; ?>>Sí</option>
                    <option value="No" <?php if ($santaCena == 'No') echo 'selected'; ?>>No</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="link" class="form-label">Link:</label>
                <input type="text" value="<?php echo $link; ?>" class="form-control" name="link" id="link" aria-describedby="helpId" placeholder="Link">
            </div>
            <div class="mb-3">
                <label for="pdf" class="form-label">PDF:</label>
                <input type="file" name="pdf" id="pdf" aria-describedby="helpId">
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
</div>
<?php include("../../templates/footer.php"); ?>
