<!--Row -->
<div id="wizard2">
    <h3>Datos Generales</h3>

    <section>
        <div class="row ">
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-control-label">Marca: <span class="tx-danger">*</span></label>
                <input class="form-control" id="marca" name="marca" placeholder="Ingrese la marca del activo" required="" type="text">
            </div>
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-control-label">Modelo: <span class="tx-danger">*</span></label>
                <input class="form-control" id="modelo" name="modelo" placeholder="Ingrese el modelo del activo" required="" type="text">
            </div>
        </div>

        <div class="row ">
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-label">Año: <span class="tx-danger">*</span></label>
                <input type="number" id="año" name="año" min="1950" max="2023" class="form-control" required="">
            </div>
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-control-label">Clasificación: <span class="tx-danger">*</span></label>
                <input class="form-control" id="clasificacion" name="clasificacion" placeholder="Ingrese el modelo del activo" required="" type="text">
            </div>
        </div>

        <div class="row ">
            <div class="col-md-5 col-lg-4 mb-4">
                <label class="form-label">Código Interno: <span class="tx-danger">*</span></label>
                <input type="text" id="codigo_interno" name="codigo_interno" placeholder="Ingrese el código interno del activo" class="form-control" required="">
            </div>
            <div class="col-md-5 col-lg-4 mg-t-20 mg-md-t-0">
                <label class="form-control-label">Número de serie: </label>
                <input class="form-control" id="numero_serie" name="numero_serie" placeholder="Ingrese el número de serie del activo" type="text">
            </div>
            <div class="col-md-5 col-lg-4 mg-t-20 mg-md-t-0">
                <label class="form-label">Horas de uso promedio: <span class="tx-danger">*</span></label>
                <input type="number" id="horas_uso_promedio" name="horas_uso_promedio" min="0" class="form-control" required="">
            </div>
        </div>
    </section>

    <h3>Financiero</h3>

    <section>
        <div class="row ">
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-control-label">Precio de compra: <span class="tx-danger">*</span></label>
                <input type="number" id="precio_compra" name="precio_compra" min="0" class="form-control" required="">
            </div>
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-control-label">Orden de compra: <span class="tx-danger">*</span></label>
                <input class="form-control" id="orden_de_compra" name="orden_compra" placeholder="Ingrese la orden de compra del activo" required="" type="text">
            </div>
        </div>

        <div class="row ">
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-label">Vida útil (Meses): <span class="tx-danger">*</span></label>
                <input type="number" id="vida_util" name="vida_util" min="0" class="form-control" required="">
            </div>
            <div class="col-md-6 col-lg-6 mb-4">
                <label class="form-label">Valor residual (%): <span class="tx-danger">*</span></label>
                <input type="number" id="valor_residual" name="valor_residual" min="0" max="100" class="form-control" required="">
            </div>
        </div>
    </section>


</div>

<!--/Row-->


@section('scripts')

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