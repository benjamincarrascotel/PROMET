<!--Row -->
<div id="wizard2_2">
    <h3>Seleccionar Activo</h3>

    <section>

        <div class="mb-3 row">
            <label for="activo_id" class="col-sm-2 col-form-label">Activos disponibles: <br> (En Bodega)</label>
            <div class="col-sm-10">
                <select id="activo_id" class="form-control block mt-1 w-full" name="activo_id" required>
                    <option value={{null}} >                
                        Seleccione alguna de las opciones                 
                    </option> 
                    @foreach ($activos as $key => $value)              
                        <option value="{{ $value->id }}" {{ ( $key == $selectedID) }}>                
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
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-control-label">Monto: <span class="tx-danger">*</span></label>
                <input type="number" id="monto" name="monto" min="0" class="form-control" required="">
            </div>
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-control-label">Fecha Inicio Arriendo: <span class="tx-danger">*</span></label>
                <input class="form-control" id="fecha_inicio" name="fecha_inicio" placeholder="Ingrese la fecha de inicio" required="" type="date">
            </div>
        </div>

        <div class="row ">
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-control-label">Cliente (Área): <span class="tx-danger">*</span></label>
                    <select id="cliente_area" class="form-control block mt-1 w-full" name="cliente_area" required>
                        <option value={{null}} >                
                            Seleccione alguna de las opciones                 
                        </option>
                        <option>                
                            GERENCIA PROYECTOS MINEROS                 
                        </option>  
                        <option>                
                            GERENCIA PROYECTOS ENTERPRISE                
                        </option>  
                        <option>                
                            GERENCIA OPERACIONES MINERAS
                        </option>  
                        <option>                
                            GERENCIA OPERACIONES ENTERPRISE
                        </option>  
                        <option>                
                            GERENCIA DE LOGÍSTICA               
                        </option>  
                    </select>
            </div>
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-control-label">Fecha Término Arriendo: <span class="tx-danger">*</span></label>
                <input class="form-control" id="fecha_termino" name="fecha_termino" placeholder="Ingrese la fecha de término" required="" type="date">
            </div>
        </div>

        <div class="row ">
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-label">Encargado: <span class="tx-danger">*</span></label>
                <input type="text" id="encargado" name="encargado"  class="form-control" required="">
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