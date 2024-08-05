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
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab"
                                aria-selected="false" tabindex="-1" onclick="getProdi()">
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
                                <div class="col-sm-2" id="filtering">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Filtering Data</h5>
                                            <div class="form-group mb-3">
                                                <label for="prodi-f" class="col-form-label">Program Studi</label>
                                                <select id="prodi-f" class="form-control"></select>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-secondary btn-sm" id="filter"><i
                                                    class='bx bx-search-alt-2 pt-0'></i>
                                                Filter</button>
                                            <button class="btn btn-warning btn-sm" id="reset"><i
                                                    class='bx bx-reset'></i>
                                                Reset</button>
                                        </div>
                                    </div>
                                </div>
                                <dvi class="col-sm-10" id="list-kelas">
                                    <div class="d-flex flex-row w-100 justify-content-between">
                                        <div class="justify-content-start">
                                            <button class="btn btn-primary btn-sm add-class"><i
                                                    class='bx bxs-add-to-queue'></i> New Class</button>
                                        </div>
                                        <div class="justify-content-end">
                                            <nav aria-label="...">
                                                <ul class="pagination justify-content-end">
                                                    <li class="page-item" id="prev"><a class="page-link"
                                                            href="javascript:;" tabindex="-1"
                                                            aria-disabled="true">Previous</a>
                                                    </li>

                                                    <li class="page-item" id="next"><a class="page-link"
                                                            href="javascript:;">Next</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>

                                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4"
                                        id="list-kelas-mahasiswa">

                                    </div>
                                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-1 row-cols-xl-1"
                                        style="display: none" id="alert-info">
                                        <div
                                            class="alert border-0 border-start border-5 border-info alert-dismissible fade show py-2">
                                            <div class="d-flex align-items-center">
                                                <div class="font-35 text-info"><i class="bx bx-info-square"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h6 class="mb-0 text-info"Oooops</h6>
                                                        <div>Data Kelas Tidak Ditemukan</div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close" fdprocessedid="v95uju"></button>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-12">
                                            <label for="">Showing</label>
                                            <label for="" id="showing"></label>
                                        </div>
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
    <div class="modal fade" id="new-class-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" id="form-kelas-mahasiswa">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Form Kelas Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="id_program_study" class="col-sm-3 col-form-label">Program Studi</label>
                        <div class="col-sm-9">
                            <select name="id_program_study" id="id_program_study" class="form-control">
                                <option value="">Pilih Program Study</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama_kelas" class="col-sm-3 col-form-label">Nama Kelas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas_mahasiswa"
                                placeholder="Enter Nama Kelas" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jumlah_mahasiswa" class="col-sm-3 col-form-label">Jumlah Mahasiswa</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="jumlah_mahasiswa" name="jumlah_mahasiswa"
                                placeholder="Enter Jumlah Mahasiswa" required>
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
@endsection

