@extends('client.layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-9 blog-pull-right">
                    {{-- @foreach($courses as $course)
                        <div class="row mb-15">
                        <div class="col-sm-6 col-md-4">
                            <div class="thumb">
                                <img alt="featured project" src="{{ $course->image }}" class="img-fullwidth">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-8">
                            <h4 class="line-bottom mt-0 mt-sm-20">{{ $course->name }}</h4>
                            @if($course->users->pivot->status == 1 && $course->users->id == Auth::User()->id)
                            <p><span class="badge badge-info">Actived</span></p>
                            @endif
                            <em>{{ $course->users->count() }} {{ trans('layouts.Trainee') }}</em><br>
                            <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" href="{{ route('course.show', $course->id) }}">{{ trans('layouts.view details') }}</a>
                        </div>
                        </div>
                        <hr>
                    @endforeach --}}

                    @foreach ($courses as $course)
                        <div class="row mb-15">
                            <div class="col-sm-6 col-md-4">
                                <div class="thumb">
                                    <img alt="featured project" src="{{ $course->image }}" class="img-fullwidth">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-8">
                                <h4 class="line-bottom mt-0 mt-sm-20">{{ $course->name }}
                                @foreach ($course->users as $user)
                                    @if ($user->id == Auth::user()->id)
                                        @if ($user->pivot->status == config('client.user.false'))
                                            <i class="fa fa-check-circle check"></i>
                                        @elseif ($user->pivot->status ==config('client.user.true'))
                                            <i class="fa fa-check-circle nocheck"></i>
                                        @endif
                                    @endif
                                @endforeach
                                </h4>
                                <p>{{ $course->description }}</p>
                                <em>{{ $course->users->count() }} {{ trans('layouts.member') }}</em><br>
                                <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" id="course{{ $course->id }}" href="{{ route('course.show', $course->id) }}">{{ trans('layouts.viewD') }}</a>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    <div class="row">
                        <div class="col-sm-12">
                            <nav>
                                {{ $courses->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="sidebar sidebar-left mt-sm-30">
                        <div class="widget">
                            <h5 class="widget-title line-bottom">{{ trans('layouts.search') }} <span class="text-theme-color-2">{{ trans('layouts.categories') }}</span></h5>
                            <div class="search-form">
                                <form id="search">
                                    <div class="input-group">
                                        <input type="text" id="value" placeholder="Click to Search" class="form-control search-input">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="widget">
                            <h5 class="widget-title line-bottom">{{ trans('layouts.categories') }}</h5>
                            {{-- <div class="categories">
                                <ul class="list list-border angle-double-right">
                                    <li><a href="{{ route('course.index') }}">{{ trans('layouts.all') }}<span></span></a></li>
                                    @foreach ($categories as $category)
                                        @if ($category->categories->count() > 0)
                                        <li><a href="{{ route('category.show', $category->id) }}">{{ $category->name }}<span></span></a></li>
                                        <ul>
                                            @foreach ($category->categories as $categoryChild)
                                                <li>
                                                    <a href="{{ route('category.show', $categoryChild->id) }}">{{ $categoryChild->name }}
                                                        <span>{{ '('.$categoryChild->courses->count().')' }}
                                                        </span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    @endforeach
                                    <nav>
                                        {{ $categories->links() }}
                                    </nav>
                                </ul>
                            </div> --}}


                            <div id="jstree">
                                <ul>
                                    @foreach ($categories as $category)
                                        @if ($category->categories->count() > config('client.user.false'))
                                        <li>
                                            <a class="parentCategory" href="{{ route('category.show', $category->id) }}">{{ $category->name }}<span></span></a>
                                            <ul>
                                                @foreach ($category->categories as $categoryChild)
                                                    <li>
                                                        <a href="{{ route('category.show', $categoryChild->id) }}">{{ $categoryChild->name }}
                                                            <span>{{ '('.$categoryChild->courses->count().')' }}
                                                            </span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            {{-- <div id="cssmenu">
                                <ul>
                                   <li class="has-sub"><a href="#"><span>Link1</span></a>
                                      <ul>
                                         <li class="even"><a href="#"><span>menu1</span></a></li>
                                         <li class="odd"><a href="#"><span>menu2</span></a></li>
                                         <li class="even"><a href="#"><span>menu3</span></a></li>
                                      </ul>
                                   </li>
                                   <li class="has-sub"><a href="#"><span>Link2</span></a>
                                      <ul>
                                         <li class="even"><a href="#"><span>link21</span></a></li>
                                         <li class="odd"><a href="#"><span>link22</span></a></li>
                                         <li class="even"><a href="#"><span>link23</span></a></li>
                                      </ul>
                                   </li>

                                </ul>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <script type="text/javascript">
        $( document ).ready(function() {
            $('#cssmenu ul ul li:odd').addClass('odd');
            $('#cssmenu ul ul li:even').addClass('even');
            $('#cssmenu > ul > li > a').click(function() {
                $('#cssmenu li').removeClass('active');
                $(this).closest('li').addClass('active');
                var checkElement = $(this).next();
                if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                    $(this).closest('li').removeClass('active');
                    checkElement.slideUp('normal');
                }
                if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                    $('#cssmenu ul ul:visible').slideUp('normal');
                    checkElement.slideDown('normal');
                }
                if($(this).closest('li').find('ul').children().length == 0) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script> --}}
    <script type="text/javascript">
        $("#jstree").jstree({
            "state" : { "key" : "state_demo" },
            "types" : {
                "default" : {
                    "icon" : "glyphicon glyphicon-flash"
                },
                "demo" : {
                    "icon" : "glyphicon glyphicon-ok"
                }
            },
          "plugins" : ["wholerow", "types", "search", "state"]
        });

        $("#search").submit(function(e) {
          e.preventDefault();
          $("#jstree").jstree(true).search($("#value").val());
        });

        $('#jstree').on("changed.jstree", function (e, data) {
            var link = data.node.a_attr.href;
            window.location.replace(link);
        });
    </script>
@endsection


