<div class="modal fade" id="add-form" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form class="modal-content" id="form-add">
            @csrf
            <div class="modal-body">
                <div class="card-title d-flex align-items-center">
                    <h5 class="mb-0 text-info">Form Tambah Pengguna</h5>
                </div>
                <hr>
                <div class="row mb-3">
                    <label for="jenjang_study" class="col-sm-3 col-form-label">Role</label>
                    <div class="col-sm-9">
                        <select name="role" id="role" class="form-control" required>
                            <option value="">Pilih Role</option>
                            <option value="1" selected>Operator</option>
                            <option value="2">Ka Prodi</option>
                            
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter Name" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="email" name="email"
                            placeholder="Enter Nama Email" required>
                    </div>
                </div>
                <div class="row mb-3 v-nim">
                    <label for="nidn_nim" class="col-sm-3 col-form-label">NIDN/NIM</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nidn_nim" name="nidn_nim"
                            placeholder="Enter NIDN or NIM">
                    </div>
                </div>
                <div class="row mb-3 v-prodi">
                    <label for="prodi" class="col-sm-3 col-form-label">Prodi</label>
                    <div class="col-sm-9">
                        <select name="prodi" id="prodi" class="form-control"></select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputChoosePassword" class="form-label col-sm-3">Enter
                        Password</label>
                    <div class="col-sm-9">
                        <div class="input-group" id="show_hide_password">
                            <input type="password" name="password" class="form-control border-end-0"
                                id="inputChoosePassword" value="12345678" placeholder="Enter Password" required> <a
                                href="javascript:;" class="input-group-text bg-transparent"><i
                                    class='bx bx-hide'></i></a>
                        </div>
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
