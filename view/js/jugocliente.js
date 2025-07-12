var tabla;

function initJugo(){



    listarJugo();

    $("#b").on("submit",function(e)
	{
		guardaryeditarJugo(e);	
	});
}

// Funcion para listar el menu
function listarJugo() {
    $.ajax({
        url: '../src/jugo.php?op=6',
        type: 'get',
        dataType: 'json',
        success: function(data) {
            var container = $('#card2');
            container.empty(); 

            data.forEach(function(item) {
                var card2 = `
                    <div class="col-md-4">
                        <div class="card bg-transparent border my-3 my-md-0">
                            <img src="../file/jugo/${item.image}" alt="Food image" class="rounded-0 card-img-top mg-responsive">
                            <div class="card-body">
                                <h1 class="text-center mb-4"><a href="#" class="badge badge-primary">$${item.price}</a></h1>
                                <h4 class="pt50 pb50">${item.name}</h4>
                                <p class="text-white">${item.description}</p>
                                
                            </div>
                        </div>
                    </div>`;
                container.append(card2);
            });
        },
        error: function(e) {
            console.log(e.responseText);    
        }
    });
}


// Funcion para guardar y editar jugo
function guardaryeditarJugo(e) {
    console.log("Formulario enviado");

    $("#btnGuardarJugos").prop("disabled", true);
    var formData = new FormData($("#b")[0]);

    $.ajax({
        url: "../src/jugo.php?op=1",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            console.log(datos);
            console.log("ta bien");
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", status, error);
        }
    });
}

// Funcion para mostrar jugo
function mostrarJugo(idjugo) {
    console.log('Editar botón clickeado para el ítem con ID: ' + idjugo);
    $.post("../src/jugo.php?op=4", {idjugo: idjugo}, function(data, status) {
        console.log(data);
        data = JSON.parse(data);
        $("#nombrejugo").val(data.jugonombre);
        $("#tipojugo").val(data.jugotipo);  
        $("#preciojugo").val(data.jugoprecio);
        $("#descripcionjugo").val(data.jugodescripcion);
        $("#idjugo").val(data.idjugo);
        $("#imagenmuestrajugo").attr("src","../file/jugo/"+data.jugoimagen);
		$("#imagenactualjugo").val(data.jugoimagen);
    });
}
//Función para desactivar registros
function desactivarJugo(idjugo) {
    swal.fire({
        title: 'Mensaje de Confirmación',
        text: "¿Desea desactivar el Registro?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Desactivar'
    }).then((result) => {
        if (result.value) {
            $.post("../src/jugo.php?op=2", {idjugo: idjugo}, function(e) {
                mensaje = e.split(":");
                if (mensaje[0] == "1") {  
                    swal.fire(
                        'Mensaje de Confirmación',
                        mensaje[1],
                        'success'
                    ).then(() => {
                        location.reload(); // Recargar la página
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Error',
                        text: mensaje[1],
                        footer: 'Verifique la información de Registro, en especial que la información no fué ingresada previamente a la Base de Datos.'
                    });
                }			
            });	
        }
    });   
}

//Función para activar registros
function activarJugo(idjugo) {
    swal.fire({
        title: 'Mensaje de Confirmación',
        text: "¿Desea activar el Registro?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Activar'
    }).then((result) => {
        if (result.value) {
            $.post("../src/jugo.php?op=3", {idjugo: idjugo}, function(e) {
                console.log(e);
                mensaje = e.split(":");
                if (mensaje[0] == "1") {  
                    swal.fire(
                        'Mensaje de Confirmación',
                        mensaje[1],
                        'success'
                    ).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Error',
                        text: mensaje[1],
                        footer: 'Verifique la información de Registro, en especial que la información no fué ingresada previamente a la Base de Datos.'
                    });
                }			
            });	
        }
    }); 
}

initJugo();