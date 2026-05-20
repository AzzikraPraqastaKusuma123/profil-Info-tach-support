<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/tentang-kami', function () {
    return view('tentang-kami');
});

Route::get('/layanan-kami', function () {
    return view('layanan-kami');
});

Route::get('/klien-kami', function () {
    return view('klien-kami');
});

Route::get('/informasi', function () {
    return view('informasi');
});
