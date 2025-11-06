<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CtaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryCategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PortfolioAboutController;
use App\Http\Controllers\PortfolioBannerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ResearchAreaController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\TeamAuthController;
use App\Http\Controllers\TeamCategoryController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamDashboardController;
use Illuminate\Support\Facades\Route;

// Home routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/projects', [HomeController::class, 'projects'])->name('projects');

// Publications page (single page)
Route::get('/publications', [PublicationController::class, 'publicIndex'])->name('publications');

// Projects page
Route::get('/projects', [ProjectController::class, 'publicIndex'])->name('projects');
Route::get('/projects/{id}', [ProjectController::class, 'showProject'])->name('project.details');

// Research routes
Route::get('/research', [ResearchController::class, 'publicIndex'])->name('research');
Route::get('/research/{research}', [ResearchController::class, 'publicShow'])->name('research.details');

// Events routes
Route::get('/events', [EventController::class, 'publicIndex'])->name('events');
Route::get('/events/{id}', [EventController::class, 'showEvent'])->name('event.details');

// Team page
Route::get('/team', [HomeController::class, 'team'])->name('team');

// News page
Route::get('/news', [HomeController::class, 'news'])->name('news');
Route::get('/news/{id}', [HomeController::class, 'newsDetail'])->name('news.detail');

// Blog page
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/blog/{id}', [HomeController::class, 'blogDetail'])->name('blog.detail');

// Contact page
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Contact message submission
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Newsletter subscription routes
Route::post('/newsletter/subscribe', [\App\Http\Controllers\Dashboard\NewsletterSubscriberController::class, 'subscribe'])->name('newsletter.subscribe');

// About page
Route::get('/about', function () {
    return view('about');
})->name('about');

// Services pages
Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/services/laboratory', function () {
    return view('services.laboratory');
})->name('services.laboratory');

Route::get('/services/analytical', function () {
    return view('services.analytical');
})->name('services.analytical');

Route::get('/services/accreditation', function () {
    return view('services.accreditation');
})->name('services.accreditation');

Route::get('/services/robotics', function () {
    return view('services.robotics');
})->name('services.robotics');

Route::get('/services/diabetes', function () {
    return view('services.diabetes');
})->name('services.diabetes');

Route::get('/services/pathology', function () {
    return view('services.pathology');
})->name('services.pathology');

Route::get('/services/healthcare', function () {
    return view('services.healthcare');
})->name('services.healthcare');

Route::get('/services/energy', function () {
    return view('services.energy');
})->name('services.energy');

Route::get('/services/ai', function () {
    return view('services.ai');
})->name('services.ai');

// Team member pages
Route::get('/member/{team}', function (App\Models\Team $team) {
    return view('team.member', compact('team'));
})->whereNumber('team')->name('team.member');

// Additional pages
Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

Route::get('/services/scientific', function () {
    return view('services.scientific');
})->name('services.scientific');

Route::get('/services/chemistry', function () {
    return view('services.chemistry');
})->name('services.chemistry');

Route::get('/services/gemological', function () {
    return view('services.gemological');
})->name('services.gemological');

Route::get('/services/forensic', function () {
    return view('services.forensic');
})->name('services.forensic');

Route::get('/services/immunology', function () {
    return view('services.immunology');
})->name('services.immunology');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Team Authentication Routes
Route::get('/team-login', [TeamAuthController::class, 'showLogin'])->name('team.login');
Route::post('/team-login', [TeamAuthController::class, 'login'])->name('team.login.post');
Route::post('/team-logout', [TeamAuthController::class, 'logout'])->name('team.logout');

// Team Password Reset Routes
Route::get('/team-forgot-password', [TeamAuthController::class, 'showForgotPassword'])->name('team.password.request');
Route::post('/team-forgot-password', [TeamAuthController::class, 'sendResetLink'])->name('team.password.email');
Route::get('/team-reset-password/{token}', [TeamAuthController::class, 'showResetPassword'])->name('team.password.reset');
Route::post('/team-reset-password', [TeamAuthController::class, 'resetPassword'])->name('team.password.update');

