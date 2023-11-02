<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\School\Auth\AuthController;
use App\Http\Controllers\School\Api\DepartmentController;
use App\Http\Controllers\School\Api\StudentController;
use App\Http\Controllers\School\Api\ResultController;
use App\Http\Controllers\School\Forntend\ForntendController;



/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('/v1/results',[ForntendController::class,'Results']); 
Route::get('/v1/students',[ForntendController::class,'Students']);      

Route::prefix('v1')->group(function(){

    Route::post('/login',[AuthController::class,'Login']);
    Route::post('/register',[AuthController::class,'Register']);

   Route::get('/login', function(){
        return response()->json(['message'=>'Unauthorised']);
    })->name('login');
  
    Route::middleware('auth:api')->group(function(){
        Route::get('/users',[AuthController::class,'Index']);
        Route::post('/logout',[AuthController::class,'Logout']);
        Route::get('/users/{id}',[AuthController::class,'Show']);

        //Department Section
        Route::post('/department/create',[DepartmentController::class,'DPCreate']);
        Route::put('/department/{id}/edit',[DepartmentController::class,'DPUpdate']);
        Route::get('/department',[DepartmentController::class,'Department']);
        Route::get('/department/{id}',[DepartmentController::class,'Show']);
        Route::delete('/department/remove/{id}',[DepartmentController::class,'Destory']);

        //Student Section
        Route::post('/student/create',[StudentController::class,'STCreate']);
        Route::put('/student/{id}/edit',[StudentController::class,'STUpdate']);
        Route::get('/student',[StudentController::class,'Student']);
        Route::get('/student/{id}',[StudentController::class,'Show']);
        Route::delete('/student/remove/{id}',[StudentController::class,'Destory']);

        //Result Section
        Route::post('/result/create',[ResultController::class,'RSCreate']);
        Route::put('/result/{id}/edit',[ResultController::class,'RSUpdate']);
        Route::get('/result',[ResultController::class,'Result']);
        Route::get('/result/{id}',[ResultController::class,'Show']);
        Route::delete('/result/remove/{id}',[ResultController::class,'Destory']);
    });

});
