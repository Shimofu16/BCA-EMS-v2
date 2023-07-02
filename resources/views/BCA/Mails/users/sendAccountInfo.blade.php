@component('mail::message')
    @if (!$data['isFaculty'])
        Here`s your Student Id and Password
        Student Id: {{ $data['email'] }}
        Password: {{ $data['password'] }}
    @endif
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
