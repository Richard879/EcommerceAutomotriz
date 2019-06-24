<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">
                        <vs-divider color="dark">MODULO CONFIGURADOR DE MODELOS POR AÑO</vs-divider>
                    </h2>
                </div>
            </header>

            <section>
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link" :class="{'active': (vistaFormulario == 1)}" id="tab01" href="#TabBandejaModelos" @click="tabBandejaModelos" role="tab" data-toggle="tab">
                                            <i class="fa fa-wpforms"></i> BANDEJA DE MODELOS
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <template v-if="vistaFormulario">
                                        <div role="tabpanel" class="tab-pane fade" :class="{'in active show': (vistaFormulario == 1)}" id="TabBandejaModelos">
                                            <section class="forms">
                                                <div class="container-fluid">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h3 class="h4">BANDEJA DE MODELOS</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <form class="form-horizontal">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                                                <div class="col-sm-8">
                                                                                    <div class="input-group">
                                                                                        <input type="text" v-model="formBsqModelo.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
                                                                                        <div class="input-group-prepend">
                                                                                            <el-tooltip class="item" effect="dark" >
                                                                                                <div slot="content">Buscar Proveedor </div>
                                                                                                <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('proveedor','buscar', 1)">
                                                                                                    <i class="fa-lg fa fa-search"></i>
                                                                                                </button>
                                                                                            </el-tooltip>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Linea Vehiculo</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-select  v-model="formBsqModelo.nidlinea"
                                                                                                filterable
                                                                                                clearable
                                                                                                placeholder="SELECCIONE LINEA"
                                                                                                @change="llenarComboMarca()">
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
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Marca</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-select  v-model="formBsqModelo.nidmarca"
                                                                                                filterable
                                                                                                clearable
                                                                                                placeholder="SELECCIONE MARCA"
                                                                                                @change="llenarComboModelo()">
                                                                                        <el-option
                                                                                            v-for="item in arrayMarca"
                                                                                            :key="item.nIdMarca"
                                                                                            :label="item.cMarcaNombre"
                                                                                            :value="item.nIdMarca">
                                                                                        </el-option>
                                                                                    </el-select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Modelo</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-select  v-model="formBsqModelo.nidmodelo"
                                                                                                filterable
                                                                                                clearable
                                                                                                placeholder="SELECCIONE MODELO">
                                                                                        <el-option
                                                                                            v-for="item in arrayModelo"
                                                                                            :key="item.nIdModelo"
                                                                                            :label="item.cModeloNombre"
                                                                                            :value="item.nIdModelo">
                                                                                        </el-option>
                                                                                    </el-select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Nombre Comercial</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" v-model="formBsqModelo.cnombrecomercial" v-on:change="listarModelos(1)" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-9 offset-md-5">
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="listarModelos(1)">
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
                                                                <h3 class="h4">LISTADO DE MODELOS</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <form class="form-horizontal">
                                                                    <template v-if="arrayListModelos.length">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped table-sm">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Acción</th>
                                                                                        <th>Marca</th>
                                                                                        <th>Modelo</th>
                                                                                        <th>Nombre Comercial</th>
                                                                                        <th>Año</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr v-for="(modelo, index) in arrayListModelos" :key="index">
                                                                                        <td>
                                                                                            <template v-if="modelo.cFichaImageUrl">
                                                                                                <el-tooltip class="item" effect="dark">
                                                                                                    <div slot="content">Ver Ficha Tecnica del Modelo (XML) {{ modelo.cNombreModelo }} - {{ modelo.nAnioModelo }}</div>
                                                                                                    <a href="#" @click="descargaFichaTecnica(modelo.cFichaImageUrl)">
                                                                                                        <i class="fa-md fa fa-file-excel-o"></i>
                                                                                                    </a>
                                                                                                </el-tooltip>
                                                                                            </template>&nbsp;
                                                                                            <template v-if="modelo.cFichaImagePDFUrl">
                                                                                                <el-tooltip class="item" effect="dark">
                                                                                                    <div slot="content">Ver Ficha Tecnica del Modelo (PDF)  {{ modelo.cNombreModelo }} - {{ modelo.nAnioModelo }}</div>
                                                                                                    <a href="#" @click="descargaFichaTecnicaPDF(modelo.cFichaImagePDFUrl)">
                                                                                                        <i class="fa-md fa fa-file-pdf-o" :style="'color:red'"></i>
                                                                                                    </a>
                                                                                                </el-tooltip>
                                                                                            </template>&nbsp;
                                                                                            <template v-if="modelo.cFotoImageUrl">
                                                                                                <el-tooltip class="item" effect="dark">
                                                                                                    <div slot="content">Ver Fotografia Referencial del Modelo  {{ modelo.cNombreModelo }} - {{ modelo.nAnioModelo }}</div>
                                                                                                    <a href="#" @click="descargaFotoRef(modelo.cFotoImageUrl)">
                                                                                                        <i class="fa-md fa fa-file"></i>
                                                                                                    </a>
                                                                                                </el-tooltip>
                                                                                            </template>&nbsp;
                                                                                            <el-tooltip class="item" effect="dark">
                                                                                                <div slot="content">Configuracion del Modelo  {{ modelo.cNombreModelo }} - {{ modelo.nAnioModelo }}</div>
                                                                                                <i @click="generarConfiguracion(0, modelo)" :style="'color:gris'" class="fa-md fa fa-cogs"></i>
                                                                                            </el-tooltip>&nbsp;
                                                                                        </td>
                                                                                        <td v-text="modelo.cNombreMarca"></td>
                                                                                        <td v-text="modelo.cNombreModelo"></td>
                                                                                        <td v-text="modelo.cNombreComercial"></td>
                                                                                        <td v-text="modelo.nAnioModelo"></td>
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
                                                                                                <a @click.prevent="cambiarPaginaModelos(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                            </li>
                                                                                            <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                            :class="[page==isActived?'active':'']">
                                                                                                <a class="page-link"
                                                                                                href="#" @click.prevent="cambiarPaginaModelos(page)"
                                                                                                v-text="page"></a>
                                                                                            </li>
                                                                                            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                                <a @click.prevent="cambiarPaginaModelos(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </template>

                                    <template v-else>
                                        <div role="tabpanel" class="tab-pane fade" :class="{'in active show': (vistaFormulario == 0)}">
                                            <section class="forms">
                                                <div class="container-fluid">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h3 class="h4">CONFIGURADOR DEL NOMBRE COMERCIAL - {{ formConfigModelo.cnombrecomercial }} - {{ formConfigModelo.cnombremodelo }} </h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <form class="form-horizontal">
                                                                    <div class="col-xs-12">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Fotografía Referencial</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="file" id="file-upload" @change="getFileFotografia" accept="image/*" class="form-control form-control-sm"/>
                                                                                    </div>
                                                                                    <div id="preview">
                                                                                        <img v-if="formConfigurador.urlImageFotografia" :src="formConfigurador.urlImageFotografia"/>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Ficha Tecnica (XML)</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="file" id="file-upload" @change="getFileFichaTecnica" accept=".xml" class="form-control form-control-sm"/>
                                                                                    </div>
                                                                                    <!-- <div id="preview">
                                                                                        <img v-if="formConfigurador.urlImageFichaTecnica" :src="formConfigurador.urlImageFichaTecnica"/>
                                                                                    </div> -->
                                                                                    <!-- <div id="xml"></div> -->
                                                                                    <!-- <pre lang="xml" >{{formConfigurador.attachmentFichaTecnica}}</pre> -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Ficha Tecnica (PDF)</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="file" id="file-upload" @change="getFileFichaTecnicaPDF" accept=".pdf" class="form-control form-control-sm"/>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-9 offset-sm-5">
                                                                                <template v-if="cFlagAccion == 1">
                                                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarDocsForModelo()">
                                                                                        <i class="fa fa-save"></i> Registrar
                                                                                    </button>
                                                                                </template>
                                                                                <template v-else>
                                                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="actualizarDocsForModelo()">
                                                                                        <i class="fa fa-save"></i> Actualizar
                                                                                    </button>
                                                                                </template>
                                                                                <button type="button" class="btn btn-secundary btn-corner btn-sm" @click="generarConfiguracion(1)">
                                                                                    <i class="fa fa-close"></i> Cancelar
                                                                                </button>
                                                                            </div>
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

            <!-- Modal Show Proveedores -->
            <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTADO</h3>
                                    </div>
                                    <div class="card-body">
                                        <form @submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Nombre</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillProveedor.cnombreproveedor" @keyup.enter="buscaProveedores" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" >
                                                                        <div slot="content">Buscar Proveedor </div>
                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="buscaProveedores">
                                                                            <i class="fa-lg fa fa-search"></i>
                                                                        </button>
                                                                    </el-tooltip>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
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
                                                                <el-tooltip class="item" effect="dark" >
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
                // ============================================================
                // =========== VARIABLES MODAL PROVEEDOR ============
                fillProveedor:{
                    cnombreproveedor: ''
                },
                arrayProveedor: [],
                // =============================================================
                // ================ VARIABLES TAB BSQ VEHICULO ===============
                formBsqModelo:{
                    nidproveedor: '',
                    cproveedornombre: '',
                    nidlinea: '',
                    nidmarca: '',
                    nidmodelo: '',
                    cnombrecomercial: ''
                },
                arrayLinea: [],
                arrayMarca: [],
                arrayModelo: [],
                arrayListModelos: [],
                // =============================================================
                // ================ VARIABLES TAB CONFIG VEHICULO ==============
                // =============================================================
                formConfigModelo:{
                    nidmodelo: '',
                    naniomodelo: '',
                    cnombremodelo: '',
                    cnombrecomercial: '',
                    nidversionveh: ''
                },
                formConfigurador: {
                    urlImageFotografia: '',
                    urlImageFichaTecnica: '',
                    urlImageFichaTecnicaPDF: '',
                    attachmentFotografia: '',// Archivo a almacenar
                    attachmentFichaTecnica: '',// Archivo a almacenar
                    attachmentFichaTecnicaPDF: '',
                },
                cFlagAccion: 1,
                form: new FormData,// El archivo tendrá que ser enviado como elemento FormData
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
                accion: 0,
                modal:0,
                tituloModal:'',
                tituloFormulario: '',
                accionmodal: 0,
                error: 0,
                errors: [],
                mensajeError: [],
                vistaModal: 0,
                vistaFormulario: 1,
                loading: false
            }
        },
        mounted(){
            this.tabBandejaModelos();
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
            // =================================================================
            // TAB BANDEJA DE VEHÍCULOS
            // =================================================================
            tabBandejaModelos(){
                this.vistaFormulario = 1;
                this.limpiarTabBsqModelo();
            },
            limpiarTabBsqModelo(){
                this.formBsqModelo.nidproveedor       = '';
                this.formBsqModelo.cproveedornombre   = '';
                this.formBsqModelo.nidlinea           = '';
                this.formBsqModelo.nidmarca           = '';
                this.formBsqModelo.nidmodelo          = '';
                this.formBsqModelo.cnombrecomercial   = '';
                this.arrayListModelos = [];
            },
            validarBsqModelo(){
                this.error = 0;
                this.mensajeError =[];

                // if(this.formBsqModelo.nidproveedor == ''){
                //     this.mensajeError.push('Debe Seleccionar Proveedor');
                // }
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            listarModelos(page){
                if(this.validarBsqModelo()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/modeloconfig/GetListModelos';
                axios.get(url, {
                    params: {
                        'nIdEmpresa'        :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nIdProveedor'      :   this.formBsqModelo.nidproveedor,
                        'nIdLinea'          :   this.formBsqModelo.nidlinea,
                        'nIdMarca'          :   this.formBsqModelo.nidmarca,
                        'nIdModelo'         :   this.formBsqModelo.nidmodelo,
                        'cNombreComercial'  :   this.formBsqModelo.cnombrecomercial,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayListModelos           =   response.data.arrayListModelos.data;
                    this.pagination.current_page    =   response.data.arrayListModelos.current_page;
                    this.pagination.total           =   response.data.arrayListModelos.total;
                    this.pagination.per_page        =   response.data.arrayListModelos.per_page;
                    this.pagination.last_page       =   response.data.arrayListModelos.last_page;
                    this.pagination.from            =   response.data.arrayListModelos.from;
                    this.pagination.to              =   response.data.arrayListModelos.to;
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
            cambiarPaginaModelos(page){
                this.pagination.current_page=page;
                this.listarModelos(page);
            },
            descargaFotoRef(cFotoImageUrl){
                window.open(cFotoImageUrl);
            },
            descargaFichaTecnica(cFichaImageUrl){
                window.open(cFichaImageUrl);
            },
            descargaFichaTecnicaPDF(cFichaImageUrlPDF){
                window.open(cFichaImageUrlPDF);
            },
            // ==========================================================
            // =============  BUSCAR PROVEEDORES ========================
            buscaProveedores(){
                this.listarProveedores(1);
            },
            listarProveedores(page){
                var url = this.ruta + '/parametro/GetLstProveedor';

                axios.get(url, {
                    params: {
                        'nidempresa'        : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidgrupopar'       : 110023,
                        'cnombreproveedor'  : this.fillProveedor.cnombreproveedor.toString(),
                        'opcion'            : 0,
                        'page'              : page
                    }
                }).then(response => {
                    this.arrayProveedor                 =   response.data.arrayProveedor.data;
                    this.paginationModal.current_page   =   response.data.arrayProveedor.current_page;
                    this.paginationModal.total          =   response.data.arrayProveedor.total;
                    this.paginationModal.per_page       =   response.data.arrayProveedor.per_page;
                    this.paginationModal.last_page      =   response.data.arrayProveedor.last_page;
                    this.paginationModal.from           =   response.data.arrayProveedor.from;
                    this.paginationModal.to             =   response.data.arrayProveedor.to;
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
                this.formBsqModelo.nidproveedor       = nProveedorId;
                this.formBsqModelo.cproveedornombre   = cProveedorNombre;
                this.cerrarModal();
                this.arrayMarca = [];
                this.arrayModelo = [];
                this.llenarComboLinea();
            },
            llenarComboLinea(){
                var url = this.ruta + '/versionvehiculo/GetLineasByProveedor'

                axios.get(url, {
                    params: {
                        'nidempresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidproveedor'  :   this.formBsqModelo.nidproveedor,
                        'opcion': 1
                    }
                }).then(response => {
                    this.arrayLinea = response.data.arrayLinea
                    this.formBsqModelo.nidlinea = ''
                    this.llenarComboMarca();
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
            llenarComboMarca(){
                var url = this.ruta + '/versionvehiculo/GetMarcaByLinea'

                axios.get(url, {
                    params: {
                        'nidlinea'  : this.formBsqModelo.nidlinea,
                        'opcion'    : 1
                    }
                }).then(response => {
                    this.arrayMarca = response.data.arrayMarca
                    this.formBsqModelo.nidmarca = ''
                    this.arrayModelo = [];
                    this.llenarComboModelo();
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
            llenarComboModelo(){
                var url = this.ruta + '/versionvehiculo/GetModeloByMarca';

                axios.get(url, {
                    params: {
                        'nidlinea'  : this.formBsqModelo.nidlinea,
                        'nidmarca'  : this.formBsqModelo.nidmarca,
                        'opcion'    : 1
                    }
                }).then(response => {
                    this.arrayModelo = response.data.arrayModelo;
                    this.formBsqModelo.nidmodelo = '';
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
            // TAB CONFIGURADOR DE ACCESORIOS
            // =================================================================
            tabConfigurador(op){
                this.vistaFormulario = op;
                this.limpiarTabBsqConfigurar();
            },
            limpiarTabBsqConfigurar(){
                //Registrar
                this.formConfigModelo.nidmodelo                 =   '';
                this.formConfigModelo.naniomodelo               =   '';
                this.formConfigModelo.cnombremodelo             =   '';
                this.formConfigModelo.cnombrecomercial          =   '';
                this.formConfigurador.urlImageFotografia        =   '';
                this.formConfigurador.urlImageFichaTecnica      =   '';
                this.formConfigurador.urlImageFichaTecnicaPDF   =   '';
                this.formConfigurador.attachmentFotografia      =   '';
                this.formConfigurador.attachmentFichaTecnica    =   '';
                this.formConfigurador.attachmentFichaTecnicaPDF =   '';
                this.form = '';//Seteo a vacio
                this.form = new FormData;//Inicializo el Obj FormData
            },
            generarConfiguracion(op, modelo = null){
                this.tabConfigurador(op);
                if(op == 0) {
                    this.formConfigModelo.nidmodelo         =   modelo.nIdModelo
                    this.formConfigModelo.naniomodelo       =   modelo.nAnioModelo
                    this.formConfigModelo.cnombremodelo     =   modelo.cNombreModelo + ' - ' + modelo.nAnioModelo;
                    this.formConfigModelo.cnombrecomercial  =   modelo.cNombreComercial;
                    this.formConfigModelo.nidversionveh     =   modelo.nIdVersionVeh;
                    this.verificarDosc(modelo);
                }
            },
            verificarDosc(modelo){
                var url = this.ruta + '/modeloconfig/GetInfoDocsModelo';

                axios.get(url, {
                    params: {
                        'nidmodelo'         : this.formConfigModelo.nidmodelo,
                        'naniomodelo'       : this.formConfigModelo.naniomodelo,
                        'nidversionveh'     : this.formConfigModelo.nidversionveh
                    }
                }).then(response => {
                    if(response.data != ''){
                        this.formConfigurador.urlImageFotografia      =   response.data[0].cFotoImageUrl;
                        this.formConfigurador.urlImageFichaTecnica    =   '';
                        this.cFlagAccion = 2;//EDICION
                    } else {
                        this.formConfigurador.urlImageFotografia = '';
                        this.formConfigurador.urlImageFichaTecnica = '';
                        this.cFlagAccion = 1;//REGISTRAR
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
            getFileFotografia(e){
                let selectFile  = e.target.files[0];
                if(selectFile) {
                    this.formConfigurador.attachmentFotografia = selectFile;
                    this.formConfigurador.urlImageFotografia   = URL.createObjectURL(selectFile);
                } else {
                    this.formConfigurador.attachmentFotografia = '';
                    this.formConfigurador.urlImageFotografia   = '';
                }
            },
            getFileFichaTecnica(e){
                let selectFile  = e.target.files[0];
                if(selectFile) {
                    this.formConfigurador.attachmentFichaTecnica = selectFile;
                    this.formConfigurador.urlImageFichaTecnica   = URL.createObjectURL(selectFile);
                } else {
                    this.formConfigurador.attachmentFichaTecnica = '';
                    this.formConfigurador.urlImageFichaTecnica   = '';
                }
            },
            getFileFichaTecnicaPDF(e){
                let selectFile  = e.target.files[0];
                if(selectFile) {
                    this.formConfigurador.attachmentFichaTecnicaPDF = selectFile;
                    this.formConfigurador.urlImageFichaTecnicaPDF   = URL.createObjectURL(selectFile);
                } else {
                    this.formConfigurador.attachmentFichaTecnicaPDF = '';
                    this.formConfigurador.urlImageFichaTecnicaPDF   = '';
                }
            },
            registrarDocsForModelo(){
                if(this.validarRegistrarDocForModelo()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                let me = this;
                //AGREGAR ARCHIVO AL FORM DATA
                this.form.append('fileFotografia', this.formConfigurador.attachmentFotografia);
                this.form.append('fileFichaTecnica', this.formConfigurador.attachmentFichaTecnica);
                this.form.append('fileFichaTecnicaPDF', this.formConfigurador.attachmentFichaTecnicaPDF);
                this.form.append('nidmodelo', this.formConfigModelo.nidmodelo);
                this.form.append('naniomodelo', this.formConfigModelo.naniomodelo);
                this.form.append('nidversionveh', this.formConfigModelo.nidversionveh);

                const config = { headers: { 'Content-Type': 'multipart/form-data'  } };

                // Mostrar ProgressBar
                this.mostrarProgressBar();

                let url;
                url = this.ruta + '/modeloconfig/SetRegistrarDocs';
                axios.post(url, this.form, config).then(response => {
                    // console.log(response.data)
                    if(response.data[0].nFlagMsje == 1) {
                        swal(response.data[0].cMensaje);
                        $("#myBar").hide();
                        me.listarModelos(1);
                        me.generarConfiguracion(1);
                        //me.limpiarFormulario();
                    } else {
                        swal(response.data[0].cMensaje);
                        $("#myBar").hide();
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
            validarRegistrarDocForModelo(){
                let me = this;

                me.error = 0;
                me.mensajeError =[];

                if (this.cFlagAccion == 1) {
                    if(!this.formConfigurador.attachmentFotografia && !this.formConfigurador.attachmentFichaTecnica && !this.formConfigurador.attachmentFichaTecnicaPDF) {
                        me.mensajeError.push('Debe Subir los documentos para el Nombre Comercial ');
                    }
                }

                if(me.mensajeError.length){
                    me.error = 1;
                }
                return me.error;
            },
            limpiarFormulario(){
                this.limpiarTabBsqModelo();
                this.generarConfiguracion(1);
            },
            actualizarDocsForModelo(){
                if(this.validarRegistrarDocForModelo()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                let me = this;
                //AGREGAR ARCHIVO AL FORM DATA
                this.form.append('fileFotografia', this.formConfigurador.attachmentFotografia);
                this.form.append('fileFichaTecnica', this.formConfigurador.attachmentFichaTecnica);
                this.form.append('fileFichaTecnicaPDF', this.formConfigurador.attachmentFichaTecnicaPDF);
                this.form.append('nidmodelo', this.formConfigModelo.nidmodelo);
                this.form.append('naniomodelo', this.formConfigModelo.naniomodelo);
                this.form.append('nidversionveh', this.formConfigModelo.nidversionveh);

                const config = { headers: { 'Content-Type': 'multipart/form-data'  } };

                // Mostrar ProgressBar
                this.mostrarProgressBar();

                let url;
                url = this.ruta + '/modeloconfig/SetActualizarDocs';
                axios.post(url, this.form, config).then(response => {
                    // console.log(response.data)
                    if(response.data[0].nFlagMsje == 1) {
                        swal(response.data[0].cMensaje);
                        $("#myBar").hide();
                        me.limpiarFormulario();
                    } else {
                        swal(response.data[0].cMensaje);
                        $("#myBar").hide();
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
            // =============================================
            // =============  MODAL ========================
            cerrarModal(){
                this.modal = 0
                this.error = 0,
                this.mensajeError = ''
            },
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case 'proveedor':
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
                    case 'accesorios':
                    {
                        switch(accion){
                            case 'ver':
                            {
                                this.accionmodal=3;
                                this.modal = 1;
                                this.listarAccesoriosPorVehiculo(data);
                                break;
                            }
                        }
                    }
                    break;
                }
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
    #preview{
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #preview img{
        max-width: 20%;
        min-width: 13%;
        max-height: 100px;
        border-radius:120px;
        border:5px solid #666;
    }
</style>
