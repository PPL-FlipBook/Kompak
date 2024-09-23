<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FlipbookController;
use App\Http\Controllers\UserController;
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
Route::get('/',[UserController::class,'index'])->name('dashboard.index');
Route::get('/create',[UserController::class,'create'])->name('user.create');
Route::post('/prosesCreate',[UserController::class,'prosesCreate'])->name('user.prosesCreate');
Route::get('/edit/{id}',[UserController::class,'edit'])->name('user.edit');
Route::post('/update/{id}',[UserController::class,'update'])->name('user.update');
Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');


/*Route Book*/
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');

/*Route Flipbook*/
Route::get('/flipbook',[FlipbookController::class,'flipbook'])->name('dashboard.flipbook');
Route::get('/create-flipbook',[FlipbookController::class,'createFlipbook'])->name('flipbook.create');
Route::post('/prosesCreate-flipbook',[FlipbookController::class,'prosesCreateFlipbook'])->name('flipbook.prosesCreate');
Route::get('/edit-flipbook/{id}',[FlipbookController::class,'editFlipbook'])->name('flipbook.edit');
Route::post('/update-flipbook/{id}',[FlipbookController::class,'updateFlipbook'])->name('flipbook.update');
Route::delete('/destroy-flipbook/{id}', [FlipbookController::class, 'destroyFlipbook'])->name('flipbook.destroy');

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

