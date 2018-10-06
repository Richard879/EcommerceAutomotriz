<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
            <div class="container-fluid">
                <h2 class="no-margin-bottom">GESTIÓN DE CONTACTOS VENDEDOR</h2>
            </div>
            </header>

            <section>
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Tab1" href="#TabMisContactos" @click="tabMisContactos();" role="tab" data-toggle="tab">
                                            <i class="fa fa-users"></i> MIS CONTACTOS
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Tab2" href="#TabCarteraMes" @click="tabCarteraMes();" role="tab" data-toggle="tab">
                                            <i class="fa fa-suitcase"></i> CARTERA DEL MES
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="Tab3" href="#TabSeguimiento" role="tab" data-toggle="tab">
                                            <i class="fa fa-angle-double-right"></i> SEGUIMIENTO
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Tab4" href="#TabNuevoContacto" @click="tabNuevoContacto();" role="tab" data-toggle="tab">
                                            <i class="fa fa-user"></i> NUEVO CONTACTO
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
                                                                            <label class="col-sm-4 form-control-label">* Nro Documento</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillMisContactos.cnrodocumento" @keyup.enter="listarContactoSinCarteraMes(1)" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Apellidos</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillMisContactos.cfiltrodescripcion" @keyup.enter="listarContactoSinCarteraMes(1)" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-9 offset-sm-5">
                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarContactoSinCarteraMes(1);"><i class="fa fa-search"></i> Buscar</button>
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
                                                                                            <div slot="content">Asignar a Cartera  {{ c.cPerApellidos + ' ' + c.cNombre }}</div>
                                                                                            <i @click="asignarCarteraMes(c.nIdContacto)" :style="'color:#796AEE'" class="fa-md fa fa-suitcase"></i>
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
                                                                                            <div slot="content">Asignar a Cartera  {{ c.cRazonSocial }}</div>
                                                                                            <i @click="asignarCarteraMes(c.nIdContacto)" :style="'color:#796AEE'" class="fa-md fa fa-suitcase"></i>
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
                                    <div role="tabpanel" class="tab-pane fade" id="TabCarteraMes">
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
                                                                                    <input type="radio" class="radio-template" v-model="fillMisContactos.ntipopersona" :value="tipo.value" v-on:change="cambiarTipoPersonaCarteraMes()">
                                                                                    <label for="" class="form-control-label" v-text="tipo.text"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Nro Documento</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillMisContactos.cnrodocumento" @keyup.enter="listarCarteraMesPorVendedor(1)" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Apellidos</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillMisContactos.cfiltrodescripcion" @keyup.enter="listarCarteraMesPorVendedor(1)" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-9 offset-sm-5">
                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarCarteraMesPorVendedor(1);"><i class="fa fa-search"></i> Buscar</button>
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
                                                            <template v-if="arrayContactoCarteraMes.length">
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
                                                                                <tr v-for="c in arrayContactoCarteraMes" :key="c.nIdReferenciaVehiculoContacto">
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
                                                                                            <div slot="content">Seguimiento  {{ c.cPerApellidos + ' ' + c.cNombre }}</div>
                                                                                            <i @click="activarTab3(c.nIdContacto, c.nIdPersonaNatural, 1)" :style="'color:#796AEE'" class="fa-md fa fa-sign-out"></i>
                                                                                        </el-tooltip>
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Anular de Cartera Mes  {{ c.cPerApellidos + ' ' + c.cNombre }}</div>
                                                                                            <i :style="'color:red'" class="fa-md fa fa-times-circle"></i>
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
                                                                                <tr v-for="c in arrayContactoCarteraMes" :key="c.nIdReferenciaVehiculoContacto">
                                                                                    <td v-text="c.nIdContacto"></td>
                                                                                    <td v-text="c.cRazonSocial"></td>
                                                                                    <td v-text="c.cNumeroDocumento"></td>
                                                                                    <td v-text="c.nTelefonoMovil"></td>
                                                                                    <td v-text="c.cEmail"></td>
                                                                                    <td v-text="c.cContacto"></td>
                                                                                    <td v-text="c.cVendedor"></td>
                                                                                    <td>
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Seguimiento  {{ c.cRazonSocial }}</div>
                                                                                            <i @click="activarTab3(c.nIdContacto, c.nIdPersonaJuridica, 2)" :style="'color:#796AEE'" class="fa-md fa fa-sign-out"></i>
                                                                                        </el-tooltip>
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Anular de Cartera Mes  {{ c.cRazonSocial }}</div>
                                                                                            <i :style="'color:red'" class="fa-md fa fa-times-circle"></i>
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
                                                                                        <a @click.prevent="cambiarPaginaCarteraMes(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                    </li>
                                                                                    <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                    :class="[page==isActived?'active':'']">
                                                                                        <a class="page-link"
                                                                                        href="#" @click.prevent="cambiarPaginaCarteraMes(page)"
                                                                                        v-text="page"></a>
                                                                                    </li>
                                                                                    <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                        <a @click.prevent="cambiarPaginaCarteraMes(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                                                                            <el-select v-model="formNuevoContacto.nidlinea" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboMarca()">
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
                                                                                            <el-select v-model="formNuevoContacto.nidmarca" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboModelo()">
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
                                                                                            <el-select v-model="formNuevoContacto.nidmodelo" filterable clearable placeholder="SELECCIONE" >
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
                                                                                                            <div slot="content">Nuevo Seguimiento  {{ r.cLineaNombre + ' ' + r.cMarcaNombre + ' ' + r.cModeloNombre }}</div>
                                                                                                            <i @click="activarTab333(r.nIdAsignacionContactoVendedor)" :style="'color:#796AEE'" class="fa-md fa fa-sign-out"></i>
                                                                                                        </el-tooltip>
                                                                                                        <template v-if="r.cReferenciaVehEstado=='A'">
                                                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                                <div slot="content">Desactivar {{ r.cLineaNombre + ' ' + r.cMarcaNombre + ' ' + r.cModeloNombre }}</div>
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
                                                                                            <el-select v-model="formNuevoContacto.niddepartamento" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboProv()">
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
                                                                                            <el-select v-model="formNuevoContacto.nidprovincia" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboDist()">
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
                                                                                            <el-select v-model="formNuevoContacto.niddistrito" filterable clearable placeholder="SELECCIONE" >
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
                                                                                            <el-select v-model="formNuevoContacto.nidlinea" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboMarca()">
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
                                                                                            <el-select v-model="formNuevoContacto.nidmarca" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboModelo()">
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
                                                                                            <el-select v-model="formNuevoContacto.nidmodelo" filterable clearable placeholder="SELECCIONE" >
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
                                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                            <div slot="content">Eliminar Referencia  {{ referencia.cMarcaNombre + ' ' + referencia.cModeloNombre }}</div>
                                                                                                            <i @click="eliminarItemReferenciaVehiculo(index)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
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

        </main>
    </transition>
