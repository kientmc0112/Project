<div class="single-service">
    <img src="" alt="">
    <h3 class="text-theme-colored">{{ $subject->name }}</h3>
    <p>{{ $subject->description }}</p>
    <br>
    @foreach($subject->users as $user)
        @if(Auth::User()->id == $user->id)
            <h4 class="line-bottom mt-20 mb-20 text-theme-colored">{{ __('All Task') }}</h4>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="small">
                    <table class="table table-bordered">
                        <tr>
                            <td class="text-center font-16 font-weight-600 bg-theme-color-2 text-white" colspan="4">{{ __('All Task') }}</td>
                        </tr>
                        <tr>
                            <th class="col-xs-1">{{ __('Name') }}</th>
                            <th>{{ __('Content') }}</th>
                            <th class="col-xs-1">{{ __('Status') }}</th>
                            <th class="col-xs-1">{{ __('Comment') }}</th>
                        </tr>
                        <tbody>
                            @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->name }}</td>
                                <td>{{ $task->description }}</td>
                                <td>
                                @php $status = 0 @endphp
                                @foreach($task->users as $user)
                                    @if(Auth::User()->id == $user->pivot->user_id)
                                        @if($user->pivot->status == 1)
                                            <a id="{{ $task->id }}" onclick="showReport(this.id, {{ Auth::User()->id }})" data-toggle="modal" data-target="#modal{{ $task->id }}" class="btn btn-success text-center" style="width: 100%">{{ __('Completed') }}</a>
                                            @php $status = 1 @endphp
                                        @elseif($user->pivot->status == 0)
                                            <a id="{{ $task->id }}" onclick="showReport(this.id, {{ Auth::User()->id }})" data-toggle="modal" data-target="#modal{{ $task->id }}" class="btn btn-warning text-center" style="width: 100%">{{ __('Report') }}</a>
                                            @php $status = 1 @endphp
                                        @endif
                                        <div class="modal fade" id="modal{{ $task->id }}">
                                            <div class="modal-dialog bg-white widget border-1px p-30">
                                                <h5 class="widget-title line-bottom">{{ __('Report') }}</h5>
                                                <form id="quick_contact_form" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <textarea name="report" id="report{{ $task->id }}" class="form-control" rows="3"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="button" data-dismiss="modal" class="btn btn-dark btn-theme-colored btn-sm mt-0">{{ __('Close') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                @if($status == 0)
                                    <a id="task{{ $task->id }}" data-toggle="modal" data-target="#modal{{ $task->id }}" class="btn btn-info text-center" style="width: 100%">{{ __('Report') }}</a>
                                    <div class="modal fade" id="modal{{ $task->id }}">
                                        <div class="modal-dialog bg-white widget border-1px p-30">
                                            <h5 class="widget-title line-bottom">{{ __('Report') }}</h5>
                                            <form method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <textarea name="report" class="form-control" id="report{{ $task->id }}" required placeholder="Enter report ..." rows="3"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <button id="{{ $task->id }}" type="button" class="btn btn-dark btn-theme-colored btn-sm mt-0" onclick="sendReport(this.id, {{ Auth::User()->id }})">{{ __('Send') }}</button>
                                                    <button id="{{ $task->id }}" type="submit" data-dismiss="modal" class="btn btn-dark btn-theme-colored btn-sm mt-0">{{ __('Close') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                                </td>
                                <td><a class="btn btn-success">{{ __('Comment') }}</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    @endforeach
</div>
<script type="text/javascript">
    function sendReport(task_id, user_id) {
        var report = "#report" + task_id;
        var task = '#task' + task_id;
        var btnSend = '#' + task_id;
        var report = $("#report").val();
        $.ajax({
            type: 'POST',
            url: '/report/store',
            data: {
                user_id: user_id,
                task_id: task_id,
                report: report,
            },
            success: function (response) {
                $(task).removeClass('btn-info');
                $(task).addClass('btn-warning');
                $(report).val(report);
                $(btnSend).remove();
            },
            error: function(e) {
                alert("Error!");
            }
        });
    }

    function showReport(task_id, user_id) {
        var report = "#report" + task_id;
        var task = "#" + task_id;
        $.ajax({
            type: 'POST',
            url: '/report/show',
            data: {
                user_id: user_id,
                task_id: task_id,
            },
            success: function (response) {
                $(report).val(response.report[0].report);
            },
            error: function(e) {
                alert("Error! Please refresh");
            }
        });
    }
</script>

