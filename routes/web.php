<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CtaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResearchAreaController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Publications page
Route::get('/publications', function () {
    return view('publications');
})->name('publications');

// Projects page
Route::get('/projects', function () {
    return view('projects');
})->name('projects');

// Team page
Route::get('/team', function () {
    return view('team');
})->name('team');

// News page
Route::get('/news', function () {
    return view('news');
})->name('news');

// Blog page
Route::get('/blog', function () {
    return view('blog');
})->name('blog');

// Events page
Route::get('/events', function () {
    return view('events');
})->name('events');

// Contact page
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

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
Route::get('/team/{member}', function ($member) {
    return view('team.member', compact('member'));
})->name('team.member');

// Blog post pages
Route::get('/blog/{post}', function ($post) {
    return view('blog.post', compact('post'));
})->name('blog.post');

Route::get('/blog/author/{author}', function ($author) {
    return view('blog.author', compact('author'));
})->name('blog.author');

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
});

// 404 Not Found Route (must be last)
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
