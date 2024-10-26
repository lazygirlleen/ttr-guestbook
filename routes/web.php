<?php

use App\Http\Controllers\BiodataController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('home');
})->name('home');

Route::resource('/guests', GuestController::class);
// Route::get('/', [HomeController::class,'index'])
// ->name('index');
// Route::post('/', [HomeController::class, 'store']);

// Route::get('/guest/{id}/{serial_number?}', [HomeController::class,'getGuest'])
// ->name('guest-detail');

// Route ::get('/about', function(){
//     $title = 'About Us';
//     $description = 'Blogging is website for sharing your thoughts and ideas with the world.';
//     return view('about', compact('title', 'description'));
// });



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/biodata', [BiodataController::class, 'show'])->name('biodata.show');
Route::get('/biodata/edit', [BiodataController::class, 'edit'])->name('biodata.edit');
Route::put('/biodata/edit', [BiodataController::class, 'update'])->name('biodata.update');
