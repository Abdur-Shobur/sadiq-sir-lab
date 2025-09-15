<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Team Dashboard') - Team Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .user-avatar-img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="topbar">
        <div class="topbar-left">
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <a href="{{ route('team.dashboard') }}" class="brand">
                <i class="fas fa-users me-2"></i>Team Panel
            </a>
        </div>

        <div class="topbar-right">
            <div class="user-dropdown">
                <a href="#" class="user-dropdown-toggle" data-bs-toggle="dropdown">
                    @if(auth()->guard('team')->user()->image)
                        <img src="{{ auth()->guard('team')->user()->image_url }}" alt="Profile" class="user-avatar-img">
                    @else
                        <div class="user-avatar">
                            {{ strtoupper(substr(auth()->guard('team')->user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <span class="d-none d-sm-inline-block">{{ auth()->guard('team')->user()->name }}</span>
                    <i class="fas fa-chevron-down d-none d-sm-inline-block"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('team.profile') }}"><i class="fas fa-user me-2"></i>My Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('team.logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <nav class="sidebar-menu">
            <ul class="nav flex-column">
                @php
                    $team = auth()->guard('team')->user();
                @endphp

                <!-- Dashboard - Always visible -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('team.dashboard') ? 'active' : '' }}" href="{{ route('team.dashboard') }}">
                        <i class="fas fa-home"></i>Dashboard
                    </a>
                </li>

                <!-- Profile - Always visible -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('team.profile') ? 'active' : '' }}" href="{{ route('team.profile') }}">
                        <i class="fas fa-user"></i>My Profile
                    </a>
                </li>

                <!-- Research Management -->
                @if($team->hasPermission('research.view'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('team.researches.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#researchSubmenu" aria-expanded="{{ request()->routeIs('team.researches.*') ? 'true' : 'false' }}">
                        <i class="fas fa-flask"></i>Research
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse db-submenu {{ request()->routeIs('team.researches.*') ? 'show' : '' }}" id="researchSubmenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('team.researches.index') ? 'active' : '' }}" href="{{ route('team.researches.index') }}">
                                    <i class="fas fa-list"></i>All Research
                                </a>
                            </li>
                            @if($team->hasPermission('research.create'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('team.researches.create') ? 'active' : '' }}" href="{{ route('team.researches.create') }}">
                                    <i class="fas fa-plus"></i>Add Research
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                <!-- Blog Management -->
                @if($team->hasPermission('blog.view'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('team.blogs.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#blogSubmenu" aria-expanded="{{ request()->routeIs('team.blogs.*') ? 'true' : 'false' }}">
                        <i class="fas fa-blog"></i>Blogs
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse db-submenu {{ request()->routeIs('team.blogs.*') ? 'show' : '' }}" id="blogSubmenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('team.blogs.index') ? 'active' : '' }}" href="{{ route('team.blogs.index') }}">
                                    <i class="fas fa-list"></i>All Blogs
                                </a>
                            </li>
                            @if($team->hasPermission('blog.create'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('team.blogs.create') ? 'active' : '' }}" href="{{ route('team.blogs.create') }}">
                                    <i class="fas fa-plus"></i>Add Blog
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                <!-- News Management -->
                <!-- @if($team->hasPermission('news.view'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('team.news.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#newsSubmenu" aria-expanded="{{ request()->routeIs('team.news.*') ? 'true' : 'false' }}">
                        <i class="fas fa-newspaper"></i>News
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse db-submenu {{ request()->routeIs('team.news.*') ? 'show' : '' }}" id="newsSubmenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('team.news.index') ? 'active' : '' }}" href="{{ route('team.news.index') }}">
                                    <i class="fas fa-list"></i>All News
                                </a>
                            </li>
                            @if($team->hasPermission('news.create'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('team.news.create') ? 'active' : '' }}" href="{{ route('team.news.create') }}">
                                    <i class="fas fa-plus"></i>Add News
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif -->

                <!-- Event Management -->
                @if($team->hasPermission('event.view'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('team.events.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#eventSubmenu" aria-expanded="{{ request()->routeIs('team.events.*') ? 'true' : 'false' }}">
                        <i class="fas fa-calendar"></i>Events
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse db-submenu {{ request()->routeIs('team.events.*') ? 'show' : '' }}" id="eventSubmenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('team.events.index') ? 'active' : '' }}" href="{{ route('team.events.index') }}">
                                    <i class="fas fa-list"></i>All Events
                                </a>
                            </li>
                            @if($team->hasPermission('event.create'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('team.events.create') ? 'active' : '' }}" href="{{ route('team.events.create') }}">
                                    <i class="fas fa-plus"></i>Add Event
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                <!-- Project Management -->
                @if($team->hasPermission('project.view'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('team.projects.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#projectSubmenu" aria-expanded="{{ request()->routeIs('team.projects.*') ? 'true' : 'false' }}">
                        <i class="fas fa-project-diagram"></i>Projects
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse db-submenu {{ request()->routeIs('team.projects.*') ? 'show' : '' }}" id="projectSubmenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('team.projects.index') ? 'active' : '' }}" href="{{ route('team.projects.index') }}">
                                    <i class="fas fa-list"></i>All Projects
                                </a>
                            </li>
                            @if($team->hasPermission('project.create'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('team.projects.create') ? 'active' : '' }}" href="{{ route('team.projects.create') }}">
                                    <i class="fas fa-plus"></i>Add Project
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                <!-- Gallery Management -->
                @if($team->hasPermission('gallery.view'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('team.galleries.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#gallerySubmenu" aria-expanded="{{ request()->routeIs('team.galleries.*') ? 'true' : 'false' }}">
                        <i class="fas fa-images"></i>Gallery
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse db-submenu {{ request()->routeIs('team.galleries.*') ? 'show' : '' }}" id="gallerySubmenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('team.galleries.index') ? 'active' : '' }}" href="{{ route('team.galleries.index') }}">
                                    <i class="fas fa-list"></i>All Galleries
                                </a>
                            </li>
                            @if($team->hasPermission('gallery.create'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('team.galleries.create') ? 'active' : '' }}" href="{{ route('team.galleries.create') }}">
                                    <i class="fas fa-plus"></i>Add Gallery
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                <!-- Service Management -->
                @if($team->hasPermission('service.view'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('team.services.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#serviceSubmenu" aria-expanded="{{ request()->routeIs('team.services.*') ? 'true' : 'false' }}">
                        <i class="fas fa-cogs"></i>Services
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse db-submenu {{ request()->routeIs('team.services.*') ? 'show' : '' }}" id="serviceSubmenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('team.services.index') ? 'active' : '' }}" href="{{ route('team.services.index') }}">
                                    <i class="fas fa-list"></i>All Services
                                </a>
                            </li>
                            @if($team->hasPermission('service.create'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('team.services.create') ? 'active' : '' }}" href="{{ route('team.services.create') }}">
                                    <i class="fas fa-plus"></i>Add Service
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                <!-- Contact Management -->
                @if($team->hasPermission('contact.view'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('team.contacts.*') ? 'active' : '' }}" href="{{ route('team.contacts.index') }}">
                        <i class="fas fa-envelope"></i>Contact Messages
                    </a>
                </li>
                @endif


                <!-- View Website - Always visible -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}" target="_blank">
                        <i class="fas fa-external-link-alt"></i>View Website
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('team.logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Stack for additional scripts -->
    @stack('scripts')

    <!-- Toast Notifications -->
    <script>
        // Toast notification function
        function showToast(type, message) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: type,
                title: message
            });
        }

        // Check for session messages and show toasts
        @if(session('success'))
            showToast('success', '{{ session('success') }}');
        @endif

        @if(session('error'))
            showToast('error', '{{ session('error') }}');
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                showToast('error', '{{ $error }}');
            @endforeach
        @endif
    </script>

    <script>
        // Mobile sidebar toggle
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });

        // Close sidebar when clicking overlay
        document.getElementById('sidebarOverlay').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });

        // Close sidebar on window resize (if mobile)
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebarOverlay');

                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            }
        });
    </script>
</body>
</html>
