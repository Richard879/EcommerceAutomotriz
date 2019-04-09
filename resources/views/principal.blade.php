<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de Gestión Comercial">
    <meta name="author" content="hyundai.com">
    <meta name="keyword" content="Sistema de Gestión Comercial">
    <link rel="shortcut icon" href="img/favicon.ico">

    <!-- Id for Channel Notification -->
    <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : '' }}">

    <title>Sistema Ventas - SAISAC</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/plantilla.css">
    <script src="js/core.js"></script>
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <div id="myProgress">
        <div id="myBar"></div>
    </div>
    <div id="app">
        <div class="page">
            <!-- Main Navbar-->
            <header class="header">
                <nav class="navbar">
                    <!-- Search Box-->
                    <div class="search-box">
                        <button class="dismiss"><i class="icon-close"></i></button>
                        <form id="searchForm" action="#" role="search">
                            <input type="search" placeholder="Que opción esta buscando..." class="form-control">
                        </form>
                    </div>
                    <div class="container-fluid">
                        <div class="navbar-holder d-flex align-items-center justify-content-between">
                            <!-- Navbar Header-->
                            <div class="navbar-header parteIzq">
                                <!-- Navbar Brand -->
                                <a href="http://localhost:8080/saisacsys" class="navbar-brand">
                                <div class="brand-text brand-big">
                                    <span>
                                        <img class="navbar-brand-full" src="img/logo.png" width="220" height="30" alt="CoreUI Logo">
                                    </span>
                                </div>
                                <div class="brand-text brand-small"><strong>INKA</strong></div></a>
                                <!-- Toggle Button-->
                                <a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
                            </div>
                            <!-- Navbar Menu -->
                            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center parteDer">
                                @include('cabecera.cabecera')
                                <div style="display: flex; justify-content: center;">
                                    <!-- Notifications-->
                                    <li class="nav-item dropdown">
                                        <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
                                            <i class="fa fa-bell-o"></i><span class="badge bg-red badge-corner">12</span>
                                        </a>
                                        <ul aria-labelledby="notifications" class="dropdown-menu">
                                            <li>
                                                <a rel="nofollow" href="#" class="dropdown-item">
                                                    <div class="notification">
                                                        <div class="notification-content"><i class="fa fa-envelope bg-green"></i>You have 6 new messages </div>
                                                        <div class="notification-time"><small>4 minutes ago</small></div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a rel="nofollow" href="#" class="dropdown-item">
                                                    <div class="notification">
                                                        <div class="notification-content"><i class="fa fa-twitter bg-blue"></i>You have 2 followers</div>
                                                        <div class="notification-time"><small>4 minutes ago</small></div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a rel="nofollow" href="#" class="dropdown-item">
                                                    <div class="notification">
                                                        <div class="notification-content"><i class="fa fa-upload bg-orange"></i>Server Rebooted</div>
                                                        <div class="notification-time"><small>4 minutes ago</small></div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a rel="nofollow" href="#" class="dropdown-item">
                                                    <div class="notification">
                                                        <div class="notification-content"><i class="fa fa-twitter bg-blue"></i>You have 2 followers</div>
                                                        <div class="notification-time"><small>10 minutes ago</small></div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"><strong>view all notifications</strong></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- Messages -->
                                    <!--<li class="nav-item dropdown">
                                        <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
                                            <i class="fa fa-envelope-o"></i><span class="badge bg-orange badge-corner">10</span>
                                        </a>
                                        <ul aria-labelledby="notifications" class="dropdown-menu">
                                            <li>
                                                <a rel="nofollow" href="#" class="dropdown-item d-flex">
                                                    <div class="msg-profile">
                                                        <img src="img/prueba.png" alt="..." class="img-fluid rounded-circle">
                                                    </div>
                                                    <div class="msg-body">
                                                        <h3 class="h5">Jason Doe</h3><span>Sent You Message</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a rel="nofollow" href="#" class="dropdown-item d-flex">
                                                    <div class="msg-profile">
                                                        <img src="img/prueba.png" alt="..." class="img-fluid rounded-circle">
                                                    </div>
                                                    <div class="msg-body">
                                                        <h3 class="h5">Frank Williams</h3><span>Sent You Message</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a rel="nofollow" href="#" class="dropdown-item d-flex">
                                                    <div class="msg-profile">
                                                        <img src="img/prueba.png" alt="..." class="img-fluid rounded-circle">
                                                    </div>
                                                    <div class="msg-body">
                                                        <h3 class="h5">Ashley Wood</h3><span>Sent You Message</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"><strong>Read all messages</strong></a>
                                            </li>
                                        </ul>
                                    </li>-->
                                </div>
                                <li class="nav-item dropdown">
                                    <cabeceralogin :ruta="ruta" :usuario="{{ auth()->user() }}"></cabeceralogin>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="page-content d-flex align-items-stretch">
                <!-- Side Navbar -->
                @include('menu.menu')
                <div class="content-inner">
                    <!-- Contenido Principal -->
                    @yield('contenido')
                    <!-- /Fin del contenido principal -->
                    <!-- Page Footer-->
                    <footer class="main-footer">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-6">
                                <p>Automotores INKA &copy; 2018</p>
                                </div>
                                <div class="col-sm-6 text-right">
                                <p>Design by <a href="#" class="external">SAISACTI</a></p>
                                <!-- Please do not remove the backlink to us unless you support further themes development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding -->
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>
    <script src="js/app.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plantilla.js"></script>
    <script src="js/treeview.js"></script>
</body>
</html>
