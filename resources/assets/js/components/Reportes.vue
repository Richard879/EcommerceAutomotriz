<template>
    <transition tag="ul" name="bounce" mode="out-in" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <vs-divider color="dark">
                        <h2 class="no-margin-bottom">REPORTES DE {{ formLogin.cUsuario }} - {{ formLogin.cRol }}</h2>
                    </vs-divider>
                </div>
            </header>

            <!--CONSULTAS/RETAIL || Adminis//JV//Supervisor//ADV/Gerencia-->
            <template v-if="formLogin.nIdRol == 110124 || formLogin.nIdRol == 110025 || formLogin.nIdRol == 110121 || formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                <section class="dashboard-counts no-padding-bottom">
                    <div class="container-fluid">
                        <div class="row bg-white has-shadow">
                            <div class="col-xs-12" style="width: 100%;">
                                <h3>CONSULTAS/RETAIL</h3>
                            </div>
                            <div class="col-xl-4 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <div class="icon bg-violet" @click="abrirModal('ventaretail', 'abrir', 'VENTA RETAIL')"><i class="fa-md fa fa-file-excel-o"></i></div>
                                    <div class="title"><span><br>Detalle Venta Retail</span></div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <div class="icon bg-violet" @click="abrirModal('ventahgsi', 'abrir', 'VENTA HGSI')"><i class="fa-md fa fa-file-excel-o"></i></div>
                                    <div class="title"><span><br>Ventas HGSI</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </template>

            <!--Marketing y Ventas || Adminis//JV/ADV/Gerencia-->
            <section class="dashboard-counts no-padding-bottom" v-if="formLogin.nIdRol == 110124 || formLogin.nIdRol == 110025 || formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                <div class="container-fluid">
                    <div class="row bg-white has-shadow">
                        <div class="col-xs-12" style="width: 100%;">
                            <h3>MARKETING Y VENTAS</h3>
                        </div>

                        <!-- Si es Adminis//ADV//Gerencia -->
                        <template v-if="formLogin.nIdRol == 110124 || formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                            <!-- Si es ADV//Gerencia -->
                            <template v-if="formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                                <div class="col-xl-4 col-sm-6">
                                    <div class="item d-flex align-items-center">
                                        <div class="icon bg-violet" @click="abrirModal('ventadiaria', 'abrir', 'VENTA DIARIA')"><i class="fa-md fa fa-file-excel-o"></i></div>
                                        <div class="title"><span><br>Venta Diaria</span></div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6">
                                    <div class="item d-flex align-items-center">
                                        <div class="icon bg-violet" @click="abrirModal('descuento-compartido', 'abrir', 'DESCUENTOS OTORGADOS')"><i class="fa-md fa fa-file-excel-o"></i></div>
                                        <div class="title"><span><br>Descuentos Otorgados</span></div>
                                    </div>
                                </div>
                            </template>
                            <!-- Si es Adminis//ADV//Gerencia -->
                            <div class="col-xl-4 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <div class="icon bg-violet" @click="abrirModal('comision-vendedores', 'abrir', 'COMISIONES VENTAS')"><i class="fa-md fa fa-file-excel-o"></i></div>
                                    <div class="title"><span><br>Comisiones a los AC - Ventas</span></div>
                                </div>
                            </div>

                            <!-- Si es Adminis//ADV//Gerencia -->
                            <div class="col-xl-4 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <div class="icon bg-violet" @click="abrirModal('comision-vendedores', 'abrir-adm', 'COMISIONES ADMINISTRATIVO')"><i class="fa-md fa fa-file-excel-o"></i></div>
                                    <div class="title"><span><br>Comisiones a los AC - Administrativo</span></div>
                                </div>
                            </div>
                        </template>

                        <!-- Si es JV//ADV//Gerencia -->
                        <template v-if="formLogin.nIdRol == 110025 || formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                            <div class="col-xl-4 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <div class="icon bg-violet" @click="abrirModal('pedido-deposito', 'abrir', 'ESTADO DE PEDIDOS CON DEPOSITO')"><i class="fa-md fa fa-file-excel-o"></i></div>
                                    <div class="title"><span><br>Estado de Pedidos con Deposito</span></div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </section>

            <!--Reportes Comerciales || AC//JV//Supervisor//ADV//Gerencia -->
            <template v-if="formLogin.nIdRol == 110026 || formLogin.nIdRol == 110025 || formLogin.nIdRol == 110121 || formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                <section class="dashboard-counts no-padding-bottom">
                    <div class="container-fluid">
                        <div class="row bg-white has-shadow">
                            <div class="col-xs-12" style="width: 100%;">
                                <h3>REPORTES COMERCIALES</h3>
                            </div>

                            <div class="col-xl-4 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <!-- @click="abrirModal('ventadiaria', 'abrir', 'VENTA DIARIA')" -->
                                    <div class="icon bg-violet"  @click="abrirModal('stock', 'abrir', 'LISTA STOCK VEHICULOS')"><i class="fa-md fa fa-file-excel-o"></i></div>
                                    <div class="title"><span><br>Stock Vehiculos</span></div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <div class="icon bg-violet"  @click="abrirModal('stock-general', 'abrir', 'STOCK VEHICULOS GENERAL')"><i class="fa-md fa fa-file-excel-o"></i></div>
                                    <div class="title"><span><br>Stock Vehiculos General</span></div>
                                </div>
                            </div>

                            <template v-if="formLogin.nIdRol == 110025 || formLogin.nIdRol == 110121 || formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                                <div class="col-xl-4 col-sm-6">
                                    <div class="item d-flex align-items-center">
                                        <div class="icon bg-violet"  @click="abrirModal('meta-venta', 'abrir', 'METAS DE VENTAS')"><i class="fa-md fa fa-file-excel-o"></i></div>
                                        <div class="title"><span><br>Metas de venta de vehículos</span></div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6">
                                    <div class="item d-flex align-items-center">
                                        <div class="icon bg-violet"  @click="abrirModal('contacto-libre', 'abrir', 'CONTACTO LIBRE')"><i class="fa-md fa fa-file-excel-o"></i></div>
                                        <div class="title"><span><br>Contactos Libres</span></div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6">
                                    <div class="item d-flex align-items-center">
                                        <div class="icon bg-violet"  @click="abrirModal('cotizaciones', 'abrir', 'COTIZACIONES POR FILTRO')"><i class="fa-md fa fa-file-excel-o"></i></div>
                                        <div class="title"><span><br>Cotizaciones</span></div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </section>
            </template>

            <!-- Modal Show Errors -->
            <div class="modal fade" v-if="accionmodal==1" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
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

            <!-- Modal Show VENTAS RETAIL -->
            <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">FILTROS DE {{ tituloModal }} </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <form class="form-horizontal">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="row" style="display: flex; align-items: center; justify-content: center;">
                                                            <div class="text-center">
                                                                <div v-for="e in mensajeError" :key="e" v-text="e"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">* Sucursal</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidsucursal"
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
                                                                <el-select  v-model="formFiltro.nidvendedor"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="SELECCIONE UN ASESOR COMERCIAL"
                                                                            @change="listarSubLineaByVendedor()">
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
                                                    <div class="col-sm-9 offset-sm-5">
                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="listarVentaRetail(1)">
                                                            <i class="fa fa-search"></i> Buscar
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="h4">PREVISUALIZACIÓN</h3>
                                                </div>
                                                <div class="card-body">
                                                    <template v-if="arrayDetalleVentaRetail.length">
                                                        <div class="table-responsive">
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Exportar Metas de Venta(s) XLS</div>
                                                                <el-button @click="exportarDetalleVentaRetail()">
                                                                    <i :style="'color:rgb(44, 255, 101)'" class="fa-md fa fa-file-excel-o" ></i>
                                                                </el-button>
                                                            </el-tooltip>
                                                            <el-table
                                                                :data="arrayDetalleVentaRetail"
                                                                stripe
                                                                style="width: 100%">
                                                                <el-table-column property="COMPANIA" label="COMPANIA" width="120"></el-table-column>
                                                                <el-table-column property="CONCESIONARIO" label="CONCESIONARIO" width="170"></el-table-column>
                                                                <el-table-column property="TIENDA" label="TIENDA" width="150"></el-table-column>
                                                                <el-table-column fixed property="NRO_PEDIDO" label="N° PEDIDO" width="150"></el-table-column>
                                                                <el-table-column property="FECHA_PEDIDO" label="FECHA PEDIDO" width="140"></el-table-column>
                                                                <el-table-column property="DESC_CLIENTE" label="CLIENTE" width="180"></el-table-column>
                                                                <el-table-column property="NDOCUMENTO" label="Nª DOCUMENTO" width="120"></el-table-column>
                                                                <el-table-column property="COD_VENDEDOR" label="CODIGO ASESOR" width="130"></el-table-column>
                                                                <el-table-column property="NOM_VENDEDOR" label="ASESOR COMERCIAL" width="160"></el-table-column>
                                                                <el-table-column property="STATUS_PEDIDO" label="ESTADO PEDIDO" width="120"></el-table-column>
                                                                <el-table-column property="TIPO_VENTA" label="TIPO VENTA" width="120"></el-table-column>
                                                                <el-table-column property="MARCA" label="MARCA" width="100"></el-table-column>
                                                                <el-table-column property="MODELO" label="MODELO" width="100"></el-table-column>
                                                                <el-table-column property="NOMBRE_COMERCIAL" label="NOMBRE COMERCIAL" width="180"></el-table-column>
                                                                <el-table-column property="VIN" label="VIN" width="150"></el-table-column>
                                                                <el-table-column property="ANIO_MODEL" label="AÑO MODELO" width="120"></el-table-column>
                                                                <el-table-column property="ENTIDAD_FIN" label="ENTIDAD FINAN" width="120"></el-table-column>
                                                                <el-table-column label="IMPORTE_VEHICULO_SOLES" width="135">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.IMPORTE_VEHICULO_SOLES)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="IMPORTE_VEHICULO_DOLARES" width="135">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.IMPORTE_VEHICULO_DOLARES)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="DESCUENTO" width="115">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.DESCUENTO)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="SOBRE PRECIO" width="125">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.SOBREPRECIO)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="PRECIO CIERRE LP" width="135">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.PRECIOCIERRELP)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="PRECIO CIERRE FINAL CLIENTE" width="135">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.PRECIOCIERREFINALCLIENTE)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                            </el-table>
                                                            <!--
                                                            <table class="table table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>
                                                                            COMPANIA&nbsp;
                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content">Exportar Metas de Venta(s) XLS</div>
                                                                                    <i :style="'color:#796AEE'" class="fa-md fa fa-file-excel-o" @click="exportarDetalleVentaRetail()"></i>
                                                                            </el-tooltip>
                                                                        </th>
                                                                        <th>CONCESIONARIO</th>
                                                                        <th>TIENDA</th>
                                                                        <th>N° PEDIDO</th>
                                                                        <th>FECHA PEDIDO</th>
                                                                        <th>CLIENTE</th>
                                                                        <th>Nª DOCUMENTO</th>
                                                                        <th>CODIGO ASESOR</th>
                                                                        <th>ASESOR COMERCIAL</th>
                                                                        <th>ESTADO PEDIDO</th>
                                                                        <th>ESTADO DEPOSITO</th>
                                                                        <th>TIPO VENTA</th>
                                                                        <th>MARCA</th>
                                                                        <th>MODELO</th>
                                                                        <th>NOMBRE COMERCIAL</th>
                                                                        <th>VIN</th>
                                                                        <th>AÑO MODELO</th>
                                                                        <th>ENTIDAD FINAN</th>
                                                                        <th>IMPORTE SOLES</th>
                                                                        <th>IMPORTE DOLARES</th>
                                                                        <th>DESCUENTO</th>
                                                                        <th>SOBRE PRECIO</th>
                                                                        <th>PRECIO CIERRE LP</th>
                                                                        <th>PRECIO CIERRE CLIENTE</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(ventaretail, index) in arrayDetalleVentaRetail" :key="index">
                                                                        <td v-text="ventaretail.COMPANIA"></td>
                                                                        <td v-text="ventaretail.CONCESIONARIO"></td>
                                                                        <td v-text="ventaretail.TIENDA"></td>
                                                                        <td v-text="ventaretail.NRO_PEDIDO"></td>
                                                                        <td v-text="ventaretail.FECHA_PEDIDO"></td>
                                                                        <td v-text="ventaretail.DESC_CLIENTE"></td>
                                                                        <td v-text="ventaretail.NDOCUMENTO"></td>
                                                                        <td v-text="ventaretail.COD_VENDEDOR"></td>
                                                                        <td v-text="ventaretail.NOM_VENDEDOR"></td>
                                                                        <td v-text="ventaretail.STATUS_PEDIDO"></td>
                                                                        <td v-text="ventaretail.STATUS_DEPOSITO"></td>
                                                                        <td v-text="ventaretail.TIPO_VENTA"></td>
                                                                        <td v-text="ventaretail.MARCA"></td>
                                                                        <td v-text="ventaretail.MODELO"></td>
                                                                        <td v-text="ventaretail.NOMBRE_COMERCIAL"></td>
                                                                        <td v-text="ventaretail.VIN"></td>
                                                                        <td v-text="ventaretail.ANIO_MODEL"></td>
                                                                        <td v-text="ventaretail.ENTIDAD_FIN"></td>
                                                                        <td v-text="ventaretail.IMPORTE_VEHICULO_SOLES"></td>
                                                                        <td v-text="ventaretail.IMPORTE_VEHICULO_DOLARES"></td>
                                                                        <td v-text="ventaretail.DESCUENTO"></td>
                                                                        <td v-text="ventaretail.SOBREPRECIO"></td>
                                                                        <td v-text="ventaretail.PRECIOCIERRELP"></td>
                                                                        <td v-text="ventaretail.PRECIOCIERREFINALCLIENTE"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            -->
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-7">
                                                                    <nav>
                                                                        <ul class="pagination">
                                                                            <li v-if="pagination.current_page > 1" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaVentaRetail(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                            </li>
                                                                            <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                            :class="[page==isActived?'active':'']">
                                                                                <a class="page-link"
                                                                                href="#" @click.prevent="cambiarPaginaVentaRetail(page)"
                                                                                v-text="page"></a>
                                                                            </li>
                                                                            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaVentaRetail(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Show VENTAS HGSI -->
            <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">FILTROS DE {{ tituloModal }} </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <form class="form-horizontal">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="row" style="display: flex; align-items: center; justify-content: center;">
                                                            <div class="text-center">
                                                                <div v-for="e in mensajeError" :key="e" v-text="e"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">* Sucursal</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidsucursal"
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
                                                                <el-select  v-model="formFiltro.nidvendedor"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="SELECCIONE UN ASESOR COMERCIAL"
                                                                            @change="listarSubLineaByVendedor()">
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
                                                            <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidproveedor"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="PROVEEDOR"
                                                                            @change="llenarComboLinea()">
                                                                    <el-option
                                                                        v-for="item in arrayProveedor"
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
                                                            <label class="col-sm-4 form-control-label">Linea Vehiculo</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidlinea"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="SELECCIONE LINEA"
                                                                            @change="llenarComboMarca()">
                                                                    <el-option
                                                                        v-for="item in arrayLinea"
                                                                        :key="item.nIdLinea"
                                                                        :label="item.cLineaNombre"
                                                                        :value="item.nIdLinea">
                                                                    </el-option>
                                                                </el-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label class="col-md-4 form-control-label">Marca</label>
                                                            <div class="col-md-8">
                                                                <el-select  v-model="formFiltro.nidmarca"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="SELECCIONE UNA MARCA"
                                                                            @change="llenarComboModelo()">
                                                                    <el-option
                                                                        v-for="item in arrayMarca"
                                                                        :key="item.nIdMarca"
                                                                        :label="item.cMarcaNombre"
                                                                        :value="item.nIdMarca">
                                                                    </el-option>
                                                                </el-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label class="col-md-4 form-control-label">Modelo</label>
                                                            <div class="col-md-8">
                                                                <el-select  v-model="formFiltro.nidmodelo"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="SELECCIONE UN MODELO">
                                                                    <el-option
                                                                        v-for="item in arrayModelo"
                                                                        :key="item.nIdModelo"
                                                                        :label="item.cModeloNombre"
                                                                        :value="item.nIdModelo">
                                                                    </el-option>
                                                                </el-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-9 offset-sm-5">
                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="listarVentaHGSI(1)">
                                                            <i class="fa fa-search"></i> Buscar
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="h4">PREVISUALIZACIÓN</h3>
                                                </div>
                                                <div class="card-body">
                                                    <template v-if="arrayVentaHGSI.length">
                                                        <div class="table-responsive">
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Exportar Venta(s) HGSI XLS</div>
                                                                <el-button @click="exportarVentaHGSI()">
                                                                    <i :style="'color:rgb(44, 255, 101)'" class="fa-md fa fa-file-excel-o" ></i>
                                                                </el-button>
                                                            </el-tooltip>
                                                            <el-table
                                                                :data="arrayVentaHGSI"
                                                                stripe
                                                                style="width: 100%">
                                                                <el-table-column fixed property="NRO_PEDIDO" label="#PEDIDO" width="130"></el-table-column>
                                                                <el-table-column property="FECHA_PEDIDO" label="FECHA PEDIDO" width="150"></el-table-column>
                                                                <el-table-column property="LINEA" label="LINEA" width="170"></el-table-column>
                                                                <el-table-column property="MARCA" label="MARCA" width="110"></el-table-column>
                                                                <el-table-column property="MODELO" label="MODELO" width="120"></el-table-column>
                                                                <el-table-column property="NOMBRE_COMERCIAL" label="NOMBRE COMERCIAL" width="180"></el-table-column>
                                                                <el-table-column property="VIN" label="VIN" width="130"></el-table-column>
                                                                <el-table-column property="PLACA" label="PLACA" width="100"></el-table-column>
                                                                <el-table-column property="ANIO_FABRI" label="AÑO FAB" width="100"></el-table-column>
                                                                <el-table-column property="ANIO_MODEL" label="AÑO MODELO" width="120"></el-table-column>
                                                                <el-table-column property="CONTACTO" label="CONTACTO" width="160"></el-table-column>
                                                                <el-table-column property="DOCUMENTO" label="# DOC" width="100"></el-table-column>
                                                                <el-table-column property="DIRECCION" label="DIRECCIÓN" width="160"></el-table-column>
                                                                <el-table-column property="DEPARTAMENTO" label="DEPARTAMENTO" width="120"></el-table-column>
                                                                <el-table-column property="PROVINCIA" label="PROVINCIA" width="100"></el-table-column>
                                                                <el-table-column property="DISTRITO" label="DISTRITO" width="100"></el-table-column>
                                                                <el-table-column property="E_MAIL" label="EMAIL" width="160"></el-table-column>
                                                                <el-table-column property="TELEFONO" label="TELÉFONO" width="100"></el-table-column>
                                                                <el-table-column property="CELULAR" label="CELULAR" width="100"></el-table-column>
                                                                <el-table-column property="NRO_COTIZACION" label="N° COTIZACIÓN" width="120"></el-table-column>
                                                                <el-table-column property="TIPO_VENTA" label="TIPO VENTA" width="120"></el-table-column>
                                                                <el-table-column property="ESTADO_FACTURACION" label="ESTADO FACTURACION" width="100"></el-table-column>
                                                                <el-table-column property="FECHA_FACTURACION" label="FECHA FACTURACION" width="100"></el-table-column>
                                                                <el-table-column property="COD_VENDEDOR" label="COD VENDEDOR" width="100"></el-table-column>
                                                                <el-table-column property="VENDEDOR" label="VENDEDOR" width="150"></el-table-column>
                                                            </el-table>
                                                            <!--
                                                            <table class="table table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#PEDIDO&nbsp;
                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content">Exportar Venta(s) HGSI XLS</div>
                                                                                    <i :style="'color:#796AEE'" class="fa-md fa fa-file-excel-o" @click="exportarVentaHGSI()"></i>
                                                                            </el-tooltip></th>
                                                                        <th>FECHA PEDIDO</th>
                                                                        <th>LINEA</th>
                                                                        <th>MARCA</th>
                                                                        <th>MODELO</th>
                                                                        <th>NOMBRE COMERCIAL</th>
                                                                        <th>VIN</th>
                                                                        <th>PLACA</th>
                                                                        <th>AÑO FAB</th>
                                                                        <th>AÑO MODELO</th>
                                                                        <th>CONTACTO</th>
                                                                        <th># DOC</th>
                                                                        <th>DIRECCIÓN</th>
                                                                        <th>DEPARTAMENTO</th>
                                                                        <th>PROVINCIA</th>
                                                                        <th>DISTRITO</th>
                                                                        <th>EMAIL</th>
                                                                        <th>TELÉFONO</th>
                                                                        <th>CELULAR</th>
                                                                        <th>N° COTIZACIÓN</th>
                                                                        <th>TIPO VENTA</th>
                                                                        <th>FECHA CANCELACIÓN</th>
                                                                        <th>FECHA PROGRAMADA</th>
                                                                        <th>FECHA SALIDA</th>
                                                                        <th>COD VENDEDOR</th>
                                                                        <th>VENDEDOR</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(ventahgsi, index) in arrayVentaHGSI" :key="index">
                                                                        <td v-text="ventahgsi.NRO_PEDIDO"></td>
                                                                        <td v-text="ventahgsi.FECHA_PEDIDO"></td>
                                                                        <td v-text="ventahgsi.LINEA"></td>
                                                                        <td v-text="ventahgsi.MARCA"></td>
                                                                        <td v-text="ventahgsi.MODELO"></td>
                                                                        <td v-text="ventahgsi.NOMBRE_COMERCIAL"></td>
                                                                        <td v-text="ventahgsi.VIN"></td>
                                                                        <td v-text="ventahgsi.PLACA"></td>
                                                                        <td v-text="ventahgsi.ANIO_FABRI"></td>
                                                                        <td v-text="ventahgsi.ANIO_MODEL"></td>
                                                                        <td v-text="ventahgsi.CONTACTO"></td>
                                                                        <td v-text="ventahgsi.DOCUMENTO"></td>
                                                                        <td v-text="ventahgsi.DIRECCION"></td>
                                                                        <td v-text="ventahgsi.DEPARTAMENTO"></td>
                                                                        <td v-text="ventahgsi.PROVINCIA"></td>
                                                                        <td v-text="ventahgsi.DISTRITO"></td>
                                                                        <td v-text="ventahgsi.E_MAIL"></td>
                                                                        <td v-text="ventahgsi.TELEFONO"></td>
                                                                        <td v-text="ventahgsi.CELULAR"></td>
                                                                        <td v-text="ventahgsi.NRO_COTIZACION"></td>
                                                                        <td v-text="ventahgsi.TIPO_VENTA"></td>
                                                                        <td v-text="ventahgsi.FECHA_CANCELACION"></td>
                                                                        <td v-text="ventahgsi.FECHA_PROGRAMADA"></td>
                                                                        <td v-text="ventahgsi.FECHA_SALIDA"></td>
                                                                        <td v-text="ventahgsi.COD_VENDEDOR"></td>
                                                                        <td v-text="ventahgsi.VENDEDOR"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            -->
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-7">
                                                                    <nav>
                                                                        <ul class="pagination">
                                                                            <li v-if="pagination.current_page > 1" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaVentaHGSI(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                            </li>
                                                                            <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                            :class="[page==isActived?'active':'']">
                                                                                <a class="page-link"
                                                                                href="#" @click.prevent="cambiarPaginaVentaHGSI(page)"
                                                                                v-text="page"></a>
                                                                            </li>
                                                                            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaVentaHGSI(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Show Venta Diaria -->
            <div class="modal fade" v-if="accionmodal==4" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">FILTROS DE {{ tituloModal }} </h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <label class="col-md-4 form-control-label">Seleccione una Fecha</label>
                                                        <div class="col-md-8">
                                                            <el-date-picker
                                                                v-model="formFiltro.dfechaventadiaria"
                                                                type="date"
                                                                value-format="yyyy-MM-dd"
                                                                format="dd/MM/yyyy"
                                                                placeholder="dd/mm/aaaa"
                                                                :picker-options="pickerOptions">
                                                            </el-date-picker>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <label class="col-md-4 form-control-label">Asesor Comercial</label>
                                                        <div class="col-md-8">
                                                            <el-select  v-model="formFiltro.nidvendedor"
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
                                                <div class="col-sm-9 offset-sm-5">
                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="exportarVentaDiaria()">
                                                        <i class="fa fa-save"></i> Generar Reporte
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
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

            <!-- Modal Show LISTA STOCK VEHICULOS -->
            <div class="modal fade" v-if="accionmodal==5" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">FILTROS DE {{ tituloModal }} </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <form class="form-horizontal">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="row" style="display: flex; align-items: center; justify-content: center;">
                                                            <div class="text-center">
                                                                <div v-for="e in mensajeError" :key="e" v-text="e"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">* Sucursal</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidsucursal"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="SUCURSAL"
                                                                            @change="obtenerListaPrecioActiva">
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
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidproveedor"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="PROVEEDOR"
                                                                            @change="llenarComboLinea()">
                                                                    <el-option
                                                                        v-for="item in arrayProveedor"
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
                                                            <label class="col-sm-4 form-control-label">* Nro Lista</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" v-model="formFiltro.nrolista" class="form-control form-control-sm" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Linea Vehiculo</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidlinea"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="SELECCIONE LINEA"
                                                                            @change="llenarComboMarca()">
                                                                    <el-option
                                                                        v-for="item in arrayLinea"
                                                                        :key="item.nIdLinea"
                                                                        :label="item.cLineaNombre"
                                                                        :value="item.nIdLinea">
                                                                    </el-option>
                                                                </el-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Disponible</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.cflagdisponible"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="SELECCIONE">
                                                                    <el-option
                                                                        v-for="item in arrayFlagDisponible"
                                                                        :key="item.id"
                                                                        :label="item.nombre"
                                                                        :value="item.id">
                                                                    </el-option>
                                                                </el-select>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label class="col-md-4 form-control-label">Marca</label>
                                                            <div class="col-md-8">
                                                                <el-select  v-model="formFiltro.nidmarca"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="SELECCIONE UNA MARCA"
                                                                            @change="llenarComboModelo()">
                                                                    <el-option
                                                                        v-for="item in arrayMarca"
                                                                        :key="item.nIdMarca"
                                                                        :label="item.cMarcaNombre"
                                                                        :value="item.nIdMarca">
                                                                    </el-option>
                                                                </el-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label class="col-md-4 form-control-label">Modelo</label>
                                                            <div class="col-md-8">
                                                                <el-select  v-model="formFiltro.nidmodelo"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="SELECCIONE UN MODELO">
                                                                    <el-option
                                                                        v-for="item in arrayModelo"
                                                                        :key="item.nIdModelo"
                                                                        :label="item.cModeloNombre"
                                                                        :value="item.nIdModelo">
                                                                    </el-option>
                                                                </el-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-7 offset-sm-5">
                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="listarStockVehiculos()">
                                                            <i class="fa fa-search"></i> Buscar
                                                        </button>
                                                    </div>
                                                    <!-- <div class="col-sm-8 offset-sm-4">
                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="exportarStock()">
                                                            <i class="fa fa-save"></i> Generar Reporte
                                                        </button>
                                                    </div> -->
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="h4">PREVISUALIZACIÓN</h3>
                                                </div>
                                                <div class="card-body">
                                                    <template v-if="arrayStockVehiculos.length">
                                                        <div class="table-responsive">
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Exportar Stock Vehiculo(s) XLS</div>
                                                                <el-button @click="exportarStock()">
                                                                    <i :style="'color:rgb(44, 255, 101)'" class="fa-md fa fa-file-excel-o" ></i>
                                                                </el-button>
                                                            </el-tooltip>
                                                            <el-table
                                                                :data="arrayStockVehiculos"
                                                                stripe
                                                                style="width: 100%">
                                                                <el-table-column property="CODIGO_ITEM" label="COD ITEM" width="120"></el-table-column>
                                                                <el-table-column fixed property="DESC_ITEM" label="ITEM" width="220"></el-table-column>
                                                                <el-table-column property="ANIO_MODELO" label="AÑO MODELO" width="110"></el-table-column>
                                                                <el-table-column property="LINEA" label="LINEA" width="170"></el-table-column>
                                                                <el-table-column property="MARCA" label="MARCA" width="100"></el-table-column>
                                                                <el-table-column property="MODELO" label="MODELO" width="130"></el-table-column>
                                                                <el-table-column property="COD_LISTA" label="NRO LISTA" width="100"></el-table-column>
                                                                <el-table-column property="MONEDA_LISTA" label="MONEDA" width="100"></el-table-column>
                                                                <el-table-column label="PRECIO BASE" width="115">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.PRECIO_BASE)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="PRECIO CIERRE" width="115">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.PRECIO_CIERRE1)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="STOCK" width="115">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.STOCK)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="BONO ESPECIAL" width="125">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.BONO_ESPECIAL)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="COSTO DEALER" width="115">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.MDEALER_MFINAL)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column property="ESTADO" label="ESTADO" width="100"></el-table-column>
                                                            </el-table>
                                                            <!--
                                                            <table class="table table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>COD ITEM&nbsp;
                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content">Exportar Stock Vehiculo(s) XLS</div>
                                                                                    <i :style="'color:#796AEE'" class="fa-md fa fa-file-excel-o" @click="exportarStock()"></i>
                                                                            </el-tooltip></th>
                                                                        <th>ITEM</th>
                                                                        <th>AÑO MODELO</th>
                                                                        <th>LINEA</th>
                                                                        <th>MARCA</th>
                                                                        <th>MODELO</th>
                                                                        <th>NRO LISTA</th>
                                                                        <th>MONEDA</th>
                                                                        <th>PRECIO BASE</th>
                                                                        <th>PRECIO CIERRE</th>
                                                                        <th>STOCK</th>
                                                                        <th>BONO ESPECIAL</th>
                                                                        <th>COSTO DEALER</th>
                                                                        <th>ESTADO</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(stockvehiculo, index) in arrayStockVehiculos" :key="index">
                                                                        <td v-text="stockvehiculo.CODIGO_ITEM"></td>
                                                                        <td v-text="stockvehiculo.DESC_ITEM"></td>
                                                                        <td v-text="stockvehiculo.ANIO_MODELO"></td>
                                                                        <td v-text="stockvehiculo.LINEA"></td>
                                                                        <td v-text="stockvehiculo.MARCA"></td>
                                                                        <td v-text="stockvehiculo.MODELO"></td>
                                                                        <td v-text="stockvehiculo.COD_LISTA"></td>
                                                                        <td v-text="stockvehiculo.MONEDA_LISTA"></td>
                                                                        <td v-text="stockvehiculo.PRECIO_BASE"></td>
                                                                        <td v-text="stockvehiculo.PRECIO_CIERRE1"></td>
                                                                        <td v-text="stockvehiculo.STOCK"></td>
                                                                        <td v-text="stockvehiculo.BONO_ESPECIAL"></td>
                                                                        <td v-text="stockvehiculo.MDEALER_MFINAL"></td>
                                                                        <td v-text="stockvehiculo.ESTADO"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            -->
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-7">
                                                                    <nav>
                                                                        <ul class="pagination">
                                                                            <li v-if="pagination.current_page > 1" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaStockVehiculos(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                            </li>
                                                                            <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                            :class="[page==isActived?'active':'']">
                                                                                <a class="page-link"
                                                                                href="#" @click.prevent="cambiarPaginaStockVehiculos(page)"
                                                                                v-text="page"></a>
                                                                            </li>
                                                                            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaStockVehiculos(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Show STOCK VEHICULOS GENERAL -->
            <div class="modal fade" v-if="accionmodal==6" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">FILTROS DE {{ tituloModal }} </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <form class="form-horizontal">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="row" style="display: flex; align-items: center; justify-content: center;">
                                                            <div class="text-center">
                                                                <div v-for="e in mensajeError" :key="e" v-text="e"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">* Sucursal</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidsucursal"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="SUCURSAL"
                                                                            @change="obtenerListaPrecioActiva">
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
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidproveedor"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="PROVEEDOR"
                                                                            @change="llenarComboLinea()">
                                                                    <el-option
                                                                        v-for="item in arrayProveedor"
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
                                                    <!-- <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Disponible</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.cflagdisponible"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="SELECCIONE">
                                                                    <el-option
                                                                        v-for="item in arrayFlagDisponible"
                                                                        :key="item.id"
                                                                        :label="item.nombre"
                                                                        :value="item.id">
                                                                    </el-option>
                                                                </el-select>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Linea Vehiculo</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidlinea"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="SELECCIONE LINEA"
                                                                            @change="llenarComboMarca()">
                                                                    <el-option
                                                                        v-for="item in arrayLinea"
                                                                        :key="item.nIdLinea"
                                                                        :label="item.cLineaNombre"
                                                                        :value="item.nIdLinea">
                                                                    </el-option>
                                                                </el-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label class="col-md-4 form-control-label">Marca</label>
                                                            <div class="col-md-8">
                                                                <el-select  v-model="formFiltro.nidmarca"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="SELECCIONE UNA MARCA"
                                                                            @change="llenarComboModelo()">
                                                                    <el-option
                                                                        v-for="item in arrayMarca"
                                                                        :key="item.nIdMarca"
                                                                        :label="item.cMarcaNombre"
                                                                        :value="item.nIdMarca">
                                                                    </el-option>
                                                                </el-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label class="col-md-4 form-control-label">Modelo</label>
                                                            <div class="col-md-8">
                                                                <el-select  v-model="formFiltro.nidmodelo"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="SELECCIONE UN MODELO">
                                                                    <el-option
                                                                        v-for="item in arrayModelo"
                                                                        :key="item.nIdModelo"
                                                                        :label="item.cModeloNombre"
                                                                        :value="item.nIdModelo">
                                                                    </el-option>
                                                                </el-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-7 offset-sm-5">
                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="listarStockVehiculosGeneral()">
                                                            <i class="fa fa-search"></i> Buscar
                                                        </button>
                                                    </div>
                                                    <!-- <div class="col-sm-8 offset-sm-4">
                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="exportarStockGeneral()">
                                                            <i class="fa fa-save"></i> Generar Reporte
                                                        </button>
                                                    </div> -->
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="h4">PREVISUALIZACIÓN</h3>
                                                </div>
                                                <div class="card-body">
                                                    <template v-if="arrayStockVehiculosGeneral.length">
                                                        <div class="table-responsive">
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Exportar Stock Vehiculo(s) General XLS</div>
                                                                <el-button @click="exportarStockGeneral()">
                                                                    <i :style="'color:rgb(44, 255, 101)'" class="fa-md fa fa-file-excel-o" ></i>
                                                                </el-button>
                                                            </el-tooltip>
                                                            <el-table
                                                                :data="arrayStockVehiculosGeneral"
                                                                stripe
                                                                style="width: 100%">
                                                                <el-table-column property="O_C" label="OC" width="120"></el-table-column>
                                                                <el-table-column fixed property="DESC_ITEM" label="ITEM" width="220"></el-table-column>
                                                                <el-table-column property="ANIO_MODELO" label="AÑO MODELO" width="110"></el-table-column>
                                                                <el-table-column property="LINEA" label="LINEA" width="170"></el-table-column>
                                                                <el-table-column property="MARCA" label="MARCA" width="100"></el-table-column>
                                                                <el-table-column property="MODELO" label="MODELO" width="130"></el-table-column>
                                                                <el-table-column property="VIN" label="VIN" width="100"></el-table-column>
                                                                <el-table-column property="COLOR" label="COLOR" width="100"></el-table-column>
                                                                <el-table-column property="TIENDA" label="TIENDA" width="180"></el-table-column>
                                                                <el-table-column label="FECHA FACTURADO" width="145">
                                                                    <template slot-scope="scope"> {{ scope.row.FF_DIA }}/{{ scope.row.FF_MES }}/{{ scope.row.FF_ANIO }}</template>
                                                                </el-table-column>
                                                                <el-table-column property="DIAS_ALMACEN" label="DIAS EN ALMACEN" width="100"></el-table-column>
                                                                <el-table-column property="ESTADO" label="ESTADO" width="100"></el-table-column>
                                                            </el-table>
                                                            <!--
                                                            <table class="table table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>OC&nbsp;
                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content">Exportar Stock Vehiculo(s) General XLS</div>
                                                                                    <i :style="'color:#796AEE'" class="fa-md fa fa-file-excel-o" @click="exportarStockGeneral()"></i>
                                                                            </el-tooltip></th>
                                                                        <th>ITEM</th>
                                                                        <th>AÑO MODELO</th>
                                                                        <th>LINEA</th>
                                                                        <th>MARCA</th>
                                                                        <th>MODELO</th>
                                                                        <th>VIN</th>
                                                                        <th>COLOR</th>
                                                                        <th>TIENDA</th>
                                                                        <th>FECHA FACTURADO</th>
                                                                        <th>DIAS EN ALMACEN</th>
                                                                        <th>ESTADO</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(stockvehiculo, index) in arrayStockVehiculosGeneral" :key="index">
                                                                        <td v-text="stockvehiculo.O_C"></td>
                                                                        <td v-text="stockvehiculo.DESC_ITEM"></td>
                                                                        <td v-text="stockvehiculo.ANIO_MODELO"></td>
                                                                        <td v-text="stockvehiculo.LINEA"></td>
                                                                        <td v-text="stockvehiculo.MARCA"></td>
                                                                        <td v-text="stockvehiculo.MODELO"></td>
                                                                        <td v-text="stockvehiculo.VIN"></td>
                                                                        <td v-text="stockvehiculo.COLOR"></td>
                                                                        <td v-text="stockvehiculo.TIENDA"></td>
                                                                        <td> {{ stockvehiculo.FF_DIA }}/{{ stockvehiculo.FF_MES }}/{{ stockvehiculo.FF_ANIO }} </td>
                                                                        <td v-text="stockvehiculo.DIAS_ALMACEN"></td>
                                                                        <td v-text="stockvehiculo.ESTADO"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            -->
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-7">
                                                                    <nav>
                                                                        <ul class="pagination">
                                                                            <li v-if="pagination.current_page > 1" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaStockVehiculosGeneral(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                            </li>
                                                                            <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                            :class="[page==isActived?'active':'']">
                                                                                <a class="page-link"
                                                                                href="#" @click.prevent="cambiarPaginaStockVehiculosGeneral(page)"
                                                                                v-text="page"></a>
                                                                            </li>
                                                                            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaStockVehiculosGeneral(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Show Metas de Venta de Vehiculos -->
            <div class="modal fade" v-if="accionmodal==7" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">FILTROS DE {{ tituloModal }} </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <form class="form-horizontal">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="row" style="display: flex; align-items: center; justify-content: center;">
                                                            <div class="text-center">
                                                                <div v-for="e in mensajeError" :key="e" v-text="e"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">* Sucursal</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidsucursal"
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
                                                                <el-select  v-model="formFiltro.nidvendedor"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="SELECCIONE UN ASESOR COMERCIAL"
                                                                            @change="listarSubLineaByVendedor()">
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
                                                            <label class="col-sm-4 form-control-label">SubLineas</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidsublinea"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="SUBLINEA">
                                                                    <el-option
                                                                        v-for="item in arraySubLineas"
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
                                                            <label class="col-sm-4 form-control-label">* Cronograma</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidcronograma"
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
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-9 offset-sm-5">
                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="listarMetasVenta(1)">
                                                            <i class="fa fa-search"></i> Buscar
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="h4">PREVISUALIZACIÓN</h3>
                                                </div>
                                                <div class="card-body">
                                                    <template v-if="arrayMetasVenta.length">
                                                        <div class="table-responsive">
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Exportar Metas de Venta(s) XLS</div>
                                                                <el-button @click="exportarMetasVenta()">
                                                                    <i :style="'color:rgb(44, 255, 101)'" class="fa-md fa fa-file-excel-o" ></i>
                                                                </el-button>
                                                            </el-tooltip>
                                                            <el-table
                                                                :data="arrayMetasVenta"
                                                                stripe
                                                                style="width: 100%">
                                                                <el-table-column property="ANIO" label="AÑO" width="100"></el-table-column>
                                                                <el-table-column property="MES" label="MES" width="80"></el-table-column>
                                                                <el-table-column fixed property="ASESOR" label="ASESOR" width="180"></el-table-column>
                                                                <el-table-column property="SUBLINEA" label="SUBLINEA" width="170"></el-table-column>
                                                                <el-table-column property="OBJETIVO" label="OBJETIVO" width="100"></el-table-column>
                                                                <el-table-column property="COTIZACIONES" label="COTIZACIONES" width="130"></el-table-column>
                                                                <el-table-column property="PEDIDOS" label="PEDIDOS" width="100"></el-table-column>
                                                                <el-table-column property="FACTURADOS" label="FACTURADOS" width="110"></el-table-column>
                                                                <el-table-column property="PENDIENTE" label="PENDIENTES" width="100"></el-table-column>
                                                            </el-table>
                                                            <!--
                                                            <table class="table table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ID&nbsp;
                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content">Exportar Metas de Venta(s) XLS</div>
                                                                                    <i :style="'color:#796AEE'" class="fa-md fa fa-file-excel-o" @click="exportarMetasVenta()"></i>
                                                                            </el-tooltip></th>
                                                                        <th>AÑO</th>
                                                                        <th>MES</th>
                                                                        <th>ASESOR</th>
                                                                        <th>SUBLINEA</th>
                                                                        <th>OBJETIVO</th>
                                                                        <th>COTIZACIONES</th>
                                                                        <th>PEDIDOS</th>
                                                                        <th>FACTURADOS</th>
                                                                        <th>PENDIENTES</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(metasventa, index) in arrayMetasVenta" :key="index">
                                                                        <td v-text="metasventa.ID"></td>
                                                                        <td v-text="metasventa.ANIO"></td>
                                                                        <td v-text="metasventa.MES"></td>
                                                                        <td v-text="metasventa.ASESOR"></td>
                                                                        <td v-text="metasventa.SUBLINEA"></td>
                                                                        <td v-text="metasventa.OBJETIVO"></td>
                                                                        <td v-text="metasventa.COTIZACIONES"></td>
                                                                        <td v-text="metasventa.PEDIDOS"></td>
                                                                        <td v-text="metasventa.FACTURADOS"></td>
                                                                        <td v-text="metasventa.PENDIENTE"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            -->
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-7">
                                                                    <nav>
                                                                        <ul class="pagination">
                                                                            <li v-if="pagination.current_page > 1" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaMetasVenta(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                            </li>
                                                                            <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                            :class="[page==isActived?'active':'']">
                                                                                <a class="page-link"
                                                                                href="#" @click.prevent="cambiarPaginaMetasVenta(page)"
                                                                                v-text="page"></a>
                                                                            </li>
                                                                            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaMetasVenta(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Show Contactos Libres -->
            <div class="modal fade" v-if="accionmodal==8" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">FILTROS DE {{ tituloModal }} </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <form class="form-horizontal">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="row" style="display: flex; align-items: center; justify-content: center;">
                                                            <div class="text-center">
                                                                <div v-for="e in mensajeError" :key="e" v-text="e"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">* Sucursal</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidsucursal"
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
                                                                <el-select  v-model="formFiltro.nidvendedor"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="SELECCIONE UN ASESOR COMERCIAL"
                                                                            @change="listarSubLineaByVendedor()">
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
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label class="col-md-4 form-control-label">Seleccione una Fecha</label>
                                                            <div class="col-md-8">
                                                                <el-date-picker
                                                                    v-model="formFiltro.dfechaventadiaria"
                                                                    type="date"
                                                                    value-format="yyyy-MM-dd"
                                                                    format="dd/MM/yyyy"
                                                                    placeholder="dd/mm/aaaa"
                                                                    :picker-options="pickerOptions">
                                                                </el-date-picker>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-9 offset-sm-5">
                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="listarContactosLibres(1)">
                                                            <i class="fa fa-search"></i> Buscar
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="h4">PREVISUALIZACIÓN</h3>
                                                </div>
                                                <div class="card-body">
                                                    <template v-if="arrayContactosLibres.length">
                                                        <div class="table-responsive">
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Exportar Contactos Libres XLS</div>
                                                                <el-button @click="exportarContactoLibre()">
                                                                    <i :style="'color:rgb(44, 255, 101)'" class="fa-md fa fa-file-excel-o" ></i>
                                                                </el-button>
                                                            </el-tooltip>
                                                            <el-table
                                                                :data="arrayContactosLibres"
                                                                stripe
                                                                style="width: 100%">
                                                                <el-table-column fixed property="CONTACTO" label="CONTACTO" width="170"></el-table-column>
                                                                <el-table-column property="N_DOCUMENTO" label="#DOCUMENTO" width="110"></el-table-column>
                                                                <el-table-column property="DIRECCION" label="DIRECCIÓN" width="180"></el-table-column>
                                                                <el-table-column property="TELEFONO_MOVIL" label="TEL. MOVIL" width="120"></el-table-column>
                                                                <el-table-column property="TELEFONO_FIJO" label="TEL. FIJO" width="120"></el-table-column>
                                                                <el-table-column property="PROVEEDOR" label="PROVEEDOR" width="140"></el-table-column>
                                                                <el-table-column property="LINEA" label="LINEA" width="150"></el-table-column>
                                                                <el-table-column property="MARCA" label="MARCA" width="130"></el-table-column>
                                                                <el-table-column property="MODELO" label="MODELO" width="130"></el-table-column>
                                                                <el-table-column property="ANIO_MODELO" label="AÑO MODELO" width="130"></el-table-column>
                                                                <el-table-column property="FECHA_INICIO_ASIGNACION" label="FECHA INICIO ASIGNACIÓN" width="130"></el-table-column>
                                                                <el-table-column property="FECHA_FIN_ASIGNACION" label="FECHA FIN ASIGNACIÓN" width="130"></el-table-column>
                                                                <el-table-column property="ESTADO" label="ESTADO" width="130"></el-table-column>
                                                            </el-table>
                                                            <!--
                                                            <table class="table table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ID&nbsp;
                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content">Exportar Metas de Venta(s) XLS</div>
                                                                                    <i :style="'color:#796AEE'" class="fa-md fa fa-file-excel-o" @click="exportarContactoLibre()"></i>
                                                                            </el-tooltip></th>
                                                                        <th>CONTACTO</th>
                                                                        <th>#DOCUMENTO</th>
                                                                        <th>DIRECCIÓN</th>
                                                                        <th>TELÉFONO MOVIL</th>
                                                                        <th>TELEÉFONO FIJO</th>
                                                                        <th>PROVEEDOR</th>
                                                                        <th>LINEA</th>
                                                                        <th>MARCA</th>
                                                                        <th>MODELO</th>
                                                                        <th>AÑO MODELO</th>
                                                                        <th>FECHA INICIO ASIGNACIÓN</th>
                                                                        <th>FECHA FIN ASIGNACIÓN</th>
                                                                        <th>ESTADO</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(contactolibre, index) in arrayContactosLibres" :key="index">
                                                                        <td v-text="contactolibre.COD_CONTACTO"></td>
                                                                        <td v-text="contactolibre.CONTACTO"></td>
                                                                        <td v-text="contactolibre.N_DOCUMENTO"></td>
                                                                        <td v-text="contactolibre.DIRECCION"></td>
                                                                        <td v-text="contactolibre.TELEFONO_MOVIL"></td>
                                                                        <td v-text="contactolibre.TELEFONO_FIJO"></td>
                                                                        <td v-text="contactolibre.PROVEEDOR"></td>
                                                                        <td v-text="contactolibre.LINEA"></td>
                                                                        <td v-text="contactolibre.MARCA"></td>
                                                                        <td v-text="contactolibre.MODELO"></td>
                                                                        <td v-text="contactolibre.ANIO_MODELO"></td>
                                                                        <td v-text="contactolibre.FECHA_INICIO_ASIGNACION"></td>
                                                                        <td v-text="contactolibre.FECHA_FIN_ASIGNACION"></td>
                                                                        <td v-text="contactolibre.ESTADO"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            -->
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-7">
                                                                    <nav>
                                                                        <ul class="pagination">
                                                                            <li v-if="pagination.current_page > 1" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaContactoLibre(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                            </li>
                                                                            <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                            :class="[page==isActived?'active':'']">
                                                                                <a class="page-link"
                                                                                href="#" @click.prevent="cambiarPaginaContactoLibre(page)"
                                                                                v-text="page"></a>
                                                                            </li>
                                                                            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaContactoLibre(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Show DISTRIBUCION -->
            <div class="modal fade" v-if="accionmodal==9" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">FILTROS DE {{ tituloModal }} </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <form class="form-horizontal">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="row" style="display: flex; align-items: center; justify-content: center;">
                                                            <div class="text-center">
                                                                <div v-for="e in mensajeError" :key="e" v-text="e"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Sucursal</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidsucursal"
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
                                                                <el-select  v-model="formFiltro.nidvendedor"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="SELECCIONE UN ASESOR COMERCIAL"
                                                                            @change="listarSubLineaByVendedor()">
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
                                                                <el-select  v-model="formFiltro.nidcronograma"
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
                                                            <label class="col-sm-4 form-control-label">Estado Coti</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidestadocotizacion"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="ESTADOS">
                                                                    <el-option
                                                                        v-for="item in arrayEstadoCotizacion"
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
                                                                <input type="text" v-model="formFiltro.fmontodescuento" @keyup.enter="listarDistribucion(1)" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-9 offset-sm-5">
                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="listarDistribucion(1)">
                                                            <i class="fa fa-search"></i> Buscar
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="h4">PREVISUALIZACIÓN</h3>
                                                </div>
                                                <div class="card-body">
                                                    <template v-if="arrayDistribucionDesc.length">
                                                        <div class="table-responsive">
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Exportar Distribucion Descuentos(s) XLS</div>
                                                                <el-button @click="exportarDistribucacion()">
                                                                    <i :style="'color:rgb(44, 255, 101)'" class="fa-md fa fa-file-excel-o" ></i>
                                                                </el-button>
                                                            </el-tooltip>
                                                            <el-table
                                                                :data="arrayDistribucionDesc"
                                                                stripe
                                                                style="width: 100%">
                                                                <el-table-column property="EMPRESA" label="EMPRESA" width="170"></el-table-column>
                                                                <el-table-column property="SUCURSAL" label="SUCURSAL" width="120"></el-table-column>
                                                                <el-table-column fixed property="NUM_PEDIDO" label="NUM PEDIDO" width="160"></el-table-column>
                                                                <el-table-column property="NUM_COTIZACION" label="NUM COTIZACIÓN" width="160"></el-table-column>
                                                                <el-table-column property="FECHA_COTIZACION" label="FECHA COTIZACIÓN" width="140"></el-table-column>
                                                                <el-table-column property="FECHA_VENC_COTIZACION" label="FECHA VENC COTI" width="140"></el-table-column>
                                                                <el-table-column property="FECHA_PEDIDO" label="FECHA PEDIDO" width="140"></el-table-column>
                                                                <el-table-column property="TCC" label="TCC" width="120"></el-table-column>
                                                                <el-table-column property="PRECIO_BASE_DOLAR" label="PRECIO BASE" width="140"></el-table-column>
                                                                <el-table-column property="PRECIO_CIERRE_DOLAR" label="PRECIO CIERRE" width="140"></el-table-column>
                                                                <el-table-column label="TYP" width="125">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.PRECIO_TYP_DOLAR)).toFixed(2)) }} </template>
                                                                </el-table-column>
                                                                <el-table-column property="PRECIO_VENTA_CLIENTE" label="PRECIO VENTA" width="140"></el-table-column>
                                                                <el-table-column property="DESCUENTO_VEHI_DOLAR" label="DESCUENTO" width="140"></el-table-column>
                                                                <el-table-column label="SOBRE PRECIO" width="145">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.SOBREPRECIO_VEHI_DOLAR)).toFixed(2)) }} </template>
                                                                </el-table-column>
                                                                <el-table-column property="COTI_VEHI_DOLAR" label="VEHICULO ($)" width="140"></el-table-column>
                                                                <el-table-column property="COTI_VEHI_SOL" label="VEHICULO (S/)" width="140"></el-table-column>
                                                                <el-table-column property="COTI_EV_DOLAR" label="E.V ($)" width="140"></el-table-column>
                                                                <el-table-column property="COTI_EV_SOL" label="E.V (S/)" width="140"></el-table-column>
                                                                <el-table-column property="COTI_TOTAL_DOLAR" label="COTIZACION ($)" width="140"></el-table-column>
                                                                <el-table-column property="COTI_TOTAL_SOL" label="COTIZACION (S/)" width="140"></el-table-column>
                                                                <el-table-column property="ASUNTO" label="ASUNTO" width="150"></el-table-column>
                                                                <el-table-column property="ESTADO" label="ESTADO COT" width="150"></el-table-column>
                                                                <el-table-column label="DESCUENTO" width="145">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.DESCUENTO)).toFixed(2)) }} </template>
                                                                </el-table-column>
                                                                <el-table-column property="PROVEEDOR" label="PROVEEDOR" width="160"></el-table-column>
                                                                <el-table-column label="MONTO ASUMIDO" width="145">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.PROVEEDOR_MONTO_ASUMIDO)).toFixed(2)) }} </template>
                                                                </el-table-column>
                                                                <el-table-column property="EMP" label="EMPRESA" width="160"></el-table-column>
                                                                <el-table-column label="MONTO ASUMIDO" width="145">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.EMPRESA_MONTO_ASUMIDO)).toFixed(2)) }} </template>
                                                                </el-table-column>
                                                                <el-table-column property="NOMBRE_COMERCIAL" label="NOMBRE COMERCIAL" width="190"></el-table-column>
                                                                <el-table-column property="VIN" label="VIN" width="145"></el-table-column>
                                                                <el-table-column property="ASESOR_COMERCIAL" label="ASESOR COMERCIAL" width="160"></el-table-column>
                                                                <el-table-column property="CONTACTO" label="CONTACTO" width="160"></el-table-column>
                                                                <el-table-column property="N_DOCUMENTO" label="#DOCUMENTO" width="140"></el-table-column>
                                                                <el-table-column property="DIRECCION" label="DIRECCIÓN" width="170"></el-table-column>
                                                                <el-table-column property="TELEFONO_MOVIL" label="TEL MOVIL" width="140"></el-table-column>
                                                                <el-table-column property="TELEFONO_FIJO" label="TEL FIJO" width="140"></el-table-column>
                                                            </el-table>
                                                            <!--
                                                            <table class="table table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>EMPRESA&nbsp;
                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content">Exportar Distribucion Descuentos(s) XLS</div>
                                                                                    <i :style="'color:#796AEE'" class="fa-md fa fa-file-excel-o" @click="exportarDistribucacion()"></i>
                                                                            </el-tooltip></th>
                                                                        <th>SUCURSAL</th>
                                                                        <th>NUM PEDIDO</th>
                                                                        <th>NUM COTIZACIÓN</th>
                                                                        <th>FECHA COTIZACIÓN</th>
                                                                        <th>FECHA VENC COTI</th>
                                                                        <th>FECHA PEDIDO</th>
                                                                        <th>TCC</th>
                                                                        <th>PRECIO BASE</th>
                                                                        <th>PRECIO CIERRE</th>
                                                                        <th>TYP</th>
                                                                        <th>PRECIO VENTA</th>
                                                                        <th>DESCUENTO</th>
                                                                        <th>SOBRE PRECIO</th>
                                                                        <th>VEHICULO ($)</th>
                                                                        <th>VEHICULO (S/)</th>
                                                                        <th>E.V ($)</th>
                                                                        <th>E.V (S/)</th>
                                                                        <th>COTIZACION ($)</th>
                                                                        <th>COTIZACION (S/)</th>
                                                                        <th>ASUNTO</th>
                                                                        <th>ESTADO COT</th>
                                                                        <th>DESCUENTO</th>
                                                                        <th>PROVEEDOR</th>
                                                                        <th>MONTO ASUMIDO</th>
                                                                        <th>EMPRESA</th>
                                                                        <th>MONTO ASUMIDO</th>
                                                                        <th>NOMBRE COMERCIAL</th>
                                                                        <th>VIN</th>
                                                                        <th>ASESOR COMERCIAL</th>
                                                                        <th>CONTACTO</th>
                                                                        <th>NUM DOCUMENTO</th>
                                                                        <th>DIRECCIÓN</th>
                                                                        <th>TELÉFONO MOVIL</th>
                                                                        <th>TELÉFONO FIJO</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(distribucion, index) in arrayDistribucionDesc" :key="index">
                                                                        <td v-text="distribucion.EMPRESA"></td>
                                                                        <td v-text="distribucion.SUCURSAL"></td>
                                                                        <td v-text="distribucion.NUM_PEDIDO"></td>
                                                                        <td v-text="distribucion.NUM_COTIZACION"></td>
                                                                        <td v-text="distribucion.FECHA_COTIZACION"></td>
                                                                        <td v-text="distribucion.FECHA_VENC_COTIZACION"></td>
                                                                        <td v-text="distribucion.FECHA_PEDIDO"></td>
                                                                        <td v-text="distribucion.TCC"></td>
                                                                        <td v-text="distribucion.PRECIO_BASE_DOLAR"></td>
                                                                        <td v-text="distribucion.PRECIO_CIERRE_DOLAR"></td>
                                                                        <td> {{ Number((parseFloat(distribucion.PRECIO_TYP_DOLAR)).toFixed(2)) }} </td>
                                                                        <td v-text="distribucion.PRECIO_VENTA_CLIENTE"></td>
                                                                        <td v-text="distribucion.DESCUENTO_VEHI_DOLAR"></td>
                                                                        <td> {{ Number((parseFloat(distribucion.SOBREPRECIO_VEHI_DOLAR)).toFixed(2)) }} </td>
                                                                        <td v-text="distribucion.COTI_VEHI_DOLAR"></td>
                                                                        <td v-text="distribucion.COTI_VEHI_SOL"></td>
                                                                        <td> {{ Number((parseFloat(distribucion.COTI_EV_DOLAR)).toFixed(2)) }}</td>
                                                                        <td> {{ Number((parseFloat(distribucion.COTI_EV_SOL)).toFixed(2)) }} </td>
                                                                        <td v-text="distribucion.COTI_TOTAL_DOLAR"></td>
                                                                        <td v-text="distribucion.COTI_TOTAL_SOL"></td>
                                                                        <td v-text="distribucion.ASUNTO"></td>
                                                                        <td v-text="distribucion.ESTADO"></td>
                                                                        <td> {{ Number((parseFloat(distribucion.DESCUENTO)).toFixed(2)) }} </td>
                                                                        <td v-text="distribucion.PROVEEDOR"></td>
                                                                        <td> {{ Number((parseFloat(distribucion.PROVEEDOR_MONTO_ASUMIDO)).toFixed(2)) }} </td>
                                                                        <td v-text="distribucion.EMP"></td>
                                                                        <td> {{ Number((parseFloat(distribucion.EMPRESA_MONTO_ASUMIDO)).toFixed(2)) }} </td>
                                                                        <td v-text="distribucion.NOMBRE_COMERCIAL"></td>
                                                                        <td v-text="distribucion.VIN"></td>
                                                                        <td v-text="distribucion.ASESOR_COMERCIAL"></td>
                                                                        <td v-text="distribucion.CONTACTO"></td>
                                                                        <td v-text="distribucion.N_DOCUMENTO"></td>
                                                                        <td v-text="distribucion.DIRECCION"></td>
                                                                        <td v-text="distribucion.TELEFONO_MOVIL"></td>
                                                                        <td v-text="distribucion.TELEFONO_FIJO"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            -->
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-7">
                                                                    <nav>
                                                                        <ul class="pagination">
                                                                            <li v-if="pagination.current_page > 1" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaDistribucacion(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                            </li>
                                                                            <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                            :class="[page==isActived?'active':'']">
                                                                                <a class="page-link"
                                                                                href="#" @click.prevent="cambiarPaginaDistribucacion(page)"
                                                                                v-text="page"></a>
                                                                            </li>
                                                                            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaDistribucacion(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Show estado de Depositos por Pedido -->
            <div class="modal fade" v-if="accionmodal==10" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">FILTROS DE {{ tituloModal }} </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <form class="form-horizontal">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="row" style="display: flex; align-items: center; justify-content: center;">
                                                            <div class="text-center">
                                                                <div v-for="e in mensajeError" :key="e" v-text="e"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Sucursal</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidsucursal"
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
                                                                <el-select  v-model="formFiltro.nidvendedor"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="SELECCIONE UN ASESOR COMERCIAL"
                                                                            @change="listarSubLineaByVendedor()">
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
                                                                <el-select  v-model="formFiltro.nidcronograma"
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
                                                                <el-select  v-model="formFiltro.nidestadopedido"
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
                                                    <div class="col-sm-9 offset-sm-5">
                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="listarPedidoDeposito(1)">
                                                            <i class="fa fa-search"></i> Buscar
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="h4">PREVISUALIZACIÓN</h3>
                                                </div>
                                                <div class="card-body">
                                                    <template v-if="arrayPedidoDeposito.length">
                                                        <div class="table-responsive">
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Exportar Pedidos con Deposito(s) XLS</div>
                                                                <el-button @click="exportarPedidoDeposito()">
                                                                    <i :style="'color:rgb(44, 255, 101)'" class="fa-md fa fa-file-excel-o" ></i>
                                                                </el-button>
                                                            </el-tooltip>
                                                            <el-table
                                                                :data="arrayPedidoDeposito"
                                                                stripe
                                                                style="width: 100%">
                                                                <el-table-column property="EMPRESA" label="EMPRESA" width="170"></el-table-column>
                                                                <el-table-column property="SUCURSAL" label="SUCURSAL" width="160"></el-table-column>
                                                                <el-table-column fixed property="NUM_PEDIDO" label="NUM PEDIDO" width="160"></el-table-column>
                                                                <el-table-column property="FECHA_PEDIDO" label="FECHA PEDIDO" width="140"></el-table-column>
                                                                <el-table-column property="NOMBRE_COMERCIAL" label="NOMBRE COMERCIAL" width="180"></el-table-column>
                                                                <el-table-column property="VIN" label="VIN" width="150"></el-table-column>
                                                                <el-table-column label="PEDIDO ($)" width="125">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.PEDIDO_DOLAR)).toFixed(2)) }} </template>
                                                                </el-table-column>
                                                                <el-table-column label="PEDIDO (S/)" width="125">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.PEDIDO_SOL)).toFixed(2)) }} </template>
                                                                </el-table-column>
                                                                <el-table-column label="MONTO DEPOSITADO" width="125">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.MONTO_DEPOSITADO)).toFixed(2)) }} </template>
                                                                </el-table-column>
                                                                <el-table-column label="% DEPOSITADO" width="125">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.PORCENTAJE_DEPOSITADO)).toFixed(2)) }} </template>
                                                                </el-table-column>
                                                                <el-table-column property="ESTADO_PEDIDO" label="ESTADO PEDIDO" width="140"></el-table-column>
                                                                <el-table-column property="TOTAL_DEPOSITOS" label="DEPOSITOS" width="140"></el-table-column>
                                                                <el-table-column property="DEPOSITOS_APROBADO" label="DEPOSITOS APROBADOS" width="140"></el-table-column>
                                                                <el-table-column property="DEPOSITOS_PENDIENTE" label="DEPOSITOS PENDIENTES" width="140"></el-table-column>
                                                                <el-table-column property="DEPOSITOS_DESAPROBADO" label="DEPOSITOS RECHAZADOS" width="140"></el-table-column>
                                                                <el-table-column property="TOTAL_ANTICIPOS" label="ANTICIPOS" width="140"></el-table-column>
                                                                <el-table-column property="TOTAL_ANTICIPOS_FACTURADOS" label="ANTICIPOS FACTURADOS" width="140"></el-table-column>
                                                                <el-table-column property="ESTADO_FACTURACION" label="ESTADO FACTURACIÓN (SAP)" width="140"></el-table-column>
                                                                <el-table-column property="ASESOR_COMERCIAL" label="ASESOR COMERCIAL" width="180"></el-table-column>
                                                                <el-table-column property="CONTACTO" label="CONTACTO" width="180"></el-table-column>
                                                                <el-table-column property="N_DOCUMENTO" label="#DOCUMENTO" width="140"></el-table-column>
                                                                <el-table-column property="DIRECCION" label="DIRECCIÓN" width="180"></el-table-column>
                                                                <el-table-column property="TELEFONO_MOVIL" label="TEL MOVIL" width="140"></el-table-column>
                                                                <el-table-column property="TELEFONO_FIJO" label="TEL FIJO" width="140"></el-table-column>
                                                            </el-table>
                                                            <!--
                                                            <table class="table table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>EMPRESA&nbsp;
                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content"></div>
                                                                                    <i :style="'color:#796AEE'" class="fa-md fa fa-file-excel-o" @click="exportarPedidoDeposito()"></i>
                                                                            </el-tooltip></th>
                                                                        <th>SUCURSAL</th>
                                                                        <th>COD PEDIDO</th>
                                                                        <th>NUM PEDIDO</th>
                                                                        <th>FECHA PEDIDO</th>
                                                                        <th>NOMBRE COMERCIAL</th>
                                                                        <th>VIN</th>
                                                                        <th>PEDIDO ($)</th>
                                                                        <th>PEDIDO (S/)</th>
                                                                        <th>MONTO DEPOSITADO</th>
                                                                        <th>% DEPOSITADO</th>
                                                                        <th>ESTADO PEDIDO</th>
                                                                        <th>N° DEPOSITOS</th>
                                                                        <th>DEPOSITOS APROBADOS</th>
                                                                        <th>DEPOSITOS PENDIENTES</th>
                                                                        <th>DEPOSITOS RECHAZADOS</th>
                                                                        <th>N° ANTICIPOS</th>
                                                                        <th>ANTICIPOS FACTURADOS</th>
                                                                        <th>ESTADO FACTURACIÓN (SAP)</th>
                                                                        <th>ASESOR COMERCIAL</th>
                                                                        <th>CONTACTO</th>
                                                                        <th>NUM DOCUMENTO</th>
                                                                        <th>DIRECCIÓN</th>
                                                                        <th>TELÉFONO MOVIL</th>
                                                                        <th>TELÉFONO FIJO</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(pedido, index) in arrayPedidoDeposito" :key="index">
                                                                        <td v-text="pedido.EMPRESA"></td>
                                                                        <td v-text="pedido.SUCURSAL"></td>
                                                                        <td v-text="pedido.COD_PEDIDO"></td>
                                                                        <td v-text="pedido.NUM_PEDIDO"></td>
                                                                        <td v-text="pedido.FECHA_PEDIDO"></td>
                                                                        <td v-text="pedido.NOMBRE_COMERCIAL"></td>
                                                                        <td v-text="pedido.VIN"></td>
                                                                        <td> {{ Number((parseFloat(pedido.PEDIDO_DOLAR)).toFixed(2)) }} </td>
                                                                        <td> {{ Number((parseFloat(pedido.PEDIDO_SOL)).toFixed(2)) }} </td>
                                                                        <td> {{ Number((parseFloat(pedido.MONTO_DEPOSITADO)).toFixed(2)) }} </td>
                                                                        <td> {{ Number((parseFloat(pedido.PORCENTAJE_DEPOSITADO)).toFixed(2)) }} </td>
                                                                        <td v-text="pedido.ESTADO_PEDIDO"></td>
                                                                        <td v-text="pedido.TOTAL_DEPOSITOS"></td>
                                                                        <td v-text="pedido.DEPOSITOS_APROBADO"></td>
                                                                        <td v-text="pedido.DEPOSITOS_PENDIENTE"></td>
                                                                        <td v-text="pedido.DEPOSITOS_DESAPROBADO"></td>
                                                                        <td v-text="pedido.TOTAL_ANTICIPOS"></td>
                                                                        <td v-text="pedido.TOTAL_ANTICIPOS_FACTURADOS"></td>
                                                                        <td v-text="pedido.ESTADO_FACTURACION"></td>
                                                                        <td v-text="pedido.ASESOR_COMERCIAL"></td>
                                                                        <td v-text="pedido.CONTACTO"></td>
                                                                        <td v-text="pedido.N_DOCUMENTO"></td>
                                                                        <td v-text="pedido.DIRECCION"></td>
                                                                        <td v-text="pedido.TELEFONO_MOVIL"></td>
                                                                        <td v-text="pedido.TELEFONO_FIJO"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            -->
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-7">
                                                                    <nav>
                                                                        <ul class="pagination">
                                                                            <li v-if="pagination.current_page > 1" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaPedidoDeposito(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                            </li>
                                                                            <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                            :class="[page==isActived?'active':'']">
                                                                                <a class="page-link"
                                                                                href="#" @click.prevent="cambiarPaginaPedidoDeposito(page)"
                                                                                v-text="page"></a>
                                                                            </li>
                                                                            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaPedidoDeposito(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Show Cotizaciones by filtro -->
            <div class="modal fade" v-if="accionmodal==11" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">FILTROS DE {{ tituloModal }} </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <form class="form-horizontal">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="row" style="display: flex; align-items: center; justify-content: center;">
                                                            <div class="text-center">
                                                                <div v-for="e in mensajeError" :key="e" v-text="e"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Sucursal</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidsucursal"
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
                                                                <el-select  v-model="formFiltro.nidvendedor"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="SELECCIONE UN ASESOR COMERCIAL"
                                                                            @change="listarSubLineaByVendedor()">
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
                                                                <el-select  v-model="formFiltro.nidcronograma"
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
                                                            <label class="col-sm-4 form-control-label">Estado</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidestadocotizacion"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="ESTADOS">
                                                                    <el-option
                                                                        v-for="item in arrayEstadoCotizacion"
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
                                                            <label class="col-sm-4 form-control-label">* Fecha Inicio</label>
                                                            <div class="col-sm-8">
                                                                <el-date-picker
                                                                    v-model="formFiltro.dfechainicio"
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
                                                            <label class="col-sm-4 form-control-label">* Fecha Fin</label>
                                                            <div class="col-sm-8">
                                                                <el-date-picker
                                                                    v-model="formFiltro.dfechafin"
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
                                                    <div class="col-sm-9 offset-sm-5">
                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="listarCotizaciones(1)">
                                                            <i class="fa fa-search"></i> Buscar
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="h4">PREVISUALIZACIÓN</h3>
                                                </div>
                                                <div class="card-body">
                                                    <template v-if="arrayCotizaciones.length">
                                                        <div class="table-responsive">
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Exportar Cotizaciones XLS</div>
                                                                <el-button @click="expotarCotizaciones()">
                                                                    <i :style="'color:rgb(44, 255, 101)'" class="fa-md fa fa-file-excel-o" ></i>
                                                                </el-button>
                                                            </el-tooltip>
                                                            <el-table
                                                                :data="arrayCotizaciones"
                                                                stripe
                                                                style="width: 100%">
                                                                <el-table-column property="EMPRESA" label="EMPRESA" width="170"></el-table-column>
                                                                <el-table-column property="SUCURSAL" label="SUCURSAL" width="120"></el-table-column>
                                                                <el-table-column property="NUM_COTIZACION" label="NUM COTIZACIÓN" width="160"></el-table-column>
                                                                <el-table-column property="FECHA_COTIZACION" label="FECHA COTIZACIÓN" width="140"></el-table-column>
                                                                <el-table-column property="FECHA_VENC_COTIZACION" label="FECHA VENC COTI" width="140"></el-table-column>
                                                                <el-table-column property="TCC" label="TCC" width="120"></el-table-column>
                                                                <el-table-column property="COTI_VEHI_DOLAR" label="VEHICULO ($)" width="140"></el-table-column>
                                                                <el-table-column property="COTI_VEHI_SOL" label="VEHICULO (S/)" width="140"></el-table-column>
                                                                <el-table-column property="ASUNTO" label="ASUNTO" width="150"></el-table-column>
                                                                <el-table-column property="ESTADO" label="ESTADO COT" width="150"></el-table-column>
                                                                <el-table-column label="DESCUENTO" width="145">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.DESCUENTO)).toFixed(2)) }} </template>
                                                                </el-table-column>
                                                                <el-table-column property="NOMBRE_COMERCIAL" label="NOMBRE COMERCIAL" width="190"></el-table-column>
                                                                <el-table-column property="VIN" label="VIN" width="145"></el-table-column>
                                                                <el-table-column property="ASESOR_COMERCIAL" label="ASESOR COMERCIAL" width="160"></el-table-column>
                                                                <el-table-column property="CONTACTO" label="CONTACTO" width="160"></el-table-column>
                                                                <el-table-column property="N_DOCUMENTO" label="#DOCUMENTO" width="140"></el-table-column>
                                                                <el-table-column property="DIRECCION" label="DIRECCIÓN" width="170"></el-table-column>
                                                                <el-table-column property="TELEFONO_MOVIL" label="TEL MOVIL" width="140"></el-table-column>
                                                                <el-table-column property="TELEFONO_FIJO" label="TEL FIJO" width="140"></el-table-column>
                                                            </el-table>
                                                            <!--
                                                            <table class="table table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>EMPRESA&nbsp;
                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content">Exportar Distribucion Descuentos(s) XLS</div>
                                                                                    <i :style="'color:#796AEE'" class="fa-md fa fa-file-excel-o" @click="expotarCotizaciones()"></i>
                                                                            </el-tooltip></th>
                                                                        <th>SUCURSAL</th>
                                                                        <th>COD COTIZACIÓN</th>
                                                                        <th>NUM COTIZACIÓN</th>
                                                                        <th>FECHA COTIZACIÓN</th>
                                                                        <th>FECHA VENC COTI</th>
                                                                        <th>TCC</th>
                                                                        <th>VEHICULO ($)</th>
                                                                        <th>VEHICULO (S/)</th>
                                                                        <th>ASUNTO</th>
                                                                        <th>ESTADO COT</th>
                                                                        <th>DESCUENTO</th>
                                                                        <th>NOMBRE COMERCIAL</th>
                                                                        <th>VIN</th>
                                                                        <th>ASESOR COMERCIAL</th>
                                                                        <th>CONTACTO</th>
                                                                        <th>NUM DOCUMENTO</th>
                                                                        <th>DIRECCIÓN</th>
                                                                        <th>TELÉFONO MOVIL</th>
                                                                        <th>TELÉFONO FIJO</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(cotizacion, index) in arrayCotizaciones" :key="index">
                                                                        <td v-text="cotizacion.EMPRESA"></td>
                                                                        <td v-text="cotizacion.SUCURSAL"></td>
                                                                        <td v-text="cotizacion.COD_COTIZACION"></td>
                                                                        <td v-text="cotizacion.NUM_COTIZACION"></td>
                                                                        <td v-text="cotizacion.FECHA_COTIZACION"></td>
                                                                        <td v-text="cotizacion.FECHA_VENC_COTIZACION"></td>
                                                                        <td v-text="cotizacion.TCC"></td>
                                                                        <td v-text="cotizacion.COTI_VEHI_DOLAR"></td>
                                                                        <td v-text="cotizacion.COTI_VEHI_SOL"></td>
                                                                        <td v-text="cotizacion.ASUNTO"></td>
                                                                        <td v-text="cotizacion.ESTADO"></td>
                                                                        <td> {{ Number((parseFloat(cotizacion.DESCUENTO)).toFixed(2)) }} </td>
                                                                        <td v-text="cotizacion.NOMBRE_COMERCIAL"></td>
                                                                        <td v-text="cotizacion.VIN"></td>
                                                                        <td v-text="cotizacion.ASESOR_COMERCIAL"></td>
                                                                        <td v-text="cotizacion.CONTACTO"></td>
                                                                        <td v-text="cotizacion.N_DOCUMENTO"></td>
                                                                        <td v-text="cotizacion.DIRECCION"></td>
                                                                        <td v-text="cotizacion.TELEFONO_MOVIL"></td>
                                                                        <td v-text="cotizacion.TELEFONO_FIJO"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            -->
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-7">
                                                                    <nav>
                                                                        <ul class="pagination">
                                                                            <li v-if="pagination.current_page > 1" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaCotizaciones(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                            </li>
                                                                            <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                            :class="[page==isActived?'active':'']">
                                                                                <a class="page-link"
                                                                                href="#" @click.prevent="cambiarPaginaCotizaciones(page)"
                                                                                v-text="page"></a>
                                                                            </li>
                                                                            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaCotizaciones(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Show Comisiones de Vendedores - Ventas-->
            <div class="modal fade" v-if="accionmodal==12" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">FILTROS DE {{ tituloModal }} </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <form class="form-horizontal">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="row" style="display: flex; align-items: center; justify-content: center;">
                                                            <div class="text-center">
                                                                <div v-for="e in mensajeError" :key="e" v-text="e"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Sucursal</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidsucursal"
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
                                                                <el-select  v-model="formFiltro.nidvendedor"
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
                                                <!-- <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label class="col-md-4 form-control-label">* Fecha Inicio</label>
                                                            <div class="col-md-8">
                                                                <el-date-picker
                                                                    v-model="formFiltro.dfechainicio"
                                                                    type="date"
                                                                    value-format="yyyy-MM-dd"
                                                                    format="dd/MM/yyyy"
                                                                    placeholder="dd/mm/aaaa"
                                                                    :picker-options="pickerOptions">
                                                                </el-date-picker>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label class="col-md-4 form-control-label">* Fecha Fin</label>
                                                            <div class="col-md-8">
                                                                <el-date-picker
                                                                    v-model="formFiltro.dfechafin"
                                                                    type="date"
                                                                    value-format="yyyy-MM-dd"
                                                                    format="dd/MM/yyyy"
                                                                    placeholder="dd/mm/aaaa"
                                                                    :picker-options="pickerOptions">
                                                                </el-date-picker>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Cronograma</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidcronograma"
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
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-9 offset-sm-5">
                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="listarDscComisiones()">
                                                            <i class="fa fa-save"></i> Buscar
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="h4">PREVISUALIZACIÓN</h3>
                                                </div>
                                                <div class="card-body">
                                                    <template v-if="arrayDscComisiones.length">
                                                        <div class="table-responsive">
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Exportar Comisiones de Ventas XLS</div>
                                                                <el-button @click="exportarComisiones()">
                                                                    <i :style="'color:rgb(44, 255, 101)'" class="fa-md fa fa-file-excel-o" ></i>
                                                                </el-button>
                                                            </el-tooltip>
                                                            <el-table
                                                                :data="arrayDscComisiones"
                                                                stripe
                                                                style="width: 100%">
                                                                <el-table-column property="FECHA" label="FECHA PEDIDO" width="130"></el-table-column>
                                                                <el-table-column fixed property="PEDIDO" label="N° PEDIDO" width="130"></el-table-column>
                                                                <el-table-column property="VENDEDOR" label="VENDEDOR" width="210"></el-table-column>
                                                                <el-table-column property="VIN" label="VIN" width="150"></el-table-column>
                                                                <el-table-column property="CLIENTE" label="CLIENTE" width="200"></el-table-column>
                                                                <el-table-column property="MARCA" label="MARCA" width="100"></el-table-column>
                                                                <el-table-column property="MODELO" label="MODELO" width="100"></el-table-column>
                                                                <el-table-column label="COSTO_DEALER_COMPRA" width="115">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.COSTO_DEALER_COMPRA)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="COSTO_DEALER_ACTUAL" width="115">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.COSTO_DEALER_ACTUAL)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="PRECIO_CIERRE_FINAL_AV" width="115">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.PRECIO_CIERRE_FINAL_AV)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="PRECIO_CIERRE_LISTA_DE_PRECIO" width="115">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.PRECIO_CIERRE_LISTA_DE_PRECIO)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="FLETE" width="110">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.FLETE)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="TYP" width="110">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.TYP)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="PRECIO_FINAL" width="110">
                                                                    <template slot-scope="scope"> {{ (scope.row.PRECIO_FINAL == null) ? 0 : (Number((parseFloat(scope.row.PRECIO_FINAL)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="SOBRE_PRECIO" width="130">
                                                                    <template slot-scope="scope"> {{ (scope.row.SOBRE_PRECIO == null) ? 0 : (Number((parseFloat(scope.row.SOBRE_PRECIO)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="UTILIDAD_BRUTA" width="130">
                                                                    <template slot-scope="scope"> {{ (scope.row.UTILIDAD_BRUTA == null) ? 0 : (Number((parseFloat(scope.row.UTILIDAD_BRUTA)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="DESC_PROVEEDOR" width="130">
                                                                    <template slot-scope="scope"> {{ (scope.row.DESC_PROVEEDOR == null) ? 0 : (Number((parseFloat(scope.row.DESC_PROVEEDOR)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="DESC_CONCESIONARIO" width="140">
                                                                    <template slot-scope="scope"> {{ (scope.row.DESC_CONCESIONARIO == null) ? 0 : (Number((parseFloat(scope.row.DESC_CONCESIONARIO)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="FLETE" width="110">
                                                                    <template slot-scope="scope"> {{ (scope.row.FLETE == null) ? 0 : (Number((parseFloat(scope.row.FLETE)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="TYP_INF" width="110">
                                                                    <template slot-scope="scope"> {{ (scope.row.TYP_INF == null) ? 0 : (Number((parseFloat(scope.row.TYP_INF)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="SEGURO_INF" width="110">
                                                                    <template slot-scope="scope"> {{ (scope.row.SEGURO_INF == null) ? 0 : (Number((parseFloat(scope.row.SEGURO_INF)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="TOTAL_COSTOS" width="140">
                                                                    <template slot-scope="scope"> {{ (scope.row.TOTAL_COSTOS == null) ? 0 : (Number((parseFloat(scope.row.TOTAL_COSTOS)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="UTILIDAD_NETA" width="140">
                                                                    <template slot-scope="scope"> {{ (scope.row.UTILIDAD_NETA == null) ? 0 : (Number((parseFloat(scope.row.UTILIDAD_NETA)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="COMISION_1_CON_IGV" width="110">
                                                                    <template slot-scope="scope"> {{ (scope.row.COMISION_1_CON_IGV == null) ? 0 : (Number((parseFloat(scope.row.COMISION_1_CON_IGV)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="COMISION_1_SIN_IGV" width="140">
                                                                    <template slot-scope="scope"> {{ (scope.row.COMISION_1_SIN_IGV == null) ? 0 : (Number((parseFloat(scope.row.COMISION_1_SIN_IGV)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="COMISION_2_CON_IGV" width="140">
                                                                    <template slot-scope="scope"> {{ (scope.row.COMISION_2_CON_IGV == null) ? 0 : (Number((parseFloat(scope.row.COMISION_2_CON_IGV)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="COMISION_2_SIN_IGV" width="140">
                                                                    <template slot-scope="scope"> {{ (scope.row.COMISION_2_SIN_IGV == null) ? 0 : (Number((parseFloat(scope.row.COMISION_2_SIN_IGV)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="SOBRE_PRECIO_SIN_IGV" width="140">
                                                                    <template slot-scope="scope"> {{ (scope.row.SOBRE_PRECIO_SIN_IGV == null) ? 0 : (Number((parseFloat(scope.row.SOBRE_PRECIO_SIN_IGV)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="COSTO_DEALER" width="140">
                                                                    <template slot-scope="scope"> {{ (scope.row.COSTO_DEALER == null) ? 0 : (Number((parseFloat(scope.row.COSTO_DEALER)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="DIF_DEALER" width="110">
                                                                    <template slot-scope="scope"> {{ (scope.row.DIF_DEALER == null) ? 0 : (Number((parseFloat(scope.row.DIF_DEALER)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                            </el-table>
                                                        </div>
                                                        <br>
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-7">
                                                                    <nav>
                                                                        <ul class="pagination">
                                                                            <li v-if="pagination.current_page > 1" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaDscComisiones(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                            </li>
                                                                            <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                            :class="[page==isActived?'active':'']">
                                                                                <a class="page-link"
                                                                                href="#" @click.prevent="cambiarPaginaDscComisiones(page)"
                                                                                v-text="page"></a>
                                                                            </li>
                                                                            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaDscComisiones(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Show Comisiones de Vendedores - Ventas-->
            <div class="modal fade" v-if="accionmodal==13" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">FILTROS DE {{ tituloModal }} </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <form class="form-horizontal">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="row" style="display: flex; align-items: center; justify-content: center;">
                                                            <div class="text-center">
                                                                <div v-for="e in mensajeError" :key="e" v-text="e"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Sucursal</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidsucursal"
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
                                                                <el-select  v-model="formFiltro.nidvendedor"
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
                                                <!-- <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label class="col-md-4 form-control-label">* Fecha Inicio</label>
                                                            <div class="col-md-8">
                                                                <el-date-picker
                                                                    v-model="formFiltro.dfechainicio"
                                                                    type="date"
                                                                    value-format="yyyy-MM-dd"
                                                                    format="dd/MM/yyyy"
                                                                    placeholder="dd/mm/aaaa"
                                                                    :picker-options="pickerOptions">
                                                                </el-date-picker>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label class="col-md-4 form-control-label">* Fecha Fin</label>
                                                            <div class="col-md-8">
                                                                <el-date-picker
                                                                    v-model="formFiltro.dfechafin"
                                                                    type="date"
                                                                    value-format="yyyy-MM-dd"
                                                                    format="dd/MM/yyyy"
                                                                    placeholder="dd/mm/aaaa"
                                                                    :picker-options="pickerOptions">
                                                                </el-date-picker>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Cronograma</label>
                                                            <div class="col-sm-8">
                                                                <el-select  v-model="formFiltro.nidcronograma"
                                                                            filterable
                                                                            clearable
                                                                            placeholder="CRONOGRAMA ADM">
                                                                    <el-option
                                                                        v-for="item in arrayCronogramasAdm"
                                                                        :key="item.nIdCronograma"
                                                                        :label="item.cCronograma"
                                                                        :value="item.nIdCronograma">
                                                                    </el-option>
                                                                </el-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-9 offset-sm-5">
                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="listarDscComisionesAdm()">
                                                            <i class="fa fa-save"></i> Buscar
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="h4">PREVISUALIZACIÓN</h3>
                                                </div>
                                                <div class="card-body">
                                                    <template v-if="arrayDscComisionesAdm.length">
                                                        <div class="table-responsive">
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Exportar Comisiones Administrativo XLS</div>
                                                                <el-button @click="exportarComisionesAdm()">
                                                                    <i :style="'color:rgb(44, 255, 101)'" class="fa-md fa fa-file-excel-o" ></i>
                                                                </el-button>
                                                            </el-tooltip>
                                                            <el-table
                                                                :data="arrayDscComisionesAdm"
                                                                stripe
                                                                style="width: 100%">
                                                                <el-table-column property="FECHA" label="FECHA PEDIDO" width="130"></el-table-column>
                                                                <el-table-column fixed property="PEDIDO" label="N° PEDIDO" width="130"></el-table-column>
                                                                <el-table-column property="VENDEDOR" label="VENDEDOR" width="210"></el-table-column>
                                                                <el-table-column property="VIN" label="VIN" width="150"></el-table-column>
                                                                <el-table-column property="CLIENTE" label="CLIENTE" width="200"></el-table-column>
                                                                <el-table-column property="MARCA" label="MARCA" width="100"></el-table-column>
                                                                <el-table-column property="MODELO" label="MODELO" width="100"></el-table-column>
                                                                <el-table-column label="COSTO_DEALER_COMPRA" width="115">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.COSTO_DEALER_COMPRA)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="COSTO_DEALER_ACTUAL" width="115">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.COSTO_DEALER_ACTUAL)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="PRECIO_CIERRE_FINAL_AV" width="115">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.PRECIO_CIERRE_FINAL_AV)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="PRECIO_CIERRE_LISTA_DE_PRECIO" width="115">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.PRECIO_CIERRE_LISTA_DE_PRECIO)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="FLETE" width="110">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.FLETE)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="TYP" width="110">
                                                                    <template slot-scope="scope"> {{ Number((parseFloat(scope.row.TYP)).toFixed(2)) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="PRECIO_FINAL" width="110">
                                                                    <template slot-scope="scope"> {{ (scope.row.PRECIO_FINAL == null) ? 0 : (Number((parseFloat(scope.row.PRECIO_FINAL)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="SOBRE_PRECIO" width="130">
                                                                    <template slot-scope="scope"> {{ (scope.row.SOBRE_PRECIO == null) ? 0 : (Number((parseFloat(scope.row.SOBRE_PRECIO)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="UTILIDAD_BRUTA" width="130">
                                                                    <template slot-scope="scope"> {{ (scope.row.UTILIDAD_BRUTA == null) ? 0 : (Number((parseFloat(scope.row.UTILIDAD_BRUTA)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="DESC_PROVEEDOR" width="130">
                                                                    <template slot-scope="scope"> {{ (scope.row.DESC_PROVEEDOR == null) ? 0 : (Number((parseFloat(scope.row.DESC_PROVEEDOR)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="DESC_CONCESIONARIO" width="140">
                                                                    <template slot-scope="scope"> {{ (scope.row.DESC_CONCESIONARIO == null) ? 0 : (Number((parseFloat(scope.row.DESC_CONCESIONARIO)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="FLETE" width="110">
                                                                    <template slot-scope="scope"> {{ (scope.row.FLETE == null) ? 0 : (Number((parseFloat(scope.row.FLETE)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="TYP_INF" width="110">
                                                                    <template slot-scope="scope"> {{ (scope.row.TYP_INF == null) ? 0 : (Number((parseFloat(scope.row.TYP_INF)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="SEGURO_INF" width="110">
                                                                    <template slot-scope="scope"> {{ (scope.row.SEGURO_INF == null) ? 0 : (Number((parseFloat(scope.row.SEGURO_INF)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="TOTAL_COSTOS" width="140">
                                                                    <template slot-scope="scope"> {{ (scope.row.TOTAL_COSTOS == null) ? 0 : (Number((parseFloat(scope.row.TOTAL_COSTOS)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="UTILIDAD_NETA" width="140">
                                                                    <template slot-scope="scope"> {{ (scope.row.UTILIDAD_NETA == null) ? 0 : (Number((parseFloat(scope.row.UTILIDAD_NETA)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="COMISION_1_CON_IGV" width="110">
                                                                    <template slot-scope="scope"> {{ (scope.row.COMISION_1_CON_IGV == null) ? 0 : (Number((parseFloat(scope.row.COMISION_1_CON_IGV)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="COMISION_1_SIN_IGV" width="140">
                                                                    <template slot-scope="scope"> {{ (scope.row.COMISION_1_SIN_IGV == null) ? 0 : (Number((parseFloat(scope.row.COMISION_1_SIN_IGV)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="COMISION_2_CON_IGV" width="140">
                                                                    <template slot-scope="scope"> {{ (scope.row.COMISION_2_CON_IGV == null) ? 0 : (Number((parseFloat(scope.row.COMISION_2_CON_IGV)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="COMISION_2_SIN_IGV" width="140">
                                                                    <template slot-scope="scope"> {{ (scope.row.COMISION_2_SIN_IGV == null) ? 0 : (Number((parseFloat(scope.row.COMISION_2_SIN_IGV)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="SOBRE_PRECIO_SIN_IGV" width="140">
                                                                    <template slot-scope="scope"> {{ (scope.row.SOBRE_PRECIO_SIN_IGV == null) ? 0 : (Number((parseFloat(scope.row.SOBRE_PRECIO_SIN_IGV)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="COSTO_DEALER" width="140">
                                                                    <template slot-scope="scope"> {{ (scope.row.COSTO_DEALER == null) ? 0 : (Number((parseFloat(scope.row.COSTO_DEALER)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                                <el-table-column label="DIF_DEALER" width="110">
                                                                    <template slot-scope="scope"> {{ (scope.row.DIF_DEALER == null) ? 0 : (Number((parseFloat(scope.row.DIF_DEALER)).toFixed(2))) }}</template>
                                                                </el-table-column>
                                                            </el-table>
                                                        </div>
                                                        <br>
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-7">
                                                                    <nav>
                                                                        <ul class="pagination">
                                                                            <li v-if="pagination.current_page > 1" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaDscComisionesAdm(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                            </li>
                                                                            <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                            :class="[page==isActived?'active':'']">
                                                                                <a class="page-link"
                                                                                href="#" @click.prevent="cambiarPaginaDscComisionesAdm(page)"
                                                                                v-text="page"></a>
                                                                            </li>
                                                                            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaDscComisionesAdm(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
    import XLSX from 'xlsx'

    export default {
        props:['ruta', 'usuario'],
        data(){
            return {
                formLogin:{
                    cRuta: '',
                    nIdUsuario: '',
                    cUsuario: '',
                    cRol: '',
                    nIdRol: ''
                },
                formFiltro: {
                    //modal 5
                    nidsucursal: '',
                    nidproveedor: '',
                    nidlista: '',
                    nrolista: '',
                    cflagdisponible: '',
                    nidlinea: '',
                    nidmarca: '',
                    nidmodelo: '',
                    //modal 4
                    dfechaventadiaria: '',
                    dfechainicio: '',
                    dfechafin: '',
                    nidvendedor: '',
                    nidsublinea: '',
                    nidcronograma: '',
                    nidestadocotizacion: '',
                    fmontodescuento: '',
                    nidestadopedido: ''
                },
                arrayFlagDisponible: [
                    {'id': 'S', 'nombre': 'Disponibles'},
                    {'id': 'N', 'nombre': 'No Disponibles'}
                ],
                arraySucursal: [],
                arrayVendedores: [],
                arrayProveedor: [],
                arrayLinea: [],
                arrayMarca: [],
                arrayModelo: [],
                arraySubLineas: [],
                arrayCronogramas: [],
                arrayCronogramasAdm: [],
                arrayEstadoCotizacion: [],
                arrayEstadoPedido: [],
                //Previsualizar
                arrayDetalleVentaRetail: [],
                arrayVentaHGSI: [],
                arrayStockVehiculos: [],
                arrayStockVehiculosGeneral: [],
                arrayMetasVenta: [],
                arrayContactosLibres: [],
                arrayDistribucionDesc: [],
                arrayPedidoDeposito: [],
                arrayCotizaciones: [],
                arrayDscComisiones: [],
                arrayDscComisionesAdm: [],
                //OPCIONES GENERALES
                page: 1,
                perPage: 10,
                pages:[],
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
                accionmodal: 0,
                modal:0,
                tituloModal:'',
                tituloFormulario: '',
                error: 0,
                errors: [],
                mensajeError: [],
                loading: false,
                pickerOptions: {
                    disabledDate(time) {
                        return time.getTime() > Date.now();
                    },
                    shortcuts: [
                        {
                            text: 'Hoy',
                            onClick(picker) {
                                picker.$emit('pick', new Date());
                            }
                        },
                        {
                            text: 'Ayer',
                            onClick(picker) {
                                const date = new Date();
                                date.setTime(date.getTime() - 3600 * 1000 * 24);
                                picker.$emit('pick', date);
                            }
                        },
                        {
                            text: 'Hace una semana',
                            onClick(picker) {
                                const date = new Date();
                                date.setTime(date.getTime() - 3600 * 1000 * 24 * 7);
                                picker.$emit('pick', date);
                            }
                        }
                    ]
                },
            }
        },
        mounted(){
            this.cargarInformacionUsuario();
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
            cargarInformacionUsuario(){
                var url = this.ruta + '/usuario/GetInformacionUsuarioCabecera';
                axios.get(url, {
                    params: {
                        'nidusuario': this.usuario.id
                    }
                }).then(response => {
                    this.formLogin.cRuta        = response.data[0].cPathImage;
                    this.formLogin.nIdUsuario   = response.data[0].id;
                    this.formLogin.cUsuario     = response.data[0].cUsuario;
                    this.formLogin.cRol         = response.data[0].cGrupoParNombre;
                    this.formLogin.nIdRol       = response.data[0].nIdGrupoPar;
                    // this.loadAllDashboard();
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
            exportarDetalleVentaRetail(){
                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportDetalleVentaRetail';
                axios.get(url, {
                    params: {
                        'nidempresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'   :   this.formFiltro.nidsucursal,
                        'nidvendedor'   :   this.formFiltro.nidvendedor,
                        'opcion'        :   1
                    }
                }).then(response => {
                    let data = XLSX.utils.json_to_sheet(response.data)
                    const workbook = XLSX.utils.book_new()
                    const filename = 'Detalle Venta Retail'
                    XLSX.utils.book_append_sheet(workbook, data, filename)
                    XLSX.writeFile(workbook, `${filename}.xlsx`)
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
            exportarVentaHGSI(){
                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarVentaHGSI';
                axios.get(url, {
                    params: {
                        'nidempresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'   :   this.formFiltro.nidsucursal,
                        'nidvendedor'   :   this.formFiltro.nidvendedor,
                        'nidproveedor'  :   this.formFiltro.nidproveedor,
                        'nidlinea'      :   this.formFiltro.nidlinea,
                        'nidmarca'      :   this.formFiltro.nidmarca,
                        'nidmodelo'     :   this.formFiltro.nidmodelo,
                        'opcion'        :   1
                    }
                }).then(response => {
                    let data = XLSX.utils.json_to_sheet(response.data)
                    const workbook = XLSX.utils.book_new()
                    const filename = 'Ventas HGSI'
                    XLSX.utils.book_append_sheet(workbook, data, filename)
                    XLSX.writeFile(workbook, `${filename}.xlsx`)
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
            exportarVentaDiaria(){
                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarVentaDiaria';
                axios.get(url, {
                    params: {
                        'nidempresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'dfecha'        :   this.formFiltro.dfechaventadiaria,
                        'nidvendedor'   :   this.formFiltro.nidvendedor
                    }
                }).then(response => {
                    let data = XLSX.utils.json_to_sheet(response.data)
                    const workbook = XLSX.utils.book_new()
                    const filename = 'Detalle Venta Diaria'
                    XLSX.utils.book_append_sheet(workbook, data, filename)
                    XLSX.writeFile(workbook, `${filename}.xlsx`)
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
            exportarComisiones(){
                if(this.validarExportarComision()){
                    return;
                }

                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarComisiones';
                axios.get(url, {
                    params: {
                        'nidempresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'   :   this.formFiltro.nidsucursal,
                        'nidvendedor'   :   this.formFiltro.nidvendedor,
                        // 'dfechainicio'  :   this.formFiltro.dfechainicio,
                        // 'dfechafin'     :   this.formFiltro.dfechafin,
                        'nidcronograma' :   this.formFiltro.nidcronograma,
                        'opcion'            :   1
                    }
                }).then(response => {
                    let data = XLSX.utils.json_to_sheet(response.data)
                    const workbook = XLSX.utils.book_new()
                    const filename = 'Reporte de Comisiones'
                    XLSX.utils.book_append_sheet(workbook, data, filename)
                    XLSX.writeFile(workbook, `${filename}.xlsx`)
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
            exportarComisionesAdm(){
                if(this.validarExportarComision()){
                    return;
                }

                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarComisionesAdm';
                axios.get(url, {
                    params: {
                        'nidempresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'   :   this.formFiltro.nidsucursal,
                        'nidvendedor'   :   this.formFiltro.nidvendedor,
                        // 'dfechainicio'  :   this.formFiltro.dfechainicio,
                        // 'dfechafin'     :   this.formFiltro.dfechafin,
                        'nidcronograma' :   this.formFiltro.nidcronograma,
                        'opcion'            :   1
                    }
                }).then(response => {
                    let data = XLSX.utils.json_to_sheet(response.data)
                    const workbook = XLSX.utils.book_new()
                    const filename = 'Reporte de Comisiones Adm'
                    XLSX.utils.book_append_sheet(workbook, data, filename)
                    XLSX.writeFile(workbook, `${filename}.xlsx`)
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
            exportarStock(){
                if(this.validarExportarStock()){
                    return;
                }

                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarStock';
                axios.get(url, {
                    params: {
                        'nidempresa'        :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'       :   this.formFiltro.nidsucursal,
                        'nidproveedor'      :   this.formFiltro.nidproveedor,
                        'nidlista'          :   this.formFiltro.nidlista,
                        'cflagdisponible'   :   'S',
                        'nidmarca'          :   this.formFiltro.nidmarca,
                        'nidmodelo'         :   this.formFiltro.nidmodelo,
                        'opcion'            :   1
                    }
                }).then(response => {
                    let data = XLSX.utils.json_to_sheet(response.data)
                    const workbook = XLSX.utils.book_new()
                    const filename = 'Lista de Stock de Vehiculos'
                    XLSX.utils.book_append_sheet(workbook, data, filename)
                    XLSX.writeFile(workbook, `${filename}.xlsx`)
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
            exportarStockGeneral(){
                if(this.validarExportarGeneral()){
                    return;
                }

                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarStockGeneral';
                axios.get(url, {
                    params: {
                        'nidempresa'        :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'       :   this.formFiltro.nidsucursal,
                        'nidproveedor'      :   this.formFiltro.nidproveedor,
                        'cflagdisponible'   :   'S',
                        'nidmarca'          :   this.formFiltro.nidmarca,
                        'nidmodelo'         :   this.formFiltro.nidmodelo,
                        'opcion'            :   1,
                    }
                }).then(response => {
                    let data = XLSX.utils.json_to_sheet(response.data)
                    const workbook = XLSX.utils.book_new()
                    const filename = 'Stock de Vehiculos General'
                    XLSX.utils.book_append_sheet(workbook, data, filename)
                    XLSX.writeFile(workbook, `${filename}.xlsx`)
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
            validarExportarStock(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.formFiltro.nidsucursal){
                    this.mensajeError.push('Debe seleccionar una Sucursal');
                }
                if(!this.formFiltro.nidproveedor){
                    this.mensajeError.push('Debe seleccionar un Proveedor');
                }
                if(!this.formFiltro.nidlista){
                    this.mensajeError.push('El nro de lista activa no se ha generado');
                }

                // SI EL ROL ES ASESOR COMERCIAL
                if (this.formLogin.nIdRol == 110026) {
                    if(!this.formFiltro.nidlinea){
                        this.mensajeError.push('Debe seleccionar una linea');
                    }
                    if(!this.formFiltro.nidmarca){
                        this.mensajeError.push('Debe seleccionar una marca');
                    }
                    if(!this.formFiltro.nidmodelo){
                        this.mensajeError.push('Debe seleccionar un modelo');
                    }
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            validarExportarGeneral(){
                this.error = 0;
                this.mensajeError =[];

                // SI EL ROL ES ASESOR COMERCIAL
                if (this.formLogin.nIdRol == 110026) {
                    if(!this.formFiltro.nidsucursal){
                        this.mensajeError.push('Debe seleccionar una Sucursal');
                    }
                    if(!this.formFiltro.nidproveedor){
                        this.mensajeError.push('Debe seleccionar un Proveedor');
                    }
                    if(!this.formFiltro.nidlinea){
                        this.mensajeError.push('Debe seleccionar una linea');
                    }
                    if(!this.formFiltro.nidmarca){
                        this.mensajeError.push('Debe seleccionar una marca');
                    }
                    if(!this.formFiltro.nidmodelo){
                        this.mensajeError.push('Debe seleccionar un modelo');
                    }
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            exportarMetasVenta(){
                if(this.validarMetasVenta()){
                    return;
                }

                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarMetasVenta';
                axios.get(url, {
                    params: {
                        'nidempresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'   :   this.formFiltro.nidsucursal,
                        'nidvendedor'   :   this.formFiltro.nidvendedor,
                        'nidsublinea'   :   this.formFiltro.nidsublinea,
                        'nidcronograma' :   this.formFiltro.nidcronograma,
                        'opcion'            :   1,
                    }
                }).then(response => {
                    let data = XLSX.utils.json_to_sheet(response.data)
                    const workbook = XLSX.utils.book_new()
                    const filename = 'Metas de venta de vehículos'
                    XLSX.utils.book_append_sheet(workbook, data, filename)
                    XLSX.writeFile(workbook, `${filename}.xlsx`)
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
            validarExportarComision(){
                this.error = 0;
                this.mensajeError =[];

                // if(!this.formFiltro.dfechainicio){
                //     this.mensajeError.push('Debe seleccionar una Fecha Inicio');
                // }
                // if(!this.formFiltro.dfechafin){
                //     this.mensajeError.push('Debe seleccionar un Fecha Fin');
                // }
                if(!this.formFiltro.nidcronograma){
                    this.mensajeError.push('Debe seleccionar un Cronograma de Venta');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            validarMetasVenta(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.formFiltro.nidsucursal){
                    this.mensajeError.push('Debe seleccionar una Sucursal');
                }
                if(!this.formFiltro.nidcronograma){
                    this.mensajeError.push('Debe seleccionar un Cronograma');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            exportarContactoLibre(){
                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarContactosLibres';
                axios.get(url, {
                    params: {
                        'nidempresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'   :   this.formFiltro.nidsucursal,
                        'nidvendedor'   :   this.formFiltro.nidvendedor,
                        'dfecha'        :   this.formFiltro.dfechaventadiaria,
                        'opcion'        :   1,
                    }
                }).then(response => {
                    let data = XLSX.utils.json_to_sheet(response.data)
                    const workbook = XLSX.utils.book_new()
                    const filename = 'Contactos Libres'
                    XLSX.utils.book_append_sheet(workbook, data, filename)
                    XLSX.writeFile(workbook, `${filename}.xlsx`)
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
            exportarDistribucacion(){
                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarDistribucionDesc';
                axios.get(url, {
                    params: {
                        'nidempresa'            :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'           :   this.formFiltro.nidsucursal,
                        'nidvendedor'           :   this.formFiltro.nidvendedor,
                        'nidcronograma'         :   this.formFiltro.nidcronograma,
                        'nidestadocotizacion'   :   this.formFiltro.nidestadocotizacion,
                        'fmontodescuento'       :   this.formFiltro.fmontodescuento,
                        'opcion'        :   1,
                    }
                }).then(response => {
                    let data = XLSX.utils.json_to_sheet(response.data)
                    const workbook = XLSX.utils.book_new()
                    const filename = 'Distribucion Descuentos'
                    XLSX.utils.book_append_sheet(workbook, data, filename)
                    XLSX.writeFile(workbook, `${filename}.xlsx`)
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
            exportarPedidoDeposito(){
                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarPedidoDeposito';
                axios.get(url, {
                    params: {
                        'nidempresa'        :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'       :   this.formFiltro.nidsucursal,
                        'nidvendedor'       :   this.formFiltro.nidvendedor,
                        'nidcronograma'     :   this.formFiltro.nidcronograma,
                        'nidestadopedido'   :   this.formFiltro.nidestadopedido,
                        'opcion'            :   1,
                    }
                }).then(response => {
                    let data = XLSX.utils.json_to_sheet(response.data)
                    const workbook = XLSX.utils.book_new()
                    const filename = 'Pedidos con Deposito'
                    XLSX.utils.book_append_sheet(workbook, data, filename)
                    XLSX.writeFile(workbook, `${filename}.xlsx`)
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
            expotarCotizaciones(){
                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarCotizacionesByFitro';
                axios.get(url, {
                    params: {
                        'nidempresa'            :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'           :   this.formFiltro.nidsucursal,
                        'nidvendedor'           :   this.formFiltro.nidvendedor,
                        'nidcronograma'         :   this.formFiltro.nidcronograma,
                        'nidestadocotizacion'   :   this.formFiltro.nidestadocotizacion,
                        'opcion'        :   1,
                    }
                }).then(response => {
                    let data = XLSX.utils.json_to_sheet(response.data)
                    const workbook = XLSX.utils.book_new()
                    const filename = 'Cotizaciones'
                    XLSX.utils.book_append_sheet(workbook, data, filename)
                    XLSX.writeFile(workbook, `${filename}.xlsx`)
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
            //DATA
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
            listarSucursalByEmpresa(){
                var url = this.ruta + '/perrelacion/GetLstSucursalByEmpresa';
                axios.get(url, {
                    params: {
                        'nidusuario': this.usuario.id,
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa"))
                    }
                }).then(response => {
                    this.arraySucursal = response.data;
                    this.obtenerListaPrecioActiva();
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
            listarProveedores(){
                var url = this.ruta + '/parametro/GetLstProveedor';

                axios.get(url, {
                    params: {
                        'nidempresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidgrupopar'   :   110023,
                        'opcion'        :   1
                    }
                }).then(response => {
                    this.arrayProveedor = response.data.arrayProveedor;
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
            obtenerListaPrecioActiva(){
                if (this.formFiltro.nidsucursal && this.formFiltro.nidproveedor) {
                    var url = this.ruta + '/listapreciovh/GetListaPrecioActiva';
                    axios.get(url, {
                        params: {
                            'nidsucursal'   :   this.formFiltro.nidsucursal,
                            'nidproveedor'  :   this.formFiltro.nidproveedor
                        }
                    }).then(response => {
                        this.formFiltro.nidlista = response.data[0].nIdListaPrecioVersionVeh;
                        this.formFiltro.nrolista = response.data[0].nNroListaPrecio;
                    }).catch(error => {
                        console.log(error);
                        if (error.response) {
                            if (error.response.status == 401) {
                                swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                location.reload('0');
                            }
                        }
                    });
                }
            },
            llenarComboLinea(){
                var url;

                // Si el rol del usuario es Vendedor.
                (this.formLogin.nIdRol == 110026) ? url = this.ruta + '/gescontacto/GetLineasByUsuario' : url = this.ruta + '/versionvehiculo/GetLineasByProveedor'

                this.obtenerListaPrecioActiva();

                axios.get(url, {
                    params: {
                        'nidempresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidproveedor'  :   this.formFiltro.nidproveedor,
                        'opcion'        :   1
                    }
                }).then(response => {
                    this.arrayLinea             =   response.data.arrayLinea
                    this.formFiltro.nidlinea    =   ''

                    this.llenarComboMarca();
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
            llenarComboMarca(){
                var url;

                // Si el rol del usuario es Vendedor.
                (this.formLogin.nIdRol == 110026) ? url = this.ruta + '/gescontacto/GetMarcaByLinea' : url = this.ruta + '/versionvehiculo/GetMarcaByLinea'

                axios.get(url, {
                    params: {
                        'nidlinea'  :   this.formFiltro.nidlinea,
                        'opcion'    :   1
                    }
                }).then(response => {
                    this.arrayMarca             =   response.data.arrayMarca
                    this.formFiltro.nidmarca    =   ''

                    this.arrayModelo = [];
                    this.llenarComboModelo();
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
            llenarComboModelo(){
                var url;

                // Si el rol del usuario es Vendedor.
                (this.formLogin.nIdRol == 110026) ? url = this.ruta + '/gescontacto/GetModeloByMarca' : url = this.ruta + '/versionvehiculo/GetModeloByMarca'

                axios.get(url, {
                    params: {
                        'nidlinea'  :   this.formFiltro.nidlinea,
                        'nidmarca'  :   this.formFiltro.nidmarca,
                        'opcion'    :   1
                    }
                }).then(response => {
                    this.arrayModelo            =   response.data.arrayModelo
                    this.formFiltro.nidmodelo   =   ''
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
            listarSubLineaByVendedor(){
                var url = this.ruta + '/usuario/GetListSubLineasByUsuario';
                axios.get(url, {
                    params: {
                        'nidvendedor'   :   this.formFiltro.nidvendedor
                    }
                }).then(response => {
                    this.arraySubLineas = response.data;
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
            listarCronogramaAdm(){
                var url = this.ruta + '/cronograma/GetCronogramaByTipo';
                axios.get(url, {
                    params: {
                        'nidgrupar' :   110039,
                        'nidpar'    :   1300058
                    }
                }).then(response => {
                    this.arrayCronogramasAdm = response.data.arrayCronograma;
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
            listarEstadosCotizacion(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110058,
                        'opcion' : 1
                    }
                }).then(response => {
                    this.arrayEstadoCotizacion = response.data;
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
            listarEstadosPedido(){
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
            //Previsualizar
            listarVentaRetail(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportDetalleVentaRetail';
                axios.get(url, {
                    params: {
                        'nidempresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'   :   this.formFiltro.nidsucursal,
                        'nidvendedor'   :   this.formFiltro.nidvendedor,
                        'opcion'        :   2,
                        'page'          :   page
                    }
                }).then(response => {
                    this.arrayDetalleVentaRetail    = response.data.arrayDetalleVentaRetail.data;
                    this.pagination.current_page    = response.data.arrayDetalleVentaRetail.current_page;
                    this.pagination.total           = response.data.arrayDetalleVentaRetail.total;
                    this.pagination.per_page        = response.data.arrayDetalleVentaRetail.per_page;
                    this.pagination.last_page       = response.data.arrayDetalleVentaRetail.last_page;
                    this.pagination.from            = response.data.arrayDetalleVentaRetail.from;
                    this.pagination.to              = response.data.arrayDetalleVentaRetail.to;
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
            cambiarPaginaVentaRetail(page){
                this.pagination.current_page=page;
                this.listarVentaRetail(page);
            },
            listarVentaHGSI(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarVentaHGSI';
                axios.get(url, {
                    params: {
                        'nidempresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'   :   this.formFiltro.nidsucursal,
                        'nidvendedor'   :   this.formFiltro.nidvendedor,
                        'nidproveedor'  :   this.formFiltro.nidproveedor,
                        'nidlinea'      :   this.formFiltro.nidlinea,
                        'nidmarca'      :   this.formFiltro.nidmarca,
                        'nidmodelo'     :   this.formFiltro.nidmodelo,
                        'opcion'        :   2,
                        'page'          :   page
                    }
                }).then(response => {
                    this.arrayVentaHGSI             = response.data.arrayVentaHGSI.data;
                    this.pagination.current_page    = response.data.arrayVentaHGSI.current_page;
                    this.pagination.total           = response.data.arrayVentaHGSI.total;
                    this.pagination.per_page        = response.data.arrayVentaHGSI.per_page;
                    this.pagination.last_page       = response.data.arrayVentaHGSI.last_page;
                    this.pagination.from            = response.data.arrayVentaHGSI.from;
                    this.pagination.to              = response.data.arrayVentaHGSI.to;
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
            cambiarPaginaVentaHGSI(page){
                this.pagination.current_page=page;
                this.listarVentaHGSI(page);
            },
            listarStockVehiculos(page){
                if(this.validarExportarStock()){
                    return;
                }

                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarStock';
                axios.get(url, {
                    params: {
                        'nidempresa'        :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'       :   this.formFiltro.nidsucursal,
                        'nidproveedor'      :   this.formFiltro.nidproveedor,
                        'nidlista'          :   this.formFiltro.nidlista,
                        'cflagdisponible'   :   'S',
                        'nidmarca'          :   this.formFiltro.nidmarca,
                        'nidmodelo'         :   this.formFiltro.nidmodelo,
                        'opcion'            :   2,
                        'page'              :   page
                    }
                }).then(response => {
                    this.arrayStockVehiculos        = response.data.arrayStockVehiculos.data;
                    this.pagination.current_page    = response.data.arrayStockVehiculos.current_page;
                    this.pagination.total           = response.data.arrayStockVehiculos.total;
                    this.pagination.per_page        = response.data.arrayStockVehiculos.per_page;
                    this.pagination.last_page       = response.data.arrayStockVehiculos.last_page;
                    this.pagination.from            = response.data.arrayStockVehiculos.from;
                    this.pagination.to              = response.data.arrayStockVehiculos.to;
                    $("#myBar").hide();
                    // this.limpiarFiltros();
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
            cambiarPaginaStockVehiculos(page){
                this.pagination.current_page=page;
                this.listarStockVehiculos(page);
            },
            listarStockVehiculosGeneral(page){
                if(this.validarExportarGeneral()){
                    return;
                }
                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarStockGeneral';
                axios.get(url, {
                    params: {
                        'nidempresa'        :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'       :   this.formFiltro.nidsucursal,
                        'nidproveedor'      :   this.formFiltro.nidproveedor,
                        'nidlista'          :   this.formFiltro.nidlista,
                        'cflagdisponible'   :   'S',
                        'nidmarca'          :   this.formFiltro.nidmarca,
                        'nidmodelo'         :   this.formFiltro.nidmodelo,
                        'opcion'            :   2,
                        'page'              :   page
                    }
                }).then(response => {
                    this.arrayStockVehiculosGeneral = response.data.arrayStockVehiculosGeneral.data;
                    this.pagination.current_page    = response.data.arrayStockVehiculosGeneral.current_page;
                    this.pagination.total           = response.data.arrayStockVehiculosGeneral.total;
                    this.pagination.per_page        = response.data.arrayStockVehiculosGeneral.per_page;
                    this.pagination.last_page       = response.data.arrayStockVehiculosGeneral.last_page;
                    this.pagination.from            = response.data.arrayStockVehiculosGeneral.from;
                    this.pagination.to              = response.data.arrayStockVehiculosGeneral.to;
                    $("#myBar").hide();
                    // this.limpiarFiltros();
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
            cambiarPaginaStockVehiculosGeneral(page){
                this.pagination.current_page=page;
                this.listarStockVehiculosGeneral(page);
            },
            listarMetasVenta(page){
                if(this.validarMetasVenta()){
                    return;
                }
                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarMetasVenta';
                axios.get(url, {
                    params: {
                        'nidempresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'   :   this.formFiltro.nidsucursal,
                        'nidvendedor'   :   this.formFiltro.nidvendedor,
                        'nidsublinea'   :   this.formFiltro.nidsublinea,
                        'nidcronograma' :   this.formFiltro.nidcronograma,
                        'opcion'        :   2,
                        'page'          :   page
                    }
                }).then(response => {
                    this.arrayMetasVenta            = response.data.arrayMetasVenta.data;
                    this.pagination.current_page    = response.data.arrayMetasVenta.current_page;
                    this.pagination.total           = response.data.arrayMetasVenta.total;
                    this.pagination.per_page        = response.data.arrayMetasVenta.per_page;
                    this.pagination.last_page       = response.data.arrayMetasVenta.last_page;
                    this.pagination.from            = response.data.arrayMetasVenta.from;
                    this.pagination.to              = response.data.arrayMetasVenta.to;
                    $("#myBar").hide();
                    // this.limpiarFiltros();
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
            cambiarPaginaMetasVenta(page){
                this.pagination.current_page=page;
                this.listarMetasVenta(page);
            },
            listarContactosLibres(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarContactosLibres';
                axios.get(url, {
                    params: {
                        'nidempresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'   :   this.formFiltro.nidsucursal,
                        'nidvendedor'   :   this.formFiltro.nidvendedor,
                        'dfecha'        :   this.formFiltro.dfechaventadiaria,
                        'opcion'        :   2,
                        'page'          :   page
                    }
                }).then(response => {
                    this.arrayContactosLibres       = response.data.arrayContactosLibres.data;
                    this.pagination.current_page    = response.data.arrayContactosLibres.current_page;
                    this.pagination.total           = response.data.arrayContactosLibres.total;
                    this.pagination.per_page        = response.data.arrayContactosLibres.per_page;
                    this.pagination.last_page       = response.data.arrayContactosLibres.last_page;
                    this.pagination.from            = response.data.arrayContactosLibres.from;
                    this.pagination.to              = response.data.arrayContactosLibres.to;
                    $("#myBar").hide();
                    // this.limpiarFiltros();
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
            cambiarPaginaContactoLibre(page){
                this.pagination.current_page=page;
                this.listarContactosLibres(page);
            },
            listarDistribucion(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarDistribucionDesc';
                axios.get(url, {
                    params: {
                        'nidempresa'            :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'           :   this.formFiltro.nidsucursal,
                        'nidvendedor'           :   this.formFiltro.nidvendedor,
                        'nidcronograma'         :   this.formFiltro.nidcronograma,
                        'nidestadocotizacion'   :   this.formFiltro.nidestadocotizacion,
                        'fmontodescuento'       :   this.formFiltro.fmontodescuento,
                        'opcion'                :   2,
                        'page'                  :   page
                    }
                }).then(response => {
                    this.arrayDistribucionDesc      = response.data.arrayDistribucionDesc.data;
                    this.pagination.current_page    = response.data.arrayDistribucionDesc.current_page;
                    this.pagination.total           = response.data.arrayDistribucionDesc.total;
                    this.pagination.per_page        = response.data.arrayDistribucionDesc.per_page;
                    this.pagination.last_page       = response.data.arrayDistribucionDesc.last_page;
                    this.pagination.from            = response.data.arrayDistribucionDesc.from;
                    this.pagination.to              = response.data.arrayDistribucionDesc.to;
                    $("#myBar").hide();
                    // this.limpiarFiltros();
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
            cambiarPaginaDistribucacion(page){
                this.pagination.current_page=page;
                this.listarDistribucion(page);
            },
            listarPedidoDeposito(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarPedidoDeposito';
                axios.get(url, {
                    params: {
                        'nidempresa'        :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'       :   this.formFiltro.nidsucursal,
                        'nidvendedor'       :   this.formFiltro.nidvendedor,
                        'nidcronograma'     :   this.formFiltro.nidcronograma,
                        'nidestadopedido'   :   this.formFiltro.nidestadopedido,
                        'opcion'            :   2,
                        'page'              :   page
                    }
                }).then(response => {
                    this.arrayPedidoDeposito        = response.data.arrayPedidoDeposito.data;
                    this.pagination.current_page    = response.data.arrayPedidoDeposito.current_page;
                    this.pagination.total           = response.data.arrayPedidoDeposito.total;
                    this.pagination.per_page        = response.data.arrayPedidoDeposito.per_page;
                    this.pagination.last_page       = response.data.arrayPedidoDeposito.last_page;
                    this.pagination.from            = response.data.arrayPedidoDeposito.from;
                    this.pagination.to              = response.data.arrayPedidoDeposito.to;
                    $("#myBar").hide();
                    // this.limpiarFiltros();
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
            cambiarPaginaPedidoDeposito(page){
                this.pagination.current_page=page;
                this.listarPedidoDeposito(page);
            },
            listarCotizaciones(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarCotizacionesByFitro';
                axios.get(url, {
                    params: {
                        'nidempresa'            :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'           :   this.formFiltro.nidsucursal,
                        'nidvendedor'           :   this.formFiltro.nidvendedor,
                        'nidcronograma'         :   this.formFiltro.nidcronograma,
                        'nidestadocotizacion'   :   this.formFiltro.nidestadocotizacion,
                        'dfechainicio'          :   this.formFiltro.dfechainicio,
                        'dfechafin'             :   this.formFiltro.dfechafin,
                        'opcion'                :   2,
                        'page'                  :   page
                    }
                }).then(response => {
                    this.arrayCotizaciones          = response.data.arrayCotizaciones.data;
                    this.pagination.current_page    = response.data.arrayCotizaciones.current_page;
                    this.pagination.total           = response.data.arrayCotizaciones.total;
                    this.pagination.per_page        = response.data.arrayCotizaciones.per_page;
                    this.pagination.last_page       = response.data.arrayCotizaciones.last_page;
                    this.pagination.from            = response.data.arrayCotizaciones.from;
                    this.pagination.to              = response.data.arrayCotizaciones.to;
                    $("#myBar").hide();
                    // this.limpiarFiltros();
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
            cambiarPaginaCotizaciones(page){
                this.pagination.current_page=page;
                this.listarCotizaciones(page);
            },
            listarDscComisiones(page){
                if(this.validarExportarComision()){
                    return;
                }

                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarComisiones';
                axios.get(url, {
                    params: {
                        'nidempresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'   :   this.formFiltro.nidsucursal,
                        'nidvendedor'   :   this.formFiltro.nidvendedor,
                        // 'dfechainicio'  :   this.formFiltro.dfechainicio,
                        // 'dfechafin'     :   this.formFiltro.dfechafin,
                        'nidcronograma' :   this.formFiltro.nidcronograma,
                        'opcion'        :   2,
                        'page'          :   page
                    }
                }).then(response => {
                    this.arrayDscComisiones         = response.data.arrayDscOtorgadosComisiones.data;
                    this.pagination.current_page    = response.data.arrayDscOtorgadosComisiones.current_page;
                    this.pagination.total           = response.data.arrayDscOtorgadosComisiones.total;
                    this.pagination.per_page        = response.data.arrayDscOtorgadosComisiones.per_page;
                    this.pagination.last_page       = response.data.arrayDscOtorgadosComisiones.last_page;
                    this.pagination.from            = response.data.arrayDscOtorgadosComisiones.from;
                    this.pagination.to              = response.data.arrayDscOtorgadosComisiones.to;
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
            cambiarPaginaDscComisiones(page){
                this.pagination.current_page=page;
                this.listarDscComisiones(page);
            },
            listarDscComisionesAdm(page){
                if(this.validarExportarComision()){
                    return;
                }

                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarComisionesAdm';
                axios.get(url, {
                    params: {
                        'nidempresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'   :   this.formFiltro.nidsucursal,
                        'nidvendedor'   :   this.formFiltro.nidvendedor,
                        // 'dfechainicio'  :   this.formFiltro.dfechainicio,
                        // 'dfechafin'     :   this.formFiltro.dfechafin,
                        'nidcronograma' :   this.formFiltro.nidcronograma,
                        'opcion'        :   2,
                        'page'          :   page
                    }
                }).then(response => {
                    this.arrayDscComisionesAdm      = response.data.arrayDscOtorgadosComisiones.data;
                    this.pagination.current_page    = response.data.arrayDscOtorgadosComisiones.current_page;
                    this.pagination.total           = response.data.arrayDscOtorgadosComisiones.total;
                    this.pagination.per_page        = response.data.arrayDscOtorgadosComisiones.per_page;
                    this.pagination.last_page       = response.data.arrayDscOtorgadosComisiones.last_page;
                    this.pagination.from            = response.data.arrayDscOtorgadosComisiones.from;
                    this.pagination.to              = response.data.arrayDscOtorgadosComisiones.to;
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
            cambiarPaginaDscComisionesAdm(page){
                this.pagination.current_page=page;
                this.listarDscComisionesAdm(page);
            },
            // =============================================
            // =============  MODAL ========================
            limpiarFiltros(){
                this.formFiltro.nidsucursal         =   '';
                this.formFiltro.nidproveedor        =   '';
                this.formFiltro.nidlista            =   '';
                this.formFiltro.nrolista            =   '';
                this.formFiltro.cflagdisponible     =   '';
                this.formFiltro.nidlinea            =   '';
                this.formFiltro.nidmarca            =   '';
                this.formFiltro.nidmodelo           =   '';
                this.formFiltro.dfechaventadiaria   =   '';
                this.formFiltro.dfechainicio        =   '';
                this.formFiltro.dfechafin           =   '';
                this.formFiltro.nidvendedor         =   '';
                this.formFiltro.nidsublinea         =   '';
                this.formFiltro.nidcronograma       =   '';
                this.formFiltro.nidestadocotizacion =   '';
                this.formFiltro.fmontodescuento     =   '';
                this.arrayLinea                     =   [];
                this.arrayMarca                     =   [];
                this.arrayModelo                    =   [];

                this.arrayDetalleVentaRetail        =   [];
                this.arrayVentaHGSI                 =   [];
                this.arrayStockVehiculos            =   [];
                this.arrayStockVehiculosGeneral     =   [];
                this.arrayMetasVenta                =   [];
                this.arrayContactosLibres           =   [];
                this.arrayDistribucionDesc          =   [];
                this.arrayPedidoDeposito            =   [];
                this.arrayCotizaciones              =   [];
                this.arrayDscComisiones             =   [];
                this.arrayDscComisionesAdm          =   [];
            },
            cerrarModal(){
                this.modal = 0
                this.error = 0,
                this.mensajeError = ''
            },
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case 'ventaretail':
                    {
                        switch(accion){
                            case 'abrir':
                            {
                                this.limpiarFiltros();
                                this.listarSucursalByEmpresa();
                                this.tituloModal = data;
                                this.accionmodal=2;
                                this.modal = 1;
                                break;
                            }
                        }
                    }
                    break;
                    case 'ventahgsi':
                    {
                        switch(accion){
                            case 'abrir':
                            {
                                this.limpiarFiltros();
                                this.listarSucursalByEmpresa();
                                this.listarProveedores();
                                this.tituloModal = data;
                                this.accionmodal=3;
                                this.modal = 1;
                                break;
                            }
                        }
                    }
                    break;
                    case 'ventadiaria':
                    {
                        switch(accion){
                            case 'abrir':
                            {
                                this.limpiarFiltros();
                                this.listarVendedores();
                                this.tituloModal = data;
                                this.accionmodal=4;
                                this.modal = 1;
                                break;
                            }
                        }
                    }
                    break;
                    case 'stock':
                    {
                        switch(accion){
                            case 'abrir':
                            {
                                this.limpiarFiltros();
                                this.listarSucursalByEmpresa();
                                this.listarProveedores();
                                this.tituloModal = data;
                                this.accionmodal = 5;
                                this.modal = 1;
                                break;
                            }
                        }
                    }
                    break;
                    case 'stock-general':
                    {
                        switch(accion){
                            case 'abrir':
                            {
                                this.limpiarFiltros();
                                this.listarSucursalByEmpresa();
                                this.listarProveedores();
                                this.tituloModal = data;
                                this.accionmodal = 6;
                                this.modal = 1;
                                break;
                            }
                        }
                    }
                    break;
                    case 'meta-venta':
                    {
                        switch(accion){
                            case 'abrir':
                            {
                                this.limpiarFiltros();
                                this.listarSucursalByEmpresa();
                                this.listarCronograma();
                                this.tituloModal = data;
                                this.accionmodal = 7;
                                this.modal = 1;
                                break;
                            }
                        }
                    }
                    break;
                    case 'contacto-libre':
                    {
                        switch(accion){
                            case 'abrir':
                            {
                                this.limpiarFiltros();
                                this.listarSucursalByEmpresa();
                                this.tituloModal = data;
                                this.accionmodal = 8;
                                this.modal = 1;
                                break;
                            }
                        }
                    }
                    break;
                    case 'descuento-compartido':
                    {
                        switch(accion){
                            case 'abrir':
                            {
                                this.limpiarFiltros();
                                this.listarSucursalByEmpresa();
                                this.listarCronograma();
                                this.listarEstadosCotizacion();
                                this.tituloModal = data;
                                this.accionmodal = 9;
                                this.modal = 1;
                                break;
                            }
                        }
                    }
                    break;
                    case 'pedido-deposito':
                    {
                        switch(accion){
                            case 'abrir':
                            {
                                this.limpiarFiltros();
                                this.listarSucursalByEmpresa();
                                this.listarCronograma();
                                this.listarEstadosPedido();
                                this.tituloModal = data;
                                this.accionmodal = 10;
                                this.modal = 1;
                                break;
                            }
                        }
                    }
                    break;
                    case 'cotizaciones':
                    {
                        switch(accion){
                            case 'abrir':
                            {
                                this.limpiarFiltros();
                                this.listarSucursalByEmpresa();
                                this.listarCronograma();
                                this.listarEstadosCotizacion();
                                this.tituloModal = data;
                                this.accionmodal = 11;
                                this.modal = 1;
                                break;
                            }
                        }
                    }
                    break;
                    case 'comision-vendedores':
                    {
                        switch(accion){
                            case 'abrir':
                            {
                                this.limpiarFiltros();
                                this.listarSucursalByEmpresa();
                                this.listarCronograma();
                                this.tituloModal = data;
                                this.accionmodal = 12;
                                this.modal = 1;
                                break;
                            }
                            case 'abrir-adm':
                            {
                                this.limpiarFiltros();
                                this.listarSucursalByEmpresa();
                                this.listarCronogramaAdm();
                                this.tituloModal = data;
                                this.accionmodal = 13;
                                this.modal = 1;
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

<style scopedSlots>
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
    .btnBuscar{
        width: 100%;
        padding: .5rem;
        margin-top: .4rem;
    }
    .no-padding-bottom{
        margin: .8rem !important;
    }
    .el-table .cell{
        line-height: 1.1 !important;
        font-size: 1.21em;
        color: #666;
    }
    .el-table td, .el-table th{
        padding: 3px !important;
    }
    .card-header{
        display: flex;
    }
</style>
