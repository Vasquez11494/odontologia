const BtnGuardar = document.getElementById('BtnGuardar');
const BtnModificar = document.getElementById('BtnModificar');
const BtnCancelar = document.getElementById('BtnCancelar');
const BtnLimpiar = document.getElementById('BtnLimpiar');
const tablaCitas = document.getElementById('CitasIngresados');
const FormularioCitas = document.querySelector('form');


BtnModificar.parentElement.style.display = 'none'
BtnCancelar.parentElement.style.display = 'none'


const GuardarCitas = async (e) => {

    e.preventDefault();

    if (validarFormulario(FormularioCitas, ['cita_id'])) {

        BtnGuardar.disabled = true;

        const formData = new FormData(FormularioCitas)
        formData.append('tipo', 1);
        formData.delete('cita_id')

        const url = '/odontologia/controller/Citas/Cita.php'

        const config = {
            method: 'POST',
            body: formData

        }

        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();

            const { mensaje, codigo, detalle } = data

            // console.log(data);

            if (codigo == 1 && respuesta.status == 200) {

                Swal.fire({
                    title: '¡Éxito!',
                    text: mensaje,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500, 
                    timerProgressBar: true, 
                    background: '#e0f7fa', 
                    customClass: {
                        title: 'custom-title-class',
                        text: 'custom-text-class'
                    }

                });

                FormularioCitas.reset();
                ObtenerCitas();

            } else {
                console.log(detalle);
            }


        } catch (error) {
            console.log(error);
        }
        BtnGuardar.disabled = false;

    }
}

