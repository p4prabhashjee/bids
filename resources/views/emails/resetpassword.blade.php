@component('mail::message')
# Reset Your Password

Here is your OTP: {{ $otp }}

If you did not request a password reset, no further action is required.

Thanks,
{{ config('app.name') }}
@endcomponent
