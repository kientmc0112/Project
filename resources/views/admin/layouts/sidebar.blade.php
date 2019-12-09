<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i> |
            <span>{{ trans('setting.dashboard') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-user-friends"></i> |
            <span>{{ trans('setting.users') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.categories.index') }}">
            <i class="fas fa-tasks"></i> |
            <span>{{ trans('setting.categories') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.courses.index') }}">
            <i class="fas fa-chalkboard-teacher"></i> |
            <span>{{ trans('setting.courses') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.subjects.index') }}">
            <i class="fas fa-atom"></i> |
            <span>{{ trans('setting.subjects') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.tasks.index') }}">
            <i class="fas fa-book-open"></i> |
            <span>{{ trans('setting.tasks') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.reports.index') }}">
            <i class="fas fa-comment-dots"></i> |
            <span>{{ trans('setting.reports') }}</span>
        </a>
    </li>
</ul>
