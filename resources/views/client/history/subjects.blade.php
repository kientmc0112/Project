@foreach ($subjects as $subject)
    @foreach ($subject->users as $user)
        @if ($user->id == Auth::user()->id)
            <div class="upcoming-events bg-white-f3 mb-20">
                <div class="row">
                    <div class="col-sm-6 pr-0">
                        <div class="event-details p-15 mt-20">
                            <h4 class="media-heading text-uppercase font-weight-500">{{ $subject->name }}</h4>
                            <p>{{ $subject->description }}</p>
                            {{-- <a class="btn btn-flat btn-dark btn-theme-colored btn-sm" >Details <i class="fa fa-angle-double-right" data-toggle="collapse" data-target="#target2"></i></a> --}}
                            <button class="btn btn-flat btn-dark btn-theme-colored btn-sm history" id="history{{ $subject->id }}" data-toggle="collapse" data-target="#target{{ $subject->id }}">{{ trans('layouts.viewD') }}</button>
                            <div id="target{{ $subject->id }}" class="collapse">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="event-count p-15 mt-15">
                            <ul class="event-date list-inline font-16 text-uppercase mt-10 mb-20">
                                <li class="p-10 mr-5 bg-lightest">{{ $user->pivot->created_at->format('M') }}</li>
                                <li class="p-10 pl-20 pr-20 mr-5 bg-lightest"> {{ $user->pivot->created_at->day }}</li>
                                <li class="p-10 mr-10 bg-lightest">{{ $user->pivot->created_at->year }}</li>
                                <li class="mb-10 mr-5 font-14 text-theme-colored"><i class="fa fa-clock-o mr-5"></i>at {{ $user->pivot->created_at->toTimeString() }}</li>
                            </ul>
                            @if ($user->pivot->status == config('client.user.true'))
                                <ul class="event-date list-inline font-16 text-uppercase mt-10 mb-20">
                                    <li class="p-10 mr-5 bg-lightest">{{ $user->pivot->updated_at->format('M') }}</li>
                                    <li class="p-10 pl-20 pr-20 mr-5 bg-lightest"> {{ $user->pivot->updated_at->day }}</li>
                                    <li class="p-10 mr-10 bg-lightest">{{ $user->pivot->updated_at->year }}</li>
                                    <li class="mb-10 mr-5 font-14 text-theme-colored"><i class="fa fa-clock-o mr-5"></i>at {{ $user->pivot->updated_at->toTimeString() }}</li>
                                </ul>
                            @endif
                            {{-- <ul>
                                <li class="mb-10 text-theme-colored"><i class="fa fa-clock-o mr-5"></i>at {{ $user->pivot->created_at->toTimeString() }}</li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endforeach
<div class="row">
    <div class="col-sm-12">
        <nav>
            {{ $subjects->links() }}
        </nav>
    </div>
</div>
<script type="text/javascript">
    $(".row button").on('click', function () {
        var subject_id = this.id;
        subject_id = subject_id.replace('history', '');
        var content = "#target" + subject_id;
        $.ajax({
            method: 'POST',
            dataType: 'html',
            data: {
                subject_id: subject_id,
            },
            url: '/subjects/' + subject_id + '/history',
            success: function (response) {
                $(content).html(response);
            },
            error: function (e) {
                console.log(e.message);
            }
        });
    });
</script>
