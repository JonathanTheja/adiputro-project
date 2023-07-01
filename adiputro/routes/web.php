<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\MasterDepartemenController;
use App\Http\Controllers\MasterFormReportController;
use App\Http\Controllers\MasterInputController;
use App\Http\Controllers\MasterLevelController;
use App\Http\Controllers\MasterStallController;
use App\Http\Controllers\MasterUserController;
use App\Http\Controllers\ProcessEntryController;
use App\Models\ProcessEntry;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\AssignOp\Concat;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

    Route::prefix('input')->group(function () {
        Route::get('/', [MasterInputController::class,'masterInput']);

        Route::prefix('ti')->group(function () {
            Route::post('/getLevelTI', [MasterInputController::class,'getLevelTI']);
            Route::post('/getProcessEntryTI', [MasterInputController::class,'getProcessEntryTI']);
            Route::post('/getCodeComponentTI', [MasterInputController::class,'getCodeComponentTI']);
            Route::post('/getComponentTI', [MasterInputController::class,'getComponentTI']);
            Route::post('/getUserDefinedDescTI', [MasterInputController::class,'getUserDefinedDescTI']);
            Route::post('/addTI', [MasterInputController::class,'addTI']);
            Route::post('/loadKodeTI', [MasterInputController::class,'loadKodeTI']);
            Route::post('/loadInputTI', [MasterInputController::class,'loadInputTI']);
            Route::post('/approveTI', [MasterInputController::class,'approveTI']);

            Route::prefix('detail')->group(function () {
                Route::get('/{input_ti_id}', [MasterInputController::class,'getDetailTI']);
            });

        });

        Route::prefix('gt')->group(function () {
            Route::post('/add', [MasterInputController::class,'addGT']);
            Route::post('/getGTByKodeTI', [MasterInputController::class,'getGTByKodeTI']);
            Route::post('/getProcessEntryGT', [MasterInputController::class,'getProcessEntryGT']);
            Route::post('/getComponentGT', [MasterInputController::class,'getComponentGT']);
            Route::post('/getDetailComponentGT', [MasterInputController::class,'getDetailComponentGT']);
            Route::post('/getUserDefinedDescGT', [MasterInputController::class,'getUserDefinedDescGT']);
            Route::post('/approveGT', [MasterInputController::class,'approveGT']);

            Route::prefix('detail')->group(function () {
                Route::get('/{input_gt_id}', [MasterInputController::class,'getDetailGT']);
            });
        });

        Route::prefix('model')->group(function () {
            Route::post('/getDetailComponentModel', [MasterInputController::class,'getDetailComponentModel']);
            Route::post('/getDetailGTModel', [MasterInputController::class,'getDetailGTModel']);
            Route::post('/add', [MasterInputController::class,'addModel']);
        });

    });

    Route::prefix('departemen')->group(function () {
        Route::get('/', [MasterDepartemenController::class,'masterDepartemen']);
        Route::post('add', [MasterDepartemenController::class,'addDepartment']);
        Route::post('update', [MasterDepartemenController::class,'updateDepartment']);
        Route::post('delete', [MasterDepartemenController::class,'deleteDepartment']);
    });

    Route::get('/stall', [MasterStallController::class,'masterStall']);

    Route::prefix('data')->group(function () {
        Route::get('/', [MasterDataController::class,'masterData']);
        Route::post('/add', [MasterDataController::class,'addData']);
        Route::get('/update', [MasterDataController::class,'toUpdate']);
        Route::post('/doUpdate', [MasterDataController::class,'updateData']);
        Route::post('/delete', [MasterDataController::class,'deleteData']);
        Route::post('/getData', [MasterDataController::class,'getData']);
        Route::post('/getDataModal', [MasterDataController::class,'getDataModal']);
        Route::post('/getDataModal2', [MasterDataController::class,'getDataModal2']);
        Route::post('/getProcessEntryItem', [MasterDataController::class,'getProcessEntryItem']);
        Route::post('/updateSpecComponent', [MasterDataController::class,'updateSpecComponent']);
        Route::post('/placeComponentToProcess', [MasterDataController::class,'placeComponentToProcess']);
        Route::post('/deleteComponentTable', [MasterDataController::class,'deleteComponentTable']);
        Route::post('/checkToBeDeleted', [MasterDataController::class,'checkToBeDeleted']);
        Route::post('/getComponents', [MasterDataController::class,'getComponents']);
        Route::post('/getDataTemp', [MasterDataController::class,'getDataTemp']);
        Route::post('/updateQty', [MasterDataController::class,'updateQty']);
    });


});

Route::prefix('process-entry')->group(function () {
    Route::get('/', [ProcessEntryController::class,'index']);
    Route::post('/add', [ProcessEntryController::class,'addNewProcessEntry']);
    Route::post('/delete', [ProcessEntryController::class,'deleteProcessEntry']);
    Route::get('/get', [ProcessEntryController::class,'getProcessEntries']);
});

Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class,'index']);
});

Route::prefix('dokumen')->group(function () {
    Route::get('/', [DokumenController::class,'index']);
});


Route::prefix('notifikasi')->group(function () {
    Route::prefix('report')->group(function () {
        Route::get('/', [MasterFormReportController::class,'formReport']);
        Route::post('/add', [MasterFormReportController::class,'addReport']);
        Route::post('/update', [MasterFormReportController::class,'updateReport']);

        Route::prefix('approval')->group(function () {
            Route::get('/', [MasterFormReportController::class,'reportApproval']);
            Route::post('/doApprove', [MasterFormReportController::class,'doApprove']);
        });
    });
});

Route::prefix('dashboard')->group(function () {
    Route::get('/{item_level_id?}', [DashboardController::class,'dashboard']);
    Route::post('/getItemLevelParent', [DashboardController::class,'getItemLevelParent']);

    Route::prefix('report')->group(function () {
        Route::post('/getCategories', [DashboardController::class,'getCategories']);
        Route::post('/addCategory', [DashboardController::class,'addCategory']);
        Route::post('/updateCategory', [DashboardController::class,'updateCategory']);
        Route::post('/deleteCategory', [DashboardController::class,'deleteCategory']);
        Route::post('/add', [DashboardController::class,'addReport']);
        Route::post('/konfirmasi', [DashboardController::class,'konfirmasi']);
    });
});
