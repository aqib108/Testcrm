@component('mail::message')
# Welcome {{$name}}
This mail is sent using Mailtrap.
Thanks,
{{ config('app.name') }}
@endcomponent