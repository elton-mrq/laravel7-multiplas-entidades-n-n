<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;

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

Route::resource('marcas', 'MarcaController');
Route::get('/marcas/remover/{id}', [MarcaController::class, 'remover'])->name('marcas.remover');
Route::get('/marcas/produtos/{id}', [MarcaController::class, 'produtos'])->name('marcas.produtos');

Route::resource('categorias', 'CategoriaController');
Route::get('/categorias/remover/{id}', [CategoriaController::class, 'remover'])->name('categorias.remover');
Route::get('/categorias/produtos/{id}', [CategoriaController::class, 'produtos'])->name('categorias.produtos');

Route::resource('produtos', 'ProdutoController');
Route::get('/produtos/remover/{id}', [ProdutoController::class, 'remover'])->name('produtos.remover');
