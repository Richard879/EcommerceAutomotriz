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
            <section class="dashboard-counts no-padding-bottom" v-if="formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                <div class="container-fluid">
                    <div class="row bg-white has-shadow">
                        <div class="col-xs-12" style="width: 100%;">
                            <h3>CONSULTAS/RETAIL</h3>
                        </div>

                        <!-- ADV/Gerencia -->
                        <template v-if="formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
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
                                    <div class="icon bg-violet"  @click="abrirModal('stock-general', 'abrir', 'STOCK VEHICULOS GENERAL')"><i class="fa-md fa fa-file-excel-o"></i></div>
                                    <div class="title"><span><br>Stock Vehiculos General</span></div>
                                </div>
                            </div>
                            <!-- <div class="col-xl-4 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <div class="icon bg-violet"  @click="abrirModal('meta-venta', 'abrir', 'METAS DE VENTAS')"><i class="fa-md fa fa-file-excel-o"></i></div>
                                    <div class="title"><span><br>Metas de venta de vehículos</span></div>
                                </div>
                            </div> -->
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
                                                <div class="col-sm-9 offset-sm-5">
                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="exportarStock()">
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
                                                <div class="col-sm-9 offset-sm-5">
                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="exportarStockGeneral()">
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

            <!-- Modal Show STOCK VEHICULOS GENERAL -->
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
                                                                        placeholder="SUCURSAL">
                                                                <el-option
                                                                    v-for="item in arraySucursal"
                                                                    :key="item.nIdPar"
                                                                    :label="item.cParNombre"
                                                                    :value="item.nIdPar"
                                                                    @change="listarAsesoresBySucursal">
                                                                </el-option>
                                                            </el-select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <label class="col-md-4 form-control-label">* Asesor Comercial</label>
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
                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="exportarStockGeneral()">
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
                    nidvendedor: ''
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
                    this.limpiarFiltros();
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
                    this.limpiarFiltros();
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
                    this.limpiarFiltros();
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
                        'nidmodelo'         :   this.formFiltro.nidmodelo
                    }
                }).then(response => {
                    let data = XLSX.utils.json_to_sheet(response.data)
                    const workbook = XLSX.utils.book_new()
                    const filename = 'Lista de Stock de Vehiculos'
                    XLSX.utils.book_append_sheet(workbook, data, filename)
                    XLSX.writeFile(workbook, `${filename}.xlsx`)
                    $("#myBar").hide();
                    this.limpiarFiltros();
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
                        'nidmodelo'         :   this.formFiltro.nidmodelo
                    }
                }).then(response => {
                    let data = XLSX.utils.json_to_sheet(response.data)
                    const workbook = XLSX.utils.book_new()
                    const filename = 'Stock de Vehiculos General'
                    XLSX.utils.book_append_sheet(workbook, data, filename)
                    XLSX.writeFile(workbook, `${filename}.xlsx`)
                    $("#myBar").hide();
                    this.limpiarFiltros();
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

                if(!this.formFiltro.nidsucursal){
                    this.mensajeError.push('Debe seleccionar una Sucursal');
                }
                if(!this.formFiltro.nidproveedor){
                    this.mensajeError.push('Debe seleccionar un Proveedor');
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
            // =============================================
            // =============  MODAL ========================
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
                                this.listarSucursalByEmpresa();
                                this.listarVendedores();
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
