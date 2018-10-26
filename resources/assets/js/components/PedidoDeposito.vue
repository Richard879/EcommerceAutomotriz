<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">DEPÓSITOS DE PEDIDO</h2>
                </div>
            </header>

            <section>
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Tab1" href="#TabBuscaPedido" @click="tabBuscarPedido" role="tab" data-toggle="tab">
                                            <i class="fa fa-search"></i> BUSCAR PEDIDOS
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="Tab2" href="#TabGeneraDeposito" @click="tabGenerarDeposito" role="tab" data-toggle="tab">
                                            <i class="fa fa-usd"></i> REALIZAR DEPÓSITOS
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
                                                                                <el-date-picker
                                                                                    v-model="fillPedido.dfechainicio"
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
                                                                                    v-model="fillPedido.dfechafin"
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
                                                                            <label class="col-sm-4 form-control-label">Nº Orden Pedido</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillPedido.cnumeropedido" @keyup.enter="buscarPedidos" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Nro Vin</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillPedido.cnumerovin" @keyup.enter="buscarPedidos" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Marca</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="fillPedido.nidmarca" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboModelos">
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
                                                                                <el-select v-model="fillPedido.nidmodelo" filterable clearable placeholder="SELECCIONE">
                                                                                    <el-option
                                                                                        v-for="item in arrayModelo"
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
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Estado Pedido</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="fillPedido.nidestadopedido" filterable clearable placeholder="SELECCIONE">
                                                                                    <el-option
                                                                                        v-for="item in arrayEstadoPedido"
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
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarPedidos">
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
                                                            <template v-if="arrayPedido.length">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Acciones</th>
                                                                                <th>Nro Pedido</th>
                                                                                <th>Vendedor</th>
                                                                                <th>Contacto</th>
                                                                                <th>Vehiculo</th>
                                                                                <th>Número VIN</th>
                                                                                <th>Número DUA</th>
                                                                                <th>Fecha Pedido</th>
                                                                                <th>Aprobación</th>
                                                                                <th>Estado Pedido</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="pedido in arrayPedido" :key="pedido.nIdCabeceraPedido">
                                                                                <td>
                                                                                    <template v-if="pedido.cFlagEstadoAprobacion == 'A'">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Seleccionar Pedido {{ pedido.cNumeroPedido }}</div>
                                                                                            <i @click="activarTabDeposito(pedido.nIdCabeceraPedido, pedido.cContacto)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                                        </el-tooltip>
                                                                                    </template>
                                                                                </td>
                                                                                <td v-text="pedido.cNumeroPedido"></td>
                                                                                <td v-text="pedido.cVendedorNombre"></td>
                                                                                <td v-text="pedido.cContacto"></td>
                                                                                <td v-text="pedido.cNombreComercial + ' ' + pedido.nAnioFabricacion + '-' + pedido.nAnioModelo"></td>
                                                                                <td v-text="pedido.cNumeroVin"></td>
                                                                                <td v-text="pedido.cNumeroDUA"></td>
                                                                                <td v-text="pedido.dFechaPedido"></td>
                                                                                <td v-text="pedido.cEstadoAprobacion"></td>
                                                                                <td v-text="pedido.cEstadoPedido"></td>
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
                                    <div role="tabpanel" class="tab-pane fade" id="TabGeneraDeposito">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">NUEVO DEPOSITO</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Tipo Movimiento</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="formDeposito.nidtipomovimiento"
                                                                                           filterable
                                                                                           clearable
                                                                                           placeholder="SELECCIONE TIPO MOVIMIENTO"
                                                                                           @change="ocultarFormularioDeposito">
                                                                                    <el-option
                                                                                        v-for="item in arrayTipoMovimiento"
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
                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="abrirFormularioDeposito">
                                                                            <i class="fa fa-list-alt"></i> Nuevo
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <template v-if="arrayTipoMovimientoPermisos.includes('1')">
                                                            <div class="card-header">
                                                                <h3 class="h4">BANCO ORIGEN</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="container-fluid">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Banco</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-select v-model="formNuevoDeposito.nidbanco_origen" filterable clearable placeholder="SELECCIONE" >
                                                                                        <el-option
                                                                                            v-for="item in arrayBanco_Origen"
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
                                                                                <label class="col-sm-4 form-control-label">* Moneda</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-select v-model="formNuevoDeposito.nidmoneda_origen" filterable clearable placeholder="SELECCIONE" >
                                                                                        <el-option
                                                                                        v-for="item in arrayMoneda_Origen"
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
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Cuenta</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" v-model="formNuevoDeposito.cnumerocuenta_origen" class="form-control form-control-sm">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Girado por</label>
                                                                                <div class="col-sm-8">
                                                                                    <label v-text="formNuevoDeposito.cnombrecontacto" class="form-control-label-readonly"></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Fecha Depósito</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-date-picker
                                                                                        v-model="formNuevoDeposito.dfechadeposito"
                                                                                        type="date"
                                                                                        value-format="yyyy-MM-dd"
                                                                                        format="dd-MM-yyyy"
                                                                                        placeholder="dd/mm/aaaa">
                                                                                    </el-date-picker>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Nro Operación</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" v-model="formNuevoDeposito.nnumerooperacion" class="form-control form-control-sm">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Tipo Cambio Voucher</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="number" v-model="formNuevoDeposito.ftipocambiovoucher" class="form-control form-control-sm">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Tipo Cambio Comercial</label>
                                                                                <div class="col-sm-8">
                                                                                    <label v-text="formNuevoDeposito.ftipocambiocomercial" class="form-control-label-readonly"></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Monto</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="number" v-model="formNuevoDeposito.fmonto" class="form-control form-control-sm">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Voucher</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="file" id="file-upload" @change="getFile" class="form-control form-control-sm"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Observación</label>
                                                                                <div class="col-sm-8">
                                                                                    <textarea v-model="formNuevoDeposito.cglosa" class="form-control form-control-sm" cols="30" rows="6"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-6 form-control-label" v-text="formNuevoDeposito.cflagtce ? 'Tipo Cambio Especial Activado' : 'Tipo Cambio Especial Desactivado'"></label>
                                                                                <div class="col-sm-5 widthFull">
                                                                                    <el-switch
                                                                                        v-model="formNuevoDeposito.cflagtce"
                                                                                        active-color="#13ce66"
                                                                                        inactive-color="#ff4949">
                                                                                    </el-switch>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-header">
                                                                <h3 class="h4">BANCO DESTINO</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="container-fluid">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Banco</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-select v-model="formNuevoDeposito.nidbanco_destino" filterable placeholder="SELECCIONE" v-on:change="onchangeBanco_Destino()">
                                                                                        <el-option
                                                                                        v-for="item in arrayBanco_Destino"
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
                                                                                <label class="col-sm-4 form-control-label">* Moneda</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-select v-model="formNuevoDeposito.nidmoneda_destino" filterable placeholder="SELECCIONE" v-on:change="onchangeMoneda_Destino()">
                                                                                        <el-option
                                                                                        v-for="item in arrayMoneda_Destino"
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
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Cuenta</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-select v-model="formNuevoDeposito.nidnumerocuenta_destino" filterable placeholder="SELECCIONE" >
                                                                                        <el-option
                                                                                        v-for="item in arrayCuenta_Destino"
                                                                                        :key="item.nIdCuenta"
                                                                                        :label="item.cNumeroCuenta"
                                                                                        :value="item.nIdCuenta">
                                                                                        </el-option>
                                                                                    </el-select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9 offset-sm-5">
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarOtroTipoDeposito">
                                                                                <i class="fa fa-save"></i> Registrar
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </template>
                                                        <template v-if="arrayTipoMovimientoPermisos.includes('2')">
                                                            <div class="card-header">
                                                                <h3 class="h4">DETALLE DEPÓSITO</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="container-fluid">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Banco</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-select v-model="formNuevoDeposito.nidbanco_destino" filterable placeholder="SELECCIONE" @change="onchangeBanco_Destino()">
                                                                                        <el-option
                                                                                            v-for="item in arrayBanco_Destino"
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
                                                                                <label class="col-sm-4 form-control-label">* Moneda</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-select v-model="formNuevoDeposito.nidmoneda_destino" filterable clearable placeholder="SELECCIONE" @change="onchangeMoneda_Destino()">
                                                                                        <el-option
                                                                                            v-for="item in arrayMoneda_Destino"
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
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Cuenta</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-select v-model="formNuevoDeposito.nidnumerocuenta_destino" filterable clearable placeholder="SELECCIONE" >
                                                                                        <el-option
                                                                                            v-for="item in arrayCuenta_Destino"
                                                                                            :key="item.nIdCuenta"
                                                                                            :label="item.cNumeroCuenta"
                                                                                            :value="item.nIdCuenta">
                                                                                        </el-option>
                                                                                    </el-select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Girado por</label>
                                                                                <div class="col-sm-8">
                                                                                    <label v-text="formNuevoDeposito.cnombrecontacto" class="form-control-label-readonly"></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Fecha Depósito</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-date-picker
                                                                                        v-model="formNuevoDeposito.dfechadeposito"
                                                                                        type="date"
                                                                                        value-format="yyyy-MM-dd"
                                                                                        format="dd-MM-yyyy"
                                                                                        placeholder="dd/mm/aaaa">
                                                                                    </el-date-picker>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Nro Operación</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" v-model="formNuevoDeposito.nnumerooperacion" class="form-control form-control-sm">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Tipo Cambio Voucher</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="number" v-model="formNuevoDeposito.ftipocambiovoucher" class="form-control form-control-sm">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Tipo Cambio Comercial</label>
                                                                                <div class="col-sm-8">
                                                                                    <label v-text="formNuevoDeposito.ftipocambiocomercial" class="form-control-label-readonly"></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Monto</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="number" v-model="formNuevoDeposito.fmonto" class="form-control form-control-sm">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Voucher</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="file" id="file-upload" @change="getFile" class="form-control form-control-sm"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Observación</label>
                                                                                <div class="col-sm-8">
                                                                                    <textarea v-model="formNuevoDeposito.cglosa" class="form-control form-control-sm" cols="30" rows="6"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9 offset-sm-5">
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarDeposito">
                                                                                <i class="fa fa-save"></i> Registrar
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </template>
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
        </main>
    </transition>
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
                // =========== VARIABLES TIPO CAMBIO ===============
                fValorTipoCambioCompra: 0,
                fValorTipoCambioVenta: 0,
                fValorTipocambioComercial: 0,
                // ======================================================
                // =========== VARIABLES TAB BUSCAR PEDIDO ==============
                fillPedido:{
                    dfechainicio: '',
                    dfechafin: '',
                    cnumeropedido: '',
                    cnumerovin: '',
                    nidmarca: '',
                    nidmodelo: '',
                    nidestadopedido: ''
                },
                arrayPedido: [],
                arrayEstadoPedido: [],
                arrayMarca: [],
                arrayModelo: [],
                // =============================================================
                // ================ VARIABLES TAB GENERAR PEDIDO ===============
                formDeposito:{
                    nidtipomovimiento: '',
                    nidcabecerapedido: 0
                },
                arrayTipoMovimiento: [],
                arrayTipoMovimientoPermisos: [],
                // =============================================================
                // ================ VARIABLES TAB GENERAR PEDIDO ===============
                formNuevoDeposito:{
                    nidbanco_origen: '',
                    nidmoneda_origen: '',
                    cnumerocuenta_origen: '',
                    nidbanco_destino: '',
                    nidmoneda_destino: '',
                    nidnumerocuenta_destino: '',
                    fmonto: 0,
                    cnombrecontacto: '',
                    dfechadeposito: '',
                    nnumerooperacion: '',
                    ftipocambiovoucher: '',
                    ftipocambiocomercial: '',
                    cglosa: '',
                    cflagtce: false
                },
                arrayBanco_Destino: [],
                arrayMoneda_Destino: [],
                arrayCuenta_Destino: [],
                arrayBanco_Origen: [],
                arrayMoneda_Origen: [],
                arrayCuenta_Origen: [],
                arrayDeposito: [],
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
            tabBuscarPedido(){
                $('#Tab1').removeClass('nav-link ');
                $('#Tab1').addClass("nav-link active");
                $('#Tab2').removeClass('nav-link active');
                $('#Tab2').addClass("nav-link disabled");
                $('#TabBuscaPedido').addClass('in active show');
                $('#TabGeneraDeposito').removeClass('in active show');
                this.limpiarFormulario();
            },
            llenarEstadoPedido(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';

                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110063
                    }
                }).then(response => {
                    this.arrayEstadoPedido = response.data;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            llenarComboMarcas(){
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
                            location.reload('0');
                        }
                    }
                });
            },
            llenarComboModelos(){
                var url = this.ruta + '/versionvehiculo/GetModeloByMarca';

                axios.get(url,{
                    params: {
                        'nidmarca' : this.fillPedido.nidmarca
                    }
                }).then(response => {
                    this.arrayModelo = response.data;
                    this.fillPedido.nidmodelo = '';
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            buscarPedidos(){
                this.listarPedidos(1);
            },
            listarPedidos(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/pedido/GetListPedidoAprobados';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidsucursal': sessionStorage.getItem("nIdSucursal"),
                        'dfechainicio': this.fillPedido.dfechainicio,
                        'dfechafin': this.fillPedido.dfechafin,
                        'cnumeropedido': this.fillPedido.cnumeropedido,
                        'cnumerovin': this.fillPedido.cnumerovin,
                        'nidmarca': this.fillPedido.nidmarca,
                        'nidmodelo': this.fillPedido.nidmodelo,
                        'nidestadopedido': this.fillPedido.nidestadopedido,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayPedido                = response.data.arrayPedido.data;
                    this.pagination.current_page    = response.data.arrayPedido.current_page;
                    this.pagination.total           = response.data.arrayPedido.total;
                    this.pagination.per_page        = response.data.arrayPedido.per_page;
                    this.pagination.last_page       = response.data.arrayPedido.last_page;
                    this.pagination.from            = response.data.arrayPedido.from;
                    this.pagination.to              = response.data.arrayPedido.to;
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarPedidos(page);
            },
            // ==========================================================
            // =============  TAB GENERAR DEPOSITO ========================
            tabGenerarDeposito(){
                this.formDeposito.nidtipomovimiento = '';
                this.limpiarFormularioDesposito();
            },
            activarTabDeposito(nIdCabeceraPedido, cContacto){
                this.tabGenerarDeposito();//Limpiar Formulario del TAB

                $('#Tab1').removeClass('nav-link active');
                $('#Tab1').addClass("nav-link");
                $('#Tab2').removeClass('nav-link disabled');
                $('#Tab2').addClass("nav-link active");
                $('#TabBuscaPedido').removeClass('in active show');
                $('#TabGeneraDeposito').addClass('in active show');

                this.formDeposito.nidcabecerapedido = nIdCabeceraPedido;
                this.formNuevoDeposito.cnombrecontacto = cContacto;
                this.llenarComboTipoMovimiento();
                this.arrayTipoMovimientoPermisos = [];//Seteo los permisos para visualizar formularios
            },
            llenarComboTipoMovimiento(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid': 110070,
                        'opcion': 0
                    }
                }).then(response => {
                    this.arrayTipoMovimiento = response.data;
                    this.$delete(this.arrayTipoMovimiento, 0);
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            //=============== MOSTRAR FORMULARIO DEPOSITO ========================
            mostrarFormularioDeposito(){
                this.getTipoCambio();
                this.llenarComboBanco_Destino();
                this.llenarComboMoneda_Destino();
            },
            mostrarFormularioOtroDeposito(){
                this.getTipoCambio();
                this.llenarComboBanco_Destino();
                this.llenarComboMoneda_Destino();
                this.llenarComboBanco_Origen();
                this.llenarComboMoneda_Origen();
            },
            getTipoCambio(){
                this.mostrarProgressBar();
                var url = this.ruta + '/gescotizacion/GetTipoCambio';
                axios.get(url).then(response => {
                    this.fValorTipoCambioCompra = response.data[0].fValorTipoCambioCompra;
                    this.fValorTipoCambioVenta = response.data[0].fValorTipoCambioVenta;
                    this.fValorTipocambioComercial = response.data[0].fValorTipoCambioComercial;

                    this.formNuevoDeposito.ftipocambiocomercial = response.data[0].fValorTipoCambioComercial;
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            llenarComboBanco_Destino(){
                var url = this.ruta + '/parparametro/GetBancosByEmpresa';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidgrupopar': 110021
                    }
                }).then(response => {
                    this.arrayBanco_Destino = response.data;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            llenarComboMoneda_Destino(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid': 110028
                    }
                }).then(response => {
                    this.arrayMoneda_Destino = response.data;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            onchangeBanco_Destino(){
                this.formNuevoDeposito.nidmoneda_destino = '';
                this.llenarComboCuenta_Destino();
            },
            onchangeMoneda_Destino(){
                this.llenarComboCuenta_Destino();
            },
            llenarComboCuenta_Destino(){
                var url = this.ruta + '/deposito/GetNumeroCuentaByBancoAndMoneda';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidbanco': this.formNuevoDeposito.nidbanco_destino,
                        'nidmoneda': this.formNuevoDeposito.nidmoneda_destino
                    }
                }).then(response => {
                    this.arrayCuenta_Destino = response.data;
                    this.formNuevoDeposito.nidnumerocuenta_destino = '';
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            llenarComboBanco_Origen(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid': 110042
                    }
                }).then(response => {
                    this.arrayBanco_Origen = response.data;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            llenarComboMoneda_Origen(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid': 110028
                    }
                }).then(response => {
                    this.arrayMoneda_Origen = response.data;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            getFile(e){
                let selectFile = e.target.files[0];
                this.attachment = selectFile;
            },
            abrirFormularioDeposito(){
                //SI NO ESTA SELECCIONADO
                if(this.formDeposito.nidtipomovimiento == ''){
                    if(this.validaMostrarFormularioDeposito()){
                        this.accionmodal=1;
                        this.modal = 1;
                        return;
                    }
                } else {
                    var url = this.ruta + '/tipoparametro/GetTipoByIdParametro';
                    axios.get(url, {
                        params: {
                            'nidpar' : this.formDeposito.nidtipomovimiento,
                            'ctipoparametro' : 'N',
                            'nidtipopar': 0
                        }
                    }).then(response => {
                        let datos = response.data;
                        let me = this;
                        me.limpiarFormularioDesposito();//Limpiar Formulario
                        me.arrayTipoMovimientoPermisos = [];//Seteo los permisos para visualizar formularios
                        datos.map(function(x, y){
                            //comprobar si un determinado elemento no existe dentro de un array
                            if (!me.arrayTipoMovimientoPermisos.includes(x.nDatoParNumerico)) {
                                me.arrayTipoMovimientoPermisos.push(x.nDatoParNumerico);
                            }
                        });
                        (this.arrayTipoMovimientoPermisos[0] == '1') ? this.mostrarFormularioOtroDeposito() : this.mostrarFormularioDeposito();
                    }).catch(error => {
                        console.log(error);
                        if (error.response) {
                            if (error.response.status == 401) {
                                location.reload('0');
                            }
                        }
                    });
                }
            },
            validaMostrarFormularioDeposito(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formDeposito.nidtipomovimiento == ''){
                    this.mensajeError.push('Debes seleccionar Tipo Movimiento');
                };

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            //=============== REGISTRO DEPOSITO == DEPOSITO BANCARIO EFECTIVO ========================
            registrarDeposito(){
                if(this.validarNuevoDeposito()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.subirArchivos();
            },
            subirArchivos(){
                this.mostrarProgressBar();

                this.form.append('file', this.attachment);
                const config = { headers: { 'Content-Type': 'multipart/form-data'  } };
                var url = this.ruta + '/deposito/subirArchivo';

                axios.post(url, this.form, config).then(response=>{
                    this.setNuevoDeposito(response.data[0].nIdDocumentoAdjunto);
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            setNuevoDeposito(nIdDocumentoAdjunto){
                var url = this.ruta + '/deposito/SetDepositoPedido';
                axios.post(url, {
                    'nIdEmpresa': 1300011,
                    'nIdSucursal': sessionStorage.getItem("nIdSucursal"),
                    'nIdCabeceraPedido': this.formDeposito.nidcabecerapedido,
                    'nIdTipoMovimiento': this.formDeposito.nidtipomovimiento,
                    'nIdDocumentoAdjuntoVoucher': nIdDocumentoAdjunto,
                    'nIdBancoOrigen': 0,
                    'nIdMonedaOrigen': 0,
                    'cNumeroCuentaOrigen': 0,
                    'nIdCuentaBancariaEmpresa': this.formNuevoDeposito.nidnumerocuenta_destino,
                    'dFechaDeposito': this.formNuevoDeposito.dfechadeposito,
                    'nNumeroOperacion': this.formNuevoDeposito.nnumerooperacion,
                    'fTipoCambioDeposito': this.formNuevoDeposito.ftipocambiovoucher,
                    'fTipoCambioComercial': this.formNuevoDeposito.ftipocambiocomercial,
                    'fMonto': this.formNuevoDeposito.fmonto,
                    'cGlosa': this.formNuevoDeposito.cglosa
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1){
                        swal('Deposito Registrado');
                        this.limpiarFormularioDesposito();
                    }else{
                        swal('El pedido ha sido Anulado o ya está Cancelado');
                    }
                }).catch(error => {
                    this.errors = error
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            validarNuevoDeposito(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formNuevoDeposito.nidbanco_destino == ''){
                    this.mensajeError.push('Debes seleccionar Banco');
                };
                if(this.formNuevoDeposito.nidmoneda_destino == ''){
                    this.mensajeError.push('Debes seleccionar Moneda');
                };
                if(this.formNuevoDeposito.nidnumerocuenta_destino == ''){
                    this.mensajeError.push('Debes seleccionar una Cuenta');
                };
                if(this.formNuevoDeposito.dfechadeposito == ''){
                    this.mensajeError.push('Debes ingresar Fecha Depósito');
                };
                if(this.formNuevoDeposito.nnumerooperacion == ''){
                    this.mensajeError.push('Debes ingresar Nro Operación');
                };
                if(this.formNuevoDeposito.ftipocambiovoucher == ''){
                    this.mensajeError.push('Debes ingresar Tipo Cambio Voucher');
                };
                if(this.formNuevoDeposito.ftipocambiocomercial == 0){
                    this.mensajeError.push('No existe Tipo Cambio Comercial, Comuníquese con SAISACTI');
                };
                if(this.formNuevoDeposito.fmonto == ''){
                    this.mensajeError.push('Debes ingresar Monto');
                };
                if(!this.attachment){
                    this.mensajeError.push('Debes seleccionar un Voucher');
                };

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            //=============== REGISTRO OTRO DEPOSITO <> DEPOSITO BANCARIO EFECTIVO ========================
            registrarOtroTipoDeposito(){
                if(this.validarOtroTipoDeposito()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                if(this.validarNuevoDeposito()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.subirArchivosOtroDeposito();
            },
            subirArchivosOtroDeposito(){
                this.mostrarProgressBar();

                this.form.append('file', this.attachment);
                const config = { headers: { 'Content-Type': 'multipart/form-data' } };
                var url = this.ruta + '/deposito/subirArchivo';

                axios.post(url, this.form, config).then(response=>{
                    this.setNuevoOtroTipoDeposito(response.data[0].nIdDocumentoAdjunto);
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            setNuevoOtroTipoDeposito(nIdDocumentoAdjunto){
                var url = this.ruta + '/deposito/SetDepositoPedido';
                axios.post(url, {
                    'nIdEmpresa': 1300011,
                    'nIdSucursal': sessionStorage.getItem("nIdSucursal"),
                    'nIdCabeceraPedido': this.formDeposito.nidcabecerapedido,
                    'nIdTipoMovimiento': this.formDeposito.nidtipomovimiento,
                    'nIdDocumentoAdjuntoVoucher': nIdDocumentoAdjunto,
                    'nIdBancoOrigen': this.formNuevoDeposito.nidbanco_origen,
                    'nIdMonedaOrigen': this.formNuevoDeposito.nidmoneda_origen,
                    'cNumeroCuentaOrigen': this.formNuevoDeposito.cnumerocuenta_origen,
                    'nIdCuentaBancariaEmpresa': this.formNuevoDeposito.nidnumerocuenta_destino,
                    'dFechaDeposito': this.formNuevoDeposito.dfechadeposito,
                    'nNumeroOperacion': this.formNuevoDeposito.nnumerooperacion,
                    'fTipoCambioDeposito': this.formNuevoDeposito.ftipocambiovoucher,
                    'fTipoCambioComercial': this.formNuevoDeposito.ftipocambiocomercial,
                    'fMonto': this.formNuevoDeposito.fmonto,
                    'cGlosa': this.formNuevoDeposito.cglosa,
                    'cFlagTipoCambioEspecial' : (this.formNuevoDeposito.cflagtce == true) ? 'S' : 'N',
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1) {
                        this.limpiarFormularioDesposito();
                        swal('Deposito Registrado');
                    } else {
                        swal('El pedido ha sido Anulado o ya está Cancelado');
                    }
                }).catch(error => {
                    this.errors = error
                });
            },
            validarOtroTipoDeposito(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formNuevoDeposito.nidbanco_origen == ''){
                    this.mensajeError.push('Debes seleccionar Banco Origen');
                };
                if(this.formNuevoDeposito.nidmoneda_origen == ''){
                    this.mensajeError.push('Debes seleccionar Moneda Origen');
                };
                if(this.formNuevoDeposito.cnumerocuenta_origen == ''){
                    this.mensajeError.push('Debes Ingresar Cuenta Origen');
                };

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            ocultarFormularioDeposito(){
                this.arrayTipoMovimientoPermisos = [];
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
                    case 'deposito':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                            }
                        }
                    }
                }
            },
            // ===========================================================
            limpiarFormulario(){
                this.fillPedido.dfechainicio = '';
                this.fillPedido.dfechafin = '';
                this.fillPedido.cnumeropedido = '';
                this.fillPedido.cnumerovin = '';
                this.fillPedido.nidmarca = '';
                this.fillPedido.nidmodelo = '';
                this.fillPedido.nidestadopedido = '';
                this.arrayPedido = [];
            },
            limpiarFormularioDesposito(){
                this.formNuevoDeposito.nidbanco_origen = '',
                this.formNuevoDeposito.nidmoneda_origen = '',
                this.formNuevoDeposito.cnumerocuenta_origen = '',
                this.formNuevoDeposito.cnumerocuenta_origen = '',
                this.formNuevoDeposito.nidbanco_destino = '',
                this.formNuevoDeposito.nidmoneda_destino = '',
                this.formNuevoDeposito.nidnumerocuenta_destino = '',
                this.formNuevoDeposito.fmonto = 0,
                // this.formNuevoDeposito.cnombrecontacto = '',
                this.formNuevoDeposito.dfechadeposito = '',
                this.formNuevoDeposito.nnumerooperacion = '',
                this.formNuevoDeposito.ftipocambiovoucher = '',
                //this.formNuevoDeposito.ftipocambiocomercial = '',
                this.formNuevoDeposito.cglosa = ''
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
