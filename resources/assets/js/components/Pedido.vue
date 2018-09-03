<template>
    <main>
        <header class="page-header">
          <div class="container-fluid">
            <h2 class="no-margin-bottom">GENERAR PEDIDO</h2>
          </div>
        </header>
        
        <section>
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#TabBuscaPedido" @click="tabBuscarPedido()" role="tab" data-toggle="tab">
                                        <i class="fa fa-search"></i> BUSCAR PEDIDOS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#TabGeneraPedido" @click="tabGenerarPedido()" role="tab" data-toggle="tab">
                                        <i class="fa fa-list-alt"></i> GENERAR PEDIDO
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade in active show" id="TabBuscaPedido">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="h4">BUSCAR PEDIDOS</h3>
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
                                                                        <label class="col-sm-4 form-control-label">Fecha Inicio</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="date" v-model="fillPedido.dfechainicio" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Fecha Fin</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="date" v-model="fillPedido.dfechafin" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Nº Orden Pedido</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="fillPedido.cnumeropedido" @keyup.enter="buscarPedidos()" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Nro Vin</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="fillPedido.cnumerovin" @keyup.enter="buscarPedidos()" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Marca</label>
                                                                        <div class="col-sm-8">
                                                                            <select name="account" v-model="formPedido.nidmarca" class="form-control form-control-sm" v-on:change="llenarComboModelos()">
                                                                                <option v-for="marca in arrayMarca" :key="marca.nIdPar" :value="marca.nIdPar" v-text="marca.cParNombre">
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Modelo</label>
                                                                        <div class="col-sm-8">
                                                                            <select name="account" v-model="formPedido.nidmodelo" class="form-control form-control-sm">
                                                                                <option v-for="modelo in arrayModelo" :key="modelo.nIdPar" :value="modelo.nIdPar" v-text="modelo.cParNombre">
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Estado Pedido</label>
                                                                        <div class="col-sm-8">
                                                                            <select name="account" v-model="fillPedido.nidestadopedido" class="form-control form-control-sm">
                                                                                <option v-for="estado in arrayEstadoPedido" :key="estado.nIdPar" :value="estado.nIdPar" v-text="estado.cParNombre">
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">        
                                                                <div class="col-sm-9 offset-sm-5">
                                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarPedidos()"><i class="fa fa-search"></i> Buscar</button>
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
                                                        <template v-if="arrayPedido.length">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped table-sm">
                                                                    <thead>
                                                                        <tr>
                                                                            <!--<th>Acciones</th>-->
                                                                            <th>Nro Pedido</th>
                                                                            <th>Vendedor</th>
                                                                            <th>Contacto</th>
                                                                            <th>Vehiculo</th>
                                                                            <th>Número VIN</th>
                                                                            <th>Número DUA</th>
                                                                            <th>Fecha Pedido</th>
                                                                            <th>Estado Pedido</th>
                                                                            <th>Estado Aprobación</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr v-for="pedido in arrayPedido" :key="pedido.nIdCabeceraPedido">
                                                                            <!--<td> 
                                                                                <a href="#" @click="aprobarCotizacion(pedido.nIdCabeceraCotizacion, pedido.cNumeroCotizacion, pedido.cContacto)" data-toggle="tooltip" data-placement="top" 
                                                                                    :title="'Aprobar Cotización ' + pedido.nIdCabeceraCotizacion">
                                                                                    <i class="fa-md fa fa-check-circle"></i>
                                                                                </a>
                                                                            </td>-->
                                                                            <td v-text="pedido.cNumeroPedido"></td>
                                                                            <td v-text="pedido.cVendedorNombre"></td>
                                                                            <td v-text="pedido.cContacto"></td>
                                                                            <td v-text="pedido.cNombreComercial + ' ' + pedido.nAnioFabricacion + '-' + pedido.nAnioModelo"></td>
                                                                            <td v-text="pedido.cNumeroVin"></td>
                                                                            <td v-text="pedido.cNumeroDUA"></td>
                                                                            <td v-text="pedido.dFechaPedido"></td>
                                                                            <td v-text="pedido.cEstadoPedido"></td>
                                                                            <td v-text="pedido.cEstadoAprobacion"></td>
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
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="TabGeneraPedido">
                                    <template v-if="vistaFormularioPedido">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">BUSCAR COTIZACIONES</h3>
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
                                                                                <input type="date" v-model="formPedido.dfechainicio" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Fecha Fin</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="date" v-model="formPedido.dfechafin" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Marca</label>
                                                                            <div class="col-sm-8">
                                                                                <select name="account" v-model="formPedido.nidmarca" class="form-control form-control-sm" v-on:change="llenarComboModelos()">
                                                                                    <option v-for="marca in arrayMarca" :key="marca.nIdPar" :value="marca.nIdPar" v-text="marca.cParNombre">
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Modelo</label>
                                                                            <div class="col-sm-8">
                                                                                <select name="account" v-model="formPedido.nidmodelo" class="form-control form-control-sm">
                                                                                    <option v-for="modelo in arrayModelo" :key="modelo.nIdPar" :value="modelo.nIdPar" v-text="modelo.cParNombre">
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-9 offset-sm-5">
                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarCotizacionesIngresadas()"><i class="fa fa-search"></i> Buscar</button>
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
                                                            <template v-if="arrayPedido.length">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Acciones</th>
                                                                                <th>Nro Cotizacion</th>
                                                                                <th>Vendedor</th>
                                                                                <th>Vehiculo</th>
                                                                                <th>Contacto</th>
                                                                                <th>Dirección</th>
                                                                                <th>Celular</th>
                                                                                <th>Email</th>
                                                                                <th>Fecha Inicio</th>
                                                                                <th>Fecha Venc.</th>
                                                                                <th>Estado Cotización</th>
                                                                                <th>Estado Aprobación</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="pedido in arrayPedido" :key="pedido.nIdCabeceraCotizacion">
                                                                                <td> 
                                                                                    <a href="#" @click="aprobarCotizacion(pedido.nIdCabeceraCotizacion, pedido.cNumeroCotizacion, pedido.cContacto)" data-toggle="tooltip" data-placement="top" 
                                                                                        :title="'Aprobar Cotización ' + pedido.nIdCabeceraCotizacion">
                                                                                        <i class="fa-md fa fa-check-circle"></i>
                                                                                    </a>
                                                                                </td>
                                                                                <td v-text="pedido.cNumeroCotizacion"></td>
                                                                                <td v-text="pedido.cVendedorNombre"></td>
                                                                                <td v-text="pedido.cNombreComercial + ' ' + pedido.nAnioFabricacion + '-' + pedido.nAnioModelo"></td>
                                                                                <td v-text="pedido.cContacto"></td>
                                                                                <td v-text="pedido.cDireccion"></td>
                                                                                <td v-text="pedido.nTelefonoMovil"></td>
                                                                                <td v-text="pedido.cEmail"></td>
                                                                                <td v-text="pedido.dFechaCotizacion"></td>
                                                                                <td v-text="pedido.dFechaVencimientoCotizacion"></td>
                                                                                <td v-text="pedido.cEstadoCotizacion"></td>
                                                                                <td v-text="pedido.cEstadoAprobacion"></td>
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
                                                                                        <a @click.prevent="cambiarPaginaCotizacion(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                    </li>
                                                                                    <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                    :class="[page==isActived?'active':'']">
                                                                                        <a class="page-link"
                                                                                        href="#" @click.prevent="cambiarPaginaCotizacion(page)"
                                                                                        v-text="page"></a>
                                                                                    </li>
                                                                                    <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                        <a @click.prevent="cambiarPaginaCotizacion(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                                    <h2 class="no-margin-bottom" v-text="formPedido.cnombrecontacto"></h2><hr/>
                                                    <ul class="nav nav-tabs">
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="Tab1" href="#TabAsignarCompra" @click="tabAsignarCompra()" role="tab" data-toggle="tab">
                                                                <i class="fa fa fa-bus"></i> ASIGNAR COMPRA
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link disabled" id="Tab2" href="#TabDocReferencias" role="tab" data-toggle="tab">
                                                                <i class="fa fa-book"></i> DOCUMENTOS REFERENCIAS
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link disabled" id="Tab3" href="#TabDocAsociados" role="tab" data-toggle="tab">
                                                                <i class="fa fa-book"></i> DOCUMENTOS ASOCIADOS
                                                            </a>
                                                        </li>
                                                    </ul>

                                                    <div class="tab-content">
                                                        <div class="tab-pane fade in active show" id="TabAsignarCompra">
                                                           <section class="forms">
                                                                <div class="container-fluid">
                                                                    <div class="col-lg-12">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h3 class="h4">BUSCAR COTIZACIONES</h3>
                                                                            </div>
                                                                            <div class="card-body"> 
                                                                                <form class="form-horizontal">
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">Número VIN</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <input type="hidden" v-model="formCompra.nidcabeceracotizacion">
                                                                                                    <input type="text" v-model="formCompra.cnumerovin" @keyup.enter="listarCompras(1)" class="form-control form-control-sm">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">Nombre Comercial</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <input type="text" v-model="formCompra.cnombrecomercial" @keyup.enter="listarCompras(1)" class="form-control form-control-sm">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-9 offset-sm-5">
                                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarCompras(1)"><i class="fa fa-search"></i> Buscar</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h3 class="h4">LISTADO COMPRAS</h3>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <template v-if="arrayCompra.length">
                                                                                    <div class="table-responsive">
                                                                                        <table class="table table-striped table-sm">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th>Acciones</th>
                                                                                                    <th>Cód Comp.</th>
                                                                                                    <th>O/C</th>
                                                                                                    <th>Nombre Comercial</th>
                                                                                                    <th>Año Fab.</th>
                                                                                                    <th>Año Modelo</th>
                                                                                                    <th>Nro VIN</th>
                                                                                                    <th>Color</th>
                                                                                                    <th>Motor</th>
                                                                                                    <th>Almacén</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr v-for="compra in arrayCompra" :key="compra.nIdCompra">
                                                                                                    <td> 
                                                                                                        <a href="#" @click="activarTabDocReferencias(compra.nIdCompra, compra.cNumeroVin, compra.nOrdenCompra, 
                                                                                                                                                    compra.cNombreComercial, compra.nAnioFabricacion, compra.nAnioVersion,
                                                                                                                                                    compra.cNombreColor, compra.cNumeroMotor)" 
                                                                                                            data-toggle="tooltip" data-placement="top" :title="'Seleccionar Compra ' + compra.nIdCompra">
                                                                                                            <i class="fa-md fa fa-check-circle"></i>
                                                                                                        </a>
                                                                                                    </td>
                                                                                                    <td v-text="compra.nIdCompra"></td>
                                                                                                    <td v-text="compra.nOrdenCompra"></td>
                                                                                                    <td v-text="compra.cNombreComercial"></td>
                                                                                                    <td v-text="compra.nAnioFabricacion"></td>
                                                                                                    <td v-text="compra.nAnioVersion"></td>
                                                                                                    <td v-text="compra.cNumeroVin"></td>
                                                                                                    <td v-text="compra.cNombreColor"></td>
                                                                                                    <td v-text="compra.cNumeroMotor"></td>
                                                                                                    <td v-text="compra.cNombreAlmacen"></td>
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
                                                                                                            <a @click.prevent="cambiarPaginaCompra(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                                        </li>
                                                                                                        <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                                        :class="[page==isActived?'active':'']">
                                                                                                            <a class="page-link"
                                                                                                            href="#" @click.prevent="cambiarPaginaCompra(page)"
                                                                                                            v-text="page"></a>
                                                                                                        </li>
                                                                                                        <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                                            <a @click.prevent="cambiarPaginaCompra(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane fade" id="TabDocReferencias">
                                                            <section class="forms">
                                                                <div class="container-fluid">
                                                                    <div class="col-lg-12">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h3 class="h4">DATOS DE PEDIDO</h3>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <form class="form-horizontal">
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">Nro Cotización</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <input type="hidden" v-model="formDocRef.nidcompra">
                                                                                                    <label v-text="formDocRef.cnrocotizacion" class="form-control-label-readonly"></label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">Nombre Comercial</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <label v-text="formDocRef.cnombrecomercial" class="form-control-label-readonly"></label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">Año Fabricación</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <label v-text="formDocRef.naniofabricacion" class="form-control-label-readonly"></label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">Año Modelo</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <label v-text="formDocRef.naniomodelo" class="form-control-label-readonly"></label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">Nro VIN</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <label v-text="formDocRef.cnrovin" class="form-control-label-readonly"></label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">O/C</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <label v-text="formDocRef.nordencompra" class="form-control-label-readonly"></label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">Color</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <label v-text="formDocRef.ccolor" class="form-control-label-readonly"></label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">Motor</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <label v-text="formDocRef.cmotor" class="form-control-label-readonly"></label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">Precio Lista</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <label v-text="formDocRef.fpreciolista" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">Precio Sistema</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <label v-text="formDocRef.fprecioventap" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">Descuento</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <label v-text="formDocRef.fdescuentolista" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">Precio Cliente</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <label v-text="formDocRef.fpreciofinal" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">Bono</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <label v-text="formDocRef.fbono" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">Sobre Precio</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <label v-text="formDocRef.fsobreprecio" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">Bono Especial</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <label v-text="formDocRef.fbonoespecial" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">Descuento</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <label v-text="formDocRef.fdescuento" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">Fecha Pedido</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <label v-text="formDocRef.dfechapedido" class="form-control-label-readonly"></label>
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
                                                                                <h3 class="h4">FORMA DE PAGO</h3>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <form class="form-horizontal">
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">* Forma de Pago</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <select v-model="formDocRef.nidformapago" class="form-control form-control-sm">
                                                                                                        <option v-for="item in arrayFormaPago" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">* Banco</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <select v-model="formDocRef.nidbanco" class="form-control form-control-sm">
                                                                                                        <option v-for="item in arrayBanco" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-9 offset-sm-5">
                                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="activarTabDocAsociados()">
                                                                                                <i class="fa fa-arrow-right"></i> Siguiente
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane fade" id="TabDocAsociados">
                                                            <section class="forms">
                                                                <div class="container-fluid">
                                                                    <div class="card">
                                                                        <form class="form-horizontal">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-striped table-sm" style="border-collapse: separate;">
                                                                                    <thead>
                                                                                        <tr>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr v-for="documento in arrayTablaDocumento" :key="documento.nIdPar">
                                                                                            <td v-text="documento.cParNombre"></td>
                                                                                            <td><input type="file" @change="getFile" accept=".pdf,.xlsx"/></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <br>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-9 offset-sm-5">
                                                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarPedido()">
                                                                                        <i class="fa fa-save"></i> Generar Pedido
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </template>
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
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Nombre</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <input type="text" v-model="fillProveedor.cnombreproveedor" @keyup.enter="buscaProveedores()" class="form-control form-control-sm">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" title="Buscar Vehículos" class="btn btn-info btn-corner btn-sm" @click="buscaProveedores();"><i class="fa-lg fa fa-search"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
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
                                                                        <a href="#" @click="asignarProveedor(proveedor.nIdPar, proveedor.cParNombre);">
                                                                            <i class='fa-md fa fa-check-circle'></i>
                                                                        </a>
                                                                    </td>
                                                                    <td>{{proveedor.cParNombre}}</td>
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
                // =====================================================
                // =========== VARIABLES MODAL PROVEEDOR ===============
                fillProveedor:{
                    cnombreproveedor: ''
                },
                arrayProveedor: [],
                // ======================================================
                // =========== VARIABLES TAB BUSCAR PEDIDO ==============
                fillPedido:{
                    dfechainicio: '',
                    dfechafin: '',
                    cnumeropedido: '',
                    cnumerovin: '',
                    nidestadopedido: 0
                },
                arrayEstadoPedido: [],
                // =============================================================
                // ================ VARIABLES TAB GENERAR PEDIDO ===============
                formPedido:{
                    dfechainicio: '',
                    dfechafin: '',
                    nidmarca: 0,
                    nidmodelo: 0,
                    cnumerodocumento: '',
                    cfiltrodescripcion: '',
                    cnombrecontacto: ''
                },
                arrayPedido: [],
                arrayMarca: [],
                arrayModelo: [],
                vistaFormularioPedido: 1,
                // ============== VARIABLES TAB COMPRA =================
                formCompra:{
                    nidcabeceracotizacion: 0,
                    cnumerovin: '',
                    cnombrecomercial: ''
                },
                arrayCompra: [],
                // ============== VARIABLES TAB DOCUMENTOS REFERENCIA =================
                formDocRef:{
                    cnrocotizacion: '',
                    cnrovin: '',
                    nordencompra: '',
                    ccolor: '',
                    cmotor: '',
                    cnombrecomercial: '',
                    naniofabricacion: '',
                    naniomodelo: '',
                    nidbanco: 0,
                    nidformapago: 0,
                    dfechapedido: '',
                    fpreciolista: 0,
                    fprecioventap: 0,
                    fbono: 0,
                    fbonoespecial: 0,
                    fsobreprecio: 0,
                    fdescuento: 0,
                    fdescuentolista: 0,
                    fpreciofinal: 0,
                    nidcompra: 0
                },
                arrayBanco: [],
                arrayFormaPago: [],
                // ============== VARIABLES TAB DOCUMENTOS ASOCIADOS =================
                arrayTablaDocumento: [],
                // =============================================================
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
                someData: '',
                attachment: [],
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
            tabBuscarPedido(){
                this.formPedido.nidmarca = 0;
                this.formPedido.nidmodelo = 0;
                this.arrayPedido = [];
            },
            llenarEstadoPedido(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110063,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayEstadoPedido = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            buscarPedidos(){
                this.listarPedidos(1);
            },
            listarPedidos(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/pedido/GetListPedidoByTipoEstado';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidsucursal': 1300013,
                        'dfechainicio': this.fillPedido.dfechainicio,
                        'dfechafin': this.fillPedido.dfechafin,
                        'cnumeropedido': this.fillPedido.cnumeropedido,
                        'cnumerovin': this.fillPedido.cnumerovin,
                        'nidmarca': this.formPedido.nidmarca,
                        'nidmodelo': this.formPedido.nidmodelo,
                        'nidestadopedido': this.fillPedido.nidestadopedido,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayPedido = response.data.arrayPedido.data;
                    this.pagination.current_page =  response.data.arrayPedido.current_page;
                    this.pagination.total = response.data.arrayPedido.total;
                    this.pagination.per_page    = response.data.arrayPedido.per_page;
                    this.pagination.last_page   = response.data.arrayPedido.last_page;
                    this.pagination.from        = response.data.arrayPedido.from;
                    this.pagination.to           = response.data.arrayPedido.to;
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarPedidos(page);
            },
            // ==========================================================
            // =============  TAB GENERAR PEDIDO ========================
            tabGenerarPedido(){
                this.llenarComboMarcas();
                this.llenarComboModelos();
                this.limpiarFormulario();
                this.vistaFormularioPedido = 1;
            },            
            llenarComboMarcas(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110032,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayMarca = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboModelos(){
                var url = this.ruta + '/versionvehiculo/GetModeloByMarca';

                axios.get(url,{
                    params: {
                        'nidmarca' : this.formPedido.nidmarca
                    }
                }).then(response => {
                    this.arrayModelo = response.data;
                    this.formPedido.nidmodelo = 0;
                }).catch(error => {
                    console.log(error);
                });
            },
            //============= LISTAR COTIZACIONES INGRESADAS ==============
            buscarCotizacionesIngresadas(){
                this.listarCotizacionesIngresadas(1);
            },
            listarCotizacionesIngresadas(page){
                this.mostrarProgressBar();
                var url = this.ruta + '/pedido/GetLstCotizacionIngresadas';
                axios.get(url, {
                    params: {
                        'nidempresa' : 1300011,
                        'nidsucursal' : 1300013,
                        'dfechainicio' : this.formPedido.dfechainicio,
                        'dfechafin' : this.formPedido.dfechafin,
                        'nidmarca' : this.formPedido.nidmarca,
                        'nidmodelo' : this.formPedido.nidmodelo,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayPedido = response.data.arrayPedido.data;
                    this.pagination.current_page =  response.data.arrayPedido.current_page;
                    this.pagination.total = response.data.arrayPedido.total;
                    this.pagination.per_page    = response.data.arrayPedido.per_page;
                    this.pagination.last_page   = response.data.arrayPedido.last_page;
                    this.pagination.from        = response.data.arrayPedido.from;
                    this.pagination.to           = response.data.arrayPedido.to;
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaCotizacion(page){
                this.pagination.current_page=page;
                this.listarCotizacionesIngresadas(page);
            },
            desactivar(nIdPedido){
                
                swal({
                        title: 'Estas seguro de eliminar esta Pedido?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Desactivar!',
                        cancelButtonText: 'No, cancelar!'
                        }).then((result) => {
                        var url = this.ruta + '/compra/desactivar';
                        axios.put(url, {
                            nIdPedido: nIdPedido
                        }).then(response => {                            
                            swal(
                            'Desactivado!',
                            'El registro fue eliminado.'
                            );
                            this.listarPedidos(1);                   
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    })
            },
            //=============== APROBAR COTIZACION ========================
            aprobarCotizacion(nIdCabeceraCotizacion, cNumeroCotizacion, cContacto){
                this.formPedido.cnombrecontacto = cContacto;
                this.formCompra.nidcabeceracotizacion = nIdCabeceraCotizacion;
                this.formDocRef.cnrocotizacion = cNumeroCotizacion;
                this.vistaFormularioPedido = 0;
                this.listarCompras(1);
            },
            //=============== TAB ASIGNAR COMPRA ========================
            tabAsignarCompra(){
                $('#Tab1').addClass('nav-link active');
                $('#Tab2').removeClass('nav-link active');
                $('#Tab2').addClass("nav-link disabled");
                $('#Tab3').removeClass('nav-link active');
                $('#Tab3').addClass('nav-link disabled');
                $('#TabAsignarCompra').addClass('in active show');
                $('#TabDocReferencias').removeClass('in active show');
                $('#TabDocAsociados').removeClass('in active show');
            },
            listarCompras(page){
                this.mostrarProgressBar();
                var url = this.ruta + '/pedido/GetLstCompraByIdModelo';
                axios.get(url, {
                    params: {
                        'nidempresa' : 1300011,
                        'nidsucursal' : 1300013,
                        'nidcabeceracotizacion' : this.formCompra.nidcabeceracotizacion,
                        'cnumerovin' : this.formCompra.cnumerovin,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayCompra = response.data.arrayCompra.data;
                    this.pagination.current_page =  response.data.arrayCompra.current_page;
                    this.pagination.total = response.data.arrayCompra.total;
                    this.pagination.per_page    = response.data.arrayCompra.per_page;
                    this.pagination.last_page   = response.data.arrayCompra.last_page;
                    this.pagination.from        = response.data.arrayCompra.from;
                    this.pagination.to           = response.data.arrayCompra.to;
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaCompra(page){
                this.pagination.current_page=page;
                this.listarCompras(page);
            },
            //============= TAB DOCUMENTOS REFERENCIAS ==================
            activarTabDocReferencias(nIdCompra, cNumeroVin, nOrdenCompra, cNombreComercial, nAnioFabricacion, nAnioModelo, cNombreColor, cNombreMotor){
                $('#Tab1').removeClass('nav-link active');
                $('#Tab1').addClass("nav-link");
                $('#Tab2').removeClass('nav-link disabled');
                $('#Tab2').addClass("nav-link active");
                $('#TabAsignarCompra').removeClass('in active show');
                $('#TabDocReferencias').addClass('in active show');
                this.formDocRef.nidcompra = nIdCompra;
                this.formDocRef.cnrovin = cNumeroVin;
                this.formDocRef.nordencompra = nOrdenCompra;
                this.formDocRef.cnombrecomercial = cNombreComercial;
                this.formDocRef.naniofabricacion = nAnioFabricacion;
                this.formDocRef.naniomodelo = nAnioModelo;
                this.formDocRef.ccolor = cNombreColor;
                this.formDocRef.cmotor = cNombreMotor;
                this.obtenerFechaRegistroPedido();
                this.listarDatosListaPrecioDetalle(parseInt(this.formCompra.nidcabeceracotizacion));
                this.llenarComboBanco();
                this.llenarFormaPago();
            },
            obtenerFechaRegistroPedido(){
                var f = new Date();
                var day = String(f.getDate());
                var month = String((f.getMonth() +1));
                if (month.length < 2){
                    month = "0" + "" + month;
                }
                if (day.length < 2){
                    day = "0" + "" + day;
                }
                this.formDocRef.dfechapedido  = day + "/" + month + "/" + f.getFullYear();
            },
            listarDatosListaPrecioDetalle(nidcabeceracotizacion){
                this.mostrarProgressBar();

                var url = this.ruta + '/pedido/GetListaPrecioDetalleByIdCotizacion';
                axios.get(url, {
                    params: {
                        'nidempresa' : 1300011,
                        'nidsucursal' : 1300013,
                        'nidcabeceracotizacion' : this.formCompra.nidcabeceracotizacion
                    }
                }).then(response => {
                    this.formDocRef.fpreciolista = response.data[0].fPrecioLista;
                    this.formDocRef.fprecioventap = response.data[0].fPrecioVentaP;
                    this.formDocRef.fdescuentolista = response.data[0].fDescuento;
                    this.formDocRef.fbono = response.data[0].fBono;
                    this.formDocRef.fbonoespecial = response.data[0].fBonoEspecial;
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboBanco(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid': 110042,
                        'opcion': 0
                    }
                }).then(response => {
                    this.arrayBanco = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarFormaPago(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid': 110062,
                        'opcion': 0
                    }
                }).then(response => {
                    this.arrayFormaPago = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            //============= TAB DOCUMENTOS ASOCIADOS ===================
            activarTabDocAsociados(){
                if(this.validaMostrarTabAsociados()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#Tab2').removeClass('nav-link active');
                $('#Tab2').addClass("nav-link");
                $('#Tab3').removeClass('nav-link disabled');
                $('#Tab3').addClass("nav-link active");
                $('#TabDocReferencias').removeClass('in active show');
                $('#TabDocAsociados').addClass('in active show');
                this.llenarTablaDocumentos();
            },
            validaMostrarTabAsociados(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formDocRef.nidformapago == 0){
                    this.mensajeError.push('Debes Seleccionar Forma de Pago');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            llenarTablaDocumentos(){
                var url = this.ruta + '/parametro/GetListParametroByGrupo';
                
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110068,
                        'opcion' : 1
                    }
                }).then(response => {
                    this.arrayTablaDocumento = response.data.arrayParametro.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            getFile(e){
                let selectFile = e.target.files;
                for(let i= 0; i < selectFile.length; i++){
                    this.attachment.push(selectFile[i]);
                }
            },
            registrarPedido(){
                /*if(this.validarRegistrarCotizacion()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }*/

                var url = this.ruta + '/pedido/SetCabeceraPedido';
                axios.post(url, {
                    'nIdEmpresa': 1300011,
                    'nIdSucursal': 1300013,
                    'nIdCabeceraCotizacion': this.formCompra.nidcabeceracotizacion,
                    'nIdCompra': this.formDocRef.nidcompra,
                    'cNumeroPedido': 'PEDIDO-001',
                    'dFechaPedido': moment().format('YYYY-MM-DD'),
                    'nIdFormaPago': this.formDocRef.nidformapago,
                    'cGlosa': 'REGISTRO DE PEDIDO'
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        this.subirArchivos(response.data[0].nIdCabeceraPedido);
                    }
                    else{
                        swal('VIN no Disponible');
                    }
                }).catch(error => {
                    this.errors = error
                });
            },
            subirArchivos(nIdCabeceraPedido){
                this.mostrarProgressBar();
                let me = this;

                for(let i= 0; i < this.attachment.length; i++){
                    this.form.append('file[]', this.attachment[i]);
                }

                this.arrayTablaDocumento.map(function(info, i) {
                    me.form.append('data['+i+']["nIdPar"]', info.nIdPar);
                    me.form.append('data['+i+']["cParNombre"]', info.cParNombre);
                    me.form.append('data['+i+']["nIdCabeceraPedido"]', nIdCabeceraPedido);
                });

                const config = { headers: { 'Content-Type': 'multipart/form-data'  } };

                var url = this.ruta + '/pedido/subirArchivo';

                axios.post(url, this.form, config).then(response=>{
                    swal('Pedido registrado exitosamente');
                    this.vistaFormularioPedido = 1;
                    this.limpiarFormulario();
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            // ==========================================================
            // =============  BUSCAR PROVEEDORES ========================
            buscaProveedores(){
                this.listarProveedores(1);
            },
            listarProveedores(page){
                var url = this.ruta + '/parametro/GetLstProveedor';
                
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidgrupopar' : 110023,
                        'cnombreproveedor' : this.fillProveedor.cnombreproveedor.toString(),
                        'opcion' : 1,
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
                });
            },
            cambiarPaginaProveedor(page){
                this.paginationModal.current_page=page;
                this.listarProveedores(page);
            },
            asignarProveedor(nProveedorId, cProveedorNombre){
                this.formPedido.nidproveedor = nProveedorId;
                this.formPedido.cproveedornombre = cProveedorNombre;
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
                }
            },
            // ===========================================================
            limpiarFormulario(){
                this.arrayPedido = [];
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
            this.llenarComboMarcas();
            this.llenarComboModelos();
            this.llenarEstadoPedido();
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