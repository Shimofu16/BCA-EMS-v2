<x-mail::message>
<h1 class="text-center text-success">Verification Success</h1>
<p>Hello, {{ $data['name'] }}!</p>
    
<p>Thank you for verifying your email. Your email has been successfully verified. You will receive a confirmation email about your enrollment shortly, so please be sure to check your inbox.</p>
    
<p>Thanks, {{ config('app.name') }}</p>
</x-mail::message>
