@php
    function sumTable ($stock, $slug) {
        $sum = 0;
        foreach($stock['locations'] as $loc) {
            $area = null;

            foreach($loc['areas'] as $as) {
                if ($as['slug'] == $slug) $area = $as;
            }

            if ($area) $sum += $area['quantity'];
        }
        return $sum;
    }
@endphp

<table>
    <thead>
        <tr>
            <th colspan="3"></th>
            <th colspan="{{ count($stock['areas']) * 2 }}" style="text-align: center">{{ $title }}</th>
            <th colspan="2"></th>
        </tr>
        <tr>
            <th colspan="{{ 3 +(count($stock['areas']) * 2) + 2 }}">Producto: {{ $productName }}</th>
        </tr>
        <tr>
            <th colspan="3"></th>
            @foreach($stock['areas'] as $area)
            <th colspan="2">{{ $area['name'] }}</th>
            @endforeach
            <th colspan="2">TOTAL</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stock['locations'] as $loc)
        <tr>
            <th colspan="3">{{ $loc['name'] }}</th>
            @foreach($loc['areas'] as $ar)
            <td colspan="2">{{ $ar['quantity'] }}</td>
            @endforeach
            <th colspan="2">{{ $loc['total'] }}</th>
        </tr>
        @endforeach
        <tr>
            <th colspan="3">TOTAL</th>
            @foreach($stock['areas'] as $as)
            <td colspan="2">{{ sumTable($stock, $as['slug']) }}</td>
            @endforeach
            <th colspan="2">{{ $stock['total_stock'] }}</th>
        </tr>
    </tbody>
</table>