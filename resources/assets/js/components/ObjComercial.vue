<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom"> OBJETIVOS COMERCIALES -  {{ cempresa }} </h2>
                </div>
            </header>

            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tab01" href="#TabCompra" @click="tabCompra" role="tab" data-toggle="tab">
                                            <i class="fa fa-wpforms"></i> OBJETIVO COMPRA
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab02" href="#TabVenta" @click="tabVenta" role="tab" data-toggle="tab">
                                            <i class="fa fa-bus"></i> OBJETIVO VENTA
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active show" id="TabCompra">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">OBJETIVOS COMERCIALES COMPRA</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Empresa</label>
                                                                            <div class="col-sm-8">
                                                                                <label v-text="cempresa" class="form-control-label-readonly"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Sucursal</label>
                                                                            <div class="col-sm-8">
                                                                                <label v-text="csucursal" class="form-control-label-readonly"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Año</label>
                                                                            <div class="col-sm-8">
                                                                                <label v-text="fillObjComercialCompra.canio" class="form-control-label-readonly"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Mes</label>
                                                                            <div class="col-sm-8">
                                                                                <label v-text="fillObjComercialCompra.cmes" class="form-control-label-readonly"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="hidden" v-model="fillProveedor.nidproveedor">
                                                                                    <input type="text" v-model="fillProveedor.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
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
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Linea</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="fillObjComercialCompra.nidlinea" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboMarca()">
                                                                                    <el-option
                                                                                    v-for="item in arrayLinea"
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
                                                                            <label class="col-sm-4 form-control-label">Marca</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="fillObjComercialCompra.nidmarca" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboModelo()">
                                                                                    <el-option
                                                                                    v-for="item in arrayMarca"
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
                                                                            <label class="col-sm-4 form-control-label">Modelo</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="fillObjComercialCompra.nidmodelo" filterable clearable placeholder="SELECCIONE" >
                                                                                    <el-option
                                                                                    v-for="item in arrayModelo"
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
                                                                    <div class="col-sm-6 offset-sm-5">
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarDetalleVehiculoCompra(1)">
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
                                                            <form class="form-horizontal">
                                                                <template v-if="arrayDetalleVehiculoCompra.length">
                                                                    <div class="table-responsive barraLateral">
                                                                        <table class="table table-striped table-sm">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Proveedor</th>
                                                                                    <th>Linea</th>
                                                                                    <th>Marca</th>
                                                                                    <th>Modelo</th>
                                                                                    <th>Nombre Comercial</th>
                                                                                    <th>Objetivo (Cantidad)</th>
                                                                                    <th>Tipo Beneficio</th>
                                                                                    <th>Tipo Valor</th>
                                                                                    <th>Valor Beneficio</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="(detalle, index) in arrayDetalleVehiculoCompra" :key="detalle.nIdVersionVeh">
                                                                                    <td v-text="detalle.Proveedor"></td>
                                                                                    <td v-text="detalle.Linea"></td>
                                                                                    <td v-text="detalle.Marca"></td>
                                                                                    <td v-text="detalle.Modelo"></td>
                                                                                    <td v-text="detalle.cNombreComercial"></td>
                                                                                    <td>
                                                                                        <input type="number" min="0" class="form-control form-control-sm" v-model="detalle.nCantidadVehiculo"/>
                                                                                    </td>
                                                                                    <td>
                                                                                        <el-select v-model="arrayIndexTipoBeneficioId[index]" filterable clearable placeholder="SELECCIONE" >
                                                                                            <el-option
                                                                                            v-for="item in arrayTipoBeneficio"
                                                                                            :key="item.nIdPar"
                                                                                            :label="item.cParNombre"
                                                                                            :value="item.nIdPar">
                                                                                            </el-option>
                                                                                        </el-select>
                                                                                    </td>
                                                                                    <td>
                                                                                        <el-select v-model="arrayIndexFlagTipoValorId[index]" filterable clearable placeholder="SELECCIONE" >
                                                                                            <el-option
                                                                                            v-for="item in arrayFlagTipoValor"
                                                                                            :key="item.nIdPar"
                                                                                            :label="item.cParNombre"
                                                                                            :value="item.nIdPar">
                                                                                            </el-option>
                                                                                        </el-select>
                                                                                    </td>
                                                                                    <td>
                                                                                        <input type="number" v-model="arrayIndexValorBeneficio[index]" class="form-control form-control-sm">
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <br>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-9 offset-md-5">
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarObjComercialCompra()">
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
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="TabVenta">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">OBJETIVOS COMERCIALES VENTA</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Empresa</label>
                                                                            <div class="col-sm-8">
                                                                                <label v-text="cempresa" class="form-control-label-readonly"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Sucursal</label>
                                                                            <div class="col-sm-8">
                                                                                <label v-text="csucursal" class="form-control-label-readonly"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Año</label>
                                                                            <div class="col-sm-8">
                                                                                <label v-text="fillObjComercialVenta.canio" class="form-control-label-readonly"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Mes</label>
                                                                            <div class="col-sm-8">
                                                                                <label v-text="fillObjComercialVenta.cmes" class="form-control-label-readonly"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="hidden" v-model="fillProveedor.nidproveedor">
                                                                                    <input type="text" v-model="fillProveedor.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
                                                                                    <div class="input-group-prepend">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Buscar Proveedor </div>
                                                                                            <button type="button" title="Buscar Proveedor" class="btn btn-info btn-corner btn-sm" @click="abrirModal('proveedor','buscar')">
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
                                                                    <div class="col-sm-6 offset-sm-5">
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarDetalleVehiculoVenta(1)">
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
                                                            <form class="form-horizontal">
                                                                <template v-if="arrayDetalleVehiculoVenta.length">
                                                                    <div class="table-responsive barraLateral">
                                                                        <table class="table table-striped table-sm">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Proveedor</th>
                                                                                    <th>Linea</th>
                                                                                    <th>Marca</th>
                                                                                    <th>Modelo</th>
                                                                                    <th>Nombre Comercial</th>
                                                                                    <th>Objetivo (Cantidad)</th>
                                                                                    <th>Tipo Valor</th>
                                                                                    <th>Valor Beneficio</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="detalle in arrayDetalleVehiculoVenta" :key="detalle.nIdVersionVeh">
                                                                                    <td v-text="detalle.Proveedor"></td>
                                                                                    <td v-text="detalle.Linea"></td>
                                                                                    <td v-text="detalle.Marca"></td>
                                                                                    <td v-text="detalle.Modelo"></td>
                                                                                    <td v-text="detalle.cNombreComercial"></td>
                                                                                    <td>
                                                                                        <input type="number" min="0" class="form-control form-control-sm" v-model="detalle.nCantidadVehiculo"/>
                                                                                    </td>
                                                                                    <td>
                                                                                        <el-select v-model="arrayIndexFlagTipoValorIdVenta[index]" filterable placeholder="SELECCIONE" >
                                                                                            <el-option
                                                                                            v-for="item in arrayFlagTipoValorVenta"
                                                                                            :key="item.nIdPar"
                                                                                            :label="item.cParNombre"
                                                                                            :value="item.nIdPar">
                                                                                            </el-option>
                                                                                        </el-select>
                                                                                    </td>
                                                                                    <td>
                                                                                        <input type="number" v-model="arrayIndexValorBeneficioVenta[index]" class="form-control form-control-sm">
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <br>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-9 offset-md-5">
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarObjComercialVenta()">
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
                                                            </form>
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
                                <div v-for="e in mensajeError" :key="e" v-text="e"></div>
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
                            <form v-on:submit.prevent class="form-horizontal">
                                <div class="container-fluid">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">LISTADO</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Nombre</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillProveedor.cproveedornombre" @keyup.enter="buscaProveedores()" class="form-control form-control-sm">
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
        props:['ruta'],
        data(){
            return {
                cempresa: sessionStorage.getItem("cNombreEmpresa"),
                csucursal: sessionStorage.getItem("cNombreSucursal"),
                // ===========================================================
                // ===================== VARIABLES TAB COMPRA ================
                fillObjComercialCompra:{
                    nidcronograma: 0,
                    cflagtipobeneficio: 0,
                    nidlinea: '',
                    nidmarca: '',
                    nidmodelo: '',
                    canio: '',
                    cmes: ''
                },
                arrayFlagTipoValor: [],
                arrayTipoBeneficio: [],
                arrayListaVehiculoCompra: [],
                arrayDetalleVehiculoCompra: [],
                arrayTempDetalleVehiculo: [],
                arrayLinea: [],
                arrayMarca: [],
                arrayModelo: [],
                // ============== VARIABLES PARA FLAG BENEFICIO COMPRA ================
                arrayIndexTipoBeneficioId: [],
                arrayIndexTipoBeneficioNombre: [],
                arrayIndexTipoBeneficioFlag: [],
                arrayIndexValorBeneficio: [],
                // ============== VARIABLES PARA FLAG TIPO MONEDA COMPRA ================
                arrayIndexFlagTipoValorId: [],
                // ===========================================================
                // ===================== VARIABLES TAB VENTA ================
                fillObjComercialVenta:{
                    nidcronograma: 0,
                    cflagtipobeneficio: 0,
                    nidlinea: '',
                    nidmarca: '',
                    nidmodelo: '',
                    canio: '',
                    cmes: ''
                },
                arrayDetalleVehiculoVenta: [],
                arrayFlagTipoValorVenta: [],
                // ============== VARIABLES PARA FLAG BENEFICIO VENTA ================
                arrayIndexValorBeneficioVenta: [],
                // ============== VARIABLES PARA FLAG TIPO MONEDA VENTA ================
                arrayIndexFlagTipoValorIdVenta: [],
                // =============================================================
                // MODAL PROVEEDOR
                // =============================================================
                fillProveedor:{
                    nidproveedor: 0,
                    cproveedornombre: ''
                },
                arrayProveedor: [],
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
                mensajeError: []
            }
        },
        mounted(){
            this.llenarCompraActiva();
            this.llenarComboLinea();
            this.llenarComboTipoBeneficio();
            this.llenarComboTipoValor();
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
            },
        },
        methods: {
            llenarCompraActiva(){
                var url = this.ruta + '/objComercial/getCompraActiva';
                axios.get(url).then(response => {
                    this.fillObjComercialCompra.canio = response.data[0].cAnio;
                    this.fillObjComercialCompra.cmes = response.data[0].cMes;
                    this.fillObjComercialCompra.nidcronograma = response.data[0].nIdCronograma;
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
            llenarVentaActiva(){
                var url = this.ruta + '/objComercial/getVentaActiva';
                axios.get(url).then(response => {
                    this.fillObjComercialVenta.canio = response.data[0].cAnio;
                    this.fillObjComercialVenta.cmes = response.data[0].cMes;
                    this.fillObjComercialVenta.nidcronograma = response.data[0].nIdCronograma;
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
            tabCompra(){
                this.llenarCompraActiva();
                this.limpiarProveedor();
                this.limpiarTabCompra();
                this.limpiarFormulario();
            },
            llenarComboLinea(){
                var url = this.ruta + '/versionvehiculo/GetLineasByProveedor';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidproveedor' : this.fillProveedor.nidproveedor
                    }
                }).then(response => {
                    this.arrayLinea = response.data;
                    this.fillObjComercialCompra.nidlinea = '';
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
                        'nidlinea': this.fillObjComercialCompra.nidlinea
                    }
                }).then(response => {
                    this.arrayMarca = response.data;
                    this.fillObjComercialCompra.nidmarca = '';
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
                        'nidmarca': this.fillObjComercialCompra.nidmarca
                    }
                }).then(response => {
                    this.arrayModelo = response.data;
                    this.fillObjComercialCompra.nidmodelo = '';
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
            llenarComboTipoBeneficio(){
               var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110069
                    }
                }).then(response => {
                    this.arrayTipoBeneficio = response.data;
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
            llenarComboTipoValor(){
               var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110065
                    }
                }).then(response => {
                    this.arrayFlagTipoValor = response.data;
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
            // ==============================================================
            // ========== BUSCAR DETALLE VEHICULO TAB COMPRA ================
            listarDetalleVehiculoCompra(page){
                if(this.validaBuscaDetalleVehiculoCompra()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.mostrarProgressBar();
                var url = this.ruta + '/objComercial/GetDetalleVehiculoCompra';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidcronograma': this.fillObjComercialCompra.nidcronograma,
                        'nidproveedor': this.fillProveedor.nidproveedor,
                        'nidlinea': this.fillObjComercialCompra.nidlinea,
                        'nidmarca': this.fillObjComercialCompra.nidmarca,
                        'nidmodelo': this.fillObjComercialCompra.nidmodelo,
                        'page' : page
                    }
                }).then(response => {
                    let info = response.data;
                    this.arrayListaVehiculoCompra = info;
                    this.llenarArrayDetalleVehiculoCompra();
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
            llenarArrayDetalleVehiculoCompra(){
                let me = this;

                me.arrayDetalleVehiculoCompra = [];

                me.arrayListaVehiculoCompra.map(function(value, key){
                    me.arrayDetalleVehiculoCompra.push({
                            nIdVersionVeh   : value.nIdVersionVeh,
                            Proveedor       : value.Proveedor,
                            Linea           : value.Linea,
                            Marca           : value.Marca,
                            Modelo          : value.Modelo,
                            cNombreComercial: value.cNombreComercial,
                            nCantidadVehiculo: value.nCantidadVehiculo
                    });

                    me.arrayIndexTipoBeneficioId[key] = value.nIdFlagTipoBeneficio == 0 ? '' : value.nIdFlagTipoBeneficio,
                    me.arrayIndexFlagTipoValorId[key] = value.nIdFlagTipoValor == 0 ? '' : value.nIdFlagTipoValor,
                    me.arrayIndexValorBeneficio[key] = value.fValorBeneficio == 0 ? '' : value.fValorBeneficio
                });
            },
            validaBuscaDetalleVehiculoCompra(){
                this.error = 0;
                this.mensajeError =[];

                if(this.fillProveedor.nidproveedor == 0 && !this.fillProveedor.cproveedornombre){
                    this.mensajeError.push('Debe seleccionar un proveedor');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // ====================================================================
            // ============== REGISTRAR OBJETIVO COMERCIAL COMPRA =================
            llenarArrayDetalleVehiculo(){
                let me = this;

                me.arrayTempDetalleVehiculo = [];

                me.arrayDetalleVehiculoCompra.map(function(value, key){
                    if(value.nCantidadVehiculo > 0){
                        me.arrayTempDetalleVehiculo.push({
                            nIdVersionVeh       : value.nIdVersionVeh,
                            cNombreComercial    : value.cNombreComercial,
                            nCantidadVehiculo   : value.nCantidadVehiculo,
                            nIdFlagTipoBeneficio  : me.arrayIndexTipoBeneficioId[key] = '' ? 0 : me.arrayIndexTipoBeneficioId[key],
                            nIdFlagTipoValor      : me.arrayIndexFlagTipoValorId[key] = '' ? 0 : me.arrayIndexFlagTipoValorId[key],
                            fValorBeneficio     : me.arrayIndexValorBeneficio[key]
                        });
                        //console.log(me.arrayIndexFlagTipoValorId[key]);
                    }
                });
                //console.log(me.arrayTempDetalleVehiculo.length);
            },
            registrarObjComercialCompra(){

                //======= Valido informacion correcta ==========
                if(this.validarRegistrarObjComercial()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                //======= LLeno el array para enviar ==========
                this.llenarArrayDetalleVehiculo();


                var url = this.ruta + '/objComercial/SetRegistrarObjComercialCompra';
                axios.post(url, {
                    'nIdEmpresa'            :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                    'nIdSucursal'           :   parseInt(sessionStorage.getItem("nIdSucursal")),
                    'nIdProveedor'          :   this.fillProveedor.nidproveedor,
                    'nIdCronograma'         :   this.fillObjComercialCompra.nidcronograma,
                    'cFlagTipoOperacion'    :   'C',
                    'arrayData'             :   this.arrayTempDetalleVehiculo
                }).then(response => {
                    swal('Objetivo Comercial - Compra registrada exitosamente');
                    this.limpiarTabCompra();
                }).catch(error => {
                    this.errors = error
                });
            },
            validarRegistrarObjComercial(){
                let me = this;

                me.error = 0;
                me.mensajeError =[];

                if(me.arrayDetalleVehiculoCompra.length > 0){
                    me.arrayDetalleVehiculoCompra.map(function(value, key){
                        if(me.arrayIndexValorBeneficio[key])
                        {
                            if(me.arrayIndexTipoBeneficioId[key] == 0 || !me.arrayIndexTipoBeneficioId[key]){
                                me.mensajeError.push('Seleccione Tipo Beneficio para ' + value.cNombreComercial);
                            }
                            if(me.arrayIndexFlagTipoValorId[key] == 0 || !me.arrayIndexFlagTipoValorId[key]){
                                me.mensajeError.push('Seleccione Tipo Valor para' + value.cNombreComercial);
                            }
                        }
                    });
                }

                if(me.fillProveedor.nidproveedor == 0 && !me.fillProveedor.cproveedornombre){
                    me.mensajeError.push('Debe seleccionar un proveedor');
                }

                if(me.mensajeError.length){
                    me.error = 1;
                }
                return me.error;
            },
            // ==============================================================
            // ========== BUSCAR DETALLE VEHICULO TAB VENTA ================
            tabVenta(){
                this.llenarVentaActiva();
                this.limpiarProveedor();
                this.limpiarTabVenta();
                this.llenarComboTipoValorVenta();
            },
            llenarComboTipoValorVenta(){
               var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110065
                    }
                }).then(response => {
                    this.arrayFlagTipoValorVenta = response.data;
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
            listarDetalleVehiculoVenta(page){
                if(this.validaBuscaDetalleVehiculoVenta()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.mostrarProgressBar();
                var url = this.ruta + '/objComercial/GetDetalleVehiculoVenta';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidcronograma': this.fillObjComercialVenta.nidcronograma,
                        'nidproveedor': this.fillProveedor.nidproveedor,
                        'nidlinea': this.fillObjComercialVenta.nidlinea,
                        'nidmarca': this.fillObjComercialVenta.nidmarca,
                        'nidmodelo': this.fillObjComercialVenta.nidmodelo,
                        'page' : page
                    }
                }).then(response => {
                    let info = response.data;
                    this.arrayDetalleVehiculoVenta = info;
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
            validaBuscaDetalleVehiculoVenta(){
                this.error = 0;
                this.mensajeError =[];

                if(this.fillProveedor.nidproveedor == 0 && !this.fillProveedor.cproveedornombre){
                    this.mensajeError.push('Debe seleccionar un proveedor');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // ====================================================================
            // ============== REGISTRAR OBJETIVO COMERCIAL VENTA =================
            registrarObjComercialVenta(){

                //======= Valido informacion correcta ==========
                if(this.validarRegistrarObjComercialVenta()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/objComercial/SetRegistrarObjComercialVenta';
                axios.post(url, {
                    'nIdEmpresa'            :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                    'nIdSucursal'           :   parseInt(sessionStorage.getItem("nIdSucursal")),
                    'nIdProveedor'          :   this.fillProveedor.nidproveedor,
                    'nIdCronograma'         :   this.fillObjComercialVenta.nidcronograma,
                    'cFlagTipoOperacion'    :   'V',
                    'arrayData'             :   this.arrayDetalleVehiculoVenta
                }).then(response => {
                    swal('Objetivo Comercial - Venta registrada exitosamente');
                    this.limpiarTabVenta();
                }).catch(error => {
                    this.errors = error
                });
            },
            validarRegistrarObjComercialVenta(){
                let me = this;

                me.error = 0;
                me.mensajeError =[];

                if(me.fillProveedor.nidproveedor == 0 && !me.fillProveedor.cproveedornombre){
                    me.mensajeError.push('Debe seleccionar un proveedor');
                }

                if(me.mensajeError.length){
                    me.error = 1;
                }
                return me.error;
            },
            // =======================
            // MODAL PROVEEDOR
            // =======================
            buscaProveedores(){
                this.listarProveedores(1);
            },
            listarProveedores(page){
                var url = this.ruta + '/parametro/GetLstProveedor';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidgrupopar' : 110023,
                        'cnombreproveedor' : this.fillProveedor.cproveedornombre.toString(),
                        'opcion' : 0,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayProveedor = response.data.arrayProveedor.data;
                    this.paginationModal.current_page   =  response.data.arrayProveedor.current_page;
                    this.paginationModal.total          = response.data.arrayProveedor.total;
                    this.paginationModal.per_page       = response.data.arrayProveedor.per_page;
                    this.paginationModal.last_page      = response.data.arrayProveedor.last_page;
                    this.paginationModal.from           = response.data.arrayProveedor.from;
                    this.paginationModal.to             = response.data.arrayProveedor.to;
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
                this.fillProveedor.nidproveedor = nProveedorId;
                this.fillProveedor.cproveedornombre = cProveedorNombre;
                this.cerrarModal();
                this.arrayMarca = [];
                this.arrayModelo = [];
                this.llenarComboLinea();
            },
            // =================================================================
            // METODOS GENERICOS
            // =================================================================
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "proveedor":
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
                    case "tipobeneficio":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=3;
                                this.modal=1;
                                this.listarTipoBeneficio(1);
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
            limpiarProveedor(){
              this.fillProveedor.nidproveedor = 0;
              this.fillProveedor.cproveedornombre = '';
            },
            limpiarTabCompra(){
                this.arrayListaVehiculoCompra = [],
                this.arrayTempDetalleVehiculo = [],
                this.arrayDetalleVehiculoCompra = []
            },
            limpiarTabVenta(){
                this.arrayDetalleVehiculoVenta = []
            },
            limpiarFormulario(){
                this.arrayLinea = [],
                this.arrayMarca = [],
                this.arrayModelo = []
            },
            //Cerrar Modal
            cerrarModal(){
                this.modal = 0;
                this.accionmodal = 0;
                this.error = 0;
                this.mensajeError = '';
                this.arrayProveedor = [];
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
        text-align: center;
        margin: auto;
    }
    .barraLateral{
        height: 45vh;
        max-width:1200px;
        overflow-x: auto;
        overflow-y: auto;
    }
</style>

