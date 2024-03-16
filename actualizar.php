<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $texto = $_POST['texto'];
    $prioridad = $_POST['prioridad'];

    // Realiza la actualización en la base de datos
    $sql = "UPDATE notas SET texto = '$texto', prioridad = '$prioridad' WHERE id = '$id'";

    if ($conection->query($sql) === TRUE) {
        echo "<script>
            alert('Datos actualizados correctamente.');
            window.location.href = 'index.php'; // Redirige a la lista de notas
        </script>";
    } else {
        echo "Error al actualizar los datos: " . $conection->error;
    }
} else {
    echo "Solicitud no válida.";
}
?>
