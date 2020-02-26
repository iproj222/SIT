<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leaves;

class OverWorkingTimeController extends Controller
{
    //
    public function index()
    {
        $leaves = Leaves::all();

        return view('overWorkingTime.index', ['leaves' => $leaves]);
        
    }
}

