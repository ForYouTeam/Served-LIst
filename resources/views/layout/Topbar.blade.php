<div class="navbar-wrapper">
    <div class="navbar-logo">
        <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
            <i class="ti-menu"></i>
        </a>
        <div class="mobile-search waves-effect waves-light">
            <div class="header-search">
                <div class="main-search morphsearch-search">
                    <div class="input-group">
                        <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                        <input type="text" class="form-control" placeholder="Enter Keyword">
                        <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <a href="index.html">
            <img class="img-fluid" src="{{ asset('assets/images/logo.png') }}" alt="Theme-Logo" />
        </a>
        <a class="mobile-options waves-effect waves-light">
            <i class="ti-more"></i>
        </a>
    </div>

    <div class="navbar-container container-fluid">
        <ul class="nav-left">
            <li>
                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a>
                </div>
            </li>
        </ul>
        <ul class="nav-right">
            <li class="header-notification">
            </li>
            <li class="user-profile header-notification">
                <a href="#" class="waves-effect waves-light">
                    <img src="{{ asset('assets/images/user.png') }}" class="img-radius" alt="User-Profile-Image">
                    <span>{{ Auth::user()->username }}</span>
                    <i class="ti-angle-down"></i>
                </a>
                <ul class="show-notification profile-notification">
                    <li class="waves-effect waves-light">
                        <a href="{{ route('logout') }}">
                            <i class="ti-layout-sidebar-left"></i> Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
