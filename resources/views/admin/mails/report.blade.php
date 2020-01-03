@component('mail::message')
<b> Trainner : </b>{{ $user->name }} <br>
<b> Mail Trainner : </b>{{ $user->email }} <br>
<b> Content : </b>{{ $comment }} <br>

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
