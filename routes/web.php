<?php

use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

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

Route::get('/produtos',[ProdutoController::class, 'lista']);
Route::get('/produto/{id}',[ProdutoController::class, 'mostra'])->name('produto');
Route::get('/produtos/novo',[ProdutoController::class, 'novo']);
Route::post('/produtos/adiciona',[ProdutoController::class, 'adiciona']);
Route::get('/produtos/remove/{id}',[ProdutoController::class,'remove'])->name('remove');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
