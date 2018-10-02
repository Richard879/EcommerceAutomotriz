<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">ASIGNACION VENDEDOR A MODELO</h2>
                </div>
            </header>

            <template v-if="vistaFormulario">
                <section class="forms">
                    <div class="container-fluid">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4">BUSCAR LINEAS</h3>
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
                                                    <label class="col-sm-4 form-control-label">* Jefe de ventas</label>
                                                    <div class="col-sm-8">
                                                        <label v-text="formAsignaModelo.cJefeVentaNombre" class="form-control-label-readonly"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" v-model="formAsignaModelo.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
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
                                            <div class="col-sm-9 offset-sm-5">
                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarProveedorLinea()">
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
                                    <h3 class="h4">LISTADO LINEAS</h3>
                                </div>
                                <div class="card-body">
                                    <template v-if="arrayProveedorLinea.length">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Acciones</th>
                                                        <th>Código</th>
                                                        <th>Linea</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="proveedorlinea in arrayProveedorLinea" :key="proveedorlinea.nIdLinea">
                                                        <td>
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Seleccionar {{ proveedorlinea.cLineaNombre }}</div>
                                                                <i @click="abrirModalVendedor('vendedor','asignar',proveedorlinea)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                            </el-tooltip>
                                                        </td>
                                                        <td v-text="proveedorlinea.nIdLinea"></td>
                                                        <td v-text="proveedorlinea.cLineaNombre"></td>
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

            <!-- MODAL ASIGNAR MODELOS -->
            <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form v-on:submit.prevent class="form-horizontal">
                                <div class="container-fluid">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">ASIGNACION MODELO A VENDEDOR</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 form-control-label">Proveedor</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" v-model="fillVendedor.cnombreproveedor" class="form-control form-control-sm" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 form-control-label">Linea Venta</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" v-model="fillVendedor.cnombrelineaventa" class="form-control form-control-sm" readonly>
                                                        <input type="hidden" v-model="fillVendedor.nidlineaventa" class="form-control form-control-sm" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 form-control-label">Jefe de ventas</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" v-model="fillVendedor.cnombrejefeventas" class="form-control form-control-sm" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 form-control-label">Marca</label>
                                                    <div class="col-sm-4">
                                                        <el-select v-model="fillVendedor.nidmarca" filterable placeholder="Select" v-on:change="llenarComboModelo();">
                                                            <el-option
                                                            v-for="marca in arrayMarca"
                                                            :key="marca.nIdPar"
                                                            :label="marca.cParNombre"
                                                            :value="marca.nIdPar">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 form-control-label">Modelo</label>
                                                    <div class="col-sm-4">
                                                        <el-select v-model="fillVendedor.nidmodelo" filterable placeholder="Select" v-on:change="listarVendedorLinea(1);">
                                                            <el-option
                                                            v-for="modelo in arrayModelo"
                                                            :key="modelo.nIdPar"
                                                            :label="modelo.cParNombre"
                                                            :value="modelo.nIdPar">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>
                                            <template v-if="arrayVendedorLinea.length">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Asignar</th>
                                                                <th>Asesor comercial</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="vendedor in arrayVendedorLinea" :key="vendedor.nIdMiVendedor">
                                                                <td>
                                                                    <template v-if="vendedor.nIdVendedor == 0">
                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                            <div slot="content">Asignar {{ vendedor.cNombreMiVendedor }}</div>
                                                                            <i @click="asignar(vendedor.nIdMiVendedor)" :style="'color:red'" class="fa-md fa fa-square"></i>
                                                                        </el-tooltip>
                                                                    </template>
                                                                    <template v-else>
                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                            <div slot="content">Desasignar {{ vendedor.cNombreMiVendedor }}</div>
                                                                            <i @click="designar(vendedor.nIdAsignacionVendedorModelo)" :style="'color:#796AEE'" class="fa-md fa fa-check-square"></i>
                                                                        </el-tooltip>
                                                                    </template>
                                                                </td>
                                                                <td v-text="vendedor.cNombreMiVendedor"></td>
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
                                                                        <a @click.prevent="cambiarPaginaVendedor(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                    </li>
                                                                    <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                    :class="[page==isActivedModal?'active':'']">
                                                                        <a class="page-link"
                                                                        href="#" @click.prevent="cambiarPaginaVendedor(page)"
                                                                        v-text="page"></a>
                                                                    </li>
                                                                    <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                        <a @click.prevent="cambiarPaginaVendedor(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
        data(){
            return {
                cempresa: 'SAISAC',
                csucursal: sessionStorage.getItem("cNombreSucursal"),
                arrayProveedorLinea: [],
                arrayJefeVentas: [],
                arrayProveedor: [],
                arrayMarca: [],
                arrayModelo: [],
                arrayVendedorLinea: [],
                fillProveedor:{
                    cnombreproveedor: ''
                },
                fillVendedor:{
                    cnombreproveedor: '',
                    cnombrelineaventa: '',
                    nidlineaventa: 0,
                    cnombrejefeventas: '',
                    nidmarca: 0,
                    nidmodelo: 0
                },
                formAsignaModelo:{
                    nidproveedor: 0,
                    nJefeVentaId: 0,
                    cJefeVentaNombre: 'NO ES JEFE DE VENTAS'
                },
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
            informacionUsuario(){
                var url = this.ruta + '/parametro/GetParametroById';
                axios.get(url, {
                    params: {
                        'nidpar' : this.usuario.id,
                        'nidgrupopar': 110025
                    }
                }).then(response => {
                    this.formAsignaModelo.nJefeVentaId = response.data[0].nIdPar;
                    this.formAsignaModelo.cJefeVentaNombre = response.data[0].cParNombre;
                    this.fillVendedor.cnombrejefeventas = response.data[0].cParNombre;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            buscarProveedorLinea(){
                if(this.validarbuscarProveedorLinea()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                this.listarProveedorLinea(1);
            },
            listarProveedorLinea(page){
                if(this.validarVerificaJefeVenta()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/parametro/GetLineasByProveedor';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidproveedor': this.formAsignaModelo.nidproveedor,
                        'clineanombre': '',
                        'page' : page
                    }
                }).then(response => {
                    this.arrayProveedorLinea = response.data.arrayLinea.data;
                    this.pagination.current_page =  response.data.arrayLinea.current_page;
                    this.pagination.total = response.data.arrayLinea.total;
                    this.pagination.per_page    = response.data.arrayLinea.per_page;
                    this.pagination.last_page   = response.data.arrayLinea.last_page;
                    this.pagination.from        = response.data.arrayLinea.from;
                    this.pagination.to           = response.data.arrayLinea.to;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            validarVerificaJefeVenta(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formAsignaModelo.nJefeVentaId == 0){
                    this.mensajeError.push('Debe ser Jefe de Ventas para realizar la búsqueda');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            listarVendedorLinea(page){
                var url = this.ruta + '/asignavendedormodelo/GetLstVendedorModelo';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidsucursal': sessionStorage.getItem("nIdSucursal"),
                        'nidproveedor': this.formAsignaModelo.nidproveedor,
                        'nidlinea': this.fillVendedor.nidlineaventa,
                        'nidmarca': this.fillVendedor.nidmarca,
                        'nidmodelo': this.fillVendedor.nidmodelo,
                        'nidjefeventas': this.formAsignaModelo.nJefeVentaId
                        //'page' : page
                    }
                }).then(response => {
                    this.arrayVendedorLinea = response.data.arrayVendedorLinea.data;
                    this.paginationModal.current_page =  response.data.arrayVendedorLinea.current_page;
                    this.paginationModal.total = response.data.arrayVendedorLinea.total;
                    this.paginationModal.per_page    = response.data.arrayVendedorLinea.per_page;
                    this.paginationModal.last_page   = response.data.arrayVendedorLinea.last_page;
                    this.paginationModal.from        = response.data.arrayVendedorLinea.from;
                    this.paginationModal.to           = response.data.arrayVendedorLinea.to;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            validarbuscarProveedorLinea(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formAsignaModelo.nJefeVentaId == 0 || this.formAsignaModelo.nJefeVentaId == ''){
                    this.mensajeError.push('Debe seleccionar Jefe de Ventas para realizar la busqueda');
                }
                if(!this.formAsignaModelo.nidproveedor){
                    this.mensajeError.push('Debe seleccionar proveedor para realizar la busqueda');
                }
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
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
            abrirModalVendedor(modelo, accion, data =[]){
                switch(modelo){
                    case 'vendedor':
                    {
                        switch(accion){
                            case 'asignar':
                            {
                                this.accionmodal=3;
                                this.modal = 1;
                                this.fillVendedor.cnombreproveedor= this.formAsignaModelo.cproveedornombre;
                                this.fillVendedor.cnombrelineaventa = data['cLineaNombre'];
                                this.fillVendedor.nidlineaventa = data['nIdLinea'];
                                this.llenarComboMarca();
                                this.arrayVendedorLinea=[];
                                break;
                            }
                        }
                    }
                }
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
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            asignarProveedor(nProveedorId, cProveedorNombre){
                this.formAsignaModelo.nidproveedor = nProveedorId;
                this.formAsignaModelo.cproveedornombre = cProveedorNombre;
                this.cerrarModal();
                this.arrayMarca = [];
                this.arrayModelo = [];
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarProveedorLinea(page);
            },
            limpiarFormulario(){
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
            llenarComboMarca(){
                var url = this.ruta + '/versionvehiculo/GetMarcaByLinea';

                axios.get(url, {
                    params: {
                        'nidlinea' : this.fillVendedor.nidlineaventa
                    }
                }).then(response => {
                    this.arrayMarca = response.data;
                    if(this.vistaFormulario){
                        this.fillVendedor.nidmarca = 0;
                    }
                    this.arrayModelo = [];
                    this.llenarComboModelo();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            llenarComboModelo(){
                var url = this.ruta + '/versionvehiculo/GetModeloByMarca';

                axios.get(url, {
                    params: {
                        'nidmarca' : this.fillVendedor.nidmarca
                    }
                }).then(response => {
                    this.arrayModelo = response.data;
                    if(this.vistaFormulario){
                        this.fillVendedor.nidmodelo = 0;
                    }
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            cambiarPaginaProveedor(page){
                this.paginationModal.current_page=page;
                this.listarProveedores(page);
            },
            cambiarPaginaVendedor(page){
                this.paginationModal.current_page=page;
                this.listarVendedorLinea(page);
            },
            asignar(nIdMiVendedor){
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/asignavendedormodelo/SetAsignaModelo';
                axios.post(url, {
                    nIdEmpresa: 1300011,
                    nIdSucursal: sessionStorage.getItem("nIdSucursal"),
                    nIdProveedor: parseInt(this.formAsignaModelo.nidproveedor),
                    nIdVendedor: nIdMiVendedor,
                    nIdLinea: parseInt(this.fillVendedor.nidlineaventa),
                    nIdMarca: parseInt(this.fillVendedor.nidmarca),
                    nIdModelo: parseInt(this.fillVendedor.nidmodelo),
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Asignación Vendedor Modelo registrado Con Exito');
                        this.listarVendedorLinea();
                    }
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            designar(nIdAsignacionVendedorModelo){
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/asignavendedormodelo/SetDesasignaModelo';
                axios.post(url, {
                    nIdAsignacion: nIdAsignacionVendedorModelo,
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Desasignación Vendedor Modelo Realizado Con Exito');
                        this.listarVendedorLinea();
                    }
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            validar(){
                this.error = 0;
                this.mensajeError =[];
                if(!this.fillVendedor.nidmarca || this.fillVendedor.nidmarca == 0){
                    this.mensajeError.push('No ha seleccionado Marca');
                }
                if(!this.fillVendedor.nidmodelo || this.fillVendedor.nidmodelo == 0){
                    this.mensajeError.push('No ha seleccionado Modelo');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            mostrarProgressBar(){
                $("#myBar").show();
                progress();
            },
            mostrarNombreJefeV(){
                //var opcion_seleccionada = arrayJefeVentas[2].nIdPar=1300020;
                var nomb='';
                for(var i=0;i<this.arrayJefeVentas.length;i++){
                    if(this.arrayJefeVentas[i].nIdPar==this.formAsignaModelo.nJefeVentaId){
                        nomb=this.arrayJefeVentas[i].cParNombre;
                        this.fillVendedor.cnombrejefeventas= nomb;
                        this.arrayProveedorLinea=[];
                    }
                }
            },
        },
        mounted(){
            this.informacionUsuario();
        }
    }
</script>

<style>
    /* TRANSITION */
    /* Enter and leave animations can use different */
    /* durations and timing functions.              */
    .slide-fade-enter-active {
        transition: all .8s ease;
    }
    .slide-fade-leave-active {
        transition: all .12s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active below version 2.1.8 */ {
        transform: translateX(10px);
        opacity: 0;
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
    }
</style>
