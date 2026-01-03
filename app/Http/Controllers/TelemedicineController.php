<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelemedicineController extends Controller
{
   public function index(){
        return view ("pages.erp.telemedicine.index");
    }
}
