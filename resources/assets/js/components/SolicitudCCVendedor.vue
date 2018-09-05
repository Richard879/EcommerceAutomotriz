<template>
    <main>
        <header class="page-header">
          <div class="container-fluid">
            <h2 class="no-margin-bottom"> CARTA DE CARTERÍSTICA</h2>
          </div>
        </header>

        <section class="forms">
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab01" href="#TabRegistrarSCC" @click="tabNuevaSCC" role="tab" data-toggle="tab">
                                        <i class="fa fa-list"></i> NUEVA SCC
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="tab02" href="#TabAprobacion" role="tab" data-toggle="tab">
                                        <i class="fa fa-list-ol"></i> APROBACIÓN SCC
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active show" id="TabRegistrarSCC">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="h4">NUEVA SCC.</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="form-horizontal">
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* N° Carta</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="number" min="1" v-model="fillCartaCaracteristica.cnumcarta" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <el-input placeholder="Atendió" v-model="fillCartaCaracteristica.catencion" class="input-with-select col-sm-12">
                                                                            <el-select v-model="fillCartaCaracteristica.nidref" slot="prepend" placeholder="Ref">
                                                                                <el-option v-for="referencia in arrayReferencia" :key="referencia.nIdPar" :label="referencia.cParNombre" :value="referencia.nIdPar"></el-option>
                                                                            </el-select>
                                                                        </el-input>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">*Fecha Inicio</label>
                                                                        <div class="col-sm-8">
                                                                            <el-date-picker
                                                                                v-model="fillCartaCaracteristica.dfechainicio"
                                                                                value-format="yyyy-MM-dd"
                                                                                format="dd-MM-yyyy"
                                                                                type="date"
                                                                                placeholder="Seleccionar fecha de inicio">
                                                                            </el-date-picker>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">*Fecha Fin</label>
                                                                        <div class="col-sm-8">
                                                                            <el-date-picker
                                                                                v-model="fillCartaCaracteristica.dfechafin"
                                                                                value-format="yyyy-MM-dd"
                                                                                format="yyyy/MM/dd"
                                                                                type="date"
                                                                                placeholder="Seleccionar fecha de fin">
                                                                            </el-date-picker>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* VIN</label>
                                                                        <div class="col-sm-8">
                                                                            <div class="input-group">
                                                                                <input type="text" v-model="fillCartaCaracteristica.cnumerovin" disabled="disabled" class="form-control form-control-sm">
                                                                                <div class="input-group-prepend">
                                                                                    <button type="button" title="Buscar VIN" class="btn btn-info btn-corner btn-sm" @click="abrirModal('compra','buscar')">
                                                                                        <i class="fa-lg fa fa-search"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Cotización</label>
                                                                        <div class="col-sm-8">
                                                                            <div class="input-group">
                                                                                <input type="text" v-model="fillCartaCaracteristica.cnombrecontacto" disabled="disabled" class="form-control form-control-sm">
                                                                                <div class="input-group-prepend">
                                                                                    <button type="button" title="Buscar Contacto" class="btn btn-info btn-corner btn-sm" @click="abrirModal('contacto','buscar')">
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
                                                                        <label class="col-sm-4 form-control-label">* Precio Final Dolar</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="number" min="1" v-model="fillCartaCaracteristica.fpreciodolar" class="form-control form-control-sm">
                                                                        </div>
                                                                        <label class="col-sm-4 form-control-label">* Cuota Inicial</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="number" min="1" v-model="fillCartaCaracteristica.fcuotainicial" class="form-control form-control-sm">
                                                                        </div>
                                                                        <label class="col-sm-4 form-control-label">* Monto a Desembolsar</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="number" min="1" v-model="fillCartaCaracteristica.fmontodesembolar" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <label class="col-md-4 form-control-label">*Banco</label>
                                                                        <div class="col-md-8 widthFull">
                                                                            <el-select v-model="fillCartaCaracteristica.nidbanco"
                                                                                    filterable
                                                                                    clearable
                                                                                    loading-text
                                                                                    placeholder="Seleccione un banco">
                                                                                <el-option
                                                                                    v-for="banco in arrayBanco"
                                                                                    :key="banco.nIdPar"
                                                                                    :label="banco.cParNombre"
                                                                                    :value="banco.nIdPar">
                                                                                </el-option>
                                                                            </el-select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-9 offset-md-5">
                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="registrarSCC">
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
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="TabAprobacion">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
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

        <!-- Modal Buscar Compras -->
        <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form v-on:submit.prevent class="form-horizontal">
                            <div class="container-fluid">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">LISTADO COMPRAS</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Nombre</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <input type="text" v-model="fillVIN.cvin" @keyup.enter="buscaCompra()" class="form-control form-control-sm">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" title="Buscar Compra" class="btn btn-info btn-corner btn-sm" @click="buscaCompra();">
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
                                                <template v-if="arrayCompra.length">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>Seleccione</th>
                                                                    <th>VIN</th>
                                                                    <th>Nombre Comercial</th>
                                                                    <th>Año / Mes</th>
                                                                    <th>Linea</th>
                                                                    <th>Forma de Pago</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="vin in arrayCompra" :key="vin.nIdCompra">
                                                                    <td>
                                                                        <a href="#" @click="asignarCompra(vin);">
                                                                            <i class='fa-md fa fa-check-circle'></i>
                                                                        </a>
                                                                    </td>
                                                                    <td v-text="vin.cNumeroVin"></td>
                                                                    <td v-text="vin.cNombreComercial"></td>
                                                                    <td> {{ vin.cAnio }} / {{ vin.cMes }} </td>
                                                                    <td v-text="vin.cNombreLinea"></td>
                                                                    <td v-text="vin.cFormaPago"></td>
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
                                                                            <a @click.prevent="cambiarPaginaCompra(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                        </li>
                                                                        <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                        :class="[page==isActivedModal?'active':'']">
                                                                            <a class="page-link"
                                                                            href="#" @click.prevent="cambiarPaginaCompra(page)"
                                                                            v-text="page"></a>
                                                                        </li>
                                                                        <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                            <a @click.prevent="cambiarPaginaCompra(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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

        <!-- Modal Buscar Contactos -->
        <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form v-on:submit.prevent class="form-horizontal">
                            <div class="container-fluid">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">BUSQUEDA CONTACTOS</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-lg-12">
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
                                                                    <input type="text" v-model="fillMisContactos.cnrodocumento" @keyup.enter="listarContactos(1)" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <label class="col-sm-4 form-control-label">* Nombres</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" v-model="fillMisContactos.cfiltrodescripcion" @keyup.enter="listarContactos(1)" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-9 offset-sm-5">
                                                            <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarContactos(1);">
                                                                <i class="fa fa-search"></i> Buscar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-lg-12">
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
                                                                        <td v-text="c.cNombres"></td>
                                                                        <td v-text="c.cNumeroDocumento"></td>
                                                                        <td v-text="c.nTelefonoMovil"></td>
                                                                        <td v-text="c.cDireccion"></td>
                                                                        <td v-text="c.cEmail"></td>
                                                                        <td v-text="c.cVendedor"></td>
                                                                        <td>
                                                                            <a href="#" @click="asignarContacto(c)" data-toggle="tooltip">
                                                                                <i class="fa-md fa fa-suitcase"></i>
                                                                            </a>
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
                                                                            <a href="#" @click="asignarContacto(c)" data-toggle="tooltip">
                                                                                <i class="fa-md fa fa-suitcase"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </template>
                                                        </table>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="col-lg-7">
                                                                <nav>
                                                                    <ul class="pagination">
                                                                        <li v-if="paginationModal.current_page > 1" class="page-item">
                                                                            <a @click.prevent="cambiarPaginaMisContactos(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                        </li>
                                                                        <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                        :class="[page==isActivedModal?'active':'']">
                                                                            <a class="page-link"
                                                                            href="#" @click.prevent="cambiarPaginaMisContactos(page)"
                                                                            v-text="page"></a>
                                                                        </li>
                                                                        <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                            <a @click.prevent="cambiarPaginaMisContactos(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                // VARIABLES TAB NUEVO SCC
                // =============================================================
                fillCartaCaracteristica: {
                    cnumcarta: 1,
                    nidref: 0,
                    catencion: '',
                    dfechainicio: '',
                    dfechafin: '',
                    nidcompra: 0,
                    cnumerovin: '',
                    nidcontacto: 0,
                    cnombrecontacto: '',
                    fpreciodolar: 1,
                    fcuotainicial: 1,
                    fmontodesembolar: 1,
                    nidbanco: 0
                },
                arrayReferencia: [],
                fillVIN:{
                    cvin: ''
                },
                arrayCompra: [],
                fillMisContactos:{
                    ntipopersona: 1,
                    cnrodocumento: '',
                    cfiltrodescripcion: '',
                },
                arrayTipoPersona: [
                    { value: '1', text: 'NATURAL'},
                    { value: '2', text: 'JURIDICA'}
                ],
                arrayContacto: [],
                arrayBanco: [],
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
        mounted() {
            this.llenarBancos();
            this.llenarReferencias();
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
            tabNuevaSCC(){},
            llenarBancos(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110042,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayBanco = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarReferencias(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110072,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayReferencia = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            // ======================
            // MODAL BUSCAR COMPRAS
            // ======================
            buscaCompra(){
                this.listarCompra(1);
            },
            listarCompra(page){
                var url = this.ruta + '/solicitudCartaCaracteristica/GeLstCompras';

                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidsucursal' : 1300013,
                        'cnumberovin' : this.fillVIN.cvin.toString(),
                        'page' : page
                    }
                }).then(response => {
                    let info = response.data.arrayCompra;
                    this.arrayCompra = info.data;
                    this.paginationModal.current_page   = info.current_page;
                    this.paginationModal.total          = info.total;
                    this.paginationModal.per_page       = info.per_page;
                    this.paginationModal.last_page      = info.last_page;
                    this.paginationModal.from           = info.from;
                    this.paginationModal.to             = info.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaCompra(page){
                this.paginationModal.current_page=page;
                this.listarCompra(page);
            },
            asignarCompra(compra){
                this.fillCartaCaracteristica.nidcompra = compra.nIdCompra;
                this.fillCartaCaracteristica.cnumerovin = compra.cNumeroVin;
                this.cerrarModal();
            },
            // ======================
            // MODAL BUSCAR CONTACTOS
            // ======================
            cambiarTipoPersonaMisContactos(){
                this.arrayContacto = [];
            },
            cambiarPaginaMisContactos(page){
                this.paginationModal.current_page=page;
                this.listarContactos(page);
            },
            listarContactos(page){
                var url = this.ruta + '/solicitudCartaCaracteristica/GetListContactos';
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
                    let info = response.data.arrayContacto;
                    this.arrayContacto                = info.data;
                    this.paginationModal.current_page =  info.current_page;
                    this.paginationModal.total        = info.total;
                    this.paginationModal.per_page     = info.per_page;
                    this.paginationModal.last_page    = info.last_page;
                    this.paginationModal.from         = info.from;
                    this.paginationModal.to           = info.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            asignarContacto(contacto){
                if(this.fillMisContactos.ntipopersona == 1){
                    this.fillCartaCaracteristica.nidcontacto = contacto.nIdContacto;
                    this.fillCartaCaracteristica.cnombrecontacto = contacto.cNombres;
                } else {
                    this.fillCartaCaracteristica.nidcontacto = contacto.nIdContacto;
                    this.fillCartaCaracteristica.cnombrecontacto = contacto.cContacto;
                }
                this.fillMisContactos.ntipopersona = 1;
                this.fillMisContactos.cnrodocumento = '';
                this.fillMisContactos.cfiltrodescripcion = '';
                this.cerrarModal();
            },
            // ======================
            // FORMULARIO - REGISTRAR SCC
            // ======================
            registrarSCC(){
                if(this.validarRegistrarSCC()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                var url = this.ruta + '/solicitudCartaCaracteristica/SetRegistrarSCC';
                axios.post(url, {
                    'cNumeroCarta'          :   this.fillCartaCaracteristica.cnumcarta,
                    'cAtencion'             :   this.fillCartaCaracteristica.catencion,
                    'nIdRef'                :   this.fillCartaCaracteristica.nidref,
                    'dFechaInicio'          :   this.fillCartaCaracteristica.dfechainicio,
                    'dFechaVencimiento'     :   this.fillCartaCaracteristica.dfechafin,
                    'nIdCompra'             :   this.fillCartaCaracteristica.nidcompra,
                    'nIdContacto'           :   this.fillCartaCaracteristica.nidcontacto,
                    'fPrecioFinalDolar'     :   this.fillCartaCaracteristica.fpreciodolar,
                    'fCuotaInicial'         :   this.fillCartaCaracteristica.fcuotainicial,
                    'fMontoDesembolsado'    :   this.fillCartaCaracteristica.fmontodesembolar,
                    'nIdBanco'              :   this.fillCartaCaracteristica.nidbanco,
                    'nIdEstadoCarta'        :   1300194,
                    'FlagEstadoApro'        :   'PE'
                }).then(response => {
                    swal('Solicitud Carta de Caracteristica registrada exitosamente');
                    this.limpiarProceso();
                }).catch(error => {
                    this.errors = error
                });
            },
            validarRegistrarSCC(){
                this.error = 0;
                this.mensajeError =[];

                if(this.fillCartaCaracteristica.cnumcarta <= 0){
                    this.mensajeError.push('El número de carta debe ser mayor a 0');
                }
                if(!this.fillCartaCaracteristica.cnumcarta){
                    this.mensajeError.push('El número de carta es obligatorio');
                }
                if(this.fillCartaCaracteristica.nidref == 0){
                    this.mensajeError.push('Debe seleccionar una referencia');
                }
                if(!this.fillCartaCaracteristica.catencion){
                    this.mensajeError.push('El nombre de la persona que se atendió es obligatorio');
                }
                let fecha_ini = moment(this.fillCartaCaracteristica.dfechainicio);
                let fecha_fin = moment(this.fillCartaCaracteristica.dfechafin);

                if(fecha_fin.diff(fecha_ini, 'days') < 0){
                    this.mensajeError.push('La Fecha de Fin no puede ser menor a la fecha de inicio');
                }
                if(!this.fillCartaCaracteristica.dfechainicio){
                    this.mensajeError.push('Debe seleccionar una fecha de inicio');
                }
                if(!this.fillCartaCaracteristica.dfechafin){
                    this.mensajeError.push('Debe seleccionar una fecha de fin');
                }
                if(this.fillCartaCaracteristica.nidcompra == 0 && !this.fillCartaCaracteristica.cnumerovin){
                    this.mensajeError.push('Debe seleccionar un VIN');
                }
                if(this.fillCartaCaracteristica.nidcontacto == 0 && !this.fillCartaCaracteristica.cnombrecontacto){
                    this.mensajeError.push('Debe seleccionar un Contacto');
                }
                if(this.fillCartaCaracteristica.fpreciodolar <= 0){
                    this.mensajeError.push('El precio del dolar no puede ser menor a 0');
                }
                if(this.fillCartaCaracteristica.fcuotainicial <= 0){
                    this.mensajeError.push('La cuota inicial no puede ser menor a 0');
                }
                if(this.fillCartaCaracteristica.fmontodesembolar <= 0){
                    this.mensajeError.push('El monto a desembolar no puede ser menor a 0');
                }
                if(this.fillCartaCaracteristica.nidbanco == 0){
                    this.mensajeError.push('Debe seleccionar un Banco');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            limpiarProceso(){
                this.fillCartaCaracteristica.cnumcarta = 1;
                this.fillCartaCaracteristica.catencion = '';
                this.fillCartaCaracteristica.nidref = 0;
                this.fillCartaCaracteristica.dfechainicio = '';
                this.fillCartaCaracteristica.dfechafin = '';
                this.fillCartaCaracteristica.nidcompra = 0;
                this.fillCartaCaracteristica.cnumerovin = '';
                this.fillCartaCaracteristica.nidcontacto = 0;
                this.fillCartaCaracteristica.cnombrecontacto = '';
                this.fillCartaCaracteristica.fpreciodolar = 1;
                this.fillCartaCaracteristica.fcuotainicial = 1;
                this.fillCartaCaracteristica.fmontodesembolar = 1;
                this.fillCartaCaracteristica.nidbanco = 0;
            },
            // =================================================================
            // METODOS GENERICOS
            // =================================================================
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "compra":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=2;
                                this.modal = 1;
                                this.listarCompra(1);
                                break;
                            }
                        }
                    }
                    break;
                    case "contacto":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=3;
                                this.modal = 1;
                                this.listarContactos(1);
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
            //Cerrar Modal
            cerrarModal(){
                this.modal = 0;
                this.accionmodal = 0;
                this.error = 0;
                this.mensajeError = '';
                this.limpiarPaginacion();
                this.limpiarPaginacionModal();
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
        text-align: center;
        margin: auto;
    }
    .el-select {
        width: 100%;
    }
    .el-select .el-input {
        width: 120px;
    }
    .input-with-select .el-input-group__prepend {
        background-color: #fff;
    }
    .widthFull>.el-select>.el-input {
        width: 100%;
    }
    .el-date-editor.el-input, .el-date-editor.el-input__inner{
        width: 100%;
    }
</style>


