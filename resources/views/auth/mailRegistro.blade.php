@component('mail::message')
# Validar usuario como profesor

El usuario {{$name}} solicita permisos de profesor con los datos: <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-Nombre: {{$name}} <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-Email: {{$email}}

@component('mail::button', ['url' => 'http://localhost/ORIS/public/login/profesor/'. $name . '/' . $email . '/' . $id, 'color'=>'success'])
Conceder
@endcomponent

@component('mail::button', ['url' => 'http://localhost/ORIS/public/login/fail/'. $name . '/' . $email, 'color'=>'error'])
No conceder
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
