<?php include_once '../../includes/header.php' ?>
<?php
require '../../models/Paciente.php';
require '../../models/Servicio.php';
try {

  $paciente = new Paciente();

  $pacientes = $paciente->buscar();
} catch (PDOException $e) {
  $error = $e->getMessage();
} catch (Exception $e2) {
  $error = $e2->getMessage();
}


try {

  $servicio = new Servicio();


  $servicios = $servicio->buscar();
  

} catch (PDOException $e) {
  $error = $e->getMessage();
} catch (Exception $e2) {
  $error = $e2->getMessage();
}

?>

<div class="container mt-5">
  <h1 class="text-center mt-3">PROGRAMACIÓN DE CITAS</h1>
  <div class="row justify-content-center mt-2">
    <form id="formulario" class="border border-primary rounded p-3 bg-light col-md-6">
    <input type="hidden" name="det_id" id="det_id">  

    <div class="form-group">
        <label for="det_pac">Seleccione un paciente</label>
        <select class="form-select" name="det_pac" id="det_pac" required>
          <option value="">Seleccionar..</option>
          <?php foreach ($pacientes as $paciente) { ?>
            <option value="<?php echo $paciente['PAC_ID']; ?>"><?php echo $paciente['PAC_NOMBRE']; ?></option>
          <?php } ?>
        </select>
      </div>

    <div class="form-group">
        <label for="det_ser">Seleccione una servicio:</label>
        <select class="form-select" name="det_ser" id="det_ser" required>
          <option value="">Seleccionar..</option>
          <?php foreach ($servicios as $servicio) { ?>
            <option value="<?php echo $servicio['SER_ID']; ?>"><?php echo $servicio['SER_NOMBRE']; ?></option>
          <?php } ?>
        </select>
      </div>
  
      <div class="row mt-3">
                                    <div class="col">
                                        <button type="submit" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
                                    </div>
                                
                                    <div class="col">
                                        <button type="button" id="btnModificar" class="btn btn-secondary w-100">Modificar</button>
                                    </div>
                                    <div class="col">
                                        <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
                                    </div>
                                    <div class="col">
                                        <button type="reset" id="btnLimpiar" class="btn btn-warning w-100">Limpiar</button>
                                    </div>
                                </div>
    </form>
  </div>
  <div class="row justify-content-center">
        <div class="col-lg-12 table-responsive">
            <h2 class="text-center mt-3">Registro de citas programadas</h2>
            <table class="table table-bordered table-hover" id="tablaDet">
                <thead class="thead-dark">
                    <tr>
                        <th>No.</th>
                        <th>Paciente</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Correo</th>
                        <th>Servicio solicitado</th>
                        <th>Fecha</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="8" class="text-center">No hay registros disponibles</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script defer src="/Clinica_Medica/src/funciones.js"></script>
<script defer src="/Clinica_Medica/src/js/detalle/index.js"></script>

<?php include_once '../../includes/footer.php' ?>