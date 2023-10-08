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
    <div class="form-group">
        <label for="exampleInputPassword1">Harga</label>
        <input type="number" class="form-control" name="harga" value="{{ $data->harga }}" placeholder="Harga">
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
    <div class="form-group">
        <label for="exampleInputEmail1">Terbuka Untuk</label>
        <select class="custom-select" name="terbuka_untuk">
            <option selected>Choose...</option>
            <option value="Mahasiswa" {{ $data->terbuka_untuk === 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
            <option value="Dosen" {{ $data->terbuka_untuk === 'Dosen' ? 'selected' : '' }}>Dosen</option>
            <option value="Umum" {{ $data->terbuka_untuk === 'Umum' ? 'selected' : '' }}>Umum</option>
        </select>
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
</x-modal-action>