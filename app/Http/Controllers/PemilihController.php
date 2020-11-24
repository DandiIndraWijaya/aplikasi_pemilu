<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemilihan;
use App\Models\Calon;
use App\Models\User;
use App\Models\TelahMemilih;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;

class PemilihController extends Controller
{
    
    public function index(){
        $pemilihan = Pemilihan::all();

        foreach($pemilihan as $p){
            $telah_memilih = TelahMemilih::whereIn('id_pemilih', [Auth::id()])->whereIn('id_pemilihan', [$p->id])->first();
            if(!empty($telah_memilih)){
                $p->telah_memilih = true;
            }else{
                $p->telah_memilih = false;
            }
            $p->pemilihan_dimulai_carbon = \Carbon\Carbon::parse($p->pemilihan_dimulai)->format('d, M Y H:i');
            $p->pemilihan_berakhir_carbon = \Carbon\Carbon::parse($p->pemilihan_berakhir)->format('d, M Y H:i');
        }
        
        return view('pemilih/home', compact(['pemilihan']));
    }   

    public function pilih_calon($id){
        $pemilihan = Pemilihan::where('id', $id)->first();

        if(empty($pemilihan)){
            return redirect()->back();
        }else{
            $telah_memilih = TelahMemilih::where('id_pemilihan', $id)->where('id_pemilih', Auth::id())->first();
            $pemilihan_dimulai = strtotime($pemilihan->pemilihan_dimulai);
            $pemilihan_berakhir = strtotime($pemilihan->pemilihan_berakhir);
            $sekarang = time();

            if(!empty($telah_memilih) || $pemilihan_dimulai > $sekarang || $pemilihan_berakhir < $sekarang){
                return redirect()->back();
            }else{
                $pemilihan = Pemilihan::where('id', $id)->first();
                $calon = Calon::where('id_pemilihan', $id)->get();
                return view('pemilih/pilih_calon', compact(['pemilihan', 'calon']));
            }
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

    public function hasil_pemilihan($id_pemilihan){
        $pemilihan = Pemilihan::where('id', $id_pemilihan)->first();
        $calon = Calon::where('id_pemilihan', $id_pemilihan)->get();
        $pemilih = User::all();
        $jumlah_pemilih = $pemilih->count();
        $telah_memilih = TelahMemilih::where('id_pemilihan', $id_pemilihan)->get();
        $jumlah_telah_memilih = $telah_memilih->count();

        $pemilihan_dimulai = strtotime($pemilihan->pemilihan_dimulai);
        $pemilihan_berakhir = strtotime($pemilihan->pemilihan_berakhir);
        $sekarang = time();
        
        if($pemilihan_berakhir < $sekarang){
            return view('pemilih/hasil_pemilihan', compact(['pemilihan', 'calon', 'jumlah_pemilih', 'jumlah_telah_memilih']));
        }else{
            return redirect()->back();
        }
        
    }
}
