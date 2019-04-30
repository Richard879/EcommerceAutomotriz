<template>
     <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <vs-divider color="dark">
                        <h2 class="no-margin-bottom">MODULO COMPRA</h2>
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
                                        <a class="nav-link active" href="#TabBuscaCompra" @click="tabBuscarCompra()" role="tab" data-toggle="tab">
                                            <i class="fa fa-search"></i> BUSCAR PROYECTO
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#TabGeneraCompra" @click="tabGenerarCompra()" role="tab" data-toggle="tab">
                                            <i class="fa fa-bus"></i> GENERAR PROYECTO
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane fade in active show" id="TabBuscaCompra">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">BUSCAR COMPRA</h3>
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
                                                                            <label class="col-sm-4 form-control-label">* Fecha Fin</label>
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
                                                                                <input type="text" v-model="fillCompra.nordencompra" @keyup.enter="listarCompras(1)" class="form-control form-control-sm">
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
                                                                                <el-select v-model="fillCompra.nidmarca" filterable clearable placeholder="SELECCIONE" @change="llenarComboModelo()">
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
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarCompras(1)">
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
                                                            <template v-if="arrayCompra.length">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Acciones</th>
                                                                                <th>NroDoc SAP</th>
                                                                                <th>Código</th>
                                                                                <th>Periodo</th>
                                                                                <th>Nota Pedido</th>
                                                                                <th>Línea</th>
                                                                                <th>Almacén<nav></nav></th>
                                                                                <th>Disponible</th>
                                                                                <th>Nro Vin</th>
                                                                                <th>Forma Pago</th>
                                                                                <th>Nombre Comercial</th>
                                                                                <th>Año Fab</th>
                                                                                <th>Año Mod</th>
                                                                                <th>Moneda</th>
                                                                                <th>Total</th>
                                                                                <th>Nro Factura</th>
                                                                                <th>Fecha Facturado</th>
                                                                                <th>Fecha Compra</th>
                                                                                <th>DocEntry</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="compra in arrayCompra" :key="compra.nIdCompra"
                                                                                    :style="{ background : compra.cFlagColor }">
                                                                                <td>
                                                                                    <template v-if="compra.cSituacionRegistro=='A'">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Desactivar Compra {{ compra.cNumeroVin }}</div>
                                                                                            <i @click="desactivar(compra)" :style="'color:#796AEE'" class="fa-md fa fa-check-square"></i>
                                                                                        </el-tooltip>&nbsp;&nbsp;
                                                                                    </template>
                                                                                    <template v-else>
                                                                                        <el-tooltip class="item" :content="'Activar ' + compra.cNumeroVin" effect="dark" placement="top-start">
                                                                                            <i @click="activar(compra)" :style="'color:red'" class="fa-md fa fa-square"></i>
                                                                                        </el-tooltip>&nbsp;&nbsp;
                                                                                    </template>
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Editar Compra  {{ compra.cNumeroVin }}</div>
                                                                                        <i @click="abrirModal('compra','editar', compra)" :style="'color:#796AEE'" class="fa-md fa fa-edit"></i>
                                                                                    </el-tooltip>&nbsp;&nbsp;<!---->
                                                                                    <template v-if="compra.nValidaIntegracion==0">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">{{ compra.cFlagVistaIntegracion + ' ' + compra.cNumeroVin }}</div>
                                                                                            <i @click="validarSapArticulo(compra)" :style="'color:green'" class="fa-spin fa-md fa fa-cube"></i>
                                                                                        </el-tooltip>&nbsp;&nbsp;
                                                                                    </template>
                                                                                </td>
                                                                                <td v-text="compra.nDocNum"></td>
                                                                                <td v-text="compra.nIdCompra"></td>
                                                                                <td v-text="compra.cNumeroMes + '-' + compra.cAnio"></td>
                                                                                <td v-text="compra.nNumeroReserva"></td>
                                                                                <td v-text="compra.cNombreLinea"></td>
                                                                                <td v-text="compra.cNombreAlmacen"></td>
                                                                                <td v-text="compra.cFlagVehiculoLibre"></td>
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
                                                                                <td v-text="compra.nDocEntry"></td>
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
                                    <div role="tabpanel" class="tab-pane fade" id="TabGeneraCompra">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">GENERAR COMPRA</h3>
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
                                                                            <label class="col-sm-4 form-control-label">* Almacén</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="text" v-model="formAlmacen.cwhsname" class="form-control form-control-sm" readonly>
                                                                                    <div class="input-group-prepend">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Buscar Almacén </div>
                                                                                            <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('almacen','buscar')">
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
                                                                            <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="text" v-model="formCompra.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
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
                                                                        <div class="row" v-if="formCompra.nidproveedor>0">
                                                                            <label class="col-sm-4 form-control-label">* Tipo Lista</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="formCompra.nidtipolista"
                                                                                            filterable
                                                                                            clearable
                                                                                            placeholder="SELECCIONE"
                                                                                            @change="obtenerListaPrecioActiva()">
                                                                                    <el-option
                                                                                        v-for="item in arrayTipoLista"
                                                                                        :key="item.nIdPar"
                                                                                        :label="item.cParNombre"
                                                                                        :value="item.nIdPar">
                                                                                    </el-option>
                                                                                </el-select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row" v-if="formCompra.nidtipolista">
                                                                            <label class="col-sm-4 form-control-label">* Nro Lista</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="text" v-model="formCompra.nnumerolista" class="form-control form-control-sm" readonly>
                                                                                    <div class="input-group-prepend">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Buscar Lista </div>
                                                                                            <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('lista','buscar')">
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
                                                                                <a href="#" @click="descargaFormatoCompra">
                                                                                    <i class="fa-md fa fa-file-excel-o"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-8">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Ordenes de Compra</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="file" id="file-upload" @change="getFile" accept=".xls,.xlsx" class="form-control form-control-sm"/>
                                                                                <!--<label for="file-upload" class="btn btn-warning btn-corner btn-sm">
                                                                                    <i class="fa fa-file-excel-o"></i> Seleccionar Archivo
                                                                                </label>-->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="row">
                                                                            <!--<input type="text" v-model="textFile" class="col-sm-6 form-control form-control-sm" readonly>
                                                                            <div class="col-sm-6">-->
                                                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="importFileCompra()">
                                                                                    <i class="fa fa-retweet"></i> Procesar
                                                                                </button>
                                                                            <!--</div>-->
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
                                                                                    <th>Nro Reserva</th>
                                                                                    <th>Nro Vin</th>
                                                                                    <th>Forma Pago</th>
                                                                                    <th>Marca</th>
                                                                                    <th>Modelo</th>
                                                                                    <th>Nombre Comercial</th>
                                                                                    <th>Color</th>
                                                                                    <th>Año Fab</th>
                                                                                    <th>Año Mod</th>
                                                                                    <th>Mon</th>
                                                                                    <th>Total</th>
                                                                                    <th>Serie Comprobante</th>
                                                                                    <th>Nro Comprobante</th>
                                                                                    <th>Fecha Facturado</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="(compra, index) in arrayExcel" :key="compra.nNumeroReserva">
                                                                                    <td>
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Eliminar Compra  {{ compra.nNumeroReserva }}</div>
                                                                                            <i @click="eliminarItemExcel(index)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                        </el-tooltip>
                                                                                    </td>
                                                                                    <td v-text="compra.cNombreLinea"></td>
                                                                                    <td v-text="compra.cNombreAlmacen"></td>
                                                                                    <td v-text="compra.nNumeroReserva"></td>
                                                                                    <td v-text="compra.cNumeroVin"></td>
                                                                                    <td v-text="compra.cFormaPago"></td>
                                                                                    <td v-text="compra.cNombreMarca"></td>
                                                                                    <td v-text="compra.cNombreModelo"></td>
                                                                                    <td v-text="compra.cNombreComercial"></td>
                                                                                    <td v-text="compra.cNombreColor"></td>
                                                                                    <td v-text="compra.nAnioFabricacion"></td>
                                                                                    <td v-text="compra.nAnioVersion"></td>
                                                                                    <td v-text="compra.cSimboloMoneda"></td>
                                                                                    <td v-text="compra.fTotalCompra"></td>
                                                                                    <td v-text="compra.cSerieComprobante"></td>
                                                                                    <td v-text="compra.cNumeroComprobante"></td>
                                                                                    <td v-text="compra.dFechaFacturado"></td>
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
                nservicecallid: 0,
                nactivitycode: 0,
                fTotalValor: 0,
                nIdWarrantOperativo: 0,
                // ============================================
                // ============ BUSCAR COMPRA =================
                fillCompra:{
                    dfechainicio: '',
                    dfechafin: '',
                    nordencompra: '',
                    cnumerovin: '',
                    nidmarca: '',
                    nidmodelo: ''
                },
                arrayCompra: [],
                arrayCompraRpta: [],
                arrayMarca: [],
                arrayModelo: [],
                // ===============================================
                // ============ REGISTRAR COMPRA =================
                formCompra:{
                    nformapago: 0,
                    nidtipolista: '',
                    nidproveedor: 0,
                    cproveedornombre: '',
                    nnumerolista: '',
                    nidlistaprecio: 0,
                    ccarcode: '',
                    igv: 0
                },
                arrayExcel: [],
                contadorArrayExcel: 0,
                arrayTipoLista: [],
                arrayListaPrecio: [],
                //===========================================================
                // =============  VARIABLES ALMACEN ========================
                formAlmacen:{
                    nidlocalidad: 0,
                    cwhscode: '',
                    cwhsname: ''
                },
                arrayAlmacen: [],
                // ==========================================================
                // ============ VARIABLES MODAL ACTUALIZAR COMPRA =================
                formModalCompra:{
                    ndocentry: '',
                    ccardcode: '',
                    nidcompra: 0,
                    nordencompra: '',
                    cnombrecomercial:'',
                    cnumerovin:'',
                    cnumeromotor: '',
                    cnumerodua: '',
                    cnombrecolor: '',
                    cseriecomprobante: '',
                    cnumerocomprobante: '',
                    codigonacionesunidas: ''
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
                // ==========================================================
                // =============  BUSCAR PROVEEDORES ========================
                fillProveedor:{
                    cnombreproveedor: ''
                },
                arrayProveedor: [],
                //===========================================================
                // =============  VARIABLES SAP ========================
                arraySapArticulo: [],
                arraySapItemCode: [],
                arraySapRespuesta: [],
                jsonRespuesta: '',
                arraySapUpdSgc: [],
                arraySapProyecto: [],
                arraySapTarjetaEquipo: [],
                arraySapLlamadaServicio: [],
                arraySapCompra: [],
                arraySapActividad: [],
                arraySapSolucion: [],
                arraySapAsiento: [],
                nSolutionCode:  0,
                //Tbls Costo
                arrayTCTipoBeneficio: [],
                arrayTCCostoVehiculo: [],
                arraySapCosto: [],
                // ============================================================
                page: 1,
                perPage: 10,
                pages:[],
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
                textFile: '',
                loading: false
            }
        },
        mounted(){
            this.llenarComboMarca();
            this.llenarComboModelo();
            this.obtenerAlmacenPorDefecto();
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
            },
            totalVehiculo: function(){
                let me = this;
                if(me.arrayWOperativo.length > 0) {
                    return me.arrayWOperativo.reduce(function(valorAnterior, valorActual){
                        return valorAnterior + parseFloat(valorActual.fTotalCompra);
                    }, 0);
                } else {
                    return 0;
                }
            },
        },
        methods:{
            tabBuscarCompra(){
                this.fillCompra.nidmarca = '';
                this.fillCompra.nidmodelo = '';
                this.fillCompra.dfechainicio = '';
                this.fillCompra.dfechafin = '';
                this.limpiarFormulario();
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
                        'nidmarca' : this.fillCompra.nidmarca,
                        'opcion': 1
                    }
                }).then(response => {
                    this.arrayModelo = response.data.arrayModelo;
                    this.fillCompra.nidmodelo = '';
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
            listarCompras(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/compra/GetCompra';
                axios.get(url, {
                    params: {
                        'nidempresa'    : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'   : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'dfechainicio'  : this.fillCompra.dfechainicio,
                        'dfechafin'     : this.fillCompra.dfechafin,
                        'nordencompra'  : this.fillCompra.nordencompra == '' ? 0 : this.fillCompra.nordencompra,
                        'cnumerovin'    : this.fillCompra.cnumerovin,
                        'nidmarca'      : this.fillCompra.nidmarca,
                        'nidmodelo'     : this.fillCompra.nidmodelo,
                        'page'          : page
                    }
                }).then(response => {
                    this.arrayCompraRpta = response.data.arrayCompra;
                    this.paginateCompra(this.arrayCompraRpta, page);
                    /*this.pagination.current_page =  response.data.arrayCompra.current_page;
                    this.pagination.total = response.data.arrayCompra.total;
                    this.pagination.per_page    = response.data.arrayCompra.per_page;
                    this.pagination.last_page   = response.data.arrayCompra.last_page;
                    this.pagination.from        = response.data.arrayCompra.from;
                    this.pagination.to           = response.data.arrayCompra.to;*/
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
            paginateCompra(data, page){
                this.pagination.current_page= page;
                this.pagination.total       = data.length;
                this.pagination.per_page    = this.perPage;
                this.pagination.last_page   = Math.ceil(data.length / this.pagination.per_page);
                this.pagination.from        = (this.pagination.current_page * this.pagination.per_page) - this.pagination.per_page;
                this.pagination.to          = (this.pagination.current_page * this.pagination.per_page);
                this.arrayCompra            = data.slice(this.pagination.from, this.pagination.to);
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.paginateCompra(this.arrayCompraRpta, page);
            },
            // ====================================================
            // =============  GENERAR COMPRA ======================
            tabGenerarCompra(){
                this.obtenerCronogramaCompraActivo();
                this.listarTipoLista();
                this.limpiarFormulario();
            },
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
            asignarProveedor(proveedor){
                this.formCompra.nidproveedor = proveedor.nIdPar;
                this.formCompra.cproveedornombre = proveedor.cParNombre;
                this.formCompra.ccarcode = proveedor.cParJerarquia;
                this.cerrarModal();
            },
            listarTipoLista(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';

                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110044
                    }
                }).then(response => {
                    this.arrayTipoLista = response.data;
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
            obtenerListaPrecioActiva(){
                var url = this.ruta + '/compra/GetListaPrecioByProveedor';

                axios.get(url, {
                    params: {
                        'nidproveedor': parseInt(this.formCompra.nidproveedor),
                        'nidtipolista' : parseInt(this.formCompra.nidtipolista),
                        'nidentificador': 0,
                        'opcion' : 1
                    }
                }).then(response => {
                    this.formCompra.nidlistaprecio = (!response.data.arrayListaPrecio.length) ? '' : response.data.arrayListaPrecio[0].nIdListaPrecioVersionVeh;
                    this.formCompra.nnumerolista = (!response.data.arrayListaPrecio.length) ? '' : response.data.arrayListaPrecio[0].nNroListaPrecio;
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
            listarListaPrecioVersionVeh(page){
                var url = this.ruta + '/compra/GetListaPrecioByProveedor';

                axios.get(url, {
                    params: {
                        'nidproveedor': parseInt(this.formCompra.nidproveedor),
                        'nidtipolista' : parseInt(this.formCompra.nidtipolista),
                        'nidentificador': 1,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayListaPrecio = response.data.arrayListaPrecio.data;
                    this.paginationModal.current_page =  response.data.arrayListaPrecio.current_page;
                    this.paginationModal.total = response.data.arrayListaPrecio.total;
                    this.paginationModal.per_page    = response.data.arrayListaPrecio.per_page;
                    this.paginationModal.last_page   = response.data.arrayListaPrecio.last_page;
                    this.paginationModal.from        = response.data.arrayListaPrecio.from;
                    this.paginationModal.to           = response.data.arrayListaPrecio.to;
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
            cambiarPaginaListaPrecio(page){
                this.paginationModal.current_page=page;
                this.listarListaPrecioVersionVeh(page);
            },
            asignarListaPrecio(lista){
                this.formCompra.nidlistaprecio = lista.nIdListaPrecioVersionVeh;
                this.formCompra.nnumerolista = lista.nNroListaPrecio;
                this.cerrarModal();
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
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            obtenerAlmacenPorDefecto(){
                var url = this.ruta + '/almacen/GetAlmacenPorDefecto';
                axios.get(url, {
                    params: {
                        'nidsucursal'   : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'cflagtipo'     : 'VE'
                    }
                }).then(response => {
                    if(response.data.length){
                        this.formAlmacen.cwhscode = response.data[0].cWhsCode;
                        this.formAlmacen.cwhsname = response.data[0].cWhsName;
                    }
                    else{
                        this.formAlmacen.cwhscode = '';
                        this.formAlmacen.cwhsname = 'Sin Almacén Definido';
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
            //=================== Proceso Carga de Formato Compra Excel
            getFile(e){
                //console.log(e);
                let selectFile = e.target.files[0];
                this.attachment = selectFile;
                this.arrayExcel = [];
                //this.textFile = e.target.files[0].name;
            },
            importFileCompra(){
                if(this.validarReadFileCompra()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.form.append('file', this.attachment);
                const config = { headers: { 'Content-Type': 'multipart/form-data'  } };
                //var fd = new FormData();
                //fd.append('file', this.fileExcel, this.fileExcel.name);
                var url = this.ruta + '/compra/importFileCompra';
                axios.post(url, this.form, config).then(response=>{
                    this.readFileCompra(response.data);
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
            readFileCompra(nameFile){
                // console.log(nameFile);
                this.mostrarProgressBar();

                var url = this.ruta + '/compra/readFileCompra';
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
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
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

                me.arrayExcel.map(function(value, key) {
                    if(key==0){
                        if(value.cNombreLinea != "Línea"){
                            me.mensajeError.push('Falta celda Línea, verifique el archivo.');
                        };
                        if(value.cNombreAlmacen != "Almacén"){
                            me.mensajeError.push('Falta celda Almacén, verifique el archivo.');
                        };
                        if(value.nNumeroReserva != "Nro Reserva"){
                            me.mensajeError.push('Falta celda Nro Reserva, verifique el archivo.');
                        };
                        if(value.fTotalCompra != "Total"){
                            me.mensajeError.push('Falta celda Total, verifique el archivo.');
                        };
                    };
                    /*if(key != 0){
                        if(!/^([0-9])*[.]?[0-9]*$/.test(value.fTotalCompra)){
                            list.push('Existe un error en el campo Total, verifique el archivo.');
                        }
                    };*/
                });

                if(me.mensajeError.length){
                    me.error = 1;
                }
                return me.error;
            },
            eliminarItemExcel(index){
                this.$delete(this.arrayExcel, index);
                this.contadorArrayExcel = this.arrayExcel.length;
            },
            //====================================================================
            //======================  Registrar Excel Compra =====================
            registrar(){
                if(this.validarRegistro()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.mostrarProgressBar();

                var url = this.ruta + '/compra/SetCompra';
                axios.post(url, {
                    'nIdEmpresa'      : parseInt(sessionStorage.getItem("nIdEmpresa")),
                    'data'            : this.arrayExcel
                }).then(response => {
                    let me = this;

                    me.arrayTempVinExiste = [];
                    me.arrayTempVinListaPrecio = [];
                    me.arrayTempVinNombreComercial = [];

                    me.arrayCompraExisteVin = [];
                    me.arrayCompraPrecioLista = [];
                    me.arrayCompraNombreComercial = [];

                    //ARRAY PARA DEPURAR
                    me.arrayVinDepura = [];

                    //Si el VIN existe
                    if(response.data.arrayVinExiste.length)
                    {
                        me.arrayTempVinExiste = response.data.arrayVinExiste;
                        me.arrayTempVinExiste.map(function(value, key) {
                            me.arrayCompraExisteVin.push({
                                cNumeroVin: me.arrayTempVinExiste[key]
                            });
                            me.arrayVinDepura.push(me.arrayTempVinExiste[key]);
                        });
                    }

                    //==============================================================
                    //================== REGITRO DE ARTICULO EN SAP ===============
                    //Depurar Array para registrar en SAP
                    me.arrayExcel.map(function(x, y){
                        //comprobar si un determinado elemento no existe dentro de un array
                        if (!me.arrayVinDepura.includes(x.cNumeroVin)) {
                            // console.log("VIN depurados: " + x.cNumeroVin);
                            me.arraySapArticulo.push(x);
                        }
                    });

                    // console.log("N° articulos a registrar" + me.arraySapArticulo.length);
                    //Si existen compras para registrar (QUE NO EXISTAN VIN; QUE SEAN IGUALES A LA COMPRA; QUE ESTEN REGISTRADOS NOMBRE COMERCIAL)
                    if(me.arraySapArticulo.length){
                        me.registroSapBusinessProyecto();
                    }
                    else{
                        me.loadingProgressBar("OCURRIO UN PROBLEMA...");
                        me.verResultados();
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
            registroSapBusinessProyecto(){
                let me = this;
                //Depurar Array para registrar en SAP
                me.arraySapArticulo.map(function(x, y){
                    //Si el VIN del arraySapArticulo se encuentra en arraySapItemCode => guardar en Proyecto
                    //Sino se encuentra no pase a Proyecto
                    if (me.arraySapItemCode.includes(x.cNumeroVin)) {
                        me.arraySapProyecto.push({
                            'cCode': x.cNumeroVin,
                            'cName': x.cNumeroVin
                        });
                    }
                });

                var sapUrl = me.ruta + '/proyecto/SapSetProyecto';
                axios.post(sapUrl, {
                    'data': me.arraySapProyecto
                }).then(response => {
                    me.arraySapRespuesta = [];
                    me.arraySapItemCode = [];
                    me.arraySapUpdSgc = [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(value, key){
                        me.jsonRespuesta = '';
                        me.jsonRespuesta= JSON.parse(value);
                        //Si el valor de respuesta Code tiene un valor
                        if(me.jsonRespuesta.Code){
                            me.arraySapItemCode.push(me.jsonRespuesta.Code); //PARA DEPURAR

                            me.arraySapUpdSgc.push({
                                'cCode'         : me.jsonRespuesta.Code.toString(),
                                'cName'         : me.jsonRespuesta.Name.toString(),
                                'cLogRespuesta' : me.arraySapRespuesta[key].toString()
                            });
                        }
                    });
                    //===========================================================================
                    //================== ACTUALIZO TABLA INTEGRACION PROYECTO SGC ===============
                    setTimeout(function() {
                        me.registroSgcProyecto();
                    }, 1000);
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
            registroSgcProyecto(){
                let me = this;
                var sapUrl = me.ruta + '/proyecto/SetIntegraProyecto';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    //===================================================================
                    //================== REGITRO DE TARJETA EQUIPO EN SAP ===============
                    setTimeout(function() {
                        me.registroSapBusinessTarjetaEquipo();
                    }, 1000);
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
            verResultados(){
                let me = this;
                me.attachment = [];
                me.confirmaCompra();
                //============= RESULTADO PARA MOSTRAR ================
                if(me.arrayCompraExisteVin.length || me.arrayCompraPrecioLista.length || me.arrayCompraNombreComercial.length){
                    me.accionmodal=3;
                    me.modal = 1;
                    me.attachment = [];
                }else{
                    swal('Compra registrada correctamente');
                }
            },
            validarRegistro(){
                this.error = 0;
                this.mensajeError =[];

                if(this.arrayExcel == []){
                    this.mensajeError.push('No hay Datos a Registrar');
                };
                if(this.formCompra.nidproveedor == 0){
                    this.mensajeError.push('Debes seleccionar un Proveedor');
                };
                if(this.formCompra.nidtipolista == 0 || !this.formCompra.nidtipolista){
                    this.mensajeError.push('Debes seleccionar un Tipo Lista');
                };
                if(this.formCompra.nidlistaprecio == 0){
                    this.mensajeError.push('Debes seleccionar una Lista');
                };
                if(this.formCompra.ccarcode == '' || !this.formCompra.ccarcode)
                {
                    this.mensajeError.push('El Proveedor no tiene codigo Sap');
                };
                if(this.nidcronograma == 0){
                    this.mensajeError.push('No existe Periodo Compra Activo');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            validarReadFileCompra(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.attachment || this.attachment==[] || this.attachment==''){
                    this.mensajeError.push('No hay Archivos Seleccionados');
                }
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            descargaFormatoCompra(){
                window.open(this.ruta + '/storage/FormatosDescarga/FormatoCompraExcel.xlsx');
            },
            //==========================================================
            //=================== REGISTRO SAP INDIVIDUAL ==============
            validarSapArticulo(objCompra){
                this.mostrarProgressBar();

                let me = this;

                me.arraySapCompra.push({
                    'cNumeroVin'        : objCompra.cNumeroVin
                });

                //Verifico Si existe Artículo
                if(!objCompra.cNumeroVin){
                    //==============================================================
                    //================== REGISTRO ARTICULO EN SAP ===============
                    me.generarSapProyecto(objCompra);
                }
            },
            generarSapProyecto(objCompra){
                let me = this;
                //Verifico Si NO existe Proyecto De EXCEL
                if(!objCompra.cCode){
                    //==============================================================
                    //================== REGISTRO PROYECTO EN SAP ===============
                    me.loadingProgressBar("INTEGRANDO PROYECTO CON SAP BUSINESS ONE...");

                    me.arraySapProyecto.push({
                        'cCode': objCompra.cNumeroVin,
                        'cName': objCompra.cName
                    });

                    var sapUrl = me.ruta + '/proyecto/SapSetProyecto';
                    axios.post(sapUrl, {
                        'data': me.arraySapProyecto
                    }).then(response => {
                        me.arraySapRespuesta= [];
                        me.arraySapUpdSgc= [];

                        me.arraySapRespuesta = response.data;
                        me.arraySapRespuesta.map(function(x){
                            me.jsonRespuesta = '';
                            me.jsonRespuesta= JSON.parse(x);
                            //Si el valor de respuesta Code tiene un valor
                            if(me.jsonRespuesta.Code){
                                me.arraySapUpdSgc.push({
                                    'cCode'         : me.jsonRespuesta.Code.toString(),
                                    'cName'         : me.jsonRespuesta.Name.toString(),
                                    'cLogRespuesta' : response.data.toString()
                                });

                                //==============================================================
                                //================== ACTUALIZO TABLA PROYECTO SGC ===============
                                setTimeout(function() {
                                    me.generaActualizaProyecto(objCompra);
                                }, 1200);
                            }
                        });
                    }).catch(error => {
                        me.limpiarPorError("Error en la Integración de Proyecto SapB1!");
                        console.log(error);
                        if (error.response) {
                            if (error.response.status == 401) {
                                swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                location.reload('0');
                            }
                        }
                    });
                }
                else{
                    //==============================================================
                    //================== REGISTRO TARJETA EQUIPO ===============
                    setTimeout(function() {
                        me.generarSapTarjetaEquipo(objCompra);
                    }, 800);
                }
            },
            generaActualizaProyecto(objCompra){
                let me = this;
                var sapUrl = me.ruta + '/proyecto/SetIntegraProyecto';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        me.confirmaCompra();
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
            confirmaCompra(){
                let me = this;
                $("#myBar").hide();
                me.loading.close();
                swal('Compra registrada correctamente');
                me.limpiarFormulario();
                me.listarCompras(1);
            },
            // ===========================================================
            limpiarFormulario(){
                this.fillCompra.nordencompra= '',
                this.fillCompra.cnumerovin=  '',
                this.formCompra.nidtipolista= '',
                this.formCompra.ccarcode= '',
                this.formCompra.nidproveedor = 0,
                this.formCompra.cproveedornombre = '',
                this.arrayExcel = [],
                this.attachment = [];
                this.form = new FormData,
                $("#file-upload").val("");

                //========= VARIABLES SAP =============
                //Limpiar variables Sap Articulo
                this.arraySapArticulo= [],
                this.arraySapItemCode= [],
                this.arraySapRespuesta= [],
                this.jsonRespuesta= '',
                this.arraySapUpdSgc= [],
                this.arraySapProyecto= [],
                this.arraySapTarjetaEquipo= [],
                this.arraySapLlamadaServicio= [],
                this.arraySapCompra= [],
                this.arraySapActividad= [],
                this.arraySapSolucion= [],
                //Tbls Costo
                this.arrayTCTipoBeneficio= [];
                this.arrayTCCostoVehiculo= [];
                this.arraySapCosto= [];
            },
            limpiarPaginacion(){
                this.pagination.current_page =  0,
                this.pagination.total = 0,
                this.pagination.per_page = 0,
                this.pagination.last_page = 0,
                this.pagination.from  = 0,
                this.pagination.to = 0
            },
            limpiarPorError(cDescripcion){
                $("#myBar").hide();
                swal({
                    type: 'error',
                    title: 'Error...',
                    text: cDescripcion,
                });
                this.loading.close();
                this.limpiarFormulario();
                this.listarCompras(1);
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
</style>