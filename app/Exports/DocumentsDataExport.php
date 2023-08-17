<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use App\Models\Documentos;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DocumentsDataExport implements FromView,ShouldAutoSize
{
    use Exportable;

    private $documentos;
    private $documentos_sucursal;
    private $nombre;

    public function __construct($documentos, $documentos_sucursal, $nombre){
        $this->documentos = $documentos;
        $this->documentos_sucursal = $documentos_sucursal;
        $this->nombre = $nombre;
    }

    public function view() : View
    {
        return view('documentos.doc_details', [
            'documentos' => $this->documentos,
            'documentos_sucursal' => $this->documentos_sucursal,
            'nombre' => $this->nombre,
        ]);
    }


}
