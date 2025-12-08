<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\PostController;
use App\View\Components\dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'About Page']);
});

Route::get('/blog', function () {
    return view('blog', ['title' => 'Blog Page']);
});


Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact Page']);
});

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/posts', [PostController::class, 'index'])
    ->middleware('auth') 
    ->name('posts.index'); 
Route::get('/login', [LoginController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');

// Route untuk dashboard posts - hanya untuk yang sudah login

// Index - Menampilkan semua posts milik user
Route::get('/dashboard', [DashboardPostController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.index');

// Create - Form untuk membuat post baru
Route::get('/dashboard/create', [DashboardPostController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.create');

// Store - Menyimpan post baru
Route::post('/dashboard', [DashboardPostController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.store');

// Show - Menampilkan detail post berdasarkan slug
Route::get('/dashboard/{post:slug}', [DashboardPostController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.show');