<ul class="pcoded-item pcoded-left-item mt-4">
    <li class="active">
        <a href="index.html" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
            <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
            <span class="pcoded-mcaret"></span>
        </a>
    </li>
    <li class="pcoded-hasmenu" dropdown-icon="style3" subitem-icon="style7">
        <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Semua Data</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
            <li class="">
                <a href="{{ route('staff.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Staff</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </li>
</ul>
