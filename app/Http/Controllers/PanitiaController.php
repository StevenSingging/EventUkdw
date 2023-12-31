<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use Illuminate\Http\Request;
use App\Models\Pendaftaran_Acara;
use App\Models\History;
use PDF;
use App\Models\Pembayaran;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PanitiaController extends Controller
{
    public function index()
    {
        $event = Acara::where(function($query) {
            $query->whereNotNull('harga_mhs')
                  ->orWhereNotNull('harga_dosen')
                  ->orWhereNotNull('harga_umum');
        })
        ->where('penanggung_jawab', auth()->user()->id)
        ->where('status', '1')
        ->paginate();
        $acara = Acara::where('penanggung_jawab', auth()->user()->id)->where('status', '1')->paginate();


        $countacara = Acara::where('status', '1')->where('penanggung_jawab', auth()->user()->id)
            ->whereYear('waktu_mulai', '=', Carbon::now()->year)
            ->whereMonth('waktu_mulai', '=', Carbon::now()->month)
            ->count();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $countpeserta = [];
        // Retrieve the counts of participants for each event in the current month
        $countPesertaByEvent = Acara::withCount([
            'acarap' => function ($query) use ($currentMonth, $currentYear) {
                $query->whereMonth('created_at', '=', $currentMonth)
                    ->whereYear('created_at', '=', $currentYear);
            }
        ])
            ->where('penanggung_jawab', auth()->user()->id)
            ->where('status', '1')
            ->get();

        // Access the counts for each event
        foreach ($countPesertaByEvent as $eventt) {
            $countpeserta = $eventt->acarap->count();
            // $countPeserta now contains the count of participants for each event in the current month
        }
        $revenueByEvent = Pembayaran::where('status_pembayaran', '1')
            ->select(DB::raw('SUM(jumlah_pembayaran) as total_revenue'))
            ->first()
            ->total_revenue;
       
        return view('panitia.dashboard', compact('event', 'acara','countacara','countpeserta','revenueByEvent'));
    }

    public function peserta_acara_biro2($id)
    {
        $pembayaran = Pendaftaran_Acara::where('acara_id', $id)->first();
        $peserta = Pendaftaran_Acara::where('acara_id', $id)
            ->has('pembayaran') // hanya peserta dengan pembayaran
            ->paginate();

        //dd($nama_acara);
        return view('panitia.validasipembayaran', compact('peserta', 'pembayaran'));
    }

    public function peserta_acara($id)
    {
        $peserta = Pendaftaran_Acara::where('acara_id', $id)->paginate();
        $nama_acara = Acara::where('id', $id)->first();
        //dd($nama_acara);
        return view('panitia.peserta_acara', compact('peserta', 'nama_acara'));
    }

    public function validasipendaftaran(Request $request, $id)
    {
        $peserta = Pendaftaran_Acara::find($id);
        $status = $request->input('status');
        $history = new History();
        // Validasi status yang diterima
        if ($status === '0' || $status === '1') {
            $peserta->status = $status;
            $peserta->save();

            $history->user_id = $peserta->user_id;
            $history->acara_id = $peserta->acara_id;
            if ($status === '1') {
                if ($peserta->acarap->harga != null) {
                    $history->judul = 'Status Pendaftaran Acara ' . $peserta->acarap->nama_acara . ' Anda Telah Diubah Menjadi Valid Silahkan Melakukan Pembayaran';
                } else {
                    $history->judul = 'Status Pendaftaran Acara ' . $peserta->acarap->nama_acara . ' Anda Telah Diubah Menjadi Valid';
                }
            } elseif ($status === '0') {
                $history->judul = 'Status Pendaftaran Acara ' . $peserta->acarap->nama_acara . ' Anda Telah Diubah Menjadi Tidak Valid';
            }
            $history->save();

            return redirect()->back();
        } else {
            // Tambahkan penanganan kesalahan jika status tidak valid
            return redirect()->back()->with('error', 'Status tidak valid');
        }
    }
    public function cetakpeserta($id)
    {
        $acara = Acara::find($id);
        $data = $acara->acarap->where('status', 1);
        $pdf = PDF::loadView('biro4.download_peserta', ['data' => $data]);
        return $pdf->download('peserta_acara_' . $acara->nama_acara . '.pdf');
    }

    public function updatepembayaran(Request $request, $id)
    {
        $pembayaran = Pendaftaran_Acara::find($id);
        $status = $request->input('status');
        $history = new History();
        // Validasi status yang diterima
        if ($status === '0') {
            $pembayaran->pembayaran->status_pembayaran = $request->status;
            $pembayaran->pembayaran->save();

            $history->user_id = $pembayaran->user_id;
            $history->acara_id = $pembayaran->acara_id;
            $history->judul = 'Status Pembayaran Acara ' . $pembayaran->acarap->nama_acara . ' Anda Telah Diubah Menjadi Tidak Valid';
            $history->save();
            $sucess = array(
                'message' => 'Berhasil validasi Pembayaran',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($sucess);
        } elseif ($status === '1') {
            $pembayaran->pembayaran->status_pembayaran = $request->status;
            $pembayaran->pembayaran->save();

            $pembayaran->acarap->kuota = $pembayaran->acarap->kuota - 1;
            $pembayaran->acarap->save();

            $history->user_id = $pembayaran->user_id;
            $history->acara_id = $pembayaran->acara_id;
            $history->judul = 'Status Pembayaran Acara ' . $pembayaran->acarap->nama_acara . ' Anda Telah Diubah Menjadi Valid';
            $history->save();
            $sucess = array(
                'message' => 'Berhasil validasi Pembayaran',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($sucess);
        }
    }

    public function pengajuanacara()
    {
        $acara = Acara::where('penanggung_jawab', auth()->user()->id)->paginate();
        return view('panitia.pengajuanacara', compact('acara'));
    }

    public function simpanpengajuan(Request $request)
    {
        $acara = new Acara();
        if (!empty($request->input('terbuka_untuk'))) {
            $acara->jenis_acara = $request->jenis_acara;
            $acara->nama_acara = $request->nama_acara;
            $acara->warna = $request->warna;
            $acara->deskripsi = $request->deskripsi;
            $acara->waktu_mulai = $request->waktu_mulai;
            $acara->waktu_selesai = $request->waktu_selesai;
            $acara->lokasi = $request->lokasi;
            $acara->harga_dosen = $request->harga_dosen;
            $acara->harga_umum = $request->harga_umum;
            $acara->harga_mhs = $request->harga_mhs;
            $acara->harga_staff = $request->harga_staff;
            $acara->batas_pendaftaran = $request->batas_pendaftaran;
            $acara->kuota = $request->kuota;
            $acara->penanggung_jawab = auth()->user()->id;
            $acara->terbuka_untuk = json_encode($request->input('terbuka_untuk'));
            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar');
                $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
                $gambar->move(public_path('fotoacara'), $namaGambar);
                $acara->gambar = $namaGambar;
            }
            $acara->save();
            $sucess = array(
                'message' => 'Anda sudah membuat acara',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($sucess);
        } else {
            $sucess = array(
                'message' => 'Anda gagal membuat acara',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($sucess);
        }
    }
}
