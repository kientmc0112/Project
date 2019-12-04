{{-- <table class="table table-striped table-schedule">
    <thead>
        <tr class="bg-theme-colored">
            <th>Name</th>
            <th>Begin</th>
            <th>End</th>
        </tr>
    </thead>
    <tbody>
    @foreach($tasks as $task)
        @foreach($task->users as $user)
            @if($user->id == Auth::User()->id)
            <tr>
                <td>{{ $task->name }}</td>
                <td><strong>{{ $user->pivot->created_at }}</strong></td>
                <td>{{ $user->pivot->updated_at }}</td>
            </tr>
            @endif
        @endforeach
    @endforeach
    </tbody>
</table>
 --}}
<table>
    <pre>
    @php
        print_r($tasks)
    @endphp
    </pre>
    @foreach($tasks as $task)
        @foreach($task->users as $user)
            @if($user->id == Auth::User()->id)
                <p>{{ $task->name }} start at <strong>{{ $user->pivot->created_at }}</strong></p>
                <p>{{ $task->name }} complete at <strong>{{ $user->pivot->updated_at }}</strong></p>
            </tr>
            @endif
        @endforeach
    @endforeach
</div>
