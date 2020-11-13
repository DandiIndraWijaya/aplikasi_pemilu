<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use App\Models\User;
use App\Models\Siswa;
 
use Session;
 
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(){
        $siswa = Siswa::all();
        return view('dashboard', ['siswa' => $siswa]);
    }

    public function import_siswa(Request $request){
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
		$file->move('file_siswa',$nama_file);
 
		// import data
		Excel::import(new SiswaImport, public_path('/file_siswa/'.$nama_file));
 
		// notifikasi dengan session
		Session::flash('sukses','Data Siswa Berhasil Diimport!');
 
		// alihkan halaman kembali
		return redirect('/dashboard');
    }
}
