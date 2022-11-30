<ul class="navbar-nav mr-auto">
    <li>
        <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
            <i class="fas fa-bars"></i>
        </a>
    </li>
</ul>
<ul class="navbar-nav navbar-right">
    <li class="dropdown">
        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
{{--            <img alt="image" src="{{ asset('image/user.png') }}" class="rounded-circle mr-1">--}}
            <div class="d-sm-none d-lg-inline-block">Hi,
                {{ auth()->user()->name ?? '' }}
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            {{-- <a href="{{ route('profile.show') }}" class="dropdown-item has-icon">
            <i class="far fa-user"></i> Profile
            </a> --}}
            <div class="dropdown-divider"></div>
            <a href="javascript:;" class="dropdown-item has-icon text-danger"
                onclick="document.querySelector('#logout_form').submit()">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout_form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </div>
    </li>
</ul>
