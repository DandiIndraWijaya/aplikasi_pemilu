<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemilihan;
use App\Models\Calon;
use Illuminate\Support\Facades\DB;
use File; 
use Session;

class CalonController extends Controller
{
    public function index(){
        $pemilihan = Pemilihan::all();
        $calon = DB::select("SELECT calon.id as id, nama_calon, nama_pemilihan, nomor_calon, foto, calon.id_pemilihan FROM calon INNER JOIN pemilihan WHERE calon.id_pemilihan = pemilihan.id ORDER BY calon.id_pemilihan ASC, calon.id ASC");

        return view('calon/buat_calon', compact(['pemilihan', 'calon']));
    }

    public function input_calon(Request $request){
        $this->validate($request, [
            'foto_calon' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        $id_pemilihan = $request->input('id_pemilihan');
        $nama_calon = $request->input('nama_calon');
        $nomor_calon = $request->input('nomor_calon');
        $foto_calon = $request->file('foto_calon');

         // menyimpan data file yang diupload ke variabel $file
         $file = $foto_calon;
     
         $nama_file = time()."_".$file->getClientOriginalName();
      
         // isi dengan nama folder tempat kemana file diupload
         $tujuan_upload = 'foto_calon';
         $file->move($tujuan_upload,$nama_file);

         $foto_calon_uploaded = $nama_file;
        Calon::create([
            'nomor_calon' => $nomor_calon,
            'nama_calon' => $nama_calon,
            'id_pemilihan' => $id_pemilihan,
            'jumlah_suara' => 0,
            'foto' => $foto_calon_uploaded
        ]);
        
        Session::flash('sukses', 'Calon dengan nama ' . $nama_calon . ' berhasil disimpan!');

        return redirect('/admin/calon');
    }

    public function hapus_calon(Request $request){
        $id_calon = $request->input('id_calon');
        $foto_calon = $request->input('foto_calon');
        $nama_calon = $request->input('nama_calon');

        $file_path = 'foto_calon/'.$foto_calon;
        if(File::exists($file_path)){
            File::delete($file_path);
        }
        
        Calon::where('id', $id_calon)->delete();

            Session::flash('sukses', 'Calon dengan nama ' . $nama_calon . ' berhasil dihapus!');

            return redirect('/admin/calon');
    }
    
}
