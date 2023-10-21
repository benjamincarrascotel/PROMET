<input type="integer" name="activo_id" id="activo_id" value="{{$activo->id}}" hidden>

<!-- Costo de Mantención -->
<div class="row ">
    <label for="costo_mantencion" class="col-sm-2 col-form-label">Costo de mantención: </label>
    <div class="col">
        <input name="costo_mantencion" id='costo_mantencion' type="number" min="0" oninput="validity.valid||(value='');" class="form-control"  required>
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

<!-- Fechas -->
<div class="mb-3 row mt-4">
    <label for="fecha_inicio" class="col-sm-2 col-form-label">Fecha Inicio: </label>
    <div class="col-sm-10">
        <input name="fecha_inicio" id='fecha_inicio' type="date" class="form-control" style="width:20vw" required>
    </div>
</div>
<div class="mb-3 row">
    <label for="fecha_termino" class="col-sm-2 col-form-label">Fecha Termino: </label>
    <div class="col-sm-10">
        <input name="fecha_termino" id='fecha_termino' type="date" class="form-control" style="width:20vw">
    </div>
</div>

<!-- Datos del proveedor -->
<div class="mb-3 row">
    <label for="rut_proveedor" class="col-sm-2 col-form-label">RUT del Proveedor: </label>
    <div class="col-sm-10">
        <input name="rut_proveedor" id='rut_proveedor' type="text" class="form-control"  required>
    </div>
</div>

<div class="mb-3 row">
    <label for="nombre_proveedor" class="col-sm-2 col-form-label">Nombre del Proveedor: </label>
    <div class="col-sm-10">
        <input name="nombre_proveedor" id='nombre_proveedor' type="text" class="form-control"  required>
    </div>
</div>

<div class="mb-3 row">
    <label for="contacto_proveedor" class="col-sm-2 col-form-label">Contacto del Proveedor: </label>
    <div class="col-sm-10">
        <input name="contacto_proveedor" id='contacto_proveedor' type="text" class="form-control"  required>
    </div>
</div>


<!-- Cotización de la mantención -->
<div class="row">
    <label for="cotizacion_mantencion" class="col-sm-2 col-form-label">Cotización de mantención:<br>(Max. 2 MB)</label>
    
    <div class="col-lg-4 col-sm-12">
        <input type="file" class="dropify" id='cotizacion_mantencion' name="cotizacion_mantencion" data-height="180"  />
    </div>
</div>

<div class="row mt-4">
    <div class="col">
        <label class="form-control-label">Observaciones: </label>
        <textarea class="form-control mb-4 " name='observaciones' id="observaciones" placeholder="Observaciones" rows="3" maxlength="249" ></textarea>
    </div>
</div>


<!-- Debo colocar el script dentro de la "section" para que logre acceder al input "foto" -->
<script>
    var uploadField = document.getElementById("foto");
        uploadField.onchange = function() {
            console.log("entra");
            if(this.files[0].size > 2097152){
                alert("Ingresa un archivo de máximo 2 [Mb]");
                this.value = "";
            };
        };
</script>

<script src="{{ asset('dropify/js/dropify.js' )}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.dropify').dropify();
    });
</script>


<!-- INTERNAL File Uploads css-->
<link href="{{asset('assets/plugins/fileupload/css/fileupload.css')}}" rel="stylesheet" type="text/css" />



