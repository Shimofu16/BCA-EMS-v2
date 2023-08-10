<x-mail::message>
<p>Hello, {{ $data['name'] }}</p>

<p>Thank you for completing the enrollment process. To confirm your email address, simply click the button below.</p>

<x-mail::button :url="$url">
Verify email
</x-mail::button>

<p>Thanks, {{ config('app.name') }}</p>
</x-mail::message>
