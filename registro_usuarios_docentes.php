<?php include("templates/cabecera.php"); ?>
<div class=" border border-start-0 shadow p-3 mb-5 bg-body-tertiary rounded">
<div class="container-fluid bg-warning text-center">
  <h2>Registro de docentes</h2>
</div>
<form action="registro_usuarios_docentes.php" method="POST" class="row g-3 needs-validation pt-3" novalidate>
  <div class="col-md-4">
    <label for="validationCustom01" class="form-label">RFC</label>
    <input type="text" class="form-control" id="nocontrol_rfc" value="" name="nocontrol_rfc" required>
  </div>

  <div class="col-md-4">
    <label for="validationCustom02" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nom" value="" name="nom" required>
  </div>
  <div class="col-md-4">
    <label for="validationCustom03" class="form-label">A. Paterno</label>
    <input type="text" class="form-control" id="ap" value="" name="ap" required>
  </div>
  <div class="col-md-4">
    <label for="validationCustom04" class="form-label">A. Materno</label>
    <input type="text" class="form-control" id="am" value="" name="am" required>
  </div>
  <div class="col-md-4">
    <label for="validationCustom05" class="form-label">Telefono celular</label>
    <input type="text" class="form-control" id="cel_usuario" value="" name="cel_usuario" required>
  </div>
 
  <div class="col-12 text-center">
  <button class="btn btn-primary" type="submit" value="Guardar">Guardar</button>
  <button class="btn btn-primary" type="button" onclick="window.location.href='menu.php';">Cancelar</button>
  </div>
</form>
</div>
<?php include("templates/pie.php"); ?>
<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {
    include 'conectar.php';
    $obj = new OperacionesBd;
    $nocontrol_rfc= $_POST['nocontrol_rfc'];
    $nom = $_POST['nom'];
    $ap = $_POST['ap'];
    $am = $_POST['am'];
    $cel_usuario = $_POST['cel_usuario'];
 
    $sql ="INSERT INTO usuarios(identificador,nocontrol_rfc,nom,ap,am,cel_usuario) 
    VALUES (2,'$nocontrol_rfc','$nom','$ap','$am','$cel_usuario');";
    $obj->guardardatos($sql);
}
?>
