<!-- Costo de Venta -->

<input type="integer" name="activo_id" id="activo_id" value="{{$activo->id}}" hidden>

<!-- Precio venta -->
<div class="mb-3 row">
    <label for="precio_venta" class="col-sm-2 col-form-label">Precio de venta: <span class="tx-danger">*</span></label>
    <div class="col">
        <input name="precio_venta" id='precio_venta' type="number" min="0" oninput="validity.valid||(value='');" class="form-control" value="{{ old('precio_venta')}}" required>
    </div>
    <div class="col">
        <div class="dropdown">
            <select class="form-control " id="tipo_moneda" name="tipo_moneda" required value="{{ old('tipo_moneda') }}">
                <option value="CLP">CLP</option>
                <option value="UF">UF</option>
                <option value="USD">USD</option>
            </select>
        </div>
    </div>
</div>

<!-- Datos del cliente -->

<div class="mb-3 row">
    <label for="empresa" class="col-sm-2 col-form-label">Proyecto: <span class="tx-danger">*</span></label>
    <div class="col">
        <select id="empresa" class="form-control block mt-1 w-full" name="empresa" required>
            <option value={{null}}>Seleccione la empresa</option>
            @foreach ($empresas as $value)
                <option value="{{ $value->id }}" {{ $value->id == $selectedID ? 'selected' : '' }}>
                    {{ "Nombre: ".$value->nombre." - "."RUT: ".$value->rut}}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col">
        <select id="proyecto_id" class="form-control block mt-1 w-full" name="proyecto_id" required>
            <option value={{null}}>Seleccione alguno de los proyectos</option>
        </select>
    </div>
</div>

<!-- Fecha inicio -->
<div class="mb-3 row">
    <label for="fecha_inicio" class="col-sm-2 col-form-label">Fecha de Inicio Venta: <span class="tx-danger">*</span></label>
    <div class="col-sm-10">
        <input name="fecha_inicio" id='fecha_inicio' type="date" class="form-control" style="width:20vw" value="{{ old('fecha_inicio') }}" required>
    </div>
</div>

<!-- Fecha termino -->
<div class="mb-3 row">
    <label for="fecha_termino" class="col-sm-2 col-form-label">Fecha de Término Venta: </label>
    <div class="col-sm-10">
        <input name="fecha_termino" id='fecha_termino' type="date" class="form-control" style="width:20vw" value="{{ old('fecha_termino') }}">
    </div>
</div>

<div class="mb-3 row">
    <label for="encargado" class="col-sm-2 col-form-label">Encargado: <span class="tx-danger">*</span></label>
    <div class="col-sm-10">
        <input name="encargado" id='encargado' type="text" class="form-control" value="{{ old('encargado') }}" required>
    </div>
</div>

<div class="mb-3 row">
    <label class="form-control-label">Observaciones: </label>
    <textarea class="form-control mb-4 " name='observaciones' id="observaciones" placeholder="Observaciones" rows="3" maxlength="249">{{ old('observaciones') }}</textarea>
</div>

<script type="text/javascript">

    document.addEventListener("DOMContentLoaded", function () {
        var empresaSelect = document.getElementById("empresa");
        var proyectoSelect = document.getElementById("proyecto_id");
        var proyectos = {!! $proyectos->toJson() !!}; // Convierte la colección de sub_familias a un array JavaScript
        
        // Función para actualizar las opciones del input de sub_familias
        function actualizarProyectos() {
            var selectedEmpresaId = empresaSelect.value;

            // Limpiar las opciones actuales
            proyectoSelect.innerHTML = '';

            // Agregar la opción predeterminada
            var defaultOption = document.createElement("option");
            defaultOption.value = "";
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



<!-- INTERNAL File Uploads css-->
<link href="{{asset('assets/plugins/fileupload/css/fileupload.css')}}" rel="stylesheet" type="text/css" />



