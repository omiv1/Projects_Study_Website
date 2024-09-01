<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/comments',[\App\Http\Controllers\CommentController::class,'index']);



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/home', [App\Http\Controllers\CommentController::class, 'index'])->name('home');
Route::get('/comments', [App\Http\Controllers\CommentController::class, 'index'])->name('comments');
Route::get('/create', [App\Http\Controllers\CommentController::class, 'create'])->name('create');
Route::post('/create', [App\Http\Controllers\CommentController::class, 'store'])->name('store');
Route::get('/delete/{id}', [App\Http\Controllers\CommentController::class,'destroy'])->name('delete');
Route::get('/edit/{id}', [App\Http\Controllers\CommentController::class,'edit'])->name('edit');
Route::put('/update/{id}', [App\Http\Controllers\CommentController::class,'update'])->name('update');

require __DIR__.'/auth.php';
