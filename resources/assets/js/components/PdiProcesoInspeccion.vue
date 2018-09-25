<template>
    <main>
        <header class="page-header">
          <div class="container-fluid">
            <h2 class="no-margin-bottom">PROCESO DE INSPECCIÓN</h2>
          </div>
        </header>

        <template v-if="vistaFormulario">
            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h4">BUSCAR</h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal">
                                    <!--<div class="form-group row">
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
                                                <label class="col-sm-4 form-control-label">* Nombre</label>
                                                <div class="col-sm-8">
                                                    <input type="text" v-model="fillPunto.cnombre" @keyup.enter="listarPuntoInspeccion(1)" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
                                    <div class="form-group row">
                                        <div class="col-sm-9 offset-sm-5">
                                            <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarPuntoInspeccion(1)"><i class="fa fa-search"></i> Buscar</button>
                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="abrirFormulario('pdi','registrar')"><i class="fa fa-file-o"></i> Nuevo</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h4">LISTADO ITEMS</h3>
                            </div>
                            <div class="card-body">                   
                                <template v-if="arrayPuntoInspeccion.length">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Nombre</th>
                                                    <th>Tipo Movimiento</th>
                                                    <th>Ingreso Sucursal</th>
                                                    <th>Salida Sucursal</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="punto in arrayPuntoInspeccion" :key="punto.nIdPuntoInspeccion">
                                                    <td v-text="punto.nIdPuntoInspeccion"></td>
                                                    <td v-text="punto.cNombrePuntoInspeccion"></td>
                                                    <td v-text="punto.cFlagTipoMovimiento"></td>
                                                    <td v-text="punto.cFlagIngresoSucursal"></td>
                                                    <td v-text="punto.cFlagSalidaSucursal"></td>
                                                    <td>
                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                             <div slot="content">Editar {{ punto.cNombrePuntoInspeccion }}</div>
                                                             <i @click="abrirFormulario('puntoinspeccion','actualizar', punto)" :style="'color:#796AEE'" class="fa-md fa fa-edit"></i>
                                                        </el-tooltip>&nbsp;
                                                        <template v-if="punto.cSituacionRegistro=='A'">
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Desactivar {{ punto.cNombreTipoInspeccion }}</div>
                                                                <i @click="desactivar(punto.nIdPuntoInspeccion)" :style="'color:#796AEE'" class="fa-md fa fa-check-square"></i>
                                                            </el-tooltip>
                                                        </template>
                                                        <template v-else>
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Activar {{ punto.cNombreTipoInspeccion }}</div>
                                                                <i @click="activar(punto.nIdPuntoInspeccion)" :style="'color:red'" class="fa-md fa fa-square"></i>
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
                    </div>-->
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
                                                <label class="col-sm-4 form-control-label">* Punto Inspección</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" v-model="formPdi.cnombrepuntoinspeccion" disabled="disabled" class="form-control form-control-sm">
                                                        <div class="input-group-prepend">
                                                            <button type="button" title="Buscar Item" class="btn btn-info btn-corner btn-sm" @click="abrirModal('item','buscar')">
                                                                <i class="fa-lg fa fa-search"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Solicitud Autorización</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" v-model="formPdi.csolicitudnombre" disabled="disabled" class="form-control form-control-sm">
                                                        <div class="input-group-prepend">
                                                            <button type="button" title="Buscar Item" class="btn btn-info btn-corner btn-sm" @click="abrirModal('item','buscar')">
                                                                <i class="fa-lg fa fa-search"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-3 form-control-label">
                                                    <label class="checkbox-inline" v-for="tipo in arrayFlagVinPlaca" :key="tipo.value">
                                                        <input type="radio" class="radio-template" v-model="formPdi.nidflagvinplaca" :value="tipo.value">
                                                        <label for="" class="form-control-label" v-text="tipo.text"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    </label>
                                                </label>
                                                <div class="col-sm-5">
                                                    <div class="input-group">
                                                        <input type="text" v-model="formPdi.cvinplacanombre" disabled="disabled" class="form-control form-control-sm">
                                                        <div class="input-group-prepend">
                                                            <button type="button" title="Buscar Item" class="btn btn-info btn-corner btn-sm" @click="abrirModal('item','buscar')">
                                                                <i class="fa-lg fa fa-search"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-3 form-control-label">* Tipo Inspección</label>
                                                <div class="col-sm-5">
                                                    <el-select v-model="formPdi.nidtipoinspeccion" filterable clearable>
                                                        <el-option
                                                        v-for="item in arrayTipoInspeccion"
                                                        :key="item.nIdPar"
                                                        :label="item.cParNombre"
                                                        :value="item.nIdPar">
                                                        </el-option>
                                                    </el-select>
                                                </div>
                                                <div class="col-sm-4"> 
                                                    <button type="button" title="Buscar Item" class="btn btn-info btn-corner btn-sm" @click="abrirModal('item','buscar')">
                                                        <i class="fa-lg fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Tipo Movimiento</label>
                                                <div class="col-sm-8">
                                                    <label class="checkbox-inline" v-for="tipo in arrayFlagTipoMovimiento" :key="tipo.value">
                                                        <input type="radio" class="radio-template" v-model="formPdi.nidflagmovimiento" :value="tipo.value">
                                                        <label for="" class="form-control-label" v-text="tipo.text"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Nro Inspección</label>
                                                <div class="col-sm-8">
                                                    <input type="text" v-model="formPdi.cnumeroinspeccion" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Fecha Inspección</label>
                                                <div class="col-sm-8">
                                                    <el-date-picker
                                                        v-model="formPdi.dfechainspeccion"
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
                                                <label class="col-sm-4 form-control-label">* Hora Inspección</label>
                                                <div class="col-sm-8">
                                                    <input type="text" v-model="formPdi.chorainspeccion" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Almacén</label>
                                                <div class="col-sm-8">
                                                    <el-select v-model="formPdi.nidalmacen" filterable placeholder="Select" >
                                                        <el-option
                                                        v-for="item in arrayAlmacen"
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
                                                <label class="col-sm-4 form-control-label">* Fecha Mov. Almacén</label>
                                                <div class="col-sm-8">
                                                    <input type="text" v-model="formPdi.dfechaalmacen" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Conforme</label>
                                                <div class="col-sm-8">
                                                    <input type="text" v-model="formPdi.cflagconformidad" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Adjuntar</label>
                                                <div class="col-sm-8">
                                                    <input type="file" id="file-upload" @change="getFile" accept=".xls,.xlsx" class="form-control form-control-sm"/>
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

        <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form v-on:submit.prevent class="form-horizontal">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTA ITEM</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Nombre</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" v-model="fillItem.citemnombre" @keyup.enter="listarItems(1)" class="form-control form-control-sm">
                                                            <div class="input-group-prepend">
                                                                <button type="button" title="Buscar Items" class="btn btn-info btn-corner btn-sm" @click="listarItems(1)">
                                                                    <i class="fa-lg fa fa-search"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>
                                        <template v-if="arrayItem.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccione</th>
                                                            <th>Nombre Proveedor</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="item in arrayItem" :key="item.nIdPar">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar {{ item.cParNombre }}</div>
                                                                    <i @click="asignarItem(item.nIdPar, item.cParNombre)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td v-text="item.cParNombre"></td>
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
                                                                    <a @click.prevent="cambiarPaginaItem(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaItem(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaItem(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
