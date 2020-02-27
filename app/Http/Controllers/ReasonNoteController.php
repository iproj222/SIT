<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leaves;

class ReasonNoteController extends Controller
{
    //
    public function index()
    {
        $leaves = Leaves::all();

        return view('reasonNote.index', ['leaves' => $leaves]);
        
    }
}

