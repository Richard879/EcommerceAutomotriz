<template>
    <main>
        <header class="page-header">
          <div class="container-fluid">
            <h2 class="no-margin-bottom">PROCESO DE INSPECCIÓN</h2>
          </div>
        </header>

        <template v-if="vistaFormulario">
            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h4">BUSCAR</h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal">
                                    <!--<div class="form-group row">
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
                                                <label class="col-sm-4 form-control-label">* Nombre</label>
                                                <div class="col-sm-8">
                                                    <input type="text" v-model="fillPunto.cnombre" @keyup.enter="listarPuntoInspeccion(1)" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
                                    <div class="form-group row">
                                        <div class="col-sm-9 offset-sm-5">
                                            <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarPuntoInspeccion(1)"><i class="fa fa-search"></i> Buscar</button>
                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="abrirFormulario('pdi','registrar')"><i class="fa fa-file-o"></i> Nuevo</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h4">LISTADO ITEMS</h3>
                            </div>
                            <div class="card-body">                   
                                <template v-if="arrayPuntoInspeccion.length">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Nombre</th>
                                                    <th>Tipo Movimiento</th>
                                                    <th>Ingreso Sucursal</th>
                                                    <th>Salida Sucursal</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="punto in arrayPuntoInspeccion" :key="punto.nIdPuntoInspeccion">
                                                    <td v-text="punto.nIdPuntoInspeccion"></td>
                                                    <td v-text="punto.cNombrePuntoInspeccion"></td>
                                                    <td v-text="punto.cFlagTipoMovimiento"></td>
                                                    <td v-text="punto.cFlagIngresoSucursal"></td>
                                                    <td v-text="punto.cFlagSalidaSucursal"></td>
                                                    <td>
                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                             <div slot="content">Editar {{ punto.cNombrePuntoInspeccion }}</div>
                                                             <i @click="abrirFormulario('puntoinspeccion','actualizar', punto)" :style="'color:#796AEE'" class="fa-md fa fa-edit"></i>
                                                        </el-tooltip>&nbsp;
                                                        <template v-if="punto.cSituacionRegistro=='A'">
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Desactivar {{ punto.cNombreTipoInspeccion }}</div>
                                                                <i @click="desactivar(punto.nIdPuntoInspeccion)" :style="'color:#796AEE'" class="fa-md fa fa-check-square"></i>
                                                            </el-tooltip>
                                                        </template>
                                                        <template v-else>
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Activar {{ punto.cNombreTipoInspeccion }}</div>
                                                                <i @click="activar(punto.nIdPuntoInspeccion)" :style="'color:red'" class="fa-md fa fa-square"></i>
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
                    </div>-->
                </div>
            </section>
        </template>

        <template v-else>
            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h4" v-text="tituloFormulario"></h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Solicitud Autorización</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" v-model="formPdi.csolicitudnombre" disabled="disabled" class="form-control form-control-sm">
                                                        <div class="input-group-prepend">
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Buscar Solicitud Autorización</div>
                                                                <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('pdi','solicitud')">
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
                                                <label class="col-sm-4 form-control-label">* Punto Inspección</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" v-model="formPdi.cnombrepuntoinspeccion" disabled="disabled" class="form-control form-control-sm">
                                                        <div class="input-group-prepend">
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Buscar Punto Inspección </div>
                                                                <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('pdi','puntoinspeccion')">
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
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-3 form-control-label">
                                                    <label class="checkbox-inline" v-for="tipo in arrayFlagVinPlaca" :key="tipo.value">
                                                        <input type="radio" class="radio-template" v-model="formPdi.nidflagvinplaca" :value="tipo.value" v-on:change="changeFlagVinPlaca()">
                                                        <label for="" class="form-control-label" v-text="tipo.text"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    </label>
                                                </label>
                                                <div class="col-sm-5">
                                                    <div class="input-group">
                                                        <input type="text" v-model="formPdi.cvinplacanombre" disabled="disabled" class="form-control form-control-sm">
                                                        <div class="input-group-prepend">
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Buscar Por Vin o Placa </div>
                                                                <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('pdi','vinplaca')">
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
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <label class="col-sm-3 form-control-label">Tipo Inspección</label>
                                                <div class="col-sm-5">
                                                    <el-select v-model="formPdi.nidtipoinspeccion" 
                                                                filterable 
                                                                placeholder="SELECCIONE">
                                                        <el-option
                                                        v-for="item in arrayTipoInspeccion"
                                                        :key="item.nIdTipoInspeccion"
                                                        :label="item.cNombreTipoInspeccion"
                                                        :value="item.nIdTipoInspeccion">
                                                        </el-option>
                                                    </el-select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                        <div slot="content">Ver Plantilla </div>
                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('pdi','plantilla')">
                                                            <i class="fa fa-eye"></i>&nbsp;Plantilla
                                                        </button>
                                                    </el-tooltip>
                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                        <div slot="content">Ver Accesorio </div>
                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('pdi','accesorio')">
                                                            <i class="fa fa-eye"></i>&nbsp;Accesorio
                                                        </button>
                                                    </el-tooltip>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Tipo Movimiento</label>
                                                <div class="col-sm-8">
                                                    <label class="checkbox-inline" v-for="tipo in arrayFlagTipoMovimiento" :key="tipo.value">
                                                        <input type="radio" class="radio-template" v-model="formPdi.nidflagmovimiento" :value="tipo.value">
                                                        <label for="" class="form-control-label" v-text="tipo.text"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Nro Inspección</label>
                                                <div class="col-sm-8">
                                                    <input type="text" v-model="formPdi.cnumeroinspeccion" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Fecha Inspección</label>
                                                <div class="col-sm-8">
                                                    <el-date-picker
                                                        v-model="formPdi.dfechainspeccion"
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
                                                <label class="col-sm-4 form-control-label">* Hora Inspección</label>
                                                <div class="col-sm-8">
                                                    <el-time-picker
                                                        v-model="formPdi.chorainspeccion"
                                                        value-format="HH:mm"
                                                        :picker-options="{
                                                        format: 'AM/PM'
                                                        }"
                                                        placeholder="Hora Inspección">
                                                    </el-time-picker>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Almacén</label>
                                                <div class="col-sm-8">
                                                    <el-select v-model="formPdi.nidalmacen" filterable placeholder="Select" >
                                                        <el-option
                                                        v-for="item in arrayAlmacen"
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
                                                <label class="col-sm-4 form-control-label">Fecha Mov. Almacén</label>
                                                <div class="col-sm-8">
                                                    <el-date-picker
                                                        v-model="formPdi.dfechaalmacen"
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
                                                <label class="col-sm-4 form-control-label">Conforme</label>
                                                <div class="col-sm-1">
                                                    <el-switch v-model="formPdi.nflagconformidad">
                                                    </el-switch>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" v-model="formPdi.cflagconformidaddescripcion" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Adjuntar</label>
                                                <div class="col-sm-8">
                                                    <input type="file" id="file-upload" @change="getFile" accept=".xls,.xlsx" class="form-control form-control-sm"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Observación</label>
                                                <div class="col-sm-8">
                                                   <textarea v-model="formPdi.cobservacion" class="form-control form-control-sm" cols="30" rows="6"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-9 offset-sm-5">
                                            <button type="button" v-if="accion==1" class="btn btn-success btn-corner btn-sm" @click="registrar()">
                                                <i class="fa fa-save"></i> Registrar
                                            </button>
                                            <button type="button" v-if="accion==2" class="btn btn-secondary btn-corner btn-sm" @click="actualizar()">
                                                <i class="fa fa-save"></i> Actualizar
                                            </button>
                                            <button type="button" class="btn btn-secundary btn-corner btn-sm" @click="cambiarVistaFormulario()">
                                                <i class="fa fa-close"></i> Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </template>

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

        <!-- MODAL SOLICITUD AUTORIZACION -->
        <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form v-on:submit.prevent class="form-horizontal">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTA SOLICITUDES</h3>
                                    </div>
                                    <div class="card-body">
                                        <!--<div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Nombre</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" v-model="fillItem.citemnombre" @keyup.enter="listarItems(1)" class="form-control form-control-sm">
                                                            <div class="input-group-prepend">
                                                                <button type="button" title="Buscar Items" class="btn btn-info btn-corner btn-sm" @click="listarItems(1)">
                                                                    <i class="fa-lg fa fa-search"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>-->
                                        <template v-if="arraySolicitud.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccione</th>
                                                            <th>Nro Solicitud</th>
                                                            <th>Tipo Solicitud</th>
                                                            <th>Estado Solicitud</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="sa in arraySolicitud" :key="sa.nIdSolicitudAutorizacion">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar {{ sa.cTipoSolicitud }}</div>
                                                                    <i @click="asignarSolicitud(sa.nIdSolicitudAutorizacion, sa.cNumeroSolicitud, sa.cTipoSolicitud)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td v-text="sa.cNumeroSolicitud"></td>
                                                            <td v-text="sa.cTipoSolicitud"></td>
                                                            <td v-text="sa.cEstadoSolicitud"></td>
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
                                                                    <a @click.prevent="cambiarPaginaSolicitud(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaSolicitud(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaSolicitud(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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

        <!-- MODAL PUNTO INSPECCIÓN -->
        <div class="modal fade" v-if="accionmodal==4" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form v-on:submit.prevent class="form-horizontal">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTA PUNTO DE INSPECCIÓN</h3>
                                    </div>
                                    <div class="card-body">
                                        <!--<div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Nombre</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" v-model="fillItem.citemnombre" @keyup.enter="listarItems(1)" class="form-control form-control-sm">
                                                            <div class="input-group-prepend">
                                                                <button type="button" title="Buscar Items" class="btn btn-info btn-corner btn-sm" @click="listarItems(1)">
                                                                    <i class="fa-lg fa fa-search"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>-->
                                        <template v-if="arrayPuntoInspeccion.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccione</th>
                                                            <th>Código</th>
                                                            <th>Nombre</th>
                                                            <th>Tipo Movimiento</th>
                                                            <th>Ingreso Sucursal</th>
                                                            <th>Salida Sucursal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="punto in arrayPuntoInspeccion" :key="punto.nIdSolicitudAutorizacion">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar {{ punto.cNombrePuntoInspeccion }}</div>
                                                                    <i @click="asignarPuntoInspeccion(punto.nIdPuntoInspeccion, punto.cNombrePuntoInspeccion)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td v-text="punto.nIdPuntoInspeccion"></td>
                                                            <td v-text="punto.cNombrePuntoInspeccion"></td>
                                                            <td v-text="punto.cFlagTipoMovimiento"></td>
                                                            <td v-text="punto.cFlagIngresoSucursal"></td>
                                                            <td v-text="punto.cFlagSalidaSucursal"></td>
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
                                                                    <a @click.prevent="cambiarPaginaPuntoInspeccion(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaPuntoInspeccion(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaPuntoInspeccion(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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

        <!-- MODAL VIN -->
        <div class="modal fade" v-if="accionmodal==5" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form v-on:submit.prevent class="form-horizontal">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTADO COMPRA</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Fecha Inicio</label>
                                                    <div class="col-sm-8">
                                                        <el-date-picker
                                                            v-model="fillCompra.dfechainicio"
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
                                                            v-model="fillCompra.dfechafin"
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
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Marca</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="fillCompra.nidmarca" filterable placeholder="Select" v-on:change="llenarComboModelo()">
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
                                                        <el-select v-model="fillCompra.nidmodelo" filterable placeholder="Select">
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
                                            <div class="col-sm-9 offset-sm-5">
                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarPorVin(1)">
                                                    <i class="fa fa-search"></i> Buscar
                                                </button>
                                            </div>
                                        </div>
                                        <hr/>
                                        <template v-if="arrayCompra.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccione</th>
                                                            <th>Código</th>
                                                            <th>Periodo</th>
                                                            <th>OC</th>
                                                            <th>Línea</th>
                                                            <th>Almacén<nav></nav></th>
                                                            <th>Nro Vin</th>
                                                            <th>Nombre Comercial</th>
                                                            <th>Año Fab</th>
                                                            <th>Año Mod</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="compra in arrayCompra" :key="compra.nIdCompra">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar {{ compra.cNumeroVin }}</div>
                                                                    <i @click="asignarVin(compra.nIdCompra, compra.cNumeroVin)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td v-text="compra.nIdCompra"></td>
                                                            <td v-text="compra.cNumeroMes + '-' + compra.cAnio"></td>
                                                            <td v-text="compra.nOrdenCompra"></td>
                                                            <td v-text="compra.cNombreLinea"></td>
                                                            <td v-text="compra.cNombreAlmacen"></td>
                                                            <td v-text="compra.cNumeroVin"></td>
                                                            <td v-text="compra.cNombreComercial"></td>
                                                            <td v-text="compra.nAnioFabricacion"></td>
                                                            <td v-text="compra.nAnioVersion"></td>
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
                                                                    <a @click.prevent="cambiarPaginaVin(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaVin(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaVin(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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

        <!-- MODAL PLANILLA -->
        <div class="modal fade" v-if="accionmodal==7" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form v-on:submit.prevent class="form-horizontal">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">PLANTILLA</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Área</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="formPlantilla.nidflag" filterable placeholder="Select" >
                                                            <el-option
                                                            v-for="item in arrayFlag"
                                                            :key="item.nIdPar"
                                                            :label="item.cParNombre"
                                                            :value="item.nIdPar">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <!--<div class="row">
                                                    <label class="col-sm-4 form-control-label">Agregar Item</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" v-model="formPlantilla.citemnombre" disabled="disabled" class="form-control form-control-sm">
                                                            <div class="input-group-prepend">
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Buscar Item </div>
                                                                    <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('item','buscar')">
                                                                        <i class="fa-lg fa fa-search"></i>
                                                                    </button>
                                                                </el-tooltip>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>-->
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9 offset-sm-5">
                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarSeccion()">
                                                    <i class="fa fa-search"></i> Buscar
                                                </button>
                                            </div>
                                        </div>
                                        <hr/>
                                        <template v-if="arraySeccion.length > 0">  
                                            <li v-for="seccion in arraySeccion" :key="seccion.nIdSeccion">{{ seccion.cSeccionNombre }}
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <tbody>
                                                            <tr v-for="(item, index) in arrayItems" :key="item.nIdPlantillaInspeccionSeccionItem">
                                                                <td v-if="item.nIdSeccion==seccion.nIdSeccion" v-text="item.cItemNombre"></td>
                                                                <td v-if="item.nIdSeccion==seccion.nIdSeccion">
                                                                    <span class="switch">
                                                                        <el-switch v-model="arrayIndexFlagMarca[index]">
                                                                        </el-switch>
                                                                    </span>
                                                                </td>
                                                                <td v-if="item.nIdSeccion==seccion.nIdSeccion">
                                                                    <input type="text" v-if="arrayIndexFlagMarca[index]" v-model="arrayIndexDescripcion[index]" class="form-control form-control-sm">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </li>
                                            <div class="form-group row">
                                                <div class="col-sm-9 offset-sm-5">
                                                    <button type="button" v-if="accion==1" class="btn btn-success btn-corner btn-sm" @click="aceptarPlantilla()">
                                                        <i class="fa fa-save"></i> Aceptar
                                                    </button>
                                                    <button type="button" class="btn btn-secundary btn-corner btn-sm" @click="cerrarModal()">
                                                        <i class="fa fa-close"></i> Cerrar
                                                    </button>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL ACCESORIO -->
        <div class="modal fade" v-if="accionmodal==8" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form v-on:submit.prevent class="form-horizontal">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">ACCESORIOS</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Nombre</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" v-model="fillAccesorio.cnombre" @keyup.enter="listarAccesorio(1)" class="form-control form-control-sm">
                                                            <div class="input-group-prepend">
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Buscar Accesorio </div>
                                                                    <button type="button" class="btn btn-info btn-corner btn-sm" @click="listarAccesorio(1)">
                                                                        <i class="fa-lg fa fa-search"></i>
                                                                    </button>
                                                                </el-tooltip>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>
                                        <template v-if="arrayAccesorio.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccione</th>
                                                            <th>Nombre Proveedor</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="a in arrayAccesorio" :key="a.nIdPar">
                                                            <td v-text="a.cParNombre"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-9 offset-sm-5">
                                                    <button type="button" v-if="accion==1" class="btn btn-success btn-corner btn-sm" @click="aceptarPlantilla()">
                                                        <i class="fa fa-save"></i> Aceptar
                                                    </button>
                                                    <button type="button" class="btn btn-secundary btn-corner btn-sm" @click="cerrarModal()">
                                                        <i class="fa fa-close"></i> Cerrar
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
                        </form>
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
                csucursal: sessionStorage.getItem("cNombreSucursal"),
                formPdi:{
                    nidcabecerainspeccion: 0,
                    nidsolicitud: 0,
                    csolicitudnombre: '',
                    nidflagvinplaca: 1,
                    cvinplacanombre: '',
                    nidcompra: 0,
                    nidvehiculoplaca: 0,
                    nidpuntoinspeccion: 0,
                    cnombrepuntoinspeccion: '',
                    nidtipoinspeccion: '',
                    nidflagmovimiento: 1,
                    cnumeroinspeccion: '',
                    nidalmacen: 0,
                    dfechainspeccion: '',
                    chorainspeccion: '',
                    nidalmacen: 0,
                    dfechaalmacen: '',
                    nflagconformidad: 0,
                    cflagconformidaddescripcion: '',
                    cobservacion: '',
                },
                arraySolicitud: [],
                arrayPuntoInspeccion: [],
                arrayTipoInspeccion: [],
                arrayAlmacen: [],
                arrayFlagVinPlaca: [
                    { value: '1', text: 'Nro Vin'},
                    { value: '2', text: 'Placa'}
                ],
                arrayFlagTipoMovimiento: [
                    { value: '1', text: 'Ingreso'},
                    { value: '2', text: 'Salida'}
                ],
                // ============================================
                // ============ MODAL COMPRA =================
                fillCompra:{
                    dfechainicio: '',
                    dfechafin: '',
                    nordencompra: '',
                    cnumerovin: '',
                    nidmarca: 0,
                    nidmodelo: 0
                },
                arrayCompra: [],
                arrayMarca: [],
                arrayModelo: [],
                // ============================================
                // ============ MODAL PLANILLA =================
                formPlantilla:{
                    nidflag: 0,
                    cdescripcion: ''
                },
                arrayPlantilla: [],
                arraySeccion: [],
                arrayItems: [],
                arrayFlag: [],
                arrayIndexFlagMarca: [],  
                arrayIndexDescripcion: [],
                // ============ MODAL ACCESORIO =================
                fillAccesorio:{
                    cnombre: ''
                },
                arrayAccesorio: [],
                // ============================================
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
                tituloModal:'',
                tituloFormulario: '',
                accionmodal: 0,
                error: 0,
                errors: [],
                mensajeError: [],
                vistaFormulario: 1,
                validaAccionModal: 0
            }
        },
         mounted(){
            this.llenarTipoInspeccion();
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
            llenarComboTipoInspeccion(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110084,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayTipoMovimiento = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarFlag(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110085,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayFlag = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            //============================================================
            //================= BUSQUEDA INSPECCION =======================
            listarPuntoInspeccion(page){
                this.mostrarProgressBar();
                var url = this.ruta + '/puntoinspeccion/GetListPuntoInspeccion';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidsucursal': sessionStorage.getItem("nIdSucursal"),
                        'cnombre': this.fillPunto.cnombre,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayPuntoInspeccion = response.data.arrayPuntoInspeccion.data;
                    this.paginationModal.current_page =  response.data.arrayPuntoInspeccion.current_page;
                    this.paginationModal.total = response.data.arrayPuntoInspeccion.total;
                    this.paginationModal.per_page    = response.data.arrayPuntoInspeccion.per_page;
                    this.paginationModal.last_page   = response.data.arrayPuntoInspeccion.last_page;
                    this.paginationModal.from        = response.data.arrayPuntoInspeccion.from;
                    this.paginationModal.to           = response.data.arrayPuntoInspeccion.to;
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarTipoInspeccion(page);
            },
            //=============================================================
            //==================== NUEVA INSPECCION =======================
            listarSolicitud(page){
                var url = this.ruta + '/pdi/GetListSolicitudByEstado';

                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidsucursal' : sessionStorage.getItem("nIdSucursal"),
                        'nidestadosolicitud' : 1300240,
                        'page' : page
                    }
                }).then(response => {
                    this.arraySolicitud = response.data.arraySolicitud.data;
                    this.paginationModal.current_page =  response.data.arraySolicitud.current_page;
                    this.paginationModal.total = response.data.arraySolicitud.total;
                    this.paginationModal.per_page    = response.data.arraySolicitud.per_page;
                    this.paginationModal.last_page   = response.data.arraySolicitud.last_page;
                    this.paginationModal.from        = response.data.arraySolicitud.from;
                    this.paginationModal.to           = response.data.arraySolicitud.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaSolicitud(page){
                this.paginationModal.current_page=page;
                this.listarSolicitud(page);
            },
            asignarSolicitud(nIdSolicitudAutorizacion, cNumeroSolicitud, cTipoSolicitud){
                this.formPdi.nidsolicitud = nIdSolicitudAutorizacion;
                this.formPdi.csolicitudnombre = cNumeroSolicitud + ' - ' + cTipoSolicitud;
                this.cerrarModal();
            },
            //=============== PUNTO INSPECCION ===================
            listarPuntoInspeccion(page){
                var url = this.ruta + '/puntoinspeccion/GetListPuntoInspeccion';

                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidsucursal': sessionStorage.getItem("nIdSucursal"),
                        'cnombre': '',
                        'page' : page
                    }
                }).then(response => {
                    this.arrayPuntoInspeccion = response.data.arrayPuntoInspeccion.data;
                    this.paginationModal.current_page =  response.data.arrayPuntoInspeccion.current_page;
                    this.paginationModal.total = response.data.arrayPuntoInspeccion.total;
                    this.paginationModal.per_page    = response.data.arrayPuntoInspeccion.per_page;
                    this.paginationModal.last_page   = response.data.arrayPuntoInspeccion.last_page;
                    this.paginationModal.from        = response.data.arrayPuntoInspeccion.from;
                    this.paginationModal.to           = response.data.arrayPuntoInspeccion.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaPuntoInspeccion(page){
                this.paginationModal.current_page=page;
                this.listarPuntoInspeccion(page);
            },
            asignarPuntoInspeccion(nIdPuntoInspeccion, cNombrePuntoInspeccion){
                this.formPdi.nidpuntoinspeccion = nIdPuntoInspeccion;
                this.formPdi.cnombrepuntoinspeccion = cNombrePuntoInspeccion;
                this.cerrarModal();
            },
            //=============== TIPO INSPECCION ===================
            llenarTipoInspeccion(page){
                var url = this.ruta + '/tipoinspeccion/GetListTipoInspeccion';

                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'cnombre': '',
                        'page': page
                    }
                }).then(response => {
                    this.arrayTipoInspeccion = response.data.arrayTipoInspeccion.data;
                    this.pagination.current_page =  response.data.arrayTipoInspeccion.current_page;
                    this.pagination.total = response.data.arrayTipoInspeccion.total;
                    this.pagination.per_page    = response.data.arrayTipoInspeccion.per_page;
                    this.pagination.last_page   = response.data.arrayTipoInspeccion.last_page;
                    this.pagination.from        = response.data.arrayTipoInspeccion.from;
                    this.pagination.to           = response.data.arrayTipoInspeccion.to;
                }).catch(error => {
                    this.errors = error
                });
            },
            llenarAlmacen(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110088,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayAlmacen = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            //=============== LISTAR MODAL POR VIN ===================
            listarPorVin(page){
                if(this.fillCompra.nordencompra == ''){
                    var nordencompra = 0;
                }
                else{
                    var nordencompra = this.fillCompra.nordencompra;
                }

                var url = this.ruta + '/pdi/GetListCompra';

                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidsucursal' : sessionStorage.getItem("nIdSucursal"),
                        'dfechainicio' : this.fillCompra.dfechainicio,
                        'dfechafin' : this.fillCompra.dfechafin,
                        'nordencompra' : nordencompra,
                        'cnumerovin' : this.fillCompra.cnumerovin,
                        'nidmarca': this.fillCompra.nidmarca,
                        'nidmodelo': this.fillCompra.nidmodelo,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayCompra = response.data.arrayCompra.data;
                    this.paginationModal.current_page =  response.data.arrayCompra.current_page;
                    this.paginationModal.total = response.data.arrayCompra.total;
                    this.paginationModal.per_page    = response.data.arrayCompra.per_page;
                    this.paginationModal.last_page   = response.data.arrayCompra.last_page;
                    this.paginationModal.from        = response.data.arrayCompra.from;
                    this.paginationModal.to           = response.data.arrayCompra.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaVin(page){
                this.paginationModal.current_page=page;
                this.listarPorVin(page);
            },
            asignarVin(nIdCompra, cNumeroVin){
                this.formPdi.nidcompra = nIdCompra;
                this.formPdi.cvinplacanombre = cNumeroVin;
                this.cerrarModal();
            },
            llenarComboMarca(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110032,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayMarca = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboModelo(){
                var url = this.ruta + '/versionvehiculo/GetModeloByMarca';

                axios.get(url,{
                    params: {
                        'nidmarca' : this.fillCompra.nidmarca
                    }
                }).then(response => {
                    this.arrayModelo = response.data;
                    this.fillCompra.nidmodelo = 0;
                }).catch(error => {
                    console.log(error);
                });
            },
            changeFlagVinPlaca(){
                this.formPdi.cvinplacanombre = '';
                this.formPdi.nidcompra = 0;
            },
            //=============== LISTAR MODAL POR PLACA ===================
            listarPorPlaca(page){

            },
            //=============== LISTAR MODAL PLANTILLA ===================
            listarSeccion(){
                var url = this.ruta + '/pdi/GetListSeccion';
                axios.get(url, {
                    params: {
                        'nidempresa' : 1300011,
                        'nidtipoinspeccion' : this.formPdi.nidtipoinspeccion,
                        'nidflag': this.formPlantilla.nidflag
                    }
                }).then(response => {
                    this.arraySeccion = response.data;
                    this.listarItems();
                }).catch(error => {
                    console.log(error);
                });
            },
            listarItems(){
                var url = this.ruta + '/pdi/GetListItem';
                axios.get(url, {
                    params: {
                        'nidempresa' : 1300011,
                        'nidtipoinspeccion' : this.formPdi.nidtipoinspeccion,
                        'nidflag': this.formPlantilla.nidflag
                    }
                }).then(response => {
                    this.arrayItems = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarFlag(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110080,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayFlag = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            aceptarPlantilla(){
                let me = this;

                me.arrayPlantilla = [];

                me.arrayItems.map(function(value, key){
                    me.arrayPlantilla.push({
                        nIdPlantillaInspeccionSeccionItem: value.nIdPlantillaInspeccionSeccionItem,
                        nFlagMarca: me.arrayIndexFlagMarca[key],
                        cDescripcionNoConformidad: me.arrayIndexDescripcion[key]
                    });
                    alert(me.arrayIndexFlagMarca[key]);
                });
            },
            //=============== LISTAR MODAL ACCESORIO ===================
            listarAccesorio(){
                var url = this.ruta + '/parametro/GetParametroByNombre';
                
                axios.get(url, {
                    params: {
                        'ngrupoparid': 110089,
                        'cparnombre': this.fillAccesorio.cnombre
                    }
                }).then(response => {
                    this.arrayAccesorio = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            //=============== ADJUNTAR DOCUMENTO ===================
            getFile(e){
                //console.log(e);
                let selectFile = e.target.files[0];
                this.attachment = selectFile;
                //this.textFile = e.target.files[0].name;
            },
            //================= REGISTRO =======================
            registrar(){
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/puntoinspeccion/SetPuntoInspeccion';    
                axios.post(url, {
                    nIdEmpresa: 1300011,
                    nIdSucursal: sessionStorage.getItem("nIdSucursal"),
                    cNombrePuntoInspeccion: this.formPdi.cnombre,
                    nFlagTipoMovimiento: this.formPdi.nidflagmovimiento,
                    nFlagIngresoSucursal: this.formPdi.nidflagingreso,
                    nFlagSalidaSucursal: this.formPdi.nidflagsalida
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Item Agregado registrada');
                        this.vistaFormulario = 1;
                        //this.listarItemPlantilla();
                    }
                    else{
                        swal('Ya existe Item');
                    }
                }).catch(error => {
                    console.log(error);
                });
            },
            validar(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.formPdi.cnombre){
                    this.mensajeError.push('Debes Seleccionar Sección');
                };
                if(this.formPdi.nFlagIngresoSucursal == 0){
                    this.mensajeError.push('Debes Seleccionar Ingreso Sucursal');
                };
                if(this.formPdi.nFlagSalidaSucursal == 0){
                    this.mensajeError.push('Debes Seleccionar Salida Sucursal');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            activar(nIdPuntoInspeccion){
                swal({
                    title: 'Estas seguro de activar este Punto Inspección?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Activar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.value) {
                        var url = this.ruta + '/puntoinspeccion/activar';
                        axios.put(url , {
                            nIdPuntoInspeccion: nIdPuntoInspeccion
                        }).then(response => {
                            swal(
                            'Activado!',
                            'El registro fue activado.'
                            );
                            this.listarPuntoInspeccion(1);
                            this.vistaFormulario = 1;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel){}
                })
            },
            desactivar(nIdPuntoInspeccion){
                swal({
                    title: 'Estas seguro de desactivar este Punto Inspección?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Desactivar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.value) {
                        var url = this.ruta + '/puntoinspeccion/desactivar';
                        axios.put(url , {
                            nIdPuntoInspeccion: nIdPuntoInspeccion
                        }).then(response => {
                            swal(
                            'Desactivado!',
                            'El registro fue desactivado.'
                            );
                            this.listarPuntoInspeccion(1);
                            this.vistaFormulario = 1;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel){}
                })
            },
            actualizar(){
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/puntoinspeccion/UpdPuntoInspeccionById';            
                axios.post(url, {
                    nIdPuntoInspeccion: parseInt(this.formPdi.nidpuntoinspeccion),
                    nIdEmpresa: 1300011,
                    nIdSucursal: sessionStorage.getItem("nIdSucursal"),
                    cNombrePuntoInspeccion: this.formPdi.cnombre,
                    nFlagTipoMovimiento: this.formPdi.nidflagmovimiento,
                    nFlagIngresoSucursal: this.formPdi.nidflagingreso,
                    nFlagSalidaSucursal: this.formPdi.nidflagsalida
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Punto Inspección Actualizado');
                        //this.limpiarFormulario();
                        this.vistaFormulario = 1;
                        this.listarPuntoInspeccion(1);
                    }
                    else{
                        swal('Ya existe Punto Inspección');
                    }
                }).catch(error => {
                    console.log(error);
                });
            },
            abrirFormulario(modelo, accion, data =[]){
                switch(modelo){
                    case 'pdi':
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.vistaFormulario = 0;
                                this.accion = 1;
                                this.tituloFormulario = 'NUEVO PROCESO DE INSPECCIÓN';
                                this.llenarTipoInspeccion();
                                this.llenarAlmacen();
                                this.limpiarFormulario();
                                break;
                            }
                            case 'actualizar':
                            {
                                this.vistaFormulario = 0;
                                this.accion = 2;
                                this.tituloFormulario = 'ACTUALIZAR PUNTO DE INSPECCIÓN';
                                this.formPdi.nidpuntoinspeccion = data['nIdPuntoInspeccion'];
                                this.formPdi.cnombre = data['cNombrePuntoInspeccion'];
                                this.formPdi.nidflagmovimiento = (data['nFlagTipoMovimiento'] == 0 ? 0 : data['nFlagTipoMovimiento']);
                                this.formPdi.nidflagingreso = data['nFlagIngresoSucursal'];
                                this.formPdi.nidflagsalida = data['nFlagSalidaSucursal'];
                                break;
                            }
                        }
                    }
                }
            },
            cerrarModal(){
                this.modal = 0
                this.error = 0,
                this.mensajeError = ''
            },
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case 'pdi':
                    {
                        switch(accion){
                            case 'solicitud':
                            {
                                this.accionmodal=3;
                                this.modal = 1;
                                this.listarSolicitud(1);
                                break;
                            }
                            case 'puntoinspeccion':
                            {
                                this.accionmodal=4;
                                this.modal = 1;
                                this.listarPuntoInspeccion(1);
                                break;
                            }
                            case 'vinplaca':
                            {
                                if(this.formPdi.nidflagvinplaca == 1){
                                    this.accionmodal=5;
                                    this.modal =1;
                                    this.llenarComboMarca();
                                    this.llenarComboModelo();
                                    //this.listarPorVin(1);
                                }
                                else{
                                    this.accionmodal=6;
                                    this.modal =1;
                                    this.listarPorPlaca(1);
                                }
                                break;
                            }
                            case 'plantilla':
                            {
                                this.validaAccionModal = 7;

                                if(this.validarMostrarModal()){
                                    this.accionmodal=1;
                                    this.modal = 1;
                                    return;
                                }

                                this.accionmodal=7;
                                this.modal = 1;
                                this.llenarFlag();
                                break;
                            }
                            case 'accesorio':
                            {
                                this.accionmodal=8;
                                this.modal = 1;
                                this.listarAccesorio();
                                break;
                            }
                        }
                    }
                }
            },
            validarMostrarModal(){
                this.error = 0;
                this.mensajeError =[];

                //================ MODAL PLANILLA ==================
                if(this.validaAccionModal == 7){
                    if(this.formPdi.nidtipoinspeccion == 0 || this.formPdi.nidtipoinspeccion == 0){
                        this.mensajeError.push('Debes Seleccionar Tipo Inspección');
                    }
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            limpiarFormulario(){
                /*this.formPdi.nidpuntoinspeccion= 0,
                this.formPdi.cnombre= '',
                this.formPdi.nidflagmovimiento= 0,
                this.formPdi.nidflagingreso=  0,
                this.formPdi.nidflagsalida= 0*/
            },
            cambiarVistaFormulario(){
                this.vistaFormulario = 1;
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
        .disabled{
            opacity: 0.65;
            cursor: not-allowed;
            pointer-events:none;
        }
</style>