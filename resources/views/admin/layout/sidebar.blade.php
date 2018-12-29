<ul class="sidebar navbar-nav">
    <li class="nav-item ">
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="pagesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('admin.category.user') }}</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <a class="dropdown-item" href="{{ route('admin.user.index') }}">{{ __('admin.action.list') }}</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">{{ __('admin.action.add') }}</a>
            </div>
        </div>
    </li>
    <li class="nav-item ">
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="pagesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('admin.category.post') }}</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <a class="dropdown-item" href="#">{{ __('admin.action.list') }}</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">{{ __('admin.action.add') }}</a>
            </div>
        </div>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link" href="#">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>ABC</span></a>
    </li> -->
</ul>
