<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemilihController extends Controller
{
    public function index(){
        return view('pemilih/home');
    }   
}
