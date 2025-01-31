<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VotersController;
use App\Http\Controllers\VotesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

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

Route::get('/', [DashboardController::class, 'index']);


Route::get('/logout', function () {
    Session::forget('user');
    return redirect('/login');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/check-login', [AuthController::class, 'checkLogin']);
Route::post('/test', [ImportController::class, 'index']);
Route::get('/import', [ImportController::class, 'index']);
Route::post('/import-file', [ImportController::class, 'import']);
Route::post('/import-list', [ImportController::class, 'list']);
Route::get('/voters', [VotersController::class, 'index']);
Route::get('/users', [UserController::class, 'index']);
Route::post('/update-status', [UserController::class, 'update_status']);
Route::post('/save-user', [UserController::class, 'save']);
Route::post('/voters-list', [VotersController::class, 'list']);
Route::get('/votes', [VotesController::class, 'index']);
Route::get('/delete-imported', [ImportController::class, 'delete']);
Route::get('/import-details', [ImportController::class, 'details']);
Route::get('/generate-template', [ImportController::class, 'export']);
Route::post('/votes-list', [VotesController::class, 'list']);
Route::post('/import-details-list', [ImportController::class, 'detailsList']);
