@extends('layouts.app')
@section('style')
    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Data Matakuliah</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item active" aria-current="page">Tabel Matakuliah</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary btn-sm add"><i class="fa-solid fa-plus me-1"></i>Tambah Data
                        Matakuliah</button>
                </div>
                <div class="card-body">
                    @if (in_array(session('role'), [1]))
                        <div class="form group mb-3">
                            <label for="prodi-f" class="col-form-label">Program Studi</label>
                            <select id="prodi-f" class="form-control w-25"></select>
                        </div>
                    @endif

                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Program Studi</th>
                                <th>Nama Mata Kuliah</th>
                                <th>Semester</th>
                                <th>Jenis</th>
                                <th>SKS</th>
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

    @include('matkul.create')
    @include('matkul.update')
@endsection

@section('script')
    <script>
        $(function() {
            var prodi = '{{ App\helpers\infoUser()->id_prodi ?? 0 }}'
            console.log(prodi)
            if(prodi==0){
                $('#id_prodi,#e-id_prodi').attr('readonly',false)
            }else{
                $('#id_prodi,#e-id_prodi').attr('readonly',true)
            }
            getProdi()
            getSemester()
            var idData = null
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                destroy: true,
                ajax: {
                    url: '{!! route('master.matakuliah.index') !!}',
                    type: "GET",
                    data: function(data) {
                        data.prodi = prodi == 0 ? $('#prodi-f').val():prodi
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
                        data: 'data_prodi',
                        render: function(data) {
                            return data.nama_prodi
                        }
                    },
                    {
                        data: 'nama_matkul'
                    },
                    {
                        data: 'data_semester',
                        render: function(data) {
                            return data.semester
                        }
                    },
                    {
                        data: 'type_matkul',
                        render: function(data) {
                            return data == 'P' ? "Praktek" : 'Teori'
                        }
                    },
                    {
                        data: 'sks'
                    },
                    {
                        data: 'id',
                        render: function(data) {
                            return `<div class="d-flex flex-row">
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
                $('#id_prodi').val('')
                $('#nama_matkul').val('')
                $('#id_semester').val('')
                $('#sks').val('')
                getProdi('#id_prodi')
                $('#add-form').modal('show')
            })

            table.on('click', '.edit', function() {
                let data = table.row($(this).parents('tr')).data()
                idData = data.id

                $('#e-kode_matkul').val(data.kode_matkul);
                $('#e-nama_matkul').val(data.nama_matkul);
                $('#e-id_semester').val(data.data_semester.id).trigger('change');
                $('#e-praktek').prop('checked', data.type_matkul == 'P');
                $('#e-teori').prop('checked', data.type_matkul != 'P');
                $('#e-sks').val(data.sks);
                $('#edit-form').modal('show')
                getProdi('#e-id_prodi',data.data_prodi.id)
            });

            $('form#form-add').submit(function(e) {
                e.preventDefault();
                e.stopPropagation()

                let formDataArray = new FormData(this)
                const url = '{{ route('master.matakuliah.store') }}';
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
                    });

            });
            $('form#form-edit').submit(function(e) {
                e.preventDefault();
                e.stopPropagation()
                let formDataArray = new FormData(this)
                const url = '{{ route('master.matakuliah.update', ['matakuliah' => ':idData']) }}'.replace(
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

                const url = '{{ route('master.matakuliah.destroy', ['matakuliah' => ':id']) }}'.replace(':id',
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


            function getProdi(element = '#prodi-f',idProdi=0) {
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
                                `<option value="${item.id}" ${item.id == idProdi || item.id == prodi ? 'selected':''}>${item.jenjang_study}-${item.nama_prodi}</option>`;
                        });
                        $(element).html(options);

                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            }

            function getSemester() {
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
                                `<option value="${item.id}">${item.semester}</option>`;
                        });
                        $('#id_semester').html(options);
                        $('#e-id_semester').html(options);

                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            }

        });
    </script>
@endsection
