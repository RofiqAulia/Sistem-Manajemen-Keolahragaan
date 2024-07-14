<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header">Dashboard</li>
            <li class="nav-header">News</li>
            <li class="nav-item">
                <a href="{{ route('news.index') }}" class="nav-link {{ (request()->routeIs('news.index')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-images"></i>
                    <p>Data News</p>
                </a>
            </li>
            
            <li class="nav-header">Profile</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>User</p>
                </a>
            </li>
        </ul>
    </nav>
</div>
