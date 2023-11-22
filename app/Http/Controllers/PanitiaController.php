<?php

namespace App\Http\Controllers;
use App\Models\Acara;
use Illuminate\Http\Request;
use App\Models\Pendaftaran_Acara;
use App\Models\History;
use PDF;

class PanitiaController extends Controller
{
    public function index()
    {
        $event = Acara::whereNotNull('harga_mhs')
        ->orwhereNotNull('harga_dosen')
        ->orwhereNotNull('harga_umum')
        ->paginate();
        $acara = Acara::paginate();
        return view('panitia.dashboard',compact('event','acara'));
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
        if ($status === '0' || $status === '1') {
            $pembayaran->pembayaran->status_pembayaran = $request->status;
            $pembayaran->pembayaran->save();

            $history->user_id = $pembayaran->user_id;
            $history->acara_id = $pembayaran->acara_id;
            if ($status === '1') {
                $history->judul = 'Status Pembayaran Acara ' . $pembayaran->acarap->nama_acara . ' Anda Telah Diubah Menjadi Valid';
            } elseif ($status === '0') {
                $history->judul = 'Status Pembayaran Acara ' . $pembayaran->acarap->nama_acara . ' Anda Telah Diubah Menjadi Tidak Valid';
            }
            $history->save();


            return redirect()->back()->with('sucess', ' data berhasil');
        } else {
            // Tambahkan penanganan kesalahan jika status tidak valid
            return redirect()->back()->with('error', ' ');
        }
    }
}