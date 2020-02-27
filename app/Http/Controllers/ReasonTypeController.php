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

        foreach ($leaves as $key => $value){
            if( is_null($value->reason_note) && is_null($value->reason_type)){
                unset($leaves[$key]);
            }
            else if(strpos($value->reason_type,"ý do cá nhân") !==false){
                $leaves[$key]->reason_type = "Personal Issues";
            }
            else if(strpos($value->reason_type,"môi trường") !==false || strpos($value->reason_type,"Sang") !==false ){
                $leaves[$key]->reason_type = "Working Environment";
            }
            else if(strpos($value->reason_type,"học") !==false){
                $leaves[$key]->reason_type = "Continue Studying";
            }
            else if(strpos($value->reason_note,"môi trường") !==false && is_null($value->reason_type)){
                $leaves[$key]->reason_type = "Working Environment";
            }
            else if( (strpos($value->reason_note,"Định hướng") !==false  || strpos($value->reason_note,"định hướng") !==false || strpos($value->reason_note,"Chuyển") !==false ||  strpos($value->reason_note,"chuyển") !==false)&& is_null($value->reason_type) || strpos($value->reason_note,"đổi") !==false || strpos($value->reason_note,"Đổi") !==false){
                $leaves[$key]->reason_type = "CareerPath";
            }
            else if(strpos($value->reason_note,"Hết") !==false  && is_null($value->reason_type)){
                $leaves[$key]->reason_type = "Expired Contract";
            }
            else if(strpos($value->reason_note,"học") !==false  && is_null($value->reason_type)){
                $leaves[$key]->reason_type = "Continue Studying";
            }
            else if((strpos($value->reason_note,"cá nhân") !==false || strpos($value->reason_note,"kế hoạch") !==false ||  strpos($value->reason_note,"Kế hoạch") !==false )&& is_null($value->reason_type)){
                $leaves[$key]->reason_type = "Personal Issues";
            }
            else if(( strpos($value->reason_note,"Cho nghỉ việc") !==false )&& is_null($value->reason_type)){
                $leaves[$key]->reason_type = "Fired";
            }
            else if(( strpos($value->reason_note,"tăng lương") !==false  || strpos($value->reason_note,"lương cao") !==false )&& is_null($value->reason_type)){
                $leaves[$key]->reason_type = "Better Salary";
            }
            else{
                $leaves[$key]->reason_type = "Personal Issues";
            }
            
        }
        // foreach ($leaves as $key => $value){
        //     if(!(is_null($value->reason_type) && !is_null($value->reason_note))){
        //         unset($leaves[$key]);
        //     }
        // }
        
        return view('reasonType.index', ['leaves' => $leaves]);
        
    }
}

