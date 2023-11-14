<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginpetugaspage() {
        return view('loginPetugas');
    }

    public function loginsiswapage() {
        return view('loginSiswa'); 
    }

    public function loginAdmin(Request $request) {
        // return $request;
        if (Auth::guard('petugas')->attempt(['username'=>$request->username, 'password'=>$request->password])) {
            return redirect('dashboard');
        }
        return redirect('admin');
    }

    public function loginSiswa(Request $request) {
        // return $request;
        if (Auth::guard('siswa')->attempt(['nisn' => $request->nisn, 'password'=>$request->password])) {
            return redirect('dashboard');
        }
        return redirect('/');
    }

    public function logout() {
        if (Auth::guard('petugas')->check()) {
            Auth::guard('petugas')->logout();
            session()->flush();
            return redirect('admin');
        } elseif(Auth::guard('siswa')->check()) {
            Auth::guard('siswa')->logout();
            session()->flush();
            return redirect('/');
        }
    }
}
