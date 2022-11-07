<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use function PHPUnit\Framework\isNull;

class ShowComponentsController extends Controller
{
    public function index($params, Request $request)
    {
        return Inertia::render('Main', [
            'request' => $params,
            'index' => is_numeric($request[0]) ? $request[0] : $request->index,
            'object' => $request->render
        ]);
    }
}
