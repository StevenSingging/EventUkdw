<?php

namespace App\Http\Controllers;
use App\Models\History;
use App\Models\Acara;
use App\Models\Pendaftaran_Acara;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(){
        $riwayat = History::select('judul', 'user_id', 'created_at', 'acara_id')
            ->where('user_id', auth()->user()->id)
            ->selectRaw('DATE(created_at) as tanggal, TIME(created_at) as waktu')
            ->orderByDesc('created_at')
            ->get()
            ->groupBy(function ($item) {
                return $item->tanggal;
            });
        return view('dosen.dashboard',compact('riwayat'));
    }

    public function listacara(Request $request)
    {
        $start = date('YYYY-MM-DD ', strtotime($request->waktu_mulai));
        $end = date('YYYY-MM-DD ', strtotime($request->waktu_selesai));
        // $events = Acara::where('waktu_mulai','>=',$start)->orWhere('waktu_selesai','<=',$end)->orWhere('terbuka_untuk','Mahasiswa')->orWhere('terbuka_untuk','Umum')->get()

        $acara = Acara::all();
        $events = [];

        foreach ($acara as $a) {
            $terbuka_untuk = json_decode($a->terbuka_untuk);

            if (in_array('Dosen', $terbuka_untuk) || in_array('Umum', $terbuka_untuk)) {
                if($a->status == '1'){
                    $events[] = [
                        'id' => $a->id,
                        'jenis_acara' => $a->jenis_acara,
                        'title' => $a->nama_acara,
                        'start' => $a->waktu_mulai,
                        'end' => $a->waktu_selesai,
                        'color' => $a->warna,
                        'deskripsi' => $a->deskripsi,
                        'lokasi' => $a->lokasi,
                        'harga_dosen' => $a->harga_dosen,
                        'batas_pendaftaran' => $a->batas_pendaftaran,
                        'gambar' => $a->gambar,
                        'terbuka_untuk' => $a->terbuka_untuk,
                        'penanggung_jawab' => $a->panitiaa->nama,
                        'nowa' => $a->panitiaa->nowa,
                        'kouta' => $a->kuota,
                    ];
                }
            }
        }

        return response()->json($events);
    }

    public function formdaftaracara($id)
    {
        $acara = Acara::find($id);
        return view('dosen.form_pendaftaran', compact('acara'));
    }

    public function simpandaftar(Request $request, $id)
    {
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
            return redirect('/dashboard/dosen')->with($sucess);
        }

        if ($acara->kuota <= 0) {
            $sucess = array(
                'message' => 'Kuota Acara Sudah Habis',
                'alert-type' => 'error'
            );
            // Pengguna sudah mendaftar, berikan pesan kesalahan atau tindakan lain.
            return redirect('/dashboard/mhs')->with($sucess);
        } else {
            if ($acara->harga_dosen != null) {

                $daftar = new Pendaftaran_Acara();
                $daftar->user_id = $request->user()->id;
                $daftar->acara_id = $acara->id;
                $daftar->status = '1';
                $daftar->save();
    
                $pembayaran = new Pembayaran();
                $pembayaran->user_id = $request->user()->id;
                $pembayaran->acara_id = $acara->id;
                $pembayaran->pendaftaran_id = $daftar->id;
                $pembayaran->jumlah_pembayaran = $acara->harga_dosen;
                $pembayaran->save();
            }else{
                
                $daftar = new Pendaftaran_Acara();
                $daftar->user_id = $request->user()->id;
                $daftar->acara_id = $acara->id;
                $daftar->status = '1';
                $daftar->save();
    
                $acara->kuota = $acara->kuota - 1;
                $acara->save();
            }
    
    
    
            $riwayat = new History();
            $riwayat->user_id = $request->user()->id;
            $riwayat->acara_id = $acara->id;
            $riwayat->judul = 'Mendaftar Acara ' . $acara->nama_acara;
            $riwayat->save();
    
            $sucess = array(
                'message' => 'Anda berhasil mendaftar acara',
                'alert-type' => 'success'
            );
    
            return redirect('/dashboard/dosen')->with($sucess);
        }
        
    }

    public function daftaracara()
    {
        $acara = Pendaftaran_Acara::where('user_id', auth()->user()->id)->paginate();

        return view('dosen.daftar_acara', compact('acara'));
    }

    public function pembayarandsn(Request $request, $id)
    {
        // Menggunakan first() untuk mendapatkan instance model
        $pembayaran = Pembayaran::where('pendaftaran_id', $id)->first();

        if (!$pembayaran) {
            return abort(404); // Atau tindakan lain sesuai kebutuhan jika pembayaran tidak ditemukan.
        }

        $pembayaran->tanggal_pembayaran = date("Y-m-d");

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('buktipembayaran'), $namaGambar);
            $pembayaran->bukti_pembayaran = $namaGambar;
        }

        $pembayaran->save(); // Menggunakan save() pada model pembayaran.

        $riwayat = new History();
        $riwayat->user_id = $request->user()->id;
        $riwayat->acara_id = $pembayaran->pendaftaran->acarap->id;
        $riwayat->judul = 'Membayar Acara ' . $pembayaran->pendaftaran->acarap->nama_acara;
        $riwayat->save();

        //dd($pembayaran);
        $sucess = array(
            'message' => 'Anda berhasil Membayar',
            'alert-type' => 'success'
        );

        // Anda juga dapat menambahkan pesan sukses atau tindakan lain setelah menyimpan pembayaran.
        return redirect()->back()->with($sucess);
    }
}
