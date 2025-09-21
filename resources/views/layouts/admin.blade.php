<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"> -->
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
            <a href="{{ route('home') }}" class="brand">
                <i class="fas fa-flask me-2"></i>Lab Admin
            </a>
        </div>

        <div class="topbar-right">
            <div class="user-dropdown">
                <a href="#" class="user-dropdown-toggle" data-bs-toggle="dropdown">
                    @if(Auth::user()->profile_image)
                        <img src="{{ Auth::user()->profile_image_url }}" alt="Profile" class="user-avatar-img">
                    @else
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <span class="d-none d-sm-inline-block">{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down d-none d-sm-inline-block"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('dashboard.settings.index') }}"><i class="fas fa-cog me-2"></i>Settings</a></li>
                    <li><a class="dropdown-item" href="{{ route('dashboard.profile.edit') }}"><i class="fas fa-user me-2"></i>My Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
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
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs([
                        'dashboard.banners.*',
                        'dashboard.research-areas.*',
                        'dashboard.abouts.*',
                        'dashboard.services.*',
                        'dashboard.ctas.*',
                        'dashboard.social-media.*',
                        'dashboard.team-categories.*',
                    ]) ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#contentSubmenu" aria-expanded="{{ request()->routeIs([
                        'dashboard.banners.*',
                        'dashboard.research-areas.*',
                        'dashboard.abouts.*',
                        'dashboard.services.*',
                        'dashboard.ctas.*',
                        'dashboard.social-media.*',
                        'dashboard.team-categories.*',
                    ]) ? 'true' : 'false' }}">
                        <i class="fas fa-file-alt"></i>Lab Contents
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse db-submenu {{ request()->routeIs([
                        'dashboard.banners.*',
                        'dashboard.research-areas.*',
                        'dashboard.abouts.*',
                        'dashboard.services.*',
                        'dashboard.ctas.*',
                        'dashboard.social-media.*',
                        'dashboard.team-categories.*',
                    ]) ? 'show' : '' }}" id="contentSubmenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.banners.*') ? 'active' : '' }}" href="{{ route('dashboard.banners.index') }}">
                                    <i class="fas fa-image"></i>Home Banner
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.research-areas.*') ? 'active' : '' }}" href="{{ route('dashboard.research-areas.index') }}">
                                    <i class="fas fa-flask"></i>Research Areas
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.abouts.*') ? 'active' : '' }}" href="{{ route('dashboard.abouts.index') }}">
                                    <i class="fas fa-info-circle"></i>About Section
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.services.*') ? 'active' : '' }}" href="{{ route('dashboard.services.index') }}">
                                    <i class="fas fa-cogs"></i>Services
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.ctas.*') ? 'active' : '' }}" href="{{ route('dashboard.ctas.index') }}">
                                    <i class="fas fa-phone-alt"></i>CTA Section
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.social-media.*') ? 'active' : '' }}" href="{{ route('dashboard.social-media.index') }}">
                                    <i class="fas fa-share-alt"></i>Social Media
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.team-categories.*') ? 'active' : '' }}" href="{{ route('dashboard.team-categories.index') }}">
                                    <i class="fas fa-users"></i>Team Categories
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs([
                        'dashboard.portfolio-banners.*',
                        'dashboard.portfolio-abouts.*',
                        'dashboard.gallery-categories.*',
                        'dashboard.galleries.*',
                        'dashboard.profiles.*',
                    ]) ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#portfolioSubmenu" aria-expanded="{{ request()->routeIs([
                        'dashboard.portfolio-banners.*',
                        'dashboard.portfolio-abouts.*',
                        'dashboard.gallery-categories.*',
                        'dashboard.galleries.*',
                        'dashboard.profiles.*',
                    ]) ? 'true' : 'false' }}">
                        <i class="fas fa-briefcase"></i>Portfolio Content
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse db-submenu {{ request()->routeIs([
                        'dashboard.portfolio-banners.*',
                        'dashboard.portfolio-abouts.*',
                        'dashboard.gallery-categories.*',
                        'dashboard.galleries.*',
                        'dashboard.profiles.*',
                    ]) ? 'show' : '' }}" id="portfolioSubmenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.portfolio-banners.*') ? 'active' : '' }}" href="{{ route('dashboard.portfolio-banners.index') }}">
                                    <i class="fas fa-image"></i>Portfolio Banner
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.portfolio-abouts.*') ? 'active' : '' }}" href="{{ route('dashboard.portfolio-abouts.index') }}">
                                    <i class="fas fa-info-circle"></i>Portfolio About
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.gallery-categories.*') ? 'active' : '' }}" href="{{ route('dashboard.gallery-categories.index') }}">
                                    <i class="fas fa-folder"></i>Gallery Categories
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.galleries.*') ? 'active' : '' }}" href="{{ route('dashboard.galleries.index') }}">
                                    <i class="fas fa-images"></i>Gallery
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.profiles.*') ? 'active' : '' }}" href="{{ route('dashboard.profiles.index') }}">
                                    <i class="fas fa-user"></i>Profiles
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ request()->routeIs([
                    'dashboard.blogs.*',
                    'dashboard.blog-categories.*',
                ]) ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#blogSubmenu" aria-expanded="{{ request()->routeIs([
                    'dashboard.blogs.*',
                    'dashboard.blog-categories.*',
                ]) ? 'true' : 'false' }}">
                    <i class="fas fa-newspaper"></i>Blog Management
                    <i class="fas fa-chevron-down ms-auto"></i>
                </a>
                <div class="collapse db-submenu {{ request()->routeIs([
                    'dashboard.blogs.*',
                    'dashboard.blog-categories.*',
                ]) ? 'show' : '' }}" id="blogSubmenu">
                                    <ul class="nav flex-column ms-3">
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->routeIs('dashboard.blogs.*') ? 'active' : '' }}" href="{{ route('dashboard.blogs.index') }}">
                                                <i class="fas fa-newspaper"></i>Blog Posts
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->routeIs('dashboard.blog-categories.*') ? 'active' : '' }}" href="{{ route('dashboard.blog-categories.index') }}">
                                                <i class="fas fa-tags"></i>Blog Categories
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.researches.*') ? 'active' : '' }}" href="{{ route('dashboard.researches.index') }}">
                                    <i class="fas fa-microscope"></i>Research
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.achievements.*') ? 'active' : '' }}" href="{{ route('dashboard.achievements.index') }}">
                                    <i class="fas fa-trophy"></i>Achievements
                                </a>
                            </li>


                            <!-- <li class="nav-item">
                                 <a class="nav-link {{ request()->routeIs('dashboard.news.*') ? 'active' : '' }}" href="{{ route('dashboard.news.index') }}">
                                     <i class="fas fa-newspaper"></i>News Articles
                                 </a>
                             </li> -->

                             <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs([
                        'dashboard.project-categories.*',
                        'dashboard.projects.*',
                    ]) ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#projectsSubmenu" aria-expanded="{{ request()->routeIs([
                        'dashboard.project-categories.*',
                        'dashboard.projects.*',
                    ]) ? 'true' : 'false' }}">
                        <i class="fas fa-project-diagram"></i>Projects
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse db-submenu {{ request()->routeIs([
                        'dashboard.project-categories.*',
                        'dashboard.projects.*',
                    ]) ? 'show' : '' }}" id="projectsSubmenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.project-categories.*') ? 'active' : '' }}" href="{{ route('dashboard.project-categories.index') }}">
                                    <i class="fas fa-folder"></i>Project Categories
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.projects.*') ? 'active' : '' }}" href="{{ route('dashboard.projects.index') }}">
                                    <i class="fas fa-project-diagram"></i>All Projects
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard.publications.*') ? 'active' : '' }}" href="{{ route('dashboard.publications.edit') }}">
                        <i class="fas fa-book"></i>Publications
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard.events.*') ? 'active' : '' }}" href="{{ route('dashboard.events.index') }}">
                        <i class="fas fa-calendar"></i>Events
                    </a>
                </li>

                <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.teams.*') ? 'active' : '' }}" href="{{ route('dashboard.teams.index') }}">
                                    <i class="fas fa-users"></i>Team Members
                                </a>
                            </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard.home-teams.*') ? 'active' : '' }}" href="{{ route('dashboard.home-teams.manage') }}">
                        <i class="fas fa-home"></i>Home Team Management
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs([
                        'dashboard.roles.*',
                        'dashboard.permissions.*',
                    ]) ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#roleManagementSubmenu" aria-expanded="{{ request()->routeIs([
                        'dashboard.roles.*',
                        'dashboard.permissions.*',
                    ]) ? 'true' : 'false' }}">
                        <i class="fas fa-shield-alt"></i>Role Management
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse db-submenu {{ request()->routeIs([
                        'dashboard.roles.*',
                        'dashboard.permissions.*',
                    ]) ? 'show' : '' }}" id="roleManagementSubmenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.roles.*') ? 'active' : '' }}" href="{{ route('dashboard.roles.index') }}">
                                    <i class="fas fa-user-tag"></i>Roles
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.permissions.*') ? 'active' : '' }}" href="{{ route('dashboard.permissions.index') }}">
                                    <i class="fas fa-key"></i>Permissions
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard.newsletter-subscribers.*') ? 'active' : '' }}" href="{{ route('dashboard.newsletter-subscribers.index') }}">
                        <i class="fas fa-envelope"></i>Newsletter Subscribers
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard.contact-messages.*') ? 'active' : '' }}" href="{{ route('dashboard.contact-messages.index') }}">
                        <i class="fas fa-envelope"></i>Contact Messages
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard.settings.*') ? 'active' : '' }}" href="{{ route('dashboard.settings.index') }}">
                        <i class="fas fa-cog"></i>Settings
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
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
