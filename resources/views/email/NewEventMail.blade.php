@component('mail::message')
# New Event

New Event Just Came.

@component('mail::button', ['url' => config('app.url')])
See Event
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
