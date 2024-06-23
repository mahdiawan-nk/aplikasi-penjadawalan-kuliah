<div class="modal fade" id="add-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" id="form-add">
            @csrf
            <div class="modal-body">
                <div class="card-title d-flex align-items-center">
                    <h5 class="mb-0 text-info">Form Tambah Dosen</h5>
                </div>
                <hr>
                <div class="row mb-3">
                    <label for="id_prodi" class="col-sm-3 col-form-label">Program Studi</label>
                    <div class="col-sm-9">
                        <select name="id_prodi" id="id_prodi" class="form-control" required></select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-3 col-form-label">Email Dosen</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="email" name="email"
                            placeholder="Enter Email Dosen" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nidn" class="col-sm-3 col-form-label">NIDN Dosen</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nidn" name="nidn"
                            placeholder="Enter NIDN Dosen" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_dosen" class="col-sm-3 col-form-label">Nama Dosen</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_dosen" name="nama_dosen"
                            placeholder="Enter Nama Dosen" required>
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
