@extends('layouts.app')
@section('style')
    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Data Mahasiswa</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item active" aria-current="page">Tabel Mahasiswa</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary btn-sm add"><i class="fa-solid fa-plus me-1"></i>Tambah Data
                        Mahasiswa</button>
                </div>
                <div class="card-body">
                    @if (in_array(session('role'), [1]))
                        <div class="form group mb-3">
                            <label for="prodi-f" class="col-form-label">Program Studi</label>
                            <select id="prodi-f" class="form-control w-25"></select>
                        </div>
                    @endif
                    <table class="table mb-0 table-striped" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Email</th>
                                <th>Nama Mahasiswa</th>
                                <th>Program Studi</th>
                                <th>Semester</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('mahasiswa.create')
    @include('mahasiswa.update')
@endsection

@section('script')
    <script>
        $(function() {
            var roles = '{{ session('role') }}'
            var prodi = '{{ App\helpers\infoUser()->id_prodi ?? 0 }}'
            getProdi('#prodi-f', prodi)
            if (prodi == 0) {
                $('#id_prodi,#e-id_prodi').attr('readonly', false)
            } else {
                $('#id_prodi,#e-id_prodi').attr('readonly', true)
            }
            var idData = null
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('master.mahasiswa.index') !!}',
                    type: "GET",
                    data: function(data) {
                        data.prodi = prodi == 0 ? $('#prodi-f').val() : prodi
                    },
                    dataSrc: "data",
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'nim',
                    },
                    {
                        data: 'email',
                    },
                    {
                        data: 'nama',
                    },
                    {
                        data: 'data_prodi',
                        render: function(data) {
                            return data.nama_prodi
                        }
                    },
                    {
                        data: 'semester',
                    },
                    {
                        data: 'account',
                        render: function(data) {
                            let btn = ''
                            if (roles == 1) {
                                if (!data) {
                                    btn += `<button type="button" class="btn btn-outline-secondary btn-sm px-2 me-1 active-user"
                                                fdprocessedid="2ybyt"><i
                                                    class="fas fa-solid fa-user-plus mr-1"></i> Aktifkan User</button>`
                                } else {
                                    btn +=
                                        `<button type="button" class="btn btn-outline-secondary btn-sm px-2 me-1 deactive-user"
                                                fdprocessedid="2ybyt"><i
                                                    class="fas fa-solid fa-user-minus mr-1"></i> Deactive User</button>`
                                }
                            }

                            return `<div class="d-flex flex-row">
                                            ${btn}
                                            <button type="button" class="btn btn-outline-warning btn-sm px-2 me-1 edit"
                                                fdprocessedid="2ybyt"><i
                                                    class="fa-solid fa-pen-to-square mr-1"></i>edit</button>
                                            <button type="button" class="btn btn-outline-danger btn-sm px-2 ms-1 hapus"
                                                fdprocessedid="2ybyt"><i class="fa-solid fa-trash mr-1"></i>Hapus</button>
                                        </div>`
                        }
                    }

                ]
            });

            $('#prodi-f').change(function(e) {
                table.ajax.reload()

            });

            $('.add').on('click', function() {
                $('#form-add')[0].reset()
                getProdi('#id_prodi', prodi)
                $('#add-form').modal('show')
            })

            table.on('click', '.edit', function() {
                let data = table.row($(this).parents('tr')).data()
                idData = data.id

                $('#e-nama').val(data.nama)
                $('#e-nim').val(data.nim)
                $('#e-email').val(data.email)
                getSemester(data.semester)
                getProdi('#e-id_prodi', data.data_prodi.id)
                $('#edit-form').modal('show')
            });

            table.on('click', '.active-user', function() {
                let data = table.row($(this).parents('tr')).data()
                idData = data.id
                let type = 'mhs'
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonColor: "#d33",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Yes, Create Account!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "{{ url('pengguna') }}/" + data.id + "/" + type,
                            dataType: "JSON",
                            success: function(response) {
                                console.log(response)
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Success",
                                    text: "Account Has Created, Use NIM for Password",
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    idData = null
                                    table.ajax.reload();
                                })
                            }
                        });
                    }
                });
            });

            table.on('click', '.deactive-user', function() {
                let data = table.row($(this).parents('tr')).data()
                idData = data.id
                let type = 'mhs'
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonColor: "#d33",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete Account!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "{{ url('pengguna') }}/" + data.id + "/" + type +
                                "/delete",
                            dataType: "JSON",
                            success: function(response) {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Success",
                                    text: "Account Has Deleted",
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    idData = null
                                    table.ajax.reload();
                                })
                            }
                        });
                    }
                });
            });

            $('form#form-add').submit(function(e) {
                e.preventDefault();
                e.stopPropagation()

                let formDataArray = new FormData(this)
                const url = '{{ route('master.mahasiswa.store') }}';
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
                        // console.log(response)
                    })
                    .then(data => {
                        $('#add-form').modal('hide')
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            table.ajax.reload()
                        })
                    })
                    .catch(error => {
                        console.error(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Tambah Data',
                            text: 'Email atau nim sudah terdaftar',
                            showConfirmButton: true,
                        })
                    });

            });
            $('form#form-edit').submit(function(e) {
                e.preventDefault();
                e.stopPropagation()
                let formDataArray = new FormData(this)
                const url = '{{ route('master.mahasiswa.update', ['mahasiswa' => ':idData']) }}'.replace(
                    ':idData',
                    idData);
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
                        $('#edit-form').modal('hide')
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Your work has been saved",
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            idData = null
                            table.ajax.reload();
                        })
                    })
                    .catch(error => {
                        console.error(error);
                    });

            });

            table.on('click', '.hapus', function() {
                let data = table.row($(this).parents('tr')).data()
                idData = data.id
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteData(idData)
                    }
                });
            });

            function deleteData(id) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content');

                const url = '{{ route('master.mahasiswa.destroy', ['mahasiswa' => ':id']) }}'.replace(':id',
                    idData);
                const requestOptions = {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken // sertakan token CSRF di sini
                    }
                };

                fetch(url, requestOptions)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Your work has been Delete",
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            idData = null
                            table.ajax.reload();
                        })
                    })
                    .catch(error => {
                        console.error('Error deleting data:', error);
                    });
            }

            function getProdi(element, idProdi = 0) {
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
                        let options = '<option value="">Pilih Program Study</option>';
                        data.data.forEach(item => {
                            options +=
                                `<option value="${item.id}" ${item.id == idProdi ? 'selected':''}>${item.jenjang_study}-${item.nama_prodi}</option>`;
                        });
                        $(element).html(options);

                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            }
            getSemester()

            function getSemester(datas = null) {
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

                        var container = $('.view-semester');
                        container.empty()
                        data.data.forEach(function(item, index) {
                            let selectd
                            if (datas != null && datas == item.id) {
                                selectd = 'checked'
                            }
                            var radioDiv = $('<div class="form-check form-check-inline"></div>');
                            var radioInput = $(
                                '<input class="form-check-input" type="radio" name="semester" id="inlineRadio' +
                                item.id + '" value="' + item.id + '" required ' + selectd + ' required>');
                            var radioLabel = $('<label class="form-check-label" for="inlineRadio' + item
                                .id + '">' + item.semester + '</label>');

                            radioDiv.append(radioInput);
                            radioDiv.append(radioLabel);
                            container.append(radioDiv);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            }
        });
    </script>
@endsection
