<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemilihan;
use Carbon\Carbon;

class PemilihController extends Controller
{
    public function index(){
        $pemilihan = Pemilihan::all();

        foreach($pemilihan as $p){
            $p->pemilihan_dimulai_carbon = \Carbon\Carbon::parse($p->pemilihan_dimulai)->format('d, M Y H:i');
            $p->pemilihan_berakhir_carbon = \Carbon\Carbon::parse($p->pemilihan_berakhir)->format('d, M Y H:i');

            
        }
        
        return view('pemilih/home', compact(['pemilihan']));
    }   
}
