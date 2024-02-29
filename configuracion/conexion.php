<?php
// Información de conexión a la base de datos
$host = 'localhost'; // Cambia 'localhost' si tu servidor MySQL está en otro host
$dbname = 'colegio_proyecto'; // Cambia 'nombre_de_tu_base_de_datos' por el nombre de tu base de datos
$username = 'root'; // Cambia 'tu_usuario' por el nombre de usuario de tu base de datos
$password = ''; // Cambia 'tu_contraseña' por la contraseña de tu base de datos

try {
    // Conexión a la base de datos utilizando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Configuración de PDO para manejar excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Otras configuraciones opcionales de PDO, si es necesario
} catch (PDOException $e) {
    // Manejo de errores
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>
