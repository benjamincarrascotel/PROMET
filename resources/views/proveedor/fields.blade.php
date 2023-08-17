<script type="text/javascript" src="{{URL::asset('assets/js/desarrollo/regiones.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Row -->
<div class="row">
    
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        @if($error != null)
            <p class="alert alert-danger mt-4">{{ $error }}</p>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Datos Obligatorios</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-12">

                        <div class="form-group row">
                            <label class="col-md-3 form-label">Nombre Proveedor</label>
                            <div class="col-md-9">
                                <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Ingresar nombre" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-label">Rut <br> (Ej: 78485923-6)</label>
                            <div class="col-md-9">
                                <input id="rut" name="rut" type="text" maxlength="10" class="form-control" oninput="checkRut(this)" placeholder="Ingresar RUT sin puntos ni guión" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-label">Giro</label>
                            <div class="col-md-9">
                                <input id="giro" name="giro" type="text" class="form-control" placeholder="Ingresar tipo de Giro" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group row mb-0">
                            <label class="col-md-3 form-label">Persona Natural u Organización</label>
                            <div class="col-md-9">
                                <select id="natural_organizacion" name="natural_organizacion" class="form-control select2" required>
                                    <option value="{{null}}">Seleccionar opción</option>
                                    <option>Persona Natural</option>
                                    <option>Organización</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Datos Comerciales</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-12">

                        <div class="form-group row">
                            <label class="col-md-3 form-label">Dirección</label>
                            <div class="col-md-9">
                                <input id="direccion_com" name="direccion_com" type="text" class="form-control" placeholder="Ingresar dirección" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-label">Región</label>
                            <div class="col-md-9">
                                <select id="region_com" name="region_com" class="form-control" placeholder="Ingresar región" required></select>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-label">Comuna</label>
                            <div class="col-md-9">
                                <select id="comuna_com" name="comuna_com" class="form-control" placeholder="Ingresar comuna" required></select>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6 col-md-12">

                        <div class="form-group row">
                            <label class="col-md-3 form-label" for="email_com">Email</label>
                            <div class="col-md-9">
                                <input type="email" name="email_com" id="email_com" class="form-control" placeholder="Ingresar Email" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-label">Teléfono Fijo/Móvil</label>
                            <div class="col-md-9">
                                <input id="telefono_com" name="telefono_com" type="text" class="form-control" placeholder="Ingresar número telefónico" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-label">Persona Contacto</label>
                            <div class="col-md-9">
                                <input id="persona_contacto_com" name="persona_contacto_com" type="text" class="form-control" placeholder="Ingresar Persona Contacto" required>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Datos Logísticos</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-12">

                        <div class="form-group row">
                            <label class="col-md-3 form-label">Dirección</label>
                            <div class="col-md-9">
                                <input id="direccion_log" name="direccion_log" type="text" class="form-control" placeholder="Ingresar dirección" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-label">Región</label>
                            <div class="col-md-9">
                                <select id="region_log" name="region_log" class="form-control" placeholder="Ingresar región" required></select>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-label">Comuna</label>
                            <div class="col-md-9">
                                <select id="comuna_log" name="comuna_log" class="form-control" placeholder="Ingresar comuna" required></select>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6 col-md-12">

                        <div class="form-group row">
                            <label class="col-md-3 form-label" for="email_log">Email</label>
                            <div class="col-md-9">
                                <input type="email" name="email_log" id="email_log" class="form-control" placeholder="Ingresar Email" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-label">Teléfono Fijo/Móvil</label>
                            <div class="col-md-9">
                                <input id="telefono_log" name="telefono_log" type="text" class="form-control" placeholder="Ingresar número telefónico" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-label">Persona Contacto</label>
                            <div class="col-md-9">
                                <input id="persona_contacto_log" name="persona_contacto_log" type="text" class="form-control" placeholder="Ingresar Persona Contacto" required>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Datos Bancarios para su pago</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">

                        <div class="form-group row">
                            <label class="col-md-3 form-label">NRO. CUENTA</label>
                            <div class="col-md-9">
                                <input id="nro_cuenta" name="nro_cuenta" type="text" class="form-control" placeholder="Ingresar número de cuenta" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-label">TIPO DE CUENTA</label>
                            <div class="col-md-9">
                                <input id="tipo_cuenta" name="tipo_cuenta" type="text" class="form-control" placeholder="Ingresar tipo de cuenta" required>
                            </div>
                        </div>
                    </div>
                    <div class="col">

                        <div class="form-group row">
                            <label class="col-md-3 form-label">BANCO</label>
                            <div class="col-md-9">
                                <input id="banco" name="banco" type="text" class="form-control" placeholder="Ingresar banco" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-label" for="moneda">MONEDA</label>
                            <div class="col-md-9">
                                <input type="text" name="moneda" id="moneda" class="form-control" placeholder="Ingresar tipo de moneda" required>
                            </div>
                        </div>

                    </div>

                    <div class="col">

                        <div class="form-group row">
                            <label class="col-md-3 form-label">TITULAR CUENTA</label>
                            <div class="col-md-9">
                                <input id="banco" name="banco" type="text" class="form-control" placeholder="Ingresar banco" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-label" for="email_pago">EMAIL DE PAGO</label>
                            <div class="col-md-9">
                                <input type="email" name="email_pago" id="email_pago" class="form-control" placeholder="Ingresar tipo de moneda" required>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row mt-8">

                    <h5 style="color:red;">
                        Nota: el formato de nuestras nominas de pago es mediante transferencia. 
                    </h5>
                    <h5 style="color:red;">
                        Si usted no posee medio de cta cte debe indicar en este segmento solicitud de cheque (CH) o vale vista Virtual (VV).
                    </h5>

                    <div class="form-group">
                        <div class="form-label">Cheque Nominativo y Cruzado</div>
                        <label class="custom-switch">
                            <input type="checkbox" id="cheque_checkbox" name="cheque_checkbox" class="custom-switch-input" value="1">
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Acepto</span>
                        </label>
                    </div>

                    <div class="form-group">
                        <div class="form-label">Vale Vista Virtual emitido en BCI</div>
                        <label class="custom-switch">
                            <input type="checkbox" id="vale_vista_checkbox" name="vale_vista_checkbox" class="custom-switch-input" value="1">
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Acepto</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<script>

    var flag = 0;

    function checkRut(rut) {
        flag=1;
        // Despejar Puntos
        var valor = rut.value.replace('.','');
        // Despejar Guión
        valor = valor.replace('-','');
        
        // Aislar Cuerpo y Dígito Verificador
        cuerpo = valor.slice(0,-1);
        dv = valor.slice(-1).toUpperCase();
        
        // Formatear RUN
        rut.value = cuerpo + '-'+ dv;

    }