// Team Dashboard Routes (Protected by Team Auth with role-based permissions)
Route::middleware([\App\Http\Middleware\TeamAuth::class])->group(function () {
    Route::get('/team-dashboard', [TeamDashboardController::class, 'index'])->name('team.dashboard');
    Route::get('/team-profile', [TeamAuthController::class, 'profile'])->name('team.profile');
    Route::put('/team-profile', [TeamAuthController::class, 'updateProfile'])->name('team.profile.update');

    // Team Research Management Routes
    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':research.view'])->group(function () {
        Route::get('/team/researches', [\App\Http\Controllers\Team\ResearchController::class, 'index'])->name('team.researches.index');
        Route::get('/team/researches/{research}', [\App\Http\Controllers\Team\ResearchController::class, 'show'])->whereNumber('research')->name('team.researches.show');
    });

    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':research.create'])->group(function () {
        Route::get('/team/researches/create', [\App\Http\Controllers\Team\ResearchController::class, 'create'])->name('team.researches.create');
        Route::post('/team/researches', [\App\Http\Controllers\Team\ResearchController::class, 'store'])->name('team.researches.store');
    });

    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':research.edit'])->group(function () {
        Route::get('/team/researches/{research}/edit', [\App\Http\Controllers\Team\ResearchController::class, 'edit'])->whereNumber('research')->name('team.researches.edit');
        Route::put('/team/researches/{research}', [\App\Http\Controllers\Team\ResearchController::class, 'update'])->whereNumber('research')->name('team.researches.update');
    });

    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':research.delete'])->group(function () {
        Route::delete('/team/researches/{research}', [\App\Http\Controllers\Team\ResearchController::class, 'destroy'])->whereNumber('research')->name('team.researches.destroy');
    });

    // Team Blog Management Routes
    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':blog.view'])->group(function () {
        Route::get('/team/blogs', [\App\Http\Controllers\Team\BlogController::class, 'index'])->name('team.blogs.index');
        Route::get('/team/blogs/{blog}', [\App\Http\Controllers\Team\BlogController::class, 'show'])->whereNumber('blog')->name('team.blogs.show');
    });

    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':blog.create'])->group(function () {
        Route::get('/team/blogs/create', [\App\Http\Controllers\Team\BlogController::class, 'create'])->name('team.blogs.create');
        Route::post('/team/blogs', [\App\Http\Controllers\Team\BlogController::class, 'store'])->name('team.blogs.store');
    });

    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':blog.edit'])->group(function () {
        Route::get('/team/blogs/{blog}/edit', [\App\Http\Controllers\Team\BlogController::class, 'edit'])->whereNumber('blog')->name('team.blogs.edit');
        Route::put('/team/blogs/{blog}', [\App\Http\Controllers\Team\BlogController::class, 'update'])->whereNumber('blog')->name('team.blogs.update');
    });

    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':blog.delete'])->group(function () {
        Route::delete('/team/blogs/{blog}', [\App\Http\Controllers\Team\BlogController::class, 'destroy'])->whereNumber('blog')->name('team.blogs.destroy');
    });

    // Team News Management Routes
    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':news.view'])->group(function () {
        Route::get('/team/news', [\App\Http\Controllers\Team\NewsController::class, 'index'])->name('team.news.index');
        Route::get('/team/news/{news}', [\App\Http\Controllers\Team\NewsController::class, 'show'])->name('team.news.show');
    });

    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':news.create'])->group(function () {
        Route::get('/team/news/create', [\App\Http\Controllers\Team\NewsController::class, 'create'])->name('team.news.create');
        Route::post('/team/news', [\App\Http\Controllers\Team\NewsController::class, 'store'])->name('team.news.store');
    });

    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':news.edit'])->group(function () {
        Route::get('/team/news/{news}/edit', [\App\Http\Controllers\Team\NewsController::class, 'edit'])->name('team.news.edit');
        Route::put('/team/news/{news}', [\App\Http\Controllers\Team\NewsController::class, 'update'])->name('team.news.update');
    });

    // Team Event Management Routes
    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':event.view'])->group(function () {
        Route::get('/team/events', [\App\Http\Controllers\Team\EventController::class, 'index'])->name('team.events.index');
        Route::get('/team/events/{event}', [\App\Http\Controllers\Team\EventController::class, 'show'])->whereNumber('event')->name('team.events.show');
    });

    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':event.create'])->group(function () {
        Route::get('/team/events/create', [\App\Http\Controllers\Team\EventController::class, 'create'])->name('team.events.create');
        Route::post('/team/events', [\App\Http\Controllers\Team\EventController::class, 'store'])->name('team.events.store');
    });

    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':event.edit'])->group(function () {
        Route::get('/team/events/{event}/edit', [\App\Http\Controllers\Team\EventController::class, 'edit'])->whereNumber('event')->name('team.events.edit');
        Route::put('/team/events/{event}', [\App\Http\Controllers\Team\EventController::class, 'update'])->whereNumber('event')->name('team.events.update');
    });
    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':event.delete'])->group(function () {
        Route::delete('/team/events/{event}', [\App\Http\Controllers\Team\EventController::class, 'destroy'])->whereNumber('event')->name('team.events.destroy');
    });

    // Team Project Management Routes
    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':project.view'])->group(function () {
        Route::get('/team/projects', [\App\Http\Controllers\Team\ProjectController::class, 'index'])->name('team.projects.index');
        Route::get('/team/projects/{project}', [\App\Http\Controllers\Team\ProjectController::class, 'show'])->whereNumber('project')->name('team.projects.show');
    });

    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':project.create'])->group(function () {
        Route::get('/team/projects/create', [\App\Http\Controllers\Team\ProjectController::class, 'create'])->name('team.projects.create');
        Route::post('/team/projects', [\App\Http\Controllers\Team\ProjectController::class, 'store'])->name('team.projects.store');
    });

    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':project.edit'])->group(function () {
        Route::get('/team/projects/{project}/edit', [\App\Http\Controllers\Team\ProjectController::class, 'edit'])->whereNumber('project')->name('team.projects.edit');
        Route::put('/team/projects/{project}', [\App\Http\Controllers\Team\ProjectController::class, 'update'])->whereNumber('project')->name('team.projects.update');
    });

    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':project.delete'])->group(function () {
        Route::delete('/team/projects/{project}', [\App\Http\Controllers\Team\ProjectController::class, 'destroy'])->whereNumber('project')->name('team.projects.destroy');
    });

    // Team Gallery Management Routes
    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':gallery.view'])->group(function () {
        Route::get('/team/galleries', [\App\Http\Controllers\Team\GalleryController::class, 'index'])->name('team.galleries.index');
        Route::get('/team/galleries/{gallery}', [\App\Http\Controllers\Team\GalleryController::class, 'show'])->whereNumber('gallery')->name('team.galleries.show');
    });

    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':gallery.create'])->group(function () {
        Route::get('/team/galleries/create', [\App\Http\Controllers\Team\GalleryController::class, 'create'])->name('team.galleries.create');
        Route::post('/team/galleries', [\App\Http\Controllers\Team\GalleryController::class, 'store'])->name('team.galleries.store');
    });

    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':gallery.edit'])->group(function () {
        Route::get('/team/galleries/{gallery}/edit', [\App\Http\Controllers\Team\GalleryController::class, 'edit'])->whereNumber('gallery')->name('team.galleries.edit');
        Route::put('/team/galleries/{gallery}', [\App\Http\Controllers\Team\GalleryController::class, 'update'])->whereNumber('gallery')->name('team.galleries.update');
    });

    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':gallery.delete'])->group(function () {
        Route::delete('/team/galleries/{gallery}', [\App\Http\Controllers\Team\GalleryController::class, 'destroy'])->whereNumber('gallery')->name('team.galleries.destroy');
    });

    // Team Service Management Routes
    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':service.view'])->group(function () {
        Route::get('/team/services', [\App\Http\Controllers\Team\ServiceController::class, 'index'])->name('team.services.index');
        Route::get('/team/services/{service}', [\App\Http\Controllers\Team\ServiceController::class, 'show'])->name('team.services.show');
    });

    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':service.create'])->group(function () {
        Route::get('/team/services/create', [\App\Http\Controllers\Team\ServiceController::class, 'create'])->name('team.services.create');
        Route::post('/team/services', [\App\Http\Controllers\Team\ServiceController::class, 'store'])->name('team.services.store');
    });

    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':service.edit'])->group(function () {
        Route::get('/team/services/{service}/edit', [\App\Http\Controllers\Team\ServiceController::class, 'edit'])->name('team.services.edit');
        Route::put('/team/services/{service}', [\App\Http\Controllers\Team\ServiceController::class, 'update'])->name('team.services.update');
    });

    // Team Contact Management Routes
    Route::middleware([\App\Http\Middleware\CheckPermission::class . ':contact.view'])->group(function () {
        Route::get('/team/contacts', [\App\Http\Controllers\Team\ContactController::class, 'index'])->name('team.contacts.index');
        Route::get('/team/contacts/{contact}', [\App\Http\Controllers\Team\ContactController::class, 'show'])->name('team.contacts.show');
    });
});

