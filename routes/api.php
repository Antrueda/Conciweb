<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DocumentsController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('documentos/{id}', [DocumentsController::class, 'show'])->name('documentos.show');

Route::get('documentos/{id}/download', [DocumentsController::class, 'download'])->name('documentos.download');
Route::middleware(['Sinproc'])->group(function () {
    Route::post('/getSoporte', [DocumentsController::class, 'getSoporte']);
    Route::get('/document', [DocumentsController::class, 'index']);
    Route::get('/getDocumentos/{id}', [DocumentsController::class, 'getDocumentos' ]);
    Route::post('/getDocuments', [DocumentsController::class, 'getDocuments']);
    Route::get('/{id}/descargar', [DocumentsController::class, 'descargar'])->name('descargar');
 
    //Route::get('documentos/{id}/download', [DocumentsController::class, 'download'])->name('documentos.download');

});