{{-- blade-formatter-disable --}}
@component('mail::message')

@if ($user->is_activated == false)
Dear {{ $user->name }}, <br> <br>
Thank you for waiting. Your account is now reactivated. You can now use your {{ config('app.name') }} Account to access our application.
@endif

@if ($user->is_activated == true)
Dear {{ $user->name }}, <br> <br>
Unfortunatetly there are circumstances that you did not totally comply and the administrator chooses to deactivate
your {{ config('app.name') }} Account. Any Questions? you can email us at {{ config('mail.from.address') }}
@endif

@component('mail::button', ['url' => $url, 'color' => 'primary'])
Redirect
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent




