<?php
// Incluir el archivo de conexión a la base de datos
include "../configuracion/conexion.php";
// Consultar la lista de colegios disponibles
$sqlColegios = "SELECT id, nombre FROM colegios";
$stmtColegios = $pdo->query($sqlColegios);
$colegios = $stmtColegios->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Curso</title>
    <link rel="stylesheet" href="../estilos/estilos_generales.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <header>
        <h1>Sistema de Gestión Escolar</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../vistas/vista_principal.php">Inicio</a></li>
            <li><a href="../vistas/procesar_colegio.php">Procesar Colegios</a></li>
            <li><a href="../vistas/procesar_curso.php">Procesar Cursos</a></li>
        </ul>
    </nav>

    <h1 id="crear_boton_curso">Crear Curso</h1>
    <form id="crear_formulario_curso" action="../actions/cursos/crear_curso.php" method="POST">
        <label for="nombre">Nombre del Curso:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="colegio_id">Colegio:</label><br>
        <select id="colegio_id" name="colegio_id" required>
            <option value="">Seleccione un colegio</option>
            <?php foreach ($colegios as $colegio) : ?>
                <option value="<?php echo $colegio['id']; ?>"><?php echo $colegio['nombre']; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <input type="submit" value="Crear Curso">
    </form>


    <?php
    include "../configuracion/conexion.php";

    $sql = "SELECT cursos.id, cursos.nombre AS nombre_curso, colegios.nombre AS nombre_colegio
    FROM cursos
    INNER JOIN colegios ON cursos.colegio_id = colegios.id";
    $stmt = $pdo->query($sql);

    $cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php if (!empty($cursos)) : ?> <!-- Verificar si hay colegios -->
        <h1>Listado de Cursos</h1>
        <table>
            <thead>
                <tr>
                    <th>Nombre curso</th>
                    <th>Nombre colegio</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($cursos as $curso) : ?>
                    <tr>
                        <td><?php echo  $curso['nombre_curso']; ?></td>
                        <td><?php echo  $curso['nombre_colegio']; ?></td>

                        <td>
                            <form action="../actions/cursos/eliminar_curso.php" method="POST">
                                <input type="hidden" name="curso_id" value="<?php echo $curso['id']; ?>">
                                <input type="submit" value="Eliminar">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif; ?>

    <script>
        $(document).ready(function() {
            // Ocultar el menú al cargar la página
            $("#crear_formulario_curso").hide();

            // Alternar visibilidad del menú al hacer clic en el título
            $("#crear_boton_curso").click(function() {
                $("#crear_formulario_curso").toggle();
            });
        });
    </script>

</body>

</html>