</template>
<script>
    export default {
        props:['ruta'],
        data(){
                    
            return {
                cempresa: 'SAISAC',
                csucursal: sessionStorage.getItem("cNombreSucursal"),
                formPdi:{
                    nidcabecerainspeccion: 0,
                    nidsolicitud: 0,
                    csolicitudnombre: '',
                    nidflagvinplaca: 1,
                    cvinplacanombre: '',
                    nidcompra: 0,
                    nidvehiculoplaca: 0,
                    nidpuntoinspeccion: 0,
                    cnombrepuntoinspeccion: '',
                    nidtipoinspeccion: 0,
                    cflagtipomovimiento: '',
                    cnumeroinspeccion: '',
                    nidalmacen: 0,
                    dfechainspeccion: '',
                    chorainspeccion: '',
                    nidalmacen: 0,
                    dfechaalmacen: '',
                    cflagconformidad: '',
                    cobservacion: '',
                },
                arrayTipoInspeccion: [],
                arrayAlmacen: [],
                arrayFlagVinPlaca: [
                    { value: '1', text: 'Nro Vin'},
                    { value: '2', text: 'Placa'}
                ],
                arrayFlagTipoMovimiento: [
                    { value: '1', text: 'Ingreso'},
                    { value: '2', text: 'Salida'}
                ],
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
            llenarComboTipoInspeccion(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110084,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayTipoMovimiento = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarFlag(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110085,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayFlag = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            //============================================================
            //================= BUSQUEDA INSPECCION =======================
            listarPuntoInspeccion(page){
                this.mostrarProgressBar();
                var url = this.ruta + '/puntoinspeccion/GetListPuntoInspeccion';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidsucursal': sessionStorage.getItem("nIdSucursal"),
                        'cnombre': this.fillPunto.cnombre,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayPuntoInspeccion = response.data.arrayPuntoInspeccion.data;
                    this.paginationModal.current_page =  response.data.arrayPuntoInspeccion.current_page;
                    this.paginationModal.total = response.data.arrayPuntoInspeccion.total;
                    this.paginationModal.per_page    = response.data.arrayPuntoInspeccion.per_page;
                    this.paginationModal.last_page   = response.data.arrayPuntoInspeccion.last_page;
                    this.paginationModal.from        = response.data.arrayPuntoInspeccion.from;
                    this.paginationModal.to           = response.data.arrayPuntoInspeccion.to;
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarTipoInspeccion(page);
            },
            //============================================================
            //================= NUEVA INSPECCION =======================
            llenarTipoInspeccion(){
            
            },
            llenarAlmacen(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110087,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayAlmacen = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            getFile(e){
                //console.log(e);
                let selectFile = e.target.files[0];
                this.attachment = selectFile;
                //this.textFile = e.target.files[0].name;
            },
            //================= REGISTRO =======================
            registrar(){
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/puntoinspeccion/SetPuntoInspeccion';    
                axios.post(url, {
                    nIdEmpresa: 1300011,
                    nIdSucursal: sessionStorage.getItem("nIdSucursal"),
                    cNombrePuntoInspeccion: this.formPdi.cnombre,
                    nFlagTipoMovimiento: this.formPdi.nidflagmovimiento,
                    nFlagIngresoSucursal: this.formPdi.nidflagingreso,
                    nFlagSalidaSucursal: this.formPdi.nidflagsalida
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Item Agregado registrada');
                        this.vistaFormulario = 1;
                        //this.listarItemPlantilla();
                    }
                    else{
                        swal('Ya existe Item');
                    }
                }).catch(error => {
                    console.log(error);
                });
            },
            validar(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.formPdi.cnombre){
                    this.mensajeError.push('Debes Seleccionar Sección');
                };
                if(this.formPdi.nFlagIngresoSucursal == 0){
                    this.mensajeError.push('Debes Seleccionar Ingreso Sucursal');
                };
                if(this.formPdi.nFlagSalidaSucursal == 0){
                    this.mensajeError.push('Debes Seleccionar Salida Sucursal');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            activar(nIdPuntoInspeccion){
                swal({
                    title: 'Estas seguro de activar este Punto Inspección?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Activar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.value) {
                        var url = this.ruta + '/puntoinspeccion/activar';
                        axios.put(url , {
                            nIdPuntoInspeccion: nIdPuntoInspeccion
                        }).then(response => {
                            swal(
                            'Activado!',
                            'El registro fue activado.'
                            );
                            this.listarPuntoInspeccion(1);
                            this.vistaFormulario = 1;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel){}
                })
            },
            desactivar(nIdPuntoInspeccion){
                swal({
                    title: 'Estas seguro de desactivar este Punto Inspección?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Desactivar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.value) {
                        var url = this.ruta + '/puntoinspeccion/desactivar';
                        axios.put(url , {
                            nIdPuntoInspeccion: nIdPuntoInspeccion
                        }).then(response => {
                            swal(
                            'Desactivado!',
                            'El registro fue desactivado.'
                            );
                            this.listarPuntoInspeccion(1);
                            this.vistaFormulario = 1;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel){}
                })
            },
            actualizar(){
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/puntoinspeccion/UpdPuntoInspeccionById';            
                axios.post(url, {
                    nIdPuntoInspeccion: parseInt(this.formPdi.nidpuntoinspeccion),
                    nIdEmpresa: 1300011,
                    nIdSucursal: sessionStorage.getItem("nIdSucursal"),
                    cNombrePuntoInspeccion: this.formPdi.cnombre,
                    nFlagTipoMovimiento: this.formPdi.nidflagmovimiento,
                    nFlagIngresoSucursal: this.formPdi.nidflagingreso,
                    nFlagSalidaSucursal: this.formPdi.nidflagsalida
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Punto Inspección Actualizado');
                        //this.limpiarFormulario();
                        this.vistaFormulario = 1;
                        this.listarPuntoInspeccion(1);
                    }
                    else{
                        swal('Ya existe Punto Inspección');
                    }
                }).catch(error => {
                    console.log(error);
                });
            },
            abrirFormulario(modelo, accion, data =[]){
                switch(modelo){
                    case 'pdi':
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.vistaFormulario = 0;
                                this.accion = 1;
                                this.tituloFormulario = 'NUEVO PROCESO DE INSPECCIÓN';
                                this.llenarTipoInspeccion();
                                this.llenarAlmacen();
                                this.limpiarFormulario();
                                break;
                            }
                            case 'actualizar':
                            {
                                this.vistaFormulario = 0;
                                this.accion = 2;
                                this.tituloFormulario = 'ACTUALIZAR PUNTO DE INSPECCIÓN';
                                this.formPdi.nidpuntoinspeccion = data['nIdPuntoInspeccion'];
                                this.formPdi.cnombre = data['cNombrePuntoInspeccion'];
                                this.formPdi.nidflagmovimiento = (data['nFlagTipoMovimiento'] == 0 ? 0 : data['nFlagTipoMovimiento']);
                                this.formPdi.nidflagingreso = data['nFlagIngresoSucursal'];
                                this.formPdi.nidflagsalida = data['nFlagSalidaSucursal'];
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
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case 'item':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                if(this.validar()){
                                    this.accionmodal=1;
                                    this.modal = 1;
                                    return;
                                }

                                this.accionmodal=3;
                                this.modal = 1;
                                this.listarItems(1);
                                break;
                            }
                        }
                    }
                }
            },
            limpiarFormulario(){
                this.formPdi.nidpuntoinspeccion= 0,
                this.formPdi.cnombre= '',
                this.formPdi.nidflagmovimiento= 0,
                this.formPdi.nidflagingreso=  0,
                this.formPdi.nidflagsalida= 0
            },
            cambiarVistaFormulario(){
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