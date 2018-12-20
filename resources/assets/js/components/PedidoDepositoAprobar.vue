<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">APROBACIÓN DE DEPÓSITOS</h2>
                </div>
            </header>

            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Tab1" href="#TabBuscaPedido" @click="tabBuscarPedido" role="tab" data-toggle="tab">
                                            <i class="fa fa-search"></i> PEDIDOS
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="Tab2" href="#TabDistribucionDeposito" role="tab" data-toggle="tab">
                                            <i class="fa fa-usd"></i> DISTRIBUCIÓN
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
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarPedidosConDepositos">
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
                                                                                            <i @click="distribuirDeposito(pedido)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                                        </el-tooltip>
                                                                                    </template>
                                                                                    <template v-if="pedido.cFlagEstadoAprobacion == 'A' && pedido.cEstadoPedido != 'CANCELADO'">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Desaprobar Pedido {{ pedido.cNumeroPedido }}</div>
                                                                                            <i @click="desaprobarPedido(pedido)" :style="'color:red'" class="fa-md fa fa-trash"></i>
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
                                    <div class="tab-pane fade" id="TabDistribucionDeposito">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <vs-divider border-style="solid" color="dark">
                                                            {{ formDistribuirDeposito.cnombrecontacto }} - {{ formDistribuirDeposito.cNumeroPedido }}
                                                        </vs-divider>
                                                        <el-row :gutter="10">
                                                            <el-col :span="6"><div class="grid-content bg-purple">IMPORTE PENDIENTE</div></el-col>
                                                            <el-col :span="6">
                                                                <div class="grid-content bg-purple">
                                                                    USD/. {{ Number((parseFloat(formDistribuirDeposito.flagMontoTotalDepositosPendiente)).toFixed(2)) }}
                                                                </div>
                                                            </el-col>
                                                            <el-col :span="6"><div class="grid-content bg-purple">IMPORTE RECHAZADO</div></el-col>
                                                            <el-col :span="6">
                                                                <div class="grid-content bg-purple">
                                                                    USD/. {{ Number((parseFloat(formDistribuirDeposito.flagMontoTotalDepositosRechazados)).toFixed(2)) }}
                                                                </div>
                                                            </el-col>
                                                        </el-row>
                                                        <el-row :gutter="10">
                                                            <el-col :span="6"><div class="grid-content bg-purple">IMPORTE CANCELADO</div></el-col>
                                                            <el-col :span="6">
                                                                <div class="grid-content bg-purple">
                                                                    USD/. {{ Number((parseFloat(formDistribuirDeposito.flagMontoTotalDepositosAprobados)).toFixed(2)) }}
                                                                </div>
                                                            </el-col>
                                                            <el-col :span="6"><div class="grid-content bg-purple">MONTO PEDIDO</div></el-col>
                                                            <el-col :span="6">
                                                                <div class="grid-content bg-purple">
                                                                    USD/. {{ Number((parseFloat(formDistribuirDeposito.flagMontoTotalCotizacion)).toFixed(2)) }}
                                                                </div>
                                                            </el-col>
                                                        </el-row>
                                                        <el-row :gutter="10">
                                                            <el-col :span="6"><div class="grid-content bg-purple"> SALDO CANCELAR</div></el-col>
                                                            <el-col :span="6">
                                                                <div class="grid-content bg-purple">
                                                                    USD/. {{ Number((parseFloat(formDistribuirDeposito.flagMontoTotalCancelarPendiente)).toFixed(2)) }}
                                                                </div>
                                                            </el-col>
                                                        </el-row>
                                                        <vs-divider border-style="solid" color="dark"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <template v-if="arrayDepositosPorPedido.length">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ACCIÓN</th>
                                                                        <th>BANCO</th>
                                                                        <th>N° OPERACIÓN</th>
                                                                        <th>MONEDA</th>
                                                                        <th>FECHA</th>
                                                                        <th>TTPO CAMBIO</th>
                                                                        <th>MONTO S/</th>
                                                                        <th>MONTO USD/</th>
                                                                        <th>TCE</th>
                                                                        <th>TIPO</th>
                                                                        <th>ESTADO</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="deposito in arrayDepositosPorPedido" :key="deposito.nIdDepositoPedido">
                                                                        <td>
                                                                            <template v-if="deposito.cFlagEstadoAprobacion == 'P'">
                                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                    <div slot="content">Aprobar Deposito {{ deposito.cNumeroPedido }}</div>
                                                                                    <i @click="aprobarDeposito(deposito)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                                </el-tooltip>
                                                                            </template>
                                                                            <template v-if="deposito.cFlagEstadoAprobacion == 'P'">
                                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                    <div slot="content">Rechazar Deposito {{ deposito.cNumeroPedido }}</div>
                                                                                    <i @click="rechazarDeposito(deposito)" :style="'color:red'" class="fa-md fa fa-trash"></i>
                                                                                </el-tooltip>
                                                                            </template>
                                                                            <template v-if="deposito.cFlagTipoCambioEspecial == 'SI' && deposito.cFlagTipoCambioEspecialCheck == 'NO' && deposito.cFlagEstadoAprobacion == 'P'">
                                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                    <div slot="content">Tipo Cambio Especial {{ deposito.cNumeroPedido }}</div>
                                                                                    <i @click="abrirModal('TipoCambioEspecial','abrir',deposito)" :style="'color:grey'" class="fa-md fa fa-cog"></i>
                                                                                </el-tooltip>
                                                                            </template>
                                                                        </td>
                                                                        <td v-text="deposito.cNombreBanco"></td>
                                                                        <td v-text="deposito.nNumeroOperacion"></td>
                                                                        <td v-text="deposito.cNombreMoneda"></td>
                                                                        <td v-text="deposito.dFechaDeposito"></td>
                                                                        <td v-text="deposito.fTipoCambioComercial"></td>
                                                                        <td v-text="Number((parseFloat(deposito.fMontoSoles)).toFixed(2))"></td>
                                                                        <td v-text="Number((parseFloat(deposito.fMontoDolares)).toFixed(2))"></td>
                                                                        <td v-text="deposito.fTipoCambio"></td>
                                                                        <td v-text="deposito.cFlagExcedente"></td>
                                                                        <td v-text="deposito.cEstadoDeposito"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
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
                                                <vs-divider border-style="solid" color="dark"/>
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

            <!-- Modal CONFIGURAR EL TIPO CAMBIO ESPECIAL -->
            <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">TIPO CAMBIO ESPECIAL : {{ fillDepositoTCEspecial.fTipoCambioEspecial }} </h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="form-horizontal">
                                            <div class="col-lg-12">
                                                <vs-divider border-style="solid" color="dark">ESTADO CUENTA</vs-divider>
                                                <el-row :gutter="10">
                                                    <el-col :span="6"><div class="grid-content bg-purple">SALDO CANCELAR</div></el-col>
                                                    <el-col :span="6">
                                                        <div class="grid-content bg-purple">
                                                            S/. {{ Number((parseFloat(fillDepositoTCEspecial.fMontoTotal)).toFixed(2)) }}
                                                        </div>
                                                    </el-col>
                                                    <el-col :span="6"><div class="grid-content bg-purple">SALDO RESTANTE</div></el-col>
                                                    <el-col :span="6">
                                                        <div class="grid-content bg-purple">
                                                            USD/. {{ Number((parseFloat(fillDepositoTCEspecial.fMontoFaltante)).toFixed(2)) }}
                                                        </div>
                                                    </el-col>
                                                </el-row>
                                                <vs-divider border-style="solid" color="dark">IMPORTE ACTUAL</vs-divider>
                                                <el-row :gutter="10">
                                                    <el-col :span="6"><div class="grid-content bg-purple">IMPORTE EN SOLES</div></el-col>
                                                    <el-col :span="6">
                                                        <div class="grid-content bg-purple">
                                                            S/. {{ fillDepositoTCEspecial.fMontoOrigenSoles }}
                                                        </div>
                                                    </el-col>
                                                    <el-col :span="6"><div class="grid-content bg-purple">IMPORTE EN DOLARES</div></el-col>
                                                    <el-col :span="6">
                                                        <div class="grid-content bg-purple">
                                                            USD/. {{ fillDepositoTCEspecial.fMontoOrigenDolares }}
                                                        </div>
                                                    </el-col>
                                                </el-row>
                                                <vs-divider border-style="solid" color="dark"/>
                                                <el-row :gutter="10">
                                                    <el-col :span="6"><div class="grid-content bg-purple">TIPO CAMBIO ESPECIAL</div></el-col>
                                                    <el-col :span="6">
                                                        <div class="grid-content bg-purple">
                                                            <input
                                                                type="number"
                                                                class="form-control form-control-sm"
                                                                min="0"
                                                                placeholder="Ingrese Tipo de Cambio Especial"
                                                                v-model="fillDepositoTCEspecial.flagfTipoCambioEspecial"
                                                                @keyup="actualizarMontoSolesNuevo(fillDepositoTCEspecial.flagfTipoCambioEspecial)"/>
                                                        </div>
                                                    </el-col>
                                                    <el-col :span="6"><div class="grid-content bg-purple">TIPO CAMBIO ESPERADO</div></el-col>
                                                    <el-col :span="6">
                                                        <div class="grid-content bg-purple">
                                                            {{ Number((parseFloat(fillDepositoTCEspecial.fTipoCambioEsperado)).toFixed(5)) }}
                                                        </div>
                                                    </el-col>
                                                </el-row>
                                                <vs-divider border-style="solid" color="dark">IMPORTE NUEVO + TCE</vs-divider>
                                                <el-row :gutter="10">
                                                    <el-col :span="6"><div class="grid-content bg-purple">IMPORTE RESULTANTE EN SOLES</div></el-col>
                                                    <el-col :span="6">
                                                        <div class="grid-content bg-purple">
                                                            S/. {{ Number((parseFloat(fillDepositoTCEspecial.fMontoResultanteSoles)).toFixed(2)) }}
                                                        </div>
                                                    </el-col>
                                                    <el-col :span="6"><div class="grid-content bg-purple">IMPORTE RESULTANTE EN DOLARES</div></el-col>
                                                    <el-col :span="6">
                                                        <div class="grid-content bg-purple">
                                                            USD/. {{ Number((parseFloat(fillDepositoTCEspecial.fMontoResultanteDolares)).toFixed(2)) }}
                                                        </div>
                                                    </el-col>
                                                </el-row>
                                                <vs-divider border-style="solid" color="dark"/>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-9 offset-sm-3">
                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="actualizarDepositoPorTCE">
                                                            <i class="fa fa-save"></i> REALIZAR CAMBIO
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModalSinPaginacion">Cerrar</button>
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
                // =========== VARIABLES TAB DISTRUBUIR DEPOSITOS ==============
                formDistribuirDeposito: {
                    nidcabecerapedido: 0,
                    cNumeroPedido: '',
                    cnombrecontacto: '',
                    flagMontoTotalDepositosPendiente: 0,
                    flagMontoTotalDepositosRechazados: 0,
                    flagMontoTotalDepositosAprobados: 0,
                    flagMontoTotalCotizacion: 0,
                    flagMontoTotalCancelarPendiente: 0
                },
                arrayDepositosPorPedido: [],
                // =============================================================
                // =========== VARIABLES TAB REALIZAR TCE ======================
                fillDepositoTCEspecial: {
                    deposito: '',
                    nIdDepositoPedido: 0,
                    nIdMonedaOrigen: 0,
                    flagfTipoCambioEspecial : 0,
                    fTipoCambioEspecial: 0,
                    fTipoCambioEsperado: 0,
                    fMontoTotal: 0,
                    fMontoFaltante: 0,
                    fMontoOrigenDolares: 0,
                    fMontoOrigenSoles: 0,
                    fMontoResultanteDolares: 0,
                    fMontoResultanteSoles: 0
                },
                // =============================================================
                // VARIABLES GENÉRICAS
                // =============================================================
                loading: false,
                flagBuscarContacto: 0,
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
                modal:0,
                accionmodal: 0,
                tituloModal:'',
                error: 0,
                errors: [],
                mensajeError: []
            }
        },
        mounted(){
            this.tabBuscarPedido();
            this.llenarComboMarcas();
            this.llenarComboModelos();
            this.llenarEstadoPedido();
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
            // =================================================================
            // METODOS TAB PEDIDOS CON DEPOSITO
            // =================================================================
            tabBuscarPedido(){
                $('#Tab1').removeClass('nav-link ');
                $('#Tab1').addClass("nav-link active");
                $('#Tab2').removeClass('nav-link active');
                $('#Tab2').addClass("nav-link disabled");
                $('#TabBuscaPedido').addClass('in active show');
                $('#TabDistribucionDeposito').removeClass('in active show');
                this.limpiarFormulario();
                this.tabDistribucionDeposito();
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
            buscarPedidosConDepositos(){
                this.listarPedidosConDepositos(1);
            },
            listarPedidosConDepositos(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/deposito/GetListPedidoConDeposito';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
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
                this.listarPedidosConDepositos(page);
            },
            // =================================================================
            // METODOS TAB DISTRIBUCIÓN DE LOS DEPOSITOS
            // =================================================================
            distribuirDeposito(pedido){
                this.tabDistribucionDeposito();//Limpiar Formulario del TAB

                $('#Tab1').removeClass('nav-link active');
                $('#Tab1').addClass("nav-link");
                $('#Tab2').removeClass('nav-link disabled');
                $('#Tab2').addClass("nav-link active");
                $('#TabBuscaPedido').removeClass('in active show');
                $('#TabDistribucionDeposito').addClass('in active show');

                this.llenarDepositos(pedido);
            },
            tabDistribucionDeposito(){
                this.formDistribuirDeposito.nidcabecerapedido = 0;
                this.formDistribuirDeposito.cNumeroPedido = '';
                this.formDistribuirDeposito.cnombrecontacto = '';
                this.formDistribuirDeposito.flagMontoTotalCotizacion = 0;
                this.formDistribuirDeposito.flagMontoTotalCancelarPendiente = 0;
                this.formDistribuirDeposito.flagMontoTotalDepositosPendiente = 0;
                this.formDistribuirDeposito.flagMontoTotalDepositosAprobados = 0;
                this.formDistribuirDeposito.flagMontoTotalDepositosRechazados = 0;
                this.arrayDepositosPorPedido = [];
            },
            llenarDepositos(pedido){
                this.mostrarProgressBar();

                this.formDistribuirDeposito.nidcabecerapedido = pedido.nIdCabeceraPedido;
                this.formDistribuirDeposito.cNumeroPedido = pedido.cNumeroPedido;
                this.formDistribuirDeposito.cnombrecontacto = pedido.cContacto;
                this.formDistribuirDeposito.flagMontoTotalCotizacion = pedido.fMontoTotalCotizacion;

                var url = this.ruta + '/deposito/GetListDepositosPorPedido';
                axios.get(url, {
                    params: {
                        'nIdCabeceraPedido': pedido.nIdCabeceraPedido
                    }
                }).then(response => {
                    this.arrayDepositosPorPedido  = response.data;
                    this.cargarMontoDepositoAprobados(pedido);
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
            cargarMontoDepositoAprobados(pedido){
                var url = this.ruta + '/deposito/GetMontoTotalDepositos';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal' : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nIdCabeceraPedido' : pedido.nIdCabeceraPedido,
                        'cFlagEstadoAprobacion': 'A'
                    }
                }).then(response => {
                    this.formDistribuirDeposito.flagMontoTotalDepositosAprobados  = response.data[0].fMontoTotalDepositos;
                    this.cargarMontoDepositoPendiente(pedido);
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            cargarMontoDepositoPendiente(pedido){
                var url = this.ruta + '/deposito/GetMontoTotalDepositos';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal' : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nIdCabeceraPedido' : pedido.nIdCabeceraPedido,
                        'cFlagEstadoAprobacion': 'P'
                    }
                }).then(response => {
                    this.formDistribuirDeposito.flagMontoTotalDepositosPendiente = response.data[0].fMontoTotalDepositos;
                    this.cargarMontoDepositoRechazado(pedido);
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            cargarMontoDepositoRechazado(pedido){
                var url = this.ruta + '/deposito/GetMontoTotalDepositos';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal' : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nIdCabeceraPedido' : pedido.nIdCabeceraPedido,
                        'cFlagEstadoAprobacion': 'D'
                    }
                }).then(response => {
                    this.formDistribuirDeposito.flagMontoTotalDepositosRechazados = response.data[0].fMontoTotalDepositos;

                    // Resto el Total a pagar - El Total Pagado
                    var flagMontoTotalCotizacion = Number(parseFloat(this.formDistribuirDeposito.flagMontoTotalCotizacion).toFixed(4))
                    var flagMontoTotalDepositosAprobados = Number(parseFloat(this.formDistribuirDeposito.flagMontoTotalDepositosAprobados).toFixed(4))
                    var resultadoMontoCancelar = flagMontoTotalCotizacion - flagMontoTotalDepositosAprobados
                    this.formDistribuirDeposito.flagMontoTotalCancelarPendiente = resultadoMontoCancelar;
                    // (this.formDistribuirDeposito.flagMontoTotalCancelarPendiente < 0 ) ? this.formDistribuirDeposito.flagMontoTotalCancelarPendiente = 0 : this.formDistribuirDeposito.flagMontoTotalCancelarPendiente;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            aprobarDeposito(deposito){
                swal({
                    title: 'Estas seguro de aprobar el Deposito',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Aprobar!',
                    cancelButtonText: 'No, Cerrar!'
                }).then((result) => {
                    if (result.value) {
                        var url = this.ruta + '/deposito/SetCambiarEstadoDeposito';
                        axios.put(url , {
                            nIdDepositoPedido : deposito.nIdDepositoPedido,
                            nIdCabeceraPedido : deposito.nIdCabeceraPedido,
                            nIdMonedaOrigen : deposito.nIdMonedaOrigen,
                            fTipoCambio : deposito.fTipoCambio,
                            cFlagEstadoDeposito : 'A'
                        }).then(response => {
                            console.log(response);
                            swal(
                                'Aprobado!',
                                'El registro fue aprobado exitosamente.'
                            );
                            this.tabBuscarPedido();
                        }).catch(function (error) {
                            console.log(error);
                            if (error.response) {
                                if (error.response.status == 401) {
                                    location.reload('0');
                                }
                            }
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel)
                    {
                    }
                })
            },
            rechazarDeposito(deposito){
                swal({
                    title: 'Estas seguro de rechazar el Deposito',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Rechazar!',
                    cancelButtonText: 'No, Cerrar!'
                }).then((result) => {
                    if (result.value) {
                        var url = this.ruta + '/deposito/SetCambiarEstadoDeposito';
                        axios.put(url , {
                            nIdDepositoPedido : deposito.nIdDepositoPedido,
                            nIdCabeceraPedido : deposito.nIdCabeceraPedido,
                            nIdMonedaOrigen : deposito.nIdMonedaOrigen,
                            fTipoCambio : deposito.fTipoCambio,
                            cFlagEstadoDeposito : 'D'
                        }).then(response => {
                            swal(
                                'Rechazado!',
                                'El registro fue rechazado exitosamente.'
                            );
                            this.tabBuscarPedido();
                        }).catch(function (error) {
                            console.log(error);
                            if (error.response) {
                                if (error.response.status == 401) {
                                    location.reload('0');
                                }
                            }
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel)
                    {
                    }
                })
            },
            desaprobarPedido(pedido){
                swal({
                    title: 'Estas seguro de anular el Pedido ' + pedido.cNumeroPedido,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Anular!',
                    cancelButtonText: 'No, Cerrar!'
                }).then((result) => {
                    if (result.value) {
                        var url = this.ruta + '/deposito/SetCambiarEstadoPedido';
                        axios.put(url , {
                            nIdCabeceraPedido : pedido.nIdCabeceraPedido,
                            cFlagEstadoPedido : 'D',
                            nIdEstadoPedido   : 1300162
                        }).then(response => {
                            swal(
                                'Desaprobado!',
                                'El pedido ' + pedido.cNumeroPedido + ' fue desaprobado exitosamente.'
                            );
                            this.listarPedidosConDepositos(1);
                        }).catch(function (error) {
                            console.log(error);
                            if (error.response) {
                                if (error.response.status == 401) {
                                    location.reload('0');
                                }
                            }
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel)
                    {
                    }
                })
            },
            // =================================================================
            // METODOS MODAL ACTUALIZAR TCE
            // =================================================================
            cargarTipoCambioEspecial(data){
                var url = this.ruta + '/tipoparametro/GetTipoByIdParametro';
                axios.get(url, {
                    params: {
                        'nidpar': 1300356,
                        'ctipoparametro': 'P'
                    }
                }).then(response => {
                    this.fillDepositoTCEspecial.deposito = data;
                    this.fillDepositoTCEspecial.nIdDepositoPedido           =   data.nIdDepositoPedido;//Id del Deposito
                    this.fillDepositoTCEspecial.nIdMonedaOrigen             =   data.nIdMonedaOrigen;//Tipo de Moneda
                    this.fillDepositoTCEspecial.fMontoTotal                 =   (parseFloat(this.formDistribuirDeposito.flagMontoTotalCancelarPendiente)).toFixed(2);//Monto Total
                    this.fillDepositoTCEspecial.fMontoOrigenDolares         =   ((parseFloat(data.fMontoDolares)).toFixed(2));//Monto Actual en $
                    this.fillDepositoTCEspecial.fMontoOrigenSoles           =   ((parseFloat(data.fMontoSoles)).toFixed(2));//Monto Actual en S/
                    this.fillDepositoTCEspecial.fMontoFaltante              =   this.fillDepositoTCEspecial.fMontoTotal - this.fillDepositoTCEspecial.fMontoOrigenDolares
                    this.fillDepositoTCEspecial.flagfTipoCambioEspecial     =   response.data[0].fDatoParPorcentual;//Tipo Cambio Especial
                    this.fillDepositoTCEspecial.fTipoCambioEspecial         =   response.data[0].fDatoParPorcentual;//Tipo Cambio Especial

                    //Realizar el calculo del monto en dolares o soles dependiendo el tipo moneda por el tipo cambio especial
                    if (this.fillDepositoTCEspecial.nIdMonedaOrigen == 1300027) {//Soles
                        this.fillDepositoTCEspecial.fMontoResultanteSoles   = parseFloat(this.fillDepositoTCEspecial.fMontoOrigenDolares) * this.fillDepositoTCEspecial.flagfTipoCambioEspecial;
                        // this.fillDepositoTCEspecial.fMontoResultanteDolares = this.fillDepositoTCEspecial.fMontoOrigenDolares;
                        this.fillDepositoTCEspecial.fMontoResultanteDolares = parseFloat(this.fillDepositoTCEspecial.fMontoOrigenSoles) / this.fillDepositoTCEspecial.flagfTipoCambioEspecial;
                    } else {//Dolares
                        // this.fillDepositoTCEspecial.fMontoResultanteDolares = parseFloat(this.fillDepositoTCEspecial.fMontoOrigenSoles) / this.fillDepositoTCEspecial.flagfTipoCambioEspecial;
                        // // this.fillDepositoTCEspecial.fMontoResultanteSoles   = this.fillDepositoTCEspecial.fMontoOrigenSoles;
                        // this.fillDepositoTCEspecial.fMontoResultanteSoles   = this.fillDepositoTCEspecial.fMontoResultanteDolares * (this.fillDepositoTCEspecial.deposito.fTipoCambioComercial);
                    }

                    this.fillDepositoTCEspecial.fTipoCambioEsperado = this.fillDepositoTCEspecial.fMontoOrigenSoles / this.fillDepositoTCEspecial.fMontoTotal;//Calcula TCE esperado
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
            actualizarMontoSolesNuevo(value){
                let me = this;
                if(value == '') {
                    this.fillDepositoTCEspecial.flagfTipoCambioEspecial = 1;//Seta automaticamente a 1

                    //Realizar el calculo del monto en dolares o soles dependiendo el tipo moneda por el tipo cambio especial
                    if (this.fillDepositoTCEspecial.nIdMonedaOrigen == 1300027) {
                        this.fillDepositoTCEspecial.fMontoResultanteSoles   = parseFloat(this.fillDepositoTCEspecial.fMontoOrigenDolares) * this.fillDepositoTCEspecial.flagfTipoCambioEspecial;
                        this.fillDepositoTCEspecial.fMontoResultanteDolares = parseFloat(this.fillDepositoTCEspecial.fMontoOrigenSoles) / this.fillDepositoTCEspecial.flagfTipoCambioEspecial;
                    } else {
                        // this.fillDepositoTCEspecial.fMontoOrigenDolares = this.fillDepositoTCEspecial.fMontoResultanteSoles / this.fillDepositoTCEspecial.flagfTipoCambioEspecial;
                    }
                    me.$forceUpdate();
                }
                //Realizar el calculo del monto en dolares o soles dependiendo el tipo moneda por el tipo cambio especial
                if (this.fillDepositoTCEspecial.nIdMonedaOrigen == 1300027) {
                    this.fillDepositoTCEspecial.fMontoResultanteSoles   = parseFloat(this.fillDepositoTCEspecial.fMontoOrigenDolares) * this.fillDepositoTCEspecial.flagfTipoCambioEspecial;
                    this.fillDepositoTCEspecial.fMontoResultanteDolares = parseFloat(this.fillDepositoTCEspecial.fMontoOrigenSoles) / this.fillDepositoTCEspecial.flagfTipoCambioEspecial;
                } else {
                    // this.fillDepositoTCEspecial.fMontoResultanteDolares = this.fillDepositoTCEspecial.fMontoResultanteSoles / this.fillDepositoTCEspecial.flagfTipoCambioEspecial;
                }
                me.$forceUpdate();
            },
            actualizarDepositoPorTCE(){
                var url = this.ruta + '/deposito/SetCambiarMontosDepositoByTCE';
                axios.put(url, {
                    'nIdDepositoPedido': this.fillDepositoTCEspecial.nIdDepositoPedido,
                    'fMontoResultanteDolares': this.fillDepositoTCEspecial.fMontoResultanteDolares,
                    'fMontoResultanteSoles': this.fillDepositoTCEspecial.fMontoResultanteSoles,
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1){
                        swal('Monto del Deposito Actualizado');
                        this.cerrarModalSinPaginacion();
                        this.limpiarDepositoTCEspecial();
                        this.tabBuscarPedido();
                    }else{
                        swal('Ocurrio un error al actualizar el nuevo monto del Deposito');
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
            limpiarDepositoTCEspecial(){
                this.fillDepositoTCEspecial.deposito = '';
                this.fillDepositoTCEspecial.nIdDepositoPedido = 0;
                this.fillDepositoTCEspecial.nIdMonedaOrigen = 0;
                this.fillDepositoTCEspecial.flagfTipoCambioEspecial = 0;
                this.fillDepositoTCEspecial.fTipoCambioEspecial = 0;
                this.fillDepositoTCEspecial.fMontoOrigenDolares = 0;
                this.fillDepositoTCEspecial.fMontoOrigenSoles = 0;
                this.fillDepositoTCEspecial.fMontoResultanteDolares = 0;
                this.fillDepositoTCEspecial.fMontoResultanteSoles = 0;
            },
            // =================================================================
            // METODOS GENERICOS
            // =================================================================
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "TipoCambioEspecial":
                    {
                        switch(accion){
                            case 'abrir':
                            {
                                this.limpiarDepositoTCEspecial();
                                this.cargarTipoCambioEspecial(data);
                                this.accionmodal=2;
                                this.modal = 1;
                                break;
                            }
                        }
                    }
                }
            },
            //Limpiar Paginación
            limpiarPaginacion(){
                this.pagination.current_page =  0,
                this.pagination.total = 0,
                this.pagination.per_page = 0,
                this.pagination.last_page = 0,
                this.pagination.from  = 0,
                this.pagination.to = 0
            },
            limpiarPaginacionModal(){
                this.paginationModal.current_page =  0,
                this.paginationModal.total = 0,
                this.paginationModal.per_page = 0,
                this.paginationModal.last_page = 0,
                this.paginationModal.from  = 0,
                this.paginationModal.to = 0
            },
            //Cerrar Modal
            cerrarModal(){
                this.modal = 0;
                this.accionmodal = 0;
                this.error = 0;
                this.mensajeError = '';
                this.limpiarPaginacion();
                this.limpiarPaginacionModal();
            },
            cerrarModalSinPaginacion(){
                this.modal = 0;
                this.accionmodal = 0;
                this.error = 0;
                this.mensajeError = '';
            },
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
            mostrarProgressBar(){
                $("#myBar").show();
                progress();
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


