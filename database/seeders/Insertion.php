<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Insertion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // ABASTECIMIENTO USERS
        if(DB::table('abastecimiento_users')->count() == 0){
            DB::table('abastecimiento_users')->insert([
                ['nombre' => 'AChacón'],
                ['nombre' => 'AGranfer'],
                ['nombre' => 'AFernandez'],
                ['nombre' => 'ANTorres'],
                ['nombre' => 'JBeltran'],
                ['nombre' => 'MGuzman '],
                ['nombre' => 'SHerrera'],
                ['nombre' => 'YGarcia'],

            ]);
        }

        // ADMIN DE CONTRATOS
        if(DB::table('admin_contratos')->count() == 0){
            DB::table('admin_contratos')->insert([
                ['nombre' => 'Abastecimiento'],
                ['nombre' => 'ACarreño'],
                ['nombre' => 'AContreras'],
                ['nombre' => 'Administración Faena'],
                ['nombre' => 'ALagos'],
                ['nombre' => 'AOlivares '],
                ['nombre' => 'Bodega'],
                ['nombre' => 'CHGamboa'],
                ['nombre' => 'Comercial Stgo'],
                ['nombre' => 'Ecespedes'],
                ['nombre' => 'GCespedes'],
                ['nombre' => 'HVilchez'],
                ['nombre' => 'JBahamondes'],
                ['nombre' => 'JBorroni'],
                ['nombre' => 'JOlivares'],
                ['nombre' => 'KMuñoz'],
                ['nombre' => 'Lab y Calidad'],
                ['nombre' => 'LMartinez'],
                ['nombre' => 'Mantenimiento Holding'],
                ['nombre' => 'MCubillos'],
                ['nombre' => 'NMarin'],
                ['nombre' => 'No Existe'],
                ['nombre' => 'Ops Mina UVA'],
                ['nombre' => 'Ops Planta Amalia'],
                ['nombre' => 'Operaciones'],
                ['nombre' => 'SHerrera'],
                ['nombre' => 'TEscobedo'],
                ['nombre' => 'Prevención'],

            ]);
        }
        
        // TIPO CONTRATOS
        if(DB::table('tipo_contratos')->count() == 0){
            DB::table('tipo_contratos')->insert([
                [        'nombre_tipo' => 'Asesoría',    ],
                [        'nombre_tipo' => 'Inversión',    ],
                [        'nombre_tipo' => 'Operación',    ],
                [        'nombre_tipo' => 'Precio unitario',    ],

            ]);
        } 


        //SUPERADMIN
        if(DB::table('users')->count() == 0){
            DB::table('users')->insert([
                [        
                    'name' => 'SuperAdmin',
                    'email' => 'superadmin@gmail.com',
                    'password' => 'b1ff8785329d17dc78b8a01928fba6b81064c2ba8ce960008c2731e62896a02c',
                    'admin' => 1,
                    'superadmin' => 1,
                    'salt' => 'af04b0649c7a1dae40c7c46e6fbd139c',
                ],

            ]);

            DB::table('superadmins')->insert([
                [
                    'email' => 'superadmin@gmail.com',
                    'password' => 'b1ff8785329d17dc78b8a01928fba6b81064c2ba8ce960008c2731e62896a02c',
                    'rut' => '19790978',
                    'rut_dv' => '1',
                    'nombre' => 'superadmin',
                    'apellido1' => 'Apellido 1',
                    'apellido2' => 'Apellido 2',
                ],

            ]);
        } 

        // ACCIONES
        if(DB::table('accion_contratos')->count() == 0){
            DB::table('accion_contratos')->insert([
                [        'nombre_accion' => 'Licitar',    ],
                [        'nombre_accion' => 'Negociar',    ],
                [        'nombre_accion' => 'Renovar',    ],
                [        'nombre_accion' => 'Adjudicar Directamente',    ],
                [        'nombre_accion' => 'Eliminar',    ],
                [        'nombre_accion' => 'Extender Contrato',    ],
                [        'nombre_accion' => 'Suspender',    ],


            ]);
        }

        // SERVICIOS Y  BIENES
        if(DB::table('servicios_bienes')->count() == 0){

            DB::table('servicios_bienes')->insert([

                [
                    'nombre_servicio_bien' => 'Transporte de mineral',
                ],
                [
                    'nombre_servicio_bien' => 'Mov. Aglomerado',
                ],                
                [
                    'nombre_servicio_bien' => 'Perforación Seco / Mina UVA',
                ],                
                [
                    'nombre_servicio_bien' => 'Arriendo Excavadoras',
                ],                
                [
                    'nombre_servicio_bien' => 'Transporte de Personal',
                ],                
                [
                    'nombre_servicio_bien' => 'Transporte de Ripios ',
                ],                
                [
                    'nombre_servicio_bien' => 'Mov. Pilas Dinámicas',
                ],                
                [
                    'nombre_servicio_bien' => 'Proyección de Shocrete',
                ],                
                [
                    'nombre_servicio_bien' => 'Arriendo Red Devil',
                ],                
                [
                    'nombre_servicio_bien' => 'Alimentación ',
                ],                
                [
                    'nombre_servicio_bien' => 'Arriendo oficina',
                ],                
                [
                    'nombre_servicio_bien' => 'Energía Eléctrica',
                ],                
                [
                    'nombre_servicio_bien' => 'Transporte de Acido',
                ],                
                [
                    'nombre_servicio_bien' => 'Transporte de Cátodos',
                ],                
                [
                    'nombre_servicio_bien' => 'Soporte Plataforma App Covid, Pgr, Poolcam',
                ],                
                [
                    'nombre_servicio_bien' => 'Aseo de Oficina Miraflores ',
                ],                
                [
                    'nombre_servicio_bien' => 'Mantenimiento Sitios Web Grupo Rassmuss',
                ],                
                [
                    'nombre_servicio_bien' => 'Licencias TICA',
                ],                
                [
                    'nombre_servicio_bien' => 'Arriendo de maquinarias',
                ],                
                [
                    'nombre_servicio_bien' => 'Monitoreo de agua',
                ],                
                [
                    'nombre_servicio_bien' => 'Arriendo Aljibes',
                ],                
                [
                    'nombre_servicio_bien' => 'Monitoreo de Aire',
                ],                
                [
                    'nombre_servicio_bien' => 'Reforestación',
                ],                
                [
                    'nombre_servicio_bien' => 'Retiro de Residuos Organicos',
                ],                
                [
                    'nombre_servicio_bien' => 'Asesoria MAB',
                ],                
                [
                    'nombre_servicio_bien' => 'Monitoreo Ruido',
                ],                
                [
                    'nombre_servicio_bien' => 'Gestion Mensual Servicio Phishing',
                ],                
                [
                    'nombre_servicio_bien' => 'Seguridad Industrial',
                ],                
                [
                    'nombre_servicio_bien' => 'Servicios Electricos Mina UVA',
                ],                
                [
                    'nombre_servicio_bien' => 'Residuos Peligrosos',
                ],                
                [
                    'nombre_servicio_bien' => 'Arriendo Retroexcavadora Brownfield',
                ],                
                [
                    'nombre_servicio_bien' => 'Asesoria Tica (Alejandro Ojeda)',
                ],                
                [
                    'nombre_servicio_bien' => 'Analisis de Gases Equipos',
                ],                
                [
                    'nombre_servicio_bien' => 'Analisis de lote Cu',
                ],                
                [
                    'nombre_servicio_bien' => 'Soporte Plataformas Checkpoint',
                ],                
                [
                    'nombre_servicio_bien' => 'Muestras de probetas',
                ],                
                [
                    'nombre_servicio_bien' => 'Arriendo equipo Reflex',
                ],                
                [
                    'nombre_servicio_bien' => 'Muestras de Testigos',
                ],                
                [
                    'nombre_servicio_bien' => 'Sistema de GPS',
                ],                
                [
                    'nombre_servicio_bien' => 'Vigilancia y monitoreo remoto EMT',
                ],                
                [
                    'nombre_servicio_bien' => 'Lavanderia',
                ],                
                [
                    'nombre_servicio_bien' => 'Mantenimiento y Reparación',
                ],                
                [
                    'nombre_servicio_bien' => 'Tarjeta Sodexo',
                ],                
                [
                    'nombre_servicio_bien' => 'Plataforma facturación',
                ],                
                [
                    'nombre_servicio_bien' => 'Retiro de Bionzimas y Grasa',
                ],                
                [
                    'nombre_servicio_bien' => 'Residuos No peligrosos',
                ],                
                [
                    'nombre_servicio_bien' => 'Arriendo WeWork',
                ],                
                [
                    'nombre_servicio_bien' => 'Analisis de Laboratorio ALS',
                ],     
                [
                    'nombre_servicio_bien' => 'Arriendo de camionetas',
                ],             
                [
                    'nombre_servicio_bien' => 'Aseo Industrial',
                ],             
                [
                    'nombre_servicio_bien' => 'Expertise on site',
                ],             
                [
                    'nombre_servicio_bien' => 'Hosting',
                ],             
                [
                    'nombre_servicio_bien' => 'Telecomunicaciones',
                ],             
                [
                    'nombre_servicio_bien' => 'Mtto Aire y equipos',
                ],             
                [
                    'nombre_servicio_bien' => 'Arriendo de baños quimicos',
                ],             
                [
                    'nombre_servicio_bien' => 'Apoyo Mesa de Ayuda TICA SAP Price',
                ],             
                [
                    'nombre_servicio_bien' => 'Mantenimiento de Aire Equipos Miraflores',
                ],             
                [
                    'nombre_servicio_bien' => 'Mtto Orpak',
                ],             
                [
                    'nombre_servicio_bien' => 'Base de rescate',
                ],             
                [
                    'nombre_servicio_bien' => 'Arriendo Impresoras',
                ],             
                [
                    'nombre_servicio_bien' => 'Fumigacion',
                ],             
                [
                    'nombre_servicio_bien' => 'Analisis de Laboratorio SGS',
                ],             
                [
                    'nombre_servicio_bien' => 'Arriendo de Camioneta Explo Domeyko',
                ],             
                [
                    'nombre_servicio_bien' => 'Servicio de control de asistencia catemu',
                ],             
                [
                    'nombre_servicio_bien' => 'Arriendo de Maquina de Café',
                ],             
                [
                    'nombre_servicio_bien' => 'Inspeccion de Cátodos Cu',
                ],             
                [
                    'nombre_servicio_bien' => 'Arriendo de Cargador Frontal',
                ],             
                [
                    'nombre_servicio_bien' => 'Arriendo Maquina de Agua',
                ],             
                [
                    'nombre_servicio_bien' => 'Explotación El Seco',
                ],             
                [
                    'nombre_servicio_bien' => 'A17  Ácido Sulfúrico',
                ],             
                [
                    'nombre_servicio_bien' => 'A18 Petroleo',
                ],             
                [
                    'nombre_servicio_bien' => 'A04-10  Cloruro Calcio',
                ],             
                [
                    'nombre_servicio_bien' => 'A07  Ferretería',
                ],             
                [
                    'nombre_servicio_bien' => 'A04-6  Extractante (*)',
                ],             
                [
                    'nombre_servicio_bien' => 'A01 Explosivos',
                ],             
                [
                    'nombre_servicio_bien' => 'A04-5  Solvente (*)',
                ],             
                [
                    'nombre_servicio_bien' => 'A31  Repuestos Maq.Pesada',
                ],             
                [
                    'nombre_servicio_bien' => 'A23  EPP Elem.Prot.Pers.',
                ],             
                [
                    'nombre_servicio_bien' => 'A87  Cementos',
                ],             
                [
                    'nombre_servicio_bien' => 'A88 Shotcrete',
                ],             
                [
                    'nombre_servicio_bien' => 'A25-1 Gas',
                ],             
                [
                    'nombre_servicio_bien' => 'A05 Equipos de Planta',
                ],             
                [
                    'nombre_servicio_bien' => 'A04-8  Otros Reactivos (*)',
                ],             
                [
                    'nombre_servicio_bien' => 'A04-11  Cloruro de Sodio  (*)',
                ],             
                [
                    'nombre_servicio_bien' => 'A26  Artículos Eléctricos',
                ],             
                [
                    'nombre_servicio_bien' => 'A12  Geomembranas',
                ],             
                [
                    'nombre_servicio_bien' => 'A34 Fitting y cañeria',
                ],             
                [
                    'nombre_servicio_bien' => 'A04-2  Cianuro  (*)',
                ],             
                [
                    'nombre_servicio_bien' => 'A02-2 Aceros Perforación',
                ],             
                [
                    'nombre_servicio_bien' => 'A38 Sistemas',
                ],             
                [
                    'nombre_servicio_bien' => 'A20 Lubricante',
                ],             
                [
                    'nombre_servicio_bien' => 'A21  Herramientas',
                ],             
                [
                    'nombre_servicio_bien' => 'A24 Neumaticos y Camaras',
                ],             
                [
                    'nombre_servicio_bien' => 'A02-3  Aceros Fortificac.',
                ],             
                [
                    'nombre_servicio_bien' => 'A79 Materiales TICA',
                ],             
                [
                    'nombre_servicio_bien' => 'A28-2  Filtros',
                ],             
                [
                    'nombre_servicio_bien' => 'A02-1  Perforación y Brocas',
                ],             
                [
                    'nombre_servicio_bien' => 'A22  Reactivos, Mat.Lab.',
                ],             
                [
                    'nombre_servicio_bien' => 'A09  Mangueras y Acoples',
                ],             
                [
                    'nombre_servicio_bien' => 'A14 Repuestos  Vehíc. Liv',
                ],             
                [
                    'nombre_servicio_bien' => 'A04-4  Hidróxido de Sodio  (*)',
                ],             
                [
                    'nombre_servicio_bien' => 'A33  Materiales Oficina',
                ],             
                [
                    'nombre_servicio_bien' => 'A75  Agua Purificada',
                ],             
                [
                    'nombre_servicio_bien' => 'A29 Rodam.Reten.Mang.',
                ],             
                [
                    'nombre_servicio_bien' => 'A03  Bolas de Acero',
                ],             
                [
                    'nombre_servicio_bien' => 'A27 Mat. Construcción',
                ],             
                [
                    'nombre_servicio_bien' => 'A25-4 Soldadura',
                ],             
                [
                    'nombre_servicio_bien' => 'A04-7  Sulfato de Cobalto  (*) Agregado',
                ],             
                [
                    'nombre_servicio_bien' => 'A04-9 Supresor de neblina',
                ],             
                [
                    'nombre_servicio_bien' => 'A35 Malla Harnero',
                ],             
                [
                    'nombre_servicio_bien' => 'A30  Aceros bronces Fierr',
                ],             
                [
                    'nombre_servicio_bien' => 'A32  Menajes Hogar',
                ],             
                [
                    'nombre_servicio_bien' => 'A11 Pernos Golillas y Tuercas',
                ],             
                [
                    'nombre_servicio_bien' => 'A25-2 Acetileno',
                ],             
                [
                    'nombre_servicio_bien' => 'A36 Repuestos Maq.Marca',
                ],             
                [
                    'nombre_servicio_bien' => 'A19 Bencina',
                ],             
                [
                    'nombre_servicio_bien' => 'A10 Correas',
                ],             
                [
                    'nombre_servicio_bien' => 'A78  Bombas',
                ],             
                [
                    'nombre_servicio_bien' => 'A23-1 Ropa Convenio',
                ],             
                [
                    'nombre_servicio_bien' => 'A86 Baterias',
                ],             
                [
                    'nombre_servicio_bien' => 'A08 Gomas',
                ],             
                [
                    'nombre_servicio_bien' => 'A06 Pastas y Pegamentos',
                ],             
                [
                    'nombre_servicio_bien' => 'A89 Elementos Covid',
                ],             
                [
                    'nombre_servicio_bien' => 'A37 Repuesto Camion Marca',
                ],             
                [
                    'nombre_servicio_bien' => 'A76  Serv. Fabricación (bienes)',
                ],             
                [
                    'nombre_servicio_bien' => 'A90 Licencias y Software',
                ],             
                [
                    'nombre_servicio_bien' => 'A28-1 Empaquetaduras',
                ],             
                [
                    'nombre_servicio_bien' => 'A02 Perforación',
                ],             
                [
                    'nombre_servicio_bien' => 'A04-3  Ácido Sulfúrico Técn',
                ],             
                [
                    'nombre_servicio_bien' => 'A82 Equipos Mineros',
                ],             
                [
                    'nombre_servicio_bien' => 'A84 Automati control PLC',
                ],             
                [
                    'nombre_servicio_bien' => 'A81  Válvulas',
                ],             
                [
                    'nombre_servicio_bien' => 'A80 Motores',
                ],             
                [
                    'nombre_servicio_bien' => 'A04  Reactivo Planta',
                ],             
                [
                    'nombre_servicio_bien' => 'A25  Acet.Gas.Oxíg.Sold.',
                ],             
                [
                    'nombre_servicio_bien' => 'A83  CUARZO',
                ],             
                [
                    'nombre_servicio_bien' => 'A04-1 Azufre',
                ],             
                [
                    'nombre_servicio_bien' => 'A04-12 Goma Guar',
                ],             
                [
                    'nombre_servicio_bien' => 'A08-1Sello Repuesto NP',
                ],             
                [
                    'nombre_servicio_bien' => 'A09-1 Manguera Repuesto NP',
                ],             
                [
                    'nombre_servicio_bien' => 'A10-1 Correa Repuesto NP',
                ],             
                [
                    'nombre_servicio_bien' => 'A11-1 Pernos Repuesto NP',
                ],    
                [
                    'nombre_servicio_bien' => 'A28 Empaquetad.y Filtros',
                ],
                [
                    'nombre_servicio_bien' => 'A85 Equipos elect - ind',
                ],        

            ]);
            
         
        }

        if(DB::table('proveedores')->count() == 0){
            DB::table('proveedores')->insert([
                [
                    'nombre' => 'TRANSPORTE Y LOGISTICA TANTAUCO SPA',
                    'codigo' => '1002496',
                ],
                [
                    'nombre' => 'QP MINING SERVICIOS SPA',
                    'codigo' => '1003796',
                ],
                [
                    'nombre' => 'ERIC A. ARAVENA A. TRANS. CARGA Y M',
                    'codigo' => '1000122',
                ],
                [
                    'nombre' => 'CESAR PATRICIO VILLEGAS URRUTIA',
                    'codigo' => '5000024',
                ],
                [
                    'nombre' => 'ANDRES ANTONIO MARTINEZ VALENCIA TR',
                    'codigo' => '1002785',
                ],
                [
                    'nombre' => 'MARCO ANTONIO OLGUIN ESPINOSA',
                    'codigo' => '1002269',
                ],
                [
                    'nombre' => 'LUIS ALVAREZ ROJAS',
                    'codigo' => '1000061',
                ],
                [
                    'nombre' => 'SERVICIOS ROBOCON LIMITADA',
                    'codigo' => '1002351',
                ],
                [
                    'nombre' => 'AUSTIN CHILE TRADING LIMITADA',
                    'codigo' => '1000955',
                ],
                [
                    'nombre' => 'SOC. ADM DE CASINOS Y SERV ALISERVI',
                    'codigo' => '1002860',
                ],
                [
                    'nombre' => 'MARIE ELIZABETH OCAYO CUBILLOS',
                    'codigo' => '5001816',
                ],
                [
                    'nombre' => 'SOC GASTRO VALLE DEL LIWA LTDA',
                    'codigo' => '1003573',
                ],
                [
                    'nombre' => 'ORINOCO INMOBILIARIA LTDA.',
                    'codigo' => '1001869',
                ],
                [
                    'nombre' => 'TRANSPORTES TRANSVER LIMITADA',
                    'codigo' => '1000320',
                ],
                [
                    'nombre' => 'Sociedad Comercial Doña Isidora SPA',
                    'codigo' => '1004249',
                ],
                [
                    'nombre' => 'CARLOS SILVA',
                    'codigo' => '5002272',
                ],
                [
                    'nombre' => 'FC SERVICIOS INTEGRALES SpA',
                    'codigo' => '1003997',
                ],
                [
                    'nombre' => 'EMP. DE PREST. DE SERV. RODOLFO FIG',
                    'codigo' => '1000205',
                ],
                [
                    'nombre' => 'TRANSPORTES Y ARRIENDO EQUIMIN LIMI',
                    'codigo' => '1003518',
                ],
                [
                    'nombre' => 'ANALISIS AMBIENTALES S.A.',
                    'codigo' => '1003523',
                ],
                [
                    'nombre' => 'TRANSP ELIAS RAMIREZ PEREIRA E.I.R.',
                    'codigo' => '1003299',
                ],
                [
                    'nombre' => 'Transportes Camion Gustavo Patricio',
                    'codigo' => '1004130',
                ],
                [
                    'nombre' => 'JOSE ESCOBAR SALAS',
                    'codigo' => '5001833',
                ],
                [
                    'nombre' => 'TRANSPORTES JULIO SOLANO OLIVARES E',
                    'codigo' => '1001532',
                ],
                [
                    'nombre' => 'SERVICIOS Y PROYECTOS AMBIETALES S.',
                    'codigo' => '1003651',
                ],
                [
                    'nombre' => 'CONSULTORA SOLUC AMBIENTALES EST',
                    'codigo' => '1003319',
                ],
                [
                    'nombre' => 'TRIPAN S.A.',
                    'codigo' => '1003825',
                ],
                [
                    'nombre' => 'COSEMAR SERVICIOS INDUSTRIALES S.A.',
                    'codigo' => '1000184',
                ],
                [
                    'nombre' => 'MAB SERVICIOS Y ASESORIAS LTDA',
                    'codigo' => '1003203',
                ],
                [
                    'nombre' => 'INNTESEC SpA',
                    'codigo' => '1003505',
                ],
                [
                    'nombre' => 'MARCELO J. URREA C. PREST. DE SERV.',
                    'codigo' => '1001308',
                ],
                [
                    'nombre' => 'FLORES Y LARENAS LIMITADA',
                    'codigo' => '1000194',
                ],
                [
                    'nombre' => 'HIDRONOR CHILE SA',
                    'codigo' => '1002863',
                ],
                [
                    'nombre' => 'AOG Support SpA',
                    'codigo' => '1002317',
                ],
                [
                    'nombre' => 'CHEMERGEN LTDA',
                    'codigo' => '1003667',
                ],
                [
                    'nombre' => 'SGS MINERALS S.A.',
                    'codigo' => '1000991',
                ],
                [
                    'nombre' => 'LABORATORIO DE CONT. TECN LLAY LLAY',
                    'codigo' => '1001601',
                ],
                [
                    'nombre' => 'REFLEX INSTRUMENT SOUTH AMERICA LTD',
                    'codigo' => '1002010',
                ],
                [
                    'nombre' => 'FF GEOMECHANICS INGENIERIA LIMITADA',
                    'codigo' => '1000186',
                ],
                [
                    'nombre' => 'E-MINING TECHNOLOGY S A',
                    'codigo' => '1002232',
                ],
                [
                    'nombre' => 'CAMPAQA Y CIA. LTDA.',
                    'codigo' => '1001587',
                ],
                [
                    'nombre' => 'MANT. Y SERV. ANALISIS VIBRACI',
                    'codigo' => '1002972',
                ],
                [
                    'nombre' => 'MAESTRANZA EMILIO VILLEGAS E H',
                    'codigo' => '1002333',
                ],
                [
                    'nombre' => 'SERVICIOS INDUSTRIALES SEYMAR',
                    'codigo' => '1002973',
                ],
                [
                    'nombre' => 'KUNSTMANN CHILE S.A.',
                    'codigo' => '1000374',
                ],
                [
                    'nombre' => 'REPUESTOS PARA LA MINERIA PART',
                    'codigo' => '1000575',
                ],
                [
                    'nombre' => 'COMERCIAL FILTERPARTSERVICE LT',
                    'codigo' => '1002547',
                ],
                [
                    'nombre' => 'SODEXO SOLUCIONES DE MOTIVACION CHI',
                    'codigo' => '1000966',
                ],
                [
                    'nombre' => 'DBNET INGENIERIA DE SOFTWARE S.A',
                    'codigo' => '1001178',
                ],
                [
                    'nombre' => 'SOCIEDAD COMERCIAL SCOPLA LIMITADA',
                    'codigo' => '1000168',
                ],
                [
                    'nombre' => 'WEWORK CHILE',
                    'codigo' => '1003869',
                ],
                [
                    'nombre' => 'ALS PATAGONIA S.A.',
                    'codigo' => '1001023',
                ],
                [
                    'nombre' => 'COMPAÑIA DE LEASING TATTERSALL S.A.',
                    'codigo' => '1001191',
                ],
                [
                    'nombre' => 'SANDVIK CHILE S.A.',
                    'codigo' => '1000937',
                ],
                [
                    'nombre' => 'CLARO CHILE SpA',
                    'codigo' => '1003457',
                ],
                [
                    'nombre' => 'EMP NACIONAL DE TELECOMUNICACIONES',
                    'codigo' => '1000909',
                ],
                [
                    'nombre' => 'RFV REFRIGERACION VIDELA SPA',
                    'codigo' => '1002962',
                ],
                [
                    'nombre' => 'DISAL CHILE LTDA',
                    'codigo' => '1001028',
                ],
                [
                    'nombre' => 'PricewaterhouseCoopers Consultores,',
                    'codigo' => '1001198',
                ],
                [
                    'nombre' => 'ORPAK LATINA SPA',
                    'codigo' => '1002168',
                ],
                [
                    'nombre' => 'ESACHS S.A.',
                    'codigo' => '1004277',
                ],
                [
                    'nombre' => 'CANON CHILE S.A',
                    'codigo' => '1001004',
                ],
                [
                    'nombre' => 'CONTROL DE PLAGAS MOUSE CLEAN SPA',
                    'codigo' => '1003389',
                ],
                [
                    'nombre' => 'VIGATEC S A',
                    'codigo' => '1002697',
                ],
                [
                    'nombre' => 'LIVEHOME SPA',
                    'codigo' => '1004297',
                ],
                [
                    'nombre' => 'KRONOX S.A',
                    'codigo' => '1004363',
                ],
                [
                    'nombre' => 'INTERTEK CALEB BRETT CHILE S.A',
                    'codigo' => '1001040',
                ],
                [
                    'nombre' => 'VALLADARES Y VALDIVIA LTDA.',
                    'codigo' => '1001866',
                ],
                [
                    'nombre' => 'INFORMÁTICA STECH LIMITADA',
                    'codigo' => '1002477',
                ],
                [
                    'nombre' => 'QUALITY WATER SERVICE CHILE SPA',
                    'codigo' => '1002389',
                ],
                [
                    'nombre' => 'PRODUCTOS QUIMICOS Y MINERALES LTDA',
                    'codigo' => '1000224',
                ],
                [
                    'nombre' => 'FAMESA EXPLOSIVOS CHILE S.A.',
                    'codigo' => '1000158',
                ],
                [
                    'nombre' => 'ENEL DISTRIBUCION CHILE S.A.',
                    'codigo' => '1001021',
                ],
                [
                    'nombre' => 'ENGIE ENERGIA CHILE S.A.',
                    'codigo' => '1003304',
                ],
                [
                    'nombre' => 'INGENIERIA Y SOLUCIONES TECNOLOGICAS LTDA',
                    'codigo' => '0000000',
                ],
                
            ]);
        }
        
        // CLASIFICACIONES
        if(DB::table('clasificaciones')->count() == 0){
            DB::table('clasificaciones')->insert([
                [        'nombre_clasificacion' => 'N/E',    ],
                [        'nombre_clasificacion' => 'Estrategico',    ],
                [        'nombre_clasificacion' => 'Apalancado',    ],
                [        'nombre_clasificacion' => 'Cuello B',    ],
                [        'nombre_clasificacion' => 'Rutinarios',    ],

            ]);
        }

        // FAENAS
        if(DB::table('faenas')->count() == 0){
            DB::table('faenas')->insert([
                [        'nombre_faena' => 'Batuco',    ],
                [        'nombre_faena' => 'Catemu',    ],
                [        'nombre_faena' => 'Catemu/DA',    ],
                [        'nombre_faena' => 'Catemu/Pullalli',    ],
                [        'nombre_faena' => 'Dos Amigos ',    ],
                [        'nombre_faena' => 'Dos Amigos/ Pullalli',    ],
                [        'nombre_faena' => 'Holding',    ],
                [        'nombre_faena' => 'Mina Pullalli',    ],
                [        'nombre_faena' => 'Mina UVA',    ],
                [        'nombre_faena' => 'Planta Amalia',    ],
                [        'nombre_faena' => 'Pullalli/Batuco',    ],
                [        'nombre_faena' => 'Santiago',    ],

            ]);
        }

        // AREAS
        if(DB::table('areas')->count() == 0){
            DB::table('areas')->insert([
                [        'nombre_area' => 'Abastecimiento',    ],
                [        'nombre_area' => 'Adm Faena',    ],
                [        'nombre_area' => 'Bodega',    ],
                [        'nombre_area' => 'Comercial',    ],
                [        'nombre_area' => 'Exploraciones',    ],
                [        'nombre_area' => 'Finanzas',    ],
                [        'nombre_area' => 'Holding',    ],
                [        'nombre_area' => 'Lab y Calidad',    ],
                [        'nombre_area' => 'Laboratorio',    ],
                [        'nombre_area' => 'Mantenimiento Holding',    ],
                [        'nombre_area' => 'Mantenimiento Mina Uva',    ],
                [        'nombre_area' => 'Medio Ambiente',    ],
                [        'nombre_area' => 'Ops Batuco',    ],
                [        'nombre_area' => 'Ops Dos Amigos',    ],
                [        'nombre_area' => 'Ops Holding',    ],
                [        'nombre_area' => 'Ops Mina Pullalli',    ],
                [        'nombre_area' => 'Ops Mina UVA',    ],
                [        'nombre_area' => 'Ops Planta Amalia',    ],
                [        'nombre_area' => 'Planif Faena',    ],
                [        'nombre_area' => 'Prevención de Riesgos',    ],
                [        'nombre_area' => 'RRHH',    ],
                [        'nombre_area' => 'Relaciones Comunitarias',    ],
                [        'nombre_area' => 'Seguridad Holding',    ],
                [        'nombre_area' => 'TICA',    ],
        
            ]);
        }

        // CENTROS
        if(DB::table('centros')->count() == 0){
            DB::table('centros')->insert([
                [
                'nombre_centro' => 'AC02',
                ],
                [
                'nombre_centro' => 'BA02',
                ],
                [
                'nombre_centro' => 'DA02',
                ],
                [
                'nombre_centro' => 'MP01',
                ],
                [
                'nombre_centro' => 'PL01',
                ],
                [
                'nombre_centro' => 'UV01',
                ],
            ]);
        }


    }
}
