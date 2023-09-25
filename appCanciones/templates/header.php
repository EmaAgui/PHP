<?php
session_start();
$urlBase="http://localhost/appCanciones/";
if(!$_SESSION['usuario'])//si no esta logueado
{
    header("Location: ".$urlBase."login.php");
}
    
?>
<!doctype html>
<html lang="es">
<head>
  <title>Canciones</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
   <!-- jquery--> 
   <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <!-- sweetalert2 -->
    <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="../../css/styles.css">

</head>
<body>
  <header>
    <!-- place navbar here -->
  </header>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo $urlBase;?>" aria-current="page">Inicio<span class="visually-hidden">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $urlBase;?>secciones/canciones/">Lista de Canciones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $urlBase;?>secciones/artistas/">Lista Artistas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $urlBase;?>cerrar.php">Cerrar Sesión</a>
            </li>
        </ul>
    </nav>
  <main class="container">
  <?php if(isset($_GET['mensaje'])){?>
<script>
    Swal.fire({icon:"success", title:"<?php echo $_GET['mensaje']; ?>"})///alerta
</script>
<?php } ?>