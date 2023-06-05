<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Orders;

class OrderServices extends Orders {
    use HasFactory;

    protected $table = "order_services";
    protected $fillable = ['order_id','service_id','quantity','price'];

    public function service() {
        return $this->belongsTo(Services::class);
    }
}
