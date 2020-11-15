<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use App\Models\User;
use App\Models\Siswa;
 
use Session;
 
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(){
        $pemilih = User::where('role', 1)->paginate(6);
        return view('dashboard', ['pemilih' => $pemilih]);
	}
	
	public function cari_pemilih(Request $request){
		$nama = $request->nama;
		$pemilih = User::where('name', 'like', '%' . $request->nama . '%')->paginate(6);
		
		return view('dashboard', compact(['pemilih', 'nama']));
	}

    public function import_pemilih(Request $request){
        // validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
        
        User::where('role', 1)->delete();

		// upload ke folder file_siswa di dalam folder public
		$file->move('file_pemilih',$nama_file);
 
		// import data
		Excel::import(new UsersImport, public_path('/file_pemilih/'.$nama_file));
 
		// notifikasi dengan session
		Session::flash('sukses','Data Pemilih Berhasil Diimport!');
 
		// alihkan halaman kembali
		return redirect('/dashboard');
    }
}
