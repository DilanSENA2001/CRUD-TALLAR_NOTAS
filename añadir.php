<!DOCTYPE html>
<html lang="en">
<head>
    <title>Agregar notas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

<div class="container">

<?php
include('conexion.php');
session_start();

if (isset($_POST['enviar'])) {
    $tex = $_POST['texto'];
    $prio = $_POST['prioridad'];
    $u_id = $_SESSION['usuario_id'];

    include("conexion.php");

    $sql = "INSERT INTO notas (texto, prioridad, usuario_id) VALUES ('$tex', '$prio', '$u_id')";
    $result = $conection->query($sql);

    if ($result) {
        echo "<script language='JavaScript'>
            alert('Los datos fueron agregados correctamente');
            window.location.href = 'index.php';
        </script>";
    } else {
        echo "<script language='JavaScript'>
            alert('Los datos no fueron agregados correctamente');
            window.location.href = 'index.php';
        </script>";
    }
}
?>

<h1>.: Agregar una nueva nota :.</h1>

<form action="<?=$_SERVER['PHP_SELF']?>" method="POST" class="col-md-6"> 
    <input type="text" name="texto" placeholder="Ingrese su texto" class="form-control mb-2" required>
    <select id="prioridad" name="prioridad" class="form-control mb-2" required>
        <option value="">Seleccione la prioridad</option>
        <option value="1">BAJA</option>
        <option value="2">MEDIA</option>
        <option value="3">ALTA</option>
    </select> 
    <input type="submit" name="enviar" value="AGREGAR" class="btn btn-success mt-3">
</form>
</div>
</body>
</html>
