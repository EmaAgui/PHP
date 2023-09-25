<?php
include("../../bd.php");

if (isset($_GET['txtId'])) {
    $txtId = $_GET['txtId'];

    // Obtener el nombre del archivo PDF asociado a la canción
    $sentencia = $conexion->prepare("SELECT pdf FROM canciones WHERE idCancion = :id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);
    $pdf = $registro["pdf"];

    // Eliminar la canción de la base de datos
    $sentencia = $conexion->prepare("DELETE FROM canciones WHERE idCancion = :id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();

    // Eliminar el archivo PDF si existe
    if (!empty($pdf)) {
        unlink($pdf);
    }

    $mensaje = "Registro Eliminado";
    header("Location: index.php?mensaje=" . $mensaje);
}

$sentencia = $conexion->prepare("SELECT canciones.*, artista.nombre AS nombreArtista FROM canciones INNER JOIN artista ON canciones.idArtista = artista.idArtista");
$sentencia->execute();
$lista_canciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../templates/header.php"); ?>

<br>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">Nombre de la canción</th>
                        <th scope="col">Artista</th>
                        <th scope="col">Encuentro</th>
                        <th scope="col">Santa Cena</th>
                        <th scope="col">Link YT</th>
                        <th scope="col">Acordes / Letra</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_canciones as $cancion) { ?>
                        <tr>
                            <td><?php echo $cancion['nombreCancion']; ?></td>
                            <td><?php echo $cancion['nombreArtista']; ?></td>
                            <td><?php echo ($cancion['encuentro'] == '1') ? 'Sí' : 'No'; ?></td>
                            <td><?php echo ($cancion['santaCena'] == '1') ? 'Sí' : 'No'; ?></td>
                            <td>
                                <a href="<?php echo $cancion['link']; ?>" target="_blank"><?php echo $cancion['link']; ?></a>
                            </td>
                            <td>
                                <?php if (!empty($cancion['pdf'])) { ?>
                                    <a href="<?php echo $cancion['pdf']; ?>" target="_blank">Descargar PDF</a>
                                <?php } else { ?>
                                    No disponible
                                <?php } ?>
                            </td>
                            <td>
                                <a name="" id="" class="btn btn-info" href="editar.php?txtId=<?php echo $cancion['idCancion']; ?>" role="button">Editar</a>
                                <a name="" id="" class="btn btn-danger" href="index.php?txtId=<?php echo $cancion['idCancion']; ?>" role="button">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>
