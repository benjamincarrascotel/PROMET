<div>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>activo_id</th>
                <th>proyecto_id</th>
                <th>monto</th>
                <th>tipo_moneda</th>
                <th>fecha_inicio</th>
                <th>fecha_termino</th>
                <th>encargado</th>
                <th>estado</th>
                <th>observaciones</th>
                <th>tipo_proceso</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $proceso)
            <tr>
                <td>{{ $proceso['id'] }}</td>
                <td>{{ $proceso['activo_id'] }}</td>
                <td>{{ $proceso['proyecto_id'] }}</td>
                @if(isset($proceso['monto']))
                    <td>{{ $proceso['monto'] }}</td>
                @else
                    <td>{{ $proceso['precio_venta'] }}</td>
                @endif
                <td>{{ $proceso['tipo_moneda'] }}</td>
                <td>{{ \Carbon\Carbon::parse($proceso['fecha_inicio'])->format('d-m-Y') }}</td>
                @if($proceso['fecha_termino'])
                    <td>{{ \Carbon\Carbon::parse($proceso['fecha_termino'])->format('d-m-Y') }}</td>
                @else
                    <td></td>
                @endif
                <td>{{ $proceso['encargado'] }}</td>
                <td>{{ $proceso['estado'] }}</td>
                <td>{{ $proceso['observaciones'] }}</td>
                <td>{{ $proceso['tipo_proceso'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
