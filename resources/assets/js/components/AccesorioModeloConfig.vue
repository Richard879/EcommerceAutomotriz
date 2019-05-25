<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <vs-divider color="dark">
                        <h2 class="no-margin-bottom">MODULO CONFIGURADOR DE ACCESORIOS POR NOMBRE COMERCIAL</h2>
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
                                        <a class="nav-link" :class="{'active': (vistaFormulario == 1)}" id="tab01" href="#TabBandejaVehiculos" @click="tabBandejaVehiculos" role="tab" data-toggle="tab">
                                            <i class="fa fa-wpforms"></i> BANDEJA DE VEHÍCULOS
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <template v-if="vistaFormulario">
                                        <div role="tabpanel" class="tab-pane fade" :class="{'in active show': (vistaFormulario == 1)}" id="TabBandejaVehiculos">
                                            <section class="forms">
                                                <div class="container-fluid">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h3 class="h4">BANDEJA DE VEHICULOS</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <form class="form-horizontal">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                                                <div class="col-sm-8">
                                                                                    <div class="input-group">
                                                                                        <input type="text" v-model="formBsqVehiculo.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
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
                                                                                    <el-select  v-model="formBsqVehiculo.nidlinea"
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
                                                                                    <el-select  v-model="formBsqVehiculo.nidmarca"
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
                                                                                    <el-select  v-model="formBsqVehiculo.nidmodelo"
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
                                                                                <label class="col-sm-4 form-control-label">Vehículo</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" v-model="formBsqVehiculo.cnombrevehiculo" @keyup.enter="listarVehiculos(1)" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-9 offset-md-5">
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="listarVehiculos(1)">
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
                                                                <h3 class="h4">LISTADO DE VEHÍCULOS</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <form class="form-horizontal">
                                                                    <template v-if="arrayListVehiculos.length">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped table-sm">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Acción</th>
                                                                                        <th>Vehiculo</th>
                                                                                        <th>Accesorios</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr v-for="(vehiculo, index) in arrayListVehiculos" :key="index">
                                                                                        <td>
                                                                                            <el-tooltip class="item" effect="dark">
                                                                                                <div slot="content">Generar Accesorios del Vehículo  {{ vehiculo.cNombreVehiculo }}</div>
                                                                                                <i @click="generarAccesorios(1, vehiculo)" :style="'color:#796AEE'" class="fa-md fa fa-check-square"></i>
                                                                                            </el-tooltip>
                                                                                            <el-tooltip class="item" effect="dark">
                                                                                                <div slot="content">Ver Accesorios del Vehículo  {{ vehiculo.cNombreVehiculo }}</div>
                                                                                                <i @click="abrirModal('accesorios', 'ver', vehiculo)" :style="'color:green'" class="fa-md fa fa-eye"></i>
                                                                                            </el-tooltip>
                                                                                        </td>
                                                                                        <td v-text="vehiculo.cNombreVehiculo"></td>
                                                                                        <td v-text="vehiculo.cCantidad"></td>
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
                                                                                                <a @click.prevent="cambiarPaginaVehiculos(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                            </li>
                                                                                            <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                            :class="[page==isActived?'active':'']">
                                                                                                <a class="page-link"
                                                                                                href="#" @click.prevent="cambiarPaginaVehiculos(page)"
                                                                                                v-text="page"></a>
                                                                                            </li>
                                                                                            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                                <a @click.prevent="cambiarPaginaVehiculos(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                        <div role="tabpanel" class="tab-pane fade" :class="{'in active show': (vistaFormulario == 0)}">
                                            <section class="forms">
                                                <div class="container-fluid">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h3 class="h4">CONFIGURADOR ACCESORIOS DEL VEHÍCULO {{ formConfigVehiculo.cnombrevehiculo }} </h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <form class="form-horizontal">
                                                                    <div class="col-lg-10"  style="max-height: 515px; overflow-x: auto;">
                                                                        <div id="lsttreegrupo">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-striped table-sm">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Acción</th>
                                                                                            <th>Accesorios</th>
                                                                                            <th>Costo</th>
                                                                                            <th>Cantidad</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr v-for="(elemento, index) in arrayElementoVentaFlag" :key="index">
                                                                                            <td>
                                                                                                <el-tooltip class="item" effect="dark">
                                                                                                    <div slot="content">Asignar  {{ elemento.cElementoNombre }}</div>
                                                                                                    <input type="checkbox" v-model="elemento.cFlagVerifica" class="checkbox-template">
                                                                                                </el-tooltip>
                                                                                            </td>
                                                                                            <td v-text="elemento.cElementoNombre"></td>
                                                                                            <td v-text="elemento.fElemenValorVenta"></td>
                                                                                            <td><input type="number" v-model="elemento.cantidad" class="form-control form-control-sm"/></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9 offset-sm-4">
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="seleccionarEleVenta()">
                                                                                <i class="fa fa-save"></i> Registrar
                                                                            </button>
                                                                            <button type="button" class="btn btn-secundary btn-corner btn-sm" @click="tabBandejaVehiculos()">
                                                                                <i class="fa fa-close"></i> Cancelar
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

            <!-- Modal Show Accecsorios -->
            <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTADO DE ACCESORIOS</h3>
                                    </div>
                                    <div class="card-body">
                                        <template v-if="arrayAccesorios.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Cod. SAP</th>
                                                            <th>Accesorio</th>
                                                            <th>Cantidad</th>
                                                            <th>Costo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="accesorio in arrayAccesorios" :key="accesorio.nIdPar">
                                                            <td v-text="accesorio.nIdElemento"></td>
                                                            <td v-text="accesorio.cCodigoERP"></td>
                                                            <td v-text="accesorio.cElementoNombre"></td>
                                                            <td v-text="accesorio.nCantidad"></td>
                                                            <td v-text="accesorio.fElemenValorVenta"></td>
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
                formBsqVehiculo:{
                    nidproveedor: '',
                    cproveedornombre: '',
                    nidlinea: '',
                    nidmarca: '',
                    nidmodelo: '',
                    cnombrevehiculo: ''
                },
                arrayLinea: [],
                arrayMarca: [],
                arrayModelo: [],
                arrayListVehiculos: [],
                arrayAccesorios: [],
                // =============================================================
                // ================ VARIABLES TAB CONFIG VEHICULO ==============
                // =============================================================
                formConfigVehiculo:{
                    nidversion: '',
                    naniomodelo: '',
                    cnombrevehiculo: ''
                },
                arrayElementoVenta: [],
                arrayElementoVentaFlag: [],
                arrayTemproralEV: [],
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
            this.tabBandejaVehiculos();
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
            tabBandejaVehiculos(){
                this.vistaFormulario = 1;
                this.limpiarTabBsqVehiculo();
                this.limpiarTabBsqConfigurarAccesorios();
            },
            limpiarTabBsqVehiculo(){
                this.formBsqVehiculo.nidproveedor       = '';
                this.formBsqVehiculo.cproveedornombre   = '';
                this.formBsqVehiculo.nidlinea           = '';
                this.formBsqVehiculo.nidmarca           = '';
                this.formBsqVehiculo.nidmodelo          = '';
                this.arrayListVehiculos = [];
            },
            validarBsqVehiculos(){
                this.error = 0;
                this.mensajeError =[];

                // if(this.formBsqVehiculo.nidproveedor == ''){
                //     this.mensajeError.push('Debe Seleccionar Proveedor');
                // }
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            listarVehiculos(page){
                if(this.validarBsqVehiculos()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/accesoriovehiculo/GetListVehiculos';
                axios.get(url, {
                    params: {
                        'nIdEmpresa'        :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nIdProveedor'      :   this.formBsqVehiculo.nidproveedor,
                        'nIdLinea'          :   this.formBsqVehiculo.nidlinea,
                        'nIdMarca'          :   this.formBsqVehiculo.nidmarca,
                        'nIdModelo'         :   this.formBsqVehiculo.nidmodelo,
                        'cNombreVehiculo'   :   this.formBsqVehiculo.cnombrevehiculo,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayListVehiculos        =   response.data.arrayListVehiculos.data;
                    this.pagination.current_page   =   response.data.arrayListVehiculos.current_page;
                    this.pagination.total          =   response.data.arrayListVehiculos.total;
                    this.pagination.per_page       =   response.data.arrayListVehiculos.per_page;
                    this.pagination.last_page      =   response.data.arrayListVehiculos.last_page;
                    this.pagination.from           =   response.data.arrayListVehiculos.from;
                    this.pagination.to             =   response.data.arrayListVehiculos.to;
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
            cambiarPaginaVehiculos(page){
                this.pagination.current_page=page;
                this.listarVehiculos(page);
            },
            listarAccesoriosPorVehiculo(data){
                var url = this.ruta + '/accesoriovehiculo/GetListAccesoriosByVehiculo';
                axios.get(url, {
                    params: {
                        'nIdEmpresa'        :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        // 'cnombrevehiculo'   :   data.cNombreVehiculo
                        'nIdVersionVeh'     :   data.nIdVersionVeh,
                        'nAnioModelo'       :   data.nAnioModelo
                    }
                }).then(response => {
                    this.arrayAccesorios   =   response.data;
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
                this.formBsqVehiculo.nidproveedor       = nProveedorId;
                this.formBsqVehiculo.cproveedornombre   = cProveedorNombre;
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
                        'nidproveedor'  :   this.formBsqVehiculo.nidproveedor,
                        'opcion': 1
                    }
                }).then(response => {
                    this.arrayLinea = response.data.arrayLinea
                    this.formBsqVehiculo.nidlinea = ''
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
                        'nidlinea'  : this.formBsqVehiculo.nidlinea,
                        'opcion'    : 1
                    }
                }).then(response => {
                    this.arrayMarca = response.data.arrayMarca
                    this.formBsqVehiculo.nidmarca = ''
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
                        'nidlinea'  : this.formBsqVehiculo.nidlinea,
                        'nidmarca'  : this.formBsqVehiculo.nidmarca,
                        'opcion'    : 1
                    }
                }).then(response => {
                    this.arrayModelo = response.data.arrayModelo;
                    this.formBsqVehiculo.nidmodelo = '';
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
            tabConfiguradorAccesorios(){
                this.vistaFormulario = 0;
                this.limpiarTabBsqConfigurarAccesorios();
            },
            limpiarTabBsqConfigurarAccesorios(){
                this.formConfigVehiculo.nidversion       = '';
                this.formConfigVehiculo.naniomodelo      = '';
                this.formConfigVehiculo.cnombrevehiculo  = '';
                this.arrayElementoVenta = [];
                this.arrayElementoVentaFlag = [];
                this.arrayTemproralEV = [];
            },
            generarAccesorios(op, vehiculo){
                this.tabConfiguradorAccesorios();
                this.formConfigVehiculo.nidversion      =   vehiculo.nIdVersionVeh
                this.formConfigVehiculo.naniomodelo     =   vehiculo.nAnioModelo
                this.formConfigVehiculo.cnombrevehiculo =   vehiculo.cNombreVehiculo
                this.listarElementoVenta(vehiculo);
            },
            listarElementoVenta(vehiculo){
                this.mostrarProgressBar();
                var url = this.ruta + '/accesoriovehiculo/GetListElemetosByVehiculo';
                axios.get(url, {
                    params: {
                        'nidempresa'        :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nIdVersionVeh'     :   vehiculo.nIdVersionVeh,
                        'nAnioModelo'       :   vehiculo.nAnioModelo
                    }
                }).then(response => {
                    this.arrayElementoVenta = response.data;
                    this.llenarInfo();
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
            llenarInfo(){
                let me = this;
                me.arrayElementoVentaFlag = [];
                me.arrayElementoVenta.map(function(value, key){
                    me.arrayElementoVentaFlag.push({
                        nIdElemento         :   value.nIdElemento,
                        cElementoNombre     :   value.cElementoNombre,
                        fElemenValorVenta   :   value.fElemenValorVenta,
                        cFlagVerifica       :   value.cFlagVerifica == 0 ? false : true,
                        cantidad            :   value.nCantidad
                    });
                });

                jQuery(function ($) {
                    $("#lsttreegrupo").treeview();
                });
                $("#myBar").hide();
            },
            seleccionarEleVenta(){
                let me = this;
                me.arrayTemproralEV = [];

                me.arrayElementoVentaFlag.map(function(value, key) {
                    //Recorre los elementos activos que esten activos
                    // if(me.arrayCheckElementoVenta[key] == true) {
                    if (value.cFlagVerifica == true) {
                        me.arrayTemproralEV.push({
                            nIdElemento     :   value.nIdElemento,
                            cantidad        :   value.cantidad,
                            cElementoNombre :   value.cElementoNombre
                        });
                    }
                });
                this.eliminarEleVenta();
            },
            eliminarEleVenta(){
                let me = this;
                if(this.validarEleVentaSelect()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                me.mostrarProgressBar();

                var url = this.ruta + '/accesoriovehiculo/DeleteElementosByVehiculo';
                axios.post(url, {
                    'nIdEmpresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                    // 'cnombrevehiculo'   : this.formConfigVehiculo.cnombrevehiculo
                    'nidversion'    :   this.formConfigVehiculo.nidversion,
                    'naniomodelo'   :   this.formConfigVehiculo.naniomodelo
                }).then(response => {
                    // console.log(response.data);
                    this.registrarEleVenta();
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
            registrarEleVenta(){
                var url = this.ruta + '/accesoriovehiculo/SetElementosByVehiculo';
                axios.post(url, {
                    'nIdEmpresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                    // 'cnombrevehiculo'   :   this.formConfigVehiculo.cnombrevehiculo,
                    'nidversion'    :   this.formConfigVehiculo.nidversion,
                    'naniomodelo'   :   this.formConfigVehiculo.naniomodelo,
                    'arrayData'     :   this.arrayTemproralEV
                }).then(response => {
                    swal('Accesorios Registrados exitosamente al Vehiculo ' + this.formConfigVehiculo.cnombrevehiculo);
                    $("#myBar").hide();
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
            validarEleVentaSelect(){
                let me = this;
                this.error = 0;
                this.mensajeError =[];

                me.arrayTemproralEV.map(function(value, key) {
                    //Recorre los elementos activos que esten activos
                    // if(me.arrayCheckElementoVenta[key] == true) {
                    if (value.cantidad == 0) {
                        me.mensajeError.push('Debe ingresar una cantidad en el Accesorio Seleccionado : ' + value.cElementoNombre);
                    }
                });

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
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
    .barraLateral{
        height: 45vh;
        max-width:1200px;
        overflow-x: auto;
        overflow-y: auto;
    }
    .styleElementos{
        background: beige !important;
        border-radius: .4rem !important;
        padding: .2rem !important;
        margin-bottom: .4rem !important;
        display: flex;
        justify-content: space-between;
    }
    .styleElementos input{
        border-radius: .3rem;
        margin-right: .6rem;
    }
</style>
