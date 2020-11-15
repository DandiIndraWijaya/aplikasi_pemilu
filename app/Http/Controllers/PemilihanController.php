<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Models\Pemilihan;
use App\Models\TelahMemilih;
use App\Models\Calon;

class PemilihanController extends Controller
{
    public function index(){
        $pemilihan = Pemilihan::all();

        foreach($pemilihan as $p){
            $p->pemilihan_dimulai_carbon = \Carbon\Carbon::parse($p->pemilihan_dimulai)->format('d, M Y H:i');
            $p->pemilihan_berakhir_carbon = \Carbon\Carbon::parse($p->pemilihan_berakhir)->format('d, M Y H:i');
        }

        return view('calon/buat_pemilihan', compact(['pemilihan']));
    }

    public function input_pemilihan(Request $request){
        $nama_pemilihan = $request->input('nama_pemilihan');
        $deskripsi = $request->input('deskripsi');
        $pemilihan_dimulai = $request->input('pemilihan_dimulai');
        $pemilihan_berakhir = $request->input('pamilihan_berakhir');

        Pemilihan::create([
            'nama_pemilihan' => $nama_pemilihan,
            'deskripsi' => $deskripsi,
            'pemilihan_dimulai' => $pemilihan_dimulai,
            'pemilihan_berakhir' => $pemilihan_berakhir
        ]);
        
        Session::flash('sukses', $nama_pemilihan . ' berhasil disimpan!');

        return redirect('/admin/pemilihan');
    }

    public function update_pemilihan(Request $request){
        $id_pemilihan = $request->input('id');
        $nama_pemilihan = $request->input('nama_pemilihan');
        $deskripsi = $request->input('deskripsi');
        $pemilihan_dimulai = $request->input('pemilihan_dimulai');
        $pemilihan_berakhir = $request->input('pamilihan_berakhir');

        $pemilihan = Pemilihan::find($id_pemilihan);
        $pemilihan->nama_pemilihan = $nama_pemilihan;
        $pemilihan->deskripsi = $deskripsi;
        $pemilihan->pemilihan_dimulai = $pemilihan_dimulai;
        $pemilihan->pemilihan_berakhir = $pemilihan_berakhir;
        $pemilihan->save();

        TelahMemilih::where('id_pemilihan', $id_pemilihan)->delete();

        Session::flash('sukses', $nama_pemilihan . ' berhasil diupdate!');

        return redirect('/admin/pemilihan');
    }

    public function hapus_pemilihan(Request $request){
        $nama_pemilihan = $request->input('nama_pemilihan');
        $id_pemilihan = $request->input('id');

        Calon::where('id_pemilihan', $id_pemilihan)->delete();
        Pemilihan::where('id', $id_pemilihan)->delete();
        TelahMemilih::where('id_pemilihan', $id_pemilihan)->delete();
        Session::flash('sukses', $nama_pemilihan . ' berhasil dihapus!');

        return redirect('/admin/pemilihan');
    }
}
