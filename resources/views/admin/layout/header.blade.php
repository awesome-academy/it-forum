<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="index.html">Admin IT-FORUM</a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>
    {!! Form::open(['url' => '#', 'method' => 'put', 'class' => 'd-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0']) !!}
    <div class="input-group">
        <input type="text" class="form-control" placeholder="{{ __('admin.action.search') }}" aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
        <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
        </button>
        </div>
    </div>
    {!! Form::close() !!}
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">'{{ __('admin.logout') }}</a>
            </div>
        </li>
    </ul>
</nav>
