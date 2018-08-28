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
                                    <a class="nav-link active" id="tab01" href="#TabCotizacion" @click="tabCotizacion" role="tab" data-toggle="tab">
                                        <i class="fa fa-list"></i> COTIZACIÓN
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab02" href="#TabAsignarContacto" @click="tabAsignarContacto" role="tab" data-toggle="tab">
                                        <i class="fa fa-user"></i> ASIGNAR CONTACTO
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="tab03" href="#TabDetalleCotizacion" @click="tabDetalleCotización" role="tab" data-toggle="tab">
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
                                                                            <input type="text" v-model="fillConfigBasica.cempresa" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Sucursal</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="fillConfigBasica.csucursal" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Tipo Cambio Compra</label>
                                                                        <div class="col-sm-8">
                                                                            <label v-text="fillConfigBasica.tipoCambioCompra" class="form-control-label-readonly"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Tipo Cambio Venta </label>
                                                                        <div class="col-sm-8">
                                                                            <label v-text="fillConfigBasica.tipoCambioVenta" class="form-control-label-readonly"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Fecha Inicio</label>
                                                                        <div class="col-sm-8">
                                                                            <label v-text="fillConfigBasica.fechaInicio" class="form-control-label-readonly"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Fecha Fin</label>
                                                                        <div class="col-sm-8">
                                                                            <label v-text="fillConfigBasica.fechaFin" class="form-control-label-readonly"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Ref. Cotización</label>
                                                                        <div class="col-sm-8">
                                                                            <label v-text="fillConfigBasica.refCotizacion" class="form-control-label-readonly"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-9 offset-sm-5">
                                                                    <!--<button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="abrirModal('contacto','buscar')">
                                                                        <i class="fa fa-search"></i> Buscar
                                                                    </button>-->
                                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="tabAsignarContacto();">
                                                                        <i class="fa fa-arrow-right"></i> Siguiente
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
                                <div role="tabpanel" class="tab-pane fade" id="TabAsignarContacto">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="h4">ASIGNACIÓN DE CONTACTO</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="form-horizontal">
                                                            <div class="col-lg-12">
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
                                                                            <label class="col-sm-4 form-control-label">* Contacto</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillAsignarContacto.ccontacto" class="form-control form-control-sm" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Nro Documento</label>
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
                                                                            <label class="col-sm-4 form-control-label">* Tipo Medio</label>
                                                                            <div class="col-sm-8">
                                                                                <select v-model="fillAsignarContacto.nidreferencia" class="form-control form-control-sm">
                                                                                    <option v-for="item in arrayTipoMedio" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
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
                                                            </div>
                                                            <hr/>
                                                            <div class="col-lg-12">
                                                                <template v-if="arrayReferenciavehiculo.length">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-striped table-sm">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Acción</th>
                                                                                    <th>Proovedor</th>
                                                                                    <th>Linea</th>
                                                                                    <th>Marca</th>
                                                                                    <th>Modelo</th>
                                                                                    <th>Año Fab</th>
                                                                                    <th>Año Modelo</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="r in arrayReferenciavehiculo" :key="r.nIdReferenciaVehiculoContacto">
                                                                                    <td>
                                                                                        <a href="#" @click="asingarReferenciaVehiculo(r.nIdAsignacionContactoVendedor, r.nIdProveedor, r.cProveedorNombre,
                                                                                                                                        r.nIdLinea, r.nIdMarca, r.nIdModelo);">
                                                                                            <i class="fa-md fa fa-check-circle" aria-hidden="true"></i>
                                                                                        </a>
                                                                                    </td>
                                                                                    <td v-text="r.cProveedorNombre"></td>
                                                                                    <td v-text="r.cLineaNombre"></td>
                                                                                    <td v-text="r.cMarcaNombre"></td>
                                                                                    <td v-text="r.cModeloNombre"></td>
                                                                                    <td v-text="r.nAnioFabricacion"></td>
                                                                                    <td v-text="r.nAnioModelo"></td>
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
                                                <ul class="nav nav-tabs">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="tab0301" href="#TabDCVehiculo" @click="tabDCVehiculo" role="tab" data-toggle="tab">
                                                            <i class="fa fa-car"></i> VEHÍCULO
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link disabled" id="tab0302" href="#TabDCElementoVenta" role="tab" data-toggle="tab">
                                                            <i class="fa fa fa-sign-out"></i> ELEMENTO VENTA
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link disabled" id="tab0303" href="#TabDCVerificarCampana" role="tab" data-toggle="tab">
                                                            <i class="fa fa-check-square"></i> VERIFICAR CAMPAÑA
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link disabled" id="tab0304" href="#TabDCConfirmarCotizacion" role="tab" data-toggle="tab">
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
                                                                        <div class="card-header">
                                                                            <h3 class="h4">ASIGNAR VEHÍCULO</h3>
                                                                        </div>
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
                                                                                                <label class="col-sm-4 form-control-label">* Vehículo</label>
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
                                                                                <hr/>
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
                                                                                                        <th>SubTotal</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr v-for="(vehiculo, index) in arrayVehiculo" :key="vehiculo.nIdContacto">
                                                                                                        <td>
                                                                                                            <a href="#" @click="removerVehiculoLista(index);">
                                                                                                                <i :style="'color:red'" class="fa-md fa fa-times-circle" aria-hidden="true"></i>
                                                                                                            </a>
                                                                                                        </td>
                                                                                                        <td v-text="vehiculo.NombreComercial"></td>
                                                                                                        <td v-text="vehiculo.cantidad"></td>
                                                                                                        <td v-text="vehiculo.PrecioBase"></td>
                                                                                                        <td><input type="number" min="1" class="form-control form-control-sm" v-model="vehiculo.sobrePrecio"/></td>
                                                                                                        <td v-text="vehiculo.Descuento"></td>
                                                                                                        <td v-text="vehiculo.PrecioCierre"></td>
                                                                                                        <td> {{ vehiculo.subtotal = vehiculo.cantidad*vehiculo.PrecioCierre }} </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-6">
                                                                                                    <div class="form-group row">
                                                                                                        <label class="col-sm-2 form-control-label">SP: </label>
                                                                                                        <label class="form-control-label"><strong>2438</strong></label>
                                                                                                        <label class="col-sm-2 form-control-label">Dx: </label>
                                                                                                        <label class="form-control-label"><strong>2438.00</strong></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-6 direction-money">
                                                                                                    <div class="form-group row">
                                                                                                        <label class="form-control-label">TOTAL USD &nbsp; &nbsp;</label>
                                                                                                        <label class="form-control-label"><strong>{{ montoTotalVehiculoDolar = totalVehiculo }}</strong></label>
                                                                                                    </div>
                                                                                                    <div class="form-group row">
                                                                                                        <label class="form-control-label">TOTAL S/. &nbsp; &nbsp;</label>
                                                                                                        <label class="form-control-label"><strong>{{ montoTotalVehiculoSoles = totalVehiculoSoles }}</strong></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-9 offset-sm-3">
                                                                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click.prevent="siguienteTabDCElementoVenta">
                                                                                                    <i class="fa fa-arrow-right"></i> Siguiente
                                                                                                </button>
                                                                                                <button type="button" class="btn btn-info btn-corner btn-sm" @click.prevent="siguienteTabDCVerificarCampania">
                                                                                                    <i class="fa fa-arrow-right"></i> Ir a Verificar Campaña
                                                                                                </button>
                                                                                                <!--<button type="button" class="btn btn-warning btn-corner btn-sm" @click.prevent="siguienteTabDConfirmarcotizacion">
                                                                                                    <i class="fa fa-arrow-right"></i> Ir a Confirmar Cotización
                                                                                                </button>-->
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
                                                                        <div class="card-header">
                                                                            <h3 class="h4">ASIGNAR ELEMENTO VENTA</h3>
                                                                        </div>
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
                                                                                <hr/>
                                                                                <div class="col-lg-12">
                                                                                    <template v-if="arrayElementoVenta.length">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table table-striped table-sm">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>Acción</th>
                                                                                                        <th>Elemento Venta</th>
                                                                                                        <th colspan="2">Cantidad</th>
                                                                                                        <th>Precio</th>
                                                                                                        <th>SubTotal</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr v-for="(elementoventa, index) in arrayElementoVenta" :key="elementoventa.nIdContacto">
                                                                                                        <td>
                                                                                                            <a href="#" @click="removerElementoVentaLista(index);">
                                                                                                                <i :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                                            </a>
                                                                                                        </td>
                                                                                                        <td v-text="elementoventa.cElemenNombre"></td>
                                                                                                        <td colspan="2"><input type="number" min="1" class="form-control form-control-sm" v-model="elementoventa.cantidad"/></td>
                                                                                                        <td v-text="elementoventa.fElemenValorVenta"></td>
                                                                                                        <td> {{ elementoventa.subtotal = elementoventa.cantidad*elementoventa.fElemenValorVenta }} </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="row flex-rigth-margin">
                                                                                                <div class="form-group row">
                                                                                                    <label class="form-control-label">TOTAL USD: &nbsp; &nbsp;</label>
                                                                                                    <label class="form-control-label"><strong>{{ montoTotalElementoVenta = totalElementoVenta }}</strong></label>
                                                                                                </div>
                                                                                                <div class="form-group row">
                                                                                                    <label class="form-control-label">TOTAL S/. &nbsp; &nbsp;</label>
                                                                                                    <label class="form-control-label"><strong>{{ montoTotalElementoVentaSoles = totalElementoVentaSoles }}</strong></label>
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
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-9 offset-sm-4">
                                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click.prevent="siguienteTabDCVerificarCampania">
                                                                                                <i class="fa fa-arrow-right"></i> Siguiente
                                                                                            </button>
                                                                                            <button type="button" class="btn btn-info btn-corner btn-sm" @click.prevent="siguienteTabDCVerificarCampania">
                                                                                                <i class="fa fa-arrow-right"></i> Ir a Verificar Campaña
                                                                                            </button>
                                                                                            <!--<button type="button" class="btn btn-warning btn-corner btn-sm" @click.prevent="siguienteTabDConfirmarcotizacion">
                                                                                                <i class="fa fa-arrow-right"></i> Ir a Confirmar Cotización
                                                                                            </button>-->
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
                                                    <div role="tabpanel" class="tab-pane fade" id="TabDCVerificarCampana">
                                                        <section class="forms">
                                                            <div class="container-fluid">
                                                                <div class="col-lg-12">
                                                                    <div class="card">
                                                                         <div class="card-header">
                                                                            <h3 class="h4">CAMPAÑAS ACTIVAS</h3>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <form class="form-horizontal">
                                                                                <div class="col-lg-12">
                                                                                    <template v-if="arrayEventoCampania.length">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table table-striped table-sm">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>Código</th>
                                                                                                        <th>Nombre</th>
                                                                                                        <th>Tipo</th>
                                                                                                        <th>Acción</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr v-for="(evento, index) in arrayEventoCampania" :key="index">
                                                                                                        <td v-text="index+1"></td>
                                                                                                        <td v-text="evento.cNombreEventoCampania"></td>
                                                                                                        <td v-text="evento.TipoEvento"></td>
                                                                                                        <td>
                                                                                                            <a href="#" @click="abrirModal('campaña', 'detalle', evento);">
                                                                                                                <i class="fa-md fa fa-search-plus" aria-hidden="true"></i>
                                                                                                            </a>
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
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-9 offset-sm-4">
                                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click.prevent="siguienteTabDConfirmarcotizacion">
                                                                                                <i class="fa fa-arrow-right"></i> Siguiente
                                                                                            </button>
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
                                                    <div role="tabpanel" class="tab-pane fade" id="TabDCConfirmarCotizacion">
                                                        <section class="forms">
                                                            <div class="container-fluid">
                                                                <div class="col-lg-12">
                                                                    <form class="form-horizontal">
                                                                        <template v-if="arrayConfiCotiVehiculo.length">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-striped table-sm">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th colspan="3">Vehículo</th>
                                                                                            <th>Cantidad</th>
                                                                                            <th>Dscto</th>
                                                                                            <th>Precio Final</th>
                                                                                            <th>SubTotal</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr v-for="cotivehiculo in arrayConfiCotiVehiculo" :key="cotivehiculo.nIdContacto">
                                                                                            <td colspan="3"> {{ cotivehiculo.detalle }} </td>
                                                                                            <td v-text="cotivehiculo.cantidad"></td>
                                                                                            <td v-text="cotivehiculo.dscto"></td>
                                                                                            <td v-text="cotivehiculo.preciofinal"></td>
                                                                                            <td v-text="cotivehiculo.subtotal"></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <div class="row flex-rigth-margin">
                                                                                    <div class="form-group row">
                                                                                        <label class="form-control-label">TOTAL USD &nbsp; &nbsp;</label>
                                                                                        <label class="form-control-label"><strong> {{ montoTotalConfiCotiVehiculo = totalConfiCotiVehiculo }}</strong></label>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="form-control-label">TOTAL S/. &nbsp; &nbsp;</label>
                                                                                        <label class="form-control-label"><strong> {{ montoTotalConfiCotiVehiculoSoles = totalConfiCotiVehiculoSoles }}</strong></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </template>
                                                                        <template v-else>
                                                                            <table>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td colspan="10">No existen vehículos cotizados!</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </template>
                                                                        <template v-if="arrayConfiCotiEleVenta.length">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-striped table-sm">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th colspan="3">Elemento Venta</th>
                                                                                            <th>Cantidad</th>
                                                                                            <th>Dscto</th>
                                                                                            <th>Precio Final</th>
                                                                                            <th>SubTotal</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr v-for="cotieleventa in arrayConfiCotiEleVenta" :key="cotieleventa.nIdContacto">
                                                                                            <td colspan="3"> {{ cotieleventa.detalle }} </td>
                                                                                            <td v-text="cotieleventa.cantidad"></td>
                                                                                            <td v-text="cotieleventa.dscto"></td>
                                                                                            <td v-text="cotieleventa.preciofinal"></td>
                                                                                            <td v-text="cotieleventa.subtotal"></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <div class="row flex-rigth-margin">
                                                                                    <div class="form-group row">
                                                                                        <label class="form-control-label">TOTAL USD &nbsp; &nbsp;</label>
                                                                                        <label class="form-control-label"><strong>{{ montoTotalConfiCotiEleVenta = totalConfiCotiEleVenta }}</strong></label>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="form-control-label">TOTAL S/. &nbsp; &nbsp;</label>
                                                                                        <label class="form-control-label"><strong>{{ montoTotalConfiCotiEleVentaSoles = totalConfiCotiEleVentaSoles }}</strong></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </template>
                                                                        <template v-else>
                                                                            <table>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td colspan="10">No existen elementos de ventas cotizados!</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </template>
                                                                        <template v-if="arrayConfiCotiEventoEleVenta.length">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-striped table-sm">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th colspan="3">Campaña</th>
                                                                                            <th>Elemento Venta</th>
                                                                                            <th>Cantidad</th>
                                                                                            <th>Dscto</th>
                                                                                            <th>Precio Final</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr v-for="(cotieleventa, index) in arrayConfiCotiEventoEleVenta" :key="index">
                                                                                            <td colspan="3" v-text=" cotieleventa.nombreEC"></td>
                                                                                            <td v-text=" cotieleventa.nombreEV"></td>
                                                                                            <td v-text="cotieleventa.cantidad"></td>
                                                                                            <td v-text="cotieleventa.dscto"></td>
                                                                                            <td v-text="cotieleventa.preciofinal"></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <div class="row flex-rigth-margin">
                                                                                    <div class="form-group row">
                                                                                        <label class="form-control-label">TOTAL USD &nbsp; &nbsp;</label>
                                                                                        <label class="form-control-label"><strong>{{montoTotalConfiCotiEventoEleVenta=totalConfiCotiEventoEleVenta}}</strong></label>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="form-control-label">TOTAL S/. &nbsp; &nbsp;</label>
                                                                                        <label class="form-control-label"><strong>{{montoTotalConfiCotiEventoEleVentaSoles=totalConfiCotiEventoEleVentaSoles}}</strong></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </template>
                                                                        <template v-else>
                                                                            <table>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td colspan="10">No existen elementos de ventas en campañas!</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </template>

                                                                        <hr/>
                                                                        <div class="col-lg-12">
                                                                            <div class="row flex-rigth-margin">
                                                                                <div class="form-group row">
                                                                                    <strong>
                                                                                        TOTAL USD &nbsp; &nbsp; <label> {{ montoTotalCotizacion = totalConfiCoti }} </label>
                                                                                    </strong>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <strong>
                                                                                        TOTAL S/. &nbsp; &nbsp; <label> {{ montoTotalCotizacionSoles = totalConfiCotiSoles }} </label>
                                                                                    </strong>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-9 offset-sm-4">
                                                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click.prevent="registrarCotizacion">
                                                                                        <i class="fa fa-save"></i> REGISTRAR
                                                                                    </button>
                                                                                    <button type="button" class="btn btn-secundary btn-corner btn-sm" @click.prevent="cancelarCotizacion">
                                                                                        <i class="fa fa-close"></i> CANCELAR
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
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
                                                                        <td v-text="contactos.cNumeroDocumento"></td>
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
                                                                <input type="text" v-model="fillBusqVehiculo.cnombrecomercial" @keyup.enter="buscarVehiculos(1)" class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-9 offset-md-5">
                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarVehiculos(1)">
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
                                                                    <th>Año Fabricación</th>
                                                                    <th>Año Modelo</th>
                                                                    <th>Precio Base</th>
                                                                    <th>Descuento</th>
                                                                    <th>Precio Cierre</th>
                                                                    <th>Costo Dealer</th>
                                                                    <th>Precio Venta</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="vehiculo in arrayVehiculoModal" :key="vehiculo.nIdContacto">
                                                                    <td>
                                                                        <a href="#" @click.prevent="agregarVehículoLista(vehiculo);">
                                                                            <i class='fa-md fa fa-check-circle'></i>
                                                                        </a>
                                                                    </td>
                                                                    <td v-text="vehiculo.codListaPrecioVD"></td>
                                                                    <td v-text="vehiculo.NombreComercial"></td>
                                                                    <td v-text="vehiculo.AnioFab"></td>
                                                                    <td v-text="vehiculo.AnioMod"></td>
                                                                    <td v-text="vehiculo.PrecioBase"></td>
                                                                    <td v-text="vehiculo.Descuento"></td>
                                                                    <td v-text="vehiculo.PrecioCierre"></td>
                                                                    <td v-text="vehiculo.CostoDealer"></td>
                                                                    <td v-text="vehiculo.PrecioVenta"></td>
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
                                                                    <th>Acciones</th>
                                                                    <th>Código</th>
                                                                    <th>Proveedor</th>
                                                                    <th>Tipo Elemento</th>
                                                                    <th>Nombre Elemento</th>
                                                                    <th>Precio de Venta</th>
                                                                    <th>Precio de Venta Mínimo</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="elemento in arrayElementoVentaModal" :key="elemento.nIdContacto">
                                                                    <td>
                                                                        <a href="#" @click.prevent="agregarElementoVentaLista(elemento);">
                                                                            <i class='fa-md fa fa-check-circle'></i>
                                                                        </a>
                                                                    </td>
                                                                    <td v-text="elemento.nIdElemento"></td>
                                                                    <td v-text="elemento.cProveedorNombre"></td>
                                                                    <td v-text="elemento.cTipoElemenNombre"></td>
                                                                    <td v-text="elemento.cElemenNombre"></td>
                                                                    <td v-text="elemento.fElemenValorVenta"></td>
                                                                    <td v-text="elemento.fElemenValorMinimoVenta"></td>
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

        <!-- Modal Buscar Elemento de Venta -->
        <div class="modal fade" v-if="accionmodal==6" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form v-on:submit.prevent class="form-horizontal">
                            <div class="container-fluid">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">DETALLE EVENTO/CAMPAÑA</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div>
                                                                <h3 v-text="fillEventoCampania.cNombreEventoCampania"></h3>
                                                                <h2 class="no-margin-bottom" v-text="fillEventoCampania.TipoEvento"></h2>
                                                                <input type="hidden" v-text="montoTotalEventoElementoVenta = totalEventoEleVentaModal">
                                                                <input type="hidden" v-text="montoTotalEventoElementoVentaSoles = totalEventoEleVentaModalSoles">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <template v-if="arrayEventoEleVentaModal.length">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>Acciones</th>
                                                                    <th>Elemento Venta</th>
                                                                    <th>Valor</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="(eleventa, index) in arrayEventoEleVentaModal" :key="eleventa.nIdContacto">
                                                                    <template v-if="eleventa.nIdEventoCampania == fillEventoCampania.nIdEventoCampania">
                                                                        <td>
                                                                            <a href="#" @click.prevent="removerElementoVentaCampania(index);">
                                                                                <i :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                            </a>
                                                                        </td>
                                                                        <td v-text="eleventa.cNombre"></td>
                                                                        <td v-text="eleventa.fValorVenta"></td>
                                                                    </template>
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
                fillConfigBasica: {
                    cempresa: 'SAISAC',
                    csucursal: 'CHICLAYO',
                    tipoCambioVenta: 0.0,
                    tipoCambioCompra: 0.0,
                    fechaInicio: '',
                    fechaFin: '',
                    refCotizacion: 'NINGUNA'
                },
                // =============================================================
                // VARIABLES TAB ASIGNAR CONTACTO
                // =============================================================
                fillBusqContacto:{
                    ntipopersona: 1,
                    lblcontactonombre: 'Apellidos',
                    lblcontactodocumento: 'DNI',
                    ccontactonombre: '',
                    ccontactodocumento: ''
                },
                arrayContactosPorVendedor: [],
                fillAsignarContacto:{
                    nidasignarcontacto: 0,
                    nidcontacto: 0,
                    ccontacto: '',
                    cnrodocumento: '',
                    cdireccion: '',
                    cemail: '',
                    nidreferencia: 0,
                    nidlinea: 0,
                    nidmarca: 0,
                    nidmodelo: 0
                },
                arrayTipoMedio: [],
                arrayReferenciavehiculo: [],
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
                montoTotalVehiculoDolar: 0,
                fValorTipoCambioCompra: 0,
                fValorTipoCambioVenta: 0,
                fValorTipocambioComercial: 0,
                montoTotalVehiculoSoles: 0,
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
                montoTotalElementoVentaSoles: 0,
                //SUBTAB EVENTO CAMPAÑA
                arrayCampaniasByModelo: [],
                arrayCampaniasByMarca: [],
                arrayCampaniasByLinea: [],
                arrayEventoCampania: [],
                fillEventoCampania: {
                    nIdEventoCampania: 0,
                    cNombreEventoCampania: '',
                    TipoEvento: ''
                },
                arrayEventoEleVenta: [],
                arrayEventoEleVentaModal: [],
                montoTotalEventoElementoVenta: 0,
                montoTotalEventoElementoVentaSoles: 0,
                //SUBTAB CONFIRMAR COTIZACIÓN
                arrayConfiCotiVehiculo: [],
                montoTotalConfiCotiVehiculo: 0,
                montoTotalConfiCotiVehiculoSoles: 0,

                arrayConfiCotiEleVenta: [],
                montoTotalConfiCotiEleVenta: 0,
                montoTotalConfiCotiEleVentaSoles: 0,

                arrayConfiCotiEventoEleVenta: [],
                montoTotalConfiCotiEventoEleVenta: 0,
                montoTotalConfiCotiEventoEleVentaSoles: 0,

                arrayMontosCotizacion: [],
                montoTotalCotizacion: 0,
                montoTotalCotizacionSoles: 0,
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
            this.configuracionInicial();
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
            //Calcula SubTotales y Total del TAB Vehículo
            totalVehiculo: function(){
                let me = this;
                return me.arrayVehiculo.reduce(function(valorAnterior, valorActual){
                    return valorAnterior + parseFloat(valorActual.subtotal);
                }, 0);
            },
            totalVehiculoSoles: function(){
                let me = this;
                let montoconvertido = me.montoTotalVehiculoDolar * me.fValorTipocambioComercial;
                montoconvertido = Number((montoconvertido).toFixed(2));
                return montoconvertido;
            },
            //Calcula SubTotales y Total del TAB Elemento Venta
            totalElementoVenta: function(){
                let me = this;
                return me.arrayElementoVenta.reduce(function(valorAnterior, valorActual){
                    return valorAnterior + parseFloat(valorActual.subtotal);
                }, 0);
            },
            totalElementoVentaSoles: function(){
                let me = this;
                let montoconvertido = me.montoTotalElementoVenta * me.fValorTipocambioComercial;
                montoconvertido = Number((montoconvertido).toFixed(2));
                return montoconvertido;
            },
            //Calcula SubTotales y Total del TAB Evento Campaña
            totalEventoEleVentaModal: function(){
                let me = this;
                return me.arrayEventoEleVentaModal.reduce(function(valorAnterior, valorActual){
                    return valorAnterior + parseFloat(valorActual.fValorVenta);
                }, 0);
            },
            totalEventoEleVentaModalSoles: function(){
                let me = this;
                let montoconvertido = me.montoTotalEventoElementoVenta * me.fValorTipocambioComercial;
                montoconvertido = Number((montoconvertido).toFixed(2));
                return montoconvertido;
            },
            //Calcula SubTotales y Total del TAB Cotización - Vehiculo
            totalConfiCotiVehiculo: function(){
                let me = this;
                return me.arrayConfiCotiVehiculo.reduce(function(valorAnterior, valorActual){
                    return valorAnterior + parseFloat(valorActual.subtotal);
                }, 0);
            },
            totalConfiCotiVehiculoSoles: function(){
                let me = this;
                let montoconvertido = me.montoTotalConfiCotiVehiculo * me.fValorTipocambioComercial;
                montoconvertido = Number((montoconvertido).toFixed(2));
                return montoconvertido;
            },
            //Calcula SubTotales y Total del TAB Cotización - Elemento Venta
            totalConfiCotiEleVenta: function(){
                let me = this;
                return me.arrayConfiCotiEleVenta.reduce(function(valorAnterior, valorActual){
                    return valorAnterior + parseFloat(valorActual.subtotal);
                }, 0);
            },
            totalConfiCotiEleVentaSoles: function(){
                let me = this;
                let montoconvertido = me.montoTotalConfiCotiEleVenta * me.fValorTipocambioComercial;
                montoconvertido = Number((montoconvertido).toFixed(2));
                return montoconvertido;
            },
            //Calcula SubTotales y Total del TAB Cotización - Evento Camapaña (Elemento Venta)
            totalConfiCotiEventoEleVenta: function(){
                let me = this;
                return me.arrayConfiCotiEventoEleVenta.reduce(function(valorAnterior, valorActual){
                    return valorAnterior + parseFloat(valorActual.preciofinal);
                }, 0);
            },
            totalConfiCotiEventoEleVentaSoles: function(){
                let me = this;
                let montoconvertido = me.montoTotalConfiCotiEventoEleVenta * me.fValorTipocambioComercial;
                montoconvertido = Number((montoconvertido).toFixed(2));
                return montoconvertido;
            },
            //Calcula SubTotales y Total de toda la Cotización
            totalConfiCoti: function(){
                let me = this;
                return me.arrayMontosCotizacion.reduce(function(valorAnterior, valorActual){
                    return valorAnterior + parseFloat(valorActual.monto);
                }, 0);
            },
            totalConfiCotiSoles: function(){
                let me = this;
                let montoconvertido = me.montoTotalCotizacion * me.fValorTipocambioComercial;
                montoconvertido = Number((montoconvertido).toFixed(2));
                return montoconvertido;
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
                $('#TabAsignarContacto').removeClass('in active show');
                $('#TabDetalleCotizacion').removeClass('in active show');
                this.configuracionInicial();
            },
            configuracionInicial(){
                this.obtenerFechaInicioCotizacion();
                this.obtenerFechaFinCotizacion();
                this.getTipoCambio();
            },
            obtenerFechaInicioCotizacion(){
                var f = new Date();
                var day = String(f.getDate());
                var month = String((f.getMonth() +1));
                if (month.length < 2){
                    month = "0" + "" + month;
                }
                if (day.length < 2){
                    day = "0" + "" + day;
                }
                this.fillConfigBasica.fechaInicio = day + "/" + month + "/" + f.getFullYear();
            },
            obtenerFechaFinCotizacion(){
                var url = this.ruta + '/tipoparametro/GetTipoByIdParametro';
                axios.get(url, {
                    params: {
                        'nidpar' : 1300170,
                        'ctipoparametro' : 'N',
                        'nidtipopar': 4
                    }
                }).then(response => {
                    var fecha = moment().add(parseInt(response.data[0].nDatoParNumerico), 'days').format('YYYY-MM-DD');
                    var f = new Date(fecha);
                    var day = String(f.getDate());
                    var month = String((f.getMonth() +1));
                    if (month.length < 2){
                        month = "0" + "" + month;
                    }
                    if (day.length < 2){
                        day = "0" + "" + day;
                    }
                    this.fillConfigBasica.fechaFin = day + "/" + month + "/" + f.getFullYear();
                }).catch(error => {
                    console.log(error);
                });
            },
            getTipoCambio(){
                this.mostrarProgressBar();
                var url = this.ruta + '/gescotizacion/GetTipoCambio';
                axios.get(url).then(response => {
                    this.fValorTipoCambioCompra = response.data[0].fValorTipoCambioCompra;
                    this.fValorTipoCambioVenta = response.data[0].fValorTipoCambioVenta;
                    this.fValorTipocambioComercial = response.data[0].fValorTipoCambioComercial;

                    this.fillConfigBasica.tipoCambioVenta = response.data[0].fValorTipoCambioVenta;
                    this.fillConfigBasica.tipoCambioCompra = response.data[0].fValorTipoCambioCompra;
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            // =================================================================
            // TAB ASIGNAR CONTACTO
            // =================================================================
            tabAsignarContacto(){
                if(this.validaCotizacion()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass("nav-link");
                $('#tab02').addClass('nav-link active');
                $('#tab03').removeClass('nav-link active');
                $('#tab03').addClass('nav-link disabled');
                $('#TabCotizacion').removeClass('in active show');
                $('#TabAsignarContacto').addClass('in active show');
                $('#TabDetalleCotizacion').removeClass('in active show');

                this.llenarTipoMedio();
                this.llenarReferenciasVehiculo();
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
            llenarTipoMedio(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110057,
                        'opcion' : 0,
                    }
                }).then(response => {
                    let info = response.data;
                    //Data
                    this.arrayTipoMedio = info;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            llenarReferenciasVehiculo(){
                var url = this.ruta + '/gescontacto/GetRefVehiculoByContacto';
                axios.get(url, {
                    params: {
                        'nidempresa' : 1300011,
                        'nidsucursal' : 1300013,
                        'nidcontacto' : this.fillAsignarContacto.nidcontacto
                    }
                }).then(response => {
                    let info = response.data.arraySegReferenciavehiculo;
                    //Data
                    this.arrayReferenciavehiculo = info.data;
                    //Pagination
                    this.pagination.current_page   =   info.current_page;
                    this.pagination.total          =   info.total;
                    this.pagination.per_page       =   info.per_page;
                    this.pagination.last_page      =   info.last_page;
                    this.pagination.from           =   info.from;
                    this.pagination.to             =   info.to;
                    //Limpiar caja busqueda
                    this.limpiarfillBusqContacto();
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            asingarReferenciaVehiculo(nIdAsignacionContactoVendedor, nIdProveedor, cProveedorNombre, nIdLinea, nIdMarca, nIdModelo){
                this.tabDCVehiculo();
                this.fillAsignarContacto.nidasignarcontacto = nIdAsignacionContactoVendedor;
                this.fillProveedor.nidproveedor = nIdProveedor;
                this.fillProveedor.cproveedornombre = cProveedorNombre;
                this.fillAsignarContacto.nidlinea = nIdLinea;
                this.fillAsignarContacto.nidmarca = nIdMarca;
                this.fillAsignarContacto.nidmodelo = nIdModelo;
                this.tabDetalleCotización();
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
                $('#tab03').removeClass('nav-link disabled');
                $('#tab03').addClass('nav-link active');

                $('#TabCotizacion').removeClass('in active show');
                $('#TabAsignarContacto').removeClass('in active show');
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
                    this.mensajeError.push('Debes Seleccionar un Tipo Medio');
                }
                if(this.fillAsignarContacto.nidasignarcontacto == 0 ||
                    this.fillAsignarContacto.nidasignarcontacto == undefined){
                    this.mensajeError.push('Debes asignar una Referencia de Vehículo');
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
            tabDCVehiculo(){
                $('#tab0301').addClass('nav-link active');
                $('#tab0302').removeClass('nav-link active');
                $('#tab0302').addClass("nav-link disabled");
                $('#tab0303').removeClass('nav-link active');
                $('#tab0303').addClass('nav-link disabled');
                $('#tab0304').removeClass('nav-link active');
                $('#tab0304').addClass('nav-link disabled');
                $('#TabDCVehiculo').addClass('in active show');
                $('#TabDCElementoVenta').removeClass('in active show');
                $('#TabDCVerificarCampana').removeClass('in active show');
                $('#TabDCConfirmarCotizacion').removeClass('in active show');
            },
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
                        'nidproveedor': this.fillProveedor.nidproveedor,
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
                    this.fillBusqVehiculo.nidlinea = this.fillAsignarContacto.nidlinea;
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
                    this.fillBusqVehiculo.nidmarca = this.fillAsignarContacto.nidmarca;
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
                    this.fillBusqVehiculo.nidmodelo = this.fillAsignarContacto.nidmodelo;
                }).catch(error => {
                    console.log(error);
                });
            },
            buscarVehiculos(page){
                if(this.validarBuscarVehiculos()){
                    return;
                }

                this.mostrarProgressBar();

                var url = this.ruta + '/gescotizacion/GetListVehiculos';
                axios.get(url, {
                    params: {
                        'nidproveedor': this.fillProveedor.nidproveedor,
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
                    //this.limpiarfillBusqVehiculo();
                }).then(function (response) {
                    $("#myBar").hide();
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
                    this.arrayVehiculo = [];

                    this.arrayVehiculo.push({
                        codListaPrecioVD : vehiculo.codListaPrecioVD,
                        NombreComercial  : vehiculo.NombreComercial,
                        PrecioBase       : vehiculo.PrecioBase,
                        Descuento        : vehiculo.Descuento,
                        PrecioCierre     : vehiculo.PrecioCierre,
                        cantidad         : 1,
                        sobrePrecio      : 1,
                        subtotal         : 0,
                        nIdMoneda        : vehiculo.nIdMoneda,
                        nIdLinea         : vehiculo.nIdLinea,
                        nIdMarca         : vehiculo.nIdMarca,
                        nIdModelo        : vehiculo.nIdModelo
                    });

                    /*toastr.options.progressBar = true;
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = "toast-top-full-width";*/
                    toastr.success('Se Agregó vehículo "'+ vehiculo.NombreComercial +'"');
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

                    /*toastr.options.progressBar = true;
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = "toast-top-full-width";*/
                    toastr.success('Se Agregó "'+ elemento.cElemenNombre +'" ');
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
            siguienteTabDCVerificarCampania(){
                if(this.validarTabDCElementoVenta()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#tab0301').removeClass('nav-link active');
                $('#tab0301').addClass('nav-link');
                $('#tab0302').removeClass('nav-link active');
                $('#tab0302').addClass('nav-link');
                $('#tab0303').removeClass('nav-link disabled');
                $('#tab0303').addClass('nav-link active');

                $('#TabDCVehiculo').removeClass('in active show');
                $('#TabDCElementoVenta').removeClass('in active show');
                $('#TabDCVerificarCampana').addClass('in active show');
                $('#TabDCConfirmarCotizacion').removeClass('in active show');
                this.$nextTick(function () {
                    this.llenarCampaniasPorModeloVehiculo();
                })
            },
            // ======================
            // SUBTAB VERIFICAR CAMPAÑA
            // ======================
            llenarCampaniasPorModeloVehiculo(){
                var url = this.ruta + '/gescotizacion/GetListCampañasByVehiculo';
                axios.get(url, {
                    params: {
                        'nidproveedor': this.fillProveedor.nidproveedor,
                        'fecha'       : moment().format('YYYY-MM-DD'),
                        'nidcodigo'   : this.arrayVehiculo[0].nIdModelo,
                        'tipo'        : 3
                    }
                }).then(response => {
                    this.arrayCampaniasByModelo  =  response.data;
                    this.$nextTick(function () {
                        this.llenarCamapaniasPorMarcaVehiculo();
                    })
                }).catch(error => {
                    this.errors = error
                });
            },
            llenarCamapaniasPorMarcaVehiculo(){
                var url = this.ruta + '/gescotizacion/GetListCampañasByVehiculo';
                axios.get(url, {
                    params: {
                        'nidproveedor': this.fillProveedor.nidproveedor,
                        'fecha'       : moment().format('YYYY-MM-DD'),
                        'nidcodigo'   : this.arrayVehiculo[0].nIdMarca,
                        'tipo'        : 2
                    }
                }).then(response => {
                    this.arrayCampaniasByMarca  =  response.data;
                    this.$nextTick(function () {
                        this.llenarCamapaniasPorLineaVehiculo();
                    })
                }).catch(error => {
                    this.errors = error
                });
            },
            llenarCamapaniasPorLineaVehiculo(){
                var url = this.ruta + '/gescotizacion/GetListCampañasByVehiculo';
                axios.get(url, {
                    params: {
                        'nidproveedor': this.fillProveedor.nidproveedor,
                        'fecha'       : moment().format('YYYY-MM-DD'),
                        'nidcodigo'   : this.arrayVehiculo[0].nIdLinea,
                        'tipo'        : 1
                    }
                }).then(response => {
                    this.arrayCampaniasByLinea  =  response.data;
                    this.$nextTick(function () {
                        this.llenarEventoCampania();
                    })
                }).catch(error => {
                    this.errors = error
                });
            },
            llenarEventoCampania(){
                let me = this;
                let url = me.ruta + '/gescotizacion/GetListEventoElementoVenta';

                this.arrayEventoCampania = []; //Setea array de campañas
                this.arrayEventoEleVentaModal = [];//Setea array de elementos de venta del modal

                this.$nextTick(function () {
                    let me = this;
                    if(this.arrayCampaniasByModelo.length > 0){
                        this.arrayCampaniasByModelo.map(function(ec){
                            me.arrayEventoCampania.push({
                                nIdEventoCampania       : ec.nIdEventoCampania,
                                cNombreEventoCampania   : ec.cNombreEventoCampania,
                                nIdTipoEvento           : ec.nIdTipoEvento,
                                TipoEvento              : ec.TipoEvento,
                                dFechaInicio            : ec.dFechaInicio,
                                dFechaFin               : ec.dFechaFin,
                                fValorPresupuesto       : ec.fValorPresupuesto
                            });

                            axios.get(url, {
                                params: {
                                    'fecha'  : moment().format('YYYY-MM-DD'),
                                    'nideventocampania'  : ec.nIdEventoCampania
                                }
                            }).then(response => {
                                me.arrayEventoEleVenta  =  response.data;
                                me.$nextTick(function () {
                                    me.llenarEventoEleVenta();
                                })
                            }).catch(error => {
                                me.errors = error
                            });
                        });
                    }
                    if(this.arrayCampaniasByMarca.length > 0){
                        this.arrayCampaniasByMarca.map(function(ec){
                            me.arrayEventoCampania.push({
                                nIdEventoCampania       : ec.nIdEventoCampania,
                                cNombreEventoCampania   : ec.cNombreEventoCampania,
                                nIdTipoEvento           : ec.nIdTipoEvento,
                                TipoEvento              : ec.TipoEvento,
                                dFechaInicio            : ec.dFechaInicio,
                                dFechaFin               : ec.dFechaFin,
                                fValorPresupuesto       : ec.fValorPresupuesto
                            });

                            axios.get(url, {
                                params: {
                                    'fecha'  : moment().format('YYYY-MM-DD'),
                                    'nideventocampania'  : ec.nIdEventoCampania
                                }
                            }).then(response => {
                                me.arrayEventoEleVenta  =  response.data;
                                me.$nextTick(function () {
                                    me.llenarEventoEleVenta();
                                })
                            }).catch(error => {
                                this.errors = error
                            });
                        });
                    }
                    if(this.arrayCampaniasByLinea.length > 0){
                        this.arrayCampaniasByLinea.map(function(ec){
                            me.arrayEventoCampania.push({
                                nIdEventoCampania       : ec.nIdEventoCampania,
                                cNombreEventoCampania   : ec.cNombreEventoCampania,
                                nIdTipoEvento           : ec.nIdTipoEvento,
                                TipoEvento              : ec.TipoEvento,
                                dFechaInicio            : ec.dFechaInicio,
                                dFechaFin               : ec.dFechaFin,
                                fValorPresupuesto       : ec.fValorPresupuesto
                            });

                            axios.get(url, {
                                params: {
                                    'fecha'  : moment().format('YYYY-MM-DD'),
                                    'nideventocampania'  : ec.nIdEventoCampania
                                }
                            }).then(response => {
                                me.arrayEventoEleVenta  =  response.data;
                                me.$nextTick(function () {
                                    me.llenarEventoEleVenta();
                                })
                            }).catch(error => {
                                me.errors = error
                            });
                        });
                    }
                })
            },
            llenarEventoEleVenta(){
                this.$nextTick(function () {
                    let me = this;
                    if(this.arrayEventoEleVenta.length > 0){
                        this.arrayEventoEleVenta.map(function(eev){
                            me.arrayEventoEleVentaModal.push({
                                nIdEventoCampania       : eev.nIdEventoCampania,
                                cNombreEventoCampania   : eev.cNombreEventoCampania,
                                nIdElementoVenta        : eev.nIdElementoVenta,
                                cNombre                 : eev.cNombre,
                                nIdEventoElementoVenta  : eev.nIdEventoElementoVenta,
                                fValorVenta             : eev.fValorVenta,
                                nIdMoneda               : eev.nIdMoneda,
                                cantidad                : 1
                            });
                        });
                    }
                })
            },
            removerElementoVentaCampania(index){
                this.$delete(this.arrayEventoEleVentaModal, index);
            },
            // ======================
            // SUBTAB CONFIRMAR COTIZACIÓN
            // ======================
            llenarDetalleConfirmacion(){
                let me = this;

                //Setear arrays vacío
                me.arrayConfiCotiVehiculo = [];//Seteo array detalle de vehiculos
                me.arrayConfiCotiEleVenta = [];//Seteo array detalle de ele venta
                me.arrayConfiCotiEventoEleVenta = [];//Seteo array detalle ele venta de campaña
                me.arrayMontosCotizacion = [];//Seteo array de totales calculados

                // ======================
                // DETALLE VEHÍCULO
                // ======================
                me.arrayVehiculo.map(function (v) {
                    me.arrayConfiCotiVehiculo.push({
                        codigo       : v.codListaPrecioVD,
                        detalle      : v.NombreComercial,
                        cantidad     : v.cantidad,
                        dscto        : v.Descuento,
                        preciofinal  : v.PrecioCierre,
                        subtotal     : v.subtotal,
                        nidmoneda    : v.nIdMoneda,
                        flagTipoItem : 'V'
                    });
                });

                me.arrayMontosCotizacion.push({
                    monto: me.montoTotalVehiculoDolar
                });

                // ======================
                // DETALLE ELEMENTO VENTA
                // ======================
                if(me.arrayElementoVenta.length > 0){
                    me.arrayElementoVenta.map(function(ev){
                        me.arrayConfiCotiEleVenta.push({
                            codigo       : ev.nIdElemento,
                            detalle      : ev.cElemenNombre,
                            cantidad     : ev.cantidad,
                            dscto        : 1,
                            preciofinal  : ev.fElemenValorVenta,
                            subtotal     : ev.subtotal,
                            flagTipoItem : 'E',
                            nidmoneda    : ev.nIdMoneda
                        });
                    });

                    me.arrayMontosCotizacion.push({
                        monto: me.montoTotalElementoVenta
                    });
                }

                // ======================
                // DETALLE CAMPAÑA ELEMENTO VENTA
                // ======================
                if(me.arrayEventoEleVentaModal.length > 0){
                    me.arrayEventoEleVentaModal.map(function(ev){
                        me.arrayConfiCotiEventoEleVenta.push({
                            codigoEV     : ev.nIdElementoVenta,
                            codigoEC     : ev.nIdEventoCampania,
                            codigoEEV    : ev.nIdEventoElementoVenta,
                            nombreEV     : ev.cNombre,
                            nombreEC     : ev.cNombreEventoCampania,
                            cantidad     : ev.cantidad,
                            dscto        : 1,
                            preciofinal  : ev.fValorVenta,
                            flagTipoItem : 'E',
                            nidmoneda    : ev.nIdMoneda
                        });
                    });

                    me.arrayMontosCotizacion.push({
                        monto: me.montoTotalEventoElementoVenta
                    });
                }
            },
            registrarCotizacion(){
                if(this.validarRegistrarCotizacion()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/gescotizacion/SetCabeceraCotizacion';
                axios.post(url, {
                    'nIdAsignacionContactoVendedor': parseInt(this.fillAsignarContacto.nidasignarcontacto),
                    'cNumeroCotizacion' : 'COT-001',
                    'nIdEmpresa' : 1300011,
                    'nIdSucursal':1300013,
                    'nIdReferencia':1300129,
                    'dFechaCotizacion':moment().format('YYYY-MM-DD'),
                    'dFechaVencimientoCotizacion':moment().add(7, 'days').format('YYYY-MM-DD'),
                    'fTipoCambioVenta':this.fValorTipoCambioVenta,
                    'fTipoCambioCompra':this.fValorTipoCambioCompra,
                    'fTotalCotizacionVehiculoDolar': this.montoTotalConfiCotiVehiculo,
                    'fTotalCotizacionVehiculoSol': this.montoTotalConfiCotiVehiculoSoles,
                    'fTotalElementoVentaDolar': this.montoTotalConfiCotiEleVenta,
                    'fTotalElementoVentaSol': this.montoTotalConfiCotiEleVentaSoles
                }).then(response => {
                    this.registrarDetalleCotizacion(response.data[0].nIdCabeceraCotizacion);
                }).catch(error => {
                    this.errors = error
                });
            },
            registrarDetalleCotizacion(nIdCabeCoti){
                if(this.arrayVehiculo.length > 0){
                    var url = this.ruta + '/gescotizacion/SetDetalleCotizacion';
                    axios.post(url, {
                        nIdCabeCoti: nIdCabeCoti,
                        arrayvehiculos: this.arrayConfiCotiVehiculo,
                        arrayelemventa: this.arrayConfiCotiEleVenta,
                        arrayeventoeleventa: this.arrayConfiCotiEventoEleVenta
                    }).then(response => {
                        this.limpiarProcesoCotizacion();
                        swal('Cotización registrado exitosamente');
                    }).catch(error => {
                        console.log(error);
                    });
                }
            },
            validarRegistrarCotizacion(){
                this.error = 0;
                this.mensajeError =[];

                if(this.arrayVehiculo.length == 0){
                    this.mensajeError.push('Debe haber un vehiculo agregado');
                }

                if(!this.fillAsignarContacto.nidcontacto){
                    this.mensajeError.push('Debe asignar un contacto');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            limpiarProcesoCotizacion(){
                //Tab Asignar Cotización
                this.fillAsignarContacto.ccontacto = '';
                this.fillAsignarContacto.cdireccion = '';
                this.fillAsignarContacto.cemail = '';
                this.fillAsignarContacto.cnrodocumento = '';
                this.fillAsignarContacto.nidasignarcontacto = '';
                this.fillAsignarContacto.nidcontacto = '';
                this.fillAsignarContacto.nidreferencia = 0;
                this.arrayReferenciavehiculo = [];
                //Tab Detalle Cotización
                this.fillProveedor.cproveedornombre = '';
                this.fillProveedor.nidproveedor = '';
                this.fillBusqVehiculo.cinfotipolista = '';
                this.fillBusqVehiculo.cnombrecomercial = '';
                this.fillBusqVehiculo.nidlinea = 0;
                this.fillBusqVehiculo.nidmarca = 0;
                this.fillBusqVehiculo.nidmodelo = 0;
                this.fillBusqVehiculo.nidtipolista = 0;

                this.arrayVehiculo = [];
                this.arrayElementoVenta = [];
                this.arrayEventoEleVenta= [];
                this.arrayEventoEleVentaModal= [];


                this.arrayMontosCotizacion = [];
                this.arrayConfiCotiVehiculo = [];
                this.arrayConfiCotiEleVenta = [];
                this.arrayConfiCotiEventoEleVenta = [];

                this.montoTotalVehiculoDolar = 0;
                this.montoTotalVehiculoSoles = 0;
                this.montoTotalElementoVenta = 0;
                this.montoTotalElementoVentaSoles = 0;
                this.montoTotalEventoElementoVenta= 0;
                this.montoTotalEventoElementoVentaSoles= 0;

                this.montoTotalConfiCotiVehiculo = 0;
                this.montoTotalConfiCotiVehiculoSoles = 0;
                this.montoTotalConfiCotiEleVenta = 0;
                this.montoTotalConfiCotiEleVentaSoles = 0;
                this.montoTotalCotizacion = 0;
                this.montoTotalCotizacionSoles = 0;
                this.montoTotalConfiCotiEventoEleVenta= 0;
                this.montoTotalConfiCotiEventoEleVentaSoles= 0;


                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass('nav-link active');
                $('#tab02').removeClass('nav-link active');
                $('#tab02').addClass('nav-link');
                $('#tab03').removeClass('nav-link active');
                $('#tab03').addClass('nav-link disabled');

                $('#TabCotizacion').addClass("in active show");
                $('#TabAsignarContacto').removeClass('in active show');
                $('#TabDetalleCotizacion').removeClass('in active show');

                $('#tab0301').removeClass('nav-link');
                $('#tab0301').addClass('nav-link active');
                $('#tab0302').removeClass('nav-link active');
                $('#tab0302').addClass('nav-link disabled');
                $('#tab0303').removeClass('nav-link active');
                $('#tab0303').addClass('nav-link disabled');
                $('#tab0304').removeClass('nav-link active');
                $('#tab0304').addClass('nav-link disabled');

                $('#TabDCVehiculo').addClass('in active show');
                $('#TabDCElementoVenta').removeClass('in active show');
                $('#TabDCVerificarCampana').removeClass('in active show');
                $('#TabDCConfirmarCotizacion').removeClass('in active show');
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
                                (this.fillBusqContacto.ntipopersona) == 1 ?
                                        this.fillAsignarContacto.ccontacto = data['cContacto'] :
                                        this.fillAsignarContacto.ccontacto = data['cRazonSocial'];
                                this.fillAsignarContacto.nidcontacto = data['nIdContacto'];
                                // this.fillAsignarContacto.ccontacto = data['cContacto'];
                                this.fillAsignarContacto.cnrodocumento = data['cNumeroDocumento'];
                                this.fillAsignarContacto.cdireccion = data['cDireccion'];
                                this.fillAsignarContacto.cemail = data['cEmail'];
                                this.tabAsignarContacto();
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
                    case 'campaña':
                    {
                        switch(accion){
                            case 'detalle':
                            {
                                this.fillEventoCampania.cNombreEventoCampania = data['cNombreEventoCampania'];
                                this.fillEventoCampania.TipoEvento = data['TipoEvento'];
                                this.fillEventoCampania.nIdEventoCampania = data['nIdEventoCampania'];
                                this.accionmodal=6;
                                this.modal = 1;
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
            siguienteTabDConfirmarcotizacion(){
                if(this.validarTabDCElementoVenta()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#tab0301').removeClass('nav-link active');
                $('#tab0301').addClass('nav-link');
                $('#tab0302').removeClass('nav-link active');
                $('#tab0302').addClass('nav-link');
                $('#tab0303').removeClass('nav-link active');
                $('#tab0303').addClass('nav-link');
                $('#tab0304').removeClass('nav-link disabled');
                $('#tab0304').addClass('nav-link active');

                $('#TabDCVehiculo').removeClass('in active show');
                $('#TabDCElementoVenta').removeClass('in active show');
                $('#TabDCVerificarCampana').removeClass('in active show');
                $('#TabDCConfirmarCotizacion').addClass('in active show');

                this.llenarDetalleConfirmacion();
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


