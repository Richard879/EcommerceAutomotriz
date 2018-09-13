<template>
    <main>
        <header class="page-header">
          <div class="container-fluid">
            <h2 class="no-margin-bottom">GESTIÓN DE CONTACTOS JEFE DE VENTAS</h2>
          </div>
        </header>

        <section>
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Tab1" href="#TabMisContactos" @click="tabMisContactos()" role="tab" data-toggle="tab">
                                        <i class="fa fa-users"></i> MIS CONTACTOS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Tab2" href="#TabContactosPorVendedor" @click="tabContactosPorVendedor()" role="tab" data-toggle="tab">
                                        <i class="fa fa-user-circle-o"></i> CONTACTOS POR VENDEDOR
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Tab3" href="#TabContactosLibres" @click="tabContactosLibres()" role="tab" data-toggle="tab">
                                        <i class="fa fa-male"></i> CONTACTOS LIBRES
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="Tab4" href="#TabSeguimiento" role="tab" data-toggle="tab">
                                        <i class="fa fa-angle-double-right"></i> SEGUIMIENTO
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Tab5" href="#TabNuevoContacto" @click="tabNuevoContacto()" role="tab" data-toggle="tab">
                                        <i class="fa fa-user"></i> NUEVO CONTACTO
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Tab5" href="#TabLeads" role="tab" data-toggle="tab">
                                        <i class="fa fa-file-excel-o"></i> LEADS
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active show" id="TabMisContactos">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="h4">BUSCAR CONTACTOS</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="form-horizontal">
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Tipo Persona</label>
                                                                        <div class="col-sm-8">
                                                                            <label class="checkbox-inline" v-for="tipo in arrayTipoPersona" :key="tipo.id">
                                                                                <input type="radio" class="radio-template" v-model="fillMisContactos.ntipopersona" :value="tipo.value" v-on:change="cambiarTipoPersonaMisContactos()">
                                                                                <label for="" class="form-control-label" v-text="tipo.text"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Contacto</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="fillMisContactos.cfiltrodescripcion" @keyup.enter="listarMisContactosJFV(1)" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Nro Documento</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="fillMisContactos.cnrodocumento" @keyup.enter="listarMisContactosJFV(1)" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-9 offset-sm-5">
                                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarMisContactosJFV(1);"><i class="fa fa-search"></i> Buscar</button>
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
                                                        <template v-if="arrayContacto.length">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped table-sm">
                                                                    <template v-if="fillMisContactos.ntipopersona == 1">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Código</th>
                                                                                <th>Apellidos</th>
                                                                                <th>Nombres</th>
                                                                                <th>Nro Documento</th>
                                                                                <th>Telefono</th>
                                                                                <th>Dirección</th>
                                                                                <th>Email</th>
                                                                                <th>Vendedor</th>
                                                                                <th>Acciones</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="c in arrayContacto" :key="c.nIdContacto">
                                                                                <td v-text="c.nIdContacto"></td>
                                                                                <td v-text="c.cPerApellidos"></td>
                                                                                <td v-text="c.cNombre"></td>
                                                                                <td v-text="c.cNumeroDocumento"></td>
                                                                                <td v-text="c.nTelefonoMovil"></td>
                                                                                <td v-text="c.cDireccion"></td>
                                                                                <td v-text="c.cEmail"></td>
                                                                                <td v-text="c.cVendedor"></td>
                                                                                <td>
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Seguimiento {{ c.cPerApellidos + ' ' + c.cNombre }}</div>
                                                                                        <i @click="activarTab3(c.nIdContacto, c.nIdPersonaNatural, 1)" :style="'color:#796AEE'" class="fa-md fa fa-sign-out"></i>
                                                                                    </el-tooltip>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </template>
                                                                    <template v-else>
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Código</th>
                                                                                <th>Razon Social</th>
                                                                                <th>Nro Documento</th>
                                                                                <th>Telefono</th>
                                                                                <th>Email</th>
                                                                                <th>Persona Contacto</th>
                                                                                <th>Vendedor</th>
                                                                                <th>Acciones</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="c in arrayContacto" :key="c.nIdContacto">
                                                                                <td v-text="c.nIdContacto"></td>
                                                                                <td v-text="c.cRazonSocial"></td>
                                                                                <td v-text="c.cNumeroDocumento"></td>
                                                                                <td v-text="c.nTelefonoMovil"></td>
                                                                                <td v-text="c.cEmail"></td>
                                                                                <td v-text="c.cContacto"></td>
                                                                                <td v-text="c.cVendedor"></td>
                                                                                <td>
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Seguimiento {{ c.cRazonSocial }}</div>
                                                                                        <i @click="activarTab3(c.nIdContacto, c.nIdPersonaJuridica, 2)" :style="'color:#796AEE'" class="fa-md fa fa-sign-out"></i>
                                                                                    </el-tooltip>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </template>
                                                                </table>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="row">
                                                                    <div class="col-sm-7">
                                                                        <nav>
                                                                            <ul class="pagination">
                                                                                <li v-if="pagination.current_page > 1" class="page-item">
                                                                                    <a @click.prevent="cambiarPaginaMisContactos(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                </li>
                                                                                <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                :class="[page==isActived?'active':'']">
                                                                                    <a class="page-link"
                                                                                    href="#" @click.prevent="cambiarPaginaMisContactos(page)"
                                                                                    v-text="page"></a>
                                                                                </li>
                                                                                <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                    <a @click.prevent="cambiarPaginaMisContactos(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="TabContactosPorVendedor">
                                    <template v-if="vistaContactoPorVendedor">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">BUSCAR CONTACTOS POR VENDEDOR</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Tipo Persona</label>
                                                                            <div class="col-sm-8">
                                                                                <label class="checkbox-inline" v-for="tipo in arrayTipoPersona" :key="tipo.id">
                                                                                    <input type="radio" class="radio-template" v-model="fillContactoPorVendedor.ntipopersona" :value="tipo.value" v-on:change="cambiarTipoPersonaContactosPorVendedor()">
                                                                                    <label for="" class="form-control-label" v-text="tipo.text"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Vendedor</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="hidden" v-model="formVendedor.nidvendedor">
                                                                                    <input type="text" v-model="formVendedor.cvendedornombre" disabled="disabled" class="form-control form-control-sm">
                                                                                    <div class="input-group-prepend">
                                                                                        <button type="button" title="Buscar Vendedor" class="btn btn-info btn-corner btn-sm" @click="abrirModal('vendedor','buscar')">
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
                                                                            <label class="col-sm-4 form-control-label">Contacto</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillContactoPorVendedor.cfiltrodescripcion" @keyup.enter="buscarContactosPorVendedor()" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Nro Documento</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="number" v-model.number="fillContactoPorVendedor.cnrodocumento" @keyup.enter="buscarContactosPorVendedor()" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-9 offset-sm-5">
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarContactosPorVendedor();">
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
                                                            <template v-if="arrayContactosPorVendedor.length">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-sm">
                                                                        <template v-if="fillContactoPorVendedor.ntipopersona == 1">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Código</th>
                                                                                    <th>Apellidos</th>
                                                                                    <th>Nombres</th>
                                                                                    <th>Nro Documento</th>
                                                                                    <th>Telefono</th>
                                                                                    <th>Dirección</th>
                                                                                    <th>Email</th>
                                                                                    <th>Vendedor</th>
                                                                                    <th>Acciones</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="c in arrayContactosPorVendedor" :key="c.nIdContacto">
                                                                                    <td>{{ c.nIdContacto }}</td>
                                                                                    <td>{{ c.cPerApellidos }}</td>
                                                                                    <td>{{ c.cNombre }}</td>
                                                                                    <td>{{ c.cNumeroDocumento }}</td>
                                                                                    <td>{{ c.nTelefonoMovil }}</td>
                                                                                    <td>{{ c.cDireccion }}</td>
                                                                                    <td>{{ c.cEmail }}</td>
                                                                                    <td>{{ c.cVendedor }}</td>
                                                                                    <td>
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Reasignar Contacto {{ c.cPerApellidos + ' ' + c.cNombre }}</div>
                                                                                            <i @click="mostrarVistaContactoPorVendedor(c.nIdContacto, c.cPerApellidos + ' ' +c.cNombre, c.cVendedor)" :style="'color:blue'" class="fa-md fa fa-street-view"></i>
                                                                                        </el-tooltip>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </template>
                                                                        <template v-else>
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Código</th>
                                                                                    <th>Razon Social</th>
                                                                                    <th>Nro Documento</th>
                                                                                    <th>Telefono</th>
                                                                                    <th>Email</th>
                                                                                    <th>Vendedor</th>
                                                                                    <th>Persona Contacto</th>
                                                                                    <th>Acciones</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="c in arrayContactosPorVendedor" :key="c.nIdContacto">
                                                                                    <td>{{ c.nIdContacto }}</td>
                                                                                    <td>{{ c.cRazonSocial }}</td>
                                                                                    <td>{{ c.cNumeroDocumento }}</td>
                                                                                    <td>{{ c.nTelefonoMovil }}</td>
                                                                                    <td>{{ c.cEmail }}</td>
                                                                                    <td>{{ c.cContacto }}</td>
                                                                                    <td>{{ c.cVendedor }}</td>
                                                                                    <td>
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Reasignar Contacto {{ c.cRazonSocial }}</div>
                                                                                            <i @click="mostrarVistaContactoPorVendedor(c.nIdContacto, c.cRazonSocial, c.cVendedor)" :style="'color:blue'" class="fa-md fa fa-street-view"></i>
                                                                                        </el-tooltip>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </template>
                                                                    </table>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-7">
                                                                            <nav>
                                                                                <ul class="pagination">
                                                                                    <li v-if="pagination.current_page > 1" class="page-item">
                                                                                        <a @click.prevent="cambiarPaginaContactosPorVendedor(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                    </li>
                                                                                    <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                    :class="[page==isActived?'active':'']">
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
                                    <template v-else>
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">REASIGNAR CONTACTO</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="col-lg-12">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-8">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Nombre Contacto</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="hidden" v-model="formReasignarContacto.nidcontacto">
                                                                                    <label v-text="formReasignarContacto.ccontacto" class="form-control-label"></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-8">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Nombre Vendedor</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="hidden" v-model="formReasignarContacto.nidvendedor">
                                                                                    <label v-text="formReasignarContacto.cvendedornombre" class="form-control-label"></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-8">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Nuevo Vendedor</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="hidden" v-model="formReasignarContacto.nreasignaidvendedor">
                                                                                    <input type="text" v-model="formReasignarContacto.creasignavendedornombre" disabled="disabled" class="form-control form-control-sm">
                                                                                    <div class="input-group-prepend">
                                                                                        <button type="button" title="Buscar Vendedor" class="btn btn-info btn-corner btn-sm" @click="abrirModal('nuevovendedor','buscar')">
                                                                                            <i class="fa-lg fa fa-search"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">LISTADO REFERENCIAS</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <template v-if="arrayReasignarReferencia.length">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Cód Ref.</th>
                                                                                <th>Proveedor</th>
                                                                                <th>Línea</th>
                                                                                <th>Marca</th>
                                                                                <th>Modelo</th>
                                                                                <th>Año Fab</th>
                                                                                <th>Año Modelo</th>
                                                                                <th>Acciones</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="referencia in arrayReasignarReferencia" :key="referencia.nIdReferenciaVehiculoContacto">
                                                                                <td v-text="referencia.nIdReferenciaVehiculoContacto"></td>
                                                                                <td v-text="referencia.cProveedorNombre"></td>
                                                                                <td v-text="referencia.cLineaNombre"></td>
                                                                                <td v-text="referencia.cMarcaNombre"></td>
                                                                                <td v-text="referencia.cModeloNombre"></td>
                                                                                <td v-text="referencia.nAnioFabricacion"></td>
                                                                                <td v-text="referencia.nAnioModelo"></td>
                                                                                <td>
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Reasignar Referencia {{ referencia.cMarcaNombre + ' ' + referencia.cModeloNombre }}</div>
                                                                                        <i @click="reasignarReferenciaVehiculo(referencia.nIdReferenciaVehiculoContacto)" :style="'color:blue'" class="fa-md fa fa-car"></i>
                                                                                    </el-tooltip>
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
                                                                                        <a @click.prevent="cambiarPaginaReferenciaPorReasignar(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                    </li>
                                                                                    <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                    :class="[page==isActived?'active':'']">
                                                                                        <a class="page-link"
                                                                                        href="#" @click.prevent="cambiarPaginaReferenciaPorReasignar(page)"
                                                                                        v-text="page"></a>
                                                                                    </li>
                                                                                    <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                        <a @click.prevent="cambiarPaginaReferenciaPorReasignar(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                <div role="tabpanel" class="tab-pane fade" id="TabContactosLibres">
                                    <template v-if="vistaContactoLibre">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">BUSCAR CONTACTOS LIBRES</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Tipo Persona</label>
                                                                            <div class="col-sm-8">
                                                                                <label class="checkbox-inline" v-for="tipo in arrayTipoPersona" :key="tipo.id">
                                                                                    <input type="radio" class="radio-template" v-model="fillContactoLibre.ntipopersona" :value="tipo.value" v-on:change="cambiarTipoPersonaContactoLibre()">
                                                                                    <label for="" class="form-control-label" v-text="tipo.text"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Contacto</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillContactoLibre.cfiltrodescripcion" @keyup.enter="buscarContactosLibres()" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Nro Documento</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="number" v-model.number="fillContactoLibre.cnrodocumento" @keyup.enter="buscarContactosLibres()" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Tipo de Contacto</label>
                                                                            <div class="col-sm-8">
                                                                                <select v-model="fillContactoLibre.ntipocontacto" class="form-control form-control-sm">
                                                                                    <option v-for="item in arrayTipoContacto" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-9 offset-sm-5">
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarContactosLibres();">
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
                                                            <template v-if="arrayContactoLibre.length">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-sm">
                                                                        <template v-if="fillContactoLibre.ntipopersona == 1">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Código</th>
                                                                                    <th>Apellidos</th>
                                                                                    <th>Nombres</th>
                                                                                    <th>Nro Documento</th>
                                                                                    <th>Telefono</th>
                                                                                    <th>Dirección</th>
                                                                                    <th>Email</th>
                                                                                    <th>Acciones</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="c in arrayContactoLibre" :key="c.nIdContacto">
                                                                                    <td v-text="c.nIdContacto"></td>
                                                                                    <td v-text="c.cPerApellidos"></td>
                                                                                    <td v-text="c.cNombre"></td>
                                                                                    <td v-text="c.cNumeroDocumento"></td>
                                                                                    <td v-text="c.nTelefonoMovil"></td>
                                                                                    <td v-text="c.cDireccion"></td>
                                                                                    <td v-text="c.cEmail"></td>
                                                                                    <td>
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Asignar Contacto {{ c.cPerApellidos + ' ' +  c.cNombre }} a Vendedor</div>
                                                                                            <i @click="mostrarVistaAsignaContacto(c.nIdContacto, c.cPerApellidos + ' ' +c.cNombre)" :style="'color:blue'" class="fa-md fa fa-user"></i>
                                                                                        </el-tooltip>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </template>
                                                                        <template v-else>
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Código</th>
                                                                                    <th>Razon Social</th>
                                                                                    <th>Nro Documento</th>
                                                                                    <th>Telefono</th>
                                                                                    <th>Email</th>
                                                                                    <th>Persona Contacto</th>
                                                                                    <th>Acciones</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="c in arrayContactoLibre" :key="c.nIdContacto">
                                                                                    <td v-text="c.nIdContacto"></td>
                                                                                    <td v-text="c.cRazonSocial"></td>
                                                                                    <td v-text="c.cNumeroDocumento"></td>
                                                                                    <td v-text="c.nTelefonoMovil"></td>
                                                                                    <td v-text="c.cEmail"></td>
                                                                                    <td v-text="c.cContacto"></td>
                                                                                    <td>
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Asignar Contacto {{ c.cRazonSocial }} a Vendedor</div>
                                                                                            <i @click="mostrarVistaAsignaContacto(c.nIdContacto, c.cRazonSocial)" :style="'color:blue'" class="fa-md fa fa-user"></i>
                                                                                        </el-tooltip>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </template>
                                                                    </table>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-7">
                                                                            <nav>
                                                                                <ul class="pagination">
                                                                                    <li v-if="pagination.current_page > 1" class="page-item">
                                                                                        <a @click.prevent="cambiarPaginaContactoLibre(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                    </li>
                                                                                    <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                    :class="[page==isActived?'active':'']">
                                                                                        <a class="page-link"
                                                                                        href="#" @click.prevent="cambiarPaginaContactoLibre(page)"
                                                                                        v-text="page"></a>
                                                                                    </li>
                                                                                    <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                        <a @click.prevent="cambiarPaginaContactoLibre(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                    <template v-else>
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">ASIGNAR CONTACTO</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="col-lg-12">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-8">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Nombre Contacto</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="hidden" v-model="fillAsignarContacto.nidcontacto">
                                                                                    <label v-text="fillAsignarContacto.ccontacto" class="form-control-label"></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-8">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Nuevo Vendedor</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="hidden" v-model="formVendedor.nidvendedor">
                                                                                    <input type="text" v-model="formVendedor.cvendedornombre" disabled="disabled" class="form-control form-control-sm">
                                                                                    <div class="input-group-prepend">
                                                                                        <button type="button" title="Buscar Vendedor" class="btn btn-info btn-corner btn-sm" @click="abrirModal('vendedor','buscar')">
                                                                                            <i class="fa-lg fa fa-search"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">LISTADO REFERENCIAS</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <template v-if="arrayReferenciaLibre.length">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Cód Ref.</th>
                                                                                <th>Proveedor</th>
                                                                                <th>Línea</th>
                                                                                <th>Marca</th>
                                                                                <th>Modelo</th>
                                                                                <th>Año Fab</th>
                                                                                <th>Año Modelo</th>
                                                                                <th>Acciones</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="referencia in arrayReferenciaLibre" :key="referencia.nIdReferenciaVehiculoContacto">
                                                                                <td v-text="referencia.nIdReferenciaVehiculoContacto"></td>
                                                                                <td v-text="referencia.cProveedorNombre"></td>
                                                                                <td v-text="referencia.cLineaNombre"></td>
                                                                                <td v-text="referencia.cMarcaNombre"></td>
                                                                                <td v-text="referencia.cModeloNombre"></td>
                                                                                <td v-text="referencia.nAnioFabricacion"></td>
                                                                                <td v-text="referencia.nAnioModelo"></td>
                                                                                <td>
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Asignar Referencia {{ referencia.cMarcaNombre + ' ' +  referencia.cModeloNombre }}</div>
                                                                                        <i @click="asignarReferenciaLibre(referencia.nIdReferenciaVehiculoContacto)" :style="'color:blue'" class="fa-md fa fa-car"></i>
                                                                                    </el-tooltip>
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
                                                                                        <a @click.prevent="cambiarPaginaReferenciaLibre(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                    </li>
                                                                                    <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                    :class="[page==isActived?'active':'']">
                                                                                        <a class="page-link"
                                                                                        href="#" @click.prevent="cambiarPaginaReferenciaLibre(page)"
                                                                                        v-text="page"></a>
                                                                                    </li>
                                                                                    <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                        <a @click.prevent="cambiarPaginaReferenciaLibre(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                <div role="tabpanel" class="tab-pane fade" id="TabSeguimiento">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <ul class="nav nav-tabs">
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="Tab111" href="#TabSegDatosContacto" @click="TabSegDatosContacto();" role="tab" data-toggle="tab">
                                                            <i class="fa fa fa-male"></i> DATOS DE CONTACTO
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link disabled" id="Tab222" href="#TabSegReferenciaVehiculo" role="tab" data-toggle="tab">
                                                            <i class="fa fa-car"></i> REFERENCIA VEHICULO
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link disabled" id="Tab333" href="#TabSegSeguimiento" @click="tabDatosPersonales()" role="tab" data-toggle="tab">
                                                            <i class="fa fa-angle-double-right"></i> NUEVO SEGUIMIENTO
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content">
                                                    <div class="tab-pane fade in active show" id="TabSegDatosContacto">
                                                        <section class="forms">
                                                            <div class="container-fluid">
                                                                <div class="col-lg-12">
                                                                    <form class="form-horizontal">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Tipo Persona</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="hidden" v-model="formSegDatosContacto.nidpersona">
                                                                                        <input type="text" v-model="formSegDatosContacto.ctipopersona" class="form-control form-control-sm" readonly>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Contacto</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" v-model="formSegDatosContacto.ccontacto" class="form-control form-control-sm" readonly>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Nro Documento</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" v-model="formSegDatosContacto.cnrodocumento" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Telefono</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" v-model="formSegDatosContacto.ctelefono" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Dirección</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" v-model="formSegDatosContacto.cdireccion" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Email</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="mail" v-model="formSegDatosContacto.cemail" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-9 offset-sm-4">
                                                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="activarTab222();">
                                                                                    <i class="fa fa-arrow-right"></i> Siguiente
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade" id="TabSegReferenciaVehiculo">
                                                        <section class="forms">
                                                            <div class="container-fluid">
                                                                <div class="col-lg-12">
                                                                    <form class="form-horizontal">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                                                    <div class="col-sm-8">
                                                                                        <div class="input-group">
                                                                                            <input type="hidden" v-model="formNuevoContacto.nidproveedor">
                                                                                            <input type="text" v-model="formNuevoContacto.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
                                                                                            <div class="input-group-prepend">
                                                                                                <button type="button" title="Buscar Proveedor" class="btn btn-info btn-corner btn-sm" @click="abrirModal('proveedor','buscar')">
                                                                                                    <i class="fa-lg fa fa-search"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Linea Vehiculo</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="hidden" v-model="formNuevoContacto.nidcontacto">
                                                                                        <el-select v-model="formNuevoContacto.nidlinea" filterable placeholder="Select" v-on:change="llenarComboMarca()">
                                                                                            <el-option
                                                                                            v-for="item in arrayLinea"
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
                                                                                    <label class="col-sm-4 form-control-label">Marca</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-select v-model="formNuevoContacto.nidmarca" filterable placeholder="Select" v-on:change="llenarComboModelo()">
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
                                                                                        <el-select v-model="formNuevoContacto.nidmodelo" filterable placeholder="Select" >
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
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Año Fabricación</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-select v-model="formNuevoContacto.naniofabricacion" filterable placeholder="Select" >
                                                                                            <el-option
                                                                                            v-for="item in arrayAnioFabricacion"
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
                                                                                    <label class="col-sm-4 form-control-label">Año Modelo</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-select v-model="formNuevoContacto.naniomodelo" filterable placeholder="Select" >
                                                                                            <el-option
                                                                                            v-for="item in arrayAnioModelo"
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
                                                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarSegReferenciaVehiculo()">
                                                                                    <i class="fa fa-save"></i> Registrar
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h3 class="h4">LISTADO</h3>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <template v-if="arraySegReferenciavehiculo.length">
                                                                                <div class="table-responsive">
                                                                                    <table class="table table-striped table-sm">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Cod. Ref.</th>
                                                                                                <th>Proveedor</th>
                                                                                                <th>Línea</th>
                                                                                                <th>Marca</th>
                                                                                                <th>Modelo</th>
                                                                                                <th>Año Fab</th>
                                                                                                <th>Año Modelo</th>
                                                                                                <th>Acciones</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr v-for="r in arraySegReferenciavehiculo" :key="r.nIdReferenciaVehiculoContacto">
                                                                                                <td v-text="r.nIdReferenciaVehiculoContacto"></td>
                                                                                                <td v-text="r.cProveedorNombre"></td>
                                                                                                <td v-text="r.cLineaNombre"></td>
                                                                                                <td v-text="r.cMarcaNombre"></td>
                                                                                                <td v-text="r.cModeloNombre"></td>
                                                                                                <td v-text="r.nAnioFabricacion"></td>
                                                                                                <td v-text="r.nAnioModelo"></td>
                                                                                                <td>
                                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                        <div slot="content">Nuevo Seguimiento {{ r.cMarcaNombre + ' ' + r.cModeloNombre }}</div>
                                                                                                        <i @click="activarTab333(r.nIdAsignacionContactoVendedor)" :style="'color:#796AEE'" class="fa-md fa fa-sign-out"></i>
                                                                                                    </el-tooltip>
                                                                                                    <template v-if="r.cReferenciaVehEstado=='A'">
                                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                            <div slot="content">Desactivar {{ r.cMarcaNombre + ' ' + r.cModeloNombre }}</div>
                                                                                                            <i @click="desactivar(r.nIdReferenciaVehiculoContacto)" :style="'color:#796AEE'" class="fa-md fa fa-check-square"></i>
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
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade" id="TabSegSeguimiento">
                                                        <section class="forms">
                                                            <div class="container-fluid">
                                                                <div class="col-lg-12">
                                                                    <form class="form-horizontal">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Zona</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="hidden" v-model="formNuevoSeguimiento.nidasignacioncontactovendedor">
                                                                                        <select v-model="formNuevoSeguimiento.nidzona" class="form-control form-control-sm">
                                                                                            <option v-for="item in arrayZona" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Estado</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select v-model="formNuevoSeguimiento.nidestadoseguimiento" class="form-control form-control-sm">
                                                                                            <option v-for="item in arrayEstadoSeguimiento" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Tipo Seguimiento</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select v-model="formNuevoSeguimiento.nidtiposeguimiento" class="form-control form-control-sm">
                                                                                            <option v-for="item in arrayTipoSeguimiento" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Forma de Pago</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select v-model="formNuevoSeguimiento.nidformapago" class="form-control form-control-sm">
                                                                                            <option v-for="item in arrayFormaPago" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Fecha Seguimiento</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-date-picker
                                                                                            v-model="formNuevoSeguimiento.dfechaseguimiento"
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
                                                                                    <label class="col-sm-4 form-control-label">* Hora Seguimiento</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-time-picker
                                                                                            v-model="formNuevoSeguimiento.choraseguimiento"
                                                                                            value-format="HH:mm"
                                                                                            :picker-options="{
                                                                                            format: 'AM/PM'
                                                                                            }"
                                                                                            placeholder="Fecha de Inicio">
                                                                                        </el-time-picker>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    <label class="col-sm-2 form-control-label">* Asunto</label>
                                                                                    <div class="col-sm-6">
                                                                                        <input type="text" v-model="formNuevoSeguimiento.casunto" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    <label class="col-sm-2 form-control-label">* Rendir Seguimiento</label>
                                                                                    <div class="col-sm-6">
                                                                                        <textarea v-model="formNuevoSeguimiento.crendirseguimiento"  cols="30" rows="5" class="form-control form-control-sm"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-9 offset-sm-5">
                                                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarSeguimiento();">
                                                                                    <i class="fa fa-save"></i> Registrar
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h3 class="h4">LISTADO</h3>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <template v-if="arraySeguimiento.length">
                                                                                <div class="table-responsive">
                                                                                    <table class="table table-striped table-sm">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Cod. Seg.</th>
                                                                                                <th>Zona</th>
                                                                                                <th>Tipo Seguimiento</th>
                                                                                                <th>Forma Pago</th>
                                                                                                <th>Estado</th>
                                                                                                <th>Fecha</th>
                                                                                                <th>Hora</th>
                                                                                                <th>Asunto</th>
                                                                                                <th>Acciones</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr v-for="s in arraySeguimiento" :key="s.nIdSeguimientoContacto">
                                                                                                <td v-text="s.nIdSeguimientoContacto"></td>
                                                                                                <td v-text="s.cZonaNombre"></td>
                                                                                                <td v-text="s.cTipoSegNombre"></td>
                                                                                                <td v-text="s.cFormaPago"></td>
                                                                                                <td v-text="s.cEstadoSegNombre"></td>
                                                                                                <td v-text="s.dFechaSeguimientoVendedor"></td>
                                                                                                <td v-text="s.cHoraSeguimiento"></td>
                                                                                                <td v-text="s.cAsunto"></td>
                                                                                                <td>
                                                                                                    <template v-if="s.cSeguimientoEstado=='A'">
                                                                                                        <a href="#" @click="desactivar(s.nIdSeguimientoContacto)" data-toggle="tooltip" data-placement="top"
                                                                                                        :title="'Desactivar ' + s.nIdSeguimientoContacto">
                                                                                                            <i class="fa-md fa fa-check-square"></i>
                                                                                                        </a>
                                                                                                    </template>
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
                                <div role="tabpanel" class="tab-pane fade" id="TabNuevoContacto">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <ul class="nav nav-tabs">
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="Tab11" href="#TabDatosPersonales" @click="tabDatosPersonales();" role="tab" data-toggle="tab">
                                                            <i class="fa fa-id-badge"></i> DATOS PERSONALES
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link disabled" id="Tab22" href="#TabDatosContacto" role="tab" data-toggle="tab">
                                                            <i class="fa fa fa-map-marker"></i> DATOS DE CONTACTO
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link disabled" id="Tab33" href="#TabReferenciaVehiculo" role="tab" data-toggle="tab">
                                                            <i class="fa fa-car"></i> REFERENCIA VEHICULO
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content">
                                                    <div class="tab-pane fade in active show" id="TabDatosPersonales">
                                                        <section class="forms">
                                                            <div class="container-fluid">
                                                                <div class="col-lg-12">
                                                                    <form class="form-horizontal">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Tipo Persona</label>
                                                                                    <div class="col-sm-8">
                                                                                        <label class="checkbox-inline" v-for="tipo in arrayTipoPersona" :key="tipo.id">
                                                                                            <input type="radio" class="radio-template" v-model="formNuevoContacto.ntipopersona" :value="tipo.value" v-on:change="cambiarTipoPersona()">
                                                                                            <label for="" class="form-control-label" v-text="tipo.text"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Tipo Documento</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select v-model="formNuevoContacto.ntpodocumento" class="form-control form-control-sm">
                                                                                            <option v-for="item in arrayTipoDocumento" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Nro Documento</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="number" v-model="formNuevoContacto.cnrodocumento" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <template v-if="vistaDatosPersonaNatural">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Apellido Paterno</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="text" v-model="formNuevoContacto.capepaterno" class="form-control form-control-sm">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Apellido Materno</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="text" v-model="formNuevoContacto.capematerno" class="form-control form-control-sm">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </template>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label v-text="formNuevoContacto.lblcnombres" class="col-sm-4 form-control-label"></label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" v-model="formNuevoContacto.cnombre" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Fecha Nacimiento</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-date-picker
                                                                                            v-model="formNuevoContacto.dfecnacimiento"
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
                                                                            <div class="col-sm-9 offset-sm-4">
                                                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="activarTab22();">
                                                                                    <i class="fa fa-arrow-right"></i> Siguiente
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade" id="TabDatosContacto">
                                                        <section class="forms">
                                                            <div class="container-fluid">
                                                                <div class="col-lg-12">
                                                                    <form class="form-horizontal">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Departamento</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-select v-model="formNuevoContacto.niddepartamento" filterable placeholder="Select" v-on:change="llenarComboProv()">
                                                                                            <el-option
                                                                                            v-for="item in arrayDptos"
                                                                                            :key="item.id"
                                                                                            :label="item.text"
                                                                                            :value="item.id">
                                                                                            </el-option>
                                                                                        </el-select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Provincia</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-select v-model="formNuevoContacto.nidprovincia" filterable placeholder="Select" v-on:change="llenarComboDist()">
                                                                                            <el-option
                                                                                            v-for="item in arrayProv"
                                                                                            :key="item.id"
                                                                                            :label="item.text"
                                                                                            :value="item.id">
                                                                                            </el-option>
                                                                                        </el-select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Distrito</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-select v-model="formNuevoContacto.niddistrito" filterable placeholder="Select" >
                                                                                            <el-option
                                                                                            v-for="item in arrayDist"
                                                                                            :key="item.id"
                                                                                            :label="item.text"
                                                                                            :value="item.id">
                                                                                            </el-option>
                                                                                        </el-select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Dirección</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" v-model="formNuevoContacto.cdireccion" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Email</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" v-model="formNuevoContacto.cmailprincipal" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Email Alternativo</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" v-model="formNuevoContacto.cmailalternativo" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Telefono Fijo</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" v-model="formNuevoContacto.ctelefonofijo" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Celular</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" v-model="formNuevoContacto.ncelular" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Celular Alternativo</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" v-model="formNuevoContacto.ncelularalternativo" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <template v-if="vistaDatosPersonaNatural">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Estado Civil</label>
                                                                                        <div class="col-sm-8">
                                                                                            <select v-model="formNuevoContacto.nestadocivil" class="form-control form-control-sm">
                                                                                                <option v-for="item in arrayEstadoCivil" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </template>
                                                                        </div>
                                                                        <template v-if="vistaDatosPersonaNatural">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Profesión</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-select v-model="formNuevoContacto.nprofesion" filterable placeholder="Select" >
                                                                                                <el-option
                                                                                                v-for="item in arrayProfesion"
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
                                                                                        <label class="col-sm-4 form-control-label">Centro Laboral</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="text" v-model="formNuevoContacto.ccentrolaboral" class="form-control form-control-sm">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </template>
                                                                    </form>
                                                                </div>
                                                                <template v-if="!vistaDatosPersonaNatural" style="margin-top: 2rem;">
                                                                    <div class="container-fluid">
                                                                        <div class="col-lg-12">
                                                                            <div class="card">
                                                                                <div class="card-header">
                                                                                    <h3 class="h4">DATOS DE CONTACTO DE LA PERSONA JURIDICA</h3>
                                                                                </div>
                                                                                <div class="card-body">
                                                                                    <form class="form-horizontal">
                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">* Tipo Documento</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <select v-model="formNuevoContactoJurifico.ntpodocumento" class="form-control form-control-sm">
                                                                                                            <option v-for="item in arrayTipoDocumentoNaturales" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                                                            </option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">* Nro Documento</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <input type="number" v-model="formNuevoContactoJurifico.cnrodocumento" class="form-control form-control-sm">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">* Apellido Paterno</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <input type="text" v-model="formNuevoContactoJurifico.capepaterno" class="form-control form-control-sm">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">* Apellido Materno</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <input type="text" v-model="formNuevoContactoJurifico.capematerno" class="form-control form-control-sm">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">* Nombres</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <input type="text" v-model="formNuevoContactoJurifico.cnombre" class="form-control form-control-sm">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">* Email</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <input type="text" v-model="formNuevoContactoJurifico.cmailprincipal" class="form-control form-control-sm">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">* Teléfono</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <input type="text" v-model="formNuevoContactoJurifico.ncelular" class="form-control form-control-sm">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </template>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-9 offset-sm-4">
                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="activarTab33();">
                                                                            <i class="fa fa-arrow-right"></i> Siguiente
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade" id="TabReferenciaVehiculo">
                                                        <section class="forms">
                                                            <div class="container-fluid">
                                                                <div class="col-lg-12">
                                                                    <form class="form-horizontal">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                                                    <div class="col-sm-8">
                                                                                        <div class="input-group">
                                                                                            <input type="hidden" v-model="formNuevoContacto.nidproveedor">
                                                                                            <input type="text" v-model="formNuevoContacto.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
                                                                                            <div class="input-group-prepend">
                                                                                                <button type="button" title="Buscar Proveedor" class="btn btn-info btn-corner btn-sm" @click="abrirModal('proveedor','buscar')">
                                                                                                    <i class="fa-lg fa fa-search"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Linea Vehiculo</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-select v-model="formNuevoContacto.nidlinea" filterable placeholder="Select" v-on:change="llenarComboMarca()">
                                                                                            <el-option
                                                                                            v-for="item in arrayLinea"
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
                                                                                    <label class="col-sm-4 form-control-label">Marca</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-select v-model="formNuevoContacto.nidmarca" filterable placeholder="Select" v-on:change="llenarComboModelo()">
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
                                                                                        <el-select v-model="formNuevoContacto.nidmodelo" filterable placeholder="Select" >
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
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Año Fabricación</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-select v-model="formNuevoContacto.naniofabricacion" filterable placeholder="Select" >
                                                                                            <el-option
                                                                                            v-for="item in arrayAnioFabricacion"
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
                                                                                    <label class="col-sm-4 form-control-label">Año Modelo</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-select v-model="formNuevoContacto.naniomodelo" filterable placeholder="Select" >
                                                                                            <el-option
                                                                                            v-for="item in arrayAnioModelo"
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
                                                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="asignarReferenciaVehiculo()">
                                                                                    <i class="fa fa-arrow-down"></i> Asignar
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h3 class="h4">LISTADO</h3>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <template v-if="arrayReferenciaVehiculo.length">
                                                                                <div class="table-responsive">
                                                                                    <table class="table table-striped table-sm">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Acciones</th>
                                                                                                <th>Proveedor</th>
                                                                                                <th>Línea</th>
                                                                                                <th>Marca</th>
                                                                                                <th>Modelo</th>
                                                                                                <th>Año Fab</th>
                                                                                                <th>Año Modelo</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr v-for="(referencia, index) in arrayReferenciaVehiculo" :key="referencia.nIdModelo">
                                                                                                <td>
                                                                                                    <a href="#" @click="eliminarItemReferenciaVehiculo(index)" data-toggle="tooltip" data-placement="top"
                                                                                                        :title="'Eliminar Referencia'">
                                                                                                        <i :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                                    </a>
                                                                                                </td>
                                                                                                <td v-text="referencia.cProveedorNombre"></td>
                                                                                                <td v-text="referencia.cLineaNombre"></td>
                                                                                                <td v-text="referencia.cMarcaNombre"></td>
                                                                                                <td v-text="referencia.cModeloNombre"></td>
                                                                                                <td v-text="referencia.nAnioFabricacion"></td>
                                                                                                <td v-text="referencia.nAnioModelo"></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-9 offset-sm-5">
                                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarNuevoContacto()">
                                                                                            <i class="fa fa-save"></i> Registrar
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
                                                            </div>
                                                        </section>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="TabLeads">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="h4">LISTADO</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="col-lg-12">
                                                            <div class="form-group row">
                                                                <div class="col-sm-8">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Importar Leads</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="file" id="file-upload" @change="getFile" accept=".xls,.xlsx" class="form-control form-control-sm"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="row">
                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="importFileLeads()">
                                                                            <i class="fa fa-retweet"></i> Procesar
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <template v-if="arrayLeads.length">
                                                                <div class="table-responsive border" style="max-height: 300px; max-width:1200px; overflow-y: auto; overflow-x: auto;-ms-overflow-style: -ms-autohiding-scrollbar;">
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Acciones</th>
                                                                                <th>Tipo Documento</th>
                                                                                <th>Nro Documento</th>
                                                                                <th>Nombres</th>
                                                                                <th>Apellido Paterno</th>
                                                                                <th>Apellido Materno</th>
                                                                                <th>Teléfono</th>
                                                                                <th>Celular</th>
                                                                                <th>Email</th>
                                                                                <th>Departamento</th>
                                                                                <th>Provincia</th>
                                                                                <th>Distrito</th>
                                                                                <th>Dirección</th>
                                                                                <th>Marca</th>
                                                                                <th>Modelo</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="(lead, index) in arrayLeads" :key="lead.cNumeroDocumento">
                                                                                <td>
                                                                                    <a href="#" @click="eliminarItemLead(index);" data-toggle="tooltip" data-placement="top" :title="'Eliminar ' +lead.cNumeroDocumento">
                                                                                    <i :style="'color:red'" class="fa-md fa fa-times-circle"></i></a>
                                                                                </td>
                                                                                <td v-text="lead.cTipoDocumento"></td>
                                                                                <td v-text="lead.cNumeroDocumento"></td>
                                                                                <td v-text="lead.cNombre"></td>
                                                                                <td v-text="lead.cApellidoPaterno"></td>
                                                                                <td v-text="lead.cApellidoMaterno"></td>
                                                                                <td v-text="lead.cTelefonoFijo"></td>
                                                                                <td v-text="lead.nTelefonoMovil"></td>
                                                                                <td v-text="lead.cEmail"></td>
                                                                                <td v-text="lead.cDepartamentoNombre"></td>
                                                                                <td v-text="lead.cProvinciaNombre"></td>
                                                                                <td v-text="lead.cDistritoNombre"></td>
                                                                                <td v-text="lead.cDireccion"></td>
                                                                                <td v-text="lead.cLineaNombre"></td>
                                                                                <td v-text="lead.cMarcaNombre"></td>
                                                                                <td v-text="lead.cModeloNombre"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-7">
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <div class="datatable-info">Total: {{ contadorArrayLeads }} registros</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-9 offset-sm-5">
                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarLeads()">
                                                                            <i class="fa fa-save"></i> Registrar
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
                                                                    <input type="text" v-model="fillProveedor.cnombreproveedor" @keyup.enter="buscaProveedores()" class="form-control form-control-sm">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" title="Buscar Vehículos" class="btn btn-info btn-corner btn-sm" @click="buscaProveedores();"><i class="fa-lg fa fa-search"></i></button>
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
                                                            <label class="col-sm-4 form-control-label">Nombres</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <input type="text" v-model="fillVendedor.cnombrevendedor" @keyup.enter="listarVendedores(1)" class="form-control form-control-sm">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" title="Buscar Vehículos" class="btn btn-info btn-corner btn-sm" @click="listarVendedores(1);"><i class="fa-lg fa fa-search"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <template v-if="arrayVendedor.length">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>Seleccione</th>
                                                                    <th>Nombre Vendedor</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="vendedor in arrayVendedor" :key="vendedor.nIdPar">
                                                                    <td>
                                                                        <a href="#" @click="asignarVendedor(vendedor.nIdPar, vendedor.cParNombre);">
                                                                            <i class='fa-md fa fa-check-circle'></i>
                                                                        </a>
                                                                    </td>
                                                                    <td v-text="vendedor.cParNombre"></td>
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
                                                                            <a @click.prevent="cambiarPaginaVendedor(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                        </li>
                                                                        <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                        :class="[page==isActivedModal?'active':'']">
                                                                            <a class="page-link"
                                                                            href="#" @click.prevent="cambiarPaginaVendedor(page)"
                                                                            v-text="page"></a>
                                                                        </li>
                                                                        <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                            <a @click.prevent="cambiarPaginaVendedor(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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

        <div class="modal fade" v-if="accionmodal==4" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                                            <label class="col-sm-4 form-control-label">Nombres</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <input type="text" v-model="fillVendedor.cnombrevendedor" @keyup.enter="listarVendedores(1)" class="form-control form-control-sm">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" title="Buscar Vehículos" class="btn btn-info btn-corner btn-sm" @click="listarVendedores(1);"><i class="fa-lg fa fa-search"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <template v-if="arrayVendedor.length">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>Seleccione</th>
                                                                    <th>Nombre Vendedor</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="vendedor in arrayVendedor" :key="vendedor.nIdPar">
                                                                    <td>
                                                                        <a href="#" @click="reasignarVendedor(vendedor.nIdPar, vendedor.cParNombre);">
                                                                            <i class='fa-md fa fa-check-circle'></i>
                                                                        </a>
                                                                    </td>
                                                                    <td v-text="vendedor.cParNombre"></td>
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
                                                                            <a @click.prevent="cambiarPaginaVendedor(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                        </li>
                                                                        <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                        :class="[page==isActivedModal?'active':'']">
                                                                            <a class="page-link"
                                                                            href="#" @click.prevent="cambiarPaginaVendedor(page)"
                                                                            v-text="page"></a>
                                                                        </li>
                                                                        <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                            <a @click.prevent="cambiarPaginaVendedor(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                cempresa: 'SAISAC',
                csucursal: 'CHICLAYO',
                canio: '2018',
                cmes: 'MAYO',
                nidempresa: 0,
                nidsucursal: 0,
                arrayReferenciaVehiculo: [],
                arraySegReferenciavehiculo: [],
                arrayContacto: [],
                arrayTipoPersona: [
                    { value: '1', text: 'NATURAL'},
                    { value: '2', text: 'JURIDICA'}
                ],
                arrayEstadoSeguimiento: [],
                arrayTipoSeguimiento: [],
                arrayFormaPago: [],
                arraySeguimiento: [],
                arrayTipoDocumentoNaturales: [],
                // ============================================================
                // =========== VARIABLES MODAL PROVEEDOR ============
                fillProveedor:{
                    cnombreproveedor: ''
                },
                arrayProveedor: [],
                // ============================================================
                // =========== VARIABLES MODAL VENDEDOR ============
                fillVendedor:{
                    cnombrevendedor: ''
                },
                arrayVendedor: [],
                // ============================================================
                // =========== VARIABLES FORMULARIO VENDEDOR ============
                formVendedor: {
                    nidvendedor: '',
                    cvendedornombre: ''
                },
                // ============================================================
                // =========== VARIABLES BUSCAR CONTACTO ============
                fillMisContactos:{
                    ntipopersona: 1,
                    cnrodocumento: '',
                    cfiltrodescripcion: ''
                },
                // =============================================================
                // =========== VARIABLES TAB CONTACTOS POR VENDEDOR ============
                fillContactoPorVendedor:{
                    ntipopersona: 1,
                    cnrodocumento: '',
                    cfiltrodescripcion: ''
                },
                arrayContactosPorVendedor: [],
                vistaContactoPorVendedor: 1,
                // =============================================================
                // ============== VARIABLES TAB CONTACTOS LIBRES ===============
                fillContactoLibre: {
                    ntipopersona: 1,
                    cnrodocumento: '',
                    cfiltrodescripcion: '',
                    ntipocontacto: 0
                },
                arrayContactoLibre: [],
                arrayTipoContacto: [],
                vistaContactoLibre: 1,
                // =============================================================
                // ============== VARIABLES ASIGNAR CONTACTO =================
                fillAsignarContacto: {
                    nidcontacto: 0,
                    ccontacto: ''
                },
                arrayReferenciaLibre: [],
                // =============================================================
                // ============== VARIABLES REASIGNAR CONTACTO =================
                formReasignarContacto: {
                    nidcontacto: 0,
                    ccontacto: '',
                    nidvendedor: 0,
                    cvendedornombre: '',
                    nreasignaidvendedor: 0,
                    creasignavendedornombre: ''
                },
                arrayReasignarReferencia: [],
                // =============================================================
                // ================ VARIABLES TAB NUEVO CONTACTO ===============
                formNuevoContacto:{
                    ntipopersona: 1,
                    ntpodocumento: 0,
                    cnrodocumento: '',
                    capepaterno: '',
                    capematerno: '',
                    cnombre: '',
                    dfecnacimiento: '',
                    lblcnombres: '* Nombres',
                    niddepartamento: 0,
                    nidprovincia: 0,
                    niddistrito: 0,
                    nidproveedor: 0,
                    cproveedornombre: '',
                    cdireccion: '',
                    cmailprincipal: '',
                    cmailalternativo: '',
                    ctelefonofijo: '',
                    ncelular: '',
                    ncelularalternativo: '',
                    nestadocivil: 0,
                    nprofesion: 0,
                    ccentrolaboral: '',
                    nidlinea: 0,
                    nidmarca: 0,
                    nidmodelo: 0,
                    naniofabricacion: 0,
                    naniomodelo: 0,
                    nidcontacto: 0
                },
                formNuevoContactoJurifico:{
                    ntpodocumento: 0,
                    cnrodocumento: '',
                    capepaterno: '',
                    capematerno: '',
                    cnombre: '',
                    cmailprincipal: '',
                    ncelular : ''
                },
                vistaDatosPersonaNatural: 1,
                // =============================================================
                // ================= VARIABLES TAB SEGUIMIENTO =================
                formSegDatosContacto:{
                    ctipopersona: '',
                    ccontacto: '',
                    cnrodocumento: '',
                    cdireccion: '',
                    ctelefono: '',
                    cemail: '',
                    nidpersona: 0
                },
                arrayZona: [],
                // =============================================================
                // ============== VARIABLES TAB NUEVO SEGUIMIENTO ==============
                formNuevoSeguimiento:{
                    nidzona: 0,
                    nidestadoseguimiento: 0,
                    nidtiposeguimiento: 0,
                    nidformapago: 0,
                    dfechaseguimiento: '',
                    choraseguimiento: '',
                    casunto: '',
                    crendirseguimiento: '',
                    nidasignacioncontactovendedor: 0
                },
                arrayTipoDocumento: [],
                arrayLinea: [],
                arrayMarca: [],
                arrayModelo: [],
                arrayAnioFabricacion: [],
                arrayAnioModelo: [],
                arrayEstadoCivil: [],
                arrayProfesion: [],
                arrayDptos:[],
                arrayProv : [],
                arrayDist: [],
                // =============================================================
                // ============== VARIABLES TAB LEADS ==============
                arrayLeads: [],
                contadorArrayLeads: 0,
                arrayTemporalLeads: [],
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
                accion: 0,
                modal:0,
                tituloModal:'',
                tituloFormulario: '',
                accionmodal: 0,
                error: 0,
                errors: [],
                mensajeError: [],
                attachment: null,
                form: new FormData,
                textFile: ''
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
            // =========================================================
            // =============  TAB MIS CONTACTOS ========================
            tabMisContactos(){
                $('#Tab4').addClass("nav-link disabled");
                this.limpiarMisContactos();
                this.arrayContacto = [];
            },
            cambiarTipoPersonaMisContactos(){
                this.arrayContacto = [];
            },
            cambiarPaginaMisContactos(page){
                this.pagination.current_page=page;
                this.listarMisContactosJFV(page);
            },
            listarMisContactosJFV(page){
                this.mostrarProgressBar();
                var url = this.ruta + '/gescontacto/GetListContactoByJFV';
                axios.get(url, {
                    params: {
                        'nidempresa' : 1300011,
                        'nidsucursal' : 1300013,
                        'nidcronograma' : 220016,
                        'ntipopersona' : this.fillMisContactos.ntipopersona,
                        'cnrodocumento' : String(this.fillMisContactos.cnrodocumento.toString()),
                        'cfiltrodescripcion' : this.fillMisContactos.cfiltrodescripcion.toString(),
                        'page' : page
                    }
                }).then(response => {
                    this.arrayContacto = response.data.arrayContacto.data;
                    this.pagination.current_page =  response.data.arrayContacto.current_page;
                    this.pagination.total = response.data.arrayContacto.total;
                    this.pagination.per_page    = response.data.arrayContacto.per_page;
                    this.pagination.last_page   = response.data.arrayContacto.last_page;
                    this.pagination.from        = response.data.arrayContacto.from;
                    this.pagination.to           = response.data.arrayContacto.to;
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            // =========================================================
            // =============  TAB CONTACTOS POR VENDEDOR ===============
            tabContactosPorVendedor(){
                $('#Tab4').addClass("nav-link disabled");
                this.vistaContactoPorVendedor = 1;
                this.arrayContactosPorVendedor = [];
                this.limpiarTodoVendedor();
                this.limpiarReasignarContacto();
                this.limpiarContactosPorVendedor();
            },
            buscarContactosPorVendedor(){
                if(this.validarBusquedaContactosPorVendedor()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.listarContactosPorVendedor(1);
            },
            validarBusquedaContactosPorVendedor(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formVendedor.nidvendedor == 0){
                    this.mensajeError.push('Debes Seleccionar un Vendedor');
                };

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            cambiarPaginaContactosPorVendedor(page){
                this.pagination.current_page=page;
                this.listarContactosPorVendedor(page);
                this.arrayVendedor = [];
            },
            listarContactosPorVendedor(page){
                this.mostrarProgressBar();
                var url = this.ruta + '/gescontacto/GetListContactoByVendedor';
                axios.get(url, {
                    params: {
                        'nidempresa' : 1300011,
                        'nidsucursal' : 1300013,
                        'nidcronograma' : 220016,
                        'ntipopersona' : this.fillContactoPorVendedor.ntipopersona,
                        'cnrodocumento' : String(this.fillContactoPorVendedor.cnrodocumento.toString()),
                        'cfiltrodescripcion' : this.fillContactoPorVendedor.cfiltrodescripcion.toString(),
                        'nidvendedor'      : this.formVendedor.nidvendedor,
                        'page' : page
                    }
                }).then(response => {
                    let info = response.data.arrayContactosPorVendedor;
                    //Data
                    this.arrayContactosPorVendedor = info.data;
                    //Pagination
                    this.pagination.current_page   =   info.current_page;
                    this.pagination.total          =   info.total;
                    this.pagination.per_page       =   info.per_page;
                    this.pagination.last_page      =   info.last_page;
                    this.pagination.from           =   info.from;
                    this.pagination.to             =   info.to;
                    //Limpiar caja busqueda
                    //this.limpiarBuscarContactosCPV();
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarTipoPersonaContactosPorVendedor(){
                this.arrayContactosPorVendedor = []
            },
            mostrarVistaContactoPorVendedor(nIdContacto, cNombre, cVendedor){
                this.vistaContactoPorVendedor = 0;
                this.formReasignarContacto.nidcontacto = parseInt(nIdContacto);
                this.formReasignarContacto.ccontacto = cNombre;
                this.formReasignarContacto.cvendedornombre = cVendedor;
                this.listarReferenciaVehiculoPorReasignar(1);
            },
            listarReferenciaVehiculoPorReasignar(page){
                var url = this.ruta + '/gescontacto/GetRefVehiculoByContactoPorReasignar';

                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidsucursal': 1300013,
                        'nidcontacto' : this.formReasignarContacto.nidcontacto,
                        'nidvendedor' : this.formReasignarContacto.nreasignaidvendedor,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayReasignarReferencia = response.data.arrayReasignarReferencia.data;
                    this.pagination.current_page =  response.data.arrayReasignarReferencia.current_page;
                    this.pagination.total = response.data.arrayReasignarReferencia.total;
                    this.pagination.per_page    = response.data.arrayReasignarReferencia.per_page;
                    this.pagination.last_page   = response.data.arrayReasignarReferencia.last_page;
                    this.pagination.from        = response.data.arrayReasignarReferencia.from;
                    this.pagination.to           = response.data.arrayReasignarReferencia.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaReferenciaPorReasignar(page){
                this.pagination.current_page=page;
                this.listarReferenciaVehiculoPorReasignar(page);
            },
            reasignarReferenciaVehiculo(nIdReferenciaVehiculoContacto){
                if(this.validaReasignarReferenciaVehiculo()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                swal({
                    title: 'Estas seguro de Reasignar esta Referencia?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Activar!',
                    cancelButtonText: 'No, cancelar!'
                    }).then((result) => {
                        if (result.value) {
                            var url = this.ruta + '/gescontacto/UpdReasignarReferenciaVehiculo';
                            axios.post(url, {
                                nIdReferenciaVehiculoContacto: parseInt(nIdReferenciaVehiculoContacto),
                                nIdEmpresa: 1300011,
                                nIdSucursal: 1300013,
                                nIdCronograma: 220016,
                                nIdVendedor: parseInt(this.formReasignarContacto.nreasignaidvendedor)
                            }).then(response => {
                                swal(
                                'Activado!',
                                'El registro fue Reasignado.'
                                );
                                this.listarReferenciaVehiculoPorReasignar(1);
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                        } else if (result.dismiss === swal.DismissReason.cancel)
                        {
                        }
                    })
            },
            validaReasignarReferenciaVehiculo(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formReasignarContacto.nreasignaidvendedor == 0){
                    this.mensajeError.push('Debes Seleccionar un Vendedor');
                };

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // =========================================================
            // =============  TAB CONTACTOS LIBRES =====================
            tabContactosLibres(){
                $('#Tab4').addClass("nav-link disabled");
                this.vistaContactoLibre = 1;
                this.arrayContactoLibre = [];
                this.limpiarTodoVendedor();
                this.limpiarContactoLibre();
                this.llenarComboTipoContacto();
            },
            buscarContactosLibres(){
                this.listarContactosLibres(1);
            },
            cambiarPaginaContactoLibre(page){
                this.pagination.current_page=page;
                this.listarContactosLibres(page);
            },
            listarContactosLibres(page){
                this.mostrarProgressBar();
                var url = this.ruta + '/gescontacto/GetListContactosLibres';
                axios.get(url, {
                    params: {
                        'ntipopersona' : this.fillContactoLibre.ntipopersona,
                        'cnrodocumento' : String(this.fillContactoLibre.cnrodocumento.toString()),
                        'cfiltrodescripcion' : this.fillContactoLibre.cfiltrodescripcion.toString(),
                        'ntipocontacto': this.fillContactoLibre.ntipocontacto,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayContactoLibre = response.data.arrayContactoLibre.data;
                    this.pagination.current_page =  response.data.arrayContactoLibre.current_page;
                    this.pagination.total = response.data.arrayContactoLibre.total;
                    this.pagination.per_page    = response.data.arrayContactoLibre.per_page;
                    this.pagination.last_page   = response.data.arrayContactoLibre.last_page;
                    this.pagination.from        = response.data.arrayContactoLibre.from;
                    this.pagination.to           = response.data.arrayContactoLibre.to;
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboTipoContacto(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110056
                                                                                + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayTipoContacto = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarTipoPersonaContactoLibre(){
                this.arrayContactoLibre = []
            },
            mostrarVistaAsignaContacto(nIdContacto, cNombre){
                this.vistaContactoLibre = 0;
                this.fillAsignarContacto.nidcontacto = nIdContacto;
                this.fillAsignarContacto.ccontacto = cNombre;
                this.listarReferenciasVehiculoLibre(1);
            },
            listarReferenciasVehiculoLibre(page){
                var url = this.ruta + '/gescontacto/GetListReferenciaVehiculoLibre';

                axios.get(url, {
                    params: {
                        'nidcontacto': this.fillAsignarContacto.nidcontacto,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayReferenciaLibre = response.data.arrayReferenciaLibre.data;
                    this.pagination.current_page =  response.data.arrayReferenciaLibre.current_page;
                    this.pagination.total = response.data.arrayReferenciaLibre.total;
                    this.pagination.per_page    = response.data.arrayReferenciaLibre.per_page;
                    this.pagination.last_page   = response.data.arrayReferenciaLibre.last_page;
                    this.pagination.from        = response.data.arrayReferenciaLibre.from;
                    this.pagination.to           = response.data.arrayReferenciaLibre.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaReferenciaLibre(page){
                this.pagination.current_page=page;
                this.listarReferenciasVehiculoLibre(page);
            },
            asignarReferenciaLibre(nIdReferenciaVehiculoContacto){
                if(this.validaAsignarReferenciLibre()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                swal({
                    title: 'Estas seguro de asignar esta referencia?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Activar!',
                    cancelButtonText: 'No, cancelar!'
                    }).then((result) => {
                        if (result.value) {
                            var url = this.ruta + '/gescontacto/SetAsignaReferenciaLibre';
                            axios.post(url, {
                                nIdReferenciaVehiculoContacto: parseInt(nIdReferenciaVehiculoContacto),
                                nIdEmpresa: 1300011,
                                nIdSucursal: 1300013,
                                nIdCronograma: 220016,
                                nIdVendedor: parseInt(this.formVendedor.nidvendedor)
                            }).then(response => {
                                swal(
                                'Activado!',
                                'El registro fue asignado.'
                                );
                                this.listarReferenciasVehiculoLibre(1);
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                        } else if (result.dismiss === swal.DismissReason.cancel)
                        {
                        }
                    })
            },
            validaAsignarReferenciLibre(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formVendedor.nidvendedor == 0){
                    this.mensajeError.push('Debes Seleccionar un Vendedor');
                };
                if(this.fillAsignarContacto.nidcontacto = 0){
                    this.mensajeError.push('Debes Seleccionar un Contacto');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // ========================================================
            // =============  TAB SEGUIMIENTO =========================
            activarTab3(nIdContacto, nIdPersona, nTipoPersona){
                $('#Tab1').removeClass('nav-link active');
                $('#Tab1').addClass("nav-link");
                $('#Tab4').removeClass('nav-link disabled');
                $('#Tab4').addClass("nav-link active");
                $('#TabMisContactos').removeClass('in active show');
                $('#TabSeguimiento').addClass('in active show');
                this.formNuevoContacto.nidcontacto = nIdContacto;
                this.formSegDatosContacto.nidpersona = nIdPersona;
                this.TabSegDatosContacto();
                this.cargarTabSegDatosContacto(nTipoPersona);
            },
            cargarTabSegDatosContacto(nTipoPersona){
                if(nTipoPersona == "1")
                {
                    var url = this.ruta + '/gescontacto/GetContactoNaturalById';

                    axios.get(url, {
                        params: {
                            'nidcontacto': this.formNuevoContacto.nidcontacto,
                            'nidpersonanatural' : this.formSegDatosContacto.nidpersona
                        }
                    }).then(response => {
                        this.formSegDatosContacto.ctipopersona = response.data[0].cTipoPersona;
                        this.formSegDatosContacto.ccontacto = response.data[0].cContacto;
                        this.formSegDatosContacto.cnrodocumento = response.data[0].cNumeroDocumento;
                        this.formSegDatosContacto.ctelefono = response.data[0].nTelefonoMovil;
                        this.formSegDatosContacto.cemail = response.data[0].cEmail;
                        this.formSegDatosContacto.cdireccion = response.data[0].cDireccion;
                    }).catch(error => {
                        console.log(error);
                    });
                }
                else
                {
                    var url = this.ruta + '/gescontacto/GetContactoJuridicoById';

                    axios.get(url, {
                        params: {
                            'nidcontacto': this.formNuevoContacto.nidcontacto,
                            'nidpersonajuridico' : this.formSegDatosContacto.nidpersona
                        }
                    }).then(response => {
                        this.formSegDatosContacto.ctipopersona = response.data[0].cTipoPersona;
                        this.formSegDatosContacto.ccontacto = response.data[0].cContacto;
                        this.formSegDatosContacto.cnrodocumento = response.data[0].cNumeroDocumento;
                        this.formSegDatosContacto.ctelefono = response.data[0].nTelefonoMovil;
                        this.formSegDatosContacto.cemail = response.data[0].cEmail;
                        this.formSegDatosContacto.cdireccion = response.data[0].cDireccion;
                    }).catch(error => {
                        console.log(error);
                    });
                }
            },
            TabSegDatosContacto(){
                $('#Tab111').addClass('nav-link active');
                $('#Tab222').removeClass('nav-link active');
                $('#Tab222').addClass("nav-link disabled");
                $('#Tab333').removeClass('nav-link active');
                $('#Tab333').addClass('nav-link disabled');
                $('#TabSegDatosContacto').addClass('in active show');
                $('#TabSegReferenciaVehiculo').removeClass('in active show');
                $('#TabSegSeguimiento').removeClass('in active show');
            },
            activarTab222(){
                if(this.validarTab222()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#Tab111').removeClass('nav-link active');
                $('#Tab111').addClass("nav-link");
                $('#Tab222').removeClass('nav-link disabled');
                $('#Tab222').addClass("nav-link active");
                $('#TabSegDatosContacto').removeClass('in active show');
                $('#TabSegReferenciaVehiculo').addClass('in active show');
                this.llenarComboLinea();
                this.llenarComboAnioFabricacion();
                this.llenarComboAnioModelo();
                this.listarReferenciaVehiculoByContacto(1);
            },
            validarTab222(){
                this.error = 0;
                this.mensajeError =[];

                /*if(this.formNuevoContacto.ntpodocumento == 0){
                    this.mensajeError.push('Debes Seleccionar Tipo Documento');
                };
                if(this.formNuevoContacto.ntipopersona == 1)
                {
                    if(!this.formNuevoContacto.cnrodocumento){
                    this.mensajeError.push('Debes Ingresar Nro Documento');
                    };
                    if(!this.formNuevoContacto.capepaterno){
                        this.mensajeError.push('Debes Ingresar Apellido Paterno');
                    };
                    if(!this.formNuevoContacto.capematerno){
                        this.mensajeError.push('Debes Ingresar Apellido Materno');
                    };
                    if(!this.formNuevoContacto.cnombre){
                        this.mensajeError.push('Debes Ingresar Nombres');
                    };
                }

                if(this.formNuevoContacto.ntipopersona == 2){
                    if(!this.formNuevoContacto.cnrodocumento){
                    this.mensajeError.push('Debes Ingresar Nro Documento');
                    };
                    if(!this.formNuevoContacto.cnombre){
                        this.mensajeError.push('Debes Ingresar Razon Social');
                    };
                }*/

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            listarReferenciaVehiculoByContacto(page){
                var url = this.ruta + '/gescontacto/GetRefVehiculoByContacto';

                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidsucursal': 1300013,
                        'nidcontacto' : this.formNuevoContacto.nidcontacto,
                        'page' : page
                    }
                }).then(response => {
                    this.arraySegReferenciavehiculo = response.data.arraySegReferenciavehiculo.data;
                    this.pagination.current_page =  response.data.arraySegReferenciavehiculo.current_page;
                    this.pagination.total = response.data.arraySegReferenciavehiculo.total;
                    this.pagination.per_page    = response.data.arraySegReferenciavehiculo.per_page;
                    this.pagination.last_page   = response.data.arraySegReferenciavehiculo.last_page;
                    this.pagination.from        = response.data.arraySegReferenciavehiculo.from;
                    this.pagination.to           = response.data.arraySegReferenciavehiculo.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            registrarSegReferenciaVehiculo(){
                if(this.validarRegistraSegReferenciaVehiculo()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var nidaniofabricacion = this.formNuevoContacto.naniofabricacion;
                var nidaniomodelo = this.formNuevoContacto.naniomodelo;

                var nAnioFabricacionRef = "";
                var nAnioModeloRef = "";

                $.each(this.arrayAnioFabricacion, function (index, value) {
                    if(value.nIdPar == nidaniofabricacion){
                        nAnioFabricacionRef = value.cParNombre;
                    }
                });
                $.each(this.arrayAnioModelo, function (index, value) {
                    if(value.nIdPar == nidaniomodelo){
                        nAnioModeloRef = value.cParNombre;
                    }
                });

                var url = this.ruta + '/gescontacto/SetContactoSegRefVehiculo';

                axios.post(url, {
                    nIdEmpresa: 1300011,
                    nIdSucursal: 1300013,
                    nIdCronograma: 220016,
                    nIdContacto: this.formNuevoContacto.nidcontacto,
                    nIdProveedor: this.formNuevoContacto.nidproveedor,
                    nIdLinea: this.formNuevoContacto.nidlinea,
                    nIdMarca: this.formNuevoContacto.nidmarca,
                    nIdModelo: this.formNuevoContacto.nidmodelo,
                    nAnioFabricacion: nAnioFabricacionRef,
                    nAnioModelo: nAnioModeloRef

                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Referencia Vehiculo registrada');
                        this.listarReferenciaVehiculoByContacto(1);
                    }
                    else{
                        swal('Ya existe Referencia Vehiculo');
                    }
                }).catch(error => {
                    console.log(error);
                });
            },
            validarRegistraSegReferenciaVehiculo(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formNuevoContacto.nidproveedor == 0){
                    this.mensajeError.push('Debes Seleccionar Proveedor');
                };
                if(this.formNuevoContacto.nidlinea == 0){
                    this.mensajeError.push('Debes Seleccionar Linea');
                };
                if(this.formNuevoContacto.nidmarca == 0){
                    this.mensajeError.push('Debes Seleccionar Marca');
                };
                if(this.formNuevoContacto.nidmodelo == 0){
                    this.mensajeError.push('Debes Seleccionar Modelo');
                };
                if(this.formNuevoContacto.naniofabricacion == 0){
                    this.mensajeError.push('Debes Seleccionar Año Fabricación');
                };
                if(this.formNuevoContacto.naniomodelo == 0){
                    this.mensajeError.push('Debes Seleccionar Año Modelo');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            activarTab333(nIdAsignacionContactoVendedor){
                $('#Tab222').removeClass('nav-link active');
                $('#Tab222').addClass("nav-link");
                $('#Tab333').removeClass('nav-link disabled');
                $('#Tab333').addClass("nav-link active");
                $('#TabSegReferenciaVehiculo').removeClass('in active show');
                $('#TabSegSeguimiento').addClass('in active show');
                this.formNuevoSeguimiento.choraseguimiento = moment().format('HH:mm');
                this.formNuevoSeguimiento.nidasignacioncontactovendedor = nIdAsignacionContactoVendedor;
                this.llenarComboZona();
                this.llenarComboEstadoSeguimiento();
                this.llenarComboTipoSeguimiento();
                this.llenarComboFormaPago();
                this.listarSeguimientoPorIdAsignacion(1);
            },
            llenarComboZona(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110052
                                                                                + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayZona = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboEstadoSeguimiento(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110053
                                                                                + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayEstadoSeguimiento = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboTipoSeguimiento(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110054
                                                                                + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayTipoSeguimiento = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboFormaPago(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110055
                                                                                + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayFormaPago = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            listarSeguimientoPorIdAsignacion(page){
                var url = this.ruta + '/gescontacto/GetListSeguimientoByIdAsignacion';

                axios.get(url, {
                    params: {
                        'nidasignacioncontactovendedor' : this.formNuevoSeguimiento.nidasignacioncontactovendedor,
                        'page' : page
                    }
                }).then(response => {
                    this.arraySeguimiento = response.data.arraySeguimiento.data;
                    this.pagination.current_page =  response.data.arraySeguimiento.current_page;
                    this.pagination.total = response.data.arraySeguimiento.total;
                    this.pagination.per_page    = response.data.arraySeguimiento.per_page;
                    this.pagination.last_page   = response.data.arraySeguimiento.last_page;
                    this.pagination.from        = response.data.arraySeguimiento.from;
                    this.pagination.to           = response.data.arraySeguimiento.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            registrarSeguimiento(){
                if(this.validarRegistroMovimiento()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/gescontacto/SetSeguimiento';

                axios.post(url, {
                    cFlagOrigenSeguimiento: 'P',
                    nIdAsignacionContactoVendedor: this.formNuevoSeguimiento.nidasignacioncontactovendedor,
                    nIdCabeceraCotizacion: 0,
                    nIdZona: this.formNuevoSeguimiento.nidzona,
                    nIdTipoSeguimiento: this.formNuevoSeguimiento.nidtiposeguimiento,
                    nIdFormaPago: this.formNuevoSeguimiento.nidformapago,
                    nIdEstadoSeguimiento: this.formNuevoSeguimiento.nidestadoseguimiento,
                    dFechaSeguimientoVendedor: this.formNuevoSeguimiento.dfechaseguimiento,
                    cHoraSeguimiento: this.formNuevoSeguimiento.choraseguimiento,
                    cAsunto: this.formNuevoSeguimiento.casunto,
                    cRendirSeguimiento: this.formNuevoSeguimiento.crendirseguimiento
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Seguimiento registrado');
                        this.limpiarSeguimiento();
                        this.listarSeguimientoPorIdAsignacion(1);
                    }
                }).catch(error => {
                    console.log(error);
                });
            },
            validarRegistroMovimiento(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formNuevoSeguimiento.nidasignacioncontactovendedor == 0){
                    this.mensajeError.push('Debes Seleccionar Referencia de Vehículo');
                };
                if(this.formNuevoSeguimiento.nidzona == 0){
                    this.mensajeError.push('Debes Seleccionar Zona');
                };
                if(this.formNuevoSeguimiento.nidtiposeguimiento == 0){
                    this.mensajeError.push('Debes Seleccionar Tipo Seguimiento');
                };
                if(this.formNuevoSeguimiento.nidformapago == 0){
                    this.mensajeError.push('Debes Seleccionar Forma Pago');
                };
                if(this.formNuevoSeguimiento.nidestadoseguimiento == 0){
                    this.mensajeError.push('Debes Seleccionar Estado Seguimiento');
                };
                if(this.formNuevoSeguimiento.dfechaseguimiento == ''){
                    this.mensajeError.push('Debes Ingresar Fecha Seguimiento');
                };
                if(!this.formNuevoSeguimiento.choraseguimiento){
                    this.mensajeError.push('Debes Ingresar Hora Seguimiento');
                };
                if(!this.formNuevoSeguimiento.casunto){
                    this.mensajeError.push('Debes Ingresar Asunto');
                };
                if(!this.formNuevoSeguimiento.crendirseguimiento){
                    this.mensajeError.push('Debes Ingresar Hora Seguimiento');
                };

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // ========================================================
            // =============  TAB NUEVO CONTACTO ======================
            tabNuevoContacto(){
                $('#Tab4').addClass("nav-link disabled");
                this.limpiarNuevoContacto();
                this.cargarTabDatosPersonales();
                this.tabDatosPersonales();
            },
            // =============  TAB DATOS PERSONALES ======================
            tabDatosPersonales(){
                $('#Tab11').addClass('nav-link active');
                $('#Tab22').removeClass('nav-link active');
                $('#Tab22').addClass("nav-link disabled");
                $('#Tab33').removeClass('nav-link active');
                $('#Tab33').addClass('nav-link disabled');
                $('#TabDatosPersonales').addClass('in active show');
                $('#TabDatosContacto').removeClass('in active show');
                $('#TabReferenciaVehiculo').removeClass('in active show');
            },
            cambiarTipoPersona(){
                this.llenarComboTpoDocumento();
                if(this.formNuevoContacto.ntipopersona == 1)
                {
                    this.formNuevoContacto.lblcnombres = '* Nombres',
                    this.vistaDatosPersonaNatural = 1
                }
                else
                {
                    this.formNuevoContacto.lblcnombres = '* Razón Social',
                    this.vistaDatosPersonaNatural = 0
                }
            },
            cargarTabDatosPersonales(){
                this.llenarComboTpoDocumento();
                this.llenarComboDptos();
                this.llenarComboDptos();
                this.llenarComboProv();
                this.llenarComboDist();
                this.llenarComboEstadoCivil();
                this.llenarComboProfesion();
                this.llenarComboAnioFabricacion();
                this.llenarComboAnioModelo();
                this.llenarComboTpoDocumentoDatoConctactoJurifico();
            },
            validarTab22(){
                this.error = 0;
                this.mensajeError =[];
                let nrodocumento = this.formNuevoContacto.cnrodocumento;

                if(this.formNuevoContacto.ntpodocumento == 0){
                    this.mensajeError.push('Debes Seleccionar Tipo Documento');
                };
                if(this.formNuevoContacto.ntipopersona == 1)
                {
                    if(!nrodocumento){
                        this.mensajeError.push('Debes Ingresar Nro Documento');
                    };
                    if(nrodocumento.length < 8 || nrodocumento.length > 8) {
                        this.mensajeError.push('El Nro Documento debe contener 8 dígitos');
                    };
                    if(this.formNuevoContacto.ncelular.length > 9){
                        this.mensajeError.push('El numero de Celular es incorrecto');
                    };
                    if(!this.formNuevoContacto.capepaterno){
                        this.mensajeError.push('Debes Ingresar Apellido Paterno');
                    };
                    if(!this.formNuevoContacto.capematerno){
                        this.mensajeError.push('Debes Ingresar Apellido Materno');
                    };
                    if(!this.formNuevoContacto.cnombre){
                        this.mensajeError.push('Debes Ingresar Nombres');
                    };
                }

                if(this.formNuevoContacto.ntipopersona == 2){
                    if(!nrodocumento){
                        this.mensajeError.push('Debes Ingresar Nro Documento');
                    };
                    if(nrodocumento.length < 11 || nrodocumento.length > 11) {
                        this.mensajeError.push('El Nro Documento debe contener (11) números');
                    };
                    if(!this.formNuevoContacto.cnombre){
                        this.mensajeError.push('Debes Ingresar Razon Social');
                    };
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            llenarComboTpoDocumento(){
                if(this.formNuevoContacto.ntipopersona == 1)
                {
                    var url = this.ruta + '/parametro/GetDocumentoNatural?ngrupoparid=' + 110047
                                                                            + '&opcion=' + 0;
                    axios.get(url).then(response => {
                        this.arrayTipoDocumento = response.data;
                        this.formNuevoContacto.ntpodocumento = 0;
                    }).catch(error => {
                        console.log(error);
                    });
                }
                else{
                    var url = this.ruta + '/parametro/GetDocumentoJuridica?ngrupoparid=' + 110047
                                                                                + '&opcion=' + 0;
                    axios.get(url).then(response => {
                        this.arrayTipoDocumento = response.data;
                        this.formNuevoContacto.ntpodocumento = 0;
                    }).catch(error => {
                        console.log(error);
                    });
                }
            },
            llenarComboDptos(){
                var url = this.ruta + '/ubigeo/GetDptos';
                axios.get(url).then(response => {
                    this.arrayDptos = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboProv(){
                var url = this.ruta + '/ubigeo/GetProvinciasByDpto?niddepartamento=' + this.formNuevoContacto.niddepartamento;
                axios.get(url).then(response => {
                    this.arrayProv = response.data;
                    this.formNuevoContacto.nidprovincia = 0;
                    this.arrayDist = [];
                    this.llenarComboDist();
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboDist(){
                var url = this.ruta + '/ubigeo/GetDistritosByProv?nidprovincia=' + this.formNuevoContacto.nidprovincia;
                axios.get(url).then(response => {
                    this.arrayDist = response.data;
                    this.formNuevoContacto.niddistrito = 0;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboEstadoCivil(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110048
                                                                            + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayEstadoCivil = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboProfesion(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110049
                                                                            + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayProfesion = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            // =============  TAB DATOS DE CONTACTO ======================
            activarTab22(){
                if(this.validarTab22()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#Tab11').removeClass('nav-link active');
                $('#Tab11').addClass("nav-link");
                $('#Tab22').removeClass('nav-link disabled');
                $('#Tab22').addClass("nav-link active");
                $('#TabDatosPersonales').removeClass('in active show');
                $('#TabDatosContacto').addClass('in active show');
            },
            validarTab33(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formNuevoContacto.niddepartamento == 0){
                    this.mensajeError.push('Debes Seleccionar Departamento');
                };
                if(this.formNuevoContacto.nidprovincia == 0){
                    this.mensajeError.push('Debes Seleccionar Provincia');
                };
                if(this.formNuevoContacto.niddistrito == 0){
                    this.mensajeError.push('Debes Seleccionar Distrito');
                };
                if(!this.formNuevoContacto.cdireccion){
                    this.mensajeError.push('Debes Ingresar Dirección');
                };
                if(!this.formNuevoContacto.cmailprincipal){
                    this.mensajeError.push('Debes Ingresar Email');
                };
                if(!this.formNuevoContacto.ncelular){
                    this.mensajeError.push('Debes Ingresar Celular');
                };
                if(this.formNuevoContacto.ncelular.length > 9){
                        this.mensajeError.push('El numero de Celular es incorrecto');
                };

                if(this.formNuevoContacto.ntipopersona == 2) {
                    let nrodocumento = this.formNuevoContactoJurifico.cnrodocumento;
                    if(this.formNuevoContactoJurifico.ntpodocumento == 0){
                        this.mensajeError.push('Debes Seleccionar un Tipo de Documento');
                    };
                    if(!nrodocumento){
                        this.mensajeError.push('Debes escribir el #doc del contacto');
                    };
                    if(nrodocumento.length < 8 || nrodocumento.length > 9) {
                        this.mensajeError.push('El Nro Documento debe contener más de 7 dígitos');
                    };
                    if(!this.formNuevoContactoJurifico.capepaterno){
                        this.mensajeError.push('Debes escribir el apellido paterno del contacto');
                    };
                    if(!this.formNuevoContactoJurifico.capematerno){
                        this.mensajeError.push('Debes escribir el apellido materno del contacto');
                    };
                    if(!this.formNuevoContactoJurifico.cnombre){
                        this.mensajeError.push('Debes escribir el nombre del contacto');
                    };
                    if(!this.formNuevoContactoJurifico.cmailprincipal){
                        this.mensajeError.push('Debes escribir el correo del contacto');
                    };
                    if(!this.formNuevoContactoJurifico.ncelular){
                        this.mensajeError.push('Debes escribir el telefono movil del contacto');
                    };
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            llenarComboTpoDocumentoDatoConctactoJurifico(){
                var url = this.ruta + '/parametro/GetDocumentoNatural?ngrupoparid=' + 110047
                                                                            + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayTipoDocumentoNaturales = response.data;
                    this.formNuevoContactoJurifico.ntpodocumento = 0;
                }).catch(error => {
                    console.log(error);
                });
            },
            // =============  TAB REFERENCIA VEHICULO ======================
            activarTab33(){
                if(this.validarTab33()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#Tab22').removeClass('nav-link active');
                $('#Tab22').addClass("nav-link");
                $('#Tab33').removeClass('nav-link disabled');
                $('#Tab33').addClass("nav-link active");
                $('#TabDatosContacto').removeClass('in active show');
                $('#TabReferenciaVehiculo').addClass('in active show');
                this.llenarComboLinea();
            },
            llenarComboLinea(){
                var url = this.ruta + '/versionvehiculo/GetLineasByProveedor';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidproveedor' : this.formNuevoContacto.nidproveedor
                    }
                }).then(response => {
                    this.arrayLinea = response.data;
                    this.formNuevoContacto.nidlinea = 0;
                    this.llenarComboMarca();
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboMarca(){
                var url = this.ruta + '/versionvehiculo/GetMarcaByLinea';

                axios.get(url, {
                    params: {
                        'nidlinea': this.formNuevoContacto.nidlinea
                    }
                }).then(response => {
                    this.arrayMarca = response.data;
                    this.formNuevoContacto.nidmarca = 0;
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
                        'nidmarca': this.formNuevoContacto.nidmarca
                    }
                }).then(response => {
                    this.arrayModelo = response.data;
                    this.formNuevoContacto.nidmodelo = 0;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboAnioFabricacion(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110034
                                                                                + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayAnioFabricacion = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboAnioModelo(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110035
                                                                                + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayAnioModelo = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            asignarReferenciaVehiculo(){
                if(this.validaAsignarReferenciaVehiculo()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var nidlinea = this.formNuevoContacto.nidlinea;
                var nidmarca = this.formNuevoContacto.nidmarca;
                var nidmodelo = this.formNuevoContacto.nidmodelo;
                var nidaniofabricacion = this.formNuevoContacto.naniofabricacion;
                var nidaniomodelo = this.formNuevoContacto.naniomodelo;
                var cLineaNombreRef = "";
                var cMarcaNombreRef = "";
                var cModeloNombreRef = "";
                var nAnioFabricacionRef = "";
                var nAnioModeloRef = "";

                $.each(this.arrayLinea, function (index, value) {
                    if(value.nIdPar == nidlinea){
                        cLineaNombreRef = value.cParNombre;
                    }
                });
                $.each(this.arrayMarca, function (index, value) {
                    if(value.nIdPar == nidmarca){
                        cMarcaNombreRef = value.cParNombre;
                    }
                });
                $.each(this.arrayModelo, function (index, value) {
                    if(value.nIdPar == nidmodelo){
                        cModeloNombreRef = value.cParNombre;
                    }
                });
                $.each(this.arrayAnioFabricacion, function (index, value) {
                    if(value.nIdPar == nidaniofabricacion){
                        nAnioFabricacionRef = value.cParNombre;
                    }
                });
                $.each(this.arrayAnioModelo, function (index, value) {
                    if(value.nIdPar == nidaniomodelo){
                        nAnioModeloRef = value.cParNombre;
                    }
                });

                var nIdProveedorRef = this.formNuevoContacto.nidproveedor;
                var nIdLineaRef = this.formNuevoContacto.nidlinea;
                var nIdMarcaRef = this.formNuevoContacto.nidmarca;
                var nIdModeloRef = this.formNuevoContacto.nidmodelo;
                var cProveedorNombreRef = this.formNuevoContacto.cproveedornombre;

                if(this.encuentraReferenciaVehiculo(nIdProveedorRef, nIdLineaRef, nIdMarcaRef, nIdModeloRef, nAnioFabricacionRef, nAnioModeloRef)){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Esa Referencia Vehículo ya se encuentra agregada!',
                            })
                }
                else{
                    this.arrayReferenciaVehiculo.push({
                                nIdProveedor: nIdProveedorRef,
                                nIdLinea: nIdLineaRef,
                                nIdMarca: nIdMarcaRef,
                                nIdModelo: nIdModeloRef,
                                cProveedorNombre: cProveedorNombreRef,
                                cLineaNombre: cLineaNombreRef,
                                cMarcaNombre: cMarcaNombreRef,
                                cModeloNombre: cModeloNombreRef,
                                nAnioFabricacion: nAnioFabricacionRef,
                                nAnioModelo: nAnioModeloRef
                    });
                    toastr.success('Se Agregó Referencia Vehiculo');
                }
            },
            encuentraReferenciaVehiculo(nIdProveedorRef, nIdLineaRef, nIdMarcaRef, nIdModeloRef, nAnioFabricacionRef, nAnioModeloRef){
                var sw=0;
                for(var i=0;i<this.arrayReferenciaVehiculo.length;i++){
                    if(this.arrayReferenciaVehiculo[i].nIdProveedor==nIdProveedorRef &&
                        this.arrayReferenciaVehiculo[i].nIdLinea==nIdLineaRef &&
                        this.arrayReferenciaVehiculo[i].nIdMarca==nIdMarcaRef &&
                        this.arrayReferenciaVehiculo[i].nIdModelo==nIdModeloRef &&
                        this.arrayReferenciaVehiculo[i].nAnioFabricacion==nAnioFabricacionRef &&
                        this.arrayReferenciaVehiculo[i].nAnioModelo==nAnioModeloRef    ){
                        sw=true;
                    }
                }
                return sw;
            },
            validaAsignarReferenciaVehiculo(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formNuevoContacto.nidproveedor == 0){
                    this.mensajeError.push('Debes Seleccionar Proveedor');
                };
                if(this.formNuevoContacto.nidlinea == 0){
                    this.mensajeError.push('Debes Seleccionar Linea');
                };
                if(this.formNuevoContacto.nidmarca == 0){
                    this.mensajeError.push('Debes Seleccionar Marca');
                };
                if(this.formNuevoContacto.nidmodelo == 0){
                    this.mensajeError.push('Debes Seleccionar Modelo');
                };
                if(this.formNuevoContacto.naniofabricacion == 0){
                    this.mensajeError.push('Debes Seleccionar Año Fabricación');
                };
                if(this.formNuevoContacto.naniomodelo == 0){
                    this.mensajeError.push('Debes Seleccionar Año Modelo');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            eliminarItemReferenciaVehiculo(index){
                this.$delete(this.arrayReferenciaVehiculo, index);
            },
            // =============  REGISTRAR CONTACTO ======================
            registrarNuevoContacto(){
                if(this.validarRegistroNuevoContacto()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                if (this.formNuevoContacto.ntipopersona == "1") {
                    this.registrarPersonaNatural();
                } else {
                    this.registrarPersonaJuridica();
                }
            },
            registrarPersonaNatural(){
                var url = this.ruta + '/gescontacto/SetContactoPerNatural';
                axios.post(url, {
                    nIdTipoDocumento: this.formNuevoContacto.ntpodocumento,
                    cNumeroDocumento: String(this.formNuevoContacto.cnrodocumento),
                    cNombre: this.formNuevoContacto.cnombre.toUpperCase().toString(),
                    cApellidoPaterno: this.formNuevoContacto.capepaterno.toUpperCase().toString(),
                    cApellidoMaterno: this.formNuevoContacto.capematerno.toUpperCase().toString(),
                    cUbigeo: this.formNuevoContacto.niddistrito,
                    cDireccion: this.formNuevoContacto.cdireccion.toUpperCase().toString(),
                    cEmail: this.formNuevoContacto.cmailprincipal.toUpperCase().toString(),
                    cEmailAlternativo: this.formNuevoContacto.cmailalternativo.toUpperCase().toString(),
                    dFechaNacimiento: this.formNuevoContacto.dfecnacimiento,
                    nIdEstadoCivil: this.formNuevoContacto.nestadocivil,
                    cTelefonoFijo: this.formNuevoContacto.ctelefonofijo,
                    nTelefonoMovil: this.formNuevoContacto.ncelular,
                    nTelefonoMovilAlternativo: this.formNuevoContacto.ncelularalternativo,
                    cCentroLaboral: this.formNuevoContacto.ccentrolaboral.toUpperCase().toString(),
                    nIdProfesion: this.formNuevoContacto.nprofesion
                }).then(response => {
                    if(response.data[0].nFlagMsje==1){
                        this.registrarReferenciaVehiculo(response.data[0].nIdContacto);
                    }else{
                        swal('Ya existe Persona');
                    }
                }).catch(error => {
                    console.log(error);
                });
            },
            registrarPersonaJuridica(){
                var url = this.ruta + '/gescontacto/SetContactoPerJuridica';
                axios.post(url, {
                    //Datos contacto Juridico
                    cRuc: String(this.formNuevoContacto.cnrodocumento),
                    cRazonSocial: this.formNuevoContacto.cnombre.toUpperCase().toString(),
                    cUbigeo: this.formNuevoContacto.niddistrito,
                    cDireccion: this.formNuevoContacto.cdireccion.toUpperCase().toString(),
                    cEmail: this.formNuevoContacto.cmailprincipal.toUpperCase().toString(),
                    cEmailAlternativo: this.formNuevoContacto.cmailalternativo.toUpperCase().toString(),
                    cTelefonoFijo: this.formNuevoContacto.ctelefonofijo,
                    nTelefonoMovil: this.formNuevoContacto.ncelular,
                    nTelefonoMovilAlternativo: this.formNuevoContacto.ncelularalternativo,
                    //Datos Contacto Natural del Juridico
                    nIdTipoDocumentoContacto: this.formNuevoContactoJurifico.ntpodocumento,
                    cNumeroDocumentoContacto: String(this.formNuevoContactoJurifico.cnrodocumento),
                    cNombreContacto: this.formNuevoContactoJurifico.cnombre.toUpperCase().toString(),
                    cApellidoPaternoContacto: this.formNuevoContactoJurifico.capepaterno.toUpperCase().toString(),
                    cApellidoMaternoContacto: this.formNuevoContactoJurifico.capematerno.toUpperCase().toString(),
                    cEmailPrincipalContacto: this.formNuevoContactoJurifico.cmailprincipal.toUpperCase().toString(),
                    cTelefonoMovilContacto: this.formNuevoContactoJurifico.ncelular.toUpperCase().toString()
                }).then(response => {
                    if(response.data[0].nFlagMsje==1){
                        this.registrarReferenciaVehiculo(response.data[0].nIdContacto);
                        console.log(response.data[0]);
                    }else{
                        swal('Ya existe Persona');
                    }
                }).catch(error => {
                    console.log(error);
                });
            },
            validarRegistroNuevoContacto(){
                this.error = 0;
                this.mensajeError =[];

                if(this.arrayReferenciaVehiculo.length == 0){
                    this.mensajeError.push('Debes Ingresar una Referencia Vehículo');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            registrarReferenciaVehiculo(nIdContacto){
                if(this.arrayReferenciaVehiculo.length > 0){
                    var url = this.ruta + '/gescontacto/SetContactoRefVehiculo';
                    axios.post(url, {
                        nIdEmpresa: 1300011,
                        nIdSucursal: 1300013,
                        nIdCronograma: 220016,
                        nIdContacto: nIdContacto,
                        data: this.arrayReferenciaVehiculo
                    }).then(response => {
                        swal('Contacto registrado');
                        this.limpiarNuevoContacto();
                        this.tabDatosPersonales();
                    }).catch(error => {
                        console.log(error);
                    });
                }
            },
            // ========================================================
            // =============  TAB LEADS ======================
            getFile(e){
                let selectFile = e.target.files[0];
                this.attachment = selectFile;
            },
            importFileLeads(){
                if(this.validarReadFileLeads()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.form.append('file', this.attachment);
                const config = { headers: { 'Content-Type': 'multipart/form-data'  } };
                var url = this.ruta + '/gescontacto/importFileLeads';
                axios.post(url, this.form, config).then(response=>{
                    this.readFileLeads(response.data);
                }).catch(error => {
                    console.log(error);
                });
            },
            readFileLeads(nameFile){
                //this.mostrarProgressBar();

                var url = this.ruta + '/gescontacto/readFileLeads';
                axios.post(url, {
                    nameFile: nameFile
                }).then(response => {

                    /*if(this.validaCamposExcel(response.data)){
                        this.accionmodal=1;
                        this.modal = 1;
                        return;
                    }*/

                    this.$delete(response.data, 0);
                    this.arrayLeads = response.data;
                    this.contadorArrayLeads = this.arrayLeads.length;

                    /*
                    let me = this;

                    this.$delete(response.data, 0);
                    this.arrayTemporalLeads = response.data;

                    this.arrayTemporalLeads.map(function(value, key) {
                            var arrayNombres = [];
                            var NuevoNombreCompleto;
                            var cNombre, cApellidoPaterno, cApellidoMaterno;
                            var cFlagActivaLead;
                            NuevoNombreCompleto = value.cNombreCompleto.replace(".", "");
                            NuevoNombreCompleto = NuevoNombreCompleto.replace("  ", " ");
                            NuevoNombreCompleto = NuevoNombreCompleto.replace("   ", " ");
                            NuevoNombreCompleto = NuevoNombreCompleto.trim();
                            arrayNombres = NuevoNombreCompleto.split(" ");

                            if(arrayNombres.length == 3){
                                cNombre = arrayNombres[0];
                                cApellidoPaterno = arrayNombres[1];
                                cApellidoMaterno = arrayNombres[2];
                                cFlagActivaLead = "SI";
                            }
                            else if(arrayNombres.length == 4){
                                cNombre = arrayNombres[0] + " " + arrayNombres[1];
                                cApellidoPaterno = arrayNombres[2];
                                cApellidoMaterno = arrayNombres[3];
                                cFlagActivaLead = "SI";
                            }
                            else{
                                cNombre = "";
                                cApellidoPaterno = "";
                                cApellidoMaterno = "";
                                cFlagActivaLead = "NO";
                            }

                            if(cFlagActivaLead == "SI")
                            {
                                me.arrayLeads.push({
                                    cTipoDocumento: value.cTipoDocumento,
                                    cNumeroDocumento: value.cNumeroDocumento,
                                    cNombre: cNombre.toUpperCase(),
                                    cApellidoPaterno: cApellidoPaterno.toUpperCase(),
                                    cApellidoMaterno: cApellidoMaterno.toUpperCase(),
                                    cTelefonoFijo: value.cTelefonoFijo,
                                    nTelefonoMovil: value.nTelefonoMovil,
                                    cEmail: value.cEmail,
                                    cDepartamentoNombre: value.cDepartamentoNombre,
                                    cProvinciaNombre: value.cProvinciaNombre,
                                    cDistritoNombre: value.cDistritoNombre,
                                    cDireccion: value.cDireccion,
                                    cMarcaNombre: value.cMarcaNombre,
                                    cModeloNombre: value.cModeloNombre,
                                    cGlosa: value.cGlosa
                                });
                            }     
                    });
                    
                    
                    this.contadorArrayLeads = me.arrayLeads.length;*/

                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            validarReadFileLeads(){
                this.error = 0;
                this.mensajeError =[];

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            validaCamposExcel(foo){
                this.error = 0;
                this.mensajeError = [];
                var list=[];

                foo.map(function(value, key) {
                    if(key==0){
                        if(value.nOrdenCompra != "OC"){
                            list.push('Falta celda OC, verifique el archivo.');
                        };
                        if(value.cNombreLinea != "Línea"){
                            list.push('Falta celda Línea, verifique el archivo.');
                        };
                        if(value.cNombreAlmacen != "Almacén"){
                            list.push('Falta celda Almacén, verifique el archivo.');
                        };
                        if(value.nNumeroReserva != "Nro Reserva"){
                            list.push('Falta celda Nro Reserva, verifique el archivo.');
                        };
                        if(value.fTotalCompra != "Total"){
                            list.push('Falta celda Total, verifique el archivo.');
                        };
                    };
                    /*if(key != 0){
                        if(!/^([0-9])*[.]?[0-9]*$/.test(value.fTotalCompra)){
                            list.push('Existe un error en el campo Total, verifique el archivo.');
                        }
                    };*/
                });

                if(list.length){
                    this.mensajeError = list;
                    this.error = 1;
                }
                return this.error;
            },
            eliminarItemLead(index){
                this.$delete(this.arrayLeads, index);
                this.contadorArrayLeads = this.arrayLeads.length;
            },
            registrarLeads(){
                if(this.validarRegistroLead()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/gescontacto/SetLeads';
                axios.post(url, {
                    data: this.arrayLeads
                }).then(response => {
                    swal('Leads registrados');
                    this.arrayLeads = [];
                    $("#file-upload").val("");
                }).catch(error => {
                    console.log(error);
                });


            },
            validarRegistroLead(){
                this.error = 0;
                this.mensajeError =[];

                if(this.arrayLeads == []){
                    this.mensajeError.push('No hay Datos a Registrar');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // ==========================================================
            // =============  BUSCAR PROVEEDORES ========================
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
                        'opcion' : 1,
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
                this.formNuevoContacto.nidproveedor = nProveedorId;
                this.formNuevoContacto.cproveedornombre = cProveedorNombre;
                this.cerrarModal();
                this.arrayMarca = [];
                this.arrayModelo = [];
                this.llenarComboLinea();
            },
            // ==========================================================
            // =============  BUSCAR VENDEDORES =========================
            listarVendedores(page){
                var url = this.ruta + '/gescontacto/GetListVendedoresByJFV';

                axios.get(url, {
                    params: {
                        'cnombrevendedor' :   this.fillVendedor.cnombrevendedor,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayVendedor = response.data.arrayVendedor.data;
                    this.paginationModal.current_page =  response.data.arrayVendedor.current_page;
                    this.paginationModal.total = response.data.arrayVendedor.total;
                    this.paginationModal.per_page    = response.data.arrayVendedor.per_page;
                    this.paginationModal.last_page   = response.data.arrayVendedor.last_page;
                    this.paginationModal.from        = response.data.arrayVendedor.from;
                    this.paginationModal.to           = response.data.arrayVendedor.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaVendedor(page){
                this.paginationModal.current_page=page;
                this.listarVendedores(page);
            },
            asignarVendedor(nVendedorId, cVendedorNombre){
                this.formVendedor.nidvendedor = nVendedorId;
                this.formVendedor.cvendedornombre = cVendedorNombre;
                this.cerrarModal();
            },
            reasignarVendedor(nVendedorId, cVendedorNombre){
                this.formReasignarContacto.nreasignaidvendedor = nVendedorId;
                this.formReasignarContacto.creasignavendedornombre = cVendedorNombre;
                this.cerrarModal();
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
                    case "vendedor":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=3;
                                this.modal = 1;
                                this.listarVendedores(1);
                                break;
                            }
                        }
                    }
                    break;
                    case "nuevovendedor":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=4;
                                this.modal = 1;
                                this.listarVendedores(1);
                                break;
                            }
                        }
                    }
                    break;
                }
            },
            // ===========================================================
            limpiarMisContactos(){
                this.fillMisContactos.cnrodocumento = '';
                this.fillMisContactos.cfiltrodescripcion = '';
            },
            limpiarTodoVendedor(){
                this.arrayVendedor = [];
                this.formVendedor.nidvendedor = 0;
                this.formVendedor.cvendedornombre = '';
            },
            limpiarContactosPorVendedor(){
                this.fillContactoPorVendedor.cnrodocumento = '';
                this.fillContactoPorVendedor.cfiltrodescripcion = '';
            },
            limpiarReasignarContacto(){
                this.formReasignarContacto.nidcontacto = 0;
                this.formReasignarContacto.ccontacto = '';
                this.formReasignarContacto.nidvendedor = 0;
                this.formReasignarContacto.cvendedornombre = '';
                this.formReasignarContacto.nreasignaidvendedor = 0;
                this.formReasignarContacto.creasignavendedornombre = '';
            },
            limpiarContactoLibre(){
                this.fillContactoLibre.cnrodocumento = '';
                this.fillContactoLibre.cfiltrodescripcion = '';
            },
            limpiarSeguimiento(){
                this.formNuevoSeguimiento.nidzona = 0;
                this.formNuevoSeguimiento.nidestadoseguimiento = 0;
                this.formNuevoSeguimiento.nidtiposeguimiento = 0;
                this.formNuevoSeguimiento.dfechaseguimiento = '';
                this.formNuevoSeguimiento.choraseguimiento = '';
                this.formNuevoSeguimiento.casunto = '';
                this.formNuevoSeguimiento.crendirseguimiento = '';
            },
            limpiarNuevoContacto(){
                //Tab DATOS PERSONALES
                this.formNuevoContacto.ntpodocumento = 0,
                this.formNuevoContacto.cnrodocumento = '',
                this.formNuevoContacto.capepaterno = '',
                this.formNuevoContacto.capematerno = '',
                this.formNuevoContacto.cnombre = '',
                this.formNuevoContacto.dfecnacimiento = '',
                //Tab DATOS DE CONTACTO
                this.formNuevoContacto.niddepartamento = 0,
                this.formNuevoContacto.nidprovincia = 0,
                this.formNuevoContacto.niddistrito = 0,
                this.formNuevoContacto.cdireccion = '',
                this.formNuevoContacto.cmailprincipal = '',
                this.formNuevoContacto.cmailalternativo = '',
                this.formNuevoContacto.ctelefonofijo = '',
                this.formNuevoContacto.ncelular = '',
                this.formNuevoContacto.ncelularalternativo = '',
                this.formNuevoContacto.nestadocivil = 0,
                this.formNuevoContacto.nprofesion = 0,
                this.formNuevoContacto.ccentrolaboral = '',
                //Tab DATOS DE CONTACTO - Datos Contacto Jurídico
                this.formNuevoContactoJurifico.ntpodocumento = 0,
                this.formNuevoContactoJurifico.cnrodocumento = '',
                this.formNuevoContactoJurifico.capematerno = '',
                this.formNuevoContactoJurifico.capepaterno = '',
                this.formNuevoContactoJurifico.cnombre = '',
                this.formNuevoContactoJurifico.cmailprincipal = '',
                this.formNuevoContactoJurifico.ncelular = '',
                //Tab REFERENCIA VEHICULO
                this.formNuevoContacto.nidproveedor = 0,
                this.formNuevoContacto.cproveedornombre = '',
                this.arrayLinea = [];
                this.arrayMarca = [];
                this.arrayModelo = [];
                this.formNuevoContacto.nidlinea = 0,
                this.formNuevoContacto.nidmarca = 0,
                this.formNuevoContacto.nidmodelo = 0,
                this.formNuevoContacto.naniofabricacion = 0,
                this.formNuevoContacto.naniomodelo = 0
                //Referencia
                this.arrayReferenciaVehiculo = []
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
            //this.tabBuscarEventoCampania();
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
        .el-select{
            width: 100%;
        }
        .el-date-editor.el-input, .el-date-editor.el-input__inner{
            width: 100% !important;
        }
</style>
