@component('mail::message')
<p>Hello, {{ $data['name'] }}</p>

<p>Thank you for completing the enrollment process. To confirm your email address, simply click the button below.</p>
    {{--  button for verifying the students email  --}}
@component('mail::button', ['url' => $url, 'color' => 'primary'])
        Verify
@endcomponent
<p>Thanks, {{ config('app.name') }}</p>
@endcomponent
