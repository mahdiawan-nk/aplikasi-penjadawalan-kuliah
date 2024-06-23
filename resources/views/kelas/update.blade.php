<div class="modal fade" id="edit-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" id="form-edit">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="card-title d-flex align-items-center">
                    <h5 class="mb-0 text-info">Form Update Kelas</h5>
                </div>
                <hr>
                <div class="row mb-3">
                    <label for="nama_gedung" class="col-sm-3 col-form-label">Nama Gedung</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="e-nama_gedung" name="nama_gedung"
                            placeholder="Enter Nama Gedung">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_kelas" class="col-sm-3 col-form-label">Nama Kelas/Ruangan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="e-nama_kelas" name="nama_kelas"
                            placeholder="Enter Nama Kelas / Ruangan">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kapasitas" class="col-sm-3 col-form-label">Kapasitas</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="e-kapasitas" name="kapasitas"
                            placeholder="Enter Kapasitas">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
