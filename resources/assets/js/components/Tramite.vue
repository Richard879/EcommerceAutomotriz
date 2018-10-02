<template >
    <transition name="slide-fade"  appear>
        <main>
            <header class="page-header">
            <div class="container-fluid">
                <h2 class="no-margin-bottom"> TRAMITE - TARJETA Y PLACA </h2>
            </div>
            </header>

            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tab01" href="#TabBuscarPedido" role="tab" @click.prevent="tabBuscarPedido" data-toggle="tab">
                                            <i class="fa fa-search"></i> PEDIDOS
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="tab02" href="#TabGenerarTramite" role="tab" data-toggle="tab">
                                            <i class="fa fa-address-card"></i> GENERAR TRAMITE
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab03" href="#TabBandejaSolicitudes" role="tab" @click.prevent="tabBandejaSolicitudes" data-toggle="tab">
                                            <i class="fa fa-address-book"></i> SOLICITUDES TRAMITE
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active show" id="TabBuscarPedido">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">BUSCAR PEDIDOS CANCELADOS.</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <div class="form-group row">
                                                                    <div class="col-md-6">
                                                                        <div class="row">
                                                                            <label class="col-md-4 form-control-label">*Estado</label>
                                                                            <div class="col-md-8 widthFull">
                                                                                <el-select v-model="fillBusquedaPedidos.nidestadotramite"
                                                                                        filterable
                                                                                        clearable
                                                                                        loading-text
                                                                                        placeholder="Seleccione un Estado Tramite">
                                                                                    <el-option
                                                                                        v-for="estado in arrayEstadoTramite"
                                                                                        :key="estado.nIdPar"
                                                                                        :label="estado.cParNombre"
                                                                                        :value="estado.nIdPar">
                                                                                    </el-option>
                                                                                </el-select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-9 offset-md-5">
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="buscarMisPedidos(1)">
                                                                            <i class="fa fa-search"></i> Buscar
                                                                        </button>
                                                                        <button type="button" class="btn btn-default btn-corner btn-sm" @click.prevent="limpiarBuscarPedidos()">
                                                                            <i class="fa fa-recycle"></i> Limpiar
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
                                                            <h3 class="h4">BANDEJA PEDIDOS CANCELADOS</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <div class="col-lg-12">
                                                                    <template v-if="arrayPedidosCancelados.length">
                                                                        <div>
                                                                            <el-table
                                                                                v-loading="loading"
                                                                                ref="multipleTable"
                                                                                :data="arrayPedidosCancelados"
                                                                                style="width: 100%"
                                                                                @selection-change="handleSelectionChange">
                                                                                    <el-table-column
                                                                                        :fixed="flagFixed"
                                                                                        :type="flagType"
                                                                                        :width="flagWidth"
                                                                                        >
                                                                                    </el-table-column>
                                                                                    <el-table-column
                                                                                        label="Fecha Pedido"
                                                                                        property="dFechaPedido"
                                                                                        width="120">
                                                                                    </el-table-column>
                                                                                    <el-table-column
                                                                                        property="cNumeroPedido"
                                                                                        label="Nro Pedido"
                                                                                        width="120">
                                                                                    </el-table-column>
                                                                                    <el-table-column
                                                                                        property="cNumeroVin"
                                                                                        label="Nro VIN"
                                                                                        width="160">
                                                                                    </el-table-column>
                                                                                    <el-table-column
                                                                                        property="cNombreComercial"
                                                                                        label="Nombre Comercial"
                                                                                        width="180">
                                                                                    </el-table-column>
                                                                                    <el-table-column
                                                                                        property="nAnioFabricacion"
                                                                                        label="Año Fabricación"
                                                                                        width="120">
                                                                                    </el-table-column>
                                                                                    <el-table-column
                                                                                        property="cEstadoTramite"
                                                                                        label="Estado"
                                                                                        show-overflow-tooltip>
                                                                                    </el-table-column>
                                                                                    <el-table-column
                                                                                        fixed="right"
                                                                                        label="Acciones"
                                                                                        width="80">
                                                                                        <template slot-scope="scope">

                                                                                        </template>
                                                                                    </el-table-column>
                                                                            </el-table>
                                                                        </div>
                                                                    </template>
                                                                    <br>
                                                                    <div v-if="arrayPedidosChecked.length" class="form-group row">
                                                                        <div class="col-md-9 offset-md-5">
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="tabGenerarTramite">
                                                                                <i class="fa fa-save"></i> Generar Tramite
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="row">
                                                                        <div class="col-lg-7">
                                                                            <nav>
                                                                                <ul class="pagination">
                                                                                    <li v-if="pagination.current_page > 1" class="page-item">
                                                                                        <a @click.prevent="cambiarPaginaMisPedidos(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                    </li>
                                                                                    <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                    :class="[page==isActived?'active':'']">
                                                                                        <a class="page-link"
                                                                                        href="#" @click.prevent="cambiarPaginaMisPedidos(page)"
                                                                                        v-text="page"></a>
                                                                                    </li>
                                                                                    <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                        <a @click.prevent="cambiarPaginaMisPedidos(pagination.current_page+1)" class="page-link" href="#">Sig</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </nav>
                                                                        </div>
                                                                        <div class="col-lg-5">
                                                                            <div class="datatable-info">Mostrando {{ pagination.from }} a {{ pagination.to }} de {{ pagination.total }} registros</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade in active show" id="TabGenerarTramite">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <form class="form-horizontal">
                                                        <div class="form-group row">
                                                            <div class="col-sm-6">
                                                                <div class="row">
                                                                    <label class="col-sm-4 form-control-label">Fecha Inicio Tramite</label>
                                                                    <div class="col-sm-8">
                                                                        <el-input
                                                                            suffix-icon="el-icon-date"
                                                                            :readonly="true"
                                                                            :disabled="true"
                                                                            v-model="fillBusquedaPedidosSeleccionados.fechaInicioTramite">
                                                                        </el-input>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="row">
                                                                    <label class="col-sm-4 form-control-label">Fecha Fin Real Tramite</label>
                                                                    <div class="col-sm-8">
                                                                        <el-input
                                                                            suffix-icon="el-icon-date"
                                                                            :readonly="true"
                                                                            :disabled="true"
                                                                            v-model="fillBusquedaPedidosSeleccionados.fechaFinRealTramite">
                                                                        </el-input>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-6">
                                                                <div class="row">
                                                                    <label class="col-sm-4 form-control-label">Nro Vehículos</label>
                                                                    <div class="col-sm-8">
                                                                        <el-input-number
                                                                            v-model="fillBusquedaPedidosSeleccionados.nroVehiculos"
                                                                            controls-position="right"
                                                                            :disabled="true"
                                                                            :min="(fillBusquedaPedidosSeleccionados.nroVehiculos > 0) ? fillBusquedaPedidosSeleccionados.nroVehiculos : 1"
                                                                            :max="(fillBusquedaPedidosSeleccionados.nroVehiculos > 0) ? fillBusquedaPedidosSeleccionados.nroVehiculos : 1">
                                                                        </el-input-number>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">LISTADO</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <div class="col-lg-12">
                                                                    <template v-if="arrayPedidosChecked.length">
                                                                        <div>
                                                                            <el-table
                                                                                :data="arrayPedidosChecked"
                                                                                style="width: 100%">
                                                                                <el-table-column
                                                                                    label="Fecha Pedido"
                                                                                    property="dFechaPedido"
                                                                                    width="100">
                                                                                </el-table-column>
                                                                                <el-table-column
                                                                                    property="cNumeroPedido"
                                                                                    label="Nro Pedido"
                                                                                    width="120">
                                                                                </el-table-column>
                                                                                <el-table-column
                                                                                    property="cNumeroVin"
                                                                                    label="Nro VIN"
                                                                                    width="160">
                                                                                </el-table-column>
                                                                                <el-table-column
                                                                                    property="cNombreComercial"
                                                                                    label="Nombre Comercial"
                                                                                    width="180">
                                                                                </el-table-column>
                                                                                <el-table-column
                                                                                    property="nAnioFabricacion"
                                                                                    label="Año Fabricación"
                                                                                    width="100">
                                                                                </el-table-column>
                                                                                <el-table-column
                                                                                    property="cEstado"
                                                                                    label="Estado"
                                                                                    show-overflow-tooltip>
                                                                                </el-table-column>
                                                                                <el-table-column
                                                                                    label="Total. T. Tarjeta"
                                                                                    width="80">
                                                                                    <template slot-scope="scope">
                                                                                        S/.
                                                                                        <span style="margin-left: 10px">{{ scope.row.fTotalTramiteTarjeta }}</span>
                                                                                    </template>
                                                                                </el-table-column>
                                                                                <el-table-column
                                                                                    label="Total. T. Placa"
                                                                                    width="80">
                                                                                    <template slot-scope="scope">
                                                                                        S/.
                                                                                        <span style="margin-left: 10px">{{ scope.row.fTotalTramitePlaca }}</span>
                                                                                    </template>
                                                                                </el-table-column>
                                                                                <el-table-column
                                                                                    label="Total. G. Adicional"
                                                                                    width="80">
                                                                                    <template slot-scope="scope">
                                                                                        S/.
                                                                                        <span style="margin-left: 10px">{{ scope.row.fTotalGAdicional }}</span>
                                                                                    </template>
                                                                                </el-table-column>
                                                                            </el-table>
                                                                        </div>
                                                                    </template>
                                                                    <br>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <el-row :gutter="10">
                                                                        <el-col :span="16"><div class="grid-content bg-purple">Total</div></el-col>
                                                                        <el-col :span="8">
                                                                            <div class="grid-content bg-purple">
                                                                                <el-col :span="8"><div class="grid-content bg-purple">S/. {{ montoSubTotalTramiteTarjeta = totalTramiteTarjeta }}</div></el-col>
                                                                                <el-col :span="8"><div class="grid-content bg-purple">S/. {{ montoSubTotalTramitePlaca = totalTramitePlaca }}</div></el-col>
                                                                                <el-col :span="8"><div class="grid-content bg-purple">S/. {{ montoSubTotalTramiteAdicional = totalTramiteAdicional }}</div></el-col>
                                                                            </div>
                                                                        </el-col>
                                                                    </el-row>
                                                                    <el-row :gutter="10">
                                                                        <el-col :span="16"><div class="grid-content bg-purple">Total General</div></el-col>
                                                                        <el-col :span="8">
                                                                            <div class="grid-content bg-purple">
                                                                                S/. {{ montoTotalGeneralTramite = totalGeneral }}
                                                                            </div>
                                                                        </el-col>
                                                                    </el-row>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <form class="form-horizontal">
                                                                        <div v-if="arrayPedidosChecked.length" class="form-group row">
                                                                            <div class="col-md-9 offset-md-5">
                                                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="tabRegistrarTramite">
                                                                                    <i class="fa fa-save"></i> Generar Tramite
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="TabBandejaSolicitudes">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <ul class="nav nav-tabs">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="tab0301" href="#SubTabBandejaSolicitudes" @click="subtabGenerarTramite" role="tab" data-toggle="tab">
                                                                <i class="fa fa-id-badge"></i> BANDEJA SOLICITUDES
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="tab0302" href="#SubTabDetalleSolcitud" role="tab" data-toggle="tab">
                                                                <i class="fa fa-align-left"></i>  DETALLE SOLICITUD
                                                            </a>
                                                        </li>
                                                    </ul>

                                                    <div class="tab-content">
                                                        <div class="tab-pane fade in active show" id="SubTabBandejaSolicitudes">
                                                            <section class="forms">
                                                                <div class="container-fluid">
                                                                    <div class="col-lg-12">
                                                                        <form class="form-horizontal">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Fecha Inicio Tramite</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-date-picker
                                                                                                v-model="fillBusquedaSolTramite.fechaInicioTramite"
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
                                                                                        <label class="col-sm-4 form-control-label">Fecha Fin Real Tramite</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-date-picker
                                                                                                v-model="fillBusquedaSolTramite.fechaFinRealTramite"
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
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <label class="col-md-4 form-control-label">*Estado Tramite</label>
                                                                                        <div class="col-md-8 widthFull">
                                                                                            <el-select v-model="fillBusquedaSolTramite.nidestadotramite"
                                                                                                    filterable
                                                                                                    clearable
                                                                                                    loading-text
                                                                                                    placeholder="Seleccione un Estado Tramite">
                                                                                                <el-option
                                                                                                    v-for="estado in arrayEstadoTramite"
                                                                                                    :key="estado.nIdPar"
                                                                                                    :label="estado.cParNombre"
                                                                                                    :value="estado.nIdPar">
                                                                                                </el-option>
                                                                                            </el-select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-md-9 offset-md-5">
                                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="buscarMisTramites(1)">
                                                                                        <i class="fa fa-search"></i> Buscar
                                                                                    </button>
                                                                                    <button type="button" class="btn btn-default btn-corner btn-sm" @click.prevent="limpiarBandejaSolicitudes()">
                                                                                        <i class="fa fa-recycle"></i> Limpiar
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h3 class="h4">BANDEJA DE SOLICITUDES</h3>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <form class="form-horizontal">
                                                                                    <div class="col-lg-12">
                                                                                        <template v-if="arraySolicitudesTramites.length">
                                                                                            <div>
                                                                                                <el-table
                                                                                                    v-loading="loading"
                                                                                                    :data="arraySolicitudesTramites"
                                                                                                    style="width: 100%">
                                                                                                        <el-table-column
                                                                                                            property="cNumeroSolicitudTramite"
                                                                                                            label="N° Solicitud T"
                                                                                                            width="120">
                                                                                                        </el-table-column>
                                                                                                        <el-table-column
                                                                                                            property="cEstadoTramite"
                                                                                                            label="Estado Tramite"
                                                                                                            width="120">
                                                                                                        </el-table-column>
                                                                                                        <el-table-column
                                                                                                            property="nNumeroVehiculos"
                                                                                                            label="Total Vehiculo"
                                                                                                            width="120">
                                                                                                        </el-table-column>
                                                                                                        <el-table-column
                                                                                                            property="fTotalTramite"
                                                                                                            label="Total General"
                                                                                                            width="120">
                                                                                                        </el-table-column>
                                                                                                        <el-table-column
                                                                                                            property="nTotalTarjeta"
                                                                                                            label="Tarjeta"
                                                                                                            width="120">
                                                                                                        </el-table-column>
                                                                                                        <el-table-column
                                                                                                            property="nTotalPlaca"
                                                                                                            label="Placa"
                                                                                                            show-overflow-tooltip>
                                                                                                        </el-table-column>
                                                                                                        <el-table-column
                                                                                                            fixed="right"
                                                                                                            label="Acciones"
                                                                                                            width="80">
                                                                                                            <template slot-scope="scope">
                                                                                                                <el-tooltip class="item"
                                                                                                                            effect="dark"
                                                                                                                            content="Ver Detalle Solicitud"
                                                                                                                            placement="top-start">
                                                                                                                    <el-button @click="abrirModal('solicitud-tramite', 'detalle', scope.row)"><i class="fa fa-eye"></i></el-button>
                                                                                                                </el-tooltip>
                                                                                                            </template>
                                                                                                        </el-table-column>
                                                                                                </el-table>
                                                                                            </div>
                                                                                        </template>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-7">
                                                                                                <nav>
                                                                                                    <ul class="pagination">
                                                                                                        <li v-if="pagination.current_page > 1" class="page-item">
                                                                                                            <a @click.prevent="cambiarPaginaMisTramites(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                                        </li>
                                                                                                        <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                                        :class="[page==isActived?'active':'']">
                                                                                                            <a class="page-link"
                                                                                                            href="#" @click.prevent="cambiarPaginaMisTramites(page)"
                                                                                                            v-text="page"></a>
                                                                                                        </li>
                                                                                                        <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                                            <a @click.prevent="cambiarPaginaMisTramites(pagination.current_page+1)" class="page-link" href="#">Sig</a>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </nav>
                                                                                            </div>
                                                                                            <div class="col-lg-5">
                                                                                                <div class="datatable-info">Mostrando {{ pagination.from }} a {{ pagination.to }} de {{ pagination.total }} registros</div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                        <div class="tab-pane fade" id="SubTabDetalleSolcitud">
                                                            <section class="forms">
                                                                <div class="container-fluid">
                                                                    <div class="col-lg-12">
                                                                        <form class="form-horizontal">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Nro Solicitud</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-input
                                                                                                :readonly="true"
                                                                                                :disabled="true"
                                                                                                v-model="fillDetalleSolTramite.nroSolicitud">
                                                                                            </el-input>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Total Vehículos</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-input
                                                                                                :readonly="true"
                                                                                                :disabled="true"
                                                                                                v-model="fillDetalleSolTramite.nroVehiculos">
                                                                                            </el-input>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Fecha Inicio Tramite</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-input
                                                                                                suffix-icon="el-icon-date"
                                                                                                :readonly="true"
                                                                                                :disabled="true"
                                                                                                v-model="fillDetalleSolTramite.fechaInicioTramite">
                                                                                            </el-input>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Fecha Fin Real Tramite</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-input
                                                                                                suffix-icon="el-icon-date"
                                                                                                :readonly="true"
                                                                                                :disabled="true"
                                                                                                v-model="fillDetalleSolTramite.fechaFinRealTramite">
                                                                                            </el-input>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h3 class="h4">BANDEJA DE DETALLE SOLICITUD DE TRAMITE</h3>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <form class="form-horizontal">
                                                                                    <div class="col-lg-12">
                                                                                        <template v-if="arrayDetalleSolicitudTramite.length">
                                                                                            <div>
                                                                                                <el-table
                                                                                                    v-loading="loading"
                                                                                                    :data="arrayDetalleSolicitudTramite"
                                                                                                    style="width: 100%">
                                                                                                        <el-table-column
                                                                                                            property="dFechaInicioTramite"
                                                                                                            label="Fecha Inicio T"
                                                                                                            width="120">
                                                                                                        </el-table-column>
                                                                                                        <el-table-column
                                                                                                            property="dFechaFinTramite"
                                                                                                            label="Fecha Fin T"
                                                                                                            width="120">
                                                                                                        </el-table-column>
                                                                                                        <el-table-column
                                                                                                            property="dFechaFinRealTramite"
                                                                                                            label="Fecha Fin Real T"
                                                                                                            width="120">
                                                                                                        </el-table-column>
                                                                                                        <el-table-column
                                                                                                            property="cNumeroVin"
                                                                                                            label="N° VIN"
                                                                                                            width="120">
                                                                                                        </el-table-column>
                                                                                                        <el-table-column
                                                                                                            property="cEstadoTarjeta"
                                                                                                            label="Estado Tarjeta"
                                                                                                            width="120">
                                                                                                        </el-table-column>
                                                                                                        <el-table-column
                                                                                                            property="cEstadoPlaca"
                                                                                                            label="Estado Placa"
                                                                                                            show-overflow-tooltip>
                                                                                                        </el-table-column>
                                                                                                        <el-table-column
                                                                                                            fixed="right"
                                                                                                            label="Acciones"
                                                                                                            width="180">
                                                                                                            <template slot-scope="scope">
                                                                                                                <template v-if="scope.row.cEstadoTarjeta != 'RECIBIDA'">
                                                                                                                    <el-tooltip class="item"
                                                                                                                                effect="dark"
                                                                                                                                content="Tarjeta"
                                                                                                                                placement="top-start">
                                                                                                                        <el-button @click="abrirModal('tarjeta', 'abrir', scope.row);"><i class="fa fa-address-card"></i></el-button>
                                                                                                                    </el-tooltip>
                                                                                                                </template>

                                                                                                                <template v-if="scope.row.cEstadoTarjeta == 'RECIBIDA' && scope.row.cEstadoPlaca != 'RECIBIDA'">
                                                                                                                    <el-tooltip class="item"
                                                                                                                                effect="dark"
                                                                                                                                content="Placa"
                                                                                                                                placement="top-start">
                                                                                                                        <el-button @click="abrirModal('placa', 'abrir', scope.row);"><i class="fa fa-car"></i></el-button>
                                                                                                                    </el-tooltip>
                                                                                                                </template>
                                                                                                            </template>
                                                                                                        </el-table-column>
                                                                                                </el-table>
                                                                                            </div>
                                                                                        </template>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-7">
                                                                                                <nav>
                                                                                                    <ul class="pagination">
                                                                                                        <li v-if="pagination.current_page > 1" class="page-item">
                                                                                                            <a @click.prevent="cambiarPaginaMisPedidos(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                                        </li>
                                                                                                        <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                                        :class="[page==isActived?'active':'']">
                                                                                                            <a class="page-link"
                                                                                                            href="#" @click.prevent="cambiarPaginaMisPedidos(page)"
                                                                                                            v-text="page"></a>
                                                                                                        </li>
                                                                                                        <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                                            <a @click.prevent="cambiarPaginaMisPedidos(pagination.current_page+1)" class="page-link" href="#">Sig</a>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </nav>
                                                                                            </div>
                                                                                            <div class="col-lg-5">
                                                                                                <div class="datatable-info">Mostrando {{ pagination.from }} a {{ pagination.to }} de {{ pagination.total }} registros</div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
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
                                <div v-for="e in mensajeError" :key="e" v-text="e"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Tarjeta -->
            <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form v-on:submit.prevent class="form-horizontal">
                                <div class="container-fluid">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">Tarjeta</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="text-center">
                                                                <div v-for="e in mensajeError" :key="e" v-text="e"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label class="col-md-4 form-control-label">*Estado</label>
                                                            <div class="col-md-8 widthFull">
                                                                <el-select v-model="fillModalTarjetaPlaca.nIdEstado"
                                                                        filterable
                                                                        clearable
                                                                        @change="cambiarEstadoModal"
                                                                        loading-text
                                                                        placeholder="Seleccione un Estado Tramite">
                                                                    <el-option
                                                                        v-for="estado in arrayEstadoTramiteTarjetaPlaca"
                                                                        :key="estado.nIdPar"
                                                                        :label="estado.cParNombre"
                                                                        :value="estado.nIdPar">
                                                                    </el-option>
                                                                </el-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <template v-if="vistaEstado == 1">
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <label class="col-sm-4 form-control-label">N° Tarjeta</label>
                                                                <div class="col-sm-8">
                                                                    <el-input
                                                                        clearable
                                                                        v-model="fillModalTarjetaPlaca.cNroTarjeta">
                                                                    </el-input>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <label class="col-sm-4 form-control-label">N° Placa</label>
                                                                <div class="col-sm-8">
                                                                    <el-input
                                                                        clearable
                                                                        v-model="fillModalTarjetaPlaca.cNroPlaca">
                                                                    </el-input>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                                <template v-else-if="vistaEstado == 0">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <label class="col-md-2 form-control-label">*Observación</label>
                                                                <div class="col-md-10 widthFull">
                                                                    <el-input
                                                                        type="textarea"
                                                                        autosize
                                                                        clearable
                                                                        v-model="fillModalTarjetaPlaca.cObservacion">
                                                                    </el-input>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                                <div class="col-lg-12">
                                                    <form class="form-horizontal">
                                                        <div v-if="vistaEstado != 2" class="form-group row">
                                                            <div class="col-md-9 offset-md-5">
                                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarTramiteTarjeta">
                                                                    <i class="fa fa-save"></i> Registrar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <hr/>

                                            <template v-if="arrayListadoEstadosTarjetaPlaca.length">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha Fin Real</th>
                                                                <th>Estado</th>
                                                                <th>Observacion</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="estadosObs in arrayListadoEstadosTarjetaPlaca" :key="estadosObs.nIdTramiteObs">
                                                                <td v-text="estadosObs.dFechaFinRealTramite"></td>
                                                                <td v-text="estadosObs.cEstado"></td>
                                                                <td v-text="estadosObs.cObservacion"></td>
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
                                                                        <a @click.prevent="cambiarPaginaMisObservaciones(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                    </li>
                                                                    <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                    :class="[page==isActivedModal?'active':'']">
                                                                        <a class="page-link"
                                                                        href="#" @click.prevent="cambiarPaginaMisObservaciones(page)"
                                                                        v-text="page"></a>
                                                                    </li>
                                                                    <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                        <a @click.prevent="cambiarPaginaMisObservaciones(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModalTramiteTarjetaPlaca">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Placa -->
            <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form v-on:submit.prevent class="form-horizontal">
                                <div class="container-fluid">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">Placa</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="text-center">
                                                                <div v-for="e in mensajeError" :key="e" v-text="e"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label class="col-md-4 form-control-label">*Estado</label>
                                                            <div class="col-md-8 widthFull">
                                                                <el-select v-model="fillModalTarjetaPlaca.nIdEstado"
                                                                        filterable
                                                                        clearable
                                                                        @change="cambiarEstadoModal"
                                                                        loading-text
                                                                        placeholder="Seleccione un Estado Tramite">
                                                                    <el-option
                                                                        v-for="estado in arrayEstadoTramiteTarjetaPlaca"
                                                                        :key="estado.nIdPar"
                                                                        :label="estado.cParNombre"
                                                                        :value="estado.nIdPar">
                                                                    </el-option>
                                                                </el-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <template v-if="vistaEstado == 0">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <label class="col-md-2 form-control-label">*Observación</label>
                                                                <div class="col-md-10 widthFull">
                                                                    <el-input
                                                                        type="textarea"
                                                                        autosize
                                                                        clearable
                                                                        v-model="fillModalTarjetaPlaca.cObservacion">
                                                                    </el-input>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                                <div class="col-lg-12">
                                                    <form class="form-horizontal">
                                                        <div v-if="vistaEstado != 2" class="form-group row">
                                                            <div class="col-md-9 offset-md-5">
                                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarTramitePlaca">
                                                                    <i class="fa fa-save"></i> Registrar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <hr/>

                                            <template v-if="arrayListadoEstadosTarjetaPlaca.length">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha Fin Real</th>
                                                                <th>Estado</th>
                                                                <th>Observacion</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="estadosObs in arrayListadoEstadosTarjetaPlaca" :key="estadosObs.nIdTramiteObs">
                                                                <td v-text="estadosObs.dFechaFinRealTramite"></td>
                                                                <td v-text="estadosObs.cEstado"></td>
                                                                <td v-text="estadosObs.cObservacion"></td>
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
                                                                        <a @click.prevent="cambiarPaginaMisObservaciones(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                    </li>
                                                                    <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                    :class="[page==isActivedModal?'active':'']">
                                                                        <a class="page-link"
                                                                        href="#" @click.prevent="cambiarPaginaMisObservaciones(page)"
                                                                        v-text="page"></a>
                                                                    </li>
                                                                    <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                        <a @click.prevent="cambiarPaginaMisObservaciones(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModalTramiteTarjetaPlaca">Cerrar</button>
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
                loading: false,
                flagFixed: false,
                flagType: '',
                flagWidth: '',
                // =============================================================
                // VARIABLES BUSCAR PEDIDOS
                // =============================================================
                arrayEstadoTramite: [],
                fillBusquedaPedidos: {
                    nidestadotramite: ''
                },
                arrayPedidosCancelados: [],
                arrayPedidosChecked: [],
                // =============================================================
                // VARIABLES GENERAR TRAMITE
                // =============================================================
                fillBusquedaPedidosSeleccionados: {
                    fechaInicioTramite: '',
                    fechaFinRealTramite: '',
                    nroVehiculos: 0
                },
                montoSubTotalTramiteTarjeta: 0,
                montoSubTotalTramitePlaca: 0,
                montoSubTotalTramiteAdicional: 0,
                montoTotalGeneralTramite: 0,
                // =============================================================
                // VARIABLES SOLICITUD TRAMITE
                // =============================================================
                // ================================
                // SOLICITUD TRAMITE
                // ================================
                fillBusquedaSolTramite: {
                    fechaInicioTramite: '',
                    fechaFinRealTramite: '',
                    nidestadotramite: ''
                },
                arraySolicitudesTramites: [],
                // ================================
                // DETALLE SOLICITUD TRAMITE
                // ================================
                arrayDetalleSolicitudTramite: [],
                fillDetalleSolTramite: {
                    nroSolicitud: '',
                    nroVehiculos: '',
                    fechaInicioTramite: '',
                    fechaFinRealTramite: ''
                },
                // ================================
                // MODAL TRAMITE
                // ================================
                fillModalTarjetaPlaca: {
                    nIdEstado: '',
                    cNroTarjeta: '',
                    cNroPlaca: '',
                    cObservacion: '',
                    nIdTramiteTarjeta: '',
                    nIdCabeceraTramite: '',
                    nIdTramitePlaca: '',
                    dFechaInicioTramite: '',
                    dFechaFinTramite: '',
                    flagRegTramiteByEstado: '',//Registra Tramite by Estado (RECIBIDO o OBSERVADO)
                    flagOpcion: '',//Flag para bucar Listado de Observacion es por Tarjeta o Placa
                },
                vistaEstado: 2,
                arrayEstadoTramiteTarjetaPlaca: [],//Select de Estados
                arrayListadoEstadosTarjetaPlaca: [],//Listado de Estados Observados
                // =============================================================
                // VARIABLES GENÉRICAS
                // =============================================================
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
        mounted() {
            this.tabBuscarPedido();
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
            //Calcula SubTotales y Total del Tramite de Tarjeta
            totalTramiteTarjeta: function(){
                let me = this;
                return me.arrayPedidosChecked.reduce(function(valorAnterior, valorActual){
                    return valorAnterior + parseFloat(valorActual.fTotalTramiteTarjeta);
                }, 0);
            },
            //Calcula SubTotales y Total del Tramite de Placa
            totalTramitePlaca: function(){
                let me = this;
                return me.arrayPedidosChecked.reduce(function(valorAnterior, valorActual){
                    return valorAnterior + parseFloat(valorActual.fTotalTramitePlaca);
                }, 0);
            },
            //Calcula SubTotales y Total del Tramite de Adicional
            totalTramiteAdicional: function(){
                let me = this;
                return me.arrayPedidosChecked.reduce(function(valorAnterior, valorActual){
                    return valorAnterior + parseFloat(valorActual.fTotalGAdicional);
                }, 0);
            },
            totalGeneral: function(){
                let me = this;
                let montoTotalGeneral = me.montoSubTotalTramiteTarjeta + me.montoSubTotalTramitePlaca + me.montoSubTotalTramiteAdicional;
                montoTotalGeneral = Number((montoTotalGeneral).toFixed(2));
                return montoTotalGeneral;
            },
        },
        methods: {
            // =================================================================
            // METODOS TAB BUSCAR PEDIDOS
            // =================================================================
            tabBuscarPedido(){
                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass('nav-link active');
                $('#tab02').removeClass('nav-link active');
                $('#tab02').addClass('nav-link disabled');
                $('#tab03').removeClass('nav-link active');
                $('#tab03').addClass('nav-link');

                $('#TabBuscarPedido').addClass('in active show');
                $('#TabGenerarTramite').removeClass('in active show');
                $('#TabBandejaSolicitudes').removeClass('in active show');
                this.limpiarBuscarPedidos();
                this.llenarEstados();
                this.buscarMisPedidos(1);
            },
            llenarEstados(){
                var url = this.ruta + '/getComision/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110087,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayEstadoTramite = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            limpiarBuscarPedidos(){
                this.fillBusquedaPedidos.nidestadotramite = '';
            },
            buscarMisPedidos(page){
                this.loading = true;
                var url = this.ruta + '/tramite/GetPedidosCanceladosByEstadoTramite';
                axios.get(url, {
                    params: {
                        'nIdEstadoTramite' : (this.fillBusquedaPedidos.nidestadotramite == '') ? '0' : this.fillBusquedaPedidos.nidestadotramite,
                        'page' : page
                    }
                }).then(response => {
                    let me = this;
                    let info = response.data.arrayPedidosCancelados;
                    this.arrayPedidosCancelados  = info.data;
                    this.pagination.current_page = info.current_page;
                    this.pagination.total        = info.total;
                    this.pagination.per_page     = info.per_page;
                    this.pagination.last_page    = info.last_page;
                    this.pagination.from         = info.from;
                    this.pagination.to           = info.to;

                    if (this.arrayPedidosCancelados.length > 0) {
                        //Si la variable Estado no existe
                        if (typeof this.arrayPedidosCancelados[0].cEstadoTramite == "undefined"){
                            this.flagFixed = true
                            this.flagType  = 'selection'
                            this.flagWidth = '55'
                        } else {
                            (this.arrayPedidosCancelados[0].cEstadoTramite == '') ? this.flagFixed = true : this.flagFixed = '';
                            (this.arrayPedidosCancelados[0].cEstadoTramite == '') ? this.flagType = 'selection' : this.flagType = '';
                            (this.arrayPedidosCancelados[0].cEstadoTramite == '') ? this.flagWidth = '55' : this.flagWidth = '0';
                        }
                    }
                    //Setea el array a vacío
                    this.arrayPedidosChecked = [];
                    this.loading = false;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            cambiarPaginaMisPedidos(page){
                this.pagination.current_page=page;
                this.buscarMisPedidos(page);
            },
            handleSelectionChange(val){
                let me = this;

                val.map(function(value, key){
                    val[key].fTotalTramiteTarjeta = 10;
                    val[key].fTotalTramitePlaca = 5;
                    val[key].fTotalGAdicional = 2;
                })

                this.arrayPedidosChecked = val;
            },
            tabGenerarTramite(){
                if(this.validaGenerarTramite()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass('nav-link');
                $('#tab02').removeClass('nav-link disabled');
                $('#tab02').addClass('nav-link active');
                $('#tab03').removeClass('nav-link active');
                $('#tab03').addClass('nav-link');

                $('#TabBuscarPedido').removeClass('in active show');
                $('#TabGenerarTramite').addClass('in active show');
                $('#TabBandejaSolicitudes').removeClass('in active show');
                this.subtabGenerarTramite();
            },
            validaGenerarTramite(){
                this.error = 0;
                this.mensajeError =[];

                if(this.arrayPedidosChecked.length < 0){
                    this.mensajeError.push('Debe seleccionar un Pedido');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // =================================================================
            // METODOS TAB GENERAR TRAMITE
            // =================================================================
            subtabGenerarTramite(){
                $('#tab0201').removeClass('nav-link active');
                $('#tab0201').addClass('nav-link active');
                $('#tab0202').removeClass('nav-link active');
                $('#tab0202').addClass('nav-link');
                $('#tab0203').removeClass('nav-link active');
                $('#tab0203').addClass('nav-link disabled');

                $('#SubTabGenerarTramite').addClass('in active show');
                $('#SubTabBandejaSolicitudes').removeClass('in active show');
                $('#SubTabTarjetaPlaca').removeClass('in active show');
                this.cargarDatosBusquedaSubGenerarTramite();
            },
            cargarDatosBusquedaSubGenerarTramite(){
                this.obtenerFechaInicioTramite();
                this.obtenerFechaFinTramite();
                this.obtenerNroVehiculos();
            },
            obtenerFechaInicioTramite(){
                this.fillBusquedaPedidosSeleccionados.fechaInicioTramite = moment().format('DD/MM/YYYY');
            },
            obtenerFechaFinTramite(){
                var url = this.ruta + '/tipoparametro/GetTipoByIdParametro';
                axios.get(url, {
                    params: {
                        'nidpar' : 1300170,
                        'ctipoparametro' : 'N',
                        'nidtipopar': 4
                    }
                }).then(response => {
                    var fecha = moment().add(parseInt(response.data[0].nDatoParNumerico), 'days').format('DD/MM/YYYY');
                    this.fillBusquedaPedidosSeleccionados.fechaFinRealTramite = fecha;
                }).catch(error => {
                    console.log(error);
                });
            },
            obtenerNroVehiculos(){
                this.fillBusquedaPedidosSeleccionados.nroVehiculos = this.arrayPedidosChecked.length;
            },
            tabRegistrarTramite(){
                if(this.validarRegistrarTramite()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/tramite/SetCabeceraTramite';
                axios.post(url, {
                    'nIdEmpresa'            :   1300011,
                    'nIdSucursal'           :   sessionStorage.getItem("nIdSucursal"),
                    'dFechaInicioTramite'   :   this.fillBusquedaPedidosSeleccionados.fechaInicioTramite,
                    'dFechaFinTramite'      :   this.fillBusquedaPedidosSeleccionados.fechaFinRealTramite,
                    'nNroVehiculoTramite'   :   this.fillBusquedaPedidosSeleccionados.nroVehiculos,
                    'fTotalConTramiteTarjeta'   :   this.montoSubTotalTramiteTarjeta,
                    'fTotalConTramitePlaca' :   this.montoSubTotalTramitePlaca,
                    'fTotalGastoAdicional'  :   this.montoSubTotalTramiteAdicional,
                    'fTotalTramite'         :   this.montoTotalGeneralTramite,
                    'nIdEstadoTramite'      :   1300304,
                    'cFlagEstadoAprobacion' :   'P',
                }).then(response => {
                    this.setTramiteTarjeta(response.data);
                }).catch(error => {
                    this.errors = error
                });
            },
            validarRegistrarTramite(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.fillBusquedaPedidosSeleccionados.fechaFinRealTramite){
                    this.mensajeError.push('La fecha de Inicio del Tramite es un campo obligatorio');
                }
                if(!this.fillBusquedaPedidosSeleccionados.fechaInicioTramite){
                    this.mensajeError.push('La fecha de Fin del Tramite es un campo obligatorio');
                }
                if(!this.fillBusquedaPedidosSeleccionados.nroVehiculos || this.fillBusquedaPedidosSeleccionados.nroVehiculos == 0){
                    this.mensajeError.push('El número de vehículos es un campo obligatorio');
                }
                if(!this.montoSubTotalTramiteTarjeta){
                    this.mensajeError.push('El SubTotal del Tramite de la Tarjeta es un campo obligatorio');
                }
                if(!this.montoSubTotalTramitePlaca){
                    this.mensajeError.push('El SubTotal del Tramite de la Placa es un campo obligatorio');
                }
                if(!this.montoSubTotalTramiteAdicional){
                    this.mensajeError.push('El SubTotal del Gasto Adicional es un campo obligatorio');
                }
                if(!this.montoTotalGeneralTramite){
                    this.mensajeError.push('El Totla General del Tramite es un campo obligatorio');
                }
                if(this.arrayPedidosChecked.length == 0){
                    this.mensajeError.push('Se debe asignar Pedidos a la bandeja');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            setTramiteTarjeta(data){
                if(this.arrayPedidosChecked.length > 0){
                    var url = this.ruta + '/tramite/SetTramiteTarjeta';
                    axios.post(url, {
                        nIdCabeceraTramite      : data['nIdCabeceraTramite'],
                        dFechaInicioTramite     : data['dFechaInicioTramite'],
                        dFechaFinTramite        : data['dFechaFinTramite'],
                        nIdEstadoTramite        : 1300328,//Estado "EN TARJETA"
                        arrayPedidosChecked     : this.arrayPedidosChecked
                    }).then(response => {
                        swal('Tramite registrado exitosamente');
                        this.tabBandejaSolicitudes();
                    }).catch(error => {
                        console.log(error);
                    });
                }
            },
            // =================================================================
            // METODOS TAB SOLICITUD TRAMITE
            // =================================================================
            // ==================================
            // SUBTAB BANDEJA SOLICITUDES
            // ==================================
            tabBandejaSolicitudes(){
                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass('nav-link');
                $('#tab02').removeClass('nav-link active');
                $('#tab02').addClass('nav-link disabled');
                $('#tab03').removeClass('nav-link active');
                $('#tab03').addClass('nav-link active');

                $('#TabBuscarPedido').removeClass('in active show');
                $('#TabGenerarTramite').removeClass('in active show');
                $('#TabBandejaSolicitudes').addClass('in active show');

                $('#tab0301').removeClass('nav-link active');
                $('#tab0301').addClass('nav-link active');
                $('#tab0302').removeClass('nav-link active');
                $('#tab0302').addClass('nav-link disabled');

                $('#SubTabBandejaSolicitudes').addClass('in active show');
                $('#SubTabDetalleSolcitud').removeClass('in active show');
                this.limpiarBandejaSolicitudes();
                this.buscarMisTramites(1);
            },
            limpiarBandejaSolicitudes(){
                this.fillBusquedaPedidosSeleccionados.fechaInicioTramite = '';
                this.fillBusquedaPedidosSeleccionados.fechaFinRealTramite = '';
                this.fillBusquedaPedidosSeleccionados.nroVehiculos = 0;
                this.arrayPedidosChecked = [];
                this.fillBusquedaSolTramite.fechaInicioTramite = '';
                this.fillBusquedaSolTramite.fechaFinRealTramite = '';
                this.fillBusquedaSolTramite.nidestadotramite = '';
            },
            buscarMisTramites(page){
                this.loading = true;
                var url = this.ruta + '/tramite/GetSolicitudesTramites';
                axios.get(url, {
                    params: {
                        'nIdEstadoTramite' : (this.fillBusquedaSolTramite.nidestadotramite == '') ? '0' : this.fillBusquedaSolTramite.nidestadotramite,
                        'fechaInicioTramite' : this.fillBusquedaSolTramite.fechaInicioTramite,
                        'fechaFinRealTramite' : this.fillBusquedaSolTramite.fechaFinRealTramite,
                        'page' : page
                    }
                }).then(response => {
                    let me = this;
                    let info = response.data.arraySolicitudesTramites;
                    this.arraySolicitudesTramites  = info.data;
                    this.pagination.current_page = info.current_page;
                    this.pagination.total        = info.total;
                    this.pagination.per_page     = info.per_page;
                    this.pagination.last_page    = info.last_page;
                    this.pagination.from         = info.from;
                    this.pagination.to           = info.to;
                    this.loading = false;
                }).catch(error => {
                    if (error.response) {
                        if (error.response.status == 401) {
                            // window.open(this.ruta);
                            location.reload(true);
                        }
                    }
                });
            },
            cambiarPaginaMisTramites(page){
                this.pagination.current_page=page;
                this.buscarMisTramites(page);
            },
            cargarDetalleSolicitudTramite(page, data){
                this.loading = true;
                var url = this.ruta + '/tramite/GetDetalleSolicitudTramite';
                axios.get(url, {
                    params: {
                        'nIdCabeceraTramite' : data.nIdCabeceraTramite,
                        'page' : page
                    }
                }).then(response => {
                    let me = this;
                    let info = response.data.arrayDetalleSolicitudTramite;
                    this.arrayDetalleSolicitudTramite  = info.data;
                    this.pagination.current_page = info.current_page;
                    this.pagination.total        = info.total;
                    this.pagination.per_page     = info.per_page;
                    this.pagination.last_page    = info.last_page;
                    this.pagination.from         = info.from;
                    this.pagination.to           = info.to;
                    this.loading = false;

                    this.fillDetalleSolTramite.nroSolicitud = this.arrayDetalleSolicitudTramite[0].cNumeroSolicitudTramite;
                    this.fillDetalleSolTramite.nroVehiculos = this.arrayDetalleSolicitudTramite[0].nNumeroVehiculoTramite;
                    this.fillDetalleSolTramite.fechaInicioTramite = this.arrayDetalleSolicitudTramite[0].FechaInicioTramite;
                    this.fillDetalleSolTramite.fechaFinRealTramite = this.arrayDetalleSolicitudTramite[0].FechaFinRealTramite;
                    this.tabBandejaDetalleSolicitudTramite()
                }).catch(error => {
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload(true);
                        }
                    }
                });
            },
            tabBandejaDetalleSolicitudTramite(){
                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass('nav-link');
                $('#tab02').removeClass('nav-link active');
                $('#tab02').addClass('nav-link disabled');
                $('#tab03').removeClass('nav-link active');
                $('#tab03').addClass('nav-link active');

                $('#TabBuscarPedido').removeClass('in active show');
                $('#TabGenerarTramite').removeClass('in active show');
                $('#TabBandejaSolicitudes').addClass('in active show');

                $('#tab0301').removeClass('nav-link active');
                $('#tab0301').addClass('nav-link');
                $('#tab0302').removeClass('nav-link active');
                $('#tab0302').addClass('nav-link active');

                $('#SubTabBandejaSolicitudes').removeClass('in active show');
                $('#SubTabDetalleSolcitud').addClass('in active show');
            },
            // ==================================
            // MODAL TRAMITE TARJETA
            // ==================================
            llenarEstadosTramiteTarjetaPlaca(){
                var url = this.ruta + '/getComision/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110090,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayEstadoTramiteTarjetaPlaca = response.data;
                    this.$delete(this.arrayEstadoTramiteTarjetaPlaca, 0);
                }).catch(error => {
                    console.log(error);
                });
            },
            buscarMisObservaciones(page){
                var url = this.ruta + '/tramite/GetEstadosTarjetasPlaca';
                axios.get(url, {
                    params: {
                        'flagOpcion' : this.fillModalTarjetaPlaca.flagOpcion,
                        'nIdTramiteTarjeta': this.fillModalTarjetaPlaca.nIdTramiteTarjeta,
                        'nIdTramitePlaca': this.fillModalTarjetaPlaca.nIdTramitePlaca,
                        'page' : page
                    }
                }).then(response => {
                    let me = this;
                    let info = response.data.arrayListadoEstadosTarjetaPlaca;
                    this.arrayListadoEstadosTarjetaPlaca  = info.data;
                    this.paginationModal.current_page = info.current_page;
                    this.paginationModal.total        = info.total;
                    this.paginationModal.per_page     = info.per_page;
                    this.paginationModal.last_page    = info.last_page;
                    this.paginationModal.from         = info.from;
                    this.paginationModal.to           = info.to;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            cambiarPaginaMisObservaciones(page){
                this.pagination.current_page=page;
                this.buscarMisObservaciones(page);
            },
            cambiarEstadoModal(){
                if(this.fillModalTarjetaPlaca.nIdEstado == '') {
                   this.vistaEstado = 2;//Si es RECIBIDO
                   this.fillModalTarjetaPlaca.flagRegTramiteByEstado = '';//RECIBIDO
               }
               if(this.fillModalTarjetaPlaca.nIdEstado == 1300329) {
                   this.vistaEstado = 1;//Si es RECIBIDO
                   this.fillModalTarjetaPlaca.flagRegTramiteByEstado = 1;//RECIBIDO
               }
               if(this.fillModalTarjetaPlaca.nIdEstado == 1300330) {
                   this.vistaEstado = 0;//Si es OBSERVADA
                   this.fillModalTarjetaPlaca.flagRegTramiteByEstado = 0;//OBSERVADA
               }
            },
            registrarTramiteTarjeta(){
                if(this.validarTramiteTarjeta()){
                    return;
                }

                var url = this.ruta + '/tramite/SetEstadoTramiteTarjeta';
                axios.post(url, {
                    'nIdTramiteTarjeta': this.fillModalTarjetaPlaca.nIdTramiteTarjeta,
                    'dFechaFinRealTramite': moment().format('DD/MM/YYYY'),
                    'nIdEstado': this.fillModalTarjetaPlaca.nIdEstado,
                    'cNroTarjeta' : this.fillModalTarjetaPlaca.cNroTarjeta,
                    'cNroPlaca': this.fillModalTarjetaPlaca.cNroPlaca,
                    'cObservacion' : this.fillModalTarjetaPlaca.cObservacion,
                    'flagRegTramiteByEstado': this.fillModalTarjetaPlaca.flagRegTramiteByEstado
                }).then(response => {
                    console.log(response);
                    this.cargarDetalleSolicitudTramite(1, this.fillModalTarjetaPlaca);
                    this.cerrarModalTramiteTarjetaPlaca();
                }).catch(error => {
                    console.log(error);
                });
            },
            validarTramiteTarjeta(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.fillModalTarjetaPlaca.nIdEstado){
                    this.mensajeError.push('Debe seleccionar un estado, es campo obligatorio');
                }
                if (this.vistaEstado == 1) {
                    if(!this.fillModalTarjetaPlaca.cNroTarjeta){
                        this.mensajeError.push('Debe ingresar un número de Tarjeta, es campo obligatorio');
                    }
                    if(!this.fillModalTarjetaPlaca.cNroPlaca){
                        this.mensajeError.push('Debe ingresar un número de Placa, es campo obligatorio');
                    }
                } else {
                    if(!this.fillModalTarjetaPlaca.cObservacion){
                        this.mensajeError.push('Debe ingresar una observación, es campo obligatorio');
                    }
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // ==================================
            // MODAL TRAMITE PLACA
            // ==================================
            registrarTramitePlaca(){
                if(this.validarTramitePlaca()){
                    return;
                }

                var url = this.ruta + '/tramite/SetEstadoTramitePlaca';
                axios.post(url, {
                    'nIdTramitePlaca': this.fillModalTarjetaPlaca.nIdTramitePlaca,
                    'nIdCabeceraTramite': this.fillModalTarjetaPlaca.nIdCabeceraTramite,
                    'nIdTramiteTarjeta': this.fillModalTarjetaPlaca.nIdTramiteTarjeta,
                    'dFechaInicioTramite': this.fillModalTarjetaPlaca.dFechaInicioTramite,
                    'dFechaFinTramite': this.fillModalTarjetaPlaca.dFechaFinTramite,
                    'nIdEstado': this.fillModalTarjetaPlaca.nIdEstado,
                    'dFechaFinRealTramite': moment().format('DD/MM/YYYY'),
                    'cObservacion' : this.fillModalTarjetaPlaca.cObservacion,
                    'flagRegTramiteByEstado': this.fillModalTarjetaPlaca.flagRegTramiteByEstado
                }).then(response => {
                    console.log(response);
                    this.cargarDetalleSolicitudTramite(1, this.fillModalTarjetaPlaca);
                    this.cerrarModalTramiteTarjetaPlaca();
                }).catch(error => {
                    console.log(error);
                });
            },
            validarTramitePlaca(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.fillModalTarjetaPlaca.nIdEstado){
                    this.mensajeError.push('Debe seleccionar un estado, es campo obligatorio');
                }
                if (this.vistaEstado != 1) {
                    if(!this.fillModalTarjetaPlaca.cObservacion){
                        this.mensajeError.push('Debe ingresar una observación, es campo obligatorio');
                    }
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // =================================================================
            // METODOS GENERICOS
            // =================================================================
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "solicitud-tramite":
                    {
                        switch(accion){
                            case 'detalle':
                            {
                                this.cargarDetalleSolicitudTramite(1, data);
                                break;
                            }
                        }
                    }
                    break;
                    case "tarjeta":
                    {
                        switch(accion){
                            case 'abrir':
                            {
                                this.accionmodal=2;
                                this.modal = 1;
                                this.vistaEstado = 2;//Inputs Ocultos
                                this.arrayListadoEstadosTarjetaPlaca = [];//Setear Listado de Estados Observados
                                this.fillModalTarjetaPlaca.flagOpcion = 1;//Flag para bucar Listado de Tarjetas
                                this.fillModalTarjetaPlaca.nIdTramiteTarjeta = data['nIdTramiteTarjeta'];
                                this.fillModalTarjetaPlaca.nIdCabeceraTramite = data['nIdCabeceraTramite'];
                                this.llenarEstadosTramiteTarjetaPlaca();
                                this.buscarMisObservaciones(1);
                                break;
                            }
                        }
                    }
                    break;
                    case "placa":
                    {
                        switch(accion){
                            case 'abrir':
                            {
                                this.accionmodal=3;
                                this.modal = 1;
                                this.vistaEstado = 2;//Inputs Ocultos
                                this.arrayListadoEstadosTarjetaPlaca = [];//Setear Listado de Estados Observados
                                this.fillModalTarjetaPlaca.flagOpcion = 2;//Flag para bucar Listado de Placas
                                this.fillModalTarjetaPlaca.nIdTramiteTarjeta = data['nIdTramiteTarjeta'];
                                this.fillModalTarjetaPlaca.nIdTramitePlaca = data['nIdTramitePlaca'];
                                this.fillModalTarjetaPlaca.nIdCabeceraTramite = data['nIdCabeceraTramite'];
                                this.fillModalTarjetaPlaca.dFechaInicioTramite = data['dFechaInicioTramite'];
                                this.fillModalTarjetaPlaca.dFechaFinTramite = data['dFechaFinTramite'];
                                this.llenarEstadosTramiteTarjetaPlaca();
                                this.buscarMisObservaciones(1);
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
            cerrarModalSolicitud(){
                this.modal = 0;
                this.accionmodal = 0;
                this.error = 0;
                this.mensajeError = '';
            },
            cerrarModalTramiteTarjetaPlaca(){
                this.cerrarModalSolicitud();
                this.fillModalTarjetaPlaca.nIdEstado = '',
                this.fillModalTarjetaPlaca.cNroPlaca = '',
                this.fillModalTarjetaPlaca.cNroTarjeta = '',
                this.fillModalTarjetaPlaca.cObservacion = '',
                this.fillModalTarjetaPlaca.nIdTramiteTarjeta = '',
                this.fillModalTarjetaPlaca.nIdTramitePlaca = '',
                this.fillModalTarjetaPlaca.dFechaInicioTramite = '',
                this.fillModalTarjetaPlaca.dFechaFinTramite = '',
                this.fillModalTarjetaPlaca.nIdCabeceraTramite = '',
                this.fillModalTarjetaPlaca.flagRegTramiteByEstado = ''
                this.arrayListadoEstadosTarjetaPlaca = [];
                this.fillModalTarjetaPlaca.flagOpcion = '';
                this.vistaEstado = 2;
            }
        }
    }
</script>

<style>
    .el-row {
        margin-bottom: 20px;
    }
    .el-col {
        border-radius: 4px;
    }
    .bg-purple-dark {
        background: #99a9bf;
    }
    .bg-purple {
        background: #d3dce6;
    }
    .bg-purple-light {
        background: #e5e9f2;
    }
    .grid-content {
        border-radius: 4px;
        min-height: 36px;
    }
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
        text-align: center;
        margin: auto;
    }
    .input-with-select .el-input-group__prepend {
        background-color: #fff;
    }
    .widthFull>.el-select>.el-input {
        width: 100%;
    }
    /* Estilos Modal */
    .menosPadding{
        padding: .31rem;
    }
    .subCabecera{
        justify-content: center;
        padding: 1rem;
        background: white;
    }
    .subCabecera>h3{
        color: black;
        font-size: 1rem;
        font-weight: bolder;
    }
    .flexRigth{
        display: flex;
        justify-content: center;
        align-items: flex-end;
        align-content: flex-end;
    }
    .flexLeft{
        width: 100%;
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
        align-content: flex-start;
    }
    .flexLeft>h4{
        font-weight: bolder;
    }
</style>



