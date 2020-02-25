<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leaves;

class LeavesController extends Controller
{
    //
    public function index()
    {
        $leaves = Leaves::select('reason_type', 'reason_note')->get();
        return $leaves;
    }
}

