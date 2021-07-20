<?php

namespace App\Http\Controllers;

use App\Http\Core\CovidService;

class CovidController extends Controller
{
    public function index()
    {   
        return response()->json(CovidService::getCovidCases());
    }

    public function data()
    {   
        return view('covid', ['cases' => $this->index()]);
    }
}
