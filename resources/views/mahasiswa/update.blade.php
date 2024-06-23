<div class="modal fade" id="edit-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form class="modal-content" id="form-edit">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="card-title d-flex align-items-center">
                    <h5 class="mb-0 text-info">Form Update Mahasiswa</h5>
                </div>
                <hr>
                <div class="row mb-3">
                    <label for="id_prodi" class="col-sm-3 col-form-label">Program Studi</label>
                    <div class="col-sm-9">
                        <select name="id_prodi" id="e-id_prodi" class="form-control"></select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nidn" class="col-sm-3 col-form-label">Semester</label>
                    <div class="col-sm-9 view-semester">

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nim" class="col-sm-3 col-form-label">NIM</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="e-nim" name="nim"
                            placeholder="Enter NIM">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="e-email" name="email"
                            placeholder="Enter Email">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="e-nama" name="e-nama"
                            placeholder="Enter Nama">
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
