<div class="modal fade" id="edit-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form class="modal-content" id="form-edit">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="card-title d-flex align-items-center">
                    <h5 class="mb-0 text-info">Form Tambah Mata Kuliah</h5>
                </div>
                <hr>
                <div class="row mb-3">
                    <label for="id_prodi" class="col-sm-3 col-form-label">Program Studi</label>
                    <div class="col-sm-9">
                        <select name="id_prodi" id="e-id_prodi" class="form-control"></select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kode_matkul" class="col-sm-3 col-form-label">Kode Mata Kuliah</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="e-kode_matkul" name="kode_matkul"
                            placeholder="Enter Kode Mata Kuliah">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_matkul" class="col-sm-3 col-form-label">Nama Mata Kuliah</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="e-nama_matkul" name="nama_matkul"
                            placeholder="Enter Nama Mata Kuliah">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="id_semester" class="col-sm-3 col-form-label">Semester</label>
                    <div class="col-sm-9">
                        <select name="id_semester" id="e-id_semester" class="form-control"></select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="type_matkul" class="col-sm-3 col-form-label">Jenis Mata Kuliah</label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type_matkul" id="e-teori"
                                value="T">
                            <label class="form-check-label" for="e-teori">Teori</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type_matkul" id="e-praktek"
                                value="P">
                            <label class="form-check-label" for="e-praktek">Praktek</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sks" class="col-sm-3 col-form-label">SKS Mata Kuliah</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="e-sks" name="sks"
                            placeholder="Enter SKS">
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
