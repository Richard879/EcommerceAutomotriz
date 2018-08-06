<template>
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
                                                                        <label class="col-sm-4 form-control-label">Fecha Inicio</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="date" v-model="fillCompra.dfechainicio" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Fecha Fin</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="date" v-model="fillCompra.dfechafin" class="form-control form-control-sm">
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
                                                                <div class="col-sm-9 offset-sm-4">
                                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarCompras();"><i class="fa fa-search"></i> Buscar</button>
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
                                                                        <tr v-for="compra in arrayCompra" :key="compra.nIdCompra">
                                                                            <td>{{ compra.nIdCompra }}</td>
                                                                            <td>{{ compra.cNumeroMes + '-' + compra.cAnio }}</td>
                                                                            <td>{{ compra.nOrdenCompra }}</td>
                                                                            <td>{{ compra.cNombreLinea }}</td>
                                                                            <td>{{ compra.cNombreAlmacen }}</td>
                                                                            <td>{{ compra.nNumeroReserva }}</td>
                                                                            <td>{{ compra.cNumeroVin }}</td>
                                                                            <td>{{ compra.cFormaPago }}</td>
                                                                            <td>{{ compra.cNombreComercial }}</td>
                                                                            <td>{{ compra.nAnioFabricacion }}</td>
                                                                            <td>{{ compra.nAnioVersion }}</td>
                                                                            <td>{{ compra.cSimboloMoneda }}</td>
                                                                            <td>{{ compra.fTotalCompra }}</td>
                                                                            <td>{{ compra.cNumeroFactura }}</td>
                                                                            <td>{{ compra.dFechaFacturado }}</td>
                                                                            <td>
                                                                                <a href="#" @click="desactivar(compra.nIdCompra)" data-toggle="tooltip" data-placement="top" v-bind:title="'Anular O/C ' +compra.nOrdenCompra">
                                                                                    <i v-bind:style="'color:red'" class="fa-md fa fa-times-circle"></i>
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
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Tipo Lista</label>
                                                                        <div class="col-sm-8">
                                                                            <select name="account" v-model="formCompra.nidtipolista" class="form-control form-control-sm">
                                                                                <option v-for="tipolista in arrayTipoLista" :key="tipolista.nIdPar" :value="tipolista.nIdPar" v-text="tipolista.cParNombre">
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
                                                                        <label class="col-sm-6 form-control-label">* Ordenes de Compra</label>
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
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="importFileCompra()">
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
                                                                            <tr v-for="(compra, index) in arrayExcel" :key="compra.nOrdenCompra">
                                                                                <td>
                                                                                    <a href="#" @click="eliminarItemExcel(index);" data-toggle="tooltip" data-placement="top" v-bind:title="'Eliminar ' +compra.nOrdenCompra">
                                                                                    <i v-bind:style="'color:red'" class="fa-md fa fa-times-circle"></i></a>
                                                                                </td>
                                                                                <td>{{ compra.nOrdenCompra }}</td>
                                                                                <td>{{ compra.cNombreLinea }}</td>
                                                                                <td>{{ compra.cNombreAlmacen }}</td>
                                                                                <td>{{ compra.nNumeroReserva }}</td>
                                                                                <td>{{ compra.cNumeroVin }}</td>
                                                                                <td>{{ compra.cFormaPago }}</td>
                                                                                <td>{{ compra.cNombreMarca }}</td>
                                                                                <td>{{ compra.cNombreModelo }}</td>
                                                                                <td>{{ compra.cNombreComercial }}</td>
                                                                                <td>{{ compra.cNombreColor }}</td>
                                                                                <td>{{ compra.nAnioFabricacion }}</td>
                                                                                <td>{{ compra.nAnioVersion }}</td>
                                                                                <td>{{ compra.cSimboloMoneda }}</td>
                                                                                <td>{{ compra.fTotalCompra }}</td>
                                                                                <td>{{ compra.cNumeroFactura }}</td>
                                                                                <td>{{ compra.dFechaFacturado }}</td>
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
                                <div role="tabpanel" class="tab-pane fade" id="TabAsignaCaracter">ccc</div>
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
                        <form>
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
                                                                    <input type="text" v-model="fillProvedor.cnombreproveedor" @keyup.enter="buscaProveedores()" class="form-control form-control-sm">
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
                arrayCompra: [],
                arrayExcel: [],
                contadorArrayExcel: 0,
                arrayTipoLista: [],
                arrayProveedor: [],
                fillProvedor:{
                    cnombreproveedor: ''
                },
                fillCompra:{
                    dfechainicio: '',
                    dfechafin: '',
                    nordencompra: '',
                    cnumerovin: ''
                },
                formCompra:{
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
            buscarCompras(){
                this.listarCompras(1);
            },
            listarCompras(page){
                this.nidempresa = 1300011;
                this.nidsucursal = 1300013;
                if(this.fillCompra.nordencompra == ''){
                    var nordencompra = 0;
                }
                else{
                    var nordencompra = this.fillCompra.nordencompra;
                }

                var url = this.ruta + '/compra/GetCompra?nidempresa=' + this.nidempresa
                                                                + '&nidsucursal=' + this.nidsucursal
                                                                + '&dfechainicio=' + this.fillCompra.dfechainicio
                                                                + '&dfechafin=' + this.fillCompra.dfechafin
                                                                + '&nordencompra=' + nordencompra
                                                                + '&cnumerovin=' + this.fillCompra.cnumerovin
                                                                + '&page='+ page;
                axios.get(url).then(response => {
                    this.arrayCompra = response.data.arrayCompra.data;
                    this.pagination.current_page =  response.data.arrayCompra.current_page;
                    this.pagination.total = response.data.arrayCompra.total;
                    this.pagination.per_page    = response.data.arrayCompra.per_page;
                    this.pagination.last_page   = response.data.arrayCompra.last_page;
                    this.pagination.from        = response.data.arrayCompra.from;
                    this.pagination.to           = response.data.arrayCompra.to;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarCompras(page);
            },
            tabGenerarCompra(){
                this.listarTipoLista();
                this.limpiarFormulario();
            },
            buscaProveedores(){
                this.listarProveedores(1);
            },
            listarProveedores(page){
                var url = this.ruta + '/parametro/GetLstProveedor?nidempresa=' + 1300011 
                                                                    + '&nidgrupopar=' + 110023
                                                                    + '&cnombreproveedor=' + this.fillProvedor.cnombreproveedor.toString() 
                                                                    + '&opcion=' + 1
                                                                    + '&page='+ page;
                axios.get(url).then(response => {
                    this.arrayProveedor = response.data.arrayProveedor.data;
                    this.paginationModal.current_page =  response.data.arrayProveedor.current_page;
                    this.paginationModal.total = response.data.arrayProveedor.total;
                    this.paginationModal.per_page    = response.data.arrayProveedor.per_page;
                    this.paginationModal.last_page   = response.data.arrayProveedor.last_page;
                    this.paginationModal.from        = response.data.arrayProveedor.from;
                    this.paginationModal.to           = response.data.arrayProveedor.to;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            cambiarPaginaProveedor(page){
                this.paginationModal.current_page=page;
                this.listarProveedores(page);
            },
            asignarProveedor(nProveedorId, cProveedorNombre){
                this.formCompra.nidproveedor = nProveedorId;
                this.formCompra.cproveedornombre = cProveedorNombre;
                this.cerrarModal();
            },
            listarTipoLista(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110044 
                                                                                + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayTipoLista = response.data;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            getFile(e){
                //console.log(e);
                let selectFile = e.target.files[0];
                this.attachment = selectFile;
                this.textFile = e.target.files[0].name;
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
                });
            },
            readFileCompra(nameFile){
                var url = this.ruta + '/compra/readFileCompra';
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
            eliminarItemExcel(index){
                //this.arrayExcel.splice(index, 1);
                //this.$set(this, 'imageList', this.images);
                this.$delete(this.arrayExcel, index);
            },
            registrar(){
                this.arrayCompra = this.arrayExcel;

                if(this.validarRegistro()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                
                var url = this.ruta + '/compra/SetCompra';
                axios.post(url, {
                    nIdEmpresa: 1300011,
                    nIdSucursal: 1300013,
                    nIdCronograma: 220011,
                    nIdProveedor: this.formCompra.nidproveedor,
                    nIdTipoLista: this.formCompra.nidtipolista,
                    data: this.arrayCompra,
                    nIdUsuario: 190011
                }).then(response => {
                    swal('Compra registrada');
                    this.arrayExcel = [];
                    this.arrayCompra = [];
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
                if(this.arrayCompra == []){
                    this.mensajeError.push('No hay Datos a Registrar');
                };
                if(this.formCompra.nidproveedor == 0){
                    this.mensajeError.push('Debes seleccionar un Proveedor');
                };
                if(this.formCompra.nidtipolista == 0){
                    this.mensajeError.push('Debes seleccionar un Tipo Lista');
                };

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            validarReadFileCompra(){
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
            desactivar(nIdCompra){
                
                swal({
                        title: 'Estas seguro de eliminar esta Compra?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Desactivar!',
                        cancelButtonText: 'No, cancelar!'
                        }).then((result) => {
                        var url = this.ruta + '/compra/desactivar';
                        axios.put(url, {
                            nIdCompra: nIdCompra
                        }).then(response => {                            
                            swal(
                            'Desactivado!',
                            'El registro fue eliminado.'
                            );
                            this.listarCompras(1);                   
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
                this.fillCompra.nordencompra= '',
                this.fillCompra.cnumerovin=  '',
                this.arrayExcel = [],
                this.arrayCompra = [],
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
        }
    }
</script>
<style>
        .mostrar{
            display: list-item !important;
            opacity: 1 !important;
            position: fixed !important;
            background-color: #3c29297a !important;
        }
        .modal-content{
            width: 100% !important;
            position: fixed !important;
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
