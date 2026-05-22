<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\LiveChatController;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Models\Service;
use App\Models\Client;
use App\Models\Information;

// Public Pages
Route::get('/', function () {
    return view('home');
});

Route::get('/tentang-kami', function () {
    return view('tentang-kami');
});

Route::get('/layanan-kami', function () {
    $services = Service::all();
    return view('layanan-kami', compact('services'));
});

Route::get('/klien-kami', function () {
    $clients = Client::all();
    return view('klien-kami', compact('clients'));
});

Route::get('/informasi', function () {
    $articles = Information::all();
    return view('informasi', compact('articles'));
});

// Visitor Chat API
Route::post('/api/chat/takeover', [LiveChatController::class, 'requestTakeover']);
Route::get('/api/chat/messages', [LiveChatController::class, 'getUserMessages']);
Route::post('/api/chat/send', [LiveChatController::class, 'sendUserMessage']);

// Admin Authentication
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Panel (Protected by AdminAuthMiddleware)
Route::middleware([AdminAuthMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);

    // Services CRUD
    Route::get('/services', [AdminDashboardController::class, 'servicesIndex'])->name('services');
    Route::post('/services', [AdminDashboardController::class, 'servicesStore'])->name('services.store');
    Route::post('/services/{id}/update', [AdminDashboardController::class, 'servicesUpdate'])->name('services.update');
    Route::post('/services/{id}/delete', [AdminDashboardController::class, 'servicesDestroy'])->name('services.delete');

    // Clients CRUD
    Route::get('/clients', [AdminDashboardController::class, 'clientsIndex'])->name('clients');
    Route::post('/clients', [AdminDashboardController::class, 'clientsStore'])->name('clients.store');
    Route::post('/clients/{id}/update', [AdminDashboardController::class, 'clientsUpdate'])->name('clients.update');
    Route::post('/clients/{id}/delete', [AdminDashboardController::class, 'clientsDestroy'])->name('clients.delete');

    // Information CRUD
    Route::get('/information', [AdminDashboardController::class, 'infoIndex'])->name('information');
    Route::post('/information', [AdminDashboardController::class, 'infoStore'])->name('information.store');
    Route::post('/information/{id}/update', [AdminDashboardController::class, 'infoUpdate'])->name('information.update');
    Route::post('/information/{id}/delete', [AdminDashboardController::class, 'infoDestroy'])->name('information.delete');

    // Live Chat Console
    Route::get('/chat', [LiveChatController::class, 'chatDashboard'])->name('chat');
    Route::get('/chat/sessions', [LiveChatController::class, 'listSessions'])->name('chat.sessions');
    Route::get('/chat/sessions/{id}/messages', [LiveChatController::class, 'getSessionMessages'])->name('chat.messages');
    Route::post('/chat/sessions/{id}/send', [LiveChatController::class, 'sendAdminMessage'])->name('chat.send');
    Route::post('/chat/sessions/{id}/takeover', [LiveChatController::class, 'toggleTakeover'])->name('chat.takeover');
});
