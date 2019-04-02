<template>
     <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">COMPRA</h2>
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
                                            <i class="fa fa-search"></i> BUSCAR COMPRA
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#TabGeneraCompra" @click="tabGenerarCompra()" role="tab" data-toggle="tab">
                                            <i class="fa fa-bus"></i> GENERAR COMPRA
                                        </a>
                                    </li>
                                    <!--<li class="nav-item">
                                        <a class="nav-link" href="#TabAsignaCaracter" @click="limpiarFormulario()" role="tab" data-toggle="tab">
                                            <i class="fa fa fa-clipboard"></i> ASIGNAR CARACTERÍSTICAS
                                        </a>
                                    </li>-->
                                    <li class="nav-item">
                                        <a class="nav-link" href="#TabLineaCredito" @click="tabLineaCredito()" role="tab" data-toggle="tab">
                                            <i class="fa fa-file-text-o"></i> LÍNEA DE CRÉDITO
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#TabForum" @click="tabForum()" role="tab" data-toggle="tab">
                                            <i class="fa fa fa-signal"></i> LÍNEA FORUM
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
                                                                                <input type="text" v-model="fillCompra.nordencompra" @keyup.enter="buscarCompras()" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Nro Vin</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillCompra.cnumerovin" @keyup.enter="buscarCompras()" class="form-control form-control-sm">
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
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarCompras();">
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
                                                                                <th>OC</th>
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
                                                                                <th>DocEntry Compra</th>
                                                                                <th>DocEntry Merc.</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="compra in arrayCompra" :key="compra.nIdCompra">
                                                                                <td>
                                                                                    <template v-if="compra.cSituacionRegistro=='A'">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Desactivar Compra {{ compra.nOrdenCompra }}</div>
                                                                                            <i @click="desactivar(compra)" :style="'color:#796AEE'" class="fa-md fa fa-check-square"></i>
                                                                                        </el-tooltip>&nbsp;&nbsp;
                                                                                    </template>
                                                                                    <template v-else>
                                                                                        <el-tooltip class="item" :content="'Activar ' + compra.nOrdenCompra" effect="dark" placement="top-start">
                                                                                            <i @click="activar(compra)" :style="'color:red'" class="fa-md fa fa-square"></i>
                                                                                        </el-tooltip>&nbsp;&nbsp;
                                                                                    </template>
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Editar Compra  {{ compra.nOrdenCompra }}</div>
                                                                                        <i @click="abrirModal('compra','editar', compra)" :style="'color:#796AEE'" class="fa-md fa fa-edit"></i>
                                                                                    </el-tooltip>&nbsp;&nbsp;<!---->
                                                                                    <template v-if="compra.nValidaIntegracion==0">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Registra Sap  {{ compra.cNumeroVin }}</div>
                                                                                            <i @click="validarSapArticulo(compra)" :style="'color:green'" class="fa-spin fa-md fa fa-cube"></i>
                                                                                        </el-tooltip>&nbsp;&nbsp;
                                                                                    </template>
                                                                                    <!--<template v-if="compra.nDocEntryMercanciaValida==0">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Registra Stock Sap  {{ compra.cNumeroVin }}</div>
                                                                                            <i @click="generaSapEntradaMercancia(compra)" :style="'color:green'" class="fa-spin fa-md fa fa-wpforms"></i>
                                                                                        </el-tooltip>&nbsp;&nbsp;
                                                                                    </template>-->
                                                                                </td>
                                                                                <td v-text="compra.nDocNum"></td>
                                                                                <td v-text="compra.nIdCompra"></td>
                                                                                <td v-text="compra.cNumeroMes + '-' + compra.cAnio"></td>
                                                                                <td v-text="compra.nOrdenCompra"></td>
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
                                                                                <td v-text="compra.nDocEntryMercancia"></td>
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
                                                                                    <th>OC</th>
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
                                                                                <tr v-for="(compra, index) in arrayExcel" :key="compra.nOrdenCompra">
                                                                                    <td>
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Eliminar O/C  {{ compra.nOrdenCompra }}</div>
                                                                                            <i @click="eliminarItemExcel(index)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                        </el-tooltip>
                                                                                    </td>
                                                                                    <td v-text="compra.nOrdenCompra"></td>
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
                                    <div role="tabpanel" class="tab-pane fade" id="TabAsignaCaracter">EN MANTENIMIENTO</div>


                                    <div role="tabpanel" class="tab-pane fade" id="TabLineaCredito">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">BUSCAR COMPRA SIN LINEA CREDITO</h3>
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
                                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('compra','lineacredito')">
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
                                                            <template v-if="arrayTempLineaCredito.length">
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
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="(compra, index) in arrayTempLineaCredito" :key="compra.nIdCompra">
                                                                                <td>
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Eliminar {{ compra.cNumeroVin }}</div>
                                                                                        <i @click="removerCompraLinea(index)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                    </el-tooltip>
                                                                                </td>
                                                                                <td v-text="compra.nIdCompra"></td>
                                                                                <td v-text="compra.cNumeroMes + '-' + compra.cAnio"></td>
                                                                                <td v-text="compra.nOrdenCompra"></td>
                                                                                <td v-text="compra.cNumeroVin"></td>
                                                                                <td v-text="compra.cNombreComercial"></td>
                                                                                <td v-text="compra.nAnioFabricacion"></td>
                                                                                <td v-text="compra.nAnioVersion"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-9 offset-sm-5">
                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarLineaCredito()">
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

                                    <div role="tabpanel" class="tab-pane fade" id="TabForum">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">GENERAR WARRANT OPERATIVO</h3>
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
                                                                            <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="formWOperativo.nidproveedor" filterable clearable placeholder="SELECCIONE" >
                                                                                    <el-option
                                                                                    v-for="item in arrayProveedorForum"
                                                                                    :key="item.nIdPar"
                                                                                    :label="item.cParNombre"
                                                                                    :value="item.nIdPar">
                                                                                    </el-option>
                                                                                </el-select>
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
                                                                                <a href="#" @click="descargaFormatoForum">
                                                                                    <i class="fa-md fa fa-file-excel-o"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-8">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Importar Forum</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="file" id="file-upload" @change="getFileForum" accept=".xls,.xlsx" class="form-control form-control-sm"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="row">
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="importFileForum()">
                                                                                <i class="fa fa-retweet"></i> Procesar
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <template v-if="arrayForum.length">
                                                                    <div class="table-responsive border" style="max-height: 300px; max-width:1200px; overflow-y: auto; overflow-x: auto;-ms-overflow-style: -ms-autohiding-scrollbar;">
                                                                        <table class="table table-striped table-sm">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Acciones</th>
                                                                                    <th>Modelo</th>
                                                                                    <th>VIN</th>
                                                                                    <th>Nro. Motor</th>
                                                                                    <th>Color</th>
                                                                                    <th>Moneda</th>
                                                                                    <th>Monto</th>
                                                                                    <th>Fecha</th>
                                                                                    <th>Valor Interés</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="(forum, index) in arrayForum" :key="forum.cNumeroVin">
                                                                                    <td>
                                                                                        <a href="#" @click="eliminarItemForum(index);" data-toggle="tooltip" data-placement="top" :title="'Eliminar ' +forum.cNumeroVin">
                                                                                        <i :style="'color:red'" class="fa-md fa fa-times-circle"></i></a>
                                                                                    </td>
                                                                                    <td v-text="forum.cNombreModelo"></td>
                                                                                    <td v-text="forum.cNumeroVin"></td>
                                                                                    <td v-text="forum.cNumeroMotor"></td>
                                                                                    <td v-text="forum.cNombreColor"></td>
                                                                                    <td v-text="forum.cMoneda"></td>
                                                                                    <td v-text="forum.fMonto"></td>
                                                                                    <td v-text="forum.dFecha"></td>
                                                                                    <td><input type="text" v-model="arrayValorInteres[index]" class="form-control form-control-sm"></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="row">
                                                                            <div class="col-sm-7">
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <div class="datatable-info">Total: {{ contadorArrayForum }} registros</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9 offset-sm-5">
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarForum()">
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
                                        <form @submit.prevent class="form-horizontal">
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
                                                                    <i @click="asignarProveedor(proveedor)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
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

            <!-- MODAL RESPUESTAS DE GENERAR COMPRA-->
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
                                            <h3 class="h4">ESTAS COMPRAS NO COINCIDEN CON LA LISTA DE PRECIOS</h3>
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

            <!--  MODAL EDITAR COMPRA -->
            <div class="modal fade" v-if="accionmodal==4" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4">EDITAR DATOS DE COMPRA</h3>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* O/C</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="formModalCompra.nordencompra" class="form-control form-control-sm" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Nombe Comercial</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="formModalCompra.cnombrecomercial" class="form-control form-control-sm" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Número VIN</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="formModalCompra.cnumerovin" class="form-control form-control-sm" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Número Motor</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="formModalCompra.cnumeromotor" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Número DUA</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="formModalCompra.cnumerodua" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Nombre Color</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="formModalCompra.cnombrecolor" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Serie Comprobante</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="formModalCompra.cseriecomprobante" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Numero Comprobante</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" v-model="formModalCompra.cnumerocomprobante" class="form-control form-control-sm">
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

            <!-- MODAL LINEA DE CREDITO -->
            <div class="modal fade" v-if="accionmodal==5" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTA DE COMPRAS NO LINEA CREDITO</h3>
                                    </div>
                                    <div class="card-body">
                                        <form @submit.prevent class="form-horizontal">
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
                                                            <input type="text" v-model="fillCompra.nordencompra" @keyup.enter="listarCompraNoLineaCredito(1)" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Nro Vin</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" v-model="fillCompra.cnumerovin" @keyup.enter="listarCompraNoLineaCredito(1)" class="form-control form-control-sm">
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
                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarCompraNoLineaCredito(1);"><i class="fa fa-search"></i> Buscar</button>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
                                        <template v-if="arrayLineaCredito.length">
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
                                                            <th>Fecha Compra</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="compra in arrayLineaCredito" :key="compra.nIdCompra">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar {{ compra.cNumeroVin }}</div>
                                                                    <i @click="asignarComprasLinea(compra)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
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
                                                                <li v-if="pagination.current_page > 1" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaLineaCredito(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                :class="[page==isActived?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaLineaCredito(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaLineaCredito(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL LSITA DE PRECIOS -->
            <div class="modal fade" v-if="accionmodal==6" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTA DE PRECIOS</h3>
                                    </div>
                                    <div class="card-body">
                                        <!--<form @submit.prevent class="form-horizontal">
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
                                        </form>-->
                                        <br/>
                                        <template v-if="arrayListaPrecio.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccione</th>
                                                            <th>Código Lista</th>
                                                            <th>Nombre Proveedor</th>
                                                            <th>Nro Lista</th>
                                                            <th>Periodo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="lista in arrayListaPrecio" :key="lista.nIdListaPrecioVersionVeh">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar {{ lista.nIdListaPrecioVersionVeh }}</div>
                                                                    <i @click="asignarListaPrecio(lista)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td>{{lista.nIdListaPrecioVersionVeh}}</td>
                                                            <td>{{lista.cNombreProveedor}}</td>
                                                            <td>{{lista.nNroListaPrecio}}</td>
                                                            <td>{{lista.cCronograma}}</td>
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
                                                                    <a @click.prevent="cambiarPaginaListaPrecio(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaListaPrecio(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaListaPrecio(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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

            <!-- MODAL ALMACENES -->
            <div class="modal fade" v-if="accionmodal==7" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTA DE ALMACENES</h3>
                                    </div>
                                    <div class="card-body">
                                        <template v-if="arrayAlmacen.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccione</th>
                                                            <th>Código Almacén</th>
                                                            <th>Nombre Almacén</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="almacen in arrayAlmacen" :key="almacen.cWhsCode">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar {{ almacen.cWhsName }}</div>
                                                                    <i @click="asignarAlmacen(almacen)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td>{{almacen.cWhsCode}}</td>
                                                            <td>{{almacen.cWhsName}}</td>
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
                                                                    <a @click.prevent="cambiarPaginaAlmacen(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaAlmacen(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaAlmacen(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                ccustomercode: 'C20480683839',
                canio: '',
                cmes: '',
                nidcronograma: 0,
                nservicecallid: 0,
                nactivitycode: 0,
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
                    nidcompra: 0,
                    cnombrecomercial:'',
                    cnumerovin:'',
                    cnumeromotor: '',
                    cnumerodua: '',
                    cnombrecolor: '',
                    cnumerodua: '',
                    nordencompra: '',
                    cseriecomprobante: '',
                    cnumerocomprobante: ''
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
                formWOperativo:{
                    nidproveedor: 0,
                    cproveedornombre: '',
                    cnrowarrant: '',
                    dfechainicio: '',
                    dfechafin: '',
                    ccarcode: ''
                },
                arrayProveedorForum: [],
                arrayForum: [],
                contadorArrayForum: 0,
                arrayValorInteres: [],
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
                //Tbls Costo
                arrayTCTipoBeneficio: [],
                arrayTCCostoVehiculo: [],
                arraySapCosto: [],
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
                textFile: '',
                loading: false
            }
        },
        mounted(){
            this.llenarComboMarca();
            this.llenarComboModelo();
            this.obtenerAlmacenPorDefecto();
            //this.obtenerIgv();
            this.obtenerCodigoSapEmpresa();
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
            tabBuscarCompra(){
                this.fillCompra.nidmarca = '';
                this.fillCompra.nidmodelo = '';
                this.fillCompra.dfechainicio = '';
                this.fillCompra.dfechafin = '';
                this.limpiarFormulario();
            },
            buscarCompras(){
                this.listarCompras(1);
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
                    this.pagination.current_page =  response.data.arrayCompra.current_page;
                    this.pagination.total = response.data.arrayCompra.total;
                    this.pagination.per_page    = response.data.arrayCompra.per_page;
                    this.pagination.last_page   = response.data.arrayCompra.last_page;
                    this.pagination.from        = response.data.arrayCompra.from;
                    this.pagination.to           = response.data.arrayCompra.to;
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
                this.listarCompras(page);
            },
            obtenerCodigoSapEmpresa(){
                this.ccustomercode = sessionStorage.getItem("cCustomerCode");
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
            /*obtenerIgv(){
                var url = this.ruta + '/tipoparametro/GetTipoByIdParametro';
                axios.get(url, {
                    params: {
                        'nidpar': 1300477,
                        'ctipoparametro': 'P',
                        'nidtipopar': 51
                    }
                }).then(response => {
                    this.formCompra.igv = response.data.arrayTipoParametro.data[0].fDatoParPorcentual;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },*/
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
                        if(value.nOrdenCompra != "OC"){
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
                    'nIdSucursal'     : parseInt(sessionStorage.getItem("nIdSucursal")),
                    'nIdCronograma'   : parseInt(this.nidcronograma),
                    'nIdProveedor'    : parseInt(this.formCompra.nidproveedor),
                    'nIdTipoLista'    : parseInt(this.formCompra.nidtipolista),
                    'nIdListaPrecioVeh': parseInt(this.formCompra.nidlistaprecio),
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
                    if(response.data.arrayPrecioLista.length){
                        me.arrayTempVinListaPrecio = response.data.arrayPrecioLista;
                        me.arrayTempVinListaPrecio.map(function(value, key) {
                            me.arrayCompraPrecioLista.push({
                                cNumeroVin: me.arrayTempVinListaPrecio[key]
                            });
                            me.arrayVinDepura.push(me.arrayTempVinListaPrecio[key]);
                        });
                    }
                    if(response.data.arrayNombreComercial.length){
                        me.arrayTempVinNombreComercial = response.data.arrayNombreComercial;
                        me.arrayTempVinNombreComercial.map(function(value, key) {
                            me.arrayCompraNombreComercial.push({
                                cNumeroVin: me.arrayTempVinNombreComercial[key]
                            });
                            me.arrayVinDepura.push(me.arrayTempVinNombreComercial[key]);
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
                        me.registroSapBusinessArticulo();
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
            registroSapBusinessArticulo(){
                let me = this;
                me.loadingProgressBar("INTEGRANDO ARTÍCULO CON SAP BUSINESS ONE...");
                var sapUrl = me.ruta + '/articulo/SapSetArticulo';
                axios.post(sapUrl, {
                    'data': me.arraySapArticulo
                }).then(response => {
                    me.arraySapRespuesta = [];
                    me.arraySapItemCode = [];
                    me.arraySapUpdSgc= [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(value, key){
                        me.jsonRespuesta = '';
                        me.jsonRespuesta= JSON.parse(value);
                        //==== Si devuelve Json ItemCode
                        if(me.jsonRespuesta.ItemCode){
                            me.arraySapItemCode.push(me.jsonRespuesta.ItemCode); //PARA DEPURAR
                            //PARA GUARDAR EN EL SGC LA INFO DE SAP
                            me.arraySapUpdSgc.push({
                                'cItemCode'     : me.jsonRespuesta.ItemCode.toString(),
                                'cLogRespuesta' : me.arraySapRespuesta[key].toString()
                            });
                        }
                    });
                    //===========================================================================
                    //================== ACTUALIZO TABLA INTEGRACION ARTICULO SGC ===============
                    setTimeout(function() {
                        me.registroSgcArticulo();
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
            registroSgcArticulo(){
                let me = this;
                var sapUrl = me.ruta + '/articulo/SetIntegraArticulo';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                   //==============================================================
                    //================== REGITRO DE PROYECTO EN SAP ===============
                    setTimeout(function() {
                        me.registroSapBusinessProyecto();
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
            /*generarSerieSap(){
                let me = this;
                var sapUrl = me.ruta + '/articulo/SapSetSerialNumber';
                axios.post(sapUrl, {
                    'data'  : arraySapArticulo
                }).then(response => {
                    setTimeout(function() {
                        me.registroSapBusinessProyecto();
                    }, 1600);
                }).catch(error => {
                    me.limpiarPorError("Error en la Integración Llamada Servicio SapB1!");
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },*/
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
            registroSapBusinessTarjetaEquipo(){
                let me = this;
                //Depurar Array para registrar en SAP
                me.arraySapArticulo.map(function(x, y){
                    //Si el VIN del arraySapArticulo se encuentra en arraySapItemCode => guardar en TarjetaEquipo
                    //Sino se encuentra no pase a TarjetaEquipo
                    if (me.arraySapItemCode.includes(x.cNumeroVin)) {
                        me.arraySapTarjetaEquipo.push({
                            'cCustomerCode'     : me.ccustomercode,
                            'cInternalSerialNum': x.cNumeroVin,
                            'cItemCode'         : x.cNumeroVin
                        });
                    }
                });

                var sapUrl = me.ruta + '/tarjetaequipo/SapSetTarjetaEquipo';
                axios.post(sapUrl, {
                    'data': me.arraySapTarjetaEquipo
                }).then(response => {
                    me.arraySapRespuesta = [];
                    me.arraySapItemCode = [];
                    me.arraySapUpdSgc = [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(value, key){
                        me.jsonRespuesta = '';
                        me.jsonRespuesta= JSON.parse(value);
                        //Si el valor de respuesta Code tiene un valor
                        if(me.jsonRespuesta.ItemCode){
                            me.arraySapItemCode.push(me.jsonRespuesta.ItemCode); //PARA DEPURAR

                            me.arraySapUpdSgc.push({
                                'nEquipmentCardNum' : parseInt(me.jsonRespuesta.EquipmentCardNum),
                                'cItemCode'         : me.jsonRespuesta.ItemCode.toString(),
                                'cInternalSerialNum': me.jsonRespuesta.InternalSerialNum.toString(),
                                'cLogRespuesta'     : me.arraySapRespuesta[key].toString()
                            });
                        }
                    });
                    //================================================================================
                    //================== ACTUALIZO TABLA INTEGRACION TRAJETA EQUIPO SGC ===============
                    setTimeout(function() {
                        me.registroSgcTarjetaEquipo();
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
            registroSgcTarjetaEquipo(){
                let me = this;
                var sapUrl = me.ruta + '/tarjetaequipo/SetIntegraTarjetaEquipo';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    //===================================================================
                    //================== REGITRO DE LLAMADA SERVICIO EN SAP ===============
                    setTimeout(function() {
                        me.registroSapBusinessCompra();
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
            registroSapBusinessCompra(){
                let me = this;
                me.loading.close();
                me.loadingProgressBar("INTEGRANDO COMPRA CON SAP BUSINESS ONE...");
                //Depurar Array para registrar en SAP
                me.arraySapArticulo.map(function(x, y){
                    //Si el VIN del arraySapArticulo se encuentra en arraySapItemCode => guardar en compra
                    //Sino se encuentra no pase a compra
                    if (me.arraySapItemCode.includes(x.cNumeroVin)) {
                        me.arraySapCompra.push(x);
                    }
                });

                var sapUrl = me.ruta + '/compra/SapSetCompra';
                axios.post(sapUrl, {
                    'cCardCode'     : me.formCompra.ccarcode,
                    'fDocDate'      : moment().format('YYYY-MM-DD'),
                    'fDocDueDate'   : moment().add(30, 'days').format('YYYY-MM-DD'),
                    'cWarehouseCode': me.formAlmacen.cwhscode,
                    'Igv'           : 1 + parseFloat((me.formCompra.igv)),
                    'nIdSapSucursal': parseInt(sessionStorage.getItem("nIdSapSucursal")),
                    'data'          : me.arraySapCompra
                }).then(response => {
                    me.arraySapRespuesta = [];
                    me.arraySapUpdSgc = [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(value, key){
                        me.jsonRespuesta = '';
                        me.jsonRespuesta= JSON.parse(value);
                        //Verifico que devuelva DocEntry
                        if(me.jsonRespuesta.DocEntry){
                            console.log("Integración SAP Compra : OK");

                            me.arraySapUpdSgc.push({
                                'nDocEntry' : parseInt(me.jsonRespuesta.DocEntry),
                                'nDocNum'   : parseInt(me.jsonRespuesta.DocNum),
                                'cDocType'  : me.jsonRespuesta.DocType.toString(),
                                'cLogRespuesta': me.arraySapRespuesta[key].toString(),
                                'cItemCode' : me.jsonRespuesta.DocumentLines[0].ItemCode.toString()
                            });

                            me.arraySapActividad.push({
                                'dActivityDate' :   moment().format('YYYY-MM-DD'),//'2019-01-29'
                                'hActivityTime' :   moment().format('HH:mm:ss'),
                                'cCardCode'     :   me.ccustomercode,
                                'cNotes'        :   'OrdenCompra',
                                'nDocEntry'     :   me.jsonRespuesta.DocEntry.toString(),
                                'nDocNum'       :   me.jsonRespuesta.DocNum.toString(),
                                'nDocType'      :   '22',
                                'nDuration'     :   '15',
                                'cDurationType' :   'du_Minuts',
                                'dEndDueDate'   :   moment().format('YYYY-MM-DD'),
                                'hEndTime'      :   moment().add(15, 'minutes').format('HH:mm:ss'),
                                'cReminder'     :   'tYES',
                                'nReminderPeriod':  '15',
                                'cReminderType' :   'du_Minuts',
                                'dStartDate'    :   moment().format('YYYY-MM-DD'),
                                'hStartTime'    :   moment().format('HH:mm:ss')
                            });
                        }
                    });
                    //==============================================================
                    //================== ACTUALIZAR DOCENTRY ===============
                    setTimeout(function() {
                        me.registroSgcCompra();
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
            registroSgcCompra(){
                let me = this;
                var sapUrl = me.ruta + '/compra/SetIntegraCompra';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    //==============================================================
                    //================== REGITRO DE ACTIVIDAD EN SAP ===============
                    setTimeout(function() {
                        me.registroSapBusinessActividad();
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
            registroSapBusinessActividad(){
                let me = this;

                var sapUrl = me.ruta + '/actividad/SapSetActividadCompra';
                axios.post(sapUrl, {
                    'data': me.arraySapActividad
                }).then(response => {
                    me.arraySapRespuesta = [];
                    me.arraySapUpdSgc = [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(value, key){
                        me.jsonRespuesta = '';
                        me.jsonRespuesta= JSON.parse(value);
                        //Si el valor de respuesta Code tiene un valor
                        if(me.jsonRespuesta.ActivityCode){
                            me.arraySapUpdSgc.push({
                                'nActivityCode' : parseInt(me.jsonRespuesta.ActivityCode),
                                'nActividadTipo': 22,
                                'cActividadTipo': 'OrdenCompra',
                                'cCardCode'     : me.jsonRespuesta.CardCode.toString(),
                                'nDocEntry'     : parseInt(me.jsonRespuesta.DocEntry),
                                'nDocNum'       : parseInt(me.jsonRespuesta.DocNum),
                                'cLogRespuesta' : me.arraySapRespuesta[key].toString()
                            });
                        }
                    });
                    //================================================================
                    //=========== ACTUALIZO TABLA INTEGRACION ACTIVIDAD SGC ==========
                    setTimeout(function() {
                        me.registroSgcActividad();
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
            registroSgcActividad(){
                let me = this;
                var sapUrl = me.ruta + '/actividad/SetIntegraActividadCompra';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    setTimeout(function() {
                        me.registroSapBusinessSolucion();
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
            registroSapBusinessSolucion(){
                let me = this;

                //Depurar Array para registrar en SAP
                me.arraySapCompra.map(function(value, key){
                    me.arraySapSolucion.push({
                        'cItemCode' : value.cNumeroVin,
                        'cSubject'  : "Cierre De Servicio"
                    });
                });

                var sapUrl = me.ruta + '/solucion/SapSetSolucion';
                axios.post(sapUrl, {
                    'data': me.arraySapSolucion
                }).then(response => {
                    me.arraySapRespuesta = [];
                    me.arraySapUpdSgc = [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(value, key){
                        me.jsonRespuesta = '';
                        me.jsonRespuesta= JSON.parse(value);
                        //Si el valor de respuesta Code tiene un valor
                        if(me.jsonRespuesta.SolutionCode){
                            me.arraySapUpdSgc.push({
                                'nSolutionCode' : parseInt(me.jsonRespuesta.SolutionCode),
                                'cItemCode'     : me.jsonRespuesta.ItemCode.toString(),
                                'cFlagTipo'     : 'C',
                                'cLogRespuesta' : me.arraySapRespuesta[key].toString()
                            });
                        }
                    });
                    //================================================================
                    //=========== ACTUALIZO TABLA INTEGRACION ACTIVIDAD SGC ==========
                    setTimeout(function() {
                        me.registroSgcSolucion();
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
            registroSgcSolucion(){
                let me = this;
                var sapUrl = me.ruta + '/solucion/SetIntegraSolucion';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    setTimeout(function() {
                        me.getOrdenCompraActividad();
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
            getOrdenCompraActividad(){
                let me = this;

                //Depurar Array para registrar en SAP
                me.arraySapArticulo.map(function(x, y){
                    //Si el VIN del arraySapArticulo se encuentra en arraySapItemCode => guardar en LlamadaServicio
                    //Sino se encuentra no pase a LlamadaServicio
                    if (me.arraySapItemCode.includes(x.cNumeroVin)) {

                        var sapUrl = me.ruta + '/actividad/GetIntegraActividadByItemCode';
                        axios.get(sapUrl, {
                            params: {
                                'citemcode'     : x.cNumeroVin,
                                'nactividadtipo': 22
                            }
                        }).then(response => {
                            me.arraySapLlamadaServicio.push({
                                'nActivityCode'     : response.data[0].nActivityCode,
                                'cCustomerCode'     : response.data[0].cCustomerCode,
                                'cInternalSerialNum': response.data[0].cItemCode,
                                'cItemCode'         : response.data[0].cItemCode,
                                'nSolutionCode'     : response.data[0].nSolutionCode,
                                'cSubject'          : 'COMPRA'
                            });
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
                });
                setTimeout(function() {
                    me.registroSapBusinessLlamadaServicio();
                }, 1600);
            },
            registroSapBusinessLlamadaServicio(){
                let me = this;

                var sapUrl = me.ruta + '/llamadaservicio/SapSetLlamadaServicioCompra';
                axios.post(sapUrl, {
                    'data': me.arraySapLlamadaServicio
                }).then(response => {
                    me.arraySapRespuesta = [];
                    me.arraySapItemCode = [];
                    me.arraySapUpdSgc = [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(value, key){
                        me.jsonRespuesta = '';
                        me.jsonRespuesta= JSON.parse(value);
                        //Si el valor de respuesta Code tiene un valor
                        if(me.jsonRespuesta.ItemCode){
                            me.arraySapItemCode.push(me.jsonRespuesta.ItemCode); //PARA DEPURAR

                            me.arraySapUpdSgc.push({
                                'nServiceCallID'    : me.jsonRespuesta.ServiceCallID.toString(),
                                'cFlagTipo'         : 'C',
                                'nActivityCode'     : me.jsonRespuesta.ServiceCallActivities[0].ActivityCode.toString(),
                                'cInternalSerialNum': me.jsonRespuesta.InternalSerialNum.toString(),
                                'cItemCode'         : me.jsonRespuesta.ItemCode.toString(),
                                'cLogRespuesta'     : me.arraySapRespuesta[key].toString()
                            });
                        }
                    });
                    //=========================================================================
                    //============ ACTUALIZO TABLA INTEGRACION LLAMADA SERVICIO SGC ===========
                    setTimeout(function() {
                        me.registroSgcLlamadaServicio();
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
            registroSgcLlamadaServicio(){
                let me = this;
                var sapUrl = me.ruta + '/llamadaservicio/SetIntegraLlamadaServicioCompra';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    setTimeout(function() {
                        me.registroSapBusinessTblCostoCabecera();
                        // me.verResultados();
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
            registroSapBusinessTblCostoCabecera(){
                let me = this;

                me.loading.close();
                me.loadingProgressBar("INTEGRANDO TABLA COSTOS CON SAP BUSINESS ONE...");

                var sapUrl = me.ruta + '/tablacosto/SapSetTablaCostoCabecera';
                axios.post(sapUrl, {
                    'data': me.arraySapArticulo
                }).then(response => {
                    me.arraySapRespuesta = [];
                    me.arraySapItemCode = [];
                    me.arraySapUpdSgc = [];
                    me.arraySapCosto = [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(value, key){
                        me.jsonRespuesta = '';
                        me.jsonRespuesta= JSON.parse(value);
                        //==== Si devuelve Json ItemCode
                        if(me.jsonRespuesta.DocEntry){
                            //Guardo los VINES Y DocEntry de la Cabecera de la Tabla Costos
                            me.arraySapItemCode.push(me.jsonRespuesta.U_SYP_VIN);

                            me.arraySapCosto.push({
                                'DocEntry' : me.jsonRespuesta.DocEntry,
                                'U_SYP_VIN': me.jsonRespuesta.U_SYP_VIN
                            });

                            me.arraySapUpdSgc.push({
                                'nDocEntry' : me.jsonRespuesta.DocEntry,
                                'cU_SYP_VIN': me.jsonRespuesta.U_SYP_VIN,
                                'cLogRespuesta': me.arraySapRespuesta[key].toString()
                            });
                        }
                    });

                    setTimeout(function() {
                        me.registroSgcTblCostoCabecera();
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
            registroSgcTblCostoCabecera(){
                let me = this;
                var sapUrl = me.ruta + '/tablacosto/SetIntegraTblCostoCab';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    setTimeout(function() {
                        me.obtenerConceptosTblCosto();
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
            obtenerConceptosTblCosto(){
                let me = this;

                var url = me.ruta + '/tablacosto/GetCompraConceptosTblCosto';
                axios.post(url, {
                        'nIdEmpresa'    : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nIdSucursal'   : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nIdCronograma' : me.nidcronograma,
                        'data'          : me.arraySapArticulo
                }).then(response => {
                    // ====================== CONCEPTO =========================
                    // ====================  TIPO DE BENEFICIO =================
                    let arrayBeneficio = response.data.array_infoTipoBeneficio;
                    arrayBeneficio.map(function (x) {
                        me.arrayTCTipoBeneficio.push({
                            'U_SYP_VIN'           :   x.U_SYP_VIN,
                            'U_SYP_CCONCEPTO'     :   x.U_SYP_CCONCEPTO,
                            'U_SYP_DCONCEPTO'     :   x.U_SYP_DCONCEPTO,
                            'U_SYP_CDOCUMENTO'    :   x.U_SYP_CDOCUMENTO,
                            'U_SYP_DDOCUMENTO'    :   x.U_SYP_DDOCUMENTO,
                            'U_SYP_IMPORTE'       :   x.U_SYP_IMPORTE,
                            'U_SYP_COSTO'         :   x.U_SYP_COSTO,
                            'U_SYP_ESTADO'        :   x.U_SYP_ESTADO
                        });
                    });
                    // ====================== CONCEPTO =========================
                    // ====================  COSTO DEL VEHICULO ================
                    /*let arrayCostoVehiculo = response.data.array_infoCostoVehiculo;
                    arrayCostoVehiculo.map(function (x) {
                        me.arrayTCCostoVehiculo.push({
                            'U_SYP_VIN'           :   x.U_SYP_VIN,
                            'U_SYP_CCONCEPTO'     :   x.U_SYP_CCONCEPTO,
                            'U_SYP_DCONCEPTO'     :   x.U_SYP_DCONCEPTO,
                            'U_SYP_CDOCUMENTO'    :   x.U_SYP_CDOCUMENTO,
                            'U_SYP_DDOCUMENTO'    :   x.U_SYP_DDOCUMENTO,
                            'U_SYP_IMPORTE'       :   x.U_SYP_IMPORTE,
                            'U_SYP_COSTO'         :   x.U_SYP_COSTO,
                            'U_SYP_ESTADO'        :   x.U_SYP_ESTADO
                        });
                    });*/

                    setTimeout(function() {
                        me.registroSapBusinessTblCostoDetalle();
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
            registroSapBusinessTblCostoDetalle(){
                let me = this;

                var url = me.ruta + '/tablacosto/SapPachTablaCostoDetalle';
                axios.post(url, {
                    'dataCabecera'  : me.arraySapCosto,
                    'dataTipoBeneficio'  : me.arrayTCTipoBeneficio/*,
                    'dataCostoVehiculo'  : me.arrayTCCostoVehiculo*/
                }).then(response => {
                    me.verResultados();
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
            activar(compra){
                swal({
                    title: 'Estas seguro de activar esta compra?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Activar!',
                    cancelButtonText: 'No, cancelar!'
                    }).then((result) => {
                        if (result.value) {
                            var url = this.ruta + '/compra/activar';
                            axios.put(url, {
                                nIdCompra: parseInt(compra.nIdCompra)
                            }).then(response => {
                                if(response.data[0].nFlagMsje == 1){
                                    swal(
                                        'Activado!',
                                        response.data[0].cMensaje
                                    );
                                }
                                else{
                                    swal(
                                        'Alerta!',
                                        response.data[0].cMensaje
                                    );
                                }
                                this.listarCompras(1);
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
            desactivar(compra){
                swal({
                    title: 'Estas seguro de eliminar esta Compra?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Desactivar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.value) {
                        var url = this.ruta + '/compra/desactivar';
                        axios.put(url, {
                            nIdCompra: parseInt(compra.nIdCompra)
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
                            this.listarCompras(1);
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
            descargaFormatoCompra(){
                window.open(this.ruta + '/storage/FormatosDescarga/FormatoCompraExcel.xlsx');
            },
            //==========================================================
            //=================== REGISTRO SAP INDIVIDUAL ==============
            validarSapArticulo(objCompra){
                this.mostrarProgressBar();

                let me = this;

                me.arraySapCompra.push({
                    'nIdCompra'         : objCompra.nIdCompra,
                    'nIdCronograma'     : objCompra.nIdCronograma,
                    'cCronograma'       : objCompra.cNumeroMes + '-' + objCompra.cAnio,
                    'nOrdenCompra'      : objCompra.nOrdenCompra,
                    'cNombreLinea'      : objCompra.cNombreLinea,
                    'cNombreAlmacen'    : objCompra.cNombreAlmacen,
                    'nNumeroReserva'    : objCompra.nNumeroReserva,
                    'cNumeroVin'        : objCompra.cNumeroVin,
                    'cFormaPago'        : objCompra.cFormaPago,
                    'cNombreComercial'  : objCompra.cNombreComercial,
                    'nAnioFabricacion'  : objCompra.nAnioFabricacion,
                    'nAnioVersion'      : objCompra.nAnioVersion,
                    'cNombreModelo'     : objCompra.cNombreModelo,
                    'cNombreColor'      : objCompra.cNombreColor,
                    'cSimboloMoneda'    : objCompra.cSimboloMoneda,
                    'fTotalCompra'      : objCompra.fTotalCompra,
                    'cSerieComprobante' : objCompra.cSerieComprobante,
                    'cNumeroComprobante': objCompra.cNumeroComprobante,
                    'dFechaFacturado'   : objCompra.dFechaFacturado,
                    'dFechaCompra'      : objCompra.dFechaCompra,
                    'cItemType'         : objCompra.cItemType
                });
                //Obtener Codigo Sap Proveedor
                me.formCompra.ccarcode = objCompra.cCardCode;

                //Obtener Cronograma
                //me.nidcronograma = objCompra.nIdCronograma;

                //Verifico Si existe Artículo
                if(!objCompra.cItemCode){
                    //==============================================================
                    //================== REGISTRO ARTICULO EN SAP ===============
                    me.generaSapArticulo(objCompra);
                }
                else{
                    //==============================================================
                    //================== REGISTRO COMPRA EN SAP ===============
                    me.generarSapProyecto(objCompra);
                }
            },
            generaSapArticulo(objCompra){
                let me = this;
                me.loadingProgressBar("INTEGRANDO ARTÍCULO CON SAP BUSINESS ONE...");

                var sapUrl = me.ruta + '/articulo/SapSetArticulo';
                axios.post(sapUrl, {
                    'data': me.arraySapCompra
                }).then(response => {
                    me.arraySapRespuesta= [];
                    me.arraySapUpdSgc= [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(x){
                        me.jsonRespuesta = '';
                        me.jsonRespuesta= JSON.parse(x);
                        //Si el valor de ItemCode tiene un valor
                        if(me.jsonRespuesta.ItemCode){
                            me.arraySapUpdSgc.push({
                                'cItemCode'     : me.jsonRespuesta.ItemCode.toString(),
                                'cLogRespuesta' : response.data.toString()
                            });

                            setTimeout(function() {
                                me.generaActualizaArticulo(objCompra);
                            }, 1600);
                        }
                    });
                }).catch(error => {
                    me.limpiarPorError("Error en la Integración de Artículo SapB1!");
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            generaActualizaArticulo(objCompra){
                let me = this;
                var sapUrl = me.ruta + '/articulo/SetIntegraArticulo';
                axios.post(sapUrl, {
                    'data'  : me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        //==============================================================
                        //================== REGISTRO PROYECTO EN SAP ===============
                        setTimeout(function() {
                            me.generarSapProyecto(objCompra);
                        }, 1600);
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
            /*generarSerieSap(objCompra){
                let me = this;
                var sapUrl = me.ruta + '/articulo/SapSetSerialNumber';
                axios.post(sapUrl, {
                    'data'  : arraySapCompra
                }).then(response => {
                    setTimeout(function() {
                        me.generarSapProyecto(objCompra);
                    }, 1600);
                }).catch(error => {
                    me.limpiarPorError("Error en la Integración Llamada Servicio SapB1!");
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },*/
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
                                }, 1600);
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
                    }, 1600);
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
                        //==============================================================
                        //============= REGISTRO TARJETA EQUIPO EN SAP ===============
                        me.generarSapTarjetaEquipo(objCompra);
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
            generarSapTarjetaEquipo(objCompra){
                let me = this;

                //Verifico Si No existe Tarjeta Equipo De EXCEL
                if(objCompra.nEquipmentCardNum==0){
                    //==============================================================
                    //============= REGISTRO TARJETA EQUIPO EN SAP ===============
                    me.loadingProgressBar("INTEGRANDO TARJETA EQUIPO CON SAP BUSINESS ONE...");

                    me.arraySapTarjetaEquipo.push({
                        'cCustomerCode'     : objCompra.cCustomerCode,
                        'cInternalSerialNum': objCompra.cNumeroVin,
                        'cItemCode'         : objCompra.cNumeroVin
                    });

                    var sapUrl = me.ruta + '/tarjetaequipo/SapSetTarjetaEquipo';
                    axios.post(sapUrl, {
                        'data': me.arraySapTarjetaEquipo
                    }).then(response => {
                        me.arraySapRespuesta= [];
                        me.arraySapUpdSgc= [];

                        me.arraySapRespuesta = response.data;
                        me.arraySapRespuesta.map(function(x){
                            me.jsonRespuesta = '';
                            me.jsonRespuesta= JSON.parse(x);
                            //Si el valor de respuesta InternalSerialNum tiene un valor
                            if(me.jsonRespuesta.InternalSerialNum){
                                me.arraySapUpdSgc.push({
                                    'nEquipmentCardNum' : parseInt(me.jsonRespuesta.EquipmentCardNum),
                                    'cItemCode'         : me.jsonRespuesta.ItemCode.toString(),
                                    'cInternalSerialNum': me.jsonRespuesta.InternalSerialNum.toString(),
                                    'cLogRespuesta'     : response.data.toString()
                                });

                                //==============================================================
                                //================== ACTUALIZO TABLA TarjetaEquipo ===============
                                setTimeout(function() {
                                    me.generaActualizaTarjetaEquipo(objCompra);
                                }, 1600);
                            }
                        });
                    }).catch(error => {
                        me.limpiarPorError("Error en la Integración de Tarjeta Equipo SapB1!");
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
                    //================== REGISTRO COMPRA EN SAP ===============
                    setTimeout(function() {
                        me.generaSapCompra(objCompra);
                    }, 1600);
                }
            },
            generaActualizaTarjetaEquipo(objCompra){
                let me = this;
                var sapUrl = me.ruta + '/tarjetaequipo/SetIntegraTarjetaEquipo';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        //==============================================================
                        //================== REGISTRO COMPRA EN SAP ===============
                        me.loading.close();
                        setTimeout(function() {
                            me.generaSapCompra(objCompra);
                        }, 1600);
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
            generaSapCompra(objCompra){
                let me = this;
                //Verifico Si No existe OrdenCompra De EXCEL
                if(objCompra.nDocEntry== 0){
                    //==============================================================
                    //================== REGISTRO COMPRA EN SAP ===============
                    me.loadingProgressBar("INTEGRANDO COMPRA CON SAP BUSINESS ONE...");

                    var sapUrl = me.ruta + '/compra/SapSetCompra';
                    axios.post(sapUrl, {
                        'cCardCode'     : me.formCompra.ccarcode,
                        'fDocDate'      : moment().format('YYYY-MM-DD'),
                        'fDocDueDate'   : moment().add(30, 'days').format('YYYY-MM-DD'),
                        'cWarehouseCode': me.formAlmacen.cwhscode,
                        'Igv'           : 1 + parseFloat((me.formCompra.igv)),
                        'nIdSapSucursal': parseInt(sessionStorage.getItem("nIdSapSucursal")),
                        'data'          : me.arraySapCompra
                    }).then(response => {
                        me.arraySapRespuesta= [];
                        me.arraySapUpdSgc= [];
                        me.arraySapActividad= [];

                        me.arraySapRespuesta = response.data;
                        me.arraySapRespuesta.map(function(x){
                            me.jsonRespuesta = '';
                            me.jsonRespuesta= JSON.parse(x);
                            //Verifico que devuelva DocEntry
                            if(me.jsonRespuesta.DocEntry){
                                console.log("Integración SAP Compra : OK");

                                me.arraySapUpdSgc.push({
                                    'nDocEntry'     : parseInt(me.jsonRespuesta.DocEntry),
                                    'nDocNum'       : parseInt(me.jsonRespuesta.DocNum),
                                    'cDocType'      : me.jsonRespuesta.DocType.toString(),
                                    'cLogRespuesta' : response.data.toString(),
                                    'cItemCode'     : me.jsonRespuesta.DocumentLines[0].ItemCode.toString()
                                });

                                me.arraySapActividad.push({
                                    'dActivityDate' : moment().format('YYYY-MM-DD'),
                                    'hActivityTime' : moment().format('HH:mm:ss'),
                                    'cCardCode'     : objCompra.cCustomerCode,
                                    'cNotes'        : 'OrdenCompra',
                                    'nDocEntry'     : me.jsonRespuesta.DocEntry.toString(),
                                    'nDocNum'       : me.jsonRespuesta.DocNum.toString(),
                                    'nDocType'      : '22',
                                    'nDuration'     : '15',
                                    'cDurationType' : 'du_Minuts',
                                    'dEndDueDate'   : moment().format('YYYY-MM-DD'),
                                    'hEndTime'      : moment().add(15, 'minutes').format('HH:mm:ss'),
                                    'cReminder'     : 'tYES',
                                    'nReminderPeriod': '15',
                                    'cReminderType' : 'du_Minuts',
                                    'dStartDate'    : moment().format('YYYY-MM-DD'),
                                    'hStartTime'    : moment().format('HH:mm:ss')
                                });

                                //==============================================================
                                //================== ACTUALIZAR DOCENTRY ===============
                                setTimeout(function() {
                                    me.generaActualizarDocEntry(objCompra);
                                }, 1600);
                            }
                        });
                    }).catch(error => {
                        me.limpiarPorError("Error en la Integración Compra SapB1!");
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
                    //================== REGISTRO ACTIVIDAD EN SAP ===============
                    setTimeout(function() {
                        me.generaSapActividadCompra(objCompra);
                    }, 1600);
                }
            },
            generaActualizarDocEntry(objCompra){
                let me = this;
                var sapUrl = me.ruta + '/compra/SetIntegraCompra';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        setTimeout(function() {
                            me.generaSapActividadCompra(objCompra);
                        }, 1600);
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
            generaSapActividadCompra(objCompra){
                let me = this;
                //Verifico Si No existe Actividad De EXCEL
                if(objCompra.nActivityCode== 0){
                    //==============================================================
                    //================== REGISTRO ACTIVIDAD EN SAP ===============
                    var sapUrl = me.ruta + '/actividad/SapSetActividadCompra';
                    axios.post(sapUrl, {
                        'data': me.arraySapActividad
                    }).then(response => {
                        me.arraySapRespuesta = [];
                        me.arraySapUpdSgc = [];

                        me.arraySapRespuesta = response.data;
                        me.arraySapRespuesta.map(function(x){
                            me.jsonRespuesta = '';
                            me.jsonRespuesta= JSON.parse(x);
                            //Si el valor de respuesta Code tiene un valor
                            if(me.jsonRespuesta.ActivityCode){
                                me.arraySapUpdSgc.push({
                                    'nActivityCode' : parseInt(me.jsonRespuesta.ActivityCode),
                                    'nActividadTipo': 22,
                                    'cActividadTipo': 'OrdenCompra',
                                    'cCardCode'     : me.jsonRespuesta.CardCode.toString(),
                                    'nDocEntry'     : parseInt(me.jsonRespuesta.DocEntry),
                                    'nDocNum'       : parseInt(me.jsonRespuesta.DocNum),
                                    'cLogRespuesta' : response.data.toString()
                                });

                                //================================================================
                                //=========== ACTUALIZO TABLA INTEGRACION ACTIVIDAD SGC ==========
                                me.nactivitycode = me.jsonRespuesta.ActivityCode;
                                setTimeout(function() {
                                    me.generaActualizarActividadCompra(objCompra);
                                }, 1600);
                            }
                        });
                    }).catch(error => {
                        me.limpiarPorError("Error en la Integración Actividad SapB1!");
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
                    //============= REGISTRO LLAMADA DE SERVICIO EN SAP ============
                    setTimeout(function() {
                            me.generaSapSolucion(objCompra);
                    }, 1600);
                }
            },
            generaActualizarActividadCompra(objCompra){
                let me = this;
                var sapUrl = me.ruta + '/actividad/SetIntegraActividadCompra';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        //==============================================================
                        //================== REGISTRO ACTIVIDAD EN SAP ===============
                        setTimeout(function() {
                            me.generaSapSolucion(objCompra);
                        }, 1600);
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
            generaSapSolucion(objCompra){
                let me = this;
                if(objCompra.nSolutionCode== 0){
                    me.arraySapSolucion.push({
                        'cItemCode' : objCompra.cNumeroVin,
                        'cSubject'  : "Cierre De Servicio"
                    });

                    var sapUrl = me.ruta + '/solucion/SapSetSolucion';
                    axios.post(sapUrl, {
                        'data': me.arraySapSolucion
                    }).then(response => {
                        me.arraySapRespuesta = [];
                        me.arraySapUpdSgc = [];

                        me.arraySapRespuesta = response.data;
                        me.arraySapRespuesta.map(function(x){
                            me.jsonRespuesta = '';
                            me.jsonRespuesta= JSON.parse(x);
                            //Si el valor de respuesta Code tiene un valor
                            if(me.jsonRespuesta.SolutionCode){
                                me.arraySapUpdSgc.push({
                                    'nSolutionCode' : parseInt(me.jsonRespuesta.SolutionCode),
                                    'cItemCode'     : me.jsonRespuesta.ItemCode.toString(),
                                    'cFlagTipo'     : 'C',
                                    'cLogRespuesta' : response.data.toString()
                                });

                                me.arraySapLlamadaServicio = [];
                                me.arraySapLlamadaServicio.push({
                                    'nActivityCode'     : me.nactivitycode,
                                    'cCustomerCode'     : objCompra.cCustomerCode,
                                    'cInternalSerialNum': objCompra.cNumeroVin,
                                    'cItemCode'         : objCompra.cNumeroVin,
                                    'nSolutionCode'     : me.jsonRespuesta.SolutionCode,
                                    'cSubject'          : objCompra.cSubject
                                });

                                //================================================================
                                //=========== ACTUALIZO TABLA INTEGRACION ACTIVIDAD SGC ==========
                                setTimeout(function() {
                                    me.generaActualizarSolucion(objCompra);
                                }, 1600);
                            }
                        });
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
                else{
                    //==============================================================
                    //============ REGISTRO LLAMADA DE SERVICIO EN SAP =============
                    setTimeout(function() {
                        me.generaSapLlamadaServicioCompra(objCompra);
                    }, 1600);
                }
            },
            generaActualizarSolucion(objCompra){
                let me = this;
                var sapUrl = me.ruta + '/solucion/SetIntegraSolucion';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        //==============================================================
                        //=========== REGISTRO LLAMADA DE SERVICIO EN SAP ==============
                        setTimeout(function() {
                            me.generaSapLlamadaServicioCompra(objCompra);
                        }, 1600);
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
            generaSapLlamadaServicioCompra(objCompra){
                let me = this;

                //Validar que Solucion ya esta registrado
                if(objCompra.nSolutionCode!= 0){

                    me.loadingProgressBar("INTEGRANDO LLAMADA DE SERVICIO CON SAP BUSINESS ONE...");

                    me.arraySapLlamadaServicio = [];
                    me.arraySapLlamadaServicio.push({
                        'nActivityCode'     : objCompra.nActivityCode,
                        'cCustomerCode'     : objCompra.cCustomerCode,
                        'cInternalSerialNum': objCompra.cNumeroVin,
                        'cItemCode'         : objCompra.cNumeroVin,
                        'nSolutionCode'     : objCompra.nSolutionCode,
                        'cSubject'          : objCompra.cSubject
                    });
                }

                if(objCompra.nServiceCallID== 0){
                    var sapUrl = me.ruta + '/llamadaservicio/SapSetLlamadaServicioCompra';
                    axios.post(sapUrl, {
                        'data': me.arraySapLlamadaServicio
                    }).then(response => {
                        me.arraySapRespuesta = [];
                        me.arraySapUpdSgc = [];

                        me.arraySapRespuesta = response.data;
                        me.arraySapRespuesta.map(function(x){
                            me.jsonRespuesta = '';
                            me.jsonRespuesta= JSON.parse(x);
                            //Si el valor de respuesta Code tiene un valor
                            if(me.jsonRespuesta.ItemCode){
                                me.arraySapItemCode.push(me.jsonRespuesta.ItemCode); //PARA DEPURAR

                                me.arraySapUpdSgc.push({
                                    'nServiceCallID'    : me.jsonRespuesta.ServiceCallID.toString(),
                                    'cFlagTipo'         : 'C',
                                    'nActivityCode'     : me.jsonRespuesta.ServiceCallActivities[0].ActivityCode.toString(),
                                    'cInternalSerialNum': me.jsonRespuesta.InternalSerialNum.toString(),
                                    'cItemCode'         : me.jsonRespuesta.ItemCode.toString(),
                                    'cLogRespuesta'     : response.data.toString()
                                });

                                //=========================================================================
                                //============ ACTUALIZO TABLA INTEGRACION LLAMADA SERVICIO SGC ===========
                                setTimeout(function() {
                                    me.generaActualizarLlamadaServicio(objCompra);
                                }, 1600);
                            }
                        });
                    }).catch(error => {
                        me.limpiarPorError("Error en la Integración Llamada Servicio SapB1!");
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
                    //================== REGISTRO TABLA COSTO EN SAP ===============
                    setTimeout(function() {
                        me.generaSapTblCostoCabecera(objCompra);
                    }, 1600);
                }
            },
            generaActualizarLlamadaServicio(objCompra){
                let me = this;
                var sapUrl = me.ruta + '/llamadaservicio/SetIntegraLlamadaServicioCompra';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    ////////////////////////////////////////if()
                     ////////////////////////////////////////if()
                    //==============================================================
                    //================== REGISTRO TABLA COSTO EN SAP ===============
                    setTimeout(function() {
                        me.generaSapTblCostoCabecera(objCompra);
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
            generaSapTblCostoCabecera(objCompra){
                let me = this;

                me.loading.close();
                me.loadingProgressBar("INTEGRANDO TABLA COSTOS CON SAP BUSINESS ONE...");

                var sapUrl = me.ruta + '/tablacosto/SapSetTablaCostoCabecera';
                axios.post(sapUrl, {
                    'data': me.arraySapCompra
                }).then(response => {
                    me.arraySapRespuesta = [];
                    me.arraySapUpdSgc = [];
                    me.arraySapCosto = [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(x){
                        me.jsonRespuesta = '';
                        me.jsonRespuesta= JSON.parse(x);
                        //==== Si devuelve Json ItemCode
                        if(me.jsonRespuesta.DocEntry){
                            me.arraySapCosto.push({
                                'DocEntry' : me.jsonRespuesta.DocEntry,
                                'U_SYP_VIN': me.jsonRespuesta.U_SYP_VIN
                            });

                            me.arraySapUpdSgc.push({
                                'nDocEntry'     : me.jsonRespuesta.DocEntry,
                                'cU_SYP_VIN'    : me.jsonRespuesta.U_SYP_VIN,
                                'cLogRespuesta' : response.data.toString()
                            });
                        }
                    });

                    setTimeout(function() {
                        me.generaActualizarTblCostoCabecera(objCompra);
                    }, 1600);
                }).catch(error => {
                    me.limpiarPorError("Error en la Integración Tabla Costo Cabecera SapB1!");
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            generaActualizarTblCostoCabecera(objCompra){
                let me = this;
                var sapUrl = me.ruta + '/tablacosto/SetIntegraTblCostoCab';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    setTimeout(function() {
                        me.obtenerConceptosTblCostoPorVin(objCompra);
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
            obtenerConceptosTblCostoPorVin(objCompra){
                let me = this;

                var url = me.ruta + '/tablacosto/GetCompraConceptosTblCosto';
                axios.post(url, {
                        'nIdEmpresa'    : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nIdSucursal'   : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nIdCronograma' : objCompra.nIdCronograma,
                        'data'          : me.arraySapCompra
                }).then(response => {
                    // ====================== CONCEPTO =========================
                    // ====================  TIPO DE BENEFICIO =================
                    if(response.data.array_infoTipoBeneficio.length){
                        let arrayBeneficio = response.data.array_infoTipoBeneficio;
                        arrayBeneficio.map(function (x) {
                            me.arrayTCTipoBeneficio.push({
                                'U_SYP_VIN'           :   x.U_SYP_VIN,
                                'U_SYP_CCONCEPTO'     :   x.U_SYP_CCONCEPTO,
                                'U_SYP_DCONCEPTO'     :   x.U_SYP_DCONCEPTO,
                                'U_SYP_CDOCUMENTO'    :   x.U_SYP_CDOCUMENTO,
                                'U_SYP_DDOCUMENTO'    :   x.U_SYP_DDOCUMENTO,
                                'U_SYP_IMPORTE'       :   x.U_SYP_IMPORTE,
                                'U_SYP_COSTO'         :   x.U_SYP_COSTO,
                                'U_SYP_ESTADO'        :   x.U_SYP_ESTADO
                            });
                        });
                    }

                    // ====================== CONCEPTO =========================
                    // ====================  COSTO DEL VEHICULO ================
                    /*if(response.data.array_infoCostoVehiculo.length){
                        let arrayCostoVehiculo = response.data.array_infoCostoVehiculo;
                        arrayCostoVehiculo.map(function (x) {
                            me.arrayTCCostoVehiculo.push({
                                'U_SYP_VIN'           :   x.U_SYP_VIN,
                                'U_SYP_CCONCEPTO'     :   x.U_SYP_CCONCEPTO,
                                'U_SYP_DCONCEPTO'     :   x.U_SYP_DCONCEPTO,
                                'U_SYP_CDOCUMENTO'    :   x.U_SYP_CDOCUMENTO,
                                'U_SYP_DDOCUMENTO'    :   x.U_SYP_DDOCUMENTO,
                                'U_SYP_IMPORTE'       :   x.U_SYP_IMPORTE,
                                'U_SYP_COSTO'         :   x.U_SYP_COSTO,
                                'U_SYP_ESTADO'        :   x.U_SYP_ESTADO
                            });
                        });
                    }*/

                    setTimeout(function() {
                        me.generaSapTblCostoDetallePorVin();
                    }, 1600);
                }).catch(error => {
                    me.limpiarPorError("Error en la Integración Costos Servicio SapB1!");
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            generaSapTblCostoDetallePorVin(){
                let me = this;

                var url = me.ruta + '/tablacosto/SapPachTablaCostoDetalle';
                axios.post(url, {
                    'dataCabecera'      : me.arraySapCosto,
                    'dataTipoBeneficio' : me.arrayTCTipoBeneficio/*,
                    'dataCostoVehiculo' : me.arrayTCCostoVehiculo*/
                }).then(response => {
                    me.confirmaCompra();
                }).catch(error => {
                    me.limpiarPorError("Error en la Integración Tabla Costo Detalle SapB1!");
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
            //=================== Generar Entrada Mercancia ==============
            generaSapEntradaMercancia(objCompra){
                let me = this;
                //Verifico Si No existe OrdenCompra De EXCEL
                if(objCompra.nDocEntryMercancia== 0){
                    me.arraySapCompra.push({
                        'nIdCompra'         : objCompra.nIdCompra,
                        'nIdCronograma'     : objCompra.nIdCronograma,
                        'cNumeroVin'        : objCompra.cNumeroVin,
                        'cNombreComercial'  : objCompra.cNombreComercial,
                        'nAnioFabricacion'  : objCompra.nAnioFabricacion,
                        'nAnioVersion'      : objCompra.nAnioVersion,
                        'cSimboloMoneda'    : objCompra.cSimboloMoneda,
                        'fTotalCompra'      : objCompra.fTotalCompra,
                        'cSerieComprobante' : objCompra.cSerieComprobante,
                        'cNumeroComprobante': objCompra.cNumeroComprobante,
                        'nDocEntry'         : objCompra.nDocEntry,
                        'cItemType'         : objCompra.cItemType,
                        'cCardCode'         : objCompra.cCardCode
                    });
                    //==============================================================
                    //================== REGISTRO MERCANCIA EN SAP ===============
                    me.loadingProgressBar("INTEGRANDO ENTRADA DE MERCANCÍAS CON SAP BUSINESS ONE...");

                    var sapUrl = me.ruta + '/mercancia/SapSetMercanciaByOC';
                    axios.post(sapUrl, {
                        'fDocDate': moment().format('YYYY-MM-DD'),
                        'fDocDueDate': moment().add(30, 'days').format('YYYY-MM-DD'),
                        'data': me.arraySapCompra
                    }).then(response => {
                        me.arraySapRespuesta= [];
                        me.arraySapUpdSgc= [];
                        me.arraySapActividad= [];

                        me.arraySapRespuesta = response.data;
                        me.arraySapRespuesta.map(function(x){
                            me.jsonRespuesta = '';
                            me.jsonRespuesta= JSON.parse(x);
                            //Verifico que devuelva DocEntry
                            if(me.jsonRespuesta.DocEntry){
                                console.log("Integración SAP Mercancia : OK");

                                me.arraySapUpdSgc.push({
                                    'nDocEntry'     : parseInt(me.jsonRespuesta.DocEntry),
                                    'nDocNum'       : parseInt(me.jsonRespuesta.DocNum),
                                    'cDocType'      : me.jsonRespuesta.DocType.toString(),
                                    'cLogRespuesta' : response.data.toString(),
                                    'cItemCode'     : me.jsonRespuesta.DocumentLines[0].ItemCode.toString()
                                });

                                me.arraySapActividad.push({
                                    'dActivityDate' : moment().format('YYYY-MM-DD'),
                                    'hActivityTime' : moment().format('HH:mm:ss'),
                                    'cCardCode'     : objCompra.cCustomerCode,
                                    'cNotes'        : 'EntradaMercancia',
                                    'nDocEntry'     : me.jsonRespuesta.DocEntry.toString(),
                                    'nDocNum'       : me.jsonRespuesta.DocNum.toString(),
                                    'nDocType'      : '20',
                                    'nDuration'     : '15',
                                    'cDurationType' : 'du_Minuts',
                                    'dEndDueDate'   : moment().format('YYYY-MM-DD'),
                                    'hEndTime'      : moment().add(15, 'minutes').format('HH:mm:ss'),
                                    'cReminder'     : 'tYES',
                                    'nReminderPeriod': '15',
                                    'cReminderType' : 'du_Minuts',
                                    'dStartDate'    : moment().format('YYYY-MM-DD'),
                                    'hStartTime'    : moment().format('HH:mm:ss')
                                });

                                //==============================================================
                                //================== ACTUALIZAR DOCENTRY ===============
                                setTimeout(function() {
                                    me.generaActualizarMercancia(objCompra);
                                }, 1600);
                            }
                        });
                    }).catch(error => {
                        me.limpiarPorError("Error en la Integración Entrada Mercancía SapB1!");
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
            generaActualizarMercancia(objCompra){
                let me = this;
                var sapUrl = me.ruta + '/mercancia/SetIntegraMercanciaCompra';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                         //==============================================================
                        //================== REGISTRO ACTIVIDAD EN SAP ===============
                        setTimeout(function() {
                            me.generaSapActividadMercancia(objCompra);
                        }, 1600);
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
            generaSapActividadMercancia(objCompra){
                let me = this;
                //==============================================================
                //================== REGISTRO ACTIVIDAD EN SAP ===============
                var sapUrl = me.ruta + '/actividad/SapSetActividadMercancia';
                axios.post(sapUrl, {
                    'data': me.arraySapActividad
                }).then(response => {
                    me.arraySapRespuesta = [];
                    me.arraySapUpdSgc = [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(x){
                        me.jsonRespuesta = '';
                        me.jsonRespuesta= JSON.parse(x);
                        //Si el valor de respuesta Code tiene un valor
                        if(me.jsonRespuesta.ActivityCode){
                            me.arraySapUpdSgc.push({
                                'nServiceCallID'    : objCompra.nServiceCallID,
                                'nActivityCode'     : parseInt(me.jsonRespuesta.ActivityCode),
                                'nActividadTipo'    : 20,
                                'cActividadTipo'    : 'EntradaMercancia',
                                'cCardCode'         : me.jsonRespuesta.CardCode.toString(),
                                'nDocEntry'         : parseInt(me.jsonRespuesta.DocEntry),
                                'nDocNum'           : parseInt(me.jsonRespuesta.DocNum),
                                'cLogRespuesta'     : response.data.toString()
                            });

                            me.arraySapLlamadaServicio = [];
                            me.arraySapLlamadaServicio.push({
                                'nActivityCode'     : me.jsonRespuesta.ActivityCode,
                                'cCustomerCode'     : objCompra.cCustomerCode,
                                'cInternalSerialNum': objCompra.cNumeroVin,
                                'cItemCode'         : objCompra.cNumeroVin,
                                'cSubject'          : objCompra.cSubject
                            });

                            //================================================================
                            //=========== ACTUALIZO TABLA INTEGRACION ACTIVIDAD SGC ==========
                            me.nactivitycode = me.jsonRespuesta.ActivityCode;
                            setTimeout(function() {
                                me.generaActualizarActividadMercancia(objCompra);
                            }, 1600);
                        }
                    });
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
            generaActualizarActividadMercancia(objCompra){
                let me = this;
                var sapUrl = me.ruta + '/actividad/SetIntegraActividad';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        //================================================================================
                        //================== REGISTRO EN TABLA SCL5 DE LA LLAMADA SERVICIO ===============
                        setTimeout(function() {
                            me.generaSapActividadServiceCall(objCompra);
                        }, 1600);
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
            // =============  ACTUALIZAR COMPRA ======================
            actualizar(){
                if(this.validarActualizar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/compra/UpdCompraById';
                axios.post(url, {
                    nIdEmpresa: parseInt(sessionStorage.getItem("nIdEmpresa")),
                    nIdSucursal: parseInt(sessionStorage.getItem("nIdSucursal")),
                    nIdCompra: this.formModalCompra.nidcompra,
                    cNumeroVin: this.formModalCompra.cnumerovin,
                    cNumeroMotor: this.formModalCompra.cnumeromotor,
                    cNumeroDua: this.formModalCompra.cnumerodua,
                    cNombreColor: this.formModalCompra.cnombrecolor,
                    cSerieComprobante: this.formModalCompra.cseriecomprobante,
                    cNumeroComprobante: this.formModalCompra.cnumerocomprobante
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1) {
                        swal('Compra actualizada correctamente');
                        this.cerrarModal();
                        this.listarCompras(1);
                    } else {
                        swal('Ya existe VIN');
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
            validarActualizar(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.formModalCompra.cnumerovin){
                    this.mensajeError.push('Debes ingresar Nro Vin');
                };

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // ====================================================
            // =============  TAB LINEA CREDITO ======================
            tabLineaCredito(){
                this.arrayLineaCredito = [];
                this.fillCompra.nidmarca = '';
                this.fillCompra.nidmodelo = '';
            },
            listarCompraNoLineaCredito(page){
                this.mostrarProgressBar();
                if(this.fillCompra.nordencompra == ''){
                    var nordencompra = 0;
                }
                else{
                    var nordencompra = this.fillCompra.nordencompra;
                }

                var url = this.ruta + '/compra/GetLstCompraNoLineaCredito';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'dfechainicio': this.fillCompra.dfechainicio,
                        'dfechafin': this.fillCompra.dfechafin,
                        'nordencompra': nordencompra,
                        'cnumerovin': this.fillCompra.cnumerovin,
                        'nidmarca': this.fillCompra.nidmarca,
                        'nidmodelo': this.fillCompra.nidmodelo,
                        'page': page
                    }
                }).then(response => {
                    this.arrayLineaCredito = response.data.arrayLineaCredito.data;
                    this.pagination.current_page =  response.data.arrayLineaCredito.current_page;
                    this.pagination.total = response.data.arrayLineaCredito.total;
                    this.pagination.per_page    = response.data.arrayLineaCredito.per_page;
                    this.pagination.last_page   = response.data.arrayLineaCredito.last_page;
                    this.pagination.from        = response.data.arrayLineaCredito.from;
                    this.pagination.to           = response.data.arrayLineaCredito.to;
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
            cambiarPaginaLineaCredito(page){
                this.pagination.current_page=page;
                this.listarCompraNoLineaCredito(page);
            },
            asignarComprasLinea(compra){
                let me = this;

                if(me.encontrarCompraLinea(compra.nIdCompra)){
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'La compra ya se encuentra agregada!',
                    })
                } else {
                    me.arrayTempLineaCredito.push({
                            nIdCompra: compra.nIdCompra,
                            cNumeroVin: compra.cNumeroVin,
                            cNumeroMes: compra.cNumeroMes,
                            cAnio: compra.cAnio,
                            nOrdenCompra: compra.nOrdenCompra,
                            cNumeroVin: compra.cNumeroVin,
                            cNombreComercial: compra.cNombreComercial,
                            nAnioFabricacion: compra.nAnioFabricacion,
                            nAnioVersion: compra.nAnioVersion
                    });

                    toastr.success('Se Agregó "'+ compra.cNumeroVin +'" ');
                }
            },
            encontrarCompraLinea(compra){
                var sw=0;
                this.arrayTempLineaCredito.map(function (x) {
                    if(x.nIdCompra == compra){
                        sw = true;
                    }
                });
                return sw;
            },
            removerCompraLinea(index){
                this.$delete(this.arrayTempLineaCredito, index);
            },
            registrarLineaCredito(){
                this.mostrarProgressBar();

                var url = this.ruta + '/compra/UpdCompraLineaCreditoById';
                axios.post(url, {
                    nIdEmpresa: parseInt(sessionStorage.getItem("nIdEmpresa")),
                    nIdSucursal: parseInt(sessionStorage.getItem("nIdSucursal")),
                    data: this.arrayTempLineaCredito
                }).then(response => {
                    this.arrayTempLineaCredito = [];
                    $("#myBar").hide();
                    swal('Compras actualizadas a Linea Credito');
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
            unCheckBox(){
                let me = this;

                me.arrayLineaCredito.map(function(value, key) {
                    me.checkBoxLinea[key] == false;
                });
            },
            // ====================================================
            // =============  TAB FORUM ======================
            tabForum(){
                this.listarProveedorWO();
                this.limpiarFormulario();
            },
            listarProveedorWO(){
                var url = this.ruta + '/parametro/GetLstProveedor';

                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidgrupopar': 110094,
                        'cnombreproveedor': '',
                        'opcion' : 1
                    }
                }).then(response => {
                    this.arrayProveedorForum = response.data.arrayProveedor;
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
            descargaFormatoForum(){
                window.open(this.ruta + '/storage/FormatosDescarga/FormatoForum.xlsx');
            },
            getFileForum(e){
                let selectFile = e.target.files[0];
                this.attachment = selectFile;
            },
            importFileForum(){
                if(this.validarReadFileForum()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.form.append('file', this.attachment);
                const config = { headers: { 'Content-Type': 'multipart/form-data'  } };
                var url = this.ruta + '/compra/importFileForum';
                axios.post(url, this.form, config).then(response=>{
                    this.readFileForum(response.data);
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
            readFileForum(nameFile){
                this.mostrarProgressBar();
                var url = this.ruta + '/compra/readFileForum';
                axios.post(url, {
                    'nameFile': nameFile
                }).then(response => {
                    /*if(this.validaCamposExcel(response.data)){
                        this.accionmodal=1;
                        this.modal = 1;
                        return;
                    }*/

                    this.$delete(response.data, 0);
                    this.arrayForum = response.data;
                    this.contadorArrayForum = this.arrayForum.length;
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
            validarReadFileForum(){
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
            validaCamposExcelForum(foo){
                this.error = 0;
                this.mensajeError = [];
                var list=[];

                foo.map(function(value, key) {
                    if(key==0){
                        if(value.nOrdenCompra != "OC"){
                            list.push('Falta celda OC, verifique el archivo.');
                        };
                        if(value.cNombreLinea != "Línea"){
                            list.push('Falta celda Línea, verifique el archivo.');
                        };
                        if(value.cNombreAlmacen != "Almacén"){
                            list.push('Falta celda Almacén, verifique el archivo.');
                        };
                        if(value.nNumeroReserva != "Nro Reserva"){
                            list.push('Falta celda Nro Reserva, verifique el archivo.');
                        };
                        if(value.fTotalCompra != "Total"){
                            list.push('Falta celda Total, verifique el archivo.');
                        };
                    };
                    /*if(key != 0){
                        if(!/^([0-9])*[.]?[0-9]*$/.test(value.fTotalCompra)){
                            list.push('Existe un error en el campo Total, verifique el archivo.');
                        }
                    };*/
                });

                if(list.length){
                    this.mensajeError = list;
                    this.error = 1;
                }
                return this.error;
            },
            eliminarItemForum(index){
                this.$delete(this.arrayForum, index);
                this.contadorArrayForum = this.arrayForum.length;
            },
            registrarForum(){
                let me = this;

                if(me.validarRegistroForum()){
                    me.accionmodal=1;
                    me.modal = 1;
                    return;
                }

                me.mostrarProgressBar();

                var url = me.ruta + '/woperativo/SetWOperativo';
                axios.post(url, {
                    'nIdProveedor'      : me.formWOperativo.nidproveedor,
                    'fTotalValor'       : me.fTotalValor,
                    'data'              : me.arrayForum
                }).then(response => {
                    this.confirmarForum();
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
            validarRegistroForum(){
                this.error = 0;
                this.mensajeError =[];

                if(this.arrayForum == []){
                    this.mensajeError.push('No hay Datos a Registrar');
                };
                if(this.formWOperativo.nidproveedor == 0 || !this.formWOperativo.nidproveedor){
                    this.mensajeError.push('Seleccione Proveedor');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            confirmarForum(){
                let me = this;
                //me.loading.close();
                $("#myBar").hide();
                swal('Warrant Operativo registrado');
                me.limpiarFormulario();
            },
            // =============  LISTAR ALMACEN ======================
            listarAlmacen(page){
                var url = this.ruta + '/almacen/GetAlmacenByLocalidad';

                axios.get(url, {
                    params: {
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'page' : page
                    }
                }).then(response => {
                    this.arrayAlmacen = response.data.arrayAlmacen.data;
                    this.paginationModal.current_page =  response.data.arrayAlmacen.current_page;
                    this.paginationModal.total = response.data.arrayAlmacen.total;
                    this.paginationModal.per_page    = response.data.arrayAlmacen.per_page;
                    this.paginationModal.last_page   = response.data.arrayAlmacen.last_page;
                    this.paginationModal.from        = response.data.arrayAlmacen.from;
                    this.paginationModal.to           = response.data.arrayAlmacen.to;
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
            cambiarPaginaAlmacen(page){
                this.paginationModal.current_page=page;
                this.listarAlmacen(page);
            },
            asignarAlmacen(objAlmacen){
                this.formAlmacen.cwhscode = objAlmacen.cWhsCode;
                this.formAlmacen.cwhsname = objAlmacen.cWhsName;
                this.cerrarModal();
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
                    }
                    break;
                    case 'compra':
                    {
                        switch(accion){
                            case 'editar':
                            {
                                this.accionmodal=4;
                                this.modal = 1;
                                this.formModalCompra.nidcompra = data['nIdCompra'];
                                this.formModalCompra.nordencompra = data['nOrdenCompra'];
                                this.formModalCompra.cnombrecomercial = data['cNombreComercial'];
                                this.formModalCompra.cnumerovin = data['cNumeroVin'];
                                this.formModalCompra.cnumeromotor = data['cNumeroMotor'];
                                this.formModalCompra.cnumerodua = data['cNumeroDua'];
                                this.formModalCompra.cnombrecolor = data['cNombreColor'];
                                this.formModalCompra.cseriecomprobante = data['cSerieComprobante'];
                                this.formModalCompra.cnumerocomprobante = data['cNumeroComprobante'];
                                break;
                            }
                            case 'lineacredito':
                            {
                                this.accionmodal=5;
                                this.modal = 1;
                                this.arrayLineaCredito = [];
                                break;
                            }
                        }
                    }
                    break;
                    case 'lista':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=6;
                                this.modal = 1;
                                this.listarListaPrecioVersionVeh(1);
                                break;
                            }
                        }
                    }
                    break;
                    case 'almacen':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=7;
                                this.modal = 1;
                                this.listarAlmacen(1);
                                break;
                            }
                        }
                    }
                    break;
                }
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
                this.arrayForum = [];
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
    /*input[type="file"] {
        display: none;
    }*/
</style>