const ObtenerCitas = async (e) => {

    if (e) e.preventDefault();
    const paciente = FormularioCitas.cita_paciente.value;
    const doctor = FormularioCitas.cita_doctor.value;
    const fecha = FormularioCitas.cita_fecha.value;
    const desc = FormularioCitas.cita_descripcion.value;

    const url = `/odontologia/controller/Citas/Cita.php?cita_paciente=${paciente}$cita_doctor=${doctor}&cita_fecha=${fecha}&cita_descripcion=${desc}`;
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data);
        tablaCitas.tBodies[0].innerHTML = '';
        const fragment = document.createDocumentFragment();
        let contador = 1;

        if (respuesta.status == 200) {
            if (data.length > 0) {
                data.forEach(cita => {
                    const tr = document.createElement('tr');
                    const celda1 = document.createElement('td');
                    const celda2 = document.createElement('td');
                    const celda3 = document.createElement('td');
                    const celda4 = document.createElement('td');
                    const celda5 = document.createElement('td');
                    const celda6 = document.createElement('td');
                    const celda7 = document.createElement('td');


                    const BtnModificar = document.createElement('button');
                    const BtnEliminar = document.createElement('button');

                    BtnModificar.innerHTML = '<i class="bi bi-pencil"></i>';
                    BtnModificar.classList.add('btn', 'btn-warning', 'w-100', 'text-uppercase', 'fw-bold', 'shadow', 'border-0');

                    BtnEliminar.innerHTML = '<i class="bi bi-trash3"></i>';
                    BtnEliminar.classList.add('btn', 'btn-danger', 'w-100', 'text-uppercase', 'fw-bold', 'shadow', 'border-0');

                    BtnModificar.addEventListener('click', () => llenarFormulario(cita));
                    BtnEliminar.addEventListener('click', () => EliminarCita(cita.cita_id));



                    celda1.innerText = contador;
                    celda2.innerText = cita.paciente_nombre;
                    celda3.innerText = cita.doctor_nombre;
                    celda4.innerText = cita.cita_fecha;
                    celda5.innerText = cita.cita_descripcion;
                    celda6.appendChild(BtnModificar);
                    celda7.appendChild(BtnEliminar);

                    tr.appendChild(celda1);
                    tr.appendChild(celda2);
                    tr.appendChild(celda3);
                    tr.appendChild(celda4);
                    tr.appendChild(celda5);
                    tr.appendChild(celda6);
                    tr.appendChild(celda7);

                    fragment.appendChild(tr);
                    contador++;
                });

                if (e) {
                    Swal.fire({
                        position: "center",
                        icon: "info",
                        title: `Se encontraron ${data.length} Odontologo(s)`,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }

            } else {
                const tr = document.createElement('tr');
                const td = document.createElement('td');
                td.innerText = 'No hay Odontologos Registrados ';
                tr.classList.add('text-center');
                td.colSpan = 8;

                tr.appendChild(td);
                fragment.appendChild(tr);

                if (e) {
                    Swal.fire({
                        position: "center",
                        icon: "info",
                        title: 'No se encontraron Odontologos',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        }

        tablaCitas.tBodies[0].appendChild(fragment);

    } catch (error) {
        console.log(error);
    }
}

const llenarFormulario = (cita) => {
    Swal.fire({
        title: `¿Está seguro de que desea modificar la Cita`,
        text: "Esta acción permitirá editar la cita con el Odontologo.",
        icon: 'warning',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Sí, modificar',
        denyButtonText: 'No, cancelar',
        confirmButtonColor: '#3085d6', 
        denyButtonColor: '#d33', 
        background: '#fff3e0', 
        customClass: {
            title: 'custom-title-class',
            text: 'custom-text-class',
            confirmButton: 'custom-confirm-button',
            denyButton: 'custom-deny-button'
        }
    }).then((result) => {
        if (result.isConfirmed) {


            FormularioCitas.cita_id.value = cita.cita_id;
            FormularioCitas.cita_paciente.value = cita.cita_paciente;
            FormularioCitas.cita_doctor.value = cita.cita_doctor;
            FormularioCitas.cita_fecha.value = cita.cita_fecha;
            FormularioCitas.cita_descripcion.value = cita.cita_descripcion;


            BtnModificar.parentElement.style.display = '';
            BtnCancelar.parentElement.style.display = '';
            BtnGuardar.parentElement.style.display = 'none';
            BtnLimpiar.parentElement.style.display = 'none';
        }
    });
};

const ModificarCitas = async (e) => {

    e.preventDefault();


    if (validarFormulario(FormularioCitas)) {

        BtnModificar.disabled = true;

        const formData = new FormData(FormularioCitas)
        formData.append('tipo', 2);

        const url = '/odontologia/controller/Citas/Cita.php'
        const config = {
            method: 'POST',
            body: formData

        }

        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();

            const { mensaje, codigo, detalle } = data


            if (codigo == 2 && respuesta.status == 200) {

                BtnModificar.parentElement.style.display = 'none'
                BtnCancelar.parentElement.style.display = 'none'
                BtnGuardar.parentElement.style.display = ''
                BtnLimpiar.parentElement.style.display = ''
                
                Swal.fire({
                    title: '¡Éxito!',
                    text: mensaje,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500, 
                    timerProgressBar: true, 
                    background: '#e0f7fa', 
                    customClass: {
                        title: 'custom-title-class',
                        text: 'custom-text-class'
                    }

                });

                FormularioCitas.reset();
                ObtenerCitas();

            } else {
                console.log(detalle);
            }


        } catch (error) {
            console.log(error);
        }
        BtnModificar.disabled = false;

    }
}

const Cancelar = () => {
    BtnModificar.parentElement.style.display = 'none'
    BtnCancelar.parentElement.style.display = 'none'
    BtnGuardar.parentElement.style.display = ''
    BtnLimpiar.parentElement.style.display = ''
    FormularioCitas.reset();
    ObtenerCitas();
}

const EliminarCita = async (ID) => {
    Swal.fire({
        title: '¿Está seguro de que desea eliminar esta Cita?',
        text: "Esta acción es irreversible.",
        icon: 'warning',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Sí, eliminar',
        denyButtonText: 'No, cancelar',
        confirmButtonColor: '#3085d6', 
        denyButtonColor: '#d33', 
        background: '#fff3e0', 
        customClass: {
            title: 'custom-title-class',
            text: 'custom-text-class',
            confirmButton: 'custom-confirm-button',
            denyButton: 'custom-deny-button'
        }
    }).then(async (result) => {
        if (result.isConfirmed) {
     
            const formData = new FormData();
            formData.append('tipo', 3);
            formData.append('cita_id', ID);

            const url = '/odontologia/controller/Citas/Cita.php';
            const config = {
                method: 'POST',
                body: formData
            };

            try {
                const respuesta = await fetch(url, config);
                const data = await respuesta.json();
                const { mensaje, codigo, detalle } = data;

                if (codigo == 3 && respuesta.status == 200) {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: mensaje,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                        background: '#e0f7fa', 
                        customClass: {
                            title: 'custom-title-class',
                            text: 'custom-text-class'
                        }
                    }).then(() => {
                        FormularioCitas.reset();
                        ObtenerCitas();
                    });

                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo un problema al eliminar la Cita.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#d33',
                        background: '#ffebee', 
                        customClass: {
                            title: 'custom-title-class',
                            text: 'custom-text-class'
                        }
                    });
                }

            } catch (error) {
                console.log(error);
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al procesar la solicitud.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#d33',
                    background: '#ffebee', 
                    customClass: {
                        title: 'custom-title-class',
                        text: 'custom-text-class'
                    }
                });
            }
        }
    });
};


ObtenerCitas();
FormularioCitas.addEventListener('submit', GuardarCitas)
BtnModificar.addEventListener('click', ModificarCitas)
BtnCancelar.addEventListener('click', Cancelar)