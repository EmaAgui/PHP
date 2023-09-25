<?php
include("../../bd.php");

if(isset($_GET['txtId'])){
    $txtId = (isset($_GET['txtId']) ? $_GET['txtId'] : "");
    
    $sentencia = $conexion->prepare("SELECT * FROM `usuarios` WHERE `id` = :id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();
    
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);///PDO::FETCH_LAZY es para que no se ejecute la consulta hasta que se necesite
   
    $usuario=$registro["usuario"];
    $password=$registro["password"];
    $correo=$registro["correo"];
} 

if($_POST){
    ///recolección de datos de metodo post, formulario
    $txtId=(isset($_POST["txtId"])?$_POST["txtId"]:"");
    $usuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");
    $password=(isset($_POST["password"])?$_POST["password"]:"");
    $correo=(isset($_POST["correo"])?$_POST["correo"]:"");
    ///Preparo la insercion de datos
    $sentencia=$conexion->prepare("UPDATE usuarios SET usuario = :usuario, password = :password, correo = :correo WHERE id = :id");
    ///asignando valores que vienen del metodo post(formulario)
    $sentencia->bindParam(":usuario", $usuario);///binparam es para asignar valores a los parametros de la sentencia
    $sentencia->bindParam(":password", $password);///binparam es para asignar valores a los parametros de la sentencia
    $sentencia->bindParam(":correo", $correo);///binparam es para asignar valores a los parametros de la sentencia
    $sentencia->bindParam(":id", $txtId);///binparam es para asignar valores a los parametros de la sentencia
    $sentencia->execute();///ejecutar la sentencia
    $mensaje = "Registro Actualizado";
    header("Location: index.php?mensaje=".$mensaje);///redireccionar a la pagina de inicio
}
?>

<?php include("../../templates/header.php"); ?>
<br>
<div class="card">
    <div class="card-header">
        Datos del usuario
    </div>
    <div class="card-body">
        
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="txtId" class="form-label"><img src="image source" class="img-fluid rounded-top" alt="">ID:</label>
                <input type="text"
                value="<?php echo $txtId; ?>"
                class="form-control" readonly name="txtId" id="txtId" aria-describedby="helpId" placeholder="ID">
            </div> 
            
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del usuario:</label>
                <input type="text"
                value="<?php echo $usuario; ?>"
                class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password"
              value="<?php echo $password; ?>"
              class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña">
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email"
                value="<?php echo $correo; ?>"
                class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo">
            </div>

            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    
</div>

<?php include("../../templates/footer.php"); ?>