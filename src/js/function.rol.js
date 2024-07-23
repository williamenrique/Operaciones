var tableRol;
document.addEventListener('DOMContentLoaded', function () {
	tableRol = $('#tableRol').DataTable({
		"language": {
			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "Ningún dato disponible",
			"sInfo": "Total de _TOTAL_ Registros",
			"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix": "",
			"sSearch": "Buscar:",
			"sUrl": "",
			"sInfoThousands": ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst": "Primero",
				"sLast": "Último",
				"sNext": "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			},
			"buttons": {
				"copy": "Copiar",
				"colvis": "Visibilidad"
			}
		},
		"responsive": {
			"name": "medium",
			"width": "1188"
		},
		"ajax": {
			"url": ' ' + base_url + 'Roles/getRoles',
			"dataSrc": ''
		},
		"columns": [
			{ 'data': 'rol_id' },
			{ 'data': 'rol_name' },
			{ 'data': 'rol_descripcion' },
			{ 'data': 'rol_status' },
			{ 'data': 'opciones' }
		],
		"resonsieve": "true",
		"bDestroy": true,
		"iDisplayLength": 10,
		"order": [[0, "asc"]]
	});

	/****************NUEVO ROL **********************
	funcion para capturar los daros de un nuevo rol *
	************************************************/
	let formRol = document.querySelector('#formRol');
	formRol.onsubmit = function (e) {
		e.preventDefault();

		//obtener los datos
		let intIdRol = document.querySelector('#idRol').value;
		let strNombre = document.querySelector('#txtnombre').value;
		let strDescripcion = document.querySelector('#txtdescripcion').value;
		// let strStatus = document.querySelector('#selectStatus').value;
		var radioOption = $('[name="radioStatus"]:checked').val();
		//hacer una validacion para diferentes navegadores y crear el formato de lectura y hacemos la peticion mediante ajax
		//usando un if reducido creamos un objeto del contenido en (request)
		let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		let ajaxUrl = base_url + 'Roles/setRol';
		//creamos un objeto del formulario con los datos haciendo referencia a formData
		let formData = new FormData(formRol); 
		//prepara los datos por ajax preparando el dom
		request.open('POST', ajaxUrl, true);
		//envio de datos del formulario que se almacena enla variable
		request.send(formData);
		//despues del envio retornamos una funcion con los datos
		request.onreadystatechange = function () {
			//validamos la respuesta del servidor al enviar los datos
			if (request.readyState == 4 && request.status == 200) {
				//obtener el json y convertirlo a un objeto en javascript
				var objData = JSON.parse(request.responseText);
				//condionamos la respuesta del array del controlador
				if (objData.status) {
					// $('#modalRol').modal('hide');
					formRol.reset();
					notifi(objData.msg, 'success');
					//refrescamos el dataTable
					let tableRoles = $('#tableRol').DataTable();
					//recargamos la tabla 
					tableRoles.ajax.reload(function () {
						//cada vez que se haga una accion se recarga la tabla y los botones
						// fntEditRol();
						// fntDelRol();
					});
				} else {
					notifi(objData.msg, 'error');
				}
			}
		};
	};
})

/******************
 * cargamos el modal con su respectivo info de nuevo
 */
function openModal() {
	//inicializar el modal que sea nuevo rol
	document.querySelector('#idRol').value = '';//limpiar el value del input hiden del modal
	document.querySelector('#titleModal').innerHTML = 'Nuevo Rol';
	document.querySelector('.modal-header').classList.replace('headerUpdate', 'headerRegistrer');
	document.querySelector('#btnActionForm').classList.replace('btn-info', 'btn-primary');
	document.querySelector('#btnText').innerHTML = 'Guardar';
	document.querySelector('#formRol').reset();
	$("#modalRol").modal("show");
}
/***************************************
 * funcion para los botones de edicion eliminar y actualizar
 **************************************/
//se agrega el evento lod cuando carge el documento y ejecuta las funciones
window.addEventListener('load', function () {
	// fntEditRol();
	// fntDelRol();
}, false);
/****************************
 * funcion boton editar rol
 ****************************/
