<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DownloadController;

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

Route::get('first_page', function () {
    return view('first_page');
});
Route::get('second_page', function () {
    return view('second_page');
})->name('second_page');
// Route::get('third_page', function () {
//     return view('third_page');
// })->name('third_page');

Route::post('authentication',[AuthenticationController::class,'authentication'])->name('authentication');
Route::post('third_page',[DownloadController::class,'thirdpage'])->name('post_third_page');
Route::post('download',[DownloadController::class,'download'])->name('download');

