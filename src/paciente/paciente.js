const BtnGuardar = document.getElementById('BtnGuardar');
const BtnBuscar = document.getElementById('BtnBuscar');
const BtnModificar = document.getElementById('BtnModificar');
const BtnCancelar = document.getElementById('BtnCancelar');
const BtnLimpiar = document.getElementById('BtnLimpiar');
const tablaPacientes = document.getElementById('PacientesIngresados');
const FormularioPacientes = document.querySelector('form');


BtnModificar.parentElement.style.display = 'none'
BtnCancelar.parentElement.style.display = 'none'


const GuardarPacientes = async (e) => {

    e.preventDefault();

    if (validarFormulario(FormularioPacientes, ['paciente_id'])) {

        BtnGuardar.disabled = true;

        const formData = new FormData(FormularioPacientes)
        formData.append('tipo', 1);
        formData.delete('paciente_id')

        const url = '/odontologia/controller/paciente/Paciente.php'

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

                FormularioPacientes.reset();
                ObtenerPacientes();

            } else {
                console.log(detalle);
            }


        } catch (error) {
            console.log(error);
        }
        BtnGuardar.disabled = false;

    }
}

const ObtenerPacientes = async (e) => {

    if (e) e.preventDefault();

    const nombre = FormularioPacientes.paciente_nombre.value;
    const telefono = FormularioPacientes.paciente_telefono.value;
    const correo = FormularioPacientes.paciente_correo.value;
    const edad = FormularioPacientes.paciente_edad.value;
  

    const url = `/odontologia/controller/paciente/Paciente.php?paciente_nombre=${nombre}&paciente_telefono=${telefono}&paciente_correo=${correo}&paciente_edad=${edad}`;
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data);

        tablaPacientes.tBodies[0].innerHTML = '';
        const fragment = document.createDocumentFragment();
        let contador = 1;

        if (respuesta.status == 200) {
            if (data.length > 0) {
                data.forEach(paciente => {
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

                    BtnModificar.addEventListener('click', () => llenarFormulario(paciente));
                    BtnEliminar.addEventListener('click', () => EliminarPaciente(paciente.paciente_id));

                    celda1.innerText = contador;
                    celda2.innerText = paciente.paciente_nombre;
                    celda3.innerText = paciente.paciente_telefono;
                    celda4.innerText = paciente.paciente_correo;
                    celda5.innerText = paciente.paciente_edad;
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
                        title: `Se encontraron ${data.length} paciente(s)`,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }

            } else {
                const tr = document.createElement('tr');
                const td = document.createElement('td');
                td.innerText = 'No hay pacientes Registrados ';
                tr.classList.add('text-center');
                td.colSpan = 8;

                tr.appendChild(td);
                fragment.appendChild(tr);

                if (e) {
                    Swal.fire({
                        position: "center",
                        icon: "info",
                        title: 'No se encontraron pacientes',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        }

        tablaPacientes.tBodies[0].appendChild(fragment);

    } catch (error) {
        console.log(error);
    }
}

const llenarFormulario = (paciente) => {
    Swal.fire({
        title: `¿Está seguro de que desea modificar los datos de: "${paciente.paciente_nombre}"?`,
        text: "Esta acción permitirá editar los datos del paciente.",
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
            FormularioPacientes.paciente_id.value = paciente.paciente_id;
            FormularioPacientes.paciente_nombre.value = paciente.paciente_nombre;
            FormularioPacientes.paciente_telefono.value = paciente.paciente_telefono;
            FormularioPacientes.paciente_correo.value = paciente.paciente_correo;
            FormularioPacientes.paciente_edad.value = paciente.paciente_edad;


            BtnModificar.parentElement.style.display = '';
            BtnCancelar.parentElement.style.display = '';
            BtnGuardar.parentElement.style.display = 'none';
            BtnBuscar.parentElement.style.display = 'none';
            BtnLimpiar.parentElement.style.display = 'none';
        }
    });
};

const ModificarPacientes = async (e) => {

    e.preventDefault();


    if (validarFormulario(FormularioPacientes)) {

        BtnModificar.disabled = true;

        const formData = new FormData(FormularioPacientes)
        formData.append('tipo', 2);

        const url = '/odontologia/controller/paciente/Paciente.php'
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
                BtnBuscar.parentElement.style.display = ''
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

                FormularioPacientes.reset();
                ObtenerPacientes();

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
    BtnBuscar.parentElement.style.display = ''
    BtnLimpiar.parentElement.style.display = ''
    FormularioPacientes.reset();
    ObtenerPacientes();
}

const EliminarPaciente = async (ID) => {
    Swal.fire({
        title: '¿Está seguro de que desea eliminar al Paciente?',
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
            formData.append('paciente_id', ID);

            const url = '/odontologia/controller/paciente/Paciente.php';
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
                        FormularioPacientes.reset();
                        ObtenerPacientes();
                    });

                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo un problema al eliminar al paciente.',
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


ObtenerPacientes();
FormularioPacientes.addEventListener('submit', GuardarPacientes)
BtnModificar.addEventListener('click', ModificarPacientes)
BtnBuscar.addEventListener('click', ObtenerPacientes)
BtnCancelar.addEventListener('click', Cancelar)