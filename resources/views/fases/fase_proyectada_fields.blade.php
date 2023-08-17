<!-- Contrato -->
<div class="mb-3 row">
    <label for="contrato_id" class="col-sm-2 col-form-label">Contrato</label>
    <div class="col-sm-10">
        <select id="contrato_id" class="form-control block mt-1 w-full" name="contrato_id" required>
            @if($selectedID == 0)    
                <option value={{null}} >                
                    Seleccione alguna de las opciones                 
                </option>   
            @endif
            @foreach ($contratos as $key => $value)              
                <option value="{{ $value->id }}" {{ ( $key == $selectedID) }}>                
                    {{ $value->servicio_bien->nombre_servicio_bien." - ".$value->contrato_sap }}                 
                </option>
            @endforeach                   
        </select>
    </div>
</div>


<div class="mb-3 row">
    <label for="solicitud_de_base" class="col-sm-2 col-form-label">Solicitud de base</label>
    <div class="col-sm-10">
        <input name="solicitud_de_base" id='solicitud_de_base' type="date" class="form-control" style="width:10vw"  required>
    </div>
</div>

<div class="mb-3 row">
    <label for="envio_bases_primera_revision" class="col-sm-2 col-form-label">Envio bases primera revisión</label>
    <div class="col-sm-10">
        <input name="envio_bases_primera_revision" id='envio_bases_primera_revision' type="date" class="form-control" style="width:10vw"  required>
    </div>
</div>

<div class="mb-3 row">
    <label for="primera_revision_bases_por_abastecimiento" class="col-sm-2 col-form-label">Primera revisión bases por abastecimiento</label>
    <div class="col-sm-10">
        <input name="primera_revision_bases_por_abastecimiento" id='primera_revision_bases_por_abastecimiento' type="date" class="form-control" style="width:10vw"  required>
    </div>
</div>

<div class="mb-3 row">
    <label for="envio_bases_segunda_revision" class="col-sm-2 col-form-label">Envio bases segunda revisión</label>
    <div class="col-sm-10">
        <input name="envio_bases_segunda_revision" id='envio_bases_segunda_revision' type="date" class="form-control" style="width:10vw"  required>
    </div>
</div>

<div class="mb-3 row">
    <label for="segunda_revision_bases_por_abastecimiento" class="col-sm-2 col-form-label">Segunda revisión bases por abastecimiento</label>
    <div class="col-sm-10">
        <input name="segunda_revision_bases_por_abastecimiento" id='segunda_revision_bases_por_abastecimiento' type="date" class="form-control" style="width:10vw"  required>
    </div>
</div>

<div class="mb-3 row">
    <label for="recopilacion_de_informacion" class="col-sm-2 col-form-label">Recopilación de información</label>
    <div class="col-sm-10">
        <input name="recopilacion_de_informacion" id='recopilacion_de_informacion' type="date" class="form-control" style="width:10vw"  required>
    </div>
</div>

<div class="mb-3 row">
    <label for="invitacion_a_oferentes" class="col-sm-2 col-form-label">Invitación a oferentes</label>
    <div class="col-sm-10">
        <input name="invitacion_a_oferentes" id='invitacion_a_oferentes' type="date" class="form-control" style="width:10vw"  required>
    </div>
</div>

<div class="mb-3 row">
    <label for="visita_a_terreno" class="col-sm-2 col-form-label">Visita a terreno</label>
    <div class="col-sm-10">
        <input name="visita_a_terreno" id='visita_a_terreno' type="date" class="form-control" style="width:10vw"  required>
    </div>
</div>

<div class="mb-3 row">
    <label for="preguntas_y_consultas_proponente" class="col-sm-2 col-form-label">Preguntas y consultas proponente</label>
    <div class="col-sm-10">
        <input name="preguntas_y_consultas_proponente" id='preguntas_y_consultas_proponente' type="date" class="form-control" style="width:10vw"  required>
    </div>
</div>

<div class="mb-3 row">
    <label for="respuestas_del_mandante" class="col-sm-2 col-form-label">Respuestas del mandante</label>
    <div class="col-sm-10">
        <input name="respuestas_del_mandante" id='respuestas_del_mandante' type="date" class="form-control" style="width:10vw"  required>
    </div>
</div>

<div class="mb-3 row">
    <label for="recepcion_de_ofertas_tecnicas_economicas" class="col-sm-2 col-form-label">Recepción de ofertas técnicas económicas</label>
    <div class="col-sm-10">
        <input name="recepcion_de_ofertas_tecnicas_economicas" id='recepcion_de_ofertas_tecnicas_economicas' type="date" class="form-control" style="width:10vw"  required>
    </div>
</div>

<div class="mb-3 row">
    <label for="evaluacion_ofertas_tecnicas" class="col-sm-2 col-form-label">Evaluación ofertas técnicas</label>
    <div class="col-sm-10">
        <input name="evaluacion_ofertas_tecnicas" id='evaluacion_ofertas_tecnicas' type="date" class="form-control" style="width:10vw"  required>
    </div>
</div>

<div class="mb-3 row">
    <label for="evaluacion_ofertas_economicas" class="col-sm-2 col-form-label">Evaluación ofertas económicas</label>
    <div class="col-sm-10">
        <input name="evaluacion_ofertas_economicas" id='evaluacion_ofertas_economicas' type="date" class="form-control" style="width:10vw"  required>
    </div>
</div>

<div class="mb-3 row">
    <label for="comite_de_inversiones" class="col-sm-2 col-form-label">Comité de inversiones</label>
    <div class="col-sm-10">
        <input name="comite_de_inversiones" id='comite_de_inversiones' type="date" class="form-control" style="width:10vw"  required>
    </div>
</div>

<div class="mb-3 row">
    <label for="adjudicacion" class="col-sm-2 col-form-label">Adjudicación</label>
    <div class="col-sm-10">
        <input name="adjudicacion" id='adjudicacion' type="date" class="form-control" style="width:10vw"  required>
    </div>
</div>

