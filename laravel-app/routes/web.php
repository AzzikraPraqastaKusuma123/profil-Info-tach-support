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

Route::get('/dGVudGFuZ19rYW1pX3NlY3VyZV90b2tlbl9hMWIyYzNkNGU1ZjZnN2g4X3ZlcmlmaWNhdGlvbl9rZXlfcHRfaXRzXzIwMjZfcHJvZmlsZQ==', function () {
    return view('tentang-kami');
})->name('tentang-kami');

Route::get('/bGF5YW5hbl9rYW1pX3NlcnZpY2VzX3NlY3VyZV90b2tlbl96OXk4eDd3NnY1dTR0M3MyX3ZlcmlmaWNhdGlvbl9rZXlfcHRfaXRzXzIwMjZfcHJvZmlsZQ==', function () {
    $services = Service::all();
    return view('layanan-kami', compact('services'));
})->name('layanan-kami');

Route::get('/a2xpZW5fa2FtaV9jbGllbnRzX3NlY3VyZV90b2tlbl9xMXcyZTNyNHQ1eTZ1N2k4X3ZlcmlmaWNhdGlvbl9rZXlfcHRfaXRzXzIwMjZfcHJvZmlsZQ==', function () {
    $clients = Client::all();
    return view('klien-kami', compact('clients'));
})->name('klien-kami');

Route::get('/aW5mb3JtYXNpX25ld3Nfc2VjdXJlX3Rva2VuX20wbjliOHY3YzZ4NXo0bDNfdmVyaWZpY2F0aW9uX2tleV9wdF9pdHNfMjAyNl9wcm9maWxl', function () {
    $articles = Information::all();
    return view('informasi', compact('articles'));
})->name('informasi');

// Redirects from old routes to obfuscated ones
Route::redirect('/tentang-kami', '/dGVudGFuZ19rYW1pX3NlY3VyZV90b2tlbl9hMWIyYzNkNGU1ZjZnN2g4X3ZlcmlmaWNhdGlvbl9rZXlfcHRfaXRzXzIwMjZfcHJvZmlsZQ==', 301);
Route::redirect('/layanan-kami', '/bGF5YW5hbl9rYW1pX3NlcnZpY2VzX3NlY3VyZV90b2tlbl96OXk4eDd3NnY1dTR0M3MyX3ZlcmlmaWNhdGlvbl9rZXlfcHRfaXRzXzIwMjZfcHJvZmlsZQ==', 301);
Route::redirect('/klien-kami', '/a2xpZW5fa2FtaV9jbGllbnRzX3NlY3VyZV90b2tlbl9xMXcyZTNyNHQ1eTZ1N2k4X3ZlcmlmaWNhdGlvbl9rZXlfcHRfaXRzXzIwMjZfcHJvZmlsZQ==', 301);
Route::redirect('/informasi', '/aW5mb3JtYXNpX25ld3Nfc2VjdXJlX3Rva2VuX20wbjliOHY3YzZ4NXo0bDNfdmVyaWZpY2F0aW9uX2tleV9wdF9pdHNfMjAyNl9wcm9maWxl', 301);

// Redirects from old short obfuscated routes to new long obfuscated ones
Route::redirect('/dGVudGFuZy1rYW1p', '/dGVudGFuZ19rYW1pX3NlY3VyZV90b2tlbl9hMWIyYzNkNGU1ZjZnN2g4X3ZlcmlmaWNhdGlvbl9rZXlfcHRfaXRzXzIwMjZfcHJvZmlsZQ==', 301);
Route::redirect('/bGF5YW5hbi1rYW1p', '/bGF5YW5hbl9rYW1pX3NlcnZpY2VzX3NlY3VyZV90b2tlbl96OXk4eDd3NnY1dTR0M3MyX3ZlcmlmaWNhdGlvbl9rZXlfcHRfaXRzXzIwMjZfcHJvZmlsZQ==', 301);
Route::redirect('/a2xpZW4ta2FtaQ==', '/a2xpZW5fa2FtaV9jbGllbnRzX3NlY3VyZV90b2tlbl9xMXcyZTNyNHQ1eTZ1N2k4X3ZlcmlmaWNhdGlvbl9rZXlfcHRfaXRzXzIwMjZfcHJvZmlsZQ==', 301);
Route::redirect('/aW5mb3JtYXNp', '/aW5mb3JtYXNpX25ld3Nfc2VjdXJlX3Rva2VuX20wbjliOHY3YzZ4NXo0bDNfdmVyaWZpY2F0aW9uX2tleV9wdF9pdHNfMjAyNl9wcm9maWxl', 301);

