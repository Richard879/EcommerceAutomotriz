<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
            <div class="container-fluid">
                <h2 class="no-margin-bottom">ELEMENTO VENTA</h2>
            </div>
            </header>

            <template v-if="vistaFormulario">
                <section class="forms">
                    <div class="container-fluid">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4">BUSCAR ELEMENTO VENTA</h3>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label class="col-sm-2 form-control-label">* Empresa</label>
                                            <div class="col-sm-4">
                                                <input type="text" v-model="cempresa" class="form-control form-control-sm" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 form-control-label">Tipo Elemento</label>
                                            <div class="col-sm-4">
                                                <el-select v-model="formEle.ntpoelemen" filterable clearable placeholder="SELECCIONE" >
                                                    <el-option
                                                    v-for="item in arrayTipoElemento"
                                                    :key="item.nIdPar"
                                                    :label="item.cParNombre"
                                                    :value="item.nIdPar">
                                                    </el-option>
                                                </el-select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 form-control-label">Nombre Elemento</label>
                                            <div class="col-sm-4">
                                                <input type="text" v-model="formEle.celementonombre" @keyup.enter="buscarElemento()" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9 offset-sm-3">
                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarElemento()"><i class="fa fa-search"></i> Buscar</button>
                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="abrirFormulario('elemento','registrar')"><i class="fa fa-file-o"></i> Nuevo</button>
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
                                    <template v-if="arrayElementoVenta.length">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Código</th>
                                                        <th>Código SAP</th>
                                                        <th>Proveedor</th>
                                                        <th>Tipo</th>
                                                        <th>Nombre Elemento</th>
                                                        <th>Moneda</th>
                                                        <th>Prec. Venta</th>
                                                        <th>Prec. Venta Mínimo</th>
                                                        <th>Costo</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="elemento in arrayElementoVenta" :key="elemento.nIdElemento">
                                                        <td v-text="elemento.nIdElemento"></td>
                                                        <td v-text="elemento.cCodigoERP"></td>
                                                        <td v-text="elemento.cProveedorNombre"></td>
                                                        <td v-text="elemento.cTipoElemenNombre"></td>
                                                        <td v-text="elemento.cElemenNombre"></td>
                                                        <td v-text="elemento.cMonedaNombre"></td>
                                                        <td v-text="elemento.fElemenValorVenta"></td>
                                                        <td v-text="elemento.fElemenValorMinimoVenta"></td>
                                                        <td v-text="elemento.fElementValorCosto"></td>
                                                        <td>
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Editar {{ elemento.cElemenNombre }}</div>
                                                                <i @click="abrirFormulario('elemento','actualizar', elemento)" :style="'color:#796AEE'" class="fa-md fa fa-edit"></i>
                                                            </el-tooltip>&nbsp;&nbsp;
                                                            <template v-if="elemento.cElementoEstado=='A'">
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Desactivar {{ elemento.cElemenNombre }}</div>
                                                                    <i @click="desactivar(elemento.nIdElemento)" :style="'color:#796AEE'" class="fa-md fa fa-check-square"></i>
                                                                </el-tooltip>
                                                            </template>
                                                            <template v-else>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Activar {{ elemento.cElemenNombre }}</div>
                                                                    <i @click="activar(elemento.nIdElemento)" :style="'color:red'" class="fa-md fa fa-square"></i>
                                                                </el-tooltip>
                                                            </template>&nbsp;&nbsp;
                                                            <!--<template v-if="!elemento.cCodigoERP">
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Registra Sap  {{ elemento.cElemenNombre }}</div>
                                                                    <i @click="validarSapArticulo(elemento)" :style="'color:green'" class="fa-spin fa-md fa fa-cube"></i>
                                                                </el-tooltip>
                                                            </template>-->
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
                                                        <input type="text" v-model="cempresa" class="form-control form-control-sm" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Proveedor</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" v-model="formEle.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
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
                                                    <label class="col-sm-4 form-control-label">* Tipo Elemento</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="formEle.ntpoelemen" filterable clearable placeholder="SELECCIONE" >
                                                            <el-option
                                                            v-for="item in arrayTipoElemento"
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
                                                    <label class="col-sm-4 form-control-label">* Tipo Moneda</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="formEle.nidmoneda" filterable clearable placeholder="SELECCIONE" >
                                                            <el-option
                                                            v-for="tpomoneda in arrayTipoMoneda"
                                                            :key="tpomoneda.nIdPar"
                                                            :label="tpomoneda.cParNombre"
                                                            :value="tpomoneda.nIdPar">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Nombre Elemento</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="formEle.celenombre" class="form-control form-control-sm" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Código ERP</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="formEle.celecodigoerp" class="form-control form-control-sm" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Valor Venta</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" v-model="formEle.felevalorventa" class="form-control form-control-sm" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Valor Mínimo Venta</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" v-model="formEle.felevarlorminventa" class="form-control form-control-sm" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Valor Costo</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" v-model="formEle.felevalorcosto" class="form-control form-control-sm" placeholder="">
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
                arrayTipoElemento: [],
                arrayElementoVenta: [],
                arrayTipoMoneda: [],
                arrayProveedor: [],
                fillProveedor:{
                    cnombreproveedor: ''
                },
                formEle:{
                    nidproveedor: 0,
                    cproveedornombre: '',
                    ntpoelemen: '',
                    nidmoneda: '',
                    nidelemento: 0,
                    celenombre: '',
                    celecodigoerp: '',
                    felevalorventa: '',
                    felevarlorminventa: '',
                    celementonombre: '',
                    felevalorcosto: ''
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
            llenarComboTpoElemento(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110027
                    }
                }).then(response => {
                    this.arrayTipoElemento = response.data;
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
            llenarComboTpoMoneda(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110028
                    }
                }).then(response => {
                    this.arrayTipoMoneda = response.data;
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
                this.formEle.nidproveedor = nProveedorId;
                this.formEle.cproveedornombre = cProveedorNombre;
                this.cerrarModal();
            },
            buscarElemento(){
                this.listarElementos(1);
            },
            listarElementos(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/elemento/GetElementoByTipo';

                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidtipoelemen': this.formEle.ntpoelemen,
                        'celementonombre': this.formEle.celementonombre,
                        'page': page
                    }
                }).then(response => {
                    this.arrayElementoVenta = response.data.arrayElementoVenta.data;
                    this.pagination.current_page =  response.data.arrayElementoVenta.current_page;
                    this.pagination.total = response.data.arrayElementoVenta.total;
                    this.pagination.per_page    = response.data.arrayElementoVenta.per_page;
                    this.pagination.last_page   = response.data.arrayElementoVenta.last_page;
                    this.pagination.from        = response.data.arrayElementoVenta.from;
                    this.pagination.to           = response.data.arrayElementoVenta.to;
                }).then(function (response) {
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
                this.listarElementos(page);
            },
            registrar(){
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/elemento/SetElemento';
                axios.post(url, {
                    nIdEmpresa: parseInt(sessionStorage.getItem("nIdEmpresa")),
                    nIdProveedor: parseInt(this.formEle.nidproveedor),
                    nIdTipoElemento: parseInt(this.formEle.ntpoelemen),
                    nIdMoneda: parseInt(this.formEle.nidmoneda),
                    cElemenNombre: this.formEle.celenombre.toUpperCase(),
                    fElemenValorVenta: this.formEle.felevalorventa,
                    fElemenValorMinimoVenta: this.formEle.felevarlorminventa,
                    cCodigoERP: this.formEle.celecodigoerp,
                    fElemenValorCosto: this.formEle.felevalorcosto
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Elemento registrado');
                        this.listarElementos(1);
                        this.vistaFormulario = 1;
                    }
                    else{
                        swal('Ya existe Elemento Venta');
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
                if(this.accion == 2){
                    if(this.formEle.nidelemento == 0){
                     this.mensajeError.push('Debes Seleccionar Elemento Venta');
                    };
                };
                /*if(this.formEle.nidproveedor == 0){
                    this.mensajeError.push('Debes Ingresar el Proveedor');
                };*/
                if(this.formEle.ntpoelemen == 0 || !this.formEle.ntpoelemen){
                    this.mensajeError.push('Debes Ingresar un Tipo de Elemento');
                };
                if(this.formEle.nidmoneda == 0 || !this.formEle.nidmoneda){
                    this.mensajeError.push('Debes Ingresar un Tipo de Moneda');
                };
                if(!this.formEle.celenombre){
                    this.mensajeError.push('Debes Ingresar un nombre');
                };
                if(!this.formEle.felevalorventa){
                    this.mensajeError.push('Debes Ingresar un valor de Venta');
                };
                if(this.formEle.felevarlorminventa > this.formEle.felevalorventa){
                    this.mensajeError.push('El Valor Venta debe ser mayor al Valor Mínimo Venta');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            actualizar(){
                var url = this.ruta + '/elemento/UpdElementoById';
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                axios.post(url, {
                    nIdEmpresa: parseInt(sessionStorage.getItem("nIdEmpresa")),
                    nIdProveedor: parseInt(this.formEle.nidproveedor),
                    nIdElementoVenta: parseInt(this.formEle.nidelemento),
                    nIdTipoElemento: parseInt(this.formEle.ntpoelemen),
                    nIdMoneda: parseInt(this.formEle.nidmoneda),
                    cElemenNombre: this.formEle.celenombre.toUpperCase(),
                    fElemenValorVenta: this.formEle.felevalorventa,
                    fElemenValorMinimoVenta: this.formEle.felevarlorminventa,
                    cCodigoERP: this.formEle.celecodigoerp,
                    fElemenValorCosto: this.formEle.felevalorcosto
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Elemento Actualizado');
                        this.limpiarFormulario();
                        this.vistaFormulario = 1;
                    }
                    else{
                        swal('Ya existe Elemento Venta');
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
            activar(nIdElementoVenta){
                swal({
                    title: 'Estas seguro de activar este elemento?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Activar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.value) {
                        var url = this.ruta + '/elemento/activar';
                        axios.put(url , {
                            nIdElementoVenta: parseInt(nIdElementoVenta)
                        }).then(response => {
                            swal(
                            'Activado!',
                            'El registro fue activado.'
                            );
                            this.listarElementos(1);
                            this.vistaFormulario = 1;
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
                    } else if (result.dismiss === swal.DismissReason.cancel){}
                })
            },
            desactivar(nIdElementoVenta){
                swal({
                    title: 'Estas seguro de desactivar este elemento?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Desactivar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.value) {
                        var url = this.ruta + '/elemento/desactivar';
                        axios.put(url , {
                            nIdElementoVenta: parseInt(nIdElementoVenta)
                        }).then(response => {
                            swal(
                            'Desactivado!',
                            'El registro fue desactivado.'
                            );
                            this.listarElementos(1);
                            this.vistaFormulario = 1;
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
                    } else if (result.dismiss === swal.DismissReason.cancel){}
                })
            },
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
                }
            },
            abrirFormulario(modelo, accion, data =[]){
                switch(modelo){
                    case 'elemento':
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.vistaFormulario = 0;
                                this.accion = 1;
                                this.llenarComboTpoElemento();
                                this.llenarComboTpoMoneda();
                                this.tituloFormulario = 'NUEVO ELEMENTO VENTA';
                                this.limpiarFormulario();
                                break;
                            }
                            case 'actualizar':
                            {
                                this.vistaFormulario = 0;
                                this.accion = 2;
                                this.llenarComboTpoElemento();
                                this.llenarComboTpoMoneda();
                                this.tituloFormulario = 'ACTUALIZAR ELEMENTO VENTA';
                                this.formEle.nidelemento = data['nIdElemento'];
                                this.formEle.ntpoelemen = data['nIdTipoElemento'];
                                this.formEle.nidproveedor  = data['nIdProveedor'];
                                this.formEle.cproveedornombre = data['cProveedorNombre'];
                                this.formEle.nidmoneda = data['nIdMoneda'];
                                this.formEle.celenombre = data['cElemenNombre'];
                                this.formEle.celecodigoerp = data['cCodigoERP'];
                                this.formEle.felevalorventa = data['fElemenValorVenta'];
                                this.formEle.felevarlorminventa = data['fElemenValorMinimoVenta'];
                                this.formEle.felevalorcosto = data['fElementValorCosto'];
                                break;
                            }
                        }
                    }
                }
            },
            limpiarFormulario(){
                this.formEle.nidproveedor= 0,
                this.formEle.cproveedornombre= '',
                this.formEle.ntpoelemen= '',
                this.formEle.nidmoneda= '',
                this.formEle.celenombre= '',
                this.formEle.celecodigoerp= '',
                this.formEle.felevalorventa= '',
                this.formEle.felevarlorminventa= '',
                this.formEle.felevalorcosto= '',
                this.arrayElementoVenta = []
            },
            cambiarVistaFormulario(){
                //this.limpiarFormulario();
                this.listarElementos(1);
                this.vistaFormulario = 1;
            },
            limpiarPaginacion(){
                this.pagination.current_page =  0,
                this.pagination.total = 0,
                this.pagination.per_page = 0,
                this.pagination.last_page = 0,
                this.pagination.from  = 0,
                this.pagination.to = 0
            },
            mostrarProgressBar(){
                $("#myBar").show();
                progress();
            }
        },
        mounted(){
            this.llenarComboTpoElemento();
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
