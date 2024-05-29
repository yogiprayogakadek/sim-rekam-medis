<div class="fixed-sidebar-left">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header">
            <span>featured</span>
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a href="/" class="{{ Request::is('/') ? 'active' : '' }}">
                <div class="pull-left"><i class="zmdi zmdi-home mr-20"></i><span class="right-nav-text">Dashboard</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <li>
            <a href="{{ route('user.index') }}" class="{{ Request::is('user') ? 'active' : '' }}">
                <div class="pull-left"><i class="zmdi zmdi-account-circle mr-20"></i><span
                        class="right-nav-text">Staff</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <li>
            <a href="{{ route('rekam-medis.index') }}" class="{{ Request::is('rekam-medis') ? 'active' : '' }}">
                <div class="pull-left"><i class="zmdi zmdi-hospital mr-20"></i><span class="right-nav-text">Rekam
                        Medis</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
    </ul>
</div>
