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
<<<<<<< HEAD
                                    <a class="nav-link active" href="#TabBuscaCompra" @click="limpiarFormulario();" role="tab" data-toggle="tab">
                                        <i class="fa fa-search"></i> BUSCAR COMPRA
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#TabGeneraCompra" @click="tabGenerarCompra();" role="tab" data-toggle="tab">
                                        <i class="fa fa-bus"></i> GENERAR COMPRA
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#TabAsignaCaracter" @click="limpiarFormulario();" role="tab" data-toggle="tab">
                                        <i class="fa fa fa-clipboard"></i> ASIGNAR CARACTERÍSTICAS
=======
                                    <a class="nav-link active" href="#TabBuscaPedido" @click="tabBuscarPedido()" role="tab" data-toggle="tab">
                                        <i class="fa fa-search"></i> BUSCAR PEDIDOS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#TabGeneraPedido" @click="tabGenerarPedido()" role="tab" data-toggle="tab">
                                        <i class="fa fa-list-alt"></i> GENERAR PEDIDO
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
<<<<<<< HEAD
                                <div class="tab-pane fade in active show" id="TabBuscaCompra">
=======
                                <div class="tab-pane fade in active show" id="TabBuscaPedido">
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
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
                                                                        <label class="col-sm-4 form-control-label">Fecha Inicio</label>
                                                                        <div class="col-sm-8">
<<<<<<< HEAD
                                                                            <input type="date" v-model="fillCompra.dfechainicio" class="form-control form-control-sm">
=======
                                                                            <input type="date" v-model="fillPedido.dfechainicio" class="form-control form-control-sm">
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Fecha Fin</label>
                                                                        <div class="col-sm-8">
<<<<<<< HEAD
                                                                            <input type="date" v-model="fillCompra.dfechafin" class="form-control form-control-sm">
=======
                                                                            <input type="date" v-model="fillPedido.dfechafin" class="form-control form-control-sm">
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
<<<<<<< HEAD
                                                                        <label class="col-sm-4 form-control-label">Nº Orden Compra</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="fillCompra.nordencompra" @keyup.enter="buscarCompras()" class="form-control form-control-sm">
=======
                                                                        <label class="col-sm-4 form-control-label">Nº Orden Pedido</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="fillPedido.nordencompra" @keyup.enter="buscarPedidos()" class="form-control form-control-sm">
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Nro Vin</label>
                                                                        <div class="col-sm-8">
<<<<<<< HEAD
                                                                            <input type="text" v-model="fillCompra.cnumerovin" @keyup.enter="buscarCompras()" class="form-control form-control-sm">
=======
                                                                            <input type="text" v-model="fillPedido.cnumerovin" @keyup.enter="buscarPedidos()" class="form-control form-control-sm">
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">        
                                                                <div class="col-sm-9 offset-sm-4">
<<<<<<< HEAD
                                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarCompras();"><i class="fa fa-search"></i> Buscar</button>
=======
                                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarPedidos();"><i class="fa fa-search"></i> Buscar</button>
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
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
<<<<<<< HEAD
                                                        <template v-if="arrayCompra.length">
=======
                                                        <template v-if="arrayPedido.length">
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                                                            <div class="table-responsive">
                                                                <table class="table table-striped table-sm">
                                                                    <thead>
                                                                        <tr>
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
                                                                            <th>Acciones</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
<<<<<<< HEAD
                                                                        <tr v-for="compra in arrayCompra" :key="compra.nIdCompra">
                                                                            <td v-text="compra.nIdCompra"></td>
                                                                            <td v-text="compra.cNumeroMes + '-' + compra.cAnio"></td>
                                                                            <td v-text="compra.nOrdenCompra"></td>
