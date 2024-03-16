<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Notas</title>
</head>
<body>

<div class="container">
    <h1  style="text-align:center">.: Edita la Nota :.</a></h1>
    <hr>

    <?php
    include("conexion.php");

    if (isset($_GET['id'])) { 
        $id = $_GET['id'];
        $sql = "SELECT * FROM notas WHERE id = '$id'";
        $result = $conection->query($sql);

        if ($result->num_rows > 0) {
            $notas = $result->fetch_assoc();
            echo "
            <form action='actualizar.php' method='POST' class='col-md-6'>
                <input type='hidden' name='id' value='{$notas['id']}'>
                <input type='text' name='texto' class='form-control mb-2' value='{$notas['texto']}'><br>
                <input type='text' name='prioridad' class='form-control mb-2' value='{$notas['prioridad']}'><br>
                <button type='submit' class='btn btn-primary'>Guardar Nota</button>
            </form>";
        } else {
            echo "No se encontró ninguna nota con ese ID.";
        }
    } else {
        echo "No se proporcionó un ID de nota válido.";
    }
    ?>

</div>
</body>
</html>
