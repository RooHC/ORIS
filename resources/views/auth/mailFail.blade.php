@component('mail::message')
# Validar usuario como profesor

Le comunicamos que desafortunadamente su su usuario {{$name}} no ha podido ser dado de alta como profesor. <br>
Para cualquier tipo de duda responda a este mensaje.

Gracias,<br>
{{ config('app.name') }}
@endcomponent