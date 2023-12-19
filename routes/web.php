<?php

use App\Http\Controllers\FakultasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use Illuminate\Support\Facades\Auth;
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
// Route ::get('/fakultas', function(){
//     return view ('fakultas');
// });

//admin
Route::middleware('auth')->group(function(){
    Route::resource('fakultas', FakultasController::class);
    Route::resource('prodi',ProdiController::class);
    Route::resource('mahasiswa',MahasiswaController::class);
});

// //user
// Route::middleware(['auth', 'checkRole:U'])->group(function(){
//     Route::get('/fakultas', [FakultasController::class, 'index'])->name('fakultas.index');


// });

// Route ::get('/mahasiswa', function(){
//     $data = [
//         ["npm" => 2226250091, "nama" => "Jihan"],
//         ["npm" => 2226250104, "nama" => "Bryant"],
//     ];
//     return view ('mahasiswa.index')->with('mahasiswa', $data);
// });
// require __DIR__.'/auth.php';
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['checkRole:A,U'])->name('home');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
