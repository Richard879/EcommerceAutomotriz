<template>
     <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <vs-divider color="dark">
                        <h2 class="no-margin-bottom">MODULO COMPRA</h2>
                    </vs-divider>
                </div>
            </header>

            <section>
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#TabBuscaProyecto" @click="tabBuscarProyecto()" role="tab" data-toggle="tab">
                                            <i class="fa fa-search"></i> BUSCAR PROYECTO
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#TabGeneraProyecto" @click="tabGenerarProyecto()" role="tab" data-toggle="tab">
                                            <i class="fa fa-bus"></i> GENERAR PROYECTO
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane fade in active show" id="TabBuscaProyecto">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">BUSCAR PROYECTOS</h3>
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
                                                                            <label class="col-sm-4 form-control-label">Nro Vin</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillCompra.cnumerovin" @keyup.enter="listarProyectos(1)" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Fecha Inicio</label>
                                                                            <div class="col-sm-8">
                                                                                <el-date-picker
                                                                                    v-model="fillCompra.dfechainicio"
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
                                                                            <label class="col-sm-4 form-control-label">* Fecha Fin</label>
                                                                            <div class="col-sm-8">
                                                                                <el-date-picker
                                                                                    v-model="fillCompra.dfechafin"
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
                                                                    <div class="col-sm-9 offset-sm-5">
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarProyectos(1)">
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
                                                            <template v-if="arrayProyecto.length">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Acciones</th>
                                                                                <th>Nro Vin</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="proyecto in arrayProyecto" :key="proyecto.cNumeroVin">
                                                                                <td>
                                                                                    <template v-if="proyecto.nValidaIntegracion==0">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">{{ proyecto.cFlagVistaIntegracion + ' ' + proyecto.cNumeroVin }}</div>
                                                                                            <i @click="validarSapArticulo(proyecto)" :style="'color:green'" class="fa-spin fa-md fa fa-cube"></i>
                                                                                        </el-tooltip>&nbsp;&nbsp;
                                                                                    </template>
                                                                                </td>
                                                                                <td v-text="proyecto.cNumeroVin"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-7">
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
                                                                        <div class="col-sm-5">
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
                                    <div role="tabpanel" class="tab-pane fade" id="TabGeneraProyecto">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">GENERAR PROYECTO</h3>
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
                                                            <div class="col-lg-12">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-8">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Descargar Formato</label>
                                                                            <div class="col-sm-8">
                                                                                <a href="#" @click="descargaFormatoCompra">
                                                                                    <i class="fa-md fa fa-file-excel-o"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-8">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Ordenes de Compra</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="file" id="file-upload" @change="getFile" accept=".xls,.xlsx" class="form-control form-control-sm"/>
                                                                                <!--<label for="file-upload" class="btn btn-warning btn-corner btn-sm">
                                                                                    <i class="fa fa-file-excel-o"></i> Seleccionar Archivo
                                                                                </label>-->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="row">
                                                                            <!--<input type="text" v-model="textFile" class="col-sm-6 form-control form-control-sm" readonly>
                                                                            <div class="col-sm-6">-->
                                                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="importFileProyecto()">
                                                                                    <i class="fa fa-retweet"></i> Procesar
                                                                                </button>
                                                                            <!--</div>-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <template v-if="arrayExcel.length">
                                                                    <div class="table-responsive border" style="max-height: 300px; max-width:1200px; overflow-y: auto; overflow-x: auto;-ms-overflow-style: -ms-autohiding-scrollbar;">
                                                                        <table class="table table-striped table-sm">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Acciones</th>
                                                                                    <th>Nro Vin</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="(compra, index) in arrayExcel" :key="compra.nIdProyecto">
                                                                                    <td>
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Eliminar Compra  {{ compra.cNumeroVin }}</div>
                                                                                            <i @click="eliminarItemExcel(index)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                        </el-tooltip>
                                                                                    </td>
                                                                                    <td v-text="compra.cNumeroVin"></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-7">
                                                                            </div>
                                                                            <div class="col-lg-5">
                                                                                <div class="datatable-info">Total: {{ contadorArrayExcel }} registros</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9 offset-sm-5">
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrar()">
                                                                                <i class="fa fa-save"></i> Registrar
                                                                            </button>
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
                                            </div>
                                        </section>
                                    </div>
                                </div>
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

            <!-- MODAL RESPUESTAS DE GENERAR PROYECTO-->
            <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Automotores INKA</h4>
                            <button type="button" class="close" @click="limpiarFormulario(); cerrarModal()" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div v-if="arrayCompraExisteVin.length" class="col-sm-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">ESTOS VIN YA SE ECUENTRAN REGISTRADOS</h3>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped table-sm">
                                                <tbody>
                                                    <tr v-for="compra in arrayCompraExisteVin" :key="compra.cNumeroVin">
                                                        <td v-text="compra.cNumeroVin"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="limpiarFormulario(); cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </transition>
