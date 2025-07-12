// Definir la variable Tabla
var tabla;

// Inicialización
function init() {
    // Validación de campos
    $("#num_comensales").validacion("0123456789");
    $("#reservahora").validacion("0123456789:");
    $("#reservafecha").validacion("0123456789-");
    $("#mostrarmesa").validacion("0123456789");

    // Manejar el envío del formulario
    $("#reservaForm").on("submit", function (e) {
        guardaryeditarreserva();
    });
}

// Función mostrar formulario
function mostrarform(flag) {
    // limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

// Función limpiar
function limpiar() {
    $("#num_comensales").val("");
    $("#reservahora").val("");
    $("#reservafecha").val("");
    $("#mostrarmesa").val("");
}

function guardaryeditarreserva() {
    // e.preventDefault(); // Prevenir acción predeterminada
    $("#btnGuardarreserva").prop("disabled", true);
    var formData = new FormData($("#reservaForm")[0]);
    
    $.ajax({
        url: "../src/reserva.php?op=0",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            var datos = JSON.parse(response);
            if (datos.status === 1) {
                Swal.fire("Mensaje de Confirmación", datos.message, "success");
                limpiar();
            } else {
                Swal.fire("Error", datos.message, "error");
            }
        },
        complete: function () {
            $("#btnGuardarreserva").prop("disabled", false);
        }
    });
}


function mostrarmesas(e) {
    e.preventDefault(); // No se activará la acción predeterminada del evento
    $.ajax({
        url: "../src/reserva.php?op=1",
        type: "POST",
        contentType: false,
        processData: false,
        success: function (response) {
            var datos = JSON.parse(response);
            if (Array.isArray(datos)) {
                var select = $("#mostrarmesa");
                select.empty();
                datos.forEach(function (mesa) {
                    select.append(new Option(mesa.nombre, mesa.id)); // Ajusta según los campos devueltos
                });
                select.prop("disabled", false);
            } else {
                Swal.fire("Error", "No se pudieron obtener las mesas disponibles.", "error");
            }
        },
        complete: function () {
            $("#mostrarmesa").prop("disabled", false);
        }
    });
}

// Inicializar
init();
