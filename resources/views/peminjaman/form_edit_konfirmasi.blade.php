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
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="card border-top border-0 border-4 border-primary">
                    <form class="card-body" id="form-add" method="post" action="{{ route('trx.peminjaman.store') }}">
                        @csrf
                        @method('PUT')
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-info">Form Request Peminjaman dan Konfirmasi Pemakaian Kelas</h5>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Jadwal Kuliah</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="id_jadwal" name="id_jadwal"
                                    data-placeholder="Pilih Matakuliah" required disabled>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama_matkul" class="col-sm-3 col-form-label">Hari Jam</label>
                            <div class="col-sm-3">
                                <select name="hari" id="hari" class="form-control" required disabled>
                                    <option value="">Pilih Hari</option>
                                    <?php $hariIndo = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']; ?>
                                    @foreach ($hariIndo as $hari)
                                        <option value="{{ $hari }}">{{ $hari }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="jam_mulai" name="jam_mulai"
                                    placeholder="Jam Mulai" required disabled>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="jam_selesai" name="jam_selesai"
                                    placeholder="Jam Selesai" required disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Mata Kuliah</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="id_matkul" name="id_matkul"
                                    data-placeholder="Pilih Matakuliah" required disabled>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Rombel Kelas</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="rombel" name="rombel"
                                    placeholder="Enter Romebel Kelas" required disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama_matkul" class="col-sm-3 col-form-label">Gedung Ruang Kelas</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="id_kelas" name="id_kelas"
                                    data-placeholder="Pilih Ruang Kelas" required disabled>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama_matkul" class="col-sm-3 col-form-label">Dosen Pengajar</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="id_dosen" name="id_dosen" data-placeholder="Pilih Dosen"
                                    required disabled>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama_matkul" class="col-sm-3 col-form-label">Keterangan Penggunaan</label>
                            <div class="col-sm-9">
                                <textarea name="keterangan" id="keterangan" rows="5" class="form-control" disabled required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <input type="hidden" name="jenis_request" value="{{ $status }}">
                                <input type="hidden" name="status_admin" value="0">
                                <input type="hidden" name="status_penggunaan" value="0">
                                <button type="submit" class="btn btn-info px-5" fdprocessedid="mhgvk"
                                    id="btn-submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(function() {
            var jenisRequest = {{ $status }}
            var dataKelas = @json($data);
            console.log(dataKelas)
            $("#jam_mulai").flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                onChange: function(selectedDates, dateStr, instance) {
                    // Saat jam mulai berubah, atur opsi minDate untuk jam selesai
                    if (dateStr) {
                        var minTime = instance.parseDate(dateStr, "H:i");
                        $("#jam_selesai").flatpickr({
                            enableTime: true,
                            noCalendar: true,
                            dateFormat: "H:i",
                            time_24hr: true,
                            minDate: minTime
                        });
                    }
                }
            });

            $("#jam_selesai").flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true
            });



            $('form#form-add').submit(function(e) {
                e.preventDefault();
                e.stopPropagation()
                let btn = $('#btn-submit')
                btn.text('Prosess...').attr('disabled', true)
                let formDataArray = $(this).serialize()
                const url = '{{ route('trx.peminjaman.update',['peminjaman'=>$data->id]) }}';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formDataArray,
                    dataType: "JSON",
                    success: function(response) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            window.location.href = '{{ route('trx.peminjaman.index') }}'
                        })
                    },
                    complete: function() {
                        btn.text('Submit').attr('disabled', false)
                    }
                });

            });

            var getJadwalKuliah=(jadwal)=> {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content');
                $.ajax({
                    type: "GET",
                    url: "{{ route('trx.penjadwalan.index') }}",
                    data: {
                        ajax: 'true'
                    },
                    dataType: "JSON",
                    success: function(data) {
                        let opsi = []
                        data.data.forEach(element => {
                            opsi.push({
                                id: element.id,
                                text: element.nama_matkul
                            })
                        });

                        $("#id_jadwal").select2({
                            theme: "bootstrap-5",
                            data: opsi
                        });

                        $('#id_jadwal').val(jadwal).trigger('change')
                    }
                });

            }
            var getMatkul = (matkul = null) => {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content');
                $.ajax({
                    type: "GET",
                    url: "{{ route('master.matakuliah.index') }}",
                    data: {
                        ajax: 'true'
                    },
                    dataType: "JSON",
                    success: function(data) {
                        let opsi = []
                        data.data.forEach(element => {
                            opsi.push({
                                id: element.id,
                                text: element.nama_matkul
                            })
                        });

                        $("#id_matkul").select2({
                            theme: "bootstrap-5",
                            data: opsi
                        });

                        if (matkul != null) {
                            $('#id_matkul').val(matkul).trigger('change')
                        }
                    }
                });

            }

            var getKelas = (kelas) => {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content');
                const url = '{{ route('master.kelas.getgrouped', ['group' => ':idData']) }}'.replace(
                    ':idData', 'all');
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "JSON",
                    success: function(data) {
                        $("#id_kelas").select2({
                            theme: "bootstrap-5",
                            data: data,
                            templateResult: formatData,
                            templateSelection: formatData
                        });
                        if (kelas != null) {
                            $('#id_kelas').val(kelas).trigger('change')
                        }
                    }
                });
            }

            let getDosen = (dosen) => {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content');

                $.ajax({
                    type: "GET",
                    url: "{{ route('master.dosen.index') }}",
                    data: {
                        ajax: 'true'
                    },
                    dataType: "JSON",
                    success: function(data) {
                        let opsi = []
                        data.data.forEach(element => {
                            opsi.push({
                                id: element.id,
                                text: element.nama_dosen
                            })
                        });

                        $("#id_dosen").select2({
                            theme: "bootstrap-5",
                            data: opsi
                        });

                        if (dosen != null) {
                            $('#id_dosen').val(dosen).trigger('change')
                        }
                    }
                });
            }

            if (jenisRequest == 0) {
                $('#konfirmasi').prop('checked', true)
                $('#id_jadwal').attr('disabled', false)
                $('#keterangan').val(dataKelas.keterangan)
                getJadwalKuliah(dataKelas.id_jadwal)
                getKelas(dataKelas.id_kelas)
            }
            $('#id_jadwal').change(function(e) {
                e.preventDefault();
                let vals = $(this).val()

                const url = '{{ route('trx.penjadwalan.show', ['penjadwalan' => ':idData']) }}'.replace(
                    ':idData',
                    vals);
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "JSON",
                    success: function(response) {
                        let JamData = response.jam.split('-')
                        let jam = {
                            'mulai': JamData[0],
                            'selesai': JamData[1]
                        };
                        $('#hari').val(response.hari).trigger('change')
                        $('#jam_mulai').val(jam.mulai)
                        $('#jam_selesai').val(jam.selesai)
                        getMatkul(response.id_matkul)
                        $('#rombel').val(response.rombel)
                        if (dataKelas != null) {
                            getKelas(null)
                        } else {
                            getKelas(response.id_kelas)

                        }

                        getDosen(response.id_dosen)
                    },
                    complete: function() {
                        $('#hari,#jam_mulai,#jam_selesai,#rombel,#id_matkul,#id_kelas,#id_dosen,#keterangan')
                            .attr(
                                'disabled', false)
                    }
                });
            });

            function formatData(data) {
                if (!data.id) {
                    return $('<strong>' + data.text + '</strong>');
                }
                var $state = $('<span>' + data.text + '</span>');
                return $state;
            }

        });
    </script>
@endsection
