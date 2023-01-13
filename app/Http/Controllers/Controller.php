<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Todo App Rest API Documentation",
 *      description="L5 Swagger OpenApi description",
 *      @OA\Contact(
 *          email="contact@flawlessjae.com"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 *   @OA\SecurityScheme(
*      securityScheme="sanctum",
*      in="header",
*      name="bearerAuth",
*      type="http",
*      scheme="bearer",
*      bearerFormat="JWT",
* ),
 *
 *
 *
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
