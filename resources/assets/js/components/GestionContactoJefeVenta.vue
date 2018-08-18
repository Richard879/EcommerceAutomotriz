<template>
    <main>
        <header class="page-header">
          <div class="container-fluid">
            <h2 class="no-margin-bottom">GESTIÓN DE CONTACTOS JEFE DE VENTA</h2>
          </div>
        </header>

        <section>
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tabMisContact" href="#TabMisContactos" @click="tabMisContactos();" role="tab" data-toggle="tab">
                                        <i class="fa fa-users"></i> MIS CONTACTOS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tabContactVend" href="#TabContactosPorVendedor" @click="tabContactosPorVendedor();" role="tab" data-toggle="tab">
                                        <i class="fa fa-users"></i> CONTACTOS POR VENDEDOR
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tabContactLib" href="#TabContactosLibres" @click="tabContactosLibres();" role="tab" data-toggle="tab">
                                        <i class="fa fa-hand-paper-o"></i> CONTACTOS LIBRES
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="tabSegContac" href="#TabSeguirContacto" @click="tabSeguirContacto();" role="tab" data-toggle="tab">
                                        <i class="fa fa-angle-double-right"></i> SEGUIMIENTO
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tabNueContact" href="#TabNuevoContacto" @click="tabNuevoContacto();" role="tab" data-toggle="tab">
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
                                                                                <input type="radio" class="radio-template" v-model="fillBuscarContacto.ntipopersona" :value="tipo.value" v-on:change="cambiarTipoPersonaMC()">
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
                                                                            <input type="text" v-model="fillBuscarContacto.cnrodocumento" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Contacto</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="fillBuscarContacto.ccontacto" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-9 offset-sm-5">
                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarMisContactosMC();">
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
                                                        <template v-if="arrayContactos.length">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped table-sm">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Contacto</th>
                                                                            <th>Razón Social</th>
                                                                            <th>DNI</th>
                                                                            <th>Teléfono</th>
                                                                            <th>Dirección</th>
                                                                            <th>Acciones</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr v-for="(referencia) in arrayContactos" :key="referencia.codReferencia">
                                                                            <td v-text="referencia.Contacto"></td>
                                                                            <td v-text="referencia.RazonSocial"></td>
                                                                            <td v-text="referencia.DNI"></td>
                                                                            <td v-text="referencia.Telefono"></td>
                                                                            <td v-text="referencia.Direccion"></td>
                                                                            <td>
                                                                                <a data-toggle="tooltip" @click.prevent="abrirModal('conctacto', 'seguirContacto', referencia)" data-placement="top"
                                                                                    :title="'Seguir Contacto'">
                                                                                    <i :style="'color:green'" class="fa-md fa fa-eye"></i>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="container-fluid">
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
                                <div role="tabpanel" class="tab-pane fade" id="TabContactosPorVendedor">
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
                                                                                <input type="radio" class="radio-template" v-model="fillBuscarContactoPorVendedor.ntipopersona" :value="tipo.value" v-on:change="cambiarTipoPersonaCPV()">
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
                                                                            <input type="number" v-model.number="fillBuscarContactoPorVendedor.cnrodocumento" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Contacto</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="fillBuscarContactoPorVendedor.ccontacto" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Vendedor</label>
                                                                        <div class="col-sm-8">
                                                                            <select v-model="fillBuscarContactoPorVendedor.cusuario" class="form-control form-control-sm">
                                                                                <option v-for="vendedor in arrayVendedores" :key="vendedor.nIdVendedor" :value="vendedor.nIdVendedor" v-text="vendedor.cUsuario">
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-9 offset-sm-5">
                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarMisContactosCPV();">
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
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Vendedor</th>
                                                                            <th>Contacto</th>
                                                                            <th>Razón Social</th>
                                                                            <th>DNI</th>
                                                                            <th>Teléfono</th>
                                                                            <th>Dirección</th>
                                                                            <th>Acciones</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr v-for="(referencia) in arrayContactosPorVendedor" :key="referencia.codReferencia">
                                                                            <td v-text="referencia.Vendedor"></td>
                                                                            <td v-text="referencia.Contacto"></td>
                                                                            <td v-text="referencia.RazonSocial"></td>
                                                                            <td v-text="referencia.DNI"></td>
                                                                            <td v-text="referencia.Telefono"></td>
                                                                            <td v-text="referencia.Direccion"></td>
                                                                            <td>
                                                                                <a data-toggle="tooltip" @click.prevent="abrirModal('contactosCPV','reasignarContacto', referencia)"  data-placement="top"
                                                                                    :title="'Reasignar Contacto'">
                                                                                    <i :style="'color:orange'" class="fa-md fa fa-street-view"></i>
                                                                                </a>
                                                                                <!-- <a data-toggle="tooltip" @click.prevent="abrirModal('conctacto', 'seguirContacto', referencia)" data-placement="top"
                                                                                    :title="'Seguir Contacto'">
                                                                                    <i :style="'color:green'" class="fa-md fa fa-eye"></i>
                                                                                </a> -->
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
                                <div role="tabpanel" class="tab-pane fade" id="TabContactosLibres">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form class="form-horizontal">
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Tipo Persona</label>
                                                                        <div class="col-sm-8">
                                                                            <label class="checkbox-inline" v-for="tipo in arrayTipoPersona" :key="tipo.id">
                                                                                <input type="radio" class="radio-template" v-model="fillContactosLibres.ntipopersona" :value="tipo.value" v-on:change="cambiarTipoPersonaCL()">
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
                                                                            <input type="number" v-model.number="fillContactosLibres.cnrodocumento" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Contacto</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="fillContactosLibres.ccontacto" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Tipo de Contacto</label>
                                                                        <div class="col-sm-8">
                                                                            <select v-model="fillContactosLibres.ctipocontacto" class="form-control form-control-sm">
                                                                                <option v-for="tipoConctacto in arrayTipoContacto" :key="tipoConctacto.value" :value="tipoConctacto.value" v-text="tipoConctacto.text">
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-9 offset-sm-5">
                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarMisContactosCL();">
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
                                                        <template v-if="arrayContactosLibres.length">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped table-sm">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Contacto</th>
                                                                            <th>Razón Social</th>
                                                                            <th>DNI</th>
                                                                            <th>Teléfono</th>
                                                                            <th>Dirección</th>
                                                                            <th>Acciones</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr v-for="(referencia) in arrayContactosLibres" :key="referencia.codReferencia">
                                                                            <td v-text="referencia.Vendedor"></td>
                                                                            <td v-text="referencia.Contacto"></td>
                                                                            <td v-text="referencia.RazonSocial"></td>
                                                                            <td v-text="referencia.DNI"></td>
                                                                            <td v-text="referencia.Telefono"></td>
                                                                            <td v-text="referencia.Direccion"></td>
                                                                            <td>
                                                                                <a data-toggle="tooltip" @click.prevent="abrirModal('contactosCPV','reasignarContacto', referencia)"  data-placement="top"
                                                                                    :title="'Reasignar Contacto'">
                                                                                    <i :style="'color:orange'" class="fa-md fa fa-street-view"></i>
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
                                <div role="tabpanel" class="tab-pane fade" id="TabSeguirContacto">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <ul class="nav nav-tabs">
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="tabdcsc" href="#TabDatosContactoSC" @click="activarTabRVsc" role="tab" data-toggle="tab">
                                                            <i class="fa fa-id-badge"></i> DATOS DE CONTACTO
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link disabled" id="tabrvsc" href="#TabReferenciaVehiculoSC" @click="cargarDatosTabRV" role="tab" data-toggle="tab">
                                                            <i class="fa fa fa-map-marker"></i> REFERENCIA VEHICULO
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link disabled" id="tabnssc" href="#TabNuevoSeguimientoSC" role="tab" data-toggle="tab">
                                                            <i class="fa fa-car"></i> NUEVO SEGUIMIENTO
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content">
                                                    <div class="tab-pane fade in active show" id="TabDatosContactoSC">
                                                        <section class="forms">
                                                            <div class="container-fluid">
                                                                <div class="col-lg-12">
                                                                    <form class="form-horizontal">
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-4">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Tipo Persona</label>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="input-group">
                                                                                                <label v-text="fillSeguimientoContacto.tipopersona"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-4">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">DNI/RUC:</label>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="input-group">
                                                                                                <label v-text="fillSeguimientoContacto.dni"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-4">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Contacto:</label>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="input-group">
                                                                                                <label v-text="fillSeguimientoContacto.contacto"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-4">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Dirección</label>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control form-control-sm" v-model="fillSeguimientoContacto.direccion">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-4">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Teléfono</label>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control form-control-sm" v-model="fillSeguimientoContacto.telefono">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-4">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Email:</label>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="input-group">
                                                                                                <input type="text" class="form-control form-control-sm" v-model="fillSeguimientoContacto.email">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-9 offset-sm-4">
                                                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="activarTabRVsc();">
                                                                                        <i class="fa fa-arrow-right"></i> Siguiente
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade" id="TabReferenciaVehiculoSC">
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
                                                                                            <input type="hidden" v-model="fillSeguimientoContacto.nidproveedor">
                                                                                            <input type="text" v-model="fillSeguimientoContacto.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
                                                                                            <div class="input-group-prepend">
                                                                                                <button type="button" title="Buscar Proveedor" class="btn btn-info btn-corner btn-sm" @click="abrirModal('proveedor','buscar', 2)">
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
                                                                                        <select name="account" v-model="fillSeguimientoContacto.nidlinea" class="form-control form-control-sm" v-on:change="llenarComboMarcaSC();">
                                                                                            <option v-for="linea in arrayLinea" :key="linea.nIdPar" :value="linea.nIdPar" v-text="linea.cParNombre">
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Marca</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select name="account" v-model="fillSeguimientoContacto.nidmarca" class="form-control form-control-sm" v-on:change="llenarComboModeloSC();">
                                                                                            <option v-for="marca in arrayMarca" :key="marca.nIdPar" :value="marca.nIdPar" v-text="marca.cParNombre">
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Modelo</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select name="account" v-model="fillSeguimientoContacto.nidmodelo" class="form-control form-control-sm">
                                                                                            <option v-for="modelo in arrayModelo" :key="modelo.nIdPar" :value="modelo.nIdPar" v-text="modelo.cParNombre">
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Año Fabricación</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select name="account" v-model="fillSeguimientoContacto.naniofabricacion" class="form-control form-control-sm">
                                                                                            <option v-for="fab in arrayAnioFabricacion" :key="fab.nIdPar" :value="fab.nIdPar" v-text="fab.cParNombre">
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Año Modelo</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select name="account" v-model="fillSeguimientoContacto.naniomodelo" class="form-control form-control-sm">
                                                                                            <option v-for="version in arrayAnioModelo" :key="version.nIdPar" :value="version.nIdPar" v-text="version.cParNombre">
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-9 offset-sm-5">
                                                                                <button type="button" class="btn btn-success btn-corner btn-sm pull-rigth" @click="registrarSegReferenciaVehiculo()">
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
                                                                                                    <a href="#" @click="activarTabNSsc(r.nIdAsignacionContactoVendedor)" data-toggle="tooltip" data-placement="top"
                                                                                                        :title="'Nuevo Seguimiento ' + r.cLineaNombre + ' ' + r.cMarcaNombre + ' ' + r.cModeloNombre">
                                                                                                        <i class="fa-md fa fa-sign-out"></i>
                                                                                                    </a>
                                                                                                    <template v-if="r.cReferenciaVehEstado=='A'">
                                                                                                        <a href="#" @click="desactivar(r.nIdReferenciaVehiculoContacto)" data-toggle="tooltip" data-placement="top"
                                                                                                        :title="'Desactivar ' + r.cLineaNombre + ' ' + r.cMarcaNombre + ' ' + r.cModeloNombre">
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
                                                    <div role="tabpanel" class="tab-pane fade" id="TabNuevoSeguimientoSC">
                                                        <section class="forms">
                                                            <div class="container-fluid">
                                                                <div class="col-lg-12">
                                                                    <form class="form-horizontal">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Zona</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select class="form-control form-control-sm">
                                                                                            <option>
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Estado</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select class="form-control form-control-sm">
                                                                                            <option>
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
                                                                                        <select class="form-control form-control-sm">
                                                                                            <option>
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Forma de Pago</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select class="form-control form-control-sm">
                                                                                            <option>
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
                                                                                        <input type="date" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Hora Seguimiento</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Asunto</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Rendir Seguimiento</label>
                                                                                    <div class="col-sm-8">
                                                                                        <textarea cols="30" rows="10" class="form-control form-control-sm"></textarea>
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
                                                                                        <input type="text" v-model="formNuevoContacto.cnombres" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Fecha Nacimiento</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="date" v-model="formNuevoContacto.dfecnacimiento" class="form-control form-control-sm">
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
                                                                                        <select v-model="formNuevoContacto.niddepartamento" class="form-control form-control-sm" v-on:change="llenarComboProv()">
                                                                                            <option v-for="dpto in arrayDptos" :key="dpto.id" :value="dpto.id" v-text="dpto.text">
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Provincia</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select v-model="formNuevoContacto.nidprovincia" class="form-control form-control-sm" v-on:change="llenarComboDist">
                                                                                            <option v-for="prov in arrayProv" :key="prov.id" :value="prov.id" v-text="prov.text">
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Distrito</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select v-model="formNuevoContacto.niddistrito" class="form-control form-control-sm">
                                                                                            <option v-for="dist in arrayDist" :key="dist.id" :value="dist.id" v-text="dist.text">
                                                                                            </option>
                                                                                        </select>
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
                                                                                            <select v-model="formNuevoContacto.nprofesion" class="form-control form-control-sm">
                                                                                                <option v-for="item in arrayProfesion" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                                                </option>
                                                                                            </select>
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
                                                                                                    <label class="col-sm-4 form-control-label">Nombres</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <input type="text" v-model="formNuevoContactoJurifico.cnombres" class="form-control form-control-sm">
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
                                                                                                    <label class="col-sm-4 form-control-label">Teléfono</label>
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
                                                                <form v-on:submit.prevent class="form-horizontal">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9 offset-sm-4">
                                                                            <button type="button btn-block" class="btn btn-success btn-corner btn-sm" @click="activarTab33();">
                                                                                <i class="fa fa-arrow-right"></i> Siguiente
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
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
                                                                                                <button type="button" title="Buscar Proveedor" class="btn btn-info btn-corner btn-sm" @click="abrirModal('proveedor','buscar', 1)">
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
                                                                                        <select name="account" v-model="formNuevoContacto.nidlinea" class="form-control form-control-sm" v-on:change="llenarComboMarca();">
                                                                                            <option v-for="linea in arrayLinea" :key="linea.nIdPar" :value="linea.nIdPar"> {{ linea.cParNombre }}
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Marca</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select name="account" v-model="formNuevoContacto.nidmarca" class="form-control form-control-sm" v-on:change="llenarComboModelo();">
                                                                                            <option v-for="marca in arrayMarca" :key="marca.nIdPar" :value="marca.nIdPar" v-text="marca.cParNombre">
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Modelo</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select name="account" v-model="formNuevoContacto.nidmodelo" class="form-control form-control-sm">
                                                                                            <option v-for="modelo in arrayModelo" :key="modelo.nIdPar" :value="modelo.nIdPar" v-text="modelo.cParNombre">
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Año Fabricación</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select name="account" v-model="formNuevoContacto.naniofabricacion" class="form-control form-control-sm">
                                                                                            <option v-for="fab in arrayAnioFabricacion" :key="fab.nIdPar" :value="fab.nIdPar" v-text="fab.cParNombre">
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Año Modelo</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select name="account" v-model="formNuevoContacto.naniomodelo" class="form-control form-control-sm">
                                                                                            <option v-for="version in arrayAnioModelo" :key="version.nIdPar" :value="version.nIdPar" v-text="version.cParNombre">
                                                                                            </option>
                                                                                        </select>
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
                                                                                            <tr v-for="(referencia, index) in arrayReferenciaVehiculo" :key="referencia.nIdProveedor">
                                                                                                <td>
                                                                                                    <a href="#" @click="eliminarItemReferenciaVehiculo(index)" data-toggle="tooltip" data-placement="top"
                                                                                                        :title="'Eliminar Referencia'">
                                                                                                        <i :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                                    </a>
                                                                                                </td>
                                                                                                <td>{{ referencia.cProveedorNombreRef }}</td>
                                                                                                <td>{{ referencia.cLineaNombreRef }}</td>
                                                                                                <td>{{ referencia.cMarcaNombreRef }}</td>
                                                                                                <td>{{ referencia.cModeloNombreRef }}</td>
                                                                                                <td>{{ referencia.nAnioFabricacionRef }}</td>
                                                                                                <td>{{ referencia.nAnioModeloRef }}</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-7">
                                                                                        </div>
                                                                                        <!--<div class="col-lg-5">
                                                                                            <div class="datatable-info">Mostrando {{ pagination.from }} a {{ pagination.to }} de {{ pagination.total }} registros</div>
                                                                                        </div>-->
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
                                                                <div class="form-group row">
                                                                    <div class="col-sm-9 offset-sm-5">
                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarNuevoContacto()">
                                                                            <i class="fa fa-save"></i> Registrar
                                                                        </button>
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

        <!-- Modal Asignar Proveedor -->
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
                                                                    <td>{{proveedor.cParNombre}}</td>
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

        <!-- Modal Reasignar Contacto -->
        <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form v-on:submit.prevent class="form-horizontal">
                            <div class="container-fluid">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">REASIGNAR CONTACTO</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="form-group row" v-show="error">
                                                    <div class="col-xs-12">
                                                        <div class="row">
                                                            <div class="text-center text-error">
                                                                <div v-for="error in mensajeError" :key="error" v-text="error"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Contacto:</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <label v-text="fillReasignarContacto.contacto"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Tipo Persona</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <label v-text="fillReasignarContacto.tipopersona"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">DNI/RUC:</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <label v-text="fillReasignarContacto.dni"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Marca</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <label v-text="fillReasignarContacto.nombremarca"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Modelo</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <label v-text="fillReasignarContacto.nombremodelo"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Vendedor:</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <label v-text="fillReasignarContacto.vendedor"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Nuevo Vendedor</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <select name="account" v-model="fillReasignarContacto.idvendedor" class="form-control form-control-sm">
                                                                        <option v-for="vendedores in arrayVendedores" :key="vendedores.nIdVendedor" :value="vendedores.nIdVendedor" v-text="vendedores.cUsuario">
                                                                        </option>
                                                                    </select>
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
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="ReasignarContactoCPV()">Guardar</button>
                        <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Asignar Proveedor -->
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
                                                            <label class="col-sm-4 form-control-label">Nombre</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <input type="text" v-model="fillProveedor.cnombreproveedor" @keyup.enter="buscaProveedoresSC()" class="form-control form-control-sm">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" title="Buscar Provedores" class="btn btn-info btn-corner btn-sm" @click="buscaProveedoresSC();">
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
                                                                        <a href="#" @click="asignarProveedorSC(proveedor.nIdPar, proveedor.cParNombre);">
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
                                                                            <a @click.prevent="cambiarPaginaProveedorSC(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                        </li>
                                                                        <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                        :class="[page==isActivedModal?'active':'']">
                                                                            <a class="page-link"
                                                                            href="#" @click.prevent="cambiarPaginaProveedorSC(page)"
                                                                            v-text="page"></a>
                                                                        </li>
                                                                        <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                            <a @click.prevent="cambiarPaginaProveedorSC(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                //Radio Buttons Tipo Persona
                arrayTipoPersona: [
                    { value: '1', text: 'NATURAL'},
                    { value: '2', text: 'JURIDICA'}
                ],

                // =============================================================
                // VARIABLES TAB MIS CONTACTO
                // =============================================================
                fillBuscarContacto:{
                    ntipopersona: 1,
                    cnrodocumento: '',
                    ccontacto: ''
                },
                arrayContactos: [],

                // =============================================================
                // VARIABLES TAB CONTACTOS POR VENDEDOR
                // =============================================================
                fillBuscarContactoPorVendedor:{
                    ntipopersona: 1,
                    cnrodocumento: '',
                    ccontacto: '',
                    cusuario: 0
                },
                arrayVendedores: [],
                arrayContactosPorVendedor: [],
                fillReasignarContacto: {
                    contacto: '',
                    tipopersona: 0,
                    dni: '',
                    nombrelinea: 0,
                    nombremarca: 0,
                    nombremodelo: 0,
                    vendedor: '',
                    idvendedor: 0,
                    idasigcontactvendedor: 0
                },

                // =============================================================
                // VARIABLES TAB CONTACTOS LIBRES
                // =============================================================
                fillContactosLibres: {
                    ntipopersona: 1,
                    cnrodocumento: '',
                    ccontacto: '',
                    ctipocontacto: 0
                },
                arrayTipoContacto: [
                    { value: 0, text: 'Seleccione un Tipo de Persona'},
                    { value: 'N', text: 'N'},
                    { value: 'S', text: 'S'}
                ],
                arrayContactosLibres: [],

                // =============================================================
                // VARIABLES TAB SEGUIMIENTO CONTACTO
                // =============================================================
                fillSeguimientoContacto: {
                    tipopersona: 0,
                    dni: '',
                    contacto: '',
                    direccion: '',
                    telefono: '',
                    email: '',
                    nidproveedor: 0,
                    cproveedornombre: '',
                    nidlinea:0,
                    nidmarca:0,
                    nidmodelo:0,
                    naniofabricacion:0,
                    naniomodelo:0,
                    nidcontacto: 0,
                    //
                    nombrelinea: 0,
                    nombremarca: 0,
                    nombremodelo: 0,
                    vendedor: '',
                    idvendedor: 0,
                    idasigcontactvendedor: 0
                },
                arraySegReferenciavehiculo: [],
                // =============================================================
                // VARIABLES TAB NUEVO CONTACTO
                // =============================================================
                //sub tab datos personales natural
                arrayTipoDocumento: [],
                //sub tab datos contacto
                arrayDptos:[],
                arrayProv : [],
                arrayDist: [],
                arrayEstadoCivil: [],
                arrayProfesion: [],
                //sub tab referencia vehiculo
                arrayLinea: [],
                arrayMarca: [],
                arrayModelo: [],
                arrayAnioFabricacion: [],
                arrayAnioModelo: [],
                //sub tab referencia vehiculo - Modal Busqueda de proveedor
                fillProveedor:{
                    cnombreproveedor: ''
                },
                arrayProveedor: [],
                //sub tab referencia vehiculo - Listado de Referencias de vehiculos
                arrayReferenciaVehiculo: [],
                //Datos de contacto Form Natural / Juridico
                formNuevoContacto:{
                    //Tab DATOS PERSONALES
                    ntipopersona: 1,
                    ntpodocumento: 0,
                    cnrodocumento: '',
                    capepaterno: '',
                    capematerno: '',
                    cnombres: '',
                    dfecnacimiento: '',
                    lblcnombres: '* Nombres',
                    //Tab DATOS DE CONTACTO
                    niddepartamento: 0,
                    nidprovincia: 0,
                    niddistrito: 0,
                    cdireccion: '',
                    cmailprincipal: '',
                    cmailalternativo: '',
                    ctelefonofijo: '',
                    ncelular: '',
                    ncelularalternativo: '',
                    nestadocivil: 0,
                    nprofesion: 0,
                    ccentrolaboral: '',
                    //Tab REFERENCIA VEHICULO
                    nidproveedor: 0,
                    cproveedornombre: '',
                    nidlinea: 0,
                    nidmarca: 0,
                    nidmodelo: 0,
                    naniofabricacion: 0,
                    naniomodelo: 0
                },
                //Datos de contacto Form Jurifico
                formNuevoContactoJurifico:{
                    ntpodocumento: 0,
                    cnrodocumento: '',
                    capepaterno: '',
                    capematerno: '',
                    cnombres: '',
                    cmailprincipal: '',
                    ncelular : ''
                },
                //sub tab datos personales jurifico
                arrayTipoDocumentoNaturales: [],
                //Pagination
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
            // =================================================================
            // INICIO TAB MIS CONTACTO
            // =================================================================
            tabMisContactos(){
                $('#TabContactosPorVendedor').removeClass('nav-link active');
                $('#TabContactosPorVendedor').addClass("nav-link disabled");
                $('#TabContactosLibres').removeClass('nav-link active');
                $('#TabContactosLibres').addClass("nav-link disabled");
                $('#TabSeguirContacto').removeClass('nav-link active');
                $('#TabSeguirContacto').addClass("nav-link disabled");
                $('#TabNuevoContacto').removeClass('nav-link active');
                $('#TabNuevoContacto').addClass("nav-link disabled");
                this.limpiarListadoMC();
                this.limpiarBuscarContactosMC();
            },
            cambiarTipoPersonaMC(){
                this.limpiarBuscarContactosMC();
            },
            limpiarListadoMC(){
                this.arrayContactos = [];
                this.limpiarPaginacion();
            },
            limpiarBuscarContactosMC(){
                this.fillBuscarContacto.cnrodocumento = '',
                this.fillBuscarContacto.ccontacto = ''
            },
            buscarMisContactosMC(){
                if(this.validarBuscarContactosMC()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/gescontacto/GetContactos';
                axios.get(url, {
                    params: {
                        'ntipoPersona'  : this.fillBuscarContacto.ntipopersona,
                        'cdocumento'    : this.fillBuscarContacto.cnrodocumento.toString(),
                        'ccontacto'     : this.fillBuscarContacto.ccontacto.toString()
                    }
                }).then(response => {
                    let info = response.data.arrayContactos;
                    //Data
                    this.arrayContactos = info.data;
                    //Pagination
                    this.pagination.current_page   =   info.current_page;
                    this.pagination.total          =   info.total;
                    this.pagination.per_page       =   info.per_page;
                    this.pagination.last_page      =   info.last_page;
                    this.pagination.from           =   info.from;
                    this.pagination.to             =   info.to;
                    //Limpiar caja busqueda
                    this.limpiarBuscarContactosMC();
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            validarBuscarContactosMC(){
                this.error = 0;
                this.mensajeError =[];

                let nrodocumento = this.fillBuscarContacto.cnrodocumento;
                let tipopersona  = this.fillBuscarContacto.ntipopersona;

                if (tipopersona == 1) {
                    if(nrodocumento){
                        // if (nrodocumento.length < 8 || nrodocumento.length >8) {
                        //     console.log(nrodocumento.length);
                        //     this.mensajeError.push('El #documento debe ser de 8 digitos');
                        // }
                    };
                } else {
                    if(nrodocumento){
                        // if (nrodocumento.length < 11 || nrodocumento.length > 11) {
                        //     this.mensajeError.push('El #documento debe ser de 11 digitos');
                        // }
                    };
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },

            // =================================================================
            // INICIO TAB CONTACTOS POR PROVEEDOR
            // =================================================================
            tabContactosPorVendedor(){
                $('#TabMisContactos').removeClass('nav-link active');
                $('#TabMisContactos').addClass("nav-link disabled");
                $('#TabContactosLibres').removeClass('nav-link active');
                $('#TabContactosLibres').addClass("nav-link disabled");
                $('#TabSeguirContacto').removeClass('nav-link active');
                $('#TabSeguirContacto').addClass("nav-link disabled");
                $('#TabNuevoContacto').removeClass('nav-link active');
                $('#TabNuevoContacto').addClass("nav-link disabled");
                this.llenarComboVendedores();
                this.limpiarBuscarContactosCPV();
                this.limpiarListadoCPV();
            },
            cambiarTipoPersonaCPV(){
                this.limpiarBuscarContactosCPV();
            },
            limpiarBuscarContactosCPV(){
                this.fillBuscarContactoPorVendedor.cnrodocumento = '',
                this.fillBuscarContactoPorVendedor.ccontacto = '',
                this.fillBuscarContactoPorVendedor.cusuario = 0
            },
            limpiarListadoCPV(){
                this.arrayContactosPorVendedor = [];
                this.limpiarPaginacion();
            },
            llenarComboVendedores(){
                var url = this.ruta + '/gescontacto/GetVendedores';
                axios.get(url, {
                    params: {
                        'opcion'    :   '0'
                    }
                }).then(response => {
                    this.arrayVendedores = response.data;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            buscarMisContactosCPV(){
                if(this.validaBuscarConctactobyProveedorCPV()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                var url = this.ruta + '/gescontacto/GetContactosPorVendedor';
                axios.get(url, {
                    params: {
                        'ntipoPersona'  : this.fillBuscarContactoPorVendedor.ntipopersona,
                        'cdocumento'    : this.fillBuscarContactoPorVendedor.cnrodocumento,
                        'ccontacto'     : this.fillBuscarContactoPorVendedor.ccontacto,
                        'vendedor'      : this.fillBuscarContactoPorVendedor.cusuario
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
                    this.limpiarBuscarContactosCPV();
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            validaBuscarConctactobyProveedorCPV(){
                this.error = 0;
                this.mensajeError =[];

                let nrodocumento = this.fillBuscarContactoPorVendedor.cnrodocumento;
                let tipopersona  = this.fillBuscarContactoPorVendedor.ntipopersona;

                if (tipopersona == 1) {
                    if(nrodocumento){
                        // if (nrodocumento.length < 8 || nrodocumento.length >8) {
                        //     this.mensajeError.push('El #documento debe ser de 8 digitos');
                        // }
                    };
                } else {
                    if(nrodocumento){
                        // if (nrodocumento.length < 11 || nrodocumento.length > 11) {
                        //     this.mensajeError.push('El #documento debe ser de 11 digitos');
                        // }
                    };
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            ReasignarContactoCPV(){
                if(this.validarResasignarContactoCPV()){
                    return;
                }
                var url = this.ruta + '/gescontacto/UpdReasignarContacto';
                axios.get(url, {
                    params: {
                        'asigcontactvendedor'  : this.fillReasignarContacto.idasigcontactvendedor,
                        'vendedor'  : this.fillReasignarContacto.idvendedor
                    }
                }).then(response => {
                    //console.log(response.data.data[0].cMensaje);
                    if(response.data.data[0].nFlagMsje==1){
                        swal(response.data.data[0].cMensaje + this.fillReasignarContacto.vendedor);
                    }else{
                        swal(response.data.data[0].cMensaje);
                    }
                    this.buscarMisContactosCPV();
                    this.cerrarModal();
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            validarResasignarContactoCPV(){
                this.error = 0;
                this.mensajeError =[];

                if(this.fillReasignarContacto.idvendedor == 0){
                    this.mensajeError.push('Debe seleccionar un vendedor');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },

            // =================================================================
            // INICIO TAB CONTACTO LIBRES
            // =================================================================
            tabContactosLibres(){
            },
            cambiarTipoPersonaCL(){
                this.limpiarBuscarContactosCL();
            },
            limpiarBuscarContactosCL(){
                this.fillContactosLibres.cnrodocumento = '',
                this.fillContactosLibres.ccontacto = '',
                this.fillContactosLibres.cusuario = 0,
                this.fillContactosLibres.ctipocontacto = 0
            },
            buscarMisContactosCL(){
                if(this.validaBuscarConctactobyTipoContacto()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                var url = this.ruta + '/gescontacto/GetContactosLibres';
                axios.get(url, {
                    params: {
                        'ntipoPersona'  : this.fillContactosLibres.ntipopersona,
                        'cdocumento'    : this.fillContactosLibres.cnrodocumento,
                        'ccontacto'     : this.fillContactosLibres.ccontacto,
                        'ctipocontacto' : this.fillContactosLibres.ctipocontacto
                    }
                }).then(response => {
                    let info = response.data.arrayContactosLibres;
                    //Data
                    this.arrayContactosLibres = info.data;
                    //Pagination
                    this.pagination.current_page   =   info.current_page;
                    this.pagination.total          =   info.total;
                    this.pagination.per_page       =   info.per_page;
                    this.pagination.last_page      =   info.last_page;
                    this.pagination.from           =   info.from;
                    this.pagination.to             =   info.to;
                    //Limpiar caja busqueda
                    this.limpiarBuscarContactosCL();
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            validaBuscarConctactobyTipoContacto(){
                this.error = 0;
                this.mensajeError =[];

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },

            // =================================================================
            // INICIO TAB SEGUIR CONTACTO
            // =================================================================
            tabSeguirContacto(){},
            tabIrAlSeguimiento(){
                //Tabs Principales
                $('#tabMisContact').removeClass('nav-link active');
                $('#tabMisContact').addClass("nav-link");
                $('#tabContactVend').removeClass('nav-link active');
                $('#tabContactVend').addClass("nav-link");
                $('#tabSegContac').removeClass('nav-link disabled');
                $('#tabSegContac').addClass("nav-link active");
                $('#TabMisContactos').removeClass('in active show');
                $('#TabContactosPorVendedor').removeClass('in active show');
                $('#TabSeguirContacto').addClass('in active show');
            },
            activarTabRVsc(){
                if(this.validarTabRVsc()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.cargarDatosTabRV();

                $('#tabdcsc').removeClass('nav-link active');
                $('#tabdcsc').addClass("nav-link");
                $('#TabDatosContactoSC').removeClass('in active show');
                $('#tabrvsc').removeClass('nav-link disabled');
                $('#tabrvsc').addClass("nav-link active");
                $('#TabReferenciaVehiculoSC').addClass('in active show');
            },
            validarTabRVsc(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.fillSeguimientoContacto.direccion){
                    this.mensajeError.push('La dirección no puede estar vació');
                };
                if(!this.fillSeguimientoContacto.telefono){
                    this.mensajeError.push('El teléfono no puede estar vació');
                };
                if(!this.fillSeguimientoContacto.email){
                    this.mensajeError.push('El correo electronico no puede estar vació');
                };

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            cargarDatosTabRV(){
                this.llenarComboAnioFabricacionSC();
                this.llenarComboAnioModeloSC();
                this.limpiarSubTabRV();
                this.listarReferenciaVehiculoByContacto(1);
            },
            limpiarSubTabRV(){
                this.fillSeguimientoContacto.nidproveedor = 0,
                this.fillSeguimientoContacto.cproveedornombre = '';
                this.arrayLinea = [];
                this.arrayMarca = [];
                this.arrayModelo = [];
                this.fillSeguimientoContacto.nidlinea = 0;
                this.fillSeguimientoContacto.nidmarca = 0;
                this.fillSeguimientoContacto.nidmodelo = 0;
            },
            buscaProveedoresSC(){
                this.listarProveedores(1);
            },
            listarProveedoresSC(page){
                var url = this.ruta + '/parametro/GetLstProveedor';
                axios.get(url, {
                    params: {
                        'nidempresa': 130011,
                        'nidgrupopar': 110023,
                        'cnombreproveedor': this.fillProveedor.cnombreproveedor.toString(),
                        'opcion': 1,
                        'page:': page
                    }
                }).then(response => {
                    //Data
                    this.arrayProveedor = response.data.arrayProveedor.data;
                    //Pagination
                    this.paginationModal.current_page   =  response.data.arrayProveedor.current_page;
                    this.paginationModal.total          = response.data.arrayProveedor.total;
                    this.paginationModal.per_page       = response.data.arrayProveedor.per_page;
                    this.paginationModal.last_page      = response.data.arrayProveedor.last_page;
                    this.paginationModal.from           = response.data.arrayProveedor.from;
                    this.paginationModal.to             = response.data.arrayProveedor.to;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            cambiarPaginaProveedorSC(page){
                this.paginationModal.current_page=page;
                this.listarProveedoresSC(page);
            },
            asignarProveedorSC(nProveedorId, cProveedorNombre){
                this.fillSeguimientoContacto.nidproveedor = nProveedorId;
                this.fillSeguimientoContacto.cproveedornombre = cProveedorNombre;
                this.cerrarModal();
                this.fillProveedor.cnombreproveedor = '';
                this.arrayMarca = [];//Setea Array de Marcas
                this.arrayModelo = [];//Setea Array de Modelos
                this.llenarComboLineaSC();
            },
            llenarComboLineaSC(){
                this.nidempresa = 130011;

                var url = this.ruta + '/versionvehiculo/GetLineasByProveedor';
                axios.get(url, {
                    params: {
                        'nidempresa': 130011,
                        'nidproveedor': this.fillSeguimientoContacto.nidproveedor
                    }
                }).then(response => {
                    //Data
                    this.arrayLinea = response.data;
                    //Select lineas se setea en 0
                    this.fillSeguimientoContacto.nidlinea = 0;
                    this.llenarComboMarcaSC();
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            llenarComboMarcaSC(){
                var url = this.ruta + '/versionvehiculo/GetMarcaByLinea';

                axios.get(url, {
                    params: {
                        'nidlinea': this.fillSeguimientoContacto.nidlinea
                    }
                }).then(response => {
                    this.arrayMarca = response.data;
                    this.fillSeguimientoContacto.nidmarca = 0;
                    this.arrayModelo = [];
                    this.llenarComboModeloSC();
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            llenarComboModeloSC(){
                var url = this.ruta + '/versionvehiculo/GetModeloByMarca';
                axios.get(url, {
                    params: {
                        'nidmarca': this.fillSeguimientoContacto.nidmarca
                    }
                }).then(response => {
                    this.arrayModelo = response.data;
                    this.fillSeguimientoContacto.nidmodelo = 0;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            llenarComboAnioFabricacionSC(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid': 110034,
                        'opcion': 0
                    }
                }).then(response => {
                    this.arrayAnioFabricacion = response.data;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            llenarComboAnioModeloSC(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid': 110035,
                        'opcion': 0
                    }
                }).then(response => {
                    this.arrayAnioModelo = response.data;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            listarReferenciaVehiculoByContacto(page){
                var url = this.ruta + '/gescontacto/GetRefVehiculoByContacto_JFV';

                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidsucursal': 1300013,
                        'nidcontacto' : this.fillSeguimientoContacto.nidcontacto,
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

                var nidaniofabricacion = this.fillSeguimientoContacto.naniofabricacion;
                var nidaniomodelo = this.fillSeguimientoContacto.naniomodelo;

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
                    nIdContacto: this.fillSeguimientoContacto.nidcontacto,
                    nIdProveedor: this.fillSeguimientoContacto.nidproveedor,
                    nIdLinea: this.fillSeguimientoContacto.nidlinea,
                    nIdMarca: this.fillSeguimientoContacto.nidmarca,
                    nIdModelo: this.fillSeguimientoContacto.nidmodelo,
                    nAnioFabricacion: nAnioFabricacionRef,
                    nAnioModelo: nAnioModeloRef
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Referencia Vehiculo registrada');
                        this.arrayReferenciaVehiculoTemp = [];
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

                if(this.fillSeguimientoContacto.nidproveedor == 0){
                    this.mensajeError.push('Debes Seleccionar Proveedor');
                };
                if(this.fillSeguimientoContacto.nidlinea == 0){
                    this.mensajeError.push('Debes Seleccionar Linea');
                };
                if(this.fillSeguimientoContacto.nidmarca == 0){
                    this.mensajeError.push('Debes Seleccionar Marca');
                };
                if(this.fillSeguimientoContacto.nidmodelo == 0){
                    this.mensajeError.push('Debes Seleccionar Modelo');
                };
                if(this.fillSeguimientoContacto.naniofabricacion == 0){
                    this.mensajeError.push('Debes Seleccionar Año Fabricación');
                };
                if(this.fillSeguimientoContacto.naniomodelo == 0){
                    this.mensajeError.push('Debes Seleccionar Año Modelo');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            activarTabNSsc(nIdAsignacionContactoVendedor){
                $('#tabrvsc').removeClass('nav-link active');
                $('#tabrvsc').addClass("nav-link");
                $('#tabnssc').removeClass('nav-link disabled');
                $('#tabnssc').addClass("nav-link active");
                $('#TabReferenciaVehiculoSC').removeClass('in active show');
                $('#TabNuevoSeguimientoSC').addClass('in active show');
            },

            // =================================================================
            // INICIO TAB NUEVO CONTACTO
            // =================================================================
            tabNuevoContacto(){
                this.tabDatosPersonales();
                this.cargarTabDatosPersonales();
            },
            cambiarTipoPersona(){
                this.llenarComboTpoDocumento();
                //Limpia todos los campos al cambiar de tipo de persona
                this.limpiarFormularioNuevoContacto();
                if(this.fillSeguimientoContacto.ntipopersona == 1)
                {
                    this.formNuevoContacto.lblcnombres = 'Nombres(*)',
                    this.vistaDatosPersonaNatural = 1
                } else {
                    this.formNuevoContacto.lblcnombres = 'Razón Social(*)',
                    this.vistaDatosPersonaNatural = 0
                }
            },
            cargarTabDatosPersonales(){
                this.llenarComboTpoDocumento();
                this.llenarComboDptos();
                this.llenarComboDist();
                this.llenarComboProv();
                this.llenarComboDist();
                this.llenarComboEstadoCivil();
                this.llenarComboProfesion();
                this.llenarComboAnioFabricacion();
                this.llenarComboAnioModelo();
                this.limpiarFormularioNuevoContacto();
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
                        this.errors = error.response.data
                    });
                }
                else{
                    var url = this.ruta + '/parametro/GetDocumentoJuridica?ngrupoparid=' + 110047
                                                                                + '&opcion=' + 0;
                    axios.get(url).then(response => {
                        this.arrayTipoDocumento = response.data;
                        this.formNuevoContacto.ntpodocumento = 0;
                    }).catch(error => {
                        this.errors = error.response.data
                    });
                }
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
            //Inicio Combos Ubigeo
            llenarComboDptos(){
                var url = this.ruta + '/ubigeo/GetDptos';
                axios.get(url).then(response => {
                    this.arrayDptos = response.data;
                }).catch(error => {
                    this.errors = error.response.data
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
                    this.errors = error.response.data
                });
            },
            llenarComboDist(){
                var url = this.ruta + '/ubigeo/GetDistritosByProv?nidprovincia=' + this.formNuevoContacto.nidprovincia;
                axios.get(url).then(response => {
                    this.arrayDist = response.data;
                    this.formNuevoContacto.niddistrito = 0;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            //Fin Combos Ubigeo
            //Inicio Modal Asignar Proveedor
            buscaProveedores(){
                this.listarProveedores(1);
            },
            listarProveedores(page){
                var url = this.ruta + '/parametro/GetLstProveedor?nidempresa=' + 130011
                                                                    + '&nidgrupopar=' + 110023
                                                                    + '&cnombreproveedor=' + this.fillProveedor.cnombreproveedor.toString()
                                                                    + '&opcion=' + 1
                                                                    + '&page='+ page;
                axios.get(url).then(response => {
                    //Data
                    this.arrayProveedor = response.data.arrayProveedor.data;
                    //Pagination
                    this.paginationModal.current_page =  response.data.arrayProveedor.current_page;
                    this.paginationModal.total = response.data.arrayProveedor.total;
                    this.paginationModal.per_page    = response.data.arrayProveedor.per_page;
                    this.paginationModal.last_page   = response.data.arrayProveedor.last_page;
                    this.paginationModal.from        = response.data.arrayProveedor.from;
                    this.paginationModal.to           = response.data.arrayProveedor.to;
                }).catch(error => {
                    this.errors = error.response.data
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
                this.fillProveedor.cnombreproveedor = '';
                this.arrayMarca = [];//Setea Array de Marcas
                this.arrayModelo = [];//Setea Array de Modelos
                this.llenarComboLinea();
            },
            //Fin Modal Asignar Proveedor
            //Inicio Combo vehículo por Proveedor
            llenarComboLinea(){
                this.nidempresa = 130011;

                var url = this.ruta + '/versionvehiculo/GetLineasByProveedor?nidempresa=' + this.nidempresa
                                                                    + '&nidproveedor=' + this.formNuevoContacto.nidproveedor;
                axios.get(url).then(response => {
                    //Data
                    this.arrayLinea = response.data;
                    //Select lineas se setea en 0
                    this.formNuevoContacto.nidlinea = 0;
                    this.llenarComboMarca();
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            llenarComboMarca(){
                var url = this.ruta + '/versionvehiculo/GetMarcaByLinea?nidlinea=' + this.formNuevoContacto.nidlinea;

                axios.get(url).then(response => {
                    this.arrayMarca = response.data;
                    this.formNuevoContacto.nidmarca = 0;
                    this.arrayModelo = [];
                    this.llenarComboModelo();
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            llenarComboModelo(){
                var url = this.ruta + '/versionvehiculo/GetModeloByMarca?nidmarca=' + this.formNuevoContacto.nidmarca;
                axios.get(url).then(response => {
                    this.arrayModelo = response.data;
                    this.formNuevoContacto.nidmodelo = 0;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            //Fin Combo Vehículo por proveedor
            llenarComboAnioFabricacion(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110034
                                                                                + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayAnioFabricacion = response.data;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            llenarComboAnioModelo(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110035
                                                                                + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayAnioModelo = response.data;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            //Inicio Combo Datos de Conctacto - PN
            llenarComboEstadoCivil(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110048
                                                                            + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayEstadoCivil = response.data;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            llenarComboProfesion(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110049
                                                                            + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayProfesion = response.data;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            //Fin Combo Datos de Conctacto - PN
            //Inicio Proceso de Asignación
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

                //Captura los nombres relacionados al id del combo seleccionado, para visualizarlo
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

                //Capturo datos para comprobación
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
                }else{
                    this.arrayReferenciaVehiculo.push({
                        nIdProveedorRef: nIdProveedorRef,
                        nIdLineaRef: nIdLineaRef,
                        nIdMarcaRef: nIdMarcaRef,
                        nIdModeloRef: nIdModeloRef,
                        cProveedorNombreRef: cProveedorNombreRef,
                        cLineaNombreRef: cLineaNombreRef,
                        cMarcaNombreRef: cMarcaNombreRef,
                        cModeloNombreRef: cModeloNombreRef,
                        nAnioFabricacionRef: nAnioFabricacionRef,
                        nAnioModeloRef: nAnioModeloRef
                    });
                    toastr.success('Se Agregó Referencia Vehiculo');
                }
            },
            encuentraReferenciaVehiculo(nIdProveedorRef, nIdLineaRef, nIdMarcaRef, nIdModeloRef, nAnioFabricacionRef, nAnioModeloRef){
                var sw=0;
                for(var i=0;i<this.arrayReferenciaVehiculo.length;i++){
                    if(this.arrayReferenciaVehiculo[i].nIdProveedorRef==nIdProveedorRef &&
                        this.arrayReferenciaVehiculo[i].nIdLineaRef==nIdLineaRef &&
                        this.arrayReferenciaVehiculo[i].nIdMarcaRef==nIdMarcaRef &&
                        this.arrayReferenciaVehiculo[i].nIdModeloRef==nIdModeloRef &&
                        this.arrayReferenciaVehiculo[i].nAnioFabricacionRef==nAnioFabricacionRef &&
                        this.arrayReferenciaVehiculo[i].nAnioModeloRef==nAnioModeloRef    ){
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
            //Fin Proceso de Asignación
            //Inicio Tabs
            tabDatosPersonales(){
                $('#Tab22').removeClass('nav-link active');
                $('#Tab22').addClass("nav-link disabled");
                $('#Tab33').removeClass('nav-link active');
                $('#Tab33').addClass("nav-link disabled");
                $('#TabDatosContacto').removeClass('in active show');
                $('#TabReferenciaVehiculo').removeClass('in active show');
                $('#Tab11').addClass('nav-link active');
                $('#TabDatosPersonales').addClass('in active show');
            },
            activarTab22(){
                if(this.validarTab22()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                //Cargar tipo de documentos para datos de contacto de la persona juridica
                this.llenarComboTpoDocumentoDatoConctactoJurifico();

                $('#Tab11').removeClass('nav-link active');
                $('#Tab11').addClass("nav-link");
                $('#Tab22').removeClass('nav-link disabled');
                $('#Tab22').addClass("nav-link active");
                $('#TabDatosPersonales').removeClass('in active show');
                $('#TabDatosContacto').addClass('in active show');
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
                    if(!this.formNuevoContacto.capepaterno){
                        this.mensajeError.push('Debes Ingresar Apellido Paterno');
                    };
                    if(!this.formNuevoContacto.capematerno){
                        this.mensajeError.push('Debes Ingresar Apellido Materno');
                    };
                    if(!this.formNuevoContacto.cnombres){
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
                    if(!this.formNuevoContacto.cnombres){
                        this.mensajeError.push('Debes Ingresar Razon Social');
                    };
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
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
                    if(!this.formNuevoContactoJurifico.cnombres){
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
            //Fin Tabs
            //Inicio Registrar Contacto
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
                    cNombre: this.formNuevoContacto.cnombres.toUpperCase().toString(),
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
                    cRazonSocial: this.formNuevoContacto.cnombres.toUpperCase().toString(),
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
                    cNombreContacto: this.formNuevoContactoJurifico.cnombres.toUpperCase().toString(),
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
            //Fin Registrar Contacto
            //Inicio Registrar Referencia Vehículo
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
                        this.limpiarFormularioNuevoContacto();
                        this.tabDatosPersonales();
                    }).catch(error => {
                        console.log(error);
                    });
                }
            },
            //Limpiar TAB Nuevo Contacto
            limpiarFormularioNuevoContacto(){
                //Tab DATOS PERSONALES
                this.formNuevoContacto.ntpodocumento = '',
                this.formNuevoContacto.cnrodocumento = '',
                this.formNuevoContacto.capepaterno = '',
                this.formNuevoContacto.capematerno = '',
                this.formNuevoContacto.cnombres = '',
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
                this.formNuevoContacto.nprofesion = '',
                this.formNuevoContacto.ccentrolaboral = '',
                //Tab DATOS DE CONTACTO - Datos Contacto Jurídico
                this.formNuevoContactoJurifico.ntpodocumento = '',
                this.formNuevoContactoJurifico.cnrodocumento = '',
                this.formNuevoContactoJurifico.capematerno = '',
                this.formNuevoContactoJurifico.capepaterno = '',
                this.formNuevoContactoJurifico.cnombres = '',
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

            // =================================================================
            // METODOS GENERICOS
            // =================================================================
            // Abrir Modales
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case 'proveedor':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.modal = 1;
                                if (data == 1) {
                                    this.accionmodal=2;
                                    this.listarProveedores(1);
                                } else {
                                    this.accionmodal=4;
                                    this.listarProveedoresSC(1);
                                }
                                break;
                            }
                        }
                    }
                    case 'conctacto':
                    {
                        switch(accion){
                            case 'seguirContacto':
                            {
                                // =============================================
                                // Data para realizar seguimiento
                                // =============================================
                                this.fillSeguimientoContacto.tipopersona = data['TipoPersona'];
                                this.fillSeguimientoContacto.dni = data['DNI'];
                                this.fillSeguimientoContacto.contacto = data['Contacto'];
                                this.fillSeguimientoContacto.direccion = data['Direccion'];
                                this.fillSeguimientoContacto.telefono = data['Telefono'];
                                this.fillSeguimientoContacto.email = data['Email'];
                                this.fillSeguimientoContacto.nidcontacto = data['nIdContacto'];

                                this.fillSeguimientoContacto.nombrelinea = data['nombreLinea'];
                                this.fillSeguimientoContacto.nombremarca = data['nombreMarca'];
                                this.fillSeguimientoContacto.nombremodelo = data['nombreModelo'];
                                this.fillSeguimientoContacto.vendedor = data['Vendedor'];
                                this.fillSeguimientoContacto.idasigcontactvendedor = data['codAsigContactVendedor'];
                                this.tabIrAlSeguimiento();
                                break;
                            }
                        }
                    }
                    case 'contactosCPV':
                    {
                        switch(accion){
                            case 'reasignarContacto':
                            {
                                this.accionmodal=3;
                                this.modal = 1;
                                // =============================================
                                // Data para reasignar contacto
                                // =============================================
                                this.fillReasignarContacto.contacto = data['Contacto'];
                                this.fillReasignarContacto.tipopersona = data['TipoPersona'];
                                this.fillReasignarContacto.dni = data['DNI'];
                                this.fillReasignarContacto.nombrelinea = data['nombreLinea'];
                                this.fillReasignarContacto.nombremarca = data['nombreMarca'];
                                this.fillReasignarContacto.nombremodelo = data['nombreModelo'];
                                this.fillReasignarContacto.vendedor = data['Vendedor'];
                                this.fillReasignarContacto.idasigcontactvendedor = data['codAsigContactVendedor'];
                                this.llenarComboVendedores();
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
            //Cerrar ModaL
            cerrarModal(){
                this.modal = 0
                this.error = 0,
                this.mensajeError = ''
            },
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
