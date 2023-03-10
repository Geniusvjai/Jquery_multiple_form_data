<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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
    return view('welcome');
});

Route::post('create-data', [Controller::class, 'create_ajax'])->name('ajax.data');
Route::get('edit', [Controller::class, 'show_language'])->name('get_language');

Route::get('update', [Controller::class, 'update'])->name('update.data');
