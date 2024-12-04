<?php include("templates/cabecera.php"); ?>
<?php include_once("conectar.php"); ?>

<?php
$obj = new OperacionesBd();
$libro_info = [];
$usuario_info = [];

// Proceso para buscar el libro
if (isset($_POST['buscar_libro']) || isset($_POST['buscar_usuario']) || isset($_POST['prestar_libro'])) {
    if (isset($_POST['buscar_libro'])) {
        $id_local = $_POST['id_local'];

        $sql_libro = "SELECT * FROM libros WHERE id_local = '$id_local'";
        $resultado_libro = $obj->mostrardatos($sql_libro);

        if ($resultado_libro) {
            $libro_info = $resultado_libro[0];
            if ($libro_info['estatus'] == 1) {
                echo "<script>alert('El libro ya está prestado'); window.location.href='prestamos.php';</script>";
                exit;
            }
        } else {
            echo "<p>No se encontró ningún libro con el ID Local proporcionado.</p>";
        }
    }

    // Mantener los datos del libro
    if (!empty($_POST['id_libros'])) {
        $libro_info['id_libros'] = $_POST['id_libros'];
        $libro_info['id_local'] = $_POST['id_local'];
        $libro_info['titulo'] = $_POST['titulo'];
        $libro_info['nom_autor'] = $_POST['nom_autor'];
        $libro_info['genero'] = $_POST['genero'];
    }

    if (isset($_POST['buscar_usuario'])) {
        $nocontrol_rfc = $_POST['nocontrol_rfc'];

        $sql_usuario = "SELECT * FROM usuarios WHERE nocontrol_rfc = '$nocontrol_rfc'";
        $resultado_usuario = $obj->mostrardatos($sql_usuario);

        if ($resultado_usuario) {
            $usuario_info = $resultado_usuario[0];
        } else {
            echo "<p>No se encontró ningún usuario con el RFC proporcionado.</p>";
        }
    }
}

// Proceso para registrar el préstamo
if (isset($_POST['prestar_libro'])) {
    $id_libros = $_POST['id_libros'];
    $id_local = $_POST['id_local'];
    $id_usuarios = $_POST['id_usuarios'];
    $fecha_prestamo = date('Y-m-d');
    $estado = 1; // Estado de préstamo: 1 (prestado)

    $sql_actualizar_libro = "UPDATE libros SET estatus = '$estado' WHERE id_libros = '$id_libros'";
    $sql_registrar_movimiento = "INSERT INTO movimientos (id_libros, id_local, id_usuarios, fecha_prestamo) VALUES ('$id_libros', '$id_local', '$id_usuarios', '$fecha_prestamo')";

    if ($obj->actualizadatos($sql_actualizar_libro) && $obj->actualizadatos($sql_registrar_movimiento)) {
        echo "<script>alert('Préstamo registrado exitosamente.'); window.location.href='prestamos.php';</script>";
        exit;
    } else {
        echo "<p>Error al registrar el préstamo.</p>";
    }
}
?>

<div class="container">
    <h2>Préstamo de Libros</h2>

    <!-- Formulario combinado para buscar libro y usuario -->
    <form action="prestamos.php" method="POST" class="needs-validation" novalidate>
        <div class="form-group">
            <label for="id_local">ID Local del Libro</label>
            <input type="text" class="form-control" id="id_local" name="id_local" value="<?php echo isset($libro_info['id_local']) ? $libro_info['id_local'] : ''; ?>" required>
            <button type="submit" name="buscar_libro" class="btn btn-primary mt-2">Buscar Libro</button>
        </div>

        <?php if (!empty($libro_info)) { ?>
            <div class="mt-4">
                <h3>Información del Libro</h3>
                <p><strong>Título:</strong> <?php echo $libro_info['titulo']; ?></p>
                <p><strong>Autor:</strong> <?php echo $libro_info['nom_autor']; ?></p>
                <p><strong>Género:</strong> <?php echo $libro_info['genero']; ?></p>
                <p><strong>ID Libro:</strong> <?php echo $libro_info['id_libros']; ?></p>
                <!-- Campos ocultos para mantener los datos del libro -->
                <input type="hidden" name="id_libros" value="<?php echo $libro_info['id_libros']; ?>">
                <input type="hidden" name="titulo" value="<?php echo $libro_info['titulo']; ?>">
                <input type="hidden" name="nom_autor" value="<?php echo $libro_info['nom_autor']; ?>">
                <input type="hidden" name="genero" value="<?php echo $libro_info['genero']; ?>">
            </div>
        <?php } ?>

        <div class="form-group mt-4">
            <label for="nocontrol_rfc">No. de Control RFC del Usuario</label>
            <input type="text" class="form-control" id="nocontrol_rfc" name="nocontrol_rfc" value="<?php echo isset($usuario_info['nocontrol_rfc']) ? $usuario_info['nocontrol_rfc'] : ''; ?>" required>
            <button type="submit" name="buscar_usuario" class="btn btn-primary mt-2">Buscar Usuario</button>
        </div>

        <?php if (!empty($usuario_info)) { ?>
            <div class="mt-4">
                <h3>Información del Usuario</h3>
                <p><strong>Nombre:</strong> <?php echo $usuario_info['nom']; ?></p>
                <p><strong>Apellido Paterno:</strong> <?php echo $usuario_info['ap']; ?></p>
                <p><strong>Apellido Materno:</strong> <?php echo $usuario_info['am']; ?></p>
                <p><strong>ID Usuario:</strong> <?php echo $usuario_info['id_usuarios']; ?></p>
                <!-- Campos ocultos para mantener los datos del usuario -->
                <input type="hidden" name="id_usuarios" value="<?php echo $usuario_info['id_usuarios']; ?>">
                <input type="hidden" name="nom" value="<?php echo $usuario_info['nom']; ?>">
                <input type="hidden" name="ap" value="<?php echo $usuario_info['ap']; ?>">
                <input type="hidden" name="am" value="<?php echo $usuario_info['am']; ?>">
            </div>
        <?php } ?>

        <?php if (!empty($libro_info) && !empty($usuario_info)) { ?>
            <div class="form-group mt-4">
                <button type="submit" name="prestar_libro" class="btn btn-success">Prestar Libro</button>
            </div>
        <?php } ?>
    </form>
</div>

<?php include("templates/pie.php"); ?>