@can('IsDospem')

{{-- Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Buat Agenda pertemuan dengan Mahasiswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-start">
          <form method="post" action="/dashboard/agenda-bimbingan">
              @csrf
              {{-- <div>
                  <label for="hari">Hari</label>
              </div>
              <div class="input-group mb-3">
                  <select class="form-select" name="hari" id="hari">
                    @foreach ($hari as $day)
                      <option value="{{ $day }}">{{ $day }}</option>
                    @endforeach
                  </select>
              </div> --}}
              <div class="mb-3">
                  <label for="tanggal" class="form-label">Tanggal</label>
                  <input type="date" class="form-control" name="tanggal" id="tanggal" required>
              </div>
              <div class="mb-3">
                  <label for="waktu_awal" class="form-label">Jam Awal</label>
                  <input type="time" class="form-control" name="waktu_awal" id="waktu_awal" required>
              </div>
              <div class="mb-3">
                  <label for="waktu_akhir" class="form-label">Jam Akhir</label>
                  <input type="time" class="form-control" name="waktu_akhir" id="waktu_akhir" required>
              </div>
              <div class="form-check">
                  <input class="form-check-input" type="radio" name="jenis_pertemuan" id="offline" value="Offline" checked>
                  <label class="form-check-label" for="offline">
                    Offline
                  </label>
              </div>
              <div class="form-check">
                  <input class="form-check-input" type="radio" name="jenis_pertemuan" id="online" value="Online">
                  <label class="form-check-label" for="online">
                    Online
                  </label>
              </div>
              <div class="mb-3">
                  <label for="kuota" class="form-label">Kuota Bimbingan</label>
                  <input type="number" class="form-control" name="kuota" id="kuota" placeholder="Masukkan kuota bimbingan" required>
              </div>
              <div class="mb-3">
                  <label for="keterangan" class="form-label">Keterangan</label>
                  <textarea class="form-control" name="keterangan" id="keterangan" rows="3" placeholder="Jika online, masukkan link disini..."></textarea>
              </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
          </form>
    </div>
  </div>
</div>

<script>
  var today = new Date().toISOString().split('T')[0];
  document.getElementById('tanggal').setAttribute('min', today);
</script>

@endcan

@can('IsMahasiswa')
  
{{-- Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Buat Agenda pertemuan dengan Mahasiswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-start">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>
                      <th>Hari</th>
                      <th>Tanggal</th>
                      <th>Waktu</th>
                      <th>Pertemuan</th>
                  </tr>
              </thead>
              <tbody>
                  {{-- @dd($dataappointment) --}}
                  <tr>
                      <td>{{ $appointment->hari }}</td>
                      <td>{{ $appointment->tanggal }}</td>
                      <td>{{ $appointment->waktu_awal . " - " . $appointment->waktu_akhir}}</td>
                      <td>{{ $appointment->jenis_pertemuan }}</td>
                  </tr>
              </tbody>
          </table>
        </div>
        
          <form method="post" action="/dashboard/bimbingan">
              @csrf
              <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
              <input type="hidden" name="pembimbing_id" value="{{ $appointment->pembimbing_id }}">
              <input type="hidden" name="tanggal_bimbingan" value="{{ $appointment->tanggal }}">
              <div class="mb-3">
                  <label for="jam_awal" class="form-label">Jam Awal</label>
                  <input type="time" class="form-control" name="jam_awal" id="jam_awal" required>
              </div>
              <div class="mb-3">
                  <label for="jam_akhir" class="form-label">Jam Akhir</label>
                  <input type="time" class="form-control" name="jam_akhir" id="jam_akhir" required>
              </div>
              <div class="mb-3">
                  <label for="materi_pembahasan" class="form-label">Materi Pembahasan</label>
                  <textarea class="form-control" name="materi_pembahasan" id="materi_pembahasan" rows="3" placeholder="Masukkan materi pembahasan bimbingan yang akan dilaksanakan..."></textarea>
              </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Ajukan</button>
      </div>
          </form>
    </div>
  </div>
</div>  

@endcan