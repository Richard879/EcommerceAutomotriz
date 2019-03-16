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
                                                                    <!--<div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Nro Warrant</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillWOperativo.cnrowarrant" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>-->
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
                                                                                <th>Proveedor</th>
                                                                                <th>Moneda</th>
                                                                                <th>Valor Total</th>
                                                                                <th>Total Comision Dolar</th>
                                                                                <th>Total Comision Sol</th>
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
                                                                                <td v-text="operativo.fTotalComisionDolar"></td>
                                                                                <td v-text="operativo.fTotalComisionSol"></td>
                                                                                <td v-text="operativo.cParNombre"></td>
                                                                                <td>
                                                                                    <a href="#" @click="asignaIdWOperativo(operativo);" data-toggle="tooltip" data-placement="top" :title="'Ver Detalle ' +operativo.nIdWarrantOperativo">
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
                                                                                <th>Código</th>
                                                                                <th>O/C</th>
                                                                                <th>Nombre Comercial</th>
                                                                                <th>Nro VIN</th>
                                                                                <th>Moneda</th>
                                                                                <th>Valor Warrant</th>
                                                                                <th>Comisión Dolar</th>
                                                                                <th>Comisión Sol</th>
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
                                                                                <td v-text="odetalle.fComisionDolar"></td>
                                                                                <td v-text="odetalle.fComisionSol"></td>
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
                                                                <!--<div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Nro Warranat</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="formWOperativo.cnrowarrant" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>-->
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
                                                                            <th>Comisión Dolares</th>
                                                                            <th>Comisión Soles</th>
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
                                                                            <td v-text="temporal.nAnioFabricacion"></td>
                                                                            <td v-text="temporal.nAnioVersion"></td>
                                                                            <td v-text="temporal.cFormaPago"></td>
                                                                            <td v-text="temporal.cSimboloMoneda"></td>
                                                                            <td v-text="temporal.fTotalCompra"></td>
                                                                            <td v-text="temporal.cNumeroFactura"></td>
                                                                            <td v-text="temporal.fComisionDolar"></td>
                                                                            <td v-text="temporal.fComisionSol"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-lg-7">
                                                                    </div>
                                                                    <div class="col-lg-5">
                                                                        <div class="datatable-info">Total: USD <strong>{{ fTotalValor }}</strong></div>
                                                                        <div class="datatable-info">Total Comision Dolares: USD <strong>{{ fTotalComisionDolar }}</strong></div>
                                                                        <div class="datatable-info">Total Comision Soles: S./ <strong>{{ fTotalComisionSol }}</strong></div>
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
                cempresa: sessionStorage.getItem("cNombreEmpresa"),
                csucursal: sessionStorage.getItem("cNombreSucursal"),
                arrayBanco: [],
                arrayEstadoWarrant: [],
                arrayWOperativo: [],
                arrayWOperativoDetalle: [],
                arrayTemporal: [],
                arrayVersionVehiculo: [],
                arrayCompra: [],
                fTotalValor: 0,
                fTotalComisionSol: 0,
                fTotalComisionDolar: 0,
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
                arrayAsiento: [],
                //===========================================================
                // =============  VARIABLES COMPRA ========================
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
                //===========================================================
                // =============  VARIABLES ALMACEN ========================
                formAlmacen:{
                    nidlocalidad: 0,
                    cwhscode: '',
                    cwhsname: ''
                },
                arrayAlmacen: [],
                //===========================================================
                // =============  VARIABLES SAP ========================
                arraySapRespuesta: [],
                jsonRespuesta: '',
                arraySapUpdSgc: [],
                arraySapWO: [],
                arraySapCompra: [],
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
            }
        },
        methods:{
            obtenerIgv(){
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
            },
            obtenerLocalidadBySucursal(){
                var url = this.ruta + '/parparametro/GetParParametro';

                axios.get(url, {
                    params: {
                        'nparsrccodigo': 0,
                        'nparsrcgrupoarametro': 110102,
                        'npardstcodigo': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'npardstgrupoarametro': 110022,
                        'opcion': 1
                    }
                }).then(response => {
                    if(response.data.arrayParParametro.length){
                        this.formAlmacen.nidlocalidad = response.data.arrayParParametro[0].nParSrcCodigo;
                        this.obtenerAlmacenByLocalidad();
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
            obtenerAlmacenByLocalidad(){
                var url = this.ruta + '/almacen/GetAlmacenPorDefecto';
                axios.get(url, {
                    params: {
                        'nidpar': this.formAlmacen.nidlocalidad,
                        'nidgrupopar': 110102
                    }
                }).then(response => {
                    if(response.data.length){
                        this.formAlmacen.cwhscode = response.data[0].cParJerarquia;
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
            llenarComboProvFinanciero(){
                var url = this.ruta + '/parametro/GetLstProveedor';

                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidgrupopar': 110094,
                        'cnombreproveedor': '',
                        'opcion' : 1
                    }
                }).then(response => {
                    this.arrayBanco = response.data.arrayProveedor;
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
                        'nidestadowarrant': this.fillWOperativo.nidestadowarrant,
                        'cnrowarrant': this.fillWOperativo.cnrowarrant,
                        'page': page
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
                this.listarWOperativos(page);
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
                        'nidwarrantoperativo': this.fillWOperativoDetalle.nidwarrantoperativo,
                        'cnumerovin': this.fillWOperativoDetalle.cnumerovin,
                        'nidestadowarrant': this.fillWOperativoDetalle.nidestadowarrant,
                        'page': page
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
                var url = this.ruta + '/compra/GetCompraSinWOperativo';

                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'cnumerovin': this.fillVersionVehiculo.cnumerovin,
                        'cnombrecomercial': this.fillVersionVehiculo.cnombrecomercial,
                        'page': page
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
                if(this.encuentra(data.nIdCompra)){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Ese vehículo ya se encuentra agregado!',
                            })
                }
                else{
                    this.arrayTemporal.push(data);
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
                let me = this;
                me.fTotalValor = 0;
                me.fTotalComisionDolar = 0;
                me.fTotalComisionSol = 0;
                me.arrayTemporal.map(function(value, key) {
                    me.fTotalValor = parseFloat(me.fTotalValor) + parseFloat(value.fTotalCompra);
                    me.fTotalComisionDolar = parseFloat(me.fTotalComisionDolar) + parseFloat(value.fComisionDolar);
                    me.fTotalComisionSol = parseFloat(me.fTotalComisionSol) + parseFloat(value.fComisionSol);
                });
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

                var url = me.ruta + '/woperativo/SetWOperativo';
                axios.post(url, {
                    'nIdProveedor'      : me.formWOperativo.nidbanco,
                    'fTotalValor'       : me.fTotalValor,
                    'fTotalComisionDolar': me.fTotalComisionDolar,
                    'fTotalComisionSol' : me.fTotalComisionSol,
                    'data'              : me.arrayTemporal
                }).then(response => {
                    me.arrayTemporal.map(function(value, key) {
                        me.arrayAsiento.push({
                            'ProjectCode'   : value.cNumeroVin,
                            'fCredit'       : "0",
                            'fDebit'        : value.fTotalCompra,
                            'fCredit1'      : value.fTotalCompra,
                            'fComisionSol'  : value.fComisionSol,
                            'fDebit1'       : "0"
                        })
                    });
                    //==============================================================
                    //================== GENERAR ASIENTO CONTABLE SAP ===============
                    setTimeout(function() {
                        me.generaSapCompraWO();
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
            generaSapCompraWO(objCompra){
                let me = this;

                //==============================================================
                //================== REGISTRO COMPRA EN SAP ===============
                me.loadingProgressBar("INTEGRANDO WARRANT OPERATIVO CON SAP BUSINESS ONE...");

                me.arraySapCompra.push({
                    'cItemCode'        : "SCMEGEGEGEN00465", //CODIGO SERVICIO WO
                    'fTotalCompra'     : me.fTotalValor
                });

                var sapUrl = me.ruta + '/compra/SapSetCompraWO';
                axios.post(sapUrl, {
                    'cCardCode'     : "P20544637313",// me.formCompra.ccarcode,
                    'fDocDate'      : moment().format('YYYY-MM-DD'),
                    'fDocDueDate'   : moment().add(30, 'days').format('YYYY-MM-DD'),
                    'WarehouseCode' : me.formAlmacen.cwhscode,
                    'Igv'           : 1 + parseFloat((me.formCompra.igv)),
                    'data'          : me.arraySapCompra
                }).then(response => {
                    me.arraySapRespuesta= [];
                    me.arraySapUpdSgc= [];

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

                            //==============================================================
                            //================== ACTUALIZAR DOCENTRY ===============
                            setTimeout(function() {
                                me.generaActualizarDocEntryWO(objCompra);
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
            },
            generaActualizarDocEntryWO(objCompra){
                let me = this;
                var sapUrl = me.ruta + '/compra/SetIntegraPurchaseOrder';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        setTimeout(function() {
                            me.generaSapWO();
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
            generaSapWO(){
                let me = this;
                me.loadingProgressBar("INTEGRANDO ASIENTO CONTABLE CON SAP BUSINESS ONE...");

                var url = me.ruta + '/asiento/SapSetAsientoContableWO';
                axios.post(url, {
                    'data' : me.arrayAsiento
                }).then(response => {
                    //console.log(response);
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
                                'cTipo'         : 'WO',
                                'nJdtNum'       : parseInt(me.jsonRespuesta.JdtNum),
                                'nNumber'       : parseInt(me.jsonRespuesta.Number),
                                'cLogRespuesta' : response.data.toString()
                            });
                        }
                    });

                    //==============================================================================
                    //================== ACTUALIZO TABLA INTEGRACION ASIENTO CONTABLE ===============
                    setTimeout(function() {
                        me.generaActualizaWO();
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
            generaActualizaWO(){
                let me = this;
                var sapUrl = me.ruta + '/woperativo/SetIntegraAsientoContableWO';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                         setTimeout(function() {
                            me.obtenerWOTblCosto();
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
            obtenerWOTblCosto(){
                let me = this;
                var url = me.ruta + '/tablacosto/GetWOComisionTblCosto';
                axios.post(url, {
                        'nIdEmpresa'    : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nIdSucursal'   : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'data'          : me.arrayAsiento
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
                            'U_SYP_COSTO'         :   x.U_SYP_COSTO,
                            'U_SYP_ESTADO'        :   x.U_SYP_ESTADO
                        });
                    });

                    setTimeout(function() {
                        me.registroSapBusinessTblCostoWO();
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
            confirmarWO(){
                let me = this;
                me.loading.close();
                $("#myBar").hide();
                swal('Warrant Operativo registrado');
                me.limpiarFormulario();
            },
            validar(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formWOperativo.nidbanco == 0 || !this.formWOperativo.nidbanco){
                    this.mensajeError.push('Debes Seleecionar un Proveedor');
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
                this.arrayTemporal = [];
                this.limpiarPaginacion();

                //========= VARIABLES SAP =============
                //Limpiar variables Sap Articulo
                this.arraySapRespuesta= [],
                this.jsonRespuesta= '',
                this.arraySapUpdSgc= [],
                this.arraySapWO= [],
                this.arraySapCompra= []
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
        },
        mounted(){
            this.tabBuscarWOperativo();
            this.obtenerLocalidadBySucursal();
            this.obtenerIgv();
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
