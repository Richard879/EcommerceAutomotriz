<template>
    <main>
        <header class="page-header">
          <div class="container-fluid">
            <h2 class="no-margin-bottom">COTIZACIÓN</h2>
          </div>
        </header>

        <section>
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab01" href="#TabCotizacion" @click="tabCotizacion();" role="tab" data-toggle="tab">
                                        <i class="fa fa-users"></i> COTIZACIÓN
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab02" href="#TabAsignarCotizacion" @click="tabAsignarCotizacion();" role="tab" data-toggle="tab">
                                        <i class="fa fa-users"></i> ASIGNAR CONTACTO
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab03" href="#TabDetalleCotizacion" role="tab" data-toggle="tab">
                                        <i class="fa fa-hand-paper-o"></i> DETALLE COTIZACIÓN
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active show" id="TabCotizacion">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="h4">CONFIGURACIÓN BÁSICA</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="form-horizontal">
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Empresa</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="configbasica.cempresa" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Sucursal</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="configbasica.csucursal" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Tipo Cambio Venta</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="configbasica.tipoCambioVenta" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Tipo Cambio</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="configbasica.tipoCambioCompra" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Fecha Inicio</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="configbasica.fechaInicio" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Fecha Fin</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="configbasica.fechaFin" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Ref. Cotización</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="configbasica.refCotizacion" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-9 offset-sm-5">
                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="abrirModal('contacto','buscar')">
                                                                        <i class="fa fa-search"></i> Buscar
                                                                    </button>
                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="tabAsignarCotizacion();">
                                                                        <i class="fa fa-angle-right"></i> Siguiente
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
                                <div role="tabpanel" class="tab-pane fade" id="TabAsignarCotizacion">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="h4">ASIGNACIÓN DE CONTACTO</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="form-horizontal">
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Contacto</label>
                                                                        <div class="col-sm-8">
                                                                            <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="abrirModal('contacto','buscar')">
                                                                                <i class="fa fa-search"></i> Buscar
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Apellidos y Nombres</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="fillAsignarContacto.ccontacto" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Doc. Identidad</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="fillAsignarContacto.cnrodocumento" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Dirección</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="fillAsignarContacto.cdireccion" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Referencia</label>
                                                                        <div class="col-sm-8">
                                                                            <select v-model="fillAsignarContacto.nidreferencia" class="form-control form-control-sm">
                                                                                <option v-for="item in arrayReferencias" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Email</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="fillAsignarContacto.cemail" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-9 offset-sm-5">
                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="tabDetalleCotización();">
                                                                        <i class="fa fa-angle-right"></i> Siguiente
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
                                <div role="tabpanel" class="tab-pane fade" id="TabDetalleCotizacion">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <ul class="nav nav-tabs">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" id="tab0301" href="#TabDCVehiculo" @click="tabDCVehiculo();" role="tab" data-toggle="tab">
                                                                    <i class="fa fa-users"></i> VEHÍCULO
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link disabled" id="tab0302" href="#TabDCElementoVenta" role="tab" data-toggle="tab">
                                                                    <i class="fa fa-users"></i> ELEMENTO VENTA
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link disabled" id="tab0303" href="#TabDCVerificarCampana" role="tab" data-toggle="tab">
                                                                    <i class="fa fa-hand-paper-o"></i> VERIFICAR CAMPAÑA
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link disabled" id="tab0304" href="#TabDCConfirmarCotizacion" role="tab" data-toggle="tab">
                                                                    <i class="fa fa-hand-paper-o"></i> CONFIRMAR COTIZACIÓN
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div role="tabpanel" class="tab-pane fade in active show" id="TabDCVehiculo">
                                                                <section class="forms">
                                                                    <div class="container-fluid">
                                                                        <div class="col-lg-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <form class="form-horizontal">
                                                                                        <div class="col-lg-12">
                                                                                            <div class="form-group row">
                                                                                                <div class="col-sm-6">
                                                                                                    <div class="row">
                                                                                                        <label class="col-sm-4 form-control-label">LINEA ARTICULO</label>
                                                                                                        <div class="col-sm-8">
                                                                                                            <input type="text" class="form-control form-control-sm" readonly placeholder="VH VEHÍCULO MOTORIZADO">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-sm-6">
                                                                                                    <div class="row">
                                                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="abrirModal('vehiculo','buscar')">
                                                                                                            <i class="fa fa-search"></i> Buscar
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <template v-if="arrayVehiculo.length">
                                                                                                <div class="table-responsive">
                                                                                                    <table class="table table-striped table-sm">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                                <th>Acción</th>
                                                                                                                <th>Vehículo</th>
                                                                                                                <th>Cantidad</th>
                                                                                                                <th>Precio Base</th>
                                                                                                                <th>Sobre Precio</th>
                                                                                                                <th>Dscto</th>
                                                                                                                <th>Precio Cierre</th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
                                                                                                            <tr v-for="vehiculo in arrayVehiculo" :key="vehiculo.nIdContacto">
                                                                                                                <td>
                                                                                                                    <a href="#" @click="abrirModal('contacto', 'asignar', vehiculo);">
                                                                                                                        <i class='fa-md fa fa-check-circle'></i>
                                                                                                                    </a>
                                                                                                                </td>
                                                                                                                <td v-text="vehiculo.vehiculo"></td>
                                                                                                                <td v-text="vehiculo.cantidad"></td>
                                                                                                                <td v-text="vehiculo.preciobase"></td>
                                                                                                                <td v-text="vehiculo.sobrepecio"></td>
                                                                                                                <td v-text="vehiculo.dscto"></td>
                                                                                                                <td v-text="vehiculo.preciocierre"></td>
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
                                                                                                                        <a @click.prevent="cambiarPaginaContactosPorVendedor(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                                                    </li>
                                                                                                                    <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                                                                    :class="[page==isActivedModal?'active':'']">
                                                                                                                        <a class="page-link"
                                                                                                                        href="#" @click.prevent="cambiarPaginaContactosPorVendedor(page)"
                                                                                                                        v-text="page"></a>
                                                                                                                    </li>
                                                                                                                    <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                                                        <a @click.prevent="cambiarPaginaContactosPorVendedor(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                            </div>
                                                            <div role="tabpanel" class="tab-pane fade" id="TabDCElementoVenta">
                                                                <section class="forms">
                                                                    <div class="container-fluid">
                                                                        <div class="col-lg-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <form class="form-horizontal">
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                            </div>
                                                            <div role="tabpanel" class="tab-pane fade" id="TabDCVerificarCampana">
                                                                <section class="forms">
                                                                    <div class="container-fluid">
                                                                        <div class="col-lg-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <form class="form-horizontal">
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                            </div>
                                                            <div role="tabpanel" class="tab-pane fade" id="TabDCConfirmarCotizacion">
                                                                <section class="forms">
                                                                    <div class="container-fluid">
                                                                        <div class="col-lg-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <form class="form-horizontal">
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

        <!-- Modal Buscar Contactos -->
        <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form v-on:submit.prevent class="form-horizontal">
                            <div class="container-fluid">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">BUSQUEDA DE CONTACTOS</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">* Tipo Persona</label>
                                                            <div class="col-sm-8">
                                                                <label class="checkbox-inline" v-for="tipo in arrayTipoPersona" :key="tipo.value">
                                                                    <input type="radio" class="radio-template" v-model="fillBusqContacto.ntipopersona" :value="tipo.value" @change="cambiarTipoPersona()">
                                                                    <label for="" class="form-control-label" v-text="tipo.text"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label" v-text="fillBusqContacto.lblcontactonombre"></label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <input type="text" v-model="fillBusqContacto.ccontactonombre" @keyup.enter="buscarContactosPorVendedor(1)" class="form-control form-control-sm">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" :title="fillBusqContacto.lblcontactonombre" class="btn btn-info btn-corner btn-sm" @click="buscarContactosPorVendedor(1);">
                                                                            <i class="fa-lg fa fa-search"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label" v-text="fillBusqContacto.lblcontactodocumento"></label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <input type="text" v-model="fillBusqContacto.ccontactodocumento" @keyup.enter="buscarContactosPorVendedor(1)" class="form-control form-control-sm">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" :title="fillBusqContacto.lblcontactonombre" class="btn btn-info btn-corner btn-sm" @click="buscarContactosPorVendedor(1);">
                                                                            <i class="fa-lg fa fa-search"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-9 offset-sm-5">
                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarContactosPorVendedor(1);">
                                                            <i class="fa fa-search"></i> Buscar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <template v-if="arrayContactosPorVendedor.length">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>Seleccione</th>
                                                                    <template v-if="arrayContactosPorVendedor[0].cPerApellidos">
                                                                        <th>Apellidos y Nombres</th>
                                                                        <th>DNI</th>
                                                                    </template>
                                                                    <template v-else>
                                                                        <th>Razón Social</th>
                                                                        <th>RUC</th>
                                                                    </template>
                                                                    <th>Email</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="contactos in arrayContactosPorVendedor" :key="contactos.nIdContacto">
                                                                    <td>
                                                                        <a href="#" @click="abrirModal('contacto', 'asignar', contactos);">
                                                                            <i class='fa-md fa fa-check-circle'></i>
                                                                        </a>
                                                                    </td>
                                                                    <template v-if="contactos.cPerApellidos">
                                                                        <td v-text="contactos.cContacto"></td>
                                                                        <td v-text="contactos.cNumeroDocumento"></td>
                                                                    </template>
                                                                    <template v-else>
                                                                        <td v-text="contactos.cRazonSocial"></td>
                                                                        <td v-text="contactos.cRuc"></td>
                                                                    </template>
                                                                    <td v-text="contactos.cEmail"></td>
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
                                                                            <a @click.prevent="cambiarPaginaContactosPorVendedor(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                        </li>
                                                                        <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                        :class="[page==isActivedModal?'active':'']">
                                                                            <a class="page-link"
                                                                            href="#" @click.prevent="cambiarPaginaContactosPorVendedor(page)"
                                                                            v-text="page"></a>
                                                                        </li>
                                                                        <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                            <a @click.prevent="cambiarPaginaContactosPorVendedor(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                        <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Buscar Vehiculos -->
        <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form v-on:submit.prevent class="form-horizontal">
                            <div class="container-fluid">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">BUSQUEDA DE VEHÍCULOS</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Lista de Precio</label>
                                                            <div class="col-sm-8">
                                                                <label></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <label class="col-sm-4 form-control-label">Marca</label>
                                                                <div class="col-sm-8">
                                                                    <select name="account" v-model="fillBusqVehiculo.nidmarca" class="form-control form-control-sm" v-on:change="llenarComboModelo();">
                                                                        <!-- <option v-for="marca in arrayMarca" :key="marca.nIdPar" :value="marca.nIdPar" v-text="marca.cParNombre">
                                                                        </option> -->
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <label class="col-sm-4 form-control-label">Modelo</label>
                                                                <div class="col-sm-8">
                                                                    <select name="account" v-model="fillBusqVehiculo.nidmodelo" class="form-control form-control-sm">
                                                                        <!-- <option v-for="modelo in arrayModelo" :key="modelo.nIdPar" :value="modelo.nIdPar" v-text="modelo.cParNombre">
                                                                        </option> -->
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <label class="col-sm-4 form-control-label">Año Modelo</label>
                                                                <div class="col-sm-8">
                                                                    <select name="account" v-model="fillBusqVehiculo.naniomodelo" class="form-control form-control-sm">
                                                                        <!-- <option v-for="version in arrayAnioModelo" :key="version.nIdPar" :value="version.nIdPar" v-text="version.cParNombre">
                                                                        </option> -->
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <label class="col-sm-4 form-control-label">Nombre Comercial</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" v-model="fillBusqVehiculo.cnombrecomercial" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-9 offset-sm-5">
                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarVehiculos(1);">
                                                            <i class="fa fa-search"></i> Buscar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <template v-if="arrayVehiculoModal.length">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>Seleccione</th>
                                                                    <th>Codigo</th>
                                                                    <th>Nombre Comercial</th>
                                                                    <th>Stock</th>
                                                                    <th>Precio</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="vehiculo in arrayVehiculoModal" :key="vehiculo.nIdContacto">
                                                                    <td>
                                                                        <a href="#" @click="abrirModal('contacto', 'asignar', vehiculo);">
                                                                            <i class='fa-md fa fa-check-circle'></i>
                                                                        </a>
                                                                    </td>
                                                                    <td v-text="vehiculo.codigo"></td>
                                                                    <td v-text="vehiculo.nombrecomercial"></td>
                                                                    <td v-text="vehiculo.stock"></td>
                                                                    <td v-text="vehiculo.precio"></td>
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
                                                                            <a @click.prevent="cambiarPaginaContactosPorVendedor(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                        </li>
                                                                        <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                        :class="[page==isActivedModal?'active':'']">
                                                                            <a class="page-link"
                                                                            href="#" @click.prevent="cambiarPaginaContactosPorVendedor(page)"
                                                                            v-text="page"></a>
                                                                        </li>
                                                                        <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                            <a @click.prevent="cambiarPaginaContactosPorVendedor(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                        <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
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
                // =============================================================
                // VARIABLES TAB COTIZACIÓN
                // =============================================================
                configbasica: {
                    cempresa: 'SAISAC',
                    csucursal: 'CHICLAYO',
                    tipoCambioVenta: 3.3,
                    tipoCambioCompra: 3.285,
                    fechaInicio: '2018-06-15',
                    fechaFin: '2018-06-20',
                    refCotizacion: 'NINGUNA'
                },
                fillBusqContacto:{
                    ntipopersona: 1,
                    lblcontactonombre: 'Apellidos',
                    lblcontactodocumento: 'DNI',
                    ccontactonombre: '',
                    ccontactodocumento: ''
                },
                arrayContactosPorVendedor: [],
                // =============================================================
                // VARIABLES TAB ASIGNAR COTIZACIÓN
                // =============================================================
                fillAsignarContacto:{
                    nidcontacto: 0,
                    ccontacto: '',
                    cnrodocumento: '',
                    cdireccion: '',
                    cemail: '',
                    nidreferencia: 0
                },
                arrayReferencias: [],
                // =============================================================
                // VARIABLES TAB DETALLE COTIZACIÓN
                // =============================================================
                arrayVehiculo: [],
                arrayVehiculoModal : [],
                arrayMarca: [],
                arrayModelo: [],
                arrayAnioModelo: [],
                fillBusqVehiculo:{
                    nidmarca: 0,
                    nidmodelo: 0,
                    naniomodelo: 0,
                    cnombrecomercial: ''
                },
                // =============================================================
                // VARIABLES GENÉRICAS
                // =============================================================
                //Radio Buttons Tipo Persona
                arrayTipoPersona: [
                    { value: '1', text: 'NATURAL'},
                    { value: '2', text: 'JURIDICA'}
                ],
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
                accionmodal: 0,
                error: 0,
                errors: [],
                mensajeError: []
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
            }
        },
        methods:{
            // =================================================================
            // TAB COTIZACIÓN
            // =================================================================
            tabCotizacion(){
                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass('nav-link active');
                $('#tab02').removeClass('nav-link active');
                $('#tab02').addClass('nav-link');
                $('#tab03').removeClass('nav-link active');
                $('#tab03').addClass('nav-link');

                $('#TabCotizacion').addClass("in active show");
                $('#TabAsignarCotizacion').removeClass('in active show');
                $('#TabDetalleCotizacion').removeClass('in active show');
            },
            tabAsignarCotizacion(){
                if(this.validaCotizacion()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass('nav-link');
                $('#tab02').removeClass('nav-link');
                $('#tab02').addClass('nav-link active');
                $('#tab03').removeClass('nav-link active');
                $('#tab03').addClass('nav-link');

                $('#TabCotizacion').removeClass('in active show');
                $('#TabAsignarCotizacion').addClass('in active show');
                $('#TabDetalleCotizacion').removeClass('in active show');
                this.llenarReferencias();
            },
            validaCotizacion(){
                this.error = 0;
                this.mensajeError =[];

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            buscarContactosPorVendedor(page){
                var url = this.ruta + '/gescontacto/GetListContactoByVendedor';
                axios.get(url, {
                    params: {
                        'nidempresa' : 1300011,
                        'nidsucursal' : 1300013,
                        'nidcronograma' : 220016,
                        'ntipopersona' : this.fillBusqContacto.ntipopersona,
                        'cnrodocumento' : String(this.fillBusqContacto.ccontactodocumento.toString()),
                        'cfiltrodescripcion' : this.fillBusqContacto.ccontactonombre.toString(),
                        'page' : page
                    }
                }).then(response => {
                    let info = response.data.arrayContactosPorVendedor;
                    //Data
                    this.arrayContactosPorVendedor = info.data;
                    //Pagination
                    this.paginationModal.current_page   =   info.current_page;
                    this.paginationModal.total          =   info.total;
                    this.paginationModal.per_page       =   info.per_page;
                    this.paginationModal.last_page      =   info.last_page;
                    this.paginationModal.from           =   info.from;
                    this.paginationModal.to             =   info.to;
                    //Limpiar caja busqueda
                    this.limpiarfillBusqContacto();
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            cambiarPaginaContactosPorVendedor(page){
                this.pagination.current_page=page;
                this.buscarContactosPorVendedor(page);
            },
            cambiarTipoPersona(){
                if (this.fillBusqContacto.ntipopersona == 1) {
                    this.fillBusqContacto.lblcontactonombre = "Apellidos";
                    this.fillBusqContacto.lblcontactodocumento = "DNI";
                } else {
                    this.fillBusqContacto.lblcontactonombre = "Razón Social";
                    this.fillBusqContacto.lblcontactodocumento = "RUC";
                }
                this.limpiarfillBusqContacto();
            },
            limpiarfillBusqContacto(){
                this.fillBusqContacto.ccontactonombre = '';
                this.fillBusqContacto.ccontactodocumento = '';
            },
            // =================================================================
            // TAB ASGINAR COTIZACIÓN
            // =================================================================
            llenarReferencias(){
                var url = this.ruta + '/gescotizacion/GetListReferencias';
                axios.get(url).then(response => {
                    let info = response.data;
                    //Data
                    this.arrayReferencias = info;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            tabDetalleCotización(){
                if(this.validaAsignarCotizacion()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass('nav-link');
                $('#tab02').removeClass('nav-link active');
                $('#tab02').addClass('nav-link');
                $('#tab03').removeClass('nav-link');
                $('#tab03').addClass('nav-link active');

                $('#TabCotizacion').removeClass('in active show');
                $('#TabAsignarCotizacion').removeClass('in active show');
                $('#TabDetalleCotizacion').addClass('in active show');
            },
            validaAsignarCotizacion(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.fillAsignarContacto.ccontacto){
                    this.mensajeError.push('Apellidos y Nombres no puede estar vacío');
                }
                if(!this.fillAsignarContacto.cnrodocumento){
                    this.mensajeError.push('Doc. Identidad no puede estar vacío');
                }
                if(!this.fillAsignarContacto.cdireccion){
                    this.mensajeError.push('La dirección no puede estar vacía');
                }
                if(!this.fillAsignarContacto.cemail){
                    this.mensajeError.push('El email no puede estar vacío');
                }
                if(this.fillAsignarContacto.nidreferencia == 0){
                    this.mensajeError.push('Debes Seleccionar una Referencia');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // =================================================================
            // TAB DETALLE COTIZACION
            // =================================================================
            llenarComboModelo(){

            },
            buscarVehiculos(){

            },
            // =================================================================
            // METODOS GENERICOS
            // =================================================================
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "contacto":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.modal = 1;
                                this.accionmodal = 2;
                                this.buscarContactosPorVendedor(1);
                                break;
                            }
                        }
                    }
                    break;
                    case "contacto":
                    {
                        switch(accion){
                            case 'asignar':
                            {
                                // (this.fillBusqContacto.ntipopersona) == 1 ? this.fillAsignarContacto.ccontacto = data['cPerApellidos'] : this.fillAsignarContacto.ccontacto = data['cContacto'];
                                this.fillAsignarContacto.nidcontacto = data['nIdContacto'];
                                this.fillAsignarContacto.ccontacto = data['cContacto'];
                                this.fillAsignarContacto.cnrodocumento = data['cNumeroDocumento'];
                                this.fillAsignarContacto.cdireccion = data['cDireccion'];
                                this.fillAsignarContacto.cemail = data['cEmail'];
                                this.tabAsignarCotizacion();
                                this.cerrarModal();
                                break;
                            }
                        }
                    }
                    break;
                    case "vehiculo":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.modal = 1;
                                this.accionmodal = 3;
                                break;
                            }
                        }
                    }
                    break;
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
            //Cerrar ModaL
            cerrarModal(){
                this.modal = 0,
                this.accionmodal = 0,
                this.error = 0,
                this.mensajeError = ''
            },
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


