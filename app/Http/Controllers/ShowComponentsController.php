<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ShowComponentsController extends Controller
{
    public function index($params, Request $request)
    {
        // dd($request[0]);
        return Inertia::render('Main', [
            'request' => $params,
            'index' => is_numeric($request[0]) ? $request[0] : $request->index,
            'object' => $request->render
        ]);
        // return $request;
    }
}
