<ul class="pcoded-item pcoded-left-item mt-4">
    <li class="{{ request()->routeIs('task.index') ? 'active' : '' }}">
        <a href="{{ route('task.index') }}" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="ti-menu-alt"></i></span>
            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Dashboard</span>
            <span class="pcoded-mcaret"></span>
        </a>
    </li>
    @role('super-admin')
        <li class="{{ request()->routeIs('staff.index') ? 'active' : '' }}">
            <a href="{{ route('staff.index') }}" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="ti-user"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Staff</span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>
        <li class="{{ request()->routeIs('tag.index') ? 'active' : '' }}">
            <a href="{{ route('tag.index') }}" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="ti-tag"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Tag</span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>
        <li class="{{ request()->routeIs('prioritas.index') ? 'active' : '' }}">
            <a href="{{ route('prioritas.index') }}" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="ti-crown"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Prioritas</span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>
    @endrole
</ul>
