<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CtaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ResearchAreaController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\TeamAuthController;
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
Route::get('/team/{team}', function (App\Models\Team $team) {
    return view('team.member', compact('team'));
})->name('team.member');

// Additional pages
Route::get('/research', function () {
    return view('research');
})->name('research');

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

// Team Authentication Routes
Route::get('/team-login', [TeamAuthController::class, 'showLogin'])->name('team.login');
Route::post('/team-login', [TeamAuthController::class, 'login'])->name('team.login.post');
Route::post('/team-logout', [TeamAuthController::class, 'logout'])->name('team.logout');

// Team Dashboard Routes (Protected by Team Auth)
Route::middleware('team.auth')->group(function () {
    Route::get('/team-dashboard', [TeamDashboardController::class, 'index'])->name('team.dashboard');
    Route::get('/team-profile', [TeamAuthController::class, 'profile'])->name('team.profile');
    Route::put('/team-profile', [TeamAuthController::class, 'updateProfile'])->name('team.profile.update');
});

// Dashboard Routes (Protected by Auth)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Banner Management Routes
    Route::resource('dashboard/banners', BannerController::class, ['as' => 'dashboard']);

    // Research Areas Management Routes
    Route::resource('dashboard/research-areas', ResearchAreaController::class, ['as' => 'dashboard']);

    // About Sections Management Routes
    Route::resource('dashboard/abouts', AboutController::class, ['as' => 'dashboard']);

    // Services Management Routes
    Route::resource('dashboard/services', ServiceController::class, ['as' => 'dashboard']);

    // CTA Management Routes
    Route::resource('dashboard/ctas', CtaController::class, ['as' => 'dashboard']);

    // Publications Management Routes (simplified - single page)
    Route::get('/dashboard/publications', [PublicationController::class, 'edit'])->name('dashboard.publications.edit');
    Route::put('/dashboard/publications', [PublicationController::class, 'update'])->name('dashboard.publications.update');

    // Project Categories Management Routes
    Route::resource('dashboard/project-categories', ProjectCategoryController::class, ['as' => 'dashboard']);

    // Projects Management Routes
    Route::resource('dashboard/projects', ProjectController::class, ['as' => 'dashboard']);

    // Events Management Routes
    Route::resource('dashboard/events', EventController::class, ['as' => 'dashboard']);

    // Team Management Routes
    Route::resource('dashboard/teams', TeamController::class, ['as' => 'dashboard']);

    // Blog Categories Management Routes
    Route::resource('dashboard/blog-categories', BlogCategoryController::class, ['as' => 'dashboard']);

    // Blog Management Routes
    Route::resource('dashboard/blogs', BlogController::class, ['as' => 'dashboard']);

    // News Management Routes
    Route::resource('dashboard/news', NewsController::class, ['as' => 'dashboard']);

    // Contact Messages Management Routes
    Route::resource('dashboard/contact-messages', ContactController::class, ['as' => 'dashboard'])->except(['create', 'edit', 'store']);
    Route::put('/dashboard/contact-messages/{contactMessage}/status', [ContactController::class, 'updateStatus'])->name('dashboard.contact-messages.update-status');

    // Settings Management Routes
    Route::get('/dashboard/settings', [SettingsController::class, 'index'])->name('dashboard.settings.index');
    Route::put('/dashboard/settings', [SettingsController::class, 'update'])->name('dashboard.settings.update');

    // Social Media Management Routes
    Route::resource('dashboard/social-media', SocialMediaController::class, [
        'as' => 'dashboard',
    ])->parameters(['social-media' => 'socialMedia']);
});

// 404 Not Found Route (must be last)
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
