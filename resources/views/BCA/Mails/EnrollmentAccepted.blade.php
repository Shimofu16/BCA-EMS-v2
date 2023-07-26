<x-mail::message>
<h1 class="text-center text-success">Enrollment Success</h1>

<p>Hello, {{ $data['name'] }}!</p>

<p>Good day! Thank you for enrolling in Breakthrough Christian Academy. We are excited to have you join us this school year.</p>
@if (!$data['isOld'])
<p>
Here is your password and student Id. Please remember to keep this email secure and do not share your password
with
anybody.<br>
Student Id : {{ $data['student_id'] }} <br>
Password : {{ $data['password'] }}<br>
</p>
@endif
<p>Thanks, {{ config('app.name') }}</p>
</x-mail::message>
