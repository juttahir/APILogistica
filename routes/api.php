<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ping', function (Request $request) {
    return response()->json(['200'],200);
});

Route::get('/pedido/{id}', [OrdersController::class, 'pedido']);

Route::get('/produto/{title}', [ProductsController::class, 'produto']);
Route::get('/produto', [ProductsController::class, 'listarProdutos']);
