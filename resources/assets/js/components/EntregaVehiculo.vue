<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">ENTREGA DE VEHÍCULO</h2>
                </div>
            </header>

            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tab01" href="#TabMisInspecciones" role="tab" @click.prevent="tabMisInspecciones" data-toggle="tab">
                                            <i class="fa fa-search"></i> MIS VEHÍCULOS
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="tab02" href="#TaEntregaVehiculo" role="tab" data-toggle="tab">
                                            <i class="fa fa-list-alt"></i> ENTREGAR VEHÍCULO
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active show" id="TabMisInspecciones">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">BUSCAR VEHÍCULOS.</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <div class="form-group row">
                                                                    <div class="col-md-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Placa</label>
                                                                            <div class="col-md-8 widthFull">
                                                                                <div class="input-group">
                                                                                    <el-input placeholder="Buscar Placa" v-model="fillBusquedaVehiculo.cnrovehiculo" :disabled="true" class="input-with-select" :clearable="true">
                                                                                        <el-button slot="append" icon="el-icon-search" @click="abrirModal('vehiculo','buscar', 2)"></el-button>
                                                                                    </el-input>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Fecha Solicitud</label>
                                                                            <div class="col-sm-8">
                                                                                <el-date-picker
                                                                                    v-model="fillBusquedaVehiculo.dfechaSolicitud"
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
                                                                            <label class="col-md-4 form-control-label">*Estado</label>
                                                                            <div class="col-md-8 widthFull">
                                                                                <el-select v-model="fillBusquedaVehiculo.nidestado"
                                                                                        filterable
                                                                                        clearable
                                                                                        loading-text
                                                                                        placeholder="Seleccione un Estado">
                                                                                    <el-option
                                                                                        v-for="estado in arrayEstado"
                                                                                        :key="estado.nIdPar"
                                                                                        :label="estado.cParNombre"
                                                                                        :value="estado.cParAbreviatura">
                                                                                    </el-option>
                                                                                </el-select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-9 offset-md-5">
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="buscarMisInspecciones(1)">
                                                                            <i class="fa fa-search"></i> Buscar
                                                                        </button>
                                                                        <button type="button" class="btn btn-default btn-corner btn-sm" @click.prevent="limpiarMisMisInspecciones()">
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
                                                            <h3 class="h4">LISTADO</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <div class="col-lg-12">
                                                                    <template v-if="arrayInspeccionesAprobadas.length">
                                                                        <div class="table-responsive barraLateral">
                                                                            <el-table v-loading="loading" :data="arrayInspeccionesAprobadas" style="width: 100%">
                                                                                <el-table-column  property="dFechaInspeccion" label="Fecha Inpsección"   width="100"></el-table-column>
                                                                                <el-table-column  property="cHoraInspeccion" label="Hora Inspección"   width="95"></el-table-column>
                                                                                <el-table-column  property="cPlaca" label="Placa" width="95"></el-table-column>
                                                                                <el-table-column  property="encargado" label="Encargado" width="150"></el-table-column>
                                                                                <el-table-column  property="cNumeroSolicitud" label="Ref.Solicitud Entrega" width="130"></el-table-column>
                                                                                <el-table-column  property="dFechaEntregaVehiculo" label="Fecha Entrega" width="100"></el-table-column>
                                                                                <el-table-column  property="cHoraEntregaVehiculo" label="Hora de Entrega" show-overflow-tooltip></el-table-column>
                                                                                <el-table-column  fixed="right" label="Acciones"   width="150">
                                                                                    <template slot-scope="scope">
                                                                                        <template v-if="scope.row.dFechaEntregaVehiculo != null">
                                                                                            <el-tooltip class="item" effect="dark" :content="'Ver Archivos Adjuntos : ' + scope.row.cPlaca " placement="top-start">
                                                                                                <el-button @click="abrirModal('entregavehiculo', 'mostrar', scope.row)"><i class="fa fa-file"></i></el-button>
                                                                                            </el-tooltip>
                                                                                        </template>
                                                                                        <template v-if="scope.row.cFlagEntregado == null">
                                                                                            <el-tooltip class="item" effect="dark" content="Editar" placement="top-start">
                                                                                                <el-button @click="tabEntregaVehiculo(scope.row)"><i class="fa fa-edit"></i></el-button>
                                                                                            </el-tooltip>
                                                                                        </template>
                                                                                    </template>
                                                                                </el-table-column>
                                                                            </el-table>
                                                                            <div class="col-lg-12">
                                                                                <div class="row">
                                                                                    <div class="col-lg-7">
                                                                                        <nav>
                                                                                            <ul class="pagination">
                                                                                                <li v-if="pagination.current_page > 1" class="page-item">
                                                                                                    <a @click.prevent="cambiarPaginaMisInspecciones(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                                </li>
                                                                                                <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                                :class="[page==isActived?'active':'']">
                                                                                                    <a class="page-link"
                                                                                                    href="#" @click.prevent="cambiarPaginaMisInspecciones(page)"
                                                                                                    v-text="page"></a>
                                                                                                </li>
                                                                                                <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                                    <a @click.prevent="cambiarPaginaMisInspecciones(pagination.current_page+1)" class="page-link" href="#">Sig</a>
                                                                                                </li>
                                                                                            </ul>
                                                                                        </nav>
                                                                                    </div>
                                                                                    <div class="col-lg-5">
                                                                                        <div class="datatable-info">Mostrando {{ pagination.from }} a {{ pagination.to }} de {{ pagination.total }} registros</div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </template>
                                                                    <template v-else>
                                                                        <tr>
                                                                            <td>No existen registros</td>
                                                                        </tr>
                                                                    </template>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="TaEntregaVehiculo">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">ENTREGAR VEHÍCULO.</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Fecha Entrega</label>
                                                                            <div class="col-sm-8">
                                                                                <el-date-picker
                                                                                    v-model="fillEntregaVehiculo.dfechaEntrega"
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
                                                                            <label class="col-sm-4 form-control-label">Hora Entrega</label>
                                                                            <div class="col-sm-8 widthFull">
                                                                                <el-time-picker
                                                                                    v-model="fillEntregaVehiculo.cHoraEntrega"
                                                                                    value-format="HH:mm"
                                                                                    :picker-options="{
                                                                                        format: 'AM/PM'
                                                                                    }"
                                                                                    placeholder="Hora de Entrega">
                                                                                </el-time-picker>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-8">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Persona que recibe </label>
                                                                            <div class="col-sm-8">
                                                                                <el-row>
                                                                                    <div class="input-group">
                                                                                        <el-input placeholder="Persona que se le entregará el vehículo"
                                                                                                  v-model="fillEntregaVehiculo.cNombrePersonaRecibe"
                                                                                                  :disabled="true"
                                                                                                  class="input-with-select">
                                                                                            <el-button slot="append" icon="el-icon-search"  @click="abrirModal('contacto','buscar', 2)"></el-button>
                                                                                        </el-input>
                                                                                    </div>
                                                                                    <el-button type="primary" icon="el-icon-circle-plus"  @click="abrirModal('contacto','nuevo', 110083)" circle></el-button>
                                                                                </el-row>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                         <div class="row">
                                                                             <label class="col-sm-6 form-control-label" v-text="fillEntregaVehiculo.fConforme ? 'Conforme' : 'No  Conforme'"></label>
                                                                             <div class="col-sm-5 widthFull">
                                                                                 <el-switch
                                                                                    v-model="fillEntregaVehiculo.fConforme"
                                                                                    active-color="#13ce66"
                                                                                    inactive-color="#ff4949">
                                                                                </el-switch>
                                                                             </div>
                                                                         </div>
                                                                         <div class="row">
                                                                             <label class="col-sm-6 form-control-label"><i class="fa fa-facebook-square"></i> Permiso Facebook</label>
                                                                             <div class="col-sm-5 widthFull">
                                                                                 <el-switch
                                                                                    v-model="fillEntregaVehiculo.fFacebook"
                                                                                    active-color="#13ce66"
                                                                                    inactive-color="#ff4949">
                                                                                </el-switch>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                     <div class="col-sm-12">
                                                                         <div class="row">
                                                                            <input type="file" multiple="multiple" id="attachments" @change="uploadFieldChange" class="form-control form-control-sm"/>
                                                                         </div>
                                                                         <div class="row upload">
                                                                             <div class="attachment-holder animated fadeIn" v-cloak v-for="(attachment, index) in attachments" :key="index">
                                                                                 <el-alert
                                                                                    :title="' (' + String(index+1) + ') '"
                                                                                    type="success"
                                                                                    :closable="false">
                                                                                    <span class="h6">{{ attachment.name + ' (' + Number((attachment.size / 1024 / 1024).toFixed(1)) + 'MB)'}}</span>
                                                                                    <el-button @click.prevent="removeAttachment(attachment)" type="danger" size="mini" icon="el-icon-delete" circle></el-button>
                                                                                </el-alert>
                                                                            </div>
                                                                        </div>
                                                                     </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-9 offset-md-5">
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="registrarEntregaVehiculo">
                                                                            <i class="fa fa-save"></i> Registrar
                                                                        </button>
                                                                        <button type="button" class="btn btn-default btn-corner btn-sm" @click.prevent="limpiarEntregaVehiculo">
                                                                            <i class="fa fa-recycle"></i> Limpiar
                                                                        </button>
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

            <!-- Modal Buscar Vehiculos -->
            <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form v-on:submit.prevent class="form-horizontal">
                                <div class="container-fluid">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="h4">BUSQUEDA VEHICULO POR PLACA </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <label class="col-sm-4 form-control-label">Nombre</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group">
                                                                        <input type="text" v-model="modalVehiculo.cnrovehiculo" @keyup.enter="listarVehiculo(1)" class="form-control form-control-sm">
                                                                        <div class="input-group-prepend">
                                                                            <button type="button" title="Buscar Vehiculos" class="btn btn-info btn-corner btn-sm" @click="listarVehiculo(1);">
                                                                                <i class="fa-lg fa fa-search"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <template v-if="arrayVehiculosByCriterio.length">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Seleccione</th>
                                                                        <th>Placa</th>
                                                                        <th>Nombre Comercial</th>
                                                                        <th>Año / Mes</th>
                                                                        <th>Linea</th>
                                                                        <th>Forma de Pago</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="vehiculo in arrayVehiculosByCriterio" :key="vehiculo.cPlaca">
                                                                        <td>
                                                                            <a href="#" @click="asignarVehiculo(vehiculo)" data-toggle="tooltip">
                                                                                <i class='fa-md fa fa-check-circle'></i>
                                                                            </a>
                                                                        </td>
                                                                        <td v-text="vehiculo.cPlaca"></td>
                                                                        <td v-text="vehiculo.cNombreComercial"></td>
                                                                        <td> {{ vehiculo.cAnio }} / {{ vehiculo.cMes }} </td>
                                                                        <td v-text="vehiculo.cNombreLinea"></td>
                                                                        <td v-text="vehiculo.cFormaPago"></td>
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
                                                                                <a @click.prevent="cambiarPaginaVehiculosByCriterio(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                            </li>
                                                                            <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                            :class="[page==isActivedModal?'active':'']">
                                                                                <a class="page-link"
                                                                                href="#" @click.prevent="cambiarPaginaVehiculosByCriterio(page)"
                                                                                v-text="page"></a>
                                                                            </li>
                                                                            <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaVehiculosByCriterio(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModalSolicitud()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Buscar Contactos -->
            <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form v-on:submit.prevent class="form-horizontal">
                                <div class="container-fluid">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="h4">BUSQUEDA CONTACTOS</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-lg-12">
                                                    <form class="form-horizontal">
                                                        <div class="form-group row">
                                                            <div class="col-sm-6">
                                                                <div class="row">
                                                                    <label class="col-sm-4 form-control-label">* Nro Documento</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" v-model="modalMisContactos.cnrodocumento" @keyup.enter="listarContactos(1)" class="form-control form-control-sm">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="row">
                                                                    <label class="col-sm-4 form-control-label">* Nombres</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" v-model="modalMisContactos.cfiltrodescripcion" @keyup.enter="listarContactos(1)" class="form-control form-control-sm">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-9 offset-sm-5">
                                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarContactos(1);">
                                                                    <i class="fa fa-search"></i> Buscar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-lg-12">
                                                    <template v-if="arrayContacto.length">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-sm">
                                                                <template v-if="modalMisContactos.ntipopersona == 1">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Acciones</th>
                                                                            <th>Contacto</th>
                                                                            <th>Nro Documento</th>
                                                                            <th>Telefono</th>
                                                                            <th>Dirección</th>
                                                                            <th>Email</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr v-for="c in arrayContacto" :key="c.nIdAsignacionContactoVendedor">
                                                                            <td>
                                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                    <div slot="content">Seleccionar Contacto</div>
                                                                                    <i @click.prevent="abrirModal('contacto', 'asignar', c)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                                </el-tooltip>
                                                                            </td>
                                                                            <td v-text="c.cContacto"></td>
                                                                            <td v-text="c.cNumeroDocumento"></td>
                                                                            <td v-text="c.nTelefonoMovil"></td>
                                                                            <td v-text="c.cDireccion"></td>
                                                                            <td v-text="c.cEmail"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </template>
                                                                <template v-else>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Acciones</th>
                                                                            <th>Razon Social</th>
                                                                            <th>Nro Documento</th>
                                                                            <th>Telefono</th>
                                                                            <th>Email</th>
                                                                            <th>Persona Contacto</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr v-for="c in arrayContacto" :key="c.nIdAsignacionContactoVendedor">
                                                                            <td>
                                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                    <div slot="content">Seleccionar Contacto</div>
                                                                                    <i @click.prevent="abrirModal('contacto', 'asignar', c)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                                </el-tooltip>
                                                                            </td>
                                                                            <td v-text="c.cRazonSocial"></td>
                                                                            <td v-text="c.cNumeroDocumento"></td>
                                                                            <td v-text="c.nTelefonoMovil"></td>
                                                                            <td v-text="c.cEmail"></td>
                                                                            <td v-text="c.cContacto"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </template>
                                                            </table>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-lg-7">
                                                                    <nav>
                                                                        <ul class="pagination">
                                                                            <li v-if="paginationModal.current_page > 1" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaMisContactos(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                            </li>
                                                                            <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                            :class="[page==isActivedModal?'active':'']">
                                                                                <a class="page-link"
                                                                                href="#" @click.prevent="cambiarPaginaMisContactos(page)"
                                                                                v-text="page"></a>
                                                                            </li>
                                                                            <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaMisContactos(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModalSolicitud()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Show Archivos Adjuntos -->
            <div class="modal fade" v-if="accionmodal==4" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title">Archivos Adjuntos</h2>
                            <button type="button" class="close" @click="cerrarModalSolicitud" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="text-center">
                                                            <div v-for="e in mensajeError" :key="e" v-text="e"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div v-for="archivos in arrayArchivosAdjuntos" :key="archivos.nIdDocumentoAdjunto">
                                                            <a :href="archivos.cRutaDocumento" target="_blank" class="listaArchivosAdjuntos">
                                                                <el-alert
                                                                    :title="archivos.cArchivo"
                                                                    type="success"
                                                                    :closable="false"
                                                                    show-icon>
                                                                </el-alert>
                                                            </a>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModalSolicitud">Cerrar</button>
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
                // =============================================================
                // VARIABLES TAB INSPECCIONES
                // =============================================================
                fillBusquedaVehiculo: {
                    nidempresa: 1300011,
                    cempresa: sessionStorage.getItem("cNombreEmpresa"),
                    nidsucursal: sessionStorage.getItem("nIdSucursal"),
                    csucursal: sessionStorage.getItem("cNombreSucursal"),
                    nidvehiculo: '',
                    cnrovehiculo: '',
                    dfechaSolicitud: '',
                    nidestado: ''
                },
                arrayEstado: [],
                arrayMisVehiculos : [],
                arrayArchivosAdjuntos: [],
                // ===============================
                // VARIABLES MODAL VEHICULO
                // ===============================
                modalVehiculo: {
                    cnrovehiculo: '',
                },
                arrayVehiculosByCriterio: [],
                arrayInspeccionesAprobadas: [],
                // =============================================================
                // VARIABLES TAB ENTREGA VEHÍCULO
                // =============================================================
                fillEntregaVehiculo: {
                    nIdCabeceraInspeccion: '',
                    dfechaEntrega: '',
                    cHoraEntrega: '',
                    nIdPersonaRecibe: '',
                    cNombrePersonaRecibe: '',
                    fConforme: true,
                    fFacebook: true
                },
                checked: true,
                attachments: [],// Listado de archivos a almacenar
                form: new FormData,// Cada archivo tendrá que ser enviado como elemento FormData
                percentCompleted: 0,// Puede almacenar el progreso de carga 0-100 en valor y mostrarlo en la pantalla
                // ===============================
                // VARIABLES MODAL CONTACTO
                // ===============================
                modalMisContactos:{
                    ntipopersona: 1,
                    cnrodocumento: '',
                    cfiltrodescripcion: '',
                },
                arrayContacto: [],
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
        mounted() {
            this.tabMisInspecciones();
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
        },
        methods: {
            tabMisInspecciones(){
                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass('nav-link active');
                $('#tab02').removeClass('nav-link active');
                $('#tab02').addClass('nav-link disabled');

                $('#TabMisInspecciones').addClass('in active show');
                $('#TaEntregaVehiculo').removeClass('in active show');

                this.limpiarMisMisInspecciones();
                this.limpiarEntregaVehiculo();
                this.llenarEstados();
                this.buscarMisInspecciones(1);
            },
            llenarEstados(){
                var url = this.ruta + '/getComision/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110093,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayEstado = response.data;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            // ======================
            // MODAL BUSCAR VEHICULO
            // ======================
            cambiarPaginaVehiculosByCriterio(page){
                this.paginationModal.current_page=page;
                this.listarVehiculo(page);
            },
            listarVehiculo(page){
                var url = this.ruta + '/autorizacion/GetLstVehiculosByCriterio';
                axios.get(url, {
                    params: {
                        'nidempresa': this.fillBusquedaVehiculo.nidempresa,
                        'nidsucursal' : this.fillBusquedaVehiculo.nidsucursal,
                        'cnrovehiculo' : this.modalVehiculo.cnrovehiculo.toString(),
                        'criterio': 2,
                        'page' : page,
                    }
                }).then(response => {
                    let info = response.data.arrayVehiculosByCriterio;
                    this.arrayVehiculosByCriterio     = info.data;
                    this.paginationModal.current_page =  info.current_page;
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
            asignarVehiculo(vehiculo){
                this.fillBusquedaVehiculo.nidvehiculo = vehiculo.nIdVehiculoPlaca;
                this.fillBusquedaVehiculo.cnrovehiculo = vehiculo.cPlaca;

                this.modalVehiculo.cnrovehiculo = '';
                this.cerrarModalSolicitud();
            },
            // ======================
            // TAB BUSCAR INSPECCIONES
            // ======================
            buscarMisInspecciones(page){
                var url = this.ruta + '/entregavehiculo/GetLstInspecciones';
                axios.get(url, {
                    params: {
                        'nidempresa': this.fillBusquedaVehiculo.nidempresa,
                        'nidsucursal' : this.fillBusquedaVehiculo.nidsucursal,
                        'nidvehiculo' : this.fillBusquedaVehiculo.nidvehiculo,
                        'dfechaSolicitud' : this.fillBusquedaVehiculo.dfechaSolicitud,
                        'nidestado' : this.fillBusquedaVehiculo.nidestado,
                        'page' : page,
                    }
                }).then(response => {
                    let info = response.data.arrayInspeccionesAprobadas;
                    this.arrayInspeccionesAprobadas     = info.data;
                    this.pagination.current_page =  info.current_page;
                    this.pagination.total        = info.total;
                    this.pagination.per_page     = info.per_page;
                    this.pagination.last_page    = info.last_page;
                    this.pagination.from         = info.from;
                    this.pagination.to           = info.to;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            cambiarPaginaMisInspecciones(page){
                this.paginationModal.current_page=page;
                this.buscarMisSolicitudesEntregaVehiculo(page);
            },
            limpiarMisMisInspecciones(){
                //Tab BUSCAS INSPECCIONES
                this.fillBusquedaVehiculo.nidvehiculo = '';
                this.fillBusquedaVehiculo.cnrovehiculo = '';
                this.fillBusquedaVehiculo.dfechaSolicitud = '';
                this.fillBusquedaVehiculo.nidestado = '';
            },
            listarArchivosAdjuntos(data){
                var url = this.ruta + '/entregavehiculo/GetLstArchivosAdjuntos';
                axios.get(url, {
                    params: {
                        'nIdEntregaVehiculo' : data['nIdEntregaVehiculo']
                    }
                }).then(response => {
                    let info = response.data;
                    this.arrayArchivosAdjuntos        = info;
                    this.paginationModal.current_page =  info.current_page;
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
            // ======================
            // TAB ENTREGA VEHÍCULO
            // ======================
            tabEntregaVehiculo(data){
                if(this.validarTab02()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.limpiarEntregaVehiculo();
                this.fillEntregaVehiculo.nIdCabeceraInspeccion = data['nIdCabeceraInspeccion'];

                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass('nav-link');
                $('#tab02').removeClass('nav-link disabled');
                $('#tab02').addClass('nav-link active');

                $('#TabMisInspecciones').removeClass('in active show');
                $('#TaEntregaVehiculo').addClass('in active show');
            },
            validarTab02(){
                this.error = 0;
                this.mensajeError =[];

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            limpiarEntregaVehiculo(){
                this.fillEntregaVehiculo.nIdCabeceraInspeccion = '';
                this.fillEntregaVehiculo.dfechaEntrega = '';
                this.fillEntregaVehiculo.cHoraEntrega = '';
                this.fillEntregaVehiculo.nIdPersonaRecibe = '';
                this.fillEntregaVehiculo.cNombrePersonaRecibe = '';
                this.fillEntregaVehiculo.fConforme = true;
                this.fillEntregaVehiculo.fFacebook = true;
                this.attachments = [];
                this.$forceUpdate();
            },
            //LOAD IMAGE DROPZONE
            // Esta función será llamada cada vez que agregue un archivo.
            uploadFieldChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                for (var i = files.length - 1; i >= 0; i--) {
                    this.attachments.push(files[i]);
                }
                // Restablezca el formulario para evitar copiar estos archivos varias veces en this.attachments
                document.getElementById("attachments").value = [];
            },
            // Esta función será llamada cada vez que remueva un archivo.
            removeAttachment(attachment) {
                this.attachments.splice(this.attachments.indexOf(attachment), 1);
                this.getAttachmentSize();
            },
            // Esta función actualizará el tamaño del archivo
            getAttachmentSize() {
                this.upload_size = 0; //Restablecer al inicioƒ
                this.attachments.map((item) => { this.upload_size += parseInt(item.size); });

                this.upload_size = Number((this.upload_size).toFixed(1));
                this.$forceUpdate();
            },
            //Agrega los archivos al Form Data
            prepareFields() {
                if (this.attachments.length > 0) {
                    for (var i = 0; i < this.attachments.length; i++) {
                        let attachment = this.attachments[i];
                        this.form.append('files[]', attachment);
                    }
                }
            },
            registrarEntregaVehiculo(){
                if(this.validarRegistrarEntregaVehiculo()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                let me = this;
                this.form = new FormData;//Setear cada vez que entre a registrar

                this.prepareFields();

                //this.form.append('files', this.fileList);
                this.form.append('nIdCabeceraInspeccion', this.fillEntregaVehiculo.nIdCabeceraInspeccion);
                this.form.append('dfechaEntrega', this.fillEntregaVehiculo.dfechaEntrega);
                this.form.append('cHoraEntrega', this.fillEntregaVehiculo.cHoraEntrega);
                this.form.append('nIdPersonaRecibe', this.fillEntregaVehiculo.nIdPersonaRecibe);
                this.form.append('fConforme', (this.fillEntregaVehiculo.fConforme == true) ? 'C' : 'N');
                this.form.append('fFacebook', (this.fillEntregaVehiculo.fFacebook == true) ? 'S' : 'N');

                var config = {
                    headers: { 'Content-Type': 'multipart/form-data' } ,
                    onUploadProgress: function(progressEvent) {
                        this.percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        this.$forceUpdate();
                    }.bind(this)
                };
                // Realizar peticòn HTTP
                var url = this.ruta + '/entregavehiculo/SetGenerarEntregaVehículo';
                axios.post(url, this.form, config).
                then(response => {
                    this.tabMisInspecciones();
                    toastr.success('Se generó la entrega del vehículo!', 'Success');
                    this.attachments = [];
                    this.form = new FormData;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            validarRegistrarEntregaVehiculo(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.fillEntregaVehiculo.dfechaEntrega){
                    this.mensajeError.push('Debe seleccionar una fecha de entrega, es campo obligatorio');
                } else {
                    let fecha_actual   = moment();
                    let fecha_entrega  = moment(this.fillEntregaVehiculo.dfechaEntrega);
                    if(fecha_actual.diff(fecha_entrega, 'days') > 0){
                        this.mensajeError.push('La Fecha de Entrega debe ser una fecha posterior a la fecha de Actual');
                    }
                }
                if(!this.fillEntregaVehiculo.cHoraEntrega){
                    this.mensajeError.push('La Hora de entrega es obligatoria');
                }
                if(!this.fillEntregaVehiculo.nIdPersonaRecibe && !this.fillEntregaVehiculo.cNombrePersonaRecibe){
                    this.mensajeError.push('Debe seleccionar una persona, es campo obligatorio');
                }
                if(this.attachments.length == 0){
                    this.mensajeError.push('Debe subir al menos un archivo');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // ======================
            // MODAL BUSCAR CONTACTOS
            // ======================
            cambiarTipoPersonaMisContactos(){
                this.arrayContacto = [];
                this.cambiarPaginaMisContactos(1);
            },
            cambiarPaginaMisContactos(page){
                this.paginationModal.current_page=page;
                this.listarContactos(page);
            },
            listarContactos(page){
                var url = this.ruta + '/autorizacion/GetLstContactosByUsuario';
                axios.get(url, {
                    params: {
                        'nidempresa' : this.fillBusquedaVehiculo.nidempresa,
                        'nidsucursal' : this.fillBusquedaVehiculo.nidsucursal,
                        'nidcronograma' : 220016,
                        'ntipopersona' : this.modalMisContactos.ntipopersona,
                        'cnrodocumento' : String(this.modalMisContactos.cnrodocumento.toString()),
                        'cfiltrodescripcion' : this.modalMisContactos.cfiltrodescripcion.toString(),
                        'tipoRol': 1,
                        'page' : page
                    }
                }).then(response => {
                    let info = response.data.arrayContactosByUsuario;
                    this.arrayContacto                = info.data;
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
            // =================================================================
            // METODOS GENERICOS
            // =================================================================
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "vehiculo":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.listarVehiculo(1);
                                this.accionmodal=2;
                                this.modal = 1;
                                break;
                            }
                        }
                    }
                    break;
                    case "contacto":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.modalMisContactos.ntipopersona = 1;
                                this.listarContactos(1);
                                this.accionmodal=3;
                                this.modal = 1;
                                break;
                            }
                            break;
                            case 'asignar':
                            {
                                if(this.modalMisContactos.ntipopersona == 1){
                                    this.fillEntregaVehiculo.nIdPersonaRecibe = data['nIdPersonaNatural'];
                                    this.fillEntregaVehiculo.cNombrePersonaRecibe = data['cContacto'];
                                } else {
                                    this.fillEntregaVehiculo.nIdPersonaRecibe = data['nIdPersonaNatural'];
                                    this.fillEntregaVehiculo.cNombrePersonaRecibe = data['cRazonSocial'];
                                }
                                this.modalMisContactos.ntipopersona = 1;
                                this.modalMisContactos.cnrodocumento = '';
                                this.modalMisContactos.cfiltrodescripcion = '';
                                this.cerrarModalSolicitud();
                                break;
                            }
                            break;
                            case 'nuevo':
                            {
                                let me = this;
                                switch (data) {
                                    case 110026:
                                        me.$emit('vista', 1300281);//VENDEDORES
                                        break;
                                    case 110025:
                                        me.$emit('vista', 1300280);//JEFE DE VENTAS
                                        break;
                                    case 110083:
                                        me.$emit('vista', 1300300);//ADMINISTRADOR DE VENTAS
                                        break;
                                    default:
                                        break;
                                }
                            }
                        }
                    }
                    break;
                    case "entregavehiculo":
                    {
                        switch(accion){
                            case 'mostrar':
                            {
                                this.listarArchivosAdjuntos(data);
                                this.accionmodal=4;
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
            cerrarModalSolicitud(){
                this.modal = 0;
                this.accionmodal = 0;
                this.error = 0;
                this.mensajeError = '';
                this.arrayArchivosAdjuntos = [];
            }
        }
    }
</script>

<style>
    .upload{
        display: flex;
        flex-direction: column;
    }
    .attachment-holder{
        margin-bottom: .5rem;
    }
    .remove{
        background: red;
        cursor: pointer;
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
    .el-select {
        width: 100%;
    }
    .input-with-select .el-input-group__prepend {
        background-color: #fff;
    }
    .widthFull>.el-select>.el-input {
        width: 100%;
    }
    .el-date-editor.el-input, .el-date-editor.el-input__inner{
        width: 100%;
    }
    .el-input-number{
        width: 100% !important;
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
    .el-row{
        display: flex;
        justify-content: space-between;
        align-content: space-around;
    }
    .disabled{
        opacity: 0.65;
        cursor: not-allowed;
        pointer-events:none;
    }
    .listaArchivosAdjuntos{
        width: 100%;
        margin-bottom: .5rem;
    }
</style>

