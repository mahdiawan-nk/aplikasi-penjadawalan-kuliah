<div class="modal fade" id="edit-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" id="form-edit">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="card-title d-flex align-items-center">
                    <h5 class="mb-0 text-info">Form Ubah Semester</h5>
                </div>
                <hr>
                <div class="row mb-3">
                    <label for="periode" class="col-sm-3 col-form-label">Periode</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="e-periode" name="periode"
                            placeholder="Enter Periode">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="semester" class="col-sm-3 col-form-label">Semester</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="e-semester" name="semester"
                            placeholder="Enter Semester">
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
