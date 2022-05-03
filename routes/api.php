<?php

use App\Http\Controllers\APIAuthController;
use App\Http\Controllers\ProtectedAPI;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentWithAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::controller(StudentController::class)->group(function(){
    Route::get('st/list','index');
    Route::post('st/store','store');    
    Route::get('st/show/{student}','show');
    Route::put('st/update/{student}','update');
    Route::delete('st/delete/{student}','destroy');
});



Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('protected/student',StudentWithAuthController::class);    
});

Route::post('register',[APIAuthController::class,'register']);
Route::get('login',[APIAuthController::class,'login']);
Route::get('logout',[APIAuthController::class,'logout']);