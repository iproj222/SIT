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


        // foreach ($leaves as $lev){
        //     if(empty($lev->reason_note) && empty($lev->reason_type)){

        //     }

        //     $lev->reason_note ;
        //     $lev->reason_type ;
        // }
        

        return view('reasonType.index', ['leaves' => $leaves]);
        
    }
}

