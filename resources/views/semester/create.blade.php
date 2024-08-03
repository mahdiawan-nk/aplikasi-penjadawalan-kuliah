<div class="modal fade" id="add-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" id="form-add">
            @csrf
            <div class="modal-body">
                <div class="card-title d-flex align-items-center">
                    <h5 class="mb-0 text-info">Form Tambah Semester</h5>
                </div>
                <hr>
                <div class="row mb-3">
                    <label for="periode" class="col-sm-3 col-form-label">Tahun Akademik</label>
                    <div class="col-sm-9">
                        <select name="id_tahun_akademik" class="form-select" id="id_ta">
                            <option value="">Pilih Tahun Akademik</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="periode" class="col-sm-3 col-form-label">Periode</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="periode" name="periode"
                            placeholder="Enter Periode" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="semester" class="col-sm-3 col-form-label">Semester</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="semester" name="semester"
                            placeholder="Enter Semester" required>
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
