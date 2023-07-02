@component('mail::message')
    {{-- student name --}}
<p>Dear, {{ $data['name'] }}!</p>

<p>This is a friendly reminder that you have a payment due on {{ date('F d, Y',strtotime($data['date'])) }}.<br>Thank you for your attention to this matter.</p>
<p>Thanks, {{ config('app.name') }}</p>
@endcomponent
