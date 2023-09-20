<table>
    <thead>
        <tr>
            <th colspan="5"></th>
            <th colspan="4" style="text-align: center">Stock de Productos por {{ $type == 'locations' ? 'Ubicaciones' : 'Áreas' }}</th>
            <th colspan="5"></th>
        </tr>
        <tr>
            <th colspan="14"></th>
        </tr>
        <tr>
            <th colspan="2" bgcolor="#92c7c5">SKU</th>
            <th colspan="2" bgcolor="#92c7c5">Marca</th>
            <th colspan="4" bgcolor="#92c7c5">Nombre</th>
            <th colspan="2" bgcolor="#92c7c5">Modelo</th>
            <th colspan="2" bgcolor="#92c7c5">Color</th>

            @foreach($$type as $item)
            <th colspan="3" bgcolor="#a6c792">{{ $item->name }}</th>
            @endforeach
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

            @foreach($st['items'] as $it)
            <td colspan="3">{{ $it['quantity'] }}</td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>