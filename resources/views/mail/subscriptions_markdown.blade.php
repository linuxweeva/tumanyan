@component('mail::message')
# @lang('email.team.greeting')

<br>
{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}
@endforeach


@lang('email.wish')
@endcomponent