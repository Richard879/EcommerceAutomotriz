<template>
     <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
            <div class="container-fluid">
                <h2 class="no-margin-bottom">EXHIBICION</h2>
            </div>
            </header>

            <section>
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#TabBuscaExhibicion" @click="tabBuscarExhibicion()" role="tab" data-toggle="tab">
                                            <i class="fa fa-search"></i> BUSCAR EXHIBICION
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#TabGeneraExhibicion" @click="tabGenerarExhibicion()" role="tab" data-toggle="tab">
                                            <i class="fa fa-bus"></i> GENERAR EXHIBICION
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane fade in active show" id="TabBuscaExhibicion">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">BUSCAR EXHIBICION</h3>
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
                                                                            <label class="col-sm-4 form-control-label">* Fecha Inicio</label>
                                                                            <div class="col-sm-8">
                                                                                <el-date-picker
                                                                                    v-model="fillExhibicion.dfechainicio"
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
                                                                            <label class="col-sm-4 form-control-label">* Fecha Fin</label>
                                                                            <div class="col-sm-8">
                                                                                <el-date-picker
                                                                                    v-model="fillExhibicion.dfechafin"
                                                                                    type="date"
                                                                                    value-format="yyyy-MM-dd"
                                                                                    format="dd/MM/yyyy"
                                                                                    placeholder="dd/mm/aaaa">
                                                                                </el-date-picker>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Nº Orden Exhibicion</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillExhibicion.nordencompra" @keyup.enter="buscarExhibicions()" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Nro Vin</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillExhibicion.cnumerovin" @keyup.enter="buscarExhibicions()" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Marca</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="fillExhibicion.nidmarca" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboModelo()">
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
                                                                                <el-select v-model="fillExhibicion.nidmodelo" filterable clearable placeholder="SELECCIONE">
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
                                                                    <div class="col-sm-9 offset-sm-5">
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarExhibicions();">
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
                                                            <template v-if="arrayExhibicion.length">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Acciones</th>
                                                                                <th>Código</th>
                                                                                <th>Periodo</th>
                                                                                <th>Línea</th>
                                                                                <th>Almacén<nav></nav></th>
                                                                                <th>Nro Vin</th>
                                                                                <th>Nombre Comercial</th>
                                                                                <th>Año Fab</th>
                                                                                <th>Año Mod</th>
                                                                                <th>Moneda</th>
                                                                                <th>Total</th>
                                                                                <th>Fecha Reg.</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="exhibicion in arrayExhibicion" :key="exhibicion.nIdExhibicion">
                                                                                <td>
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Anular {{ exhibicion.cNumeroVin }}</div>
                                                                                        <i @click="desactivar(exhibicion)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                    </el-tooltip>&nbsp;
                                                                                </td>
                                                                                <td v-text="exhibicion.nIdExhibicion"></td>
                                                                                <td v-text="exhibicion.cNumeroMes + '-' + exhibicion.cAnio"></td>
                                                                                <td v-text="exhibicion.cNombreLinea"></td>
                                                                                <td v-text="exhibicion.cNombreAlmacen"></td>
                                                                                <td v-text="exhibicion.cNumeroVin"></td>
                                                                                <td v-text="exhibicion.cNombreComercial"></td>
                                                                                <td v-text="exhibicion.nAnioFabricacion"></td>
                                                                                <td v-text="exhibicion.nAnioModelo"></td>
                                                                                <td v-text="exhibicion.cSimboloMoneda"></td>
                                                                                <td v-text="exhibicion.fTotalExhibicion"></td>
                                                                                <td v-text="exhibicion.dFechaRegistro"></td>
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
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="TabGeneraExhibicion">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">GENERAR EXHIBICION</h3>
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
                                                                            <label class="col-sm-4 form-control-label">* Año</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="canio" class="form-control form-control-sm" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Mes</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="cmes" class="form-control form-control-sm" readonly>
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
                                                                                    <input type="hidden" v-model="formExhibicion.nidproveedor">
                                                                                    <input type="text" v-model="formExhibicion.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
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
                                                            <div class="col-lg-12">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-8">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Descargar Formato</label>
                                                                            <div class="col-sm-8">
                                                                                <a href="#" @click="descargaFormatoExhibicion">
                                                                                    <i class="fa-md fa fa-file-excel-o"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-8">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Ordenes de Exhibicion</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="file" id="file-upload" @change="getFile" accept=".xls,.xlsx" class="form-control form-control-sm"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="row">
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="importFileExhibicion()">
                                                                                <i class="fa fa-retweet"></i> Procesar
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <template v-if="arrayExcel.length">
                                                                    <div class="table-responsive border" style="max-height: 300px; max-width:1200px; overflow-y: auto; overflow-x: auto;-ms-overflow-style: -ms-autohiding-scrollbar;">
                                                                        <table class="table table-striped table-sm">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Acciones</th>
                                                                                    <th>Línea</th>
                                                                                    <th>Almacén<nav></nav></th>
                                                                                    <th>Nro Vin</th>
                                                                                    <th>Marca</th>
                                                                                    <th>Modelo</th>
                                                                                    <th>Nombre Comercial</th>
                                                                                    <th>Color</th>
                                                                                    <th>Año Fab</th>
                                                                                    <th>Año Mod</th>
                                                                                    <th>Mon</th>
                                                                                    <th>Total</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="(exhibicion, index) in arrayExcel" :key="exhibicion.nOrdenExhibicion">
                                                                                    <td>
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Eliminar O/C  {{ exhibicion.nOrdenExhibicion }}</div>
                                                                                            <i @click="eliminarItemExcel(index)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                        </el-tooltip>
                                                                                    </td>
                                                                                    <td v-text="exhibicion.cNombreLinea"></td>
                                                                                    <td v-text="exhibicion.cNombreAlmacen"></td>
                                                                                    <td v-text="exhibicion.cNumeroVin"></td>
                                                                                    <td v-text="exhibicion.cNombreMarca"></td>
                                                                                    <td v-text="exhibicion.cNombreModelo"></td>
                                                                                    <td v-text="exhibicion.cNombreComercial"></td>
                                                                                    <td v-text="exhibicion.cNombreColor"></td>
                                                                                    <td v-text="exhibicion.nAnioFabricacion"></td>
                                                                                    <td v-text="exhibicion.nAnioModelo"></td>
                                                                                    <td v-text="exhibicion.cSimboloMoneda"></td>
                                                                                    <td v-text="exhibicion.fTotalExhibicion"></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-7">
                                                                            </div>
                                                                            <div class="col-lg-5">
                                                                                <div class="datatable-info">Total: {{ contadorArrayExcel }} registros</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9 offset-sm-5">
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrar()">
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
                                                            </div>
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

            <!-- MODAL PROVEEDORES -->
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
                                                                <input type="text" v-model="fillProveedor.cnombreproveedor" @keyup.enter="buscaProveedores" class="form-control form-control-sm">
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
                                                            <td>{{proveedor.cParNombre}}</td>
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

            <!-- MODAL RESPUESTAS DE GENERAR EXHIBICION-->
            <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Automotores INKA</h4>
                            <button type="button" class="close" @click="limpiarFormulario(); cerrarModal()" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div v-if="arrayCompraExisteVin.length" class="col-sm-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">ESTOS VIN YA SE ECUENTRAN REGISTRADOS</h3>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped table-sm">
                                                <tbody>
                                                    <tr v-for="compra in arrayCompraExisteVin" :key="compra.cNumeroVin">
                                                        <td v-text="compra.cNumeroVin"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="arrayCompraPrecioLista.length" class="col-sm-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">ESTAS COMPRAS NO TIENEN EL FORMATO</h3>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped table-sm">
                                                <tbody>
                                                    <tr v-for="compra in arrayCompraPrecioLista" :key="compra.cNumeroVin">
                                                        <td v-text="compra.cNumeroVin"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="arrayCompraNombreComercial.length" class="col-sm-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">NO EXISTEN NOMBRE COMERCIAL EN BD</h3>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped table-sm">
                                                <tbody>
                                                    <tr v-for="compra in arrayCompraNombreComercial" :key="compra.cNumeroVin">
                                                        <td v-text="compra.cNumeroVin"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="limpiarFormulario(); cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--  MODAL EDITAR EXHIBICION -->
            <div class="modal fade" v-if="accionmodal==4" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4">EDITAR DATOS DE EXHIBICION</h3>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* O/C</label>
                                                    <div class="col-sm-8">
                                                        <label v-text="formModalExhibicion.nordencompra" class="form-control-label-readonly"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Nombe Comercial</label>
                                                    <div class="col-sm-8">
                                                        <label v-text="formModalExhibicion.cnombrecomercial" class="form-control-label-readonly"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Número VIN</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="formModalExhibicion.cnumerovin" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Número Motor</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="formModalExhibicion.cnumeromotor" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Número DUA</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="formModalExhibicion.cnumerodua" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Nombre Color</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="formModalExhibicion.cnombrecolor" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9 offset-sm-5">
                                                <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="actualizar();">
                                                    <i class="fa fa-save"></i> Actualizar
                                                </button>
                                                <button type="button" class="btn btn-secundary btn-corner btn-sm" @click="cerrarModal()">
                                                    <i class="fa fa-close"></i> Cancelar
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
                canio: '',
                cmes: '',
                nidcronograma: 0,
                // ============================================
                // ============ BUSCAR EXHIBICION =================
                fillExhibicion:{
                    dfechainicio: '',
                    dfechafin: '',
                    nordencompra: '',
                    cnumerovin: '',
                    nidmarca: '',
                    nidmodelo: ''
                },
                arrayMarca: [],
                arrayModelo: [],
                // ===============================================
                // ============ REGISTRAR EXHIBICION =================
                formExhibicion:{
                    nformapago: 0,
                    nidtipolista: 0,
                    nidproveedor: 0,
                    cproveedornombre: ''
                },
                arrayExhibicion: [],
                arrayExcel: [],
                contadorArrayExcel: 0,
                arrayTipoLista: [],
                // ==========================================================
                // ============ VARIABLES MODAL ACTUALIZAR EXHIBICION =================
                formModalExhibicion:{
                    nidcompra: 0,
                    cnombrecomercial:'',
                    cnumerovin:'',
                    cnumeromotor: '',
                    cnumerodua: '',
                    cnombrecolor: '',
                    cnumerodua: '',
                    nordencompra: ''
                },
                // ============ VARIABLES DE RESPUESTA =================
                arrayCompraPrecioLista: [],
                arrayCompraExisteVin: [],
                arrayCompraNombreComercial: [],
                arrayTempVinExiste: [],
                arrayTempVinListaPrecio:[],
                arrayTempVinNombreComercial: [],
                // ============================================================
                // =========== TAB LINEA CREDITO ============
                arrayLineaCredito: [],
                arrayTempLineaCredito: [],
                checkBoxLinea: [],
                // ============================================================
                // =========== TAB FORUM ============
                formForum:{
                    nidproveedor: ''
                },
                arrayProveedorForum: [],
                arrayForum: [],
                contadorArrayForum: 0,
                // ==========================================================
                // =============  BUSCAR PROVEEDORES ========================
                fillProveedor:{
                    cnombreproveedor: ''
                },
                arrayProveedor: [],
                // ============================================================
                pagination : {
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
                attachment: null,
                form: new FormData,
                textFile: ''
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

                var to = from + (this.offset * 3);
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
            tabBuscarExhibicion(){
                this.fillExhibicion.nidmarca = '';
                this.fillExhibicion.nidmodelo = '';
                this.fillExhibicion.dfechainicio = '';
                this.fillExhibicion.dfechafin = '';
                this.limpiarFormulario();
            },
            buscarExhibicions(){
                this.listarExhibicions(1);
            },
            llenarComboMarca(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';

                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110032
                    }
                }).then(response => {
                    this.arrayMarca = response.data;
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

                axios.get(url,{
                    params: {
                        'nidmarca' : this.fillExhibicion.nidmarca
                    }
                }).then(response => {
                    this.arrayModelo = response.data;
                    this.fillExhibicion.nidmodelo = '';
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            listarExhibicions(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/exhibicion/GetExhibicion';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'dfechainicio': this.fillExhibicion.dfechainicio,
                        'dfechafin': this.fillExhibicion.dfechafin,
                        'nidmarca': this.fillExhibicion.nidmarca,
                        'nidmodelo': this.fillExhibicion.nidmodelo,
                        'cnumerovin': this.fillExhibicion.cnumerovin,
                        'page': page
                    }
                }).then(response => {
                    this.arrayExhibicion = response.data.arrayExhibicion.data;
                    this.pagination.current_page =  response.data.arrayExhibicion.current_page;
                    this.pagination.total = response.data.arrayExhibicion.total;
                    this.pagination.per_page    = response.data.arrayExhibicion.per_page;
                    this.pagination.last_page   = response.data.arrayExhibicion.last_page;
                    this.pagination.from        = response.data.arrayExhibicion.from;
                    this.pagination.to           = response.data.arrayExhibicion.to;
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarExhibicions(page);
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
                this.formExhibicion.nidproveedor = nProveedorId;
                this.formExhibicion.cproveedornombre = cProveedorNombre;
                this.cerrarModal();
            },
            // ====================================================
            // =============  GENERAR EXHIBICION ======================
            tabGenerarExhibicion(){
                this.obtenerCronogramaCompraActivo();
                this.limpiarFormulario();
            },
            obtenerCronogramaCompraActivo(){
                var url = this.ruta + '/cronograma/GetCronogramaCompraActivo';

                axios.get(url,{
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa"))
                    }
                }).then(response => {
                    this.canio = response.data.arrayCronograma[0].cAnio;
                    this.cmes = response.data.arrayCronograma[0].cMes;
                    this.nidcronograma = response.data.arrayCronograma[0].nIdCronograma;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            getFile(e){
                let selectFile = e.target.files[0];
                this.attachment = selectFile;
                this.arrayExcel = [];
            },
            importFileExhibicion(){
                if(this.validarReadFileExhibicion()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.form.append('file', this.attachment);
                const config = { headers: { 'Content-Type': 'multipart/form-data'  } };
                var url = this.ruta + '/exhibicion/importFileExhibicion';
                axios.post(url, this.form, config).then(response=>{
                    this.readFileExhibicion(response.data);
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            readFileExhibicion(nameFile){
                this.mostrarProgressBar();

                var url = this.ruta + '/exhibicion/readFileExhibicion';
                axios.post(url, {
                    nameFile: nameFile
                }).then(response => {

                    this.arrayExcel = response.data;

                    if(this.validaCamposExcel()){
                        this.accionmodal=1;
                        this.modal = 1;
                        return;
                    }

                    this.$delete(this.arrayExcel, 0)
                    this.contadorArrayExcel = this.arrayExcel.length;
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            validaCamposExcel(){
                let me = this;
                me.error = 0;
                me.mensajeError = [];
                var i = 1;

                /*me.arrayExcel.map(function(value, key) {
                    if(key==0){
                        if(value.nOrdenExhibicion != "OC"){
                            me.mensajeError.push('Falta celda OC, verifique el archivo.');
                        };
                        if(value.cNombreLinea != "Línea"){
                            me.mensajeError.push('Falta celda Línea, verifique el archivo.');
                        };
                        if(value.cNombreAlmacen != "Almacén"){
                            me.mensajeError.push('Falta celda Almacén, verifique el archivo.');
                        };
                        if(value.nNumeroReserva != "Nro Reserva"){
                            me.mensajeError.push('Falta celda Nro Reserva, verifique el archivo.');
                        };
                        if(value.fTotalExhibicion != "Total"){
                            me.mensajeError.push('Falta celda Total, verifique el archivo.');
                        };
                    };
                });*/

                if(me.mensajeError.length){
                    me.error = 1;
                }
                return me.error;
            },
            eliminarItemExcel(index){
                this.$delete(this.arrayExcel, index);
            },
            registrar(){
                if(this.validarRegistro()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.mostrarProgressBar();

                var url = this.ruta + '/exhibicion/SetExhibicion';
                axios.post(url, {
                    nIdEmpresa: parseInt(sessionStorage.getItem("nIdEmpresa")),
                    nIdSucursal: sessionStorage.getItem("nIdSucursal"),
                    nIdCronograma: parseInt(this.nidcronograma),
                    nIdProveedor: parseInt(this.formExhibicion.nidproveedor),
                    data: this.arrayExcel
                }).then(response => {
                    let me = this;

                    me.arrayTempVinExiste = [];
                    me.arrayTempVinListaPrecio = [];
                    me.arrayTempVinNombreComercial = [];
                    me.arrayCompraExisteVin = [];
                    me.arrayCompraPrecioLista = [];
                    me.arrayCompraNombreComercial = [];

                    if(response.data.arrayVinExiste.length)
                    {
                        me.arrayTempVinExiste = response.data.arrayVinExiste;
                        me.arrayTempVinExiste.map(function(value, key) {
                            me.arrayCompraExisteVin.push({
                                cNumeroVin: me.arrayTempVinExiste[key]
                            });
                        });
                    }
                    if(response.data.arrayFormato.length){
                        me.arrayTempVinListaPrecio = response.data.arrayFormato;
                        me.arrayTempVinListaPrecio.map(function(value, key) {
                            me.arrayCompraPrecioLista.push({
                                cNumeroVin: me.arrayTempVinListaPrecio[key]
                            });
                        });
                    }
                    if(response.data.arrayNombreComercial.length){
                        me.arrayTempVinNombreComercial = response.data.arrayNombreComercial;
                        me.arrayTempVinNombreComercial.map(function(value, key) {
                            me.arrayCompraNombreComercial.push({
                                cNumeroVin: me.arrayTempVinNombreComercial[key]
                            });
                        });
                    }
                    
                    $("#myBar").hide();
                    //============= RESULTADO PARA MOSTRAR ================
                    if(me.arrayCompraExisteVin.length || me.arrayCompraPrecioLista.length || me.arrayCompraNombreComercial.length){
                        me.accionmodal=3;
                        me.modal = 1;
                        me.attachment = [];
                    }else{
                        swal('Exhibicion registrada correctamente');
                        me.attachment = [],
                        me.limpiarFormulario();
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
            validarRegistro(){
                this.error = 0;
                this.mensajeError =[];

                if(this.arrayExcel == []){
                    this.mensajeError.push('No hay Datos a Registrar');
                };
                if(this.formExhibicion.nidproveedor == 0){
                    this.mensajeError.push('Debes seleccionar un Proveedor');
                };

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            validarReadFileExhibicion(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.attachment || this.attachment==[] || this.attachment==''){
                    this.mensajeError.push('No hay Archivos Seleccionados');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            desactivar(exhibicion){
                swal({
                    title: 'Estas seguro de eliminar esta Exhibicion?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Desactivar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.value) {
                        var url = this.ruta + '/exhibicion/desactivar';
                        axios.put(url, {
                            nIdExhibicion: exhibicion.nIdExhibicion
                        }).then(response => {
                            if(response.data[0].nFlagMsje == 1){
                                swal(
                                    'Desactivado!',
                                    response.data[0].cMensaje
                                );
                            }
                            else{
                                swal(
                                    'Alerta!',
                                    response.data[0].cMensaje
                                );
                            }
                            this.listarExhibicions(1);
                        })
                        .catch(function (error) {
                            console.log(error);
                            if (error.response) {
                                if (error.response.status == 401) {
                                    location.reload('0');
                                }
                            }
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel)
                    {
                    }
                })
            },
            descargaFormatoExhibicion(){
                window.open(this.ruta + '/storage/FormatosDescarga/FormatoExhibicionExcel.xlsx');
            },
            // =============  ACTUALIZAR EXHIBICION ======================
            actualizar(){
                if(this.validarActualizar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/exhibicion/UpdExhibicionById';
                axios.post(url, {
                    nIdEmpresa: parseInt(sessionStorage.getItem("nIdEmpresa")),
                    nIdSucursal: sessionStorage.getItem("nIdSucursal"),
                    nIdExhibicion: this.formModalExhibicion.nidcompra,
                    cNumeroVin: this.formModalExhibicion.cnumerovin,
                    cNumeroMotor: this.formModalExhibicion.cnumeromotor,
                    cNumeroDua: this.formModalExhibicion.cnumerodua,
                    cNombreColor: this.formModalExhibicion.cnombrecolor
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1) {
                        swal('Exhibicion actualizada correctamente');
                        this.cerrarModal();
                        this.listarExhibicions(1);
                    } else {
                        swal('Ya existe VIN');
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
            validarActualizar(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.formModalExhibicion.cnumerovin){
                    this.mensajeError.push('Debes ingresar Nro Vin');
                };

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // =============================================
            // =============  MODAL ========================
            cerrarModal(){
                this.modal = 0,
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
                    }break;
                    case 'exhibicion':
                    {
                        switch(accion){
                            case 'editar':
                            {
                                this.accionmodal=4;
                                this.modal = 1;
                                this.formModalExhibicion.nidcompra = data['nIdExhibicion'];
                                this.formModalExhibicion.nordencompra = data['nOrdenExhibicion'];
                                this.formModalExhibicion.cnombrecomercial = data['cNombreComercial'];
                                this.formModalExhibicion.cnumerovin = data['cNumeroVin'];
                                this.formModalExhibicion.cnumeromotor = data['cNumeroMotor'];
                                this.formModalExhibicion.cnumerodua = data['cNumeroDua'];
                                this.formModalExhibicion.cnombrecolor = data['cNombreColor'];
                                break;
                            }
                            case 'lineacredito':
                            {
                                this.accionmodal=5;
                                this.modal = 1;
                                break;
                            }
                        }
                    };
                }
            },
            // ===========================================================
            limpiarFormulario(){
                this.fillExhibicion.nordencompra= '',
                this.fillExhibicion.cnumerovin=  '',
                this.arrayExcel = [],
                this.form = new FormData,
                $("#file-upload").val("")
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
    /*input[type="file"] {
        display: none;
    }*/
</style>
