@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
# Error en envio!
@else
# Personeria de Bogota!
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
<!--Regards,<br>{{ config('app.name') }}-->
@endif

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
Línea de Atención 24 horas Teléfono: 143 o Teléfonos: +57(1)382 0450, +57(1)382 0480.<br><a href='http://www.personeriabogota.gov.co' target='_blank'>www.personeriabogota.gov.co</a>
@endcomponent
@endisset
@endcomponent
