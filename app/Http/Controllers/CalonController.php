<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalonController extends Controller
{
    public function index(){
        return view('calon/buat_calon');
    }
}
