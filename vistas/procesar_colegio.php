<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Colegio</title>
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

    <h1 id="crear_boton">Crear Colegio</h1>

    <form id="crear_formulario" action="../actions/colegios/crear_colegio.php" method="POST">
        <label for="nombre">Nombre del Colegio:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="direccion">Dirección:</label><br>
        <input type="text" id="direccion" name="direccion" required><br><br>

        <label for="ciudad">Ciudad:</label><br>
        <input type="text" id="ciudad" name="ciudad" required><br><br>

        <label for="estado">Estado:</label><br>
        <input type="text" id="estado" name="estado" required><br><br>

        <input type="submit" value="Crear Colegio">
    </form>




    <?php
    include "../configuracion/conexion.php";

    $sql = "SELECT * FROM colegios";
    $stmt = $pdo->query($sql);

    $colegios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php if (!empty($colegios)) : ?> <!-- Verificar si hay colegios -->
        <h1>Listado de Colegios</h1>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Ciudad</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($colegios as $colegio) : ?>
                    <tr>
                        <td><?php echo $colegio['nombre']; ?></td>
                        <td><?php echo $colegio['direccion']; ?></td>
                        <td><?php echo $colegio['ciudad']; ?></td>
                        <td><?php echo $colegio['estado']; ?></td>
                        <td>
                            <form action="../actions/colegios/eliminar_colegio.php" method="POST">
                                <input type="hidden" name="colegio_id" value="<?php echo $colegio['id']; ?>">
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
            $("#crear_formulario").hide();

            // Alternar visibilidad del menú al hacer clic en el título
            $("#crear_boton").click(function() {
                $("#crear_formulario").toggle();
            });
        });
    </script>
</body>

</html>