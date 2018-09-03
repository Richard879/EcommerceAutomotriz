<template>
    <main>
        <header class="page-header">
          <div class="container-fluid">
            <h2 class="no-margin-bottom"> OBJETIVOS COMERCIALES -  {{ fillObjComerciales.cempresa }} </h2>
          </div>
        </header>

        <section class="forms">
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab01" href="#TabCompra" @click="tabCompra" role="tab" data-toggle="tab">
                                        <i class="fa fa-list"></i> COMPRA
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab02" href="#TabVenta" @click="tabVenta" role="tab" data-toggle="tab">
                                        <i class="fa fa-user"></i> VENTA
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active show" id="TabCompra">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="h4">OBJETIVOS COMERCIALES COMPRA</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="form-horizontal">
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Empresa</label>
                                                                        <div class="col-sm-8">
                                                                            <label v-text="fillObjComerciales.cempresa" class="form-control-label-readonly"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Sucursal</label>
                                                                        <div class="col-sm-8">
                                                                            <label v-text="fillObjComerciales.csucursal" class="form-control-label-readonly"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Año</label>
                                                                        <div class="col-sm-8">
                                                                            <label v-text="fillObjComerciales.caño" class="form-control-label-readonly"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Mes</label>
                                                                        <div class="col-sm-8">
                                                                            <label v-text="fillObjComerciales.cmes" class="form-control-label-readonly"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Tipo Beneficio</label>
                                                                        <div class="col-sm-8">
                                                                            <div class="input-group">
                                                                                <input type="text" v-model="fillTipoBeneficio.ctipobeneficionombre" disabled="disabled" class="form-control form-control-sm">
                                                                                <div class="input-group-prepend">
                                                                                    <button type="button" title="Buscar Tipo de Beneficio" class="btn btn-info btn-corner btn-sm" @click="abrirModal('tipobeneficio','buscar')">
                                                                                        <i class="fa-lg fa fa-search"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                                                                <div class="col-sm-6 offset-sm-5">
                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarDetalleVehículo(1)">
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
                                                        <form class="form-horizontal">
                                                            <div class="col-lg-12">
                                                                <template v-if="arrayDetalleVehiculoAdd.length">
                                                                    <div class="table-responsive barraLateral">
                                                                        <table class="table table-striped table-sm">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Proveedor</th>
                                                                                    <th>Linea</th>
                                                                                    <th>Marca</th>
                                                                                    <th>Modelo</th>
                                                                                    <th>Objetivo (Cantidad)</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="detalle in arrayDetalleVehiculoAdd" :key="detalle.nIdVersionVeh">
                                                                                    <td v-text="detalle.Proveedor"></td>
                                                                                    <td v-text="detalle.Linea"></td>
                                                                                    <td v-text="detalle.Marca"></td>
                                                                                    <td v-text="detalle.Modelo"></td>
                                                                                    <td><input type="number" min="0" class="form-control form-control-sm" v-model="detalle.cantidad"/></td>
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
                                                        <hr>
                                                        <div class="col-lg-12" v-if="arrayDetalleVehiculoAdd.length">
                                                            <div class="form-group row">
                                                                <div class="col-md-9 offset-md-5">
                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="registrarObjComercial(1)">
                                                                        <i class="fa fa-save"></i> Registrar
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="TabVenta">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="h4">OBJETIVOS COMERCIALES VENTA</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="form-horizontal">
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Empresa</label>
                                                                        <div class="col-sm-8">
                                                                            <label v-text="fillObjComerciales.cempresa" class="form-control-label-readonly"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Sucursal</label>
                                                                        <div class="col-sm-8">
                                                                            <label v-text="fillObjComerciales.csucursal" class="form-control-label-readonly"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Año</label>
                                                                        <div class="col-sm-8">
                                                                            <label v-text="fillObjComerciales.caño" class="form-control-label-readonly"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Mes</label>
                                                                        <div class="col-sm-8">
                                                                            <label v-text="fillObjComerciales.cmes" class="form-control-label-readonly"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Tipo Beneficio</label>
                                                                        <div class="col-sm-8">
                                                                            <div class="input-group">
                                                                                <input type="text" v-model="fillTipoBeneficio.ctipobeneficionombre" disabled="disabled" class="form-control form-control-sm">
                                                                                <div class="input-group-prepend">
                                                                                    <button type="button" title="Buscar Tipo de Beneficio" class="btn btn-info btn-corner btn-sm" @click="abrirModal('tipobeneficio','buscar')">
                                                                                        <i class="fa-lg fa fa-search"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                                                                <div class="col-sm-6 offset-sm-5">
                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarDetalleVehículo(1)">
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
                                                        <form class="form-horizontal">
                                                            <div class="col-lg-12">
                                                                <template v-if="arrayDetalleVehiculoAdd.length">
                                                                    <div class="table-responsive barraLateral">
                                                                        <table class="table table-striped table-sm">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Proveedor</th>
                                                                                    <th>Linea</th>
                                                                                    <th>Marca</th>
                                                                                    <th>Modelo</th>
                                                                                    <th>Objetivo (Cantidad)</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="detalle in arrayDetalleVehiculoAdd" :key="detalle.nIdVersionVeh">
                                                                                    <td v-text="detalle.Proveedor"></td>
                                                                                    <td v-text="detalle.Linea"></td>
                                                                                    <td v-text="detalle.Marca"></td>
                                                                                    <td v-text="detalle.Modelo"></td>
                                                                                    <td><input type="number" min="0" class="form-control form-control-sm" v-model="detalle.cantidad"/></td>
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
                                                        <hr>
                                                        <div class="col-lg-12" v-if="arrayDetalleVehiculoAdd.length">
                                                            <div class="form-group row">
                                                                <div class="col-md-9 offset-md-5">
                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="registrarObjComercial(2)">
                                                                        <i class="fa fa-save"></i> Registrar
                                                                    </button>
                                                                </div>
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

        <!-- Modal Buscar Proveedores -->
        <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                                                    <input type="text" v-model="fillTipoBeneficio.ctipobeneficionombre" @keyup.enter="buscaTipoIncentivo" class="form-control form-control-sm">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" title="Buscar Tipo Beneficio" class="btn btn-info btn-corner btn-sm" @click="buscaTipoIncentivo">
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
                                                <template v-if="arrayTipoBeneficio.length">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>Seleccione</th>
                                                                    <th>Nombre Beneficio</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="tipobeneficio in arrayTipoBeneficio" :key="tipobeneficio.nIdPar">
                                                                    <td>
                                                                        <a href="#" @click="asignarTipoBeneficio(tipobeneficio);">
                                                                            <i class='fa-md fa fa-check-circle'></i>
                                                                        </a>
                                                                    </td>
                                                                    <td v-text="tipobeneficio.cParNombre"></td>
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
                                                                            <a @click.prevent="cambiarPaginaTipoBeneficio(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                        </li>
                                                                        <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                        :class="[page==isActivedModal?'active':'']">
                                                                            <a class="page-link"
                                                                            href="#" @click.prevent="cambiarPaginaTipoBeneficio(page)"
                                                                            v-text="page"></a>
                                                                        </li>
                                                                        <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                            <a @click.prevent="cambiarPaginaTipoBeneficio(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                fillObjComerciales:{
                    nidempresa: 1300011,
                    cempresa: 'SAISAC',
                    nidsucursal: 1300013,
                    csucursal: 'CHICLAYO',
                    nidcronograma: 0,
                    cflagtipobeneficio: 0,
                    caño: '',
                    cmes: ''
                },
                fillTipoBeneficio: {
                    nidtipobeneficio: 0,
                    ctipobeneficionombre: ''
                },
                arrayTipoBeneficio: [],
                fillProveedor:{
                    nidproveedor: 0,
                    cproveedornombre: ''
                },
                arrayProveedor: [],
                arrayDetalleVehiculo: [],
                arrayDetalleVehiculoAdd: [],
                // =============================================================
                // VARIABLES GENÉRICAS
                // =============================================================
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
        mounted(){
            this.llenarCompraActiva();
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
            llenarCompraActiva(){
                var url = this.ruta + '/getObjComercial/getCompraActiva';
                axios.get(url).then(response => {
                    this.fillObjComerciales.caño = response.data[0].cAnio;
                    this.fillObjComerciales.cmes = response.data[0].cMes;
                    this.fillObjComerciales.nidcronograma = response.data[0].nIdCronograma;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarVentaActiva(){
                var url = this.ruta + '/getObjComercial/getVentaActiva';
                axios.get(url).then(response => {
                    this.fillObjComerciales.caño = response.data[0].cAnio;
                    this.fillObjComerciales.cmes = response.data[0].cMes;
                    this.fillObjComerciales.nidcronograma = response.data[0].nIdCronograma;
                }).catch(error => {
                    console.log(error);
                });
            },
            tabCompra(){
                this.llenarCompraActiva();
                this.limpiarProceso();
            },
            tabVenta(){
                this.llenarVentaActiva();
                this.limpiarProceso();
            },
            // =======================
            // MODAL PROVEEDOR
            // =======================
            buscaTipoIncentivo(){
                this.listarTipoBeneficio(1);
            },
            listarTipoBeneficio(page){
                var url = this.ruta + '/getObjComercial/GetLstTipoBeneficio';
                axios.get(url, {
                    params: {
                        'nidempresa': this.fillObjComerciales.nidempresa,
                        'nidgrupopar' : 110069,
                        'ctipobeneficionombre' : this.fillTipoBeneficio.ctipobeneficionombre.toString(),
                        'opcion' : 1,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayTipoBeneficio = response.data.arrayTipoIncentivo.data;
                    this.paginationModal.current_page   =  response.data.arrayTipoIncentivo.current_page;
                    this.paginationModal.total          = response.data.arrayTipoIncentivo.total;
                    this.paginationModal.per_page       = response.data.arrayTipoIncentivo.per_page;
                    this.paginationModal.last_page      = response.data.arrayTipoIncentivo.last_page;
                    this.paginationModal.from           = response.data.arrayTipoIncentivo.from;
                    this.paginationModal.to             = response.data.arrayTipoIncentivo.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaTipoBeneficio(page){
                this.paginationModal.current_page=page;
                this.listarTipoBeneficio(page);
            },
            asignarTipoBeneficio(tipobeneficio){
                this.fillTipoBeneficio.nidtipobeneficio = tipobeneficio.nIdPar;
                this.fillTipoBeneficio.ctipobeneficionombre = tipobeneficio.cParNombre;
                this.fillObjComerciales.cflagtipobeneficio = tipobeneficio.cParAbreviatura;
                this.cerrarModal();
            },
            // =======================
            // MODAL PROVEEDOR
            // =======================
            buscaProveedores(){
                this.listarProveedores(1);
            },
            listarProveedores(page){
                var url = this.ruta + '/parametro/GetLstProveedor';
                axios.get(url, {
                    params: {
                        'nidempresa': this.fillObjComerciales.nidempresa,
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
            },
            // =======================
            // BUSCAR DETALLE DE VEHÍCULO
            // =======================
            buscarDetalleVehículo(page){
                if(this.validaBuscarDetalleVehículo()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                var url = this.ruta + '/getObjComercial/getDetalleVehiculo';
                axios.get(url, {
                    params: {
                        'nidproveedor': this.fillProveedor.nidproveedor,
                        'page' : page
                    }
                }).then(response => {
                    let info = response.data;
                    //Data
                    this.arrayDetalleVehiculo  = info;
                    this.llenarArrayDetalleVehiculo();
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaDetalleVehiculo(page){
                this.pagination.current_page=page;
                // this.buscarDetalleVehículo(page);
            },
            validaBuscarDetalleVehículo(){
                this.error = 0;
                this.mensajeError =[];

                if(this.fillProveedor.nidproveedor == 0 && !this.fillProveedor.cproveedornombre){
                    this.mensajeError.push('Debe seleccionar un proveedor');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            llenarArrayDetalleVehiculo(){
                let me = this;
                if(me.arrayDetalleVehiculo.length > 0){
                    me.arrayDetalleVehiculo.map(function(ev){
                        me.arrayDetalleVehiculoAdd.push({
                            nIdVersionVeh   : ev.nIdVersionVeh,
                            nIdProveedor    : ev.nIdProveedor,
                            Proveedor       : ev.Proveedor,
                            nIdLinea        : ev.nIdLinea,
                            Linea           : ev.Linea,
                            nIdMarca        : ev.nIdMarca,
                            Marca           : ev.Marca,
                            nIdModelo       : ev.nIdModelo,
                            Modelo          : ev.Modelo,
                            cNombreComercial: ev.cNombreComercial,
                            cantidad        : ''
                        });
                    });
                }
            },
            // =======================
            // REGISTRAR OBJETIVO COMERCIAL
            // =======================
            registrarObjComercial(data){
                if(this.validarRegistrarObjComercial(data)){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                var url = this.ruta + '/getObjComercial/SetRegistrarObjeComercial';
                axios.post(url, {
                    'nIdEmpresa'            :   this.fillObjComerciales.nidempresa,
                    'nIdSucursal'           :   this.fillObjComerciales.nidsucursal,
                    'nIdProveedor'          :   this.fillProveedor.nidproveedor,
                    'nIdCronograma'         :   this.fillObjComerciales.nidcronograma,
                    'cFlagTipoOperacion'    :   (data) == 1 ? 'C' : 'V',
                    'cFlagTipoBeneficio'    :   this.fillObjComerciales.cflagtipobeneficio,
                    'cFlagTipoValor'        :   '',
                    'fValorPorcentual'      :   0,
                    'fValorMoneda'          :   0,
                    'arrayData'             :   this.arrayDetalleVehiculoAdd
                }).then(response => {
                    (data) == 1 ?
                        swal('Objetivo Comercial - Compra registrada exitosamente') :
                        swal('Objetivo Comercial - Venta registrada exitosamente');
                    this.limpiarProceso();
                }).catch(error => {
                    this.errors = error
                });
            },
            validarRegistrarObjComercial(){
                this.error = 0;
                this.mensajeError =[];

                if(this.fillTipoBeneficio.nidtipobeneficio == 0 && !this.fillTipoBeneficio.ctipobeneficionombre){
                    this.mensajeError.push('Debe seleccionar un tipo de beneficio');
                }
                if(this.fillProveedor.nidproveedor == 0 && !this.fillProveedor.cproveedornombre){
                    this.mensajeError.push('Debe seleccionar un proveedor');
                }
                if(this.arrayDetalleVehiculoAdd.length == 0){
                    this.mensajeError.push('Debe agregar Detalle de Vehículos');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // =================================================================
            // METODOS GENERICOS
            // =================================================================
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "proveedor":
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
                    case "tipobeneficio":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=3;
                                this.modal=1;
                                this.listarTipoBeneficio(1);
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
            limpiarProceso(){
                this.fillObjComerciales.cflagtipobeneficio = '';
                this.fillTipoBeneficio.nidtipobeneficio = 0;
                this.fillTipoBeneficio.ctipobeneficionombre = '';
                this.fillProveedor.nidproveedor = 0;
                this.fillProveedor.cproveedornombre = '';
                this.arrayDetalleVehiculoAdd = [];
            },
            //Cerrar Modal
            cerrarModal(){
                this.modal = 0;
                this.accionmodal = 0;
                this.error = 0;
                this.mensajeError = '';
                this.limpiarPaginacion();
                this.limpiarPaginacionModal();
                //Modal Buscar Proveedores
                this.arrayProveedor = [];
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
    .barraLateral{
        height: 38vh;
        overflow-y: scroll;
    }
</style>

