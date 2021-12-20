<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TorrokoController;

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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('torroko', [TorrokoController::class, 'index']);
Route::get('quiz', [TorrokoController::class, 'quiz']);
Route::post('result',[TorrokoController::class,'result']);
// 最終結果の表示のページ
Route::get('quiz_result',[TorrokoController::class,'quiz_result']);
// ここからはクイズの2番目
Route::get('quiz2',[TorrokoController::class,'quiz2']);
Route::post('result2',[TorrokoController::class,'result2']);
Route::get('quiz_result2',[TorrokoController::class,'quiz_result2']);

