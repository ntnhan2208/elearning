<div class="topbar">
    <div class="topbar-left">
        <a href="#" class="logo">
            @if(Auth::User()->role == 1)
                <span>
                Administrator
                </span>
            @elseif(Auth::User()->role == 2)
                <span>
                Giáo viên
                </span>
            @else
                <span>
                Học sinh
                </span>
            @endif

        </a>
    </div>
    <nav class="navbar-custom">
        <ul class="list-unstyled topbar-nav float-right mb-0">
            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#"
                   role="button"
                   aria-haspopup="false" aria-expanded="false">
                    @if(Auth::check())
                        <span class="ml-1 nav-user-name hidden-sm"> {{ Auth::User()->name }} <i
                                    class="mdi mdi-chevron-down"></i> </span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('change_password') }}"><i
                                class="dripicons-gear text-muted mr-2"></i>
                        {{ trans('site.admin.change_pass') }}</a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class='btn btn-block dropdown-item'><i class="dripicons-exit text-muted
                         mr-2"></i> {{ trans('site.logout') }}</button>
                    </form>
                </div>
            </li>
        </ul><!--end topbar-nav-->
        <ul class="list-unstyled topbar-nav mb-0">
            <li>
                <button class="button-menu-mobile nav-link waves-effect waves-light">
                    <i class="dripicons-menu nav-icon"></i>
                </button>
            </li>
        </ul>
    </nav>
</div>
 