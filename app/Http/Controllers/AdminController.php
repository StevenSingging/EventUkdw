<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Models\History;
use App\Models\Pendaftaran_Acara;
use App\Models\Pembayaran;
use PDF;
use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{


    public function index()
    {

        return view('biro4.dashboard');
    }

    public function acara()
    {

        return view('biro4.manage_acara');
    }

    public function listacara(Request $request)
    {
        $start = date('YYYY-MM-DD ', strtotime($request->waktu_mulai));
        $end = date('YYYY-MM-DD ', strtotime($request->waktu_selesai));

        $events = Acara::where('waktu_mulai', '>=', $start)->orWhere('waktu_selesai', '<=', $end)->get()
            ->map(fn ($item) => [
                'id' => $item->id,
                'jenis_acara' => $item->jenis_acara,
                'title' => $item->nama_acara,
                'start' => $item->waktu_mulai,
                'end' => $item->waktu_selesai,
                'color' => $item->warna,
                'deskripsi' => $item->deskripsi,
                'lokasi' => $item->lokasi,
                'harga_dosen' => $item->harga_dosen,
                'harga_mhs' => $item->harga_mhs,
                'harga_umum' => $item->harga_umum,
                'batas_pendaftaran' => $item->batas_pendaftaran,
                'gambar' => $item->gambar,
                'terbuka_untuk' => $item->terbuka_untuk

            ]);

        return response()->json($events);
    }

    public function simpanacara(Request $request, Acara $event)
    {
        if (!empty($request->input('terbuka_untuk'))) {
            $event->jenis_acara = $request->jenis_acara;
            $event->nama_acara = $request->nama_acara;
            $event->warna = $request->warna;
            $event->deskripsi = $request->deskripsi;
            $event->waktu_mulai = $request->waktu_mulai;
            $event->waktu_selesai = $request->waktu_selesai;
            $event->lokasi = $request->lokasi;
            $event->harga_dosen = $request->harga_dosen;
            $event->harga_umum = $request->harga_umum;
            $event->harga_mhs = $request->harga_mhs;
            $event->batas_pendaftaran = $request->batas_pendaftaran;
            $event->penanggung_jawab = $request->penanggung_jawab;
            $event->terbuka_untuk = json_encode($request->input('terbuka_untuk'));
            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar');
                $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
                $gambar->move(public_path('fotoacara'), $namaGambar);
                $event->gambar = $namaGambar;
            }
            $event->save();
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

    public function create(Acara $event)
    {
        return view('event-form', ['data' => $event, 'action' => route('events.store')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Acara $event)
    {
        return view('event-form', ['data' => $event, 'action' => route('events.update', $event->id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Acara $event)
    {   
        if (!empty($request->input('terbuka_untuk'))) {
            $event->jenis_acara = $request->jenis_acara;
            $event->nama_acara = $request->nama_acara;
            $event->warna = $request->warna;
            $event->deskripsi = $request->deskripsi;
            $event->waktu_mulai = $request->waktu_mulai;
            $event->waktu_selesai = $request->waktu_selesai;
            $event->lokasi = $request->lokasi;
            $event->harga_dosen = $request->harga_dosen;
            $event->harga_umum = $request->harga_umum;
            $event->harga_mhs = $request->harga_mhs;
            $event->batas_pendaftaran = $request->batas_pendaftaran;
            $event->terbuka_untuk = json_encode($request->input('terbuka_untuk'));
            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar');
                $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
                $gambar->move(public_path('fotoacara'), $namaGambar);
                $event->gambar = $namaGambar;
            }
            $event->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Save data successfully'
            ]);
        }
    }
    public function destroy($id)
    {
        $event = Acara::findOrFail($id);
        $event->delete();
        $sucess = array(
            'message' => 'Anda berhasil menghapus acara',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($sucess);
 
    }

    public function home()
    {
        $event = Acara::latest()->take(6)->get();
        $count = Acara::count();
        return view('welcome', compact('event', 'count'));
    }

    public function lihatacara($id)
    {
        $event = Acara::find($id);
        return view('lihat-event', compact('event'));
    }

    public function peserta()
    {
        $event = Acara::paginate();
        $count = Acara::count();
        return view('biro4.peserta', compact('event', 'count'));
    }

    public function peserta_acara($id)
    {
        $peserta = Pendaftaran_Acara::where('acara_id', $id)->paginate();
        $nama_acara = Acara::where('id', $id)->first();
        //dd($nama_acara);
        return view('biro4.peserta_acara', compact('peserta', 'nama_acara'));
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


    public function dashboardb2()
    {
        $event = Acara::whereNotNull('harga_mhs')
        ->orwhereNotNull('harga_dosen')
        ->orwhereNotNull('harga_umum')
        ->paginate();
        return view('biro2.dashboard', compact('event'));
    }

    public function peserta_acara_biro2($id)
    {
        $pembayaran = Pendaftaran_Acara::where('acara_id', $id)->first();
        $peserta = Pendaftaran_Acara::where('acara_id', $id)
            ->has('pembayaran') // hanya peserta dengan pembayaran
            ->paginate();

        //dd($nama_acara);
        return view('biro2.validasipembayaran', compact('peserta', 'pembayaran'));
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

    public function cetakpeserta($id)
    {
        $acara = Acara::find($id);
        $data = $acara->acarap->where('status', 1);
        $pdf = PDF::loadView('biro4.download_peserta', ['data' => $data]);
        return $pdf->download('peserta_acara_' . $acara->nama_acara . '.pdf');
    }
}