</script>


<script>
    var RegionesYcomunas = {

    "regiones": [{
            "NombreRegion": "Arica y Parinacota",
            "comunas": ["Arica", "Camarones", "Putre", "General Lagos"]
    },
        {
            "NombreRegion": "Tarapacá",
            "comunas": ["Iquique", "Alto Hospicio", "Pozo Almonte", "Camiña", "Colchane", "Huara", "Pica"]
    },
        {
            "NombreRegion": "Antofagasta",
            "comunas": ["Antofagasta", "Mejillones", "Sierra Gorda", "Taltal", "Calama", "Ollagüe", "San Pedro de Atacama", "Tocopilla", "María Elena"]
    },
        {
            "NombreRegion": "Atacama",
            "comunas": ["Copiapó", "Caldera", "Tierra Amarilla", "Chañaral", "Diego de Almagro", "Vallenar", "Alto del Carmen", "Freirina", "Huasco"]
    },
        {
            "NombreRegion": "Coquimbo",
            "comunas": ["La Serena", "Coquimbo", "Andacollo", "La Higuera", "Paiguano", "Vicuña", "Illapel", "Canela", "Los Vilos", "Salamanca", "Ovalle", "Combarbalá", "Monte Patria", "Punitaqui", "Río Hurtado"]
    },
        {
            "NombreRegion": "Valparaíso",
            "comunas": ["Valparaíso", "Casablanca", "Concón", "Juan Fernández", "Puchuncaví", "Quintero", "Viña del Mar", "Isla de Pascua", "Los Andes", "Calle Larga", "Rinconada", "San Esteban", "La Ligua", "Cabildo", "Papudo", "Petorca", "Zapallar", "Quillota", "Calera", "Hijuelas", "La Cruz", "Nogales", "San Antonio", "Algarrobo", "Cartagena", "El Quisco", "El Tabo", "Santo Domingo", "San Felipe", "Catemu", "Llaillay", "Panquehue", "Putaendo", "Santa María", "Quilpué", "Limache", "Olmué", "Villa Alemana"]
    },
        {
            "NombreRegion": "Región del Libertador Gral. Bernardo O’Higgins",
            "comunas": ["Rancagua", "Codegua", "Coinco", "Coltauco", "Doñihue", "Graneros", "Las Cabras", "Machalí", "Malloa", "Mostazal", "Olivar", "Peumo", "Pichidegua", "Quinta de Tilcoco", "Rengo", "Requínoa", "San Vicente", "Pichilemu", "La Estrella", "Litueche", "Marchihue", "Navidad", "Paredones", "San Fernando", "Chépica", "Chimbarongo", "Lolol", "Nancagua", "Palmilla", "Peralillo", "Placilla", "Pumanque", "Santa Cruz"]
    },
        {
            "NombreRegion": "Región del Maule",
            "comunas": ["Talca", "ConsVtución", "Curepto", "Empedrado", "Maule", "Pelarco", "Pencahue", "Río Claro", "San Clemente", "San Rafael", "Cauquenes", "Chanco", "Pelluhue", "Curicó", "Hualañé", "Licantén", "Molina", "Rauco", "Romeral", "Sagrada Familia", "Teno", "Vichuquén", "Linares", "Colbún", "Longaví", "Parral", "ReVro", "San Javier", "Villa Alegre", "Yerbas Buenas"]
    },
        {
            "NombreRegion": "Región del Biobío",
            "comunas": ["Concepción", "Coronel", "Chiguayante", "Florida", "Hualqui", "Lota", "Penco", "San Pedro de la Paz", "Santa Juana", "Talcahuano", "Tomé", "Hualpén", "Lebu", "Arauco", "Cañete", "Contulmo", "Curanilahue", "Los Álamos", "Tirúa", "Los Ángeles", "Antuco", "Cabrero", "Laja", "Mulchén", "Nacimiento", "Negrete", "Quilaco", "Quilleco", "San Rosendo", "Santa Bárbara", "Tucapel", "Yumbel", "Alto Biobío", "Chillán", "Bulnes", "Cobquecura", "Coelemu", "Coihueco", "Chillán Viejo", "El Carmen", "Ninhue", "Ñiquén", "Pemuco", "Pinto", "Portezuelo", "Quillón", "Quirihue", "Ránquil", "San Carlos", "San Fabián", "San Ignacio", "San Nicolás", "Treguaco", "Yungay"]
    },
        {
            "NombreRegion": "Región de la Araucanía",
            "comunas": ["Temuco", "Carahue", "Cunco", "Curarrehue", "Freire", "Galvarino", "Gorbea", "Lautaro", "Loncoche", "Melipeuco", "Nueva Imperial", "Padre las Casas", "Perquenco", "Pitrufquén", "Pucón", "Saavedra", "Teodoro Schmidt", "Toltén", "Vilcún", "Villarrica", "Cholchol", "Angol", "Collipulli", "Curacautín", "Ercilla", "Lonquimay", "Los Sauces", "Lumaco", "Purén", "Renaico", "Traiguén", "Victoria", ]
    },
        {
            "NombreRegion": "Región de Los Ríos",
            "comunas": ["Valdivia", "Corral", "Lanco", "Los Lagos", "Máfil", "Mariquina", "Paillaco", "Panguipulli", "La Unión", "Futrono", "Lago Ranco", "Río Bueno"]
    },
        {
            "NombreRegion": "Región de Los Lagos",
            "comunas": ["Puerto Montt", "Calbuco", "Cochamó", "Fresia", "FruVllar", "Los Muermos", "Llanquihue", "Maullín", "Puerto Varas", "Castro", "Ancud", "Chonchi", "Curaco de Vélez", "Dalcahue", "Puqueldón", "Queilén", "Quellón", "Quemchi", "Quinchao", "Osorno", "Puerto Octay", "Purranque", "Puyehue", "Río Negro", "San Juan de la Costa", "San Pablo", "Chaitén", "Futaleufú", "Hualaihué", "Palena"]
    },
        {
            "NombreRegion": "Región Aisén del Gral. Carlos Ibáñez del Campo",
            "comunas": ["Coihaique", "Lago Verde", "Aisén", "Cisnes", "Guaitecas", "Cochrane", "O’Higgins", "Tortel", "Chile Chico", "Río Ibáñez"]
    },
        {
            "NombreRegion": "Región de Magallanes y de la AntárVca Chilena",
            "comunas": ["Punta Arenas", "Laguna Blanca", "Río Verde", "San Gregorio", "Cabo de Hornos (Ex Navarino)", "AntárVca", "Porvenir", "Primavera", "Timaukel", "Natales", "Torres del Paine"]
    },
        {
            "NombreRegion": "Región Metropolitana de Santiago",
            "comunas": ["Cerrillos", "Cerro Navia", "Conchalí", "El Bosque", "Estación Central", "Huechuraba", "Independencia", "La Cisterna", "La Florida", "La Granja", "La Pintana", "La Reina", "Las Condes", "Lo Barnechea", "Lo Espejo", "Lo Prado", "Macul", "Maipú", "Ñuñoa", "Pedro Aguirre Cerda", "Peñalolén", "Providencia", "Pudahuel", "Quilicura", "Quinta Normal", "Recoleta", "Renca", "San Joaquín", "San Miguel", "San Ramón", "Vitacura", "Puente Alto", "Pirque", "San José de Maipo", "Colina", "Lampa", "TilVl", "San Bernardo", "Buin", "Calera de Tango", "Paine", "Melipilla", "Alhué", "Curacaví", "María Pinto", "San Pedro", "Talagante", "El Monte", "Isla de Maipo", "Padre Hurtado", "Peñaflor"]
    }]
}

