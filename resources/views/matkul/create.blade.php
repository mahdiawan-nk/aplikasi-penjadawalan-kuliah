<div class="modal fade" id="add-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form class="modal-content" id="form-add">
            @csrf
            <div class="modal-body">
                <div class="card-title d-flex align-items-center">
                    <h5 class="mb-0 text-info">Form Tambah Mata Kuliah</h5>
                </div>
                <hr>
                <div class="row mb-3">
                    <label for="id_prodi" class="col-sm-3 col-form-label">Program Studi</label>
                    <div class="col-sm-9">
                        <select name="id_prodi" id="id_prodi" class="form-control" required></select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kode_matkul" class="col-sm-3 col-form-label">Kode Mata Kuliah</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="kode_matkul" name="kode_matkul"
                            placeholder="Enter Kode Mata Kuliah " required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_matkul" class="col-sm-3 col-form-label">Nama Mata Kuliah</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_matkul" name="nama_matkul"
                            placeholder="Enter Nama Mata Kuliah" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="id_semester" class="col-sm-3 col-form-label">Semester</label>
                    <div class="col-sm-9">
                        <select name="id_semester" id="id_semester" class="form-control" required></select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="type_matkul" class="col-sm-3 col-form-label">Jenis Mata Kuliah</label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type_matkul" id="teori"
                                value="T" required>
                            <label class="form-check-label" for="teori">Teori</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type_matkul" id="praktek"
                                value="P" required>
                            <label class="form-check-label" for="praktek">Praktek</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sks" class="col-sm-3 col-form-label">SKS Mata Kuliah</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="sks" name="sks"
                            placeholder="Enter SKS" required>
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
