<!DOCTYPE html>
<html lang="en">
<?php
$userName = auth()->user()->name ?? "";

?>
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link href="{{ asset('assets/adminimg/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/adminlib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/adminlib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/admincss/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom Stylesheet (Arabic) -->
    <link href="{{ asset('assets/admincss/style.css') }}" rel="stylesheet">

    @stack('styles') <!-- Allows child views to push additional styles -->
</head>

<body>

    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <div class="container-fluid">
            <!-- Sidebar Start -->
            @if($showSidebar ?? true) <!-- If $showSidebar is true or not defined, show the sidebar -->
                <div class="sidebar pe-4 pb-3">
                    <nav class="navbar bg-light navbar-light">
                        <a href="{{ route('order.index') }}" class="navbar-brand mx-4 mb-3">
                            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>
Sales
                            </h3>
                        </a>


                        <div class="navbar-nav w-100">
                            {{-- <a href="{{ route('admin.index') }}" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a> --}}
                            {{-- <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Elements</a>
                                <div class="dropdown-menu bg-transparent border-0">
                                    <a href="button.html" class="dropdown-item">Buttons</a>
                                    <a href="typography.html" class="dropdown-item">Typography</a>
                                    <a href="element.html" class="dropdown-item">Other Elements</a>
                                </div>
                            </div> --}}

                            <a href="{{ route('dashboard.index') }}" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i> Dashboard </a>
                            <br>
                            <a href="{{ route('order.index') }}" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i> Orders </a>
                            <br>
                            <a href="{{ route('ai_recommendations') }}" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i> Ai Recommendations </a>
                            <br>
                            <a href="{{ route('weather') }}" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i> Weather </a>
                            <br>

                            <!-- Secure Logout -->
                            <form id="logout-form" action="" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>

                    </nav>
                </div>
            @endif
            <!-- Sidebar End -->

            <!-- Content Start -->
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- Content End -->

        </div>

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/adminlib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('assets/adminlib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/adminlib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/adminlib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/adminlib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/adminlib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('assets/adminlib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/adminjs/main.js') }}"></script>

</body>

</html>
