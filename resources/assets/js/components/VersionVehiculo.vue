<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">
                        <vs-divider color="dark">MODULO VERSIÓN VEHÍCULO</vs-divider>
                    </h2>
                </div>
            </header>

            <template v-if="vistaFormulario">
                <section class="forms">
                    <div class="container-fluid">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4">BUSCAR VERSION VEHICULO</h3>
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
                                                    <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" v-model="formVersion.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
                                                            <div class="input-group-prepend">
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Buscar Proveedor </div>
                                                                    <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('proveedor','buscar')">
                                                                        <i class="fa-lg fa fa-search"></i>
                                                                    </button>
                                                                </el-tooltip>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Clase</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="formVersion.nidclase" filterable clearable placeholder="SELECCIONE" >
                                                            <el-option
                                                            v-for="item in arrayClase"
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
                                                    <label class="col-sm-4 form-control-label">SubClase</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="formVersion.nidsubclase" filterable clearable placeholder="SELECCIONE" >
                                                            <el-option
                                                            v-for="item in arraySubClase"
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
                                                    <label class="col-sm-4 form-control-label">Linea Vehiculo</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="formVersion.nidlinea" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboMarca()">
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
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Marca</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="formVersion.nidmarca" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboModelo()">
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
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Modelo</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="formVersion.nidmodelo" filterable clearable placeholder="SELECCIONE" >
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
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Nombre Comercial</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="formVersion.cnombrecomercial" @keyup.enter="buscarVersionVehiculo()" class="form-control form-control-sm" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9 offset-sm-5">
                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarVersionVehiculo();">
                                                    <i class="fa fa-search"></i> Buscar
                                                </button>
                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="abrirFormulario('versionvehiculo','registrar')">
                                                    <i class="fa fa-file-o"></i> Nuevo
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
                                    <template v-if="arrayVersionVehiculo.length">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Codigo</th>
                                                        <th>Línea</th>
                                                        <th>Marca</th>
                                                        <th>Modelo</th>
                                                        <th>Nombre Comercial</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="vehiculo in arrayVersionVehiculo" :key="vehiculo.nIdVersionVeh">
                                                        <td v-text="vehiculo.nIdVersionVeh"></td>
                                                        <td v-text="vehiculo.cLineaNombre"></td>
                                                        <td v-text="vehiculo.cMarcaNombre"></td>
                                                        <td v-text="vehiculo.cModeloNombre"></td>
                                                        <td v-text="vehiculo.cNombreComercial"></td>
                                                        <td>
                                                            <el-tooltip class="item" :content="'Editar ' + vehiculo.cNombreComercial" effect="dark" placement="top-start">
                                                                <i @click="abrirFormulario('versionvehiculo','actualizar', vehiculo)" :style="'color:#796AEE'" class="fa-md fa fa-edit"></i>
                                                            </el-tooltip>&nbsp;
                                                            <template v-if="vehiculo.cVersionVehEstado=='A'">
                                                                <el-tooltip class="item" :content="'Desactivar ' + vehiculo.cNombreComercial" effect="dark" placement="top-start">
                                                                    <i @click="desactivar(vehiculo.nIdVersionVeh)" :style="'color:#796AEE'" class="fa-md fa fa-check-square"></i>
                                                                </el-tooltip>
                                                            </template>
                                                            <template v-else>
                                                                <el-tooltip class="item" :content="'Activar ' + vehiculo.cNombreComercial" effect="dark" placement="top-start">
                                                                    <i @click="activar(vehiculo.nIdVersionVeh)" :style="'color:red'" class="fa-md fa fa-square"></i>
                                                                </el-tooltip>
                                                            </template>
                                                        </td>
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
            </template>

            <template v-else>
                <section class="forms">
                    <div class="container-fluid">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4" v-text="tituloFormulario"></h3>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Empresa</label>
                                                    <div class="col-sm-8">
                                                        <input v-model="cempresa" class="form-control form-control-sm" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" v-model="formVersion.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
                                                            <div class="input-group-prepend">
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Buscar Proveedor </div>
                                                                    <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('proveedor','buscar')">
                                                                        <i class="fa-lg fa fa-search"></i>
                                                                    </button>
                                                                </el-tooltip>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Clase</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="formVersion.nidclase" filterable clearable placeholder="SELECCIONE" >
                                                            <el-option
                                                            v-for="item in arrayClase"
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
                                                    <label class="col-sm-4 form-control-label">* Sub Clase</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="formVersion.nidsubclase" filterable clearable placeholder="SELECCIONE" >
                                                            <el-option
                                                            v-for="item in arraySubClase"
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
                                                    <label class="col-sm-4 form-control-label">* Linea Vehículo</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="formVersion.nidlinea" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboMarca()">
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
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Marca</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="formVersion.nidmarca" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboModelo()">
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
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Modelo</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="formVersion.nidmodelo" filterable clearable placeholder="SELECCIONE">
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
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Nombre Comercial</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="formVersion.cnombrecomercial" class="form-control form-control-sm" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9 offset-sm-5">
                                                <button type="button" v-if="accion==1" class="btn btn-success btn-corner btn-sm" @click="registrar()">
                                                    <i class="fa fa-save"></i> Registrar
                                                </button>
                                                <button type="button" v-if="accion==2" class="btn btn-secondary btn-corner btn-sm" @click="actualizar()">
                                                    <i class="fa fa-save"></i> Actualizar
                                                </button>
                                                <button type="button" class="btn btn-secundary btn-corner btn-sm" @click="cambiarVistaFormulario()">
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
            </template>

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

            <!-- Modal Buscar Proveedores -->
            <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTA DE PROVEEDORES</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Nombre</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillProveedor.cnombreproveedor" @keyup.enter="buscaProveedores()" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Buscar Proveedor </div>
                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="buscaProveedores()">
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
                cempresa: sessionStorage.getItem("cNombreEmpresa"),
                arrayVersionVehiculo: [],
                arrayClase: [],
                arraySubClase: [],
                arrayLinea: [],
                arrayMarca: [],
                arrayModelo: [],
                arrayAnioFabricacion: [],
                arrayAnioVersion: [],
                arrayProveedor: [],
                fillProveedor:{
                    cnombreproveedor: ''
                },
                formVersion:{
                    nidproveedor: 0,
                    cproveedornombre: '',
                    nidclase: '',
                    nidsubclase: '',
                    nidlinea: '',
                    nidmarca: '',
                    nidmodelo: '',
                    nidversionveh: 0,
                    cnombrecomercial:''
                },
                pagination: {
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
                vistaFormulario: 1
            }
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
            llenarComboClase(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';

                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110029
                    }
                }).then(response => {
                    this.arrayClase = response.data;
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
            llenarComboSubClase(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';

                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110030
                    }
                }).then(response => {
                    this.arraySubClase = response.data;
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
            llenarComboLinea(){
                var url = this.ruta + '/versionvehiculo/GetLineasByProveedor';

                axios.get(url, {
                    params: {
                        'nidempresa' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidproveedor' : this.formVersion.nidproveedor,
                        'opcion': 1
                    }
                }).then(response => {
                    this.arrayLinea = response.data.arrayLinea;
                    if(this.vistaFormulario){
                        this.formVersion.nidlinea = '';
                    }
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
                var url = this.ruta + '/versionvehiculo/GetMarcaByLinea';

                axios.get(url, {
                    params: {
                        'nidlinea' : this.formVersion.nidlinea,
                        'opcion': 1
                    }
                }).then(response => {
                    this.arrayMarca = response.data.arrayMarca;
                    if(this.vistaFormulario){
                        this.arrayVersionVehiculo=[];
                    }
                    this.formVersion.nidmarca = '';
                    this.arrayModelo = [];
                    this.formVersion.nidmodelo = '';
                    //this.llenarComboModelo();
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
                        'nidlinea': this.formVersion.nidlinea,
                        'nidmarca': this.formVersion.nidmarca,
                        'opcion': 1
                    }
                }).then(response => {
                    this.arrayModelo = response.data.arrayModelo;
                    if(this.vistaFormulario){
                        this.arrayVersionVehiculo=[];
                    }
                    this.formVersion.nidmodelo = '';
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
            buscaProveedores(){
                this.listarProveedores(1);
            },
            listarProveedores(page){
                var url = this.ruta + '/parametro/GetLstProveedor';

                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidgrupopar' : 110023,
                        'cnombreproveedor' : this.fillProveedor.cnombreproveedor.toString(),
                        'opcion' : 0,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayProveedor = response.data.arrayProveedor.data;
                    this.paginationModal.current_page =  response.data.arrayProveedor.current_page;
                    this.paginationModal.total = response.data.arrayProveedor.total;
                    this.paginationModal.per_page    = response.data.arrayProveedor.per_page;
                    this.paginationModal.last_page   = response.data.arrayProveedor.last_page;
                    this.paginationModal.from        = response.data.arrayProveedor.from;
                    this.paginationModal.to           = response.data.arrayProveedor.to;
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
                this.formVersion.nidproveedor = nProveedorId;
                this.formVersion.cproveedornombre = cProveedorNombre;
                this.cerrarModal();
                this.arrayMarca = [];
                this.arrayModelo = [];
                this.llenarComboLinea();
            },
            buscarVersionVehiculo(){
                if(this.validarBusqueda()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.listarVersionVehiculo(1);
            },
            validarBusqueda(){
                this.error = 0;
                this.mensajeError =[];
                if(this.formVersion.nidproveedor == 0 || !this.formVersion.nidproveedor){
                    this.mensajeError.push('Debes Seleccionar el Proveedor');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            listarVersionVehiculo(page){
                this.mostrarProgressBar();
                var url = this.ruta + '/versionvehiculo/GetVersionVehiculo';

                axios.get(url, {
                    params: {
                        'nidempresa'    : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidproveedor'  : this.formVersion.nidproveedor,
                        'nidclase'      : this.formVersion.nidclase,
                        'nidsubclase'   : this.formVersion.nidsubclase,
                        'nidlinea'      : this.formVersion.nidlinea,
                        'nidmarca'      : this.formVersion.nidmarca,
                        'nidmodelo'     : this.formVersion.nidmodelo,
                        'cnombrecomercial' : this.formVersion.cnombrecomercial.toString(),
                        'page'          : page
                    }
                }).then(response => {
                    this.arrayVersionVehiculo   = response.data.arrayVersionVehiculo.data;
                    this.pagination.current_page= response.data.arrayVersionVehiculo.current_page;
                    this.pagination.total       = response.data.arrayVersionVehiculo.total;
                    this.pagination.per_page    = response.data.arrayVersionVehiculo.per_page;
                    this.pagination.last_page   = response.data.arrayVersionVehiculo.last_page;
                    this.pagination.from        = response.data.arrayVersionVehiculo.from;
                    this.pagination.to          = response.data.arrayVersionVehiculo.to;
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
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarVersionVehiculo(page);
            },
            registrar(){
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/versionvehiculo/SetVersion';
                axios.post(url, {
                    nIdEmpresa: parseInt(sessionStorage.getItem("nIdEmpresa")),
                    nIdProveedor: parseInt(this.formVersion.nidproveedor),
                    nIdClase: parseInt(this.formVersion.nidclase),
                    nIdSubClase: parseInt(this.formVersion.nidsubclase),
                    nIdLinea: parseInt(this.formVersion.nidlinea),
                    nIdMarca: parseInt(this.formVersion.nidmarca),
                    nIdModelo: parseInt(this.formVersion.nidmodelo),
                    cNombreComercial: this.formVersion.cnombrecomercial.toUpperCase().toString()
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Versión Vehículo registrado');
                        this.limpiarFormulario();
                        this.arrayVersionVehiculo= [];
                        //this.listarVersionVehiculo(1);
                        //this.vistaFormulario = 1;
                    }
                    else{
                        swal('Ya existe Vehiculo');
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
            validar(){
                this.error = 0;
                this.mensajeError =[];

                if(this.accion == 2 && this.formVersion.nidversionveh == 0){
                    this.mensajeError.push('No ha seleccionado el Vehiculo');
                }

                if(this.formVersion.nidproveedor == 0 || !this.formVersion.nidproveedor){
                    this.mensajeError.push('Debes Ingresar el Proveedor');
                };
                if(this.formVersion.nidclase == 0 || !this.formVersion.nidclase){
                    this.mensajeError.push('Debes Ingresar una Clase');
                };
                if(this.formVersion.nidsubclase == 0 || !this.formVersion.nidsubclase){
                    this.mensajeError.push('Debes Ingresar una Sub clase');
                };
                if(this.formVersion.nidlinea == 0 || !this.formVersion.nidlinea){
                    this.mensajeError.push('Debes Ingresar una Línea');
                };
                if(this.formVersion.nidmarca == 0 || !this.formVersion.nidmarca){
                    this.mensajeError.push('Debes Ingresar una Marca');
                };
                if(this.formVersion.nidmodelo == 0 || !this.formVersion.nidmodelo){
                    this.mensajeError.push('Debes Ingresar un Modelo');
                };
                if(!this.formVersion.cnombrecomercial){
                    this.mensajeError.push('Debes Ingresar un Nombre comercial');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            actualizar(){
                var url = this.ruta + '/versionvehiculo/UpdVersionVehiculoById';

                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                axios.post(url, {
                    nIdVersionVeh: parseInt(this.formVersion.nidversionveh),
                    nIdEmpresa: parseInt(sessionStorage.getItem("nIdEmpresa")),
                    nIdProveedor: parseInt(this.formVersion.nidproveedor),
                    nIdClase: parseInt(this.formVersion.nidclase),
                    nIdSubClase: parseInt(this.formVersion.nidsubclase),
                    nIdLinea: parseInt(this.formVersion.nidlinea),
                    nIdMarca: parseInt(this.formVersion.nidmarca),
                    nIdModelo: parseInt(this.formVersion.nidmodelo),
                    cNombreComercial: this.formVersion.cnombrecomercial.toUpperCase().toString()
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Versión Vehículo Actualizado');
                        this.limpiarFormulario();
                        //this.listarVersionVehiculo(1);
                        //this.vistaFormulario = 1;
                    }
                    else{
                        swal('Ya existe Vehiculo');
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
            activar(nIdVersionVeh){
                swal({
                    title: 'Estas seguro de activar este vehículo?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Activar!',
                    cancelButtonText: 'No, cancelar!'
                    }).then((result) => {
                        if (result.value) {
                            var url = this.ruta + '/versionvehiculo/activar';
                            axios.put(url, {
                                nIdVersionVeh: parseInt(nIdVersionVeh)
                            }).then(response => {
                                swal(
                                'Activado!',
                                'El registro fue activado.'
                                );
                                this.listarVersionVehiculo(1);
                            })
                            .catch(function (error) {
                                console.log(error);
                                if (error.response) {
                                    if (error.response.status == 401) {
                                        swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                        location.reload('0');
                                    }
                                }
                            });
                        } else if (result.dismiss === swal.DismissReason.cancel)
                        {
                        }
                    })
            },
            desactivar(nIdVersionVeh){
                swal({
                    title: 'Estas seguro de desactivar este vehículo?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Desactivar!',
                    cancelButtonText: 'No, cancelar!'
                    }).then((result) => {
                        if (result.value) {
                            var url = this.ruta + '/versionvehiculo/desactivar';
                            axios.put(url, {
                                nIdVersionVeh: parseInt(nIdVersionVeh)
                            }).then(response => {
                                swal(
                                'Desactivado!',
                                'El registro fue desactivado.'
                                );
                                this.listarVersionVehiculo(1);
                            })
                            .catch(function (error) {
                                console.log(error);
                                if (error.response) {
                                    if (error.response.status == 401) {
                                        swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                        location.reload('0');
                                    }
                                }
                            });
                        } else if (result.dismiss === swal.DismissReason.cancel)
                        {
                        }
                    })
            },
            cerrarModal(){
                //this.accionmodal==1;
                this.modal = 0
                /*this.nombre = '',
                this.descripcion = '',
                this.tituloModal = '',*/
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
                }
            },
            abrirFormulario(modelo, accion, data =[]){
                switch(modelo){
                    case 'versionvehiculo':
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.vistaFormulario = 0;
                                this.accion = 1;
                                this.llenarComboClase();
                                this.llenarComboSubClase();
                                this.llenarComboLinea();
                                this.llenarComboMarca();
                                this.llenarComboModelo();
                                this.tituloFormulario = 'NUEVO VERSION VEHICULO';
                                this.limpiarFormulario();
                                break;
                            }
                            case 'actualizar':
                            {
                                this.vistaFormulario = 0;
                                this.accion = 2;
                                this.formVersion.nidproveedor = data['nIdProveedor'];
                                this.formVersion.cproveedornombre = data['cProveedorNombre'];
                                this.llenarComboClase();
                                this.llenarComboSubClase();
                                this.llenarComboLinea();
                                this.formVersion.nidclase = data['nIdClase'];
                                this.formVersion.nidsubclase = data['nIdSubClase'];
                                this.formVersion.nidlinea = data['nIdLinea'];
                                //this.llenarComboMarca();
                                this.formVersion.nidmarca = data['nIdMarca'];
                                //this.llenarComboModelo();
                                this.tituloFormulario = 'ACTUALIZAR VERSION VEHICULO';
                                this.formVersion.nidmodelo = data['nIdModelo'];
                                this.formVersion.nidversionveh = data['nIdVersionVeh'];
                                this.formVersion.cnombrecomercial = data['cNombreComercial'];
                                break;
                            }
                        }
                    }
                }
            },
            cambiarVistaFormulario(){
                if(this.accion == 1){
                    this.limpiarFormulario();
                    this.vistaFormulario = 1;
                }else{
                    this.limpiarFormulario();
                    this.vistaFormulario = 1;
                }
            },
            limpiarFormulario(){
                /*this.formVersion.nidclase=  '',
                this.formVersion.nidsubclase= '',
                this.formVersion.nidlinea= '',
                this.formVersion.nidmarca= '',
                this.formVersion.nidmodelo= '',*/
                this.formVersion.cnombrecomercial= ''
            },
            mostrarProgressBar(){
                $("#myBar").show();
                progress();
            }
        },
        mounted(){
            this.llenarComboClase();
            this.llenarComboSubClase();
            this.llenarComboLinea();
            this.llenarComboMarca();
            this.llenarComboModelo();
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
