<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title') - Admin PLN</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
        /* Top Navigation Bar Styling */
        .top-navigation {
            background: #2c3e50;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            color: #fff !important;
            text-decoration: none;
            font-weight: 600;
            font-size: 18px;
        }

        .navbar-brand:hover {
            color: #fff !important;
        }

        .navbar-brand img {
            width: 50px !important;
            height: 50px !important;
            object-fit: contain;
            margin-right: 10px;
        }

        /* Navigation Items */
        .navbar-nav .nav-item .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            padding: 15px 20px;
            transition: all 0.3s ease;
            border-radius: 5px;
            margin: 0 5px;
        }

        .navbar-nav .nav-item .nav-link:hover {
            color: #fff !important;
            background: rgba(255, 255, 255, 0.1);
        }

        .navbar-nav .nav-item.active .nav-link {
            color: #fff !important;
            background: rgba(255, 255, 255, 0.2);
        }

        /* Dropdown Styling */
        .dropdown-menu {
            background: #34495e;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,.1);
        }

        .dropdown-item {
            color: rgba(255, 255, 255, 0.8);
            padding: 10px 20px;
        }

        .dropdown-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .dropdown-toggle::after {
            margin-left: 5px;
        }

        /* User Profile Styling */
        .user-info {
            display: flex;
            align-items: center;
            color: #fff;
        }

        .user-info img {
            width: 35px;
            height: 35px;
            margin-left: 15px;
        }

        /* Dropdown arrow positioning */
        #userDropdown .dropdown-toggle::after {
            margin-left: 0.3rem;
            margin-right: 0;
        }

        /* Content wrapper adjustment */
        .content-wrapper {
            padding-top: 20px;
        }

        /* Footer */
        footer {
            background: #f8f9fc;
            border-top: 1px solid #e3e6f0;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 16px;
            }
            
            .navbar-brand img {
                width: 40px !important;
                height: 40px !important;
            }
            
            .navbar-nav .nav-item .nav-link {
                padding: 10px;
                margin: 2px;
            }
        }

        
    </style>

    @yield('styles')
</head>

<body>

    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark top-navigation">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/PLN_LOGO.png') }}" alt="PLN Logo">
                Admin PLN
            </a>

            <!-- Toggler for mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Items -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <!-- Dashboard -->
                    <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>

                    <!-- Master Data Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="masterDataDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-fw fa-database"></i>
                            Master Data
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="masterDataDropdown">
                            <li><a class="dropdown-item {{ Request::is('admin/wilayah*') ? 'active' : '' }}" 
                                   href="{{ route('wilayah.index') }}">
                                <i class="fas fa-fw fa-map-marker-alt"></i>
                                Data Wilayah
                            </a></li>
                            <li><a class="dropdown-item {{ Request::is('admin/pemadaman*') ? 'active' : '' }}" 
                                   href="{{ route('pemadaman.index') }}">
                                <i class="fas fa-fw fa-bolt"></i>
                                Jadwal Pemadaman
                            </a></li>
                        </ul>
                    </li>

                    <!-- Public Page -->
                    <li class="nav-item">
                        <a class="nav-link" href="/" target="_blank">
                            <i class="fas fa-fw fa-globe"></i>
                            Halaman Publik
                        </a>
                    </li>
                </ul>

                <!-- User Info -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="me-2">Admin</span>
                            <img class="rounded-circle"
                                 src="https://ui-avatars.com/api/?name=Admin&background=random" alt="Profile">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw me-2"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="content-wrapper">
        <!-- Begin Page Content -->
        @yield('content')
        <!-- /.container-fluid -->
    </div>

    <!-- Footer -->
    <footer class="sticky-footer">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>PLN 2025 &copy; Tarissa Nurhapsari Laksono</span>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Pilih "Logout" jika Anda ingin mengakhiri sesi ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script>
        // Keep the scroll to top button functionality
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('.scroll-to-top').fadeIn();
            } else {
                $('.scroll-to-top').fadeOut();
            }
        });

        $('.scroll-to-top').click(function() {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });
    </script>

    @yield('scripts')

</body>

</html>