=======
                                                                        <tr v-for="compra in arrayPedido" :key="compra.nIdPedido">
                                                                            <td v-text="compra.nIdPedido"></td>
                                                                            <td v-text="compra.cNumeroMes + '-' + compra.cAnio"></td>
                                                                            <td v-text="compra.nOrdenPedido"></td>
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                                                                            <td v-text="compra.cNombreLinea"></td>
                                                                            <td v-text="compra.cNombreAlmacen"></td>
                                                                            <td v-text="compra.nNumeroReserva"></td>
                                                                            <td v-text="compra.cNumeroVin"></td>
                                                                            <td v-text="compra.cFormaPago"></td>
                                                                            <td v-text="compra.cNombreComercial"></td>
                                                                            <td v-text="compra.nAnioFabricacion"></td>
                                                                            <td v-text="compra.nAnioVersion"></td>
                                                                            <td v-text="compra.cSimboloMoneda"></td>
<<<<<<< HEAD
                                                                            <td v-text="compra.fTotalCompra"></td>
                                                                            <td v-text="compra.cNumeroFactura"></td>
                                                                            <td v-text="compra.dFechaFacturado"></td>
                                                                            <td>
                                                                                <a href="#" @click="desactivar(compra.nIdCompra)" data-toggle="tooltip" data-placement="top" :title="'Anular O/C ' +compra.nOrdenCompra">
=======
                                                                            <td v-text="compra.fTotalPedido"></td>
                                                                            <td v-text="compra.cNumeroFactura"></td>
                                                                            <td v-text="compra.dFechaFacturado"></td>
                                                                            <td>
                                                                                <a href="#" @click="desactivar(compra.nIdPedido)" data-toggle="tooltip" data-placement="top" :title="'Anular O/C ' +compra.nOrdenPedido">
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                                                                                    <i :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                </a>
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
                                </div>
<<<<<<< HEAD
                                <div role="tabpanel" class="tab-pane fade" id="TabGeneraCompra">
=======
                                <div role="tabpanel" class="tab-pane fade" id="TabGeneraPedido">
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
<<<<<<< HEAD
                                                        <h3 class="h4">GENERAR COMPRA</h3>
=======
                                                        <h3 class="h4">BUSCAR COTIZACIONES</h3>
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
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
<<<<<<< HEAD
                                                                        <label class="col-sm-4 form-control-label">* Año</label>
=======
                                                                        <label class="col-sm-4 form-control-label">* Fecha Inicio</label>
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="canio" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
<<<<<<< HEAD
                                                                        <label class="col-sm-4 form-control-label">* Mes</label>
=======
                                                                        <label class="col-sm-4 form-control-label">* Fecha Fin</label>
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="cmes" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
<<<<<<< HEAD
                                                                        <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                                        <div class="col-sm-8">
                                                                            <div class="input-group">
                                                                                <input type="hidden" v-model="formCompra.nidproveedor">
                                                                                <input type="text" v-model="formCompra.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
                                                                                <div class="input-group-prepend">
                                                                                    <button type="button" title="Buscar Proveedor" class="btn btn-info btn-corner btn-sm" @click="abrirModal('proveedor','buscar')">
                                                                                        <i class="fa-lg fa fa-search"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
=======
                                                                        <label class="col-sm-4 form-control-label">Marca</label>
                                                                        <div class="col-sm-8">
                                                                            <select name="account" v-model="formPedido.nidmarca" class="form-control form-control-sm" v-on:change="llenarComboModelo();">
                                                                                <option v-for="marca in arrayMarca" :key="marca.nIdPar" :value="marca.nIdPar" v-text="marca.cParNombre">
                                                                                </option>
                                                                            </select>
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
<<<<<<< HEAD
                                                                        <label class="col-sm-4 form-control-label">* Tipo Lista</label>
                                                                        <div class="col-sm-8">
                                                                            <select name="account" v-model="formCompra.nidtipolista" class="form-control form-control-sm">
                                                                                <option v-for="tipolista in arrayTipoLista" :key="tipolista.nIdPar" :value="tipolista.nIdPar" v-text="tipolista.cParNombre">
