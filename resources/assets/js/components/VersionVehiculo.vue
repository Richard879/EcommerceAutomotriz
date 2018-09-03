<template>
    <main>
        <header class="page-header">
          <div class="container-fluid">
            <h2 class="no-margin-bottom">VERSIÓN VEHÍCULO</h2>
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
                                                        <input type="hidden" v-model="formVersion.nidproveedor">
                                                        <input type="text" v-model="formVersion.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
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
                                                <label class="col-sm-4 form-control-label">Clase</label>
                                                <div class="col-sm-8">
                                                    <select name="account" v-model="formVersion.nidclase" class="form-control form-control-sm">
                                                        <option v-for="clase in arrayClase" :key="clase.nIdPar" :value="clase.nIdPar" v-text="clase.cParNombre">
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">SubClase</label>
                                                <div class="col-sm-8">
                                                    <select name="account" v-model="formVersion.nidsubclase" class="form-control form-control-sm">
                                                        <option v-for="subclase in arraySubClase" :key="subclase.nIdPar" :value="subclase.nIdPar" v-text="subclase.cParNombre">
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Linea Vehiculo</label>
                                                <div class="col-sm-8">
                                                    <select name="account" v-model="formVersion.nidlinea" class="form-control form-control-sm" v-on:change="llenarComboMarca();">
                                                        <option v-for="linea in arrayLinea" :key="linea.nIdPar" :value="linea.nIdPar" v-text="linea.cParNombre">
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Marca</label>
                                                <div class="col-sm-8">
                                                    <select name="account" v-model="formVersion.nidmarca" class="form-control form-control-sm" v-on:change="llenarComboModelo();">
                                                        <option v-for="marca in arrayMarca" :key="marca.nIdPar" :value="marca.nIdPar" v-text="marca.cParNombre">
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Modelo</label>
                                                <div class="col-sm-8">
                                                    <select name="account" v-model="formVersion.nidmodelo" class="form-control form-control-sm">
                                                        <option v-for="modelo in arrayModelo" :key="modelo.nIdPar" :value="modelo.nIdPar" v-text="modelo.cParNombre">
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Nombre Comercial</label>
                                                <div class="col-sm-8">
                                                    <input type="hidden" v-model="formVersion.nidversionveh">
                                                    <input type="text" v-model="formVersion.cnombrecomercial" @keyup.enter="buscarVersionVehiculo()" class="form-control form-control-sm" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-9 offset-sm-4">
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
                                                        <a href="#" @click="abrirFormulario('versionvehiculo','actualizar', vehiculo)" data-toggle="tooltip" data-placement="top"
                                                            :title="'Editar ' +vehiculo.cNombreComercial">
                                                            <i class="fa-md fa fa-edit"></i>
                                                        </a>
                                                        <template v-if="vehiculo.cVersionVehEstado=='A'">
                                                            <a href="#" @click="desactivar(vehiculo.nIdVersionVeh)" data-toggle="tooltip" data-placement="top"
                                                            :title="'Desactivar ' +vehiculo.nIdVersionVeh">
                                                                <i class="fa-md fa fa-check-square"></i>
                                                            </a>
                                                        </template>
                                                        <template v-else>
                                                            <a href="#" @click="activar(vehiculo.nIdVersionVeh)" data-toggle="tooltip" data-placement="top"
                                                            :title="'Activar ' +vehiculo.nIdVersionVeh">
                                                                <i :style="'color:red'" class="fa-md fa fa-square"></i>
                                                            </a>
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
                                                        <input type="hidden" v-model="formVersion.nidproveedor">
                                                        <input type="text" v-model="formVersion.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
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
                                                <label class="col-sm-4 form-control-label">* Clase</label>
                                                <div class="col-sm-8">
                                                    <select name="account" v-model="formVersion.nidclase" class="form-control form-control-sm">
                                                        <option v-for="clase in arrayClase" :key="clase.nIdPar" :value="clase.nIdPar" v-text="clase.cParNombre">
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Sub Clase</label>
                                                <div class="col-sm-8">
                                                    <select name="account" v-model="formVersion.nidsubclase" class="form-control form-control-sm">
                                                        <option v-for="subclase in arraySubClase" :key="subclase.nIdPar" :value="subclase.nIdPar" v-text="subclase.cParNombre">
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Linea Vehículo</label>
                                                <div class="col-sm-8">
                                                    <select name="account" v-model="formVersion.nidlinea" class="form-control form-control-sm" v-on:change="llenarComboMarca();">
                                                        <option v-for="linea in arrayLinea" :key="linea.nIdPar" :value="linea.nIdPar" v-text="linea.cParNombre">
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Marca</label>
                                                <div class="col-sm-8">
                                                    <select name="account" v-model="formVersion.nidmarca" class="form-control form-control-sm" v-on:change="llenarComboModelo();">
                                                        <option v-for="marca in arrayMarca" :key="marca.nIdPar" :value="marca.nIdPar" v-text="marca.cParNombre">
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Modelo</label>
                                                <div class="col-sm-8">
                                                    <select name="account" v-model="formVersion.nidmodelo" class="form-control form-control-sm">
                                                        <option v-for="modelo in arrayModelo" :key="modelo.nIdPar" :value="modelo.nIdPar" v-text="modelo.cParNombre">
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Nombre Comercial</label>
                                                <div class="col-sm-8">
                                                    <input type="hidden" v-model="formVersion.nidversionveh">
                                                    <input type="text" v-model="formVersion.cnombrecomercial" class="form-control form-control-sm" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-9 offset-sm-4">
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

        <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form v-on:submit.prevent class="form-horizontal">
                            <div class="container-fluid">
                                <div class="col-lg-12">
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
                                                                    <input type="text" v-model="fillProveedor.cnombreproveedor" @keyup.enter="buscaProveedores()" class="form-control form-control-sm">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" title="Buscar Vehículos" class="btn btn-info btn-corner btn-sm" @click="buscaProveedores();"><i class="fa-lg fa fa-search"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
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
                                                                        <a href="#" @click="asignarProveedor(proveedor.nIdPar, proveedor.cParNombre);">
                                                                            <i class='fa-md fa fa-check-circle'></i>
                                                                        </a>
                                                                    </td>
                                                                    <td v-text="proveedor.cParNombre"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="col-lg-7">
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
                                                            <div class="col-lg-5">
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
</template>
<script>
    export default {
        props:['ruta'],
        data(){
            return {
                cempresa: 'SAISAC',
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
                    nidempresa: 0,
                    nidproveedor: 0,
                    cproveedornombre: '',
                    nidclase: 0,
                    nidsubclase: 0,
                    nidlinea: 0,
                    nidmarca: 0,
                    nidmodelo: 0,
                    nidaniofabricacion: 0,
                    nidanioversion: 0,
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
                        'ngrupoparid' : 110029,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayClase = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboSubClase(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';

                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110030,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arraySubClase = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboLinea(){
                var url = this.ruta + '/versionvehiculo/GetLineasByProveedor';

                axios.get(url, {
                    params: {
                        'nidempresa' : 1300011,
                        'nidproveedor' : this.formVersion.nidproveedor
                    }
                }).then(response => {
                    this.arrayLinea = response.data;
                    if(this.vistaFormulario){
                        this.formVersion.nidlinea = 0;
                    }
                    this.llenarComboMarca();
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboMarca(){
                var url = this.ruta + '/versionvehiculo/GetMarcaByLinea';

                axios.get(url, {
                    params: {
                        'nidlinea' : this.formVersion.nidlinea
                    }
                }).then(response => {
                    this.arrayMarca = response.data;
                    if(this.vistaFormulario){
                        this.formVersion.nidmarca = 0;
                    }
                    this.arrayModelo = [];
                    this.llenarComboModelo();
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboModelo(){
                var url = this.ruta + '/versionvehiculo/GetModeloByMarca';

                axios.get(url, {
                    params: {
                        'nidmarca' : this.formVersion.nidmarca
                    }
                }).then(response => {
                    this.arrayModelo = response.data;
                    if(this.vistaFormulario){
                        this.formVersion.nidmodelo = 0;
                    }
                }).catch(error => {
                    console.log(error);
                });
            },
            buscaProveedores(){
                this.listarProveedores(1);
            },
            listarProveedores(page){
                var url = this.ruta + '/parametro/GetLstProveedor';

                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidgrupopar' : 110023,
                        'cnombreproveedor' : this.fillProveedor.cnombreproveedor.toString(),
                        'opcion' : 1,
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
                if(this.formVersion.nidproveedor == 0){
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
                        'nidempresa' : 1300011,
                        'nidproveedor' : this.formVersion.nidproveedor,
                        'nidclase' : this.formVersion.nidclase,
                        'nidsubclase' : this.formVersion.nidsubclase,
                        'nidlinea' : this.formVersion.nidlinea,
                        'nidmarca' : this.formVersion.nidmarca,
                        'nidmodelo' : this.formVersion.nidmodelo,
                        'cnombrecomercial' : this.formVersion.cnombrecomercial.toString(),
                        'page' : page
                    }
                }).then(response => {
                    this.arrayVersionVehiculo = response.data.arrayVersionVehiculo.data;
                    this.pagination.current_page =  response.data.arrayVersionVehiculo.current_page;
                    this.pagination.total = response.data.arrayVersionVehiculo.total;
                    this.pagination.per_page    = response.data.arrayVersionVehiculo.per_page;
                    this.pagination.last_page   = response.data.arrayVersionVehiculo.last_page;
                    this.pagination.from        = response.data.arrayVersionVehiculo.from;
                    this.pagination.to           = response.data.arrayVersionVehiculo.to;
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
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
                    nIdEmpresa: 1300011,
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
                        this.listarVersionVehiculo(1);
                        this.vistaFormulario = 1;
                    }
                    else{
                        swal('Ya existe Vehiculo');
                    }
                }).catch(error => {
                    console.log(error);
                });
            },
            validar(){
                this.error = 0;
                this.mensajeError =[];

                if(this.accion == 2 && this.formVersion.nidversionveh == 0){
                    this.mensajeError.push('No ha seleccionado el Vehiculo');
                }

                if(!this.formVersion.nidproveedor || this.formVersion.nidproveedor == 0){
                    this.mensajeError.push('Debes Ingresar el Proveedor');
                };
                if(this.formVersion.nidclase == 0){
                    this.mensajeError.push('Debes Ingresar una Clase');
                };
                if(this.formVersion.nidsubclase == 0){
                    this.mensajeError.push('Debes Ingresar una Sub clase');
                };
                if(this.formVersion.nidlinea == 0){
                    this.mensajeError.push('Debes Ingresar una Línea');
                };
                if(this.formVersion.nidmarca == 0){
                    this.mensajeError.push('Debes Ingresar una Marca');
                };
                if(this.formVersion.nidmodelo == 0){
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
                    nIdEmpresa: 1300011,
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
                        this.listarVersionVehiculo(1);
                        this.vistaFormulario = 1;
                    }
                    else{
                        swal('Ya existe Vehiculo');
                    }
                }).catch(error => {
                    console.log(error);
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
                //this.formVersion.nidproveedor= 0,
                //this.formVersion.cproveedornombre= '',
                this.formVersion.nidclase=  0,
                this.formVersion.nidsubclase= 0,
                this.formVersion.nidlinea= 0,
                this.formVersion.nidmarca= 0,
                this.formVersion.nidmodelo= 0,
                this.formVersion.cnombrecomercial= '',
                this.formVersion.nidaniofabricacion= 0,
                this.formVersion.nidanioversion= 0
                //this.arrayVersionVehiculo = []
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
