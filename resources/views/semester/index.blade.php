@extends('layouts.app')
@section('style')
    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <style>
        /* Hides spinner arrows in Chrome, Safari, and Edge */
        input[type=number] {
            -moz-appearance: textfield;
            /* Firefox */
            -webkit-appearance: none;
            /* Chrome, Safari, Edge */
            appearance: none;
            /* Future-proofing */
        }

        /* Hides spinner arrows in Firefox */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Data Semester</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item active" aria-current="page">Tabel Semester</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card loader-pace">
                <div class="card-header" {{ in_array(session('role'), [1]) ? '' : 'hidden' }}>
                    <button class="btn btn-primary btn-sm add"><i class="fa-solid fa-plus me-1"></i>Tambah Data
                        Semester</button>
                    <button class="btn btn-secondary btn-sm setting-ta"><i class="fa-solid fa-gears me-1"></i>Setting Tahun
                        Akademik</button>
                </div>
                <div class="card-body">
                    <table class="table mb-0 table-striped" id="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Periode</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('semester.create')
    @include('semester.update')
    <div class="modal fade" id="setting-tahun-akademik" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Pengaturan Tahun Akademik</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="page-form-ta" style="display: none">
                    <form action="" id="form-ta">
                        @csrf
                        <div class="row mb-3">
                            <label for="kodeAkademik" class="col-sm-3 col-form-label">Kode T.A</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kodeAkademik" name="kode_akademik"
                                    placeholder="Enter Kode Tahun Akademik Ex: 2022-1 (1:ganjil, 2:genap)" required>
                                <div id="validationFeedback" class="invalid-feedback">
                                    Kode Tahun Akademik tidak valid. Harus mengikuti format yang diizinkan.
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tahunAkademik" class="col-sm-3 col-form-label">Tahun Akademik</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tahunAkademik" name="tahun_akademik"
                                    placeholder="Enter Tahun Akademik ex: 2023/2024" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                                    <button type="button" class="btn btn-light px-4" id="cancel-form-ta">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-body" id="page-table-ta">
                    <button class="btn btn-sm btn-primary mb-2 new-tahun-akademik">Tambah Tahun Akademik</button>
                    <table class="table mb-0" id="table-ta">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kode T.A</th>
                                <th scope="col">Tahun Akademik</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>
                                    <button type="button" class="btn btn-outline-dark btn-sm pe-0"
                                        fdprocessedid="eig92j"><i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-dark btn-sm pe-0" fdprocessedid="tcwyo"><i
                                            class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>
                                    <button type="button" class="btn btn-outline-dark btn-sm pe-0"
                                        fdprocessedid="eig92j"><i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-dark btn-sm pe-0"
                                        fdprocessedid="tcwyo"><i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('.pace-progress', function(e) {
            console.log('Progress value:', e.detail);
        });

        function setValidationPattern(year, validSuffixes) {
            // Membuat regex berdasarkan tahun dan suffix yang valid
            const regexPattern = `^(${year}-(${validSuffixes.join('|')})$)`;
            return new RegExp(regexPattern);
        }

        // Fungsi untuk mendapatkan tahun saat ini dan tahun yang valid
        function getValidYears() {
            const currentYear = new Date().getFullYear();
            const years = [];

            for (let i = -5; i <= 5; i++) {
                years.push(currentYear + i);
            }
            return years;
        }

        // Menentukan suffix yang valid
        const validSuffixes = ['1', '2']; // Misalnya, '1' untuk ganjil, '2' untuk genap

        // Mengambil tahun-tahun yang valid
        const validYears = getValidYears();

        // Mengatur pola validasi dinamis
        const input = document.getElementById('kodeAkademik');
        const feedback = document.getElementById('validationFeedback');

        // Mengatur pola regex dinamis dengan tahun yang valid
        const validPatterns = validYears.map(year => setValidationPattern(year, validSuffixes));

        // Menambahkan event listener untuk validasi
        input.addEventListener('input', function() {
            const value = this.value;
            const isValid = validPatterns.some(pattern => pattern.test(value));

            if (isValid) {
                this.classList.remove('is-invalid');
                feedback.style.display = 'none';
            } else {
                this.classList.add('is-invalid');
                feedback.style.display = 'block';
            }
        });

        document.getElementById('kodeAkademik').addEventListener('input', function() {
            const kodeAkademik = this.value;
            const tahunAkademikInput = document.getElementById('tahunAkademik');

            // Mengambil tahun dari kode akademik
            const match = kodeAkademik.match(/^(\d{4})-(\d)$/);

            if (match) {
                const year = match[1]; // Tahun (misal: 2023)
                const term = match[2]; // Term (misal: 1 atau 2)

                // Menghitung tahun berikutnya
                const nextYear = parseInt(year, 10) + 1;

                // Mengatur format tahun akademik berdasarkan term
                const tahunAkademik = `${year}/${nextYear}`;

                // Mengupdate input tahun akademik
                tahunAkademikInput.value = tahunAkademik;
            } else {
                // Jika format kode akademik tidak sesuai, kosongkan input tahun akademik
                tahunAkademikInput.value = '';
            }
        });

        $(function() {
            var idData = null

            let modeForm = 'add';
            const csrfTokens = document.querySelector('meta[name="csrf-token"]').getAttribute(
                'content');

            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('master.semester.index') !!}',
                    type: "GET",
                    data: {
                        tokens: csrfTokens
                    },
                    dataSrc: "data",
                    beforeSend: function() {
                        // openLoader()
                    },
                    complete: function() {
                        // closeLoader()
                    }
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: {
                            periode: 'periode',
                            tahunakademik: 'tahunakademik'
                        },
                        render(h) {
                            return h.periode + ' ' + h.tahunakademik.tahun_akademik
                        },
                    },
                    {
                        data: 'semester',
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


            $('#table-ta').css('width', '100%')
            var tableListTahunAkademik = $('#table-ta').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('master.tahunakademik.index') !!}',
                    type: "GET",
                    data: {
                        tokens: csrfTokens
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
                        data: 'kode_akademik',
                    },
                    {
                        data: 'tahun_akademik',
                    },
                    {
                        data: 'id',
                        render: function(data) {
                            return `<div class="d-flex flex-row">
                                            <button type="button" class="btn btn-outline-warning btn-sm px-2 me-1 edit"
                                                fdprocessedid="2ybyt"><i
                                                    class="fa-solid fa-pen-to-square mr-1"></i>edit</button>
                                        </div>`
                        }
                    }

                ]


            })

            const fetchstoreTa = (url, requestOptions) => {

                fetch(url, requestOptions)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.status == 'success') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Your work has been saved',
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                $('#page-table-ta').show()
                                $('#page-form-ta').hide()
                                tableListTahunAkademik.ajax.reload()
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.message,
                            })
                        }

                    })
                    .catch(error => {
                        console.error(error);
                    });
            }

            const fetchupdateTa = (url, requestOptions) => {

                console.log(requestOptions)
                fetch(url, requestOptions)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok.');
                        }
                        return response.json();
                    })
                    .then(data => {

                        if (data.status == 'success') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Your work has been saved',
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                $('#page-table-ta').show()
                                $('#page-form-ta').hide()
                                tableListTahunAkademik.ajax.reload()
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.message,
                            })
                        }

                    })
                    .catch(error => {
                        console.error(error);
                    });
            }

            const fetchOptionTa = (elemnt) => {
                let urlList = '{{ route('master.tahunakademik.index') }}';
                fetch(urlList)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        let listView = $('#' + elemnt);
                        listView.empty();

                        listView.append(
                            `<option value="">Pilih Tahun Akademik</option>`
                        )

                        data.data.forEach(element => {
                            listView.append(
                                `<option value="${element.id}">${element.kode_akademik}  (${element.tahun_akademik})</option>`
                            )
                        });

                    })
                    .catch(error => {
                        console.error(error);
                    });

            }
            $('#id_ta').change(function(e) {
                e.preventDefault();
                let id = $(this).val()

                const urlList = '{{ route('master.tahunakademik.show', ['tahunakademik' => ':idData']) }}'
                    .replace(':idData', id);
                fetch(urlList)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        $('#periode').val(data.data.jenis_periode)

                    })
                    .catch(error => {
                        console.error(error);
                    });
            });

            $('#e-id_ta').change(function(e) {
                e.preventDefault();
                let id = $(this).val()

                const urlList = '{{ route('master.tahunakademik.show', ['tahunakademik' => ':idData']) }}'
                    .replace(':idData', id);
                fetch(urlList)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        $('#e-periode').val(data.data.jenis_periode)

                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
            $('.new-tahun-akademik').click(function(e) {
                e.preventDefault();
                modeForm = 'add'
                $('#page-table-ta').hide()
                $('#page-form-ta').show()
            });

            $('.add').on('click', function() {
                fetchOptionTa('id_ta')
                $('#periode').val('')
                $('#semester').val('')
                $('#add-form').modal('show')
            })

            $('.setting-ta').on('click', function() {

                $('#setting-tahun-akademik').modal('show')
            })

            $('#cancel-form-ta').on('click', function() {
                $('#page-table-ta').show()
                $('#page-form-ta').hide()
            })

            table.on('click', '.edit', function() {
                let data = table.row($(this).parents('tr')).data()
                idData = data.id
                fetchOptionTa('e-id_ta')
                setTimeout(() => {
                    $('#e-id_ta').val(data.tahunakademik.id)
                    $('#e-periode').val(data.periode)
                    $('#e-semester').val(data.semester)
                }, 1000);

                $('#edit-form').modal('show')
            });

            tableListTahunAkademik.on('click', '.edit', function() {
                let data = tableListTahunAkademik.row($(this).parents('tr')).data()
                idData = data.id
                modeForm = 'edit'
                $('#page-table-ta').hide()
                $('#page-form-ta').show()
                $('[name="kode_akademik"]').val(data.kode_akademik)
                $('[name="tahun_akademik"]').val(data.tahun_akademik)

            });

            $('#form-ta').submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Log FormData contents
                formData.forEach((value, key) => {
                    console.log(key, value);
                });

                let url;
                let requestOptions;

                if (modeForm == 'add') {
                    url = '{{ route('master.tahunakademik.store') }}';
                    requestOptions = {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // sertakan token CSRF di sini
                        }
                    };
                    fetchstoreTa(url, requestOptions);
                } else {
                    url = '{{ route('master.tahunakademik.update', ['tahunakademik' => ':idData']) }}'
                        .replace(':idData', idData);
                    const formUpdate = new FormData();
                    formUpdate.append('_token', csrfToken);
                    formUpdate.append('_method', 'PUT');
                    formUpdate.append('kode_akademik', $('[name="kode_akademik"]').val());
                    formUpdate.append('tahun_akademik', $('[name="tahun_akademik"]').val());

                    const requestOptions = {
                        method: 'POST',
                        body: formUpdate
                    };
                    fetchupdateTa(url, requestOptions);
                }
            });


            $('form#form-add').submit(function(e) {
                e.preventDefault();
                e.stopPropagation()

                let formDataArray = new FormData(this)
                const url = '{{ route('master.semester.store') }}';
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
                const url = '{{ route('master.semester.update', ['semester' => ':idData']) }}'.replace(
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

                const url = '{{ route('master.semester.destroy', ['semester' => ':id']) }}'.replace(':id',
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
