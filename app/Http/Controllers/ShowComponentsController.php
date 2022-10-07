<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ShowComponentsController extends Controller
{
    public function index($params, Request $request)
    {        
        return Inertia::render('Main', [
            'request' => $params,
            'index' => $request[0]
        ]);
        // return $request;
    }
}
