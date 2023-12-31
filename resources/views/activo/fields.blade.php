<!--Row -->
<div id="wizard2">
    <h3>Datos Generales</h3>

    <section>
        <div class="row ">
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-control-label">Marca: <span class="tx-danger">*</span></label>
                <input class="form-control" id="marca" name="marca" placeholder="Ingrese la marca del activo" required="" type="text" value="{{ old('marca') }}">
            </div>
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-control-label">Modelo: <span class="tx-danger">*</span></label>
                <input class="form-control" id="modelo" name="modelo" placeholder="Ingrese el modelo del activo" required="" type="text" value="{{ old('modelo') }}">
            </div>
        </div>

        <div class="row ">
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-label">Año: <span class="tx-danger">*</span></label>
                <input type="number" id="año" name="año" min="1950" max="2023" class="form-control" required="" value="{{ old('año') }}">
            </div>
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-control-label">Clasificación: <span class="tx-danger">*</span></label>
                <input class="form-control" id="clasificacion" name="clasificacion" placeholder="Ingrese el modelo del activo" required="" type="text" value="{{ old('clasificacion') }}">
            </div>
        </div>

        <div class="row ">
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-control-label">Código Interno: <span class="tx-danger">*</span></label>
                <input type="text" id="codigo_interno" name="codigo_interno" placeholder="Ingrese el código interno del activo" class="form-control" required="" value="{{ old('codigo_interno') }}">
            </div>
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-control-label">Número de serie: <span class="tx-danger">*</span> </label>
                <input required="" class="form-control" id="numero_serie" name="numero_serie" placeholder="Ingrese el número de serie del activo" type="text" value="{{ old('numero_serie') }}">
            </div>
        </div>

        <div class="row ">
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-label">Horas de uso promedio: <span class="tx-danger">*</span></label>
                <input type="number" id="horas_uso_promedio" name="horas_uso_promedio" min="0" class="form-control" required="" value="{{ old('horas_uso_promedio') }}">
            </div>
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-control-label">Tiempo de uso (Meses): </label>
                <input class="form-control" id="tiempo_uso_meses" name="tiempo_uso_meses" placeholder="Ingrese el modelo del activo" min="0" type="number" value="{{ old('tiempo_uso_meses') }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-6 mb-4">
                <label for="familia_id" class="form-label">Familia de Productos: <span class="tx-danger">*</span></label>
                <select id="familia_id" class="form-control block mt-1 w-full" name="familia_id" required>
                    <option value={{null}}>Seleccione alguna de las opciones</option>
                    @foreach ($familias as $value)
                        <option value="{{ $value->id }}" {{ $value->id == $selectedID ? 'selected' : '' }}>
                            {{ "[ ".$value->id." ] - ".$value->acronimo." - ".$value->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        
            <div class="col-md-6 col-lg-6 mb-4">
                <label for="sub_familia_id" class="form-label">Sub Familia de Productos: <span class="tx-danger">*</span></label>
                <select id="sub_familia_id" class="form-control block mt-1 w-full" name="sub_familia_id" required>
                    <option value={{null}} selected >Seleccione alguna de las opciones</option>
                </select>
            </div>
        </div>

        <div class="row">
            <label for="foto" class="col-sm-2 col-form-label">Imagen:<br>(Max. 2 MB)</label>
            
                <div class="col-lg-4 col-sm-12">
                    <input type="file" class="dropify" id='foto' name="foto" data-height="180" />
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

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var familiaSelect = document.getElementById("familia_id");
                var subFamiliaSelect = document.getElementById("sub_familia_id");
                var subFamilias = {!! $sub_familias->toJson() !!}; // Convierte la colección de sub_familias a un array JavaScript
                
                // Función para actualizar las opciones del input de sub_familias
                function actualizarSubFamilias() {
                    var selectedFamiliaId = familiaSelect.value;

                    // Limpiar las opciones actuales
                    subFamiliaSelect.innerHTML = '';

                    // Agregar la opción predeterminada
                    var defaultOption = document.createElement("option");
                    defaultOption.value = null;
                    defaultOption.text = "Seleccione alguna de las opciones";
                    subFamiliaSelect.appendChild(defaultOption);

                    // Agregar las sub_familias correspondientes a la familia seleccionada
                    subFamilias[selectedFamiliaId].forEach(function (subFamilia) {
                        var option = document.createElement("option");
                        option.value = subFamilia.id;
                        option.text = "[ "+subFamilia.id+" ] - "+subFamilia.acronimo+" - "+subFamilia.nombre ;
                        subFamiliaSelect.appendChild(option);
                    });
                }

                // Asignar el evento change al input de familias
                familiaSelect.addEventListener("change", function () {
                    actualizarSubFamilias();
                });

            });
        </script>


        

    </section>

    <h3>Financiero</h3>

    <section>
        <div class="row ">
            <div class="col">
                <label class="form-control-label">Precio de compra: <span class="tx-danger">*</span></label>
                <input name="precio_compra" id='precio_compra' type="number" min="0" step="any" class="form-control" required value="{{ old('precio_compra') }}">
            </div>
            <div class="col">
                <label class="form-control-label">Tipo de moneda: </label>
                <div class="dropdown">
                    <select class="form-control " id="tipo_moneda" name="tipo_moneda" required value="{{ old('tipo_moneda') }}">
                        <option value="CLP">CLP</option>
                        <option value="UF">UF</option>
                        <option value="USD">USD</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <label class="form-control-label">Orden de compra: <span class="tx-danger">*</span></label>
                <input class="form-control" id="orden_de_compra" name="orden_compra" placeholder="Ingrese la orden de compra del activo" required="" type="text" value="{{ old('orden_compra') }}">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-control-label">Vida útil (Meses): <span class="tx-danger">*</span></label>
                <input type="number" id="vida_util" name="vida_util" min="0" class="form-control" required="" value="{{ old('vida_util') }}">
            </div>
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-control-label">Valor residual (%): </label>
                <input type="number" id="valor_residual" name="valor_residual" min="0" max="100" class="form-control" value="{{ old('valor_residual') }}">
            </div>
        </div>

        <div class="row ">
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-control-label">Centro de Costos: <span class="tx-danger">*</span></label>
                <input type="text" id="centro_costos" name="centro_costos" placeholder="Ingrese el centro de costos" class="form-control" required="" value="{{ old('centro_costos') }}">
            </div>
        </div>
        

        <div class="row">
            <label for="archivo" class="col-sm-2 col-form-label">Archivos:<br>(OC, Guía de Despacho u otros)<br>(Max. 2 MB)</label>
            <div class="col">
                <input type="file" class="dropify" id='archivo' name="archivo" data-height="180"  />
            </div>
            <div class="col">
                <input type="file" class="dropify" id="archivo2" name="archivo2"   />
            </div>
            <div class="col">
                <input type="file" class="dropify" id="archivo3" name="archivo3"   />
            </div>
                
        </div>

    </section>


</div>

<!--/Row-->


@section('scripts')

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


    <script>
        window.onload = function() {
            var botonEnlace = document.querySelector('a[href="#finish"]');
            var botonSubmit = document.getElementById('botonSubmit');

            botonEnlace.addEventListener('click', function(event) {
                event.preventDefault(); // Evitar que el enlace realice su comportamiento predeterminado
                botonSubmit.click(); // Simular un clic en el botón de tipo submit
            });
        };
    </script>

    

    <!-- INTERNAl Jquery.steps js -->
    <script src="{{asset('assets/plugins/jquery-steps/jquery.steps.min.js')}}"></script>
    <script src="{{asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>

    <!-- INTERNAl Forn-wizard js-->
    <script src="{{asset('assets/plugins/formwizard/jquery.smartWizard.js')}}"></script>
    <script src="{{asset('assets/plugins/formwizard/fromwizard.js')}}"></script>

    <!-- INTERNAl Accordion-Wizard-Form js-->
    <script src="{{asset('assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js')}}"></script>
    <script src="{{asset('assets/js/form-wizard.js')}}"></script>
    <script src="{{asset('assets/js/form-wizard2.js')}}"></script>

@endsection