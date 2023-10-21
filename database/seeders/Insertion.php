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
                    'bodega' => 1,
                    'salt' => 'af04b0649c7a1dae40c7c46e6fbd139c',
                ],

            ]);

            DB::table('superadmins')->insert([
                [
                    'email' => 'superadmin@gmail.com',
                    'password' => 'b1ff8785329d17dc78b8a01928fba6b81064c2ba8ce960008c2731e62896a02c',
                    'rut' => '19790977',
                    'rut_dv' => '4',
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

        // FAMILIAS PRODUCTOS
        if(DB::table('familia_productos')->count() == 0){
            DB::table('familia_productos')->insert([
                [
                    'id' => 1,
                    'nombre' => 'EQUIPOS MAYORES',
                    'acronimo' => 'EMA',
                ],
                [
                    'id' => 2,
                    'nombre' => 'EQUIPOS MENORES',
                    'acronimo' => 'EME',
                ],
                [
                    'id' => 3,
                    'nombre' => 'VEHICULOS',
                    'acronimo' => 'VEH',
                ],
                [
                    'id' => 4,
                    'nombre' => 'Módulos y Contenedores',
                    'acronimo' => 'MOD',
                ],
            ]);
        }

        // SUB FAMILIAS
        if(DB::table('sub_familia_productos')->count() == 0){
            DB::table('sub_familia_productos')->insert([
                [
                    'id' => 1,
                    'familia_id' => 1,
                    'nombre' => 'Grua Hidraulica',
                    'acronimo' => 'GH',
                ],
                [
                    'id' => 2,
                    'familia_id' => 1,
                    'nombre' => 'Grua Horquilla',
                    'acronimo' => 'GHOR',
                ],
                [
                    'id' => 3,
                    'familia_id' => 1,
                    'nombre' => 'Alza Hombre',
                    'acronimo' => 'ALZH',
                ],
                [
                    'id' => 4,
                    'familia_id' => 1,
                    'nombre' => 'Manipulador Telescopico',
                    'acronimo' => 'MANIT',
                ],
                [
                    'id' => 5,
                    'familia_id' => 1,
                    'nombre' => 'Retroexcavadora',
                    'acronimo' => 'RETEX',
                ],
                [
                    'id' => 6,
                    'familia_id' => 1,
                    'nombre' => 'Excavadora',
                    'acronimo' => 'EXCA',
                ],
                [
                    'id' => 7,
                    'familia_id' => 1,
                    'nombre' => 'Rodillo Compactador',
                    'acronimo' => 'RCOMP',
                ],
                [
                    'id' => 8,
                    'familia_id' => 1,
                    'nombre' => 'Motoniveladora',
                    'acronimo' => 'MNIVEL',
                ],
                [
                    'id' => 9,
                    'familia_id' => 1,
                    'nombre' => 'Mini Retroexcavadora',
                    'acronimo' => 'MINRE',
                ],
                [
                    'id' => 10,
                    'familia_id' => 1,
                    'nombre' => 'Minicargador',
                    'acronimo' => 'MINCA',
                ],
                [
                    'id' => 11,
                    'familia_id' => 1,
                    'nombre' => 'Tractocamion',
                    'acronimo' => 'TRCAM',
                ],
                [
                    'id' => 12,
                    'familia_id' => 1,
                    'nombre' => 'Semiremolque',
                    'acronimo' => 'SREM',
                ],
                [
                    'id' => 13,
                    'familia_id' => 1,
                    'nombre' => 'Camion Pluma',
                    'acronimo' => 'CP',
                ],
                [
                    'id' => 14,
                    'familia_id' => 1,
                    'nombre' => 'Camion Abastecedor de Combustible',
                    'acronimo' => 'CACOM',
                ],
                [
                    'id' => 15,
                    'familia_id' => 1,
                    'nombre' => 'Camion Plano 3/4',
                    'acronimo' => 'CPLAN',
                ],
                [
                    'id' => 16,
                    'familia_id' => 1,
                    'nombre' => 'Camion Aljibes',
                    'acronimo' => 'CALJ',
                ],
                [
                    'id' => 17,
                    'familia_id' => 1,
                    'nombre' => 'Camion Tolva',
                    'acronimo' => 'CTOL',
                ],

                

                [
                    'id' => 18,
                    'familia_id' => 2,
                    'nombre' => 'Generador',
                    'acronimo' => 'GEN',
                ],
                [
                    'id' => 19,
                    'familia_id' => 2,
                    'nombre' => 'Termofusionadora',
                    'acronimo' => 'TERF',
                ],
                [
                    'id' => 20,
                    'familia_id' => 2,
                    'nombre' => 'Equipo Topográfico',
                    'acronimo' => 'ETOP',
                ],
                [
                    'id' => 21,
                    'familia_id' => 2,
                    'nombre' => 'Torre de Iluminación',
                    'acronimo' => 'TRILU',
                ],
                [
                    'id' => 22,
                    'familia_id' => 2,
                    'nombre' => 'Equipo Compactador',
                    'acronimo' => 'ECOMP',
                ],
                [
                    'id' => 23,
                    'familia_id' => 2,
                    'nombre' => 'Radio de Comunicacion',
                    'acronimo' => 'RACO',
                ],
                [
                    'id' => 24,
                    'familia_id' => 2,
                    'nombre' => 'Moto Bomba y Bombas',
                    'acronimo' => 'MBOM',
                ],
                [
                    'id' => 25,
                    'familia_id' => 2,
                    'nombre' => 'Motoniveladora',
                    'acronimo' => 'MNIV',
                ],
                [
                    'id' => 26,
                    'familia_id' => 2,
                    'nombre' => 'Calefactor',
                    'acronimo' => 'CAL',
                ],
                [
                    'id' => 27,
                    'familia_id' => 2,
                    'nombre' => 'Compresor',
                    'acronimo' => 'COM',
                ],
                [
                    'id' => 28,
                    'familia_id' => 2,
                    'nombre' => 'Andamios',
                    'acronimo' => 'ANDA',
                ],
                [
                    'id' => 29,
                    'familia_id' => 2,
                    'nombre' => 'Moldajes',
                    'acronimo' => 'MOLD',
                ],
                [
                    'id' => 30,
                    'familia_id' => 2,
                    'nombre' => 'Herramientas Electricas',
                    'acronimo' => 'HEEL',
                ],
                [
                    'id' => 31,
                    'familia_id' => 2,
                    'nombre' => 'Herramientas Inalambricas',
                    'acronimo' => 'HEIN',
                ],
                [
                    'id' => 32,
                    'familia_id' => 2,
                    'nombre' => 'Equipos e Instrumentos de Precisión',
                    'acronimo' => 'EQPR',
                ],
                [
                    'id' => 33,
                    'familia_id' => 2,
                    'nombre' => 'Yugos',
                    'acronimo' => 'YUGO',
                ],
                [
                    'id' => 34,
                    'familia_id' => 2,
                    'nombre' => 'Equipos de Carga y Levante',
                    'acronimo' => 'ECV',
                ],
                [
                    'id' => 35,
                    'familia_id' => 2,
                    'nombre' => 'Equipos Hidraulicos',
                    'acronimo' => 'EHID',
                ],
                [
                    'id' => 36,
                    'familia_id' => 2,
                    'nombre' => 'Equipos Manuales',
                    'acronimo' => 'EMAN',
                ],
                [
                    'id' => 37,
                    'familia_id' => 2,
                    'nombre' => 'Equipos Neumaticos',
                    'acronimo' => 'ENEU',
                ],



                [
                    'id' => 38,
                    'familia_id' => 3,
                    'nombre' => 'Camioneta',
                    'acronimo' => 'CAM',
                ],
                [
                    'id' => 39,
                    'familia_id' => 3,
                    'nombre' => 'Furgones y Minibuses',
                    'acronimo' => 'FTP',
                ],
                [
                    'id' => 40,
                    'familia_id' => 3,
                    'nombre' => 'Camion Liviano',
                    'acronimo' => 'CL',
                ],
                [
                    'id' => 41,
                    'familia_id' => 3,
                    'nombre' => 'BUS',
                    'acronimo' => 'BUS',
                ],
                [
                    'id' => 42,
                    'familia_id' => 4,
                    'nombre' => 'Módulos y Contenedores',
                    'acronimo' => 'MOD',
                ],
                

            ]);
        }
       

        // EMPRESAS
        if(DB::table('empresas')->count() == 0){
            DB::table('empresas')->insert([
                [
                    'nombre' => 'Promet Servicios Spa',
                    'rut' => '96.853.940-k',
                    'giro' => 'Construcción Modulares, servicios y obra de ingeniería, hotelera, arriendo y compra de bienes',
                ],
                [
                    'nombre' => 'Promet Montajes Spa',
                    'rut' => '76.543.046-1',
                    'giro' => 'Ejecución de obras civiles, montaje de plantas, asesoría e inversión',
                ],
                [
                    'nombre' => 'Promet Maquinarias y Equipos Spa',
                    'rut' => '76.248.021-2',
                    'giro' => 'Arriendo y venta de equipos y maquinaria, arriendo de camionetas.',
                ],
                [
                    'nombre' => 'Promet Transportes Spa',
                    'rut' => '76.248.012-3',
                    'giro' => 'Transporte de carga.',
                ],
                [
                    'nombre' => 'Servicios Industriales Spa',
                    'rut' => '76.576.479-3',
                    'giro' => 'Servicios Industriales y obra menores.',
                ],
            ]);
        }

        // PROYECTOS
        if(DB::table('proyectos')->count() == 0){
            DB::table('proyectos')->insert([
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 5,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Hotelería',
                    'sociedad_sap' => 'PIN',
                    'codigo_sap' => 'V/PIN-HOT-22-001-01',
                    'nombre_sap' => 'CC188 Guardias',

                    'estado' => 'ACTIVO',
                ],

                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'Rental',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => '610001',
                    'nombre_sap' => 'CC880 GAV Rental',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'Rental',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => '610002',
                    'nombre_sap' => 'CC890 GAV Habitacional',

                    'estado' => 'ACTIVO',
                ],

                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Administración',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => 'V/PMA-ADM-23-001-01',
                    'nombre_sap' => 'Staff Adm Infr Modular y Activos',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Maquinarias',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => 'V/PMA-MAQ-22-001-01',
                    'nombre_sap' => 'CC257 Equipos Mayores',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Maquinarias',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => 'V/PMA-MAQ-22-001-02',
                    'nombre_sap' => 'CC258 Equipos Menores',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Maquinarias',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => 'V/PMA-MAQ-22-001-03',
                    'nombre_sap' => 'CC259 Vehículos',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Maquinarias',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => 'V/PMA-MAQ-22-001-05',
                    'nombre_sap' => 'CC250 ADMINISTRACION DE EQUIPOS',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Maquinarias',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => 'V/PMA-MAQ-22-001-06',
                    'nombre_sap' => 'CC251 EQUIPOS SANTIAGO',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Rental',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => 'V/PMA-REN-22-001-04',
                    'nombre_sap' => 'CC881 Operaciones Norte',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Rental',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => 'V/PMA-REN-22-001-05',
                    'nombre_sap' => 'CC882 Operaciones RM',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Rental',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => 'V/PMA-REN-22-001-06',
                    'nombre_sap' => 'CC883 Mantenciones Norte',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Rental',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => 'V/PMA-REN-22-001-07',
                    'nombre_sap' => 'CC884 Mantenciones RM',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Rental',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => 'V/PMA-REN-22-001-16',
                    'nombre_sap' => 'Fletes Norte',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Rental',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => 'V/PMA-REN-22-001-17',
                    'nombre_sap' => 'Fletes RM',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Rental',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => 'V/PMA-REN-22-001-11',
                    'nombre_sap' => 'CC888 Desarrollo Inmobiliario',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Rental',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => 'V/PMA-REN-22-002-01',
                    'nombre_sap' => 'Operación Rental',

                    'estado' => 'ACTIVO',
                ],


                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 2,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'Administración',
                    'sociedad_sap' => 'PMO',
                    'codigo_sap' => '620011',
                    'nombre_sap' => 'CC909 OPERACIONES MONTAJE',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 2,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'Control de Gestión',
                    'sociedad_sap' => 'PMO',
                    'codigo_sap' => '620008',
                    'nombre_sap' => 'CC908 Gerencia Control de Gestión',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 2,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'Estudios',
                    'sociedad_sap' => 'PMO',
                    'codigo_sap' => '620007',
                    'nombre_sap' => 'CC907 Gerencia Estudios',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 2,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'Gerencia General',
                    'sociedad_sap' => 'PMO',
                    'codigo_sap' => '620002',
                    'nombre_sap' => 'CC903 Gerencia General ',

                    'estado' => 'ACTIVO',
                ],

                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 2,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Operaciones Montajes',
                    'sociedad_sap' => 'PMO',
                    'codigo_sap' => 'V/PMO-MON-23-003-01',
                    'nombre_sap' => 'Gestión Compras CMP Huasco',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 2,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Maquinarias',
                    'sociedad_sap' => 'PMO',
                    'codigo_sap' => 'V/PMO-MAQ-23-001-01',
                    'nombre_sap' => 'ADMINISTRACION DE EQUIPOS',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 2,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Operaciones Montajes',
                    'sociedad_sap' => 'PMO',
                    'codigo_sap' => 'V/PMO-MON-21-004-01',
                    'nombre_sap' => 'CC29 QB Misceláneos área Puerto y Pipeline',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 2,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Operaciones Montajes',
                    'sociedad_sap' => 'PMO',
                    'codigo_sap' => 'V/PMO-MON-21-005-01',
                    'nombre_sap' => 'CC34 Proyecto Manto Verde C5003',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 2,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Operaciones Montajes',
                    'sociedad_sap' => 'PMO',
                    'codigo_sap' => 'V/PMO-MON-22-001-01',
                    'nombre_sap' => 'CC915 Profesionales en tránsito (915)',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 2,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Operaciones Montajes',
                    'sociedad_sap' => 'PMO',
                    'codigo_sap' => 'V/PMO-MON-22-004-01',
                    'nombre_sap' => 'CMP Huasco Proyecto CEDRE',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 2,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Operaciones Montajes',
                    'sociedad_sap' => 'PMO',
                    'codigo_sap' => 'V/PMO-MON-22-005-01',
                    'nombre_sap' => 'Anglo American Las Tórtolas II',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 2,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Operaciones Montajes',
                    'sociedad_sap' => 'PMO',
                    'codigo_sap' => 'V/PMO-MON-23-001-01',
                    'nombre_sap' => 'QB Misceláneos II',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 2,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Operaciones Montajes',
                    'sociedad_sap' => 'PMO',
                    'codigo_sap' => 'V/PMO-MON-23-004-01',
                    'nombre_sap' => 'Escondida Extensión Correa CV-030',

                    'estado' => 'ACTIVO',
                ],


                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'Administración',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => '630007',
                    'nombre_sap' => 'CC901 Gastos Generales',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'Administración',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => '630053',
                    'nombre_sap' => 'Gerencia Infraestructura',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'Administración',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => '630004',
                    'nombre_sap' => 'CC904 Gerencia Admin. y Finanzas',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'Control de Gestión',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => '630011',
                    'nombre_sap' => 'CC908 Gerencia Control de Gestión',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'Estudios',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => '630009',
                    'nombre_sap' => 'CC907 Gerencia Estudios I+C',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'Gerencia General',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => '630003',
                    'nombre_sap' => 'CC903 Gerencia General ',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'Habitacional',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => '630058',
                    'nombre_sap' => 'CC890 GAV Habitacional',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'Hotelería',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => '630018',
                    'nombre_sap' => 'CC912 Gerencia Hotelería',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'I+C Modular',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => '630012',
                    'nombre_sap' => 'CC909 Gerencia Operaciones I+C',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'Planta',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => '630022',
                    'nombre_sap' => 'Planta Chacabuco',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'SSOMA',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => '630006',
                    'nombre_sap' => 'CC906 Gerencia SSOMA',

                    'estado' => 'ACTIVO',
                ],
                
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Abastecimiento',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-ABA-22-002-06',
                    'nombre_sap' => 'CC115 Gerencia Abastecimiento',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Abastecimiento',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-ABA-22-002-07',
                    'nombre_sap' => 'CC117 Bodega Central',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Abastecimiento',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-ABA-22-002-05',
                    'nombre_sap' => 'Bodega Limón Verde',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Infraestructura',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-INF-23-001-01',
                    'nombre_sap' => 'Ordenamiento Patio L. Verde',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Infraestructura',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-INF-23-001-02',
                    'nombre_sap' => 'Desmovilizaciones',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Infraestructura',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-INF-23-001-03',
                    'nombre_sap' => 'Gastos Generales Patio Limón Verde',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Hotelería',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-HOT-22-001-01',
                    'nombre_sap' => 'CC386 Hotel Coya',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Hotelería',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-HOT-22-001-02',
                    'nombre_sap' => 'CC225 Hotel Huechún',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Hotelería',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-HOT-22-001-03',
                    'nombre_sap' => 'CC202 Hotel Calama',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Hotelería',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-HOT-22-001-04',
                    'nombre_sap' => 'CC391 Hotel Mejillones',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Hotelería',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-HOT-22-001-05',
                    'nombre_sap' => 'CC563 Hotel Colbún',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Hotelería',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-HOT-22-001-06',
                    'nombre_sap' => 'Campamento Pionero Aguas Verdes',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Hotelería',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-HOT-22-005-01',
                    'nombre_sap' => 'CC107 Administración Hoteles',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Hotelería',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-HOT-21-001-10',
                    'nombre_sap' => 'CC427 Arriendo Inf. Camp MV+6to',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'I+C Modular',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-MOD-22-002-01',
                    'nombre_sap' => 'CC915 Profesionales en tránsito',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'I+C Modular',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-MOD-22-002-05',
                    'nombre_sap' => 'Supply Chain',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'I+C Modular',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-MOD-22-007-01',
                    'nombre_sap' => 'Const. y Montaje Pabellones DRT',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'I+C Modular',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-MOD-23-001-01',
                    'nombre_sap' => 'Kit Montajes y Fundaciones (INVERSIÓN)',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'I+C Modular',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-MOD-23-002-01',
                    'nombre_sap' => 'Campamento Engie',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Maquinarias',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-MAQ-22-001-01',
                    'nombre_sap' => 'CC250 ADMINISTRACION DE EQUIPOS',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Planta',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-FAB-22-001-11',
                    'nombre_sap' => 'CC888 Desarrollo Inmobiliario',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Planta',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-FAB-22-001-12',
                    'nombre_sap' => 'Fabricación Pabellones Codelco Chuqui',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Planta',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-FAB-22-003-01',
                    'nombre_sap' => 'CC114 Gerencia Producción',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Planta',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-FAB-22-003-04',
                    'nombre_sap' => 'Gastos Generales Planta',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 4,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Transportes',
                    'sociedad_sap' => 'PTR',
                    'codigo_sap' => 'V/PTR-TRA-22-001-03',
                    'nombre_sap' => 'CC322 Operaciones Transportes',

                    'estado' => 'ACTIVO',
                ],
                //TRASPORTE

                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'Administración',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => '630062',
                    'nombre_sap' => 'Supply Chain',

                    'estado' => 'ACTIVO',
                ],

                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'I+C Modular',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-MOD-23-002-05',
                    'nombre_sap' => 'Equipamiento Engie',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'I+C Modular',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-MOD-23-002-06',
                    'nombre_sap' => 'Mantención Equipos Engie',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Hotelería',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-HOT-23-002-01',
                    'nombre_sap' => 'Arriendo Inf. Engie',

                    'estado' => 'ACTIVO',
                ],
                
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'Infraestructura',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => '610025',
                    'nombre_sap' => 'Operación Infraestructura Norte',

                    'estado' => 'ACTIVO',
                ],

                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Infraestructura',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => 'V/PMA-INF-23-001-01',
                    'nombre_sap' => 'Mantención Rental N',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Infraestructura',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => 'V/PMA-INF-23-001-02',
                    'nombre_sap' => 'Reparación Rental N',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Infraestructura',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => 'V/PMA-INF-23-001-03',
                    'nombre_sap' => 'Modificación Rental N',

                    'estado' => 'ACTIVO',
                ],

                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'Infraestructura',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => '610024',
                    'nombre_sap' => 'Operación Infraestructura RM',

                    'estado' => 'ACTIVO',
                ],

                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Infraestructura',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => 'V/PMA-INF-23-002-01',
                    'nombre_sap' => 'Mantención Rental RM',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Infraestructura',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => 'V/PMA-INF-23-002-02',
                    'nombre_sap' => 'Reparación Rental RM',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 3,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Infraestructura',
                    'sociedad_sap' => 'PMA',
                    'codigo_sap' => 'V/PMA-INF-23-002-03',
                    'nombre_sap' => 'Modificación Rental RM',

                    'estado' => 'ACTIVO',
                ],

                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 2,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Operaciones Montajes',
                    'sociedad_sap' => 'PMO',
                    'codigo_sap' => 'V/PMO-MON-23-005-01',
                    'nombre_sap' => 'CMP Reparación Molino El Romeral',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'Infraestructura',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => '630063',
                    'nombre_sap' => 'Operación Infraestructura Norte ',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'CECO',
                    'area' => 'Infraestructura',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => '630064',
                    'nombre_sap' => 'Operación Infraestructura RM',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Planta',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-FAB-23-003-01',
                    'nombre_sap' => 'Fabricación Láscar',

                    'estado' => 'ACTIVO',
                ],
                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 1,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'I+C Modular',
                    'sociedad_sap' => 'PSE',
                    'codigo_sap' => 'V/PSE-MOD-23-003-01',
                    'nombre_sap' => 'IIFF Láscar',

                    'estado' => 'ACTIVO',
                ],

                [
                    'nombre' => 'Nombre',
                    'empresa_id' => 2,

                    'centro_costo' => 'centro_costos',

                    'objeto_imputacion' => 'PEP',
                    'area' => 'Operaciones Montajes',
                    'sociedad_sap' => 'PMO',
                    'codigo_sap' => 'V/PMO-MON-22-006-01',
                    'nombre_sap' => 'Proyecto Rajo Inca',

                    'estado' => 'ACTIVO',
                ],
                
            ]);
        }

    }
}
