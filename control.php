<?php
session_start();

include('conexion.php');

$usuario = $_POST['usuario'];
$clave = $_POST['pass'];

// Escapar los valores para evitar SQL injection (se recomienda usar consultas preparadas)
$usuario = $conection->real_escape_string($usuario);
$clave = $conection->real_escape_string($clave);

// Hashear la contraseña (si está guardada en la base de datos como hash)
// $clave = md5($clave);

$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND password = '$clave'";
$result = $conection->query($sql);

if ($result && $result->num_rows > 0) {
    $datos = $result->fetch_assoc();

    $_SESSION["logueado"] = "si";
    $_SESSION["user"] = $datos['usuario'];
    $_SESSION["name"] = $datos['nombre'];
    $_SESSION["rol_id"] = $datos['rol_id'];
    $_SESSION["usuario_id"] = $datos['id'];
	$_SESSION["prioridad"] = $datos['prioridad'];
	


    header("Location: index.php");
} else {
    header("Location: login.php?error=si");
}
?>