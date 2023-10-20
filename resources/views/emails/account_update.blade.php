{{-- blade-formatter-disable --}}
@component('mail::message')
# Account Update

@if ($option == 'activate')
Dear {{ $user->name }}, <br> <br>
Thank you for waiting. Your account is now reactivated. You can now use your ISKOOL Account to access our application.
@endif

@if ($option == 'deactivate')
Dear {{ $user->name }}, <br> <br>
Unfortunatetly there are circumstances that you did not totally comply and the administrator choses to deactivate
your ISKOOL Account. Further Questions? you can email us at iskool.pup@gmail.com
@endif

@component('mail::button', ['url' => $url, 'color' => 'primary'])
Redirect
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
