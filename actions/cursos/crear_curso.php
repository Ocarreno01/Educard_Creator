<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "../configuracion/conexion.php";
    $nombre = $_POST["nombre"];
    $colegio_id = $_POST["colegio_id"];

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO cursos (nombre, colegio_id) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute([$nombre, $colegio_id]);

    // Validar el resultado y mostrar un mensaje de éxito o error
    if ($success) {
        // Mostrar alerta de éxito
        echo '<script>alert("Los datos se han insertado correctamente.");</script>';
    } else {
        // Mostrar alerta de error
        echo '<script>alert("Ha ocurrido un error al insertar los datos.");</script>';
    }

    // Redirigir al usuario de vuelta a la página principal
    echo '<script>window.location.href = "../vistas/procesar_curso.php";</script>';
    exit(); // Salir del script para evitar que se procese más código
}
