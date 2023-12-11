<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProcesosExport implements FromCollection, WithHeadings
{
    protected $parameter;

    public function __construct($parameter)
    {
        $this->parameter = $parameter;
    }

    public function collection()
    {
        return $this->parameter;
    }

    public function headings(): array
    {
        // Define your column names here
        return ['id', 'activo_id', 'proyecto_id', 'monto', 'tipo_moneda', 'fecha_inicio', 'fecha_termino', 'encargado', 'estado', 'observaciones', 'tipo_proceso'];
    }
}
