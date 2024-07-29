<?php include_once '../../includes/header.php' ?>
<div class="container">
  <h1 class="text-center mt-5">Registro de Pacientes</h1>
  <div class="row justify-content-center mb-3">
    <div class="col-lg-8">
      <div class="card border-0 shadow-lg">
        <div class="card-body">
          <form id="formulario">
            <h2>Ingrese información general de paciente</h2>
            <input type="hidden" name="pac_id" id="pac_id">
            <div class="row mb-3">
              <div class="col">
                <label for="pac_nombre" class="form-label">Nombre completo:</label>
                <input type="text" name="pac_nombre" id="pac_nombre" class="form-control"  required>
              </div>
              <div class="col">
                <label for="pac_tel" class="form-label">Teléfono:</label>
                <input type="text" name="pac_tel" id="pac_tel" class="form-control" placeholder=" xxxx xxxx"  required>
              </div>
              <div class="col">
                <label for="pac_direccion" class="form-label">Dirección</label>
                <input type="text" name="pac_direccion" id="pac_direccion" class="form-control"  required>
              </div>
              <div class="col">
                <label for="pac_correo" class="form-label">Correo:</label>
                <input type="text" name="pac_correo" id="pac_correo" class="form-control"  required>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <button type="submit" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
              </div>
              <div class="col">
                <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
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
      </div>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-lg-8 table-responsive">
      <h2 class="text-center mt-3">Listado de clientes</h2>
      <table class="table table-bordered table-hover" id="tablaPacientes">
        <thead class="thead-dark">
          <tr>
            <th>No.</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Correo</th>
            <th>Modificar</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="7" class="text-center">No hay registro de pacientes</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>
<script defer src="/Clinica_Medica/src/funciones.js"></script>
<script defer src="/Clinica_Medica/src/js/paciente/index.js"></script>
<?php include_once '../../includes/footer.php' ?>