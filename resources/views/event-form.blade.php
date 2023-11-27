<x-modal-action action="{{ $action }}">

    @if ($data->id)
    @method('put')
    @endif
    <div class="form-group">
        <label for="exampleInputEmail1">Jenis Acara</label>
        <select class="custom-select" name="jenis_acara">
            <option value="Seminar" {{ $data->jenis_acara === 'Seminar' ? 'selected' : '' }}>Seminar</option>
            <option value="Lomba" {{ $data->jenis_acara === 'Lomba' ? 'selected' : '' }}>Lomba</option>
            <option value="Workshop" {{ $data->jenis_acara === 'Workshop' ? 'selected' : '' }}>Workshop</option>
            <option value="Pelatihan" {{ $data->jenis_acara === 'Pelatihan' ? 'selected' : '' }}>Pelatihan</option>
            <option value="Aktivitas Sosial" {{ $data->jenis_acara === 'Aktivitas Sosial' ? 'selected' : '' }}>Aktivitas Sosial</option>
            <option value="Pameran" {{ $data->jenis_acara === 'Pameran' ? 'selected' : '' }}>Pameran</option>
            <option value="Job Fair" {{ $data->jenis_acara === 'Job Fair' ? 'selected' : '' }}>Job Fair</option>
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
    @php
    $tbk = json_decode($data->terbuka_untuk);
    @endphp
    <div class="form-group">
        <label for="">Terbuka Untuk</label>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="Mahasiswa" name="terbuka_untuk[]" id="chkmhs" @if (in_array('Mahasiswa', $tbk)) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Mahasiswa
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="Dosen" name="terbuka_untuk[]" id="chkdsn" @if (in_array('Dosen', $tbk)) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Dosen
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="Umum" name="terbuka_untuk[]" id="chkumum" @if (in_array('Umum', $tbk)) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Umum
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="Staff" name="terbuka_untuk[]" id="chkstaff" @if (in_array('Staff', $tbk)) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Staff
            </label>
        </div>
    </div>
    <div class="form-group" id="hargaInputmahasiswa" style="display: none;">
        <label for="exampleInputPassword1">Harga Mahasiswa</label>
        <input type="number" class="form-control" name="harga_mhs" value="{{ $data->harga_mhs }}" placeholder="Harga Mahasiswa">
    </div>
    <div class="form-group" id="hargaInputdosen" style="display: none;">
        <label for="exampleInputPassword1">Harga Dosen</label>
        <input type="number" class="form-control" name="harga_dosen" value="{{ $data->harga_dosen }}" placeholder="Harga Dosen">
    </div>
    <div class="form-group" id="hargaInputumums" style="display: none;">
        <label for="exampleInputPassword1">Harga Umum</label>
        <input type="number" class="form-control" name="harga_umum" value="{{ $data->harga_umum }}" placeholder="Harga Umum">
    </div>
    <div class="form-group" id="hargaInputstafff" style="display: none;">
        <label for="exampleInputPassword1">Harga Staff</label>
        <input type="number" class="form-control" name="harga_staff" value="{{ $data->harga_staff }}" placeholder="Harga Staff">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Batas Pendaftaran</label>
        <input type="datetime-local" class="form-control" value="{{ $data->batas_pendaftaran }}" name="batas_pendaftaran">
    </div>
    <div class="form-group">
        <label for="">Kuota Peserta</label>
        <input type="number" class="form-control" value="{{ $data->kuota }}" name="kuota">
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
        <label>Penanggung Jawab</label>
        <select class="custom-select" name="penanggung_jawab" id="panitiaForm1">
            <option selected>Choose...</option>
        </select>
    </div>
    <div class="row mt-3" style="display: flex; justify-content:space-between;">
        <div>
            <button type="button" class="btn btn-danger" name="delete" id="deleteButton">Hapus</button>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </div>
    <script>
        // Ambil elemen checkbox
        var chkMahasiswa = document.getElementById('chkmhs');
        var chkDosen = document.getElementById('chkdsn');
        var chkUmum = document.getElementById('chkumum');
        var chkStaff = document.getElementById('chkstaff');

        // Ambil elemen input harga
        var hargaInputdsn = document.getElementById('hargaInputdosen');
        var hargaInputmhs = document.getElementById('hargaInputmahasiswa');
        var hargaInputumum = document.getElementById('hargaInputumums');
        var hargaInputstaff = document.getElementById('hargaInputstafff');

        // Tambahkan event listener saat checkbox berubah
        chkMahasiswa.addEventListener('change', toggleHargaInput);
        chkDosen.addEventListener('change', toggleHargaInput);
        chkUmum.addEventListener('change', toggleHargaInput);
        chkStaff.addEventListener('change', toggleHargaInput);

        function toggleHargaInput() {
            hargaInputmhs.style.display = chkMahasiswa.checked ? 'block' : 'none';
            hargaInputdsn.style.display = chkDosen.checked ? 'block' : 'none';
            hargaInputumum.style.display = chkUmum.checked ? 'block' : 'none';
            hargaInputstaff.style.display = chkStaff.checked ? 'block' : 'none';
        }
    </script>
    <!-- <script>
        const eventId = "{{ $data->id }}"; // Ganti dengan cara Anda mendapatkan ID acara yang benar
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const modal = $('#modal-action');
        $('#deleteButton').on('click', function() {
            if (confirm('Apakah Anda yakin ingin menghapus acara ini?')) {

                $.ajax({
                    url: `{{ url('eventsdelete') }}/${eventId}`,
                    method: 'delete',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    success: function(res) {
                        modal.modal('hide');
                        location.reload();
                    },
                    error: function(res) {
                        const message = res.responseJSON.message || 'Terjadi kesalahan';
                        iziToast.error({
                            title: 'Error',
                            message: message,
                            position: 'topRight'
                        });
                    }
                });
            }
            console.log(eventId)
        });
    </script> -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectPenanggungJawab = document.querySelector('panitiaForm1');

        });
    </script>
</x-modal-action>