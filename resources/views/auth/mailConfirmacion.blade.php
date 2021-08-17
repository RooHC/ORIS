@component('mail::message')
# Validar usuario como profesor

Le confirmamos que su usuario {{$name}} ya tiene disponible los permisos de profesor con los datos: <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-Nombre: {{$name}} <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-Email: {{$email}}

@component('mail::button', ['url' => 'http://localhost/ORIS/public/'])
Acceder
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent