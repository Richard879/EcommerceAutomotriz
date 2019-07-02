<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <vs-divider color="dark">
                        <h2 class="no-margin-bottom">MODULO RECUPERACIÓN DE DINERO</h2>
                    </vs-divider>
                </div>
            </header>

            <section>
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link" :class="{'active': (vistaFormulario == 1)}" id="tab01" href="#TabBandejaDescuentosGenerar" @click="tabBandejaDsctoPedido" role="tab" data-toggle="tab">
                                            <i class="fas fa-coins"></i> DESCUENTOS OTORGADOS - PEDIDO
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" :class="{'active': (vistaFormulario == 0)}" id="tab02" href="#TabBandejaDescuentosNC" @click="tabBandejaDsctoPedidoNC" role="tab" data-toggle="tab">
                                            <i class="fas fa-coins"></i> Nota Crédito
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <template v-if="vistaFormulario">
                                        <div role="tabpanel" class="tab-pane fade" :class="{'in active show': (vistaFormulario == 1)}" id="TabBandejaDescuentosGenerar">
                                            <section class="forms">
                                                <div class="container-fluid">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h3 class="h4">BANDEJA DE DESCUENTOS OTORGADOS</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <form class="form-horizontal">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Sucursal</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-select  v-model="formDscOtorgados.nidsucursal"
                                                                                                filterable
                                                                                                clearable
                                                                                                placeholder="SUCURSAL"
                                                                                                @change="listarAsesoresBySucursal(1)">
                                                                                        <el-option
                                                                                            v-for="item in arraySucursal"
                                                                                            :key="item.nIdPar"
                                                                                            :label="item.cParNombre"
                                                                                            :value="item.nIdPar">
                                                                                        </el-option>
                                                                                    </el-select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="row">
                                                                                <label class="col-md-4 form-control-label">Asesor Comercial</label>
                                                                                <div class="col-md-8">
                                                                                    <el-select  v-model="formDscOtorgados.nidvendedor"
                                                                                                filterable
                                                                                                clearable
                                                                                                placeholder="SELECCIONE UN ASESOR COMERCIAL">
                                                                                        <el-option
                                                                                            v-for="ele in arrayVendedores"
                                                                                            :key="ele.nIdUsuario"
                                                                                            :label="ele.cNombreCompleto"
                                                                                            :value="ele.nIdUsuario">
                                                                                        </el-option>
                                                                                    </el-select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Cronograma</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-select  v-model="formDscOtorgados.nidcronograma"
                                                                                                filterable
                                                                                                clearable
                                                                                                placeholder="CRONOGRAMA">
                                                                                        <el-option
                                                                                            v-for="item in arrayCronogramas"
                                                                                            :key="item.nIdCronograma"
                                                                                            :label="item.cCronograma"
                                                                                            :value="item.nIdCronograma">
                                                                                        </el-option>
                                                                                    </el-select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Estado Pedido</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-select  v-model="formDscOtorgados.nidestadopedido"
                                                                                                filterable
                                                                                                clearable
                                                                                                placeholder="ESTADOS">
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
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Monto Descuento</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" v-model="formDscOtorgados.fmontodescuento" @keyup.enter="listarDistribucion(1)" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9 offset-sm-5">
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="listarDescPedido(1)">
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
                                                                <h3 class="h4">PREVISUALIZACIÓN</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <template v-if="arrayDistribucionDesc.length">
                                                                    <div class="table-responsive">
                                                                        <el-table
                                                                            ref="multipleTable"
                                                                            :data="arrayDistribucionDesc"
                                                                            stripe
                                                                            style="width: 100%"
                                                                            @selection-change="itemSelectedDscOtorgados">
                                                                            <el-table-column fixed type="selection" width="55"></el-table-column>
                                                                            <el-table-column property="SUCURSAL" label="SUCURSAL" width="100"></el-table-column>
                                                                            <el-table-column fixed property="NUM_PEDIDO" label="N° PEDIDO" width="100"></el-table-column>
                                                                            <el-table-column property="NUM_COTIZACION" label="N° COTIZACIÓN" width="110"></el-table-column>
                                                                            <el-table-column property="FECHA_COTIZACION" label="F. COTIZACIÓN" width="110"></el-table-column>
                                                                            <el-table-column property="FECHA_VENC_COTIZACION" label="F. VENC. COTI" width="110"></el-table-column>
                                                                            <el-table-column property="FECHA_PEDIDO" label="FECHA PEDIDO" width="110"></el-table-column>
                                                                            <el-table-column property="TCC" label="TCC"></el-table-column>
                                                                            <el-table-column property="PRECIO_BASE_DOLAR" label="PRECIO BASE" width="100"></el-table-column>
                                                                            <el-table-column property="PRECIO_CIERRE_DOLAR" label="PRECIO CIERRE" width="110"></el-table-column>
                                                                            <el-table-column label="TYP">
                                                                                <template slot-scope="scope"> {{ Number((parseFloat(scope.row.PRECIO_TYP_DOLAR)).toFixed(2)) }}</template>
                                                                            </el-table-column>
                                                                            <el-table-column property="PRECIO_VENTA_CLIENTE" label="PRECIO VENTA" width="110"></el-table-column>
                                                                            <el-table-column property="DESCUENTO_VEHI_DOLAR" label="DESCUENTO" width="100"></el-table-column>
                                                                            <el-table-column label="SOBRE PRECIO" width="110">
                                                                                <template slot-scope="scope"> {{ Number((parseFloat(scope.row.SOBREPRECIO_VEHI_DOLAR)).toFixed(2)) }}</template>
                                                                            </el-table-column>
                                                                            <el-table-column property="COTI_VEHI_DOLAR" label="VEHICULO ($)" width="110"></el-table-column>
                                                                            <el-table-column property="COTI_VEHI_SOL" label="VEHICULO (S/)" width="110"></el-table-column>
                                                                            <el-table-column label="E.V ($)" width="90">
                                                                                <template slot-scope="scope"> {{ Number((parseFloat(scope.row.COTI_EV_DOLAR)).toFixed(2)) }}</template>
                                                                            </el-table-column>
                                                                            <el-table-column label="E.V (S/)" width="90">
                                                                                <template slot-scope="scope"> {{ Number((parseFloat(scope.row.COTI_EV_SOL)).toFixed(2)) }}</template>
                                                                            </el-table-column>
                                                                            <el-table-column property="COTI_TOTAL_DOLAR" label="COTIZACION ($)" width="120"></el-table-column>
                                                                            <el-table-column property="COTI_TOTAL_SOL" label="COTIZACION (S/)" width="120"></el-table-column>
                                                                            <el-table-column property="ASUNTO" label="ASUNTO" width="120"></el-table-column>
                                                                            <el-table-column property="ESTADO" label="ESTADO COT" width="120"></el-table-column>
                                                                            <el-table-column label="DESCUENTO" width="110">
                                                                                <template slot-scope="scope"> {{ Number((parseFloat(scope.row.DESCUENTO)).toFixed(2)) }}</template>
                                                                            </el-table-column>
                                                                            <el-table-column property="PROVEEDOR" label="PROVEEDOR" width="120"></el-table-column>
                                                                            <el-table-column label="MONTO ASUMIDO" width="130">
                                                                                <template slot-scope="scope">
                                                                                    <input type="text" v-model="scope.row.PROVEEDOR_MONTO_ASUMIDO" @keyup="verificarMonto(scope.row, scope.$index, 1)" class="form-control inputdsc">
                                                                                    <!-- {{ Number((parseFloat(scope.row.PROVEEDOR_MONTO_ASUMIDO)).toFixed(2)) }} -->
                                                                                </template>
                                                                            </el-table-column>
                                                                            <el-table-column property="EMP" label="EMPRESA" width="120"></el-table-column>
                                                                            <el-table-column label="MONTO ASUMIDO" width="130">
                                                                                <template slot-scope="scope">
                                                                                    <input type="text" v-model="scope.row.EMPRESA_MONTO_ASUMIDO" @keyup="verificarMonto(scope.row, scope.$index, 2)" class="form-control inputdsc">
                                                                                    <!-- {{ Number((parseFloat(scope.row.EMPRESA_MONTO_ASUMIDO)).toFixed(2)) }} -->
                                                                                </template>
                                                                            </el-table-column>
                                                                            <el-table-column property="NOMBRE_COMERCIAL" label="NOMBRE COMERCIAL" width="148"></el-table-column>
                                                                            <el-table-column property="VIN" label="VIN" width="120"></el-table-column>
                                                                            <el-table-column property="ASESOR_COMERCIAL" label="ASESOR COMERCIAL" width="148"></el-table-column>
                                                                            <el-table-column property="CONTACTO" label="CONTACTO" width="120"></el-table-column>
                                                                            <el-table-column property="N_DOCUMENTO" label="N° DOCUMENTO" width="120"></el-table-column>
                                                                            <el-table-column property="DIRECCION" label="DIRECCIÓN" width="120"></el-table-column>
                                                                            <el-table-column property="TELEFONO_MOVIL" label="TEL MOVIL" width="120"></el-table-column>
                                                                            <!-- <el-table-column fixed="right" label="Operaciones" width="120">
                                                                                <template slot-scope="scope">
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Generar Nota Credito {{ scope.row.VIN }}</div>
                                                                                        <i @click="generarSAPNotaCredito(scope.row)" :style="'color:blue'" class="fas fa-md fa-poll-h"></i>&nbsp;&nbsp;
                                                                                    </el-tooltip>
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Obtener Nota Credito {{ scope.row.VIN }}</div>
                                                                                        <i @click="generarSAPNotaCredito(scope.row)" :style="'color:green'" class="fas fa-md fa-cube fa-spin"></i>
                                                                                    </el-tooltip>
                                                                                </template>
                                                                            </el-table-column> -->
                                                                        </el-table>
                                                                    </div>
                                                                    <br>
                                                                    <template v-if="arrayDistribucionMultipleSelection.length > 0">
                                                                        <div class="col-sm-12">
                                                                            <form class="form-horizontal">
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-9 offset-sm-5">
                                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="obtenerSgcCostoDscProveedor(1)">
                                                                                            <i class="fas fa-md fa-poll-h fa-spin"></i> Integrar Tabla Costo
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </template>
                                                                    <br>
                                                                    <div class="col-sm-12">
                                                                        <div class="row">
                                                                            <div class="col-sm-7">
                                                                                <nav>
                                                                                    <ul class="pagination">
                                                                                        <li v-if="pagination.current_page > 1" class="page-item">
                                                                                            <a @click.prevent="cambiarPaginaDscPedido(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                        </li>
                                                                                        <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                        :class="[page==isActived?'active':'']">
                                                                                            <a class="page-link"
                                                                                            href="#" @click.prevent="cambiarPaginaDscPedido(page)"
                                                                                            v-text="page"></a>
                                                                                        </li>
                                                                                        <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                            <a @click.prevent="cambiarPaginaDscPedido(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                        </div>
                                    </template>

                                    <template v-else>
                                        <div role="tabpanel" class="tab-pane fade" :class="{'in active show': (vistaFormulario == 0)}"  id="TabBandejaDescuentosNC">
                                            <section class="forms">
                                                <div class="container-fluid">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h3 class="h4">BANDEJA DE DESCUENTOS OTORGADOS PARA NOTA CREDITO</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <form class="form-horizontal">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Sucursal</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-select  v-model="formDscOtorgados.nidsucursal"
                                                                                                filterable
                                                                                                clearable
                                                                                                placeholder="SUCURSAL"
                                                                                                @change="listarAsesoresBySucursal(1)">
                                                                                        <el-option
                                                                                            v-for="item in arraySucursal"
                                                                                            :key="item.nIdPar"
                                                                                            :label="item.cParNombre"
                                                                                            :value="item.nIdPar">
                                                                                        </el-option>
                                                                                    </el-select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="row">
                                                                                <label class="col-md-4 form-control-label">Asesor Comercial</label>
                                                                                <div class="col-md-8">
                                                                                    <el-select  v-model="formDscOtorgados.nidvendedor"
                                                                                                filterable
                                                                                                clearable
                                                                                                placeholder="SELECCIONE UN ASESOR COMERCIAL">
                                                                                        <el-option
                                                                                            v-for="ele in arrayVendedores"
                                                                                            :key="ele.nIdUsuario"
                                                                                            :label="ele.cNombreCompleto"
                                                                                            :value="ele.nIdUsuario">
                                                                                        </el-option>
                                                                                    </el-select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Cronograma</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-select  v-model="formDscOtorgados.nidcronograma"
                                                                                                filterable
                                                                                                clearable
                                                                                                placeholder="CRONOGRAMA">
                                                                                        <el-option
                                                                                            v-for="item in arrayCronogramas"
                                                                                            :key="item.nIdCronograma"
                                                                                            :label="item.cCronograma"
                                                                                            :value="item.nIdCronograma">
                                                                                        </el-option>
                                                                                    </el-select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Estado Pedido</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-select  v-model="formDscOtorgados.nidestadopedido"
                                                                                                filterable
                                                                                                clearable
                                                                                                placeholder="ESTADOS">
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
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Monto Descuento</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" v-model="formDscOtorgados.fmontodescuento" @keyup.enter="listarDistribucion(1)" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9 offset-sm-5">
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="listarPedidoDistribuido(1)">
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
                                                                <h3 class="h4">PREVISUALIZACIÓN</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <template v-if="arrayNotaCredito.length">
                                                                    <div class="table-responsive">
                                                                        <el-table
                                                                            ref="multipleTable"
                                                                            :data="arrayNotaCredito"
                                                                            stripe
                                                                            style="width: 100%"
                                                                            @selection-change="itemSelectedPedidosDistribuidos">
                                                                            <el-table-column fixed type="selection" width="55"></el-table-column>
                                                                            <el-table-column property="SUCURSAL" label="SUCURSAL" width="100"></el-table-column>
                                                                            <el-table-column fixed property="NUM_PEDIDO" label="N° PEDIDO" width="100"></el-table-column>
                                                                            <el-table-column property="NUM_COTIZACION" label="N° COTIZACIÓN" width="110"></el-table-column>
                                                                            <el-table-column property="FECHA_COTIZACION" label="F. COTIZACIÓN" width="110"></el-table-column>
                                                                            <el-table-column property="FECHA_VENC_COTIZACION" label="F. VENC. COTI" width="110"></el-table-column>
                                                                            <el-table-column property="FECHA_PEDIDO" label="FECHA PEDIDO" width="110"></el-table-column>
                                                                            <el-table-column property="TCC" label="TCC"></el-table-column>
                                                                            <el-table-column property="PRECIO_BASE_DOLAR" label="PRECIO BASE" width="100"></el-table-column>
                                                                            <el-table-column property="PRECIO_CIERRE_DOLAR" label="PRECIO CIERRE" width="110"></el-table-column>
                                                                            <el-table-column label="TYP">
                                                                                <template slot-scope="scope"> {{ Number((parseFloat(scope.row.PRECIO_TYP_DOLAR)).toFixed(2)) }}</template>
                                                                            </el-table-column>
                                                                            <el-table-column property="PRECIO_VENTA_CLIENTE" label="PRECIO VENTA" width="110"></el-table-column>
                                                                            <el-table-column property="DESCUENTO_VEHI_DOLAR" label="DESCUENTO" width="100"></el-table-column>
                                                                            <el-table-column label="SOBRE PRECIO" width="110">
                                                                                <template slot-scope="scope"> {{ Number((parseFloat(scope.row.SOBREPRECIO_VEHI_DOLAR)).toFixed(2)) }}</template>
                                                                            </el-table-column>
                                                                            <el-table-column property="COTI_VEHI_DOLAR" label="VEHICULO ($)" width="110"></el-table-column>
                                                                            <el-table-column property="COTI_VEHI_SOL" label="VEHICULO (S/)" width="110"></el-table-column>
                                                                            <el-table-column label="E.V ($)" width="90">
                                                                                <template slot-scope="scope"> {{ Number((parseFloat(scope.row.COTI_EV_DOLAR)).toFixed(2)) }}</template>
                                                                            </el-table-column>
                                                                            <el-table-column label="E.V (S/)" width="90">
                                                                                <template slot-scope="scope"> {{ Number((parseFloat(scope.row.COTI_EV_SOL)).toFixed(2)) }}</template>
                                                                            </el-table-column>
                                                                            <el-table-column property="COTI_TOTAL_DOLAR" label="COTIZACION ($)" width="120"></el-table-column>
                                                                            <el-table-column property="COTI_TOTAL_SOL" label="COTIZACION (S/)" width="120"></el-table-column>
                                                                            <el-table-column property="ASUNTO" label="ASUNTO" width="120"></el-table-column>
                                                                            <el-table-column property="ESTADO" label="ESTADO COT" width="120"></el-table-column>
                                                                            <el-table-column label="DESCUENTO" width="110">
                                                                                <template slot-scope="scope"> {{ Number((parseFloat(scope.row.DESCUENTO)).toFixed(2)) }}</template>
                                                                            </el-table-column>
                                                                            <el-table-column property="PROVEEDOR" label="PROVEEDOR" width="120"></el-table-column>
                                                                            <el-table-column label="MONTO ASUMIDO" width="130">
                                                                                <template slot-scope="scope">
                                                                                    {{ Number((parseFloat(scope.row.PROVEEDOR_MONTO_ASUMIDO)).toFixed(2)) }}
                                                                                </template>
                                                                            </el-table-column>
                                                                            <el-table-column property="EMP" label="EMPRESA" width="120"></el-table-column>
                                                                            <el-table-column label="MONTO ASUMIDO" width="130">
                                                                                <template slot-scope="scope">
                                                                                    {{ Number((parseFloat(scope.row.EMPRESA_MONTO_ASUMIDO)).toFixed(2)) }}
                                                                                </template>
                                                                            </el-table-column>
                                                                            <el-table-column property="NOMBRE_COMERCIAL" label="NOMBRE COMERCIAL" width="148"></el-table-column>
                                                                            <el-table-column property="VIN" label="VIN" width="120"></el-table-column>
                                                                            <el-table-column property="ASESOR_COMERCIAL" label="ASESOR COMERCIAL" width="148"></el-table-column>
                                                                            <el-table-column property="CONTACTO" label="CONTACTO" width="120"></el-table-column>
                                                                            <el-table-column property="N_DOCUMENTO" label="N° DOCUMENTO" width="120"></el-table-column>
                                                                            <el-table-column property="DIRECCION" label="DIRECCIÓN" width="120"></el-table-column>
                                                                            <el-table-column property="TELEFONO_MOVIL" label="TEL MOVIL" width="120"></el-table-column>
                                                                            <el-table-column fixed="right" label="Operaciones" width="120">
                                                                                <template slot-scope="scope">
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Obtener Nota Credito {{ scope.row.VIN }}</div>
                                                                                        <input type="text" v-model="scope.row.nDocNumNC" class="form-control inputdsc">
                                                                                    </el-tooltip>
                                                                                    <!-- Se mostrara la opción para pagar solo si se ha ingresado el DocNum y esta con estado Pendiente la nota de credito-->
                                                                                    <template v-if="scope.row.nDocNumNC != 0 && scope.row.cFlagEstadoNC == 'P'">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Pagar Nota Credito {{ scope.row.VIN }}</div>
                                                                                            <i @click="aprobarNotaCredito(scope.row)" :style="'color:#B0B02E'" class="fas fa-md fa-coins fa-spin"></i>
                                                                                        </el-tooltip>
                                                                                    </template>
                                                                                </template>
                                                                            </el-table-column>
                                                                        </el-table>
                                                                    </div>
                                                                    <br>
                                                                    <template v-if="arrayNotaCreditoMultipleSelection.length > 0">
                                                                        <div class="col-sm-12">
                                                                            <form class="form-horizontal">
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-9 offset-sm-5">
                                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="actualizarNotasCredito(1)">
                                                                                            <i class="fas fa-md fa-poll-h fa-spin"></i> Nota de Credito Pagadas
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </template>
                                                                    <br>
                                                                    <div class="col-sm-12">
                                                                        <div class="row">
                                                                            <div class="col-sm-7">
                                                                                <nav>
                                                                                    <ul class="pagination">
                                                                                        <li v-if="pagination.current_page > 1" class="page-item">
                                                                                            <a @click.prevent="cambiarPaginaPedidoDistribuidos(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                        </li>
                                                                                        <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                        :class="[page==isActived?'active':'']">
                                                                                            <a class="page-link"
                                                                                            href="#" @click.prevent="cambiarPaginaPedidoDistribuidos(page)"
                                                                                            v-text="page"></a>
                                                                                        </li>
                                                                                        <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                            <a @click.prevent="cambiarPaginaPedidoDistribuidos(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                        </div>
                                    </template>
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
        </main>
    </transition>
