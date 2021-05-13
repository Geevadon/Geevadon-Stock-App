<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config ('app.name') }}</title>

    <!-- Custom fonts for this template-->
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset ('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset ('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route ('page.dashboard')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-cart-arrow-down"></i>
                </div>
                <div class="sidebar-brand-text mx-3">GStock <sup>App</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ set_active_route ('page.dashboard') }}">
                <a class="nav-link" href="{{ route ('page.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tableau de bord</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Principaux
            </div>

            <!-- Nav Commands - Pages Collapse Menu -->
            <li class="nav-item {{ set_active_route ('orders.index', 'orders.create', 'orders.show', 'order-history.index', 'order-history.show') }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCommands" aria-expanded="true" aria-controls="collapseCommands">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Commandes</span>
                </a>
                <div id="collapseCommands" class="collapse" aria-labelledby="headingCommands" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Gestion de Commandes</h6>
                        <a class="collapse-item" href="{{ route ('orders.index') }}">Liste de Commandes</a>
                        <a class="collapse-item" href="{{ route ('orders.create') }}">Nouvelle Commande</a>
                        <a class="collapse-item" href="{{ route ('order-history.index') }}">Historique</a>
                    </div>
                </div>
            </li>

            <!-- Nav Products - Utilities Collapse Menu -->
            <li class="nav-item {{ set_active_route ('products.index', 'products.create', 'products.edit', 'product-history.index') }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="true" aria-controls="collapseProducts">
                    <i class="fa fa-shopping-bag"></i>
                    <span>Produits</span>
                </a>
                <div id="collapseProducts" class="collapse" aria-labelledby="headingProducts" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Gestion de Produits</h6>
                        <a class="collapse-item" href="{{ route ('products.index') }}">Liste de Produits</a>
                        <a class="collapse-item" href="{{ route ('products.create') }}">Nouveau Produit</a>
                        <a class="collapse-item" href="{{ route ('product-history.index') }}">Historique</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Autres
            </div>

            <!-- Nav Categories - Utilities Collapse Menu -->
            <li class="nav-item {{ set_active_route ('categories.index', 'categories.create', 'categories.edit') }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="true" aria-controls="collapseCategories">
                    <i class="fas fa-list-ul"></i>
                    <span>Catégories</span>
                </a>
                <div id="collapseCategories" class="collapse" aria-labelledby="headingCategories" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Gestion de Catégories</h6>
                        <a class="collapse-item" href="{{ route ('categories.index') }}">Liste de Catégories</a>
                        <a class="collapse-item" href="{{ route ('categories.create') }}">Nouvelle Catégorie</a>
                    </div>
                </div>
            </li>

            <!-- Nav Brands - Utilities Collapse Menu -->
            <li class="nav-item {{ set_active_route ('brands.index', 'brands.create', 'brands.edit') }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBrands" aria-expanded="true" aria-controls="collapseBrands">
                    <i class="fas fa-copyright"></i>
                    <span>Marques</span>
                </a>
                <div id="collapseBrands" class="collapse" aria-labelledby="headingBrands" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Gestion de Marques</h6>
                        <a class="collapse-item" href="{{ route ('brands.index') }}">Liste de Marques</a>
                        <a class="collapse-item" href="{{ route ('brands.create') }}">Nouvelle Marque</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Informations
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route ('page.help') }}">
                    <i class="fas fa-fw fa-question-circle"></i>
                    <span>Aide</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form method="POST" action="{{ route ('search.product') }}" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            @csrf
                            <input type="text" class="form-control bg-light border-0 small" name="search_query" placeholder="Rechercher un produit..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">{{ $notifications_count }}+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Notifications
                                </h6>
                                <span class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3 d-block">
                                            <div class="icon-circle bg-primary">
                                                <i class="fas fa-file-alt text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            @foreach ($notifications as $notification)
                                                <div class="small text-gray-500">{{ date_format (date_create ($notification->created_at), 'd/m/Y') }}</div>
                                                <span class="font-weight-bold">{{ substr ($notification->content, 0, -42) }}</span>
                                            @endforeach
                                        </div>

                                </span>

                                <a class="dropdown-item text-center small text-gray-500" href="{{ route ('notifications.index') }}">Voir toutes les notifications</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth ()->user ()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset (auth ()->user ()->profile->photo) }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route ('profile.index') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Mon Profile
                                </a>
                                <a class="dropdown-item" href="{{route ('profile.edit', auth ()->user ()->id) }}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Paramètres
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" onclick="event.preventDefault (); document.getElementById ('logout-form').submit ();" href="{{ route ('logout') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Déconnexion
                                </a>
                                <form action="{{ route ('logout') }}" method="post" id="logout-form">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                {{-- ======================================== DEBUT CONTENU DE LA PAGE ================================= --}}

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    {{-- ------------ Show Message Flash ----------- --}}
                    @if (session()->has ('notification.message'))
                    <div class="alert alert-{{ session ()->has ('notification.type') ? session ()->get ('notification.type') : ''}} alert-dismissible fade show" role="alert">
                        <strong>{{ session ()->get ('notification.message') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

                {{-- ======================================== FIN CONTENU DE LA PAGE ================================= --}}
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>&copy; {{ config ('app.name') }} - Licence MIT - Made with ❤️ by Donatien Vamuleke (Geevadon)</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    {{-- ==================================== OUR CONFIRM MODAL ========================================== --}}
    @include('layouts.partials._confirm-modal')

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/datatables-demo.js') }}"></script>

    {{-- ============================== OUR CONFIRMATION MODALS SCRIPTS =================================== --}}
    @include('layouts.partials._confirm-modal-scripts')

</body>

</html>
