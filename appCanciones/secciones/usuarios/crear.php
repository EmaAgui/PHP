<?php 
include("../../bd.php");
if($_POST){
    ///recolección de datos de metodo post, formulario
    $usuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");
    $password=(isset($_POST["password"])?$_POST["password"]:"");
    $correo=(isset($_POST["correo"])?$_POST["correo"]:"");
    ///Preparo la insercion de datos
    $sentencia=$conexion->prepare("INSERT INTO usuarios (id,usuario,password,correo) VALUES (null, :usuario, :password, :correo)");
    ///asignando valores que vienen del metodo post(formulario)
    $sentencia->bindParam(":usuario", $usuario);///binparam es para asignar valores a los parametros de la sentencia
    $sentencia->bindParam(":password", $password);///binparam es para asignar valores a los parametros de la sentencia
    $sentencia->bindParam(":correo", $correo);///binparam es para asignar valores a los parametros de la sentencia
    $sentencia->execute();///ejecutar la sentencia
    $mensaje = "Registro Creado";
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
              <label for="usuario" class="form-label">Nombre del usuario:</label>
              <input type="text"
                class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password"
                class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña">
            </div>
            <div class="mb-3">
              <label for="correo" class="form-label">Correo:</label>
              <input type="email"
                class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo">
            </div>

            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    
</div>


<?php include("../../templates/footer.php"); ?>