<div class="modal fade" id="add-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form class="modal-content" id="form-add">
            @csrf
            <div class="modal-body">
                <div class="card-title d-flex align-items-center">
                    <h5 class="mb-0 text-info">Form Tambah Prodi</h5>
                </div>
                <hr>
                <div class="row mb-3">
                    <label for="kode_prodi" class="col-sm-3 col-form-label">Kode Prodi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="kode_prodi" name="kode_prodi"
                            placeholder="Enter kode_prodi" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_prodi" class="col-sm-3 col-form-label">Nama Prodi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_prodi" name="nama_prodi"
                            placeholder="Enter Nama Prodi" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alias" class="col-sm-3 col-form-label">Nama Alias Prodi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="alias" name="alias"
                            placeholder="Enter Nama Alias Prodi" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jenjang_study" class="col-sm-3 col-form-label">Jenjang Study</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="jenjang_study" name="jenjang_study"
                            placeholder="Enter Jenjang Study" required>
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
