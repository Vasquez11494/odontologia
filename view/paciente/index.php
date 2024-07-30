<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

include_once '../template/header.php';

?>
<h1 class="text-center mt-3">Formulario para agregar pacientes</h1>
<div class="row justify-content-center mt-3">
    <form class="border bg-light shadow rounded p-4 col-lg-6">
        <div class="row mb-3">
            <div class="col">
                <input type="hidden" name="paciente_id" id="paciente_id" class="form-control" >
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="paciente_nombre">Nombres del Paciente</label>
                <input type="text" name="paciente_nombre" id="paciente_nombre" class="form-control" >
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="paciente_telefono">Telefono</label>
                <input type="number" name="paciente_telefono" id="paciente_telefono" class="form-control" >
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="paciente_correo">Correo Electronico</label>
                <input type="email" name="paciente_correo" id="paciente_correo" class="form-control" >
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="paciente_edad">Edad</label>
                <input type="number" name="paciente_edad" id="paciente_edad" class="form-control" >
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="submit" id="BtnGuardar" class="btn btn-primary w-100 text-uppercase shadow border-0">Guardar</button>
            </div>
            <div class="col">
                <button type="button" id="BtnBuscar" class="btn btn-info w-100 text-uppercase shadow border-0">Buscar</button>
            </div>
            <div class="col">
                <button type="button" id="BtnModificar" class="btn btn-warning w-100 text-uppercase shadow border-0">Modificar</button>
            </div>
            <div class="col">
                <button type="button" id="BtnCancelar" class="btn btn-secondary w-100 text-uppercase shadow border-0">Cancelar</button>
            </div>
            <div class="col">
                <button type="reset" id="BtnLimpiar" class="btn btn-secondary w-100 text-uppercase shadow border-0">Limpiar</button>
            </div>
        </div>
    </form>
</div>
<!-- MOSTRAR DATOS -->
<div class="row justify-content-center mt-4">
    <div class="col-lg-10 table-wrapper">
        <h2 class="text-center mb-4">Pacientes Ingresados</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="PacientesIngresados">
                <thead class="table-warning" >
                    <tr>
                        <th >No.</th>
                        <th>Nombres</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Edad</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7" class="text-center">No hay Pacientes Registrados</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- js -->
<script src="../../src/paciente/paciente.js"></script>
<script src="../../src/funciones.js"></script>
<?php include '../template/footer.php'; ?>