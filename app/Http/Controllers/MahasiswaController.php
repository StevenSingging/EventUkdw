<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\History;
use App\Models\Pendaftaran_Acara;
use Illuminate\Http\Request;
use App\Models\Pembayaran;

class MahasiswaController extends Controller
{
    public function index()
    {
        $riwayat = History::select('judul', 'user_id', 'created_at', 'acara_id')
            ->where('user_id', auth()->user()->id)
            ->selectRaw('DATE(created_at) as tanggal, TIME(created_at) as waktu')
            ->orderByDesc('created_at')
            ->get()
            ->groupBy(function ($item) {
                return $item->tanggal;
            });
        return view('mahasiswa.dashboard',compact('riwayat'));
    }

    public function listacara(Request $request)
    {
        $start = date('YYYY-MM-DD ', strtotime($request->waktu_mulai));
        $end = date('YYYY-MM-DD ', strtotime($request->waktu_selesai));
        // $events = Acara::where('waktu_mulai','>=',$start)->orWhere('waktu_selesai','<=',$end)->orWhere('terbuka_untuk','Mahasiswa')->orWhere('terbuka_untuk','Umum')->get()

        $events = Acara::where('waktu_mulai', '>=', $start)
            ->orwhere('waktu_selesai', '<=', $end)
            ->whereIn('terbuka_untuk', ['Mahasiswa', 'Umum'])
            ->get()
            ->map(fn ($item) => [
                'id' => $item->id,
                'jenis_acara' => $item->jenis_acara,
                'title' => $item->nama_acara,
                'start' => $item->waktu_mulai,
                'end' => $item->waktu_selesai,
                'color' => $item->warna,
                'deskripsi' => $item->deskripsi,
                'lokasi' => $item->lokasi,
                'harga' => $item->harga,
                'batas_pendaftaran' => $item->batas_pendaftaran,
                'gambar' => $item->gambar,
                'terbuka_untuk' => $item->terbuka_untuk

            ]);

        return response()->json($events);
    }

    public function daftaracara($id){
        $acara = Acara::find($id);
        return view('mahasiswa.form_pendaftaran',compact('acara'));
    }

    public function simpandaftar(Request $request, $id){
        $acara = Acara::find($id);
        $user = $request->user();

        // Cek apakah pengguna sudah mendaftar ke acara ini
        $existingRegistration = Pendaftaran_Acara::where('user_id', $user->id)
            ->where('acara_id', $acara->id)
            ->first();
    
        if ($existingRegistration) {
            $sucess = array(
                'message' => 'Anda sudah mendaftar acara ini',
                'alert-type' => 'error'
            );
            // Pengguna sudah mendaftar, berikan pesan kesalahan atau tindakan lain.
            return redirect('/dashboard/mahasiswa')->with($sucess);
        }

        if($acara->harga != null){
            $pembayaran = new Pembayaran();
            $pembayaran->user_id = $request->user()->id;
            $pembayaran->acara_id = $acara->id;
            $pembayaran->jumlah_pembayaran = $acara->harga;
            $pembayaran->save();
        }

        $daftar = new Pendaftaran_Acara();
        $daftar->user_id = $request->user()->id;
        $daftar->acara_id = $acara->id;
        $daftar->save();

        $riwayat = new History();
        $riwayat->user_id = $request->user()->id;
        $riwayat->acara_id = $acara->id;
        $riwayat->judul = 'Mendaftar Acara '.$acara->nama_acara;
        $riwayat->save();

        $sucess = array(
            'message' => 'Anda berhasil mendaftar acara',
            'alert-type' => 'success'
        );

        return redirect('/dashboard/mahasiswa')->with($sucess);
    }
}
