<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\MasterDepartemenController;
use App\Http\Controllers\MasterFormReportController;
use App\Http\Controllers\MasterLevelController;
use App\Http\Controllers\MasterStallController;
use App\Http\Controllers\MasterUserController;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\AssignOp\Concat;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class,'index']);
Route::get('/login', [AuthController::class,'index']);
Route::post('/doLogin', [AuthController::class,'doLogin']);
Route::post('/doRegister', [AuthController::class,'doRegister']);

Route::prefix('master')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/', [MasterUserController::class,'masterUser']);
        Route::post('/update', [MasterUserController::class,'updateUser']);
        Route::post('/delete', [MasterUserController::class,'deleteUser']);
    });

    Route::prefix('departemen')->group(function () {
        Route::get('/', [MasterDepartemenController::class,'masterDepartemen']);
        Route::post('add', [MasterDepartemenController::class,'addDepartment']);
        Route::post('update', [MasterDepartemenController::class,'updateDepartment']);
        Route::post('delete', [MasterDepartemenController::class,'deleteDepartment']);
    });

    Route::get('/stall', [MasterStallController::class,'masterStall']);
    Route::get('/level', [MasterLevelController::class,'masterLevel']);

    Route::prefix('data')->group(function () {
        Route::get('/', [MasterDataController::class,'masterData']);
        Route::post('/add', [MasterDataController::class,'addData']);
        Route::get('/update', [MasterDataController::class,'toUpdate']);
        Route::post('/doUpdate', [MasterDataController::class,'updateData']);
        Route::post('/delete', [MasterDataController::class,'deleteData']);
        Route::post('/getData', [MasterDataController::class,'getData']);
    });

    Route::prefix('form')->group(function () {
        Route::prefix('report')->group(function () {
            Route::get('/', [MasterFormReportController::class,'formReport']);
            Route::post('/add', [MasterFormReportController::class,'addReport']);
        });
    });
});

