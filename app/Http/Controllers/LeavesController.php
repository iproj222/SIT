<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leaves;

class LeavesController extends Controller
{
    //
    public function index()
    {
        $employees = Leaves::all();
        return view('leaves.index', ['leaves' => $leaves]);
    }
}

