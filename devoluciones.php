<?php include("templates/cabecera.php"); ?>
<?php include_once("conectar.php"); ?>

<?php
$obj = new OperacionesBd();
$libro_info = [];
$usuario_info = [];

// Proceso para buscar el libro y el usuario que lo tiene prestado
if (isset($_POST['buscar_libro']) || isset($_POST['devolver_libro'])) {
    if (isset($_POST['buscar_libro'])) {
        $id_local = $_POST['id_local'];

        $sql_libro = "
            SELECT libros.id_libros, libros.id_local, libros.titulo, libros.nom_autor, libros.genero, libros.estatus, 
                   usuarios.id_usuarios, usuarios.nom, usuarios.ap, usuarios.am 
            FROM libros 
            LEFT JOIN movimientos ON libros.id_libros = movimientos.id_libros 
            LEFT JOIN usuarios ON movimientos.id_usuarios = usuarios.id_usuarios 
            WHERE libros.id_local = '$id_local' AND libros.estatus = 1
        ";
        $resultado_libro = $obj->mostrardatos($sql_libro);

        if ($resultado_libro) {
            $libro_info = $resultado_libro[0];
        } else {
            echo "<script>alert('No se encontró ningún libro prestado con el ID Local proporcionado.'); window.location.href='devoluciones.php';</script>";
            exit;
        }
    }

    // Proceso para devolver el libro
    if (isset($_POST['devolver_libro'])) {
        $id_libros = $_POST['id_libros'];
        $sql_devolver_libro = "UPDATE libros SET estatus = 0 WHERE id_libros = '$id_libros'";
        if ($obj->actualizadatos($sql_devolver_libro)) {
            echo "<script>alert('Devolución registrada exitosamente.'); window.location.href='devoluciones.php';</script>";
            exit;
        } else {
            echo "<p>Error al registrar la devolución.</p>";
        }
    }
}
?>

<div class="container">
    <h2>Devolución de Libros</h2>

    <!-- Formulario para buscar el libro -->
    <form action="devoluciones.php" method="POST" class="needs-validation" novalidate>
        <div class="form-group">
            <label for="id_local">ID Local del Libro</label>
            <input type="text" class="form-control" id="id_local" name="id_local" value="<?php echo isset($libro_info['id_local']) ? $libro_info['id_local'] : ''; ?>" required>
            <button type="submit" name="buscar_libro" class="btn btn-primary mt-2">Buscar Libro</button>
        </div>
    </form>

    <?php if (!empty($libro_info)) { ?>
        <div class="mt-4">
            <h3>Información del Libro</h3>
            <p><strong>ID Local:</strong> <?php echo $libro_info['id_local']; ?></p>
            <p><strong>Título:</strong> <?php echo $libro_info['titulo']; ?></p>
            <p><strong>Autor:</strong> <?php echo $libro_info['nom_autor']; ?></p>
            <p><strong>Género:</strong> <?php echo $libro_info['genero']; ?></p>
            <p><strong>ID Libro:</strong> <?php echo $libro_info['id_libros']; ?></p>

            <?php if ($libro_info['estatus'] == 1) { ?>
                <h3>Información del Usuario</h3>
                <p><strong>Nombre:</strong> <?php echo $libro_info['nom']; ?></p>
                <p><strong>Apellido Paterno:</strong> <?php echo $libro_info['ap']; ?></p>
                <p><strong>Apellido Materno:</strong> <?php echo $libro_info['am']; ?></p>

                <!-- Formulario para devolver el libro -->
                <form action="devoluciones.php" method="POST" class="needs-validation" novalidate>
                    <input type="hidden" name="id_libros" value="<?php echo $libro_info['id_libros']; ?>">
                    <button type="submit" name="devolver_libro" class="btn btn-success mt-2">Devolver Libro</button>
                </form>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<?php include("templates/pie.php"); ?>