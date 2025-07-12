var tabla;

function initMenu(){
    listarMenu();
    $("#a").on("submit",function(e)
	{
		guardaryeditarMenu(e);	
	});
}

// Funcion para listar el menu
function listarMenu() {
    $.ajax({
        url: '../src/menu.php?op=0',
        type: 'get',
        dataType: 'json',
        success: function(data) {
            var container = $('#card');
            container.empty();

            data.forEach(function(item) {
                var card = `
                    <div class="col-md-4">
                        <div class="card bg-transparent border my-3 my-md-0">
                            <img src="../file/comida/${item.image}" alt="Food image" class="rounded-0 card-img-top mg-responsive">
                            <div class="card-body">
                                <h1 class="text-center mb-4"><a href="#" class="badge badge-primary">$${item.price}</a></h1>
                                <h4 class="pt50 pb50">${item.name}</h4>
                                <p class="text-white">${item.description}</p>
                                <button class="btn btn-info" onclick="mostrarMenu(${item.id})"><i class="bx bx-pencil"></i>Editar</button>
                                ${item.active ?
                                    `<button class="btn btn-primary" onclick="desactivarMenu(${item.id})"><i class="bx bx-trash"></i>Desactivar</button>` : 
                                    `<button class="btn btn-danger" onclick="activarMenu(${item.id})"><i class="bx bxs-check-square"></i>Activar</button>`}
                            </div>
                        </div>
                    </div>`;
                container.append(card);
            });
        },
        error: function(e) {
            console.log(e.responseText);    
        }
    }); 
}


// Funcion para mostrar el menu
function mostrarMenu(idcomida) {
    console.log('Editar botón clickeado para el ítem con ID: ' + idcomida);
    $.post("../src/menu.php?op=4", {idcomida: idcomida}, function(data, status) {
        console.log(data);
        data = JSON.parse(data);
        //mostrarform(true);
        $("#nombre").val(data.comidanombre);
        $("#tipo").val(data.comidatipo);
        $("#precio").val(data.comidaprecio);
        $("#descripcion").val(data.comidadescripcion);
        $("#idcomida").val(data.idcomida);
        $("#imagenmuestra").attr("src","../file/comida/"+data.comidaimagen);
		$("#imagenactual").val(data.comidaimagen);
    });
}


// Funcion para guardar y editar registros
function guardaryeditarMenu(e) {
    console.log("Formulario enviado");
    alert("Formulario enviado");

    $("#btnGuardarMenu").prop("disabled", true);
    var formData = new FormData($("#a")[0]);

    $.ajax({
        url: "../src/menu.php?op=1",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            mensaje=datos.split(":");
			if(mensaje[0]=="1"){               
			swal.fire(
				'Mensaje de Confirmación',
				mensaje[1],
				'success'

				);           
	          mostrarform(false);
	          tabla.ajax.reload();
			}
			else{
				Swal.fire({
					type: 'error',
					title: 'Error',
					text: mensaje[1],
					footer: 'Verifique la información de Registro, en especial que la información no fué ingresada previamente a la Base de Datos.'
				});
			}
        },
        
    });
}

//Función para desactivar registros
function desactivarMenu(idcomida) {
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
            $.post("../src/menu.php?op=2", {idcomida: idcomida}, function(e) {
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
function activarMenu(idcomida) {
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
            $.post("../src/menu.php?op=3", {idcomida: idcomida}, function(e) {
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


initMenu();