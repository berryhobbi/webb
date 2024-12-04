<?php include("templates/cabecera.php"); ?>
<?php
// Comprobar si se recibe un ID para actualizar
if (!empty($_GET['actualiza_alumnos'])) {
    include_once("conectar.php"); // Asegurar inclusión única
    $conexion = new OperacionesBd();
    $editar = $_GET['actualiza_alumnos'];
    $sql = "SELECT * FROM usuarios WHERE id_usuarios = '$editar';";
    $resultado = $conexion->mostrardatos($sql);
    foreach ($resultado as $row) {
?>
<div class="border border-start-0 shadow p-3 mb-5 bg-body-tertiary rounded">
    <div class="container-fluid bg-warning text-center">
        <h2>ACTUALIZACIÓN DE DATOS DE ALUMNOS</h2>
    </div>
    <!-- Formulario para actualizar los datos -->
    <form action="actualizar_alumnos.php" method="POST" class="row g-3 needs-validation pt-3" novalidate>
        <input type="hidden" name="id_usuarios" value="<?php echo $row['id_usuarios']; ?>">
        <div class="col-md-4">
            <label for="titulo" class="form-label">IDENTIFICADOR</label>
            <input type="text" class="form-control" id="identificador" value="<?php echo $row['identificador']; ?>" name="identificador" required>
        </div>
        <div class="col-md-4">
            <label for="titulo" class="form-label">NO. CONTROL</label>
            <input type="text" class="form-control" id="nocontrol_rfc" value="<?php echo $row['nocontrol_rfc']; ?>" name="nocontrol_rfc" required>
        </div>
        <div class="col-md-4">
            <label for="genero" class="form-label">NOMBRE</label>
            <input type="text" class="form-control" id="nom" value="<?php echo $row['nom']; ?>" name="nom" required>
        </div>
        <div class="col-md-4">
            <label for="editorial" class="form-label">A. PATERNO</label>
            <input type="text" class="form-control" id="ap" value="<?php echo $row['ap']; ?>" name="ap" required>
        </div>
        <div class="col-md-4">
            <label for="edicion" class="form-label">A. MATERNO</label>
            <input type="text" class="form-control" id="am" value="<?php echo $row['am']; ?>" name="am" required>
        </div>

        <div class="col-md-2">
            <label for="cantidad" class="form-label">No. CELULAR</label>
            <input type="text" class="form-control" id="cel_usuario" value="<?php echo $row['cel_usuario']; ?>" name="cel_usuario" required>
        </div>


        <div class="col-md-2">
            <label for="cantidad" class="form-label">SEMESTRE</label>
            <input type="text" class="form-control" id="sem" value="<?php echo $row['sem']; ?>" name="sem" required>
        </div>

        <div class="col-md-2">
            <label for="cantidad" class="form-label">TURNO</label>
            <input type="text" class="form-control" id="grupo" value="<?php echo $row['grupo']; ?>" name="grupo" required>
        </div>

        <div class="col-md-2">
            <label for="cantidad" class="form-label">ESPECIALIDAD</label>
            <input type="text" class="form-control" id="especialidad" value="<?php echo $row['especialidad']; ?>" name="especialidad" required>
        </div>

        
        <div class="col-12 text-center">
            <button class="btn btn-primary" type="submit" name="actualizar" value="Guardar">Guardar</button>
            <a href="docentes_registrados.php" class="btn btn-primary">Cancelar</a>
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
    $id_usuarios = $_POST['id_usuarios'];
    $identificador = $_POST['identificador'];
    $nocontrol_rfc = $_POST['nocontrol_rfc'];
    $nom = $_POST['nom'];
    $ap = $_POST['ap'];
    $am = $_POST['am'];
    $cel_usuario = $_POST['cel_usuario'];
    $sem = $_POST['sem'];
    $grupo = $_POST['grupo'];
    $turno = $_POST['turno'];
    $especialidad = $_POST['especialidad'];
    // Actualizar el registro en la base de datos
    $sql = "UPDATE usuarios SET 
                identificador = '$identificador', 
                nocontrol_rfc = '$nocontrol_rfc',
                nom = '$nom', 
                ap = '$ap', 
                am = '$am', 
                cel_usuario = '$cel_usuario', 
                sem = '$sem',
                grupo = '$grupo', 
                turno = '$turno', 
                especialidad = '$especialidad'
            WHERE id_usuarios = '$id_usuarios';"; 
            
if ($obj->actualizadatos($sql)) {
    header("Location: alumnos_registrados.php"); // Redirige si fue exitoso
    exit;
} else {
    echo "<p>Error al actualizar el registro</p>";
}
}
?>
<?php include("templates/pie.php"); ?>
