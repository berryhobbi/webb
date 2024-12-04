<?php include("templates/cabecera.php"); ?>
<div class=" border border-start-0 shadow p-3 mb-5 bg-body-tertiary rounded">
<div class="container-fluid bg-warning text-center">
  <h2>Registro de alumnos</h2>
</div>
<form action="registro_usuarios_alumnos.php" method="POST" class="row g-3 needs-validation pt-3" novalidate>
  <div class="col-md-4">
    <label for="validationCustom01" class="form-label">No. control</label>
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
  <div class="col-md-3">
    <label for="validationCustom06" class="form-label">Semestre</label>
    <select class="form-control" id="sem" name="sem">
        <option selected disabled placeholder>Seleccione</option>
        <option class="form-control" id="sem" name="sem" value="1">1</option>
        <option class="form-control" id="sem" name="sem" value="2">2</option>
        <option class="form-control" id="sem" name="sem" value="3">3</option>
        <option class="form-control" id="sem" name="sem" value="4">4</option>
        <option class="form-control" id="sem" name="sem" value="5">5</option>
        <option class="form-control" id="sem" name="sem" value="6">6</option>
    </select>
  </div>
  <div class="col-md-3">
    <label for="validationCustom07" class="form-label">Grupo</label>
    <select class="form-control" id="grupo" name="grupo">
        <option selected disabled placeholder>Seleccione</option>
        <option class="form-control"  value="A">A</option>
        <option class="form-control"  value="B">B</option>
        <option class="form-control"  value="C">C</option>
        <option class="form-control"  value="D">D</option>
        <option class="form-control"  value="E">E</option>
        <option class="form-control"  value="F">F</option>
    </select>
  </div>
  <div class="col-md-3">
    <label for="validationCustom08" class="form-label">Turno</label>
    <select class="form-control" id="turno" name="turno">
        <option selected disabled pl
        aceholder>Seleccione</option>
        <option class="form-control"  value="Matutino">Matutino</option>
        <option class="form-control"  value="Vespertino">Vespertino</option>
    </select>
  </div>
  <div class="col-md-3">
    <label for="validationCustom09" class="form-label">Especialidad</label>
    <select class="form-control" id="especialidad" name="especialidad">
        <option selected disabled placeholder>Seleccione</option>
        <option class="form-control" >Componente básico/Propedéutico</option>
        <option class="form-control" >Técnico en Administración de Recursos Humanos</option>
        <option class="form-control" >Técnico en Construcción</option>
        <option class="form-control" >Técnico Laboratorista Químico</option>
        <option class="form-control" >Técnico en Electrónica</option>
        <option class="form-control" >Técnico en Programación</option>
        <option class="form-control" >Técnico en Electricidad</option>
    </select>
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
    $sem = $_POST['sem'];
    $grupo = $_POST['grupo'];
    $turno = $_POST['turno'];
    $especialidad = $_POST['especialidad'];
    $sql ="INSERT INTO usuarios(identificador,nocontrol_rfc,nom,ap,am,
    cel_usuario,sem,grupo,turno, especialidad) 
    VALUES (1,'$nocontrol_rfc','$nom','$ap','$am','$cel_usuario','$sem',
    '$grupo','$turno','$especialidad');";
    $obj->guardardatos($sql); 
}
?>
