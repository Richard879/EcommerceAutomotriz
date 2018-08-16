<template>
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
                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarWFinanciero();"><i class="fa fa-search"></i> Buscar</button>
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
                                                                                    <a href="#" @click="asignaIdWFinanciero(operativo.nIdWarrantFinanciero);" data-toggle="tooltip" data-placement="top" :title="'Ver Detalle ' +operativo.nIdWarrantFinanciero">
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
                                                                            <select v-model="formWFinanciero.nidbanco" class="form-control form-control-sm">
                                                                                <option v-for="item in arrayBanco" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                                </option>
                                                                            </select>
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
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Fecha Registro</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="date" v-model="formWFinanciero.dfechainicio" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Fecha Vencimiento</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="date" v-model="formWFinanciero.dfechafin" class="form-control form-control-sm">
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
                                                                        <span class="input-group-btn">
                                                                            <button type="button" title="Buscar Vehículos" class="btn btn-info btn-corner btn-sm" @click="abrirModal('vehiculos','buscar')">
                                                                                <i class="fa-lg fa fa-search"></i>
                                                                            </button>
                                                                        </span>
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
                                                                            <td v-text="temporal.fTotalCompra"></td>
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
                        <form v-on:submit.prevent class="form-horizontal">
                            <div class="container-fluid">
                                <div class="col-lg-12">
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
                                                                <td v-text="vehiculo.cAnioFabricacion"></td>
                                                                <td v-text="vehiculo.cAnioVersion"></td>
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
</template>
<script>
    export default {
        props:['ruta'],
        data(){
            return {
                cempresa: 'SAISAC',
                csucursal: 'CHICLAYO',
                canio: '2018',
                cmes: 'MAYO',
                nidempresa: 0,
                nidsucursal: 0,
                arrayBanco: [],
                arrayEstadoWarrant: [],
                arrayWFinanciero: [],
                arrayWFinancieroDetalle: [],
                arrayTemporal: [],
                arrayVersionVehiculo: [],
                arrayCompra: [],
                fTotalWarrant: 0,
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
                    nidbanco: 0,
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
            llenarComboBanco(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110042 
                                                                                + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayBanco = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboEstadoWarrant(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110043 
                                                                                + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayEstadoWarrant = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
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
                var url = this.ruta + '/wfinanciero/GetWFinanciero?nidestadowarrant=' + this.fillWFinanciero.nidestadowarrant
                                                                + '&cnrowarrant=' + this.fillWFinanciero.cnrowarrant
                                                                + '&page='+ page;
                axios.get(url).then(response => {
                    this.arrayWFinanciero = response.data.arrayWFinanciero.data;
                    this.pagination.current_page =  response.data.arrayWFinanciero.current_page;
                    this.pagination.total = response.data.arrayWFinanciero.total;
                    this.pagination.per_page    = response.data.arrayWFinanciero.per_page;
                    this.pagination.last_page   = response.data.arrayWFinanciero.last_page;
                    this.pagination.from        = response.data.arrayWFinanciero.from;
                    this.pagination.to           = response.data.arrayWFinanciero.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarWFinancieros(page);
            },
            asignaIdWFinanciero(nIdWarrantFinanciero){
                this.fillWFinancieroDetalle.nidwarrantfinanciero= nIdWarrantFinanciero;
                this.buscarWFinancieroDetalle();
            },
            buscarWFinancieroDetalle(){
                this.listarDetalleWFinanciero(this.fillWFinancieroDetalle.nidwarrantfinanciero, 1);
            },
            listarDetalleWFinanciero(nIdWarrantFinanciero, page){
                this.vistaFormularioTabBuscar = 0;
                var url = this.ruta + '/wfinanciero/GetWFinancieroDetalle?nidwarrantfinanciero=' + nIdWarrantFinanciero
                                                                    + '&cnumerovin=' + this.fillWFinancieroDetalle.cnumerovin
                                                                    + '&nidestadowarrant=' + this.fillWFinancieroDetalle.nidestadowarrant
                                                                    + '&page='+ page;
                axios.get(url).then(response => {
                    this.arrayWFinancieroDetalle = response.data.arrayWFinancieroDetalle.data;
                    this.pagination.current_page =  response.data.arrayWFinancieroDetalle.current_page;
                    this.pagination.total = response.data.arrayWFinancieroDetalle.total;
                    this.pagination.per_page    = response.data.arrayWFinancieroDetalle.per_page;
                    this.pagination.last_page   = response.data.arrayWFinancieroDetalle.last_page;
                    this.pagination.from        = response.data.arrayWFinancieroDetalle.from;
                    this.pagination.to           = response.data.arrayWFinancieroDetalle.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaDetalle(page){
                this.pagination.current_page=page;
                this.listarDetalleWFinanciero(page);
            },
            tabGeneraWFinanciero(){
                this.limpiarFormulario();
                this.llenarComboBanco();
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
                this.nidsucursal = 1300013;

                var url = this.ruta + '/compra/GetCompraSinWFinanciero?nidempresa=' + this.nidempresa
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
                
                var url = this.ruta + '/wfinanciero/SetWFinanciero';
                axios.post(url, {
                    nIdBanco: this.formWFinanciero.nidbanco,
                    cNumeroWarrant: this.formWFinanciero.cnrowarrant,
                    dFechaInicio: this.formWFinanciero.dfechainicio,
                    dFechaVence: this.formWFinanciero.dfechafin,
                    //data: this.arrayTemporal,
                    nIdUsuario: 190011
                }).then(response => {
                    /*swal('Warrant Operativo registrado');
                    this.arrayTemporal = [];*/
                    //console.log(response.data[0]);
                    //alert(response.data[0].nIdWarrantFinanciero);
                    this.registrarDetalle(response.data[0].nIdWarrantFinanciero);
                }).catch(error => {
                    console.log(error);
                });
            },
            registrarDetalle(nIdWarrantFinanciero){
                var url = this.ruta + '/wfinanciero/SetWFinancieroDetalle';
                axios.post(url, {
                    nIdWarrantFinanciero: nIdWarrantFinanciero,
                    data: this.arrayTemporal,
                    nIdUsuario: 190011
                }).then(response => {
                    swal('Warrant Financiero registrado');
                    this.arrayTemporal = [];
                }).catch(error => {
                    console.log(error);
                });
            },
            validar(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formWFinanciero.nidbanco == 0){
                    this.mensajeError.push('Debes Seleccionar un Banco');
                };
                if(this.formWFinanciero.dfechainicio == ''){
                    this.mensajeError.push('Debes Ingresar Fecha Registro');
                };
                if(this.formWFinanciero.dfechafin == ''){
                    this.mensajeError.push('Debes Ingresar Fecha Vencimiento');
                };
                if(this.formWFinanciero.dfechainicio > this.formWFinanciero.dfechafin){
                    this.mensajeError.push('La Fecha Registro debe ser menor a la Fecha Venc.');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            limpiarFormulario(){
                this.fillWFinanciero.nordencompra= '',
                this.fillWFinanciero.cnumerovin=  '',
                this.arrayCompra = [],
                this.arrayWFinanciero = [],
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
            this.tabBuscarWFinanciero();
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