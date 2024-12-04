<?php include("templates/cabecera.php"); ?>

<?php
// Comprobar si se recibe un ID para actualizar
if (!empty($_GET['actualiza_libros'])) {
    include_once("conectar.php"); // Asegurar inclusión única
    $conexion = new OperacionesBd();
    $editar = $_GET['actualiza_libros'];
    $sql = "SELECT * FROM libros WHERE id_libros = '$editar';";
    $resultado = $conexion->mostrardatos($sql);

    foreach ($resultado as $row) {
?>

<div class="border border-start-0 shadow p-3 mb-5 bg-body-tertiary rounded">
    <div class="container-fluid bg-warning text-center">
        <h2>ACTUALIZACIÓN DE DATOS EN LIBROS</h2>
    </div>

    <!-- Formulario para actualizar los datos -->
    <form action="actualizar_libros.php" method="POST" class="row g-3 needs-validation pt-3" novalidate>
        <input type="hidden" name="id_libros" value="<?php echo $row['id_libros']; ?>">
        
        <div class="col-md-4">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" class="form-control" id="isbn" value="<?php echo $row['isbn']; ?>" name="isbn" required>
        </div>
        <div class="col-md-4">
            <label for="titulo" class="form-label">TÍTULO</label>
            <input type="text" class="form-control" id="titulo" value="<?php echo $row['titulo']; ?>" name="titulo" required>
        </div>
        <div class="col-md-4">
            <label for="genero" class="form-label">GÉNERO</label>
            <input type="text" class="form-control" id="genero" value="<?php echo $row['genero']; ?>" name="genero" required>
        </div>
        <div class="col-md-4">
            <label for="editorial" class="form-label">EDITORIAL</label>
            <input type="text" class="form-control" id="editorial" value="<?php echo $row['editorial']; ?>" name="editorial" required>
        </div>
        <div class="col-md-4">
            <label for="edicion" class="form-label">EDICIÓN</label>
            <input type="text" class="form-control" id="edicion" value="<?php echo $row['edicion']; ?>" name="edicion" required>
        </div>
        
        <div class="col-md-2">
            <label for="ano_publ" class="form-label">AÑO DE PUBLICACIÓN</label>
            <?php $cont = date('Y'); ?>
            <select class="form-control" id="ano_publ" name="ano_publ" required>
                <option value="<?php echo $row['ano_publ']; ?>"><?php echo $row['ano_publ']; ?></option>
                <?php while ($cont >= 1850) { ?>
                    <option value="<?php echo $cont; ?>"><?php echo $cont; ?></option>
                <?php $cont--; } ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="nom_autor" class="form-label">NOMBRE DEL AUTOR</label>
            <input type="text" class="form-control" id="nom_autor" value="<?php echo $row['nom_autor']; ?>" name="nom_autor" required>
        </div>
        <div class="col-md-4">
            <label for="ap_autor" class="form-label">APELLIDO PATERNO</label>
            <input type="text" class="form-control" id="ap_autor" value="<?php echo $row['ap_autor']; ?>" name="ap_autor" required>
        </div>
        <div class="col-md-4">
            <label for="am_autor" class="form-label">APELLIDO MATERNO</label>
            <input type="text" class="form-control" id="am_autor" value="<?php echo $row['am_autor']; ?>" name="am_autor" required>
        </div>
        <div class="col-12 text-center">
            <button class="btn btn-primary" type="submit" name="actualizar" value="Guardar">Guardar</button>
            <a href="libros_registrados.php" class="btn btn-primary">Cancelar</a>
        </div>
    </form>
</div>

<?php
    }
}
?>

<?php
// Procesar datos enviados por el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
    include_once('conectar.php'); // Asegurar inclusión única
    $obj = new OperacionesBd();

    // Recuperar datos del formulario
    $id_libros = $_POST['id_libros'];
    $isbn = $_POST['isbn'];
    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $editorial = $_POST['editorial'];
    $edicion = $_POST['edicion'];
    $ano_publ = $_POST['ano_publ'];
    $nom_autor = $_POST['nom_autor'];
    $ap_autor = $_POST['ap_autor'];
    $am_autor = $_POST['am_autor'];

    // Actualizar el registro en la base de datos
    $sql = "UPDATE libros SET 
                isbn = '$isbn', 
                titulo = '$titulo', 
                genero = '$genero', 
                editorial = '$editorial', 
                edicion = '$edicion', 
                ano_publ = '$ano_publ', 
                estatus = '$estatus', 
                nom_autor = '$nom_autor', 
                ap_autor = '$ap_autor', 
                am_autor = '$am_autor' 
            WHERE id_libros = '$id_libros';";

if ($obj->actualizadatos($sql)) {
    header("Location: libros_registrados.php"); // Redirige si fue exitoso
    exit;
} else {
    echo "<p>Error al actualizar el registro</p>";
}
}
?>

<?php include("templates/pie.php"); ?>