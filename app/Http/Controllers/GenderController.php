<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leaves;

class GenderController extends Controller
{
    //
    public function index()
    {
        $leaves = Leaves::all();

        return view('gender.index', ['leaves' => $leaves]);
        
    }
}

