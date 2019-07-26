<template>
    <!--<transition tag="ul" name="bounce" mode="out-in" appear>-->
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <vs-divider color="dark">
                        <h2 class="no-margin-bottom">DASHBOARD DE {{ formLogin.cUsuario }} - {{ formLogin.cRol }}</h2>
                    </vs-divider>
                </div>
            </header>

            <!-- Dashboard 01 - NÚMERO DE TRABAJADORES POR CARGO ||  JV/ADV//Gerencia-->
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

            <!-- Dashboard 02 - NÚMERO DE MIS COTIZACIONES Y COTIZACIONES POR ASESOR COMERCIAL-->
            <section class="dashboard-counts no-padding-bottom">
                <div class="container-fluid">
                    <div class="row bg-white has-shadow">
                        <!-- JV/ADV//Gerencia -->
                        <template v-if="formLogin.nIdRol == 110096">
                            <div class="col-xl-6 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <canvas id="GetCotizacionesMontoByMes"></canvas>
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-6">
                                <div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-12 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">
                                                <div class="text">
                                                    <h3 class="h4">Monto Total Cotizaciones</h3>
                                                </div>
                                            </div>
                                            <div class="project-date">
                                                $ <span class="hidden-sm-down">{{ cDashboard02.fMontoTotalDolaresCotizacion }}</span>
                                            </div>
                                            <div class="project-date">
                                                S/. <span class="hidden-sm-down">{{ cDashboard02.fMontoTotalSolesCotizacion }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-12 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">
                                                <div class="text">
                                                    <h3 class="h4">Cantidad Total Cotizaciones</h3>
                                                </div>
                                            </div>
                                            <div class="project-date">
                                                N° <span class="hidden-sm-down">{{ cDashboard02.nCantidadTotalCotizacion }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
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

            <!-- Dashboard 03 - ESTADISTICAS DE COTIZACIONES POR ASESOR COMERCIAL ASGINADO    -->
            <section class="dashboard-counts no-padding-bottom" v-if="formLogin.nIdRol == 110025">
                <div class="container-fluid">
                    <div class="row bg-white has-shadow">
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
                                    placeholder="SELECCIONE UN ASESOR COMERCIAL">
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

            <!-- Dashboard 04 - ESTADISTICAS DE COTIZACIONES POR TODOS LOS ASESORES COMERCIALES   -->
            <section class="dashboard-counts no-padding-bottom" v-if="formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                <div class="container-fluid">
                    <div class="row bg-white has-shadow">
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
                                    placeholder="SELECCIONE UN ASESOR COMERCIAL">
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

            <!-- Dashboard 05 - NÚMERO DE MIS PEDIDOS Y PEDIDOS POR ASESOR COMERCIAL-->
            <section class="dashboard-counts no-padding-bottom">
                <div class="container-fluid">
                    <div class="row bg-white has-shadow">
                        <!-- JV/ADV//Gerencia -->
                        <template v-if="formLogin.nIdRol == 110096">
                            <div class="col-xl-6 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <canvas id="GetPedidosMontoByMes"></canvas>
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-6">
                                <div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-12 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">
                                                <div class="text">
                                                    <h3 class="h4">Monto Total Pedidos</h3>
                                                </div>
                                            </div>
                                            <div class="project-date">
                                                $ <span class="hidden-sm-down">{{ cDashboard05.fMontoTotalDolaresPedido }}</span>
                                            </div>
                                            <div class="project-date">
                                                S/. <span class="hidden-sm-down">{{ cDashboard05.fMontoTotalSolesPedido }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-12 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">
                                                <div class="text">
                                                    <h3 class="h4">Cantidad Total Pedidos</h3>
                                                </div>
                                            </div>
                                            <div class="project-date">
                                                N° <span class="hidden-sm-down">{{ cDashboard05.nCantidadTotalPedido }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <!-- V/JV/ADV -->
                        <template v-if="formLogin.nIdRol == 110026 || formLogin.nIdRol == 110025 || formLogin.nIdRol == 110083">
                            <div class="col-xl-6 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <canvas id="GetMisPedido"></canvas>
                                </div>
                            </div>
                        </template>
                        <!-- JV/ADV//Gerencia -->
                        <template v-if="formLogin.nIdRol == 110025 || formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                            <div class="col-xl-6 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <canvas id="GetPedidosByVendedor"></canvas>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </section>

            <!-- Dashboard 06 - ESTADISTICAS DE PEDIDOS POR ASESOR COMERCIAL ASGINADO    -->
            <section class="dashboard-counts no-padding-bottom" v-if="formLogin.nIdRol == 110025">
                <div class="container-fluid">
                    <div class="row bg-white has-shadow">
                        <div class="chart col-lg-3 col-12">
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="col-xs-12" style="width: 100%;">
                                        <h3>ESTADISTICAS DE PEDIDOS POR ASESOR COMERCIAL</h3>
                                    </div>
                                </div>
                            </div>
                            <el-select v-model="cDashboard03.fillPedidoInfoUsuarioFind.nIdUsuario"
                                    filterable
                                    clearable
                                    placeholder="SELECCIONE UN ASESOR COMERCIAL">
                                <el-option
                                    v-for="item in cDashboard03.arrayAsesoresByJV"
                                    :key="item.nIdUsuario"
                                    :label="item.cNombreUsuario"
                                    :value="item.nIdUsuario">
                                </el-option>
                            </el-select>
                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary btn-corner btn-sm btnBuscar" @click.prevent="GetPedidoByUserFind">
                                        <i class="fa fa-search"></i> Buscar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="chart col-lg-9 col-12">
                            <div class="bar-chart has-shadow bg-white">
                                <div class="title"><strong class="text-violet"> {{ cDashboard03.fillPedidoInfoUsuarioFind.cNombreRol }} </strong><br>
                                <small>{{ cDashboard03.fillPedidoInfoUsuarioFind.cNombreUsuario }}</small></div>
                                <canvas id="arrayDashboardPedidoUserFind"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Dashboard 07 - ESTADISTICAS DE PEDIDOS POR TODOS LOS ASESORES COMERCIALES   -->
            <section class="dashboard-counts no-padding-bottom" v-if="formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                <div class="container-fluid">
                    <div class="row bg-white has-shadow">
                        <div class="chart col-lg-3 col-12">
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="col-xs-12" style="width: 100%;">
                                        <h3>ESTADISTICAS DE PEDIDOS POR ASESOR COMERCIAL</h3>
                                    </div>
                                </div>
                            </div>
                            <el-select v-model="cDashboard04.fillPedidoInfoUsuario.nIdUsuario"
                                    filterable
                                    clearable
                                    placeholder="SELECCIONE UN ASESOR COMERCIAL">
                                <el-option
                                    v-for="item in cDashboard04.arrayAsesoresByAll"
                                    :key="item.nIdUsuario"
                                    :label="item.cNombreUsuario"
                                    :value="item.nIdUsuario">
                                </el-option>
                            </el-select>
                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary btn-corner btn-sm btnBuscar" @click.prevent="GetPedidoByUserAllFind">
                                        <i class="fa fa-search"></i> Buscar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="chart col-lg-9 col-12">
                            <div class="bar-chart has-shadow bg-white">
                                <div class="title"><strong class="text-violet"> {{ cDashboard04.fillPedidoInfoUsuario.cNombreRol }} </strong><br>
                                <small>{{ cDashboard04.fillPedidoInfoUsuario.cNombreUsuario }}</small></div>
                                <canvas id="arrayDashboardPedidoUserAllFind"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

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
        props:['ruta', 'usuario', 'notifications'],
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
                    // Monto Total Cotizaciones por Mes
                    arrayCotizacionesMontoByMes: [],
                    arrayCotizacionesMontoNombre: [],
                    arrayCotizacionesMontoMonto: [],
                    // Monto Total Pedidos
                    fMontoTotalDolaresCotizacion: 0,
                    fMontoTotalSolesCotizacion: 0,
                    // Cantidad Total Pedidos
                    nCantidadTotalCotizacion: 0,
                    // Mis Cotizaciones
                    arrayMisCotizaciones: [],
                    arrayInfoMisCotizacionesNombre: [],
                    arrayInfoMisCotizacionesCantidad: [],
                    // Cotizaciones Por Rol Asesor Comercial
                    arrayCotizacionesByAsesorComercial: [],
                    arrayInfoAsesorComercialNombre: [],
                    arrayInfoAsesorComercialCantidad: [],
                    // Cotizaciones Por Rol Jefe Ventas
                    arrayCotizacionesByJefeVentas: [],
                    arrayInfoJefeVentasNombre: [],
                    arrayInfoJefeVentasCantidad: [],
                    // Cotizaciones Por Rol ADV
                    arrayCotizacionesByADV: [],
                    arrayInfoADVNombre: [],
                    arrayInfoADVCantidad: [],
                },
                cDashboard03: {
                    arrayAsesoresByJV: [],
                    //COTIZACIÓN
                    fillInfoUsuarioFind: {
                        nIdUsuario: '',
                        cNombreUsuario: '',
                        cNombreRol: ''
                    },
                    arrayDashboardAsesoresByJV: [],
                    arrayInfoAsesorComercialNombre: [],
                    arrayInfoAsesorComercialCantidad: [],
                    //PEDIDO
                    fillPedidoInfoUsuarioFind: {
                        nIdUsuario: '',
                        cNombreUsuario: '',
                        cNombreRol: ''
                    },
                    arrayDashboardPedidoAsesoresByJV: [],
                    arrayInfoPedidoAsesorComercialNombre: [],
                    arrayInfoPedidoAsesorComercialCantidad: []
                },
                cDashboard04: {
                    arrayAsesoresByAll: [],
                    fillInfoUsuario: {
                        nIdUsuario: '',
                        cNombreUsuario: '',
                        cNombreRol: ''
                    },
                    arrayDashboardAsesoresByAll: [],
                    arrayInfoAsesorComercialNombre: [],
                    arrayInfoAsesorComercialCantidad: [],
                    //========
                    fillPedidoInfoUsuario: {
                        nIdUsuario: '',
                        cNombreUsuario: '',
                        cNombreRol: ''
                    },
                    arrayDashboardPedidoAsesoresByAll: [],
                    arrayInfoAsesorPedidoComercialNombre: [],
                    arrayInfoAsesorPedidoComercialCantidad: []
                },
                cDashboard05: {
                    // Monto Total Pedidos por Mes
                    arrayPedidosMontoByMes: [],
                    arrayPedidoMontoNombre: [],
                    arrayPedidoMontoMonto: [],
                    // Monto Total Pedidos
                    fMontoTotalDolaresPedido: 0,
                    fMontoTotalSolesPedido: 0,
                    // Cantidad Total Pedidos
                    nCantidadTotalPedido: 0,
                    // Mis Pedidos
                    arrayMisPedidos: [],
                    arrayInfoMisPedidosNombre: [],
                    arrayInfoMisPedidosCantidad: [],
                    // Pedidos Por Rol Asesor Comercial
                    arrayPedidosByAsesorComercial: [],
                    arrayInfoAsesorComercialNombre: [],
                    arrayInfoAsesorComercialCantidad: [],
                    arraInfoAsesorComercialMonto: [],
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
                    ((parseInt(sessionStorage.getItem("nIdEmpresa")) == null) ||
                    (parseInt(sessionStorage.getItem("nIdEmpresa")) == undefined) ||
                    (parseInt(sessionStorage.getItem("nIdEmpresa")) == '')) ? '' : this.loadAllDashboard();
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
                if(this.formLogin.nIdRol == 110096) {
                    //Solo si es Gerencia
                    this.GetMontoCotizacionesPorMes();
                    this.GetMontoTotalCotizaciones();
                    this.GetTotalCotizaciones();
                }
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

                // Dashboard 05
                if(this.formLogin.nIdRol == 110096) {
                    //Solo si es Gerencia
                    this.GetMontoPedidoPorMes();
                    this.GetMontoTotalPedidos();
                    this.GetTotalPedidos();
                }
                if(this.formLogin.nIdRol == 110026 || this.formLogin.nIdRol == 110025 || this.formLogin.nIdRol == 110083) {
                    //Solo si es V/JV/ADV
                    this.GetMisPedidos();
                }
                if(this.formLogin.nIdRol == 110025 || this.formLogin.nIdRol == 110083 || this.formLogin.nIdRol == 110096) {
                    //Solo si es JV/ADV//Gerencia
                    this.GetPedidosPorAsesorComercial();
                }
            },
            // Dashboard 01
            GetAsesoresComercialesByRol(){
                var url = this.ruta + '/dashboard/GetEmpleadosByRol';
                axios.get(url, {
                    params: {
                        'nIdEmpresa'    :   (parseInt(sessionStorage.getItem("nIdEmpresa")) == null) ? '0' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidrol'        :   110026
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
                        'nIdEmpresa'    :   (parseInt(sessionStorage.getItem("nIdEmpresa")) == null) ? '0' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidrol'        :   110025
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
                        'nIdEmpresa'    :   (parseInt(sessionStorage.getItem("nIdEmpresa")) == null) ? '0' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidrol'        :   110083
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
                        'nIdEmpresa'    :   (parseInt(sessionStorage.getItem("nIdEmpresa")) == null) ? '0' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidrol'        :   110096
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
                        'nIdEmpresa'    :   (parseInt(sessionStorage.getItem("nIdEmpresa")) == null) ? '0' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidrol'        :   110086
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
            //=================
            GetMontoCotizacionesPorMes(){
                var url = this.ruta + '/dashboard/GetCotizacionMontoByMes';
                axios.get(url, {
                    params: {
                        'nIdEmpresa'    :   (parseInt(sessionStorage.getItem("nIdEmpresa")) == null) ? '0' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'dfecha'        :   moment().format('YYYY-MM-DD')
                    }
                }).then(response => {
                    this.cDashboard02.arrayCotizacionesMontoByMes = response.data;
                    this.createDashBoardObtenerMontoCotizacionesPorMes()
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
            createDashBoardObtenerMontoCotizacionesPorMes(){
                let me=this;

                if(me.cDashboard02.arrayCotizacionesMontoByMes.length > 0) {
                    me.cDashboard02.arrayCotizacionesMontoByMes.map(function(x) {
                        me.cDashboard02.arrayCotizacionesMontoNombre.push(x.cNombreMes);
                        me.cDashboard02.arrayCotizacionesMontoMonto.push(x.fMontoDolares);
                    });
                }

                var ctx = document.getElementById('GetCotizacionesMontoByMes').getContext('2d');
                var chart = new Chart(ctx, {
                    // Tipo de Chart
                    type: 'bar',
                    // Los Datos para el Chart
                    data: {
                        labels: (this.cDashboard02.arrayCotizacionesMontoByMes.length > 0) ? me.cDashboard02.arrayCotizacionesMontoNombre : '',
                        datasets: [{
                            label: "Monto Total de Cotizaciones por Mes",
                            backgroundColor: '#3b5998',
                            borderColor: '#32506d',
                            data: (this.cDashboard02.arrayCotizacionesMontoByMes.length > 0) ? me.cDashboard02.arrayCotizacionesMontoMonto : ''
                        }]
                    },
                    // Configuration options go here
                    options: {
                        barValueSpacing: 20,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0,
                                }
                            }]
                        }
                    }
                });
            },
            //=================
            GetMontoTotalCotizaciones(){
                var url = this.ruta + '/dashboard/GetCotizacionMontoTotal';
                axios.get(url, {
                    params: {
                        'nIdEmpresa'    :   (parseInt(sessionStorage.getItem("nIdEmpresa")) == null) ? '0' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'dfecha'        :   moment().format('YYYY-MM-DD')
                    }
                }).then(response => {
                    this.cDashboard02.fMontoTotalDolaresCotizacion = (response.data[0] == null) ? 0 : response.data[0].fMontoTotalDolares;
                    this.cDashboard02.fMontoTotalSolesCotizacion = (response.data[0] == null) ? 0 : response.data[0].fMontoTotalSoles;
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
            //=================
            GetTotalCotizaciones(){
                var url = this.ruta + '/dashboard/GetCotizacionCantidadTotal';
                axios.get(url, {
                    params: {
                        'nIdEmpresa'    :   (parseInt(sessionStorage.getItem("nIdEmpresa")) == null) ? '0' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'dfecha'        :   moment().format('YYYY-MM-DD')
                    }
                }).then(response => {
                    this.cDashboard02.nCantidadTotalCotizacion = (response.data[0].nCantidadTotalCotizacion == null) ? 0 : response.data[0].nCantidadTotalCotizacion;
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
            //=================
            GetMisCotizaciones(){
                var url = this.ruta + '/dashboard/GetCotizacionesByUsuario';
                axios.get(url, {
                    params: {
                        'nIdEmpresa'    :   (parseInt(sessionStorage.getItem("nIdEmpresa")) == null) ? '0' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nIdUsuario'    :   this.formLogin.nIdUsuario,
                        'dfecha'        :   moment().format('YYYY-MM-DD')
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
                        me.cDashboard02.arrayInfoMisCotizacionesNombre.push(x.cNombreMes);
                        me.cDashboard02.arrayInfoMisCotizacionesCantidad.push(x.nCantidaCotizaciones);
                    });
                }

                var ctx = document.getElementById('GetMisCotizaciones').getContext('2d');
                var chart = new Chart(ctx, {
                    // Tipo de Chart
                    type: 'bar',
                    // Los Datos para el Chart
                    data: {
                        labels: (this.cDashboard02.arrayMisCotizaciones.length > 0) ? me.cDashboard02.arrayInfoMisCotizacionesNombre : '',
                        datasets: [{
                            label: "Mis Cotizaciones por Mes",
                            backgroundColor: '#3b5998',
                            borderColor: '#32506d',
                            data: (this.cDashboard02.arrayMisCotizaciones.length > 0) ? me.cDashboard02.arrayInfoMisCotizacionesCantidad : '',
                        }]
                    },
                    // Configuration options go here
                    options: {}
                });
            },
            //=================
            GetCotizacionesPorAsesorComercial(){
                var url = this.ruta + '/dashboard/GetCotizacionesByRol';
                axios.get(url, {
                    params: {
                        'nIdEmpresa'    :   (parseInt(sessionStorage.getItem("nIdEmpresa")) == null) ? '0' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nIdRol'        :   '110026',
                        'dfecha'        :   moment().format('YYYY-MM-DD')
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
                        me.cDashboard02.arrayInfoAsesorComercialNombre.push(x.cNombreMes);
                        me.cDashboard02.arrayInfoAsesorComercialCantidad.push(x.nCantidaCotizaciones);
                    });
                }

                var ctx = document.getElementById('GetCotizacioneByVendedor').getContext('2d');
                var chart = new Chart(ctx, {
                    // Tipo de Chart
                    type: 'bar',
                    // Los Datos para el Chart
                    data: {
                        labels: (this.cDashboard02.arrayCotizacionesByAsesorComercial.length > 0) ? me.cDashboard02.arrayInfoAsesorComercialNombre : '',
                        datasets: [{
                            label: "Cotizaciones por Mes de los Asesores Comerciales",
                            backgroundColor: '#3b5998',
                            borderColor: '#32506d',
                            data: (this.cDashboard02.arrayCotizacionesByAsesorComercial.length > 0) ? me.cDashboard02.arrayInfoAsesorComercialCantidad : '',
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
                        'nIdEmpresa'    :   (parseInt(sessionStorage.getItem("nIdEmpresa")) == '') ? '0' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nIdUsuario'    :   this.formLogin.nIdUsuario
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
                    me.mensajeError.push("Debe seleccionar un Asesor Comercial para Mostrar sus estadisticas");
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
                        'nIdEmpresa'    :   (parseInt(sessionStorage.getItem("nIdEmpresa")) == '') ? '0' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nIdUsuario'    :   this.cDashboard03.fillInfoUsuarioFind.nIdUsuario,
                        'dfecha'        :   moment().format('YYYY-MM-DD')
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
                me.cDashboard03.arrayInfoAsesorComercialNombre = [];
                me.cDashboard03.arrayInfoAsesorComercialCantidad = [];
                let ctx = '';
                let chart = '';

                if(me.cDashboard03.arrayDashboardAsesoresByJV.length > 0) {
                    me.cDashboard03.arrayDashboardAsesoresByJV.map(function(x) {
                        me.cDashboard03.arrayInfoAsesorComercialNombre.push(x.cNombreMes);
                        me.cDashboard03.arrayInfoAsesorComercialCantidad.push(x.nCantidaCotizaciones);
                    });
                }

                ctx = document.getElementById('arrayDashboardUserFind').getContext('2d');
                chart = new Chart(ctx, {
                    // Tipo de Chart
                    type: 'bar',
                    // Los Datos para el Chart
                    data: {
                        labels: (this.cDashboard03.arrayDashboardAsesoresByJV.length > 0) ? me.cDashboard03.arrayInfoAsesorComercialNombre : '',
                        datasets: [{
                            label: "Número de Cotizaciones por Mes",
                            backgroundColor: '#3b5998',
                            borderColor: '#32506d',
                            data: (this.cDashboard03.arrayDashboardAsesoresByJV.length > 0) ? me.cDashboard03.arrayInfoAsesorComercialCantidad : '',
                        }]
                    },
                    // Configuration options go here
                    options: {}
                });
            },
            //=================
            validarPedidoByUserFind(){
                let me = this;
                me.error = 0;
                me.mensajeError =[];

                if (!me.cDashboard03.fillPedidoInfoUsuarioFind.nIdUsuario) {
                    me.mensajeError.push("Debe seleccionar un Asesor Comercial para Mostrar sus estadisticas");
                }

                if(me.mensajeError.length){
                    me.error = 1;
                }
                return me.error;
            },
            GetPedidoByUserFind(){
                if(this.validarPedidoByUserFind()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                var url = this.ruta + '/dashboard/GetPedidosByUsuario';
                axios.get(url, {
                    params: {
                        'nIdEmpresa'    :   (parseInt(sessionStorage.getItem("nIdEmpresa")) == '') ? '0' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nIdUsuario'    :   this.cDashboard03.fillPedidoInfoUsuarioFind.nIdUsuario,
                        'dfecha'        :   moment().format('YYYY-MM-DD')
                    }
                }).then(response => {
                    this.cDashboard03.fillPedidoInfoUsuarioFind.cNombreUsuario  = '';
                    this.cDashboard03.fillPedidoInfoUsuarioFind.cNombreRol      = '';
                    this.cDashboard03.arrayDashboardPedidoAsesoresByJV          = [];

                    if(response.data.length) {
                        this.cDashboard03.fillPedidoInfoUsuarioFind.cNombreUsuario  = response.data[0].cNombreUsuario;
                        this.cDashboard03.fillPedidoInfoUsuarioFind.cNombreRol      = response.data[0].cNombreRol;
                        this.cDashboard03.arrayDashboardPedidoAsesoresByJV          = response.data;
                    }
                    this.createDashBoardPedidoByUserFind()
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
            createDashBoardPedidoByUserFind(){
                let me = this;

                //Setear Información
                me.cDashboard03.arrayInfoPedidoAsesorComercialNombre = [];
                me.cDashboard03.arrayInfoPedidoAsesorComercialCantidad = [];
                let ctx = '';
                let chart = '';

                if(me.cDashboard03.arrayDashboardPedidoAsesoresByJV.length > 0) {
                    me.cDashboard03.arrayDashboardPedidoAsesoresByJV.map(function(x) {
                        me.cDashboard03.arrayInfoPedidoAsesorComercialNombre.push(x.cNombreMes);
                        me.cDashboard03.arrayInfoPedidoAsesorComercialCantidad.push(x.nCantidaPedidos);
                    });
                }

                ctx = document.getElementById('arrayDashboardPedidoUserFind').getContext('2d');
                chart = new Chart(ctx, {
                    // Tipo de Chart
                    type: 'bar',
                    // Los Datos para el Chart
                    data: {
                        labels: (this.cDashboard03.arrayDashboardPedidoAsesoresByJV.length > 0) ? me.cDashboard03.arrayInfoPedidoAsesorComercialNombre : '',
                        datasets: [{
                            label: "Número de Pedidos por Mes",
                            backgroundColor: '#3b5998',
                            borderColor: '#32506d',
                            data: (this.cDashboard03.arrayDashboardPedidoAsesoresByJV.length > 0) ? me.cDashboard03.arrayInfoPedidoAsesorComercialCantidad : '',
                        }]
                    },
                    // Configuration options go here
                    options: {}
                });
            },
            // Dashboard 04
            GetAsesoresByAll(){
                var url = this.ruta + '/dashboard/GetAsesoresByJV';
                axios.get(url, {
                    params: {
                        'nIdEmpresa'    :   (parseInt(sessionStorage.getItem("nIdEmpresa")) == '') ? '0' : parseInt(sessionStorage.getItem("nIdEmpresa")),
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
            //=================
            validarCotizacionByUserAllFind(){
                let me = this;
                me.error = 0;
                me.mensajeError =[];

                if (!me.cDashboard04.fillInfoUsuario.nIdUsuario) {
                    me.mensajeError.push("Debe seleccionar un Asesor Comercial para Mostrar sus estadisticas de Cotizaciones");
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
                        'nIdEmpresa'    :   (parseInt(sessionStorage.getItem("nIdEmpresa")) == '') ? '0' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nIdUsuario'    :   this.cDashboard04.fillInfoUsuario.nIdUsuario,
                        'dfecha'        :   moment().format('YYYY-MM-DD')
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
                    this.createDashBoardCotizacionByUserFindAll()
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
            createDashBoardCotizacionByUserFindAll(){
                let me = this;

                //Setear Información
                me.cDashboard04.arrayInfoAsesorComercialNombre = [];
                me.cDashboard04.arrayInfoAsesorComercialCantidad = [];
                let ctx = '';
                let chart = '';

                if(me.cDashboard04.arrayDashboardAsesoresByAll.length > 0) {
                    me.cDashboard04.arrayDashboardAsesoresByAll.map(function(x) {
                        me.cDashboard04.arrayInfoAsesorComercialNombre.push(x.cNombreMes);
                        me.cDashboard04.arrayInfoAsesorComercialCantidad.push(x.nCantidaCotizaciones);
                    });
                }

                ctx = document.getElementById('arrayDashboardUserAllFind').getContext('2d');
                chart = new Chart(ctx, {
                    // Tipo de Chart
                    type: 'bar',
                    // Los Datos para el Chart
                    data: {
                        labels: (this.cDashboard04.arrayDashboardAsesoresByAll.length > 0) ? me.cDashboard04.arrayInfoAsesorComercialNombre : '',
                        datasets: [{
                            label: "Número de Cotizaciones por Mes",
                            backgroundColor: '#3b5998',
                            borderColor: '#32506d',
                            data: (this.cDashboard04.arrayDashboardAsesoresByAll.length > 0) ? me.cDashboard04.arrayInfoAsesorComercialCantidad : '',
                        }]
                    },
                    // Configuration options go here
                    options: {}
                });
            },
            //=================
            validarPedidoByUserAllFind(){
                let me = this;
                me.error = 0;
                me.mensajeError =[];

                if (!me.cDashboard04.fillPedidoInfoUsuario.nIdUsuario) {
                    me.mensajeError.push("Debe seleccionar un Asesor Comercial para Mostrar sus estadisticas de Pedidos");
                }

                if(me.mensajeError.length){
                    me.error = 1;
                }
                return me.error;
            },
            GetPedidoByUserAllFind(){
                if(this.validarPedidoByUserAllFind()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                var url = this.ruta + '/dashboard/GetPedidosByUsuario';
                axios.get(url, {
                    params: {
                        'nIdEmpresa'    :   (parseInt(sessionStorage.getItem("nIdEmpresa")) == '') ? '0' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nIdUsuario'    :   this.cDashboard04.fillPedidoInfoUsuario.nIdUsuario,
                        'dfecha'        :   moment().format('YYYY-MM-DD')
                    }
                }).then(response => {
                    this.cDashboard04.fillPedidoInfoUsuario.cNombreUsuario = '';
                    this.cDashboard04.fillPedidoInfoUsuario.cNombreRol = '';
                    this.cDashboard04.arrayDashboardPedidoAsesoresByAll = [];

                    if(response.data.length) {
                        this.cDashboard04.fillPedidoInfoUsuario.cNombreUsuario  = response.data[0].cNombreUsuario;
                        this.cDashboard04.fillPedidoInfoUsuario.cNombreRol      = response.data[0].cNombreRol;
                        this.cDashboard04.arrayDashboardPedidoAsesoresByAll     = response.data;
                    }
                    this.createDashBoardPedidoByUserFindAll()
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
            createDashBoardPedidoByUserFindAll(){
                let me = this;

                //Setear Información
                me.cDashboard04.arrayInfoAsesorPedidoComercialNombre = [];
                me.cDashboard04.arrayInfoAsesorPedidoComercialCantidad = [];
                let ctx = '';
                let chart = '';

                if(me.cDashboard04.arrayDashboardPedidoAsesoresByAll.length > 0) {
                    me.cDashboard04.arrayDashboardPedidoAsesoresByAll.map(function(x) {
                        me.cDashboard04.arrayInfoAsesorPedidoComercialNombre.push(x.cNombreMes);
                        me.cDashboard04.arrayInfoAsesorPedidoComercialCantidad.push(x.nCantidaPedidos);
                    });
                }

                ctx = document.getElementById('arrayDashboardPedidoUserAllFind').getContext('2d');
                chart = new Chart(ctx, {
                    // Tipo de Chart
                    type: 'bar',
                    // Los Datos para el Chart
                    data: {
                        labels: (this.cDashboard04.arrayDashboardPedidoAsesoresByAll.length > 0) ? me.cDashboard04.arrayInfoAsesorPedidoComercialNombre : '',
                        datasets: [{
                            label: "Número de Pedidos por Mes",
                            backgroundColor: '#3b5998',
                            borderColor: '#32506d',
                            data: (this.cDashboard04.arrayDashboardPedidoAsesoresByAll.length > 0) ? me.cDashboard04.arrayInfoAsesorPedidoComercialCantidad : '',
                        }]
                    },
                    // Configuration options go here
                    options: {}
                });
            },
            // Dashboard 05
            //=================
            GetMontoPedidoPorMes(){
                var url = this.ruta + '/dashboard/GetPedidoMontoByMes';
                axios.get(url, {
                    params: {
                        'nIdEmpresa'    :   (parseInt(sessionStorage.getItem("nIdEmpresa")) == '') ? '0' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'dfecha'        :   moment().format('YYYY-MM-DD')
                    }
                }).then(response => {
                    this.cDashboard05.arrayPedidosMontoByMes = response.data;
                    this.createDashBoardObtenerMontoPedidosPorMes()
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
            createDashBoardObtenerMontoPedidosPorMes(){
                let me=this;

                if(me.cDashboard05.arrayPedidosMontoByMes.length > 0) {
                    me.cDashboard05.arrayPedidosMontoByMes.map(function(x) {
                        me.cDashboard05.arrayPedidoMontoNombre.push(x.cNombreMes);
                        me.cDashboard05.arrayPedidoMontoMonto.push(x.fMontoDolares);
                    });
                }

                var ctx = document.getElementById('GetPedidosMontoByMes').getContext('2d');
                var chart = new Chart(ctx, {
                    // Tipo de Chart
                    type: 'bar',
                    // Los Datos para el Chart
                    data: {
                        labels: (this.cDashboard05.arrayPedidosMontoByMes.length > 0) ? me.cDashboard05.arrayPedidoMontoNombre : '',
                        datasets: [{
                            label: "Monto Total de Pedidos por Mes",
                            backgroundColor: '#3b5998',
                            borderColor: '#32506d',
                            data: (this.cDashboard05.arrayPedidosMontoByMes.length > 0) ? me.cDashboard05.arrayPedidoMontoMonto : ''
                        }]
                    },
                    // Configuration options go here
                    options: {
                        barValueSpacing: 20,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0,
                                }
                            }]
                        }
                    }
                });
            },
            //=================
            GetMontoTotalPedidos(){
                var url = this.ruta + '/dashboard/GetPedidoMontoTotal';
                axios.get(url, {
                    params: {
                        'nIdEmpresa'    :   (parseInt(sessionStorage.getItem("nIdEmpresa")) == '') ? '0' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'dfecha'        :   moment().format('YYYY-MM-DD')
                    }
                }).then(response => {
                    this.cDashboard05.fMontoTotalDolaresPedido = (response.data[0] == null) ? 0 : response.data[0].fMontoTotalDolares;
                    this.cDashboard05.fMontoTotalSolesPedido = (response.data[0] == null) ? 0 : response.data[0].fMontoTotalSoles;
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
            //=================
            GetTotalPedidos(){
                var url = this.ruta + '/dashboard/GetPedidoCantidadTotal';
                axios.get(url, {
                    params: {
                        'nIdEmpresa'    :   (parseInt(sessionStorage.getItem("nIdEmpresa")) == '') ? '0' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'dfecha'        :   moment().format('YYYY-MM-DD')
                    }
                }).then(response => {
                    this.cDashboard05.nCantidadTotalPedido = (response.data[0].nCantidadTotalPedido == null) ? 0 : response.data[0].nCantidadTotalPedido;
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
            //=================
            GetMisPedidos(){
                var url = this.ruta + '/dashboard/GetPedidosByUsuario';
                axios.get(url, {
                    params: {
                        'nIdEmpresa'    :   (parseInt(sessionStorage.getItem("nIdEmpresa")) == '') ? '0' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nIdUsuario'    :   this.formLogin.nIdUsuario,
                        'dfecha'        :   moment().format('YYYY-MM-DD')
                    }
                }).then(response => {
                    this.cDashboard05.arrayMisPedidos = response.data;
                    this.createDashBoardObtenerMisPedidos()
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
            createDashBoardObtenerMisPedidos(){
                let me=this;

                if (me.cDashboard05.arrayMisPedidos.length > 0) {
                    me.cDashboard05.arrayMisPedidos.map(function(x) {
                        me.cDashboard05.arrayInfoMisPedidosNombre.push(x.cNombreMes);
                        me.cDashboard05.arrayInfoMisPedidosCantidad.push(x.nCantidaPedidos);
                    });
                }

                var ctx = document.getElementById('GetMisPedido').getContext('2d');
                var chart = new Chart(ctx, {
                    // Tipo de Chart
                    type: 'bar',
                    // Los Datos para el Chart
                    data: {
                        labels: (this.cDashboard05.arrayMisPedidos.length > 0) ? me.cDashboard05.arrayInfoMisPedidosNombre : '',
                        datasets: [{
                            label: "Mis Pedidos por Mes",
                            backgroundColor: '#3b5998',
                            borderColor: '#32506d',
                            data: (this.cDashboard05.arrayMisPedidos.length > 0) ? me.cDashboard05.arrayInfoMisPedidosCantidad : '',
                        }]
                    },
                    // Configuration options go here
                    options: {}
                });
            },
            //=================
            GetPedidosPorAsesorComercial(){
                var url = this.ruta + '/dashboard/GetPedidosByRol';
                axios.get(url, {
                    params: {
                        'nIdEmpresa'    :   (parseInt(sessionStorage.getItem("nIdEmpresa")) == '') ? '0' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nIdRol'        :   '110026',
                        'dfecha'        :   moment().format('YYYY-MM-DD')
                    }
                }).then(response => {
                    this.cDashboard05.arrayPedidosByAsesorComercial = response.data;
                    this.createDashBoardObtenerPedidosPorAsesorVentas()
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
            createDashBoardObtenerPedidosPorAsesorVentas(){
                let me=this;

                if(me.cDashboard05.arrayPedidosByAsesorComercial.length > 0) {
                    me.cDashboard05.arrayPedidosByAsesorComercial.map(function(x) {
                        me.cDashboard05.arrayInfoAsesorComercialNombre.push(x.cNombreMes);
                        me.cDashboard05.arrayInfoAsesorComercialCantidad.push(x.nCantidaPedidos);
                        me.cDashboard05.arraInfoAsesorComercialMonto.push(x.fMontoDolares);
                    });
                }

                var ctx = document.getElementById('GetPedidosByVendedor').getContext('2d');
                /*
                var data = {
                    labels: (this.cDashboard05.arrayPedidosByAsesorComercial.length > 0) ? me.cDashboard05.arrayInfoAsesorComercialNombre : '',
                    datasets: [
                        {
                            label: "Cantidad",
                            backgroundColor: "#3b5998",
                            data: (this.cDashboard05.arrayPedidosByAsesorComercial.length > 0) ? me.cDashboard05.arrayInfoAsesorComercialCantidad : ''
                        },
                        {
                            label: "Monto",
                            backgroundColor: "#32506d",
                            data: (this.cDashboard05.arrayPedidosByAsesorComercial.length > 0) ? me.cDashboard05.arraInfoAsesorComercialMonto : ''
                        }
                    ]
                };*/
                var chart = new Chart(ctx, {
                    // Tipo de Chart
                    type: 'bar',
                    // Los Datos para el Chart
                    data: {
                        labels: (this.cDashboard05.arrayPedidosByAsesorComercial.length > 0) ? me.cDashboard05.arrayInfoAsesorComercialNombre : '',
                        datasets: [{
                            label: "Pedidos por Mes de los Asesores Comerciales",
                            backgroundColor: '#3b5998',
                            borderColor: '#32506d',
                            data: (this.cDashboard05.arrayPedidosByAsesorComercial.length > 0) ? me.cDashboard05.arrayInfoAsesorComercialCantidad : ''
                        }]
                    },
                    // Configuration options go here
                    options: {
                        barValueSpacing: 20,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0,
                                }
                            }]
                        }
                    }
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
    .no-padding-bottom{
        margin: .8rem !important;
    }
</style>
