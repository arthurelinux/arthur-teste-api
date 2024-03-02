<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProductsController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [ProductsController::class, 'index']);


Route::post('/sales', [SalesController::class, 'store']); // Cadastrar nova venda
Route::post('/sales/adicao/{id}', [SalesController::class, 'adicionar']); // Cadastrar nova venda
Route::get('/sales', [\App\Http\Controllers\SalesProductsController::class, 'index']); // Consultar vendas realizadas
Route::get('/sales/{id}', [\App\Http\Controllers\SalesProductsController::class, 'show']); // Consultar uma venda específica
Route::put('/sales/{id}', [SalesController::class, 'cancelar']); // Cancelar uma venda