</template>
<script>
    export default {
        props:['ruta'],
        data(){
            return {
                cempresa: sessionStorage.getItem("cNombreEmpresa"),
                csucursal: sessionStorage.getItem("cNombreSucursal"),
                // ============================================
                // ============ BUSCAR COMPRA =================
                fillCompra:{
                    dfechainicio: '',
                    dfechafin: '',
                    nordencompra: '',
                    cnumerovin: '',
                    nidmarca: '',
                    nidmodelo: ''
                },
                arrayProyecto: [],
                arrayProyectoRpta: [],
                // ===============================================
                // ============ REGISTRAR COMPRA =================
                formCompra:{
                    nformapago: 0,
                    nidtipolista: '',
                    nidproveedor: 0,
                    cproveedornombre: '',
                    nnumerolista: '',
                    nidlistaprecio: 0,
                    ccarcode: '',
                    igv: 0
                },
                arrayExcel: [],
                contadorArrayExcel: 0,
                // ============ VARIABLES DE RESPUESTA =================
                arrayCompraExisteVin: [],
                arrayTempVinExiste: [],
                //===========================================================
                // =============  VARIABLES SAP ========================
                arraySapVin: [],
                arraySapItemCode: [],
                arraySapRespuesta: [],
                jsonRespuesta: '',
                arraySapUpdSgc: [],
                arraySapProyecto: [],
                // ============================================================
                page: 1,
                perPage: 10,
                pages:[],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
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
                accion: 0,
                modal:0,
                tituloModal:'',
                tituloFormulario: '',
                accionmodal: 0,
                error: 0,
                errors: [],
                mensajeError: [],
                attachment: null,
                form: new FormData,
                textFile: '',
                loading: false
            }
        },
        mounted(){
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
            },
        },
        methods:{
            tabBuscarProyecto(){
                this.limpiarFormulario();
            },
            listarProyectos(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/proyecto/GetAddonProyecto';
                axios.get(url, {
                    params: {
                        'nidempresa'    : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'dfechainicio'  : this.fillCompra.dfechainicio,
                        'dfechafin'     : this.fillCompra.dfechafin,
                        'cnumerovin'    : this.fillCompra.cnumerovin,
                        'page'          : page
                    }
                }).then(response => {
                    this.arrayProyectoRpta = response.data.arrayCompra;
                    this.paginateProyecto(this.arrayProyectoRpta, page);
                    $("#myBar").hide();
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
            paginateProyecto(data, page){
                this.pagination.current_page= page;
                this.pagination.total       = data.length;
                this.pagination.per_page    = this.perPage;
                this.pagination.last_page   = Math.ceil(data.length / this.pagination.per_page);
                this.pagination.from        = (this.pagination.current_page * this.pagination.per_page) - this.pagination.per_page;
                this.pagination.to          = (this.pagination.current_page * this.pagination.per_page);
                this.arrayCompra            = data.slice(this.pagination.from, this.pagination.to);
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.paginateProyecto(this.arrayProyectoRpta, page);
            },
            // ====================================================
            // =============  GENERAR COMPRA ======================
            tabGenerarProyecto(){
                this.limpiarFormulario();
            },
            //=================== Proceso Carga de Formato Compra Excel
            getFile(e){
                //console.log(e);
                let selectFile = e.target.files[0];
                this.attachment = selectFile;
                this.arrayExcel = [];
                //this.textFile = e.target.files[0].name;
            },
            importFileProyecto(){
                if(this.validarReadFileCompra()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.form.append('file', this.attachment);
                const config = { headers: { 'Content-Type': 'multipart/form-data'  } };
                var url = this.ruta + '/proyecto/importFileProyecto';
                axios.post(url, this.form, config).then(response=>{
                    this.readFileProyecto(response.data);
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
            readFileProyecto(nameFile){
                // console.log(nameFile);
                this.mostrarProgressBar();

                var url = this.ruta + '/proyecto/readFileProyecto';
                axios.post(url, {
                    nameFile: nameFile
                }).then(response => {

                    this.arrayExcel = response.data;

                    this.$delete(this.arrayExcel, 0)
                    this.contadorArrayExcel = this.arrayExcel.length;
                    $("#myBar").hide();
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
            eliminarItemExcel(index){
                this.$delete(this.arrayExcel, index);
                this.contadorArrayExcel = this.arrayExcel.length;
            },
            //====================================================================
            //======================  Registrar Excel Compra =====================
            registrar(){
                if(this.validarRegistro()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.mostrarProgressBar();

                var url = this.ruta + '/proyecto/AddonSetProyecto';
                axios.post(url, {
                    'nIdEmpresa'      : parseInt(sessionStorage.getItem("nIdEmpresa")),
                    'data'            : this.arrayExcel
                }).then(response => {
                    let me = this;

                    me.arrayTempVinExiste = [];
                    me.arrayCompraExisteVin = [];
                    me.arrayVinDepura = [];

                    if(response.data.arrayVinExiste.length)
                    {
                        me.arrayTempVinExiste = response.data.arrayVinExiste;
                        me.arrayTempVinExiste.map(function(value, key) {
                            me.arrayCompraExisteVin.push({
                                'cNumeroVin': me.arrayTempVinExiste[key]
                            });
                            me.arrayVinDepura.push(me.arrayTempVinExiste[key]);
                        });
                    }

                    me.arrayExcel.map(function(x, y){
                        if (!me.arrayVinDepura.includes(x.cNumeroVin)) {
                            me.arraySapVin.push(x);
                        }
                    });

                    if(me.arraySapVin.length){
                        setTimeout(function() {
                            me.registroSapBusinessProyecto();
                        }, 1200);
                    }
                    else{
                        me.loadingProgressBar("OCURRIO UN PROBLEMA...");
                        me.verResultados();
                    }
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
            registroSapBusinessProyecto(){
                let me = this;
                me.loadingProgressBar("INTEGRANDO PROYECTO CON SAP BUSINESS ONE...");
                
                me.arraySapVin.map(function(x, y){
                    me.arraySapProyecto.push({
                        'cCode': x.cNumeroVin,
                        'cName': x.cNumeroVin
                    });
                });

                var sapUrl = me.ruta + '/proyecto/SapSetProyecto';
                axios.post(sapUrl, {
                    'data': me.arraySapProyecto
                }).then(response => {
                    me.arraySapRespuesta = [];
                    me.arraySapUpdSgc = [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(value, key){
                        me.jsonRespuesta = '';
                        me.jsonRespuesta= JSON.parse(value);
                        if(me.jsonRespuesta.Code){
                            me.arraySapUpdSgc.push({
                                'cCode'         : me.jsonRespuesta.Code.toString(),
                                'cName'         : me.jsonRespuesta.Name.toString(),
                                'cLogRespuesta' : me.arraySapRespuesta[key].toString()
                            });
                        }
                    });
                    //===========================================================================
                    //================== ACTUALIZO TABLA INTEGRACION PROYECTO SGC ===============
                    setTimeout(function() {
                        me.registroSgcProyecto();
                    }, 1200);
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
            registroSgcProyecto(){
                let me = this;
                
                var sapUrl = me.ruta + '/proyecto/AddonIntegraSetProyecto';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    //===================================================================
                    //================== REGITRO DE TARJETA EQUIPO EN SAP ===============
                    setTimeout(function() {
                        me.verResultados();
                    }, 1200);
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
            verResultados(){
                let me = this;
                me.attachment = [];
                me.confirmaProyecto();
                //============= RESULTADO PARA MOSTRAR ================
                if(me.arrayCompraExisteVin.length){
                    me.accionmodal=3;
                    me.modal = 1;
                    me.attachment = [];
                }else{
                    swal('Compra registrada correctamente');
                }
            },
            validarRegistro(){
                this.error = 0;
                this.mensajeError =[];

                if(this.arrayExcel == []){
                    this.mensajeError.push('No hay Datos a Registrar');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            validarReadFileCompra(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.attachment || this.attachment==[] || this.attachment==''){
                    this.mensajeError.push('No hay Archivos Seleccionados');
                }
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            descargaFormatoCompra(){
                window.open(this.ruta + '/storage/FormatosDescarga/FormatoProyecto.xlsx');
            },
            //==========================================================
            //=================== REGISTRO SAP INDIVIDUAL ==============
            validarSapArticulo(objCompra){
                this.mostrarProgressBar();

                let me = this;

                me.arraySapCompra.push({
                    'cNumeroVin'        : objCompra.cNumeroVin
                });

                //Verifico Si existe Artículo
                if(!objCompra.cNumeroVin){
                    //==============================================================
                    //================== REGISTRO ARTICULO EN SAP ===============
                    me.generarSapProyecto(objCompra);
                }
            },
            generarSapProyecto(objCompra){
                let me = this;
                //Verifico Si NO existe Proyecto De EXCEL
                if(!objCompra.cCode){
                    //==============================================================
                    //================== REGISTRO PROYECTO EN SAP ===============
                    me.loadingProgressBar("INTEGRANDO PROYECTO CON SAP BUSINESS ONE...");

                    me.arraySapProyecto.push({
                        'cCode': objCompra.cNumeroVin,
                        'cName': objCompra.cNumeroVin
                    });

                    var sapUrl = me.ruta + '/proyecto/SapSetProyecto';
                    axios.post(sapUrl, {
                        'data': me.arraySapProyecto
                    }).then(response => {
                        me.arraySapRespuesta= [];
                        me.arraySapUpdSgc= [];

                        me.arraySapRespuesta = response.data;
                        me.arraySapRespuesta.map(function(x){
                            me.jsonRespuesta = '';
                            me.jsonRespuesta= JSON.parse(x);
                            //Si el valor de respuesta Code tiene un valor
                            if(me.jsonRespuesta.Code){
                                me.arraySapUpdSgc.push({
                                    'cCode'         : me.jsonRespuesta.Code.toString(),
                                    'cName'         : me.jsonRespuesta.Name.toString(),
                                    'cLogRespuesta' : response.data.toString()
                                });

                                //==============================================================
                                //================== ACTUALIZO TABLA PROYECTO SGC ===============
                                setTimeout(function() {
                                    me.generaActualizaProyecto(objCompra);
                                }, 1200);
                            }
                        });
                    }).catch(error => {
                        me.limpiarPorError("Error en la Integración de Proyecto SapB1!");
                        console.log(error);
                        if (error.response) {
                            if (error.response.status == 401) {
                                swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                location.reload('0');
                            }
                        }
                    });
                }
                else{
                    //==============================================================
                    //================== REGISTRO TARJETA EQUIPO ===============
                    setTimeout(function() {
                        me.generarSapTarjetaEquipo(objCompra);
                    }, 800);
                }
            },
            generaActualizaProyecto(objCompra){
                let me = this;
                var sapUrl = me.ruta + '/proyecto/SetIntegraProyecto';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        me.confirmaProyecto();
                    }
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
            confirmaProyecto(){
                let me = this;
                $("#myBar").hide();
                me.loading.close();
                swal('Proyecto registrada correctamente');
                me.limpiarFormulario();
                me.listarProyectos(1);
            },
            // ===========================================================
            limpiarFormulario(){
                this.fillCompra.nordencompra= '',
                this.fillCompra.cnumerovin=  '',
                this.formCompra.nidtipolista= '',
                this.formCompra.ccarcode= '',
                this.formCompra.nidproveedor = 0,
                this.formCompra.cproveedornombre = '',
                this.arrayExcel = [],
                this.attachment = [];
                this.form = new FormData,
                $("#file-upload").val("");

                //========= VARIABLES SAP =============
                //Limpiar variables Sap Articulo
                this.arraySapVin= [],
                this.arraySapItemCode= [],
                this.arraySapRespuesta= [],
                this.jsonRespuesta= '',
                this.arraySapUpdSgc= [],
                this.arraySapProyecto= [],
                this.arraySapTarjetaEquipo= [],
                this.arraySapLlamadaServicio= [],
                this.arraySapCompra= [],
                this.arraySapActividad= [],
                this.arraySapSolucion= [],
                //Tbls Costo
                this.arrayTCTipoBeneficio= [];
                this.arrayTCCostoVehiculo= [];
                this.arraySapCosto= [];
            },
            limpiarPaginacion(){
                this.pagination.current_page =  0,
                this.pagination.total = 0,
                this.pagination.per_page = 0,
                this.pagination.last_page = 0,
                this.pagination.from  = 0,
                this.pagination.to = 0
            },
            limpiarPorError(cDescripcion){
                $("#myBar").hide();
                swal({
                    type: 'error',
                    title: 'Error...',
                    text: cDescripcion,
                });
                this.loading.close();
                this.limpiarFormulario();
                this.listarProyectos(1);
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
</style>