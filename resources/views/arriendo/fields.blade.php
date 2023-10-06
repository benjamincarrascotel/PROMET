<!--Row -->
<div id="wizard2_2">
    <h3>Seleccionar Activo</h3>

    <section>

        <div class="mb-3 row">
            <label for="activo_id" class="col-sm-2 col-form-label">Activos disponibles: <br> (En Bodega)</label>
            <div class="col-sm-10">
                <select id="activo_id" class="form-control block mt-1 w-full" name="activo_id" required>
                    <option value={{null}}>Seleccione alguna de las opciones</option>
                    @foreach ($activos as $value)
                        <option value="{{ $value->id }}" {{ $value->id == $selectedID ? 'selected' : '' }}>
                            {{ "ID: ".$value->id." - "."Código Interno: ".$value->codigo_interno." - "."Marca: ".$value->marca." - "."Modelo: ".$value->modelo." - Ubicación: BODEGA" }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        

    </section>

    <h3>Datos de Arriendo</h3>

    <section>
        <div class="row ">
            <div class="col">
                <label class="form-control-label">Monto Mensual: <span class="tx-danger">*</span></label>
                <input type="number" id="monto" name="monto" min="0" class="form-control" required="">
            </div>
            <div class="col">
                <label class="form-control-label">Tipo de moneda: </label>
                <div class="dropdown">
                    <select class="form-control " id="tipo_moneda" name="tipo_moneda" required value="{{ old('tipo_moneda') }}">
                        <option value="CLP">CLP</option>
                        <option value="UF">UF</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Datos del cliente -->

        <div class="row mt-4">
            <div class="col">
                <label class="form-control-label">Empresa: <span class="tx-danger">*</span></label>
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
                <label for="proyecto_id" class="form-control-label">Proyecto: <span class="tx-danger">*</span></label>
                <select id="proyecto_id" class="form-control block mt-1 w-full" name="proyecto_id" required>
                    <option value={{null}}>Seleccione alguno de los proyectos</option>
                </select>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <label class="form-control-label">Fecha Inicio Arriendo: <span class="tx-danger">*</span></label>
                <input class="form-control" id="fecha_inicio" name="fecha_inicio" placeholder="Ingrese la fecha de inicio" required="" type="date">
            </div>
            
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-control-label">Fecha Término Arriendo: <span class="tx-danger">*</span></label>
                <input class="form-control" id="fecha_termino" name="fecha_termino" placeholder="Ingrese la fecha de término" required="" type="date">
            </div>

            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-label">Encargado: <span class="tx-danger">*</span></label>
                <input type="text" id="encargado" name="encargado"  class="form-control" required="">
            </div>
        </div>


        

        

    </section>


</div>

<!--/Row-->


@section('scripts')
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