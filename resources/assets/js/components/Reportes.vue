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

            <!--CONSULTAS/RETAIL || ADV/Gerencia-->
            <section class="dashboard-counts no-padding-bottom" v-if="formLogin.nIdRol == 110025 || formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                <div class="container-fluid">
                    <div class="row bg-white has-shadow">
                        <div class="col-xs-12" style="width: 100%;">
                            <h3>CONSULTAS/RETAIL</h3>
                        </div>

                        <!-- JV/ADV/Gerencia -->
                        <template v-if="formLogin.nIdRol == 110025 || formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                            <div class="col-xl-4 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <div class="icon bg-violet" @click="exportarDetalleVentaRetail()"><i class="fa-md fa fa-file-excel-o"></i></div>
                                    <div class="title"><span><br>Detalle Venta Retail</span></div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <div class="icon bg-violet" @click="exportarVentaHGSI()"><i class="fa-md fa fa-file-excel-o"></i></div>
                                    <div class="title"><span><br>Ventas HGSI</span></div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </section>

            <!--Marketing y Ventas || ADV/Gerencia-->
            <section class="dashboard-counts no-padding-bottom" v-if="formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                <div class="container-fluid">
                    <div class="row bg-white has-shadow">
                        <div class="col-xs-12" style="width: 100%;">
                            <h3>MARKETING Y VENTAS</h3>
                        </div>

                        <!-- ADV/Gerencia -->
                        <template v-if="formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                            <div class="col-xl-4 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <div class="icon bg-violet" @click="abrirModal('ventadiaria', 'abrir', 'VENTA DIARIA')"><i class="fa-md fa fa-file-excel-o"></i></div>
                                    <div class="title"><span><br>Venta Diaria</span></div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </section>

            <!--Reportes Comerciales || JV/ADV/Gerencia ||| formLogin.nIdRol == 110026 <= Vendedores || -->
            <section class="dashboard-counts no-padding-bottom" v-if="formLogin.nIdRol == 110025 || formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                <div class="container-fluid">
                    <div class="row bg-white has-shadow">
                        <div class="col-xs-12" style="width: 100%;">
                            <h3>REPORTES COMERCIALES</h3>
                        </div>

                        <!-- JV/ADV/Gerencia -->
                        <template v-if="formLogin.nIdRol == 110025 || formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
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
                            <div class="col-xl-4 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <div class="icon bg-violet"  @click="abrirModal('meta-venta', 'abrir', 'METAS DE VENTAS')"><i class="fa-md fa fa-file-excel-o"></i></div>
                                    <div class="title"><span><br>Metas de venta de vehículos</span></div>
                                </div>
                            </div>
                        </template>
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

            <!-- Modal Show Venta Diaria -->
            <div class="modal fade" v-if="accionmodal==4" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-md" role="document">
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
                <div class="modal-dialog modal-primary modal-md" role="document">
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
                                                    <div class="col-sm-8 offset-sm-4">
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
                                                    <h3 class="h4">DATA FILTRADA</h3>
                                                </div>
                                                <div class="card-body">
                                                    <form class="form-horizontal">
                                                        <div class="col-lg-12">
                                                            <template v-if="arrayStockVehiculos.length">
                                                                <div class="table-responsive">
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
                                                    </form>
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
                <div class="modal-dialog modal-primary modal-md" role="document">
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
                                                    <h3 class="h4">DATA FILTRADA</h3>
                                                </div>
                                                <div class="card-body">
                                                    <form class="form-horizontal">
                                                        <div class="col-lg-12">
                                                            <template v-if="arrayStockVehiculosGeneral.length">
                                                                <div class="table-responsive">
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
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-8">
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
                                                    </form>
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
                <div class="modal-dialog modal-primary modal-md" role="document">
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
                                                    <h3 class="h4">DATA FILTRADA</h3>
                                                </div>
                                                <div class="card-body">
                                                    <form class="form-horizontal">
                                                        <div class="col-lg-12">
                                                            <template v-if="arrayMetasVenta.length">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>ID&nbsp;
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Exportar Metas de Venta(s) XLS</div>
                                                                                            <i :style="'color:#796AEE'" class="fa-md fa fa-file-excel-o" @click="exportarMetasVenta()"></i>
                                                                                    </el-tooltip></th>
                                                                                <th>VENDEDOR</th>
                                                                                <th>AÑO</th>
                                                                                <th>MES</th>
                                                                                <th>SUBLINEA</th>
                                                                                <th>CUOTA</th>
                                                                                <th>Nª COTIZACIONES</th>
                                                                                <th>Nª PEDIDOS</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="(metasventa, index) in arrayMetasVenta" :key="index">
                                                                                <td v-text="metasventa.ID"></td>
                                                                                <td v-text="metasventa.VENDEDOR"></td>
                                                                                <td v-text="metasventa.ANIO"></td>
                                                                                <td v-text="metasventa.MES"></td>
                                                                                <td v-text="metasventa.SUBLINEA"></td>
                                                                                <td v-text="metasventa.CUOTA"></td>
                                                                                <td v-text="metasventa.N_COTIZACIONES"></td>
                                                                                <td v-text="metasventa.N_PEDIDOS"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-8">
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
                                                    </form>
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
                    nidvendedor: '',
                    nidsublinea: '',
                    nidcronograma: ''
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
                //Previsualizar
                arrayStockVehiculos: [],
                arrayStockVehiculosGeneral: [],
                arrayMetasVenta: [],
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
                axios.get(url).then(response => {
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
                axios.get(url).then(response => {
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
            exportarStock(){
                if(this.validarExportarStock()){
                    return;
                }

                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarStock';
                axios.get(url, {
                    params: {
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

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            validarExportarGeneral(){
                this.error = 0;
                this.mensajeError =[];

                /*if(!this.formFiltro.nidsucursal){
                    this.mensajeError.push('Debe seleccionar una Sucursal');
                }*/
                /*if(!this.formFiltro.nidproveedor){
                    this.mensajeError.push('Debe seleccionar un Proveedor');
                }*/

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
            //DATA
            listarVendedores(){
                this.mostrarProgressBar();

                var url = this.ruta + '/usuario/GetListUsuariosByRol';
                axios.get(url, {
                    params: {
                        'nidempresa':   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidempresa':   0,
                        'nidrol'    :   '110026'
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
                url = this.ruta + '/versionvehiculo/GetLineasByProveedor'

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
                url = this.ruta + '/versionvehiculo/GetMarcaByLinea'

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
                url = this.ruta + '/versionvehiculo/GetModeloByMarca'

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
            //Previsualizar
            listarStockVehiculos(page){
                if(this.validarExportarStock()){
                    return;
                }

                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarStock';
                axios.get(url, {
                    params: {
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
            // =============================================
            // =============  MODAL ========================
            limpiarFiltros(){
                this.formFiltro.nidsucursal         = '';
                this.formFiltro.nidproveedor        = '';
                this.formFiltro.nidlista            = '';
                this.formFiltro.nrolista            = '';
                this.formFiltro.cflagdisponible     = '';
                this.formFiltro.nidlinea            = '';
                this.formFiltro.nidmarca            = '';
                this.formFiltro.nidmodelo           = '';
                this.formFiltro.dfechaventadiaria   = '';
                this.formFiltro.nidvendedor         = '';
                this.formFiltro.nidsublinea         = '';
                this.formFiltro.nidcronograma       = '';
                this.arrayStockVehiculos            = [];
                this.arrayStockVehiculosGeneral     = [];
                this.arrayMetasVenta                = [];
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
    .btnBuscar{
        width: 100%;
        padding: .5rem;
        margin-top: .4rem;
    }
    .no-padding-bottom{
        margin: .8rem !important;
    }
</style>
