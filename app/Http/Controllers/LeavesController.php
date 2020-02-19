<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leaves;

class LeavesController extends Controller
{
    //
    public function index()
    {
        $leaves = Employee::all();
        return view('Employee.index', ['leaves' => $leaves]);
    }
}

