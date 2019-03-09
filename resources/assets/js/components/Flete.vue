<template>
     <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">FLETE</h2>
                </div>
            </header>

            <section>
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#TabBuscaFlete" @click="tabBuscarFlete()" role="tab" data-toggle="tab">
                                            <i class="fa fa-search"></i> BUSCAR FLETE
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tabGeneraFlete" @click="tabGeneraFlete()" role="tab" data-toggle="tab">
                                            <i class="fa fa-file-text-o"></i> ASIGNAR FLETE
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane fade in active show" id="TabBuscaFlete">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">BUSCAR FLETE</h3>
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
                                                                                    v-model="fillFlete.dfechainicio"
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
                                                                                    v-model="fillFlete.dfechafin"
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
                                                                    <div class="col-sm-9 offset-sm-5">
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarFlete(1);">
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
                                                            <template v-if="arrayFlete.length">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Acciones</th>
                                                                                <th>Código</th>
                                                                                <th>Nro Serie</th>
                                                                                <th>Nro Comprobante</th>
                                                                                <th>Nro Ruc</th>
                                                                                <th>Importe Total</th>
                                                                                <th>Fecha Registro</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="flete in arrayFlete" :key="flete.nIdFleteDetalle">
                                                                                <td>
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Ver Detalle  {{ flete.nIdFlete }}</div>
                                                                                        <i @click="abrirModal('detalle','buscar', flete)" :style="'color:#796AEE'" class="fa-md fa fa-eye"></i>
                                                                                    </el-tooltip>&nbsp;&nbsp;
                                                                                </td>
                                                                                <td v-text="flete.nIdFlete"></td>
                                                                                <td v-text="flete.cSerieComprobante"></td>
                                                                                <td v-text="flete.cNumeroComprobante"></td>
                                                                                <td v-text="flete.cNumeroRuc"></td>
                                                                                <td v-text="flete.fImporteTotalFlete"></td>
                                                                                <td v-text="flete.dFechaRegistro"></td>
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
                                                                                        <a @click.prevent="cambiarPaginaFlete(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                    </li>
                                                                                    <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                    :class="[page==isActived?'active':'']">
                                                                                        <a class="page-link"
                                                                                        href="#" @click.prevent="cambiarPaginaFlete(page)"
                                                                                        v-text="page"></a>
                                                                                    </li>
                                                                                    <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                        <a @click.prevent="cambiarPaginaFlete(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                    <div role="tabpanel" class="tab-pane fade" id="tabGeneraFlete">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">ASIGNAR FLETE</h3>
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
                                                                            <label class="col-sm-4 form-control-label">* Ruc</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="formmFlete.cnumeroruc" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Serie Comprobante</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="formmFlete.cseriecomprobante" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Nro Comprobante</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="number" v-model="formmFlete.cnumerocomprobante" class="form-control form-control-sm">
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
                                                            <div class="form-group row">
                                                                <div class="col-sm-9">
                                                                    <div class="row">
                                                                        <label class="col-sm-3 form-control-label">* Buscar Compras</label>
                                                                        <div class="col-sm-6">
                                                                            <div class="input-group">
                                                                                <input type="text" placeholder="BUSCAR COMPRAS" class="form-control form-control-sm" readonly>
                                                                                <div class="input-group-prepend">
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Buscar Compras </div>
                                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('compra','buscar')">
                                                                                            <i class="fa-lg fa fa-search"></i>
                                                                                        </button>
                                                                                    </el-tooltip>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br/>
                                                            <template v-if="arrayTempFlete.length">
                                                                <span style="color:red; font-size: 12px;"><strong>* El Importe del Flete debe ser en SOLES y SIN IGV</strong></span>
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Acciones</th>
                                                                                <th>Código</th>
                                                                                <th>Periodo</th>
                                                                                <th>OC</th>
                                                                                <th>Nro Vin</th>
                                                                                <th>Nombre Comercial</th>
                                                                                <th>Año Fab</th>
                                                                                <th>Año Mod</th>
                                                                                <th>Importe Flete</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="(compra, index) in arrayTempFlete" :key="compra.nIdCompra">
                                                                                <td>
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Eliminar {{ compra.cNumeroVin }}</div>
                                                                                        <i @click="removerCompraFlete(index)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                    </el-tooltip>
                                                                                </td>
                                                                                <td v-text="compra.nIdCompra"></td>
                                                                                <td v-text="compra.cNumeroMes + '-' + compra.cAnio"></td>
                                                                                <td v-text="compra.nOrdenCompra"></td>
                                                                                <td v-text="compra.cNumeroVin"></td>
                                                                                <td v-text="compra.cNombreComercial"></td>
                                                                                <td v-text="compra.nAnioFabricacion"></td>
                                                                                <td v-text="compra.nAnioVersion"></td>
                                                                                <td><input type="text" v-model="arrayIndexFleteMonto[index]" class="form-control form-control-sm"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-9 offset-sm-5">
                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarFlete()">
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

            <!-- MODAL COMPRAS -->
            <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTA DE COMPRAS</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Fecha Inicio</label>
                                                        <div class="col-sm-8">
                                                            <el-date-picker
                                                                v-model="fillCompra.dfechainicio"
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
                                                        <label class="col-sm-4 form-control-label">Fecha Fin</label>
                                                        <div class="col-sm-8">
                                                            <el-date-picker
                                                                v-model="fillCompra.dfechafin"
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
                                                        <label class="col-sm-4 form-control-label">Nº Orden Compra</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" v-model="fillCompra.cnumerofactura" @keyup.enter="listarCompras(1)" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Nro Vin</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" v-model="fillCompra.cnumerovin" @keyup.enter="listarCompras(1)" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Marca</label>
                                                        <div class="col-sm-8">
                                                            <el-select v-model="fillCompra.nidmarca" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboModelo()">
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
                                                            <el-select v-model="fillCompra.nidmodelo" filterable clearable placeholder="SELECCIONE">
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
                                                <div class="col-sm-9 offset-sm-5">
                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarCompras(1);"><i class="fa fa-search"></i> Buscar</button>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
                                        <template v-if="arrayCompra.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccione</th>
                                                            <th>Código</th>
                                                            <th>Periodo</th>
                                                            <th>OC</th>
                                                            <th>Línea</th>
                                                            <th>Almacén<nav></nav></th>
                                                            <th>Nro Reserva</th>
                                                            <th>Nro Vin</th>
                                                            <th>Forma Pago</th>
                                                            <th>Nombre Comercial</th>
                                                            <th>Año Fab</th>
                                                            <th>Año Mod</th>
                                                            <th>Moneda</th>
                                                            <th>Total</th>
                                                            <th>Nro Factura</th>
                                                            <th>Fecha Facturado</th>
                                                            <th>Fecha Flete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="compra in arrayCompra" :key="compra.nIdCompra">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar {{ compra.cNumeroVin }}</div>
                                                                    <i @click="asignarComprasFlete(compra)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td v-text="compra.nIdCompra"></td>
                                                            <td v-text="compra.cNumeroMes + '-' + compra.cAnio"></td>
                                                            <td v-text="compra.nOrdenCompra"></td>
                                                            <td v-text="compra.cNombreLinea"></td>
                                                            <td v-text="compra.cNombreAlmacen"></td>
                                                            <td v-text="compra.nNumeroReserva"></td>
                                                            <td v-text="compra.cNumeroVin"></td>
                                                            <td v-text="compra.cFormaPago"></td>
                                                            <td v-text="compra.cNombreComercial"></td>
                                                            <td v-text="compra.nAnioFabricacion"></td>
                                                            <td v-text="compra.nAnioVersion"></td>
                                                            <td v-text="compra.cSimboloMoneda"></td>
                                                            <td v-text="compra.fTotalCompra"></td>
                                                            <td v-text="compra.cNumeroFactura"></td>
                                                            <td v-text="compra.dFechaFacturado"></td>
                                                            <td v-text="compra.dFechaCompra"></td>
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
                                                                    <a @click.prevent="cambiarPagina(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPagina(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPagina(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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

            <!-- MODAL DETALLE FLETE -->
            <div class="modal fade" v-if="accionmodal==4" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">DETALLE FLETE</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Marca</label>
                                                        <div class="col-sm-8">
                                                            <el-select v-model="fillFlete.nidmarca" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboModelo()">
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
                                                            <el-select v-model="fillFlete.nidmodelo" filterable clearable placeholder="SELECCIONE">
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
                                                        <label class="col-sm-4 form-control-label">Nro Vin</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" v-model="fillFlete.cnumerovin" @keyup.enter="buscarCompras()" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-9 offset-sm-5">
                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarFleteDetalle(1);"><i class="fa fa-search"></i> Buscar</button>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
                                        <template v-if="arrayFleteDetalle.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Acciones</th>
                                                            <th>Código</th>
                                                            <th>Nro Vin</th>
                                                            <th>Nombre Comercial</th>
                                                            <th>Año Fab</th>
                                                            <th>Año Mod</th>
                                                            <th>Moneda</th>
                                                            <th>Monto Flete</th>
                                                            <th>Fecha Reg</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="flete in arrayFleteDetalle" :key="flete.nIdFleteDetalle">
                                                            <td></td>
                                                            <td v-text="flete.nIdFleteDetalle"></td>
                                                            <td v-text="flete.cNumeroVin"></td>
                                                            <td v-text="flete.cNombreComercial"></td>
                                                            <td v-text="flete.nAnioFabricacion"></td>
                                                            <td v-text="flete.nAnioVersion"></td>
                                                            <td v-text="flete.cMonedaNombre"></td>
                                                            <td v-text="flete.fImporteFleteSinIgv"></td>
                                                            <td v-text="flete.dFechaRegistro"></td>
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
                                                                    <a @click.prevent="cambiarPaginaFleteDetalle(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                :class="[page==isActived?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaFleteDetalle(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaFleteDetalle(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                csucursal: sessionStorage.getItem("cNombreSucursal"),
                canio: '',
                cmes: '',
                nidcronograma: 0,
                // ============================================
                // ============ BUSCAR FLETE =================
                fillFlete:{
                    nidflete: 0,
                    dfechainicio: '',
                    dfechafin: '',
                    cnumerofactura: '',
                    cnumerovin: '',
                    nidmarca: '',
                    nidmodelo: ''
                },
                formmFlete:{
                    cnumeroruc: '',
                    cseriecomprobante: '',
                    cnumerocomprobante: ''
                },
                fillCompra:{
                    dfechainicio: '',
                    dfechafin: '',
                    nordencompra: '',
                    cnumerofactura: '',
                    cnumerovin: '',
                    nidmarca: '',
                    nidmodelo: ''
                },
                // ============================================================
                // =========== TAB ASIGNAR FLETE ============
                arrayMarca: [],
                arrayModelo: [],
                arrayCompra: [],
                arrayFlete: [],
                arrayTempFlete: [],
                arrayIndexFleteMonto: [],
                arrayFleteDetalle: [],
                // ==========================================================
                // =============  BUSCAR PROVEEDORES ========================
                fillProveedor:{
                    cnombreproveedor: ''
                },
                arrayProveedor: [],
                // =============  VARIBALES SAP ========================
                arrayTCFlete: [],
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
                mensajeError: []
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
            tabBuscarFlete(){
                this.limpiarFormulario();
                this.llenarComboMarca();
                this.llenarComboModelo();
            },
            listarFlete(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/flete/GetListFlete';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'dfechainicio': this.fillFlete.dfechainicio,
                        'dfechafin': this.fillFlete.dfechafin,
                        'page': page
                    }
                }).then(response => {
                    this.arrayFlete = response.data.arrayFlete.data;
                    this.pagination.current_page =  response.data.arrayFlete.current_page;
                    this.pagination.total = response.data.arrayFlete.total;
                    this.pagination.per_page    = response.data.arrayFlete.per_page;
                    this.pagination.last_page   = response.data.arrayFlete.last_page;
                    this.pagination.from        = response.data.arrayFlete.from;
                    this.pagination.to           = response.data.arrayFlete.to;
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
            cambiarPaginaFlete(page){
                this.pagination.current_page=page;
                this.listarFlete(page);
            },
            listarFleteDetalle(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/flete/GetListFleteDetalle';
                axios.get(url, {
                    params: {
                        'nidflete': this.fillFlete.nidflete,
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'cnumerovin': this.fillFlete.cnumerovin,
                        'nidmarca': this.fillFlete.nidmarca,
                        'nidmodelo': this.fillFlete.nidmodelo,
                        'page': page
                    }
                }).then(response => {
                    this.arrayFleteDetalle = response.data.arrayFleteDetalle.data;
                    this.paginationModal.current_page =  response.data.arrayFleteDetalle.current_page;
                    this.paginationModal.total = response.data.arrayFleteDetalle.total;
                    this.paginationModal.per_page    = response.data.arrayFleteDetalle.per_page;
                    this.paginationModal.last_page   = response.data.arrayFleteDetalle.last_page;
                    this.paginationModal.from        = response.data.arrayFleteDetalle.from;
                    this.paginationModal.to           = response.data.arrayFleteDetalle.to;
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
            cambiarPaginaFleteDetalle(){
                this.paginationModal.current_page=page;
                this.listarFleteDetalle(page);
            },
            // ====================================================
            // =============  TAB ASIGNAR FLETE ======================
            tabGeneraFlete(){
                this.arrayLineaCredito = [];
                this.fillFlete.nidmarca = '';
                this.fillFlete.nidmodelo = '';
            },
            listarCompras(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/flete/GetComprasForFlete';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'dfechainicio': this.fillCompra.dfechainicio,
                        'dfechafin': this.fillCompra.dfechafin,
                        'nordencompra': this.fillCompra.nordencompra == '' ? 0 : this.fillCompra.nordencompra,
                        'cnumerovin': this.fillCompra.cnumerovin,
                        'nidmarca': this.fillCompra.nidmarca,
                        'nidmodelo': this.fillCompra.nidmodelo,
                        'page': page
                    }
                }).then(response => {
                    this.arrayCompra = response.data.arrayCompra.data;
                    this.paginationModal.current_page =  response.data.arrayCompra.current_page;
                    this.paginationModal.total = response.data.arrayCompra.total;
                    this.paginationModal.per_page    = response.data.arrayCompra.per_page;
                    this.paginationModal.last_page   = response.data.arrayCompra.last_page;
                    this.paginationModal.from        = response.data.arrayCompra.from;
                    this.paginationModal.to           = response.data.arrayCompra.to;
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
                this.paginationModal.current_page=page;
                this.listarCompras(page);
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
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            llenarComboModelo(){
                var url = this.ruta + '/versionvehiculo/GetModeloByMarca';

                axios.get(url,{
                    params: {
                        'nidmarca' : this.accionmodal==3 ? this.fillCompra.nidmarca : this.fillFlete.nidmarca,
                        'opcion': 1
                    }
                }).then(response => {
                    this.arrayModelo = response.data.arrayModelo;
                    this.fillFlete.nidmodelo = '';
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
            asignarComprasFlete(compra){
                let me = this;

                if(me.encontrarCompraFlete(compra.nIdCompra)){
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'La compra ya se encuentra agregada!',
                    })
                } else {
                    me.arrayTempFlete.push(compra);
                    toastr.success('Se Agregó "'+ compra.cNumeroVin +'" ');
                }
            },
            encontrarCompraFlete(nIdCompra){
                var sw=0;
                this.arrayTempFlete.map(function (x) {
                    if(x.nIdCompra == nIdCompra){
                        sw = true;
                    }
                });
                return sw;
            },
            removerCompraFlete(index){
                this.$delete(this.arrayTempFlete, index);
            },
            registrarFlete(){
                let me = this;

                if(me.validarRegistroFlete()){
                    me.accionmodal=1;
                    me.modal = 1;
                    return;
                }

                me.mostrarProgressBar();

                me.arrayFlete = [];

                me.arrayTempFlete.map(function(value, key){
                    if(me.arrayIndexFleteMonto[key] > 0){
                        me.arrayFlete.push({
                            'nIdCompra': value.nIdCompra,
                            'cNumeroVin': value.cNumeroVin,
                            'nIdMoneda': 1300027,
                            'fImporteFlete': me.arrayIndexFleteMonto[key]
                        });
                    }
                });

                var url = this.ruta + '/flete/SetFlete';
                axios.post(url, {
                    'nIdEmpresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                    'nIdSucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                    'cNumeroRuc': this.formmFlete.cnumeroruc,
                    'cTipoComprobante': 'F',
                    'cSerieComprobante': this.formmFlete.cseriecomprobante,
                    'cNumeroComprobante': this.formmFlete.cnumerocomprobante,
                    'data': this.arrayFlete
                }).then(response => {
                    this.obtenerFleteTblCosto();
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
            validarRegistroFlete(){
                this.error = 0;
                this.mensajeError =[];

                if(this.arrayTempFlete == []){
                    this.mensajeError.push('No hay Datos a Registrar');
                };
                if(!this.formmFlete.cnumeroruc || this.formmFlete.cnumeroruc.length != 11){
                    this.mensajeError.push('El Ruc debe contener 11 dígitos');
                };
                if(!this.formmFlete.cseriecomprobante){
                    this.mensajeError.push('Debe Ingresar Serie Comprobante');
                };
                if(!this.formmFlete.cnumerocomprobante){
                    this.mensajeError.push('Debe Ingresar Nro Comprobante');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            obtenerFleteTblCosto(){
                let me = this;

                var url = me.ruta + '/tablacosto/GetCompraFleteTblCosto';
                axios.post(url, {
                        'nIdEmpresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nIdSucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'data': me.arrayFlete
                }).then(response => {
                    me.arrayTCFlete = [];
                    // ====================== CONCEPTO =========================
                    // ======================== FLETE ==========================
                    let arrayFlete = response.data.array_infoFlete;
                    arrayFlete.map(function (x) {
                        me.arrayTCFlete.push({
                            U_SYP_VIN           :   x.U_SYP_VIN,
                            DocEntry            :   x.DocEntry,
                            U_SYP_CCONCEPTO     :   x.U_SYP_CCONCEPTO,
                            U_SYP_DCONCEPTO     :   x.U_SYP_DCONCEPTO,
                            U_SYP_CDOCUMENTO    :   x.U_SYP_CDOCUMENTO,
                            U_SYP_DDOCUMENTO    :   x.U_SYP_DDOCUMENTO,
                            U_SYP_IMPORTE       :   x.U_SYP_IMPORTE,
                            U_SYP_COSTO         :   x.U_SYP_COSTO,
                            U_SYP_ESTADO        :   x.U_SYP_ESTADO
                        });
                    });

                    setTimeout(function() {
                        me.registroSapBusinessTblCostoFlete();
                    }, 1600);
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
            registroSapBusinessTblCostoFlete(){
                let me = this;

                me.loadingProgressBar("INTEGRANDO FLETE CON SAP BUSINESS ONE...");

                var url = me.ruta + '/tablacosto/SapPachTablaCosto';
                axios.post(url, {
                    'data'  : me.arrayTCFlete
                }).then(response => {
                    me.loading.close();
                    $("#myBar").hide();
                    swal('Flete registrado exitosamente');
                    me.limpiarFormulario();
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
                this.modal = 0,
                this.error = 0,
                this.mensajeError = '',
                this.accionmodal = 0
            },
            abrirModal(modelo, accion, data){
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
                    case 'compra':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=3;
                                this.modal = 1;
                                this.llenarComboMarca();
                                this.llenarComboModelo();
                                this.arrayCompra = [];
                                break;
                            }
                        }
                    }break;
                    case 'detalle':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=4;
                                this.modal = 1;
                                this.fillFlete.nidflete = data.nIdFlete;
                                this.listarFleteDetalle(1);
                                break;
                            }
                        }
                    }break;
                }
            },
            // ===========================================================
            limpiarFormulario(){
                this.fillFlete.nidmarca = '';
                this.fillFlete.nidmodelo = '';
                this.fillFlete.dfechainicio = '';
                this.fillFlete.dfechafin = '';
                this.arrayFlete = [];
                this.arrayTempFlete = [];
                this.arrayIndexFleteMonto = [];
                this.formmFlete.cnumeroruc = '';
                this.formmFlete.cseriecomprobante = '';
                this.formmFlete.cnumerocomprobante = '';
                this.arrayTCFlete = [];
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
            },
            loadingProgressBar(texto){
                this.loading = this.$loading({
                    lock: true,
                    text: texto,
                    spinner: 'fa-spin fa-md fa fa-cube',
                    background: 'rgba(0, 0, 0, 0.7)'
                });
            }
        },
        mounted(){
            this.llenarComboMarca();
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
