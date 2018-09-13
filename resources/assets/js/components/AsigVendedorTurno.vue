<template>
    <main>
        <header class="page-header">
          <div class="container-fluid">
            <h2 class="no-margin-bottom">AGINACIÓN VENDEDOR A TURNO</h2>
          </div>
        </header>

        <section>
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab01" href="#TabBusqueda" @click="tabBusqueda" role="tab" data-toggle="tab">
                                        <i class="fa fa-users"></i> MIS VENDEDORES
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="tab02" href="#TabAsignacion" role="tab" data-toggle="tab">
                                        <i class="fa fa-calendar"></i> ASIGNAR TURNO
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active show" id="TabBusqueda">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="h4">BUSQUEDA</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="form-horizontal">
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Empresa</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="fillFormularioGeneral.cempresa" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Sucursal</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="fillFormularioGeneral.csucursal" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Año</label>
                                                                        <div class="col-sm-8">
                                                                            <label v-text="fillFormularioGeneral.caño" class="form-control-label-readonly"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Mes</label>
                                                                        <div class="col-sm-8">
                                                                            <label v-text="fillFormularioGeneral.cmes" class="form-control-label-readonly"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <label class="col-md-4 form-control-label">Jefe de Ventas</label>
                                                                        <div class="col-md-8">
                                                                            <label v-text="fillFormularioGeneral.cusuarionombre" class="form-control-label-readonly"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6 offset-sm-5">
                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarVendedoresAsignadosJV(1)">
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
                                                        <h3 class="h4">LISTADO MIS VENDEDORES</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="form-horizontal">
                                                            <template v-if="arrayVendedoresByIdJV.length">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Seleccionar</th>
                                                                                <th>Vendedor</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="vendedor in arrayVendedoresByIdJV" :key="vendedor.cParNombre">
                                                                                <td>
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Seleccionar {{ vendedor.cParNombre }}</div>
                                                                                        <i @click="asigarVendedorByJefe(vendedor)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
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
                                                                                    <li v-if="pagination.current_page > 1" class="page-item">
                                                                                        <a @click.prevent="cambiarPaginaVendedoresByJV(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                    </li>
                                                                                    <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                    :class="[page==isActived?'active':'']">
                                                                                        <a class="page-link"
                                                                                        href="#" @click.prevent="cambiarPaginaVendedoresByJV(page)"
                                                                                        v-text="page"></a>
                                                                                    </li>
                                                                                    <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                        <a @click.prevent="cambiarPaginaVendedoresByJV(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="TabAsignacion">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="h4">ASIGNACIÓN</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="form-horizontal">
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Año</label>
                                                                        <div class="col-sm-8">
                                                                            <label v-text="fillFormularioGeneral.caño" class="form-control-label-readonly"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Mes</label>
                                                                        <div class="col-sm-8">
                                                                            <label v-text="fillFormularioGeneral.cmes" class="form-control-label-readonly"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <label class="col-md-4 form-control-label">Jefe de Ventas</label>
                                                                        <div class="col-md-8">
                                                                            <label v-text="fillFormularioGeneral.cusuarionombre" class="form-control-label-readonly"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <label class="col-md-4 form-control-label">Vendedor</label>
                                                                        <div class="col-md-8">
                                                                            <label v-text="fillFormularioGeneral.cvendedornombre" class="form-control-label-readonly"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <label class="col-md-4 form-control-label">Turno</label>
                                                                        <div class="col-md-8">
                                                                            <div class="input-group">
                                                                                <input type="text" v-model="fillFormularioGeneral.cnombreturno" disabled="disabled" class="form-control form-control-sm">
                                                                                <div class="input-group-prepend">
                                                                                    <button type="button" title="Buscar Turno" class="btn btn-info btn-corner btn-sm" @click="abrirModal('turno','buscar')">
                                                                                        <i class="fa-lg fa fa-search"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr/>
                                                            <template v-if="fillFormularioGeneral.cnombreturno" :class="[fillFormularioGeneral.cnombreturno != '' ? 'col-xs-12' : '']">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Seleccionar</th>
                                                                                <th>Turno</th>
                                                                                <th>Hora Inicio</th>
                                                                                <th>Hora Fin</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="turno in arrayTurnoVendedor" :key="turno.cdia">
                                                                                <td>
                                                                                    <label class="checkbox-inline" :key="turno.nIdTurnoVendedor">
                                                                                        <input :id="turno.nIdTurnoVendedor" type="radio" class="radio-template" v-model="fillFormularioGeneral.nidturnovendedor" :value="turno.nIdTurnoVendedor">
                                                                                    </label>
                                                                                </td>
                                                                                <td v-text="turno.cTurno"></td>
                                                                                <td v-text="turno.cHoraInicio"> </td>
                                                                                <td v-text="turno.cHoraFin"> </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </template>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="h4">CALENDARIO</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <template v-if="fillFormularioGeneral.nidturnovendedor">
                                                                    <template v-if="arrayDias.length">
                                                                        <div :class="[arrayDias.length ? 'col-lg-4' : '']">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-6 form-control-label">Fecha Seleccionada</label>
                                                                                        <div class="col-sm-6">
                                                                                            <label v-text="message" class="form-control-label-readonly"></label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <form class="form-horizontal">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table table-striped table-sm">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>Eliminar</th>
                                                                                                        <th>Fecha</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr v-for="(dia, index) in arrayDias" :key="dia.cdia">
                                                                                                        <td>
                                                                                                            <a href="#" @click.prevent="removerDiaLista(index);">
                                                                                                                <i class="fa-md fa fa-times-circle" aria-hidden="true"></i>
                                                                                                            </a>
                                                                                                        </td>
                                                                                                        <td v-text="dia.cdia"></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </template>
                                                                    <div :class="[arrayDias.length ? 'col-lg-8' : 'col-lg-12']">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <form class="form-horizontal">
                                                                                    <calendar-view
                                                                                        :show-date="showDate"
                                                                                        @click-date="onClickDay"
                                                                                        class="theme-default holiday-us-traditional holiday-us-official">
                                                                                        <calendar-view-header
                                                                                                slot="header"
                                                                                                slot-scope="t"
                                                                                                :header-props="t.headerProps"
                                                                                                @input="setShowDate" />
                                                                                    </calendar-view>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <template v-if="arrayDias.length">
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group row">
                                                                                <div class="col-md-9 offset-md-5">
                                                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarVendedorTurno()">
                                                                                        <i class="fa fa-save"></i> Registrar
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </template>
                                                                </template>
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

        <!-- Modal Buscar Turnos -->
        <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form v-on:submit.prevent class="form-horizontal">
                            <div class="container-fluid">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">LISTADO TURNOS</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <template v-if="arrayTurno.length">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>Seleccione</th>
                                                                    <th>Nombre Turno</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="turno in arrayTurno" :key="turno.nIdPar">
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
    import { CalendarView, CalendarViewHeader } from "vue-simple-calendar"
    export default {
        props:['ruta', 'usuario'],
        data(){
            return {
                fillFormularioGeneral: {
                    nidempresa: 1300011,
                    cempresa: 'SAISAC',
                    nidsucursal: 1300013,
                    csucursal: 'CHICLAYO',
                    nidcronograma: 0,
                    caño: '',
                    cmes: '',
                    nidusuario: '',
                    cusuarionombre: '',
                    nidturno: 0,
                    cnombreturno: '',
                    nidturnovendedor: 0,
                    nidvendedor: 0,
                    cvendedornombre: ''
                },
                arrayVendedoresByIdJV: [],
                arrayTurno: [],
                arrayTurnoVendedor: [],
                showDate: new Date(),
                message: '',
                arrayDiasSeleccionados: [],
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
        components: {
			CalendarView,
			CalendarViewHeader,
		},
        mounted(){
            this.llenarVentaActiva();
            this.informacionUsuario();
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
            arrayDias: function(){
                let me = this;
                return me.arrayDiasSeleccionados.sort(function(a, b){
                    var diaA, diaB;
                    diaA = a.cdia.split('-');
                    diaB = b.cdia.split('-');
                    // '2018-10-02'.split('-')
                    // gives ["2018", "10", "02"]
                    return parseInt(diaA[0]) - parseInt(diaB[0]) || parseInt(diaA[1]) - parseInt(diaB[1]) || parseInt(diaA[2]) - parseInt(diaB[2]);
                });
            },
        },
        methods: {
            tabBusqueda(){
                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass('nav-link active');
                $('#tab02').removeClass('nav-link active');
                $('#tab02').addClass('nav-link disabled');

                $('#TabBusqueda').addClass("in active show");
                $('#TabAsignacion').removeClass('in active show');
            },
            // ==============================================
            // TAB BUSQUEDA
            // ==============================================
            llenarVentaActiva(){
                var url = this.ruta + '/objComercial/getVentaActiva';
                axios.get(url).then(response => {
                    this.fillFormularioGeneral.caño = response.data[0].cAnio;
                    this.fillFormularioGeneral.cmes = response.data[0].cMes;
                    this.fillFormularioGeneral.nidcronograma = response.data[0].nIdCronograma;
                }).catch(error => {
                    console.log(error);
                });
            },
            informacionUsuario(){
                var url = this.ruta + '/asigVendedorTurno/GetParametroById';
                axios.get(url, {
                    params: {
                        'nidpar' : this.usuario.id
                    }
                }).then(response => {
                    this.fillFormularioGeneral.nidusuario = response.data[0].nIdPar;
                    this.fillFormularioGeneral.cusuarionombre = response.data[0].cParNombre;
                }).catch(error => {
                    console.log(error);
                });
            },
            buscarVendedoresAsignadosJV(page){
                if(this.validarBuscarVendedoresByJV()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                var url = this.ruta + '/asigVendedorTurno/GetParametroByParParent';
                axios.get(url, {
                    params: {
                        'nidpar' : this.fillFormularioGeneral.nidusuario,
                        'nidgrupar' : 110026,
                        'page' : page
                    }
                }).then(response => {
                    let info = response.data.arrayVendedoresByIdJV;
                    //Data
                    this.arrayVendedoresByIdJV = info.data;
                    //Pagination
                    this.pagination.current_page   =   info.current_page;
                    this.pagination.total          =   info.total;
                    this.pagination.per_page       =   info.per_page;
                    this.pagination.last_page      =   info.last_page;
                    this.pagination.from           =   info.from;
                    this.pagination.to             =   info.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            validarBuscarVendedoresByJV(){
                this.error = 0;
                this.mensajeError =[];

                if(this.fillFormularioGeneral.nidusuario == 0){
                    this.mensajeError.push('Debe ser Jefe de Ventas para realizar la busqueda');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            cambiarPaginaVendedoresByJV(page){
                this.paginationModal.current_page=page;
                this.buscarVendedoresAsignadosJV(page);
            },
            asigarVendedorByJefe(vendedor){
                this.fillFormularioGeneral.nidvendedor = vendedor.nIdPar;
                this.fillFormularioGeneral.cvendedornombre = vendedor.cParNombre;
                this.fillFormularioGeneral.nidturno = 0;
                this.fillFormularioGeneral.cnombreturno = '';
                this.arrayDiasSeleccionados = [];
                this.tabAsignacion();
            },
            tabAsignacion(){
                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass('nav-link');
                $('#tab02').removeClass('nav-link disabled');
                $('#tab02').addClass('nav-link active');

                $('#TabBusqueda').removeClass("in active show");
                $('#TabAsignacion').addClass('in active show');
            },
            // ==============================================
            // TAB ASIGNACIÓN
            // ==============================================
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
                        'ngrupoparid' : 110060,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayTurno = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            asignarTurno(turno){
                this.fillFormularioGeneral.nidturno = turno.nIdPar;
                this.fillFormularioGeneral.cnombreturno = turno.cParNombre;
                this.fillFormularioGeneral.nidturnovendedor = 0;
                this.arrayDiasSeleccionados = [];
                this.llenarTurnoVendedor(turno.nIdPar);
                this.cerrarModal();
            },
            llenarTurnoVendedor(turno){
                var url = this.ruta + '/asigVendedorTurno/GeLstDetalleTurno';
                axios.get(url, {
                    params: {
                        'nidturno' : turno,
                    }
                }).then(response => {
                    this.arrayTurnoVendedor = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            setShowDate(d) {
				this.showDate = d;
            },
            onClickDay(d) {
                this.message = moment(d).format('DD/MM/YYYY');
                this.agregarDiasAlVendedor(moment(d).format('YYYY-MM-DD'));
            },
            agregarDiasAlVendedor(fecha){
                if(this.encontrarDiaRepetido(fecha)){
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'El día seleccionado ya se encuentra agregado!',
                    })
                } else {
                    this.arrayDiasSeleccionados.push({
                        cdia : fecha
                    })
                    toastr.success('Se Agregó Fecha"'+ fecha +'" ');
                }
            },
            encontrarDiaRepetido(fecha){
                var sw=0;
                this.arrayDiasSeleccionados.map(function (x) {
                    if(x.cdia == fecha){
                        sw = true;
                    }
                });
                return sw;
            },
            removerDiaLista(index){
                this.$delete(this.arrayDiasSeleccionados, index);
            },
            registrarVendedorTurno(){
                if(this.validarRegistrarVendedorTurno()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.mostrarProgressBar();
                var url = this.ruta + '/asigVendedorTurno/SetRegistrarVendedorTurno';
                axios.post(url, {
                    nidempresa : this.fillFormularioGeneral.nidempresa,
                    nidsucursal : this.fillFormularioGeneral.nidsucursal,
                    nidcronograma : this.fillFormularioGeneral.nidcronograma,
                    nidvendedor : this.fillFormularioGeneral.nidvendedor,
                    nidturnovendedor : this.fillFormularioGeneral.nidturnovendedor,
                    arrayData : this.arrayDias
                }).then(response => {
                    $("#myBar").hide();
                    this.limpiarProceso();
                    swal({
                        type: 'success',
                        title: 'Correcto...',
                        text: 'Asigno correctamente los turnos al vendedor!',
                    })
                }).catch(error => {
                    console.log(error);
                });
            },
            validarRegistrarVendedorTurno(){
                this.error = 0;
                this.mensajeError =[];
                if(!this.fillFormularioGeneral.cusuarionombre && this.fillFormularioGeneral.nidusuario == 0){
                    this.mensajeError.push('No existe Jefe de Ventas');
                }
                if(!this.fillFormularioGeneral.cvendedornombre && this.fillFormularioGeneral.nidvendedor == 0){
                    this.mensajeError.push('No existe Vendedor Asignado');
                }
                if(!this.fillFormularioGeneral.cnombreturno && this.fillFormularioGeneral.nidturno == 0){
                    this.mensajeError.push('Debe seleccionar un Turno');
                }
                if(this.fillFormularioGeneral.nidturnovendedor == 0){
                    this.mensajeError.push('Debe seleccionar un Turno del Vendedor');
                }
                if(this.arrayDias.length == 0){
                    this.mensajeError.push('No hay fechas agregadas, debe seleccionar una fecha al menos');
                }
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            limpiarProceso(){
                this.fillFormularioGeneral.nidturno = 0;
                this.fillFormularioGeneral.cnombreturno = '';
                this.fillFormularioGeneral.nidturnovendedor = 0;
                this.arrayTurnoVendedor = [];
                this.arrayDiasSeleccionados = [];
            },
            // =================================================================
            // METODOS GENERICOS
            // =================================================================
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "turno":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=2;
                                this.modal = 1;
                                this.listarTurnos(1);
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
</style>
