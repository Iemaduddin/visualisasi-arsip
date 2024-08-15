<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        Visualisasi Arsip
    </title>
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">
    <!--     Fonts and icons     -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/fontAwesome.css') }}">
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    {{-- <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('assets/js/plugins/42d5adcbca.js') }}" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    {{-- font awesome 6.5.1 --}}
    {{-- <link href="{{ asset('assets/css/fontawesome-6.5.1/css/all.min.css') }}" rel="stylesheet" /> --}}
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />

    {{-- Font Awesome Pro --}}
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-6.5.1/css/all.css') }}" />

    {{-- <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css"> --}}
    <link href="{{ asset('assets/css/fontawesome-6.5.1/css/all.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet" />

</head>

<body class="{{ $class ?? '' }}">
    @guest
        @yield('content')
    @endguest

    @auth
        @if (in_array(request()->route()->getName(), ['login', 'register', 'recover-password']))
            @yield('content')
        @else
            @if (!in_array(request()->route()->getName(), ['profile.operator', 'profile.operator']))
                <div class="min-height-300 bg-gradient-info position-absolute w-100"></div>
            @elseif (in_array(request()->route()->getName(), ['profile.operator', 'profile.operator']))
                <div class="position-absolute w-100 min-height-300 top-0"
                    style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg'); background-position-y: 50%;">
                    <span class="mask bg-primary opacity-6"></span>
                </div>
            @endif
            @include('layouts.partials.sidenav')
            <main class="main-content border-radius-lg">
                @yield('content')
            </main>
        @endif
    @endauth

    {{-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> --}}
    <script src="{{ asset('assets/js/plugins/jquery-3.7.0.js') }}"></script>
    {{-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> --}}
    <script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/counterup.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    {{-- preloader --}}
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $(".preloader").fadeOut();
            }, 300);
        });
    </script>
    <script>
        $('#userTable, #locationTable, #categoryTable, #archiveTable').DataTable({
            pagingType: 'full_numbers',
            // stateSave: true,
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var title = column.footer().textContent.trim(); // Use header instead of footer

                    // Exclude 'id' and 'action' columns from search
                    if (title !== 'Action') {
                        // Create input element and add event listener
                        $('<input type="text" class="form-control form-control-sm" placeholder=' +
                                title + ' />')
                            .appendTo($(column.footer()).empty()) // Use header instead of footer
                            .on('keyup change clear', function() {
                                if (column.search() !== this.value) {
                                    column.search(this.value).draw();
                                }
                            });
                    } else {
                        // For 'id' and 'action' columns, leave the header empty
                        $(column.footer()).empty();
                    }
                });
            },
        });
    </script>
    @include('sweetalert::alert')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="{{ asset('assets/js/plugins/sweetalert2@11.js') }}"></script>
    <!-- Github buttons -->
    {{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}
    <script async defer src="{{ asset('assets/js/plugins/buttons.js') }}"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/argon-dashboard.js') }}"></script>

    <script>
        $(document).on('click', '.confirm-delete, .confirm-delete1', function(event) {
            let form = $(this).closest("form");
            event.preventDefault();

            Swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Data akan terhapus secara permanen.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#8392ab",
                confirmButtonText: "Ya, delete!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>

    {{-- eye password --}}
    <script>
        const showPasswordToggle = document.querySelector("#show-password-toggle");
        const passwordField = document.querySelector("#password");

        showPasswordToggle.addEventListener("click", function() {
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);

            // Toggle eye icon
            const eyeIconClass = type === "password" ? "fa-eye" : "fa-eye-slash";
            this.innerHTML = `<i class="fa ${eyeIconClass}" aria-hidden="true"></i>`;
        });
    </script>


</body>

</html>
