<div class="single-service">
    <img src="" alt="">
    <h3 class="text-theme-colored">{{ $subject->name }}</h3>
    <p>{{ $subject->description }}</p>
    <br>
    {{-- @if($permiss == 1) --}}
    @if($permiss->first()->status == 1)
        @foreach($subject->users as $user)
            @if(Auth::User()->id == $user->id)
                <p>Complete: {{ $user->pivot->process . '/' . $subject->tasks->count() }}</p>
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
                                                <button id="task{{ $task->id }}" data-toggle="modal" data-target="#modal{{ $task->id }}" class="btn btn-success text-center btn-report">{{ __('Completed') }}</button>
                                                @php $status = 1 @endphp
                                            @elseif($user->pivot->status == 0)
                                                <button id="task{{ $task->id }}" data-toggle="modal" data-target="#modal{{ $task->id }}" class="btn btn-warning text-center btn-report">{{ __('Waiting') }}</button>
                                                @php $status = 1 @endphp
                                            @endif
                                            <div class="modal fade" id="modal{{ $task->id }}">
                                                <div class="modal-dialog bg-white widget border-1px p-30">
                                                    <h5 class="widget-title line-bottom">{{ __('Report') }}</h5>
                                                    <form method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <textarea name="report" id="report{{ $task->id }}" class="form-control" rows="3"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <a type="button" data-dismiss="modal" class="btn btn-dark btn-theme-colored btn-sm mt-0">{{ __('Close') }}</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    @if($status == 0)
                                        <a id="btn{{ $task->id }}" data-toggle="modal" data-target="#modal{{ $task->id }}" class="btn btn-info text-center btn-report">{{ __('Report') }}</a>
                                        <div class="modal fade" id="modal{{ $task->id }}">
                                            <div class="modal-dialog bg-white widget border-1px p-30">
                                                <h5 class="widget-title line-bottom">{{ __('Report') }}</h5>
                                                <form class="formReport">
                                                    @csrf
                                                    <div class="form-group">
                                                        <textarea name="report" class="form-control" id="report{{ $task->id }}" required placeholder="Enter report ..." rows="3"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="button" id="task{{ $task->id }}" class="btn btn-dark btn-theme-colored btn-sm mt-0">{{ __('Send') }}</button>
                                                        <a data-dismiss="modal" class="btn btn-dark btn-theme-colored btn-sm mt-0">{{ __('Close') }}</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                    </td>
                                    <td><a id="cmt{{ $task->id }}" data-toggle="modal" data-target="#modalR{{ $task->id }}" class="btn btn-success">{{ __('Comment') }}</a>
                                        <div class="modal fade" id="modalR{{ $task->id }}">
                                            <div class="modal-dialog bg-white widget border-1px p-30">
                                                <h5 class="widget-title line-bottom">{{ __('Report') }}</h5>
                                                <form method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <textarea name="report" id="comment{{ $task->id }}" class="form-control" rows="3"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <a type="button" data-dismiss="modal" class="btn btn-dark btn-theme-colored btn-sm mt-0">{{ __('Close') }}</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div>
<script type="text/javascript">
    //Show report
    $("td button").on('click', function () {
        var task_id = this.id;
        task_id = task_id.replace('task', '');
        var report = "#report" + task_id;
        $.ajax({
            type: 'POST',
            url: '/report/show',
            data: {
                task_id: task_id,
            },
            success: function (response) {
                $(report).val(response.result[0].report);
            },
            error: function(e) {
                alert("Error! Please refresh");
            }
        });
    });

    //Show comment
    $("td a").on('click', function () {
        var task_id = this.id;
        task_id = task_id.replace('cmt', '');
        var comment = "#comment" + task_id;
        $.ajax({
            type: 'POST',
            url: '/report/show',
            data: {
                task_id: task_id,
            },
            success: function (response) {
                $(comment).val(response.result[0].cmt);
            },
            error: function(e) {
                alert("Error! Please refresh");
            }
        });
    });

    //Send report
    $(".formReport button").on('click', function () {
        var task_id = this.id;
        task_id = task_id.replace('task', '');
        var report = "#report" + task_id;
        var btn = "#btn" + task_id;
        var reportContent = $(report).val();
        var btnSend = "#task" + task_id;
        $.ajax({
            type: 'POST',
            url: '/report/store',
            data: {
                task_id: task_id,
                report: reportContent,
            },
            success: function (response) {
                $(btn).removeClass('btn-info');
                $(btn).addClass('btn-warning');
                $(btn).text('Waiting');
                $(report).val(reportContent);
                $(btnSend).remove();
            },
            error: function(e) {
                alert("Error!");
            }
        });
    });

    // function sendReport(task_id, user_id) {
    //     var report = "#report" + task_id;
    //     var task = '#task' + task_id;
    //     var btnSend = '#' + task_id;
    //     var report = $("#report").val();
    //     $.ajax({
    //         type: 'POST',
    //         url: '/report/store',
    //         data: {
    //             user_id: user_id,
    //             task_id: task_id,
    //             report: report,
    //         },
    //         success: function (response) {
    //             $(task).removeClass('btn-info');
    //             $(task).addClass('btn-warning');
    //             $(report).val(report);
    //             $(btnSend).remove();
    //         },
    //         error: function(e) {
    //             alert("Error!");
    //         }
    //     });
    // }

    // function showReport(task_id, user_id) {
    //     var report = "#report" + task_id;
    //     var task = "#" + task_id;
    //     $.ajax({
    //         type: 'POST',
    //         url: '/report/show',
    //         data: {
    //             task_id: task_id,
    //         },
    //         success: function (response) {
    //             $(report).val(response.report[0].report);
    //         },
    //         error: function(e) {
    //             alert("Error! Please refresh");
    //         }
    //     });
    // }

</script>

