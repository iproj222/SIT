<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leaves;

class LastPositionController extends Controller
{
    //
    public function index()
    {
        $leaves = Leaves::all();

        return view('LastPosition.index', ['leaves' => $leaves]);
        
    }
}

