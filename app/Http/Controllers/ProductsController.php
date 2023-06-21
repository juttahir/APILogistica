<?php

namespace App\Http\Controllers;

use App\Services\ProductsService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function produto(Request $request, string $title)
    {
        $productsService = new ProductsService();
        $response = $productsService->produto($request, $title);

        return response()->json($response);
    }
    public function getISBN(Request $request, string $isbn)
    {
        $productsService = new ProductsService();
        $response = $productsService->getISBN($request, $isbn);

        return $response;
    }
    public function criarProduto(Request $request)
    {
        $productsService = new ProductsService();
        $response = $productsService->criarProduto($request);

        return $response;
    }
    public function update(Request $request, $isbn)
    {
        $productsService = new ProductsService();
        $response = $productsService->update($request, $isbn);

        return $response;
    }
}
