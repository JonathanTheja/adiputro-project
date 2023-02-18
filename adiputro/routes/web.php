<?php

use App\Http\Controllers\AuthController;
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

Route::get('/dashboard', function () {
    $masterNow = "masterUser";
    return view('dashboard', compact("masterNow"));
});

Route::prefix('master')->group(function () {
    Route::get('/user', function () {
        $masterNow = "masterUser";
        return view('dashboard', compact("masterNow"));
    });
    Route::get('/departemen', function () {
        $masterNow = "masterDepartemen";
        return view('dashboard', compact("masterNow"));
    });
});
