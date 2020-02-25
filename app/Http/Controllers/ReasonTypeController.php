<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leaves;

class ReasonTypeController extends Controller
{
    //
    public function index()
    {
        $leaves = Leaves::all();

        return view('reasonType.index', ['leaves' => $leaves]);
        
    }
}

