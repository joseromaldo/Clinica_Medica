const btnGuardar = document.getElementById('btnGuardar');
const btnModificar = document.getElementById('btnModificar');
const btnBuscar = document.getElementById('btnBuscar');
const btnCancelar = document.getElementById('btnCancelar');
const btnLimpiar = document.getElementById('btnLimpiar');
const tablaServicios = document.getElementById('tablaServicios');
const formulario = document.getElementById('formulario');

btnModificar.parentElement.style.display = 'none';
btnCancelar.parentElement.style.display = 'none';

const getServicios = async (alerta ='si') => {
    const nombre = formulario.ser_nombre.value.trim();
    const fecha = formulario.ser_fecha.value.trim();

  
    const url = `/Clinica_Medica/controllers/servicio/index.php?ser_nombre=${nombre}&ser_fecha${fecha}`;
  
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data);

        tablaServicios.tBodies[0].innerHTML = '';
        const fragment = document.createDocumentFragment();
        let contador = 1;

        if (respuesta.status === 200) {
            if(alerta =='si'){
                Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: "success",
                    title: 'Grados encontrados',
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                }).fire();

            }

            if (data.length > 0) {
                data.forEach(ser => {
                    const tr = document.createElement('tr');
                    const celda1 = document.createElement('td');
                    const celda2 = document.createElement('td');
                    const celda3 = document.createElement('td');
                    const celda4 = document.createElement('td');
                    const celda5 = document.createElement('td');
                    
                    const buttonModificar = document.createElement('button');
                    const buttonEliminar = document.createElement('button');

                    celda1.innerText = contador;
                    celda2.innerText = ser.SER_NOMBRE;
                    celda3.innerText = ser.SER_FECHA;
                   
                    buttonModificar.textContent = 'Modificar';
                    buttonModificar.classList.add('btn', 'btn-warning', 'w-100');
                    buttonModificar.addEventListener('click', () => llenarDatos(ser));

                    buttonEliminar.textContent = 'Eliminar';
                    buttonEliminar.classList.add('btn', 'btn-danger', 'w-100');
                    buttonEliminar.addEventListener('click', () => eliminar(ser.SER_ID));

                    celda4.appendChild(buttonModificar);
                    celda5.appendChild(buttonEliminar);

                    tr.appendChild(celda1);
                    tr.appendChild(celda2);
                    tr.appendChild(celda3);
                    tr.appendChild(celda4);
                    tr.appendChild(celda5);
                    fragment.appendChild(tr);

                    contador++;
                });
            } else {
                const tr = document.createElement('tr');
                const td = document.createElement('td');
                td.innerText = 'No hay servicios disponibles';
                td.colSpan = 4 ;

                tr.appendChild(td);
                fragment.appendChild(tr);
            }
        } else {
            console.log('Error al cargar servicios');
        }

        tablaServicios.tBodies[0].appendChild(fragment);
    } catch (error) {
        console.log(error);
    }
};



const guardarServicios = async (e) => {
    e.preventDefault();
    btnGuardar.disabled = true;

    const url = '/Clinica_Medica/controllers/servicio/index.php';
    const formData = new FormData(formulario);
    formData.append('tipo', 1);
    formData.delete('ser_id');

    const config = {
        method: 'POST',
        body: formData
    };

    try {
        console.log('Enviando datos:', ...formData.entries());
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log('Respuesta recibida:', data);
        const { mensaje, codigo, detalle } = data;
        if (respuesta.ok && codigo === 1) {
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "success",
                title: mensaje,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();

            formulario.reset();
            getServicios(alerta ='no');
        } else {
            console.log('Error:', detalle);
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "error",
                title: 'Error al guardar',
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();
        }
    } catch (error) {
        console.log('Error de conexión:', error);
        Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: "error",
            title: 'Error de conexión',
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        }).fire();
    }
    btnGuardar.disabled = false;
};

const llenarDatos = (ser) => {
    formulario.ser_nombre.value = ser.SER_NOMBRE;
    formulario.ser_fecha.value = ser.SER_FECHA;
    formulario.ser_id.value = ser.SER_ID;


    btnLimpiar.parentElement.style.display = 'none';
    btnBuscar.parentElement.style.display = 'none';
    btnCancelar.parentElement.style.display = '';
    btnGuardar.parentElement.style.display = 'none';
    btnModificar.parentElement.style.display = '';
};

const modificar = async (e) => {
    e.preventDefault();
    btnModificar.disabled = true;

    const url = '/Clinica_Medica/controllers/servicio/index.php';
    const formData = new FormData(formulario);
    formData.append('tipo', 2);

    const config = {
        method: 'POST',
        body: formData
    };

    try {
        console.log('Enviando datos:', ...formData.entries());
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log('Respuesta recibida:', data);
        const { mensaje, codigo, detalle } = data;
        if (respuesta.ok && codigo === 1) {
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "success",
                title: mensaje,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();

            formulario.reset();
            getServicios(alerta ='no');
            btnBuscar.parentElement.style.display = '';
            btnCancelar.parentElement.style.display = 'none';
            btnGuardar.parentElement.style.display = '';
            btnModificar.parentElement.style.display = 'none';
        } else {
            console.log('Error:', detalle);
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "error",
                title: 'Error al modificar',
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();
        }
    } catch (error) {
        console.log('Error de conexión:', error);
        Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: "error",
            title: 'Error de conexión',
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        }).fire();
    }
    btnModificar.disabled = false;
};

const cancelar = (e) => {
    e.preventDefault();

    formulario.reset();

    btnLimpiar.parentElement.style.display = '';
    btnBuscar.parentElement.style.display = '';
    btnCancelar.parentElement.style.display = 'none';
    btnGuardar.parentElement.style.display = '';
    btnModificar.parentElement.style.display = 'none';

    Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        icon: "info",
        title: 'Modificación cancelada',
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    }).fire();
};

const eliminar = async (serId) => {
    const url = '/Clinica_Medica/controllers/servicio/index.php';
    const formData = new FormData();
    formData.append('ser_id', serId);
    formData.append('tipo', 3);

    const config = {
        method: 'POST',
        body: formData
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { mensaje, codigo, detalle } = data;
        if (respuesta.ok && codigo === 1) {
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "success",
                title: mensaje,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();

            getServicios(alerta ='no');
        } else {
            console.log('Error:', detalle);
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "error",
                title: 'Error al eliminar',
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();
        }
    } catch (error) {
        console.log('Error de conexión:', error);
        Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: "error",
            title: 'Error de conexión',
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        }).fire();
    }
};

const limpiarFormulario = () => {
    formulario.reset();
};

getServicios();
btnGuardar.addEventListener('click', guardarServicios);
btnModificar.addEventListener('click', modificar);
btnCancelar.addEventListener('click', cancelar);
btnBuscar.addEventListener('click', getServicios);
btnLimpiar.addEventListener('click', limpiarFormulario);
