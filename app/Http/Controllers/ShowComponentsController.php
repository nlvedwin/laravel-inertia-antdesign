<?php

namespace App\Http\Controllers;

use App\Models\UsersManagement;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShowComponentsController extends Controller
{
    public function index($projectName, $params, Request $request)
    {
        return Inertia::render('Main', [
            'request' => $params,
            'index' => is_numeric($request[0]) ? $request[0] : $request->index,
            'object' => $request->render,
            'users' => $params === 'Users Management' ? UsersManagement::all() : ''
        ]);
    }
}
