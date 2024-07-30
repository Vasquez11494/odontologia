<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

include_once '../template/header.php';
include_once '../../model/Paciente.php';
include_once '../../model/Doctor.php';


$paciente = new Paciente();
$pacientes = $paciente->buscar();

$doctor = new Doctor();
$doctores = $doctor->buscar();

?>
<h1 class="text-center mt-3">Generar Citas</h1>
<div class="row justify-content-center mt-3">
    <form class="border bg-light shadow rounded p-4 col-lg-6">
        <div class="row mb-3">
            <div class="col">
                <input type="hidden" name="cita_id" id="cita_id" class="form-control">
            </div>
        </div>
        <div class="row mt-3 mb-4">
            <label for="cita_paciente">Seleccione al Paciente</label>
            <select name="cita_paciente" id="cita_paciente" class="form-control">
                <option value="">SELECCIONE...</option>
                <?php foreach ($pacientes as $paciente) : ?>
                    <option value="<?= $paciente['paciente_id'] ?>"> <?= $paciente['paciente_nombre'] . ""  ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="row mt-3 mb-3">
            <label for="cita_doctor">Seleccione al Odontologo</label>
            <select name="cita_doctor" id="cita_doctor" class="form-control">
                <option value="">SELECCIONE...</option>
                <?php foreach ($doctores as $doctor) : ?>
                    <option value="<?= $doctor['doctor_id'] ?>"> <?= $doctor['doctor_nombre'] . ""  ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="cita_fecha">Seleccione la fecha y Hora</label>
                <input type="datetime-local" name="cita_fecha" id="cita_fecha" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="cita_descripcion">Descripción</label>
                <textarea name="cita_descripcion" id="cita_descripcion" class="form-control" placeholder="Agregue algún comentario" rows="4"></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <button type="submit" id="BtnGuardar" class="btn btn-primary w-100 text-uppercase shadow border-0">Guardar</button>
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
        <h2 class="text-center mb-4">Citas Ingresadas</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="CitasIngresados">
                <thead class="table-warning">
                    <tr>
                        <th>No.</th>
                        <th>Paciente</th>
                        <th>Odontologo</th>
                        <th>Fecha de la Cita</th>
                        <th>Descripción</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7" class="text-center">No hay Registro</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- js -->
<script src="../../src/cita/cita.js"></script>
<script src="../../src/funciones.js"></script>
<?php include '../template/footer.php'; ?>