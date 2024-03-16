<?php
// Inicia la sesión
session_start();

if (!isset($_SESSION['logueado'])) {
    // El usuario no está logueado, redirige a la página de login
    header("Location: login.php");
    exit(); // Asegura que el script se detenga después de redirigir
}

include("conexion.php");

// Definir el mapeo de prioridades
$mapaPrioridades = [
    1 => 'Baja',
    2 => 'Media',
    3 => 'Alta'
];

if ($_SESSION['rol_id'] == 1) {
    // Admin: ver y editar todas las notas
    $sql = "SELECT * FROM notas";
    $result = $conection->query($sql);
} elseif ($_SESSION['rol_id'] == 2) {
    // User: ver y editar solo sus notas
    $user_id = $_SESSION['usuario_id'];
    $sql = "SELECT * FROM notas WHERE usuario_id = $user_id";
    $result = $conection->query($sql);
} elseif ($_SESSION['rol_id'] == 3) {
    // Editor: ver y editar todas las notas
    $sql = "SELECT * FROM notas";
    $result = $conection->query($sql);
} else {
    // Otro rol desconocido o sin acceso
    echo "No tienes acceso a esta función.";
    exit(); // Detener la ejecución si el rol no está permitido
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        /* Estilos de los post-it */
        .post-it1 {
            background: #A9DFBF;
            color: #000;
            display: inline-block;
            vertical-align: top;
            margin: 10px;
            width: calc(33.3333% - 20px);
            height: auto;
            padding: 1em;
            box-shadow: 5px 5px 7px rgba(33, 33, 33, 1);
            transition: transform 0.15s linear, box-shadow 0.15s linear;
            cursor: grab;
        }

        .post-it2 {
            background: #F9E79F;
            color: #000;
            display: inline-block;
            vertical-align: top;
            margin: 10px;
            width: calc(33.3333% - 20px);
            height: auto;
            padding: 1em;
            box-shadow: 5px 5px 7px rgba(33, 33, 33, 1);
            transition: transform 0.15s linear, box-shadow 0.15s linear;
            cursor: grab;
        }

        .post-it3 {
            background: #CD6155;
            color: #000;
            display: inline-block;
            vertical-align: top;
            margin: 10px;
            width: calc(33.3333% - 20px);
            height: auto;
            padding: 1em;
            box-shadow: 5px 5px 7px rgba(33, 33, 33, 1);
            transition: transform 0.15s linear, box-shadow 0.15s linear;
            cursor: grab;
        }

        .post-it:active {
            cursor: grabbing;
        }

        .post-it:hover {
            box-shadow: 10px 10px 7px rgba(0, 0, 0, 0.7);
            transform: scale(1.25);
            z-index: 5;
        }

        /* Estilos del contenido de los post-it */
        .post-it .content {
            padding: 1em;
            box-sizing: border-box;
            word-wrap: break-word;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".post-it").draggable(); // Hace los post-it arrastrables
        });
    </script>
    <title>Notas</title>
</head>

<body>
    <div class="container">
        <h1 style="text-align:center">.: NOTAS :. <a href="cerrar_sesion.php" class="btn btn-primary float-end mt-2" style="margin-left: auto;">Cerrar sesión</a></h1>
        <hr>

        <?php
        while ($notas = $result->fetch_assoc()) {
            $colorClass = '';

            if ($notas['prioridad'] == 1) {
                $colorClass = 'post-it1';
            } elseif ($notas['prioridad'] == 2) {
                $colorClass = 'post-it2';
            } elseif ($notas['prioridad'] == 3) {
                $colorClass = 'post-it3';
            }

            echo "<div class='$colorClass' onclick='window.location=\"update.php?id={$notas['id']}\"'>";
            echo "<h4>{$notas['texto']}</h4>";
            echo "<p>Fecha: {$notas['fecha']}</p>";
            echo "<p>Prioridad: {$mapaPrioridades[$notas['prioridad']]}</p>";
            echo "<p>Usuario ID: {$notas['usuario_id']}</p>";

            // Agregar enlaces de edición y eliminación según el rol
            if ($_SESSION['rol_id'] == 1 || ($_SESSION['rol_id'] == 2 && $_SESSION['usuario_id'] == $notas['usuario_id']) || ($_SESSION['rol_id'] == 3 && $_SESSION['usuario_id'] == $notas['usuario_id'])) {
                echo "<a href='update.php?id={$notas['id']}' class='btn btn-primary'>Editar</a>&nbsp;";

                // Agregar el botón de eliminar solo si el rol no es 3 (Editor)
                if ($_SESSION['rol_id'] != 3) {
                    echo "<a href='eliminar.php?id={$notas['id']}' class='btn btn-danger'>Eliminar</a>";
                }
            }

            echo "</div>";
        }
        ?>

        <!-- Agregar una nueva nota solo para roles de Usuario y Admin -->
        <?php
        if ($_SESSION['rol_id'] == 1 || $_SESSION['rol_id'] == 2) {
            echo "<a href='añadir.php' class='btn btn-secondary float-end mt-2'>Agregar una nueva nota</a>";
        }
        ?>

    </div>
</body>

</html>
