<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('') }}static-file/favicon-32x32.png" type="image/png" />
    <!-- loader-->
    <link href="{{ asset('') }}assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{ asset('') }}assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('') }}assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('') }}assets/css/app.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/css/icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <title>UP - Sigin</title>
    <style>
        .bg-login {
            background-image: url(https://sains.universitaspahlawan.ac.id/web/upload/frontend/background/universitaspahlawan.jpg);
            background-size: 100% 100%;
            background-repeat: no-repeat;
            min-height: 100%;
            height: 100%;
        }
    </style>
</head>

<body class="bg-login">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                    <div class="col mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="d-grid d-flex flex-row">
                                        <img src="{{ asset('static-file/logo.png') }}" alt=""
                                            class="img-fluid w-25">
                                        <div class="d-flex flex-column align-self-center">
                                            <h4>SISTEM INFORMASI PENJADWALAN RUANG KELAS</h4>
                                            <h4>UNIVERSITAS PAHLAWAN TUANKU TAMBUSAI</h4>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="form-body">
                                        <form class="row g-3" id="form-login" method="POST" action="{{ route('registrasi') }}">
                                            @csrf
                                            <div class="col-12">
                                                <label for="name" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="name"
                                                    placeholder="Nama Lengkap" name="name" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="nim" class="form-label">NIM</label>
                                                <input type="text" class="form-control" id="name"
                                                    placeholder="NIM" name="nidn_nim" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" id="inputEmailAddress"
                                                    placeholder="Email Address" name="email" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Program Studi</label>
                                                <select id="prodi" name="prodi" class="form-control" required>

                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Enter
                                                    Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" name="password"
                                                        class="form-control border-end-0" id="inputChoosePassword"
                                                        value="12345678" placeholder="Enter Password"> <a
                                                        href="javascript:;" class="input-group-text bg-transparent"><i
                                                            class='bx bx-hide'></i></a>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-3 mx-auto my-auto"><label for=""
                                                            id="captcha" class="fw-bold ms-2"></label></div>
                                                    <div class="col-9">
                                                        <input type="text" class="form-control" id="captchaInput"
                                                            placeholder="input captcha">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="col-lg-12 col-md-12 d-flex flex-row justify-content-between">
                                                <a href="{{ route('login') }}" class="btn btn-secondary w-25">Login</a>
                                                <button type="submit" class="btn btn-primary w-25"></i>Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->

    <!--plugins-->
    <script src="{{ asset('') }}assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
            $('form#form-login').on('submit', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                if (checkCaptcha()) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('registrasi') }}",
                        data: $(this).serialize(),
                        dataType: "JSON",
                        success: function(response) {
                            Swal.fire({
                                icon: "success",
                                title: "REgistrasi Berhasil",
                                text: "Akun berhasil dibuat",
                                footer: '<a href="#">Why do I have this issue?</a>'
                            }).then((result)=>{
                                window.location.href = '{{ route('login') }}'
                            })
                        },
                        error: function(xhr, status, error) {
                            // Tampilkan kode status HTTP
                            console.log(xhr);
                        },
                        statusCode: {
                            400: function() {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Email nim sudah terdaftar",
                                }).then((result) => {
                                    generateCaptcha();
                                });
                            }
                            // Tambahkan penanganan untuk kode status lain jika diperlukan
                        }
                    });

                }


            });
        });

        var captchaAnswer;

        function generateCaptcha() {
            var num1 = Math.floor(Math.random() * 30);
            var num2 = Math.floor(Math.random() * 20);
            var question = num1 + ' + ' + num2 + ' = ';
            captchaAnswer = num1 + num2;
            document.getElementById('captcha').textContent = question;
        }

        function checkCaptcha() {
            var userInput = document.getElementById('captchaInput').value;
            if (parseInt(userInput) === captchaAnswer) {
                return true;
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Captcha salah",
                });
                generateCaptcha();
                return false;
            }

        }

        window.onload = function() {
            generateCaptcha();
        };
        getProdi()

        function getProdi(datas = null) {


            fetch('{{ route('data.prodi') }}?ajax=true', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
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

                    $("#prodi").select2({
                        theme: "bootstrap-5",
                        data: opsi
                    });

                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }
    </script>
</body>

</html>
