<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *    title="API BB Serviços 1.0.0",
 *    description="As documentações e APIs BB Serviços, tem como finalidade a integração em sistemas parceiros.",
 *    @OA\Contact(
 *         email="contato@bbservicos.com.br"
 *    ),
 *    @OA\License(
 *         name="EMS BB Serviços",
 *         url="https://app.bbems.com.br"
 *    ),
 *    version="1.0.0"
 * ),
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     in="header",
 *     name="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * ),
 */


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
