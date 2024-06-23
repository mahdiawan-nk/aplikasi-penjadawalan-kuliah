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
    @if (in_array(session('role'), [1, 2, 4, 3]))
        <div class="page-wrapper">
        @else
            <div class="page-wrapper-full">
    @endif


    <div class="page-content">
        @if (in_array(session('role'), [1, 2]))
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Ruang Kelas</p>
                                    <h4 class="my-1 text-info kelas"></h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                                    <i class="fas fa-regular fa-building"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Matakuliah</p>
                                    <h4 class="my-1 text-danger matkul"></h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto">
                                    <i class="fas fa-regular fa-list"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Dosen</p>
                                    <h4 class="my-1 text-success dosen"></h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                    <i class="fas fa-regular fa-users"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-warning">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Program Study</p>
                                    <h4 class="my-1 text-warning prodi"></h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
                                    <i class="fas fa-regular fa-graduation-cap"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->
        @endif


        <div class="row">
            <div class="col-12 col-lg-6 col-xl-6 d-flex">
                <div class="card w-100 radius-10">
                    <div class="card-header d-flex justify-content-between flex-column">
                        <label for="" class="fs-5 fw-bold">Daftar Kelas Kosong/Tidak digunakan</label>
                        <div class="d-flex flex-row">
                            <input type="search" class="form-control" placeholder="Cari Berdasarkan Nama Ruangan"
                                style="width: 78% !important" id="keyword">
                            <button class="btn btn-sm btn-info ms-2 search" onclick="DataKelas()"><i
                                    class='bx bx-search-alt-2'></i> Cari</button>
                            <button class="btn btn-sm btn-secondary ms-2 search" onclick="clearFilter()">Clear
                                Filter</button>
                        </div>

                    </div>
                    <div class="card-body view-kelas-kosong" style="height: 50vh;overflow-y:scroll">

                    </div>

                </div>

            </div>
            <div class="col-12 col-lg-6 col-xl-6 d-flex">
                <div class="card w-100 radius-10">
                    <h5 class="card-header"><label for="">Daftar Kelas digunakan</label></h5>
                    <div class="card-body view-kelas-terisi" style="height: 50vh;overflow-y:scroll">

                    </div>

                </div>

            </div>
        </div>

        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Jadwal Kuliah</h6>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0" id="table">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Matakuliah</th>
                                <th>Periode</th>
                                <th>Semester</th>
                                <th>Prodi</th>
                                <th>Kelas</th>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>SKS</th>
                                <th>Gedung Ruang</th>
                                <th>Ruang</th>
                                <th>Dosen</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
    </div>
@endsection

@section('script')
    <script>
        channel.bind('my-event', function(data) {
            console.log(data.message.userId)
            if (data.message.userId == idUser) {
                DataKelas()
            }
        });
        $(function() {
            var table = $('#table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: {
                    url: '{!! route('trx.penjadwalan.index') !!}',
                    type: "GET",
                    data: function(data) {
                        data.prodi = $('#prodi-f').val()
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
                        data: 'nama_matkul',

                    },
                    {
                        data: 'periode'
                    },
                    {
                        data: 'semester'
                    },
                    {
                        data: 'data_prodi',
                        render: function(data) {
                            let list = ''
                            data.forEach(element => {
                                list += `<li>${element.nama_prodi}</li>`
                            });
                            return list
                        }
                    },
                    {
                        data: 'rombel'
                    },
                    {
                        data: 'hari'
                    },
                    {
                        data: 'jam'
                    },
                    {
                        data: 'sks'
                    },
                    {
                        data: 'data_gedung'
                    },
                    {
                        data: 'nama_kelas'
                    },
                    {
                        data: 'nama_dosen'
                    },
                ],
                order: [
                    [9, 'asc']
                ],
                columnDefs: [{
                        visible: false,
                        targets: 6
                    }, {
                        visible: true,
                        targets: 9
                    },
                    {
                        visible: false,
                        targets: 10
                    }
                ],
                rowGroup: {
                    dataSrc: ['hari']
                }
            });

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                'content');

            fetch('{{ route('statistik.card') }}', {
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
                    $('.kelas').text(data.data.kelas)
                    $('.matkul').text(data.data.matakuliah)
                    $('.dosen').text(data.data.dosen)
                    $('.prodi').text(data.data.prodi)



                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });



            $('.view-kelas-kosong').on('click', '.request', function() {
                let ids = $(this).data('id')
                Swal.fire({
                    icon: "question",
                    title: "Request?",
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: "Konfirmasi Pemakaian",
                    denyButtonText: `Peminjaman Ruangan`
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href =
                            '{{ route('trx.peminjaman.create', ['peminjaman' => ':idData']) }}'
                            .replace(':idData', ids);
                        console.log(ids)
                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });
            });
            DataKelas()


        });

        function DataKelas() {

            let keyword = document.getElementById('keyword').value;

            // Buat URL dengan query parameter keyword
            let url = new URL('{{ route('kelas-kosong') }}');
            if (keyword) {
                url.searchParams.append('keyword', keyword);
            }
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                'content');
            fetch(url, {
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
                    let kelasKosong = '';
                    data.kelas_kosong.forEach(item => {
                        kelasKosong += `<div class="card radius-10 border shadow-none"  >
                                <div class="card-body ">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h4 class="my-1">${item.nama_gedung}</h4>
                                            <p class="mb-0 text-secondary">${item.nama_kelas}</p>
                                            <p class="mb-0 font-13">${item.kapasitas} MHS</p>
                                        </div>
                                        <div class="widgets-icons-2 bg-gradient-cosmic text-white ms-auto request" style="cursor:pointer" data-id="${item.uid}">
                                            <i class="fa-solid fa-building"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>`
                    });
                    $('.view-kelas-kosong').html(kelasKosong)

                    let kelasIsi = '';
                    data.kelas_terisi.forEach(items => {
                        let dates = '';
                        items.jadwal_kelas.forEach((jadwal, index) => {
                            dates +=
                                `<label>${jadwal.jam_mulai} - ${jadwal.jam_selesai}</label>`
                            if (index < items.jadwal_kelas.length - 1) {
                                dates += ', ';
                            }
                        });
                        kelasIsi += `<div class="card radius-10 border shadow-none" >
                                <div class="card-body ">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h4 class="my-1">${items.nama_gedung}</h4>
                                            <p class="mb-0 text-secondary">${items.nama_kelas}</p>
                                            <p class="mb-0 font-13">${items.kapasitas} MHS</p>
                                            <p class="mb-0 font-13">Jam ${dates}</p>
                                        </div>
                                        <div class="widgets-icons-2 bg-gradient-ibiza text-white ms-auto">
                                            <i class="fa-solid fa-building"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>`
                    });
                    $('.view-kelas-terisi').html(kelasIsi)


                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        function clearFilter() {
            // Kosongkan input field keyword
            document.getElementById('keyword').value = '';
            // Panggil fungsi DataKelas untuk memuat ulang data tanpa filter
            DataKelas();
        }
    </script>
@endsection
