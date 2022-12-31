<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getLimit($limit = 20)
    {
        if ($limit > 20 || $limit <0) {
            $limit = 20;
        }

        return $limit;
    }

    public function error(String $message = 'Failure', int $status = 400)
    {
        return response()->json([
            'message'   => $message,
        ], $status);
    }
}
