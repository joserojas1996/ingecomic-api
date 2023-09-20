<table>
    <thead>
        <tr>
            <th colspan="{{ !$type? '8' : '7' }}"></th>
            <th colspan="5" style="text-align: center">{{ $title }}</th>
            <th colspan="8"></th>
        </tr>
        <tr>
            <th colspan="21">Producto: {{ $productName }}</th>
        </tr>
        <tr>
            @if (!$type)
            <th style="text-align: center">Tipo</th>
            @endif
            <th colspan="2" style="text-align: center">Cantidad</th>
            <th colspan="2" style="text-align: center">Balance</th>
            <th colspan="2" style="text-align: center">Stock Total</th>
            <th colspan="3" style="text-align: center">Ubicación</th>
            <th colspan="3" style="text-align: center">Área</th>
            <th colspan="3" style="text-align: center">Fecha</th>
            <th colspan="5" style="text-align: center">Descripción</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productStock as $stock)
        <tr>
            @if (!$type)
            <td>{{ $stock->type_name }}</td>
            @endif
            <td colspan="2">{{ $stock->quantity }}</td>
            <td colspan="2">{{ $stock->balance }}</td>
            <td colspan="2">{{ $stock->total_stock }}</td>
            <td colspan="3">{{ $stock->location->name }}</td>
            <td colspan="3">{{ $stock->area->name }}</td>
            <td colspan="3">{{ \Carbon\Carbon::parse($stock->created_at)->format('d/m/Y g:i A') }}</td>
            <td colspan="5">{{ $stock->description }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td rowspan="2" colspan="{{ !$type? '16' : '15' }}"></td>
            <td rowspan="2" colspan="5">TOTAL DE OPERACIONES: {{ $productStock->count() }}</td>
        </tr>
    </tfoot>
</table>