<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\guruController;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\siswalistController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\ViewerController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/login', function () {
    return view('login');
});

Route::get('/Admin', function () {
    return view('admin');
});
// Route::get('/master',function(){
//     return view('master');
// });

Route::get('/siswa', function () {
    return view('siswa');
});

Route::get('loging', function () {
    // buat proses login
});

Route::get('/', function () {
    return view('user');
});
Route::post('/sent', [Usercontroller::class, 'save'])->name('senter');
Route::get('/user', [Usercontroller::class, 'lives']);


Route::get('/guru', [guruController::class, 'index'])->name('admin.page');
Route::get('/guru/image/{id}', [guruController::class, 'image'])->name('admin.image');
Route::post('/guru/update-approval/{id}', [guruController::class, 'updateApproval']);

Route::get('/siswa', [siswaController::class, 'uses'])->name('viewer.source');

Route::delete('/admin/siswa/{id}', [AdminController::class, 'destroy_siswa'])->name('admin.siswa.destroy');
Route::post('/admin/siswa', [AdminController::class, 'siswamade'])->name('admin.siswa.made');
Route::get('/admin/siswa', [AdminController::class, 'siswalist']);
Route::get('/admin', function () {
    return view('admin.index');
});
Route::get('/admin/acces', [AdminController::class, 'display'])->name('admin.display');
Route::post('/admin/acces', [AdminController::class, 'made'])->name('master.made');
Route::delete('/admin/acces/{id}', [AdminController::class, 'destroy'])->name('master.destroy');


Route::post('/login', [logincontroller::class, 'login'])->name("login.in");

Route::get('/logout', function () {
    session()->flush();
    return redirect('/login')->with('clearLocalStorage', true);
});

Route::post('/Admin/updaterole/{id}', [AdminController::class, 'updaterole']);

Route::post('/lives', [Usercontroller::class, 'lives'])->name("lives");
