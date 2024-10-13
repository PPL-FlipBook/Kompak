<?php

use App\Http\Controllers\ActivitasLogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FlipbookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserRoleTransitionController;
use App\Models\Book;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*Route User*/
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/create', [DashboardController::class, 'create'])->name('user.create');
    Route::post('/prosesCreate', [DashboardController::class, 'prosesCreate'])->name('user.prosesCreate');
    Route::get('/edit/{id}', [DashboardController::class, 'edit'])->name('user.edit');
    Route::post('/update/{id}', [DashboardController::class, 'update'])->name('user.update');
    Route::delete('/destroy/{id}', [DashboardController::class, 'destroy'])->name('user.destroy');

/*auth login*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('auth.index');
    Route::post('/login', [AuthController::class, 'verify'])->name('auth.verify');
    Route::get('/register', [AuthController::class, 'register'])->name('register.index');
    Route::post('/register', [AuthController::class, 'registerProceed'])->name('register.verify');
    Route::get('/register/activation/{token}', [AuthController::class, 'registerVerify']);
    Route::get('/forgot-password', [AuthController::class, 'forgotpassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'resetPasswordEmail'])->name('password.email');
    Route::get('/password/confirmation/{token}', [AuthController::class, 'showResetPasswordConfirmation'])->name('password.confirmation');
    Route::post('/password/update/{token}', [AuthController::class, 'updatePassword'])->name('password.update');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
});

Route::get('/Logout',[AuthController::class, 'Logout'])->name('auth.logout');

/*Route Book*/
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');
Route::get('/books/{id}',[BookController::class,'flipbook'])->name('books.show');


/*Route Frontend*/
Route::get('/', [FlipbookController::class, 'index'])->name('frontend.index');
Route::get('/flipbook/{id}',[FlipbookController::class,'flipbook'])->name('frontend.example1');

/*Route Billing*/
Route::get('/billing',[Controller::class,'billing'])->name('dashboard.billing');

/*Route Kategory*/
Route::get('/kategory',[CategoryController::class,'index'])->name('kategory.index');
Route::post('/kategory',[CategoryController::class,'store'])->name('kategory.store');
Route::get('/kategory/{id}/edit', [CategoryController::class, 'edit'])->name('kategory.edit');
Route::put('/kategory/{id}',[CategoryController::class,'update'])->name('kategory.update');
Route::delete('/kategory/{id}', [CategoryController::class, 'destroy'])->name('kategory.destroy');

/*Pdf*/
Route::get('/flipbook/{id}',[BookController::class,'flipbook'])->name('frontend.example1');

/*Route Storage*/
Route::get('storage/book{filename}', function ($filename) {
    $path = storage_path('app/public/books/images/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->name('storage/book');

Route::get('pdf/{filename}', function ($filename) {
    $path = storage_path('app/public/books/pdf/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->name('pdf.view');

