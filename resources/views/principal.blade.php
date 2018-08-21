<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema Ventas Laravel Vue Js- IncanatoIT">
    <meta name="author" content="Incanatoit.com">
    <meta name="keyword" content="Sistema ventas Laravel Vue Js, Sistema compras Laravel Vue Js">
    <link rel="shortcut icon" href="img/favicon.ico">
    <title>Sistema Ventas - SAISAC</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/plantilla.css">
    
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
                <input type="search" placeholder="What are you looking for..." class="form-control">
                </form>
            </div>
            <div class="container-fluid">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                <!-- Navbar Header-->
                <div class="navbar-header">
                    <!-- Navbar Brand --><a href="http://172.20.6.62:8080/saisacsys" class="navbar-brand">
                    <div class="brand-text brand-big"><span><img class="navbar-brand-full" src="img/logo.png" width="220" height="30" alt="CoreUI Logo"></span></div>
                    <div class="brand-text brand-small"><strong>INKA</strong></div></a>    
                    <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
                </div>
                <!-- Navbar Menu -->
                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                    <!-- Search-->
                    <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="icon-search"></i></a></li>
                    <!-- Notifications-->
                    <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell-o"></i><span class="badge bg-red badge-corner">12</span></a>
                    <ul aria-labelledby="notifications" class="dropdown-menu">
                        <li><a rel="nofollow" href="#" class="dropdown-item"> 
                            <div class="notification">
                            <div class="notification-content"><i class="fa fa-envelope bg-green"></i>You have 6 new messages </div>
                            <div class="notification-time"><small>4 minutes ago</small></div>
                            </div></a></li>
                        <li><a rel="nofollow" href="#" class="dropdown-item"> 
                            <div class="notification">
                            <div class="notification-content"><i class="fa fa-twitter bg-blue"></i>You have 2 followers</div>
                            <div class="notification-time"><small>4 minutes ago</small></div>
                            </div></a></li>
                        <li><a rel="nofollow" href="#" class="dropdown-item"> 
                            <div class="notification">
                            <div class="notification-content"><i class="fa fa-upload bg-orange"></i>Server Rebooted</div>
                            <div class="notification-time"><small>4 minutes ago</small></div>
                            </div></a></li>
                        <li><a rel="nofollow" href="#" class="dropdown-item"> 
                            <div class="notification">
                            <div class="notification-content"><i class="fa fa-twitter bg-blue"></i>You have 2 followers</div>
                            <div class="notification-time"><small>10 minutes ago</small></div>
                            </div></a></li>
                        <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>view all notifications                                            </strong></a></li>
                    </ul>
                    </li>
                    <!-- Messages                        -->
                    <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-envelope-o"></i><span class="badge bg-orange badge-corner">10</span></a>
                    <ul aria-labelledby="notifications" class="dropdown-menu">
                        <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                            <div class="msg-profile"> <img src="img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
                            <div class="msg-body">
                            <h3 class="h5">Jason Doe</h3><span>Sent You Message</span>
                            </div></a></li>
                        <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                            <div class="msg-profile"> <img src="img/avatar-2.jpg" alt="..." class="img-fluid rounded-circle"></div>
                            <div class="msg-body">
                            <h3 class="h5">Frank Williams</h3><span>Sent You Message</span>
                            </div></a></li>
                        <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                            <div class="msg-profile"> <img src="img/avatar-3.jpg" alt="..." class="img-fluid rounded-circle"></div>
                            <div class="msg-body">
                            <h3 class="h5">Ashley Wood</h3><span>Sent You Message</span>
                            </div></a></li>
                        <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>Read all messages   </strong></a></li>
                    </ul>
                    </li>
                    <!-- Languages dropdown    -->
                    <!--<li class="nav-item dropdown">
                        <a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle">
                            <img src="img/flags/16/GB.png" alt="English"><span class="d-none d-sm-inline-block">English</span>
                        </a>
                        <ul aria-labelledby="languages" class="dropdown-menu">
                            <li><a rel="nofollow" href="#" class="dropdown-item"> <img src="img/flags/16/DE.png" alt="English" class="mr-2">German</a></li>
                            <li><a rel="nofollow" href="#" class="dropdown-item"> <img src="img/flags/16/FR.png" alt="English" class="mr-2">French                                         </a></li>
                        </ul>
                    </li>-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <img src="img/avatar-1.jpg" class="img-avatar" style="height: 35px; border-radius: 50em; margin: 0 10px;" alt="admin@bootstrapmaster.com">
                            <span class="d-md-down-none">{{ Auth::user()->usuario }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!--<div class="dropdown-header text-center">
                                <strong>Cuenta</strong>
                            </div>-->
                            <!--<a class="dropdown-item" href="#"><i class="fa fa-user"></i> Perfil</a>-->
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-lock"></i> Cerrar sesión
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            
                        </div>
                        <!-- Navbar Menu -->
                        <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                           <!-- Search-->
                           <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="icon-search"></i></a></li>
                           <!-- Notifications-->
                           <li class="nav-item dropdown">
                              <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell-o"></i><span class="badge bg-red badge-corner">12</span></a>
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
                                 <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>view all notifications </strong></a></li>
                              </ul>
                           </li>
                           <!-- Messages -->
                           <li class="nav-item dropdown">
                              <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-envelope-o"></i><span class="badge bg-orange badge-corner">10</span></a>
                              <ul aria-labelledby="notifications" class="dropdown-menu">
                                 <li>
                                    <a rel="nofollow" href="#" class="dropdown-item d-flex">
                                       <div class="msg-profile"> <img src="img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
                                       <div class="msg-body">
                                          <h3 class="h5">Jason Doe</h3>
                                          <span>Sent You Message</span>
                                       </div>
                                    </a>
                                 </li>
                                 <li>
                                    <a rel="nofollow" href="#" class="dropdown-item d-flex">
                                       <div class="msg-profile"> <img src="img/avatar-2.jpg" alt="..." class="img-fluid rounded-circle"></div>
                                       <div class="msg-body">
                                          <h3 class="h5">Frank Williams</h3>
                                          <span>Sent You Message</span>
                                       </div>
                                    </a>
                                 </li>
                                 <li>
                                    <a rel="nofollow" href="#" class="dropdown-item d-flex">
                                       <div class="msg-profile"> <img src="img/avatar-3.jpg" alt="..." class="img-fluid rounded-circle"></div>
                                       <div class="msg-body">
                                          <h3 class="h5">Ashley Wood</h3>
                                          <span>Sent You Message</span>
                                       </div>
                                    </a>
                                 </li>
                                 <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>Read all messages </strong></a></li>
                              </ul>
                           </li>
                           <!-- Languages dropdown -->
                           <!--<li class="nav-item dropdown">
                              <a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle">
                              <img src="img/flags/16/GB.png" alt="English"><span class="d-none d-sm-inline-block">English</span>
                              </a>
                              <ul aria-labelledby="languages" class="dropdown-menu">
                              <li><a rel="nofollow" href="#" class="dropdown-item"> <img src="img/flags/16/DE.png" alt="English" class="mr-2">German</a></li>
                              <li><a rel="nofollow" href="#" class="dropdown-item"> <img src="img/flags/16/FR.png" alt="English" class="mr-2">French </a></li>
                              </ul>
                              </li>-->
                           <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                              <img src="img/avatar-1.jpg" class="img-avatar" style="height: 35px; border-radius: 50em; margin: 0 10px;" alt="admin@bootstrapmaster.com">
                              <span class="d-md-down-none">{{ Auth::user()->usuario }}</span>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">
                                 <!--<div class="dropdown-header text-center">
                                    <strong>Cuenta</strong>
                                    </div>-->
                                 <!--<a class="dropdown-item" href="#"><i class="fa fa-user"></i> Perfil</a>-->
                                 <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                 <i class="fa fa-lock"></i> Cerrar sesión
                                 </a>
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                 </form>
                              </div>
                           </li>
                           <!-- Logout -->
                           <!--<li class="nav-item"><a href="login.html" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>-->
                        </ul>
                     </div>
                  </div>
               </nav>
            </header>
            <div class="page-content d-flex align-items-stretch">
               <!-- Side Navbar -->
               @include('template.sidebar')
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
                              <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding -->
                           </div>
                        </div>
                     </div>
                  </footer>
               </div>
            </div>
         </div>
      </div>
      </div>
      <script src="js/app.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/plantilla.js"></script>
   </body>
</html>
