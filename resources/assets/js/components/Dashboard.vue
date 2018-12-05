<template>
    <!--<transition tag="ul" name="bounce" mode="out-in" appear>-->
        <main>
            <!-- Page Header-->
            <header class="page-header">
                <div class="container-fluid">
                <h2 class="no-margin-bottom">Dashboard</h2>
                </div>
                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="SapLogin">
                    <i class="fa fa-user"></i> Login
                </button>
                <button type="button" class="btn btn-default btn-corner btn-sm" @click="SapLogout">
                    <i class="fa fa-out"></i> Logout
                </button>
                <button type="button" class="btn btn-default btn-corner btn-sm" @click="SapMetaData">
                    <i class="fa fa-out"></i> MetaData
                </button>
                <button type="button" class="btn btn-default btn-corner btn-sm" @click="SapGetValidarContacto">
                    <i class="fa fa-out"></i> Verificar Usuario
                </button>
            </header>
            <!-- Dashboard Counts Section-->
            <section class="dashboard-counts no-padding-bottom">
                <div class="container-fluid">
                    <div class="row bg-white has-shadow">
                        <!-- Item -->
                        <div class="col-xl-3 col-sm-6">
                            <div class="item d-flex align-items-center">
                                <div class="icon bg-violet"><i class="icon-user"></i></div>
                                <div class="title"><span>New<br>Clients</span>
                                    <div class="progress">
                                        <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                                    </div>
                                </div>
                                <div class="number"><strong>25</strong></div>
                            </div>
                        </div>
                        <!-- Item -->
                        <div class="col-xl-3 col-sm-6">
                            <div class="item d-flex align-items-center">
                                <div class="icon bg-red"><i class="icon-padnote"></i></div>
                                <div class="title"><span>Work<br>Orders</span>
                                    <div class="progress">
                                        <div role="progressbar" style="width: 70%; height: 4px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                                    </div>
                                </div>
                                <div class="number"><strong>70</strong></div>
                            </div>
                        </div>
                        <!-- Item -->
                        <div class="col-xl-3 col-sm-6">
                            <div class="item d-flex align-items-center">
                                <div class="icon bg-green"><i class="icon-bill"></i></div>
                                <div class="title"><span>New<br>Invoices</span>
                                    <div class="progress">
                                        <div role="progressbar" style="width: 40%; height: 4px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                                    </div>
                                </div>
                                <div class="number"><strong>40</strong></div>
                            </div>
                        </div>
                        <!-- Item -->
                        <div class="col-xl-3 col-sm-6">
                            <div class="item d-flex align-items-center">
                                <div class="icon bg-orange"><i class="icon-check"></i></div>
                                <div class="title"><span>Open<br>Cases</span>
                                    <div class="progress">
                                        <div role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                                    </div>
                                </div>
                                <div class="number"><strong>50</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Dashboard Header Section    -->
            <section class="dashboard-header">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Statistics -->
                        <div class="statistics col-lg-3 col-12">
                            <div class="statistic d-flex align-items-center bg-white has-shadow">
                                <div class="icon bg-red"><i class="fa fa-tasks"></i></div>
                                <div class="text"><strong>234</strong><br><small>Applications</small></div>
                            </div>
                            <div class="statistic d-flex align-items-center bg-white has-shadow">
                                <div class="icon bg-green"><i class="fa fa-calendar-o"></i></div>
                                <div class="text"><strong>152</strong><br><small>Interviews</small></div>
                            </div>
                            <div class="statistic d-flex align-items-center bg-white has-shadow">
                                <div class="icon bg-orange"><i class="fa fa-paper-plane-o"></i></div>
                                <div class="text"><strong>147</strong><br><small>Forwards</small></div>
                            </div>
                        </div>
                        <!-- Line Chart            -->
                        <div class="chart col-lg-6 col-12">
                            <div class="line-chart bg-white d-flex align-items-center justify-content-center has-shadow">
                                <canvas id="lineCahrt"></canvas>
                            </div>
                        </div>
                        <div class="chart col-lg-3 col-12">
                            <!-- Bar Chart   -->
                            <div class="bar-chart has-shadow bg-white">
                                <div class="title"><strong class="text-violet">95%</strong><br><small>Current Server Uptime</small></div>
                                <canvas id="barChartHome"></canvas>
                            </div>
                            <!-- Numbers-->
                            <div class="statistic d-flex align-items-center bg-white has-shadow">
                                <div class="icon bg-green"><i class="fa fa-line-chart"></i></div>
                                <div class="text"><strong>99.9%</strong><br><small>Success Rate</small></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Projects Section-->
            <section class="projects no-padding-top">
                <div class="container-fluid">
                    <!-- Project-->
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
                    <!-- Project-->
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
                    <!-- Project-->
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
                    <!-- Project-->
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

            <!-- Client Section-->
            <section class="client no-padding-top">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Work Amount  -->
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
                        <!-- Client Profile -->
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
                        <!-- Total Overdue -->
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

            <!-- Feeds Section-->
            <section class="feeds no-padding-top">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Trending Articles-->
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
                        <!-- Check List -->
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

            <!-- Updates Section  -->
            <section class="updates no-padding-top">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Recent Updates-->
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
                                    <!-- Item-->
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
                        <!-- Daily Feeds -->
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
                                    <!-- Item-->
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
                        <!-- Recent Activities -->
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
            </section>
        </main>
    <!--</transition>-->
</template>

<script>
    export default {
        props:['ruta'],
        data(){
            return {
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
                vistaFormulario: 1,
                data: {
                    CompanyDB: "SBO_INKA_PROD",
                    UserName: "janton",
                    Password: "1234"
                },
                SessionId: 0
            }
        },
        methods:{
            SapLogin(){
                //JSON.stringify(this.data)
                var url = this.ruta + '/SAPLoginController/login';
                axios.post(url, this.data, {
                }).then(response => {
                    console.log(response.data.SessionId);
                    this.SessionId = response.data.SessionId;
                    swal('INICIO SESIÓN CORRECTAMENTE');
                }).catch(error => {
                    console.log(error);
                });
            },
            SapLogout(){
                var url = this.ruta + '/SAPLoginController/logout';
                axios.post(url,  {
                    "B1SESSION" : this.SessionId
                }).then(response => {
                    console.log(response.data);
                    swal('CERRÓ SESIÓN CORRECTAMENTE');
                }).catch(error => {
                    console.log(error);
                });
            },
            SapMetaData(){
                var url = this.ruta + '/SAPLoginController/MetaData';
                axios.get(url).then(response => {
                    console.log(response.data);
                    swal('METADATA');
                }).catch(error => {
                    console.log(error);
                });
            },
            SapGetValidarContacto(){
                var url = this.ruta + '/gescontacto/SapGetValidarContacto';

                this.mostrarProgressBar();
                axios.post(url,  {

                }).then(response => {
                    $("#myBar").hide();
                    console.log(response.data);
                    if(response.data == true){
                        swal("EXISTE");
                    }else{
                        swal("NO EXISTE");
                    }
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>
