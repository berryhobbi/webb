<?php include("templates/cabecera.php"); ?>

<?php
// Comprobar si se recibe un ID para actualizar
if (!empty($_GET['actualiza_docentes'])) {
    include_once("conectar.php"); // Asegurar inclusión única
    $conexion = new OperacionesBd();
    $editar = $_GET['actualiza_docentes'];
    $sql = "SELECT * FROM usuarios WHERE id_usuarios = '$editar';";
    $resultado = $conexion->mostrardatos($sql);

    foreach ($resultado as $row) {
?>

<div class="border border-start-0 shadow p-3 mb-5 bg-body-tertiary rounded">
    <div class="container-fluid bg-warning text-center">
        <h2>ACTUALIZACIÓN DE DATOS EN DOCENTES</h2>
    </div>

    <!-- Formulario para actualizar los datos -->
    <form action="actualizar_usuarios.php" method="POST" class="row g-3 needs-validation pt-3" novalidate>
        <input type="hidden" name="id_usuarios" value="<?php echo $row['id_usuarios']; ?>">
        
        <div class="col-md-4">
            <label for="isbn" class="form-label">No. Control</label>
            <input type="text" class="form-control" id="nocontrol_rfc" value="<?php echo $row['nocontrol_rfc']; ?>" name="nocontrol_rfc" required>
        </div>
        <div class="col-md-4">
            <label for="titulo" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nom" value="<?php echo $row['nom']; ?>" name="nom" required>
        </div>
        <div class="col-md-4">
            <label for="genero" class="form-label">A.Paterno</label>
            <input type="text" class="form-control" id="ap" value="<?php echo $row['ap']; ?>" name="ap" required>
        </div>
        <div class="col-md-4">
            <label for="editorial" class="form-label">A.Materno</label>
            <input type="text" class="form-control" id="am" value="<?php echo $row['am']; ?>" name="am" required>
        </div>
        <div class="col-md-4">
            <label for="edicion" class="form-label">Celular</label>
            <input type="text" class="form-control" id="cel_usuario" value="<?php echo $row['cel_usuario']; ?>" name="cel_usuario" required>
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
    $nocontrol_rfc = $_POST['nocontrol_rfc'];
    $nom = $_POST['nom'];
    $ap = $_POST['ap'];
    $am = $_POST['am'];
    $cel_usuario = $_POST['cel_usuario'];
    

    // Actualizar el registro en la base de datos
    $sql = "UPDATE usuarios SET 
                nocontrol_rfc = '$nocontrol_rfc', 
                nom = '$nom', 
                ap = '$ap', 
                am = '$am', 
                cel_usuario = '$cel_usuario', 
                

            WHERE id_usuarios = '$id_usuarios';";

if ($obj->actualizadatos($sql)) {
    header("Location: docentes_registrados.php"); // Redirige si fue exitoso
    exit;
} else {
    echo "<p>Error al actualizar el registro</p>";
}
}
?>

<?php include("templates/pie.php"); ?>