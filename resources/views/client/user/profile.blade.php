@extends('client.layouts.main')
@section('content')
<section class="">
    <div class="container">
        <div class="section-content">
            <div class="row">
                <div class="col-sx-12 col-sm-4 col-md-4">
                    <div class="doctor-thumb">
                        <img id="imageAvatar1" src="{{ $user->avatar }}" alt="">
                    </div>
                    <div class="info p-20 bg-black-333">
                        <h4 class="text-uppercase text-white">{{ $user->name }}</h4>
                        <ul class="list angle-double-right m-0">
                            <li class="mt-0 text-gray-silver">
                                <strong class="text-gray-lighter">{{ trans('layouts.address') }}</strong>
                                <br>{{ $user->address }}
                            </li>
                            <li class="mt-0 text-gray-silver">
                                <strong class="text-gray-lighter">{{ trans('layouts.email') }}</strong>
                                <br>{{ $user->email }}
                            </li>
                            <li class="text-gray-silver">
                                <strong class="text-gray-lighter">{{ trans('layouts.phone1') }}</strong>
                                <br>{{ $user->phone }}
                            </li>
                        </ul>
                        <ul class="styled-icons icon-gray icon-circled icon-sm mt-15 mb-15">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                        @if (Auth::user()->id == $user->id)
                        <a class="btn btn-info btn-flat mt-10 mb-sm-30" data-toggle="modal"
                            data-target="#myModal">{{ trans('layouts.editP') }}</a>
                        @endif
                        <div class="modal fade" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="formEdit" name="{{ $user->id }}"
                                        action="{{ route('user.update', $user->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h4 class="modal-title">{{ trans('layouts.editP') }}</h4>
                                        </div>
                                        <div class="modal-body row">
                                            <div id="edit-error-bag">
                                                <ul id="edit-task-errors">
                                                </ul>
                                            </div>
                                            <div class="col-xs-7">
                                                <div class="form-group">
                                                    <label>{{ trans('layouts.name') }}</label>
                                                    <input class="form-control" name="name" required="" id="name"
                                                        type="text" value="{{ $user->name }}">

                                                </div>
                                                <div class="form-group">
                                                    <label>{{ trans('layouts.phone1') }}</label>
                                                    <input class="form-control" name="phone" id="phone" required=""
                                                        type="text" value="{{ $user->phone }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ trans('layouts.address') }}</label>
                                                    <textarea class="form-control" name="address" id="address"
                                                        required="" type="text" col="2">{{ $user->address }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-xs-5">
                                                <div class="form-group">
                                                    <label>{{ trans('layouts.avatar') }}</label><br>
                                                    <input type="file" name="avatar" id="avatar"
                                                        value="{{ $user->avatar }}">
                                                    <img id="imageAvatar" class="thumbnail" src="{{ $user->avatar }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">{{ trans('layouts.close') }}</button>
                                            <button class="btn btn-info" id="btn-add" type="submit"
                                                name="save">{{ trans('layouts.save') }}</button>
                                            </input>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8">
                    <div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#courses" aria-controls="courses" role="tab" data-toggle="tab" class="font-15 text-uppercase">{{ trans('layouts.courses') }} <span class="badge">{{ $courses->count() }}</span></a></li>
                            <li role="presentation"><a href="#subjects" aria-controls="subjects" role="tab" data-toggle="tab" class="font-15 text-uppercase">{{ trans('layouts.subjects')}} <span class="badge">{{ $subjects->count() }}</span></a></li>
                            <li role="presentation"><a href="#tasks" aria-controls="tasks" role="tab" data-toggle="tab" class="font-15 text-uppercase">{{ trans('layouts.tasks')}} <span class="badge">{{ $tasks->count() }}</span></a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="courses">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>{{ trans('layouts.number') }}</th>
                                                <th>{{ trans('layouts.name') }}</th>
                                                <th>{{ trans('layouts.process') }}</th>
                                                <th>{{ trans('layouts.status') }}</th>
                                                <th>{{ trans('layouts.view') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php $i = 1 @endphp
                                        @foreach($courses as $course)
                                            <tr>
                                                <th scope="row">{{ '#' . $i++ }}</th>
                                                <td>{{ $course->name }}</td>
                                                <td>{{ $course->pivot->process }}</td>
                                                <td>
                                                    @if ($course->pivot->status == false)
                                                        <button class="btn btn-warning btn-xs">{{ trans('layouts.activity') }}</button>
                                                    @else
                                                        <button class="btn btn-success btn-xs">{{ trans('layouts.finished') }}</button>
                                                    @endif
                                                </td>
                                                <td><a class="btn btn-info btn-xs" href="{{ route('course.show', $course->id) }}">{{ trans('layouts.view') }}</a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="subjects">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('layouts.number') }}</th>
                                            <th>{{ trans('layouts.name') }}</th>
                                            <th>{{ trans('layouts.process') }}</th>
                                            <th>{{ trans('layouts.dateStart') }}</th>
                                            <th>{{ trans('layouts.dateFinish') }}</th>
                                            <th>{{ trans('layouts.status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $j = 1 @endphp
                                    @foreach($subjects as $subject)
                                        <tr>
                                            <th scope="row"># {{ $j++ }}</th>
                                            <td>{{ $subject->name }}</td>
                                            <td>{{ $subject->pivot->process }}</td>
                                            <td>{{ $subject->pivot->created_at }}</td>
                                            <td>
                                                @if ($subject->pivot->created_at != $subject->pivot->updated_at)
                                                    {{ $subject->pivot->updated_at }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($subject->pivot->status == false)
                                                    <button class="btn btn-warning btn-xs">{{ trans('layouts.activing') }}</button>
                                                @else
                                                    <button class="btn btn-success btn-xs">{{ trans('layouts.success') }}</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="tasks">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('layouts.number') }}</th>
                                            <th>{{ trans('layouts.name') }}</th>
                                            <th>{{ trans('layouts.dateStart') }}</th>
                                            <th>{{ trans('layouts.dateFinish') }}</th>
                                            <th>{{ trans('layouts.status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $k = 1 @endphp
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <th scope="row"># {{ $k++ }}</th>
                                            <td>{{ $task->name }}</td>
                                            <td>{{ $task->pivot->created_at }}</td>
                                            <td>
                                                @if ($task->pivot->created_at != $task->pivot->updated_at)
                                                    {{ $subject->updated_at }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($task->pivot->status == false)
                                                    <button class="btn btn-warning btn-xs">{{ trans('layouts.activing') }}</button>
                                                @else
                                                    <button class="btn btn-success btn-xs">{{ trans('layouts.finished') }}</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    // function readURL(input) {
    //     if(input.files && input.files[0]) {
    //         var reader = new FileReader();
    //         reader.onload = function(e) {
    //             $("#imageAvatar").attr("src", e.target.result);
    //         };
    //         reader.readAsDataURL(input.files[0]);
    //     }
    // }

    $(document).ready(function () {
        $("#avatar").on('change', function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#imageAvatar").attr("src", e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

        $("#formEdit").submit(function (e) {
            e.preventDefault();
            var url = '/users/' + $("#formEdit").attr('name') + '/update';
            var avatar = $("#avatar").val();
            avatar = avatar.replace('C:\\fakepath', '/images/avatar/');
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    name: $("#name").val(),
                    phone: $("#phone").val(),
                    address: $("#address").val(),
                    avatar: avatar,
                },
                success: function (response) {
                    window.location.reload();
                },
                error: function (data) {
                    var errors = $.parseJSON(data.responseText);
                    $('#edit-task-errors').html('');
                    $('#edit-error-bag').addClass("alert alert-danger");
                    $.each(errors.errors, function (key, value) {
                        $('#edit-task-errors').append('<li>' + value + '</li>');
                    });
                    $("#edit-error-bag").show();
                }
            });
        });
    });

</script>
@endsection
