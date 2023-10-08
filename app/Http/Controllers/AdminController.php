<?php

namespace App\Http\Controllers;
use App\Models\Acara;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;

class AdminController extends Controller
{
    public function index(){
       
        return view('admin.manage_acara');
    }

    public function listacara(Request $request){
        $start = date('YYYY-MM-DD ', strtotime($request->waktu_mulai));
        $end = date('YYYY-MM-DD ', strtotime($request->waktu_selesai));

        $events = Acara::where('waktu_mulai','>=',$start)->orWhere('waktu_selesai','<=',$end)->get()
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

    public function simpanacara(Request $request){

        $data = Acara::create($request->all());
        if($request->hasFile('gambar')){
            $request->file('gambar')->move('fotoacara/', $request->file('gambar')->getClientOriginalName());
            $data->gambar = $request->file('gambar')->getClientOriginalName();

        }
        return redirect()->back();
    }

    public function editEvent(Request $request)
    {
        // Validasi data input jika diperlukan

        // Cari event berdasarkan ID
        $event = Acara::find($request->input('id'));

        if (!$event) {
            return response()->json(['success' => false, 'message' => 'Event not found']);
        }

        // Update data event
        $event->jenis_acara = $request->input('jenis_acara');
        $event->nama_acara = $request->input('title');
        $event->warna = $request->input('warna');
        $event->deskripsi = $request->input('deskripsi');
        $event->start = $request->input('start');
        $event->end = $request->input('end');
        $event->lokasi = $request->input('lokasi');
        $event->harga = $request->input('harga');
        $event->batas_pendaftaran = $request->input('batas_pendaftaran');
        $event->terbuka_untuk = $request->input('terbuka_untuk');

        // Simpan perubahan
        if ($event->save()) {
            return response()->json(['success' => true, 'message' => 'Event updated successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to update event']);
        }
    }
   
    public function create(Acara $event)
    {
        return view('event-form', ['data' => $event, 'action' => route('events.store')]);
    }
    public function store(EventRequest $request, Acara $event)
    {
        return $this->update($request, $event);
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
        if ($request->has('delete')) {
            return $this->destroy($event);
        }
        
        $event->jenis_acara = $request->jenis_acara;
        $event->nama_acara = $request->nama_acara;
        $event->warna = $request->warna;
        $event->deskripsi = $request->deskripsi;
        $event->waktu_mulai = $request->waktu_mulai;
        $event->waktu_selesai = $request->waktu_selesai;
        $event->lokasi = $request->lokasi;
        $event->harga = $request->harga;
        $event->batas_pendaftaran = $request->batas_pendaftaran;
        $event->terbuka_untuk = $request->terbuka_untuk;
        if($request->hasFile('gambar')){
            $request->file('gambar')->move('fotoacara/', $request->file('gambar')->getClientOriginalName());
            $event->gambar = $request->file('gambar')->getClientOriginalName();

        }

        $event->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Save data successfully'
        ]);
    }
    public function destroy(Acara $event)
    {
        $event->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Delete data successfully'
        ]);
    }
    
}
