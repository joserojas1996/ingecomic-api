<table>
    <thead>
        <tr>
            <th colspan="6"></th>
            <th colspan="7" style="text-align: center">Stock de Productos por Ubicaciones y Áreas</th>
            <th colspan="6"></th>
        </tr>
        <tr>
            <th colspan="19"></th>
        </tr>
        <tr>
            <th colspan="2">SKU</th>
            <th colspan="2">Marca</th>
            <th colspan="4">Nombre</th>
            <th colspan="2">Modelo</th>
            <th colspan="2">Color</th>
            <th colspan="3">Ubicación</th>
            <th colspan="2">Área</th>
            <th colspan="2">Stock Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stock as $st)
        <tr>
            <td colspan="2">{{ $st['sku'] }}</td>
            <td colspan="2">{{ $st['marca'] }}</td>
            <td colspan="4">{{ $st['name'] }}</td>
            <td colspan="2">{{ getAtt($st['attributes'], "model") }}</td>
            <td colspan="2">{{ getAtt($st['attributes'], "color") }}</td>
            <td colspan="3">{{ $st['location'] }}</td>
            <td colspan="2">{{ $st['area'] }}</td>
            <td colspan="2">{{ $st['balance'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>