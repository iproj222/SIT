<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leaves;

class PeriodController extends Controller
{
    //
    public function index()
    {
        $leaves = Leaves::all();

        return view('Period.index', ['leaves' => $leaves]);
        
    }
}

