<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use App\Models\Products;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Get pedido information.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProduto(Request $request)
    {
        if($request->isNotEmpty()){
            return Products::where("title", "LIKE", "%{$request->title}%")->get();
        } else{
            return response()->json(['message' => 'Pedido não encontrado'], 404);
        }
    }
}
