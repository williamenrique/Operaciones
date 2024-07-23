var tablePersonal
document.addEventListener('DOMContentLoaded', function () {
	/**********cargarcargar  en la tabla**********/
	if(document.querySelector('#tablePersonal')){
		$("#tablePersonal").DataTable({
			"responsive": true, "lengthChange": false, "autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print"],
			pageLength: 50,
			"language": {
				"sProcessing": "Procesando...",
				"sLengthMenu": "Mostrar _MENU_ registros",
				"sZeroRecords": "No se encontraron resultados",
				"sEmptyTable": "Ningún dato disponible",
				"sInfo": "Total de _TOTAL_ Registros",
				"sInfoEmpty": "Registros del 0 al 0 de un total de 0 registros",
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
				}
			},
			"ajax": {
				"url": ' ' + base_url + 'Personal/getPersonal',
				"dataSrc": ''
			},
			"columns": [
				{ 'data': 'personal_cedula' },
				{ 'data': 'personal_nombre' },
				{ 'data': 'cargo' },
				{ 'data': 'personal_tlf' },
				{ 'data': 'personal_status' }
			],
			dom: 'Bfrtip',
			"responsive": true, "lengthChange": true, "autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print"]
		}).buttons().container().appendTo('#tableFlota_wrapper .col-sm-6:eq(0)')
	}
	// traer personal y cargarlo en tabla del 1x10
	if(document.querySelector('#tablePersonalVota')){
		$("#tablePersonalVota").DataTable({
			"responsive": true, "lengthChange": false, "autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print"],
			pageLength: 50,
			"language": {
				"sProcessing": "Procesando...",
				"sLengthMenu": "Mostrar _MENU_ registros",
				"sZeroRecords": "No se encontraron resultados",
				"sEmptyTable": "Ningún dato disponible",
				"sInfo": "Total de _TOTAL_ Registros",
				"sInfoEmpty": "Registros del 0 al 0 de un total de 0 registros",
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
				}
			},
			"ajax": {
				"url": ' ' + base_url + 'Personal/getPersonalVota',
				"dataSrc": ''
			},
			"columns": [
				{ 'data': 'personal_cedula' },
				{ 'data': 'personal_nombre' },
				{ 'data': 'cargo' },
				{ 'data': 'personal_tlf' },
				{ 'data': 'personal_voto' },
				{ 'data': '1x10' }
			],
			dom: 'Bfrtip',
			"responsive": true, "lengthChange": true, "autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print"]
		}).buttons().container().appendTo('#tablePersonalVota_wrapper .col-sm-6:eq(0)')
	}
	/**********cargarcargar  en la tabla**********/
	if(document.querySelector('#tablePersonalF')){
		$("#tablePersonalF").DataTable({
			"responsive": true, "lengthChange": false, "autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print"],
			pageLength: 50,
			"language": {
				"sProcessing": "Procesando...",
				"sLengthMenu": "Mostrar _MENU_ registros",
				"sZeroRecords": "No se encontraron resultados",
				"sEmptyTable": "Ningún dato disponible",
				"sInfo": "Total de _TOTAL_ Registros",
				"sInfoEmpty": "Registros del 0 al 0 de un total de 0 registros",
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
				}
			},
			"ajax": {
				"url": ' ' + base_url + 'Personal/getPersonalF',
				"dataSrc": ''
			},
			"columns": [
				{ 'data': 'personal_cedula' },
				{ 'data': 'personal_nombre' },
				{ 'data': 'cargo' },
				{ 'data': 'personal_tlf' },
				{ 'data': 'personal_status' }
			],
			dom: 'Bfrtip',
			"responsive": true, "lengthChange": true, "autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print"]
		}).buttons().container().appendTo('#tableFlota_wrapper .col-sm-6:eq(0)')
	}
	/**********cargar personal ya voto  en la tabla**********/
	if(document.querySelector('#tablePersonalConteo')){
		$("#tablePersonalConteo").DataTable({
			"responsive": true, "lengthChange": false, "autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print"],
			pageLength: 50,
			"language": {
				"sProcessing": "Procesando...",
				"sLengthMenu": "Mostrar _MENU_ registros",
				"sZeroRecords": "No se encontraron resultados",
				"sEmptyTable": "Ningún dato disponible",
				"sInfo": "Total de _TOTAL_ Registros",
				"sInfoEmpty": "Registros del 0 al 0 de un total de 0 registros",
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
				}
			},
			"ajax": {
				"url": ' ' + base_url + 'Personal/getPersonalConteo',
				"dataSrc": ''
			},
			"columns": [
				{ 'data': 'personal_cedula' },
				{ 'data': 'personal_nombre' },
				{ 'data': 'cargo' },
				{ 'data': 'personal_tlf' },
				{ 'data': 'personal_status' }
			],
			dom: 'Bfrtip',
			"responsive": true, "lengthChange": true, "autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print"]
		}).buttons().container().appendTo('#tableFlota_wrapper .col-sm-6:eq(0)')
	}
})
window.addEventListener('load', function () {
},false)
/**********si existe el select cargamos los puestos de trabajo en el select**********/
if (document.querySelector('#listCargo')) {
	let ajaxUrl = base_url + "Personal/getSelectCargo"
	//creamos el objeto para os navegadores
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	//abrimos la conexion y enviamos los parametros para la peticion
	request.open("GET", ajaxUrl, true)
	request.send()
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			//option obtenidos del controlador
			document.querySelector('#listCargo').innerHTML = request.responseText
			//seleccionando el primer option
			$("#listCargo").selectpicker('render')
		}
	}
}
/********** funcion cambiar el estado del personal***************/
function fntStatus(status,idPersonal){
	(async () => {
		/* inputOptions can be an object or Promise */
		const inputOptions = new Promise((resolve) => {
			setTimeout(() => {
			resolve({
				'1': 'Activo',
				'0': 'Inactivo',
				'2': 'Vacaciones',
				'3': 'Reposo'
			})
			}, 1000)
		})
		
		const { value: color } = await Swal.fire({
			title: 'Seleccione el cambio del estado dl personal .',
			input: 'radio',
			inputOptions: inputOptions,
			inputValidator: (value) => {
			if (!value) {
				return 'Es necesario que seleccione una opcion'
			}
			}
		})
		if (color) {
			// console.log(color)
			// Swal.fire({ html: `You selected: ${color}` })
			(async () => {
				const { value: text } = await Swal.fire({
					input: 'textarea',
					inputPlaceholder: 'Observacion por el cambio.',
					inputAttributes: {
						'aria-label': 'Observacion por el cambio.'
					},
					showCancelButton: true,
					inputValidator: (value) => {
						if (!value) {
							return 'Necesitas escribir algo!'
						}
					}
				})
				if (text) {
					//hacer una validacion para diferentes navegadores y crear el formato de lectura y hacemos la peticion mediante ajax
					let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
					let ajaxUrl = base_url + 'Personal/statusPersonal/'
					//id del atributo lr que obtuvimos enla variable
					let strData = new URLSearchParams("idPersonal="+idPersonal+"&idStatus="+color+"&srtText="+text)
					request.open("POST", ajaxUrl, true)
					//forma en como se enviara
					request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
					//enviamos
					request.send(strData)
					// request.send()
					request.onreadystatechange = function () {
						//comprobamos la peticion
						if (request.readyState == 4 && request.status == 200) {
							//convertir en objeto JSON
							let objData = JSON.parse(request.responseText)
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
								}else{
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
								let tablePersonal = $('#tablePersonal').DataTable()
								tablePersonal.ajax.reload()
							}else{
								Swal.fire('Atencion!', objData.msg, 'error')
							}
						}
					}
				}
			})()
		}
	})()
}
//TODO: 1X10
/**********si existe el select cargamos el personal en el select**********/
if (document.querySelector('#listPersonal')) {
	let ajaxUrl = base_url + "Personal/getListPersonal"
	//creamos el objeto para os navegadores
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	//abrimos la conexion y enviamos los parametros para la peticion
	request.open("GET", ajaxUrl, true)
	request.send()
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			//option obtenidos del controlador
			document.querySelector('#listPersonal').innerHTML = request.responseText
			//seleccionando el primer option
			$("#listPersonal").selectpicker('render')
		}
	}
}
/**********si existe el elemneto le incluimos el contador**********/
if (document.querySelector('#numbConteo')) {
	let ajaxUrl = base_url + "Personal/contPersonal"
	//creamos el objeto para os navegadores
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	//abrimos la conexion y enviamos los parametros para la peticion
	request.open("GET", ajaxUrl, true)
	request.send()
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			//option obtenidos del controlador
			var objData = JSON.parse(request.responseText)
			document.querySelector('#numbConteo').innerHTML = objData[0].CONTEO
		}
	}
}
/****************agregar 1x10 al personal***********************/
if(document.querySelector('#formUnoXDiez')){
	let formUnoXDiez = document.querySelector('#formUnoXDiez')
	formUnoXDiez.onsubmit = function (e) {
		e.preventDefault()
		//usando un if reducido creamos un objeto del contenido en (request)
		let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
		let ajaxUrl = base_url + 'Personal/setUnoXDiez'
		//creamos un objeto del formulario con los datos haciendo referencia a formData
		let formData = new FormData(formUnoXDiez) 
		//prepara los datos por ajax preparando el dom
		request.open('POST', ajaxUrl, true)
		//envio de datos del formulario que se almacena enla variable
		request.send(formData)
		//despues del envio retornamos una funcion con los datos
		request.onreadystatechange = function () {
			//validamos la respuesta del servidor al enviar los datos
			if (request.readyState == 4 && request.status == 200) {
				//obtener el json y convertirlo a un objeto en javascript
				var objData = JSON.parse(request.responseText)
				//condionamos la respuesta del array del controlador
				if (objData.status) {
					// formUnidad.reset()
					notifi(objData.msg, 'success')
					document.querySelector('#txtCedula').value = ''
					document.querySelector('#txtCedula').focus()
					document.querySelector('#txtNombre').value = ''
				} else {
					notifi(objData.msg, 'error')
				}
			}
		}
	}
}
// TODO: mostrar en una lista todos los agregados por personal
const fntView1x10 = (intPersonal) => {
	//usando un if reducido creamos un objeto del contenido en (request)
	let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	let ajaxUrl = base_url + "Personal/getUnoXDiez/" + intPersonal
	//prepara los datos por ajax preparando el dom
	request.open('POST', ajaxUrl, true)
	//envio de datos del formulario que se almacena enla variable
	request.send()
	//despues del envio retornamos una funcion con los datos
	request.onreadystatechange = function () {
		//validamos la respuesta del servidor al enviar los datos
		if (request.readyState == 4 && request.status == 200) {
			//obtener el json y convertirlo a un objeto en javascript
			// var objData = JSON.parse(request.responseText)
			document.getElementById('list1x10').innerHTML = request.responseText
		}
	}
}
// cambiar el estado del voto del persobnal
const fntVotoPersonal = (intPersonal) =>{
	//usando un if reducido creamos un objeto del contenido en (request)
	let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	let ajaxUrl = base_url + "Personal/changeVotoP"
	let strData = new URLSearchParams("intPersonal="+intPersonal)
	//prepara los datos por ajax preparando el dom
	request.open('POST', ajaxUrl, true)
	//envio de datos del formulario que se almacena enla variable
	request.send(strData)
	//despues del envio retornamos una funcion con los datos
	request.onreadystatechange = function () {
		//validamos la respuesta del servidor al enviar los datos
		if (request.readyState == 4 && request.status == 200) {
			var objData = JSON.parse(request.responseText)
			if (objData.status) {
				notifi(objData.msg, 'success')
				//refrescamos el dataTable
				let tablePersonalVota = $('#tablePersonalVota').DataTable()
				// recargamos la tabla 
				tablePersonalVota.ajax.reload()
			} else {
				notifi(objData.msg, 'error')
			}
		}
	}
}
// cambiar el estado del voto del persobnal
const fntVotoMilitante = (intPersonal,intVoto) =>{
	//usando un if reducido creamos un objeto del contenido en (request)
	let request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP')
	let ajaxUrl = base_url + "Personal/changeVotoM"
	let strData = new URLSearchParams("intVoto="+intVoto)
	//prepara los datos por ajax preparando el dom
	request.open('POST', ajaxUrl, true)
	//envio de datos del formulario que se almacena enla variable
	request.send(strData)
	//despues del envio retornamos una funcion con los datos
	request.onreadystatechange = function () {
		//validamos la respuesta del servidor al enviar los datos
		if (request.readyState == 4 && request.status == 200) {
			var objData = JSON.parse(request.responseText)
			if (objData.status) {
				notifi(objData.msg, 'success')
				//refrescamos el dataTable
				let tablePersonalVota = $('#tablePersonalVota').DataTable()
				// recargamos la tabla 
				tablePersonalVota.ajax.reload()
				fntView1x10(intPersonal)
			} else {
				notifi(objData.msg, 'error')
			}
		}
	}
}

// cambiar el estado del voto del militante
// const fntVotoMilitante = () =>{}