<div class="modal fade" id="edit-form" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <form class="modal-content" id="form-edit">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="card-title d-flex align-items-center">
                    <h5 class="mb-0 text-info">Form Penjadwalan Kelas</h5>
                </div>
                <hr>
                <div class="row mb-3">
                    <label for="nama_matkul" class="col-sm-3 col-form-label">Hari Jam</label>
                    <div class="col-sm-3">
                        <select name="hari" id="e-hari" class="form-control" required>
                            <option value="">Pilih Hari</option>
                            <?php $hariIndo = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']; ?>
                            @foreach ($hariIndo as $hari)
                                <option value="{{ $hari }}">{{ $hari }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="e-jam_mulai" name="jam_mulai"
                            placeholder="Jam Mulai" required>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="e-jam_selesai" name="jam_selesai"
                            placeholder="Jam Selesai" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Program Studi</label>
                    <div class="col-sm-9 e-view-prodi d-flex flex-row" style="height: 30vh; overflow-y: auto;">

                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Semester</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="e-semester" name="semester" data-placeholder="Pilih Semester"
                            required>
                            <option></option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Mata Kuliah</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="e-id_matkul" name="id_matkul"
                            data-placeholder="Pilih Matakuliah" required>
                            <option></option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Rombel Kelas</label>
                    <div class="col-sm-9">
                        <select name="rombel" id="e-rombel" class="form-control">
                            <option value="">Pilih Rombel</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_matkul" class="col-sm-3 col-form-label">Gedung Ruang Kelas</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="e-id_kelas" name="id_kelas" data-placeholder="Pilih Ruang Kelas"
                            required>
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_matkul" class="col-sm-3 col-form-label">Dosen Pengajar</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="e-id_dosen" name="id_dosen" data-placeholder="Pilih Dosen"
                            required>
                            <option></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
