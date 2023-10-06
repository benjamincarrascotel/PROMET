<!-- Arriendo ID -->
<input hidden name="arriendo_id" id='arriendo_id' type="number" class="form-control" value="{{$arriendo->id}}"  required>

<!-- Proyecto anterior id -->
<div class="mb-3 row">
    <label for="proyecto_anterior_id" class="col-sm-2 col-form-label">Proyecto anterior: </label>
    <div class="col-sm-10">
        <input hidden name="proyecto_anterior_id" id='proyecto_anterior_id' type="number" class="form-control" value="{{$arriendo->proyecto_id}}"  required>
        <input disabled name="proyecto" id='proyecto' type="text" class="form-control" value="{{ "[ ".$arriendo->proyecto->codigo_sap." ] ".$arriendo->proyecto->nombre_sap." - "."Empresa: ".$arriendo->proyecto->empresa->nombre." - "."RUT: ".$arriendo->proyecto->empresa->rut}}"  required>
    </div>
</div>


<!-- Proyecto actual id -->
<div class="mb-3 row">
    <label for="proyecto_actual_id" class="col-sm-2 col-form-label">Nuevo proyecto: </label>
    <div class="col-sm-10">

        <select id="empresa_id" class="form-control block mt-1 w-full" name="empresa_id" required>
            <option value={{null}}>Seleccione la empresa</option>
            @foreach ($empresas as $value)
                <option value="{{ $value->id }}" {{ $value->id == $selectedID ? 'selected' : '' }}>
                    {{ "Empresa: ".$value->nombre." - "."RUT: ".$value->rut." - "."Giro: ".$value->giro}}
                </option>
            @endforeach
        </select>


        <select id="proyecto_actual_id" class="form-control block mt-1 w-full" name="proyecto_actual_id" required>
            <option value={{null}}>Seleccione alguno de los proyectos</option>
        </select>
    </div>
</div>

<!-- Datos nuevos -->
<div class="row ">
    <label for="monto" class="col-sm-2 col-form-label">Nuevo Monto Mensual: </label>
    <div class="col">
        <input name="monto" id='monto' type="number" min="0" oninput="validity.valid||(value='');" class="form-control"  required>
    </div>
    <div class="col">
        <div class="dropdown">
            <select class="form-control " id="tipo_moneda" name="tipo_moneda" required>
                <option value="CLP">CLP</option>
                <option value="UF">UF</option>
            </select>
        </div>
    </div>
</div>


<!-- Fecha traspaso -->
<div class="mt-4 row">
    <label for="fecha_traspaso" class="col-sm-2 col-form-label">Fecha de traspaso: </label>
    <div class="col-sm-10">
        <input name="fecha_traspaso" id='fecha_traspaso' type="date" class="form-control" required>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var empresaSelect = document.getElementById("empresa_id");
        var proyectoSelect = document.getElementById("proyecto_actual_id");
        var proyectos = {!! $proyectos->toJson() !!}; // Convierte la colección de sub_familias a un array JavaScript
        
        // Función para actualizar las opciones del input de sub_familias
        function actualizarProyectos() {
            var selectedEmpresaId = empresaSelect.value;

            // Limpiar las opciones actuales
            proyectoSelect.innerHTML = '';

            // Agregar la opción predeterminada
            var defaultOption = document.createElement("option");
            defaultOption.value = null;
            defaultOption.text = "Seleccione alguno de los proyectos";
            proyectoSelect.appendChild(defaultOption);

            // Agregar las sub_familias correspondientes a la familia seleccionada
            proyectos[selectedEmpresaId].forEach(function (proyecto) {
                var option = document.createElement("option");
                option.value = proyecto.id;
                option.text = "[ "+proyecto.codigo_sap+" ] "+proyecto.nombre_sap;
                proyectoSelect.appendChild(option);
            });
        }

        // Asignar el evento change al input de familias
        empresaSelect.addEventListener("change", function () {
            actualizarProyectos();
        });

    });
</script>



