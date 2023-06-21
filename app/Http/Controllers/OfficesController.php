<?php

namespace App\Http\Controllers;

use App\Services\OfficesService;
use Illuminate\Http\Request;

class OfficesController extends Controller
{
    public function getAll()
    {
        $officesService = new OfficesService();
        return $officesService->getAllOffices();
    }
    public function getOffices(Request $request, string $name)
    {
        $officesService = new OfficesService();
        return $officesService->getOffice($request, $name);
    }
}
