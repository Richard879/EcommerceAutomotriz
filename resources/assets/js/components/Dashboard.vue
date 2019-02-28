<template>
    <!--<transition tag="ul" name="bounce" mode="out-in" appear>-->
        <main>
            <!-- Page Header-->
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">Dashboard de {{ formLogin.cUsuario }} - {{ formLogin.cRol }} </h2>
                </div>
            </header>

            <!-- Dashboard Section - Cantidad de Trabajadores Por Cargo ||  JV/ADV//Gerencia-->
            <section class="dashboard-counts no-padding-bottom" v-if="formLogin.nIdRol == 110025 || formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                <div class="container-fluid">
                    <div class="row bg-white has-shadow">
                        <div class="col-xs-12" style="width: 100%;">
                            <h3>Cantidad de Trabajadores Por Cargo</h3>
                        </div>
                        <!-- JV/ADV//Gerencia-->
                        <template v-if="formLogin.nIdRol == 110025 || formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                            <div class="col-xl-4 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <div class="icon bg-violet"><i class="icon-user"></i></div>
                                    <div class="title"><span>N°<br>Asesores Comerciales</span>
                                        <div class="progress">
                                            <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                                        </div>
                                    </div>
                                    <div class="number"><strong> {{ cDashboard01.nCantidadAsesoresComerciales }} </strong></div>
                                </div>
                            </div>
                        </template>

                        <!-- ADV//Gerencia-->
                        <template v-if="formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                            <div class="col-xl-4 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <div class="icon bg-violet"><i class="icon-user"></i></div>
                                    <div class="title"><span>N°<br>Jefe Ventas</span>
                                        <div class="progress">
                                            <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                                        </div>
                                    </div>
                                    <div class="number"><strong> {{ cDashboard01.nCantidadJefeVentas }} </strong></div>
                                </div>
                            </div>
                        </template>

                        <!-- ADV//Gerencia-->
                        <template v-if="formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                            <div class="col-xl-4 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <div class="icon bg-violet"><i class="icon-user"></i></div>
                                    <div class="title"><span>N°<br>Administrador de Ventas</span>
                                        <div class="progress">
                                            <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                                        </div>
                                    </div>
                                    <div class="number"><strong> {{ cDashboard01.nCantidadADV }} </strong></div>
                                </div>
                            </div>
                        </template>

                        <!-- Gerencia-->
                        <template v-if="formLogin.nIdRol == 110096">
                            <div class="col-xl-4 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <div class="icon bg-violet"><i class="icon-user"></i></div>
                                    <div class="title"><span>N°<br>Gerencia</span>
                                        <div class="progress">
                                            <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                                        </div>
                                    </div>
                                    <div class="number"><strong> {{ cDashboard01.nCantidadGerente }} </strong></div>
                                </div>
                            </div>
                        </template>

                        <!-- ADV/Gerencia -->
                        <template v-if="formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                            <div class="col-xl-4 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <div class="icon bg-violet"><i class="icon-user"></i></div>
                                    <div class="title"><span>N°<br>Tramitador</span>
                                        <div class="progress">
                                            <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                                        </div>
                                    </div>
                                    <div class="number"><strong> {{ cDashboard01.nCantidadTramitador }} </strong></div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </section>

            <!-- Dashboard Section 02 -->
            <section class="dashboard-counts no-padding-bottom">
                <div class="container-fluid">
                    <div class="row bg-white has-shadow">
                        <!-- V/JV/ADV -->
                        <template v-if="formLogin.nIdRol == 110026 || formLogin.nIdRol == 110025 || formLogin.nIdRol == 110083">
                            <div class="col-xl-6 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <canvas id="GetMisCotizaciones"></canvas>
                                </div>
                            </div>
                        </template>
                        <!-- JV/ADV//Gerencia -->
                        <template v-if="formLogin.nIdRol == 110025 || formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                            <div class="col-xl-6 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <canvas id="GetCotizacioneByVendedor"></canvas>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </section>

            <!-- Dashboard Header Section    -->
            <section class="dashboard-header" v-if="formLogin.nIdRol == 110025">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Statistics -->
                        <div class="chart col-lg-3 col-12">
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="col-xs-12" style="width: 100%;">
                                        <h3>ESTADISTICAS DE COTIZACIONES POR ASESOR COMERCIAL</h3>
                                    </div>
                                </div>
                            </div>
                            <el-select v-model="cDashboard03.fillInfoUsuarioFind.nIdUsuario"
                                    filterable
                                    clearable
                                    placeholder="SELECCIONE UN ASESOR DE VENTAS">
                                <el-option
                                    v-for="item in cDashboard03.arrayAsesoresByJV"
                                    :key="item.nIdUsuario"
                                    :label="item.cNombreUsuario"
                                    :value="item.nIdUsuario">
                                </el-option>
                            </el-select>
                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary btn-corner btn-sm btnBuscar" @click.prevent="GetCotizacionByUserFind">
                                        <i class="fa fa-search"></i> Buscar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="chart col-lg-9 col-12">
                            <div class="bar-chart has-shadow bg-white">
                                <div class="title"><strong class="text-violet"> {{ cDashboard03.fillInfoUsuarioFind.cNombreRol }} </strong><br>
                                <small>{{ cDashboard03.fillInfoUsuarioFind.cNombreUsuario }}</small></div>
                                <canvas id="arrayDashboardUserFind"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Dashboard Header Section    -->
            <section class="dashboard-header" v-if="formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                <div class="container-fluid">
                    <div class="row">
                        <div class="chart col-lg-3 col-12">
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="col-xs-12" style="width: 100%;">
                                        <h3>ESTADISTICAS DE COTIZACIONES POR ASESOR COMERCIAL</h3>
                                    </div>
                                </div>
                            </div>
                            <el-select v-model="cDashboard04.fillInfoUsuario.nIdUsuario"
                                    filterable
                                    clearable
                                    placeholder="SELECCIONE UN ASESOR DE VENTAS">
                                <el-option
                                    v-for="item in cDashboard04.arrayAsesoresByAll"
                                    :key="item.nIdUsuario"
                                    :label="item.cNombreUsuario"
                                    :value="item.nIdUsuario">
                                </el-option>
                            </el-select>
                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary btn-corner btn-sm btnBuscar" @click.prevent="GetCotizacionByUserAllFind">
                                        <i class="fa fa-search"></i> Buscar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="chart col-lg-9 col-12">
                            <div class="bar-chart has-shadow bg-white">
                                <div class="title"><strong class="text-violet"> {{ cDashboard04.fillInfoUsuario.cNombreRol }} </strong><br>
                                <small>{{ cDashboard04.fillInfoUsuario.cNombreUsuario }}</small></div>
                                <canvas id="arrayDashboardUserAllFind"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Projects Section -->
            <section class="projects no-padding-top">
                <div class="container-fluid">
                    <div class="project">
                        <div class="row bg-white has-shadow">
                            <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                <div class="project-title d-flex align-items-center">
                                    <div class="image has-shadow"><img src="img/prueba.png" alt="..." class="img-fluid"></div>
                                    <div class="text">
                                        <h3 class="h4">Project Title</h3><small>Lorem Ipsum Dolor</small>
                                    </div>
                                </div>
                                <div class="project-date"><span class="hidden-sm-down">Today at 4:24 AM</span></div>
                            </div>
                            <div class="right-col col-lg-6 d-flex align-items-center">
                                <div class="time"><i class="fa fa-clock-o"></i>12:00 PM </div>
                                <div class="comments"><i class="fa fa-comment-o"></i>20</div>
                                <div class="project-progress">
                                    <div class="progress">
                                        <div role="progressbar" style="width: 45%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="project">
                        <div class="row bg-white has-shadow">
                            <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                <div class="project-title d-flex align-items-center">
                                    <div class="image has-shadow"><img src="img/prueba.png" alt="..." class="img-fluid"></div>
                                    <div class="text">
                                        <h3 class="h4">Project Title</h3><small>Lorem Ipsum Dolor</small>
                                    </div>
                                </div>
                                <div class="project-date"><span class="hidden-sm-down">Today at 4:24 AM</span></div>
                            </div>
                            <div class="right-col col-lg-6 d-flex align-items-center">
                                <div class="time"><i class="fa fa-clock-o"></i>12:00 PM </div>
                                <div class="comments"><i class="fa fa-comment-o"></i>20</div>
                                <div class="project-progress">
                                    <div class="progress">
                                        <div role="progressbar" style="width: 60%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="project">
                        <div class="row bg-white has-shadow">
                            <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                <div class="project-title d-flex align-items-center">
                                    <div class="image has-shadow"><img src="img/prueba.png" alt="..." class="img-fluid"></div>
                                    <div class="text">
                                        <h3 class="h4">Project Title</h3><small>Lorem Ipsum Dolor</small>
                                    </div>
                                </div>
                                <div class="project-date"><span class="hidden-sm-down">Today at 4:24 AM</span></div>
                            </div>
                            <div class="right-col col-lg-6 d-flex align-items-center">
                                <div class="time"><i class="fa fa-clock-o"></i>12:00 PM </div>
                                <div class="comments"><i class="fa fa-comment-o"></i>20</div>
                                <div class="project-progress">
                                    <div class="progress">
                                        <div role="progressbar" style="width: 50%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="project">
                        <div class="row bg-white has-shadow">
                            <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                <div class="project-title d-flex align-items-center">
                                    <div class="image has-shadow"><img src="img/prueba.png" alt="..." class="img-fluid"></div>
                                    <div class="text">
                                        <h3 class="h4">Project Title</h3><small>Lorem Ipsum Dolor</small>
                                    </div>
                                </div>
                                <div class="project-date"><span class="hidden-sm-down">Today at 4:24 AM</span></div>
                            </div>
                            <div class="right-col col-lg-6 d-flex align-items-center">
                                <div class="time"><i class="fa fa-clock-o"></i>12:00 PM </div>
                                <div class="comments"><i class="fa fa-comment-o"></i>20</div>
                                <div class="project-progress">
                                    <div class="progress">
                                        <div role="progressbar" style="width: 50%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Client Section
            <section class="client no-padding-top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="work-amount card">
                                <div class="card-close">
                                    <div class="dropdown">
                                        <button type="button" id="closeCard1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <div aria-labelledby="closeCard1" class="dropdown-menu dropdown-menu-right has-shadow">
                                            <a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a>
                                            <a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h3>Work Hours</h3><small>Lorem ipsum dolor sit amet.</small>
                                    <div class="chart text-center">
                                        <div class="text"><strong>90</strong><br><span>Hours</span></div>
                                        <canvas id="pieChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="client card">
                                <div class="card-close">
                                    <div class="dropdown">
                                        <button type="button" id="closeCard2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <div aria-labelledby="closeCard2" class="dropdown-menu dropdown-menu-right has-shadow">
                                            <a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a>
                                            <a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <div class="client-avatar">
                                        <img src="img/prueba.png" alt="..." class="img-fluid rounded-circle">
                                        <div class="status bg-green"></div>
                                    </div>
                                    <div class="client-title">
                                        <h3>Jason Doe</h3><span>Web Developer</span><a href="#">Follow</a>
                                    </div>
                                    <div class="client-info">
                                        <div class="row">
                                            <div class="col-4"><strong>20</strong><br><small>Photos</small></div>
                                            <div class="col-4"><strong>54</strong><br><small>Videos</small></div>
                                            <div class="col-4"><strong>235</strong><br><small>Tasks</small></div>
                                        </div>
                                    </div>
                                    <div class="client-social d-flex justify-content-between">
                                        <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                                        <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                                        <a href="#" target="_blank"><i class="fa fa-google-plus"></i></a>
                                        <a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
                                        <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="overdue card">
                                <div class="card-close">
                                    <div class="dropdown">
                                        <button type="button" id="closeCard3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <div aria-labelledby="closeCard3" class="dropdown-menu dropdown-menu-right has-shadow">
                                            <a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a>
                                            <a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h3>Total Overdue</h3><small>Lorem ipsum dolor sit amet.</small>
                                    <div class="number text-center">$20,000</div>
                                    <div class="chart">
                                        <canvas id="lineChart1"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            Feeds Section
            <section class="feeds no-padding-top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="articles card">
                                <div class="card-close">
                                    <div class="dropdown">
                                        <button type="button" id="closeCard4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <div aria-labelledby="closeCard4" class="dropdown-menu dropdown-menu-right has-shadow">
                                            <a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a>
                                            <a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header d-flex align-items-center">
                                    <h2 class="h3">Trending Articles </h2>
                                    <div class="badge badge-rounded bg-green">4 New </div>
                                </div>
                                <div class="card-body no-padding">
                                    <div class="item d-flex align-items-center">
                                        <div class="image">
                                            <img src="img/prueba.png" alt="..." class="img-fluid rounded-circle">
                                        </div>
                                        <div class="text">
                                            <a href="#"><h3 class="h5">Lorem Ipsum Dolor</h3></a>
                                            <small>Posted on 5th June 2017 by Aria Smith.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="checklist card">
                                <div class="card-close">
                                    <div class="dropdown">
                                        <button type="button" id="closeCard5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <div aria-labelledby="closeCard5" class="dropdown-menu dropdown-menu-right has-shadow">
                                            <a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a>
                                            <a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header d-flex align-items-center">
                                    <h2 class="h3">To Do List </h2>
                                </div>
                                <div class="card-body no-padding">
                                    <div class="item d-flex">
                                        <input type="checkbox" id="input-1" name="input-1" class="checkbox-template">
                                        <label for="input-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            Updates Section
            <section class="updates no-padding-top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="recent-updates card">
                                <div class="card-close">
                                    <div class="dropdown">
                                        <button type="button" id="closeCard6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <div aria-labelledby="closeCard6" class="dropdown-menu dropdown-menu-right has-shadow">
                                            <a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a>
                                            <a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <h3 class="h4">Recent Updates</h3>
                                </div>
                                <div class="card-body no-padding">
                                    <div class="item d-flex justify-content-between">
                                        <div class="info d-flex">
                                            <div class="icon"><i class="icon-rss-feed"></i></div>
                                            <div class="title">
                                                <h5>Lorem ipsum dolor sit amet.</h5>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed.</p>
                                            </div>
                                        </div>
                                        <div class="date text-right"><strong>24</strong><span>May</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="daily-feeds card">
                                <div class="card-close">
                                    <div class="dropdown">
                                        <button type="button" id="closeCard7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <div aria-labelledby="closeCard7" class="dropdown-menu dropdown-menu-right has-shadow">
                                            <a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a>
                                            <a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <h3 class="h4">Daily Feeds</h3>
                                </div>
                                <div class="card-body no-padding">
                                    <div class="item">
                                        <div class="feed d-flex justify-content-between">
                                            <div class="feed-body d-flex justify-content-between">
                                                <a href="#" class="feed-profile"><img src="img/prueba.png" alt="person" class="img-fluid rounded-circle"></a>
                                                <div class="content">
                                                    <h5>Aria Smith</h5><span>Posted a new blog </span>
                                                    <div class="full-date"><small>Today 5:60 pm - 12.06.2014</small></div>
                                                </div>
                                            </div>
                                            <div class="date text-right"><small>5min ago</small></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="recent-activities card">
                                <div class="card-close">
                                    <div class="dropdown">
                                        <button type="button" id="closeCard8" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <div aria-labelledby="closeCard8" class="dropdown-menu dropdown-menu-right has-shadow">
                                            <a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a>
                                            <a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <h3 class="h4">Recent Activities</h3>
                                </div>
                                <div class="card-body no-padding">
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-4 date-holder text-right">
                                                <div class="icon"><i class="icon-clock"></i></div>
                                                <div class="date"> <span>6:00 am</span><br><span class="text-info">6 hours ago</span></div>
                                            </div>
                                            <div class="col-8 content">
                                                <h5>Meeting</h5>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->

            <!-- Modal Show Errors -->
            <div class="modal fade" v-if="accionmodal==1" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Automotores INKA</h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <div v-for="e in mensajeError" :key="e" v-text="e">

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    <!--</transition>-->
</template>