=======
                                                                        <label class="col-sm-4 form-control-label">Modelo</label>
                                                                        <div class="col-sm-8">
                                                                            <select name="account" v-model="formPedido.nidmodelo" class="form-control form-control-sm">
                                                                                <option v-for="modelo in arrayModelo" :key="modelo.nIdPar" :value="modelo.nIdPar" v-text="modelo.cParNombre">
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                                                                                </option>
                                                                            </select>
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
                                                                <div class="col-sm-5">
                                                                    <div class="row">
<<<<<<< HEAD
                                                                        <label class="col-sm-6 form-control-label">* Ordenes de Compra</label>
=======
                                                                        <label class="col-sm-6 form-control-label">* Ordenes de Pedido</label>
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                                                                        <div class="col-sm-6">
                                                                            <label for="file-upload" class="btn btn-warning btn-corner btn-sm">
                                                                                <i class="fa fa-file-excel-o"></i> Seleccionar Archivo
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-7">
                                                                    <div class="row">
                                                                        <input type="text" v-model="textFile" class="col-sm-6 form-control form-control-sm" readonly>
                                                                        <input type="file" id="file-upload" @change="getFile" accept=".xls,.xlsx"/>
                                                                        <div class="col-sm-6">
<<<<<<< HEAD
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="importFileCompra()">
=======
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="importFilePedido()">
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                                                                                <i class="fa fa-retweet"></i> Procesar
                                                                            </button>
                                                                        </div>
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
                                                                                <th>Nro Factura</th>
                                                                                <th>Fecha Facturado</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
<<<<<<< HEAD
                                                                            <tr v-for="(compra, index) in arrayExcel" :key="compra.nOrdenCompra">
                                                                                <td>
                                                                                    <a href="#" @click="eliminarItemExcel(index);" data-toggle="tooltip" data-placement="top" :title="'Eliminar ' +compra.nOrdenCompra">
                                                                                    <i :style="'color:red'" class="fa-md fa fa-times-circle"></i></a>
                                                                                </td>
                                                                                <td v-text="compra.nOrdenCompra"></td>
=======
                                                                            <tr v-for="(compra, index) in arrayExcel" :key="compra.nOrdenPedido">
                                                                                <td>
                                                                                    <a href="#" @click="eliminarItemExcel(index);" data-toggle="tooltip" data-placement="top" :title="'Eliminar ' +compra.nOrdenPedido">
                                                                                    <i :style="'color:red'" class="fa-md fa fa-times-circle"></i></a>
                                                                                </td>
                                                                                <td v-text="compra.nOrdenPedido"></td>
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
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
<<<<<<< HEAD
                                                                                <td v-text="compra.fTotalCompra"></td>
=======
                                                                                <td v-text="compra.fTotalPedido"></td>
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                                                                                <td v-text="compra.cNumeroFactura"></td>
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
<<<<<<< HEAD
                                <div role="tabpanel" class="tab-pane fade" id="TabAsignaCaracter">ccc</div>
=======
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
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
<<<<<<< HEAD
                arrayCompra: [],
=======
                arrayPedido: [],
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                arrayExcel: [],
                contadorArrayExcel: 0,
                arrayTipoLista: [],
                arrayProveedor: [],
