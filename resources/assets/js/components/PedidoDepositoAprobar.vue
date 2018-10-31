<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">APROBACIÓN DE DEPÓSITOS</h2>
                </div>
            </header>

            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Tab1" href="#TabBuscaPedido" @click="tabBuscarPedido" role="tab" data-toggle="tab">
                                            <i class="fa fa-search"></i> PEDIDOS
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="Tab2" href="#TabDistribucionDeposito" @click="tabDistribucionDeposito" role="tab" data-toggle="tab">
                                            <i class="fa fa-usd"></i> DISTRIBUCIÓN
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane fade in active show" id="TabBuscaPedido">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">BUSCAR PEDIDOS</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Empresa</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="cempresa" class="form-control form-control-sm" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Sucursal</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="csucursal" class="form-control form-control-sm" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Fecha Inicio</label>
                                                                            <div class="col-sm-8">
                                                                                <el-date-picker
                                                                                    v-model="fillPedido.dfechainicio"
                                                                                    type="date"
                                                                                    value-format="yyyy-MM-dd"
                                                                                    format="dd/MM/yyyy"
                                                                                    placeholder="dd/mm/aaaa">
                                                                                </el-date-picker>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Fecha Fin</label>
                                                                            <div class="col-sm-8">
                                                                                <el-date-picker
                                                                                    v-model="fillPedido.dfechafin"
                                                                                    type="date"
                                                                                    value-format="yyyy-MM-dd"
                                                                                    format="dd/MM/yyyy"
                                                                                    placeholder="dd/mm/aaaa">
                                                                                </el-date-picker>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Nº Orden Pedido</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillPedido.cnumeropedido" @keyup.enter="buscarPedidos" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Nro Vin</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillPedido.cnumerovin" @keyup.enter="buscarPedidos" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Marca</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="fillPedido.nidmarca" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboModelos">
                                                                                    <el-option
                                                                                        v-for="item in arrayMarca"
                                                                                        :key="item.nIdPar"
                                                                                        :label="item.cParNombre"
                                                                                        :value="item.nIdPar">
                                                                                    </el-option>
                                                                                </el-select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Modelo</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="fillPedido.nidmodelo" filterable clearable placeholder="SELECCIONE">
                                                                                    <el-option
                                                                                        v-for="item in arrayModelo"
                                                                                        :key="item.nIdPar"
                                                                                        :label="item.cParNombre"
                                                                                        :value="item.nIdPar">
                                                                                    </el-option>
                                                                                </el-select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Estado Pedido</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="fillPedido.nidestadopedido" filterable clearable placeholder="SELECCIONE">
                                                                                    <el-option
                                                                                        v-for="item in arrayEstadoPedido"
                                                                                        :key="item.nIdPar"
                                                                                        :label="item.cParNombre"
                                                                                        :value="item.nIdPar">
                                                                                    </el-option>
                                                                                </el-select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-9 offset-sm-5">
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarPedidosConDepositos">
                                                                            <i class="fa fa-search"></i> Buscar
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">LISTADO</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <template v-if="arrayPedido.length">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Acciones</th>
                                                                                <th>Nro Pedido</th>
                                                                                <th>Vendedor</th>
                                                                                <th>Contacto</th>
                                                                                <th>Vehiculo</th>
                                                                                <th>Número VIN</th>
                                                                                <th>Número DUA</th>
                                                                                <th>Fecha Pedido</th>
                                                                                <th>Aprobación</th>
                                                                                <th>Estado Pedido</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="pedido in arrayPedido" :key="pedido.nIdCabeceraPedido">
                                                                                <td>
                                                                                    <template v-if="pedido.cFlagEstadoAprobacion == 'A'">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Seleccionar Pedido {{ pedido.cNumeroPedido }}</div>
                                                                                            <i @click="distribuirDeposito(pedido)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                                        </el-tooltip>
                                                                                    </template>
                                                                                </td>
                                                                                <td v-text="pedido.cNumeroPedido"></td>
                                                                                <td v-text="pedido.cVendedorNombre"></td>
                                                                                <td v-text="pedido.cContacto"></td>
                                                                                <td v-text="pedido.cNombreComercial + ' ' + pedido.nAnioFabricacion + '-' + pedido.nAnioModelo"></td>
                                                                                <td v-text="pedido.cNumeroVin"></td>
                                                                                <td v-text="pedido.cNumeroDUA"></td>
                                                                                <td v-text="pedido.dFechaPedido"></td>
                                                                                <td v-text="pedido.cEstadoAprobacion"></td>
                                                                                <td v-text="pedido.cEstadoPedido"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="row">
                                                                        <div class="col-lg-7">
                                                                            <nav>
                                                                                <ul class="pagination">
                                                                                    <li v-if="pagination.current_page > 1" class="page-item">
                                                                                        <a @click.prevent="cambiarPagina(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                    </li>
                                                                                    <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                    :class="[page==isActived?'active':'']">
                                                                                        <a class="page-link"
                                                                                        href="#" @click.prevent="cambiarPagina(page)"
                                                                                        v-text="page"></a>
                                                                                    </li>
                                                                                    <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                        <a @click.prevent="cambiarPagina(pagination.current_page+1)" class="page-link" href="#">Sig</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </nav>
                                                                        </div>
                                                                        <div class="col-lg-5">
                                                                            <div class="datatable-info">Mostrando {{ pagination.from }} a {{ pagination.to }} de {{ pagination.total }} registros</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </template>
                                                            <template v-else>
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td colspan="10">No existen registros!</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </template>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="tab-pane fade" id="TabDistribucionDeposito">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <vs-divider border-style="solid" color="dark">
                                                            {{ formDistribuirDeposito.cnombrecontacto }} - {{ formDistribuirDeposito.cNumeroPedido }}
                                                        </vs-divider>
                                                        <vs-divider border-style="solid" color="dark"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <template v-if="arrayDepositosPorPedido.length">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ACCIÓN</th>
                                                                        <th>BANCO</th>
                                                                        <th>N° OPERACIÓN</th>
                                                                        <th>MONEDA</th>
                                                                        <th>FECHA</th>
                                                                        <th>TTPO CAMBIO</th>
                                                                        <th>MONTO S/</th>
                                                                        <th>MONTO USD/</th>
                                                                        <th>TCE</th>
                                                                        <th>TIPO</th>
                                                                        <th>ESTADO</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="depositos in arrayDepositosPorPedido" :key="depositos.nIdDepositoPedido">
                                                                        <td>
                                                                            <template>
                                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                    <div slot="content">Aprobar Deposito {{ depositos.cNumeroPedido }}</div>
                                                                                    <i @click="aprobarDeposito(depositos)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                                </el-tooltip>
                                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                    <div slot="content">Desaprobar Deposito {{ depositos.cNumeroPedido }}</div>
                                                                                    <i @click="aprobarDeposito(depositos)" :style="'color:red'" class="fa-md fa fa-trash"></i>
                                                                                </el-tooltip>
                                                                            </template>
                                                                        </td>
                                                                        <td v-text="depositos.cNombreBanco"></td>
                                                                        <td v-text="depositos.nNumeroOperacion"></td>
                                                                        <td v-text="depositos.cNombreMoneda"></td>
                                                                        <td v-text="depositos.dFechaDeposito"></td>
                                                                        <td v-text="depositos.fTipoCambioComercial"></td>
                                                                        <td v-text="Number((parseFloat(depositos.fMontoSoles)).toFixed(2))"></td>
                                                                        <td v-text="Number((parseFloat(depositos.fMontoDolares)).toFixed(2))"></td>
                                                                        <td v-text="depositos.cFlagTipoCambioEspecial"></td>
                                                                        <td v-text="depositos.cFlagExcedente"></td>
                                                                        <td v-text="depositos.cEstadoDeposito"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </template>
                                                    <template v-else>
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="10">No existen registros!</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </template>
                                                </div>
                                                <vs-divider border-style="solid" color="dark"/>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </transition>