<script>
    export default {
        props:['ruta', 'usuario'],
        data(){
            return {
                formLogin:{
                    cRuta: '',
                    nIdUsuario: '',
                    cUsuario: '',
                    cRol: '',
                    nIdRol: ''
                },
                cDashboard01: {
                    nCantidadAsesoresComerciales: 0,
                    nCantidadJefeVentas: 0,
                    nCantidadADV: 0,
                    nCantidadGerente: 0,
                    nCantidadTramitador: 0
                },
                cDashboard02: {
                    // Mis Cotizaciones
                    arrayMisCotizaciones: [],
                    arraInfoMisCotizacionesNombre: [],
                    arraInfoMisCotizacionesCantidad: [],
                    // Cotizaciones Por Rol Asesor Comercial
                    arrayCotizacionesByAsesorComercial: [],
                    arraInfoAsesorComercialNombre: [],
                    arraInfoAsesorComercialCantidad: [],
                    // Cotizaciones Por Rol Jefe Ventas
                    arrayCotizacionesByJefeVentas: [],
                    arraInfoJefeVentasNombre: [],
                    arraInfoJefeVentasCantidad: [],
                    // Cotizaciones Por Rol ADV
                    arrayCotizacionesByADV: [],
                    arraInfoADVNombre: [],
                    arraInfoADVCantidad: [],
                },
                cDashboard03: {
                    arrayAsesoresByJV: [],
                    fillInfoUsuarioFind: {
                        nIdUsuario: '',
                        cNombreUsuario: '',
                        cNombreRol: ''
                    },
                    arrayDashboardAsesoresByJV: [],
                    arraInfoAsesorComercialNombre: [],
                    arraInfoAsesorComercialCantidad: []
                },
                cDashboard04: {
                    arrayAsesoresByAll: [],
                    fillInfoUsuario: {
                        nIdUsuario: '',
                        cNombreUsuario: '',
                        cNombreRol: ''
                    },
                    arrayDashboardAsesoresByAll: [],
                    arraInfoAsesorComercialNombre: [],
                    arraInfoAsesorComercialCantidad: []
                },
                //==========================================================
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                paginationModal: {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset:3,
                modal:0,
                tituloModal:'',
                tituloFormulario: '',
                accionmodal: 0,
                error: 0,
                errors: [],
                mensajeError: [],
                vistaFormulario: 1
            }
        },
        mounted(){
            this.cargarInformacionUsuario();
        },
        methods:{
            cargarInformacionUsuario(){
                var url = this.ruta + '/usuario/GetInformacionUsuarioCabecera';
                axios.get(url, {
                    params: {
                        'nidusuario': this.usuario.id
                    }
                }).then(response => {
                    this.formLogin.cRuta        = response.data[0].cPathImage;
                    this.formLogin.nIdUsuario   = response.data[0].id;
                    this.formLogin.cUsuario     = response.data[0].cUsuario;
                    this.formLogin.cRol         = response.data[0].cGrupoParNombre;
                    this.formLogin.nIdRol       = response.data[0].nIdGrupoPar;
                    this.loadAllDashboard();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            loadAllDashboard(){
                // Dashboard 01
                this.GetAsesoresComercialesByRol();
                this.GetJefeVentasByRol();
                this.GetADVByRol();
                this.GetGenerenteByRol();
                this.GetTramitadorByRol();

                // Dashboard 02
                if(this.formLogin.nIdRol == 110026 || this.formLogin.nIdRol == 110025 || this.formLogin.nIdRol == 110083) {
                    //Solo si es V/JV/ADV
                    this.GetMisCotizaciones();
                }
                if(this.formLogin.nIdRol == 110025 || this.formLogin.nIdRol == 110083 || this.formLogin.nIdRol == 110096) {
                    //Solo si es JV/ADV//Gerencia
                    this.GetCotizacionesPorAsesorComercial();
                }

                // Dashboard 03
                if(this.formLogin.nIdRol == 110025) {
                     //Solo si es JV
                    this.GetAsesoresByJV();
                }

                // Dashboard 04
                if(this.formLogin.nIdRol == 110083 || this.formLogin.nIdRol == 110096) {
                    //Solo si es ADV//Gerencia
                    this.GetAsesoresByAll();
                }
            },
            // Dashboard 01
            GetAsesoresComercialesByRol(){
                var url = this.ruta + '/dashboard/GetEmpleadosByRol';
                axios.get(url, {
                    params: {
                        'nidrol': 110026
                    }
                }).then(response => {
                    this.cDashboard01.nCantidadAsesoresComerciales = response.data[0].nCantidaEmpleados;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            GetJefeVentasByRol(){
                var url = this.ruta + '/dashboard/GetEmpleadosByRol';
                axios.get(url, {
                    params: {
                        'nidrol': 110025
                    }
                }).then(response => {
                    this.cDashboard01.nCantidadJefeVentas = response.data[0].nCantidaEmpleados;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            GetADVByRol(){
                var url = this.ruta + '/dashboard/GetEmpleadosByRol';
                axios.get(url, {
                    params: {
                        'nidrol': 110083
                    }
                }).then(response => {
                    this.cDashboard01.nCantidadADV = response.data[0].nCantidaEmpleados;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            GetGenerenteByRol(){
                var url = this.ruta + '/dashboard/GetEmpleadosByRol';
                axios.get(url, {
                    params: {
                        'nidrol': 110096
                    }
                }).then(response => {
                    this.cDashboard01.nCantidadGerente = response.data[0].nCantidaEmpleados;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            GetTramitadorByRol(){
                var url = this.ruta + '/dashboard/GetEmpleadosByRol';
                axios.get(url, {
                    params: {
                        'nidrol': 110086
                    }
                }).then(response => {
                    this.cDashboard01.nCantidadTramitador = response.data[0].nCantidaEmpleados;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            // Dashboard 02
            GetMisCotizaciones(){
                var url = this.ruta + '/dashboard/GetCotizacionesByUsuario';
                axios.get(url, {
                    params: {
                        'nIdUsuario': this.formLogin.nIdUsuario,
                        'dfecha': moment().format('YYYY-MM-DD')
                    }
                }).then(response => {
                    this.cDashboard02.arrayMisCotizaciones = response.data;
                    this.createDashBoardObtenerMisCotizaciones()
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            createDashBoardObtenerMisCotizaciones(){
                let me=this;

                if (me.cDashboard02.arrayMisCotizaciones.length > 0) {
                    me.cDashboard02.arrayMisCotizaciones.map(function(x) {
                        me.cDashboard02.arraInfoMisCotizacionesNombre.push(x.cNombreMes);
                        me.cDashboard02.arraInfoMisCotizacionesCantidad.push(x.nCantidaCotizaciones);
                    });
                }

                var ctx = document.getElementById('GetMisCotizaciones').getContext('2d');
                var chart = new Chart(ctx, {
                    // Tipo de Chart
                    type: 'bar',
                    // Los Datos para el Chart
                    data: {
                        labels: (this.cDashboard02.arrayMisCotizaciones.length > 0) ? me.cDashboard02.arraInfoMisCotizacionesNombre : '',
                        datasets: [{
                            label: "Mis Cotizaciones por Mes",
                            backgroundColor: '#3b5998',
                            borderColor: '#32506d',
                            data: (this.cDashboard02.arrayMisCotizaciones.length > 0) ? me.cDashboard02.arraInfoMisCotizacionesCantidad : '',
                        }]
                    },
                    // Configuration options go here
                    options: {}
                });
            },
            GetCotizacionesPorAsesorComercial(){
                var url = this.ruta + '/dashboard/GetCotizacionesByRol';
                axios.get(url, {
                    params: {
                        'nIdRol': '110026',
                        'dfecha': moment().format('YYYY-MM-DD')
                    }
                }).then(response => {
                    this.cDashboard02.arrayCotizacionesByAsesorComercial = response.data;
                    this.createDashBoardObtenerCotizacionesPorAsesorVentas()
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            createDashBoardObtenerCotizacionesPorAsesorVentas(){
                let me=this;

                if(me.cDashboard02.arrayCotizacionesByAsesorComercial.length > 0) {
                    me.cDashboard02.arrayCotizacionesByAsesorComercial.map(function(x) {
                        me.cDashboard02.arraInfoAsesorComercialNombre.push(x.cNombreMes);
                        me.cDashboard02.arraInfoAsesorComercialCantidad.push(x.nCantidaCotizaciones);
                    });
                }

                var ctx = document.getElementById('GetCotizacioneByVendedor').getContext('2d');
                var chart = new Chart(ctx, {
                    // Tipo de Chart
                    type: 'bar',
                    // Los Datos para el Chart
                    data: {
                        labels: (this.cDashboard02.arrayCotizacionesByAsesorComercial.length > 0) ? me.cDashboard02.arraInfoAsesorComercialNombre : '',
                        datasets: [{
                            label: "Cotizaciones por Mes de los Asesores Ventas",
                            backgroundColor: '#3b5998',
                            borderColor: '#32506d',
                            data: (this.cDashboard02.arrayCotizacionesByAsesorComercial.length > 0) ? me.cDashboard02.arraInfoAsesorComercialCantidad : '',
                        }]
                    },
                    // Configuration options go here
                    options: {}
                });
            },
            // Dashboard 03
            GetAsesoresByJV(){
                var url = this.ruta + '/dashboard/GetAsesoresByJV';
                axios.get(url, {
                    params: {
                        'nIdUsuario': this.formLogin.nIdUsuario
                    }
                }).then(response => {
                    this.cDashboard03.arrayAsesoresByJV = response.data;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            validarCotizacionByUserFind(){
                let me = this;
                me.error = 0;
                me.mensajeError =[];

                if (!me.cDashboard03.fillInfoUsuarioFind.nIdUsuario) {
                    me.mensajeError.push("Debe seleccionar un Asesor de Ventas para Mostrar sus estadisticas");
                }

                if(me.mensajeError.length){
                    me.error = 1;
                }
                return me.error;
            },
            GetCotizacionByUserFind(){
                if(this.validarCotizacionByUserFind()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                var url = this.ruta + '/dashboard/GetCotizacionesByUsuario';
                axios.get(url, {
                    params: {
                        'nIdUsuario': this.cDashboard03.fillInfoUsuarioFind.nIdUsuario,
                        'dfecha': moment().format('YYYY-MM-DD')
                    }
                }).then(response => {
                    this.cDashboard03.fillInfoUsuarioFind.cNombreUsuario = '';
                    this.cDashboard03.fillInfoUsuarioFind.cNombreRol = '';
                    this.cDashboard03.arrayDashboardAsesoresByJV = [];

                    if(response.data.length) {
                        // console.log(response.data);
                        this.cDashboard03.fillInfoUsuarioFind.cNombreUsuario = response.data[0].cNombreUsuario;
                        this.cDashboard03.fillInfoUsuarioFind.cNombreRol = response.data[0].cNombreRol;
                        this.cDashboard03.arrayDashboardAsesoresByJV = response.data;
                    }
                    this.createDashBoardCotizacionByUserFind()
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            createDashBoardCotizacionByUserFind(){
                let me = this;

                //Setear Información
                me.cDashboard03.arraInfoAsesorComercialNombre = [];
                me.cDashboard03.arraInfoAsesorComercialCantidad = [];
                let ctx = '';
                let chart = '';

                if(me.cDashboard03.arrayDashboardAsesoresByJV.length > 0) {
                    me.cDashboard03.arrayDashboardAsesoresByJV.map(function(x) {
                        me.cDashboard03.arraInfoAsesorComercialNombre.push(x.cNombreMes);
                        me.cDashboard03.arraInfoAsesorComercialCantidad.push(x.nCantidaCotizaciones);
                    });
                }

                ctx = document.getElementById('arrayDashboardUserFind').getContext('2d');
                chart = new Chart(ctx, {
                    // Tipo de Chart
                    type: 'bar',
                    // Los Datos para el Chart
                    data: {
                        labels: (this.cDashboard03.arrayDashboardAsesoresByJV.length > 0) ? me.cDashboard03.arraInfoAsesorComercialNombre : '',
                        datasets: [{
                            label: "Número de Cotizaciones por Mes",
                            backgroundColor: '#3b5998',
                            borderColor: '#32506d',
                            data: (this.cDashboard03.arrayDashboardAsesoresByJV.length > 0) ? me.cDashboard03.arraInfoAsesorComercialCantidad : '',
                        }]
                    },
                    // Configuration options go here
                    options: {}
                });
            },
            // Dashboard 04
            GetAsesoresByAll(){
                var url = this.ruta + '/dashboard/GetCotizacionesByUsuario';
                axios.get(url, {
                    params: {
                        'dfecha': moment().format('YYYY-MM-DD')
                    }
                }).then(response => {
                    this.cDashboard04.arrayAsesoresByAll = response.data;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            validarCotizacionByUserAllFind(){
                let me = this;
                me.error = 0;
                me.mensajeError =[];

                if (!me.cDashboard04.fillInfoUsuario.nIdUsuario) {
                    me.mensajeError.push("Debe seleccionar un Asesor de Ventas para Mostrar sus estadisticas de Cotizaciones");
                }

                if(me.mensajeError.length){
                    me.error = 1;
                }
                return me.error;
            },
            GetCotizacionByUserAllFind(){
                if(this.validarCotizacionByUserAllFind()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                var url = this.ruta + '/dashboard/GetCotizacionesByUsuario';
                axios.get(url, {
                    params: {
                        'nIdUsuario': this.cDashboard04.fillInfoUsuario.nIdUsuario,
                        'dfecha': moment().format('YYYY-MM-DD')
                    }
                }).then(response => {
                    this.cDashboard04.fillInfoUsuario.cNombreUsuario = '';
                    this.cDashboard04.fillInfoUsuario.cNombreRol = '';
                    this.cDashboard04.arrayDashboardAsesoresByAll = [];

                    if(response.data.length) {
                        this.cDashboard04.fillInfoUsuario.cNombreUsuario = response.data[0].cNombreUsuario;
                        this.cDashboard04.fillInfoUsuario.cNombreRol = response.data[0].cNombreRol;
                        this.cDashboard04.arrayDashboardAsesoresByAll = response.data;
                    }
                    this.createDashBoardCotizacionByUserFind()
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            createDashBoardCotizacionByUserFind(){
                let me = this;

                //Setear Información
                me.cDashboard04.arraInfoAsesorComercialNombre = [];
                me.cDashboard04.arraInfoAsesorComercialCantidad = [];
                let ctx = '';
                let chart = '';

                if(me.cDashboard04.arrayDashboardAsesoresByAll.length > 0) {
                    me.cDashboard04.arrayDashboardAsesoresByAll.map(function(x) {
                        me.cDashboard04.arraInfoAsesorComercialNombre.push(x.cNombreMes);
                        me.cDashboard04.arraInfoAsesorComercialCantidad.push(x.nCantidaCotizaciones);
                    });
                }

                ctx = document.getElementById('arrayDashboardUserAllFind').getContext('2d');
                chart = new Chart(ctx, {
                    // Tipo de Chart
                    type: 'bar',
                    // Los Datos para el Chart
                    data: {
                        labels: (this.cDashboard04.arrayDashboardAsesoresByAll.length > 0) ? me.cDashboard04.arraInfoAsesorComercialNombre : '',
                        datasets: [{
                            label: "Número de Cotizaciones por Mes",
                            backgroundColor: '#3b5998',
                            borderColor: '#32506d',
                            data: (this.cDashboard04.arrayDashboardAsesoresByAll.length > 0) ? me.cDashboard04.arraInfoAsesorComercialCantidad : '',
                        }]
                    },
                    // Configuration options go here
                    options: {}
                });
            },
            // =============================================
            // =============  MODAL ========================
            cerrarModal(){
                this.modal = 0,
                this.error = 0,
                this.mensajeError = []
            },
            mostrarProgressBar(){
                $("#myBar").show();
                progress();
            },
            loadingProgressBar(texto){
                this.loading = this.$loading({
                    lock: true,
                    text: texto,
                    spinner: 'fa-spin fa-md fa fa-cube',
                    background: 'rgba(0, 0, 0, 0.7)'
                });
            }
        }
    }
</script>

<style>
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: fixed !important;
        background-color: #3c29297a !important;
        overflow-y: scroll;
    }
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .error{
        display: flex;
        justify-content: center;
    }
    .text-center{
        color: red;
        font-weight: bold;
        font-size: 0.75rem;
    }
    .btnBuscar{
        width: 100%;
        padding: .5rem;
        margin-top: .4rem;
    }
</style>