</template>

<script>
    export default {
        props:['ruta', 'usuario'],
        data(){
            return {
                // =================================================================
                // VARAIBLES BANDEJA DE DESCUENTOS OTORGADOS DE LOS PEDIDOS
                // =================================================================
                formDscOtorgados: {
                    nidsucursal: '',
                    nidvendedor: '',
                    nidcronograma: '',
                    nidestadopedido: '',
                    fmontodescuento: ''
                },
                arrayDistribucionDescRpta: [],
                arrayDistribucionDesc: [],
                arrayDistribucionMultipleSelection: [],
                arraySapCostoDscProveedor: [],
                // =================================================================
                // VARAIBLES BANDEJA DE NOTA DE CREDITO DE LOS PEDIDOS
                // =================================================================
                arrayNotaCreditoRpta: [],
                arrayNotaCredito: [],
                arrayNotaCreditoMultipleSelection: [],

                arraySucursal: [],
                arrayVendedores: [],
                arrayCronogramas: [],
                arrayEstadoPedido: [],
                // =============================================================
                // VARIABLES GENÉRICAS
                // =============================================================
                page: 1,
                perPage: 10,
                pages:[],
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'from1': 0,
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
                vistaModal: 0,
                vistaFormulario: 1,
                loading: false
            }
        },
        mounted(){
            this.tabBandejaDsctoPedido();
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
            // =================================================================
            // TAB BANDEJA DE DESCUENTOS OTORGADOS DE LOS PEDIDOS
            // =================================================================
            toggleSelection(rows) {
                if (rows) {
                    rows.forEach(row => {
                        this.$refs.multipleTable.toggleRowSelection(row);
                    });
                } else {
                    this.$refs.multipleTable.clearSelection();
                }
            },
            itemSelectedDscOtorgados(val) {
                this.arrayDistribucionMultipleSelection = val;
            },
            tabBandejaDsctoPedido(){
                this.vistaFormulario = 1;
                this.limpiarTabBsqDescPedido();
                this.listarSucursalByEmpresa();
                // this.listarVendedores();
                this.listarCronograma();
                this.listarEstadoPedido();
            },
            limpiarTabBsqDescPedido(){
                this.formDscOtorgados.nidsucursal           =   '';
                this.formDscOtorgados.nidvendedor           =   '';
                this.formDscOtorgados.nidcronograma         =   '';
                this.formDscOtorgados.nidestadopedido       =   '';
                this.formDscOtorgados.fmontodescuento       =   '';
                this.arrayDistribucionDescRpta              =   [];
                this.arrayDistribucionDesc                  =   [];
                this.arrayDistribucionMultipleSelection     =   [];
                this.arraySapCostoDscProveedor              =   [];

                this.arrayNotaCreditoRpta                   =   [];
                this.arrayNotaCredito                       =   [];
                this.arrayNotaCreditoMultipleSelection      =   [];
            },
            /**
             * METODOS PARA CARGAR DATA
             */
            listarSucursalByEmpresa(){
                var url = this.ruta + '/perrelacion/GetLstSucursalByEmpresa';
                axios.get(url, {
                    params: {
                        'nidusuario': this.usuario.id,
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa"))
                    }
                }).then(response => {
                    this.arraySucursal = response.data;
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
            listarVendedores(){
                this.mostrarProgressBar();

                var url = this.ruta + '/usuario/GetListUsuariosByRol';
                axios.get(url, {
                    params: {
                        'nidempresa' :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal':   0,
                        'nidrol'     :   '110026'
                    }
                }).then(response => {
                    this.arrayVendedores = response.data;
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                    $("#myBar").hide();
                });
            },
            listarCronograma(){
                var url = this.ruta + '/cronograma/GetCronogramaByTipo';
                axios.get(url, {
                    params: {
                        'nidgrupar' :   110039,
                        'nidpar'    :   1300057
                    }
                }).then(response => {
                    this.arrayCronogramas = response.data.arrayCronograma;
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
            listarEstadoPedido(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110063,
                        'opcion' : 1
                    }
                }).then(response => {
                    this.arrayEstadoPedido = response.data;
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
            listarAsesoresBySucursal(){
                var url = this.ruta + '/usuario/GetListUsuariosBySucursal';
                axios.get(url, {
                    params: {
                        'nidempresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'   :   this.formFiltro.nidsucursal
                    }
                }).then(response => {
                    this.arrayVendedores = response.data;
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
            /**
             * FIN METODOS PARA CARGAR DATA
             */
            validarBsqDescPedido(){
                this.error = 0;
                this.mensajeError =[];

                // if(this.formBsqVehiculo.nidproveedor == ''){
                //     this.mensajeError.push('Debe Seleccionar Proveedor');
                // }
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            listarDescPedido(page){
                if(this.validarBsqDescPedido()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/dsctotorgados/GetListDistribucionDesc';
                axios.get(url, {
                    params: {
                        'nidempresa'        :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'       :   this.formDscOtorgados.nidsucursal,
                        'nidvendedor'       :   this.formDscOtorgados.nidvendedor,
                        'nidcronograma'     :   this.formDscOtorgados.nidcronograma,
                        'nidestadopedido'   :   this.formDscOtorgados.nidestadopedido,
                        'fmontodescuento'   :   this.formDscOtorgados.fmontodescuento,
                        'opcion'            :   2,
                        'page'              :   page
                    }
                }).then(response => {
                    this.arrayDistribucionDescRpta  = response.data.arrayDistribucionDesc;
                    this.paginateDscOtorgadosPedido(this.arrayDistribucionDescRpta, page);
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                    $("#myBar").hide();
                });
            },
            paginateDscOtorgadosPedido(data, page){
                this.pagination.current_page    =   page; // 1
                this.pagination.total           =   data.length; // 55
                this.pagination.per_page        =   this.perPage; // 10
                this.pagination.last_page       =   Math.ceil(data.length / this.pagination.per_page); // 55 / 10 => 5.5 => 6
                this.pagination.from            =   (this.pagination.current_page * this.pagination.per_page) - this.pagination.per_page + 1; // (1 * 10) - 10 + 1
                this.pagination.from1           =   (this.pagination.current_page * this.pagination.per_page) - this.pagination.per_page ; // (1 * 10) - 10
                this.pagination.to              =   (this.pagination.last_page == page) ? ( (this.pagination.current_page * this.pagination.per_page) - ((this.pagination.current_page * this.pagination.per_page) - data.length)) : (this.pagination.current_page * this.pagination.per_page);
                this.arrayDistribucionDesc      =   data.slice(this.pagination.from1, this.pagination.to); // mostrar desde (0 // 10)
            },
            cambiarPaginaDscPedido(page){
                this.pagination.current_page=page;
                this.paginateDscOtorgadosPedido(this.arrayDistribucionDescRpta, page);
            },
            verificarMonto(data, index, op){
                // console.log(data, index);
                // console.log(this.arrayDistribucionDesc[index]);

                if (op == 1) {
                    //Monto Total del Descuento - Monto Asumido Proveedor
                    let montoParaEmp = this.arrayDistribucionDesc[index].DESCUENTO - this.arrayDistribucionDesc[index].PROVEEDOR_MONTO_ASUMIDO;
                    //Monto Asumido Emp se actualiza.
                    this.arrayDistribucionDesc[index].EMPRESA_MONTO_ASUMIDO = montoParaEmp
                } else {
                    //Monto Total del Descuento - Monto Asumido Proveedor
                    let montoParaProv = this.arrayDistribucionDesc[index].DESCUENTO - this.arrayDistribucionDesc[index].EMPRESA_MONTO_ASUMIDO;
                    //Monto Asumido Emp se actualiza.
                    this.arrayDistribucionDesc[index].PROVEEDOR_MONTO_ASUMIDO = montoParaProv
                }
            },
            // ==
            obtenerSgcCostoDscProveedor(){
                let me = this;

                me.mostrarProgressBar();
                me.loadingProgressBar("INTEGRANDO COSTOS CON SAP BUSINESS ONE...");

                me.arraySapCostoDscProveedor = [];
                // ====================== CONCEPTO =========================
                // =============== DESCUENTOS DE PROVEEDOR =================
                me.arrayDistribucionMultipleSelection.map(function(value, key){
                    me.arraySapCostoDscProveedor.push({
                        'U_SYP_VIN'                 : value.VIN,
                        'DocEntry'                  : value.nDocEntryTblCosto,
                        'U_SYP_CCONCEPTO'           : '08',
                        'U_SYP_DCONCEPTO'           : 'Descuento de Proveedor',
                        'U_SYP_CDOCUMENTO'          : '01',
                        'U_SYP_DDOCUMENTO'          : 'Nota de Crédito',
                        'U_SYP_IMPORTE'             : (value.PROVEEDOR_MONTO_ASUMIDO > 0) ? ('-' + (value.PROVEEDOR_MONTO_ASUMIDO * value.TCCP)) : value.PROVEEDOR_MONTO_ASUMIDO * value.TCCP,
                        'U_SYP_IMPORTE_USD'         : (value.PROVEEDOR_MONTO_ASUMIDO > 0) ? ('-' + value.PROVEEDOR_MONTO_ASUMIDO) : value.PROVEEDOR_MONTO_ASUMIDO,
                        'U_SYP_COSTO'               : 'Si',
                        'U_SYP_ESTADO'              : 'Pendiente',
                        'nIdCabeceraCotizacion'     : value.nIdCabeceraCotizacion,
                        'EMP_ID'                    : value.EMP_ID,
                        'EMPRESA_MONTO_ASUMIDO'     : value.EMPRESA_MONTO_ASUMIDO,
                        'PROVEEDOR_DISTRIBUCION_ID' : value.PROVEEDOR_DISTRIBUCION_ID,
                        'PROVEEDOR_ID'              : value.PROVEEDOR_ID,
                        'PROVEEDOR_MONTO_ASUMIDO'   : value.PROVEEDOR_MONTO_ASUMIDO,
                        'EMPRESA_DISTRIBUCION_ID'   : value.EMPRESA_DISTRIBUCION_ID
                    });
                });

                setTimeout(function() {
                    me.registroSapBusinessTblCostoDscProveedor();
                }, 300);
            },
            registroSapBusinessTblCostoDscProveedor(){
                let me = this;

                var url = me.ruta + '/tablacosto/SapPachTablaCosto';
                axios.post(url, {
                    'data'  : me.arraySapCostoDscProveedor
                }).then(response => {
                    this.registrarNuevaDscOtorgado();
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
            registrarNuevaDscOtorgado(){
                let me = this;

                var url = me.ruta + '/dsctotorgados/SetDistribucionDesc';
                axios.post(url, {
                    'data'  : me.arraySapCostoDscProveedor
                }).then(response => {
                    swal(
                        'Generado!',
                        'Los Descuentos Otorgados del pedido han sido integrados con éxito.',
                        'success'
                    );
                    $("#myBar").hide();
                    me.loading.close();
                    this.listarDescPedido(1);
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
            // TAB BANDEJA DE NOTAS DE CREDITO DE LOS PEDIDOS
            // =================================================================
            tabBandejaDsctoPedidoNC(){
                this.vistaFormulario = 0;
                this.limpiarTabBsqDescPedido();
                this.listarSucursalByEmpresa();
                this.listarCronograma();
                this.listarEstadoPedido();
            },
            listarPedidoDistribuido(page){
                if(this.validarBsqDescPedido()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/dsctotorgados/GetListPedidoDistribuido';
                axios.get(url, {
                    params: {
                        'nidempresa'        :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'       :   this.formDscOtorgados.nidsucursal,
                        'nidvendedor'       :   this.formDscOtorgados.nidvendedor,
                        'nidcronograma'     :   this.formDscOtorgados.nidcronograma,
                        'nidestadopedido'   :   this.formDscOtorgados.nidestadopedido,
                        'fmontodescuento'   :   this.formDscOtorgados.fmontodescuento,
                        'opcion'            :   2,
                        'page'              :   page
                    }
                }).then(response => {
                    this.arrayNotaCreditoRpta  = response.data.arrayPedidosDistribuido;
                    this.paginatePedidoDistribuido(this.arrayNotaCreditoRpta, page);
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                    $("#myBar").hide();
                });
            },
            paginatePedidoDistribuido(data, page){
                this.pagination.current_page    =   page; // 1
                this.pagination.total           =   data.length; // 55
                this.pagination.per_page        =   this.perPage; // 10
                this.pagination.last_page       =   Math.ceil(data.length / this.pagination.per_page); // 55 / 10 => 5.5 => 6
                this.pagination.from            =   (this.pagination.current_page * this.pagination.per_page) - this.pagination.per_page + 1; // (1 * 10) - 10 + 1
                this.pagination.from1           =   (this.pagination.current_page * this.pagination.per_page) - this.pagination.per_page ; // (1 * 10) - 10
                this.pagination.to              =   (this.pagination.last_page == page) ? ( (this.pagination.current_page * this.pagination.per_page) - ((this.pagination.current_page * this.pagination.per_page) - data.length)) : (this.pagination.current_page * this.pagination.per_page);
                this.arrayNotaCredito           =   data.slice(this.pagination.from1, this.pagination.to); // mostrar desde (0 // 10)
            },
            cambiarPaginaPedidoDistribuidos(page){
                this.pagination.current_page=page;
                this.paginatePedidoDistribuido(this.arrayNotaCreditoRpta, page);
            },
            itemSelectedPedidosDistribuidos(val) {
                this.arrayNotaCreditoMultipleSelection = val;
            },
            actualizarNotasCredito(){
                if(this.validarNotasCredito()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                let me = this;

                var url = me.ruta + '/dsctotorgados/SetUpdDocNumNC';
                axios.post(url, {
                    'data'  : me.arrayNotaCreditoMultipleSelection
                }).then(response => {
                    swal(
                        'Generado!',
                        'Las Notas de Crédito han sido actualizadas correctamente.',
                        'success'
                    );
                    $("#myBar").hide();
                    me.loading.close();
                    this.listarDescPedido(1);
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
            validarNotasCredito(){
                let me = this;
                this.error = 0;
                this.mensajeError =[];

                me.arrayNotaCreditoMultipleSelection.map(function(value, key){
                    if (value.nDocNumNC == 0 || value.nDocNumNC == '') {
                        me.mensajeError.push('Debe ingresar el Código de la NC del Pedido : ' + value.NUM_PEDIDO);
                    }
                });

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            aprobarNotaCredito(){

            },
            // =============================================
            // =============  MODAL ========================
            cerrarModal(){
                this.modal = 0
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
                    case 'accesorios':
                    {
                        switch(accion){
                            case 'ver':
                            {
                                this.accionmodal=3;
                                this.modal = 1;
                                this.listarAccesoriosPorVehiculo(data);
                                break;
                            }
                        }
                    }
                    break;
                }
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
    .barraLateral{
        height: 45vh;
        max-width:1200px;
        overflow-x: auto;
        overflow-y: auto;
    }
    .styleElementos{
        background: beige !important;
        border-radius: .4rem !important;
        padding: .2rem !important;
        margin-bottom: .4rem !important;
        display: flex;
        justify-content: space-between;
    }
    .styleElementos input{
        border-radius: .3rem;
        margin-right: .6rem;
    }
    .el-autocomplete{
        width: 100%;
    }
    .el-autocomplete-suggestion li{
        font-size: 0.8em;
    }
    .el-table .cell{
        line-height: 1.1 !important;
        font-size: 1.21em;
        color: #666;
    }
    .el-table td, .el-table th{
        padding: 0 !important;
    }
    .inputdsc{
        border: 1px solid #3b5998 !important;
    }
</style>

