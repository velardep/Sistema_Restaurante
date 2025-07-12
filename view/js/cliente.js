var tabla;

function init() {
 
    mostrarform(false);
    $("#clientes").on("submit", function (e) {
        guardaryeditarcliente(e);
    });
    
}


//Función mostrar formulario
function mostrarform(flag) {
    //limpiar();
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


//Función limpiar
function limpiar() {
    $("#nombre").val("");
    $("#descripcion").val("");
    $("#idaccion").val("");

}




function guardaryeditarcliente(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardarcliente").prop("disabled", true);
    var formData = new FormData($("#clientes")[0]);

    console.log(formData);
    $.ajax({
        url: "../src/cliente.php?op=0",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            console.log(datos);
            mensaje = datos.split(":");
                if (mensaje[0] == "1") {
                    swal.fire("Mensaje de Confirmación", mensaje[1], "success");
                    mostrarform(false);
                    tabla.ajax.reload();

                    

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


init();

