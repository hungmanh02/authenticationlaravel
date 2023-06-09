<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tổng quan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Quản trị
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @can('users')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Người dung</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Người dung:</h6>
                <a class="collapse-item" href="{{route('admin.users.index')}}">Danh sách người dùng</a>
                @can('create','App\\Models\User')
                <a class="collapse-item" href="{{route('admin.users.add')}}">Thêm người dùng</a>
                @endcan
            </div>
        </div>
    </li>
    @endcan


    <!-- Nav Item - Utilities Collapse Menu -->
    @can('groups')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Nhóm người dùng</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Nhóm người dùng:</h6>
                <a class="collapse-item" href="{{route('admin.groups.index')}}">Danh sách nhóm</a>
                @can('create','App\\Models\Group')
                <a class="collapse-item" href="{{route('admin.groups.add')}}">Thêm nhóm</a>
                @endcan
            </div>
        </div>
    </li>
    @endcan

    <!-- Nav Item - Posts Collapse Menu -->
    @can('posts')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePosts"
            aria-expanded="true" aria-controls="collapsePosts">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Bài viết</span>
        </a>
        <div id="collapsePosts" class="collapse" aria-labelledby="headingPosts"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Bài viết:</h6>
                <a class="collapse-item" href="{{route('admin.posts.index')}}">Danh sách bài viết</a>
                @can('create','App\\Models\Post')
                <a class="collapse-item" href="{{route('admin.posts.add')}}">Thêm bài viết</a>
                @endcan
            </div>
        </div>
    </li>
    @endcan


    {{-- <!-- Divider -->
    <hr class="sidebar-divider"> // đường gạch nganh--}}



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div>

</ul>
