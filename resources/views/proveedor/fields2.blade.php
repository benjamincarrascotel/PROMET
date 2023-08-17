<div class="row">
    <div class="col-lg-6 col-md-12">

        <input hidden id="id" name="id" @if($proveedor->id)value="{{$proveedor->id}}"@endif type="text" class="form-control" required>


        <!--TODO setear valor en caso de que exista -->
        <div class="form-group row mb-0">
            <label class="col-md-3 form-label">Sociedad a Facturar o emitir docto.</label>
            <div class="col-md-9">
                <select id="sociedad_a_facturar" name="sociedad_a_facturar" class="form-control select2" required >
                    <option value="{{null}}">Seleccionar opción</option>
                    <option>Compañía Minera Pullalli SpA Rut 78.200.830-7 SAP 1001</option>
                    <option>Compañía Explotadora de Minas SpA Rut 89.274.000-3 SAP 1002</option>
                    <option>Sociedad de Exploración y Desarrollo Minero Rut 79.812.520-6 SAP 1003</option>
                    <option>Minera e Industrial Quimpro Ltda. Rut 79.779.160-1 SAP 1004</option>
                    <option>Insumos Mineros SpA Rut 87.635.600-7 SAP 1005
                    </option>
                    <option>Compañía Minera Falda Verde Rut 81.490.200-5 SAP 1006
                    </option>
                    <option>Compañía Minera El Inglés Rut 89.980.400-7 SAP 1007
                    </option>
                    <option>Minera Pada SpA Rut 76.328.667-3 SAP 1008
                    </option>
                    <option>Sociedad Minera Cerro San Ramón Rut 76.087.584-8 SAP 1009
                    </option>
                    <option>Sociedad Minera Atocha Rut 79.802.600-3 SAP 1010
                    </option>
                    <option>Compañía Minera Hinojal Rut 84.725.100-k SAP 1011
                    </option>
                    <option>Sociedad de Exploración y Desarrollo Minero Oro Andino Ltda. Rut 78.711.440-7 SAP 1012
                    </option>
                    <option>Compañía Minera Catemu Limitada Rut 82.880.800-1 SAP 1013
                    </option>
                    <option>Compañía Minera Resguardo Rut 79.967.200-6 SAP 1015
                    </option>
                    <option>Minera San Esteban S.A. Rut 76.059.419-9 SAP 1016
                    </option>
                    <option>Sociedad Minera Union Particular Rut 76.056.598-9 SAP 1017
                    </option>
                    <option>Compañía Minera Viñita Azul Rut 79.685.950-4 SAP 1018
                    </option>
                    <option>Up Grade Mining S.A Rut 76.209.657-9 SAP 1019
                    </option>
                    <option>Inversiones Aegis Chile S.A. Rut 96.530.430-4 SAP 2000
                    </option>
                    <option>Inversiones Alfalfa SpA Rut 76.427.574-8 SAP 2001
                    </option>
                    <option>Inversiones Asturias SpA Rut 76.275.003-1 SAP 2002
                    </option>
                    <option>Inversiones Las Catalpas S.A. Rut 76.057.806-1 SAP 2003
                    </option>
                    <option>Inversiones El Espino S.A. Rut 76.350.938-9 SAP 2004
                    </option>
                    <option>Fondo de Inversión Privado Rass Rut 76.057.874-6 SAP 2005
                    </option>
                    <option>Fondo de Inversión Privado Lo Fontecilla Rut 76.072.313-4 SAP 2006
                    </option>
                    <option>Inversiones Hierro Viejo Limitada Rut 76.051.930-8 SAP 2007
                    </option>
                    <option>Inversiones Los Paltos SpA Rut 76.379.467-9 SAP 5002
                    </option>
                    <option>Inmobiliaria Batuco Ltda. Rut 99.530.510-0 SAP 3000
                    </option>
                    <option>Inmobiliaria Cemin Sociedad Anónima Rut 76.042.276-2 SAP 3001
                    </option>
                    <option>Inmobiliaria Llanos del Solar Ltda. Rut 76.377.971-8 SAP 3002
                    </option>
                    <option>Gestora Montecarlo Sociedad Anónima Rut 76.057.794-4 SAP 4000
                    </option>
                    <option>Administradora Quillay S.A. Rut 76.349.375-K SAP 4001
                    </option>
                    <option>Agricola Batuco Limitada Rut 89.265.900-1 SAP 5000
                    </option>
                    <option>Agrícola Los Almendros Ltda. Rut 77.678.990-9 SAP 5001
                    </option>
                    <option>Comercial Cimet Chile Spa Rut 77.967.100-3 SAP 9001
                    </option>
                    <option>Mepsa Chile SpA Rut 96.871.960-2 SAP 9002
                    </option>
                    <option>Sudamericana de Fibras Chile S.A. Rut 96.799.000-0 SAP 9004
                    </option>
                    <option>Innovations - Solutions, Services And Tools S.A. Rut 76.126.841-4 SAP 9005
                    </option>
                    <option>Innovations - Solutions, Services And Tools S.A. Rut 76.126.841-4 SAP 9006
                    </option>
                    <option>Predictive Analytics S.A. Rut 76.272.482-0 SAP 9007
                    </option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 form-label">Codigo SAP Sociedad</label>
            <div class="col-md-9">
                <input onkeypress="return false;" id="codigo" name="codigo" type="text" class="form-control" required @if($proveedor->codigo)value="{{$proveedor->codigo}}"@endif>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 form-label">Nombre Solicitante</label>
            <div class="col-md-9">
                <input id="nombre_solicitante" name="nombre_solicitante" type="text" class="form-control" required @if($proveedor->nombre_solicitante)value="{{$proveedor->nombre_solicitante}}"@endif>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 form-label">Cargo</label>
            <div class="col-md-9">
                <input id="cargo_solicitante" name="cargo_solicitante" type="text" class="form-control" required @if($proveedor->cargo_solicitante)value="{{$proveedor->cargo_solicitante}}"@endif>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 form-label">Departamento</label>
            <div class="col-md-9">
                <input id="departamento_solicitante" name="departamento_solicitante" type="text" class="form-control" required @if($proveedor->departamento_solicitante)value="{{$proveedor->departamento_solicitante}}"@endif>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 form-label">Autorizado por <br> (Jefatura del Área)</label>
            <div class="col-md-9">
                <input id="jefatura_solicitante" name="jefatura_solicitante" type="text" class="form-control" required @if($proveedor->jefatura_solicitante)value="{{$proveedor->jefatura_solicitante}}"@endif>
            </div>
        </div>


    </div>
    <div class="col-lg-6 col-md-12">
        <div class="form-group row mb-0">
            <label class="col-md-3 form-label">Condiciones de Pago</label>
            <div class="col-md-9">
                <select id="condiciones_pago" name="condiciones_pago" class="form-control select2" required>
                    <option value="{{null}}">Seleccionar opción</option>
                    <option @if($proveedor->condiciones_pago == "15 DIAS") selected @endif>15 DIAS</option>
                    <option @if($proveedor->condiciones_pago == "30 DIAS") selected @endif>30 DIAS</option>
                    <option @if($proveedor->condiciones_pago == "CONTADO") selected @endif>CONTADO</option>

                </select>
            </div>
        </div>
        <div class="form-group row mb-0 mt-2">
            <label class="col-md-3 form-label">Tipo de Documento</label>
            <div class="col-md-9">
                <select id="tipo_documento" name="tipo_documento" class="form-control select2" required>
                    <option value="{{null}}">Seleccionar opción</option>
                    <option @if($proveedor->tipo_documento == "FACTURA") selected @endif>FACTURA</option>
                    <option @if($proveedor->tipo_documento == "BOLETA") selected @endif>BOLETA</option>
                    <option @if($proveedor->tipo_documento == "OTRO") selected @endif>OTRO</option>
                </select>
            </div>
        </div>
        
    </div>

    <div class="mb-3 mt-4">
        <label for="descripcion">Descripción de la compra o el servicio </label>
        <div >
            <textarea class="form-control mb-4 " name='descripcion' id="descripcion" placeholder="Descripción de la compra o servicio" required rows="3" maxlength="249" @if($proveedor->descripcion)value="{{$proveedor->descripcion}}"@endif>{{$proveedor->descripcion}}</textarea>
    
        </div>
    </div>

    <h4 style="color:red;">Para las fechas considerar formato internacional [MES/DIA/AÑO].</h4>

    <div class="form-group row">
        <label class="col-md-2 form-label">Fecha de solicitud</label>
        <div >
            <input id="fecha_solicitud" name="fecha_solicitud" type="date" class="form-control" style="width: 15%"  required @if($proveedor->fecha_solicitud)value="{{$proveedor->fecha_solicitud}}"@endif>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-2 form-label">Creación</label>
        <div >
            <input disabled type="text" class="form-control" style="width: 15%" value="{{Carbon\Carbon::parse($proveedor->created_at)->format('m-d-Y H:i:s')}}">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-2 form-label">Modificación</label>
        <div >
            <input disabled type="text" class="form-control" style="width: 15%"  value="{{Carbon\Carbon::parse($proveedor->updated_at)->format('m-d-Y H:i:s')}}">
        </div>
    </div>

</div>

<script type="text/javascript">

    $(document).ready(function(){
        $('#sociedad_a_facturar').on('change', function () {
            const seleccion = $('#sociedad_a_facturar').val();
            var valores = seleccion.split("SAP").map(function(item) {
                return item.trim();
            });
            
            codigo_campo = document.getElementById("codigo");
            codigo_campo.value = valores[1];

        });

        var selected = {!! json_encode($proveedor->sociedad_a_facturar) !!};
        console.log(selected);
        const $select = document.querySelector('#sociedad_a_facturar');
        $select.value = selected;
    });
</script>