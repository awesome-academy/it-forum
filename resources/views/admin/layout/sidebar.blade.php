<ul class="sidebar navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.index') }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>{{ __('admin.category.home') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.post.index') }}">
            <i class="fas fa-clipboard"></i>
            <span>{{ __('admin.category.post') }}</span>
        </a>
    </li>
    <li class="nav-item ">
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="pagesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-tag"></i>
                <span>{{ __('admin.category.tag') }}</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <a class="dropdown-item" href="{{ route('admin.tag.index') }}">{{ __('admin.action.list') }}</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('admin.tag.create') }}">{{ __('admin.action.add') }}</a>
            </div>
        </div>
    </li>
    <li class="nav-item ">
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="pagesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
                <span>{{ __('admin.category.user') }}</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <a class="dropdown-item" href="{{ route('admin.user.index') }}">{{ __('admin.action.list') }}</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('admin.user.create') }}">{{ __('admin.action.add') }}</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.report.index') }}">
            <i class="fas fa-flag"></i>
            <span>{{ __('admin.category.report') }}</span>
        </a>
    </li>
    <li class="nav-item ">
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="pagesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-wrench"></i>
                <span>{{ __('admin.category.config') }}</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <a class="dropdown-item" href="{{ route('admin.config.index') }}">{{ __('admin.action.list') }}</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('admin.config.create') }}">{{ __('admin.action.add') }}</a>
            </div>
        </div>
    </li>
</ul>
