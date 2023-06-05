<?php

namespace App\Http\Controllers;

use App\Providers\OrdersServiceProvider;

class OrdersController extends Controller
{
    /**
     * @OA\Get(
     *     tags={"Ordem de Pedidos"},
     *     path="/api/pedido/{Pedido}",
     *     summary="Status do pedido de entrada",
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

    public function pedidos($id)
    {
        $ordersServiceProvider = new OrdersServiceProvider($id);
        $response = $ordersServiceProvider->getPedido($id);

        return $response;
    }
}
