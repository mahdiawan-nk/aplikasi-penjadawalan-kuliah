@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
    @if (in_array(session('role'), [1, 2, 4]))
        <div class="page-wrapper">
        @else
            <div class="page-wrapper-full">
    @endif
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Data Request Ruangan Kelas</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Tabel Request Ruangan Kelas</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary btn-sm add" {{ session('role') == 4 ? '' : 'hidden' }}><i
                        class="fa-solid fa-plus me-1"></i>Request Pemakaian
                    Ruangan</button>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tgl Log</th>
                            <th>User Request</th>
                            <th>Ruangan</th>
                            <th>Hari</th>
                            <th>Jam Pemakaian</th>
                            <th>Status Request</th>
                            <th>Status Konfirmasi</th>
                            <th>Status Penggunaan</th>
                            <th>Aksi user</th>
                            <th>Aksi admin</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(function() {
            var idData = null
            var roles = {{ session('role') }}

            var table = $('#table').DataTable({
                responsive: true,
                processing: false,
                serverSide: true,
                ordering: false,
                ajax: {
                    url: '{!! route('trx.peminjaman.index') !!}',
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
                        data: 'log_date',
                        render: function(data) {
                            return `<div class="d-flex flex-column"><span>${data.date}</span> <span>${data.jam}</span></div>`
                        },
                    },
                    {
                        data: 'user_request'
                    },
                    {
                        data: 'kelas',
                        render: function(data) {
                            return `${data.nama_gedung} - ${data.nama_kelas}`
                        }
                    },
                    {
                        data: 'hari'
                    },
                    {
                        data: 'jam_pemakaian'
                    },
                    {
                        data: 'jenis_request',
                        render: function(data) {
                            return data == 0 ? 'Konfirmasi Pemakaian' : 'Request Peminjaman'
                        }
                    },
                    {
                        data: 'status_admin',
                        render: function(data) {
                            return data == 0 ? '<span class="badge bg-primary">Prosess</span>' : (
                                data == 1 ? '<span class="badge bg-success">Accepted</span>' :
                                '<span class="badge bg-danger">Rejected</span>')
                        }
                    },
                    {
                        data: 'status_penggunaan',
                        render: function(data) {
                            return data == 0 ? '<span class="badge bg-primary">Not Use</span>' : (
                                data == 1 ? '<span class="badge bg-success">In Use</span>' :
                                '<span class="badge bg-secondary">Selesai</span>')
                        }
                    },
                    {
                        data: 'status_penggunaan',
                        render: function(data) {
                            let btn;
                            if (data == 0) {
                                btn = `<button type="button" class="btn btn-outline-warning btn-sm px-2 me-1 edit"
                                                fdprocessedid="2ybyt"><i
                                                    class="fa-solid fa-pen-to-square mr-1"></i>edit</button>`
                            } else if (data == 1) {
                                btn = `<button type="button" class="btn btn-outline-secondary btn-sm selesai"
                                                fdprocessedid="2ybyt"><i
                                                    class="fa-solid fa-door-closed mr-1"></i>Selesai</button>`
                            } else {
                                btn = '';
                            }
                            return `<div class="d-flex flex-row">
                                            ${btn}
                                        </div>`
                        }
                    },
                    {
                        data: 'status_admin',
                        render: function(data) {
                            if (data != 1) {
                                return `<div class="d-flex flex-row">
                                            <button type="button" class="btn btn-outline-secondary btn-sm px-2 me-1 konfirmasi"
                                                fdprocessedid="2ybyt"><i
                                                    class="fa-solid fa-check mr-1"></i>Konfirmasi</button>
                                        </div>`
                            }

                            return ''

                        }
                    }

                ]
            });

            channel.bind('my-event', function(data) {
                console.log(data.message.userId)
                if (data.message.userId == idUser) {
                    table.ajax.reload()
                }
            });
            var deleteData = (id) => {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content');

                const url = '{{ route('master.prodi.destroy', ['prodi' => ':id']) }}'.replace(':id',
                    id);
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

            var konfirmasi = (id, status, penggunaan) => {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const url = '{{ route('trx.peminjaman.update', ['peminjaman' => ':id']) }}'.replace(':id', id);

                const formData = {
                    status_admin: status,
                    status_penggunaan: penggunaan,
                    '_token': csrfToken
                };
                $.ajax({
                    type: "PUT",
                    url: url,
                    data: formData,
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response)
                        table.ajax.reload()
                    },
                    error: function(a, b, c) {
                        console.log(a.responseText)
                    }
                });
            };

            $("#jam_mulai,#e-jam_mulai").flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                onChange: function(selectedDates, dateStr, instance) {
                    // Saat jam mulai berubah, atur opsi minDate untuk jam selesai
                    if (dateStr) {
                        var minTime = instance.parseDate(dateStr, "H:i");
                        $("#jam_selesai,#e-jam_selesai").flatpickr({
                            enableTime: true,
                            noCalendar: true,
                            dateFormat: "H:i",
                            time_24hr: true,
                            minDate: minTime
                        });
                    }
                }
            });

            $("#jam_selesai,#e-jam_selesai").flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true
            });



            table.column(9).visible(roles == 4 ? true : false);
            table.column(10).visible(roles == 1 ? true : false);
            table.column(2).visible(roles == 1 ? true : false);

            $('.add').on('click', function() {
                const url = '{{ route('trx.peminjaman.new') }}';
                window.location.href = url
            })

            table.on('click', '.konfirmasi', function() {
                let data = table.row($(this).parents('tr')).data()
                idData = data.id
                Swal.fire({
                    icon: "question",
                    title: "Do you want to save the changes?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Accepted",
                    denyButtonText: `Rejected`
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        konfirmasi(idData, 1, 1)
                    } else if (result.isDenied) {
                        konfirmasi(idData, 2, 0)
                    }
                });
            });

            table.on('click', '.selesai', function() {
                let data = table.row($(this).parents('tr')).data()
                idData = data.id
                Swal.fire({
                    icon: "question",
                    title: "Do you want to save the changes?",
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: "Selesai",
                    denyButtonText: `Rejected`
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        if (roles == 4) {
                            konfirmasi(idData, 1, 2)
                        } else {
                            konfirmasi(idData, 1, 1)
                        }

                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });
            });

            table.on('click', '.edit', function() {
                let data = table.row($(this).parents('tr')).data()
                // idData = data.id
                const url = '{{ route('trx.peminjaman.show', ['peminjaman' => ':idData']) }}'.replace(
                    ':idData',
                    data.uid);
                window.location.href = url


            });

            $('form#form-add').submit(function(e) {
                e.preventDefault();
                e.stopPropagation()

                let formDataArray = new FormData(this)
                const url = '{{ route('master.prodi.store') }}';
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
                const url = '{{ route('master.prodi.update', ['prodi' => ':idData']) }}'.replace(
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

            $('#status_request').change(function(e) {
                e.preventDefault();
                let vals = $(this).val()
                console.log()
                if (vals ==
                    0) { // jika 0 request konfirmasi input, select change attribut readonly and auto fill
                    $('#id_jadwal').attr('disabled', false)
                } else { // jika 1 request peminjaman input, select change attribut requierd not auto fill

                }

            });

            $('#id_jadwal').change(function(e) {
                e.preventDefault();
                let vals = $(this).val()
                getJadwalKuliahById(vals)

            });





        });
    </script>
@endsection
