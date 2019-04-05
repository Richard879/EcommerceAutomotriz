<template>
    <transition name="slide-fade" appear>
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
                                                                            <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarWOperativo();">
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
                                                                                        <a  href="#"
                                                                                            @click="asignaIdWOperativo(operativo)"
                                                                                            data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            :title="'Ver Detalle ' + operativo.nIdWarrantOperativo">
                                                                                            <i class="fa-md fa fa-eye"></i>
                                                                                        </a>
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
                                                                                    <th>O/C</th>
                                                                                    <th>Nombre Comercial</th>
                                                                                    <th>Nro VIN</th>
                                                                                    <th>Moneda</th>
                                                                                    <th>Valor Warrant</th>
                                                                                    <th>DocNum Asiento</th>
                                                                                    <th>DocNum Comprobante</th>
                                                                                    <!--<th>Comisión Dolar</th>
                                                                                    <th>Comisión Sol</th>-->
                                                                                    <th>Estado</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="odetalle in arrayWOperativoDetalle" :key="odetalle.nIdDetalleWarrant">
                                                                                    <template v-if="odetalle.nIdEstadoWarrant==1300079">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Cancelar {{ odetalle.nIdDetalleWarrant }}</div>
                                                                                            <i @click="cancelarWOperativoDetalle(odetalle)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                                        </el-tooltip>&nbsp;&nbsp;
                                                                                    </template>
                                                                                    <template v-else>&nbsp;&nbsp;</template>
                                                                                    <td>{{ odetalle.nIdDetalleWarrant }}</td>
                                                                                    <td>{{ odetalle.nOrdenCompra }}</td>
                                                                                    <td>{{ odetalle.cNombreComercial }}</td>
                                                                                    <td>{{ odetalle.cNumeroVin }}</td>
                                                                                    <td>{{ odetalle.cSimboloMoneda }}</td>
                                                                                    <td>{{ odetalle.fValorWarrant }}</td>
                                                                                    <td>{{ odetalle.nDocNumAsiento }}</td>
                                                                                    <td>{{ odetalle.nDocNumComprobante }}</td>
                                                                                    <!--<td v-text="odetalle.fComisionDolar"></td>
                                                                                    <td v-text="odetalle.fComisionSol"></td>-->
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
                                                                                        <i :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                    </a>
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
                arrayEstadoWarrant: [],
                arrayWOperativo: [],
                arrayWOperativoDetalle: [],
                arrayTemporal: [],
                arrayVersionVehiculo: [],
                fTotalValor: 0,
                fTotalComisionSol: 0,
                fTotalComisionDolar: 0,
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
                formWOperativo:{
                    nidproveedor: 0,
                    cproveedornombre: '',
                    cnrowarrant: '',
                    dfechainicio: '',
                    dfechafin: '',
                    ccarcode: ''
                },
                fillVersionVehiculo:{
                    cnumerovin: '',
                    cnombrecomercial: ''
                },
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
                if(me.arrayTemporal.length > 0) {
                    return me.arrayTemporal.reduce(function(valorAnterior, valorActual){
                        return valorAnterior + parseFloat(valorActual.fTotalCompra);
                    }, 0);
                } else {
                    return 0;
                }
            },
            totalComisionDolar: function(){
                let me = this;
                if(me.arrayTemporal.length > 0) {
                    return me.arrayTemporal.reduce(function(valorAnterior, valorActual){
                        return valorAnterior + parseFloat(valorActual.fComisionDolar);
                    }, 0);
                } else {
                    return 0;
                }
            },
            totalComisionSol: function(){
                let me = this;
                if(me.arrayTemporal.length > 0) {
                    return me.arrayTemporal.reduce(function(valorAnterior, valorActual){
                        return valorAnterior + parseFloat(valorActual.fComisionSol);
                    }, 0);
                } else {
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
                        'cnumerovin'       : this.fillWOperativo.cnumerovin,
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
                    case 'vehiculos':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=3;
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
                        }, 1200);
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
            },
            registroSgcAsientoContable(){
                let me = this;
                var sapUrl = me.ruta + '/woperativo/SetIntegraAsientoContableWO';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1) {
                         setTimeout(function() {
                            me.generaSapFacturaProveedor();
                        }, 1200);
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

                var sapUrl = me.ruta + '/comprobante/SapSetFacturaProveedorWO';
                axios.post(sapUrl, {
                    'cCardCode'     : me.formWOperativo.ccarcode, //CODIGO FORUM
                    'fDocDate'      : moment().format('YYYY-MM-DD'),
                    'fDocDueDate'   : moment().add(30, 'days').format('YYYY-MM-DD'),
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
                                'cFlagTipo'         :   "FP",
                                'cTipo'             :   'WO',
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
            },
            registroSgcActividad(){
                let me = this;
                var sapUrl = me.ruta + '/actividad/SetIntegraActividadCompra';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    setTimeout(function() {
                        //me.confirmarWO();
                        me.registroSapBusinessSolucion();
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
            },
            registroSgcSolucion(){
                let me = this;
                var sapUrl = me.ruta + '/solucion/SetIntegraSolucion';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    setTimeout(function() {
                        me.getFacturaProveedorActividad();
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
                }, 1200);
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
            },
            registroSgcLlamadaServicio(){
                let me = this;
                var sapUrl = me.ruta + '/llamadaservicio/SetIntegraLlamadaServicio';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    setTimeout(function() {
                        me.obtenerWOTblCosto();
                        //me.confirmarWO();
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
                this.error = 0;
                this.mensajeError =[];

                if(this.formWOperativo.nidproveedor == 0 || !this.formWOperativo.nidproveedor){
                    this.mensajeError.push('Debe seleecionar un Proveedor');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
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
                this.arraySapWO= []
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
</style>
