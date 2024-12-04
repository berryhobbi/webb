<?php
// Incluimos un script para confirmar que no haya registros vacios 
//o nulos, es decir evitamos  errores y nos aseguramos que el script
// de eliminación no intente procesar un valor vacío o inexistente.
if (!empty($_GET['id_libros'])) {
    include("conectar.php");
    $conect = new OperacionesBd;
    $id = ($_GET['id_libros']); // Obtenemos el valor del id
    //que se va a eliminar
    $sql = "DELETE FROM libros WHERE id_libros = '$id'";
    $conect->eliminardatos($sql);
    header("Location: libros_registrados.php");
    exit; // Se recomienda usarse para finalizar el script 
    //después de la redirección
}
// Incluir cabecera después de la lógica
include("templates/cabecera.php");
?>
<script>
    // Método de confirmación en JS
    function confirmarEliminacion(id_libros) {
        // confirm es un método propio de JavaScript que muestra un cuadro de diálogo
        if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
            // Redirigir a eliminar.php si el usuario confirma
            window.location.href = "libros_registrados.php?id_libros=" + id_libros;
        }
    }
</script>

<div class="container-fluid bg-warning text-center">
    <h2>Libros registrados</h2>
</div>
<table class="table table-hover">
    <thead>
        <tr class="text-center">
            <th scope="col">ID</th>
            <th scope="col">ISBN</th>
            <th scope="col">Título</th>
            <th scope="col">Género</th>
            <th scope="col">Editorial</th>
            <th scope="col">Edición</th>
            <th scope="col">Año de publicación</th>
            <th scope="col">Estatus</th>
            <th scope="col">Nombre autor</th>
            <th scope="col">Ap. autor</th>
            <th scope="col">Am. autor</th>
            <th scope="col">Modificar</th>
            <th scope="col">Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include("conectar.php");
        $conect = new OperacionesBd;
        $sql = "SELECT * FROM libros;";
        $resultado = $conect->mostrardatos($sql);

        foreach ($resultado as $col) {
        ?>
        <tr>
            <th scope="row"><?php echo $col['id_libros']; ?></th>
            <td><?php echo $col['isbn']; ?></td>
            <td><?php echo $col['titulo']; ?></td>
            <td><?php echo $col['genero']; ?></td>
            <td><?php echo $col['editorial']; ?></td>
            <td><?php echo $col['edicion']; ?></td>
            <td><?php echo $col['ano_publ']; ?></td>
            <td><?php echo $col['estatus']; ?></td>
            <td><?php echo $col['nom_autor']; ?></td>
            <td><?php echo $col['ap_autor']; ?></td>
            <td><?php echo $col['am_autor']; ?></td>

            <td class="text-center"><a href="actualizar_libros.php?actualiza_libros=<?php echo $col['id_libros'] ?>">
            <img src="img/modificar.jpeg" alt="" style="width:30px; height:30px;"></a></td>
            <td class="text-center">

                <a href="javascript:confirmarEliminacion(<?php echo $col['id_libros']; ?>);">
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