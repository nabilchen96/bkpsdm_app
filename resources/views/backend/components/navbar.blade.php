<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('instansi') }}">
                <i class="bi bi-building menu-icon"></i>
                <span class="menu-title">Instansi</span>
            </a>
        </li>
        <style>
            .sidebar .nav .nav-item .nav-link {
                white-space: normal;
            }

            .sub-menu-title {
                font-size: 12px !important;
            }
        </style>
        @if (Auth::user()->role == 'Admin')
            {{-- <li class="nav-item">
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
                                <span class="menu-title sub-menu-title">User</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('instansi') }}">
                                <span class="menu-title sub-menu-title">instansi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('pegawai') }}">
                                <span class="menu-title sub-menu-title">Pegawai</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}
        @endif
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic">
                <i class="bi bi-file-earmark-text menu-icon"></i>
                <span class="menu-title" style="margin-top: 7px;">
                    Master
                </span>
                <i style="margin-top: 7px;" class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic2">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('pegawai') }}">
                            <span class="menu-title sub-menu-title">Pegawai</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('ujian-dinas') }}">
                            <span class="menu-title sub-menu-title">Ujian Dinas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('prajabatan') }}">
                            <span class="menu-title sub-menu-title">Prajabatan</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#user" aria-expanded="false" aria-controls="ui-basic">
                <i class="bi bi-person-circle menu-icon"></i>
                <span class="menu-title" style="margin-top: 7px;">
                    Pengguna
                </span>
                <i style="margin-top: 7px;" class="menu-arrow"></i>
            </a>
            <div class="collapse" id="user">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('user') }}?user=Admin">
                            <span class="menu-title sub-menu-title">Admin</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('user') }}?user=Operator">
                            <span class="menu-title sub-menu-title">Operator</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
