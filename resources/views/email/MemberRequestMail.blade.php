@component('mail::message')
# Member Request Accepted

Your Member Request Just Accepted.Please Login Now...

@component('mail::button', ['url' => config('app.url').'/login'])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
