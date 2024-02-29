<?php
// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["colegio_id"])) {
    // Incluir el archivo de conexión a la base de datos
    include "../configuracion/conexion.php";

    // Obtener el ID del colegio a eliminar
    $colegio_id = $_POST["colegio_id"];

    // Preparar y ejecutar la consulta para eliminar el colegio
    $sql = "DELETE FROM colegios WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute([$colegio_id]);

    // Verificar si la eliminación fue exitosa y redirigir al usuario
    if ($success) {
        // Mostrar alerta de éxito
        echo '<script>alert("Los datos se han eliminado correctamente.");</script>';
    } else {
        // Mostrar alerta de error
        echo '<script>alert("Ha ocurrido un error al insertar los datos.");</script>';
    }

    // Redirigir al usuario de vuelta a la página principal
    echo '<script>window.location.href = "../vistas/procesar_colegio.php";</script>';
    exit(); // Salir del script para evitar que se procese más código
}