// Dashboard Routes (Protected by Auth only - temporarily removing permissions)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Research Management Routes
    Route::resource('dashboard/researches', ResearchController::class, ['as' => 'dashboard']);
    Route::post('dashboard/researches/update-order', [ResearchController::class, 'updateOrder'])->name('dashboard.researches.update-order');

    // Team Management Routes
    Route::resource('dashboard/teams', TeamController::class, ['as' => 'dashboard']);
    Route::resource('dashboard/team-categories', TeamCategoryController::class, ['as' => 'dashboard']);
    Route::post('dashboard/team-categories/{teamCategory}/toggle-status', [TeamCategoryController::class, 'toggleStatus'])->name('dashboard.team-categories.toggle-status');
    Route::post('dashboard/team-categories/{teamCategory}/update-team-order', [TeamCategoryController::class, 'updateTeamOrder'])->name('dashboard.team-categories.update-team-order');
    Route::post('dashboard/team-categories/{teamCategory}/add-team-members', [TeamCategoryController::class, 'addTeamMembers'])->name('dashboard.team-categories.add-team-members');
    Route::delete('dashboard/team-categories/{teamCategory}/teams/{team}', [TeamCategoryController::class, 'removeTeamMember'])->name('dashboard.team-categories.remove-team-member');
    Route::get('dashboard/team-categories/{teamCategory}/available-teams', [TeamCategoryController::class, 'getAvailableTeams'])->name('dashboard.team-categories.available-teams');

    // Home Team Management Routes
    Route::get('dashboard/home-teams', [\App\Http\Controllers\HomeTeamController::class, 'manage'])->name('dashboard.home-teams.manage');
    Route::post('dashboard/home-teams/add', [\App\Http\Controllers\HomeTeamController::class, 'addTeams'])->name('dashboard.home-teams.add');
    Route::delete('dashboard/home-teams/{homeTeam}', [\App\Http\Controllers\HomeTeamController::class, 'removeTeam'])->name('dashboard.home-teams.remove');
    Route::post('dashboard/home-teams/update-order', [\App\Http\Controllers\HomeTeamController::class, 'updateOrder'])->name('dashboard.home-teams.update-order');
    Route::post('dashboard/home-teams/{homeTeam}/toggle-status', [\App\Http\Controllers\HomeTeamController::class, 'toggleStatus'])->name('dashboard.home-teams.toggle-status');
    Route::get('dashboard/home-teams/available', [\App\Http\Controllers\HomeTeamController::class, 'getAvailableTeams'])->name('dashboard.home-teams.available');

    // Role Management Routes
    Route::resource('dashboard/roles', \App\Http\Controllers\RoleController::class, ['as' => 'dashboard']);
    Route::post('dashboard/roles/{role}/toggle-status', [\App\Http\Controllers\RoleController::class, 'toggleStatus'])->name('dashboard.roles.toggle-status');

    // Permission Management Routes
    Route::resource('dashboard/permissions', \App\Http\Controllers\PermissionController::class, ['as' => 'dashboard']);
    Route::post('dashboard/permissions/{permission}/toggle-status', [\App\Http\Controllers\PermissionController::class, 'toggleStatus'])->name('dashboard.permissions.toggle-status');

    // Blog Management Routes
    Route::resource('dashboard/blogs', BlogController::class, ['as' => 'dashboard']);
    Route::resource('dashboard/blog-categories', BlogCategoryController::class, ['as' => 'dashboard']);

    // News Management Routes
    Route::resource('dashboard/news', NewsController::class, ['as' => 'dashboard']);

    // Event Management Routes
    Route::resource('dashboard/events', EventController::class, ['as' => 'dashboard']);

    // Project Management Routes
    Route::resource('dashboard/projects', ProjectController::class, ['as' => 'dashboard']);
    Route::resource('dashboard/project-categories', ProjectCategoryController::class, ['as' => 'dashboard']);

    // Gallery Management Routes
    Route::resource('dashboard/galleries', GalleryController::class, ['as' => 'dashboard']);
    Route::resource('dashboard/gallery-categories', GalleryCategoryController::class, ['as' => 'dashboard']);

    // Service Management Routes
    Route::resource('dashboard/services', ServiceController::class, ['as' => 'dashboard']);

    // Contact Management Routes
    Route::resource('dashboard/contact-messages', ContactController::class, ['as' => 'dashboard'])->except(['create', 'edit', 'store']);
    Route::put('dashboard/contact-messages/{contactMessage}/update-status', [ContactController::class, 'updateStatus'])->name('dashboard.contact-messages.update-status');

    // Newsletter Management Routes
    Route::resource('dashboard/newsletter-subscribers', \App\Http\Controllers\Dashboard\NewsletterSubscriberController::class, ['as' => 'dashboard']);
    Route::get('dashboard/newsletter-subscribers/export', [\App\Http\Controllers\Dashboard\NewsletterSubscriberController::class, 'export'])
        ->name('dashboard.newsletter-subscribers.export');
    Route::post('dashboard/newsletter-subscribers/{newsletterSubscriber}/status', [\App\Http\Controllers\Dashboard\NewsletterSubscriberController::class, 'updateStatus'])
        ->whereNumber('newsletterSubscriber')
        ->name('dashboard.newsletter-subscribers.update-status');

    // Settings Management Routes
    Route::get('/dashboard/settings', [SettingsController::class, 'index'])->name('dashboard.settings.index');
    Route::put('/dashboard/settings', [SettingsController::class, 'update'])->name('dashboard.settings.update');

    // Other routes
    Route::resource('dashboard/banners', BannerController::class, ['as' => 'dashboard']);
    Route::resource('dashboard/portfolio-banners', PortfolioBannerController::class, ['as' => 'dashboard']);
    Route::resource('dashboard/portfolio-abouts', PortfolioAboutController::class, ['as' => 'dashboard']);
    Route::resource('dashboard/abouts', AboutController::class, ['as' => 'dashboard']);
    Route::resource('dashboard/ctas', CtaController::class, ['as' => 'dashboard']);
    Route::resource('dashboard/research-areas', ResearchAreaController::class, ['as' => 'dashboard']);
    Route::resource('dashboard/social-media', SocialMediaController::class, ['as' => 'dashboard'])->parameters(['social-media' => 'social_medium']);
    Route::resource('dashboard/achievements', AchievementController::class, ['as' => 'dashboard']);

    // Publications Management Routes
    Route::get('/dashboard/publications', [PublicationController::class, 'edit'])->name('dashboard.publications.edit');
    Route::put('/dashboard/publications', [PublicationController::class, 'update'])->name('dashboard.publications.update');

    // Profile Management Routes
    Route::resource('dashboard/profiles', ProfileController::class, ['as' => 'dashboard']);
    Route::get('/dashboard/profile', [\App\Http\Controllers\UserProfileController::class, 'edit'])->name('dashboard.profile.edit');
    Route::put('/dashboard/profile', [\App\Http\Controllers\UserProfileController::class, 'update'])->name('dashboard.profile.update');
});

// 404 Not Found Route (must be last)
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
