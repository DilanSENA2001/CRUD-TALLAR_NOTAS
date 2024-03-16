<?php
include("conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Realizar la eliminación en la base de datos
    $sql = "DELETE FROM notas WHERE id = '$id'";
    if ($conection->query($sql) === TRUE) {
        echo "<script>
                alert('Empleado eliminado correctamente.');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "Error al eliminar la nota: " . $conection->error;
    }
} else {
    echo "No se proporcionó un ID de empleado válido.";
}
?>
