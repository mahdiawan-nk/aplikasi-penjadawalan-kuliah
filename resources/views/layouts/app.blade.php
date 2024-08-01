<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('') }}static-file/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    @yield('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/notifications/css/lobibox.min.css" />
    <link href="{{ asset('') }}assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('') }}assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('') }}assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('') }}assets/css/loading-bar.css" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('') }}assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/fonts/font.googleapis.css') }}" rel="stylesheet">
    <link href="{{ asset('') }}assets/css/app.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/css/icons.css" rel="stylesheet">

    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('') }}assets/css/dark-theme.css" />
    <link rel="stylesheet" href="{{ asset('') }}assets/css/semi-dark.css" />
    <link rel="stylesheet" href="{{ asset('') }}assets/css/header-colors.css" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}"/>
    <title>Dashboard</title>
    <link href="{{ asset('assets/plugins/datatable/datatables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/select2-bootstrap-5-theme.min.css') }}" />

    <style>
        .fa-loader {
            font-size: 20em;
            line-height: .03125em;
        }
    </style>

</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--start header -->
        @include('layouts.header')
        <!--end header -->
        <!--navigation-->
        @if (in_array(session('role'), [1, 2, 4,3]))
            @include('layouts.nav')
        @endif

        <!--end navigation-->
        <!--start page wrapper -->
        @yield('wrapper')
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
                class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2021. All right reserved.</p>
        </footer>
    </div>
    <!--end wrapper-->
    <!--start switcher-->
    <div class="switcher-wrapper">
        <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
        </div>
        <div class="switcher-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
                <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
            </div>
            <hr />
            <h6 class="mb-0">Theme Styles</h6>
            <hr />
            <div class="d-flex align-items-center justify-content-between">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
                    <label class="form-check-label" for="lightmode">Light</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
                    <label class="form-check-label" for="darkmode">Dark</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
                    <label class="form-check-label" for="semidark">Semi Dark</label>
                </div>
            </div>
            <hr />
            <div class="form-check">
                <input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
                <label class="form-check-label" for="minimaltheme">Minimal Theme</label>
            </div>
            <hr />
            <h6 class="mb-0">Header Colors</h6>
            <hr />
            <div class="header-colors-indigators">
                <div class="row row-cols-auto g-3">
                    <div class="col">
                        <div class="indigator headercolor1" id="headercolor1"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor2" id="headercolor2"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor3" id="headercolor3"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor4" id="headercolor4"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor5" id="headercolor5"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor6" id="headercolor6"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor7" id="headercolor7"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor8" id="headercolor8"></div>
                    </div>
                </div>
            </div>
            <hr />
            <h6 class="mb-0">Sidebar Colors</h6>
            <hr />
            <div class="header-colors-indigators">
                <div class="row row-cols-auto g-3">
                    <div class="col">
                        <div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="loader-state" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-body d-flex flex-column justify-content-center align-items-center">
                    <div class="">
                        <i class="fa-regular fa-clock fa-spin fa-loader bd-gray-100"></i>
                    </div>
                    <h3 class="mt-5 text-white">Please Wait..!!!!</h3>

                </div>
            </div>
        </div>
    </div>
    <!--end switcher-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('') }}assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="{{ asset('') }}assets/js/jquery.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="{{ asset('') }}assets/plugins/notifications/js/lobibox.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/notifications/js/notifications.min.js"></script>
    <!--app JS-->
    <script src="{{ asset('') }}assets/js/app.js"></script>
    <script src="{{ asset('assets/plugins/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/pusher.min.js') }}"></script>
    <script>
        paceOptions = {
            ajax: true,
            document: true,
            eventLag: false,
            restartOnPushState: true,
            restartOnRequestAfter: true,
            target: ".page-wrapper",
            elements: {
                checkInterval: 100,
                selectors: [".page-wrapper"]
            },
            ajax: {
                trackMethods: ["GET"]
            }
        };

        $(".wrapper").hasClass("toggled") ? ($(".wrapper").removeClass("toggled"), $(".sidebar-wrapper").unbind("hover")) :
            ($(".wrapper").addClass("toggled"), $(".sidebar-wrapper").hover(function() {
                $(".wrapper").addClass("sidebar-hovered")
            }, function() {
                $(".wrapper").removeClass("sidebar-hovered")
            }))

        var idUser = '{{ App\Helpers\infoUser()->id }}';

        Pusher.logToConsole = false;

        var pusher = new Pusher('5485f0d7a988f8a9c610', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            console.log(data.message.userId)
            if (data.message.userId == idUser) {
                info_noti(data.message.body)
                notification()
            }

        });

        function info_noti(msg) {
            Lobibox.notify('info', {
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
                position: 'top right',
                icon: 'bx bx-info-circle',
                msg: msg
            });
        }

        notification()

        function notification() {
            $.ajax({
                type: "GET",
                url: "{{ route('notif.index') }}",
                dataType: "JSON",
                success: function(response) {
                    $('.alert-count').text(response.unread_count)
                    let html = ''
                    response.notifications.forEach(item => {
                        html += `<a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                                <div class="notify bg-light-info text-info"><i class="bx bx-info-circle"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="msg-name">${item.title}<span class="msg-time float-end">${item.created_at_human}</span></h6>
                                    <p class="msg-info" style="white-space:pre-wrap;width:250px">${item.body}</p>
                                </div>
                            </div>
                        </a>`
                    });
                    $('.header-notifications-list').html(html)
                }
            });
        }
    </script>
    <script src="{{ asset('') }}assets/js/pace.min.js"></script>
    @yield('script')
</body>

</html>
