<?php

namespace App\Models\DTOs;

class OrderServicesDto extends OrderDto {

    public function __construct(
        int $order_id,
        int $service_id,
        int $id,
        ?int $quantity = 0, // Adicione o tipo nullable (?int) e um valor padrão
        float $price,
        ?string $status
    ) {
        parent::__construct(
            'entrada',
            $order_id,
            $service_id,
            $id,
            $quantity ?: 0, // Defina um valor padrão para $quantity caso seja nulo
            $price,
            $status
        );
    }

}


