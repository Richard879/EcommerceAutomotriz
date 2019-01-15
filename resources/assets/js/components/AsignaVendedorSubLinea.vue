<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">ASIGNACION VENDEDOR A SUBLINEAS</h2>
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
                                                        <label v-text="formAsignaSubLinea.cJefeVentaNombre" class="form-control-label-readonly"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" v-model="formAsignaSubLinea.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
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
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTADO</h3>
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

            <!-- MODAL ASIGNAR SUBLINEAS -->
            <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">ASIGNACION MODELO A VENDEDOR</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <label class="col-sm-2 form-control-label">Proveedor</label>
                                                <div class="col-sm-4">
                                                    <input type="text" v-model="fillVendedor.cnombreproveedor" class="form-control form-control-sm" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 form-control-label">Linea Venta</label>
                                                <div class="col-sm-4">
                                                    <input type="text" v-model="fillVendedor.cnombrelineaventa" class="form-control form-control-sm" readonly>
                                                    <input type="hidden" v-model="fillVendedor.nidlinea" class="form-control form-control-sm" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 form-control-label">Jefe de ventas</label>
                                                <div class="col-sm-4">
                                                    <input type="text" v-model="fillVendedor.cnombrejefeventas" class="form-control form-control-sm" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 form-control-label">SubLinea</label>
                                                <div class="col-sm-4">
                                                    <el-select v-model="fillVendedor.nidsublinea" filterable clearable placeholder="SELECCIONE" v-on:change="listarVendedorSubLinea(1);">
                                                        <el-option
                                                        v-for="sublinea in arraySubLinea"
                                                            :key="sublinea.nIdSubLinea"
                                                            :label="sublinea.cSubLineaNombre"
                                                            :value="sublinea.nIdSubLinea">
                                                        </el-option>
                                                    </el-select>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
                                        <template v-if="arrayVendedorSubLinea.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Asignar</th>
                                                            <th>Asesor comercial</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="vendedor in arrayVendedorSubLinea" :key="vendedor.nIdMiVendedor">
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
                                                                        <i @click="designar(vendedor.nIdAsignacionVendedorSubLinea)" :style="'color:#796AEE'" class="fa-md fa fa-check-square"></i>
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
                cempresa: sessionStorage.getItem("cNombreEmpresa"),
                csucursal: sessionStorage.getItem("cNombreSucursal"),
                arrayProveedorLinea: [],
                arrayJefeVentas: [],
                arrayProveedor: [],
                arrayMarca: [],
                arraySubLinea: [],
                arrayVendedorSubLinea: [],
                fillProveedor:{
                    cnombreproveedor: ''
                },
                fillVendedor:{
                    cnombreproveedor: '',
                    cnombrelineaventa: '',
                    nidlinea: 0,
                    cnombrejefeventas: '',
                    nidsublinea: ''
                },
                formAsignaSubLinea:{
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
                    this.formAsignaSubLinea.nJefeVentaId = response.data[0].nIdPar;
                    this.formAsignaSubLinea.cJefeVentaNombre = response.data[0].cParNombre;
                    this.fillVendedor.cnombrejefeventas = response.data[0].cParNombre;
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
            validarVerificaJefeVenta(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formAsignaSubLinea.nJefeVentaId == 0){
                    this.mensajeError.push('Debe ser Jefe de Ventas para realizar la búsqueda');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // ===============================================================
            // ===========  LISTAR LINEAS POR PROVEEDOR ================
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
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidproveedor': this.formAsignaSubLinea.nidproveedor,
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
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarProveedorLinea(page);
            },
            validarbuscarProveedorLinea(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formAsignaSubLinea.nJefeVentaId == 0 || this.formAsignaSubLinea.nJefeVentaId == ''){
                    this.mensajeError.push('Debe seleccionar Jefe de Ventas para realizar la busqueda');
                }
                if(!this.formAsignaSubLinea.nidproveedor){
                    this.mensajeError.push('Debe seleccionar proveedor para realizar la busqueda');
                }
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // ===============================================================
            // ===========  LISTAR VENEDEDOR MODELO ASIGNADOS ================
            llenarComboSubLinea(){
                var url = this.ruta + '/versionvehiculo/GetSubLineaByLinea';

                axios.get(url, {
                    params: {
                        'nidlinea': this.fillVendedor.nidlinea,
                        'opcion': 1
                    }
                }).then(response => {
                    this.arraySubLinea = response.data.arraySubLinea;
                    if(this.vistaFormulario){
                        this.fillVendedor.nidsublinea = '';
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
            listarVendedorSubLinea(page){
                if(!this.fillVendedor.nidsublinea){
                    this.arrayVendedorSubLinea = []
                }else{
                    var url = this.ruta + '/asignavendedorsublinea/GetLstVendedorSubLinea';
                    axios.get(url, {
                        params: {
                            'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                            'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                            'nidproveedor': this.formAsignaSubLinea.nidproveedor,
                            'nidlinea': this.fillVendedor.nidlinea,
                            'nidsublinea': this.fillVendedor.nidsublinea,
                            'nidjefeventas': this.formAsignaSubLinea.nJefeVentaId
                        }
                    }).then(response => {
                        this.arrayVendedorSubLinea = response.data.arrayVendedorSubLinea.data;
                        this.paginationModal.current_page =  response.data.arrayVendedorSubLinea.current_page;
                        this.paginationModal.total = response.data.arrayVendedorSubLinea.total;
                        this.paginationModal.per_page    = response.data.arrayVendedorSubLinea.per_page;
                        this.paginationModal.last_page   = response.data.arrayVendedorSubLinea.last_page;
                        this.paginationModal.from        = response.data.arrayVendedorSubLinea.from;
                        this.paginationModal.to           = response.data.arrayVendedorSubLinea.to;
                    }).catch(error => {
                        console.log(error);
                        if (error.response) {
                            if (error.response.status == 401) {
                                swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                location.reload('0');
                            }
                        }
                    });
                }
            },
            cambiarPaginaVendedor(page){
                this.paginationModal.current_page=page;
                this.listarVendedorSubLinea(page);
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
                                this.fillVendedor.cnombreproveedor= this.formAsignaSubLinea.cproveedornombre;
                                this.fillVendedor.cnombrelineaventa = data['cLineaNombre'];
                                this.fillVendedor.nidlinea = data['nIdLinea'];
                                this.llenarComboSubLinea();
                                this.arrayVendedorSubLinea=[];
                                break;
                            }
                        }
                    }
                }
            },
            cerrarModal(){
                this.modal = 0
                this.error = 0,
                this.mensajeError = ''
            },
            // ==========================================================
            // =============  REGISTRO ========================
            asignar(nIdMiVendedor){
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/asignavendedorsublinea/SetAsignaSubLinea';
                axios.post(url, {
                    nIdEmpresa: parseInt(sessionStorage.getItem("nIdEmpresa")),
                    nIdSucursal: parseInt(sessionStorage.getItem("nIdSucursal")),
                    nIdProveedor: parseInt(this.formAsignaSubLinea.nidproveedor),
                    nIdVendedor: nIdMiVendedor,
                    nIdLinea: parseInt(this.fillVendedor.nidlinea),
                    nIdSubLinea: parseInt(this.fillVendedor.nidsublinea)
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Asignación Vendedor SubLinea registrado Con Exito');
                        this.listarVendedorSubLinea();
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
            designar(nIdAsignacionVendedorSubLinea){
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/asignavendedorsublinea/SetDesasignaSubLinea';
                axios.post(url, {
                    nIdAsignacion: nIdAsignacionVendedorSubLinea,
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Desasignación Vendedor SubLinea Realizado Con Exito');
                        this.listarVendedorSubLinea();
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
            // ==========================================================
            // =============  MODAL PROVEEDORES ========================
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
            asignarProveedor(nProveedorId, cProveedorNombre){
                this.formAsignaSubLinea.nidproveedor = nProveedorId;
                this.formAsignaSubLinea.cproveedornombre = cProveedorNombre;
                this.cerrarModal();
                this.arrayMarca = [];
                this.arraySubLinea = [];
            },
            cambiarPaginaProveedor(page){
                this.paginationModal.current_page=page;
                this.listarProveedores(page);
            },
            // ==========================================================
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
            validar(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.fillVendedor.nidsublinea || this.fillVendedor.nidsublinea == 0){
                    this.mensajeError.push('No ha seleccionado SubLinea');
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
                    if(this.arrayJefeVentas[i].nIdPar==this.formAsignaSubLinea.nJefeVentaId){
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
