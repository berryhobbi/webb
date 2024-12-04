<?php
// Incluimos un script para confirmar que no haya registros vacios 
//o nulos, es decir evitamos  errores y nos aseguramos que el script
// de eliminación no intente procesar un valor vacío o inexistente.
if (!empty($_GET['id_usuarios'])) {
    include("conectar.php");
    $conect = new OperacionesBd;
    $id = ($_GET['id_usuarios']); // Obtenemos el valor del id
    //que se va a eliminar
    $sql = "DELETE FROM usuarios WHERE id_usuarios = '$id'";
    $conect->eliminardatos($sql);
    header("Location: alumnos_registrados.php");
    exit; // Se recomienda usarse para finalizar el script 
    //después de la redirección
}
// Incluir cabecera después de la lógica

include("templates/cabecera.php"); 
?>
<script>
    // Método de confirmación en JS
    function confirmarEliminacion(id_usuarios) {
        // confirm es un método propio de JavaScript 
        //que muestra un cuadro de diálogo
        if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
            // Redirigir a eliminar.php si el usuario confirma
            window.location.href = "alumnos_registrados.php?id_usuarios=" + id_usuarios;
        }
    }
</script>

<div class="container-fluid bg-warning text-center">
    <h2>Alumnos registrados</h2>
</div>
<table class="table table-hover">
    <thead>
        <tr class="text-center">
            <th scope="col">ID</th>
            <th scope="col">RFC</th>
            <th scope="col">IDENTIFICADOR</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">A. PATERNO</th>
            <th scope="col">A. MATERNO</th>
            <th scope="col">No. CELULAR</th>
            <th scope="col">SEMESTRE</th>
            <th scope="col">GRUPO</th>
            <th scope="col">TURNO</th>
            <th scope="col">ESPECIALIDAD</th>
        </tr>
    </thead>
    <tbody>

    <?php
        include("conectar.php");
        $conect = new OperacionesBd;
        // Filtrar registros donde identificador sea igual a 1
        $sql = "SELECT * FROM usuarios WHERE identificador = 1;";
        $resultado = $conect->mostrardatos($sql);

        foreach ($resultado as $col) {
    ?>
        <tr>
            <th scope="row"><?php echo $col['id_usuarios']; ?></th>
            <td><?php echo $col['nocontrol_rfc']; ?></td>
            <td><?php echo $col['identificador']; ?></td>
            <td><?php echo $col['nom']; ?></td>
            <td><?php echo $col['ap']; ?></td>
            <td><?php echo $col['am']; ?></td>
            <td><?php echo $col['cel_usuario']; ?></td>
            <td><?php echo $col['sem']; ?></td>
            <td><?php echo $col['grupo']; ?></td>
            <td><?php echo $col['turno']; ?></td>
            <td><?php echo $col['especialidad']; ?></td>
            <td class="text-center">
                <a href="actualizar_alumnos.php?actualiza_alumnos=<?php 
            echo $col['id_usuarios'] ?>">
            <img src="img/modificar.jpeg" alt="" style="width:30px; 
            height:30px;"></a></td>
            <td class="text-center">
            <a href="javascript:confirmarEliminacion(<?php 
            echo $col['id_usuarios']; 
              ?>);">
            <img src="img/eliminar.jpeg" width="25" height="25">
            </a>            
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php include("templates/pie.php"); ?>