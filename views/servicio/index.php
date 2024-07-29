<?php include_once '../../includes/header.php' ?>
<div class="container">
  <h1 class="text-center mt-5">Registro de Servicos</h1>
  <div class="row justify-content-center mb-3">
    <div class="col-lg-8">
      <div class="card border-0 shadow-lg">
        <div class="card-body">
          <form id="formulario">
            <h2>Ingrese el tipo de servicio a brindar y fechas en que se brindará</h2>
            <input type="hidden" name="ser_id" id="ser_id">
            <div class="row mb-3">
              <div class="col">
                <label for="ser_nombre" class="form-label">Nombre del servicio a brindar:</label>
                <input type="text" name="ser_nombre" id="ser_nombre" class="form-control"  required>
              </div>
              <div class="col">
                <label for="ser_fecha" class="form-label">Fechas de disponibilidad:</label>
                <input type="date" name="ser_fecha" id="ser_fecha" class="form-control" required>
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
      <h2 class="text-center mt-3">Listado de servicios y fechas en que se realizarán</h2>
      <table class="table table-bordered table-hover" id="tablaServicios">
        <thead class="thead-dark">
          <tr>
            <th>No.</th>
            <th>Nombre</th>
            <th>fecha</th>
            <th>Modificar</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="5" class="text-center">No hay registro de servicios</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>
<script defer src="/Clinica_Medica/src/funciones.js"></script>
<script defer src="/Clinica_Medica/src/js/servicio/index.js"></script>
<?php include_once '../../includes/footer.php' ?>