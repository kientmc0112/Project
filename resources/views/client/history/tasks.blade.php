{{-- <table class="table table-striped table-schedule">
    <thead>
        <tr class="bg-theme-colored">
            <th>Time</th>
            <th>Event</th>
        </tr>
    </thead>
    <tbody>
     @foreach($tasksHistory as $task)
        @foreach($tasksSubject as $taskSub)
            @if($task['task_id'] == $taskSub->id)
                <tr>
                    <td>{{ $task['date'] }}</td>
                    <td>{{ $task['content'] }}</td>
                </tr>
            @endif
        @endforeach
    @endforeach
    </tbody>
</table> --}}

<table class="table table-striped table-schedule">
    {{-- <pre>
    @php
        print_r($tasksHistory)
    @endphp
    </pre> --}}
    <thead>
        <tr class="bg-theme-colored">
            <th>Date</th>
            <th>Time</th>
            <th>Event</th>
        </tr>
    </thead>
    <tbody>
    @foreach($tasksHistory as $task)
        @foreach($tasksSubject as $taskSub)
            @if($task['task_id'] == $taskSub->id)
            <tr>
                <td><strong>{{ substr($task['date'], 0, 10) }}</strong></td>
                <td><em>{{ substr($task['date'], 11, 8) }}</em></td>
                <td>{{ $task['content'] }}</td>
            </tr>
            @endif
        @endforeach
    @endforeach
    </tbody>
</table>

