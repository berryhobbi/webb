<?php include("templates/cabecera.php"); ?>
<div class=" border border-start-0 shadow p-3 mb-5 bg-body-tertiary rounded">
<div class="container-fluid bg-warning text-center">
    <h2>Registro de libros</h2>
</div>

<form action="registro_libros.php" method="POST" class="row g-3 needs-validation pt-3" novalidate>
    <div class="col-md-4">
        <label for="validationCustom01" class="form-label">ISBN</label>
        <input type="text" class="form-control" id="isbn" value="" name="isbn" required>
    </div>
    <div class="col-md-4">
        <label for="validationCustom02" class="form-label">ID_LOCAL</label>
        <input type="text" class="form-control" id="id_local" value="" name="id_local" required>
    </div>
    <div class="col-md-4">
        <label for="validationCustom03" class="form-label">TITULO</label>
        <input type="text" class="form-control" id="titulo" value="" name="titulo" required>
    </div>
    <div class="col-md-4">
        <label for="validationCustom04" class="form-label">GENERO</label>
        <input type="text" class="form-control" id="genero" value="" name="genero" required>
    </div>
    <div class="col-md-4">
        <label for="validationCustom05" class="form-label">EDITORIAL</label>
        <input type="text" class="form-control" id="editorial" value="" name="editorial" required>
    </div>
    <div class="col-md-4">
        <label for="validationCustom06" class="form-label">EDICION</label>
        <input type="text" class="form-control" id="edicion" value="" name="edicion" required>
    </div>
    
    <div class="col-md-2">
        <label for="validationCustom07" class="form-label">AÑO DE PUBLICACION</label>
        <?php $cont = date('Y'); ?>
        <select class="form-control" id="ano_publ" name="ano_publ" required>
        <?php while ($cont >= 1850) { ?>
            <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
        <?php $cont = ($cont-1); } ?>
        </select>
    </div>
   
   
    <div class="col-md-4">
        <label for="validationCustom09" class="form-label">NOMBRE DEL AUTOR</label>
        <input type="text" class="form-control" id="nom_autor" value="" name="nom_autor" required>
    </div>
    <div class="col-md-4">
        <label for="validationCustom10" class="form-label">AP. DEL AUTOR</label>
        <input type="text" class="form-control" id="ap_autor" value="" name="ap_autor" required>
    </div>
    <div class="col-md-4">
        <label for="validationCustom11" class="form-label">AM. DEL AUTOR</label>
        <input type="text" class="form-control" id="am_autor" value="" name="am_autor" required>
    </div>
    <div class="col-12 text-center">
        <button class="btn btn-primary" type="submit" value="Guardar">Guardar</button>
        <button class="btn btn-primary" type="button" 
        onclick="window.location.href='menu.php';">Cancelar</button>


        
    </div>
</form>
</div>
<?php include("templates/pie.php"); ?>


<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {
    include 'conectar.php';
    $obj = new OperacionesBd;
    $isbn= $_POST['isbn'];
    $id_local= $_POST['id_local'];
    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $editorial = $_POST['editorial'];
    $edicion = $_POST['edicion'];
    $ano_publ = $_POST['ano_publ'];
    //$estatus = $_POST['estatus'];
    $nom_autor = $_POST['nom_autor'];
    $ap_autor = $_POST['ap_autor'];
    $am_autor = $_POST['am_autor'];

    $sql ="INSERT INTO libros(isbn, id_local,titulo, genero, editorial, 
    edicion, ano_publ,estatus,nom_autor, ap_autor, am_autor) 
    VALUES ('$isbn','$id_local','$titulo','$genero','$editorial','$edicion','$ano_publ',
    0,'$nom_autor','$ap_autor','$am_autor');";
    $obj->guardardatos($sql);

    
}
?>