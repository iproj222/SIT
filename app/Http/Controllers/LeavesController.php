<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leaves;

class LeavesController extends Controller
{
    //
    public function index()
    {
        $leaves = Leaves::all();
        return view('leaves.index', ['leaves' => $leaves]);
        return view('reasonType.index', ['leaves' => $leaves]);
        return view('reasonNote.index', ['leaves' => $leaves]);
        return view('gender.index', ['leaves' => $leaves]);
        return view('period.index', ['leaves' => $leaves]);
    }
}

