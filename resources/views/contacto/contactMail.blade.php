@component('mail::message')
# Mensaje de contacto

-Nombre: {{$name}} <br>
-Email: {{$email}} <br>
-Mensaje: {{$comment}}

Gracias,<br>
{{ config('app.name') }}
@endcomponent