</template>
<script>
    export default {
        props:['ruta'],
        data(){
            return {
                cempresa: 'SAISAC',
                csucursal: sessionStorage.getItem("cNombreSucursal"),
                canio: '2018',
                cmes: 'MAYO',
                arrayTipoDocumento: [],
                arrayLinea: [],
                arrayMarca: [],
                arrayModelo: [],
                arrayAnioFabricacion: [],
                arrayAnioModelo: [],
                arrayEstadoCivil: [],
                arrayProfesion: [],
                arrayProveedor: [],
                arrayReferenciaVehiculo: [],
                arraySegReferenciavehiculo: [],
                arrayContacto: [],
                arrayContactoCarteraMes: [],
                arrayDptos:[],
                arrayProv : [],
                arrayDist: [],
                arrayTipoPersona: [
                    { value: '1', text: 'NATURAL'},
                    { value: '2', text: 'JURIDICA'}
                ],
                arrayZona: [],
                arrayEstadoSeguimiento: [],
                arrayTipoSeguimiento: [],
                arrayFormaPago: [],
                arraySeguimiento: [],
                arrayTipoDocumentoNaturales: [],
                fillProveedor:{
                    cnombreproveedor: ''
                },
                fillMisContactos:{
                    ntipopersona: 1,
                    cnrodocumento: '',
                    cfiltrodescripcion: ''
                },
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
                    nidlinea: '',
                    nidmarca: '',
                    nidmodelo: '',
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
                formSegDatosContacto:{
                    ctipopersona: '',
                    ccontacto: '',
                    cnrodocumento: '',
                    cdireccion: '',
                    ctelefono: '',
                    cemail: '',
                    nidpersona: 0
                },
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
                vistaDatosPersonaNatural: 1
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
                $('#Tab3').addClass("nav-link disabled");
                this.arrayContacto = [];
                this.limpiarMisContactos();
            },
            cambiarTipoPersonaMisContactos(){
                this.arrayContacto = [];
            },
            cambiarPaginaMisContactos(page){
                this.pagination.current_page=page;
                this.listarContactoSinCarteraMes(page);
            },
            listarContactoSinCarteraMes(page){
                this.mostrarProgressBar();
                var url = this.ruta + '/gescontacto/GetListContactoBySinCarteraMes';
                axios.get(url, {
                    params: {
                        'nidempresa' : 1300011,
                        'nidsucursal' : sessionStorage.getItem("nIdSucursal"),
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
            asignarCarteraMes(nIdContacto){
                var url = this.ruta + '/gescontacto/SetContactoCarteraMes';

                axios.post(url, {
                    nIdCronograma: 220016,
                    nIdContacto: parseInt(nIdContacto)
                }).then(response => {
                    if(response.data[0].nFlagMsje==1){
                        swal('Se asignó a Cartera de Mes');
                        this.listarContactoSinCarteraMes(1);
                    }
                    else{
                        swal('No se Asignó');
                        this.listarContactoSinCarteraMes(1);
                    }

                }).catch(error => {
                    console.log(error);
                });
            },
            // ==========================================================
            // =============  TAB CARTERA DEL MES =======================
            tabCarteraMes(){
                $('#Tab3').addClass("nav-link disabled");
                this.arrayContactoCarteraMes = [];
                this.limpiarCarteraMes();
            },
            cambiarTipoPersonaCarteraMes(){
                this.arrayContactoCarteraMes = [];
            },
            cambiarPaginaCarteraMes(page){
                this.pagination.current_page=page;
                this.listarCarteraMesPorVendedor(page);
            },
            listarCarteraMesPorVendedor(page){
                this.mostrarProgressBar();
                var url = this.ruta + '/gescontacto/GetCarteraMesByVendedor';
                axios.get(url, {
                    params: {
                        'nidempresa' : 1300011,
                        'nidsucursal' : sessionStorage.getItem("nIdSucursal"),
                        'nidcronograma' : 220016,
                        'ntipopersona' : this.fillMisContactos.ntipopersona,
                        'cnrodocumento' : String(this.fillMisContactos.cnrodocumento.toString()),
                        'cfiltrodescripcion' : this.fillMisContactos.cfiltrodescripcion.toString(),
                        'page' : page
                    }
                }).then(response => {
                    this.arrayContactoCarteraMes = response.data.arrayContactoCarteraMes.data;
                    this.pagination.current_page =  response.data.arrayContactoCarteraMes.current_page;
                    this.pagination.total = response.data.arrayContactoCarteraMes.total;
                    this.pagination.per_page    = response.data.arrayContactoCarteraMes.per_page;
                    this.pagination.last_page   = response.data.arrayContactoCarteraMes.last_page;
                    this.pagination.from        = response.data.arrayContactoCarteraMes.from;
                    this.pagination.to           = response.data.arrayContactoCarteraMes.to;
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            // ========================================================
            // =============  TAB SEGUIMIENTO =========================
            activarTab3(nIdContacto, nIdPersona, nTipoPersona){
                $('#Tab2').removeClass('nav-link active');
                $('#Tab2').addClass("nav-link");
                $('#Tab3').removeClass('nav-link disabled');
                $('#Tab3').addClass("nav-link active");
                $('#TabCarteraMes').removeClass('in active show');
                $('#TabSeguimiento').addClass('in active show');
                this.formNuevoContacto.nidcontacto = nIdContacto;
                this.formSegDatosContacto.nidpersona = nIdPersona;
                this.TabSegDatosContacto();
                this.cargarTabSegDatosContacto(nTipoPersona);
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
                        'nidsucursal': sessionStorage.getItem("nIdSucursal"),
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
                    nIdSucursal: sessionStorage.getItem("nIdSucursal"),
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
                if(this.formNuevoContacto.nidlinea == ''){
                    this.mensajeError.push('Debes Seleccionar Linea');
                };
                if(this.formNuevoContacto.nidmarca == ''){
                    this.mensajeError.push('Debes Seleccionar Marca');
                };
                if(this.formNuevoContacto.nidmodelo == ''){
                    this.mensajeError.push('Debes Seleccionar Modelo');
                };
                if(this.formNuevoContacto.naniofabricacion == ''){
                    this.mensajeError.push('Debes Seleccionar Año Fabricación');
                };
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
                if(this.validarRegistroSeguimiento()){
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
            validarRegistroSeguimiento(){
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
                $('#Tab3').addClass("nav-link disabled");
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
                    this.errors = error.response.data
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
                        'nidempresa': 130011,
                        'nidproveedor': this.formNuevoContacto.nidproveedor
                    }
                }).then(response => {
                    this.arrayLinea = response.data;
                    this.formNuevoContacto.nidlinea = '';
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
                    this.formNuevoContacto.nidmarca  = '';
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
                    this.formNuevoContacto.nidmodelo = '';
                }).catch(error => {
                    console.log(error);
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
                if(this.formNuevoContacto.nidlinea == ''){
                    this.mensajeError.push('Debes Seleccionar Linea');
                };
                if(this.formNuevoContacto.nidmarca == ''){
                    this.mensajeError.push('Debes Seleccionar Marca');
                };
                if(this.formNuevoContacto.nidmodelo == ''){
                    this.mensajeError.push('Debes Seleccionar Modelo');
                };
                if(this.formNuevoContacto.naniofabricacion == ''){
                    this.mensajeError.push('Debes Seleccionar Año Fabricación');
                };
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
                        nIdSucursal: sessionStorage.getItem("nIdSucursal"),
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
            // =============================================
            // =============  MODAL ========================
            cerrarModal(){
                this.modal = 0
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
                    }
                }
            },
            // ===========================================================
            limpiarMisContactos(){
                this.fillMisContactos.cnrodocumento = '';
                this.fillMisContactos.cfiltrodescripcion = '';
            },
            limpiarCarteraMes(){
                this.fillMisContactos.cnrodocumento = '';
                this.fillMisContactos.cfiltrodescripcion = '';
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
                this.formNuevoContacto.nidlinea = '',
                this.formNuevoContacto.nidmarca  = '',
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
</style>
