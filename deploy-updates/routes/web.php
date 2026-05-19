<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\LegalController;
use App\Models\PopularRoute;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoutesController;
use App\Http\Controllers\Admin\SourcesController;
use App\Http\Controllers\Admin\AnnouncementsController;
use App\Http\Controllers\Admin\SearchesController;
use App\Http\Controllers\Admin\ClicksController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SubscribersController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\MessagesController;

// Public routes
Route::get('/', fn() => view('welcome'));
Route::get('/search', [SearchController::class, 'index']);
Route::get('/results', [SearchController::class, 'results']);
Route::get('/hotels/results', [HotelController::class, 'results']);
Route::get('/deals', fn() => view('deals', ['routes' => PopularRoute::active()->get()]));
Route::get('/about', fn() => view('about'));
Route::get('/contact', [ContactController::class, 'show']);
Route::post('/contact', [ContactController::class, 'send']);
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{post:slug}', [BlogController::class, 'show']);
Route::get('/flights/{destination:slug}', [DestinationController::class, 'show']);
Route::get('/privacy', [LegalController::class, 'privacy']);
Route::get('/terms', [LegalController::class, 'terms']);
Route::get('/sitemap.xml', [SitemapController::class, 'index']);
Route::get('/robots.txt', function () {
    return response("User-agent: *\nAllow: /\nSitemap: " . url('/sitemap.xml') . "\n", 200)
        ->header('Content-Type', 'text/plain');
});
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe']);
Route::get('/api/airports', [App\Http\Controllers\AirportController::class, 'suggest']);

// Affiliate click tracking
Route::post('/track/click', [TrackController::class, 'click'])->name('track.click');

// Admin auth
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin protected routes
Route::middleware(\App\Http\Middleware\AdminAuth::class)->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/', fn() => redirect()->route('admin.dashboard'));

    // Popular routes CRUD
    Route::get('/routes', [RoutesController::class, 'index'])->name('routes.index');
    Route::get('/routes/create', [RoutesController::class, 'create'])->name('routes.create');
    Route::post('/routes', [RoutesController::class, 'store'])->name('routes.store');
    Route::get('/routes/{route}/edit', [RoutesController::class, 'edit'])->name('routes.edit');
    Route::put('/routes/{route}', [RoutesController::class, 'update'])->name('routes.update');
    Route::delete('/routes/{route}', [RoutesController::class, 'destroy'])->name('routes.destroy');

    // Affiliate sources
    Route::get('/sources', [SourcesController::class, 'index'])->name('sources.index');
    Route::get('/sources/{source}/edit', [SourcesController::class, 'edit'])->name('sources.edit');
    Route::put('/sources/{source}', [SourcesController::class, 'update'])->name('sources.update');
    Route::patch('/sources/{source}/toggle', [SourcesController::class, 'toggleActive'])->name('sources.toggle');

    // Announcements CRUD
    Route::get('/announcements', [AnnouncementsController::class, 'index'])->name('announcements.index');
    Route::get('/announcements/create', [AnnouncementsController::class, 'create'])->name('announcements.create');
    Route::post('/announcements', [AnnouncementsController::class, 'store'])->name('announcements.store');
    Route::get('/announcements/{announcement}/edit', [AnnouncementsController::class, 'edit'])->name('announcements.edit');
    Route::put('/announcements/{announcement}', [AnnouncementsController::class, 'update'])->name('announcements.update');
    Route::delete('/announcements/{announcement}', [AnnouncementsController::class, 'destroy'])->name('announcements.destroy');

    // Blog posts CRUD
    Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostsController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostsController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostsController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostsController::class, 'destroy'])->name('posts.destroy');

    // Subscribers
    Route::get('/subscribers', [SubscribersController::class, 'index'])->name('subscribers.index');
    Route::get('/subscribers/export', [SubscribersController::class, 'export'])->name('subscribers.export');

    // Contact messages
    Route::get('/messages', [MessagesController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [MessagesController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [MessagesController::class, 'destroy'])->name('messages.destroy');

    // Data tables
    Route::get('/searches', [SearchesController::class, 'index'])->name('searches.index');
    Route::get('/clicks', [ClicksController::class, 'index'])->name('clicks.index');

    // Site settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
});
