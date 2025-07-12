// Definir la variable Tabla
var tabla;

// Inicializacion
function init() {
    //Validacion de campos
    

    // Listar registros y ocultar formulario
    
    listarMesa();
    
    // listar();
    mostrarFormulario(false);

    // Manejar el envio del formulario
    $("#formulario").on("submit", function (e) {
        guardaryeditarMesa(e);
    });

}



// Mostrar formulario
function mostrarFormulario(flag) {
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardarMesa").prop("disabled", false);
        $("#btnagregar").hide();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnGuardarMesa").show();
    }
}


// Limpiar campos
function limpiar() {
    $("#numero").val("");
    $("#capacidad").val("");
    $("#idmesa").val("");
}

// Listar registros
function listar(){
    tabla = $("#tbllistado").DataTable({
        buttons: ["copy", "excel", "pdf"],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json",
        },
        lengthMenu: [10, 25, 50, 75, 100],
        processing: true,
        serverSide: true,
        dom: "Bfrtip",
        ajax: {
            url: "../src/mesa.php?op=0",
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            },
        },
        destroy: true,
        iDisplayLength: 10,
        order: [[0, "asc"]],
        columnDefs: [
            {
                width: "100px",
                targets: [2, 3],
            },
            
        ],
    });
}

function listarMesa(){
        $.ajax({
        url: "../src/mesa.php?op=0",
        type: "POST",
        dataType: 'JSON',

        success: function (datos) {
            var select = $('#mostrarmesa');
            for (let index = 0; index < datos.length; index++) {
                select.append(`<option value=${datos[index].num_mesa}>Mesa Número ${datos[index].num_mesa}</option>`);
            }
            console.log(datos);
         },
         error: function(xhr, status, error) {
        // Función que se ejecutará si hay un error en la solicitud
        console.error('Error en la solicitud:', error);
    }
    });
}


// Generar o editar registros
function guardaryeditarMesa(e) {
    e.preventDefault(); 
    $("#btnGuardarMesa").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);
    limpiar();

    $.ajax({
        url: "../src/mesa.php?op=1",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            console.log(datos);
            mensaje = datos.split(":");
                if (mensaje[0] == "1") {
                    swal.fire("Mensaje de Confirmación", mensaje[1], "success");
                    mostrarFormulario(false);
                    tabla.ajax.reload();
                    listar(); 

                } else {
                    Swal.fire({
                        icon: "error",
                        type: "error",
                        title: "Error",
                        text: mensaje[1],
                        footer:
                        "Verifique la información de Registro, en especial que la información no fué ingresada previamente a la Base de Datos.",
                    });
                }
         },
    });
    
    limpiar();
}

// Mostrar detalles de un registro
function mostrar(idmesa) {
    $.post(
        "../src/mesa.php?op=4",
        { idmesa: idmesa },
        function (data, status) {
            data = JSON.parse(data);
            console.log(data);
            mostrarFormulario(true);
            $("#numero").val(data.mesanumero);
            $("#capacidad").val(data.mesacapacidad);
            $("#idmesa").val(data.idmesa);
        }
    );
}

// Desactivar un registros
function desactivar(idmesa) {
    swal
    .fire({
        title: "Mensaje de Confirmación",
        text: "¿Desea desactivar el Registro?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Desactivar",
    })
    .then((result) => {
        if (result.value) {
            $.post(
                "../src/mesa.php?op=2",
                { idmesa: idmesa },
                function (e) {
                    mensaje = e.split(":");
                    if (mensaje[0] == "1") {
                        swal.fire("Mensaje de Confirmación", mensaje[1], "success");
                        tabla.ajax.reload();
                        listar(); 

                    } else {
                        Swal.fire({
                            type: "error",
                            title: "Error",
                            text: mensaje[1],
                            footer:
                                "Verifique la información de Registro, en especial que la información no fué ingresada previamente a la Base de Datos.",
                        });
                    }
                }
            );
        }
    });
}

// Activar un registros
function activar(idmesa) {
    swal
        .fire({
            title: "Mensaje de Confirmación",
            text: "¿Desea activar el Registro?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Activar",
        })
        .then((result) => {
            if (result.value) {
                $.post(
                    "../src/mesa.php?op=3",
                    { idmesa: idmesa },
                    function (e) {
                        mensaje = e.split(":");
                        if (mensaje[0] == "1") {
                            swal.fire("Mensaje de Confirmación", mensaje[1],"success");
                            tabla.ajax.reload();
                            listar(); 

                        } else {
                            Swal.fire({
                                type: "error",
                                title: "Error",
                                text: mensaje[1],
                                footer:
                                    "Verifique la información de Registro, en especial que la información no fué ingresada previamente a la Base de Datos.",
                            });
                        }
                    }
                );
            }
        });
}

// Inicializar la aplicación
init();