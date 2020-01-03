<div class="single-service">
    <img src="" alt="">
    <h3 class="text-theme-colored">{{ $subject->name }}</h3>
    <p>{{ $subject->description }}</p>
    <br>
    {{-- @if($permiss == 1) --}}
    @if ($permiss == config('client.user.false'))
        @foreach ($subject->users as $user)
            @if (Auth::user()->id == $user->id)
                <p>{{ trans('layouts.complete')}} {{ ': ' . $user->pivot->process . '/' . $subject->tasks->count() }}</p>
                <h4 class="line-bottom mt-20 mb-20 text-theme-colored">{{ trans('layouts.all') }}</h4>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="small">
                        <table class="table table-bordered">
                            <tr>
                                <td class="text-center font-16 font-weight-600 bg-theme-color-2 text-white" colspan="4">{{ trans('layouts.all') }}</td>
                            </tr>
                            <tr>
                                <th class="col-xs-1">{{ trans('layouts.name') }}</th>
                                <th>{{ trans('layouts.content') }}</th>
                                <th class="col-xs-1">{{ trans('layouts.status') }}</th>
                                <th class="col-xs-1">{{ trans('layouts.comment') }}</th>
                            </tr>
                            <tbody>
                                @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>
                                    @php $status = config('client.user.false') @endphp
                                    @foreach ($task->users as $user)
                                        @if (Auth::user()->id == $user->pivot->user_id)
                                            @if ($user->pivot->status == config('client.user.true'))
                                                <button id="task{{ $task->id }}" data-toggle="modal" data-target="#modal{{ $task->id }}" class="btn btn-success text-center btn-report">{{ trans('layouts.completed') }}</button>
                                                @php $status = config('client.user.true') @endphp
                                            @elseif ($user->pivot->status == config('client.user.false'))
                                                <button id="task{{ $task->id }}" data-toggle="modal" data-target="#modal{{ $task->id }}" class="btn btn-warning text-center btn-report">{{ trans('layouts.wait') }}</button>
                                                @php $status = config('client.user.true') @endphp
                                            @endif
                                            <div class="modal fade" id="modal{{ $task->id }}">
                                                <div class="modal-dialog bg-white widget border-1px p-30">
                                                    <h5 class="widget-title line-bottom">{{ trans('layouts.report') }}</h5>
                                                    <form method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <textarea name="report" id="report{{ $task->id }}" class="form-control" rows="config('client.client.row')"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <span data-dismiss="modal" class="btn btn-dark btn-theme-colored btn-sm mt-0">{{ trans('layouts.close') }}</span>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    @if ($status == config('client.user.false'))
                                        <a id="btn{{ $task->id }}" data-toggle="modal" data-target="#modal{{ $task->id }}" class="btn btn-info text-center btn-report">{{ trans('layouts.report') }}</a>
                                        <div class="modal fade" id="modal{{ $task->id }}">
                                            <div class="modal-dialog bg-white widget border-1px p-30">
                                                <h5 class="widget-title line-bottom">{{ trans('layouts.report') }}</h5>
                                                <form class="formReport">
                                                    @csrf
                                                    <div class="form-group">
                                                        <textarea name="report" class="form-control" id="report{{ $task->id }}" required placeholder="Enter report ..." rows="config('client.client.row')"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="a" type="button" id="task{{ $task->id }}" class="btn btn-dark btn-theme-colored btn-sm mt-0">{{ trans('layouts.send') }}</button>
                                                        <span data-dismiss="modal" class="btn btn-dark btn-theme-colored btn-sm mt-0">{{ trans('layouts.close') }}</span>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                    </td>
                                    <td><a id="cmt{{ $task->id }}" data-toggle="modal" data-target="#modalR{{ $task->id }}" class="btn btn-success">{{ trans('layouts.comment') }}</a>
                                        <div class="modal fade" id="modalR{{ $task->id }}">
                                            <div class="modal-dialog bg-white widget border-1px p-30">
                                                <h5 class="widget-title line-bottom">{{ trans('layouts.report') }}</h5>
                                                <form method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <textarea name="report" id="comment{{ $task->id }}" class="form-control" disabled rows="config('client.client.row')"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <span data-dismiss="modal" class="btn btn-dark btn-theme-colored btn-sm mt-0">{{ trans('layouts.close') }}</span>
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
                $(report).val(response.result);
                $(report).attr('disabled', '');
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
                $(comment).val(response.result[0].comment);
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
                $(report).attr('disabled', '');
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

