<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">
                        <vs-divider color="dark">MODULO GESTIÓN DE CONTACTOS JEFE DE VENTAS</vs-divider>
                    </h2>
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
                                        <a class="nav-link" id="Tab5" href="#TabLeads" @click="tabLeads()" role="tab" data-toggle="tab">
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
                                                                                    <input type="radio" class="radio-template" v-model="fillMisContactos.ntipopersona" :value="tipo.value" @change="cambiarTipoPersonaMisContactos()">
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
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarMisContactosJFV(1);">
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
                                                            <template v-if="arrayContacto.length">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-sm">
                                                                        <template v-if="fillMisContactos.ntipopersona == 1">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Código</th>
                                                                                    <th>#Codigo SAP</th>
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
                                                                                    <td v-text="c.CardCode"></td>
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
                                                                                        <el-tooltip class="item" effect="dark" v-if="c.CardCode == '' || c.CardCode == null">
                                                                                            <div slot="content"> Generar Cardcode - SAP : {{ c.cPerApellidos + ' ' + c.cNombre }}</div>
                                                                                            <i @click="SapRegistrarNuevoContacto(c)" :style="'color:green'" class="fa-spin fa-md fa fa-cube"></i>
                                                                                        </el-tooltip>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </template>
                                                                        <template v-else>
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Código</th>
                                                                                    <th>#Codigo SAP</th>
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
                                                                                    <td v-text="c.CardCode"></td>
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
                                                                                        <el-tooltip class="item" effect="dark" v-if="c.CardCode == '' || c.CardCode == null">
                                                                                            <div slot="content"> Generar Cardcode - SAP : {{ c.cPerApellidos + ' ' + c.cNombre }}</div>
                                                                                            <i @click="SapRegistrarNuevoContacto(c)" :style="'color:green'" class="fa-spin fa-md fa fa-cube"></i>
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
                                                                                        <input type="radio" class="radio-template" v-model="fillContactoPorVendedor.ntipopersona" :value="tipo.value" @change="cambiarTipoPersonaContactosPorVendedor()">
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
                                                                                        <input type="text" v-model="formVendedor.cvendedornombre" disabled="disabled" class="form-control form-control-sm">
                                                                                        <div class="input-group-prepend">
                                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                <div slot="content">Buscar Vendedor </div>
                                                                                                <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('vendedor','buscar')">
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
                                                                                                <i @click="mostrarVistaContactoPorVendedor(c.nIdContacto, c.cPerApellidos + ' ' +c.cNombre, c.cVendedor, 0)" :style="'color:blue'" class="fa-md fa fa-street-view"></i>
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
                                                                                                <i @click="mostrarVistaContactoPorVendedor(c.nIdContacto, c.cRazonSocial, c.cVendedor, 0)" :style="'color:blue'" class="fa-md fa fa-street-view"></i>
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
                                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                <div slot="content">Buscar Vendedor </div>
                                                                                                <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('nuevovendedor','buscar')">
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
                                                                            <button type="button" class="btn btn-secundary btn-corner btn-sm" @click="mostrarVistaContactoPorVendedor('', '', '', 1)">
                                                                                <i class="fa fa-close"></i> Regresar
                                                                            </button>
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
                                                                                    <th>Fecha Inicio</th>
                                                                                    <th>Fecha Fin</th>
                                                                                    <th>Acciones</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="referencia in arrayReasignarReferencia" :key="referencia.nIdReferenciaVehiculoContacto"
                                                                                        :style="referencia.cAsignacionVehiculoEstado=='I' ? 'color:red' : ''">
                                                                                    <td v-text="referencia.nIdReferenciaVehiculoContacto"></td>
                                                                                    <td v-text="referencia.cProveedorNombre"></td>
                                                                                    <td v-text="referencia.cLineaNombre"></td>
                                                                                    <td v-text="referencia.cMarcaNombre"></td>
                                                                                    <td v-text="referencia.cModeloNombre"></td>
                                                                                    <td v-text="referencia.nAnioFabricacion"></td>
                                                                                    <td v-text="referencia.nAnioModelo"></td>
                                                                                    <td v-text="referencia.dFechaInicioAsignacionContacto"></td>
                                                                                    <td v-text="referencia.dFechaFinAsignacionContacto"></td>
                                                                                    <td>
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Ampliar Fecha  {{ referencia.cMarcaNombre + ' ' + referencia.cModeloNombre }}</div>
                                                                                            <i @click="abrirModal('referencia', 'ampliar', referencia)" :style="'color:#796AEE'" class="fa-md fa fa-clock-o"></i>
                                                                                        </el-tooltip>&nbsp;
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Reasignar Referencia {{ referencia.cMarcaNombre + ' ' + referencia.cModeloNombre }}</div>
                                                                                            <i @click="reasignarReferenciaVehiculo(referencia)" :style="'color:blue'" class="fa-md fa fa-car"></i>
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
                                                                                        <input type="radio" class="radio-template" v-model="fillContactoLibre.ntipopersona" :value="tipo.value" @change="cambiarTipoPersonaContactoLibre()">
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
                                                                                    <el-select v-model="fillContactoLibre.ntipocontacto" filterable clearable placeholder="SELECCIONE" >
                                                                                        <el-option
                                                                                        v-for="item in arrayTipoContacto"
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
                                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                <div slot="content">Buscar Vendedor </div>
                                                                                                <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('vendedor','buscar')">
                                                                                                    <i class="fa-lg fa fa-search"></i>
                                                                                                </button>
                                                                                            </el-tooltip>
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
                                                                                        <label class="col-sm-4 form-control-label">Linea Vehiculo</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="hidden" v-model="formNuevoContacto.nidcontacto">
                                                                                            <el-select v-model="formNuevoContacto.nidlinea" filterable clearable placeholder="SELECCIONE" @change="llenarComboMarca()">
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
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Marca</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-select v-model="formNuevoContacto.nidmarca" filterable clearable placeholder="SELECCIONE" @change="llenarComboModelo()">
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
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Modelo</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-select v-model="formNuevoContacto.nidmodelo" filterable clearable placeholder="SELECCIONE" >
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
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Año Fabricación</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-select v-model="formNuevoContacto.naniofabricacion" filterable clearable placeholder="SELECCIONE" >
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
                                                                                            <el-select v-model="formNuevoContacto.naniomodelo" filterable clearable placeholder="SELECCIONE" >
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
                                                                                                    <th>Fecha Inicio</th>
                                                                                                    <th>Fecha Fin</th>
                                                                                                    <th>Acciones</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr v-for="r in arraySegReferenciavehiculo" :key="r.nIdReferenciaVehiculoContacto" :style="r.cAsignacionVehiculoEstado=='I' ? 'color:red' : ''">
                                                                                                    <td v-text="r.nIdReferenciaVehiculoContacto"></td>
                                                                                                    <td v-text="r.cProveedorNombre"></td>
                                                                                                    <td v-text="r.cLineaNombre"></td>
                                                                                                    <td v-text="r.cMarcaNombre"></td>
                                                                                                    <td v-text="r.cModeloNombre"></td>
                                                                                                    <td v-text="r.nAnioFabricacion"></td>
                                                                                                    <td v-text="r.nAnioModelo"></td>
                                                                                                    <td v-text="r.dFechaInicioAsignacionContacto"></td>
                                                                                                    <td v-text="r.dFechaFinAsignacionContacto"></td>
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
                                                                                            <el-select v-model="formNuevoSeguimiento.nidzona" filterable clearable placeholder="SELECCIONE" >
                                                                                                <el-option
                                                                                                v-for="item in arrayZona"
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
                                                                                        <label class="col-sm-4 form-control-label">* Estado</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="text" v-model="formNuevoSeguimiento.cestadoseguimiento" disabled class="form-control form-control-sm">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Tipo Seguimiento</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-select v-model="formNuevoSeguimiento.nidtiposeguimiento" filterable clearable placeholder="SELECCIONE" >
                                                                                                <el-option
                                                                                                v-for="item in arrayTipoSeguimiento"
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
                                                                                        <label class="col-sm-4 form-control-label">* Forma de Pago</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-select v-model="formNuevoSeguimiento.nidformapago" filterable clearable placeholder="SELECCIONE" >
                                                                                                <el-option
                                                                                                v-for="item in arrayFormaPago"
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
                                                                                                    <th>Codigo</th>
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
                                                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                                <div slot="content">Desactivar  {{ s.nIdSeguimientoContacto }}</div>
                                                                                                                <i @click="desactivarSeguimiento(s.nIdSeguimientoContacto)" :style="'color:#796AEE'" class="fa-md fa fa-check-square"></i>
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
                                                            <a class="nav-link disabled" id="Tab33" href="#TabReferenciaVehiculo" @click="limpiarAsignacion();" role="tab" data-toggle="tab">
                                                                <i class="fa fa-car"></i> REFERENCIA VEHICULO
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link disabled" id="Tab44" href="#TabOtrosIntereses" @click="limpiarAsignacion();" role="tab" data-toggle="tab">
                                                                <i class="fa fa-car"></i> OTROS INTERESES
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
                                                                                                <input type="radio" class="radio-template" v-model="formNuevoContacto.ntipopersona" :value="tipo.value" @change="cambiarTipoPersona()">
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
                                                                                            <el-select v-model="formNuevoContacto.ntpodocumento" filterable clearable placeholder="SELECCIONE" >
                                                                                                <el-option
                                                                                                v-for="item in arrayTipoDocumento"
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
                                                                                        <label class="col-sm-4 form-control-label">* Ubigeo</label>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="input-group">
                                                                                                <input type="text" v-model="formNuevoContacto.cubigeo" disabled="disabled" class="form-control form-control-sm">
                                                                                                <div class="input-group-prepend">
                                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                        <div slot="content">Buscar Ubigeo </div>
                                                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('ubigeo','buscar')">
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
                                                                                        <label class="col-sm-4 form-control-label">Email</label>
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
                                                                                            <input type="number" v-model="formNuevoContacto.ncelular" class="form-control form-control-sm">
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
                                                                                            <label class="col-sm-4 form-control-label">* Estado Civil</label>
                                                                                            <div class="col-sm-8">
                                                                                                <el-select v-model="formNuevoContacto.nestadocivil" filterable clearable placeholder="SELECCIONE" >
                                                                                                    <el-option
                                                                                                        v-for="item in arrayEstadoCivil"
                                                                                                        :key="item.nIdPar"
                                                                                                        :label="item.cParNombre"
                                                                                                        :value="item.nIdPar">
                                                                                                    </el-option>
                                                                                                </el-select>
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
                                                                                                <el-select v-model="formNuevoContacto.nprofesion" filterable clearable placeholder="SELECCIONE" >
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
                                                                                                            <el-select v-model="formNuevoContactoJurifico.ntpodocumento" filterable clearable placeholder="SELECCIONE" >
                                                                                                                <el-option
                                                                                                                v-for="item in arrayTipoDocumentoNaturales"
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
                                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                        <div slot="content">Buscar Proveedor </div>
                                                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('proveedor','buscar', 1)">
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
                                                                                        <label class="col-sm-4 form-control-label">Linea Vehiculo</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-select v-model="formNuevoContacto.nidlinea" filterable clearable placeholder="SELECCIONE" @change="llenarComboMarca()">
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
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Marca</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-select v-model="formNuevoContacto.nidmarca" filterable clearable placeholder="SELECCIONE" @change="llenarComboModelo()">
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
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Modelo</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-select v-model="formNuevoContacto.nidmodelo" filterable clearable placeholder="SELECCIONE" >
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
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Año Fabricación</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-select v-model="formNuevoContacto.naniofabricacion" filterable clearable placeholder="SELECCIONE" >
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
                                                                                            <el-select v-model="formNuevoContacto.naniomodelo" filterable clearable placeholder="SELECCIONE" >
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
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Fecha Referencia Compra</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-date-picker
                                                                                                v-model="formNuevoContacto.dfechareferenciacompra"
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
                                                                                <div class="col-sm-9 offset-sm-5">
                                                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="asignarReferenciaVehiculo()">
                                                                                        <i class="fa fa-arrow-down"></i> Asignar
                                                                                    </button>
                                                                                    <button type="button" class="btn btn-default btn-corner btn-sm" @click="activarTab44();">
                                                                                        <i class="fa fa-arrow-right"></i> Siguiente
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
                                                        <div role="tabpanel" class="tab-pane fade" id="TabOtrosIntereses">
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
                                                                                                <input type="text" v-model="formNuevoContacto.cproveedornombre2" disabled="disabled" class="form-control form-control-sm">
                                                                                                <div class="input-group-prepend">
                                                                                                    <el-tooltip class="item" effect="dark" >
                                                                                                        <div slot="content">Buscar Proveedor </div>
                                                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('proveedor','buscar', 2)">
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
                                                                                        <label class="col-sm-4 form-control-label">Linea Vehiculo</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-select v-model="formNuevoContacto.nidlinea2" filterable clearable placeholder="SELECCIONE" @change="llenarComboMarca()">
                                                                                                <el-option
                                                                                                    v-for="item in arrayLinea2"
                                                                                                    :key="item.nIdLinea"
                                                                                                    :label="item.cLineaNombre"
                                                                                                    :value="item.nIdLinea">
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
                                                                                            <el-select v-model="formNuevoContacto.nidmarca2" filterable clearable placeholder="SELECCIONE" @change="llenarComboModelo()">
                                                                                                <el-option
                                                                                                    v-for="item in arrayMarca2"
                                                                                                    :key="item.nIdMarca"
                                                                                                    :label="item.cMarcaNombre"
                                                                                                    :value="item.nIdMarca">
                                                                                                </el-option>
                                                                                            </el-select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Modelo</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-select v-model="formNuevoContacto.nidmodelo2" filterable clearable placeholder="SELECCIONE" >
                                                                                                <el-option
                                                                                                    v-for="item in arrayModelo2"
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
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Año Fabricación</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-select v-model="formNuevoContacto.naniofabricacion2" filterable clearable placeholder="SELECCIONE" >
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
                                                                                            <el-select v-model="formNuevoContacto.naniomodelo2" filterable clearable placeholder="SELECCIONE" >
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
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Fecha Referencia Compra</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-date-picker
                                                                                                v-model="formNuevoContacto.dfechareferenciacompra2"
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
                                                                                <div class="col-sm-9 offset-sm-5">
                                                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="asignarOtrosIntereses()">
                                                                                        <i class="fa fa-arrow-down"></i> Asignar
                                                                                    </button>
                                                                                    <!--<button type="button" class="btn btn-default btn-corner btn-sm" @click="regresarOtrosIntereses()">
                                                                                        <i class="fa fa-arrow-left"></i> Regresar
                                                                                    </button>-->
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
                                                                                <template v-if="arrayOtrosIntereses.length">
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
                                                                                                <tr v-for="(referencia, index) in arrayOtrosIntereses" :key="referencia.nIdModelo">
                                                                                                    <td>
                                                                                                        <el-tooltip class="item" effect="dark" >
                                                                                                            <div slot="content">Eliminar Referencia de Otros Intereses  {{ referencia.cMarcaNombre + ' ' + referencia.cModeloNombre }}</div>
                                                                                                            <i @click="eliminarItemOtrosIntereses(index)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                                        </el-tooltip>
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
                                                                            <label class="col-sm-4 form-control-label">Descargar Formato</label>
                                                                            <div class="col-sm-8">
                                                                                <a href="#" @click="descargaFormatoLeads">
                                                                                    <i class="fa-md fa fa-file-excel-o"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                                                                                    <th>Linea</th>
                                                                                    <th>Marca</th>
                                                                                    <th>Modelo</th>
                                                                                    <th>Año Fab</th>
                                                                                    <th>Año Modelo</th>
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
                                                                                    <td v-text="lead.nAnioFabricacion"></td>
                                                                                    <td v-text="lead.nAnioModelo"></td>
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

            <!-- Modal Show Proveedores -->
            <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTADO</h3>
                                    </div>
                                    <div class="card-body">
                                        <form @submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Nombre</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillProveedor.cnombreproveedor" @keyup.enter="buscaProveedores()" class="form-control form-control-sm">
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

             <!-- Modal Vendedores -->
            <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTADO</h3>
                                    </div>
                                    <div class="card-body">
                                        <form @submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Nombres</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillVendedor.cnombrevendedor" @keyup.enter="listarVendedores(1)" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Buscar Vendedor </div>
                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="listarVendedores(1)">
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
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar {{ vendedor.cParNombre }}</div>
                                                                    <i @click="asignarVendedor(vendedor.nIdPar, vendedor.cParNombre)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td v-text="vendedor.cParNombre"></td>
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

             <!-- Modal Mostrar Nuevo Vendedores-->
            <div class="modal fade" v-if="accionmodal==4" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTADO</h3>
                                    </div>
                                    <div class="card-body">
                                        <form @submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Nombres</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillVendedor.cnombrevendedor" @keyup.enter="listarVendedores(1)" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Buscar Vendedor </div>
                                                                        <button type="button" title="Buscar Vehículos" class="btn btn-info btn-corner btn-sm" @click="listarVendedores(1)">
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
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar {{ vendedor.cParNombre }}</div>
                                                                    <i @click="reasignarVendedor(vendedor.nIdPar, vendedor.cParNombre)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td v-text="vendedor.cParNombre"></td>
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

            <!-- Modal Ampliar Fecha Referencia -->
            <div class="modal fade" v-if="accionmodal==5" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">AMPLIAR PLAZO PARA COTIZAR</h3>
                                    </div>
                                    <div class="card-body">
                                        <form @submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-3 form-control-label">Cliente</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" v-model="formReasignarContacto.ccontacto" class="form-control form-control-sm" disabled >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-3 form-control-label">Vehículo</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" v-model="formAmpliarAsignacion.cvehiculo" class="form-control form-control-sm" disabled >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-3 form-control-label">Fecha Vencimiento</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" v-model="formAmpliarAsignacion.dfechavence" class="form-control form-control-sm" disabled >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-3 form-control-label">Nro de días</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" v-model="formAmpliarAsignacion.nrodias" @keyup="changeNuevaFechaVence()" class="form-control form-control-sm" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-3 form-control-label">Nueva Fecha Vencimiento</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" v-model="formAmpliarAsignacion.dnuevafechavence" class="form-control form-control-sm" disabled >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-9 offset-sm-5">
                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarAmpliacion()">
                                                        <i class="fa fa-save"></i> Registrar
                                                    </button>
                                                    <button type="button" class="btn btn-secundary btn-corner btn-sm" @click="cerrarModal()">
                                                        <i class="fa fa-close"></i> Cerrar
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

            <!-- Modal Ubigeo-->
            <div class="modal fade" v-if="accionmodal==6" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">UBIGEO</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <el-select v-model="formNuevoContacto.nopcion" filterable clearable placeholder="SELECCIONE">
                                                                <el-option
                                                                v-for="item in arrayTipoUbigeo"
                                                                :key="item.value"
                                                                :label="item.text"
                                                                :value="item.value">
                                                                </el-option>
                                                            </el-select>
                                                        </div>
                                                        <div class="col-md-8" v-if="formNuevoContacto.nopcion != 0">
                                                            <input type="text" v-model="formNuevoContacto.cfiltro" class="form-control form-control-sm" @keyup.enter="llenarUbigeo()">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-9 offset-sm-5">
                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="llenarUbigeo()"><i class="fa fa-search"></i> Buscar</button>
                                                </div>
                                            </div>
                                        </form>
                                        <template v-if="arrayUbigeo.length">
                                            <div class="table-responsive barraLateral">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Acción</th>
                                                            <th>Código</th>
                                                            <th>Departamento</th>
                                                            <th>Provincia</th>
                                                            <th>Distrito</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="u in arrayUbigeo" :key="u.cCode">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" >
                                                                    <div slot="content">Asignar {{ u.cU_SYP_DIST }}</div>
                                                                    <i @click="asignarUbigeo(u)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>&nbsp;&nbsp;
                                                            </td>
                                                            <td v-text="u.cCode"></td>
                                                            <td v-text="u.cU_SYP_DEPA"></td>
                                                            <td v-text="u.cU_SYP_PROV"></td>
                                                            <td v-text="u.cU_SYP_DIST"></td>
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
                // =========== VARIABLES MIS CONTACTOS ============
                fillMisContactos:{
                    ntipopersona: 1,
                    cnrodocumento: '',
                    cfiltrodescripcion: ''
                },
                arrayTipoPersona: [
                    { value: '1', text: 'NATURAL'},
                    { value: '2', text: 'JURIDICA'}
                ],
                arrayContacto: [],
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
                    ntipocontacto: ''
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
                // ============== VARIABLES AMPLIAR ASIGNACION =================
                formAmpliarAsignacion: {
                    nidasignacioncontactovendedor: 0,
                    nidreferenciavehiculoontacto: 0,
                    dfechavence: '',
                    cvehiculo: '',
                    nrodias: 0,
                    dnuevafechavence: '',
                    dfechafindate: ''
                },
                // =============================================================
                // ================ VARIABLES TAB NUEVO CONTACTO ===============
                formNuevoContacto:{
                    //Variables Seguimiento
                    nidcontacto: 0,
                    //Variables Datos Personales
                    ntipopersona: 1,
                    ntpodocumento: '',
                    cnrodocumento: '',
                    capepaterno: '',
                    capematerno: '',
                    cnombre: '',
                    dfecnacimiento: '',
                    lblcnombres: '* Nombres',
                    //Variables de Datos de contacto
                    /*niddepartamento: 0,
                    nidprovincia: 0,
                    niddistrito: 0,*/
                    ccode: '',
                    cdepartamento: '',
                    cprovincia: '',
                    cdistrito: '',
                    cdireccion: '',
                    cmailprincipal: '',
                    cmailalternativo: '',
                    ctelefonofijo: '',
                    ncelular: '',
                    ncelularalternativo: '',
                    nestadocivil: '',
                    nprofesion: '',
                    ccentrolaboral: '',
                    //Variables Referencia Vehiculo
                    nidproveedor: 0,
                    cproveedornombre: '',
                    nidlinea: '',
                    nidmarca: '',
                    nidmodelo: '',
                    naniofabricacion: '',
                    naniomodelo: '',
                    dfechareferenciacompra: '',
                    //Variables Otros Intereses
                    nidproveedor2: 0,
                    cproveedornombre2: '',
                    nidlinea2: '',
                    nidmarca2: '',
                    nidmodelo2: '',
                    naniofabricacion2: '',
                    naniomodelo2: '',
                    dfechareferenciacompra2: '',
                    cubigeo: '',
                    nopcion: 0,
                    cfiltro: ''
                },
                formNuevoContactoJurifico:{
                    ntpodocumento: '',
                    cnrodocumento: '',
                    capepaterno: '',
                    capematerno: '',
                    cnombre: '',
                    cmailprincipal: '',
                    ncelular : ''
                },
                cFlagReferenciaInteres: '',
                arrayTipoDocumentoNaturales: [],
                arrayReferenciaVehiculo: [],
                arrayOtrosIntereses: [],
                arrayTipoDocumento: [],
                arrayEstadoCivil: [],
                arrayProfesion: [],
                 /*arrayDptos:[],
                arrayProv : [],
                arrayDist: [],*/
                arrayUbigeo: [],
                vistaDatosPersonaNatural: 1,
                SAPNuevoContactoJson: '',
                arrayTipoUbigeo: [
                    { value: 0, text: 'TODO'},
                    { value: 1, text: 'DEPARTAMENTO'},
                    { value: 2, text: 'PROVINCIA'},
                    { value: 3, text: 'DISTRITO'}
                ],
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
                arraySegReferenciavehiculo: [],
                arrayLinea: [],
                arrayMarca: [],
                arrayModelo: [],
                arrayLinea2: [],
                arrayMarca2: [],
                arrayModelo2: [],
                arrayAnioFabricacion: [],
                arrayAnioModelo: [],
                // =============================================================
                // ============== VARIABLES TAB NUEVO SEGUIMIENTO ==============
                formNuevoSeguimiento:{
                    nidzona: '',
                    nidestadoseguimiento: 0,
                    nidtiposeguimiento: '',
                    nidformapago: '',
                    dfechaseguimiento: '',
                    choraseguimiento: '',
                    casunto: '',
                    crendirseguimiento: '',
                    nidasignacioncontactovendedor: 0,
                    cestadoseguimiento: ''
                },
                arraySeguimiento: [],
                arrayZona: [],
                arrayEstadoSeguimiento: [],
                arrayTipoSeguimiento: [],
                arrayFormaPago: [],
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
                textFile: '',
                loading: false
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
                        'nidempresa' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal' : parseInt(sessionStorage.getItem("nIdSucursal")),
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
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
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
                        'nidempresa' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal' : parseInt(sessionStorage.getItem("nIdSucursal")),
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
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            cambiarTipoPersonaContactosPorVendedor(){
                this.arrayContactosPorVendedor = []
            },
            mostrarVistaContactoPorVendedor(nIdContacto, cNombre, cVendedor, nVistaValor){
                if(nVistaValor == 0){
                    this.vistaContactoPorVendedor = 0;
                    this.formReasignarContacto.nidcontacto = parseInt(nIdContacto);
                    this.formReasignarContacto.ccontacto = cNombre;
                    this.formReasignarContacto.cvendedornombre = cVendedor;
                    this.listarReferenciaVehiculoPorReasignar(1);
                }
                else{
                    this.vistaContactoPorVendedor = 1;
                    this.listarContactosPorVendedor(1);
                }
            },
            listarReferenciaVehiculoPorReasignar(page){
                var url = this.ruta + '/gescontacto/GetRefVehiculoByContacto';

                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidcontacto' : this.formReasignarContacto.nidcontacto,
                        'nidvendedor' : this.formVendedor.nidvendedor,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayReasignarReferencia = response.data.arraySegReferenciavehiculo.data;
                    this.pagination.current_page =  response.data.arraySegReferenciavehiculo.current_page;
                    this.pagination.total = response.data.arraySegReferenciavehiculo.total;
                    this.pagination.per_page    = response.data.arraySegReferenciavehiculo.per_page;
                    this.pagination.last_page   = response.data.arraySegReferenciavehiculo.last_page;
                    this.pagination.from        = response.data.arraySegReferenciavehiculo.from;
                    this.pagination.to           = response.data.arraySegReferenciavehiculo.to;
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
            cambiarPaginaReferenciaPorReasignar(page){
                this.pagination.current_page=page;
                this.listarReferenciaVehiculoPorReasignar(page);
            },
            reasignarReferenciaVehiculo(referencia){
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
                                nIdAsignacionContactoVendedor: parseInt(referencia.nIdAsignacionContactoVendedor),
                                nIdReferenciaVehiculoContacto: parseInt(referencia.nIdReferenciaVehiculoContacto),
                                nIdEmpresa: parseInt(sessionStorage.getItem("nIdEmpresa")),
                                nIdSucursal: parseInt(sessionStorage.getItem("nIdSucursal")),
                                nIdCronograma: 220016,
                                nIdVendedor: parseInt(this.formReasignarContacto.nreasignaidvendedor)
                            }).then(response => {
                                if(response.data[0].nFlagMsje == 1)
                                {
                                    swal('Reasignación Registrada');
                                }
                                else{
                                    swal('Referencia de Vehiculo ya se encuentra Activa');
                                }
                                this.listarReferenciaVehiculoPorReasignar(1);
                            })
                            .catch(function (error) {
                                console.log(error);
                                if (error.response) {
                                    if (error.response.status == 401) {
                                        swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                        location.reload('0');
                                    }
                                }
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
            //=============  AMPLIACION FECHA ===============
            changeNuevaFechaVence(){
                var fecha = moment(this.formAmpliarAsignacion.dfechafindate).add(parseInt(this.formAmpliarAsignacion.nrodias), 'days').format('DD/MM/YYYY');
                this.formAmpliarAsignacion.dnuevafechavence = fecha;
            },
            registrarAmpliacion(){
                var url = this.ruta + '/gescontacto/SetAmpliacionFechaVenceAsignacion';
                axios.post(url, {
                    'nIdAsignacionContactoVendedor': parseInt(this.formAmpliarAsignacion.nidasignacioncontactovendedor),
                    'nIdReferenciaVehiculoContacto': parseInt(this.formAmpliarAsignacion.nidreferenciavehiculoontacto),
                    'nIdEmpresa'            : parseInt(sessionStorage.getItem("nIdEmpresa")),
                    'nIdSucursal'           : parseInt(sessionStorage.getItem("nIdSucursal")),
                    'nNroDias'              : parseInt(this.formAmpliarAsignacion.nrodias)
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Ampliación registrada');
                    }
                    else{
                        swal('Referencia de Vehiculo ya se encuentra registrada');
                    }
                    this.listarReferenciaVehiculoPorReasignar(1);
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
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            llenarComboTipoContacto(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110056
                    }
                }).then(response => {
                    this.arrayTipoContacto = response.data;
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
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
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
                                'nIdReferenciaVehiculoContacto': parseInt(nIdReferenciaVehiculoContacto),
                                'nIdEmpresa'    : parseInt(sessionStorage.getItem("nIdEmpresa")),
                                'nIdSucursal'   : parseInt(sessionStorage.getItem("nIdSucursal")),
                                'nIdCronograma' : 220016,
                                'nIdVendedor'   : parseInt(this.formVendedor.nidvendedor)
                            }).then(response => {
                                swal(
                                'Activado!',
                                'El registro fue asignado.'
                                );
                                this.listarReferenciasVehiculoLibre(1);
                            })
                            .catch(function (error) {
                                console.log(error);
                                if (error.response) {
                                    if (error.response.status == 401) {
                                        swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                        location.reload('0');
                                    }
                                }
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
                        if (error.response) {
                            if (error.response.status == 401) {
                                swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                location.reload('0');
                            }
                        }
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
                        if (error.response) {
                            if (error.response.status == 401) {
                                swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                location.reload('0');
                            }
                        }
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

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            listarReferenciaVehiculoByContacto(page){
                this.mostrarProgressBar();
                var url = this.ruta + '/gescontacto/GetRefVehiculoByContacto';

                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
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
                    $("#myBar").hide();
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
                    'nIdEmpresa'    : parseInt(sessionStorage.getItem("nIdEmpresa")),
                    'nIdSucursal'   : parseInt(sessionStorage.getItem("nIdSucursal")),
                    'nIdCronograma' : 220016,
                    'nIdContacto'   : this.formNuevoContacto.nidcontacto,
                    'nIdProveedor'  : this.formNuevoContacto.nidproveedor,
                    'nIdLinea'      : this.formNuevoContacto.nidlinea,
                    'nIdMarca'      : this.formNuevoContacto.nidmarca,
                    'nIdModelo'     : this.formNuevoContacto.nidmodelo,
                    'nAnioFabricacion': nAnioFabricacionRef,
                    'nAnioModelo'   : nAnioModeloRef
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
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            validarRegistraSegReferenciaVehiculo(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formNuevoContacto.nidproveedor == 0){
                    this.mensajeError.push('Debes Seleccionar Proveedor');
                };
                if(this.formNuevoContacto.nidlinea == ''){
                    this.mensajeError.push('Debes Seleccionar Linea');
                };
                if(this.formNuevoContacto.nidmarca == ''){
                    this.mensajeError.push('Debes Seleccionar Marca');
                };
                if(this.formNuevoContacto.nidmodelo == ''){
                    this.mensajeError.push('Debes Seleccionar Modelo');
                };
                /*if(this.formNuevoContacto.naniofabricacion == ''){
                    this.mensajeError.push('Debes Seleccionar Año Fabricación');
                };*/
                if(this.formNuevoContacto.naniomodelo == ''){
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
                this.obtenerEstadoAsignacionSeguimiento(nIdAsignacionContactoVendedor);
                this.llenarComboZona();
                this.llenarComboTipoSeguimiento();
                this.llenarComboFormaPago();
                this.listarSeguimientoPorIdAsignacion(1);
            },
            obtenerEstadoAsignacionSeguimiento(nIdAsignacionContactoVendedor){
                var url = this.ruta + '/gescontacto/GetEstadoAsignacionSeguimiento';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidasignacioncontactovendedor' : nIdAsignacionContactoVendedor
                    }
                }).then(response => {
                    this.formNuevoSeguimiento.cestadoseguimiento = response.data.arrayEstadoSeguimiento[0].cEstadoSeguimiento;
                    this.formNuevoSeguimiento.nidestadoseguimiento = response.data.arrayEstadoSeguimiento[0].nIdEstadoSeguimiento;
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
            llenarComboZona(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110052
                    }
                }).then(response => {
                    this.arrayZona = response.data;
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
            llenarComboTipoSeguimiento(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110054
                    }
                }).then(response => {
                    this.arrayTipoSeguimiento = response.data;
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
            llenarComboFormaPago(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110055
                    }
                }).then(response => {
                    this.arrayFormaPago = response.data;
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
            listarSeguimientoPorIdAsignacion(page){
                this.mostrarProgressBar();
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
                    $("#myBar").hide();
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
            registrarSeguimiento(){
                if(this.validarRegistroMovimiento()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.mostrarProgressBar();
                var url = this.ruta + '/gescontacto/SetSeguimiento';

                axios.post(url, {
                    'cFlagOrigenSeguimiento'        : 'EC',
                    'nIdAsignacionContactoVendedor' : this.formNuevoSeguimiento.nidasignacioncontactovendedor,
                    'nIdZona'                       : this.formNuevoSeguimiento.nidzona,
                    'nIdTipoSeguimiento'            : this.formNuevoSeguimiento.nidtiposeguimiento,
                    'nIdFormaPago'                  : this.formNuevoSeguimiento.nidformapago,
                    'nIdEstadoSeguimiento'          : this.formNuevoSeguimiento.nidestadoseguimiento,
                    'dFechaSeguimientoVendedor'     : this.formNuevoSeguimiento.dfechaseguimiento,
                    'cHoraSeguimiento'              : this.formNuevoSeguimiento.choraseguimiento,
                    'cAsunto'                       : this.formNuevoSeguimiento.casunto,
                    'cRendirSeguimiento'            : this.formNuevoSeguimiento.crendirseguimiento
                }).then(response => {
                    $("#myBar").hide();
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Seguimiento registrado');
                        this.limpiarSeguimiento();
                        this.listarSeguimientoPorIdAsignacion(1);
                    }
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
            desactivarSeguimiento(nIdSeguimientoContacto){
                swal({
                    title: 'Estas seguro de desactivar este vehículo?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Desactivar!',
                    cancelButtonText: 'No, cancelar!'
                    }).then((result) => {
                        if (result.value) {
                            var url = this.ruta + '/gescontacto/desactivarSeguimiento';
                            axios.put(url, {
                                nIdSeguimientoContacto: parseInt(nIdSeguimientoContacto)
                            }).then(response => {
                                swal(
                                'Desactivado!',
                                'El registro fue desactivado.'
                                );
                                this.listarSeguimientoPorIdAsignacion(1);
                            })
                            .catch(function (error) {
                                console.log(error);
                                if (error.response) {
                                    if (error.response.status == 401) {
                                        swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                        location.reload('0');
                                    }
                                }
                            });
                        } else if (result.dismiss === swal.DismissReason.cancel)
                        {
                        }
                    })
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
                    var url = this.ruta + '/parametro/GetDocumentoNatural';
                    axios.get(url, {
                        params: {
                            'ngrupoparid': 110047
                        }
                    }).then(response => {
                        this.arrayTipoDocumento = response.data;
                        this.formNuevoContacto.ntpodocumento = '';
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
                else{
                    var url = this.ruta + '/parametro/GetDocumentoJuridica';
                    axios.get(url, {
                        params: {
                            'ngrupoparid': 110047
                        }
                    }).then(response => {
                        this.arrayTipoDocumento = response.data;
                        this.formNuevoContacto.ntpodocumento = '';
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
            llenarUbigeo(page){
                //var url = this.ruta + '/ubigeo/SapGetUbigeo';
                var url = this.ruta + '/ubigeo/GetUbigeo';
                axios.get(url, {
                    params: {
                        'nopcion': this.formNuevoContacto.nopcion,
                        'cfiltro': this.formNuevoContacto.cfiltro.toUpperCase().toString(),
                        'page': page
                    }
                }).then(response => {
                    this.arrayUbigeo = response.data.arrayUbigeo.data;
                    this.paginationModal.current_page =  response.data.arrayUbigeo.current_page;
                    this.paginationModal.total = response.data.arrayUbigeo.total;
                    this.paginationModal.per_page    = response.data.arrayUbigeo.per_page;
                    this.paginationModal.last_page   = response.data.arrayUbigeo.last_page;
                    this.paginationModal.from        = response.data.arrayUbigeo.from;
                    this.paginationModal.to           = response.data.arrayUbigeo.to;
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
            cambiarPaginaUbigeo(page){
                this.paginationModal.current_page=page;
                this.llenarUbigeo(page);
            },
            asignarUbigeo(u){
                this.formNuevoContacto.cubigeo = u.cU_SYP_DEPA + ' - ' + u.cU_SYP_PROV + ' - ' + u.cU_SYP_DIST;
                this.formNuevoContacto.ccode = u.cCode;
                this.formNuevoContacto.cdepartamento = u.cU_SYP_DEPA;
                this.formNuevoContacto.cprovincia = u.cU_SYP_PROV;
                this.formNuevoContacto.cdistrito = u.cU_SYP_DIST;
                this.cerrarModal();
            },
            llenarComboEstadoCivil(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid': 110048
                    }
                }).then(response => {
                    this.arrayEstadoCivil = response.data;
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
            llenarComboProfesion(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid': 110049
                    }
                }).then(response => {
                    this.arrayProfesion = response.data;
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

                if(this.formNuevoContacto.ccode == 0 || !this.formNuevoContacto.ccode){
                    this.mensajeError.push('Debe Seleccionar Ubigeo');
                }
                if(!this.formNuevoContacto.cdireccion){
                    this.mensajeError.push('Debes Ingresar Dirección');
                };
                if(this.formNuevoContacto.cmailprincipal){
                    if (!this.validarEmail(this.formNuevoContacto.cmailprincipal)){
                        this.mensajeError.push('Debe Ingresar Email válido');
                    }
                };
                if(!this.formNuevoContacto.ncelular){
                    this.mensajeError.push('Debe Ingresar Celular');
                } else {
                    if(this.formNuevoContacto.ncelular.length > 9){
                        this.mensajeError.push('El numero de Celular es incorrecto');
                    }
                }

                if(this.formNuevoContacto.ntipopersona == 1) {
                    if(this.formNuevoContacto.nestadocivil == ''){
                        this.mensajeError.push('Debe Seleccionar el Estado Civil');
                    }
                }

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
                    if(this.formNuevoContactoJurifico.cmailprincipal){
                        if (!this.validarEmail(this.formNuevoContactoJurifico.cmailprincipal)){
                            this.mensajeError.push('Debe escribir el correo del contacto');
                        }
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
            validarEmail(email) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            },
            llenarComboTpoDocumentoDatoConctactoJurifico(){
                var url = this.ruta + '/parametro/GetDocumentoNatural';
                axios.get(url, {
                        params: {
                            'ngrupoparid': 110047
                        }
                    }).then(response => {
                    this.arrayTipoDocumentoNaturales = response.data;
                    this.formNuevoContactoJurifico.ntpodocumento = '';
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
                //this.llenarComboLinea();
                this.limpiarAsignacion();
            },
            llenarComboLinea(){
                var url;

                (this.cFlagReferenciaInteres == 1) ? (url = this.ruta + '/versionvehiculo/GetLineasByProveedor') : (url = this.ruta + '/versionvehiculo/GetLineasByProveedor')

                axios.get(url, {
                    params: {
                        'nidempresa': 130011,
                        'nidproveedor': (this.cFlagReferenciaInteres == 1) ? this.formNuevoContacto.nidproveedor : this.formNuevoContacto.nidproveedor2,
                        'opcion': 1
                    }
                }).then(response => {
                    (this.cFlagReferenciaInteres == 1) ? (this.arrayLinea = response.data.arrayLinea) : (this.arrayLinea2 = response.data.arrayLinea);
                    (this.cFlagReferenciaInteres == 1) ? this.formNuevoContacto.nidlinea = '' : this.formNuevoContacto.nidlinea2 = '';

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

                //(this.cFlagReferenciaInteres == 1) ? (url = this.ruta + '/gescontacto/GetMarcaByLinea') : (url = this.ruta + '/versionvehiculo/GetMarcaByLinea')
                (this.cFlagReferenciaInteres == 1) ? (url = this.ruta + '/versionvehiculo/GetMarcaByLinea') : (url = this.ruta + '/versionvehiculo/GetMarcaByLinea')

                axios.get(url, {
                    params: {
                        'nidlinea': (this.cFlagReferenciaInteres == 1) ? this.formNuevoContacto.nidlinea : this.formNuevoContacto.nidlinea2,
                        'opcion': 1
                    }
                }).then(response => {
                    (this.cFlagReferenciaInteres == 1) ? (this.arrayMarca = response.data.arrayMarca) : (this.arrayMarca2 = response.data.arrayMarca);
                    (this.cFlagReferenciaInteres == 1) ? this.formNuevoContacto.nidmarca = '' : this.formNuevoContacto.nidmarca2 = '';

                    this.arrayModelo = [];
                    this.arrayModelo2 = [];
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

                //(this.cFlagReferenciaInteres == 1) ? (url = this.ruta + '/gescontacto/GetModeloByMarca') : (url = this.ruta + '/versionvehiculo/GetModeloByMarca')
                (this.cFlagReferenciaInteres == 1) ? (url = this.ruta + '/versionvehiculo/GetModeloByMarca') : (url = this.ruta + '/versionvehiculo/GetModeloByMarca')

                axios.get(url, {
                    params: {
                        'nidlinea': (this.cFlagReferenciaInteres == 1) ? this.formNuevoContacto.nidlinea : this.formNuevoContacto.nidlinea2,
                        'nidmarca': (this.cFlagReferenciaInteres == 1) ? this.formNuevoContacto.nidmarca : this.formNuevoContacto.nidmarca2,
                        'opcion': 1
                    }
                }).then(response => {
                    (this.cFlagReferenciaInteres == 1) ? (this.arrayModelo = response.data.arrayModelo) : (this.arrayModelo2 = response.data.arrayModelo);
                    (this.cFlagReferenciaInteres == 1) ? this.formNuevoContacto.nidmodelo = '' : this.formNuevoContacto.nidmodelo2 = '';
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
            llenarComboAnioFabricacion(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid': 110034
                    }
                }).then(response => {
                    this.arrayAnioFabricacion = response.data;
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
            llenarComboAnioModelo(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid': 110035
                    }
                }).then(response => {
                    this.arrayAnioModelo = response.data;
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
            asignarReferenciaVehiculo(){
                if(this.validaAsignarReferenciaVehiculo()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var nidlinea            =   this.formNuevoContacto.nidlinea;
                var nidmarca            =   this.formNuevoContacto.nidmarca;
                var nidmodelo           =   this.formNuevoContacto.nidmodelo;
                var nidaniofabricacion  =   this.formNuevoContacto.naniofabricacion;
                var nidaniomodelo       =   this.formNuevoContacto.naniomodelo;
                var cLineaNombreRef     =   "";
                var cMarcaNombreRef     =   "";
                var cModeloNombreRef    =   "";
                var nAnioFabricacionRef =   "";
                var nAnioModeloRef      =   "";

                $.each(this.arrayLinea, function (index, value) {
                    if(value.nIdLinea == nidlinea){
                        cLineaNombreRef = value.cLineaNombre;
                    }
                });
                $.each(this.arrayMarca, function (index, value) {
                    if(value.nIdMarca == nidmarca){
                        cMarcaNombreRef = value.cMarcaNombre;
                    }
                });
                $.each(this.arrayModelo, function (index, value) {
                    if(value.nIdModelo == nidmodelo){
                        cModeloNombreRef = value.cModeloNombre;
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

                var nIdProveedorRef     =   this.formNuevoContacto.nidproveedor;
                var nIdLineaRef         =   this.formNuevoContacto.nidlinea;
                var nIdMarcaRef         =   this.formNuevoContacto.nidmarca;
                var nIdModeloRef        =   this.formNuevoContacto.nidmodelo;
                var cProveedorNombreRef =   this.formNuevoContacto.cproveedornombre;

                if(this.encuentraReferenciaVehiculo(nIdProveedorRef, nIdLineaRef, nIdMarcaRef, nIdModeloRef, nAnioFabricacionRef, nAnioModeloRef)){
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'Esa Referencia Vehículo ya se encuentra agregada!',
                    })
                } else {
                    this.arrayReferenciaVehiculo.push({
                        nIdProveedor        :   nIdProveedorRef,
                        nIdLinea            :   nIdLineaRef,
                        nIdMarca            :   nIdMarcaRef,
                        nIdModelo           :   nIdModeloRef,
                        cProveedorNombre    :   cProveedorNombreRef,
                        cLineaNombre        :   cLineaNombreRef,
                        cMarcaNombre        :   cMarcaNombreRef,
                        cModeloNombre       :   cModeloNombreRef,
                        nAnioFabricacion    :   nAnioFabricacionRef,
                        nAnioModelo         :   nAnioModeloRef
                    });
                    toastr.success('Se Agregó Referencia Vehiculo');
                }
                this.limpiarAsignacion();
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
                if(this.formNuevoContacto.nidlinea == ''){
                    this.mensajeError.push('Debes Seleccionar Linea');
                };
                if(this.formNuevoContacto.nidmarca == ''){
                    this.mensajeError.push('Debes Seleccionar Marca');
                };
                if(this.formNuevoContacto.nidmodelo == ''){
                    this.mensajeError.push('Debes Seleccionar Modelo');
                };
                /*if(this.formNuevoContacto.naniofabricacion == ''){
                    this.mensajeError.push('Debes Seleccionar Año Fabricación');
                };*/
                if(this.formNuevoContacto.naniomodelo == ''){
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
            // =============  TAB OTROS INTERESES ======================
            validarTab44(){
                this.error = 0;
                this.mensajeError =[];

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            activarTab44(){
                if(this.validarTab44()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#Tab33').removeClass('nav-link active');
                $('#Tab33').addClass('nav-link');
                $('#Tab44').removeClass('nav-link disabled');
                $('#Tab44').addClass('nav-link active');
                $('#TabReferenciaVehiculo').removeClass('in active show');
                $('#TabOtrosIntereses').addClass('in active show');
                //this.llenarComboLinea();
                this.limpiarAsignacion();
            },
            regresarOtrosIntereses(){
                /*$('#Tab11').removeClass('nav-link active');
                $('#Tab11').addClass('nav-link disabled');
                $('#Tab22').removeClass('nav-link active');
                $('#Tab22').addClass("nav-link disabled");
                $('#Tab33').removeClass('nav-link disabled');
                $('#Tab33').addClass('nav-link active');
                $('#Tab44').removeClass('nav-link active');
                $('#Tab44').addClass('nav-link disabled');
                $('#TabDatosPersonales').removeClass('in active show');
                $('#TabDatosContacto').removeClass('in active show');
                $('#TabReferenciaVehiculo').addClass('in active show');
                $('#TabOtrosIntereses').removeClass('in active show');*/
            },
            limpiarAsignacion(){
                //Variables Asignación Referencia Vehiculo
                this.formNuevoContacto.nidproveedor = 0;
                this.formNuevoContacto.cproveedornombre = '';
                this.formNuevoContacto.nidlinea = '';
                this.formNuevoContacto.nidmarca = '';
                this.formNuevoContacto.nidmodelo = '';
                this.formNuevoContacto.naniofabricacion = '';
                this.formNuevoContacto.naniomodelo = '';
                this.formNuevoContacto.dfechareferenciacompra = moment().format('YYYY-MM-DD');
                //Variables Asignación Otros Intereses
                this.formNuevoContacto.nidproveedor2 = 0;
                this.formNuevoContacto.cproveedornombre2 = '';
                this.formNuevoContacto.nidlinea2 = '';
                this.formNuevoContacto.nidmarca2 = '';
                this.formNuevoContacto.nidmodelo2 = '';
                this.formNuevoContacto.naniofabricacion2 = '';
                this.formNuevoContacto.naniomodelo2 = '';
                this.formNuevoContacto.dfechareferenciacompra2 = moment().format('YYYY-MM-DD');

                this.arrayLinea = [];
                this.arrayMarca = [];
                this.arrayModelo = [];
                this.arrayLinea2 = [];
                this.arrayMarca2 = [];
                this.arrayModelo2 = [];
            },
            asignarOtrosIntereses(){
                if(this.validaAsignarOtrasReferencias()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var nidlinea            =   this.formNuevoContacto.nidlinea2;
                var nidmarca            =   this.formNuevoContacto.nidmarca2;
                var nidmodelo           =   this.formNuevoContacto.nidmodelo2;
                var nidaniofabricacion  =   this.formNuevoContacto.naniofabricacion2;
                var nidaniomodelo       =   this.formNuevoContacto.naniomodelo2;
                var cLineaNombreRef     =   "";
                var cMarcaNombreRef     =   "";
                var cModeloNombreRef    =   "";
                var nAnioFabricacionRef =   "";
                var nAnioModeloRef      =   "";

                $.each(this.arrayLinea2, function (index, value) {
                    if(value.nIdLinea == nidlinea){
                        cLineaNombreRef = value.cLineaNombre;
                    }
                });
                $.each(this.arrayMarca2, function (index, value) {
                    if(value.nIdMarca == nidmarca){
                        cMarcaNombreRef = value.cMarcaNombre;
                    }
                });
                $.each(this.arrayModelo2, function (index, value) {
                    if(value.nIdModelo == nidmodelo){
                        cModeloNombreRef = value.cModeloNombre;
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

                var nIdProveedorRef     =   this.formNuevoContacto.nidproveedor2;
                var nIdLineaRef         =   this.formNuevoContacto.nidlinea2;
                var nIdMarcaRef         =   this.formNuevoContacto.nidmarca2;
                var nIdModeloRef        =   this.formNuevoContacto.nidmodelo2;
                var cProveedorNombreRef =   this.formNuevoContacto.cproveedornombre2;

                if(this.encuentraOtrosIntereses(nIdProveedorRef, nIdLineaRef, nIdMarcaRef, nIdModeloRef, nAnioFabricacionRef, nAnioModeloRef)){
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'Esa Referencia Vehículo de Otro Interés ya se encuentra agregada!',
                    })
                } else {
                    this.arrayOtrosIntereses.push({
                        'nIdProveedor'      : nIdProveedorRef,
                        'nIdLinea'          : nIdLineaRef,
                        'nIdMarca'          : nIdMarcaRef,
                        'nIdModelo'         : nIdModeloRef,
                        'cProveedorNombre'  : cProveedorNombreRef,
                        'cLineaNombre'      : cLineaNombreRef,
                        'cMarcaNombre'      : cMarcaNombreRef,
                        'cModeloNombre'     : cModeloNombreRef,
                        'nAnioFabricacion'  : nAnioFabricacionRef,
                        'nAnioModelo'       : nAnioModeloRef
                    });
                    toastr.success('Se Agregó Referencia Vehiculo de Otros Intereses');
                }
                this.limpiarAsignacion();
            },
            encuentraOtrosIntereses(nIdProveedorRef, nIdLineaRef, nIdMarcaRef, nIdModeloRef, nAnioFabricacionRef, nAnioModeloRef){
                var sw=0;
                for(var i=0;i<this.arrayOtrosIntereses.length;i++){
                    if(this.arrayOtrosIntereses[i].nIdProveedor==nIdProveedorRef &&
                        this.arrayOtrosIntereses[i].nIdLinea==nIdLineaRef &&
                        this.arrayOtrosIntereses[i].nIdMarca==nIdMarcaRef &&
                        this.arrayOtrosIntereses[i].nIdModelo==nIdModeloRef &&
                        this.arrayOtrosIntereses[i].nAnioFabricacion==nAnioFabricacionRef &&
                        this.arrayOtrosIntereses[i].nAnioModelo==nAnioModeloRef    ){
                        sw=true;
                    }
                }
                return sw;
            },
            validaAsignarOtrasReferencias(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formNuevoContacto.nidproveedor2 == 0){
                    this.mensajeError.push('Debe Seleccionar Proveedor');
                }
                if(this.formNuevoContacto.nidlinea2 == ''){
                    this.mensajeError.push('Debe Seleccionar Linea');
                }
                if(this.formNuevoContacto.nidmarca2 == ''){
                    this.mensajeError.push('Debe Seleccionar Marca');
                }
                if(this.formNuevoContacto.nidmodelo2 == ''){
                    this.mensajeError.push('Debe Seleccionar Modelo');
                }
                // if(this.formNuevoContacto.naniofabricacion2 == ''){
                //     this.mensajeError.push('Debe Seleccionar Año Fabricación');
                // }
                if(this.formNuevoContacto.naniomodelo2 == ''){
                    this.mensajeError.push('Debe Seleccionar Año Modelo');
                }
                if(this.formNuevoContacto.dfechareferenciacompra2 == ''){
                    this.mensajeError.push('Debe Seleccionar una Fecha de Referencia');
                }
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            eliminarItemOtrosIntereses(index){
                this.$delete(this.arrayOtrosIntereses, index);
            },
            // =============  REGISTRAR CONTACTO ======================
            SapRegistrarNuevoContacto(contacto){
                let me = this;
                me.loadingProgressBar("INTEGRANDO CONTACTO CON SAP BUSINESS ONE...");

                // console.log(contacto);
                this.mostrarProgressBar();
                var url = this.ruta + '/gescontacto/SapSetContacto';
                axios.post(url, {
                    'contacto': contacto
                }).then(response => {
                    // $("#myBar").hide();
                    // console.log(response.data);
                    let data = response.data;
                    this.SAPNuevoContactoJson  =  JSON.parse(data);
                    this.actualizarCardCodeContacto(contacto.nIdContacto, this.SAPNuevoContactoJson, response.data.toString());
                    me.loading.close();
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
            actualizarCardCodeContacto(nIdContacto, dataJSON, logRpta){
                var url = this.ruta + '/gescontacto/UpdCardCodeContacto';
                axios.post(url, {
                    'nIdContacto'   : nIdContacto,
                    'CardCode'      : dataJSON.CardCode.toString(),
                    'CardType'      : dataJSON.CardType.toString(),
                    'LogRespuesta'  : logRpta
                }).then(response => {
                    $("#myBar").hide();
                    console.log(response);
                    if(response.data[0].nFlagMsje==1){
                        swal(response.data[0].cMensaje);
                    } else {
                        swal(response.data[0].cMensaje);
                    }
                    this.arrayContacto = [];
                    this.SAPNuevoContactoJson = '';
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
            registrarNuevoContacto(){
                if(this.validarTab22()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                if(this.validarTab33()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

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
                    'nIdTipoDocumento'  : this.formNuevoContacto.ntpodocumento,
                    'cNumeroDocumento'  : String(this.formNuevoContacto.cnrodocumento),
                    'cNombre'           : this.formNuevoContacto.cnombre.toUpperCase().toString(),
                    'cApellidoPaterno'  : this.formNuevoContacto.capepaterno.toUpperCase().toString(),
                    'cApellidoMaterno'  : this.formNuevoContacto.capematerno.toUpperCase().toString(),
                    'cUbigeo'           : this.formNuevoContacto.ccode,
                    'cDepartamento'     : this.formNuevoContacto.cdepartamento.toUpperCase().toString(),
                    'cProvincia'        : this.formNuevoContacto.cprovincia.toUpperCase().toString(),
                    'cDistrito'         : this.formNuevoContacto.cdistrito.toUpperCase().toString(),
                    'cDireccion'        : this.formNuevoContacto.cdireccion.toUpperCase().toString(),
                    'cEmail'            : this.formNuevoContacto.cmailprincipal.toUpperCase().toString(),
                    'cEmailAlternativo' : this.formNuevoContacto.cmailalternativo.toUpperCase().toString(),
                    'dFechaNacimiento'  : this.formNuevoContacto.dfecnacimiento,
                    'nIdEstadoCivil'    : this.formNuevoContacto.nestadocivil,
                    'cTelefonoFijo'     : this.formNuevoContacto.ctelefonofijo,
                    'nTelefonoMovil'    : this.formNuevoContacto.ncelular,
                    'nTelefonoMovilAlternativo': this.formNuevoContacto.ncelularalternativo,
                    'cCentroLaboral'    : this.formNuevoContacto.ccentrolaboral.toUpperCase().toString(),
                    'nIdProfesion'      : this.formNuevoContacto.nprofesion
                }).then(response => {
                    if(response.data[0].nFlagMsje==1){
                        this.registrarReferenciaVehiculo(response.data[0].nIdContacto);
                    }else{
                        swal('Ya existe Persona');
                    }
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
            registrarPersonaJuridica(){
                var url = this.ruta + '/gescontacto/SetContactoPerJuridica';
                axios.post(url, {
                    //Datos contacto Juridico
                    'cRuc'                      : String(this.formNuevoContacto.cnrodocumento),
                    'cRazonSocial'              : this.formNuevoContacto.cnombre.toUpperCase().toString(),
                    'cUbigeo'                   : this.formNuevoContacto.ccode,
                    'cDepartamento'             : this.formNuevoContacto.cdepartamento.toUpperCase().toString(),
                    'cProvincia'                : this.formNuevoContacto.cprovincia.toUpperCase().toString(),
                    'cDistrito'                 : this.formNuevoContacto.cdistrito.toUpperCase().toString(),
                    'cDireccion'                : this.formNuevoContacto.cdireccion.toUpperCase().toString(),
                    'cEmail'                    : this.formNuevoContacto.cmailprincipal.toUpperCase().toString(),
                    'cEmailAlternativo'         : this.formNuevoContacto.cmailalternativo.toUpperCase().toString(),
                    'cTelefonoFijo'             : this.formNuevoContacto.ctelefonofijo,
                    'nTelefonoMovil'            : this.formNuevoContacto.ncelular,
                    'nTelefonoMovilAlternativo' : this.formNuevoContacto.ncelularalternativo,
                    //Datos Contacto Natural del Juridico
                    'nIdTipoDocumentoContacto'  : this.formNuevoContactoJurifico.ntpodocumento,
                    'cNumeroDocumentoContacto'  : String(this.formNuevoContactoJurifico.cnrodocumento),
                    'cNombreContacto'           : this.formNuevoContactoJurifico.cnombre.toUpperCase().toString(),
                    'cApellidoPaternoContacto'  : this.formNuevoContactoJurifico.capepaterno.toUpperCase().toString(),
                    'cApellidoMaternoContacto'  : this.formNuevoContactoJurifico.capematerno.toUpperCase().toString(),
                    'cEmailPrincipalContacto'   : this.formNuevoContactoJurifico.cmailprincipal.toUpperCase().toString(),
                    'cTelefonoMovilContacto'    : this.formNuevoContactoJurifico.ncelular.toUpperCase().toString()
                }).then(response => {
                    if(response.data[0].nFlagMsje==1){
                        this.registrarReferenciaVehiculo(response.data[0].nIdContacto);
                        console.log(response.data[0]);
                    }else{
                        swal('Ya existe Persona');
                    }
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
            validarRegistroNuevoContacto(){
                this.error = 0;
                this.mensajeError =[];

                if(this.arrayReferenciaVehiculo.length == 0 &&  this.arrayOtrosIntereses.length == 0){
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
                        'nIdEmpresa'    : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nIdSucursal'   : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nIdCronograma' : 220016,
                        'nIdContacto'   : nIdContacto,
                        'referencia'    : this.arrayReferenciaVehiculo,
                        'otrosintreses' : this.arrayOtrosIntereses
                    }).then(response => {
                        //this.SapRegistrarNuevoContacto2(nIdContacto, this.formNuevoContacto);
                        $("#myBar").hide();
                        swal("Contacto Registrado Correctamente");
                        this.limpiarNuevoContacto();
                        this.tabDatosPersonales();
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
            // ========================================================
            // =============  TAB LEADS ======================
            tabLeads(){
                $("#file-upload").val("");
                this.arrayLeads = [];
            },
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
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
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
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
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
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
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
            descargaFormatoLeads(){
                window.open(this.ruta + '/storage/FormatosDescarga/FormatoLeads.xlsx');
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
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
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
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
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
                //SI cFlagReferenciaInteres == 1 TabReferencia
                if(this.cFlagReferenciaInteres == 1){
                    this.formNuevoContacto.nidproveedor = nProveedorId;
                    this.formNuevoContacto.cproveedornombre = cProveedorNombre;
                } else {
                    this.formNuevoContacto.nidproveedor2 = nProveedorId;
                    this.formNuevoContacto.cproveedornombre2 = cProveedorNombre;
                }
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
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
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
                                this.cFlagReferenciaInteres = data;
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
                    case "referencia":
                    {
                        switch(accion){
                            case 'ampliar':
                            {
                                this.accionmodal=5;
                                this.modal = 1;
                                this.formAmpliarAsignacion.nrodias = 0;
                                this.formAmpliarAsignacion.nidasignacioncontactovendedor = data['nIdAsignacionContactoVendedor'];
                                this.formAmpliarAsignacion.nidreferenciavehiculoontacto = data['nIdReferenciaVehiculoContacto'];
                                this.formAmpliarAsignacion.cvehiculo = data['cLineaNombre'] + ' ' + data['cMarcaNombre'] + ' ' + data['cModeloNombre'] + ' ' + data['nAnioFabricacion'] + ' ' + data['nAnioModelo'];
                                this.formAmpliarAsignacion.dfechavence = data['dFechaFinAsignacionContacto'];
                                this.formAmpliarAsignacion.dfechafindate = data['dFechaFinAmpliacion'];
                                this.changeNuevaFechaVence();
                                break;
                            }
                        }
                    }
                    break;
                    case 'ubigeo':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=6;
                                this.modal = 1;
                                break;
                            }
                        }
                    }break;
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
                this.formNuevoSeguimiento.nidzona = '';
                this.formNuevoSeguimiento.nidtiposeguimiento = '';
                this.formNuevoSeguimiento.dfechaseguimiento = '';
                this.formNuevoSeguimiento.choraseguimiento = '';
                this.formNuevoSeguimiento.casunto = '';
                this.formNuevoSeguimiento.crendirseguimiento = '';
            },
            limpiarNuevoContacto(){
                //Tab DATOS PERSONALES
                this.formNuevoContacto.ntpodocumento = '',
                this.formNuevoContacto.cnrodocumento = '',
                this.formNuevoContacto.capepaterno = '',
                this.formNuevoContacto.capematerno = '',
                this.formNuevoContacto.cnombre = '',
                this.formNuevoContacto.dfecnacimiento = '',
                //Tab DATOS DE CONTACTO
                this.formNuevoContacto.ccode = '',
                this.formNuevoContacto.cubigeo = '',
                this.formNuevoContacto.cdepartamento = '',
                this.formNuevoContacto.cprovincia = '',
                this.formNuevoContacto.cdistrito = '',
                this.arrayUbigeo = [],
                this.formNuevoContacto.cdireccion = '',
                this.formNuevoContacto.cmailprincipal = '',
                this.formNuevoContacto.cmailalternativo = '',
                this.formNuevoContacto.ctelefonofijo = '',
                this.formNuevoContacto.ncelular = '',
                this.formNuevoContacto.ncelularalternativo = '',
                this.formNuevoContacto.nestadocivil = '',
                this.formNuevoContacto.nprofesion = '',
                this.formNuevoContacto.ccentrolaboral = '',
                //Tab DATOS DE CONTACTO - Datos Contacto Jurídico
                this.formNuevoContactoJurifico.ntpodocumento = '',
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
                this.formNuevoContacto.nidlinea = '',
                this.formNuevoContacto.nidmarca = '',
                this.formNuevoContacto.nidmodelo = '',
                this.formNuevoContacto.naniofabricacion = '',
                this.formNuevoContacto.naniomodelo = ''
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
</style>
