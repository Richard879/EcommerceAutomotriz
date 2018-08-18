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
                                            <!-- <div class="col-lg-12">
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
                                            </div> -->
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
                                                                            <select></select>
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
                                                                        <td v-text="contactos.cPerApellidos"></td>
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
                fillAsignarContacto:{
                    ccontacto: '',
                    cnrodocumento: '',
                    cdireccion: '',
                    cemail: ''
                },
                arrayReferencia: [],
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
                var url = this.ruta + '/gescontacto/GetContactoByVendedor';
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
                    let info = response.data.arrayContacto;
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
            // METODOS GENERICOS
            // =================================================================
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case 'contacto':
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
                    case 'contacto':
                    {
                        switch(accion){
                            case 'asignar':
                            {
                                console.log(data);
                                (this.fillBusqContacto.ntipopersona) == 1 ? this.fillAsignarContacto.ccontacto = data['cPerApellidos'] : this.fillAsignarContacto.ccontacto = data['cContacto'];
                                // this.fillAsignarContacto.ccontacto = data['cPerApellidos'];
                                this.fillAsignarContacto.cnrodocumento = data['cNumeroDocumento'];
                                this.fillAsignarContacto.cdireccion = data['cDireccion'];
                                this.fillAsignarContacto.cemail = data['cEmail'];
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


