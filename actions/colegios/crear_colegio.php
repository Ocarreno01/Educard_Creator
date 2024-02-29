<?php
// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el archivo de conexión a la base de datos
    include "../configuracion/conexion.php";

    // Recuperar los datos del formulario
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $ciudad = $_POST["ciudad"];
    $estado = $_POST["estado"];

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO colegios (nombre, direccion, ciudad, estado) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute([$nombre, $direccion, $ciudad, $estado]);

    // Validar el resultado y mostrar un mensaje de éxito o error
    if ($success) {
        // Mostrar alerta de éxito
        echo '<script>alert("Los datos se han insertado correctamente.");</script>';
    } else {
        // Mostrar alerta de error
        echo '<script>alert("Ha ocurrido un error al insertar los datos.");</script>';
    }

    // Redirigir al usuario de vuelta a la página principal
    echo '<script>window.location.href = "../vistas/procesar_colegio.php";</script>';
    exit(); // Salir del script para evitar que se procese más código
}
