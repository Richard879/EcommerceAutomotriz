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
                                        <i class="fa fa-list"></i> COTIZACIÓN
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab02" href="#TabAsignarCotizacion" @click="tabAsignarCotizacion();" role="tab" data-toggle="tab">
                                        <i class="fa fa-tasks"></i> ASIGNAR CONTACTO
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab03" href="#TabDetalleCotizacion" role="tab" data-toggle="tab">
                                        <i class="fa fa-list-ol"></i> DETALLE COTIZACIÓN
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
                                                                <a class="nav-link active" id="tab0301" href="#TabDCVehiculo" role="tab" data-toggle="tab">
                                                                    <i class="fa fa-car"></i> VEHÍCULO
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link disabled" id="tab0302" href="#TabDCElementoVenta" role="tab" data-toggle="tab">
                                                                    <i class="fa fa-list-ol"></i> ELEMENTO VENTA
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link disabled" id="tab0303" href="#TabDCVerificarCampana" role="tab" data-toggle="tab">
                                                                    <i class="fa fa-check-square"></i> VERIFICAR CAMPAÑA
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link " id="tab0304" href="#TabDCConfirmarCotizacion" role="tab" data-toggle="tab">
                                                                    <i class="fa fa-check"></i> CONFIRMAR COTIZACIÓN
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
                                                                                                        <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                                                                        <div class="col-sm-8">
                                                                                                            <div class="input-group">
                                                                                                                <input type="hidden" v-model="fillProveedor.nidproveedor">
                                                                                                                <input type="text" v-model="fillProveedor.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
                                                                                                                <div class="input-group-prepend">
                                                                                                                    <button type="button" title="Buscar Proveedor" class="btn btn-info btn-corner btn-sm" @click="abrirModal('proveedor','buscar')">
                                                                                                                        <i class="fa-lg fa fa-search"></i>
                                                                                                                    </button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <div class="col-sm-6">
                                                                                                    <div class="row">
                                                                                                        <label class="col-sm-4 form-control-label">VEHÍCULO</label>
                                                                                                        <div class="col-sm-8">
                                                                                                            <div class="input-group-prepend">
                                                                                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="abrirModal('vehiculo','buscar')">
                                                                                                                    <i class="fa fa-search"></i> Buscar
                                                                                                                </button>
                                                                                                            </div>
                                                                                                        </div>
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
                                                                                                            <tr v-for="(vehiculo, index) in arrayVehiculo" :key="vehiculo.nIdContacto">
                                                                                                                <td>
                                                                                                                    <a href="#" @click="removerVehiculoLista(index);">
                                                                                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                                                                                    </a>
                                                                                                                </td>
                                                                                                                <td v-text="vehiculo.NombreComercial"></td>
                                                                                                                <td v-text="vehiculo.cantidad"></td>
                                                                                                                <td v-text="vehiculo.PrecioBase"></td>
                                                                                                                <td><input type="number" min="1" class="form-control" v-model="vehiculo.sobrePrecio"/></td>
                                                                                                                <td><input type="number" min="1" class="form-control" v-model="vehiculo.dscto"/></td>
                                                                                                                <td v-text="vehiculo.PrecioCierre"></td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </div>
                                                                                                <div class="col-lg-12">
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-7">
                                                                                                            <div class="form-group row">
                                                                                                                SP : <label>2438</label>&nbsp
                                                                                                                Dx : <label>2438.00</label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-lg-5 direction-money">
                                                                                                            <div class="form-group row">
                                                                                                                USD : <label> {{ montoTotalVehiculo = totalVehiculo }} </label>
                                                                                                            </div>
                                                                                                            <div class="form-group row">
                                                                                                                S/. : <label> {{ montoTotalSolesVehiculo = totalSolesVehiculo }} </label>
                                                                                                            </div>
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
                                                                        <div class="col-lg-12 centrarbtn">
                                                                             <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="siguienteTabDCElementoVenta">
                                                                                <i class="fa fa-arrow-right"></i> Siguiente
                                                                            </button>
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
                                                                                        <div class="col-lg-12">
                                                                                            <div class="form-group row">
                                                                                                <div class="col-sm-6">
                                                                                                    <div class="row">
                                                                                                        <label class="col-sm-4 form-control-label">ELEMENTO VENTA</label>
                                                                                                        <div class="col-sm-8">
                                                                                                             <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="abrirModal('elementoventa','buscar')">
                                                                                                                <i class="fa fa-search"></i> Buscar
                                                                                                            </button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <template v-if="arrayElementoVenta.length">
                                                                                                <div class="table-responsive">
                                                                                                    <table class="table table-striped table-sm">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                                <th>Acción</th>
                                                                                                                <th>Elemento Venta</th>
                                                                                                                <th>Cantidad</th>
                                                                                                                <th>Precio</th>
                                                                                                                <th>SubTotal</th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
                                                                                                            <tr v-for="(elementoventa, index) in arrayElementoVenta" :key="elementoventa.nIdContacto">
                                                                                                                <td>
                                                                                                                    <a href="#" @click="removerElementoVentaLista(index);">
                                                                                                                        <i class='fa-md fa fa-check-circle'></i>
                                                                                                                    </a>
                                                                                                                </td>
                                                                                                                <td v-text="elementoventa.cElemenNombre"></td>
                                                                                                                <td><input type="number" min="1" class="form-control" v-model="elementoventa.cantidad"/></td>
                                                                                                                <td v-text="elementoventa.fElemenValorVenta"></td>
                                                                                                                <td> {{ elementoventa.subtotal = elementoventa.cantidad*elementoventa.fElemenValorVenta }} </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </div>
                                                                                                <div class="col-lg-12">
                                                                                                    <div class="row flex-rigth-margin">
                                                                                                        <div class="form-group row">
                                                                                                            USD : <label> {{ montoTotalElementoVenta = totalElementoVenta }} </label>
                                                                                                        </div>
                                                                                                        <div class="form-group row">
                                                                                                            S/. : <label> {{ montoTotalSolesElementoVenta = totalSolesElementoVenta }} </label>
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

        <!-- Modal Buscar Proveedores -->
        <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form v-on:submit.prevent class="form-horizontal">
                            <div class="container-fluid">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">LISTADO</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Nombre</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <input type="text" v-model="fillProveedor.cproveedornombre" @keyup.enter="buscaProveedores()" class="form-control form-control-sm">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" title="Buscar Proveedor" class="btn btn-info btn-corner btn-sm" @click="buscaProveedores();">
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
                                                                        <a href="#" @click="asignarProveedor(proveedor.nIdPar, proveedor.cParNombre);">
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
        <div class="modal fade" v-if="accionmodal==4" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                                            <label class="col-md-4 form-control-label">TIPO DE LISTA</label>
                                                            <div class="col-md-8">
                                                                <select name="account" v-model="fillBusqVehiculo.nidtipolista" class="form-control form-control-sm" @change="mostrarDetalleLista">
                                                                    <option value="0">SELECCIONE</option>
                                                                    <option v-for="lista in arrayTipoLista" :key="lista.value" :value="lista.value" v-text="lista.text"></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label class="col-md-4 form-control-label">DETALLE LISTA</label>
                                                            <div class="col-md-8">
                                                                <span v-text="fillBusqVehiculo.cinfotipolista"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label class="col-md-4 form-control-label">Linea</label>
                                                            <div class="col-md-8">
                                                                <select name="account" v-model="fillBusqVehiculo.nidlinea" class="form-control form-control-sm" v-on:change="llenarComboMarca();">
                                                                    <option v-for="linea in arrayLinea" :key="linea.nIdPar" :value="linea.nIdPar" v-text="linea.cParNombre">
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label class="col-md-4 form-control-label">Marca</label>
                                                            <div class="col-md-8">
                                                                <select name="account" v-model="fillBusqVehiculo.nidmarca" class="form-control form-control-sm" v-on:change="llenarComboModelo();">
                                                                    <option v-for="marca in arrayMarca" :key="marca.nIdPar" :value="marca.nIdPar" v-text="marca.cParNombre">
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label class="col-md-4 form-control-label">Modelo</label>
                                                            <div class="col-md-8">
                                                                <select name="account" v-model="fillBusqVehiculo.nidmodelo" class="form-control form-control-sm">
                                                                    <option v-for="modelo in arrayModelo" :key="modelo.nIdPar" :value="modelo.nIdPar" v-text="modelo.cParNombre">
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label class="col-md-4 form-control-label">Nombre Comercial</label>
                                                            <div class="col-md-8">
                                                                <input type="text" v-model="fillBusqVehiculo.cnombrecomercial" class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-9 offset-md-5">
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
                                                                    <th>Codigo</th>
                                                                    <th>Nombre Comercial</th>
                                                                    <th>Precio Base</th>
                                                                    <th>Descuento</th>
                                                                    <th>Precio Cierre</th>
                                                                    <th>Costo Dealer</th>
                                                                    <th>Precio Venta</th>
                                                                    <th>Año Fabricación</th>
                                                                    <th>Año Modelo</th>
                                                                    <th>Seleccione</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="vehiculo in arrayVehiculoModal" :key="vehiculo.nIdContacto">
                                                                    <td v-text="vehiculo.codListaPrecioVD"></td>
                                                                    <td v-text="vehiculo.NombreComercial"></td>
                                                                    <td v-text="vehiculo.PrecioBase"></td>
                                                                    <td v-text="vehiculo.Descuento"></td>
                                                                    <td v-text="vehiculo.PrecioCierre"></td>
                                                                    <td v-text="vehiculo.CostoDealer"></td>
                                                                    <td v-text="vehiculo.PrecioVenta"></td>
                                                                    <td v-text="vehiculo.AnioFab"></td>
                                                                    <td v-text="vehiculo.AnioMod"></td>
                                                                    <td>
                                                                        <a href="#" @click.prevent="agregarVehículoLista(vehiculo);">
                                                                            <i class='fa-md fa fa-check-circle'></i>
                                                                        </a>
                                                                    </td>
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
                                                                            <a @click.prevent="cambiarPaginaVehiculosModal(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                        </li>
                                                                        <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                        :class="[page==isActivedModal?'active':'']">
                                                                            <a class="page-link"
                                                                            href="#" @click.prevent="cambiarPaginaVehiculosModal(page)"
                                                                            v-text="page"></a>
                                                                        </li>
                                                                        <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                            <a @click.prevent="cambiarPaginaVehiculosModal(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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

        <!-- Modal Buscar Elemento de Venta -->
        <div class="modal fade" v-if="accionmodal==5" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form v-on:submit.prevent class="form-horizontal">
                            <div class="container-fluid">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">BUSQUEDA ELEMENTO VENTA</h3>
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
                                                            <label class="col-md-4 form-control-label">Tipo Elemento</label>
                                                            <div class="col-md-8">
                                                                <select name="account" v-model="fillBusqTipoElemento.ntpoelemen" class="form-control form-control-sm">
                                                                    <option v-for="elemento in arrayTipoElemento" :key="elemento.nIdPar" :value="elemento.nIdPar" v-text="elemento.cParNombre">
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-9 offset-sm-5">
                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarElementoVenta(1);">
                                                            <i class="fa fa-search"></i> Buscar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <template v-if="arrayElementoVentaModal.length">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>Código</th>
                                                                    <th>Proveedor</th>
                                                                    <th>Tipo Elemento</th>
                                                                    <th>Nombre Elemento</th>
                                                                    <th>Precio de Venta</th>
                                                                    <th>Precio de Venta Mínimo</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="elemento in arrayElementoVentaModal" :key="elemento.nIdContacto">
                                                                    <td v-text="elemento.nIdElemento"></td>
                                                                    <td v-text="elemento.cProveedorNombre"></td>
                                                                    <td v-text="elemento.cTipoElemenNombre"></td>
                                                                    <td v-text="elemento.cElemenNombre"></td>
                                                                    <td v-text="elemento.fElemenValorVenta"></td>
                                                                    <td v-text="elemento.fElemenValorMinimoVenta"></td>
                                                                    <td>
                                                                        <a href="#" @click.prevent="agregarElementoVentaLista(elemento);">
                                                                            <i class='fa-md fa fa-check-circle'></i>
                                                                        </a>
                                                                    </td>
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
                                                                            <a @click.prevent="cambiarPaginaTipoElementoVenta(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                        </li>
                                                                        <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                        :class="[page==isActivedModal?'active':'']">
                                                                            <a class="page-link"
                                                                            href="#" @click.prevent="cambiarPaginaTipoElementoVenta(page)"
                                                                            v-text="page"></a>
                                                                        </li>
                                                                        <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                            <a @click.prevent="cambiarPaginaTipoElementoVenta(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                fillProveedor:{
                    nidproveedor: 0,
                    cproveedornombre: ''
                },
                arrayProveedor: [],
                //Modal Buscar Vehiculo
                arrayTipoLista: [
                    { value: '1300082', text: 'NORMAL'},
                    { value: '1300083', text: 'ESPECIAL'}
                ],
                arrayLinea: [],
                arrayMarca: [],
                arrayModelo: [],
                fillBusqVehiculo:{
                    cinfotipolista: '',
                    nidtipolista: 0,
                    nidlinea: 0,
                    nidmarca: 0,
                    nidmodelo: 0,
                    cnombrecomercial: ''
                },
                arrayVehiculoModal : [],
                //SUBTAB Vehiculo
                arrayVehiculo: [],
                montoTotalVehiculo: 0,
                tipoCambio: 0,
                montoTotalSolesVehiculo: 0,

                //SUBTAB Elemento Venta
                fillBusqTipoElemento: {
                    cempresa: 'SAISAC',
                    csucursal: 'CHICLAYO',
                    ntpoelemen: 0
                },
                arrayTipoElemento: [],
                arrayElementoVentaModal: [],
                arrayElementoVenta: [],
                montoTotalElementoVenta: 0,
                montoTotalSolesElementoVenta: 0,
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
                accionmodal: 0,
                tituloModal:'',
                error: 0,
                errors: [],
                mensajeError: []
            }
        },
        mounted() {
            this.getTipoCambio();
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
            totalVehiculo: function(){
                let me = this;
                return me.arrayVehiculo.reduce(function(valorAnterior, valorActual){
                    return valorAnterior + parseInt(valorActual.PrecioCierre);
                }, 0);
            },
            totalSolesVehiculo: function(){
                let me = this;
                let montoconvertido = me.montoTotalVehiculo * me.tipoCambio;
                montoconvertido = Number((montoconvertido).toFixed(2));
                return montoconvertido;
            },
            totalElementoVenta: function(){
                let me = this;
                return me.arrayElementoVenta.reduce(function(valorAnterior, valorActual){
                    return valorAnterior + parseInt(valorActual.subtotal);
                }, 0);
            },
            totalSolesElementoVenta: function(){
                let me = this;
                let montoconvertido = me.montoTotalElementoVenta * me.tipoCambio;
                montoconvertido = Number((montoconvertido).toFixed(2));
                return montoconvertido;
            },
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
            // ======================
            // SUBTAB VEHÍCULO
            // ======================
            buscaProveedores(){
                this.listarProveedores(1);
            },
            listarProveedores(page){
                var url = this.ruta + '/parametro/GetLstProveedor';

                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidgrupopar' : 110023,
                        'cnombreproveedor' : this.fillProveedor.cproveedornombre.toString(),
                        'opcion' : 1,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayProveedor = response.data.arrayProveedor.data;
                    this.paginationModal.current_page   =  response.data.arrayProveedor.current_page;
                    this.paginationModal.total          = response.data.arrayProveedor.total;
                    this.paginationModal.per_page       = response.data.arrayProveedor.per_page;
                    this.paginationModal.last_page      = response.data.arrayProveedor.last_page;
                    this.paginationModal.from           = response.data.arrayProveedor.from;
                    this.paginationModal.to             = response.data.arrayProveedor.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaProveedor(page){
                this.paginationModal.current_page=page;
                this.listarProveedores(page);
            },
            asignarProveedor(nProveedorId, cProveedorNombre){
                this.fillProveedor.nidproveedor = nProveedorId;
                this.fillProveedor.cproveedornombre = cProveedorNombre;
                this.cerrarModal();
                this.arrayMarca = [];
                this.arrayModelo = [];
                this.llenarComboLinea();
            },
            validarBotonBuscarVehiculo(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.fillProveedor.cproveedornombre){
                    this.mensajeError.push('Debe seleccionar un proveedor');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            mostrarDetalleLista(){
                var url = this.ruta + '/gescotizacion/GetTipoLista';
                axios.get(url, {
                    params: {
                        'nidtipolista' : this.fillBusqVehiculo.nidtipolista
                    }
                }).then(response => {
                    var varnro = (response.data[0].NRO) == null ? '' : response.data[0].NRO + ' - ';
                    this.fillBusqVehiculo.cinfotipolista = varnro + response.data[0].MES + ' ' + response.data[0].ANIO;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboLinea(){
                this.nidempresa = 130011;

                var url = this.ruta + '/versionvehiculo/GetLineasByProveedor';
                axios.get(url, {
                    params: {
                        'nidempresa': this.nidempresa,
                        'nidproveedor' : this.fillProveedor.nidproveedor
                    }
                }).then(response => {
                    this.arrayLinea = response.data;
                    this.fillBusqVehiculo.nidlinea = 0;
                    this.llenarComboMarca();
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboMarca(){
                var url = this.ruta + '/versionvehiculo/GetMarcaByLinea';

                axios.get(url, {
                    params: {
                        'nidlinea': this.fillBusqVehiculo.nidlinea
                    }
                }).then(response => {
                    this.arrayMarca = response.data;
                    this.fillBusqVehiculo.nidmarca = 0;
                    this.arrayModelo = [];
                    this.llenarComboModelo();
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboModelo(){
                var url = this.ruta + '/versionvehiculo/GetModeloByMarca';
                axios.get(url, {
                    params: {
                        'nidmarca': this.fillBusqVehiculo.nidmarca
                    }
                }).then(response => {
                    this.arrayModelo = response.data;
                    this.fillBusqVehiculo.nidmodelo = 0;
                }).catch(error => {
                    console.log(error);
                });
            },
            buscarVehiculos(page){
                if(this.validarBuscarVehiculos()){
                    return;
                }

                var url = this.ruta + '/gescotizacion/GetListVehiculos';
                axios.get(url, {
                    params: {
                        'nidtipolista': this.fillBusqVehiculo.nidtipolista,
                        'nidlinea' : this.fillBusqVehiculo.nidlinea,
                        'nidmarca' : this.fillBusqVehiculo.nidmarca,
                        'nidmodelo' : this.fillBusqVehiculo.nidmodelo,
                        'cnombrecomercial' : this.fillBusqVehiculo.cnombrecomercial,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayVehiculoModal = response.data.arrayListaVehiculos.data;
                    this.paginationModal.current_page   =  response.data.arrayListaVehiculos.current_page;
                    this.paginationModal.total          = response.data.arrayListaVehiculos.total;
                    this.paginationModal.per_page       = response.data.arrayListaVehiculos.per_page;
                    this.paginationModal.last_page      = response.data.arrayListaVehiculos.last_page;
                    this.paginationModal.from           = response.data.arrayListaVehiculos.from;
                    this.paginationModal.to             = response.data.arrayListaVehiculos.to;
                    this.limpiarfillBusqVehiculo();
                }).catch(error => {
                    console.log(error);
                });
            },
            validarBuscarVehiculos(){
                this.error = 0;
                this.mensajeError =[];

                if(this.fillBusqVehiculo.nidtipolista == 0){
                    this.mensajeError.push('Debe seleccionar un tipo de lista');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            cambiarPaginaVehiculosModal(page){
                this.paginationModal.current_page=page;
                this.buscarVehiculos(page);
            },
            limpiarfillBusqVehiculo(){
                this.fillBusqVehiculo.nidlinea = 0;
                this.fillBusqVehiculo.nidmarca = 0;
                this.fillBusqVehiculo.nidmodelo = 0;
                this.fillBusqVehiculo.cnombrecomercial = '';
            },
            agregarVehículoLista(vehiculo){
                if(this.encontrarVehiculo(vehiculo.NombreComercial)){
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'El vehículo ya se encuentra agregado!',
                    })
                } else {
                    this.arrayVehiculo.push({
                        codListaPrecioVD : vehiculo.codListaPrecioVD,
                        NombreComercial  : vehiculo.NombreComercial,
                        PrecioBase       : vehiculo.PrecioBase,
                        Descuento        : vehiculo.Descuento,
                        PrecioCierre     : vehiculo.PrecioCierre,
                        CostoDealer      : vehiculo.CostoDealer,
                        PrecioVenta      : vehiculo.PrecioVenta,
                        AnioFab          : vehiculo.AnioFab,
                        AnioMod          : vehiculo.AnioMod,
                        cantidad         : 1,
                        sobrePrecio      : 1,
                        dscto            : 1
                    });

                    toastr.options.progressBar = true;
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = "toast-top-full-width";
                    toastr.success('Agrego vehículo "'+ vehiculo.NombreComercial +'" exitosamente');
                    this.cerrarModal();
                }
            },
            encontrarVehiculo(vehiculo){
                var sw=0;
                this.arrayVehiculo.map(function (x) {
                    if(x.NombreComercial == vehiculo){
                        sw = true;
                    }
                });
                return sw;
            },
            removerVehiculoLista(index){
                this.$delete(this.arrayVehiculo, index);
            },
            siguienteTabDCElementoVenta(){
                if(this.validarTabDCElementoVenta()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#tab0301').removeClass('nav-link active');
                $('#tab0301').addClass('nav-link');
                $('#tab0302').removeClass('nav-link disabled');
                $('#tab0302').addClass('nav-link active');

                $('#TabDCVehiculo').removeClass('in active show');
                $('#TabDCElementoVenta').addClass('in active show');
                $('#TabDCVerificarCampana').removeClass('in active show');
                $('#TabDCConfirmarCotizacion').removeClass('in active show');
            },
            validarTabDCElementoVenta(){
                this.error = 0;
                this.mensajeError =[];

                if(this.arrayVehiculo.length == 0){
                    this.mensajeError.push('Debe haber un vehiculo agregado');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // ======================
            // SUBTAB ELEMENTO VENTA
            // ======================
            cargarTipoElemento(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid': 110027,
                        'opcion' : 0,
                    }
                }).then(response => {
                    this.arrayTipoElemento = response.data;
                }).catch(error => {
                    this.errors = error
                });
            },
            buscarElementoVenta(page){
                if(this.validarBuscarElementoVenta()){
                    return;
                }

                var url = this.ruta + '/elemento/GetElementoByTipo';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidtipoelemen' : this.fillBusqTipoElemento.ntpoelemen,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayElementoVentaModal       =   response.data.arrayElementoVenta.data;
                    this.paginationModal.current_page  =   response.data.arrayElementoVenta.current_page;
                    this.paginationModal.total         =   response.data.arrayElementoVenta.total;
                    this.paginationModal.per_page      =   response.data.arrayElementoVenta.per_page;
                    this.paginationModal.last_page     =   response.data.arrayElementoVenta.last_page;
                    this.paginationModal.from          =   response.data.arrayElementoVenta.from;
                    this.paginationModal.to            =   response.data.arrayElementoVenta.to;
                }).catch(error => {
                    this.errors = error
                });
            },
            validarBuscarElementoVenta(){
                this.error = 0;
                this.mensajeError =[];

                if(this.fillBusqTipoElemento.ntpoelemen == 0){
                    this.mensajeError.push('Debe seleccionar un tipo de elemento de venta');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            cambiarPaginaTipoElementoVenta(page){
                this.pagination.current_page=page;
                this.buscarElementoVenta(page);
            },
            agregarElementoVentaLista(elemento){
                if(this.encontrarElementoVenta(elemento.cElemenNombre)){
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'El elemento de venta ya se encuentra agregado!',
                    })
                } else {
                    this.arrayElementoVenta.push({
                        cCodigoERP              : elemento.cCodigoERP,
                        cElemenNombre           : elemento.cElemenNombre,
                        cMonedaNombre           : elemento.cMonedaNombre,
                        cProveedorNombre        : elemento.cProveedorNombre,
                        cTipoElemenNombre       : elemento.cTipoElemenNombre,
                        fElemenValorMinimoVenta : elemento.fElemenValorMinimoVenta,
                        fElemenValorVenta       : elemento.fElemenValorVenta,
                        nIdElemento             : elemento.nIdElemento,
                        nIdMoneda               : elemento.nIdMoneda,
                        nIdProveedor            : elemento.nIdProveedor,
                        nIdTipoElemento         : elemento.nIdTipoElemento,
                        cantidad                : 1,
                        subtotal                : 0
                    });

                    toastr.options.progressBar = true;
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = "toast-top-full-width";
                    toastr.success('Agrego el elemento de venta "'+ elemento.cElemenNombre +'" exitosamente');
                }
            },
            encontrarElementoVenta(elemento){
                var sw=0;
                this.arrayElementoVenta.map(function (x) {
                    if(x.cElemenNombre == elemento){
                        sw = true;
                    }
                });
                return sw;
            },
            removerElementoVentaLista(index){
                this.$delete(this.arrayElementoVenta, index);
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
                                this.accionmodal=2;
                                this.modal = 1;
                                this.buscarContactosPorVendedor(1);
                                break;
                            }
                            break;
                            case 'asignar':
                            {
                                // (this.fillBusqContacto.ntipopersona) == 1 ?
                                //         this.fillAsignarContacto.ccontacto = data['cPerApellidos'] :
                                //         this.fillAsignarContacto.ccontacto = data['cContacto'];
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
                    case "proveedor":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=3;
                                this.modal = 1;
                                this.listarProveedores(1);
                                break;
                            }
                        }
                    }
                    break;
                    case 'vehiculo':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                if(this.validarBotonBuscarVehiculo()){
                                    this.accionmodal=1;
                                    this.modal = 1;
                                    return;
                                }
                                this.accionmodal=4;
                                this.modal = 1;
                                this.llenarComboLinea();
                                this.arrayVehiculo = [];
                                break;
                            }
                        }
                    }
                    break;
                    case 'elementoventa':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=5;
                                this.modal = 1;
                                this.cargarTipoElemento();
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
                //SubTab - Modal Vehiculo
                this.arrayProveedor = [];
                this.arrayVehiculoModal = [];
                //SubTab - Modal Elemento Venta
                this.arrayElementoVentaModal = [];
            },
            getTipoCambio(){
                var url = this.ruta + '/gescotizacion/GetTipoCambio';
                axios.get(url).then(response => {
                    this.tipoCambio = response.data[0].fvalortipocambio;
                }).catch(error => {
                    console.log(error);
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
        text-align: center;
        margin: auto;
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


