@component('mail::message')
# FTMS,

All courses:
@component('mail::table')
    |Course               |Member                         |
    |---------------------|-------------------------------|
    @foreach($data as $course)
    | {{ $course->name }} | {{ $course->users->count() }} |
    @endforeach
@endcomponent

@component('mail::button', ['url' => 'http://127.0.0.1:8000', 'color' => 'success'])
Go to the website
@endcomponent

Thanks!<br>
@endcomponent


