<?php

namespace App\Http\Controllers;

use App\Services\OrdersService;

class OrdersController extends Controller
{
    public function pedidos($id)
    {
        $ordersService = new OrdersService();
        return $ordersService->getPedido($id);
    }
}
