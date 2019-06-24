<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <vs-divider color="dark">
                        <h2 class="no-margin-bottom">MODULO ALMACENES</h2>
                    </vs-divider>
                </div>
            </header>

            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link" :class="{'active': (vistaFormulario == 1)}" id="tab01" href="#TabBandejaAlmacenes" @click="tabBandejaAlmacenes" role="tab" data-toggle="tab">
                                            <i class="fab fa-wpforms"></i> BANDEJA DE ALMACENES
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" :class="{'active': (vistaFormulario == 0)}" id="tab02" href="#TabConfiguradorAlmacenes" @click="tabConfiguradorAlmacenes" role="tab" data-toggle="tab">
                                            <i class="fa fa-bus"></i> CONFIGURADOR DE ALMACENES/CUENTA
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <template v-if="vistaFormulario">
                                        <div role="tabpanel" class="tab-pane fade" :class="{'in active show': (vistaFormulario == 1)}" id="TabBandejaAlmacenes">
                                            <section class="forms">
                                                <div class="container-fluid">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h3 class="h4">BANDEJA DE ALMACENES</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <form class="form-horizontal">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-md-4 form-control-label">* Localidad</label>
                                                                                <div class="col-md-8 widthFull">
                                                                                    <el-select v-model="fillBsqAlmacen.nIdLocalidad"
                                                                                            filterable
                                                                                            clearable
                                                                                            loading-text
                                                                                            placeholder="Seleccione una Localidad">
                                                                                        <el-option
                                                                                            v-for="concepto in arrayLocalidad"
                                                                                            :key="concepto.nIdPar"
                                                                                            :label="concepto.cParNombre"
                                                                                            :value="concepto.nIdPar">
                                                                                        </el-option>
                                                                                    </el-select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="row">
                                                                                <label class="col-md-4 form-control-label">* Almacen</label>
                                                                                <div class="col-md-8 widthFull">
                                                                                    <el-select v-model="fillBsqAlmacen.nIdAlmacen"
                                                                                            filterable
                                                                                            clearable
                                                                                            loading-text
                                                                                            placeholder="Seleccione un Almacen">
                                                                                        <el-option
                                                                                            v-for="concepto in arrayAlmacen"
                                                                                            :key="concepto.nIdPar"
                                                                                            :label="concepto.cParNombre"
                                                                                            :value="concepto.nIdPar">
                                                                                        </el-option>
                                                                                    </el-select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Codigo Cuenta Entrada</label>
                                                                                <div class="col-md-8 widthFull">
                                                                                    <input type="text" v-model="fillBsqAlmacen.nCodigoCuentaEntrada" class="form-control form-control-sm">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Codigo Cuenta Salida</label>
                                                                                <div class="col-md-8 widthFull">
                                                                                    <input type="text" v-model="fillBsqAlmacen.nCodigoCuentaSalida" class="form-control form-control-sm">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-9 offset-md-5">
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="listarAlmacenes(1)">
                                                                                <i class="fa fa-search"></i> BUSCAR
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
                                                                <h3 class="h4">LISTADO DE ALMACENES</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <form class="form-horizontal">
                                                                    <template v-if="arrayListAlmacenes.length">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped table-sm">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Acción</th>
                                                                                        <th>Código</th>
                                                                                        <th>Localidad</th>
                                                                                        <th>Almacen</th>
                                                                                        <th>Tipo</th>
                                                                                        <th>Codigo Almacen Entrada</th>
                                                                                        <th>Codigo Almacen Salida</th>
                                                                                        <th>Activo por Defecto</th>
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr v-for="(almacen, index) in arrayListAlmacenes" :key="index">
                                                                                        <td>
                                                                                            <template v-if="almacen.cEstado == 'A'">
                                                                                                <a href="#" @click.prevent="cambiarEstado(0, almacen)"><i :style="'color:#796AEE'" class="fa-md fa fa-check-square"></i></a>
                                                                                                &nbsp;&nbsp;
                                                                                                <a href="#" @click.prevent="cambiarVista(0, almacen)"><i :style="'color:blue'" class="fa-md fa fa-edit"></i></a>
                                                                                                &nbsp;&nbsp;
                                                                                            </template>
                                                                                            <template v-else>
                                                                                                <a href="#" @click.prevent="cambiarEstado(1, almacen)"><i :style="'color:red'" class="fa-md fa fa-square"></i></a>
                                                                                            </template>
                                                                                        </td>
                                                                                        <td v-text="almacen.id"></td>
                                                                                        <td v-text="almacen.cNombreLocalidad"></td>
                                                                                        <td v-text="almacen.cWhsName"></td>
                                                                                        <td v-text="almacen.cFlagTipoDescripcion"></td>
                                                                                        <td v-text="almacen.cAcctCode"></td>
                                                                                        <td v-text="almacen.cAcctCodeSalida"></td>
                                                                                        <td v-text="almacen.cFlagPorDefecto"></td>
                                                                                        <td>
                                                                                            <template v-if="almacen.cFlagPorDefecto == 'NO'">
                                                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                    <div slot="content">Activar por Defecto {{ almacen.cWhsName }}</div>
                                                                                                    <i @click="activarPorDefecto('S', almacen)" :style="'color:blue'" class="fa-md fa fa-check"></i>
                                                                                                </el-tooltip>
                                                                                            </template>
                                                                                            <template v-else>
                                                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                    <div slot="content">Desactivar por Defecto {{ almacen.cWhsName }}</div>
                                                                                                    <i @click="activarPorDefecto('N', almacen)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                                </el-tooltip>
                                                                                            </template>
                                                                                        </td>
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
                                                                                                <a @click.prevent="cambiarPaginaAlmacenes(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                            </li>
                                                                                            <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                                            :class="[page==isActivedModal?'active':'']">
                                                                                                <a class="page-link"
                                                                                                href="#" @click.prevent="cambiarPaginaAlmacenes(page)"
                                                                                                v-text="page"></a>
                                                                                            </li>
                                                                                            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                                <a @click.prevent="cambiarPaginaAlmacenes(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </template>

                                    <template v-else>
                                        <div role="tabpanel" class="tab-pane fade" :class="{'in active show': (vistaFormulario == 0)}"  id="TabConfiguradorAlmacenes">
                                            <section class="forms">
                                                <div class="container-fluid">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h3 class="h4">CONFIGURADOR ALMACENES</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <form class="form-horizontal">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-md-4 form-control-label">* Localidad</label>
                                                                                <div class="col-md-8 widthFull">
                                                                                    <el-select v-model="fillAlmacen.nIdLocalidad"
                                                                                            filterable
                                                                                            clearable
                                                                                            loading-text
                                                                                            v-validate="'required'"
                                                                                            data-vv-as="Localidad"
                                                                                            name="nLocalidad"
                                                                                            :class="{'has-error': vErrors.has('nLocalidad')}"
                                                                                            placeholder="Seleccione una Localidad">
                                                                                        <el-option
                                                                                            v-for="concepto in arrayLocalidad"
                                                                                            :key="concepto.nIdPar"
                                                                                            :label="concepto.cParNombre"
                                                                                            :value="concepto.nIdPar">
                                                                                        </el-option>
                                                                                    </el-select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="row">
                                                                                <label class="col-md-4 form-control-label">* Almacen</label>
                                                                                <div class="col-md-8 widthFull">
                                                                                    <el-select v-model="fillAlmacen.nIdAlmacen"
                                                                                            filterable
                                                                                            clearable
                                                                                            loading-text
                                                                                            v-validate="'required'"
                                                                                            data-vv-as="Almacen"
                                                                                            name="nAlmacen"
                                                                                            :class="{'has-error': vErrors.has('nAlmacen')}"
                                                                                            placeholder="Seleccione un Almacen">
                                                                                        <el-option
                                                                                            v-for="concepto in arrayAlmacen"
                                                                                            :key="concepto.nIdPar"
                                                                                            :label="concepto.cParNombre"
                                                                                            :value="concepto.nIdPar">
                                                                                        </el-option>
                                                                                    </el-select>
                                                                                    <span v-show="vErrors.has('nAlmacen')" class="alert-danger">
                                                                                        {{ vErrors.first('nAlmacen') }}
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Codigo Cuenta Entrada</label>
                                                                                <div class="col-md-8 widthFull">
                                                                                    <input type="text"
                                                                                            v-model.number="fillAlmacen.nCodigoCuentaEntrada"
                                                                                            class="form-control form-control-sm"
                                                                                            v-validate="'required|numeric|digits:6|max:6'"
                                                                                            data-vv-as="Codigo de Cuenta Entrada"
                                                                                            name="nCodigoCuentaEntrada"
                                                                                            :class="{'has-error': vErrors.has('nCodigoCuentaEntrada')}">
                                                                                    <span v-show="vErrors.has('nCodigoCuentaEntrada')" class="alert-danger">
                                                                                        {{ vErrors.first('nCodigoCuentaEntrada') }}
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Codigo Cuenta Salida</label>
                                                                                <div class="col-md-8 widthFull">
                                                                                    <input type="text"
                                                                                            v-model.number="fillAlmacen.nCodigoCuentaSalida"
                                                                                            class="form-control form-control-sm"
                                                                                            v-validate="'required|numeric|digits:6|max:6'"
                                                                                            data-vv-as="Codigo de Cuenta Salida"
                                                                                            name="nCodigoCuentaSalida"
                                                                                            :class="{'has-error': vErrors.has('nCodigoCuentaSalida')}">
                                                                                    <span v-show="vErrors.has('nCodigoCuentaSalida')" class="alert-danger">
                                                                                        {{ vErrors.first('nCodigoCuentaSalida') }}
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-9 offset-md-5">
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click.prevent="guardarAlmacen()">
                                                                                <i class="fa fa-save"></i> GUARDAR
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </template>
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
                                <div v-for="e in mensajeError" :key="e" v-text="e"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Show Coincidencias -->
            <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                <div v-for="(e, index) in mensajeError" :key="index">
                                    <h4>El Almacen </h4>
                                    <strong v-text="e.cWhsName"></strong><br>
                                    <span>Ya se encuentra registrado</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Show Errors Validate -->
            <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                <!-- <div v-for="e in arraCoincidencias" :key="e" v-text="e"></div> -->
                                <!-- <li v-for="(error, index) in vErrors.collect('nCodigoCuenta')" :key="index">{{ error }}</li> -->
                                <li v-for="(group, index) in vErrors.collect()" :key="index">
                                    <ul>
                                        <li v-for="(error, index2) in group" :key="index2">
                                            {{ error }}
                                        </li>
                                    </ul>
                                </li>
                            </div>
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
        props:['ruta'],
        data(){
            return {
                // =============================================================
                // VARIABLES TAB BSQ ALMACEN
                // =============================================================
                fillBsqAlmacen: {
                    nIdLocalidad: '',
                    nIdAlmacen: '',
                    nCodigoCuentaEntrada: '',
                    nCodigoCuentaSalida: ''
                },
                arrayLocalidad: [],
                arrayAlmacen: [],
                arrayListAlmacenes: [],
                // =============================================================
                // VARIABLES TAB CONFIGURAR ALMACEN
                // =============================================================
                fillAlmacen: {
                    nIdLocalidad: '',
                    nIdAlmacen: '',
                    nCodigoCuentaEntrada: '',
                    nCodigoCuentaSalida: '',
                    nId: ''
                },
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
                error: 0,
                errors: [],
                mensajeError: [],
                loading: false,
                vistaFormulario: 1,
                flagGuardar: 1
            }
        },
        mounted(){
            this.llenarLocalidades();
            this.llenarAlmacenes();
            this.tabBandejaAlmacenes();
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
        methods: {
            llenarLocalidades(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110102,
                        'opcion' : 1
                    }
                }).then(response => {
                    this.arrayLocalidad = response.data;
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
            llenarAlmacenes(){
                var url = this.ruta + '/almacen/GetAlmacen';
                axios.get(url).then(response => {
                    this.arrayAlmacen = response.data;
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
            // =================================================================
            // TAB BANDEJA DE ALMACENES
            // =================================================================
            tabBandejaAlmacenes(){
                this.vistaFormulario = 1;
                this.limpiarTabBsqAlmacenes();
            },
            limpiarTabBsqAlmacenes(){
                this.fillBsqAlmacen.nIdLocalidad = '';
                this.fillBsqAlmacen.nIdAlmacen = '';
                this.fillBsqAlmacen.nCodigoCuentaEntrada = '';
                this.fillBsqAlmacen.nCodigoCuentaSalida = '';
                this.arrayListAlmacenes = [];
            },
            listarAlmacenes(page){
                var url = this.ruta + '/almacen/GetListAlmacen';
                axios.get(url, {
                    params: {
                        'nIdLocalidad'          :   this.fillBsqAlmacen.nIdLocalidad,
                        'nIdAlmacen'            :   this.fillBsqAlmacen.nIdAlmacen,
                        'nCodigoCuentaEntrada'  :   this.fillBsqAlmacen.nCodigoCuentaEntrada,
                        'nCodigoCuentaSalida'   :   this.fillBsqAlmacen.nCodigoCuentaSalida,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayListAlmacenes       =   response.data.arrayAlmacen.data;
                    this.pagination.current_page   =   response.data.arrayAlmacen.current_page;
                    this.pagination.total          =   response.data.arrayAlmacen.total;
                    this.pagination.per_page       =   response.data.arrayAlmacen.per_page;
                    this.pagination.last_page      =   response.data.arrayAlmacen.last_page;
                    this.pagination.from           =   response.data.arrayAlmacen.from;
                    this.pagination.to             =   response.data.arrayAlmacen.to;
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
            cambiarPaginaAlmacenes(page){
                this.pagination.current_page=page;
                this.listarAlmacenes(page);
            },
            cambiarEstado(op, almacen){
                swal({
                    title: '¿Esta seguro de ' + ((op == 0) ? 'Desactivar' : ' Activar ') + ' el Almacen ' + almacen.cWhsName + '?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, ' + ((op == 0) ? 'Desactivar' : ' Activar '),
                    cancelButtonText: 'No, cerrar!'
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        this.mostrarProgressBar();

                        var url = this.ruta + '/almacen/SetCambiarEstado';
                        axios.put(url, {
                            'nIdLocalidad'  : almacen.cIdLocalidad,
                            'nIdAlmacen'    : (almacen.cWhsCode).toString(),
                            'nCodigoCuenta' : almacen.cAcctCode,
                            'opcion'        : op
                        }).then(response => {
                            me.listarAlmacenes(1);
                            $("#myBar").hide();
                            swal(
                                ((op == 0) ? 'Desactivado' : ' Activado '),
                                'El Almacen ' + almacen.cWhsName +' ha sido ' + ((op == 0) ? 'Desactivado' : ' Activado ') + ' con éxito.',
                                'success'
                            )
                        }).catch(error => {
                            console.log(error);
                            if (error.response) {
                                if (error.response.status == 401) {
                                    swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                    location.reload('0');
                                }
                            }
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {}
                });
            },
            cambiarVista(op, almacen){
                this.vistaFormulario = op;
                this.flagGuardar = 0;
                //Set Data for Update
                this.fillAlmacen.nId                    = almacen.id;
                this.fillAlmacen.nIdLocalidad           = almacen.cIdLocalidad;
                this.fillAlmacen.nIdAlmacen             = (almacen.cWhsCode).toString();
                this.fillAlmacen.nCodigoCuentaEntrada   = almacen.cAcctCode;
                this.fillAlmacen.nCodigoCuentaSalida    = almacen.cAcctCodeSalida;
            },
            actualizarAlmacen(){
                if(this.validarRegistrarAlmacen()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                //Comprueba todas las validaciones
                this.$validator.validate().then(result => {
                    if(result) {
                        var url = this.ruta + '/almacen/SetActualizarAlmacen';
                        axios.put(url, {
                            nId                     :   this.fillAlmacen.nId,
                            nIdLocalidad            :   this.fillAlmacen.nIdLocalidad,
                            nIdAlmacen              :   (this.fillAlmacen.nIdAlmacen).toString(),
                            nCodigoCuentaEntrada    :   this.fillAlmacen.nCodigoCuentaEntrada,
                            nCodigoCuentaSalida     :   this.fillAlmacen.nCodigoCuentaSalida
                        }).then(response => {
                            if (response.data[0].nFlagMsje == 1) {
                                swal(response.data[0].cMensaje);
                                this.limpiarTabBsqConfigurarAlmacenes();
                                this.vErrors.clear();//Limpiar Errores
                                this.tabBandejaAlmacenes();
                            } else {
                                swal(response.data[0].cMensaje);
                            }
                        }).catch(error => {
                            this.errors = error
                            if (error.response) {
                                if (error.response.status == 401) {
                                    swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                    location.reload('0');
                                }
                            }
                        });
                    }
                    if (!result) {
                        //Coleccion de Errores
                        this.accionmodal=3;
                        this.modal = 1;
                    }
                })
            },
            activarPorDefecto(cflag, almacen){
                swal({
                    title: '¿Esta seguro de ' + ((cflag == 'N') ? 'Desactivar' : ' Activar Por Defecto ') + ' el Almacen ' + almacen.cWhsName + '?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, ' + ((cflag == 'N') ? 'Desactivar' : ' Activar '),
                    cancelButtonText: 'No, cerrar!'
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        this.mostrarProgressBar();

                        var url = this.ruta + '/almacen/SetFlagActivaPorDefecto';
                        axios.put(url, {
                            'id'                    : almacen.id,
                            'nIdLocalidad'          : almacen.nIdLocalidad,
                            'cWhsCode'              : almacen.cWhsCode.toString(),
                            'cFlagTipo'             : almacen.cFlagTipo.toString(),
                            'cFlagActivaporDefecto' : cflag.toString()
                        }).then(response => {
                            me.listarAlmacenes(1);
                            $("#myBar").hide();
                            swal(
                                ((cflag == 'N') ? 'Desactivado' : 'Activado Por Defecto'),
                                'El Almacen ' + almacen.cWhsName +' ha sido ' + ((cflag == 'N') ? 'Desactivado' : 'Activado Por Defecto') + ' con éxito.',
                                'success'
                            )
                        }).catch(error => {
                            console.log(error);
                            if (error.response) {
                                if (error.response.status == 401) {
                                    swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                    location.reload('0');
                                }
                            }
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {}
                });
            },
            // =================================================================
            // TAB CONFIGURADOR DE ALMACENES
            // =================================================================
            tabConfiguradorAlmacenes(){
                this.vistaFormulario = 0;
                this.flagGuardar = 1;
                this.limpiarTabBsqConfigurarAlmacenes();
            },
            limpiarTabBsqConfigurarAlmacenes(){
                this.fillAlmacen.nIdLocalidad = '';
                this.fillAlmacen.nIdAlmacen = '';
                this.fillAlmacen.nCodigoCuentaEntrada = '';
                this.fillAlmacen.nCodigoCuentaSalida = '';
            },
            guardarAlmacen(){
                (this.flagGuardar == 1) ? this.registrarAlmacen() : this.actualizarAlmacen();
            },
            validarRegistrarAlmacen(){
                this.error = 0;
                this.mensajeError =[];

                if(this.fillAlmacen.nIdLocalidad == ''){
                    this.mensajeError.push('Debe seleccionar una Localidad');
                }
                if(this.fillAlmacen.nIdAlmacen == ''){
                    this.mensajeError.push('Debe seleccionar un Almacen');
                }
                if(this.fillAlmacen.nCodigoCuentaEntrada == ''){
                    this.mensajeError.push('Debe digitar un código de cuenta de entrada');
                }
                if(this.fillAlmacen.nCodigoCuentaSalida == ''){
                    this.mensajeError.push('Debe digitar un código de cuenta de salida');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            registrarAlmacen(){
                if(this.validarRegistrarAlmacen()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                //Comprueba todas las validaciones
                this.$validator.validate().then(result => {
                    if(result) {
                        var url = this.ruta + '/almacen/SetRegistrarAlmacen';
                        axios.post(url, {
                            'nIdLocalidad'          :   this.fillAlmacen.nIdLocalidad,
                            'nIdAlmacen'            :   (this.fillAlmacen.nIdAlmacen).toString(),
                            'nCodigoCuentaEntrada'  :   this.fillAlmacen.nCodigoCuentaEntrada,
                            'nCodigoCuentaSalida'   :   this.fillAlmacen.nCodigoCuentaSalida,
                        }).then(response => {
                            if (response.data[0].nFlagMsje == 1) {
                                swal(response.data[0].cMensaje);
                                this.limpiarTabBsqConfigurarAlmacenes();
                                this.vErrors.clear();//Limpiar Errores
                                this.tabBandejaAlmacenes();
                            } else {
                                swal(response.data[0].cMensaje);
                            }
                        }).catch(error => {
                            this.errors = error
                            if (error.response) {
                                if (error.response.status == 401) {
                                    swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                    location.reload('0');
                                }
                            }
                        });
                    }
                    if (!result) {
                        //Coleccion de Errores
                        this.accionmodal=3;
                        this.modal = 1;
                    }
                })
            },
            // =================================================================
            // METODOS GENERICOS
            // =================================================================
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "case":
                    {
                        switch(accion){
                            case 'case2':
                            {
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
                this.limpiarPaginacionModal();
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
        text-align: center;
        margin: auto;
    }
    .alert-danger{
        color: red;
    }
    .has-error{
        border-color: red;
    }
</style>
