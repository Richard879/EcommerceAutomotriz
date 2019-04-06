<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <vs-divider color="dark">
                        <h2 class="no-margin-bottom">MODULO AGINACIÓN VENDEDOR A CUOTA</h2>
                    </vs-divider>
                </div>
            </header>

            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h4">ASIGNAR CUOTA VENDEDOR</h3>
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
                                                <label class="col-sm-4 form-control-label">* Año</label>
                                                <div class="col-sm-8">
                                                    <label v-text="fillAsigVendedorCuota.canio" class="form-control-label-readonly"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Mes</label>
                                                <div class="col-sm-8">
                                                    <label v-text="fillAsigVendedorCuota.cmes" class="form-control-label-readonly"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Jefe de ventas</label>
                                                <div class="col-sm-8">
                                                    <label v-text="fillAsigVendedorCuota.cnombrejefeventa" class="form-control-label-readonly"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" v-model="fillAsigVendedorCuota.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
                                                        <div class="input-group-prepend">
                                                            <button type="button" title="Buscar Proveedor" class="btn btn-info btn-corner btn-sm" @click="abrirModal('proveedor','buscar')">
                                                                <i class="fa-lg fa fa-search"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Linea</label>
                                                <div class="col-sm-8">
                                                    <el-select v-model="fillAsigVendedorCuota.nidlinea"
                                                                        filterable
                                                                        placeholder="SELECCIONE" v-on:change="llenarComboSubLinea()">
                                                        <el-option
                                                            v-for="item in arrayLinea"
                                                            :key="item.nIdLinea"
                                                            :label="item.cLineaNombre"
                                                            :value="item.nIdLinea">
                                                        </el-option>
                                                    </el-select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label class="col-md-4 form-control-label">SubLinea</label>
                                                <div class="col-md-8">
                                                    <el-select v-model="fillAsigVendedorCuota.nidsublinea" filterable clearable placeholder="SELECCIONE">
                                                        <el-option
                                                        v-for="sublinea in arraySubLinea"
                                                            :key="sublinea.nIdSubLinea"
                                                            :label="sublinea.cSubLineaNombre"
                                                            :value="sublinea.nIdSubLinea">
                                                        </el-option>
                                                    </el-select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-9 offset-sm-5">
                                            <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarVendedoresAsignadosJV(1)">
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
                                <h3 class="h4">DETALLE</h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal">
                                    <template v-if="arrayFlagVendedoresByIdJV.length">
                                        <div class="table-responsive">
                                            <vs-table max-items="10" pagination :data="arrayFlagVendedoresByIdJV" notSpacer>
                                                <template slot="thead">
                                                    <vs-th>Proveedor</vs-th>
                                                    <vs-th>Linea</vs-th>
                                                    <vs-th>SubLinea</vs-th>
                                                    <vs-th>Vendedor</vs-th>
                                                    <vs-th>N° Cuota</vs-th>
                                                </template>

                                                <template slot-scope="{data}">
                                                    <vs-tr :key="indextr" v-for="(tr, indextr) in data" >
                                                        <vs-td :data="data[indextr].cNombreProveedor">
                                                            {{data[indextr].cNombreProveedor}}
                                                        </vs-td>
                                                        <vs-td :data="data[indextr].cNombreLinea">
                                                            {{data[indextr].cNombreLinea}}
                                                        </vs-td>
                                                        <vs-td :data="data[indextr].cNombreSubLinea">
                                                            {{data[indextr].cNombreSubLinea}}
                                                        </vs-td>
                                                        <vs-td :data="data[indextr].cNombreVendedor">
                                                            {{data[indextr].cNombreVendedor}}
                                                        </vs-td>
                                                        <vs-td :data="data[indextr].cNroCuota">
                                                            <vs-input-number min="1" v-model="data[indextr].cNroCuota"/>
                                                        </vs-td>
                                                    </vs-tr>
                                                </template>
                                            </vs-table>
                                            <!--
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Proveedor</th>
                                                        <th>Linea</th>
                                                        <th>Marca</th>
                                                        <th>Modelo</th>
                                                        <th>Vendedor</th>
                                                        <th>N° Cuota</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="vendedor in arrayFlagVendedoresByIdJV" :key="vendedor.cParNombre">
                                                        <td v-text="vendedor.cNombreProveedor"></td>
                                                        <td v-text="vendedor.cNombreLinea"></td>
                                                        <td v-text="vendedor.cNombreSubLinea"></td>
                                                        <td v-text="vendedor.cNombreModelo"></td>
                                                        <td v-text="vendedor.cNombreVendedor"></td>
                                                        <td><vs-input-number min="1" v-model="vendedor.cNroCuota"/></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            -->
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <div class="col-md-9 offset-md-5">
                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarVendedorCuota">
                                                    <i class="fa fa-save"></i> Registrar
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- MODAL SHOW ERRORS -->
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

            <!-- MODAL PROVEEDOR -->
            <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form v-on:submit.prevent class="form-horizontal">
                                <div class="container-fluid">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">LISTADO</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Nombre</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <input type="text" v-model="fillProveedor.cnombreproveedor" @keyup.enter="buscaProveedores" class="form-control form-control-sm">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" title="Buscar Vehículos" class="btn btn-info btn-corner btn-sm" @click="buscaProveedores">
                                                                            <i class="fa-lg fa fa-search"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>
                                            <template v-if="arrayProveedor.length">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Seleccione</th>
                                                                <th>Nombre Proveedor</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="proveedor in arrayProveedor" :key="proveedor.nIdPar">
                                                                <td>
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Seleccionar {{ proveedor.cParNombre }}</div>
                                                                        <i @click="asignarProveedor(proveedor.nIdPar, proveedor.cParNombre)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                    </el-tooltip>
                                                                </td>
                                                                <td v-text="proveedor.cParNombre"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-7">
                                                            <nav>
                                                                <ul class="pagination">
                                                                    <li v-if="paginationModal.current_page > 1" class="page-item">
                                                                        <a @click.prevent="cambiarPaginaProveedor(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                    </li>
                                                                    <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                    :class="[page==isActivedModal?'active':'']">
                                                                        <a class="page-link"
                                                                        href="#" @click.prevent="cambiarPaginaProveedor(page)"
                                                                        v-text="page"></a>
                                                                    </li>
                                                                    <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                        <a @click.prevent="cambiarPaginaProveedor(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
                                                                    </li>
                                                                </ul>
                                                            </nav>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <div class="datatable-info">Mostrando {{ paginationModal.from }} a {{ paginationModal.to }} de {{ paginationModal.total }} registros</div>
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
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </transition>
</template>

