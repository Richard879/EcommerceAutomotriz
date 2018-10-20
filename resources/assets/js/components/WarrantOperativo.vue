<template>
    <main>
        <header class="page-header">
            <div class="container-fluid">
                <h2 class="no-margin-bottom">WARRANT OPERATIVO</h2>
            </div>
        </header>

        <section>
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#TabBuscaWOperativo" @click="tabBuscarWOperativo();" role="tab" data-toggle="tab">
                                        <i class="fa fa-search"></i> BUSCAR W. OPERATIVO
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#TabGeneraWOperativo" @click="tabGeneraWOperativo();" role="tab" data-toggle="tab">
                                        <i class="fa fa-file-text-o"></i> GENERAR W. OPERATIVO
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
                                                                            <label class="col-sm-4 form-control-label">Nro Warrant</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillWOperativo.cnrowarrant" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Estado</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="fillWOperativo.nidestadowarrant" filterable clearable placeholder="SELECCIONE" >
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
                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarWOperativo();"><i class="fa fa-search"></i> Buscar</button>
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
                                                                                <th>Nro Warrant</th>
                                                                                <th>Proveedor</th>
                                                                                <th>Fecha Registro</th>
                                                                                <th>Fecha Venc.</th>
                                                                                <th>Moneda</th>
                                                                                <th>Valor Total</th>
                                                                                <th>Estado</th>
                                                                                <th>Acciones</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="operativo in arrayWOperativo" :key="operativo.nIdWarrantOperativo">
                                                                                <td>{{ operativo.nIdWarrantOperativo }}</td>
                                                                                <td>{{ operativo.cNumeroWarrant }}</td>
                                                                                <td>{{ operativo.cProveedorNombre }}</td>
                                                                                <td>{{ operativo.dFechaInicioWarrant }}</td>
                                                                                <td>{{ operativo.dFechaVencimientoWarrant }}</td>
                                                                                <td>{{ operativo.cSimboloMoneda }}</td>
                                                                                <td>{{ operativo.fValorTotal }}</td>
                                                                                <td>{{ operativo.cParNombre }}</td>
                                                                                <td>
                                                                                    <a href="#" @click="asignaIdWOperativo(operativo.nIdWarrantOperativo);" data-toggle="tooltip" data-placement="top" :title="'Ver Detalle ' +operativo.nIdWarrantOperativo">
                                                                                    <i class="fa-md fa fa-eye"></i></a>
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
                                                            <h3 class="h4">BUSCAR WARRANT OPERATIVO</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Nro VIN</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="text" v-model="fillWOperativoDetalle.cnumerovin" @keyup.enter="buscarWOperativoDetalle" class="form-control form-control-sm">
                                                                                    <div class="input-group-prepend">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Buscar Warrant </div>
                                                                                            <button type="button" class="btn btn-info btn-corner btn-sm" @click="buscarWOperativoDetalle">
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
                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarWOperativoDetalle()"><i class="fa fa-search"></i> Buscar</button>
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
                                                                                <th>Código</th>
                                                                                <th>O/C</th>
                                                                                <th>Nombre Comercial</th>
                                                                                <th>Nro VIN</th>
                                                                                <th>Moneda</th>
                                                                                <th>Valor Warrant</th>
                                                                                <th>Estado</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="odetalle in arrayWOperativoDetalle" :key="odetalle.nIdDetalleWarrant">
                                                                                <td>{{ odetalle.nIdDetalleWarrant }}</td>
                                                                                <td>{{ odetalle.nOrdenCompra }}</td>
                                                                                <td>{{ odetalle.cNombreComercial }}</td>
                                                                                <td>{{ odetalle.cNumeroVin }}</td>
                                                                                <td>{{ odetalle.cSimboloMoneda }}</td>
                                                                                <td>{{ odetalle.fValorWarrant }}</td>
                                                                                <td>{{ odetalle.cParNombre }}</td>
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
                                                                            <el-select v-model="formWOperativo.nidbanco" filterable clearable placeholder="SELECCIONE" >
                                                                                <el-option
                                                                                v-for="item in arrayBanco"
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
                                                                        <label class="col-sm-4 form-control-label">Nro Warranat</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="formWOperativo.cnrowarrant" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Fecha Registro</label>
                                                                        <div class="col-sm-8">
                                                                            <el-date-picker
                                                                                v-model="formWOperativo.dfechainicio"
                                                                                type="date"
                                                                                value-format="yyyy-MM-dd"
                                                                                format="dd/MM/yyyy"
                                                                                placeholder="dd/mm/aaaa">
                                                                            </el-date-picker>
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
                                                                            <th>Año Fab.</th>
                                                                            <th>Año Modelo</th>
                                                                            <th>Forma Pago</th>
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
                                                                            <td>{{ temporal.nOrdenCompra }}</td>
                                                                            <td>{{ temporal.cNumeroVin }}</td>
                                                                            <td>{{ temporal.cNombreComercial }}</td>
                                                                            <td>{{ temporal.nAnioFabricacion }}</td>
                                                                            <td>{{ temporal.nAnioVersion }}</td>
                                                                            <td>{{ temporal.cFormaPago }}</td>
                                                                            <td>{{ temporal.cSimboloMoneda }}</td>
                                                                            <td>{{ temporal.fTotalCompra }}</td>
                                                                            <td>{{ temporal.cNumeroFactura }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-lg-7">
                                                                    </div>
                                                                    <div class="col-lg-5">
                                                                        <div class="datatable-info">Valor Total: USD <strong>{{ fTotalWarrant }}</strong></div>
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
                                                    <label class="col-sm-4 form-control-label">Nro Vin</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" v-model="fillVersionVehiculo.cnumerovin" @keyup.enter="buscarVersionVehiculo()" class="form-control form-control-sm">
                                                            <div class="input-group-prepend">
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Buscar Vehículos </div>
                                                                    <button type="button" class="btn btn-info btn-corner btn-sm" @click="buscarVersionVehiculo">
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
                                                            <input type="text" v-model="fillVersionVehiculo.cnombrecomercial" @keyup.enter="buscarVersionVehiculo()" class="form-control form-control-sm">
                                                            <div class="input-group-prepend">
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Buscar Vehículos </div>
                                                                    <button type="button" class="btn btn-info btn-corner btn-sm" @click="buscarVersionVehiculo">
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
                                                        <th>Nro VIN</th>
                                                        <th>Nombre Comercial</th>
                                                        <th>Año Fab.</th>
                                                        <th>Año Modelo</th>
                                                        <th>Forma Pago</th>
                                                        <th>Moneda</th>
                                                        <th>Costo</th>
                                                        <th>Nro Factura</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="vehiculo in arrayVersionVehiculo" :key="vehiculo.nIdCompra">
                                                        <td>
                                                            <a href="#" @click="asignarVehiculo(vehiculo)">
                                                                <i class='fa-md fa fa-check-circle'></i>
                                                            </a>
                                                        </td>
                                                        <td>{{vehiculo.cNumeroVin}}</td>
                                                        <td>{{vehiculo.cNombreComercial}}</td>
                                                        <td>{{vehiculo.nAnioFabricacion}}</td>
                                                        <td>{{vehiculo.nAnioVersion}}</td>
                                                        <td>{{vehiculo.cFormaPago}}</td>
                                                        <td>{{vehiculo.cSimboloMoneda}}</td>
                                                        <td>{{vehiculo.fTotalCompra}}</td>
                                                        <td>{{vehiculo.cNumeroFactura}}</td>
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
</template>
<script>
    export default {
        props:['ruta'],
        data(){
            return {
                cempresa: 'SAISAC',
                csucursal: sessionStorage.getItem("cNombreSucursal"),
                canio: '2018',
                cmes: 'MAYO',
                nidempresa: 0,
                nidsucursal: 0,
                arrayBanco: [],
                arrayEstadoWarrant: [],
                arrayWOperativo: [],
                arrayWOperativoDetalle: [],
                arrayTemporal: [],
                arrayVersionVehiculo: [],
                arrayCompra: [],
                fTotalWarrant: 0,
                fillWOperativo:{
                    nidestadowarrant: '',
                    cnrowarrant: ''
                },
                fillWOperativoDetalle:{
                    nidwarrantoperativo: 0,
                    cnumerovin: '',
                    nidestadowarrant: ''
                },
                formWOperativo:{
                    nidbanco: '',
                    cnrowarrant: '',
                    dfechainicio: '',
                    dfechafin: ''
                },
                fillVersionVehiculo:{
                    cnumerovin: '',
                    cnombrecomercial: ''
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
            }
        },
        methods:{
            llenarComboProvFinanciero(){
                var url = this.ruta + '/parametro/GetLstProveedor';

                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidgrupopar' : 110094,
                        'cnombreproveedor' : ''
                    }
                }).then(response => {
                    this.arrayBanco = response.data.arrayProveedor;
                }).catch(error => {
                    console.log(error);
                });
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
                });
            },
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
                var url = this.ruta + '/woperativo/GetWOperativo?nidestadowarrant=' + this.fillWOperativo.nidestadowarrant
                                                                + '&cnrowarrant=' + this.fillWOperativo.cnrowarrant
                                                                + '&page='+ page;
                axios.get(url).then(response => {
                    this.arrayWOperativo = response.data.arrayWOperativo.data;
                    this.pagination.current_page =  response.data.arrayWOperativo.current_page;
                    this.pagination.total = response.data.arrayWOperativo.total;
                    this.pagination.per_page    = response.data.arrayWOperativo.per_page;
                    this.pagination.last_page   = response.data.arrayWOperativo.last_page;
                    this.pagination.from        = response.data.arrayWOperativo.from;
                    this.pagination.to           = response.data.arrayWOperativo.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarWOperativos(page);
            },
            asignaIdWOperativo(nIdWarrantOperativo){
                this.fillWOperativoDetalle.nidwarrantoperativo= nIdWarrantOperativo;
                this.buscarWOperativoDetalle();
            },
            buscarWOperativoDetalle(){
                this.listarDetalleWOperativo(this.fillWOperativoDetalle.nidwarrantoperativo, 1);
            },
            listarDetalleWOperativo(nIdWarrantOperativo, page){
                this.vistaFormularioTabBuscar = 0;
                var url = this.ruta + '/woperativo/GetWOperativoDetalle?nidwarrantoperativo=' + nIdWarrantOperativo
                                                                    + '&cnumerovin=' + this.fillWOperativoDetalle.cnumerovin
                                                                    + '&nidestadowarrant=' + this.fillWOperativoDetalle.nidestadowarrant
                                                                    + '&page='+ page;
                axios.get(url).then(response => {
                    this.arrayWOperativoDetalle = response.data.arrayWOperativoDetalle.data;
                    this.pagination.current_page =  response.data.arrayWOperativoDetalle.current_page;
                    this.pagination.total = response.data.arrayWOperativoDetalle.total;
                    this.pagination.per_page    = response.data.arrayWOperativoDetalle.per_page;
                    this.pagination.last_page   = response.data.arrayWOperativoDetalle.last_page;
                    this.pagination.from        = response.data.arrayWOperativoDetalle.from;
                    this.pagination.to           = response.data.arrayWOperativoDetalle.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaDetalle(page){
                this.pagination.current_page=page;
                this.listarDetalleWOperativo(page);
            },
            tabGeneraWOperativo(){
                this.limpiarFormulario();
                this.llenarComboProvFinanciero();
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
                }
            },
            buscarVersionVehiculo(){
                this.listarVersionVehiculo(1);
            },
            listarVersionVehiculo(page){
                this.nidempresa = 1300011;
                this.nidsucursal = sessionStorage.getItem("nIdSucursal");

                var url = this.ruta + '/compra/GetCompraSinWOperativo?nidempresa=' + this.nidempresa
                                                                    + '&nidsucursal=' + this.nidsucursal
                                                                    + '&cnumerovin=' + this.fillVersionVehiculo.cnumerovin
                                                                    + '&cnombrecomercial=' + this.fillVersionVehiculo.cnombrecomercial
                                                                    + '&page='+ page;
                axios.get(url).then(response => {
                    this.arrayVersionVehiculo = response.data.arrayVersionVehiculo.data;
                    this.paginationModal.current_page =  response.data.arrayVersionVehiculo.current_page;
                    this.paginationModal.total = response.data.arrayVersionVehiculo.total;
                    this.paginationModal.per_page    = response.data.arrayVersionVehiculo.per_page;
                    this.paginationModal.last_page   = response.data.arrayVersionVehiculo.last_page;
                    this.paginationModal.from        = response.data.arrayVersionVehiculo.from;
                    this.paginationModal.to           = response.data.arrayVersionVehiculo.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaVehiculos(page){
                this.paginationModal.current_page=page;
                this.listarVersionVehiculo(page);
            },
            asignarVehiculo(data =[]){
                if(this.encuentra(data['nIdCompra'])){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Ese vehículo ya se encuentra agregado!',
                            })
                }
                else{
                    this.arrayTemporal.push({
                                nIdCompra: data['nIdCompra'],
                                nOrdenCompra: data['nOrdenCompra'],
                                cNumeroVin: data['cNumeroVin'],
                                cNombreComercial: data['cNombreComercial'],
                                nAnioFabricacion: data['nAnioFabricacion'],
                                nAnioFabricacion: data['nAnioFabricacion'],
                                nAnioVersion: data['nAnioVersion'],
                                cFormaPago: data['cFormaPago'],
                                cSimboloMoneda: data['cSimboloMoneda'],
                                fTotalCompra: data['fTotalCompra'],
                                cNumeroFactura: data['cNumeroFactura']
                    });
                    this.sumarWarrant();
                    toastr.success('Se Agregó Vehículo');
                }
            },
            eliminaItemTempVehiculo(index){
                this.$delete(this.arrayTemporal, index);
                this.sumarWarrant();
                toastr.success('Se Eliminó Item Vehículo');
            },
            sumarWarrant(){
                var sumatoria=0;
                this.arrayTemporal.map(function(value, key) {
                    sumatoria = parseFloat(sumatoria) + parseFloat(value.fTotalCompra);
                });
                this.fTotalWarrant = sumatoria.toFixed(2);
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
                this.arrayTemporal;

                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/woperativo/SetWOperativo';
                axios.post(url, {
                    nIdProveedor: this.formWOperativo.nidbanco,
                    dFechaInicio: this.formWOperativo.dfechainicio,
                    data: this.arrayTemporal
                }).then(response => {
                    swal('Warrant Operativo registrado');
                    this.arrayTemporal = [];
                }).catch(error => {
                    console.log(error);
                });
            },
            validar(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formWOperativo.nidbanco == 0 || !this.formWOperativo.nidbanco){
                    this.mensajeError.push('Debes Seleecionar un Proveedor');
                };
                if(this.formWOperativo.dfechainicio == ''){
                    this.mensajeError.push('Debes Ingresar Fecha Registro');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            limpiarFormulario(){
                this.fillWOperativo.nordencompra= '',
                this.fillWOperativo.cnumerovin=  '',
                this.formWOperativo.dfechainicio = '',
                this.arrayCompra = [],
                this.arrayWOperativo = [],
                this.limpiarPaginacion()
            },
            limpiarPaginacion(){
                this.pagination.current_page =  0,
                this.pagination.total = 0,
                this.pagination.per_page = 0,
                this.pagination.last_page = 0,
                this.pagination.from  = 0,
                this.pagination.to = 0
            }
        },
        mounted(){
            this.tabBuscarWOperativo();
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
