<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemilihan;
use App\Models\Calon;
use App\Models\TelahMemilih;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;

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

    public function pilih_calon($id){
        $telah_memilih = TelahMemilih::where([
            'id_pemilih' => Auth::id(),
            'id_pemilihan' => $id
        ]);

        if(empty($telah_memilih)){
            $pemilihan = Pemilihan::where('id', $id)->first();
            $calon = Calon::where('id_pemilihan', $id)->get();
            return view('pemilih/pilih_calon', compact(['pemilihan', 'calon']));
        }else{
            return redirect()->back();
        }
    }

    public function proses_pilih_calon(Request $request){
        $id_calon = $request->input('id_calon');
        $id_pemilih = Auth::id();
        $id_pemilihan = $request->input('id_pemilihan');

        $calon = Calon::find($id_calon);
        $calon->jumlah_suara += 1;
        $calon->save();

        TelahMemilih::create([
            'id_pemilih' => $id_pemilih,
            'id_pemilihan' => $id_pemilihan
        ]);

        Session::flash('sukses_pilih_calon', 'Anda Telah Memilih ' . $calon->nama_calon);

        return redirect('/home');
    }
}
