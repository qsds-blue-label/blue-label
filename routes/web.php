<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\AuthController;


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

Route::get('/', function () {
    //Session::forget('user');
    if(!Session::get('user')){
        return redirect('/login');
    }
    return view('index');
});




Route::get('/import', function () {
    return view('import');
});



Route::get('/login', function () {
    return view('login');
});

Route::post('/check-login', [AuthController::class, 'checkLogin']);
Route::post('/test', [ImportController::class, 'index']);
Route::post('/import-file', [ImportController::class, 'index']);

