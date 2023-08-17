@extends('layouts.versions.vertical-light') 
{{-- @extends('layouts.versions.vertical-dark')  --}}
{{-- @extends('layouts.versions.horizontal-light')  --}}
{{-- @extends('layouts.versions.horizontal-dark')  --}}

{{-- Jquery --}}
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>


{{-- Select2
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" ></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}

{{-- Selectize --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/js/standalone/selectize.js" integrity="sha512-X6kWCt4NijyqM0ebb3vgEPE8jtUu9OGGXYGJ86bXTm3oH+oJ5+2UBvUw+uz+eEf3DcTTfJT4YQu/7F6MRV+wbA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/css/selectize.bootstrap5.min.css" integrity="sha512-w4sRMMxzHUVAyYk5ozDG+OAyOJqWAA+9sySOBWxiltj63A8co6YMESLeucKwQ5Sv7G4wycDPOmlHxkOhPW7LRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


{{-- DATATABLES --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet"/>
<script type="text/javascript" src="https:////cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>

{{-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> --}}

<script>
    $(document).on('change', '.file-browserinput', function() {
	var input = $(this),
		numFiles = input.get(0).files ? input.get(0).files.length : 1,
		label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	    input.trigger('fileselect', [numFiles, label]);
	});

	// We can watch for our custom `fileselect` event like this
	$(document).ready( function() {
	  $(':file').on('fileselect', function(event, numFiles, label) {

		  var input = $(this).parents('.input-group').find(':text'),
			  log = numFiles > 1 ? numFiles + ' files selected' : label;

		  if( input.length ) {
			  input.val(log);
		  } else {
			  if( log ) alert(log);
		  }

	  });
	});

	$(document).ready( function () {
		// $.noConflict();
    	var table = $('#datatable').DataTable({
			language:{
				"processing": "Procesando...",
				"lengthMenu": "Mostrar _MENU_ registros",
				"zeroRecords": "No se encontraron resultados",
				"emptyTable": "Ningún dato disponible en esta tabla",
				"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
				"infoFiltered": "(filtrado de un total de _MAX_ registros)",
				"search": "Buscar:",
				"infoThousands": ",",
				"loadingRecords": "Cargando...",
				"paginate": {
					"first": "Primero",
					"last": "Último",
					"next": "Siguiente",
					"previous": "Anterior"
				},
				"aria": {
					"sortAscending": ": Activar para ordenar la columna de manera ascendente",
					"sortDescending": ": Activar para ordenar la columna de manera descendente"
				},
				"buttons": {
					"copy": "Copiar",
					"colvis": "Visibilidad",
					"collection": "Colección",
					"colvisRestore": "Restaurar visibilidad",
					"copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
					"copySuccess": {
						"1": "Copiada 1 fila al portapapeles",
						"_": "Copiadas %ds fila al portapapeles"
					},
					"copyTitle": "Copiar al portapapeles",
					"csv": "CSV",
					"excel": "Excel",
					"pageLength": {
						"-1": "Mostrar todas las filas",
						"_": "Mostrar %d filas"
					},
					"pdf": "PDF",
					"print": "Imprimir",
					"renameState": "Cambiar nombre",
					"updateState": "Actualizar",
					"createState": "Crear Estado",
					"removeAllStates": "Remover Estados",
					"removeState": "Remover",
					"savedStates": "Estados Guardados",
					"stateRestore": "Estado %d"
				},
				"autoFill": {
					"cancel": "Cancelar",
					"fill": "Rellene todas las celdas con <i>%d<\/i>",
					"fillHorizontal": "Rellenar celdas horizontalmente",
					"fillVertical": "Rellenar celdas verticalmentemente"
				},
				"decimal": ",",
				"searchBuilder": {
					"add": "Añadir condición",
					"button": {
						"0": "Constructor de búsqueda",
						"_": "Constructor de búsqueda (%d)"
					},
					"clearAll": "Borrar todo",
					"condition": "Condición",
					"conditions": {
						"date": {
							"after": "Despues",
							"before": "Antes",
							"between": "Entre",
							"empty": "Vacío",
							"equals": "Igual a",
							"notBetween": "No entre",
							"notEmpty": "No Vacio",
							"not": "Diferente de"
						},
						"number": {
							"between": "Entre",
							"empty": "Vacio",
							"equals": "Igual a",
							"gt": "Mayor a",
							"gte": "Mayor o igual a",
							"lt": "Menor que",
							"lte": "Menor o igual que",
							"notBetween": "No entre",
							"notEmpty": "No vacío",
							"not": "Diferente de"
						},
						"string": {
							"contains": "Contiene",
							"empty": "Vacío",
							"endsWith": "Termina en",
							"equals": "Igual a",
							"notEmpty": "No Vacio",
							"startsWith": "Empieza con",
							"not": "Diferente de",
							"notContains": "No Contiene",
							"notStartsWith": "No empieza con",
							"notEndsWith": "No termina con"
						},
						"array": {
							"not": "Diferente de",
							"equals": "Igual",
							"empty": "Vacío",
							"contains": "Contiene",
							"notEmpty": "No Vacío",
							"without": "Sin"
						}
					},
					"data": "Data",
					"deleteTitle": "Eliminar regla de filtrado",
					"leftTitle": "Criterios anulados",
					"logicAnd": "Y",
					"logicOr": "O",
					"rightTitle": "Criterios de sangría",
					"title": {
						"0": "Constructor de búsqueda",
						"_": "Constructor de búsqueda (%d)"
					},
					"value": "Valor"
				},
				"searchPanes": {
					"clearMessage": "Borrar todo",
					"collapse": {
						"0": "Paneles de búsqueda",
						"_": "Paneles de búsqueda (%d)"
					},
					"count": "{total}",
					"countFiltered": "{shown} ({total})",
					"emptyPanes": "Sin paneles de búsqueda",
					"loadMessage": "Cargando paneles de búsqueda",
					"title": "Filtros Activos - %d",
					"showMessage": "Mostrar Todo",
					"collapseMessage": "Colapsar Todo"
				},
				"select": {
					"cells": {
						"1": "1 celda seleccionada",
						"_": "%d celdas seleccionadas"
					},
					"columns": {
						"1": "1 columna seleccionada",
						"_": "%d columnas seleccionadas"
					},
					"rows": {
						"1": "1 fila seleccionada",
						"_": "%d filas seleccionadas"
					}
				},
				"thousands": ".",
				"datetime": {
					"previous": "Anterior",
					"next": "Proximo",
					"hours": "Horas",
					"minutes": "Minutos",
					"seconds": "Segundos",
					"unknown": "-",
					"amPm": [
						"AM",
						"PM"
					],
					"months": {
						"0": "Enero",
						"1": "Febrero",
						"10": "Noviembre",
						"11": "Diciembre",
						"2": "Marzo",
						"3": "Abril",
						"4": "Mayo",
						"5": "Junio",
						"6": "Julio",
						"7": "Agosto",
						"8": "Septiembre",
						"9": "Octubre"
					},
					"weekdays": [
						"Dom",
						"Lun",
						"Mar",
						"Mie",
						"Jue",
						"Vie",
						"Sab"
					]
				},
				"editor": {
					"close": "Cerrar",
					"create": {
						"button": "Nuevo",
						"title": "Crear Nuevo Registro",
						"submit": "Crear"
					},
					"edit": {
						"button": "Editar",
						"title": "Editar Registro",
						"submit": "Actualizar"
					},
					"remove": {
						"button": "Eliminar",
						"title": "Eliminar Registro",
						"submit": "Eliminar",
						"confirm": {
							"_": "¿Está seguro que desea eliminar %d filas?",
							"1": "¿Está seguro que desea eliminar 1 fila?"
						}
					},
					"error": {
						"system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
					},
					"multi": {
						"title": "Múltiples Valores",
						"info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
						"restore": "Deshacer Cambios",
						"noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
					}
				},
				"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
				"stateRestore": {
					"creationModal": {
						"button": "Crear",
						"name": "Nombre:",
						"order": "Clasificación",
						"paging": "Paginación",
						"search": "Busqueda",
						"select": "Seleccionar",
						"columns": {
							"search": "Búsqueda de Columna",
							"visible": "Visibilidad de Columna"
						},
						"title": "Crear Nuevo Estado",
						"toggleLabel": "Incluir:"
					},
					"emptyError": "El nombre no puede estar vacio",
					"removeConfirm": "¿Seguro que quiere eliminar este %s?",
					"removeError": "Error al eliminar el registro",
					"removeJoiner": "y",
					"removeSubmit": "Eliminar",
					"renameButton": "Cambiar Nombre",
					"renameLabel": "Nuevo nombre para %s",
					"duplicateError": "Ya existe un Estado con este nombre.",
					"emptyStates": "No hay Estados guardados",
					"removeTitle": "Remover Estado",
					"renameTitle": "Cambiar Nombre Estado"
				}
			 
				// url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json',
				// processing:     "Procesando datos...",
				// search:         "Buscar:",
				// lengthMenu:    "Mostrar _MENU_ elementos",
				// // info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
				// // infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
				// // infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
				// // infoPostFix:    "",
				// loadingRecords: "Procesando datos...",
				// zeroRecords:    "Tabla sin datos",
				// emptyTable:     "Tabla sin datos",
				// paginate: {
				// 	first:      "Primera",
				// 	previous:   "Anterior",
				// 	next:       "Siguiente",
				// 	last:       "Ultima"
				// 	}
			}
		});
		

	} );
	
</script>