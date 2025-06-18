<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\CommentController;



Route::get('/', [PostController::class, 'show'])->name('home');
Route::match(['get', 'post'], '/blogs/{slug}', [PostController::class, 'view'])->name('blogs.show');


Route::get('/detail', function () {
    return view('detail');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/timeout-error', function () {
    return view('errors.timeout');
});


// Email Verify Route

Route::get('/email/verify', function () {
    return view('auth.verify-mail');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request){
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notify', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification Link Sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// Login Route

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// Admin Panel

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'index'])->name('posts.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/dashboard', [PostController::class, 'dashboard'])->name('dashboard');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});