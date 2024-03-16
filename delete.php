<?php
include("conection.php");

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Realiza la eliminación en la base de datos
    $sql = "DELETE FROM notas WHERE id = '$id'";
    
    if ($conection->query($sql) === TRUE) {
        echo "<script>
            alert('Empresa eliminada correctamente.');
            window.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Error al eliminar la empresa: " . $conection->error . "');
            window.location.href = 'index.php';
        </script>";
    }
} else {
    echo "<script>
        alert('ID de la empresa no proporcionado.');
        window.location.href = 'index.php';
    </script>";
}
?>

