<?php


use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// api/v1/customer
Route::group(['prefix' => 'v1'     ], function (){
    Route::resource('/invoices' ,  InvoiceController::class ) ;
    Route::resource('/customers' ,  CustomerController::class) ;

    Route::post('invoices/bulk' , [InvoiceController::class , 'bulkStore']);
});