@section('script')
    <script>
        var prodi = '{{ App\helpers\infoUser()->id_prodi ?? 0 }}'
        if (prodi == 0) {
            $('#id_program_study').attr('readonly', false)
        } else {
            $('#filtering').hide()

            $('#list-kelas').removeClass('col-sm-10').addClass('col-sm-12')
            $('#id_program_study').attr('readonly', true)
        }
        var modeForm = 'add';
        const csrfTokens = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let currentPage = 1
        let lastPage = 1;
        const fetchListKelasMahasiswa = (page, prodi) => {
            $.ajax({
                url: '{!! route('master.kelasmahasiswa.index') !!}',
                type: "GET",
                data: {
                    'prodi': prodi,
                    'page': page,
                    'paginate':true
                },
                // async: false,
                dataType: "JSON",
                success: function(response) {
                    renderListKelasMahasiswa(response.data)
                    updatePaginationInfo(response)
                    renderPaginationControls()

                }
            })
        }
        const updatePaginationInfo = (data) => {
            currentPage = data.current_page;
            lastPage = data.last_page;
            $('#showing').html(`<b>${data.from}</b> to <b>${data.to}</b> of <b>${data.total}</b> entries`);
        };

        const renderPaginationControls = () => {
            if (currentPage === 1) {
                $('#prev').addClass('disabled');
            } else {
                $('#prev').removeClass('disabled');
            }
            if (currentPage === lastPage) {
                $('#next').addClass('disabled');
            } else {
                $('#next').removeClass('disabled');
            }
        };

        const renderListKelasMahasiswa = (data) => {
            $('#list-kelas-mahasiswa').html('')
            console.log(data.length)
            if (data.length == 0) {
                $('#alert-info').show()
                return
            }

            $('#alert-info').hide()
            data.forEach((item) => {
                $('#list-kelas-mahasiswa').append(`
                    <div class="col">
                                                <div class="card border-primary border-bottom border-3 border-0">
                                                    <img src="{{ asset('static-file/classroom.png') }}"
                                                        class="card-img-top w-50 d-block mx-auto" alt="...">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-primary text-center">${item.nama_kelas}</h5>
                                                        <ul class="list-group">
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                                Jumlah MHS<span
                                                                    class="badge bg-primary rounded-pill">${item.jumlah_mahasiswa}</span>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                                Program Studi<span class="badge bg-primary rounded-pill">${item.programstudi.alias}</span>
                                                            </li>
                                                        </ul>
                                                        <hr>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <a href="javascript:;" class="btn btn-inverse-primary btn-sm edit-kelas" data-id="${item.id}"
                                                                style="font-size: 12px"><i class='bx bx-edit-alt'></i>Edit
                                                                Class</a>
                                                            <a href="javascript:;" class="btn btn-danger btn-sm delete-kelas" data-id="${item.id}"
                                                                style="font-size: 12px"><i class='bx bxs-trash'></i>Delete
                                                                Class</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                `)
            })

        }

        fetchListKelasMahasiswa(currentPage, prodi)
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

            $('#list-kelas-mahasiswa').on('click', '.edit-kelas', function(e) {
                e.preventDefault();
                let id = $(this).data('id')
                idData = id
                modeForm = 'edit'
                $.ajax({
                    type: "GET",
                    url: "{{ url('kelasmahasiswa') }}" + "/" + id,
                    dataType: "JSON",
                    success: function(response) {
                        setTimeout(() => {
                            $('[name="id_program_study"]').val(response.data
                                .id_program_study)
                            $('[name="nama_kelas_mahasiswa"]').val(response.data
                                .nama_kelas)
                            $('[name="jumlah_mahasiswa"]').val(response.data
                                .jumlah_mahasiswa)
                        }, 1000);

                    }
                });
                $('.add-class').trigger('click');
            });

            $('#list-kelas-mahasiswa').on('click', '.delete-kelas', function(e) {
                e.preventDefault();
                let id = $(this).data('id')
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
                        const url =
                            '{{ route('master.kelasmahasiswa.destroy', ['kelasmahasiswa' => ':id']) }}'
                            .replace(':id',
                                id);
                        const requestOptions = {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfTokens // sertakan token CSRF di sini
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
                                    fetchListKelasMahasiswa()
                                })
                            })
                            .catch(error => {
                                console.error('Error deleting data:', error);
                            });
                    }
                });

            });

            $('#prev > a').on('click', function(e) {
                e.preventDefault();
                if (currentPage > 1) {
                    fetchListKelasMahasiswa(currentPage - 1, prodi)
                }
            });
            $('#next > a').on('click', function(e) {
                e.preventDefault();
                if (currentPage < lastPage) {
                    fetchListKelasMahasiswa(currentPage + 1, prodi)
                }
            });

            $('#filter').click(function(e) {
                e.preventDefault();
                let valFilter = $('#prodi-f').val()
                fetchListKelasMahasiswa(currentPage, valFilter)
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
            $('form#form-kelas-mahasiswa').submit(function(e) {
                e.preventDefault();
                e.stopPropagation()
                console.log(modeForm);
                let formData = new FormData(this);
                let url;
                let requestOptions;

                if (modeForm == 'add') {
                    url = '{{ route('master.kelasmahasiswa.store') }}';
                    const formStore = new FormData();
                    formStore.append('_token', csrfTokens);
                    formStore.append('id_program_study', $('[name="id_program_study"]').val());
                    formStore.append('nama_kelas', $('[name="nama_kelas_mahasiswa"]').val());
                    formStore.append('jumlah_mahasiswa', $('[name="jumlah_mahasiswa"]').val());
                    requestOptions = {
                        method: 'POST',
                        body: formStore,
                    };
                } else {
                    url = '{{ route('master.kelasmahasiswa.update', ['kelasmahasiswa' => ':idData']) }}'
                        .replace(':idData', idData);
                    const formUpdate = new FormData();
                    formUpdate.append('_token', csrfTokens);
                    formUpdate.append('_method', 'PUT');
                    formUpdate.append('id_program_study', $('[name="id_program_study"]').val());
                    formUpdate.append('nama_kelas', $('[name="nama_kelas_mahasiswa"]').val());
                    formUpdate.append('jumlah_mahasiswa', $('[name="jumlah_mahasiswa"]').val());

                    requestOptions = {
                        method: 'POST',
                        body: formUpdate
                    };
                }

                fetch(url, requestOptions)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        $('#new-class-modal').modal('hide')
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            fetchListKelasMahasiswa()
                            modeForm = 'add'
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

            $('.add-class').click(function(e) {
                e.preventDefault();
                modeForm = 'add'
                getProdi('#id_program_study', prodi)
                $('[name="nama_kelas_mahasiswa"]').val('')
                $('[name="jumlah_mahasiswa"]').val('')
                $('#new-class-modal').modal('show')
            });


        });

        function getProdi(element = '#prodi-f', idProdi = 0) {
            fetch('{{ route('master.prodi.index') }}?ajax=true', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfTokens
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
    </script>
@endsection
