<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">CAMPAÑAS</h2>
                </div>
            </header>

            <section>
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#TabBuscaEventoCampania" @click="tabBuscarEventoCampania()" role="tab" data-toggle="tab">
                                            <i class="fa fa-search"></i> BUSCAR CAMPAÑAS
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#TabNuevoEventoCamp" @click="tabNuevoEventoCampania()" role="tab" data-toggle="tab">
                                            <i class="fa fa-bullhorn"></i> NUEVA CAMPAÑA
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane fade in active show" id="TabBuscaEventoCampania">
                                        <template v-if="vistaFormularioTabBuscar">
                                            <section class="forms">
                                                <div class="container-fluid">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h3 class="h4">BUSCAR CAMPAÑAS</h3>
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
                                                                                    <el-date-picker
                                                                                        v-model="formEventoCamp.dfechainicio"
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
                                                                                        v-model="formEventoCamp.dfechafin"
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
                                                                                <label class="col-sm-4 form-control-label">Proveedor</label>
                                                                                <div class="col-sm-8">
                                                                                    <div class="input-group">
                                                                                        <input type="hidden" v-model="formEventoCamp.nidproveedor">
                                                                                        <input type="text" v-model="formEventoCamp.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
                                                                                        <div class="input-group-prepend">
                                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                <div slot="content">Buscar Proveedor </div>
                                                                                                <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('proveedor','buscar')">
                                                                                                    <i class="fa-lg fa fa-search"></i>
                                                                                                </button>
                                                                                            </el-tooltip>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Tipo Evento</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-select v-model="formEventoCamp.ntipo" filterable clearable placeholder="SELECCIONE">
                                                                                        <el-option
                                                                                        v-for="item in arrayTipoEC"
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
                                                                            <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarEventoCampania">
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
                                                                <template v-if="arrayEventoCampania.length">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-striped table-sm">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Código</th>
                                                                                    <th>Proveedor</th>
                                                                                    <th>Tipo Evento</th>
                                                                                    <th>Nombre Campaña</th>
                                                                                    <th>Fecha Inicio.</th>
                                                                                    <th>Fecha Fin</th>
                                                                                    <th>Total Soles</th>
                                                                                    <th>Total Dolares</th>
                                                                                    <th>Nivel Detalle</th>
                                                                                    <th>Acciones</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="ec in arrayEventoCampania" :key="ec.nIdEventoCampania">
                                                                                    <td v-text="ec.nIdEventoCampania"></td>
                                                                                    <td v-text="ec.cNombreProveedor"></td>
                                                                                    <td v-text="ec.cTipoEvento"></td>
                                                                                    <td v-text="ec.cNombreEventoCampania"></td>
                                                                                    <td v-text="ec.dFechaInicio"></td>
                                                                                    <td v-text="ec.dFechaFin"></td>
                                                                                    <td v-text="ec.fMontoPresupuestoSol"></td>
                                                                                    <td v-text="ec.fMontoPresupuestoDolar"></td>
                                                                                    <td v-text="ec.cFlagDetalleEvento"></td>
                                                                                    <td>
                                                                                        <template v-if="ec.cEventoCampaniaEstado=='A'">
                                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                <div slot="content">Desactivar {{ ec.cNombreEventoCampania }}</div>
                                                                                                <i @click="desactivar(ec.nIdEventoCampania)" :style="'color:#796AEE'" class="fa-md fa fa-check-square"></i>
                                                                                            </el-tooltip>
                                                                                        </template>
                                                                                        <template v-else>
                                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                <div slot="content">Activar {{ ec.cNombreEventoCampania }}</div>
                                                                                                <i @click="activar(ec.nIdEventoCampania)" :style="'color:red'" class="fa-md fa fa-square"></i>
                                                                                            </el-tooltip>
                                                                                        </template>
                                                                                    </td>
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
                                        </template>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="TabNuevoEventoCamp">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">NUEVA CAMPAÑA</h3>
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
                                                                                <el-date-picker
                                                                                    v-model="formEventoCamp.dfechainicio"
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
                                                                                    v-model="formEventoCamp.dfechafin"
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
                                                                            <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="hidden" v-model="formEventoCamp.nidproveedor">
                                                                                    <input type="text" v-model="formEventoCamp.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
                                                                                    <div class="input-group-prepend">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Buscar Proveedor </div>
                                                                                            <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('proveedor','buscar')">
                                                                                                <i class="fa-lg fa fa-search"></i>
                                                                                            </button>
                                                                                        </el-tooltip>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Tipo Campaña</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="formEventoCamp.ntipo" filterable clearable placeholder="SELECCIONE">
                                                                                    <el-option
                                                                                    v-for="item in arrayTipoEC"
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
                                                                            <label class="col-sm-4 form-control-label">* Tipo Cambio</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="formEventoCamp.nidtipocambio" filterable clearable placeholder="SELECCIONE" v-on:change="onchangeTipoCambio()">
                                                                                    <el-option
                                                                                    v-for="item in arrayTipoCambio"
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
                                                                            <label class="col-sm-4 form-control-label">* Valor Tipo Cambio</label>
                                                                            <div class="col-sm-8">
                                                                                <label v-text="formEventoCamp.fvalortipocambio" class="form-control-label-readonly"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Descripción</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="formEventoCamp.descripcion" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--<div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Documento</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="formEventoCamp.filedocumento" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>-->
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <ul class="nav nav-tabs">
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="Tab1" href="#TabECAsignaDetalle" @click="desactivarTabs();" role="tab" data-toggle="tab">
                                                                <i class="fa fa-list"></i> ASIGNA DETALLE
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link disabled" id="Tab2" href="#TabECAsignaElemento" role="tab" data-toggle="tab">
                                                                <i class="fa fa fa-sign-out"></i> ASIGNA ELEMENTO VENTA
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link disabled" id="Tab3" href="#TabECAsignaDistribucion" role="tab" data-toggle="tab">
                                                                <i class="fa fa-usd"></i> DISTRIBUCIÓN
                                                            </a>
                                                        </li>
                                                    </ul>

                                                    <div class="tab-content">
                                                        <div class="tab-pane fade in active show" id="TabECAsignaDetalle">
                                                            <section class="forms">
                                                                <div class="container-fluid">
                                                                    <div class="col-lg-12">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h3 class="h4">ASIGNAR DETALLE</h3>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <div class="form-group row">
                                                                                    <label class="col-sm-3 form-control-label">* Detalle Evento Campaña</label>
                                                                                    <div class="col-sm-9">
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <div class="input-group-prepend">
                                                                                                    <el-select v-model="formEventoCamp.ndetalle" filterable clearable placeholder="SELECCIONE" >
                                                                                                        <el-option
                                                                                                        v-for="item in arrayDetalleEC"
                                                                                                        :key="item.nIdGrupoPar"
                                                                                                        :label="item.cGrupoParNombre"
                                                                                                        :value="item.nIdGrupoPar">
                                                                                                        </el-option>
                                                                                                    </el-select>
                                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                        <div slot="content">Buscar </div>
                                                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('detalle','buscar')">
                                                                                                            <i class="fa-lg fa fa-search"></i>
                                                                                                        </button>
                                                                                                    </el-tooltip>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <br>
                                                                                <template v-if="arrayTemporalLinea.length">
                                                                                    <div class="table-responsive border" style="max-height: 300px; max-width:1200px; overflow-y: auto; overflow-x: auto;-ms-overflow-style: -ms-autohiding-scrollbar;">
                                                                                        <table class="table table-striped table-sm">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th>Acciones</th>
                                                                                                    <th>Código Proveedor</th>
                                                                                                    <th>Nombre Proveedor</th>
                                                                                                    <th>Código Línea</th>
                                                                                                    <th>Nombre Línea</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr v-for="(templinea, index)  in arrayTemporalLinea" :key="templinea.nIdLinea">
                                                                                                    <td>
                                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                            <div slot="content">Eliminar {{ templinea.cLineaNombre }}</div>
                                                                                                            <i @click="eliminarItemLinea(index)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                                        </el-tooltip>
                                                                                                    </td>
                                                                                                    <td v-text="templinea.nIdProveedor"></td>
                                                                                                    <td v-text="templinea.cProveedorNombre"></td>
                                                                                                    <td v-text="templinea.nIdLinea"></td>
                                                                                                    <td v-text="templinea.cLineaNombre"></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                    <br>
                                                                                </template>
                                                                                <template v-if="arrayTemporalMarca.length">
                                                                                    <div class="table-responsive border" style="max-height: 300px; max-width:1200px; overflow-y: auto; overflow-x: auto;-ms-overflow-style: -ms-autohiding-scrollbar;">
                                                                                        <table class="table table-striped table-sm">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th>Acciones</th>
                                                                                                    <th>Código Proveedor</th>
                                                                                                    <th>Nombre Proveedor</th>
                                                                                                    <th>Código Marca</th>
                                                                                                    <th>Nombre Marca</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr v-for="(tempmarca, index)  in arrayTemporalMarca" :key="tempmarca.nIdLinea">
                                                                                                    <td>
                                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                            <div slot="content">Eliminar {{ tempmarca.cMarcaNombre }}</div>
                                                                                                            <i @click="eliminarItemMarca(index)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                                        </el-tooltip>
                                                                                                    </td>
                                                                                                    <td v-text="tempmarca.nIdProveedor"></td>
                                                                                                    <td v-text="tempmarca.cProveedorNombre"></td>
                                                                                                    <td v-text="tempmarca.nIdMarca"></td>
                                                                                                    <td v-text="tempmarca.cMarcaNombre"></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                    <br>
                                                                                </template>
                                                                                <template v-if="arrayTemporalModelo.length">
                                                                                    <div class="table-responsive border" style="max-height: 300px; max-width:1200px; overflow-y: auto; overflow-x: auto;-ms-overflow-style: -ms-autohiding-scrollbar;">
                                                                                        <table class="table table-striped table-sm">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th>Acciones</th>
                                                                                                    <th>Código Proveedor</th>
                                                                                                    <th>Nombre Proveedor</th>
                                                                                                    <th>Código Modelo</th>
                                                                                                    <th>Nombre Modelo</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr v-for="(tempmodelo, index)  in arrayTemporalModelo" :key="tempmodelo.nIdModelo">
                                                                                                    <td>
                                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                            <div slot="content">Eliminar {{ tempmodelo.cModeloNombre }}</div>
                                                                                                            <i @click="eliminarItemModelo(index)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                                        </el-tooltip>
                                                                                                    </td>
                                                                                                    <td v-text="tempmodelo.nIdProveedor"></td>
                                                                                                    <td v-text="tempmodelo.cProveedorNombre"></td>
                                                                                                    <td v-text="tempmodelo.nIdModelo"></td>
                                                                                                    <td v-text="tempmodelo.cModeloNombre"></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                    <br>
                                                                                </template>
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-9 offset-sm-5">
                                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="activarTab2()">
                                                                                            <i class="fa fa-arrow-right"></i> Siguiente
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane fade" id="TabECAsignaElemento">
                                                            <section class="forms">
                                                                <div class="container-fluid">
                                                                    <div class="col-lg-12">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h3 class="h4">ASIGNAR ELEMENTO VENTA</h3>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <form class="form-horizontal">
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">* ELEMENTO VENTA</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="abrirModal('elemento','buscar')">
                                                                                                        <i class="fa fa-search"></i> Buscar
                                                                                                    </button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                                <br>
                                                                                <template v-if="arrayTemporalElemento.length">
                                                                                    <div class="table-responsive border" style="max-height: 300px; max-width:1200px; overflow-y: auto; overflow-x: auto;-ms-overflow-style: -ms-autohiding-scrollbar;">
                                                                                        <table class="table table-striped table-sm">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th>Acciones</th>
                                                                                                    <th>Nombre Proveedor</th>
                                                                                                    <th>Nombre Elemento</th>
                                                                                                    <th>Cantidad</th>
                                                                                                    <th>Moneda</th>
                                                                                                    <th>Total Estimado</th>
                                                                                                    <th>Valor Venta</th>
                                                                                                    <th>SubTotal</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr v-for="(tempelemento, index)  in arrayTemporalElemento" :key="tempelemento.nIdElemento">
                                                                                                    <td>
                                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                            <div slot="content">Eliminar {{ tempelemento.cElemenNombre }}</div>
                                                                                                            <i @click="eliminarItemElemento(index)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                                        </el-tooltip>
                                                                                                    </td>
                                                                                                    <td v-text="tempelemento.cProveedorNombre"></td>
                                                                                                    <td v-text="tempelemento.cElemenNombre"></td>
                                                                                                    <td><input type="number" min="1" class="form-control form-control-sm" v-model="tempelemento.nCantidad"/></td>
                                                                                                    <td v-text="tempelemento.cMonedaNombre"></td>
                                                                                                    <td><input type="number" min="1" class="form-control form-control-sm" v-model="tempelemento.nTotalEstimado"/></td>
                                                                                                    <td v-text="tempelemento.fElemenValorVenta"></td>
                                                                                                    <td> {{ tempelemento.fSubTotal = tempelemento.nTotalEstimado * parseFloat(tempelemento.fElemenValorVenta) }} </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                    <br>
                                                                                    <div class="col-lg-12">
                                                                                        <div class="row flex-rigth-margin">
                                                                                            <div class="form-group row">
                                                                                                <label class="form-control-label">TOTAL USD: &nbsp; &nbsp;</label>
                                                                                                <label class="form-control-label"><strong>{{ montoTotalElementoVentaDolar = totalElementoVentaDolar }}</strong></label>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label class="form-control-label">TOTAL S/. &nbsp; &nbsp;</label>
                                                                                                <label class="form-control-label"><strong>{{ montoTotalElementoVentaSol = totalElementoVentaSol }}</strong></label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </template>
                                                                                <template v-else>
                                                                                    <table>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td colspan="4">No existen registros!</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </template>
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-9 offset-sm-5">
                                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrar()">
                                                                                            <i class="fa fa-save"></i> REGISTRAR
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane fade" id="TabECAsignaDistribucion">
                                                            <section class="forms">
                                                                <div class="container-fluid">
                                                                    <div class="col-lg-12">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h3 class="h4">ASIGNAR PRESUPUESTO COMPARTIDO</h3>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <form class="form-horizontal">
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-12">
                                                                                            <input type="hidden" v-model="formDistribucion.nideventocampania">
                                                                                            <label class="checkbox-inline" v-for="dist in lstTipoDistribucion" :key="dist.id">
                                                                                                <input type="radio" class="radio-template" v-model="formDistribucion.ntipodistribucion" :value="dist.value" v-on:change="cambiarVistaDistribucion()">
                                                                                                <label for="" class="form-control-label" v-text="dist.text"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h3 class="h4">DETALLE DISTRIBUCIÓN</h3>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <template v-if="vistaFormularioDistribucion">
                                                                                    <form class="form-horizontal">
                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">* Asignar Presupuesto</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <div class="input-group">
                                                                                                            <div class="input-group-prepend">
                                                                                                                <el-select v-model="formDistribucion.ntipoproveedor" filterable clearable placeholder="SELECCIONE" v-on:change="asignaEmpresaCabecera()">
                                                                                                                    <el-option
                                                                                                                    v-for="item in lstProveedorDitribucion"
                                                                                                                    :key="item.value"
                                                                                                                    :label="item.text"
                                                                                                                    :value="item.value">
                                                                                                                    </el-option>
                                                                                                                </el-select>
                                                                                                                <button type="button" title="Buscar" class="btn btn-info btn-corner btn-sm" @click="abrirModal('distribucion','cabecera')">
                                                                                                                    <i class="fa-sm fa fa-search"></i>
                                                                                                                </button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                    <template v-if="arrayProveedorPorEC.length">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table table-striped table-sm">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>Acciones</th>
                                                                                                        <th>Código Prov.</th>
                                                                                                        <th>Proveedor</th>
                                                                                                        <th>% Distribución</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr v-for="(proveedor, index) in arrayProveedorPorEC" :key="proveedor.nIdEntidad">
                                                                                                        <td>
                                                                                                            <a href="#" @click="eliminarProveedorCabecera(index);" data-toggle="tooltip" data-placement="top" :title="'Eliminar ' +proveedor.cProveedorNombre">
                                                                                                            <i :style="'color:red'" class="fa-md fa fa-times-circle"></i></a>
                                                                                                        </td>
                                                                                                        <td v-text="proveedor.nIdEntidad"></td>
                                                                                                        <td v-text="proveedor.cProveedorNombre"></td>
                                                                                                        <td>
                                                                                                            <input type="number" v-model="arrayIndexEntidadValor[index]" class="form-control form-control-sm">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </template>
                                                                                </template>
                                                                                <template v-else>
                                                                                    <form class="form-horizontal">
                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-12">
                                                                                                <template v-if="arrayElementoDistribucion.length">
                                                                                                    <div class="table-responsive">
                                                                                                        <table class="table table-striped table-sm">
                                                                                                            <thead>
                                                                                                                <tr>
                                                                                                                    <th>Código</th>
                                                                                                                    <th>Proveedor</th>
                                                                                                                    <th>Tipo Elemento</th>
                                                                                                                    <th>Nombre Elemento</th>
                                                                                                                    <th>Moneda</th>
                                                                                                                    <th>Precio Venta</th>
                                                                                                                    <th>Valor Costo</th>
                                                                                                                    <th>Cantidad</th>
                                                                                                                    <th>SubTotal Soles</th>
                                                                                                                    <th>SubTotal Dolares</th>
                                                                                                                    <th>% Distribución</th>
                                                                                                                </tr>
                                                                                                            </thead>
                                                                                                            <tbody>
                                                                                                                <tr v-for="eledist in arrayElementoDistribucion" :key="eledist.nIdEventoElementoVenta">
                                                                                                                    <td v-text="eledist.nIdEventoElementoVenta"></td>
                                                                                                                    <td v-text="eledist.cProveedorNombre"></td>
                                                                                                                    <td v-text="eledist.cTipoElemenNombre"></td>
                                                                                                                    <td v-text="eledist.cElemenNombre"></td>
                                                                                                                    <td v-text="eledist.cMonedaNombre"></td>
                                                                                                                    <td v-text="eledist.fValorVenta"></td>
                                                                                                                    <td v-text="eledist.fValorCosto"></td>
                                                                                                                    <td v-text="eledist.nTotalEstimado"></td>
                                                                                                                    <td v-text="eledist.fSubTotalElementoSol"></td>
                                                                                                                    <td v-text="eledist.fSubTotalElementoDolar"></td>
                                                                                                                    <td>
                                                                                                                        <el-tooltip class="item" :content="'Editar ' + eledist.cElemenNombre" effect="dark" placement="top-start">
                                                                                                                            <i @click="abrirModal('asignadistribucion','elemento', eledist)" :style="'color:#796AEE'" class="fa-md fa fa-edit"></i>
                                                                                                                        </el-tooltip>&nbsp;
                                                                                                                    </td>
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
                                                                                        </div>
                                                                                    </form>
                                                                                </template>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-9 offset-sm-5">
                                                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarAsignaDistribucion()">
                                                                                    <i class="fa fa-save"></i> REGISTRAR
                                                                                </button>
                                                                                <button type="button" class="btn btn-secundary btn-corner btn-sm" @click="cancelar()">
                                                                                    <i class="fa fa-close"></i> CANCELAR
                                                                                </button>
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

            <!-- MODAL PROVEEDORES -->
            <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTA DE PROVEEDORES</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Nombre</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillProveedor.cnombreproveedor" @keyup.enter="buscaProveedores" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Buscar Proveedor </div>
                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="buscaProveedores">
                                                                            <i class="fa-lg fa fa-search"></i>
                                                                        </button>
                                                                    </el-tooltip>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
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
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar {{ proveedor.cParNombre }}</div>
                                                                    <i @click="asignarProveedor(proveedor.nIdPar, proveedor.cParNombre)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td v-text="proveedor.cParNombre"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-7">
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
                                                    <div class="col-sm-5">
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL ASIGNA DETALLE LINEA, MARCAS, MODELOS -->
            <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form v-on:submit.prevent class="form-horizontal">
                                <div class="container-fluid">
                                    <template v-if="vistaModal==0">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="h4">LISTADO LINEAS</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <label class="col-sm-4 form-control-label">Nombre Linea</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group">
                                                                        <input type="text" v-model="fillModal.clineanombre" @keyup.enter="buscarLineasByProveedor()" class="form-control form-control-sm">
                                                                        <div class="input-group-prepend">
                                                                            <button type="button" title="Buscar Líneas" class="btn btn-info btn-corner btn-sm" @click="buscarLineasByProveedor();"><i class="fa-lg fa fa-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-lg-12">
                                                    <template v-if="arrayLinea.length">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Seleccione</th>
                                                                        <th>Proveedor</th>
                                                                        <th>Linea</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="linea in arrayLinea" :key="linea.nIdLinea">
                                                                        <td>
                                                                            <a href="#" @click="asignarLineas(linea)">
                                                                                <i class='fa-md fa fa-check-circle'></i>
                                                                            </a>
                                                                        </td>
                                                                        <td v-text="linea.cProveedorNombre"></td>
                                                                        <td v-text="linea.cLineaNombre"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-7">
                                                                    <nav>
                                                                        <ul class="pagination">
                                                                            <li v-if="paginationModal.current_page > 1" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaLineasByProveedor(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                            </li>
                                                                            <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                            :class="[page==isActivedModal?'active':'']">
                                                                                <a class="page-link"
                                                                                href="#" @click.prevent="cambiarPaginaLineasByProveedor(page)"
                                                                                v-text="page"></a>
                                                                            </li>
                                                                            <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaLineasByProveedor(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
                                                                            </li>
                                                                        </ul>
                                                                    </nav>
                                                                </div>
                                                                <div class="col-sm-5">
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
                                    </template>
                                    <template v-if="vistaModal==1">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="h4">LISTADO MARCAS</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="col-lg-12">
                                                        <div class="form-group row">
                                                            <div class="col-sm-6">
                                                                <div class="row">
                                                                    <label class="col-sm-4 form-control-label">Nombre Marca</label>
                                                                    <div class="col-sm-8">
                                                                        <div class="input-group">
                                                                            <input type="text" v-model="fillModal.cmarcanombre" @keyup.enter="buscarMarcasByProveedor()" class="form-control form-control-sm">
                                                                            <div class="input-group-prepend">
                                                                                <button type="button" title="Buscar Marcas" class="btn btn-info btn-corner btn-sm" @click="buscarMarcasByProveedor();"><i class="fa-lg fa fa-search"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="col-lg-12">
                                                        <template v-if="arrayMarca.length">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped table-sm">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Seleccione</th>
                                                                            <th>Proveedor</th>
                                                                            <th>Marca</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr v-for="marca in arrayMarca" :key="marca.nIdMarca">
                                                                            <td>
                                                                                <a href="#" @click="asignarMarcas(marca)">
                                                                                    <i class='fa-md fa fa-check-circle'></i>
                                                                                </a>
                                                                            </td>
                                                                            <td v-text="marca.cProveedorNombre"></td>
                                                                            <td v-text="marca.cMarcaNombre"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="row">
                                                                    <div class="col-sm-7">
                                                                        <nav>
                                                                            <ul class="pagination">
                                                                                <li v-if="paginationModal.current_page > 1" class="page-item">
                                                                                    <a @click.prevent="cambiarPaginaMarcasByProveedor(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                </li>
                                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                                :class="[page==isActivedModal?'active':'']">
                                                                                    <a class="page-link"
                                                                                    href="#" @click.prevent="cambiarPaginaMarcasByProveedor(page)"
                                                                                    v-text="page"></a>
                                                                                </li>
                                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                                    <a @click.prevent="cambiarPaginaMarcasByProveedor(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
                                                                                </li>
                                                                            </ul>
                                                                        </nav>
                                                                    </div>
                                                                    <div class="col-sm-5">
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
                                    </template>
                                    <template v-if="vistaModal==2">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="h4">LISTADO MODELOS</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Nombre Modelo</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <input type="text" v-model="fillModal.cmodelonombre" @keyup.enter="buscarModelosByProveedor()" class="form-control form-control-sm">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" title="Buscar Marcas" class="btn btn-info btn-corner btn-sm" @click="buscarModelosByProveedor();"><i class="fa-lg fa fa-search"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <template v-if="arrayModelo.length">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>Seleccione</th>
                                                                    <th>Proveedor</th>
                                                                    <th>Modelo</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="modelo in arrayModelo" :key="modelo.nIdModelo">
                                                                    <td>
                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                            <div slot="content">Agregar {{ modelo.cModeloNombre }}</div>
                                                                            <i @click="asignarModelos(modelo)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                        </el-tooltip>
                                                                    </td>
                                                                    <td v-text="modelo.cProveedorNombre"></td>
                                                                    <td v-text="modelo.cModeloNombre"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-7">
                                                                <nav>
                                                                    <ul class="pagination">
                                                                        <li v-if="paginationModal.current_page > 1" class="page-item">
                                                                            <a @click.prevent="cambiarPaginaModelosByProveedor(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                        </li>
                                                                        <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                        :class="[page==isActivedModal?'active':'']">
                                                                            <a class="page-link"
                                                                            href="#" @click.prevent="cambiarPaginaModelosByProveedor(page)"
                                                                            v-text="page"></a>
                                                                        </li>
                                                                        <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                            <a @click.prevent="cambiarPaginaModelosByProveedor(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
                                                                        </li>
                                                                    </ul>
                                                                </nav>
                                                            </div>
                                                            <div class="col-sm-5">
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
                                    </template>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL ELEMENTOS DE VENTAS -->
            <div class="modal fade" v-if="accionmodal==4" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form v-on:submit.prevent class="form-horizontal">
                                <div class="container-fluid">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">LISTADO ELEMENTO VENTA</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Tipo Elemento</label>
                                                        <div class="col-sm-8">
                                                            <el-select v-model="formEle.ntpoelemen" filterable clearable placeholder="SELECCIONE" >
                                                                <el-option
                                                                v-for="item in arrayTipoElemento"
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
                                                        <label class="col-sm-4 form-control-label">Nombre Elemento</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="formEle.celementonombre" @keyup.enter="buscarElemento()" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Buscar Elemento Venta</div>
                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="buscarElemento()">
                                                                            <i class="fa-lg fa fa-search"></i>
                                                                        </button>
                                                                    </el-tooltip>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-9 offset-sm-5">
                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarElemento()">
                                                        <i class="fa fa-search"></i> Buscar
                                                    </button>
                                                </div>
                                            </div>
                                            <br/>
                                            <template v-if="arrayElementoVenta.length">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Acciones</th>
                                                                <th>Código</th>
                                                                <th>Proveedor</th>
                                                                <th>Tipo Elemento</th>
                                                                <th>Nombre Elemento</th>
                                                                <th>Moneda</th>
                                                                <th>Precio Venta</th>
                                                                <th>Precio Venta Mínimo</th>
                                                                <th>Valor Costo</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="elemento in arrayElementoVenta" :key="elemento.nIdElemento">
                                                                <td>
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Agregar {{ elemento.cElemenNombre }}</div>
                                                                        <i @click="asignarElemento(elemento)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                    </el-tooltip>
                                                                </td>
                                                                <td v-text="elemento.nIdElemento"></td>
                                                                <td v-text="elemento.cProveedorNombre"></td>
                                                                <td v-text="elemento.cTipoElemenNombre"></td>
                                                                <td v-text="elemento.cElemenNombre"></td>
                                                                <td v-text="elemento.cMonedaNombre"></td>
                                                                <td v-text="elemento.fElemenValorVenta"></td>
                                                                <td v-text="elemento.fElemenValorMinimoVenta"></td>
                                                                <td v-text="elemento.fElementValorCosto"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-7">
                                                            <nav>
                                                                <ul class="pagination">
                                                                    <li v-if="paginationModal.current_page > 1" class="page-item">
                                                                        <a @click.prevent="cambiarPaginaElemento(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                    </li>
                                                                    <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                    :class="[page==isActivedModal?'active':'']">
                                                                        <a class="page-link"
                                                                        href="#" @click.prevent="cambiarPaginaElemento(page)"
                                                                        v-text="page"></a>
                                                                    </li>
                                                                    <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                        <a @click.prevent="cambiarPaginaElemento(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
                                                                    </li>
                                                                </ul>
                                                            </nav>
                                                        </div>
                                                        <div class="col-sm-5">
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
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL PROVEEDORES DISTRIBUCION POR ELEMENTO VENTA -->
            <div class="modal fade" v-if="accionmodal==5" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form v-on:submit.prevent class="form-horizontal">
                                <div class="container-fluid">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">LISTADO</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Entidad</label>
                                                        <div class="col-sm-8">
                                                            <el-select v-model="fillProveedor.nidproveedor" filterable clearable placeholder="SELECCIONE" >
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
                                                <div class="col-sm-9 offset-sm-5">
                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="asignarDistribucionElementoVenta()">
                                                        <i class="fa fa-arrow-down"></i> ASIGNAR
                                                    </button>
                                                </div>
                                            </div>
                                            <br/>
                                            <template v-if="arrayElementoDistribucionEnvia.length">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Opciones</th>
                                                                <th>Nombre Proveedor</th>
                                                                <th>%Distribución</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(distribucion, index) in arrayElementoDistribucionEnvia" :key="distribucion.nIdEventoElementoVenta + '-'  + distribucion.nIdProveedor">
                                                                <td v-if="formDistribucion.nindex==distribucion.nIdEventoElementoVenta">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Eliminar Item</div>
                                                                        <i @click="eliminarDistribucionElementoVenta(index)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                    </el-tooltip>&nbsp;
                                                                </td>
                                                                <td v-if="formDistribucion.nindex==distribucion.nIdEventoElementoVenta" v-text="distribucion.cNombreProveedor"></td>
                                                                <td v-if="formDistribucion.nindex==distribucion.nIdEventoElementoVenta">
                                                                    <input type="number" v-model="arrayIndexProvValor[index]" class="form-control form-control-sm">
                                                                </td>
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

            <!-- MODAL PROVEEDORES DISTRIBUCION POR EVENTO CAMPAÑAS -->
            <div class="modal fade" v-if="accionmodal==6" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form v-on:submit.prevent class="form-horizontal">
                                <div class="container-fluid">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">LISTADO</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Nombre</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillProveedor.cnombreproveedor" @keyup.enter="buscaProveedores()" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" title="Buscar Proveedores" class="btn btn-info btn-corner btn-sm" @click="buscaProveedores()">
                                                                        <i class="fa-lg fa fa-search"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>
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
                                                                    <a href="#" @click="asignarProveedorCabecera(proveedor);">
                                                                        <i class='fa-md fa fa-check-circle'></i>
                                                                    </a>
                                                                </td>
                                                                <td v-text="proveedor.cParNombre"></td>
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
                            </form>
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
                cempresa: sessionStorage.getItem("cNombreEmpresa"),
                csucursal: sessionStorage.getItem("cNombreSucursal"),
                canio: '2018',
                cmes: 'MAYO',
                nidempresa: 0,
                nidsucursal: 0,
                // ============================================================
                // =========== VARIABLES MODAL PROVEEDOR ============
                fillProveedor:{
                    nidproveedor: '',
                    cnombreproveedor: ''
                },
                arrayProveedor: [],
                // ============================================================
                // =========== VARIABLES MODAL LEMENTO VENTA ============
                formEle:{
                    nidproveedor: 0,
                    cproveedornombre: '',
                    ntpoelemen: '',
                    nidelemento: 0,
                    celementonombre: ''
                },
                arrayTipoElemento: [],
                arrayElementoVenta: [],
                // ============================================================
                // =========== VARIABLES TAB NUEVO EVENTO/CAMPANIA ===========
                formEventoCamp:{
                    dfechainicio: '',
                    dfechafin: '',
                    nidproveedor: 0,
                    cproveedornombre: '',
                    csituacion: 'ACTIVA',
                    ntipo: '',
                    fvalorpresupuesto: '',
                    descripcion:'',
                    filedocumento:'',
                    ndetalle: '',
                    cflagdetalleevento: 'CA',
                    nidmoneda: '',
                    nidtipocambio: '',
                    fvalortipocambio: 0.0
                },
                arrayEventoCampania: [],
                arrayTipoEC: [],
                arrayTipoMoneda: [],
                arrayTipoCambio: [],
                fValorTipoCambioTransaccion: 0.0,
                nIdTipoCambio: 0,
                // ============================================================
                // =========== VARIABLES TAB ASIGNA DETALLE ===========
                arrayDetalleEC: [],
                arrayTemporalLinea: [],
                arrayTemporalMarca: [],
                arrayTemporalModelo: [],
                arrayRegistraDetalle:[],
                // =========== VARIABLES MODAL LINEA, MARCA, MODELO ===========
                fillModal:{
                    clineanombre: '',
                    cmarcanombre: '',
                    cmodelonombre: ''
                },
                arrayLinea: [],
                arrayMarca: [],
                arrayModelo: [],
                // ============================================================
                // =========== VARIABLES TAB ASIGNA ELEMENTO VENTA ===========
                arrayTemporalElemento: [],
                montoTotalElementoVentaDolar: 0.00,
                montoTotalElementoVentaSol: 0.00,
                // ============================================================
                // =========== VARIABLES TAB DISTRIBUCION ===========
                formDistribucion:{
                    nideventocampania: 0,
                    ntipodistribucion: 1,
                    nidproveedor: 0,
                    cproveedornombre: '',
                    nindex: 0,
                    ntipoproveedor: '',
                    fValorPorcentual: 0,
                    nentidad: 0
                },
                lstTipoDistribucion: [
                    { value: '1', text: 'POR CAMPAÑA'},
                    { value: '2', text: 'POR ELEMENTO VENTA'}
                ],
                // ======== VARIABLES DISTRIBUCION CABECERA ===========
                arrayElementoDistribucion: [],
                arrayIndexProvValor: [],
                lstProveedorDitribucion:[
                    { value: '1', text: 'PROVEEDOR'},
                    { value: '2', text: 'EMPRESA'}
                ],
                // ======== VARIABLES DISTRIBUCION ELEMENTO VENTA ===========
                arrayProveedorPorEC: [],
                arrayIndexEntidadValor: [],
                arrayElementoDistribucionEnvia: [],
                // ==============================================
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
                accion: 0,
                modal:0,
                tituloModal:'',
                tituloFormulario: '',
                accionmodal: 0,
                error: 0,
                errors: [],
                mensajeError: [],
                vistaModal: 0,
                vistaFormularioTabBuscar: 0,
                vistaFormularioDistribucion: 1
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
            totalElementoVentaDolar: function(){
                let me = this;
                let sumaDolares;
                return me.arrayTemporalElemento.reduce(function(valorAnterior, valorActual){
                    //Si moneda es soles
                    if(valorActual.nIdMoneda == 1300027){
                        sumaDolares = valorAnterior + (parseFloat(valorActual.fSubTotal) / me.fValorTipoCambioTransaccion);
                    }else{
                        sumaDolares = valorAnterior + parseFloat(valorActual.fSubTotal);
                    }
                    return Number((sumaDolares).toFixed(2));
                }, 0);
            },
            totalElementoVentaSol: function(){
                let me = this;
                let sumaSoles;
                return me.arrayTemporalElemento.reduce(function(valorAnterior, valorActual){
                    //Si moneda es dolares
                    if(valorActual.nIdMoneda == 1300028){
                        sumaSoles = valorAnterior + (parseFloat(valorActual.fSubTotal) * me.fValorTipoCambioTransaccion);
                    }else{
                        sumaSoles = valorAnterior + parseFloat(valorActual.fSubTotal);
                    }
                    return Number((sumaSoles).toFixed(2));
                }, 0);
            },
        },
        methods:{
            llenarComboTipoEC(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';

                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110045
                    }
                }).then(response => {
                    this.arrayTipoEC = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboTpoElemento(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';

                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110027
                    }
                }).then(response => {
                    this.arrayTipoElemento = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            tabBuscarEventoCampania(){
                this.vistaFormularioTabBuscar = 1;
                this.limpiarFormulario();
                this.llenarComboTipoEC();
            },
            buscarEventoCampania(){
                this.vistaFormularioTabBuscar = 1;
                this.listarEventoCampania(1);
            },
            listarEventoCampania(page){
                this.mostrarProgressBar();
                var url = this.ruta + '/ec/GetEventoCampania';
                axios.get(url, {
                    params: {
                        'nidempresa'    : 1300011,
                        'nidsucursal'   : sessionStorage.getItem("nIdSucursal"),
                        'dfechainicio'  : this.formEventoCamp.dfechainicio,
                        'dfechafin'     : this.formEventoCamp.dfechafin,
                        'nidproveedor'  : this.formEventoCamp.nidproveedor,
                        'page'          : page
                    }
                }).then(response => {
                    this.arrayEventoCampania    = response.data.arrayEventoCampania.data;
                    this.pagination.current_page= response.data.arrayEventoCampania.current_page;
                    this.pagination.total       = response.data.arrayEventoCampania.total;
                    this.pagination.per_page    = response.data.arrayEventoCampania.per_page;
                    this.pagination.last_page   = response.data.arrayEventoCampania.last_page;
                    this.pagination.from        = response.data.arrayEventoCampania.from;
                    this.pagination.to          = response.data.arrayEventoCampania.to;
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarEventoCampania(page);
            },
            activar(nIdEventoCampania){
                swal({
                    title: 'Estas seguro de activar este Evento?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Activar!',
                    cancelButtonText: 'No, cancelar!'
                    }).then((result) => {
                        if (result.value) {
                            var url = this.ruta + '/ec/activar';
                            axios.put(url , {
                                nIdEventoCampania: nIdEventoCampania
                            }).then(response => {
                                swal(
                                'Activado!',
                                'El registro fue activado.'
                                );
                                this.listarEventoCampania(1);
                                this.vistaFormularioTabBuscar = 1;
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                        } else if (result.dismiss === swal.DismissReason.cancel)
                        {
                        }
                    })
            },
            desactivar(nIdEventoCampania){

                swal({
                    title: 'Estas seguro de desactivar este Evento?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Desactivar!',
                    cancelButtonText: 'No, cancelar!'
                    }).then((result) => {
                        if (result.value) {
                            var url = this.ruta + '/ec/desactivar';
                            axios.put(url , {
                                nIdEventoCampania: nIdEventoCampania
                            }).then(response => {
                                swal(
                                'Desactivado!',
                                'El registro fue desactivado.'
                                );
                                this.listarEventoCampania(1);
                                this.vistaFormularioTabBuscar = 1;
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                        } else if (result.dismiss === swal.DismissReason.cancel)
                        {
                        }
                    })
            },
            // ====================================================
            // =============  NUEVO EVENTO ========================
            tabNuevoEventoCampania(){
                this.limpiarFormulario();
                this.llenarComboTipoEC();
                this.llenarComboTipoMoneda();
                this.llenarComboTipoCambio();
                this.cargarTabAsignaDetalle();
                this.cargarTabAsignaElemento();
            },
            llenarComboTipoMoneda(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110028
                    }
                }).then(response => {
                    this.arrayTipoMoneda = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboTipoCambio(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110059
                    }
                }).then(response => {
                    this.arrayTipoCambio = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            onchangeTipoCambio(){
                this.getTipoCambioById();
            },
            getTipoCambioById(){
                if(this.formEventoCamp.nidtipocambio != 0){
                    this.mostrarProgressBar();
                    var url = this.ruta + '/tipocambio/GetTipoCambioById';
                    axios.get(url, {
                        params: {
                            'nidtipotransaccion' : this.formEventoCamp.nidtipocambio
                        }
                    }).then(response => {
                        this.formEventoCamp.fvalortipocambio = response.data[0].fValorTipoCambio;
                        //PARA ENVIAR EN LA TRANSACCION
                        this.fValorTipoCambioTransaccion = response.data[0].fValorTipoCambio;
                        this.nIdTipoCambio = response.data[0].nIdTipoCambio;
                    }).then(function (response) {
                        $("#myBar").hide();
                    }).catch(error => {
                        console.log(error);
                    });
                }
                else if(this.formEventoCamp.nidtipocambio == 0){
                    this.formEventoCamp.fvalortipocambio = 0;
                    this.fValorTipoCambioTransaccion = 0;
                }
            },
            // =============  TAB ASIGNA DETALLE ========================
            cargarTabAsignaDetalle(){
                this.llenarComboDetalleEC();
            },
            llenarComboDetalleEC(){
                var url = this.ruta + '/grupopar/GetGrupoParametroEventoCampania';

                axios.get(url, {
                    params: {
                    }
                }).then(response => {
                    this.arrayDetalleEC = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            validaAsignaDetalle(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formEventoCamp.nidproveedor == 0){
                    this.mensajeError.push('Debes Seleccionar un Proveedor');
                };
                if(this.formEventoCamp.ndetalle == 0){
                    this.mensajeError.push('Debes Seleccionar Detalle Evento Campaña');
                };

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            buscarLineasByProveedor(){
                this.listarLineasByProveedor(1);
            },
            listarLineasByProveedor(page){
                var url = this.ruta + '/parametro/GetLineasByProveedor';

                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidproveedor': parseInt(this.formEventoCamp.nidproveedor),
                        'clineanombre': this.fillModal.clineanombre.toString(),
                        'page' : page
                    }
                }).then(response => {
                    this.arrayLinea = response.data.arrayLinea.data;
                    this.paginationModal.current_page =  response.data.arrayLinea.current_page;
                    this.paginationModal.total = response.data.arrayLinea.total;
                    this.paginationModal.per_page    = response.data.arrayLinea.per_page;
                    this.paginationModal.last_page   = response.data.arrayLinea.last_page;
                    this.paginationModal.from        = response.data.arrayLinea.from;
                    this.paginationModal.to           = response.data.arrayLinea.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaLineasByProveedor(page){
                this.paginationModal.current_page=page;
                this.listarLineasByProveedor(page);
            },
            asignarLineas(data =[]){
                if(this.encuentraLineas(data['nIdLinea'])){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Esa Línea ya se encuentra agregado!',
                            })
                }
                else{
                    this.arrayTemporalLinea = [];
                    this.arrayTemporalLinea.push({
                                nIdLinea: data['nIdLinea'],
                                cLineaNombre: data['cLineaNombre'],
                                nIdProveedor: data['nIdProveedor'],
                                cProveedorNombre: data['cProveedorNombre']
                    });
                    this.arrayTemporalMarca = [];
                    this.arrayTemporalModelo = [];
                    toastr.success('Se Agregó Línea');
                    this.cerrarModal();
                }
            },
            encuentraLineas(nIdLinea){
                var sw=0;
                for(var i=0;i<this.arrayTemporalLinea.length;i++){
                    if(this.arrayTemporalLinea[i].nIdLinea==nIdLinea){
                        sw=true;
                    }
                }
                return sw;
            },
            buscarMarcasByProveedor(){
                this.listarMarcasByProveedor(1);
            },
            listarMarcasByProveedor(page){
                var url = this.ruta + '/parametro/GetMarcasByProveedor';

                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidproveedor' : parseInt(this.formEventoCamp.nidproveedor),
                        'cmarcanombre' : this.fillModal.cmarcanombre.toString(),
                        'page' : page
                    }
                }).then(response => {
                    this.arrayMarca = response.data.arrayMarca.data;
                    this.paginationModal.current_page =  response.data.arrayMarca.current_page;
                    this.paginationModal.total = response.data.arrayMarca.total;
                    this.paginationModal.per_page    = response.data.arrayMarca.per_page;
                    this.paginationModal.last_page   = response.data.arrayMarca.last_page;
                    this.paginationModal.from        = response.data.arrayMarca.from;
                    this.paginationModal.to           = response.data.arrayMarca.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaMarcasByProveedor(page){
                this.paginationModal.current_page=page;
                this.listarMarcasByProveedor(page);
            },
            asignarMarcas(data =[]){
                if(this.encuentraMarcas(data['nIdMarca'])){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Esa Marca ya se encuentra agregado!',
                            })
                }
                else{
                    this.arrayTemporalMarca = [];
                    this.arrayTemporalMarca.push({
                                nIdMarca: data['nIdMarca'],
                                cMarcaNombre: data['cMarcaNombre'],
                                nIdProveedor: data['nIdProveedor'],
                                cProveedorNombre: data['cProveedorNombre']
                    });
                    this.arrayTemporalLinea = [];
                    this.arrayTemporalModelo = [];
                    toastr.success('Se Agregó Marca');
                    this.cerrarModal();
                }
            },
            encuentraMarcas(nIdMarca){
                var sw=0;
                for(var i=0;i<this.arrayTemporalMarca.length;i++){
                    if(this.arrayTemporalMarca[i].nIdMarca==nIdMarca){
                        sw=true;
                    }
                }
                return sw;
            },
            buscarModelosByProveedor(){
                this.listarModelosByProveedor(1);
            },
            listarModelosByProveedor(page){
                var url = this.ruta + '/parametro/GetModelosByProveedor';

                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidproveedor': parseInt(this.formEventoCamp.nidproveedor),
                        'cmodelonombre': this.fillModal.cmodelonombre.toString(),
                        'page' : page
                    }
                }).then(response => {
                    this.arrayModelo = response.data.arrayModelo.data;
                    this.paginationModal.current_page =  response.data.arrayModelo.current_page;
                    this.paginationModal.total = response.data.arrayModelo.total;
                    this.paginationModal.per_page    = response.data.arrayModelo.per_page;
                    this.paginationModal.last_page   = response.data.arrayModelo.last_page;
                    this.paginationModal.from        = response.data.arrayModelo.from;
                    this.paginationModal.to           = response.data.arrayModelo.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaModelosByProveedor(page){
                this.paginationModal.current_page=page;
                this.listarModelosByProveedor(page);
            },
            asignarModelos(data =[]){
                if(this.encuentraModelos(data['nIdModelo'])){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Ese Modelo ya se encuentra agregado!',
                            })
                }
                else{
                    this.arrayTemporalModelo = [];
                    this.arrayTemporalModelo.push({
                                nIdModelo: data['nIdModelo'],
                                cModeloNombre: data['cModeloNombre'],
                                nIdProveedor: data['nIdProveedor'],
                                cProveedorNombre: data['cProveedorNombre']
                    });
                    this.arrayTemporalLinea = [];
                    this.arrayTemporalMarca = [];
                    toastr.success('Se Agregó Modelo ' + data['cModeloNombre']);
                    this.cerrarModal();
                }
            },
            encuentraModelos(nIdModelo){
                var sw=0;
                for(var i=0;i<this.arrayTemporalModelo.length;i++){
                    if(this.arrayTemporalModelo[i].nIdModelo==nIdModelo){
                        sw=true;
                    }
                }
                return sw;
            },
            eliminarItemLinea(index){
                this.$delete(this.arrayTemporalLinea, index);
                toastr.success('Se Eliminó Item Linea');
            },
            eliminarItemMarca(index){
                this.$delete(this.arrayTemporalMarca, index);
                toastr.success('Se Eliminó Item Marca');
            },
            eliminarItemModelo(index){
                this.$delete(this.arrayTemporalModelo, index);
                toastr.success('Se Eliminó Item Modelo');
            },
            // =============  TAB ASIGNA ELEMENTO VENTA ===================
            activarTab2(){
                if(this.validaTab2()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                $('#Tab1').removeClass('nav-link active');
                $('#Tab1').addClass("nav-link");
                $('#Tab2').removeClass('nav-link disabled');
                $('#Tab2').addClass("nav-link active");
                $('#TabECAsignaDetalle').removeClass('in active show');
                $('#TabECAsignaElemento').addClass('in active show');
            },
            cargarTabAsignaElemento(){
                this.llenarComboTpoElemento();
            },
            validaTab2(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formEventoCamp.nidtipocambio == 0 || !this.formEventoCamp.nidtipocambio){
                    this.mensajeError.push('Debes seleccionar Tipo Cambio');
                };
                if(this.formEventoCamp.fvalortipocambio == 0){
                    this.mensajeError.push('El Tipo Cambio debe ser mayor a 0');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            buscarElemento(){
                this.listarElementos(1);
            },
            listarElementos(page){
                var url = this.ruta + '/gescotizacion/GetElementoByTipo';

                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidtipoelemen': this.formEle.ntpoelemen,
                        'celementonombre': this.formEle.celementonombre,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayElementoVenta = response.data.arrayElementoVenta.data;
                    this.paginationModal.current_page =  response.data.arrayElementoVenta.current_page;
                    this.paginationModal.total = response.data.arrayElementoVenta.total;
                    this.paginationModal.per_page    = response.data.arrayElementoVenta.per_page;
                    this.paginationModal.last_page   = response.data.arrayElementoVenta.last_page;
                    this.paginationModal.from        = response.data.arrayElementoVenta.from;
                    this.paginationModal.to           = response.data.arrayElementoVenta.to;
                }).catch(error => {
                    this.errors = error
                });
            },
            cambiarPaginaElemento(page){
                this.paginationModal.current_page=page;
                this.listarElementos(page);
            },
            asignarElemento(data =[]){
                if(this.encuentraElementos(data['nIdElemento'])){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Ese Elemento ya se encuentra agregado!',
                            })
                }
                else{
                    this.arrayTemporalElemento.push({
                                nIdElemento         : data['nIdElemento'],
                                cTipoElemenNombre   : data['cTipoElemenNombre'],
                                cElemenNombre       : data['cElemenNombre'],
                                nIdProveedor        : data['nIdProveedor'],
                                cProveedorNombre    : data['cProveedorNombre'],
                                nCantidad           : 1,
                                nTotalEstimado      : 1,
                                nIdMoneda           : data['nIdMoneda'],
                                fElemenValorVenta   : data['fElemenValorVenta'],
                                cMonedaNombre       : data['cMonedaNombre'],
                                fSubTotal           : 0.00
                    });
                    toastr.success('Se Agregó Elemento ' + data['cElemenNombre']);
                }
            },
            encuentraElementos(nIdElemento){
                var sw=0;
                for(var i=0;i<this.arrayTemporalElemento.length;i++){
                    if(this.arrayTemporalElemento[i].nIdElemento==nIdElemento){
                        sw=true;
                    }
                }
                return sw;
            },
            eliminarItemElemento(index){
                this.$delete(this.arrayTemporalElemento, index);
                toastr.success('Se Eliminó Item Elemento');
            },
            // =============  REGISTRAR EVENTO ===================
            registrar(){
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.mostrarProgressBar();

                var url = this.ruta + '/ec/SetEventoCampania';
                axios.post(url, {
                    nIdEmpresa: 1300011,
                    nIdSucursal: sessionStorage.getItem("nIdSucursal"),
                    nIdProveedor: parseInt(this.formEventoCamp.nidproveedor),
                    cNombreEventoCampania: this.formEventoCamp.descripcion,
                    nIdTipoEvento: parseInt(this.formEventoCamp.ntipo),
                    dFechaInicio: this.formEventoCamp.dfechainicio,
                    dFechaFin: this.formEventoCamp.dfechafin,
                    nIdTipoCambio: parseInt(this.nIdTipoCambio),
                    fTipoCambio: this.formEventoCamp.fvalortipocambio,
                    fMontoPresupuestoDolar: this.montoTotalElementoVentaDolar,
                    fMontoPresupuestoSol:  this.montoTotalElementoVentaSol,
                    cFlagDetalleEvento: this.formEventoCamp.cflagdetalleevento
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        this.registrarAsignaDetalle(response.data[0].nIdEventoCampania)
                        this.registrarAsignaElemento(response.data[0].nIdEventoCampania);
                        $("#myBar").hide();
                        swal('Evento Campaña registrado');
                        this.formDistribucion.nideventocampania = response.data[0].nIdEventoCampania;
                        this.activarTab3();
                    }
                    else{
                        swal('NO se puede registrar Evento');
                    }
                }).catch(error => {
                    console.log(error);
                });
            },
            validar(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formEventoCamp.dfechainicio == ''){
                    this.mensajeError.push('Debes Ingresar Fecha Inicio');
                };
                if(this.formEventoCamp.dfechafin == ''){
                    this.mensajeError.push('Debes Ingresar Fecha Fin');
                };
                if(this.formEventoCamp.nidproveedor == 0){
                    this.mensajeError.push('Debes Seleccionar un Proveedor');
                };
                if(this.formEventoCamp.ntipo == 0){
                    this.mensajeError.push('Debes Seleccionar un Tipo Evento');
                };
                /*if(!this.formEventoCamp.fvalorpresupuesto){
                    this.mensajeError.push('Debes Ingresar Valor Presupuesto');
                };
                if(this.formEventoCamp.nidmoneda == 0){
                    this.mensajeError.push('Debes Seleccionar Tipo Moneda');
                };*/
                if(this.formEventoCamp.nidtipocambio == 0){
                    this.mensajeError.push('Debes Seleccionar Tipo Cambio');
                };
                if(this.formEventoCamp.fvalortipocambio == 0){
                    this.mensajeError.push('Debes Enviar valor Tipo de Cambio');
                };
                if(!this.formEventoCamp.descripcion){
                    this.mensajeError.push('Debes Ingresar Descripción');
                };
                if(this.formEventoCamp.dfechainicio > this.formEventoCamp.dfechafin){
                    this.mensajeError.push('La Fecha Inicio debe ser menor a la Fecha Fin.');
                };

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            registrarAsignaDetalle(nIdEventoCampania){
                if(this.arrayTemporalLinea.length > 0){
                    this.arrayRegistraDetalle = this.arrayTemporalLinea;
                };
                if(this.arrayTemporalMarca.length > 0){
                    this.arrayRegistraDetalle = this.arrayTemporalMarca;
                };
                if(this.arrayTemporalModelo.length > 0){
                    this.arrayRegistraDetalle = this.arrayTemporalModelo;
                };

                if (this.arrayRegistraDetalle.length > 0)
                {
                    var url = this.ruta + '/ec/SetDetalleEventoCampania';

                    axios.post(url, {
                        nIdEventoCampania: nIdEventoCampania,
                        cFlagDetalleEvento: this.formEventoCamp.cflagdetalleevento,
                        data: this.arrayRegistraDetalle,
                        nTotalRegistros: this.arrayRegistraDetalle.length,
                        fValorPresupuesto: this.formEventoCamp.fvalorpresupuesto
                    }).then(response => {
                        //this.registrarAsignaDetalle(response.data);
                    }).catch(error => {
                        console.log(error);
                    });
                }
            },
            registrarAsignaElemento(nIdEventoCampania){
                if(this.arrayTemporalElemento.length > 0){
                    var url = this.ruta + '/ec/SetEventoElementoVenta';

                    axios.post(url, {
                        nIdEventoCampania: nIdEventoCampania,
                        data: this.arrayTemporalElemento,
                        nIdTipoCambio: this.nIdTipoCambio,
                        fTipoCambio: this.fValorTipoCambioTransaccion
                    }).then(response => {
                        //this.registrarAsignaDetalle(response.data);
                    }).catch(error => {
                        console.log(error);
                    });
                }
            },
            // =============  TAB DISTRIBUCION ===================
            activarTab3(){
                $('#Tab1').removeClass('nav-link active');
                $('#Tab1').addClass("nav-link disabled");
                $('#Tab2').removeClass('nav-link active');
                $('#Tab2').addClass("nav-link disabled");
                $('#Tab3').removeClass('nav-link disabled');
                $('#Tab3').addClass("nav-link active");
                $('#TabECAsignaElemento').removeClass('in active show');
                $('#TabECAsignaDistribucion').addClass('in active show');
            },
            cambiarVistaDistribucion(){
                if(this.formDistribucion.ntipodistribucion==1){
                    this.vistaFormularioDistribucion = 1;
                }
                else{
                    this.vistaFormularioDistribucion = 0;
                    this.listarDistribucionElementoVenta();
                }
            },
            //======= Distribucion por Elemento Venta
            listarDistribucionElementoVenta(){
                var url = this.ruta + '/ec/GetDistribucionByElementoVenta';
                axios.get(url, {
                    params: {
                        'nideventocampania' : parseInt(this.formDistribucion.nideventocampania)
                    }
                }).then(response => {
                    this.arrayElementoDistribucion = response.data.arrayElementoDistribucion.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            listarProveedorElementoVenta(page){
                var url = this.ruta + '/parametro/GetLstProveedorTodos';

                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'cnombreproveedor': '',
                        'opcion': 1
                    }
                }).then(response => {
                    this.arrayProveedor = response.data.arrayProveedor;
                }).catch(error => {
                    console.log(error);
                });
            },
            asignarDistribucionElementoVenta(){
                let me = this;
                var cNombreProveedor = "";

                $.each(me.arrayProveedor, function (index, value) {
                    if(value.nIdPar == me.fillProveedor.nidproveedor){
                        me.cNombreProveedor = value.cParNombre;
                    }
                });

                if(this.encuentraDistribucionElementoVenta()){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Esa Distribución ya se encuentra agregada!',
                            })
                }
                else{
                    me.arrayElementoDistribucionEnvia.push({
                        nIdEventoElementoVenta: me.formDistribucion.nindex,
                        nIdProveedor: me.fillProveedor.nidproveedor,
                        cNombreProveedor: me.cNombreProveedor
                    });
                }
            },
            encuentraDistribucionElementoVenta(){
                var sw=0;
                for(var i=0;i<this.arrayElementoDistribucionEnvia.length;i++){
                    if(this.arrayElementoDistribucionEnvia[i].nIdEventoElementoVenta==this.formDistribucion.nindex &&
                        this.arrayElementoDistribucionEnvia[i].nIdProveedor==this.fillProveedor.nidproveedor)
                    {
                        sw=true;
                    }
                }
                return sw;
            },
            eliminarDistribucionElementoVenta(index){
                this.$delete(this.arrayElementoDistribucionEnvia, index);
            },
            //======= Distribucion por Cabecera
            validaBuscaProveedorCabecera(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formDistribucion.ntipoproveedor == 0 || !this.formDistribucion){
                    this.mensajeError.push('Debes Seleccionar la opción PROVEEDOR');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            listarProveedorCabecera(page){
                var url = this.ruta + '/parametro/GetLstProveedor';

                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidgrupopar' : 110023,
                        'cnombreproveedor' : this.fillProveedor.cnombreproveedor.toString(),
                        'opcion' : 0,
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
            asignarProveedorCabecera(data =[]){
                if(this.encuentraProveedorCabecera(data['nIdPar'])){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Ese Proveedor ya se encuentra agregado!',
                            })
                }
                else{
                    this.arrayProveedorPorEC.push({
                                nIdEntidad: data['nIdPar'],
                                cFlagEntidad: 'P',
                                cProveedorNombre: data['cParNombre']
                    });
                    toastr.success('Se Agregó Proveedor');
                }
            },
            asignaEmpresaCabecera(){
                if(this.formDistribucion.ntipoproveedor == 2){
                    if(this.encuentraProveedorCabecera(1300011)){
                            swal({
                                type: 'error',
                                title: 'Error...',
                                text: 'Esa Empresa ya se encuentra agregada!',
                                })
                    }
                    else{
                        this.arrayProveedorPorEC.push({
                                    nIdEntidad: 1300011,
                                    cFlagEntidad: 'E',
                                    cProveedorNombre: 'AUTOMOTORES INKA'
                        });
                        toastr.success('Se Agregó Empresa');
                    }
                }
            },
            encuentraProveedorCabecera(nIdEntidad){
                var sw=0;
                for(var i=0;i<this.arrayProveedorPorEC.length;i++){
                    if(this.arrayProveedorPorEC[i].nIdEntidad==nIdEntidad){
                        sw=true;
                    }
                }
                return sw;
            },
            eliminarProveedorCabecera(index){
                this.$delete(this.arrayProveedorPorEC, index);
                toastr.success('Se Eliminó Item Proveedor');
            },
            desactivarTabs(){
                $('#Tab2').addClass('disabled');
            },
            // =============  REGISTRAR DISTRIBUCION ===================
            registrarAsignaDistribucion(){
                let me = this;

                //Registro por Cabecera
                if(me.formDistribucion.ntipodistribucion==1){

                    if(me.arrayProveedorPorEC.length > 0){
                        var list=[];
                        var valorPorEC = 0;

                        me.arrayProveedorPorEC.map(function(value, key) {
                            list.push({
                                cFlagEntidad: value.cFlagEntidad,
                                nIdEntidad: value.nIdEntidad,
                                fValorPorcentual: me.arrayIndexEntidadValor[key]
                            });
                            valorPorEC = valorPorEC + parseInt(me.arrayIndexEntidadValor[key]);
                        });

                        if(me.validaRegistroDistribuionPorEC(valorPorEC)){
                            me.accionmodal=1;
                            me.modal = 1;
                            return;
                        }

                        var url = me.ruta + '/ec/SetDistribucionEventoByEC';
                        axios.post(url, {
                            nIdEventoCampania: parseInt(me.formDistribucion.nideventocampania),
                            data: list
                        }).then(response => {
                            swal('Distribución registrada');
                            me.limpiarFormulario();
                            me.inicio();
                        }).catch(error => {
                            console.log(error);
                        });
                    }
                }
                //Registro por Elemento Venta
                else{
                    if(me.arrayElementoDistribucionEnvia.length > 0){
                        var list=[];

                        me.arrayElementoDistribucionEnvia.map(function(value, key) {
                            list.push({
                                nIdEventoElementoVenta: value.nIdEventoElementoVenta,
                                cFlagEntidad: 'P',
                                nIdEntidad: value.nIdProveedor,
                                fValorPorcentual: me.arrayIndexProvValor[key]
                            });
                        });

                        var url = me.ruta + '/ec/SetDistribucionEventoByElemento';
                        axios.post(url, {
                            data: list
                        }).then(response => {
                            swal('Distribución registrada');
                            me.limpiarFormulario();
                            me.inicio();
                        }).catch(error => {
                            console.log(error);
                        });
                    }
                }
            },
            validarDistribucion(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formDistribucion.nideventocampania == 0){
                    this.mensajeError.push('Error en registro de Distribucion');
                };

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            validaRegistroDistribuionPorEC(valorPorEC){
                this.error = 0;
                this.mensajeError =[];

                if(valorPorEC > 100){
                    this.mensajeError.push('La suma de los valores de porcentaje NO debe ser mas de 100%');
                };

                if(valorPorEC != 100){
                    this.mensajeError.push('La suma de los valores de porcentaje debe ser 100');
                };

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            cancelar(){
                this.limpiarFormulario();
                this.inicio();
            },
            inicio(){
                $('#Tab1').removeClass("nav-link disabled");
                $('#Tab1').addClass('nav-link active');
                $('#Tab2').removeClass('nav-link active');
                $('#Tab2').addClass("nav-link disabled");
                $('#Tab3').removeClass('nav-link active');
                $('#Tab3').addClass("nav-link disabled");
                $('#TabECAsignaDetalle').addClass('in active show');
                $('#TabECAsignaElemento').removeClass('in active show');
                $('#TabECAsignaDistribucion').removeClass('in active show');
            },
            // =========================================================
            // =============  MODAL PROVEEDORES ========================
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
                        'opcion' : 0,
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
                this.formEventoCamp.nidproveedor = nProveedorId;
                this.formEventoCamp.cproveedornombre = cProveedorNombre;
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
                    }break;
                    case 'elemento':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=4;
                                this.modal = 1;
                                break;
                            }
                        }
                    }break;
                    case 'detalle':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                if(this.validaAsignaDetalle()){
                                    this.accionmodal=1;
                                    this.modal = 1;
                                    return;
                                }

                                if(this.formEventoCamp.ndetalle == 110031){
                                    this.formEventoCamp.cflagdetalleevento = "LI";
                                    this.vistaModal = 0;
                                    this.accionmodal=3;
                                    this.modal = 1;
                                    this.buscarLineasByProveedor();
                                }

                                if(this.formEventoCamp.ndetalle == 110032){
                                    this.formEventoCamp.cflagdetalleevento = "MA";
                                    this.vistaModal = 1;
                                    this.accionmodal=3;
                                    this.modal = 1;
                                    this.buscarMarcasByProveedor();
                                }

                                if(this.formEventoCamp.ndetalle == 110033){
                                    this.formEventoCamp.cflagdetalleevento = "MO";
                                    this.vistaModal = 2;
                                    this.accionmodal=3;
                                    this.modal = 1;
                                    this.buscarModelosByProveedor();
                                }


                                break;
                            }
                        }
                    }break;
                    case 'distribucion':
                    {
                        switch(accion){
                            case 'cabecera':
                            {
                                if(this.validaBuscaProveedorCabecera()){
                                    this.accionmodal=1;
                                    this.modal = 1;
                                    return;
                                }

                                this.accionmodal=6;
                                this.modal = 1;
                                this.listarProveedorCabecera(1);
                            }break;
                        }
                    }break;
                    case 'asignadistribucion':
                    {
                        switch(accion){
                            case 'elemento':
                            {
                                this.accionmodal=5;
                                this.modal = 1;
                                this.formDistribucion.nindex = data['nIdEventoElementoVenta'];
                                this.listarProveedorElementoVenta(1);
                                this.fillProveedor.nidproveedor = '';
                            }break;
                        }
                    }
                }
            },
            // ===========================================================
            limpiarFormulario(){
                this.formEventoCamp.dfechainicio = '',
                this.formEventoCamp.dfechafin = '',
                this.formEventoCamp.nidproveedor = 0,
                this.formEventoCamp.cproveedornombre= '',
                this.formEventoCamp.fvalorpresupuesto = '',
                this.formEventoCamp.descripcion = '',
                this.formEventoCamp.ntipo = '',
                this.formDistribucion.nideventocampania = 0,
                this.arrayTemporalLinea = [],
                this.arrayTemporalMarca = [],
                this.arrayTemporalModelo = [],
                this.arrayTemporalElemento = [],
                this.arrayElementoDistribucion = [],
                this.arrayProveedorPorEC = [],
                this.formEventoCamp.ndetalle = '',
                this.fillProveedor.nidproveedor = '',
                this.arrayElementoDistribucionEnvia = []
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
            this.tabBuscarEventoCampania();
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
    .direction-money{
        display: flex;
        justify-content: flex-end;
        align-items: flex-end;
        flex-direction: column;
    }
    .centrarbtn{
        display: flex;
        justify-content: center;
    }
    .flex-rigth-margin{
        display: flex;
        justify-content: space-around;
        align-content: space-around;
        flex-direction: column;
        align-items: flex-end;
        margin-right: 2rem;
    }
</style>
