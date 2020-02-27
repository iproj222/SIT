<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leaves;

class AgeController extends Controller
{
    //
    public function index()
    {
        $leaves = Leaves::all();

        return view('Age.index', ['leaves' => $leaves]);
        
    }
}

