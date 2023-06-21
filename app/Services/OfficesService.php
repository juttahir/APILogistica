<?php

namespace App\Services;

use App\Models\Offices;
use Illuminate\Http\Request;
use Exception;

class OfficesService
{
    /**
     * @OA\Get(
     *     tags={"Unidades"},
     *     path="/api/unidade",
     *     summary="Unidades de distribuição {GETALL}",
     *     description="Busque por todas as unidades de distribuição cadastrada",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     * )
     */
    public function getAllOffices()
    {
        $offices = Offices::all(['name', 'active']);

        return $offices;
    }

    /**
     * @OA\Get(
     *     tags={"Unidades"},
     *     path="/api/unidade/{unidade}",
     *     summary="Unidades de distribuição",
     *     description="Busque por unidade de distribuição cadastrada {string}",
     *     @OA\Parameter(
     *         name="unidade",
     *         in="path",
     *         description="Nome da unidade, Exemplo: CD Raposo",
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
     *                 property="unidade",
     *                 type="string",
     *                 description="Nome da unidade"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     * )
     */

     public function getOffice(Request $request, string $name)
     {
         $offices = new Offices();
         $response = $offices
             ->where("name", "LIKE", "%{$name}%")
             ->select('name', 'active')
             ->get();

         return $response;
     }
}
