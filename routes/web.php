<?php

use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ValidasiDataController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontEndController::class, 'index'])->middleware('auth');
Route::controller(ValidasiDataController::class)->group(function(){
    Route::post('save_validasi' , 'saveValidasi');
    Route::post('update_validasi' , 'updateValidasi');
    Route::post('/upload-temp-file', 'uploadTemp');
    Route::post('/validasi/finish', 'finish');
    Route::get('/validasi_result/{id}', 'result');
});

Route::controller(HistoryController::class)->group(function(){
    Route::get('history', 'index');
    Route::get('log_download', 'download');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth' , 'checkRole:1'] ] , function(){
    Route::controller(UserController::class)->group(function(){
        Route::get('/user_account' , 'index');
        Route::post('/user_account/save' , 'store');
        Route::post('/user_account/cek' , 'storeCek');
        Route::post('/user_account/update' , 'update');
        Route::get('/user_account/show/{id}' , 'getUser');
        Route::get('/user_account/delete/{id}' , 'destroy');
    });
});
