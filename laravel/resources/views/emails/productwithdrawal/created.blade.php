@component('mail::message')
<h1 style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';color:#3d4852;font-size:18px;font-weight:bold;margin-top:0;text-align:left">
    ¡Saludos!
</h1>
<p style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
    Una nueva solicitud de retiro de producto ha sido creada.
</p>

@component('mail::button', ['url' => $url])
Gestiona las solicitudes
@endcomponent

¡Gracias!,<br>
{{ config('app.name') }}
<hr>

Si tiene problemas al dar click sobre el botón "Registrate" , copia y pega la siguiente URL en la barra de navegación: {{$url}}
@endcomponent