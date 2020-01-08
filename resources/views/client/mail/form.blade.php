@extends('client.layouts.main')
@section('content')
    <table>
        <thead>
            <tr>
                <th>Course</th>
                <th>Member</th>
            </tr>
        </thead>
        <tbody>
        {{-- @foreach($data as $course)
            <tr>
                <td>{{ $course->name }}</td>
                <td>{{ $course->name }}</td>
            </tr>
        @endforeach --}}
        </tbody>
    </table>
@endsection
