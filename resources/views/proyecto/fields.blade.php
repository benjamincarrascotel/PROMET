<!-- Nombre -->
<div class="mb-3 row">
    <label for="nombre" class="col-sm-2 col-form-label">Nombre del proyecto: </label>
    <div class="col-sm-10">
        <input name="nombre" id='nombre' type="text" class="form-control"  required>
    </div>
</div>

<!-- Empresa id -->
<div class="mb-3 row">
    <label for="empresa_id" class="col-sm-2 col-form-label">Empresa: </label>
    <div class="col-sm-10">
        <select id="empresa_id" class="form-control block mt-1 w-full" name="empresa_id" required>
            <option value={{null}}>Seleccione alguna de las opciones</option>
            @foreach ($empresas as $value)
                <option value="{{ $value->id }}">
                    {{ "Nombre: ".$value->nombre." - "."RUT: ".$value->rut." - "."Giro: ".$value->giro}}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- Centro de Costo -->
<div class="mb-3 row">
    <label for="centro_costo" class="col-sm-2 col-form-label">Centro de costo: </label>
    <div class="col-sm-10">
        <input name="centro_costo" id='centro_costo' type="text" class="form-control" required>
    </div>
</div>