</template>

<script>
    export default {
        props:['ruta'],
        data(){
            return {
                cempresa: 'SAISAC',
                csucursal: sessionStorage.getItem("cNombreSucursal"),
                nidempresa: 1300011,
                nidsucursal: sessionStorage.getItem("nIdSucursal"),
                canio: '2018',
                cmes: 'MAYO',
                // ======================================================
                // =========== VARIABLES TAB BUSCAR PEDIDO ==============
                fillPedido:{
                    dfechainicio: '',
                    dfechafin: '',
                    cnumeropedido: '',
                    cnumerovin: '',
                    nidmarca: '',
                    nidmodelo: '',
                    nidestadopedido: ''
                },
                arrayPedido: [],
                arrayEstadoPedido: [],
                arrayMarca: [],
                arrayModelo: [],
                // ======================================================
                // =========== VARIABLES TAB DISTRUBUIR DEPOSITOS ==============
                formDistribuirDeposito: {
                    nidcabecerapedido: 0,
                    cNumeroPedido: '',
                    cnombrecontacto: ''
                },
                arrayDepositosPorPedido: [],
                // =============================================================
                // VARIABLES GENÉRICAS
                // =============================================================
                loading: false,
                flagBuscarContacto: 0,
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
                accionmodal: 0,
                tituloModal:'',
                error: 0,
                errors: [],
                mensajeError: []
            }
        },
        mounted(){
            this.tabBuscarPedido();
            this.llenarComboMarcas();
            this.llenarComboModelos();
            this.llenarEstadoPedido();
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }

                var from = this.pagination.current_page - this.offset;
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 3);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            },
            isActivedModal: function(){
                return this.paginationModal.current_page;
            },
            pagesNumberModal: function() {
                if(!this.paginationModal.to) {
                    return [];
                }

                var from = this.paginationModal.current_page - this.offset;
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.paginationModal.last_page){
                    to = this.paginationModal.last_page;
                }

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods:{
            // =================================================================
            // METODOS TAB PEDIDOS CON DEPOSITO
            // =================================================================
            tabBuscarPedido(){
                $('#Tab1').removeClass('nav-link ');
                $('#Tab1').addClass("nav-link active");
                $('#Tab2').removeClass('nav-link active');
                $('#Tab2').addClass("nav-link disabled");
                $('#TabBuscaPedido').addClass('in active show');
                $('#TabDistribucionDeposito').removeClass('in active show');
                this.limpiarFormulario();
            },
            llenarEstadoPedido(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';

                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110063
                    }
                }).then(response => {
                    this.arrayEstadoPedido = response.data;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            llenarComboMarcas(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';

                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110032
                    }
                }).then(response => {
                    this.arrayMarca = response.data;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            llenarComboModelos(){
                var url = this.ruta + '/versionvehiculo/GetModeloByMarca';

                axios.get(url,{
                    params: {
                        'nidmarca' : this.fillPedido.nidmarca
                    }
                }).then(response => {
                    this.arrayModelo = response.data;
                    this.fillPedido.nidmodelo = '';
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            buscarPedidosConDepositos(){
                this.listarPedidosConDepositos(1);
            },
            listarPedidosConDepositos(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/deposito/GetListPedidoConDeposito';
                axios.get(url, {
                    params: {
                        'nidempresa': this.nidempresa,
                        'nidsucursal': this.nidsucursal,
                        'dfechainicio': this.fillPedido.dfechainicio,
                        'dfechafin': this.fillPedido.dfechafin,
                        'cnumeropedido': this.fillPedido.cnumeropedido,
                        'cnumerovin': this.fillPedido.cnumerovin,
                        'nidmarca': this.fillPedido.nidmarca,
                        'nidmodelo': this.fillPedido.nidmodelo,
                        'nidestadopedido': this.fillPedido.nidestadopedido,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayPedido                = response.data.arrayPedido.data;
                    this.pagination.current_page    = response.data.arrayPedido.current_page;
                    this.pagination.total           = response.data.arrayPedido.total;
                    this.pagination.per_page        = response.data.arrayPedido.per_page;
                    this.pagination.last_page       = response.data.arrayPedido.last_page;
                    this.pagination.from            = response.data.arrayPedido.from;
                    this.pagination.to              = response.data.arrayPedido.to;
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarPedidosConDepositos(page);
            },
            // =================================================================
            // METODOS TAB DISTRIBUCIÓN DE LOS DEPOSITOS
            // =================================================================
            distribuirDeposito(pedido){
                this.tabDistribucionDeposito();//Limpiar Formulario del TAB

                $('#Tab1').removeClass('nav-link active');
                $('#Tab1').addClass("nav-link");
                $('#Tab2').removeClass('nav-link disabled');
                $('#Tab2').addClass("nav-link active");
                $('#TabBuscaPedido').removeClass('in active show');
                $('#TabDistribucionDeposito').addClass('in active show');

                this.llenarDepositos(pedido);
            },
            tabDistribucionDeposito(){
                this.arrayDepositosPorPedido = [];
            },
            llenarDepositos(pedido){
                this.mostrarProgressBar();

                this.formDistribuirDeposito.nidcabecerapedido = pedido.nIdCabeceraPedido;
                this.formDistribuirDeposito.cNumeroPedido = pedido.cNumeroPedido;
                this.formDistribuirDeposito.cnombrecontacto = pedido.cContacto;

                var url = this.ruta + '/deposito/GetListDepositosPorPedido';
                axios.get(url, {
                    params: {
                        'nIdCabeceraPedido': pedido.nIdCabeceraPedido
                    }
                }).then(response => {
                    this.arrayDepositosPorPedido  = response.data;
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            // =================================================================
            // METODOS GENERICOS
            // =================================================================
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "vehiculo":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.listarVehiculo(1);
                                this.accionmodal=2;
                                this.modal = 1;
                                break;
                            }
                        }
                    }
                }
            },
            //Limpiar Paginación
            limpiarPaginacion(){
                this.pagination.current_page =  0,
                this.pagination.total = 0,
                this.pagination.per_page = 0,
                this.pagination.last_page = 0,
                this.pagination.from  = 0,
                this.pagination.to = 0
            },
            limpiarPaginacionModal(){
                this.paginationModal.current_page =  0,
                this.paginationModal.total = 0,
                this.paginationModal.per_page = 0,
                this.paginationModal.last_page = 0,
                this.paginationModal.from  = 0,
                this.paginationModal.to = 0
            },
            //Cerrar Modal
            cerrarModal(){
                this.modal = 0;
                this.accionmodal = 0;
                this.error = 0;
                this.mensajeError = '';
                this.limpiarPaginacion();
                this.limpiarPaginacionModal();
            },
            cerrarModalSolicitud(){
                this.modal = 0;
                this.accionmodal = 0;
                this.error = 0;
                this.mensajeError = '';
                this.arrayArchivosAdjuntos = [];
            },
            limpiarFormulario(){
                this.fillPedido.dfechainicio = '';
                this.fillPedido.dfechafin = '';
                this.fillPedido.cnumeropedido = '';
                this.fillPedido.cnumerovin = '';
                this.fillPedido.nidmarca = '';
                this.fillPedido.nidmodelo = '';
                this.fillPedido.nidestadopedido = '';
                this.arrayPedido = [];
            },
            mostrarProgressBar(){
                $("#myBar").show();
                progress();
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
</style>


