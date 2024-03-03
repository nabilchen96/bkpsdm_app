<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if (Auth::user()->role == 'Admin')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title" style="margin-top: 7px;">Master</span>
                    <i style="margin-top: 7px;" class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('user') }}">
                                <span class="menu-title">User</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('grup_instrumen') }}">
                                <span class="menu-title">Grup Instrumen</span>
                            </a>
                        </li>
                       
                    </ul>
                </div>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{ url('') }}">
                <i class="bi bi-window-plus menu-icon"></i>
                <span class="menu-title">AMI</span>
            </a>
        </li>
    </ul>
</nav>
