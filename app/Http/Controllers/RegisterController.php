<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pterpan;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function simpanregistrasi(Request $request)
    {
        // dd($request->all());
        // $pterpan = Pterpan::select('status')->where('no_induk',$request->no_induk);
        $existingUser = User::where('nim', $request->nim)->orWhere('nidn', $request->nidn)->orWhere('email', $request->email)->first();
        if ($existingUser) {
            return redirect('register')->with('fail','Data email atau no induk yang diinput sudah ada');
        } else {
            // Data no_induk belum ada, buat entri baru
            User::create([
                'nama' => $request->nama,
                'username' => $request->username,
                'role' => $request->role,
                'nim' => $request->nim,
                'nidn' => $request->nidn,
                'email' => $request->email,
                'nowa' => $request->nowa,
                'password' => bcrypt($request->password),
                'remember_token' => Str::random(60) 
            ]);

            return redirect('/login')->with('regis','Berhasil registrasi');
        }
    }

    public function postlogin (Request $request){
        //dd($request->all());
        $input=$request->all();
        if(auth()->attempt(array('username' => $input['username'], 'password' => $input['password']))){
            if(auth()->user()->role=='Mahasiswa'){
                return redirect('dashboard/mahasiswa');
            }else if(auth()->user()->role=='Dosen'){
                return redirect('dashboard/dosen');
            }else if(auth()->user()->role=='Biro3'){
                return redirect('dashboard/biro');
            }else if(auth()->user()->role=='Biro2'){
                return redirect('dashboard/biro');
            }else if(auth()->user()->role=='Umum'){
                return redirect('dashboard/umum');
            }else if(auth()->user()->role=='Admin'){
                return redirect('dashboard/admin');
            }
        }
        return redirect('/login')->with('postlogin','Username atau Password Anda Salah, Silakan lakukan proses login kembali');
    }

    public function logout (Request $request){
        Auth::logout();
        return redirect('/login')->with('logout','Anda berhasil logout');
    }
}