jQuery(document).ready(function () {

var iRegion = 0;
var htmlRegion = '<option value="sin-region">Seleccione región</option><option value="sin-region">--</option>';
var htmlComunas = '<option value="sin-region">Seleccione comuna</option><option value="sin-region">--</option>';

jQuery.each(RegionesYcomunas.regiones, function () {
    htmlRegion = htmlRegion + '<option value="' + RegionesYcomunas.regiones[iRegion].NombreRegion + '">' + RegionesYcomunas.regiones[iRegion].NombreRegion + '</option>';
    iRegion++;
});

jQuery('#region_com').html(htmlRegion);
jQuery('#comuna_com').html(htmlComunas);

jQuery('#region_log').html(htmlRegion);
jQuery('#comuna_log').html(htmlComunas);

jQuery('#region_com').change(function () {
    var iRegiones = 0;
    var valorRegion = jQuery(this).val();
    var htmlComuna = '<option value="sin-comuna">Seleccione comuna</option><option value="sin-comuna">--</option>';
    jQuery.each(RegionesYcomunas.regiones, function () {
        if (RegionesYcomunas.regiones[iRegiones].NombreRegion == valorRegion) {
            var iComunas = 0;
            jQuery.each(RegionesYcomunas.regiones[iRegiones].comunas, function () {
                htmlComuna = htmlComuna + '<option value="' + RegionesYcomunas.regiones[iRegiones].comunas[iComunas] + '">' + RegionesYcomunas.regiones[iRegiones].comunas[iComunas] + '</option>';
                iComunas++;
            });
        }
        iRegiones++;
    });
    jQuery('#comuna_com').html(htmlComuna);
});
jQuery('#comuna_com').change(function () {
    if (jQuery(this).val() == 'sin-region') {
        alert('Selecciona una Región válida');
    } else if (jQuery(this).val() == 'sin-comuna') {
        alert('Selecciona una Comuna válida');
    }
});
jQuery('#region_com').change(function () {
    if (jQuery(this).val() == 'sin-region') {
        alert('Selecciona una Región válida');
    }
});


jQuery('#region_log').change(function () {
    var iRegiones = 0;
    var valorRegion = jQuery(this).val();
    var htmlComuna = '<option value="sin-comuna">Seleccione comuna</option><option value="sin-comuna">--</option>';
    jQuery.each(RegionesYcomunas.regiones, function () {
        if (RegionesYcomunas.regiones[iRegiones].NombreRegion == valorRegion) {
            var iComunas = 0;
            jQuery.each(RegionesYcomunas.regiones[iRegiones].comunas, function () {
                htmlComuna = htmlComuna + '<option value="' + RegionesYcomunas.regiones[iRegiones].comunas[iComunas] + '">' + RegionesYcomunas.regiones[iRegiones].comunas[iComunas] + '</option>';
                iComunas++;
            });
        }
        iRegiones++;
    });
    jQuery('#comuna_log').html(htmlComuna);
});
jQuery('#comuna_log').change(function () {
    if (jQuery(this).val() == 'sin-region') {
        alert('Selecciona una Región válida');
    } else if (jQuery(this).val() == 'sin-comuna') {
        alert('Selecciona una Comuna válida');
    }
});
jQuery('#region_log').change(function () {
    if (jQuery(this).val() == 'sin-region') {
        alert('Selecciona una Región válida');
    }
});

});


</script>