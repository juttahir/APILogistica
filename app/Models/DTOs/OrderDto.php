<?php

namespace App\Models\DTOs;

class OrderDto
{
    public $type;
    public $partner_id;
    public $recipient_id;
    public $transport_id;
    public $invoice_id;
    public $status;
    public $forecast;
    public $third_system;
    public $third_system_id;
    public $updated_at;

    public function __construct(
        ?string $type = null,
        ?string $partner_id = null,
        ?string $recipient_id = null,
        ?string $transport_id = null,
        ?string $invoice_id = null,
        ?string $status = null,
        ?string $forecast = null,
        ?string $third_system = null,
        ?string $third_system_id = null,
        ?string $updated_at = null,
        )
    {
        $this->type = $type;
        $this->partner_id = $partner_id;
        $this->recipient_id = $recipient_id;
        $this->transport_id = $transport_id;
        $this->invoice_id = $invoice_id;
        $this->status = $status;
        $this->forecast = $forecast;
        $this->third_system = $third_system;
        $this->third_system_id = $third_system_id;
        $this->updated_at = $updated_at;
    }
}
