@php
    function getAtt($attrs, $at) {
        $at_t = $at == 'model' ? "modelo" : $at;
        if ($attrs) {
            $attr = $attrs->filter(function ($a) use ($at) {
                return $a->attr == $at;
            })->values();
            return $attr->count() > 0 ? $attr[0]->value : "Sin {$at_t}";
        } else return "Sin {$at_t}";
    }
@endphp
<table>
    <thead>
        <tr>
            <th colspan="5"></th>
            <th colspan="4" style="text-align: center">Stock de Productos</th>
            <th colspan="5"></th>
        </tr>
        <tr>
            <th colspan="14"></th>
        </tr>
        <tr>
            <th colspan="2">SKU</th>
            <th colspan="2">Marca</th>
            <th colspan="4">Nombre</th>
            <th colspan="2">Modelo</th>
            <th colspan="2">Color</th>
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
            <td colspan="2">{{ $st['balance'] }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td rowspan="2" colspan="10"></td>
            <td rowspan="2" colspan="4">TOTAL DE PRODUCTOS: {{ $stock->count() }}</td>
        </tr>
    </tfoot>
</table>