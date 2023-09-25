<?php
include("../../bd.php");

if ($_POST) {
    // Recolección de datos del formulario mediante el método POST
    $nombreCancion = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
    $idArtista = (isset($_POST["idArtista"]) ? $_POST["idArtista"] : "");
    $encuentro = (isset($_POST["encuentro"]) ? $_POST["encuentro"] : "");
    $santaCena = (isset($_POST["santaCena"]) ? $_POST["santaCena"] : "");
    $link = (isset($_POST["link"]) ? $_POST["link"] : "");

    // Preparación de la inserción de datos
    $sentencia = $conexion->prepare("INSERT INTO canciones (nombreCancion, idArtista, encuentro, santaCena, link, pdf) VALUES (:nombreCancion, :idArtista, :encuentro, :santaCena, :link, :pdf)");

    // Procesamiento del archivo PDF adjunto
    $pdfFile = $_FILES["pdf"]["tmp_name"];
    $pdfFileName = $_FILES["pdf"]["name"];
    $pdfDestination = "../pdf/" . $pdfFileName;
    move_uploaded_file($pdfFile, $pdfDestination);

    // Asignación de valores a los parámetros de la sentencia
    $sentencia->bindParam(":nombreCancion", $nombreCancion);
    $sentencia->bindParam(":idArtista", $idArtista);
    $sentencia->bindParam(":encuentro", $encuentro);
    $sentencia->bindParam(":santaCena", $santaCena);
    $sentencia->bindParam(":link", $link);
    $sentencia->bindParam(":pdf", $pdfDestination);

    // Ejecución de la sentencia
    $sentencia->execute();

    $mensaje = "Canción creada";
    header("Location: index.php?mensaje=" . $mensaje);
}

$sentencia = $conexion->prepare("SELECT * FROM `artista`");
$sentencia->execute();
$lista_artistas = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../templates/header.php"); ?>
<br>
<h1>Guardar Canciones</h1>
    <div class="formulario">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="nombre">
                <label for="nombre">Nombre de la Canción</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre de la canción">
            </div>

            <div class="idArtista">
                <label for="idArtista">Artista</label>
                <select name="idArtista" id="artista">
                    <?php foreach($lista_artistas as $artista) { ?>
                        <option value="<?php echo $artista['idArtista']; ?>"><?php echo $artista['nombre']; ?></option>
                    <?php } ?>
                </select>            
            </div>

            <div class="encuentro">
                <label for="encuentro">Encuentro</label>
                <select name="encuentro" id="encuentro">
                    <option value="1">Si</option>
                    <option value="2">No</option>
                </select>
            </div>
            <div class="santaCena">
                <label for="santaCena">Santa Cena</label>
                <select name="santaCena" id="santaCena">
                    <option value="1">Si</option>
                    <option value="2">No</option>
                </select>
            </div>
            <div class="link">
                <label for="link">Link</label>
                <input type="text" name="link" id="link" placeholder="Link de la canción">
            </div>
            <div class="pdf">
                <label for="pdf">PDF de la canción:</label>
                <input type="file" name="pdf" id="pdf" accept=".pdf">
            </div>
            <input type="submit" value="Guardar">
        </form>
    </div>

<?php include("../../templates/footer.php"); ?>
