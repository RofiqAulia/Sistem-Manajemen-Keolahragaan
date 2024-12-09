<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            
            <!-- Dashboard Section -->
            <li class="nav-header">Dashboard</li>
            <li class="nav-item">
            <a href="{{ route('home') }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('landing.index') }}" target="_blank" class="nav-link {{ request()->routeIs('landing.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Landing Page</p>
                </a>
             </li>

            <!-- News Section -->
            <li class="nav-header">News</li>
            <li class="nav-item">
                <a href="#">
                    <i class="nav-icon fas fa-newspaper"></i>
                    <p>Data News</p>
                </a>
            </li>

            <!-- Data Anggota Section -->
            <li class="nav-header">Data Manajemen Olahraga</li>
            <li class="nav-item">
                <a href="{{ route('atlet.index') }}" class="nav-link {{ (request()->routeIs('atlet.index')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-running"></i>
                    <p>Data Atlet</p>
                </a>
            </li> 
            <li class="nav-item">
                <a href="#">
                    {{-- <i class="nav-icon fas fa-users-cog"></i> --}}
                    <p>Data Pengurus</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('cabor.index') }}" class="nav-link {{ (request()->routeIs('cabor.index')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users-cog"></i>
                    <p>Data Cabang Olahraga</p>
                </a>
            </li>            

            <!-- Data Anggota Section -->
            {{-- <li class="nav-header">Daftar Pelaporan</li>
            <li class="nav-item">
                <a href="#">
                    <i class="nav-icon fas fa-trophy"></i>
                    <p>Daftar Prestasi</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="nav-icon fas fa-trophy"></i>
                    <p>Daftar Pengajuan Lomba</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="nav-icon fas fa-trophy"></i>
                    <p>Daftar Event</p>
                </a>
            </li> --}}

            <!-- Profile Section -->
            <li class="nav-header">Profile</li>
            <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link {{ (request()->routeIs('user.index')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>User</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('level.index') }}" class="nav-link {{ (request()->routeIs('level.index')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-layer-group"></i>
                    <p>Level</p>
                </a>
            </li>
        </ul>
    </nav>
</div>
