<?php

namespace App\Services;

use App\Models\Products;
use Illuminate\Http\Request;
use \Exception;

class ProductsService
{
    /**
     * @OA\Get(
     *     tags={"Produtos"},
     *     path="/api/produto/{produto}",
     *     summary="Produtos em estoque",
     *     description="Busque por um ou mais títulos de produtos armazenados em nossos estoques (string)",
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

    public function produto(Request $request, string $title)
    {
        $products = new Products();
        $response = $products
            ->where("title", "LIKE", "%{$title}%")
            ->select('id', 'isbn', 'title', 'publisher', 'category', 'synopsis')
            ->get();

        return $response;
    }

    /**
     * @OA\Get(
     *     tags={"Produtos"},
     *     path="/api/produto/{isbn}/codigo",
     *     summary="Produtos em estoque",
     *     description="Busque por um ISBN {código de barras} armazenado em nossos estoques ()",
     *     @OA\Parameter(
     *         name="isbn",
     *         in="path",
     *         description="ISBN do produto",
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
     *                 property="isbn",
     *                 type="string",
     *                 description="ISBN do produto"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     * )
     */
    public function getISBN(Request $request, string $isbn)
    {
        $products = new Products();
        $response = $products
            ->where("isbn", $isbn)
            ->select('id', 'isbn', 'isbn', 'publisher', 'category', 'synopsis')
            ->get();

        if ($response) {
            return response()->json($response, 200);
        } else {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }
    }



    /**
     * @OA\Post(
     *     tags={"Produtos"},
     *     path="/api/produto/",
     *     summary="Inserir um novo produto",
     *     description="Cadastre um novo produto em nosso estoque",
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *         required={"isbn", "title", "publisher", "category", "synopsis", "height","width", "lenght", "weight"},
     *         @OA\Property(property="isbn", type="integer", format="integer", example="Código de barras"),
     *         @OA\Property(property="title", type="string", format="string", example="Título do produto"),
     *         @OA\Property(property="publisher", type="string", format="string", example="Editora"),
     *         @OA\Property(property="category", type="string", format="string", example="Livros"),
     *         @OA\Property(property="synopsis", type="string", format="string", example="Uma colcha de retalhos da vida baiana. Talvez seja esta a melhor síntese deste romance. Zulmira é o retrato-símbolo da baianidade. Baianidade de uma gente que transcende o simplesmente viver por viver; que passa pelas pedras e espinhos da vida sem se arranhar; que irradia calor humano e encanto, apesar das vicissitudes, das armadilhas do cotidiano. Zulmira é o encanto e a magia, a sabedoria e a alegria, o amor transbordando, superando, transformando."),
     *         @OA\Property(property="height", type="integer", format="integer", example="20"),
     *         @OA\Property(property="width", type="integer", format="integer", example="220"),
     *         @OA\Property(property="length", type="integer", format="integer", example="280"),
     *         @OA\Property(property="weight", type="integer", format="integer", example="928"),
     *         @OA\Property(property="cover", type="string", format="string", example="products/HRgjbRPWME6ci6cuObIWitItGDLoLahOjqM7ME6l.jpg"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200, description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example="200"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     * )
     */

    public function criarProduto(Request $request)
    {
        try {
            $produto = Products::create(
                $request->only(
                    'isbn',
                    'title',
                    'publisher',
                    'category',
                    'synopsis',
                    'height',
                    'width',
                    'length',
                    'weight'
                )
            );

            return response()->json(['status' => 200, 'data' => $produto]);

        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()]);
        }
    }

    /**
     * @OA\Put(
     *     tags={"Produtos"},
     *     path="/api/produto/{isbn}",
     *     summary="Atualiza um produto",
     *     description="Atualize um produto existente em nosso estoque",
     *     @OA\Parameter(
     *         name="isbn",
     *         in="path",
     *         description="Exemplo: 9786586539707",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             format="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             required={"title", "publisher", "category", "synopsis", "height","width", "lenght", "weight"},
     *             @OA\Property(property="title", type="string", format="string", example="Título do produto"),
     *             @OA\Property(property="publisher", type="string", format="string", example="Editora"),
     *             @OA\Property(property="category", type="string", format="string", example="Livros"),
     *             @OA\Property(property="synopsis", type="string", format="string", example="Descrição do produto"),
     *             @OA\Property(property="height", type="integer", format="integer", example="20 (em mm)"),
     *             @OA\Property(property="width", type="integer", format="integer", example="220 (em mm)"),
     *             @OA\Property(property="length", type="integer", format="integer", example="280 (em mm)"),
     *             @OA\Property(property="weight", type="integer", format="integer", example="928 (em mm)")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", format="string", example="Bibilia Sagrada"),
     *             @OA\Property(property="publisher", type="string", format="string", example="Obras católicas"),
     *             @OA\Property(property="category", type="string", format="string", example="Livros"),
     *             @OA\Property(property="synopsis", type="string", format="string", example="Bíblia Sagrada, edição Almeida Corrigida Fiel, produzida pela Sociedade Bíblica Trinitariana do Brasil e com uma belíssima arte de capa."),
     *             @OA\Property(property="height", type="integer", format="integer", example="25"),
     *             @OA\Property(property="width", type="integer", format="integer", example="134"),
     *             @OA\Property(property="length", type="integer", format="integer", example="200"),
     *             @OA\Property(property="weight", type="integer", format="integer", example="615")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     * )
     */

    public function update(Request $request, $isbn)
    {
        try {
            $product = Products::where('isbn', $isbn)->firstOrFail();

            $product->update($request->only(
                'isbn',
                'title',
                'publisher',
                'category',
                'synopsis',
                'height',
                'width',
                'length',
                'weight',
                'active'
            )
            );

            return $product;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return response()->json(['status' => 404, 'message' => 'Registro não encontrado']);
        } catch (Exception $ex) {
            return response()->json(['status' => 500, 'message' => 'Erro ao atualizar o registro', 'error' => $ex->getMessage()]);
        }
    }
}
