<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DateTime;
use App\Models\DTOs\OrderDto;
use App\Models\OrderServices;

class OrdersServiceProvider extends ServiceProvider
{
    /**
     * Get pedido information.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPedido(int $id)
    {
        $pedido = OrderServices::where('id', $id)->first();

        if ($pedido) {
            $pedidoDto = new OrderDto(
                $pedido->type,
                $pedido->office_id,
                $pedido->partner_id,
                $pedido->status,
                $pedido->id,
                $pedido->recipient_id,
                $pedido->transport_id,
                $pedido->invoice,
                $pedido->content_declaration,
                $pedido->forecast ? new DateTime($pedido->forecast) : null,
                $pedido->third_system,
                $pedido->third_system_id
            );

            // Acesso aos dados usando os métodos getters
            $sistemaParceiro = $pedidoDto->getThirdSystem();
            $idDoSistema = $pedidoDto->getThirdSystemId();
            $type = $pedidoDto->getType();
            $status = $pedidoDto->getStatus();
            $transporte = $pedidoDto->getTransportId();

            // Retorna a resposta conforme necessário
            return response()->json([
                'sistema_parceiro' => $sistemaParceiro,
                'id_do_sistema' => $idDoSistema,
                'type' => $type,
                'status' => $status,
                'transporte' => $transporte,
            ], 200);
        } else {
            return response()->json(['message' => 'Pedido não encontrado'], 404);
        }

    }
}
