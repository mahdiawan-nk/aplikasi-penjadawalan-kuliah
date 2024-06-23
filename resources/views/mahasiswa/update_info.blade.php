@extends('layouts.app')
@section('style')
    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <style>
        .page-wrapper-full {
            height: 100%;
            margin-top: 60px;
            margin-bottom: 30px;
            margin-left: 0px;
        }
    </style>
@endsection

@section('wrapper')
    <div class=".page-wrapper-full">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Data Mahasiswa</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item active" aria-current="page">Form Update Data Mahasiswa</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 mx-auto">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                                </div>
                                <h5 class="mb-0 text-primary">Update Informasi Mahasiswa</h5>
                            </div>
                            <hr>
                            <form class="row g-3" id="form-update">
                                @csrf
                                @method('PUT')
                                <div class="col-md-6">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        fdprocessedid="i8tdpi" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="nim" class="form-label">NIM Mahasiswa</label>
                                    <input type="text" class="form-control" id="nim" name="nim"
                                        fdprocessedid="ondcb" readonly>
                                </div>
                                <div class="col-md-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        fdprocessedid="1c9wpn" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">Program Studi</label>
                                    <select name="id_prodi" id="id_prodi" class="form-control"
                                        aria-placeholder="Pilih Prodi" required>
                                        <option value="">Pilih Prodi</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="semester" class="form-label">Semester</label>
                                    <select name="semester" id="semester" class="form-control" required></select>
                                </div>
                                <div class="col-md-3">
                                    <label for="kelas" class="form-label">Kelas/Rombel</label>
                                    <input type="text" class="form-control" id="kelas" name="kelas"
                                        fdprocessedid="d519b" required>
                                </div>
                                <div class="col-12">
                                    <label for="alamat" class="form-label">Alamat Tinggal Mahasiswa</label>
                                    <textarea class="form-control" id="alamat" name="alamat" placeholder="Address..." rows="3" required></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="telp" class="form-label">Telp/HP Mahasiswa</label>
                                    <input type="text" class="form-control" id="telp" name="telp"
                                        fdprocessedid="pcamub" placeholder="No Telp Mahasiswa" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin </label>
                                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-select"
                                        fdprocessedid="hc4gssq" required>
                                        <option value="">Choose...</option>
                                        <option value="L">Laki - laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <input type="hidden" name="is_update" value="1">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5" fdprocessedid="y783o9">Perbaharui
                                        Info</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var dataMahasiswa = @json($info);

        var getSemester = (semester) => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                'content');

            fetch('{{ route('master.semester.index') }}?ajax=true', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok.');
                    }
                    return response.json();
                })
                .then(data => {
                    let options = '<option value="">Pilih Semester</option>';
                    data.data.forEach(item => {
                        options +=
                            `<option value="${item.id}" ${semester === item.id ? 'selected':''}>Semester ${item.semester}</option>`;
                    });

                    $('#semester').html(options)

                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        var getProdi = (prodi) => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                'content');

            fetch('{{ route('master.prodi.index') }}?ajax=true', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok.');
                    }
                    return response.json();
                })
                .then(data => {
                    let opsi = []
                    data.data.forEach(element => {
                        opsi.push({
                            id: element.id,
                            text: element.nama_prodi
                        })
                    });

                    $("#id_prodi").select2({
                        theme: "bootstrap-5",
                        data: opsi
                    });

                    $("#id_prodi").val(prodi).trigger('change');

                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        $('#nama').val(dataMahasiswa.nama)
        $('#nim').val(dataMahasiswa.nim)
        $('#email').val(dataMahasiswa.email)
        $('#kelas').val(dataMahasiswa.kelas)
        $('#alamat').val(dataMahasiswa.alamat)
        $('#telp').val(dataMahasiswa.jenis_kelamin)
        $('#jenis_kelamin').val(dataMahasiswa.jenis_kelamin)
        getProdi(dataMahasiswa.id_prodi)
        getSemester(dataMahasiswa.semester)

        $('form#form-update').submit(function(e) {
            e.preventDefault();
            e.stopPropagation()
            let formDataArray = new FormData(this)
            const url = '{{ route('master.mahasiswa.update', ['mahasiswa' => ':idData']) }}'.replace(
                ':idData',
                dataMahasiswa.id);
            const requestOptions = {
                method: 'POST',
                body: formDataArray // Ubah objek ke dalam format JSON sebelum mengirim
            };

            fetch(url, requestOptions)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok.');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data)
                    
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Data Berhasil Di Update",
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        window.location.reload()
                    })
                })
                .catch(error => {
                    console.error(error);
                });

        });
    </script>
@endsection
