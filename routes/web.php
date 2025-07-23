<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class,'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/home', [AdminController::class,'index']);

Route::get('/category_page', [AdminController::class,'category_page']);

Route::post('/add_category', [AdminController::class, 'add_category']);

Route::get('/cat_delete/{id}', [AdminController::class,'cat_delete']);

Route::get('/edit_category/{id}', [AdminController::class,'edit_category']);

Route::post('/update_category/{id}',[AdminController::class,'update_category']);

Route::get('/add_book', [AdminController::class,'add_book']);

Route::post('/store_book', [AdminController::class,'store_book']);

Route::get('/show_book', [AdminController::class,'show_book']);

Route::get('/book_delete/{id}', [AdminController::class,'book_delete']);

Route::get('/edit_book/{id}', [AdminController::class,'edit_book']);

Route::post('/update_book/{id}', [AdminController::class,'update_book']);

Route::get('/subcat_page', [AdminController::class,'subcat_page']);

Route::post('/store_subcat', [AdminController::class,'store_subcat']);

Route::get('/get-subcategories/{category_id}', [AdminController::class, 'getSubcategories']);

Route::get('/edit_subcategory/{id}', [AdminController::class, 'edit_subcategory']);
Route::post('/update_subcategory/{id}', [AdminController::class, 'update_subcategory']);

// AJAX Route for Subcategories (Dropdown)
Route::get('/get-subcategories/{category_id}', [AdminController::class, 'getSubcategories']);

Route::get('/delete_subcategory/{id}', [AdminController::class, 'delete_subcategory']);

