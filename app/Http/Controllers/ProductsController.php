<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    /**
     * @OA\Get(
     *     tags={"Produtos"},
     *     path="/api/produtos/{produto}",
     *     summary="Produtos em estoque",
     *     description="Retorna o produto armazenado em nossos estoques",
     *     @OA\Parameter(
     *         name="produto",
     *         in="path",
     *         description="Nome do produto",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             format="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="produto",
     *                 type="string",
     *                 description="Nome do produto"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     * )
     */


    public function produto(string $title)
    {
        $produto = Products::where('title', $title)->first();

        if($produto){
            return response()->json(['Produto' => $produto], 200);
        } else{
            return response()->json(['message' => 'Pedido não encontrado'], 404);
        }
    }

    /**
     * @OA\Get(
     *     tags={"Produtos"},
     *     path="/api/produtos",
     *     summary="Listar todos os produtos",
     *     description="Retorna todos os produtos armazenados em nossos estoques",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(
     *                     property="produto",
     *                     type="string",
     *                     description="Nome do produto"
     *                 )
     *             )
     *         )
     *     )
     * )
     */

    public function listarProdutos()
    {
        $produtos = Products::get();

        if($produtos){
            return response()->json($produtos, 200);
        } else{
            return response()->json(['message' => 'Pedido não encontrado'], 404);
        }
    }
}