<<<<<<< HEAD
                fillProveedor:{
                    cnombreproveedor: ''
                },
                fillCompra:{
=======
                arrayMarca: [],
                arrayModelo: [],
                fillProveedor:{
                    cnombreproveedor: ''
                },
                fillPedido:{
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                    dfechainicio: '',
                    dfechafin: '',
                    nordencompra: '',
                    cnumerovin: ''
                },
<<<<<<< HEAD
                formCompra:{
=======
                formPedido:{
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                    nformapago: 0,
                    nidtipolista: 0,
                    nidproveedor: 0,
                    cproveedornombre: ''
                },
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
                attachment: null,
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
<<<<<<< HEAD
            buscarCompras(){
                this.listarCompras(1);
            },
            listarCompras(page){
                this.mostrarProgressBar();
                if(this.fillCompra.nordencompra == ''){
                    var nordencompra = 0;
                }
                else{
                    var nordencompra = this.fillCompra.nordencompra;
                }

                var url = this.ruta + '/compra/GetCompra';
=======
            tabBuscarPedido(){
                
            },
            buscarPedidos(){
                this.listarPedidos(1);
            },
            listarPedidos(page){
                this.mostrarProgressBar();
                if(this.fillPedido.nordencompra == ''){
                    var nordencompra = 0;
                }
                else{
                    var nordencompra = this.fillPedido.nordencompra;
                }

                var url = this.ruta + '/compra/GetPedido';
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidsucursal' : 1300013,
<<<<<<< HEAD
                        'dfechainicio' : this.fillCompra.dfechainicio,
                        'dfechafin' : this.fillCompra.dfechafin,
                        'nordencompra' : nordencompra,
                        'cnumerovin' : this.fillCompra.cnumerovin,
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
=======
                        'dfechainicio' : this.fillPedido.dfechainicio,
                        'dfechafin' : this.fillPedido.dfechafin,
                        'nordencompra' : nordencompra,
                        'cnumerovin' : this.fillPedido.cnumerovin,
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
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
<<<<<<< HEAD
                this.listarCompras(page);
            },
            tabGenerarCompra(){
=======
                this.listarPedidos(page);
            },
            tabGenerarPedido(){
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
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
<<<<<<< HEAD
                this.formCompra.nidproveedor = nProveedorId;
                this.formCompra.cproveedornombre = cProveedorNombre;
=======
                this.formPedido.nidproveedor = nProveedorId;
                this.formPedido.cproveedornombre = cProveedorNombre;
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                this.cerrarModal();
            },
            listarTipoLista(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110044,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayTipoLista = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            getFile(e){
                //console.log(e);
                let selectFile = e.target.files[0];
                this.attachment = selectFile;
                this.textFile = e.target.files[0].name;
            },
<<<<<<< HEAD
            importFileCompra(){
                if(this.validarReadFileCompra()){
=======
            importFilePedido(){
                if(this.validarReadFilePedido()){
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.form.append('file', this.attachment);
                const config = { headers: { 'Content-Type': 'multipart/form-data'  } };
                //var fd = new FormData();
                //fd.append('file', this.fileExcel, this.fileExcel.name);
<<<<<<< HEAD
                var url = this.ruta + '/compra/importFileCompra';
                axios.post(url, this.form, config).then(response=>{
                    this.readFileCompra(response.data);
=======
                var url = this.ruta + '/compra/importFilePedido';
                axios.post(url, this.form, config).then(response=>{
                    this.readFilePedido(response.data);
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                }).catch(error => {
                    console.log(error);
                });
            },
<<<<<<< HEAD
            readFileCompra(nameFile){
                this.mostrarProgressBar();

                var url = this.ruta + '/compra/readFileCompra';
=======
            readFilePedido(nameFile){
                this.mostrarProgressBar();

                var url = this.ruta + '/compra/readFilePedido';
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                axios.post(url, {
                    nameFile: nameFile
                }).then(response => {

                    if(this.validaCamposExcel(response.data)){
                        this.accionmodal=1;
                        this.modal = 1;
                        return;
                    }

                    this.$delete(response.data, 0)
                    this.arrayExcel = response.data;
                    this.contadorArrayExcel = response.data.length;
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            validaCamposExcel(foo){
                this.error = 0;
                this.mensajeError = [];
                var list=[];

                foo.map(function(value, key) {
                    if(key==0){
<<<<<<< HEAD
                        if(value.nOrdenCompra != "OC"){
=======
                        if(value.nOrdenPedido != "OC"){
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
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
<<<<<<< HEAD
                        if(value.fTotalCompra != "Total"){
=======
                        if(value.fTotalPedido != "Total"){
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                            list.push('Falta celda Total, verifique el archivo.');
                        };
                    };
                    /*if(key != 0){
<<<<<<< HEAD
                        if(!/^([0-9])*[.]?[0-9]*$/.test(value.fTotalCompra)){
=======
                        if(!/^([0-9])*[.]?[0-9]*$/.test(value.fTotalPedido)){
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
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
            eliminarItemExcel(index){
                //this.arrayExcel.splice(index, 1);
                //this.$set(this, 'imageList', this.images);
                this.$delete(this.arrayExcel, index);
            },
            registrar(){
<<<<<<< HEAD
                this.arrayCompra = this.arrayExcel;
=======
                this.arrayPedido = this.arrayExcel;
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf

                if(this.validarRegistro()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                
<<<<<<< HEAD
                var url = this.ruta + '/compra/SetCompra';
=======
                var url = this.ruta + '/compra/SetPedido';
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                axios.post(url, {
                    nIdEmpresa: 1300011,
                    nIdSucursal: 1300013,
                    nIdCronograma: 220011,
<<<<<<< HEAD
                    nIdProveedor: this.formCompra.nidproveedor,
                    nIdTipoLista: this.formCompra.nidtipolista,
                    data: this.arrayCompra,
                    nIdUsuario: 190011
                }).then(response => {
                    swal('Compra registrada');
                    this.arrayExcel = [];
                    this.arrayCompra = [];
=======
                    nIdProveedor: this.formPedido.nidproveedor,
                    nIdTipoLista: this.formPedido.nidtipolista,
                    data: this.arrayPedido,
                    nIdUsuario: 190011
                }).then(response => {
                    swal('Pedido registrada');
                    this.arrayExcel = [];
                    this.arrayPedido = [];
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                    this.attachment = null;
                    this.textFile = '';
                    $("#file").val("");
                }).catch(error => {
                    console.log(error);
                });
                
                
            },
            validarRegistro(){
                this.error = 0;
                this.mensajeError =[];
                if(!this.textFile){
                    this.mensajeError.push('No hay Archivos Seleccionados');
                }
<<<<<<< HEAD
                if(this.arrayCompra == []){
                    this.mensajeError.push('No hay Datos a Registrar');
                };
                if(this.formCompra.nidproveedor == 0){
                    this.mensajeError.push('Debes seleccionar un Proveedor');
                };
                if(this.formCompra.nidtipolista == 0){
=======
                if(this.arrayPedido == []){
                    this.mensajeError.push('No hay Datos a Registrar');
                };
                if(this.formPedido.nidproveedor == 0){
                    this.mensajeError.push('Debes seleccionar un Proveedor');
                };
                if(this.formPedido.nidtipolista == 0){
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                    this.mensajeError.push('Debes seleccionar un Tipo Lista');
                };

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
<<<<<<< HEAD
            validarReadFileCompra(){
=======
            validarReadFilePedido(){
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                this.error = 0;
                this.mensajeError =[];
                if(!this.textFile){
                    this.mensajeError.push('No hay Archivos Seleccionados');
                }
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
<<<<<<< HEAD
            desactivar(nIdCompra){
                
                swal({
                        title: 'Estas seguro de eliminar esta Compra?',
=======
            desactivar(nIdPedido){
                
                swal({
                        title: 'Estas seguro de eliminar esta Pedido?',
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Desactivar!',
                        cancelButtonText: 'No, cancelar!'
                        }).then((result) => {
                        var url = this.ruta + '/compra/desactivar';
                        axios.put(url, {
<<<<<<< HEAD
                            nIdCompra: nIdCompra
=======
                            nIdPedido: nIdPedido
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                        }).then(response => {                            
                            swal(
                            'Desactivado!',
                            'El registro fue eliminado.'
                            );
<<<<<<< HEAD
                            this.listarCompras(1);                   
=======
                            this.listarPedidos(1);                   
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    })
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
                }
            },
            limpiarFormulario(){
<<<<<<< HEAD
                this.fillCompra.nordencompra= '',
                this.fillCompra.cnumerovin=  '',
                this.arrayExcel = [],
                this.arrayCompra = [],
=======
                this.fillPedido.nordencompra= '',
                this.fillPedido.cnumerovin=  '',
                this.arrayExcel = [],
                this.arrayPedido = [],
>>>>>>> 93969adf5aeb9ff3360542055e0da725090078cf
                this.limpiarPaginacion()
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
        input[type="file"] {
            display: none;
        }
</style>