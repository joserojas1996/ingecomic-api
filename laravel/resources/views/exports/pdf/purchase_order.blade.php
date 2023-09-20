<html>

<head>
    <meta charset=”UTF-8”>
    <title>Orden de Compra</title>

    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        body {
            margin: 4.5cm 2cm 2cm;
        }

        header {
            position: fixed;
            top: 1.2cm;
            left: 1.2cm;
            right: 0cm;
            height: 2cm;
            text-align: center;
            line-height: 30px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            text-align: center;
            line-height: 35px;
        }

        .page-break {
            page-break-after: always;
        }

        .logo {
            background-image: url("https://s3.amazonaws.com/dev.intranet.colegiosantajoaquina.cl/2/2021-03-16-2y10yezaxpqoviezdw35fe6sef5oiulv1wyvwkdmam8jyxmnbwdwdtu.png");
            background-repeat: no-repeat;
            background-size: 100%;
            width: 240px;
            height: 295px;
            display: block;
            margin: auto;
        }

        .f-12 {
            font-size: 12px;
        }

        .title {
            text-align: center;
            margin-bottom: 0.8rem;
            border-bottom: #00135c 2px solid;
        }

        .title>h3 {
            margin-bottom: 0.6rem !important;
        }

        .content-table {
            margin-bottom: 2rem;
        }


        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead>tr:first-child {
            font-size: 13px;
            background-color: #c9cbc3;
        }

        thead>tr:last-child {
            font-size: 14px;
            text-transform: capitalize;
        }

        tr>td:first-child {
            color: black;
            font-weight: bold;
        }

        td {
            border: 1px solid black;
            font-size: 13px;
        }

    </style>
</head>

<body>
    <header>
        <div class="logo"></div>
    </header>

    <main>
        <div class="title">
            <h3>Orden de compra {{ $po->correlative_number }}</h3>
        </div>

        <div class="content-table">
            <table style="border: 1px solid;" cellpadding="8px" cellspacing="5px">
                <thead>
                    <tr>
                        <th colspan="2">DATOS ORDEN DE COMPRA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Razón Social: </td>
                        <td class="f-12">FUNDACIÓN EDUCACIONAL COLEGIO SANTA JOAQUINA DE VEDRUNA</td>
                    </tr>
                    <tr>
                        <td>Dirección: </td>
                        <td class="f-12">PROFESOR ALCAINO 0246</td>
                    </tr>
                    <tr>
                        <td>Región: </td>
                        <td>Región Metropolitana de Santiago</td>
                    </tr>
                    <tr>
                        <td>Comuna: </td>
                        <td>Puente Alto</td>
                    </tr>
                    <tr>
                        <td>RUT: </td>
                        <td>65.755.900-8</td>
                    </tr>
                    <tr>
                        <td>Giro: </td>
                        <td>Educación</td>
                    </tr>
                    <tr>
                        <td>Teléfono: </td>
                        <td>2-28500291</td>
                    </tr>
                    <tr>
                        <td>E-mail Sostenedor:</td>
                        <td>s.rojas@colegiosantajoaquina.cl</td>
                    </tr>
                    <tr>
                        <td>E-mail recepción factura: </td>
                        <td>p.plaza@colegiosantajoaquina.cl</td>
                    </tr>
                    <tr>
                        <td>Fecha: </td>
                        <td>{{ $po->created_at->format('d/m/Y') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="content-table">
            <table style="border: 1px solid;" cellpadding="8px" cellspacing="5px">
                <thead>
                    <tr>
                        <th colspan="2">DATOS PROVEEDOR</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($provider)
                        <tr>
                            <td>Razón Social: </td>
                            <td class="f-12">{{ $provider->fantasy_name }}</td>
                        </tr>
                        <tr>
                            <td>Dirección: </td>
                            <td class="f-12">{{ $provider->address }}</td>
                        </tr>
                        <tr>
                            <td>Región: </td>
                            <td>{{ $provider->comuna->region->name }}</td>
                        </tr>
                        <tr>
                            <td>Comuna: </td>
                            <td>{{ $provider->comuna->name }}</td>
                        </tr>
                        <tr>
                            <td>RUT: </td>
                            <td>{{ $provider->rut }}</td>
                        </tr>
                        <tr>
                            <td>Giro: </td>
                            <td>{{ $provider->gire }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="2">LA ORDEN DE COMPRA NO POSEE UN PROVEEDOR</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="content-table">
            <table style="border: 1px solid;" cellpadding="8px" cellspacing="5px">
                <thead>
                    <tr>
                        <th colspan="3">RESUMEN ORDEN DE COMPRA</th>
                    </tr>
                    <tr>
                        <th width="130px">SKU</th>
                        <th>Nombre</th>
                        <th width="100px">Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($po->products as $product)
                        <tr>
                            <td>{{ $product->sku }}</td>
                            <td>{{ $product->name }}</td>
                            <td style="text-align: right;">{{ $product->pivot->quantity }}</td>
                        </tr>
                        @php
                            $total += $product->pivot->quantity;
                        @endphp
                    @endforeach
                    <tr style="text-align: right;">
                        <td colspan="2" style="text-transform:uppercase">Total Orden de Compra</td>
                        <td>{{ $total }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- <div class="page-break"></div> -->

        <div class="content-table">
            <table style="border: 1px solid;" cellpadding="8px" cellspacing="5px">
                <thead>
                    <tr>
                        <th>
                            TÉRMINOS Y CONDICIONES
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <p>{{ $po->terms }}</p>
                            <!-- <p style="text-align: justify;">
                                Colegio Santa Joaquina de Vedruna se reserva el derecho de anular esta orden de compra en caso de existir diferencias entre la matrícula real del colegio y el número de alumnos
                                inscritos.
                            </p>
                            <p>
                                La entrega de productos y claves de acceso está condicionada a los correspondientes pagos.
                            </p> -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <footer>
        <h5>Ante cualquier consulta, no dude en contactarnos a través de nuestro correo.</h5>
    </footer>
</body>

</html>
