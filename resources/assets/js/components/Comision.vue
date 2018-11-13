<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom"> CONFIGURACIÓN DE COMISIONES</h2>
                </div>
            </header>

            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h4">CONFIGURACIÓN DE COMISIONES</h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Empresa</label>
                                                <div class="col-sm-8">
                                                    <input type="text" v-model="cempresa" class="form-control form-control-sm" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Sucursal</label>
                                                <div class="col-sm-8">
                                                    <input type="text" v-model="csucursal" class="form-control form-control-sm" readonly>
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
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label class="col-md-4 form-control-label">* Concepto de Comisión</label>
                                                <div class="col-md-8 widthFull">
                                                    <el-select v-model="fillConfigurarComision.nidconcepto"
                                                            filterable
                                                            clearable
                                                            loading-text
                                                            placeholder="Seleccione un Concepto Comisión">
                                                        <el-option
                                                            v-for="concepto in arrayConceptoComision"
                                                            :key="concepto.nIdPar"
                                                            :label="concepto.cParNombre"
                                                            :value="concepto.nIdPar">
                                                        </el-option>
                                                    </el-select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-md-4 form-control-label">* Por Turno de Vendedor</label>
                                                <div class="col-md-5">
                                                    <div class="input-group" :class="[checked ? 'disabled' : '']">
                                                        <input type="text" v-model="fillConfigurarComision.cnombreturno" disabled="disabled" class="form-control form-control-sm">
                                                        <div class="input-group-prepend">
                                                            <button type="button" title="Buscar Turno Vendedor" class="btn btn-info btn-corner btn-sm" @click="abrirModal('turno','buscar')">
                                                                <i class="fa-lg fa fa-search"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="i-checks">
                                                        <input id="checkbox" type="checkbox" class="checkbox-template" v-model="checked" @change="updateEstadoChecked">
                                                        <label class="form-control-label" v-text="checked ? 'InHabilitado' : 'Habilitado'"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Flag Comisión</label>
                                                <div class="col-sm-6">
                                                    <label class="checkbox-inline" v-for="tipo in arrayFlagComision" :key="tipo.id">
                                                        <input :id="tipo.value" type="radio" class="radio-template" v-model="fillConfigurarComision.nidflagcomision" :value="tipo.value">
                                                        <label :for="tipo.value" class="form-control-label" v-text="tipo.text"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    </label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="button" title="Buscar Flag Comisión" class="btn btn-info btn-corner btn-sm" @click="abrirModal('flagComision','buscar', fillConfigurarComision.nidflagcomision)">
                                                        <i class="fa-lg fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Tipo Comisión</label>
                                                <div class="col-md-8 widthFull">
                                                    <el-select v-model="fillConfigurarComision.nidtipocomision"
                                                            filterable
                                                            clearable
                                                            loading-text
                                                            placeholder="Seleccione un Tipo Comisión">
                                                        <el-option
                                                            v-for="tipocomision in arrayTipoComision"
                                                            :key="tipocomision.nIdPar"
                                                            :label="tipocomision.cParNombre"
                                                            :value="tipocomision.nIdPar">
                                                        </el-option>
                                                    </el-select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Tipo Moneda</label>
                                                <div class="col-md-8 widthFull">
                                                    <el-select v-model="fillConfigurarComision.nidtipomoneda"
                                                            filterable
                                                            clearable
                                                            loading-text
                                                            placeholder="Seleccione un Tipo Moneda">
                                                        <el-option
                                                            v-for="moneda in arrayTipoMoneda"
                                                            :key="moneda.nIdPar"
                                                            :label="moneda.cParNombre"
                                                            :value="moneda.nIdPar">
                                                        </el-option>
                                                    </el-select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Valor</label>
                                                <div class="col-sm-8">
                                                    <input type="number" min="1" v-model="fillConfigurarComision.nvalor" class="form-control form-control-sm">
                                                    <input type="hidden" :value="fillDetalleFlagComision.flagTipo = verificarFlagTipo">
                                                </div>
                                            </div>
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
                                    <template v-if="fillDetalleFlagComision.flagTipo == 'E'">
                                        <template v-if="fillDetalleFlagComision.arrayElementoVenta.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Acción</th>
                                                            <th>Codigo</th>
                                                            <th>Elemento Venta</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(elementoventa, index) in fillDetalleFlagComision.arrayElementoVenta" :key="elementoventa.nIdElemento">
                                                            <td>
                                                                <a href="#" @click="removerElementoVentaLista(index);">
                                                                    <i :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                </a>
                                                            </td>
                                                            <td v-text="elementoventa.nIdElemento"></td>
                                                            <td v-text="elementoventa.cElemenNombre"></td>
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
                                    </template>
                                    <template v-else-if="fillDetalleFlagComision.flagTipo == 'L'">
                                        <template v-if="fillDetalleFlagComision.arrayLineas.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Acción</th>
                                                            <th>Codigo</th>
                                                            <th>Linea</th>
                                                            <th>Abreviatura</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(lineas, index) in fillDetalleFlagComision.arrayLineas" :key="lineas.nIdLinea">
                                                            <td>
                                                                <a href="#" @click="removerLineasByProveedorLista(index);">
                                                                    <i :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                </a>
                                                            </td>
                                                            <td v-text="lineas.nIdLinea"></td>
                                                            <td v-text="lineas.cLineaNombre"></td>
                                                            <td v-text="lineas.cLineaAbreviatura"></td>
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
                                    </template>
                                    <div class="form-group row">
                                        <div class="col-md-9 offset-md-5">
                                            <button v-if="fillDetalleFlagComision.flagTipo == 'E'" type="button" class="btn btn-success btn-corner btn-sm" @click="registrarComision(1)">
                                                <i class="fa fa-save"></i> Registrar
                                            </button>
                                            <button v-if="fillDetalleFlagComision.flagTipo == 'L'" type="button" class="btn btn-success btn-corner btn-sm" @click="registrarComision(2)">
                                                <i class="fa fa-save"></i> Registrar
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">LISTA DE PROVEEDORES</h3>
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
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Buscar Lineas Por Proveedor -->
            <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form v-on:submit.prevent class="form-horizontal">
                                <div class="container-fluid">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">BUSQUEDA LINEAS POR PROVEEDOR</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                            <div class="col-sm-8">
                                                                <h3 class="h4" v-text="fillProveedor.cproveedornombre"></h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <template v-if="arrayLineaModal.length">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Seleccione</th>
                                                                <th>Linea</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="linea in arrayLineaModal" :key="linea.nIdLinea">
                                                                <td>
                                                                    <a href="#" @click="agregarLineasByProveedorLista(linea);">
                                                                        <i class='fa-md fa fa-check-circle'></i>
                                                                    </a>
                                                                </td>
                                                                <td v-text="linea.cLineaNombre"></td>
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
                                                                        <a @click.prevent="cambiarPaginaLineaByProveedor(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                    </li>
                                                                    <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                    :class="[page==isActivedModal?'active':'']">
                                                                        <a class="page-link"
                                                                        href="#" @click.prevent="cambiarPaginaLineaByProveedor(page)"
                                                                        v-text="page"></a>
                                                                    </li>
                                                                    <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                        <a @click.prevent="cambiarPaginaLineaByProveedor(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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

            <!-- Modal Buscar Elemento de Venta -->
            <div class="modal fade" v-if="accionmodal==4" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form v-on:submit.prevent class="form-horizontal">
                                <div class="container-fluid">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">BUSQUEDA ELEMENTO VENTA</h3>
                                        </div>
                                        <div class="card-body">
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
                                                <label class="col-md-2 form-control-label">Tipo Elemento</label>
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <select name="account" v-model="fillBusqTipoElemento.ntpoelemen" class="form-control form-control-sm">
                                                            <option v-for="elemento in arrayTipoElemento" :key="elemento.nIdPar" :value="elemento.nIdPar" v-text="elemento.cParNombre">
                                                            </option>
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button type="button" title="Buscar" class="btn btn-info btn-corner btn-sm" @click="buscarElementoVenta(1)">
                                                                <i class="fa-lg fa fa-search"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 form-control-label">Nombre Elemento</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="text" v-model="fillBusqTipoElemento.celementonombre" @keyup.enter="buscarElementoVenta(1)" class="form-control form-control-sm">
                                                        <div class="input-group-prepend">
                                                            <button type="button" title="Buscar" class="btn btn-info btn-corner btn-sm" @click="buscarElementoVenta(1)">
                                                                <i class="fa-lg fa fa-search"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>
                                            <template v-if="arrayElementoVentaModal.length">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Acciones</th>
                                                                <th>Código</th>
                                                                <th>Accesorio</th>
                                                                <th>Precio</th>
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
                                                                <td v-text="elemento.cElemenNombre"></td>
                                                                <td v-text="elemento.fElemenValorVenta"></td>
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
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Buscar Turnos -->
            <div class="modal fade" v-if="accionmodal==5" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form v-on:submit.prevent class="form-horizontal">
                                <div class="container-fluid">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">LISTADO TURNOS DE VENDEDORES</h3>
                                        </div>
                                        <div class="card-body">
                                            <template v-if="arrayTurnoVendedor.length">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Seleccione</th>
                                                                <th>Nombre Turno</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="turno in arrayTurnoVendedor" :key="turno.nIdPar">
                                                                <td>
                                                                    <a href="#" @click="asignarTurno(turno);">
                                                                        <i class='fa-md fa fa-check-circle'></i>
                                                                    </a>
                                                                </td>
                                                                <td v-text="turno.cParNombre"></td>
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
                // =======================
                // VARIABLES FORMULARIO
                // =======================
                fillConfigurarComision:{
                    nidconcepto: 0,
                    nidturnovendedor: 0,
                    cflagturno: '',
                    cnombreturno: '',
                    nidflagcomision: '1',
                    nidtipocomision: 0,
                    nidtipomoneda: 0,
                    nvalor: '1'
                },
                arrayConceptoComision: [],
                arrayTurnoVendedor: [],
                arrayFlagComision: [
                    { value: '1', text: 'Por Linea'},
                    { value: '2', text: 'Por Elemento Venta'}
                ],
                checked: true,
                arrayTipoComision: [],
                arrayTipoMoneda: [],
                // =======================
                // VARIABLES PROVEEDOR
                // =======================
                fillProveedor:{
                    nidproveedor: 0,
                    cproveedornombre: ''
                },
                arrayProveedor: [],
                // =======================
                // VARIABLES ELE VENTA
                // =======================
                fillBusqTipoElemento: {
                    ntpoelemen: 0,
                    celementonombre: ''
                },
                arrayTipoElemento: [],
                arrayElementoVentaModal: [],
                // =======================
                // VARIABLES LINEA
                // =======================
                arrayLineaModal:[],
                fillDetalleFlagComision:{
                    flagTipo: '',
                    arrayLineas: [],
                    arrayElementoVenta: []
                },
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
            this.llenarConceptoComision();
            this.llenarTipoComision();
            this.llenarTipoMoneda();
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
            verificarFlagTipo: function() {
                if (this.fillDetalleFlagComision.arrayElementoVenta.length == 0 && this.fillDetalleFlagComision.arrayLineas.length == 0) {
                    return this.fillDetalleFlagComision.flagTipo = '';
                }
                if (this.fillDetalleFlagComision.arrayElementoVenta.length > 0){
                    return this.fillDetalleFlagComision.flagTipo = 'E';
                }
                if(this.fillDetalleFlagComision.arrayLineas.length > 0){
                    return this.fillDetalleFlagComision.flagTipo = 'L';
                }
            }
        },
        methods: {
            llenarConceptoComision(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110064,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayConceptoComision = response.data;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            llenarTipoComision(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110065,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayTipoComision = response.data;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            llenarTipoMoneda(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110028,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayTipoMoneda = response.data;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
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
                        'nidempresa': 1300011,
                        'nidgrupopar' : 110023,
                        'cnombreproveedor' : this.fillProveedor.cproveedornombre.toString(),
                        'opcion' : 0,
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
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
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
            // MODAL TURNO COMISIÓN
            // =======================
            buscaTurno(){
                this.listarTurnos(1);
            },
            listarTurnos(page){
                var url = this.ruta + '/getComision/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110066,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayTurnoVendedor = response.data;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            asignarTurno(turno){
                this.fillConfigurarComision.nidturnovendedor = turno.nIdPar;
                this.fillConfigurarComision.cnombreturno = turno.cParNombre;
                this.fillConfigurarComision.cflagturno = turno.cParAbreviatura;
                this.cerrarModal();
            },
            updateEstadoChecked(){
                if(this.checked){
                    this.fillConfigurarComision.nidturnovendedor = 0;
                    this.fillConfigurarComision.cnombreturno = '';
                    this.fillConfigurarComision.cflagturno = '';
                }
            },
            // =======================
            // MODAL ELEMENTO VENTA
            // =======================
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
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            buscarElementoVenta(page){
                /*if(this.validarBuscarElementoVenta()){
                    return;
                }*/

                var url = this.ruta + '/elemento/GetElementoByTipo';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidtipoelemen' : this.fillBusqTipoElemento.ntpoelemen,
                        'celementonombre': this.fillBusqTipoElemento.celementonombre,
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
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
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
                    this.fillDetalleFlagComision.flagTipo = 'E';

                    this.fillDetalleFlagComision.arrayElementoVenta.push({
                        cCodigoERP              : elemento.cCodigoERP,
                        cElemenNombre           : elemento.cElemenNombre,
                        fElemenValorVenta       : elemento.fElemenValorVenta,
                        nIdElemento             : elemento.nIdElemento,
                        nIdMoneda               : elemento.nIdMoneda,
                        nIdProveedor            : elemento.nIdProveedor
                    });

                    //toastr.options.progressBar = true;
                    //toastr.options.closeButton = true;
                    toastr.success('Agrego el elemento de venta "'+ elemento.cElemenNombre +'" exitosamente');
                }
            },
            encontrarElementoVenta(elemento){
                var sw=0;
                this.fillDetalleFlagComision.arrayElementoVenta.map(function (x) {
                    if(x.cElemenNombre == elemento){
                        sw = true;
                    }
                });
                return sw;
            },
            removerElementoVentaLista(index){
                this.$delete(this.fillDetalleFlagComision.arrayElementoVenta, index);
            },
            // =======================
            // MODAL LINEAS BY PROVEEDOR
            // =======================
            validarFlagComision(data){
                this.error = 0;
                this.mensajeError =[];

                if (data == 1) {
                    if(!this.fillProveedor.cproveedornombre){
                        this.mensajeError.push('Debe agregar un proveedor');
                    }

                    if(this.fillDetalleFlagComision.arrayElementoVenta.length > 0){
                        this.mensajeError.push('Se encuentran agregados elementos de venta');
                    }
                } else {
                    if(this.fillDetalleFlagComision.arrayLineas.length > 0){
                        this.mensajeError.push('Se encuentran agregadas lineas');
                    }
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            cargarLineasByProveedor(){
                var url = this.ruta + '/getComision/GetLineasByProveedor';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidproveedor' : this.fillProveedor.nidproveedor
                    }
                }).then(response => {
                    this.arrayLineaModal = response.data.arrayLinea.data;
                    this.paginationModal.current_page  =   response.data.arrayLinea.current_page;
                    this.paginationModal.total         =   response.data.arrayLinea.total;
                    this.paginationModal.per_page      =   response.data.arrayLinea.per_page;
                    this.paginationModal.last_page     =   response.data.arrayLinea.last_page;
                    this.paginationModal.from          =   response.data.arrayLinea.from;
                    this.paginationModal.to            =   response.data.arrayLinea.to;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            cambiarPaginaLineaByProveedor(page){
                this.pagination.current_page=page;
                this.cargarLineasByProveedor(page);
            },
            agregarLineasByProveedorLista(linea){
                if(this.encontrarLineasByProveedor(linea.cLineaNombre)){
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'La Linea ya se encuentra agregado!',
                    })
                } else {
                    this.fillDetalleFlagComision.flagTipo = 'L';

                    this.fillDetalleFlagComision.arrayLineas.push({
                        nIdLinea                : linea.nIdLinea,
                        cLineaNombre            : linea.cLineaNombre,
                        cLineaAbreviatura       : linea.cLineaAbreviatura,
                        nIdProveedor            : linea.nIdProveedor,
                        cProveedorNombre        : linea.cProveedorNombre,
                        cProveedorAbreviatura   : linea.cProveedorAbreviatura,
                    });

                    //toastr.options.progressBar = true;
                    //toastr.options.closeButton = true;
                    toastr.success('Agrego el linea de venta "'+ linea.cLineaNombre +'" exitosamente');
                }
            },
            encontrarLineasByProveedor(linea){
                var sw=0;
                this.fillDetalleFlagComision.arrayLineas.map(function (x) {
                    if(x.cLineaNombre == linea){
                        sw = true;
                    }
                });
                return sw;
            },
            removerLineasByProveedorLista(index){
                this.$delete(this.fillDetalleFlagComision.arrayLineas, index);
            },
            // =======================
            // REGISTRAR CONFIGURACIÓN DE COMISIÓN
            // =======================
            registrarComision(data){
                if(this.validarRegistrarComision(data)){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                var url = this.ruta + '/getComision/SetRegistrarComision';
                axios.post(url, {
                    'nIdEmpresa'            :   1300011,
                    'nIdSucursal'           :   sessionStorage.getItem("nIdSucursal"),
                    'nIdProveedor'          :   this.fillProveedor.nidproveedor,
                    'nIdConceptoComision'   :   this.fillConfigurarComision.nidconcepto,
                    'nIdMoneda'             :   this.fillConfigurarComision.nidtipomoneda,
                    'cFlagTurno'            :   this.fillConfigurarComision.cflagturno,
                    'nIdTurnoVendedor'      :   this.fillConfigurarComision.nidturnovendedor,
                    'cFlagComisionVehiculo' :   (data) == 1 ? 'N' : 'S',
                    'cFlagElementoVenta'    :   (data) == 1 ? 'S' : 'N',
                    'cFlagTipoComision'     :   (this.fillConfigurarComision.nidtipocomision) == '1300167' ? 'M' : 'P',
                    'fValorPorcentual'      :   (this.fillConfigurarComision.nidtipocomision) == '1300167' ?  0 : this.fillConfigurarComision.nvalor,
                    'fValorMoneda'          :   (this.fillConfigurarComision.nidtipocomision) == '1300167' ? this.fillConfigurarComision.nvalor : 0,
                    'arrayData'             :   (data) == 1 ? this.fillDetalleFlagComision.arrayElementoVenta : this.fillDetalleFlagComision.arrayLineas,
                    'tipo'                  :   data
                }).then(response => {
                    swal('Comisión registrada exitosamente');
                    this.limpiarProceso();
                }).catch(error => {
                    this.errors = error
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            validarRegistrarComision(data){
                this.error = 0;
                this.mensajeError =[];

                if(this.fillConfigurarComision.nidconcepto == 0){
                    this.mensajeError.push('Debe seleccionar un concepto de comisión');
                }
                if(this.fillConfigurarComision.nidtipocomision == 0){
                    this.mensajeError.push('Debe seleccionar un tipo de comisión');
                }
                if(!this.checked){
                    if(this.fillConfigurarComision.nidturnovendedor == 0){
                        this.mensajeError.push('Debe seleccionar un turno de vendedor');
                    }
                }
                if(this.fillConfigurarComision.nidtipomoneda == 0){
                    this.mensajeError.push('Debe seleccionar un tipo de moneda');
                }
                if(data == 1){
                    if(this.fillDetalleFlagComision.arrayElementoVenta.length == 0){
                        this.mensajeError.push('Debe agregar elementos de venta antes de Registrar');
                    }
                } else {
                    if(this.fillDetalleFlagComision.arrayLineas.length == 0){
                        this.mensajeError.push('Debe agregar lineas antes de Registrar');
                    }
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
                    case "turno":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=5;
                                this.modal = 1;
                                this.listarTurnos(1);
                                break;
                            }
                        }
                    }
                    break;
                    case 'flagComision':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                if(data == 1){
                                    if(this.validarFlagComision(data)){
                                        this.accionmodal=1;
                                        this.modal = 1;
                                        return;
                                    }
                                    this.cargarLineasByProveedor();
                                    this.accionmodal=3;
                                    this.modal=1;
                                } else {
                                    if(this.validarFlagComision(data)){
                                        this.accionmodal=1;
                                        this.modal = 1;
                                        return;
                                    }
                                    this.accionmodal=4;
                                    this.modal=1;
                                    this.cargarTipoElemento();
                                }
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
                this.fillProveedor.nidproveedor = 0;
                this.fillProveedor.cproveedornombre = '';
                this.checked = true;
                this.fillConfigurarComision.cflagturno = '';
                this.fillConfigurarComision.cnombreturno = '';
                this.fillConfigurarComision.nidturnovendedor = '';
                this.fillConfigurarComision.nidflagcomision = 1;
                this.fillBusqTipoElemento.ntpoelemen = 0;
                this.fillConfigurarComision.nidconcepto = 0;
                this.fillConfigurarComision.nidtipocomision = 0;
                this.fillConfigurarComision.nidtipomoneda = 0;
                this.fillConfigurarComision.nvalor = 0;
                this.fillDetalleFlagComision.arrayElementoVenta = [];
                this.fillDetalleFlagComision.arrayLineas = [];
                this.fillDetalleFlagComision.flagTipo = '';

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
    .disabled{
        opacity: 0.65;
        cursor: not-allowed;
        border: 2px outset buttonface;
        pointer-events:none;
    }
</style>
