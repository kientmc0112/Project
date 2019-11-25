@extends('client.layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-9 blog-pull-right">
                    @foreach($courses as $course)
                        <div class="row mb-15">
                            <div class="col-sm-6 col-md-4">
                                <div class="thumb">
                                    <img alt="featured project" src="{{ $course->image }}" class="img-fullwidth">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-8">
                                <h4 class="line-bottom mt-0 mt-sm-20">{{ $course->name }}</h4>
                                <p>{{ $course->description }}</p>
                                <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" href="page-courses-accounting-technologies.html">{{ __('view details') }}</a>
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
                            <h5 class="widget-title line-bottom">{{ __('Search') }}</span></h5>
                            <div class="search-form">
                                <form>
                                    <div class="input-group">
                                        <input type="text" placeholder="Click to Search" class="form-control search-input">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="widget">
                            <h5 class="widget-title line-bottom">{{ __('Categories') }}</h5>
                            <div class="categories">
                                <ul class="list list-border angle-double-right">
                                    <li><a href="{{ route('course.index') }}">{{ __('All') }}<span></span></a></li>
                                    @foreach($categories as $category)
                                    <li><a href="{{ route('category.show', $category->id) }}">{{ $category->name }}<span>{{ '('.$category->courses->count().')' }}</span></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