<script>
    export default {
        props:['ruta', 'usuario'],
        data:()=>({
                cempresa: sessionStorage.getItem("cNombreEmpresa"),
                csucursal: sessionStorage.getItem("cNombreSucursal"),
                fillAsigVendedorCuota:{
                    nidcronograma: '',
                    canio: '',
                    cmes: '',
                    nidjefeventa: 0,
                    cnombrejefeventa: 'NO ES JEFE DE VENTAS',
                    nidlinea: '',
                    nidsublinea: '',
                    nidproveedor: '',
                    cproveedornombre: ''
                },
                arrayProveedor: [],
                fillProveedor:{
                    nidproveedor: '',
                    cproveedornombre: ''
                },
                arrayLinea: [],
                arraySubLinea: [],
                arrayVendedoresByIdJV: [],
                arrayFlagVendedoresByIdJV: [],
                // =============================================================
                // VARIABLES GENÉRICAS
                // =============================================================
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
                tituloFormulario: '',
                error: 0,
                errors: [],
                mensajeError: []
        }),
        mounted(){
            this.llenarCompraActiva();
            this.informacionUsuario();
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

                var to = from + (this.offset * 2);
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
            llenarCompraActiva(){
                var url = this.ruta + '/objComercial/getCompraActiva';
                axios.get(url).then(response => {
                    this.fillAsigVendedorCuota.canio = response.data[0].cAnio;
                    this.fillAsigVendedorCuota.cmes = response.data[0].cMes;
                    this.fillAsigVendedorCuota.nidcronograma = response.data[0].nIdCronograma;
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
            informacionUsuario(){
                var url = this.ruta + '/parametro/GetParametroById';
                axios.get(url, {
                    params: {
                        'nidpar' : this.usuario.id,
                        'nidgrupopar': 110025
                    }
                }).then(response => {
                    this.fillAsigVendedorCuota.nidjefeventa     = response.data[0].nIdPar;
                    this.fillAsigVendedorCuota.cnombrejefeventa = response.data[0].cParNombre;
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
            // =======================
            // MODAL PROVEEDOR
            // =======================
            buscaProveedores(){
                this.listarProveedores(1);
            },
            listarProveedores(page){
                var url = this.ruta + '/parametro/GetLstProveedor';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidgrupopar' : 110023,
                        'cnombreproveedor' : this.fillProveedor.cproveedornombre.toString(),
                        'opcion' : 0,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayProveedor = response.data.arrayProveedor.data;
                    this.paginationModal.current_page   =  response.data.arrayProveedor.current_page;
                    this.paginationModal.total          = response.data.arrayProveedor.total;
                    this.paginationModal.per_page       = response.data.arrayProveedor.per_page;
                    this.paginationModal.last_page      = response.data.arrayProveedor.last_page;
                    this.paginationModal.from           = response.data.arrayProveedor.from;
                    this.paginationModal.to             = response.data.arrayProveedor.to;
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
            cambiarPaginaProveedor(page){
                this.paginationModal.current_page=page;
                this.listarProveedores(page);
            },
            asignarProveedor(nProveedorId, cProveedorNombre){
                this.fillAsigVendedorCuota.nidproveedor = nProveedorId;
                this.fillAsigVendedorCuota.cproveedornombre = cProveedorNombre;
                this.cerrarModal();
                this.llenarComboLinea();
            },
            llenarComboLinea(){
                var url = this.ruta + '/versionvehiculo/GetLineasByProveedor';
                axios.get(url, {
                    params: {
                        'nidempresa': sessionStorage.getItem("nIdEmpresa"),
                        'nidproveedor' : this.fillAsigVendedorCuota.nidproveedor,
                        'opcion': 1
                    }
                }).then(response => {
                    this.arrayLinea = response.data.arrayLinea;
                    this.fillAsigVendedorCuota.nidlinea = '';
                    this.llenarComboSubLinea();
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
            llenarComboSubLinea(){
                var url = this.ruta + '/versionvehiculo/GetSubLineaByLinea';

                axios.get(url, {
                    params: {
                        'nidlinea': this.fillAsigVendedorCuota.nidlinea,
                        'opcion': 1
                    }
                }).then(response => {
                    this.arraySubLinea = response.data.arraySubLinea;
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
            buscarVendedoresAsignadosJV(page){
                if(this.validarBuscarVendedoresByJV()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                var url = this.ruta + '/asignacuota/GetLstVendedorSubLineaCuota';
                axios.get(url, {
                    params: {
                        'nidempresa'    : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'   : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidcronograma' : this.fillAsigVendedorCuota.nidcronograma,
                        'nidproveedor'  : this.fillAsigVendedorCuota.nidproveedor,
                        'nidlinea'      : this.fillAsigVendedorCuota.nidlinea,
                        'nidsublinea'   : this.fillAsigVendedorCuota.nidsublinea,
                        'nidjefeventas' : this.fillAsigVendedorCuota.nidjefeventa,
                        'page' : page
                    }
                }).then(response => {
                    let info = response.data.arrayVendedorCuota.data;
                    //Data
                    this.arrayVendedoresByIdJV = info;
                    this.llenarArrayVendedoresByIdJV();
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
            validarBuscarVendedoresByJV(){
                this.error = 0;
                this.mensajeError =[];

                if(this.fillAsigVendedorCuota.nidjefeventa == 0){
                    this.mensajeError.push('Debe ser Jefe de Ventas para realizar la busqueda');
                }
                if(this.fillAsigVendedorCuota.nidproveedor == 0 && !this.fillAsigVendedorCuota.cproveedornombre){
                    this.mensajeError.push('Debe seleccionar un proveedor');
                }
                if(this.fillAsigVendedorCuota.nidlinea == ''){
                    this.mensajeError.push('Debe seleccionar una Línea');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            llenarArrayVendedoresByIdJV(){
                let me = this;

                me.arrayFlagVendedoresByIdJV = [];//Setear Array

                me.arrayVendedoresByIdJV.map(function(value, key){
                    me.arrayFlagVendedoresByIdJV.push({
                        nIdAsignacionVendedorSubLinea : value.nIdAsignacionVendedorSubLinea,
                        cNombreProveedor            : value.cNombreProveedor,
                        cNombreLinea                : value.cNombreLinea,
                        cNombreSubLinea             : value.cNombreSubLinea,
                        cNombreVendedor             : value.cNombreVendedor,
                        cNroCuota                   : (value.cNroCuota == null) ? 0 :  value.cNroCuota
                    });
                });
            },
            registrarVendedorCuota(){
                if(this.validarRegistrarVendedorCuota()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/asignacuota/SetRegistraAsignacionCuota';
                axios.post(url, {
                    'nidempresa'             : parseInt(sessionStorage.getItem("nIdEmpresa")),
                    'nidsucursal'             : parseInt(sessionStorage.getItem("nIdSucursal")),
                    'nidcronograma'             : this.fillAsigVendedorCuota.nidcronograma,
                    'arrayFlagVendedoresByIdJV' :   this.arrayFlagVendedoresByIdJV
                }).then(response => {
                    swal('Se realizo correctamente la Asignación Vendedor Cuota');
                    this.buscarVendedoresAsignadosJV(1);
                }).catch(error => {
                    this.errors = error
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            validarRegistrarVendedorCuota(){
                this.error = 0;
                this.mensajeError =[];

                this.arrayFlagVendedoresByIdJV.map(function (x) {
                    if(x.cNroCuota < 0){
                        this.mensajeError.push('No se permiten número cuotas menores a 0');
                    }
                });

                if(this.arrayFlagVendedoresByIdJV.length == 0){
                    this.mensajeError.push('No se han encontrado Vendedores asignados');
                }
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // =================================================================
            // METODOS GENERICOS
            // =================================================================
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "proveedor":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=2;
                                this.modal = 1;
                                this.listarProveedores(1);
                                break;
                            }
                        }
                    }
                    break;
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
            limpiarProveedor(){
              this.fillProveedor.nidproveedor = 0;
              this.fillProveedor.cproveedornombre = '';
            },
            //Cerrar Modal
            cerrarModal(){
                this.modal = 0;
                this.accionmodal = 0;
                this.error = 0;
                this.mensajeError = '';
                this.limpiarPaginacion();
                this.limpiarPaginacionModal();
                //Modal Buscar Proveedores
                this.arrayProveedor = [];
            },
        }
    }
</script>

<style>
    .col {
        width: inherit !important;
    }
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
        text-align: center;
        margin: auto;
    }
    .barraLateral{
        height: 45vh;
        max-width:1200px;
        overflow-x: auto;
        overflow-y: auto;
    }
</style>