// Redirects from previous prefix-identical long obfuscated routes to new distinct ones
Route::redirect('/cGFnZV9zZWN1cml0eV90b2tlbl92ZXJpZmljYXRpb25fdGVudGFuZ19rYW1pX2l0c3VwcG9ydF8yMDI2X3NlY3VyZV9yb3V0ZV9oYXNo', '/dGVudGFuZ19rYW1pX3NlY3VyZV90b2tlbl9hMWIyYzNkNGU1ZjZnN2g4X3ZlcmlmaWNhdGlvbl9rZXlfcHRfaXRzXzIwMjZfcHJvZmlsZQ==', 301);
Route::redirect('/cGFnZV9zZWN1cml0eV90b2tlbl92ZXJpZmljYXRpb25fbGF5YW5hbl9rYW1pX2l0c3VwcG9ydF8yMDI2X3NlY3VyZV9yb3V0ZV9oYXNo', '/bGF5YW5hbl9rYW1pX3NlcnZpY2VzX3NlY3VyZV90b2tlbl96OXk4eDd3NnY1dTR0M3MyX3ZlcmlmaWNhdGlvbl9rZXlfcHRfaXRzXzIwMjZfcHJvZmlsZQ==', 301);
Route::redirect('/cGFnZV9zZWN1cml0eV90b2tlbl92ZXJpZmljYXRpb25fa2xpZW5fa2FtaV9pdHN1cHBvcnRfMjAyNl9zZWN1cmVfcm91dGVfaGFzaA==', '/a2xpZW5fa2FtaV9jbGllbnRzX3NlY3VyZV90b2tlbl9xMXcyZTNyNHQ1eTZ1N2k4X3ZlcmlmaWNhdGlvbl9rZXlfcHRfaXRzXzIwMjZfcHJvZmlsZQ==', 301);
Route::redirect('/cGFnZV9zZWN1cml0eV90b2tlbl92ZXJpZmljYXRpb25faW5mb3JtYXNpX2l0c3VwcG9ydF8yMDI2X3NlY3VyZV9yb3V0ZV9oYXNo', '/aW5mb3JtYXNpX25ld3Nfc2VjdXJlX3Rva2VuX20wbjliOHY3YzZ4NXo0bDNfdmVyaWZpY2F0aW9uX2tleV9wdF9pdHNfMjAyNl9wcm9maWxl', 301);

// Visitor Chat API (Throttled to prevent spam and DoS)
Route::middleware('throttle:60,1')->group(function () {
    Route::post('/api/chat/takeover', [LiveChatController::class, 'requestTakeover']);
    Route::get('/api/chat/messages', [LiveChatController::class, 'getUserMessages']);
    Route::post('/api/chat/send', [LiveChatController::class, 'sendUserMessage']);
});

// Admin Authentication
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->middleware('throttle:5,1')->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

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
    Route::get('/chat/pending-count', [LiveChatController::class, 'getPendingCount'])->name('chat.pending-count');
    Route::get('/chat/sessions', [LiveChatController::class, 'listSessions'])->name('chat.sessions');
    Route::get('/chat/sessions/{id}/messages', [LiveChatController::class, 'getSessionMessages'])->name('chat.messages');
    Route::post('/chat/sessions/{id}/send', [LiveChatController::class, 'sendAdminMessage'])->name('chat.send');
    Route::post('/chat/sessions/{id}/takeover', [LiveChatController::class, 'toggleTakeover'])->name('chat.takeover');
});
