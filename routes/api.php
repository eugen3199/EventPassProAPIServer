<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogController;
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

//Public
Route::post('/login', [UserController::class, 'login']);


//Require login
Route::middleware('auth:sanctum')->group(function() {

	//Users
	Route::post('/users', [UserController::class, 'store'])->middleware('permission:User.Create');
	Route::get('/users', [UserController::class, 'index'])->middleware('permission:User.Read.All');
	Route::get('/profile', [UserController::class, 'show'])->middleware('permission:User.Read.Own');
	Route::patch('/users/{id}', [UserController::class, 'updateAll'])->middleware('permission:User.Update.All');
	Route::patch('/profile', [UserController::class, 'updateOwn'])->middleware('permission:User.Update.Own');
	Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('permission:User.Delete');
	
	//Logs
	Route::get('/logs', [LogController::class, 'index']);
	Route::patch('/logs/{id}', [LogController::class, 'update']);

	//Clients
	Route::post('/clients', [UserController::class, 'store'])->middleware('permission:Client.Create');
	Route::get('/clients', [UserController::class, 'index']);
	Route::patch('/clients/{id}', [UserController::class, 'update']);
	Route::delete('/clients/{id}', [UserController::class, 'destroy'])->middleware('permission:Client.Delete');

	//Events
	Route::post('/events', [UserController::class, 'store'])->middleware('permission:Event.Create');
	Route::get('/events', [UserController::class, 'index']);
	Route::patch('/events/{id}', [UserController::class, 'update']);
	Route::delete('/events/{id}', [UserController::class, 'destroy'])->middleware('permission:Event.Delete');
});