<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">WARRANT FINANCIERO</h2>
                </div>
            </header>

            <section>
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#TabBuscaWFinanciero" @click="tabBuscarWFinanciero();" role="tab" data-toggle="tab">
                                            <i class="fa fa-search"></i> BUSCAR W. FINANCIERO
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#TabGeneraWFinanciero" @click="tabGeneraWFinanciero();" role="tab" data-toggle="tab">
                                            <i class="fa fa-file-text-o"></i> GENERAR W. FINANCIERO
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane fade in active show" id="TabBuscaWFinanciero">
                                        <template v-if="vistaFormularioTabBuscar">
                                            <section class="forms">
                                                <div class="container-fluid">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h3 class="h4">BUSCAR WARRANT FINANCIERO</h3>
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
                                                                                <label class="col-sm-4 form-control-label">Nro Warrant</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" v-model="fillWFinanciero.cnrowarrant" class="form-control form-control-sm">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Estado</label>
                                                                                <div class="col-sm-8">
                                                                                    <select v-model="fillWFinanciero.nidestadowarrant" class="form-control form-control-sm">
                                                                                        <option v-for="item in arrayEstadoWarrant" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9 offset-sm-4">
                                                                            <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarWFinanciero();">
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
                                                                <template v-if="arrayWFinanciero.length">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-striped table-sm">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Código</th>
                                                                                    <th>Nro Warrant</th>
                                                                                    <th>Banco</th>
                                                                                    <th>Fecha Registro</th>
                                                                                    <th>Fecha Venc.</th>
                                                                                    <th>Moneda</th>
                                                                                    <th>Valor Total</th>
                                                                                    <th>Estado</th>
                                                                                    <th>Acciones</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="operativo in arrayWFinanciero" :key="operativo.nIdWarrantFinanciero">
                                                                                    <td>{{ operativo.nIdWarrantFinanciero }}</td>
                                                                                    <td>{{ operativo.cNumeroWarrant }}</td>
                                                                                    <td>{{ operativo.BancoNombre }}</td>
                                                                                    <td>{{ operativo.dFechaInicioWarrant }}</td>
                                                                                    <td>{{ operativo.dFechaVencimientoWarrant }}</td>
                                                                                    <td>{{ operativo.cSimboloMoneda }}</td>
                                                                                    <td>{{ operativo.fValorTotal }}</td>
                                                                                    <td>{{ operativo.cParNombre }}</td>
                                                                                    <td>
                                                                                        <a href="#" @click="asignaIdWFinanciero(operativo);" data-toggle="tooltip" data-placement="top" :title="'Ver Detalle ' +operativo.nIdWarrantFinanciero">
                                                                                        <i class="fa-md fa fa-eye"></i></a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-7">
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
                                                                            <div class="col-lg-5">
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
                                                                <h3 class="h4">BUSCAR WARRANT FINANCIERO</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <form class="form-horizontal">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Nro VIN</label>
                                                                                <div class="col-sm-8">
                                                                                    <div class="input-group">
                                                                                        <input type="hidden" v-model="fillWFinancieroDetalle.nidwarrantfinanciero">
                                                                                        <input type="text" v-model="fillWFinancieroDetalle.cnumerovin" @keyup.enter="buscarWFinancieroDetalle()" class="form-control form-control-sm">
                                                                                        <span class="input-group-btn">
                                                                                            <button type="button" class="btn btn-info btn-corner btn-sm" @click="buscarWFinancieroDetalle();"><i class="fa-lg fa fa-search"></i></button>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Estado</label>
                                                                                <div class="col-sm-8">
                                                                                    <div class="input-group">
                                                                                        <select v-model="fillWFinancieroDetalle.nidestadowarrant" class="form-control form-control-sm">
                                                                                            <option v-for="item in arrayEstadoWarrant" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                                            </option>
                                                                                        </select>
                                                                                        <span class="input-group-btn">
                                                                                            <button type="button" class="btn btn-info btn-corner btn-sm" @click="buscarWFinancieroDetalle();"><i class="fa-lg fa fa-search"></i></button>
                                                                                        </span>
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
                                                                <template v-if="arrayWFinancieroDetalle.length">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-striped table-sm">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Código</th>
                                                                                    <th>O/C</th>
                                                                                    <th>Nombre Comercial</th>
                                                                                    <th>Nro VIN</th>
                                                                                    <th>Moneda</th>
                                                                                    <th>Valor Warrant</th>
                                                                                    <th>DocNum Asiento</th>
                                                                                    <th>DocNum Comprobante</th>
                                                                                    <th>Estado</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="odetalle in arrayWFinancieroDetalle" :key="odetalle.nIdDetalleWarrant">
                                                                                    <td v-text="odetalle.nIdDetalleWarrant"></td>
                                                                                    <td v-text="odetalle.nOrdenCompra"></td>
                                                                                    <td v-text="odetalle.cNombreComercial"></td>
                                                                                    <td v-text="odetalle.cNumeroVin"></td>
                                                                                    <td v-text="odetalle.cSimboloMoneda"></td>
                                                                                    <td v-text="odetalle.fValorWarrant"></td>
                                                                                    <td v-text="odetalle.nDocNumAsiento"></td>
                                                                                    <td v-text="odetalle.nDocNumComprobante"></td>
                                                                                    <td v-text="odetalle.cParNombre"></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-7">
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
                                                                            <div class="col-lg-5">
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
                                    <div role="tabpanel" class="tab-pane fade" id="TabGeneraWFinanciero">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">GENERAR WARRANT FINANCIERO</h3>
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
                                                                            <label class="col-sm-4 form-control-label">* Banco</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="text" v-model="formWFinanciero.cbanconombre" disabled="disabled" class="form-control form-control-sm">
                                                                                    <div class="input-group-prepend">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Buscar Banco </div>
                                                                                            <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('banco','buscar')">
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
                                                                            <label class="col-sm-4 form-control-label">Nro Warranat</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="formWFinanciero.cnrowarrant" class="form-control form-control-sm">
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
                                                            <template v-if="arrayTemporal.length">
                                                                <div class="table-responsive border" style="max-height: 300px; max-width:1200px; overflow-y: auto; overflow-x: auto;-ms-overflow-style: -ms-autohiding-scrollbar;">
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Acciones</th>
                                                                                <th>OC</th>
                                                                                <th>Nro VIN</th>
                                                                                <th>Nombre Comercial</th>
                                                                                <th>Moneda</th>
                                                                                <th>Total</th>
                                                                                <th>Nro Factura</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="(temporal, index)  in arrayTemporal" :key="temporal.nIdCompra">
                                                                                <td>
                                                                                    <a href="#" @click="eliminaItemTempVehiculo(index);" data-toggle="tooltip" data-placement="top" :title="'Eliminar ' +temporal.nIdCompra">
                                                                                    <i :style="'color:red'" class="fa-md fa fa-times-circle"></i></a>
                                                                                </td>
                                                                                <td v-text="temporal.nOrdenCompra"></td>
                                                                                <td v-text="temporal.cNumeroVin"></td>
                                                                                <td v-text="temporal.cNombreComercial"></td>
                                                                                <td v-text="temporal.cSimboloMoneda"></td>
                                                                                <td><input type="number" v-model="temporal.fTotalCompra" class="form-control form-control-sm"></td>
                                                                                <td v-text="temporal.cNumeroFactura"></td>
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

            <!-- Modal Buscar Vehiculos -->
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
                                            <form class="form-horizontal">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Nro Vin</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <input type="text" v-model="fillVersionVehiculo.cnumerovin" @keyup.enter="buscarVersionVehiculo()" class="form-control form-control-sm">
                                                                    <span class="input-group-btn">
                                                                        <button type="button" title="Buscar Vehículos" class="btn btn-info btn-corner btn-sm" @click="buscarVersionVehiculo();"><i class="fa-lg fa fa-search"></i></button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Nombre Comercial</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <input type="text" v-model="fillVersionVehiculo.cnombrecomercial" @keyup.enter="buscarVersionVehiculo()" class="form-control form-control-sm">
                                                                    <span class="input-group-btn">
                                                                        <button type="button" title="Buscar Vehículos" class="btn btn-info btn-corner btn-sm" @click="buscarVersionVehiculo();"><i class="fa-lg fa fa-search"></i></button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="card-body">
                                            <template v-if="arrayVersionVehiculo.length">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Seleccione</th>
                                                                <th>Nro VIN</th>
                                                                <th>Nombre Comercial</th>
                                                                <th>Año Fab.</th>
                                                                <th>Año Modelo</th>
                                                                <th>Moneda</th>
                                                                <th>Costo</th>
                                                                <th>Nro Factura</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="vehiculo in arrayVersionVehiculo" :key="vehiculo.nIdCompra">
                                                                <td>
                                                                    <a href="#" @click="asignarVehiculo(vehiculo)" :title="'Asignar Vehículo ' +vehiculo.cNumeroVin">
                                                                        <i class='fa-md fa fa-check-circle'></i>
                                                                    </a>
                                                                </td>
                                                                <td v-text="vehiculo.cNumeroVin"></td>
                                                                <td v-text="vehiculo.cNombreComercial"></td>
                                                                <td v-text="vehiculo.nAnioFabricacion"></td>
                                                                <td v-text="vehiculo.nAnioVersion"></td>
                                                                <td v-text="vehiculo.cSimboloMoneda"></td>
                                                                <td v-text="vehiculo.fTotalCompra"></td>
                                                                <td v-text="vehiculo.cNumeroFactura"></td>
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

            <!-- Modal Buscar Bancos -->
            <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTA DE BANCOS</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Nombre</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillProveedor.cnombreproveedor" @keyup.enter="listarBancos(1)" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Buscar Banco </div>
                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="listarBancos(1)">
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
                                        <template v-if="arrayBanco.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccione</th>
                                                            <th>Código Sap</th>
                                                            <th>Nombre Banco</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="banco in arrayBanco" :key="banco.nIdPar">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar {{ banco.cParNombre }}</div>
                                                                    <i @click="asignarBanco(banco)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td v-text="banco.cParJerarquia"></td>
                                                            <td v-text="banco.cParNombre"></td>
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
                                                                    <a @click.prevent="cambiarPaginaBanco(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaBanco(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaBanco(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                arrayBanco: [],
                arrayEstadoWarrant: [],
                arrayWFinanciero: [],
                arrayWFinancieroDetalle: [],
                arrayTemporal: [],
                arrayVersionVehiculo: [],
                fTotalValor: 0,
                fillWFinanciero:{
                    nidestadowarrant: 0,
                    cnrowarrant: ''
                },
                fillWFinancieroDetalle:{
                    nidwarrantfinanciero: 0,
                    cnumerovin: '',
                    nidestadowarrant: 0
                },
                formWFinanciero:{
                    nidwarrantfinanciero: 0,
                    nidbanco: 0,
                    cbanconombre: '',
                    cnrowarrant: '',
                    dfechainicio: '',
                    dfechafin: '',
                    ccarcode: ''
                },
                fillVersionVehiculo:{
                    cnumerovin: '',
                    cnombrecomercial: ''
                },
                arrayAsiento: [],
                fillProveedor:{
                    cnombreproveedor: ''
                },
                 //===========================================================
                // =============  VARIABLES SAP ========================
                arraySapRespuesta: [],
                jsonRespuesta: '',
                arraySapUpdSgc: [],
                arraySapWO: [],
                arraySapCompra: [],
                arraySapActividad: [],
                arraySapSolucion: [],
                nSolutionCode:  0,
                arraySapLlamadaServicio: [],
                arraySapItemCode: [],
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
                if(me.arrayTemporal.length > 0) {
                    return me.arrayTemporal.reduce(function(valorAnterior, valorActual){
                        return valorAnterior + parseFloat(valorActual.fTotalCompra);
                    }, 0);
                } else {
                    return 0;
                }
            },
        },
        mounted(){
            this.tabBuscarWFinanciero();
        },
        methods:{
            listarBancos(page){
                var url = this.ruta + '/parametro/GetListParametroByGrupo';

                axios.get(url, {
                    params: {
                        'ngrupoparid'   : 110042,
                        'cparnombre'    : this.fillProveedor.cnombreproveedor.toString(),
                        'opcion'        : 0,
                        'page'          : page
                    }
                }).then(response => {
                    this.arrayBanco = response.data.arrayParametro.data;
                    this.paginationModal.current_page =  response.data.arrayParametro.current_page;
                    this.paginationModal.total = response.data.arrayParametro.total;
                    this.paginationModal.per_page    = response.data.arrayParametro.per_page;
                    this.paginationModal.last_page   = response.data.arrayParametro.last_page;
                    this.paginationModal.from        = response.data.arrayParametro.from;
                    this.paginationModal.to           = response.data.arrayParametro.to;
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
            cambiarPaginaBanco(page){
                this.paginationModal.current_page=page;
                this.listarBancos(page);
            },
            asignarBanco(objBanco){
                this.formWFinanciero.nidbanco = objBanco.nIdPar;
                this.formWFinanciero.cbanconombre = objBanco.cParNombre;
                this.formWFinanciero.ccarcode = objBanco.cParJerarquia;
                this.cerrarModal();
            },
            llenarComboEstadoWarrant(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110043
                                                                                + '&opcion=' + 0;
                axios.get(url).then(response => {
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
            // METODOS TAB BUSCAR WARRANT FINANCIERO
            // =================================================================
            tabBuscarWFinanciero(){
                this.vistaFormularioTabBuscar = 1;
                this.llenarComboEstadoWarrant();
                this.limpiarFormulario();
            },
            buscarWFinanciero(){
                this.vistaFormularioTabBuscar = 1;
                this.listarWFinanciero(1);
            },
            listarWFinanciero(page){
                var url = this.ruta + '/wfinanciero/GetWFinanciero';

                axios.get(url, {
                    params: {
                        'nidestadowarrant'  : this.fillWFinanciero.nidestadowarrant,
                        'cnrowarrant'       : this.fillWFinanciero.cnrowarrant,
                        'page'              : page
                    }
                }).then(response => {
                    this.arrayWFinanciero = response.data.arrayWFinanciero.data;
                    this.pagination.current_page =  response.data.arrayWFinanciero.current_page;
                    this.pagination.total = response.data.arrayWFinanciero.total;
                    this.pagination.per_page    = response.data.arrayWFinanciero.per_page;
                    this.pagination.last_page   = response.data.arrayWFinanciero.last_page;
                    this.pagination.from        = response.data.arrayWFinanciero.from;
                    this.pagination.to           = response.data.arrayWFinanciero.to;
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
                this.listarWFinancieros(page);
            },
            asignaIdWFinanciero(objWF){
                this.fillWFinancieroDetalle.nidwarrantfinanciero= objWF.nIdWarrantFinanciero;
                this.buscarWFinancieroDetalle();
            },
            buscarWFinancieroDetalle(){
                this.listarDetalleWFinanciero(1);
            },
            listarDetalleWFinanciero(page){
                this.vistaFormularioTabBuscar = 0;
                var url = this.ruta + '/wfinanciero/GetWFinancieroDetalle';

                axios.get(url, {
                    params: {
                        'nidwarrantfinanciero': this.fillWFinancieroDetalle.nidwarrantfinanciero,
                        'cnumerovin': this.fillWFinancieroDetalle.cnumerovin,
                        'nidestadowarrant': this.fillWFinancieroDetalle.nidestadowarrant,
                        'page': page
                    }
                }).then(response => {
                    this.arrayWFinancieroDetalle = response.data.arrayWFinancieroDetalle.data;
                    this.pagination.current_page =  response.data.arrayWFinancieroDetalle.current_page;
                    this.pagination.total = response.data.arrayWFinancieroDetalle.total;
                    this.pagination.per_page    = response.data.arrayWFinancieroDetalle.per_page;
                    this.pagination.last_page   = response.data.arrayWFinancieroDetalle.last_page;
                    this.pagination.from        = response.data.arrayWFinancieroDetalle.from;
                    this.pagination.to           = response.data.arrayWFinancieroDetalle.to;
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
                this.listarDetalleWFinanciero(page);
            },
            // =================================================================
            // METODOS TAB GENERAR WARRANT FINANCIERO
            // =================================================================
            tabGeneraWFinanciero(){
                this.limpiarFormulario();
                this.obtenerCodigoSapEmpresa();
            },
            obtenerCodigoSapEmpresa(){
                this.ccustomercode = sessionStorage.getItem("cCustomerCode");
            },
            cerrarModal(){
                this.modal = 0,
                this.error = 0,
                this.mensajeError = ''
            },
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case 'vehiculos':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=2;
                                this.modal = 1;
                                this.listarVersionVehiculo(1);
                                break;
                            }
                        }
                    }
                    break;
                    case 'banco':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=3;
                                this.modal = 1;
                                this.listarBancos(1);
                                break;
                            }
                        }
                    }
                    break;
                }
            },
            buscarVersionVehiculo(){
                this.listarVersionVehiculo(1);
            },
            listarVersionVehiculo(page){
                var url = this.ruta + '/compra/GetCompraSinWFinanciero';

                axios.get(url, {
                    params: {
                        'nidempresa'        : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'       : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'cnumerovin'        : this.fillVersionVehiculo.cnumerovin,
                        'cnombrecomercial'  : this.fillVersionVehiculo.cnombrecomercial,
                        'page'              : page
                    }
                }).then(response => {
                    this.arrayVersionVehiculo = response.data.arrayVersionVehiculo.data;
                    this.paginationModal.current_page =  response.data.arrayVersionVehiculo.current_page;
                    this.paginationModal.total = response.data.arrayVersionVehiculo.total;
                    this.paginationModal.per_page    = response.data.arrayVersionVehiculo.per_page;
                    this.paginationModal.last_page   = response.data.arrayVersionVehiculo.last_page;
                    this.paginationModal.from        = response.data.arrayVersionVehiculo.from;
                    this.paginationModal.to           = response.data.arrayVersionVehiculo.to;
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
            asignarVehiculo(data){
                if(this.encuentra(data.nIdCompra)) {
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'El Vehículo seleccionado ya se encuentra agregado!',
                    })
                } else {
                    this.arrayTemporal.push(data);
                    toastr.success('Se Agregó Vehículo');
                }
            },
            eliminaItemTempVehiculo(index){
                this.$delete(this.arrayTemporal, index);
                toastr.success('Se Eliminó Item Vehículo');
            },
            encuentra(nIdCompra){
                var sw=0;
                for(var i=0;i<this.arrayTemporal.length;i++){
                    if(this.arrayTemporal[i].nIdCompra==nIdCompra){
                        sw=true;
                    }
                }
                return sw;
            },
            registrar(){
                let me = this;

                if(me.validar()){
                    me.accionmodal=1;
                    me.modal = 1;
                    return;
                }

                me.mostrarProgressBar();
                var url = me.ruta + '/wfinanciero/SetWFinanciero';
                axios.post(url, {
                    'nIdBanco'      : me.formWFinanciero.nidbanco,
                    'cNumeroWarrant': me.formWFinanciero.cnrowarrant,
                    'fTotalValor'   : me.fTotalValor,
                    'data'          : me.arrayTemporal
                }).then(response => {
                    me.fillWFinanciero.nidwarrantfinanciero = response.data;

                    if(me.fillWFinanciero.nidwarrantfinanciero > 0){
                        me.arrayTemporal.map(function(value, key) {
                            me.arrayAsiento.push({
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
                            me.generaSapAsientoContable();
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
            generaSapAsientoContable(){
                let me = this;
                me.loadingProgressBar("INTEGRANDO ASIENTO CONTABLE CON SAP BUSINESS ONE...");

                var url = me.ruta + '/asiento/SapSetAsientoContableWF';
                axios.post(url, {
                    'data' : me.arrayAsiento
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
                                'cTipo'         : 'WF',
                                'cLogRespuesta' : response.data.toString()
                            });
                        }
                    });

                    //==============================================================================
                    //================== ACTUALIZO TABLA INTEGRACION ASIENTO CONTABLE ===============
                    setTimeout(function() {
                        me.registroSgcAsientoContable();
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
            registroSgcAsientoContable(){
                let me = this;
                var sapUrl = me.ruta + '/wfinaciero/SetIntegraAsientoContableWF';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1) {
                         setTimeout(function() {
                            me.generaSapFacturaProveedor();
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
            generaSapFacturaProveedor(){
                let me = this;

                var sapUrl = me.ruta + '/comprobante/SapSetFacturaProveedorWF';
                axios.post(sapUrl, {
                    'cCardCode' : me.formWFinanciero.ccarcode, //CODIGO FORUM
                    'fDocDate'  : moment().format('YYYY-MM-DD'),
                    'data'      : me.arrayTemporal
                }).then(response => {
                    me.arraySapRespuesta= [];
                    me.arraySapUpdSgc= [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(x){
                        me.jsonRespuesta= JSON.parse(x);
                        //Verifico que devuelva DocEntry
                        if(me.jsonRespuesta.DocEntry){
                            me.arraySapUpdSgc.push({
                                'cFlagTipo'         :   "FP",
                                'cTipo'             :   'WF',
                                'cItemCode'         :   me.jsonRespuesta.DocumentLines[0].ProjectCode.toString(),
                                'nDocEntry'         :   parseInt(me.jsonRespuesta.DocEntry),
                                'nDocNum'           :   parseInt(me.jsonRespuesta.DocNum),
                                'cDocType'          :   me.jsonRespuesta.DocType.toString(),
                                'cLogRespuesta'     :   response.data.toString()
                            });

                            me.arraySapActividad.push({
                                'dActivityDate' :   moment().format('YYYY-MM-DD'),//'2019-01-29'
                                'hActivityTime' :   '08:13:00',
                                'cCardCode'     :   me.ccustomercode,
                                'cNotes'        :   'WarranFinanciero',
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
            },
            registroSgcFacturaProveedor(){
                let me = this;

                var sapUrl = me.ruta + '/comprobante/SetIntegraComprobanteWO';
                axios.post(sapUrl, {
                    'data'  : me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1){
                        me.registroSapBusinessActividad();
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
                                    'cActividadTipo':   'WarranFinanciero',
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
                        // me.confirmarWF();
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
                me.arrayAsiento.map(function(value, key){
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
                                'cFlagTipo'     : 'WF',
                                'cLogRespuesta' : me.arraySapRespuesta[key].toString()
                            });

                            me.nSolutionCode = me.jsonRespuesta.SolutionCode;
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
                        me.getFacturaProveedorActividad();
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
            getFacturaProveedorActividad(){
                let me = this;
                me.arraySapSolucion.map(function(x, y){
                    var sapUrl = me.ruta + '/actividad/GetIntegraActividadWFByItemCode';
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
                            'cSubject'          : 'FACTURA PROVEEDOR'
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
                }, 1600);
            },
            registroSapBusinessLlamadaServicio(){
                let me = this;

                var sapUrl = me.ruta + '/llamadaservicio/SapSetLlamadaServicioCompra';
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
                                'cFlagTipo'         : 'F',
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
                        me.confirmarWF();
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
            confirmarWF(){
                let me = this;
                me.loading.close();
                $("#myBar").hide();
                swal('Warrant Financiero registrado');
                me.limpiarFormulario();
            },
            validar(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formWFinanciero.nidbanco == 0){
                    this.mensajeError.push('Debes Seleccionar un Banco');
                };
                if(!this.formWFinanciero.ccarcode){
                    this.mensajeError.push('Debes Seleccionar un Banco con Código SAP');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            limpiarFormulario(){
                this.fillWFinanciero.nidwarrantfinanciero= 0,
                this.fillWFinanciero.nordencompra= '',
                this.fillWFinanciero.cnumerovin=  '',
                this.formWFinanciero.ccarcode= '',
                this.formWFinanciero.nidbanco= '',
                this.formWFinanciero.cbanconombre= '',
                this.formWFinanciero.cnrowarrant= '',
                this.arrayWFinanciero = [],
                this.arrayTemporal= [],
                this.limpiarPaginacion();

                //========= VARIABLES SAP =============
                //Limpiar variables Sap Articulo
                this.arraySapRespuesta= [],
                this.jsonRespuesta= '',
                this.arraySapUpdSgc= [],
                this.arraySapWO= [],
                this.arraySapCompra= [],
                this.arrayAsiento = []
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
                this.listarWFinanciero(1);
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
