<?php
    include("../../bd.php");

    if(isset($_GET['txtId'])){
        $txtId = (isset($_GET['txtId']) ? $_GET['txtId'] : "");
        $sentencia = $conexion->prepare("DELETE FROM `artista` WHERE `idArtista` = :id");
        $sentencia->bindParam(":id", $txtId);
        $sentencia->execute();
        $mensaje = "Registro Eliminado";
        header("Location: index.php?mensaje=".$mensaje);
    } 

    $sentencia = $conexion->prepare("SELECT * FROM `artista`");
    $sentencia->execute();
    $lista_artistas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include("../../templates/header.php"); ?>

<br>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary"
        href="crear.php" role="button">Agregar Registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">Nombre del artista</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach($lista_artistas as $registro){ ?>
                    <tr class="">
                        <td><?php echo $registro['nombre'];?></td>
                        <td>
                            <a name="" id="" class="btn btn-info" href="editar.php?txtId=<?php echo $registro['idArtista']; ?>" role="button">Editar</a>
                            <a name="" id="" class="btn btn-danger" href="javascript:borrar(<?php echo $registro['idArtista']; ?>);" role="button">Eliminar</a>
                        </td>
                    </tr>
                <?php }?>
                    
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
    function borrar(id) {
        if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
            window.location.href = "index.php?txtId=" + id;
        }
    }
</script>

<?php include("../../templates/footer.php"); ?>
