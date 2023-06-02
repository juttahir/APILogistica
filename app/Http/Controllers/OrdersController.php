<?php

namespace App\Http\Controllers;

use App\Models\OrderItemExits;
use Illuminate\Http\Request;
use App\Models\Orders2;

class OrdersController extends Controller
{
    /**
     * @OA\Get(
     *     tags={"Pedidos"},
     *     path="/api/pedido/{Pedido}",
     *     summary="Status do pedido",
     *     description="Retorna o status atual do pedido",
     *     @OA\Parameter(
     *         name="Pedido",
     *         in="path",
     *         description="ID do pedido",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int32"
     *         )
     *     ),
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

    public function pedido(int $id)
    {
        $pedido = Orders2::where('id', $id)->first();

        if($pedido){
            return response()->json([
                'sistema_parceiro'=> $pedido->third_system,
                'id_do_sistema'=> $pedido->third_system_id,
                'type'=> $pedido->type,
                'status'=> $pedido->status,
                'transporte'=> $pedido->transport_id,
                'criado'=> $pedido->created_at,
                'alterado'=> $pedido->updated_at,
            ], 200);
        } else{
            return response()->json(['message' => 'Pedido não encontrado'], 404);
        }
    }
}
