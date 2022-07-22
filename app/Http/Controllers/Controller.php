<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *    title="Laravel-api documentation",
 *    version="1.0.0",
 *    @OA\Contact(
 *          email="zaq22022015@gmail.com"
 *      )
 * ),
 * @OA\Tag(
 *     name="Notebook",
 *     description="Work with notes"
 * )
 * @OA\Server(
 *     description="Laravel-api server",
 *     url="http://127.0.0.1:8000/api/v1"
 *     )
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
