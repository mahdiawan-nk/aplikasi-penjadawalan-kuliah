@extends('layouts.app')
@section('style')
    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Data Kelas</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item active" aria-current="page">Data Kelas</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-primary" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab"
                                aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bx-home font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">Ruang Kelas</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation" hidden>
                            <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab"
                                aria-selected="false" tabindex="-1">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bx-user-pin font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">Kelas Mahasiswa</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content py-3">
                        <div class="tab-pane fade active show" id="primaryhome" role="tabpanel">
                            <button class="btn btn-primary btn-sm add"><i class="fa-solid fa-plus me-1"></i>Tambah Data
                                Kelas</button>
                            <table class="table mb-0 table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Gedung</th>
                                        <th scope="col">Nama Kelas/Ruangan</th>
                                        <th scope="col">Kapasitas</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Filtering Data</h5>
                                            <div class="form-group mb-3">
                                                <label for="prodi-f" class="col-form-label">Program Studi</label>
                                                <select id="prodi-f" class="form-control"></select>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-secondary btn-sm"><i class='bx bx-search-alt-2 pt-0'></i>
                                                Filter</button>
                                            <button class="btn btn-warning btn-sm"><i class='bx bx-reset'></i>
                                                Reset</button>
                                        </div>
                                    </div>
                                </div>
                                <dvi class="col-sm-10">
                                    <div class="d-flex flex-row w-100 justify-content-between">
                                        <div class="justify-content-start">
                                            <button class="btn btn-primary btn-sm add-class"><i class='bx bxs-add-to-queue' ></i> New Class</button>
                                        </div>
                                        <div class="justify-content-end">
                                            <nav aria-label="...">
                                                <ul class="pagination justify-content-end">
                                                    <li class="page-item disabled"><a class="page-link" href="javascript:;"
                                                            tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="javascript:;">1</a>
                                                    </li>
                                                    <li class="page-item active" aria-current="page"><a class="page-link"
                                                            href="javascript:;">2 <span
                                                                class="visually-hidden">(current)</span></a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="javascript:;">3</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="javascript:;">Next</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>

                                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-6 row-cols-xl-6">
                                        @foreach (range(1, 20) as $item)
                                            <div class="col">
                                                <div class="card border-primary border-bottom border-3 border-0">
                                                    <img src="{{ asset('static-file/classroom.png') }}"
                                                        class="card-img-top w-50 d-block mx-auto" alt="...">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-primary text-center">Card title</h5>
                                                        <ul class="list-group">
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                                Jumlah MHS<span
                                                                    class="badge bg-primary rounded-pill">14</span>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                                Program Studi<span
                                                                    class="badge bg-primary rounded-pill">2</span>
                                                            </li>
                                                        </ul>
                                                        <hr>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <a href="javascript:;" class="btn btn-inverse-primary btn-sm"
                                                                style="font-size: 12px"><i class='bx bx-edit-alt'></i>Edit
                                                                Class</a>
                                                            <a href="javascript:;" class="btn btn-danger btn-sm"
                                                                style="font-size: 12px"><i class='bx bxs-trash'></i>Delete
                                                                Class</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </dvi>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>

    @include('kelas.create')
    @include('kelas.update')
@endsection

@section('script')
    <script>
        $(function() {
            var idData = null
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('master.kelas.index') !!}',
                    type: "GET",
                    dataSrc: "data",
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'nama_gedung',
                    },
                    {
                        data: 'nama_kelas',
                    },
                    {
                        data: 'kapasitas',
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

            $('.add').on('click', function() {
                $('#nama_gedung').val('')
                $('#nama_kelas').val('')
                $('#kapasitas').val('')
                $('#add-form').modal('show')
            })

            table.on('click', '.edit', function() {
                let data = table.row($(this).parents('tr')).data()
                idData = data.id

                $('#e-nama_kelas').val(data.nama_kelas)
                $('#e-nama_gedung').val(data.nama_gedung)
                $('#e-kapasitas').val(data.kapasitas)
                $('#edit-form').modal('show')
            });

            $('form#form-add').submit(function(e) {
                e.preventDefault();
                e.stopPropagation()

                let formDataArray = new FormData(this)
                const url = '{{ route('master.kelas.store') }}';
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
                const url = '{{ route('master.kelas.update', ['kela' => ':idData']) }}'.replace(
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
                            table.ajax.reload(null, false);
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

                const url = '{{ route('master.kelas.destroy', ['kela' => ':id']) }}'.replace(':id',
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
                            table.ajax.reload(null, false);
                        })
                    })
                    .catch(error => {
                        console.error('Error deleting data:', error);
                    });
            }
        });
    </script>
@endsection
