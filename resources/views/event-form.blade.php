<x-modal-action action="{{ $action }}">
    @if ($data->id)
    @method('put')
    @endif
    <div class="form-group">
        <label for="exampleInputEmail1">Jenis Acara</label>
        <select class="custom-select" name="jenis_acara">
            <option value="Seminar" {{ $data->jenis_acara === 'Seminar' ? 'selected' : '' }}>Seminar</option>
            <option value="Event Kampus" {{ $data->jenis_acara === 'Event Kampus' ? 'selected' : '' }}>Event Kampus</option>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Nama Acara</label>
        <input type="text" class="form-control" name="nama_acara" value="{{ $data->nama_acara }}" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Warna</label>
        <input type="color" class="form-control" name="warna" value="{{ $data->warna }}" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="inputDescription">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="4">{{ $data->deskripsi }}</textarea>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Waktu Mulai Acara</label>
        <input type="datetime-local" class="form-control" value="{{ $data->waktu_mulai }}" name="waktu_mulai">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Waktu Selesai Acara</label>
        <input type="datetime-local" class="form-control" value="{{ $data->waktu_selesai }}" name="waktu_selesai">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Lokasi Acara</label>
        <input type="text" class="form-control" name="lokasi" value="{{ $data->lokasi }}" placeholder="Lokasi Acara">
    </div>
    <div class="form-group" id="hargaInputmhs">
        <label for="exampleInputPassword1">Harga Mahasiswa</label>
        <input type="number" class="form-control" name="harga_mhs"   value="{{ $data->harga_mhs }}" placeholder="Harga Mahasiswa">
    </div>
    <div class="form-group" id="hargaInputdsn">
        <label for="exampleInputPassword1">Harga Dosen</label>
        <input type="number" class="form-control" name="harga_dosen" value="{{ $data->harga_dosen }}" placeholder="Harga Dosen">
    </div>
    <div class="form-group" id="hargaInputumum">
        <label for="exampleInputPassword1">Harga Umum</label>
        <input type="number" class="form-control" name="harga_umum"  value="{{ $data->harga_umum }}" placeholder="Harga Umum">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Batas Pendaftaran</label>
        <input type="datetime-local" class="form-control" value="{{ $data->batas_pendaftaran }}" name="batas_pendaftaran">
    </div>
    <div class="form-group">
        <label for="exampleInputFile">Gambar</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="form-control" name="gambar">

            </div>
        </div>
    </div>
    @php
    $tbk = json_decode($data->terbuka_untuk);
    @endphp
    <div class="form-group">
        <label for="">Terbuka Untuk</label>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="Mahasiswa" name="terbuka_untuk[]" id="chkMahasiswa" @if (in_array('Mahasiswa', $tbk)) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Mahasiswa
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="Dosen" name="terbuka_untuk[]" id="chkDosen" @if (in_array('Dosen', $tbk)) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Dosen
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="Umum" name="terbuka_untuk[]" id="chkUmum" @if (in_array('Umum', $tbk)) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Umum
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="delete" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Delete</label>
                </div>
            </div>
        </div>
    </div>
    <script>
    // Ambil elemen checkbox
    var chkMahasiswa = document.getElementById('chkMahasiswa');
    var chkDosen = document.getElementById('chkDosen');
    var chkUmum = document.getElementById('chkUmum');

    // Ambil elemen input harga
    var hargaInputdsn = document.getElementById('hargaInputdsn');
    var hargaInputmhs = document.getElementById('hargaInputmhs');
    var hargaInputumum = document.getElementById('hargaInputumum');


    // Tambahkan event listener saat checkbox berubah
    chkMahasiswa.addEventListener('change', toggleHargaInput);
    chkDosen.addEventListener('change', toggleHargaInput);
    chkUmum.addEventListener('change', toggleHargaInput);

    function toggleHargaInput() {
            hargaInputmhs.disabled = !chkMahasiswa.checked;
            hargaInputdsn.disabled = !chkDosen.checked;
            hargaInputumum.disabled = !chkUmum.checked;
    }
</script>
</x-modal-action>