function fntEditRol(idRol) {
	//acceder al modal y modificar su apariencia en color de header y el texto de los botones
	document.querySelector('#title').innerHTML = 'Actualizar Rol';
	// document.querySelector('.modal-header').classList.replace('headerRegistrer', 'headerUpdate');
	document.querySelector('#btnActionForm').classList.replace('btn-primary', 'btn-success');
	document.querySelector('#btnText').innerHTML = 'Actualizar';
	//ejecutamos el ajax para obtener los datos del rol 
	var idRol = idRol;//refiriendono a a este atributo rl
	let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	let ajaxUrl = base_url + 'Roles/getRol/' + idRol;//url del documento
	request.open('GET', ajaxUrl, true);//abrimos conexion
	request.send();//enviar peticion
	//validamos si el envio y recepcion de datos
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			//mostramos los datos
			//convertir en objeto en formato JSON la respuesta
			var objData = JSON.parse(request.responseText);
			//validamos la respuesta
			if (objData.status) {
				//asignamos los valores obtenidos del controlador  al modal
				document.querySelector('#idRol').value = objData.data.rol_id;
				document.querySelector('#txtnombre').value = objData.data.rol_name;
				document.querySelector('#txtdescripcion').value = objData.data.rol_descripcion;
				if (objData.data.rol_status == 1) {
					/*********************************************************
					 * colocar el radio con el valor obtenido
					 * para evitar que se repita la opcion en 
					 * el select utilizamos una clase creada en css  notBlock
					 ********************************************************/
					//preparamos el valor de la variable en formato html
					var htmlRadio = `	<div class="form-check ml-2">
															<input class="form-check-input" type="radio" name="radioStatus" id="status2" value="2">
															<label class="form-check-label" for="status2">Inactivo</label>
														</div>
														<div class="form-check ml-2">
															<input class="form-check-input" type="radio" name="radioStatus" id="status1" value="1" checked>
															<label class="form-check-label" for="status1">Activo</label>
														</div>
													</div>
									`;
				} else {
					var htmlRadio = `	<div class="form-check ml-2">
														<input class="form-check-input" type="radio" name="radioStatus" id="status2" value="2" checked>
														<label class="form-check-label" for="status2">Inactivo</label>
														</div>
														<div class="form-check ml-2">
														<input class="form-check-input" type="radio" name="radioStatus" id="status1" value="1">
														<label class="form-check-label" for="status1">Activo</label>
														</div>
													</div>
												`;
				}
				//colocarle en el html un elemnto
				document.querySelector('.statusRol').innerHTML = htmlRadio;
				// $('#modalRol').modal('show');
			} else {
				notifi(objData.msg, 'error');
			}
		}
	}
}
/****************************
 * funcion boton eliminar rol
 ****************************/
function fntDelRol(idRol) {
	//obtenemos el valor del atributo individual
	var idRol = idRol;
	Swal.fire({
		title: 'Estas seguro de eliminar el Rol?',
		text: "No podra ser revertido el proceso!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: 'btn btn-success',
		cancelButtonColor: 'btn btn-danger',
		confirmButtonText: 'Si, eliminar!'
	}).then((result) => {
		if (result.isConfirmed) {
			//hacer una validacion para diferentes navegadores y crear el formato de lectura y hacemos la peticion mediante ajax
			let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url + 'Roles/delRol/' + idRol;
			//id del atributo lr que obtuvimos enla variable
			let strData = "idRol=" + idRol;
			request.open("POST", ajaxUrl, true);
			//forma en como se enviara
			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			//enviamos
			request.send(strData);
			// request.send();
			request.onreadystatechange = function () {
				//comprobamos la peticion
				if (request.readyState == 4 && request.status == 200) {
					//convertir en objeto JSON
					let objData = JSON.parse(request.responseText);
					if (objData.status) {
						Swal.fire('Eliminar!', objData.msg, 'success');
						let tableRoles = $('#tableRol').DataTable();
						tableRoles.ajax.reload();
					} else {
						Swal.fire('Atencion!', objData.msg, 'error');
					}
				}
			}
		}
	})
}