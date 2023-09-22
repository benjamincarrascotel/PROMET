<!-- Costo de Venta -->

<input type="integer" name="activo_id" id="activo_id" value="{{$activo->id}}" hidden>

<div class="mb-3 row">
    <label for="precio_venta" class="col-sm-2 col-form-label">Precio de venta</label>
    <div class="col-sm-10">
        <input name="precio_venta" id='precio_venta' type="number" min="0" oninput="validity.valid||(value='');" class="form-control"  required>
    </div>
</div>

<!-- Fecha -->
<div class="mb-3 row">
    <label for="fecha_venta" class="col-sm-2 col-form-label">Fecha de venta</label>
    <div class="col-sm-10">
        <input name="fecha_venta" id='fecha_venta' type="date" class="form-control" style="width:20vw" required>
    </div>
</div>

<!-- Datos del cliente -->

<div class="mb-3 row">
    <label for="proyecto_id" class="col-sm-2 col-form-label">Proyecto</label>
    <div class="col-sm-10">
        <select id="proyecto_id" class="form-control block mt-1 w-full" name="proyecto_id" required>
            <option value={{null}}>Seleccione alguna de las opciones</option>
            @foreach ($proyectos as $value)
                <option value="{{ $value->id }}" {{ $value->id == $selectedID ? 'selected' : '' }}>
                    {{ "Nombre: ".$value->nombre." - "."RUT: ".$value->rut." - "."Empresa: ".$value->empresa." - "."Centro de Costos: ".$value->centro_costo}}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="mb-3 row">
    <label for="contacto_cliente" class="col-sm-2 col-form-label">Contacto del Cliente</label>
    <div class="col-sm-10">
        <input name="contacto_cliente" id='contacto_cliente' type="text" class="form-control"  required>
    </div>
</div>


<!-- Cotización de la venta -->
<div class="row">
    <label for="cotizacion_venta" class="col-sm-2 col-form-label">Cotización de venta:<br>(Max. 2 MB)</label>
    
    <div class="col-lg-4 col-sm-12">
        <input type="file" class="dropify" id='cotizacion_venta' name="cotizacion_venta" data-height="180"  />
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



