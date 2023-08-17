<!-- Tipo de Contrato General -->
<div class="mb-3 row">

    @if($fase_actual != 15 && $fase_actual != 16 && $fase_actual != 17)

        <label for="siguiente_fase_id" class="col-sm-2 col-form-label">Siguiente Fase: </label>
        <div class="col-sm-4">
            <select class="form-control block mt-1 w-full" name="siguiente_fase_id" id="siguiente_fase_id" > 
                @switch($fase_actual)
                    @case("0")
                        <option value="1" >                
                            SOLICITUD DE BASE                
                        </option>
                        @break
                    @case("1")
                        <option value="2" >                
                            ENVIO BASES PRIMERA REVISION     
                        </option>
                        @break
                    @case("2")
                        <option value="3" >                
                            PRIMERA REVISON BASES POR ABASTECIMIENTO             
                        </option>
                        @break
                    @case("3")
                        <option value="4" >                
                            ENVIO BASES SEGUNDA REVISION            
                        </option>
                        @break
                    @case("4")
                        <option value="5" >                
                            SEGUNDA REVISION BASES POR ABASTECIMIENTO             
                        </option>
                        @break
                    @case("5")
                        <option value="6" >                
                            RECOPILACION DE INFORMACION             
                        </option>
                        @break
                    @case("6")
                        <option value="7" >                
                            INVITACION A OFERENTES             
                        </option>
                        @break
                    @case("7")
                        <option value="8" >                
                            VISITA A TERRENO             
                        </option>
                        @break
                    @case("8")
                        <option value="9" >                
                            PREGUNTAS Y CONSULTAS PROPONENTE             
                        </option>
                        @break
                    @case("9")
                        <option value="10" >                
                            RESPUESTAS DEL MANDANTE             
                        </option>
                        @break
                    @case("10")
                        <option value="11" >                
                            RECEPCION DE OFERTAS TECNICAS ECONOMICAS             
                        </option>
                        @break
                    @case("11")
                        <option value="12" >                
                            EVALUACION OFERTAS TECNICAS             
                        </option>
                        @break
                    @case("12")
                        <option value="13" >                
                            EVALUACION OFERTAS ECONOMICAS             
                        </option>
                        @break
                    @case("13")
                        <option value="14" >                
                            COMITE DE INVERSIONES
                        </option> 
                        @break
                    @case("14")
                        <option value="15" >                
                            ADJUDICACION
                        </option>
                        @break                    
                @endswitch

                <option value="16" >                
                    STAND BY
                </option>
                <option value="17" >                
                    ADJUDICACION DIRECTA
                </option>

            </select>
        </div>
        <div class="mt-1 mb-3 col-sm-3">
            <input name="fecha" id='fecha' type="date" class="form-control" style="width:10vw"  required>
        </div>
        <div class="mt-1 mb-3 col-sm-3">
            <input type="file" id='foto' name="foto" class="form-control" data-height="180"  />
        </div>
        <div class="mt-1 col-sm-3">
            <input type="submit" class="btn btn-success" value="Cambiar de Fase" />
        </div>
    @elseif($fase_actual == 16 && $fase_actual != 17)
        <div class="row">
            <div class="col">
                <h1>Contrato en Fase: <b>STAND BY   /    Fecha: {{Carbon\Carbon::parse($fases_contrato->stand_by)->format('d-m-Y')}}</b> </h1>
            </div>
            <div class="col-md-auto">
                @if($contrato->fase_contrato_comprobante[0]->stand_by)
                    <a target="_blank" href="{{ Storage::url('contratos/'.$contrato->id."/".$contrato->fase_contrato_comprobante[0]->stand_by) }}">
                        <svg  version="1.1" id="download" xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 256 256" xml:space="preserve"><style>.st0{fill:#eb970a}.st1{fill:#464646}</style><path class="st1" d="M139.562 12.152c12.313 0 22.332 10.019 22.332 22.332v48.56c0 1.265 1.068 2.333 2.333 2.333h28.017c10.622 0 14.299 6.108 15.387 8.735 1.088 2.626 2.808 9.545-4.703 17.057l-59.135 59.136c-4.21 4.209-9.818 6.525-15.792 6.525-5.975 0-11.582-2.316-15.791-6.525l-59.136-59.136c-7.511-7.511-5.791-14.43-4.703-17.057 1.088-2.626 4.765-8.734 15.386-8.734h28.018c1.265 0 2.333-1.068 2.333-2.333v-48.56c0-12.313 10.018-22.332 22.331-22.332h23.123z"/><path class="st1" d="M34.617 243.15c-13.536 0-24.548-11.013-24.548-24.549v-57.854c0-13.536 11.012-24.549 24.548-24.549s24.548 11.013 24.548 24.549v33.306h137.67v-33.306c0-13.536 11.013-24.549 24.549-24.549s24.548 11.013 24.548 24.549v57.854c0 13.536-11.012 24.549-24.548 24.549H34.617z"/><path class="st0" d="M164.227 95.377c-6.783 0-12.333-5.55-12.333-12.333v-48.56c0-6.783-5.55-12.332-12.332-12.332h-23.125c-6.782 0-12.331 5.549-12.331 12.332v48.56c0 6.783-5.551 12.333-12.333 12.333H63.755c-6.782 0-8.407 3.924-3.611 8.72l59.135 59.136c4.797 4.796 12.645 4.796 17.442 0l59.135-59.136c4.796-4.796 3.171-8.72-3.612-8.72h-28.017z"/><path class="st0" d="M221.384 233.15H34.617c-8.034 0-14.548-6.514-14.548-14.549v-57.854c0-8.034 6.514-14.549 14.548-14.549 8.035 0 14.548 6.515 14.548 14.549v43.306h157.67v-43.306c0-8.034 6.514-14.549 14.549-14.549 8.034 0 14.548 6.515 14.548 14.549v57.854c0 8.036-6.514 14.549-14.548 14.549z"/></svg>
                    </a>
                @endif
            </div>
        </div>
            @elseif($fase_actual == 17)
            <div class="row">
                <div class="col">
                    <h1>Contrato en Fase: <b>ADJUDICACION DIRECTA    /    Fecha: {{Carbon\Carbon::parse($fases_contrato->adjudicacion_directa)->format('d-m-Y')}}</b> </h1>
                </div>
            <div class="col-md-auto">
                @if($contrato->fase_contrato_comprobante[0]->adjudicacion_directa)
                    <a target="_blank" href="{{ Storage::url('contratos/'.$contrato->id."/".$contrato->fase_contrato_comprobante[0]->adjudicacion_directa) }}">
                        <svg  version="1.1" id="download" xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 256 256" xml:space="preserve"><style>.st0{fill:#eb970a}.st1{fill:#464646}</style><path class="st1" d="M139.562 12.152c12.313 0 22.332 10.019 22.332 22.332v48.56c0 1.265 1.068 2.333 2.333 2.333h28.017c10.622 0 14.299 6.108 15.387 8.735 1.088 2.626 2.808 9.545-4.703 17.057l-59.135 59.136c-4.21 4.209-9.818 6.525-15.792 6.525-5.975 0-11.582-2.316-15.791-6.525l-59.136-59.136c-7.511-7.511-5.791-14.43-4.703-17.057 1.088-2.626 4.765-8.734 15.386-8.734h28.018c1.265 0 2.333-1.068 2.333-2.333v-48.56c0-12.313 10.018-22.332 22.331-22.332h23.123z"/><path class="st1" d="M34.617 243.15c-13.536 0-24.548-11.013-24.548-24.549v-57.854c0-13.536 11.012-24.549 24.548-24.549s24.548 11.013 24.548 24.549v33.306h137.67v-33.306c0-13.536 11.013-24.549 24.549-24.549s24.548 11.013 24.548 24.549v57.854c0 13.536-11.012 24.549-24.548 24.549H34.617z"/><path class="st0" d="M164.227 95.377c-6.783 0-12.333-5.55-12.333-12.333v-48.56c0-6.783-5.55-12.332-12.332-12.332h-23.125c-6.782 0-12.331 5.549-12.331 12.332v48.56c0 6.783-5.551 12.333-12.333 12.333H63.755c-6.782 0-8.407 3.924-3.611 8.72l59.135 59.136c4.797 4.796 12.645 4.796 17.442 0l59.135-59.136c4.796-4.796 3.171-8.72-3.612-8.72h-28.017z"/><path class="st0" d="M221.384 233.15H34.617c-8.034 0-14.548-6.514-14.548-14.549v-57.854c0-8.034 6.514-14.549 14.548-14.549 8.035 0 14.548 6.515 14.548 14.549v43.306h157.67v-43.306c0-8.034 6.514-14.549 14.549-14.549 8.034 0 14.548 6.515 14.548 14.549v57.854c0 8.036-6.514 14.549-14.548 14.549z"/></svg>
                    </a>
                @endif
            </div>
    @endif
</div>