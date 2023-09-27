<!-- Arriendo ID -->
<input hidden name="arriendo_id" id='arriendo_id' type="number" class="form-control" value="{{$arriendo->id}}"  required>

<!-- Proyecto anterior id -->
<div class="mb-3 row">
    <label for="proyecto_anterior_id" class="col-sm-2 col-form-label">Proyecto anterior: </label>
    <div class="col-sm-10">
        <input hidden name="proyecto_anterior_id" id='proyecto_anterior_id' type="number" class="form-control" value="{{$arriendo->proyecto_id}}"  required>
        <input disabled name="proyecto" id='proyecto' type="text" class="form-control" value="{{"Nombre: ".$arriendo->proyecto->nombre." - "."RUT: ".$arriendo->proyecto->rut." - "."Empresa: ".$arriendo->proyecto->empresa." - "."Centro de Costos: ".$arriendo->proyecto->centro_costo}}"  required>
    </div>
</div>

<!-- Proyecto actual id -->
<div class="mb-3 row">
    <label for="proyecto_actual_id" class="col-sm-2 col-form-label">Nuevo proyecto: </label>
    <div class="col-sm-10">
        <select id="proyecto_actual_id" class="form-control block mt-1 w-full" name="proyecto_actual_id" required>
            <option value={{null}}>Seleccione alguna de las opciones</option>
            @foreach ($proyectos as $value)
                <option value="{{ $value->id }}">
                    {{ "Nombre: ".$value->nombre." - "."RUT: ".$value->rut." - "."Empresa: ".$value->empresa." - "."Centro de Costos: ".$value->centro_costo}}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- Datos nuevos -->
<div class="row ">
    <label for="monto" class="col-sm-2 col-form-label">Nuevo Monto Mensual: </label>
    <div class="col">
        <input name="monto" id='monto' type="number" min="0" oninput="validity.valid||(value='');" class="form-control"  required>
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


<!-- Fecha traspaso -->
<div class="mt-4 row">
    <label for="fecha_traspaso" class="col-sm-2 col-form-label">Fecha de traspaso: </label>
    <div class="col-sm-10">
        <input name="fecha_traspaso" id='fecha_traspaso' type="date" class="form-control" required>
    </div>
</div>



