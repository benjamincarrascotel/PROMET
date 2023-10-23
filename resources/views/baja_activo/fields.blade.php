<!-- Costo de Venta -->

<input type="integer" name="activo_id" id="activo_id" value="{{$activo->id}}" hidden>

<div class="mb-3 row">
    <label for="precio_venta" class="col-sm-2 col-form-label">Proyecto: </label>
    <div class="col">
        <select id="empresa" class="form-control block mt-1 w-full" name="empresa">
            <option value={{null}}>Seleccione la empresa</option>
            @foreach ($empresas as $value)
                <option value="{{ $value->id }}">
                    {{ "Nombre: ".$value->nombre." - "."RUT: ".$value->rut}}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col">
        <select id="proyecto_id" class="form-control block mt-1 w-full" name="proyecto_id">
            <option value={{null}}>Seleccione alguno de los proyectos</option>
        </select>
    </div>
</div>

<!-- Fecha inicio -->
<div class="mb-3 row">
    <label for="fecha" class="col-sm-2 col-form-label">Fecha: <span class="tx-danger">*</span></label>
    <div class="col-sm-10">
        <input name="fecha" id='fecha' type="date" class="form-control" style="width:20vw" required>
    </div>
</div>

<div class="mb-3 row">
    <label for="encargado" class="col-sm-2 col-form-label">Encargado: <span class="tx-danger">*</span></label>
    <div class="col-sm-10">
        <input name="encargado" id='encargado' type="text" class="form-control"  required>
    </div>
</div>

<div class="mb-3 row">
    <label class="form-control-label">Observaciones: </label>
    <textarea class="form-control mb-4 " name='observaciones' id="observaciones" placeholder="Observaciones" rows="3" maxlength="249" ></textarea>
</div>

<div class="mb-3 row">
    <label for="archivo" class="col-sm-2 col-form-label">Archivos:<br>(Fotografías, documentos u otros)<br>(Max. 2 MB)</label>
    <div class="col">
        <input type="file" class="dropify" id='archivo1' name="archivo" data-height="180"  />
    </div>
    <div class="col">
        <input type="file" class="dropify" id="archivo2" name="archivo2"   />
    </div>
    <div class="col">
        <input type="file" class="dropify" id="archivo3" name="archivo3"   />
    </div>
        
</div>

<script src="{{ asset('dropify/js/dropify.js' )}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.dropify').dropify();
    });
</script>

<script>
    var uploadField = document.getElementById("archivo");
        uploadField.onchange = function() {
            if(this.files[0].size > 2097152){
                alert("Ingresa un archivo de máximo 2 [Mb]");
                this.value = "";
            };
        };
</script>

<script>
    var uploadField = document.getElementById("archivo2");
        uploadField.onchange = function() {
            if(this.files[0].size > 2097152){
                alert("Ingresa un archivo de máximo 2 [Mb]");
                this.value = "";
            };
        };
</script>

<script>
    var uploadField = document.getElementById("archivo3");
        uploadField.onchange = function() {
            if(this.files[0].size > 2097152){
                alert("Ingresa un archivo de máximo 2 [Mb]");
                this.value = "";
            };
        };
</script>

<!-- INTERNAL File Uploads css-->
<link href="{{asset('assets/plugins/fileupload/css/fileupload.css')}}" rel="stylesheet" type="text/css" />

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
            defaultOption.value = {{!! null !!}};
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



