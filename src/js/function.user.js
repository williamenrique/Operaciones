document.addEventListener('DOMContentLoaded', function () {
	tableUser = $('#tableUser').DataTable({
			pageLength: 50,
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
			"url": ' ' + base_url + 'Usuarios/getUsers',
			"dataSrc": ''
		},
		"columns": [
			{ 'data': 'user_id' },
			{ 'data': 'user_nick' },
			{ 'data': 'user_nombres' },
			{ 'data': 'user_apellidos' },
			{ 'data': 'user_email' },
			{ 'data': 'user_tlf' },
			{ 'data': 'rol_name' },
			{ 'data': 'user_status' },
			{ 'data': 'opciones' }
		],
		"resonsieve": "true",
		"bDestroy": true,
		"iDisplayLength": 10,
		"order": [[0, "asc"]]
	})
if (document.querySelector('#formUser')) {
		var formUser = document.querySelector('#formUser')
		//agregar el evento al boton del formulario
		formUser.onsubmit = function (e) {
			e.preventDefault()
			/*************************************************
			* creamos el objeto de envio para tipo de navegador
			* hacer una validacion para diferentes navegadores y crear el formato de lectura
			* y hacemos la peticion mediante ajax
			* usando un if reducido creamos un objeto del contenido en(request)
			*****************************************************/
			let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
			let ajaxUrl = base_url + 'Usuarios/setUser'
			//creamos un objeto del formulario con los datos haciendo referencia a formData
			let formData = new FormData(formUser )
			//prepara los datos por ajax preparando el dom
			request.open('POST', ajaxUrl, true)
			//envio de datos del formulario que se almacena enla variable
			request.send(formData)
			//obtenemos los resultados
			request.onreadystatechange = function () {
				if (request.readyState == 4 && request.status == 200) {
					//obtenemos los datos y convertimos en JSON
					let objData = JSON.parse(request.responseText)
					//leemos el ststus de la respuesta
					if (objData.status) {
						notifi(objData.msg, 'success')
						formUser.reset()
						// tableUser.ajax.reload()
					} else {
						notifi(objData.msg, 'error')
					}
				}
			}
		}
	}
}, false)
/******* deshabilitar usuario ********/
function fntDelUser(idUser) {
	//obtenemos el valor del atributo individual
	var idUser = idUser
	Swal.fire({
		title: 'Estas seguro de eliminar el usuario?',
		text: "No podra ser revertido el proceso!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: 'btn btn-success',
		cancelButtonColor: 'btn btn-danger',
		confirmButtonText: 'Si, eliminar!'
	}).then((result) => {
		if (result.isConfirmed) {
			//hacer una validacion para diferentes navegadores y crear el formato de lectura y hacemos la peticion mediante ajax
			let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
			let ajaxUrl = base_url + 'Usuarios/delUser/' + idUser
			//id del atributo lr que obtuvimos enla variable
			let strData = "idUser=" + idUser
			request.open("POST", ajaxUrl, true)
			//forma en como se enviara
			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
			//enviamos
			request.send(strData)
			request.onreadystatechange = function () {
				//comprobamos la peticion
				if (request.readyState == 4 && request.status == 200) {
					//convertir en objeto JSON
					let objData = JSON.parse(request.responseText)
					if (objData.status) {
						$(function () {
							var Toast = Swal.mixin({
								toast: true,
								position: 'top-end',
								showConfirmButton: false,
								timer: 3000
							})
							Toast.fire({
								icon: 'success',
								title: objData.msg
							})
						})
						//Swal.fire('Proceso Exitoso!', objData.msg, 'success')
						let tableRoles = $('#tableRol').DataTable()
						tableUser.ajax.reload(function () {
							//cada vez que se haga una accion se recarga la tabla y los botones
							fntRolesUsuarios()
						})
					} else {
						Swal.fire('Atencion!', objData.msg, 'error')
					}
				}
			}
		}
	})
}
/******* cambiar status ********/
function fntStatus(status,idUser) {
	//obtenemos el valor del atributo individual
	var status = status;
	Swal.fire({
		title: 'Estas seguro de cambiar el estado del usuario?',
		// text: "No podra ser revertido el proceso!",
		icon: 'info',
		showCancelButton: true,
		confirmButtonColor: 'btn btn-success',
		cancelButtonColor: 'btn btn-danger',
		confirmButtonText: 'Si, cambiar!'
	}).then((result) => {
		if (result.isConfirmed) {
			//hacer una validacion para diferentes navegadores y crear el formato de lectura y hacemos la peticion mediante ajax
			let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url + 'Usuarios/statusUser/';
			//id del atributo lr que obtuvimos enla variable
			// let strData = [{"status" :status,"idUser": idUser}];
			let strData = new URLSearchParams("idUser="+idUser+"&status="+status);
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
						if (objData.estado == 1) {
							$(function () {
								var Toast = Swal.mixin({
									toast: true,
									position: 'top-end',
									showConfirmButton: false,
									timer: 3000
								})
								Toast.fire({
									icon: 'success',
									title: objData.msg
								})
							})
							if (boxUserHigh) {
								tableUserHigh.ajax.reload();
							}
						} else {
							$(function () {
								var Toast = Swal.mixin({
									toast: true,
									position: 'top-end',
									showConfirmButton: false,
									timer: 3000
								})
								Toast.fire({
									icon: 'success',
									title: objData.msg
								})
							})
						}
						//Swal.fire('Proceso Exitoso!', objData.msg, 'success');
						let tableRoles = $('#tableRol').DataTable();
						tableUser.ajax.reload();
					} else {
						Swal.fire('Atencion!', objData.msg, 'error');
					}
				}
			}
		}
	})
}