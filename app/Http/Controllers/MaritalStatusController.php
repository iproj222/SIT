<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leaves;

class MaritalStatusController extends Controller
{
    //
    public function index()
    {
        $leaves = Leaves::all();

        return view('maritalStatus.index', ['leaves' => $leaves]);
        
    }
}

