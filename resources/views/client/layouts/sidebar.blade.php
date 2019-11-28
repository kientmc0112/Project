<div class="header-nav">
    <div class="header-nav-wrapper navbar-scrolltofixed bg-theme-colored border-bottom-theme-color-2-1px">
        <div class="container">
            <nav id="menuzord" class="menuzord bg-theme-colored pull-left flip menuzord-responsive">
                <ul class="menuzord-menu">
                    <li class="active">
                        <a href="#home">{{ __('Home') }}</a>
                    </li>
                    <li>
                        <a href="#">{{ __('Categories') }} <span class="label label-info">{{ __('New') }}</span></a>
                    </li>
                    <li><a href="#">{{ __('Courses') }}</a>
                    </li>
                    <li>
                        <a href="#">{{ __('Subject') }} <span class="label label-info">{{ __('New') }}</span></a>
                    </li>
                    <li>
                        <a href="#home">{{ __('Supervisor') }}</a>
                    </li>
                    <li>
                        <a href="#home">{{ __('Task') }}</a>
                    </li>
                    <li>
                        <a href="#">{{ __('Activities') }}</a>
                    </li>
                    <li>
                        <a href="#">{{ __('Calender') }}</a>
                    </li>
                    <li id="fl_right">
                        <a href="#">
                            <i class="fas fa-user"></i> |My Profile
                        </a>
                    </li>
                    <li>
                        <a class="text-white" id="logout" href="{{ route('logout') }}">| Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
