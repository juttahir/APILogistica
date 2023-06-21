<?php

namespace App\Services;

use App\Models\OrderEntries;
use App\Models\DTOs\OrderDto;

class OrdersService
{
    /**
     * Get pedido information.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\Get(
     *     tags={"Ordem de Pedidos"},
     *     path="/api/pedido/{pedido}",
     *     summary="Status do pedido",
     *     description="Retorna o status atual do pedido",
     *     @OA\Parameter(name="pedido", in="path", description="ID do pedido",
     *         required=true,
     *         @OA\Schema(type="integer", format="int32")
     *     ),
     *     @OA\Response(response=200, description="OK"),
     *     @OA\Response(response=404, description="Not Found")
     * )
     */
    public function getPedido(int $id)
    {
        $pedido = OrderEntries::where('id', $id)->first();

        if ($pedido) {
            $pedidoDto = new OrderDto(
                $pedido->type,
                $pedido->partner_id,
                $pedido->recipient_id,
                $pedido->transport_id,
                $pedido->invoice,
                $pedido->status,
                $pedido->forecast,
                $pedido->third_system,
                $pedido->third_system_id,
                $pedido->updated_at,
            );

            return response()->json(['pedido' => $pedidoDto], 200);
        } else {
            return response()->json(['message' => 'Pedido não encontrado'], 404);
        }
    }
}
