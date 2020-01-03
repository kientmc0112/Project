@component('mail::message')
# Introduction

Your course.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/courses', 'color' => 'success'])
Go to your course
@endcomponent

Thanks,<br>
@endcomponent
