<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{

    public function index()
    {
        return view('mma.logs.index')
            ->with('logs',\App\Log::all());
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

}
