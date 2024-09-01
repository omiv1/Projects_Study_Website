<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DealCommentController;

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [\App\Http\Controllers\DashController::class, 'index']);
Route::get('/dashboard', [App\Http\Controllers\DashController::class, 'index'])->name('dashboard');
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

Route::get('/comments', [DealCommentController::class, 'index'])->name('comments.index');
Route::get('/comments/create', [DealCommentController::class, 'create'])->name('comments.create');
Route::post('/comments', [DealCommentController::class, 'store'])->name('comments.store');
Route::get('/comments/{id}/edit', [DealCommentController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{id}', [DealCommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{id}', [DealCommentController::class, 'destroy'])->name('comments.destroy');



Route::get('lang/{lang}', [\App\Http\Controllers\LanguageController::class, 'changeLanguage'])->name('lang.switch');
Route::get('/comments',[\App\Http\Controllers\CommentController::class,'index']);
//Route::get('/addDeal', [\App\Http\Controllers\DealController::class,'addDeal'])->name('addDealForm');
//Route::get('/deals', [\App\Http\Controllers\DealController::class, 'store'])->name('deals.store');

Route::get('/categoriesWithSubcategories', [App\Http\Controllers\CategoryController::class, 'showWithSubcategories'])->name('categoriesWithSubcategories');




Route::get('/addDeal', [App\Http\Controllers\DealController::class, 'create'])->name('addDeal');
Route::post('/storeDeal', [App\Http\Controllers\DealController::class, 'store'])->name('storeDeal');
Route::get('/deals', [App\Http\Controllers\DealController::class, 'index'])->name('deals');
Route::get('/deals/{id}', [App\Http\Controllers\DealController::class, 'deal'])->name('deal');
// Dodaj tę linię do pliku routes/web.php
Route::delete('/deals/{deal}', [App\Http\Controllers\DealController::class, 'destroy'])->name('deals.destroy');

Route::get('/get-subcategories/{id}', 'DealController@getSubcategories');
Route::get('/get-subcategories/{id}', 'App\Http\Controllers\DealController@getSubcategories');
Route::get('/get-subcategories/{id}', [\App\Http\Controllers\DealController::class, 'getSubcategories']);
Route::get('/get-subcategories/{id}', [\App\Http\Controllers\DealController::class, 'getSubcategories'])->name('subCategories');

Route::get('/deals/{id}', [App\Http\Controllers\DealController::class, 'deal'])->name('deals.show');
Route::post('/deals/rate', [\App\Http\Controllers\DealController::class, 'rate'])->middleware('auth');

Route::get('/addCategory', [App\Http\Controllers\CategoryController::class, 'create'])->name('addCategory');
Route::post('/storeCategory', [App\Http\Controllers\CategoryController::class, 'store'])->name('storeCategory');

Route::get('/addSubCategory', [App\Http\Controllers\SubCategoryController::class, 'create'])->name('addSubCategory');
Route::post('/storeSubCategory', [App\Http\Controllers\SubCategoryController::class, 'store'])->name('storeSubCategory');

//

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
