@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# Hola Estimado/a
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
Recibió este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
Restablecer contraseña
@endcomponent
@endisset

{{-- Outro Lines --}}
{{-- @foreach ($outroLines as $line) --}}
Este enlace de restablecimiento de contraseña caducará en 60 minutos.

Si no solicitó un restablecimiento de contraseña, no se requiere ninguna otra acción.
{{-- @endforeach --}}

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Saludos'),<br>
Midas Chile
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "Si tiene problemas para hacer clic en el botón \"Restablecer contraseña\", copie y pegue la URL a continuación en su navegador web\n".
    '[:actionURL](:actionURL)',
    [
        'actionText' => $actionText,
        'actionURL' => $actionUrl,
    ]
)
@endslot
@endisset
@endcomponent

