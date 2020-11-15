<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Siswa;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'nis' => 'required|string', //VALIDASI KOLOM USERNAME
            //TAPI KOLOM INI BISA BERISI EMAIL ATAU USERNAME
            'password' => 'required|string',
        ]);

        //LAKUKAN PENGECEKAN, JIKA INPUTAN DARI USERNAME FORMATNYA ADALAH EMAIL, MAKA KITA AKAN MELAKUKAN PROSES AUTHENTICATION MENGGUNAKAN EMAIL, SELAIN ITU, AKAN MENGGUNAKAN USERNAME
        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'id_pemilih';
    
        //TAMPUNG INFORMASI LOGINNYA, DIMANA KOLOM TYPE PERTAMA BERSIFAT DINAMIS BERDASARKAN VALUE DARI PENGECEKAN DIATAS
        $login = [
            $loginType => $request->nis,
            'password' => $request->password
        ];
    
        //LAKUKAN LOGIN
        if (auth()->attempt($login)) {
            //JIKA BERHASIL, MAKA REDIRECT KE HALAMAN HOME
            return redirect()->route('home');
        }
        //JIKA SALAH, MAKA KEMBALI KE LOGIN DAN TAMPILKAN NOTIFIKASI 
        return redirect()->route('login_pemilih')->with(['error' => 'NIS dan Password Salah!']);
    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        }
    }
}
