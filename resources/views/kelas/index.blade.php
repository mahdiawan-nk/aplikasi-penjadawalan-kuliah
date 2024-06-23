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
                            <li class="breadcrumb-item active" aria-current="page">Tabel Kelas</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary btn-sm add"><i class="fa-solid fa-plus me-1"></i>Tambah Data
                        Kelas</button>
                </div>
                <div class="card-body">
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
