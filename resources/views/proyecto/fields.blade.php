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

<!-- TIPO DE OBJETO DE IMPUTACIÓN -->
<div class="mb-3 row">
    <label for="objeto_imputacion" class="col-sm-2 col-form-label">Tipo de objeto de imputación: </label>
    <div class="col-sm-10">
        <input name="objeto_imputacion" id='objeto_imputacion' type="text" class="form-control"  required>
    </div>
</div>

<!-- Área -->
<div class="mb-3 row">
    <label for="area" class="col-sm-2 col-form-label">Área: </label>
    <div class="col-sm-10">
        <input name="area" id='area' type="text" class="form-control"  required>
    </div>
</div>

<!-- Sociedad SAP -->
<div class="mb-3 row">
    <label for="sociedad_sap" class="col-sm-2 col-form-label">Sociedad SAP: </label>
    <div class="col-sm-10">
        <input name="sociedad_sap" id='sociedad_sap' type="text" class="form-control"  required>
    </div>
</div>

<!-- Código SAP -->
<div class="mb-3 row">
    <label for="codigo_sap" class="col-sm-2 col-form-label">Código SAP: </label>
    <div class="col-sm-10">
        <input name="codigo_sap" id='codigo_sap' type="text" class="form-control"  required>
    </div>
</div>

<!-- Nombre SAP -->
<div class="mb-3 row">
    <label for="nombre_sap" class="col-sm-2 col-form-label">Nombre SAP: </label>
    <div class="col-sm-10">
        <input name="nombre_sap" id='nombre_sap' type="text" class="form-control"  required>
    </div>
</div>

<!-- Centro de Costo -->
<div class="mb-3 row">
    <label for="centro_costo" class="col-sm-2 col-form-label">Centro de costo: </label>
    <div class="col-sm-10">
        <input name="centro_costo" id='centro_costo' type="text" class="form-control" required>
    </div>
</div>



