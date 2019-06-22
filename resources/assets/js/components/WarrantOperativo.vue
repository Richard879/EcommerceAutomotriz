<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">
                        <vs-divider color="dark">MODULO WARRANT OPERATIVO</vs-divider>
                    </h2>
                </div>
            </header>

            <section>
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#TabBuscaWOperativo" @click="tabBuscarWOperativo()" role="tab" data-toggle="tab">
                                            <i class="fa fa-search"></i> BUSCAR W. OPERATIVO
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#TabGeneraWOperativo" @click="tabGeneraWOperativo()" role="tab" data-toggle="tab">
                                            <i class="fa fa-qrcode"></i> GENERAR W. OPERATIVO
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#TabGeneraOS" @click="tabGeneraOS()" role="tab" data-toggle="tab">
                                            <i class="fa fa-file-text-o"></i> GENERAR O/S
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane fade in active show" id="TabBuscaWOperativo">
                                        <template v-if="vistaFormularioTabBuscar">
                                            <section class="forms">
                                                <div class="container-fluid">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h3 class="h4">BUSCAR WARRANT OPERATIVO</h3>
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
                                                                                <label class="col-sm-4 form-control-label">Nro Vin</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" v-model="fillWOperativo.cnumerovin" class="form-control form-control-sm">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Estado</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-select v-model="fillWOperativo.nidestadowarrant" filterable clearable placeholder="SELECCIONE ESTADO" >
                                                                                        <el-option
                                                                                            v-for="item in arrayEstadoWarrant"
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
                                                                            <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarWOperativo()">
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
                                                                <template v-if="arrayWOperativo.length">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-striped table-sm">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Código</th>
                                                                                    <th>Proveedor</th>
                                                                                    <th>Moneda</th>
                                                                                    <th>Valor Total</th>
                                                                                    <!--<th>Total Comision Dolar</th>
                                                                                    <th>Total Comision Sol</th>-->
                                                                                    <th>Estado</th>
                                                                                    <th>Acciones</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="operativo in arrayWOperativo" :key="operativo.nIdWarrantOperativo">
                                                                                    <td v-text="operativo.nIdWarrantOperativo"></td>
                                                                                    <td v-text="operativo.cProveedorNombre"></td>
                                                                                    <td v-text="operativo.cSimboloMoneda"></td>
                                                                                    <td v-text="operativo.fValorTotal"></td>
                                                                                    <!--<td v-text="operativo.fTotalComisionDolar"></td>
                                                                                    <td v-text="operativo.fTotalComisionSol"></td>-->
                                                                                    <td v-text="operativo.cParNombre"></td>
                                                                                    <td>
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Ver Detalle {{ operativo.nIdWarrantOperativo }}</div>
                                                                                            <i @click="asignaIdWOperativo(operativo)" :style="'color:#796AEE'" class="fa-md fa fa-eye"></i>
                                                                                        </el-tooltip>
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
                                                                <h3 class="h4">DETALLE</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <form class="form-horizontal">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Nro VIN</label>
                                                                                <div class="col-sm-8">
                                                                                    <div class="input-group">
                                                                                        <input type="text" v-model="fillWOperativoDetalle.cnumerovin" @keyup.enter="listarDetalleWOperativo(1)" class="form-control form-control-sm">
                                                                                        <div class="input-group-prepend">
                                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                <div slot="content">Buscar Warrant </div>
                                                                                                <button type="button" class="btn btn-info btn-corner btn-sm" @click="listarDetalleWOperativo(1)">
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
                                                                                <label class="col-sm-4 form-control-label">Estado</label>
                                                                                <div class="col-sm-8">
                                                                                    <div class="input-group">
                                                                                        <el-select v-model="fillWOperativoDetalle.nidestadowarrant" filterable clearable placeholder="SELECCIONE" >
                                                                                            <el-option
                                                                                                v-for="item in arrayEstadoWarrant"
                                                                                                :key="item.nIdPar"
                                                                                                :label="item.cParNombre"
                                                                                                :value="item.nIdPar">
                                                                                            </el-option>
                                                                                        </el-select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9 offset-sm-5">
                                                                            <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarDetalleWOperativo(1)">
                                                                                <i class="fa fa-search"></i> Buscar
                                                                            </button>
                                                                            <button type="button" class="btn btn-secundary btn-corner btn-sm" @click="cambiarVistaFormulario()">
                                                                                <i class="fa fa-close"></i> Regresar
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
                                                                <template v-if="arrayWOperativoDetalle.length">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-striped table-sm">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Acciones</th>
                                                                                    <th>Código</th>
                                                                                    <th>Nombre Comercial</th>
                                                                                    <th>Año Modelo</th>
                                                                                    <th>Nro VIN</th>
                                                                                    <th>Moneda</th>
                                                                                    <th>Valor Warrant</th>
                                                                                    <th>DocNum Asiento</th>
                                                                                    <th>DocNum Comprob.</th>
                                                                                    <!--<th>Comisión Dolar</th>
                                                                                    <th>Comisión Sol</th>-->
                                                                                    <th>Estado</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="odetalle in arrayWOperativoDetalle" :key="odetalle.nIdDetalleWarrant">
                                                                                    <td>
                                                                                        <template v-if="odetalle.nIdEstadoWarrant==1300079">
                                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                <div slot="content">Cancelar {{ odetalle.nIdDetalleWarrant }}</div>
                                                                                                <i @click="cancelarWOperativoDetalle(odetalle)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                                            </el-tooltip>
                                                                                        </template>&nbsp;&nbsp;
                                                                                        <template v-if="odetalle.nValidaIntegracion==0">
                                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                <div slot="content">{{ odetalle.cFlagVistaIntegracion + ' ' + odetalle.cNumeroVin }}</div>
                                                                                                <i @click="validarSapWO(odetalle)" :style="'color:green'" class="fa-spin fa-md fa fa-cube"></i>
                                                                                            </el-tooltip>
                                                                                        </template>&nbsp;&nbsp;
                                                                                    </td>
                                                                                    <td v-text="odetalle.nIdDetalleWarrant"></td>
                                                                                    <td v-text="odetalle.cNombreComercial"></td>
                                                                                    <td v-text="odetalle.nAnioModelo"></td>
                                                                                    <td v-text="odetalle.cNumeroVin"></td>
                                                                                    <td v-text="odetalle.cSimboloMoneda"></td>
                                                                                    <td v-text="odetalle.fValorWarrant"></td>
                                                                                    <td v-text="odetalle.nDocNumAsiento"></td>
                                                                                    <td v-text="odetalle.nDocNumComprobante"></td>
                                                                                    <!--<td v-text="odetalle.fComisionDolar"></td>
                                                                                    <td v-text="odetalle.fComisionSol"></td>-->
                                                                                    <td v-text="odetalle.cParNombre"></td>
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
                                                                                            <a @click.prevent="cambiarPaginaDetalle(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                        </li>
                                                                                        <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                        :class="[page==isActived?'active':'']">
                                                                                            <a class="page-link"
                                                                                            href="#" @click.prevent="cambiarPaginaDetalle(page)"
                                                                                            v-text="page"></a>
                                                                                        </li>
                                                                                        <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                            <a @click.prevent="cambiarPaginaDetalle(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="TabGeneraWOperativo">
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
                                                                                <div class="input-group">
                                                                                    <input type="text" v-model="formWOperativo.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
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
                                                            <div class="col-sm-9">
                                                                <div class="row">
                                                                    <label class="col-sm-3 form-control-label">* Buscar Vehiculos</label>
                                                                    <div class="col-sm-6">
                                                                        <div class="input-group">
                                                                            <input type="text" value="VEHICULO MOTORIZADO" class="form-control form-control-sm" readonly>
                                                                            <div class="input-group-prepend">
                                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                    <div slot="content">Buscar Vehículos </div>
                                                                                    <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('vehiculos','buscar')">
                                                                                        <i class="fa-lg fa fa-search"></i>
                                                                                    </button>
                                                                                </el-tooltip>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <template v-if="arrayWarrant.length">
                                                                <div class="table-responsive border" style="max-height: 300px; max-width:1200px; overflow-y: auto; overflow-x: auto;-ms-overflow-style: -ms-autohiding-scrollbar;">
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Acciones</th>
                                                                                <th>Código</th>
                                                                                <th>Nro VIN</th>
                                                                                <th>Nombre Comercial</th>
                                                                                <th>Año Modelo</th>
                                                                                <th>Cod. Línea</th>
                                                                                <th>Línea</th>
                                                                                <th>Forma Pago</th>
                                                                                <th>Moneda</th>
                                                                                <th>Total</th>
                                                                                <th>Fecha Inicio Línea</th>
                                                                                <th>Fecha Venc. Línea</th>
                                                                                <th>Comis Dolar</th>
                                                                                <th>Comis Sol</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="(wo, index)  in arrayWarrant" :key="wo.nIdCompra">
                                                                                <td>
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Eliminar {{ wo.cNumeroVin }}</div>
                                                                                        <i @click="eliminaItemTempVehiculo(index)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                    </el-tooltip>
                                                                                </td>
                                                                                <td v-text="wo.nIdCompra"></td>
                                                                                <td v-text="wo.cNumeroVin"></td>
                                                                                <td v-text="wo.cNombreComercial"></td>
                                                                                <td v-text="wo.nAnioVersion"></td>
                                                                                <td v-text="wo.nIdLinea"></td>
                                                                                <td v-text="wo.cNombreLinea"></td>
                                                                                <td v-text="wo.cFormaPago"></td>
                                                                                <td v-text="wo.cSimboloMoneda"></td>
                                                                                <td v-text="wo.fTotalCompra"></td>
                                                                                <td>
                                                                                    <el-date-picker
                                                                                        v-model="wo.dFechaInicio"
                                                                                        type="date"
                                                                                        value-format="yyyy-MM-dd"
                                                                                        format="dd/MM/yyyy"
                                                                                        @change="cambiarFechaVence(wo)"
                                                                                        placeholder="dd/mm/aaaa">
                                                                                    </el-date-picker>
                                                                                </td>
                                                                                <td>
                                                                                    <el-date-picker
                                                                                        v-model="wo.dFechaFin"
                                                                                        type="date"
                                                                                        value-format="yyyy-MM-dd"
                                                                                        format="dd/MM/yyyy"
                                                                                        placeholder="dd/mm/aaaa">
                                                                                    </el-date-picker>
                                                                                </td>
                                                                                <td v-text="wo.fComisionDolar"></td>
                                                                                <td v-text="wo.fComisionSol"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="row">
                                                                        <div class="col-lg-7">
                                                                        </div>
                                                                        <div class="col-lg-5">
                                                                            <div class="datatable-info">Total: US$ <strong>{{ fTotalValor = totalVehiculo }}</strong></div>
                                                                            <div class="datatable-info">Total Comision Dolares: US$ <strong>{{ fTotalComisionDolar = totalComisionDolar }}</strong></div>
                                                                            <div class="datatable-info">Total Comision Soles: s./ <strong>{{ fTotalComisionSol = totalComisionSol }}</strong></div>
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
                                        </section>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="TabGeneraOS">
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
                                                                                <div class="input-group">
                                                                                    <input type="text" v-model="formWOperativo.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
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
                                                            <div class="col-sm-9">
                                                                <div class="row">
                                                                    <label class="col-sm-3 form-control-label">* Buscar Vehiculos</label>
                                                                    <div class="col-sm-6">
                                                                        <div class="input-group">
                                                                            <input type="text" value="VEHICULOS WARRANTEADOS" class="form-control form-control-sm" readonly>
                                                                            <div class="input-group-prepend">
                                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                    <div slot="content">Buscar Vehículos con Warrant Operativo</div>
                                                                                    <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('vehiculos','wo')">
                                                                                        <i class="fa-lg fa fa-search"></i>
                                                                                    </button>
                                                                                </el-tooltip>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <template v-if="arrayWarrant.length">
                                                                <div class="table-responsive border" style="max-height: 300px; max-width:1200px; overflow-y: auto; overflow-x: auto;-ms-overflow-style: -ms-autohiding-scrollbar;">
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Acciones</th>
                                                                                <th>Código SAP</th>
                                                                                <th>Código</th>
                                                                                <th>Nro VIN</th>
                                                                                <th>Nombre Comercial</th>
                                                                                <th>Año Modelo</th>
                                                                                <th>Cod. Línea</th>
                                                                                <th>Línea</th>
                                                                                <th>Forma Pago</th>
                                                                                <th>Moneda</th>
                                                                                <th>Total</th>
                                                                                <th>Comis Dolar</th>
                                                                                <th>Comis Sol</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="(wo, index)  in arrayWarrant" :key="wo.nIdCompra">
                                                                                <td>
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Eliminar {{ wo.cNumeroVin }}</div>
                                                                                        <i @click="eliminaItemTempVehiculo(index)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                    </el-tooltip>
                                                                                </td>
                                                                                <td v-text="wo.nDocEntry"></td>
                                                                                <td v-text="wo.nIdCompra"></td>
                                                                                <td v-text="wo.cNumeroVin"></td>
                                                                                <td v-text="wo.cNombreComercial"></td>
                                                                                <td v-text="wo.nAnioVersion"></td>
                                                                                <td v-text="wo.nIdLinea"></td>
                                                                                <td v-text="wo.cNombreLinea"></td>
                                                                                <td v-text="wo.cFormaPago"></td>
                                                                                <td v-text="wo.cSimboloMoneda"></td>
                                                                                <td v-text="wo.fTotalCompra"></td>
                                                                                <td v-text="wo.fComisionDolar"></td>
                                                                                <td v-text="wo.fComisionSol"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="row">
                                                                        <div class="col-lg-7">
                                                                        </div>
                                                                        <div class="col-lg-5">
                                                                            <div class="datatable-info">Total: US$ <strong>{{ fTotalValor = totalVehiculo }}</strong></div>
                                                                            <div class="datatable-info">Total Comision Dolares: US$ <strong>{{ fTotalComisionDolar = totalComisionDolar }}</strong></div>
                                                                            <div class="datatable-info">Total Comision Soles: s./ <strong>{{ fTotalComisionSol = totalComisionSol }}</strong></div>
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
                                                                <input type="text" v-model="fillProveedor.cnombreproveedor" @keyup.enter="listarProveedores(1)" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Buscar Proveedor </div>
                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="listarProveedores(1)">
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
                                                            <th>Código Sap</th>
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
                                                            <td v-text="proveedor.cParJerarquia"></td>
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

            <!-- MODAL VEHICULOS -->
            <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTADO</h3>
                                    </div>
                                    <div class="card-body">
                                        <form @submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Nro Vin</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillVersionVehiculo.cnumerovin" @keyup.enter="listarVersionVehiculo(1)" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Buscar Vehículos </div>
                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="listarVersionVehiculo(1)">
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
                                                        <label class="col-sm-4 form-control-label">Nombre Comercial</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillVersionVehiculo.cnombrecomercial" @keyup.enter="listarVersionVehiculo(1)" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Buscar Vehículos </div>
                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="listarVersionVehiculo(1)">
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
                                        <template v-if="arrayVersionVehiculo.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccione</th>
                                                            <th>NroDoc SAP</th>
                                                            <th>Nro VIN</th>
                                                            <th>Proveedor</th>
                                                            <th>Nombre Comercial</th>
                                                            <th>Año Modelo</th>
                                                            <th>Forma Pago</th>
                                                            <th>Moneda</th>
                                                            <th>Costo</th>
                                                            <th>Disponible</th>
                                                            <th>Sap Factura Res.</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="vehiculo in arrayVersionVehiculo" :key="vehiculo.nIdCompra">
                                                            <td>
                                                                <template v-if="vehiculo.nValidaIntegracion==0">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">{{ vehiculo.cFlagVistaIntegracion + ' ' + vehiculo.cNumeroVin }}</div>
                                                                        <i @click="validarSapFacturaReserva(vehiculo)" :style="'color:green'" class="fa-spin fa-md fa fa-cube"></i>
                                                                    </el-tooltip>
                                                                </template>
                                                                <template v-else>
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Agregar {{ vehiculo.cNumeroVin }}</div>
                                                                        <i @click="asignarVehiculo(vehiculo)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                    </el-tooltip>
                                                                </template>&nbsp;&nbsp;
                                                            </td>
                                                            <td v-text="vehiculo.nDocNumCompra"></td>
                                                            <td v-text="vehiculo.cNumeroVin"></td>
                                                            <td v-text="vehiculo.cNombreProveedor"></td>
                                                            <td v-text="vehiculo.cNombreComercial"></td>
                                                            <td v-text="vehiculo.nAnioVersion"></td>
                                                            <td v-text="vehiculo.cFormaPago"></td>
                                                            <td v-text="vehiculo.cSimboloMoneda"></td>
                                                            <td v-text="vehiculo.fTotalCompra"></td>
                                                            <td v-text="vehiculo.cFlagVehiculoLibre"></td>
                                                            <td v-text="vehiculo.nDocNumFacturaReserva"></td>
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
                                                                    <a @click.prevent="cambiarPaginaVehiculos(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaVehiculos(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaVehiculos(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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

            <!-- MODAL VEHICULOS CON WO SIN O/S-->
            <div class="modal fade" v-if="accionmodal==4" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTADO</h3>
                                    </div>
                                    <div class="card-body">
                                        <form @submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Nro Vin</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillVersionVehiculo.cnumerovin" @keyup.enter="listarVehiculosWoSinServicio(1)" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Buscar Vehículos </div>
                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="listarVehiculosWoSinServicio(1)">
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
                                                        <label class="col-sm-4 form-control-label">Nombre Comercial</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillVersionVehiculo.cnombrecomercial" @keyup.enter="listarVehiculosWoSinServicio(1)()" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Buscar Vehículos </div>
                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="listarVehiculosWoSinServicio(1)">
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
                                        <template v-if="arrayVehOS.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccione</th>
                                                            <th>Codigo SAP</th>
                                                            <th>Nro VIN</th>
                                                            <th>Proveedor</th>
                                                            <th>Nombre Comercial</th>
                                                            <th>Año Modelo</th>
                                                            <th>Forma Pago</th>
                                                            <th>Moneda</th>
                                                            <th>Costo</th>
                                                            <th>Comis Dolar</th>
                                                            <th>Comis Sol</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="vehiculo in arrayVehOS" :key="vehiculo.nIdCompra">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Agregar {{ vehiculo.cNumeroVin }}</div>
                                                                    <i @click="asignarVehOS(vehiculo)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>&nbsp;&nbsp;
                                                            </td>
                                                            <td v-text="vehiculo.nDocEntry"></td>
                                                            <td v-text="vehiculo.cNumeroVin"></td>
                                                            <td v-text="vehiculo.cNombreProveedor"></td>
                                                            <td v-text="vehiculo.cNombreComercial"></td>
                                                            <td v-text="vehiculo.nAnioVersion"></td>
                                                            <td v-text="vehiculo.cFormaPago"></td>
                                                            <td v-text="vehiculo.cSimboloMoneda"></td>
                                                            <td v-text="vehiculo.fTotalCompra"></td>
                                                            <td v-text="vehiculo.fComisionDolar"></td>
                                                            <td v-text="vehiculo.fComisionSol"></td>
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
                                                                    <a @click.prevent="cambiarPaginaVehiculos(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaVehiculos(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaVehiculos(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                ccustomercode: '',                
                //================ TAB BUSCAR WO ==============
                fillWOperativo:{
                    nidwarrantoperativo: 0,
                    nidestadowarrant: '',
                    cnrowarrant: '',
                    cnumerovin: ''
                },
                fillWOperativoDetalle:{
                    nidwarrantoperativo: 0,
                    cnumerovin: '',
                    nidestadowarrant: ''
                },
                arrayWOperativo: [],
                arrayWOperativoDetalle: [],
                arrayEstadoWarrant: [],
                //============= TAB GENERAR WO ===============
                formWOperativo:{
                    nidproveedor: 0,
                    cproveedornombre: '',
                    cnrowarrant: '',
                    dfechainicio: '',
                    dfechafin: '',
                    ccarcode: ''
                },
                arrayWarrant: [],
                arrayTemporal: [],
                fTotalValor: 0,
                fTotalComisionSol: 0,
                fTotalComisionDolar: 0,
                //============= TAB GENERAR O/S ================
                arrayVehOS: [],
                //=============== MODAL VEHICULOS ==============
                fillVersionVehiculo:{
                    cnumerovin: '',
                    cnombrecomercial: ''
                },
                arrayVersionVehiculo: [],
                //=============== MODAL PROVEEDOR ==============
                fillProveedor:{
                    cnombreproveedor: ''
                },
                arrayProveedor: [],
                //===========================================================
                // =============  VARIABLES SAP ========================
                arraySapRespuesta: [],
                jsonRespuesta: '',
                arraySapUpdSgc: [],
                arraySapCompra: [],
                arraySapActividad: [],
                arraySapSolucion: [],
                arraySapLlamadaServicio: [],
                arraySapItemCode: [],
                arraySapAsiento: [],
                arraySapWO: [],
                arraySapFacturaRserva: [],
                nSolutionCode:  0,
                //===========================================================
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
                accion: 0,
                modal:0,
                tituloModal:'',
                tituloFormulario: '',
                accionmodal: 0,
                error: 0,
                errors: [],
                mensajeError: [],
                vistaFormularioTabBuscar: 0
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
            },
            totalVehiculo: function(){
                let me = this;
                if(me.arrayWarrant.length > 0) {
                    return me.arrayWarrant.reduce(function(valorAnterior, valorActual){
                        return valorAnterior + parseFloat(valorActual.fTotalCompra);
                    }, 0);
                } else {
                    return 0;
                }
            },
            totalComisionDolar: function(){
                let me = this;
                if(me.arrayWarrant.length > 0) {
                    return me.arrayWarrant.reduce(function(valorAnterior, valorActual){
                        return valorAnterior + parseFloat(valorActual.fComisionDolar);
                    }, 0);
                } else {
                    return 0;
                }
            },
            totalComisionSol: function(){
                let me = this;
                if(me.arrayWarrant.length > 0) {
                    return me.arrayWarrant.reduce(function(valorAnterior, valorActual){
                        return valorAnterior + parseFloat(valorActual.fComisionSol);
                    }, 0);
                }else{
                    return 0;
                }
            },
        },
        mounted(){
            this.tabBuscarWOperativo();
        },
        methods:{
            listarProveedores(page){
                var url = this.ruta + '/parametro/GetLstProveedor';

                axios.get(url, {
                    params: {
                        'nidempresa'        : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidgrupopar'       : 110023,
                        'cnombreproveedor'  : this.fillProveedor.cnombreproveedor.toString(),
                        'npartipo'          : 1001,
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
            asignarProveedor(objProveedor){
                this.formWOperativo.nidproveedor = objProveedor.nIdPar;
                this.formWOperativo.cproveedornombre = objProveedor.cParNombre;
                this.formWOperativo.ccarcode = objProveedor.cParJerarquia;
                this.cerrarModal();
            },
            llenarComboEstadoWarrant(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid': 110043
                    }
                }).then(response => {
                    this.arrayEstadoWarrant = response.data;
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
            // =================================================================
            // METODOS TAB BUSCAR WARRANT OPERATIVO
            // =================================================================
            tabBuscarWOperativo(){
                this.vistaFormularioTabBuscar = 1;
                this.llenarComboEstadoWarrant();
                this.limpiarFormulario();
            },
            buscarWOperativo(){
                this.vistaFormularioTabBuscar = 1;
                this.listarWOperativo(1);
            },
            listarWOperativo(page){
                var url = this.ruta + '/woperativo/GetWOperativo';

                axios.get(url, {
                    params: {
                        'nidestadowarrant'  : this.fillWOperativo.nidestadowarrant,
                        'cnumerovin'        : this.fillWOperativo.cnumerovin,
                        'page'              : page
                    }
                }).then(response => {
                    this.arrayWOperativo = response.data.arrayWOperativo.data;
                    this.pagination.current_page =  response.data.arrayWOperativo.current_page;
                    this.pagination.total = response.data.arrayWOperativo.total;
                    this.pagination.per_page    = response.data.arrayWOperativo.per_page;
                    this.pagination.last_page   = response.data.arrayWOperativo.last_page;
                    this.pagination.from        = response.data.arrayWOperativo.from;
                    this.pagination.to           = response.data.arrayWOperativo.to;
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
                this.listarWOperativo(page);
            },
            cambiarVistaFormulario(){
                this.vistaFormularioTabBuscar = 1;
            },
            asignaIdWOperativo(objWO){
                this.vistaFormularioTabBuscar = 0;
                this.fillWOperativoDetalle.nidwarrantoperativo= objWO.nIdWarrantOperativo;
                this.listarDetalleWOperativo(1);
            },
            listarDetalleWOperativo(page){
                var url = this.ruta + '/woperativo/GetWOperativoDetalle';

                axios.get(url, {
                    params: {
                        'nidwarrantoperativo'   :   this.fillWOperativoDetalle.nidwarrantoperativo,
                        'cnumerovin'            :   this.fillWOperativoDetalle.cnumerovin,
                        'nidestadowarrant'      :   this.fillWOperativoDetalle.nidestadowarrant,
                        'page'                  :   page
                    }
                }).then(response => {
                    this.arrayWOperativoDetalle = response.data.arrayWOperativoDetalle.data;
                    this.pagination.current_page =  response.data.arrayWOperativoDetalle.current_page;
                    this.pagination.total = response.data.arrayWOperativoDetalle.total;
                    this.pagination.per_page    = response.data.arrayWOperativoDetalle.per_page;
                    this.pagination.last_page   = response.data.arrayWOperativoDetalle.last_page;
                    this.pagination.from        = response.data.arrayWOperativoDetalle.from;
                    this.pagination.to           = response.data.arrayWOperativoDetalle.to;
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
            cambiarPaginaDetalle(page){
                this.pagination.current_page=page;
                this.listarDetalleWOperativo(page);
            },
            cancelarWOperativoDetalle(objWarrant){
                swal({
                    title: 'Estas seguro de cancelar este warrant?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Activar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.value) {
                        var url = this.ruta + '/woperativo/UpdEstadoWoDetalle';
                        axios.post(url, {
                            'nIdDetalleWarrant' :   parseInt(objWarrant.nIdDetalleWarrant),
                            'nIdEstadoWarrant'  :   1300081,
                            'nIdCompra'         :   objWarrant.nIdCompra
                        }).then(response => {
                            if(response.data[0].nFlagMsje == 1){
                                swal(
                                    'Activado!',
                                    response.data[0].cMensaje
                                );
                                this.listarDetalleWOperativo(1);
                            } else {
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
                    } else if (result.dismiss === swal.DismissReason.cancel){}
                })
            },
            // =================================================================
            // METODOS TAB GENERAR WARRANT OPERATIVO
            // =================================================================
            tabGeneraWOperativo(){
                this.limpiarFormulario();
                this.listarProveedores(1);
                this.obtenerCodigoSapEmpresa();
            },
            obtenerCodigoSapEmpresa(){
                this.ccustomercode = sessionStorage.getItem("cCustomerCode");
            },
            cerrarModal(){
                this.modal = 0,
                this.error = 0,
                this.mensajeError = '',
                this.limpiarModal();
                
            },
            limpiarModal(){
                this.arrayVersionVehiculo = []
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
                    case 'vehiculos':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=3;
                                this.modal = 1;
                                break;
                            }break;
                            case 'wo':
                            {
                                this.accionmodal=4;
                                this.modal = 1;
                                break;
                            }break;
                        }
                    }
                }
            },
            listarVersionVehiculo(page){
                var url = this.ruta + '/compra/GetCompraSinWOperativo';

                axios.get(url, {
                    params: {
                        'nidempresa'        : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'       : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'cnumerovin'        : this.fillVersionVehiculo.cnumerovin,
                        'cnombrecomercial'  : this.fillVersionVehiculo.cnombrecomercial,
                        'page'              : page
                    }
                }).then(response => {
                    this.arrayVersionVehiculo           = response.data.arrayVersionVehiculo.data;
                    this.paginationModal.current_page   = response.data.arrayVersionVehiculo.current_page;
                    this.paginationModal.total          = response.data.arrayVersionVehiculo.total;
                    this.paginationModal.per_page       = response.data.arrayVersionVehiculo.per_page;
                    this.paginationModal.last_page      = response.data.arrayVersionVehiculo.last_page;
                    this.paginationModal.from           = response.data.arrayVersionVehiculo.from;
                    this.paginationModal.to             = response.data.arrayVersionVehiculo.to;
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
            cambiarPaginaVehiculos(page){
                this.paginationModal.current_page=page;
                this.listarVersionVehiculo(page);
            },
            asignarVehiculo(objCompra){
                let me = this;
                if(me.encuentra(objCompra)) {
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'El Vehículo seleccionado ya se encuentra agregado!',
                    })
                } else {
                    me.arrayWarrant.push({
                        'nIdCompra'         : objCompra.nIdCompra,
                        'cNumeroVin'        : objCompra.cNumeroVin,
                        'cNombreComercial'  : objCompra.cNombreComercial,
                        'nAnioVersion'      : objCompra.nAnioVersion,
                        'nIdLinea'          : objCompra.nIdLinea,
                        'cNombreLinea'      : objCompra.cNombreLinea,
                        'cFormaPago'        : objCompra.cFormaPago,
                        'cSimboloMoneda'    : objCompra.cSimboloMoneda,
                        'fTotalCompra'      : objCompra.fTotalCompra,
                        'fValorTipoCambio'  : objCompra.fValorTipoCambio,
                        'fComisionDolar'    : objCompra.fComisionDolar,
                        'fComisionSol'      : objCompra.fComisionSol,
                        'cCardCode'         : objCompra.cCardCode,
                        'fDocRate'          : objCompra.fDocRate,
                        'cSerieComprobante' : objCompra.cSerieComprobante,
                        'cNumeroComprobante': objCompra.cNumeroComprobante,
                        'dFechaInicio'      : moment().format('YYYY-MM-DD'),
                        'dFechaFin'         : moment().format('YYYY-MM-DD')
                    });
                    toastr.success('Se Agregó Vehículo ' + objCompra.cNumeroVin);
                    me.obtnerFechaVencimiento(objCompra);
                }
            },
            obtnerFechaVencimiento(objCompra){
                let me = this;

                var url = this.ruta + '/woperativo/GetFechaVenceByLinea';

                axios.get(url, {
                    params: {
                        'nidcompra'     : objCompra.nIdCompra,
                        'cnumerovin'    : objCompra.cNumeroVin,
                        'nidlinea'      : objCompra.nIdLinea,
                        'dfechainicio'  : objCompra.dFechaInicio ? objCompra.dFechaInicio : moment().format('YYYY-MM-DD')
                    }
                }).then(response => {
                    me.arrayWarrant.map(function(value, key){
                        if(value.cNumeroVin == response.data.arrayFechVenceWO[0].cNumeroVin){
                            me.arrayWarrant[key].dFechaFin = response.data.arrayFechVenceWO[0].dFechaVencimiento;
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
            eliminaItemTempVehiculo(index){
                this.$delete(this.arrayWarrant, index);
                toastr.success('Se Eliminó Item Vehículo');
            },
            encuentra(objCompra){
                var sw=0;
                for(var i=0;i<this.arrayWarrant.length;i++){
                    if(this.arrayWarrant[i].nIdCompra==objCompra.nIdCompra){
                        sw=true;
                    }
                }
                return sw;
            },
            cambiarFechaVence(objCompra){
                this.obtnerFechaVencimiento(objCompra);
            },
            //================= INTEGRA FACTURA DE RESERVA ==================
            validarSapFacturaReserva(objVehiculo){
                let me = this;
                me.arraySapFacturaRserva= [];
                me.arraySapFacturaRserva.push({
                    'nBaseEntry'    : objVehiculo.nBaseEntry,
                    'nBaseType'     : objVehiculo.nBaseType,
                    'cItemCode'     : objVehiculo.cItemCode
                });

                setTimeout(function() {
                    me.getSapFacturaReserva();
                }, 1200);
            },
            getSapFacturaReserva(){
                let me = this; 

                me.loadingProgressBar("VERIFICANDO FACTURA DE RESERVA CON SAP BUSINESS ONE...");
                var sapUrl = me.ruta + '/comprobante/SapGetComprobanteByTipo';
                axios.post(sapUrl, {
                    'data'  : me.arraySapFacturaRserva
                }).then(response => {
                    me.arraySapRespuesta = [];
                    me.arraySapUpdSgc = [];
                    let arrayFR = [];

                    me.arraySapRespuesta = response.data;
                    if(me.arraySapRespuesta.length){
                        me.arraySapRespuesta.map(function(value, key){
                            //Si la Factura de Reserva se encuentra ABIERTA
                            if(value.cDocStatus == 'O'){
                                me.arraySapUpdSgc.push({
                                    'cFlagTipo'         : "WO",
                                    'cTipoComprobante'  : "FR",
                                    'cItemCode'         : value.cItemCode,
                                    'nDocEntry'         : value.nDocEntry,
                                    'nDocNum'           : value.nDocNum,
                                    'cDocType'          : value.cDocType,
                                    'fDocRate'          : value.fDocRate,
                                    'cDocStatus'        : value.cDocStatus,
                                    'cLogRespuesta'     : ''
                                });

                                setTimeout(function() {
                                    me.registraSgcFacturaReserva();
                                }, 600);
                            }
                        });
                    }
                    else{
                        me.loading.close();
                        swal('No existe Factura de Reserva');
                    }
                }).catch(error => {
                    me.limpiarPorError("Error en la Integración Factura Reserva SapB1!");
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            registraSgcFacturaReserva(){
                let me = this;

                var sapUrl = me.ruta + '/comprobante/SetIntegraComprobanteWarrant';
                axios.post(sapUrl, {
                    'data'  : me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1){
                        me.listarVersionVehiculo(1);
                        me.loading.close();
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
            //==============================================================
            //================= INTEGRA WARRANT OPERATIVO ==================
            registrar(){
                let me = this;

                me.arrayTemporal = [];

                me.arrayWarrant.map(function(value, key){
                        me.arrayTemporal.push({
                            'nIdCompra'         : value.nIdCompra,
                            'cNumeroVin'        : value.cNumeroVin,
                            'fTotalCompra'      : value.fTotalCompra,
                            'fComisionDolar'    : value.fComisionDolar,
                            'fComisionSol'      : value.fComisionSol,
                            'fValorTipoCambio'  : value.fValorTipoCambio,
                            'cCardCode'         : value.cCardCode,
                            'fDocRate'          : value.fDocRate,
                            'cSerieComprobante' : value.cSerieComprobante,
                            'cNumeroComprobante': value.cNumeroComprobante,
                            'dFechaInicio'      : value.dFechaInicio,
                            'dFechaFin'         : value.dFechaFin
                        });
                });

                if(me.validar()){
                    me.accionmodal=1;
                    me.modal = 1;
                    return;
                }

                me.mostrarProgressBar();

                var url = me.ruta + '/woperativo/SetWOperativo';
                axios.post(url, {
                    'nIdProveedor'          : me.formWOperativo.nidproveedor,
                    'fTotalValor'           : me.fTotalValor,
                    'fTotalComisionDolar'   : me.fTotalComisionDolar,
                    'fTotalComisionSol'     : me.fTotalComisionSol,
                    'data'                  : me.arrayTemporal
                }).then(response => {
                    me.fillWOperativo.nidwarrantoperativo = response.data;

                    if(me.fillWOperativo.nidwarrantoperativo > 0){
                        me.arrayTemporal.map(function(value, key) {
                            me.arraySapAsiento.push({
                                'cCardCode'     : value.cCardCode,
                                'cNumeroVin'    : value.cNumeroVin,
                                'cProjectCode'  : value.cNumeroVin,
                                'fCredit'       : "0",
                                'fDebit'        : value.fTotalCompra,
                                'fCredit1'      : value.fTotalCompra,
                                'fDebit1'       : "0"
                            })
                        });

                        //==============================================================
                        //================== GENERAR ASIENTO CONTABLE SAP ===============
                        setTimeout(function() {
                            me.generaSapFacturaProveedor();
                        }, 800);
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
            //===== REGISTRO FACTURA PROVEEDOR =====
            generaSapFacturaProveedor(){
                let me = this;

                var sapUrl = me.ruta + '/comprobante/SapSetFacturaProveedorWO';
                axios.post(sapUrl, {
                    'cCardCode'     : me.formWOperativo.ccarcode,
                    'fDocDate'      : moment().format('YYYY-MM-DD'),
                    'data'          : me.arrayTemporal
                }).then(response => {
                    me.arraySapRespuesta= [];
                    me.arraySapUpdSgc= [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(x){
                        me.jsonRespuesta= JSON.parse(x);
                        //Verifico que devuelva DocEntry
                        if(me.jsonRespuesta.DocEntry){
                            me.arraySapUpdSgc.push({
                                'cFlagTipo'         :   "WO",
                                'cTipoComprobante'  :   "FP",
                                'cItemCode'         :   me.jsonRespuesta.DocumentLines[0].ProjectCode.toString(),
                                'nDocEntry'         :   parseInt(me.jsonRespuesta.DocEntry),
                                'nDocNum'           :   parseInt(me.jsonRespuesta.DocNum),
                                'cDocType'          :   me.jsonRespuesta.DocType.toString(),
                                'fDocRate'          :   parseFloat(me.jsonRespuesta.DocRate),
                                'cLogRespuesta'     :   response.data.toString()
                            });

                            me.arraySapActividad.push({
                                'dActivityDate' :   moment().format('YYYY-MM-DD'),//'2019-01-29'
                                'hActivityTime' :   '08:13:00',
                                'cCardCode'     :   me.ccustomercode,
                                'cNotes'        :   'WarranOperativo',
                                'nDocEntry'     :   me.jsonRespuesta.DocEntry.toString(),
                                'nDocNum'       :   me.jsonRespuesta.DocNum.toString(),
                                'nDocType'      :   '18',
                                'nDuration'     :   '15',
                                'cDurationType' :   'du_Minuts',
                                'dEndDueDate'   :   moment().format('YYYY-MM-DD'),//'2019-01-29'
                                'hEndTime'      :   '08:28:00',
                                'cReminder'     :   'tYES',
                                'nReminderPeriod':  '15',
                                'cReminderType' :   'du_Minuts',
                                'dStartDate'    :   moment().format('YYYY-MM-DD'),//'2019-01-29'
                                'hStartTime'    :   '08:13:00'
                            });
                            //==============================================================
                            //================== ACTUALIZAR DOCENTRY FACTURA ===============
                            setTimeout(function() {
                                me.registroSgcFacturaProveedor();
                            }, 800);
                        }
                    });
                }).catch(error => {
                    me.limpiarPorError("Error en la Integración de Factura Proveedor SapB1");
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            registroSgcFacturaProveedor(){
                let me = this;

                var sapUrl = me.ruta + '/comprobante/SetIntegraComprobanteWarrant';
                axios.post(sapUrl, {
                    'data'  : me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1){
                        setTimeout(function() {
                            me.registroSapBusinessActividad();
                        }, 800);
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
            registroSapBusinessActividad(){
                let me = this;

                var sapUrl = me.ruta + '/actividad/SapSetActividadCompra';
                axios.post(sapUrl, {
                    'data'       : me.arraySapActividad
                }).then(response => {
                    // ======================================================================
                    // GUARDAR ACTIVIDAD DE LA FACTURA DE PROVEEDORES EN SQL SERVER
                    // ======================================================================
                    me.arraySapRespuesta = [];
                    me.arraySapUpdSgc = [];

                    me.arraySapRespuesta = response.data;
                    if(me.arraySapRespuesta.length > 0) {
                        me.arraySapRespuesta.map(function(value, key){
                            me.jsonRespuesta = '';
                            me.jsonRespuesta= JSON.parse(value);
                            //Si el valor de respuesta Code tiene un valor
                            if(me.jsonRespuesta.ActivityCode){
                                me.arraySapUpdSgc.push({
                                    'nActividadTipo':   18,
                                    'cActividadTipo':   'WarranOperativo',
                                    'nActivityCode' :   parseInt(me.jsonRespuesta.ActivityCode),
                                    'cCardCode'     :   me.jsonRespuesta.CardCode.toString(),
                                    'nDocEntry'     :   parseInt(me.jsonRespuesta.DocEntry),
                                    'nDocNum'       :   parseInt(me.jsonRespuesta.DocNum),
                                    'cLogRespuesta' :   me.arraySapRespuesta[key].toString()
                                });
                            }
                        });
                    }

                    //================================================================
                    //=========== ACTUALIZO TABLA INTEGRACION ACTIVIDAD SGC ==========
                    setTimeout(function() {
                        me.registroSgcActividad();
                    }, 800);
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
                    }, 800);
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
                me.arraySapAsiento.map(function(value, key){
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
                                'cFlagTipo'     : 'WO',
                                'cLogRespuesta' : me.arraySapRespuesta[key].toString()
                            });

                            me.nSolutionCode = me.jsonRespuesta.SolutionCode;
                        }
                    });
                    //================================================================
                    //=========== ACTUALIZO TABLA INTEGRACION ACTIVIDAD SGC ==========
                    setTimeout(function() {
                        me.registroSgcSolucion();
                    }, 800);
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
                        me.getFacturaProveedorActividad();
                    }, 800);
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
            getFacturaProveedorActividad(){
                let me = this;
                me.arraySapSolucion.map(function(x, y){
                    var sapUrl = me.ruta + '/actividad/GetIntegraActividadWOByItemCode';
                    axios.get(sapUrl, {
                        params: {
                            'citemcode'     : x.cItemCode,
                            'nactividadtipo': 18
                        }
                    }).then(response => {
                        me.arraySapLlamadaServicio.push({
                            'nActivityCode'     : response.data[0].nActivityCode,
                            'cCustomerCode'     : response.data[0].cCustomerCode,
                            'cInternalSerialNum': response.data[0].cItemCode,
                            'cItemCode'         : response.data[0].cItemCode,
                            'nSolutionCode'     : response.data[0].nSolutionCode,
                            'cSubject'          : 'WOPERATIVO'
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
                });
                setTimeout(function() {
                    me.registroSapBusinessLlamadaServicio();
                }, 800);
            },
            registroSapBusinessLlamadaServicio(){
                let me = this;

                var sapUrl = me.ruta + '/llamadaservicio/SapSetLlamadaServicio';
                axios.post(sapUrl, {
                    'data': me.arraySapLlamadaServicio
                }).then(response => {
                    me.arraySapRespuesta = [];
                    me.arraySapUpdSgc = [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(value, key){
                        me.jsonRespuesta = '';
                        me.jsonRespuesta= JSON.parse(value);
                        //Si el valor de respuesta Code tiene un valor
                        if(me.jsonRespuesta.ItemCode){
                            me.arraySapUpdSgc.push({
                                'nServiceCallID'    : me.jsonRespuesta.ServiceCallID.toString(),
                                'cFlagTipo'         : 'WO',
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
                    }, 800);
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
                var sapUrl = me.ruta + '/llamadaservicio/SetIntegraLlamadaServicio';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    setTimeout(function() {
                        me.generaSapAsientoContable();
                    }, 800);
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
            //====== REGISTRO ASIENTO CONTABLE
            generaSapAsientoContable(){
                let me = this;
                me.loadingProgressBar("INTEGRANDO ASIENTO CONTABLE CON SAP BUSINESS ONE...");

                var url = me.ruta + '/asiento/SapSetAsientoContableWO';
                axios.post(url, {
                    'data' : me.arraySapAsiento
                }).then(response => {
                    me.arraySapRespuesta= [];
                    me.arraySapUpdSgc= [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(x){
                        me.jsonRespuesta = '';
                        me.jsonRespuesta= JSON.parse(x);
                        //Si el valor de respuesta Code tiene un valor
                        if(me.jsonRespuesta.ProjectCode){
                            me.arraySapUpdSgc.push({
                                'cProjectCode'  : me.jsonRespuesta.ProjectCode.toString(),
                                'nJdtNum'       : parseInt(me.jsonRespuesta.JdtNum),
                                'nNumber'       : parseInt(me.jsonRespuesta.Number),
                                'cTipo'         : 'WO',
                                'cLogRespuesta' : response.data.toString()
                            });
                        }
                    });
                    //==============================================================================
                    //================== ACTUALIZO TABLA INTEGRACION ASIENTO CONTABLE ===============
                    setTimeout(function() {
                        me.registroSgcAsientoContable();
                    }, 800);
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
            registroSgcAsientoContable(){
                let me = this;
                var sapUrl = me.ruta + '/woperativo/SetIntegraAsientoContableWO';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1) {
                        me.obtenerWOTblCosto();
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
            obtenerWOTblCosto(){
                let me = this;
                var url = me.ruta + '/tablacosto/GetWOComisionTblCosto';
                axios.post(url, {
                        'nIdEmpresa'    : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nIdSucursal'   : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'data'          : me.arraySapAsiento
                }).then(response => {
                    me.arraySapWO = [];
                    // ====================== CONCEPTO =========================
                    // ======================== COMISION WO ====================
                    let arrayCostoWO = response.data.array_infoWO;
                    arrayCostoWO.map(function (x) {
                        me.arraySapWO.push({
                            'U_SYP_VIN'           :   x.U_SYP_VIN,
                            'DocEntry'            :   x.DocEntry,
                            'U_SYP_CCONCEPTO'     :   x.U_SYP_CCONCEPTO,
                            'U_SYP_DCONCEPTO'     :   x.U_SYP_DCONCEPTO,
                            'U_SYP_CDOCUMENTO'    :   x.U_SYP_CDOCUMENTO,
                            'U_SYP_DDOCUMENTO'    :   x.U_SYP_DDOCUMENTO,
                            'U_SYP_IMPORTE'       :   x.U_SYP_IMPORTE,
                            'U_SYP_IMPORTE_USD'   :   x.U_SYP_IMPORTE_USD,
                            'U_SYP_COSTO'         :   x.U_SYP_COSTO,
                            'U_SYP_ESTADO'        :   x.U_SYP_ESTADO
                        });
                    });

                    setTimeout(function() {
                        me.registroSapBusinessTblCostoWO();
                    }, 800);
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
            registroSapBusinessTblCostoWO(){
                let me = this;
                me.loading.close();
                me.loadingProgressBar("INTEGRANDO COSTO WO CON SAP BUSINESS ONE...");

                var url = me.ruta + '/tablacosto/SapPachTablaCosto';
                axios.post(url, {
                    'data'  : me.arraySapWO
                }).then(response => {
                    me.confirmarWO();
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
            /*generaSapCompraWO(objCompra){
                let me = this;

                //==============================================================
                //================== REGISTRO COMPRA EN SAP ===============
                var sapUrl = me.ruta + '/compra/SapSetCompra';
                axios.post(sapUrl, {
                    'cCardCode'     : me.formCompra.ccarcode,
                    'fDocDate'      : moment().format('YYYY-MM-DD'),
                    'fDocDueDate'   : moment().add(30, 'days').format('YYYY-MM-DD'),
                    'WarehouseCode' : me.formAlmacen.cwhscode,
                    'Igv'           : 1 + parseFloat((me.formCompra.igv)),
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
                                'nDocEntry': parseInt(me.jsonRespuesta.DocEntry),
                                'nDocNum': parseInt(me.jsonRespuesta.DocNum),
                                'cDocType': me.jsonRespuesta.DocType.toString(),
                                'cLogRespuesta': response.data.toString(),
                                'cItemCode': me.jsonRespuesta.DocumentLines[0].ItemCode.toString()
                            });

                            //==============================================================
                            //================== ACTUALIZAR DOCENTRY ===============
                            setTimeout(function() {
                                me.generaActualizarDocEntryWO(objCompra);
                            }, 1200);
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
            },
            generaActualizarDocEntryWO(objCompra){
                let me = this;
                var sapUrl = me.ruta + '/compra/SetIntegraCompra';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {

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
            },*/
            confirmarWO(){
                let me = this;
                me.loading.close();
                $("#myBar").hide();
                swal('Warrant Operativo registrado');
                me.limpiarFormulario();
            },
            validar(){
                let me = this;
                me.error = 0;
                me.mensajeError =[];

                if(me.formWOperativo.nidproveedor == 0 || !me.formWOperativo.nidproveedor){
                    me.mensajeError.push('Debe seleecionar un Proveedor');
                };
                if(me.arrayTemporal.length > 0){
                    me.arrayTemporal.map(function(value, key){
                        if(!value.dFechaInicio){
                            me.mensajeError.push('Seleccione Fecha para ' + value.cNumeroVin);
                        }
                    });
                }
                if(me.mensajeError.length){
                    me.error = 1;
                }
                return me.error;
            },
            //===============================================================
            //=============== REGISTRO SAP INDIVIDUAL POR VIN ===============
            validarSapWO(objWO){
                this.mostrarProgressBar();

                let me = this;

                me.arrayTemporal = [];
                me.arrayTemporal.push({
                    'cNumeroVin'        : objWO.cNumeroVin,
                    'cProjectCode'      : objWO.cNumeroVin,
                    'fDocRate'          : objWO.fDocRate,
                    'fTotalCompra'      : objWO.fValorWarrant,
                    'cSerieComprobante' : objWO.cSerieComprobante,
                    'cNumeroComprobante': objWO.cNumeroComprobante
                });

                //Verifico Si existe Asiento
                if(objWO.nDocEntryComprobante==0){
                    //==============================================================
                    //================== REGISTRO ARTICULO EN SAP ===============
                    me.integraSapFacturaProveedor(objWO);
                }
                else{
                    //==============================================================
                    //================== REGISTRO COMPRA EN SAP ===============
                    me.integraSapBusinessActividad(objWO);
                }
            },            
            integraSapFacturaProveedor(objWO){
                let me = this;

                //Verifico Si existe Comprobante
                if(objWO.nDocEntryComprobante==0){

                    me.loadingProgressBar("INTEGRANDO FACTURA DE PROVEEDOR CON SAP BUSINESS ONE...");

                    //==============================================================
                    //================== REGISTRO ARTICULO EN SAP ===============
                    var sapUrl = me.ruta + '/comprobante/SapSetFacturaProveedorWO';
                    axios.post(sapUrl, {
                        'cCardCode'     : objWO.cCardCode,
                        'fDocDate'      : moment().format('YYYY-MM-DD'),
                        'data'          : me.arrayTemporal
                    }).then(response => {
                        me.arraySapRespuesta= [];
                        me.arraySapUpdSgc= [];

                        me.arraySapRespuesta = response.data;
                        me.arraySapRespuesta.map(function(x){
                            me.jsonRespuesta= JSON.parse(x);
                            //Verifico que devuelva DocEntry
                            if(me.jsonRespuesta.DocEntry){
                                me.arraySapUpdSgc.push({
                                    'cFlagTipo'         :   "WO",
                                    'cTipoComprobante'  :   'FP',
                                    'cItemCode'         :   me.jsonRespuesta.DocumentLines[0].ProjectCode.toString(),
                                    'nDocEntry'         :   parseInt(me.jsonRespuesta.DocEntry),
                                    'nDocNum'           :   parseInt(me.jsonRespuesta.DocNum),
                                    'cDocType'          :   me.jsonRespuesta.DocType.toString(),
                                    'cLogRespuesta'     :   response.data.toString()
                                });

                                me.arraySapActividad.push({
                                    'dActivityDate' :   moment().format('YYYY-MM-DD'),//'2019-01-29'
                                    'hActivityTime' :   '08:13:00',
                                    'cCardCode'     :   objWO.cCustomerCode,
                                    'cNotes'        :   'WarranOperativo',
                                    'nDocEntry'     :   me.jsonRespuesta.DocEntry.toString(),
                                    'nDocNum'       :   me.jsonRespuesta.DocNum.toString(),
                                    'nDocType'      :   '18',
                                    'nDuration'     :   '15',
                                    'cDurationType' :   'du_Minuts',
                                    'dEndDueDate'   :   moment().format('YYYY-MM-DD'),//'2019-01-29'
                                    'hEndTime'      :   '08:28:00',
                                    'cReminder'     :   'tYES',
                                    'nReminderPeriod':  '15',
                                    'cReminderType' :   'du_Minuts',
                                    'dStartDate'    :   moment().format('YYYY-MM-DD'),//'2019-01-29'
                                    'hStartTime'    :   '08:13:00'
                                });
                                //==============================================================
                                //================== ACTUALIZAR DOCENTRY FACTURA ===============
                                setTimeout(function() {
                                    me.actualizaSgcFacturaProveedor(objWO);
                                }, 3800);
                            }
                        });
                    }).catch(error => {
                        me.limpiarPorError("Error en la Integración de Factura Proveedor SapB1");
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
                        me.integraSapBusinessActividad(objWO);
                    }, 800);
                }
            },
            actualizaSgcFacturaProveedor(objWO){
                let me = this;

                var sapUrl = me.ruta + '/comprobante/SetIntegraComprobanteWarrant';
                axios.post(sapUrl, {
                    'data'  : me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1){
                        //===================================================
                        //============= REGISTRO ACTIVIDAD EN SAP ============
                        setTimeout(function() {
                                me.integraSapBusinessActividad(objWO);
                        }, 800);
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
            integraSapBusinessActividad(objWO){
                let me = this;

                //Verifico Si No existe Actividad
                if(objWO.nActivityCode==0)
                {
                    var sapUrl = me.ruta + '/actividad/SapSetActividadCompra';
                    axios.post(sapUrl, {
                        'data'  : me.arraySapActividad
                    }).then(response => {
                        // ======================================================================
                        // GUARDAR ACTIVIDAD DE LA FACTURA DE PROVEEDORES EN SQL SERVER
                        // ======================================================================
                        me.arraySapRespuesta = [];
                        me.arraySapUpdSgc = [];

                        me.arraySapRespuesta = response.data;
                        if(me.arraySapRespuesta.length > 0) {
                            me.arraySapRespuesta.map(function(value, key){
                                me.jsonRespuesta = '';
                                me.jsonRespuesta= JSON.parse(value);
                                //Si el valor de respuesta Code tiene un valor
                                if(me.jsonRespuesta.ActivityCode){
                                    me.arraySapUpdSgc.push({
                                        'nActividadTipo':   18,
                                        'cActividadTipo':   'WarranOperativo',
                                        'nActivityCode' :   parseInt(me.jsonRespuesta.ActivityCode),
                                        'cCardCode'     :   me.jsonRespuesta.CardCode.toString(),
                                        'nDocEntry'     :   parseInt(me.jsonRespuesta.DocEntry),
                                        'nDocNum'       :   parseInt(me.jsonRespuesta.DocNum),
                                        'cLogRespuesta' :   me.arraySapRespuesta[key].toString()
                                    });
                                }
                            });
                        }

                        //================================================================
                        //=========== ACTUALIZO TABLA INTEGRACION ACTIVIDAD SGC ==========
                        setTimeout(function() {
                            me.actualizaSgcActividad(objWO);
                        }, 800);
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
                    //===================================================
                    //============= REGISTRO SOLUCION EN SAP ============
                    setTimeout(function() {
                            me.integraSapBusinessSolucion(objWO);
                    }, 800);
                }
            },
            actualizaSgcActividad(objWO){
                let me = this;
                var sapUrl = me.ruta + '/actividad/SetIntegraActividadCompra';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    setTimeout(function() {
                        me.integraSapBusinessSolucion(objWO);
                    }, 800);
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
            integraSapBusinessSolucion(objWO){
                let me = this;

                if(objWO.nSolutionCode==0){
                    me.arraySapSolucion.push({
                        'cItemCode' : objWO.cNumeroVin,
                        'cSubject'  : "Cierre De Servicio"
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
                                    'cFlagTipo'     : 'WO',
                                    'cLogRespuesta' : me.arraySapRespuesta[key].toString()
                                });

                                me.nSolutionCode = me.jsonRespuesta.SolutionCode;
                            }
                        });
                        //================================================================
                        //=========== ACTUALIZO TABLA INTEGRACION ACTIVIDAD SGC ==========
                        setTimeout(function() {
                            me.actualizaSgcSolucion(objWO);
                        }, 800);
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
                        me.obtenerFacturaProveedorActividad(objWO);
                    }, 800);
                }
            },
            actualizaSgcSolucion(objWO){
                let me = this;
                var sapUrl = me.ruta + '/solucion/SetIntegraSolucion';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    setTimeout(function() {
                        me.obtenerFacturaProveedorActividad(objWO);
                    }, 800);
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
            obtenerFacturaProveedorActividad(objWO){
                let me = this;

                var sapUrl = me.ruta + '/actividad/GetIntegraActividadWOByItemCode';
                axios.get(sapUrl, {
                    params: {
                        'citemcode'     : objWO.cNumeroVin,
                        'nactividadtipo': 18
                    }
                }).then(response => {
                    me.arraySapLlamadaServicio.push({
                        'nActivityCode'     : response.data[0].nActivityCode,
                        'cCustomerCode'     : response.data[0].cCustomerCode,
                        'cInternalSerialNum': response.data[0].cItemCode,
                        'cItemCode'         : response.data[0].cItemCode,
                        'nSolutionCode'     : response.data[0].nSolutionCode,
                        'cSubject'          : 'WOPERATIVO'
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

                setTimeout(function() {
                    me.integraSapBusinessLlamadaServicio(objWO);
                }, 800);
            },
            integraSapBusinessLlamadaServicio(objWO){
                let me = this;

                //Validar que Solucion ya esta registrado
                if(objWO.nSolutionCode!=0){

                    me.loadingProgressBar("INTEGRANDO LLAMADA DE SERVICIO CON SAP BUSINESS ONE...");

                    me.arraySapLlamadaServicio = [];
                    me.arraySapLlamadaServicio.push({
                        'nActivityCode'     : objWO.nActivityCode,
                        'cCustomerCode'     : objWO.cCustomerCode,
                        'cInternalSerialNum': objWO.cNumeroVin,
                        'cItemCode'         : objWO.cNumeroVin,
                        'nSolutionCode'     : objWO.nSolutionCode,
                        'cSubject'          : objWO.cSubject
                    });
                }

                if(objWO.nServiceCallID==0){
                    var sapUrl = me.ruta + '/llamadaservicio/SapSetLlamadaServicio';
                    axios.post(sapUrl, {
                        'data': me.arraySapLlamadaServicio
                    }).then(response => {
                        me.arraySapRespuesta = [];
                        me.arraySapUpdSgc = [];

                        me.arraySapRespuesta = response.data;
                        me.arraySapRespuesta.map(function(value, key){
                            me.jsonRespuesta = '';
                            me.jsonRespuesta= JSON.parse(value);
                            //Si el valor de respuesta Code tiene un valor
                            if(me.jsonRespuesta.ItemCode){
                                me.arraySapUpdSgc.push({
                                    'nServiceCallID'    : me.jsonRespuesta.ServiceCallID.toString(),
                                    'cFlagTipo'         : 'WO',
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
                            me.actualizaSgcLlamadaServicio(objWO);
                        }, 800);
                    }).catch(error => {
                        console.log(error);
                        if (error.response) {
                            if (error.response.status == 401) {
                                swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                location.reload('0');
                            }
                        }
                    });
                }else{
                    setTimeout(function() {
                        me.integraSapAsientoContable(objWO);
                    }, 800);
                }
            },
            actualizaSgcLlamadaServicio(objWO){
                let me = this;
                var sapUrl = me.ruta + '/llamadaservicio/SetIntegraLlamadaServicio';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    setTimeout(function() {
                        me.integraSapAsientoContable(objWO);
                    }, 800);
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
            //========== Integra Asiento Contable ============
            integraSapAsientoContable(objWO){
                let me = this;

                if(objWO.nDocEntryAsiento==0){
                    me.loadingProgressBar("INTEGRANDO ASIENTO CONTABLE CON SAP BUSINESS ONE...");
                    me.arraySapAsiento = [];
                    me.arraySapAsiento.push({
                        'cCardCode'     : objWO.cCardCodeCompra,
                        'cNumeroVin'    : objWO.cNumeroVin,
                        'cProjectCode'  : objWO.cNumeroVin,
                        'fCredit'       : "0",
                        'fDebit'        : objWO.fValorWarrant,
                        'fCredit1'      : objWO.fValorWarrant,
                        'fDebit1'       : "0",
                        'fTotalCompra'  : objWO.fValorWarrant
                    });

                    var url = me.ruta + '/asiento/SapSetAsientoContableWO';
                    axios.post(url, {
                        'data' : me.arraySapAsiento
                    }).then(response => {
                        me.arraySapRespuesta = [];
                        me.arraySapUpdSgc = [];

                        me.arraySapRespuesta = response.data;
                        me.arraySapRespuesta.map(function(x){
                            me.jsonRespuesta = '';
                            me.jsonRespuesta= JSON.parse(x);
                            //Si el valor de respuesta Code tiene un valor
                            if(me.jsonRespuesta.ProjectCode){
                                me.arraySapUpdSgc.push({
                                    'cProjectCode'  : me.jsonRespuesta.ProjectCode.toString(),
                                    'nJdtNum'       : parseInt(me.jsonRespuesta.JdtNum),
                                    'nNumber'       : parseInt(me.jsonRespuesta.Number),
                                    'cTipo'         : 'WO',
                                    'cLogRespuesta' : response.data.toString()
                                });
                            }
                        });

                        //==============================================================================
                        //================== ACTUALIZO TABLA INTEGRACION ASIENTO CONTABLE ===============
                        setTimeout(function() {
                            me.actualizaSgcAsientoContable(objWO);
                        }, 1200);
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
                    me.confirmarWODetalle();
                }
            },
            actualizaSgcAsientoContable(objWO){
                let me = this;
                var sapUrl = me.ruta + '/woperativo/SetIntegraAsientoContableWO';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1) {
                        me.confirmarWODetalle();
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
            confirmarWODetalle(){
                let me = this;
                me.loading.close();
                $("#myBar").hide();
                swal('Warrant Operativo registrado');
                me.limpiarFormulario();
                me.listarDetalleWOperativo(1);
            },
            // =================================================================
            // METODOS TAB GENERAR WARRANT OPERATIVO
            // =================================================================
            tabGeneraOS(){
            },
            listarVehiculosWoSinServicio(page){
                  var url = this.ruta + '/woperativo/GetVehiculosWoSinOS';

                axios.get(url, {
                    params: {
                        'nidempresa'        : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'       : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'cnumerovin'        : this.fillVersionVehiculo.cnumerovin,
                        'cnombrecomercial'  : this.fillVersionVehiculo.cnombrecomercial,
                        'page'              : page
                    }
                }).then(response => {
                    this.arrayVehOS                     = response.data.arrayVehOS.data;
                    this.paginationModal.current_page   = response.data.arrayVehOS.current_page;
                    this.paginationModal.total          = response.data.arrayVehOS.total;
                    this.paginationModal.per_page       = response.data.arrayVehOS.per_page;
                    this.paginationModal.last_page      = response.data.arrayVehOS.last_page;
                    this.paginationModal.from           = response.data.arrayVehOS.from;
                    this.paginationModal.to             = response.data.arrayVehOS.to;
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
            generaOrdenServicio(){
                let me = this;

                me.arraySapCompra.push({
                    'AddressID'     : 'Dirección Fiscal',
                    'AddressName'   : '',
                    'Street'        : '',
                    'cUbigeo'       : ''
                });

                setTimeout(function() {
                    me.generaSapCompraWO();
                }, 800);
            },
            /*generaSapCompraWO(){
                let me = this;

                //==============================================================
                //================== REGISTRO COMPRA EN SAP ===============
                var sapUrl = me.ruta + '/compra/SapSetCompra';
                axios.post(sapUrl, {
                    'cCardCode'     : me.formCompra.ccarcode,
                    'fDocDate'      : moment().format('YYYY-MM-DD'),
                    'fDocDueDate'   : moment().add(30, 'days').format('YYYY-MM-DD'),
                    'WarehouseCode' : me.formAlmacen.cwhscode,
                    'Igv'           : 1 + parseFloat((me.formCompra.igv)),
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
                                'nDocEntry': parseInt(me.jsonRespuesta.DocEntry),
                                'nDocNum': parseInt(me.jsonRespuesta.DocNum),
                                'cDocType': me.jsonRespuesta.DocType.toString(),
                                'cLogRespuesta': response.data.toString(),
                                'cItemCode': me.jsonRespuesta.DocumentLines[0].ItemCode.toString()
                            });

                            //==============================================================
                            //================== ACTUALIZAR DOCENTRY ===============
                            setTimeout(function() {
                                me.generaActualizarDocEntryWO(objCompra);
                            }, 1200);
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
            },
            generaActualizarDocEntryWO(){
                let me = this;
                var sapUrl = me.ruta + '/compra/SetIntegraCompra';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {

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
            },*/
            //=================================================================
            limpiarFormulario(){
                this.fillWOperativo.nidwarrantoperativo= 0,
                this.fillWOperativo.nordencompra= '',
                this.fillWOperativo.cnumerovin=  '',
                this.formWOperativo.dfechainicio = '',
                this.formWOperativo.ccarcode= '',
                this.formWOperativo.nidproveedor= '',
                this.formWOperativo.cproveedornombre= '',
                this.formWOperativo.cnrowarrant= '',
                this.arrayWOperativo = [],
                this.arrayTemporal = [];
                this.limpiarPaginacion();

                //========= VARIABLES SAP =============
                //Limpiar variables Sap Articulo
                this.arraySapRespuesta= [],
                this.jsonRespuesta= '',
                this.arraySapUpdSgc= [],
                this.arraySapCompra= [],
                this.arraySapAsiento = [],
                this.arraySapActividad= [],
                this.arraySapSolucion= [],
                this.nSolutionCode=  0,
                this.arraySapLlamadaServicio= [],
                this.arraySapItemCode= [],
                this.arraySapWO= [],
                this.arraySapFacturaRserva= []
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
                this.listarWOperativo(1);
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
    .el-date-editor.el-input, .el-date-editor.el-input__inner{
        min-width: 150px;
    }
</style>
