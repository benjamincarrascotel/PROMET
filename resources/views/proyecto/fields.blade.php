<!-- Nombre -->
<div class="mb-3 row">
    <label for="nombre" class="col-sm-2 col-form-label">Nombre del proyecto</label>
    <div class="col-sm-10">
        <input name="nombre" id='nombre' type="text" class="form-control"  required>
    </div>
</div>

<!-- Centro de Costo -->
<div class="mb-3 row">
    <label for="centro_costo" class="col-sm-2 col-form-label">Centro de costo</label>
    <div class="col-sm-10">
        <input name="centro_costo" id='centro_costo' type="text" class="form-control" required>
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



