<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">ENTREGA DE VEHÍCULO</h2>
                </div>
            </header>

            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tab01" href="#TabMisEntregaVehiculos" role="tab" @click.prevent="tabMisEntregaVehiculos" data-toggle="tab">
                                            <i class="fa fa-search"></i> MIS VEHÍCULOS
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab02" href="#TaEntregaVehiculo" role="tab" data-toggle="tab">
                                            <i class="fa fa-list-alt"></i> ENTREGAR VEHÍCULO
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active show" id="TabMisEntregaVehiculos">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">BUSCAR VEHÍCULOS.</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <div class="form-group row">
                                                                    <div class="col-md-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Placa</label>
                                                                            <div class="col-md-8 widthFull">
                                                                                <div class="input-group">
                                                                                    <el-input placeholder="Buscar Placa" v-model="fillBusquedaVehiculo.cnrovehiculo" :disabled="true" class="input-with-select" :clearable="true">
                                                                                        <el-button slot="append" icon="el-icon-search" @click="abrirModal('vehiculo','buscar', 1)"></el-button>
                                                                                    </el-input>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Fecha Inspección</label>
                                                                            <div class="col-sm-8">
                                                                                <el-date-picker
                                                                                    v-model="fillBusquedaVehiculo.dfechaInseccion"
                                                                                    type="date"
                                                                                    value-format="yyyy-MM-dd"
                                                                                    format="dd/MM/yyyy"
                                                                                    placeholder="dd/mm/aaaa">
                                                                                </el-date-picker>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="row">
                                                                            <label class="col-md-4 form-control-label">*Estado</label>
                                                                            <div class="col-md-8 widthFull">
                                                                                <el-select v-model="fillBusquedaVehiculo.nidestado"
                                                                                        filterable
                                                                                        clearable
                                                                                        loading-text
                                                                                        placeholder="Seleccione un Estado">
                                                                                    <el-option
                                                                                        v-for="estado in arrayEstado"
                                                                                        :key="estado.nIdPar"
                                                                                        :label="estado.cParNombre"
                                                                                        :value="estado.nIdPar">
                                                                                    </el-option>
                                                                                </el-select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-9 offset-md-5">
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="buscarMisSolicitudesEntregaVehiculo(1)">
                                                                            <i class="fa fa-search"></i> Buscar
                                                                        </button>
                                                                        <button type="button" class="btn btn-default btn-corner btn-sm" @click.prevent="limpiarMisSolicitudesEntregaVehiculo()">
                                                                            <i class="fa fa-recycle"></i> Limpiar
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
                                    <div role="tabpanel" class="tab-pane fade in active show" id="TaEntregaVehiculo">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">ENTREGAR VEHÍCULO.</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                            </form>
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

            <!-- Modal Buscar Vehiculos -->
            <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form v-on:submit.prevent class="form-horizontal">
                                <div class="container-fluid">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="h4">BUSQUEDA VEHICULO POR {{ (fillBusquedaSolicitud.nidtipobusqueda == 1) ? 'VIN' : 'PLACA' }} </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <label class="col-sm-4 form-control-label">Nombre</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group">
                                                                        <input type="text" v-model="modalVehiculo.cnrovehiculo" @keyup.enter="listarVehiculo(1)" class="form-control form-control-sm">
                                                                        <div class="input-group-prepend">
                                                                            <button type="button" title="Buscar Vehiculos" class="btn btn-info btn-corner btn-sm" @click="listarVehiculo(1);">
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
                                                    <template v-if="arrayVehiculosByCriterio.length">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-sm">
                                                                <template v-if="fillBusquedaSolicitud.nidtipobusqueda == 1">
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
                                                                        <tr v-for="vehiculo in arrayVehiculosByCriterio" :key="vehiculo.cNumeroVin">
                                                                            <td>
                                                                                <a href="#" @click="asignarVehiculo(vehiculo)" data-toggle="tooltip">
                                                                                    <i class='fa-md fa fa-check-circle'></i>
                                                                                </a>
                                                                            </td>
                                                                            <td v-text="vehiculo.cNumeroVin"></td>
                                                                            <td v-text="vehiculo.cNombreComercial"></td>
                                                                            <td> {{ vehiculo.cAnio }} / {{ vehiculo.cMes }} </td>
                                                                            <td v-text="vehiculo.cNombreLinea"></td>
                                                                            <td v-text="vehiculo.cFormaPago"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </template>
                                                                <template v-else>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Seleccione</th>
                                                                            <th>Placa</th>
                                                                            <th>Nombre Comercial</th>
                                                                            <th>Año / Mes</th>
                                                                            <th>Linea</th>
                                                                            <th>Forma de Pago</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr v-for="vehiculo in arrayVehiculosByCriterio" :key="vehiculo.cPlaca">
                                                                            <td>
                                                                                <a href="#" @click="asignarVehiculo(vehiculo)" data-toggle="tooltip">
                                                                                    <i class='fa-md fa fa-check-circle'></i>
                                                                                </a>
                                                                            </td>
                                                                            <td v-text="vehiculo.cPlaca"></td>
                                                                            <td v-text="vehiculo.cNombreComercial"></td>
                                                                            <td> {{ vehiculo.cAnio }} / {{ vehiculo.cMes }} </td>
                                                                            <td v-text="vehiculo.cNombreLinea"></td>
                                                                            <td v-text="vehiculo.cFormaPago"></td>
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
                                                                                <a @click.prevent="cambiarPaginaVehiculosByCriterio(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                            </li>
                                                                            <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                            :class="[page==isActivedModal?'active':'']">
                                                                                <a class="page-link"
                                                                                href="#" @click.prevent="cambiarPaginaVehiculosByCriterio(page)"
                                                                                v-text="page"></a>
                                                                            </li>
                                                                            <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaVehiculosByCriterio(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModalSolicitud()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </transition>
</template>

<script>
    export default {
        props:['ruta', 'usuario'],
        data(){
            return {
                // =============================================================
                // VARIABLES MIS VEHÍCULOS
                // =============================================================
                fillBusquedaVehiculo: {
                    nidtipobusqueda: '1',
                    nidvehiculo: '',
                    cnrovehiculo: '',
                    dfechaInseccion: '',
                    nidestado: ''
                },
                arrayTipoBusquedaVehiculo: [
                    { value: '1', text: 'VIN'},
                    { value: '2', text: 'PLACA'}
                ],
                arrayEstado: [],
                arrayMisVehiculos : [],
                flagBuscarVehiculoByCriterio: 0,
                // ===============================
                // VARIABLES MODAL VEHICULO
                // ===============================
                modalVehiculo: {
                    cnrovehiculo: '',
                },
                arrayVehiculosByCriterio: [],
                // =============================================================
                // VARIABLES GENÉRICAS
                // =============================================================
                flagBuscarContacto: 0,
                flagBuscarVehiculoByCriterio: 0,
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
            this.tabMisEntregaVehiculos();
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
            tabMisEntregaVehiculos(){
                this.llenarEstados();
            },
            llenarEstados(){
                var url = this.ruta + '/getComision/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110092,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayEstado = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            // ======================
            // MODAL BUSCAR VEHICULO
            // ======================
            cambiarVehiculoByCriterio(){
                if (this.flagBuscarVehiculoByCriterio == 1) {
                    this.fillBusquedaVehiculo.nidvehiculo = '';
                    this.fillBusquedaVehiculo.cnrovehiculo = '';
                }
            },
            cambiarPaginaVehiculosByCriterio(page){
                this.paginationModal.current_page=page;
                this.listarVehiculo(page);
            },
            listarVehiculo(page){
                var url = this.ruta + '/autorizacion/GetLstVehiculosByCriterio';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidsucursal' : 1300013,
                        'cnrovehiculo' : this.modalVehiculo.cnrovehiculo.toString(),
                        'criterio': this.fillBusquedaVehiculo.nidtipobusqueda,
                        'page' : page,
                    }
                }).then(response => {
                    let info = response.data.arrayVehiculosByCriterio;
                    this.arrayVehiculosByCriterio     = info.data;
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
            asignarVehiculo(vehiculo){
                if(this.fillBusquedaVehiculo.nidtipobusqueda == 1){
                    this.fillBusquedaVehiculo.nidvehiculo = vehiculo.nIdCompra;
                    this.fillBusquedaVehiculo.cnrovehiculo = vehiculo.cNumeroVin;
                } else {
                    this.fillBusquedaVehiculo.nidvehiculo = vehiculo.nIdVehiculoPlaca;
                    this.fillBusquedaVehiculo.cnrovehiculo = vehiculo.cPlaca;
                }
                this.modalVehiculo.cnrovehiculo = '';
                this.cerrarModalSolicitud();
            },
            buscarMisSolicitudesEntregaVehiculo(){

            },
            limpiarMisSolicitudesEntregaVehiculo(){

            },
            // =================================================================
            // METODOS GENERICOS
            // =================================================================
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "vehiculo":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.flagBuscarVehiculoByCriterio = data;
                                this.listarVehiculo(1);
                                this.accionmodal=2;
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
            },
            cerrarModalSolicitud(){
                this.modal = 0;
                this.accionmodal = 0;
                this.error = 0;
                this.mensajeError = '';
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
    .el-select {
        width: 100%;
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
    .el-input-number{
        width: 100% !important;
    }
    /* Estilos Modal */
    .menosPadding{
        padding: .31rem;
    }
    .subCabecera{
        justify-content: center;
        padding: 1rem;
        background: white;
    }
    .subCabecera>h3{
        color: black;
        font-size: 1rem;
        font-weight: bolder;
    }
    .flexRigth{
        display: flex;
        justify-content: center;
        align-items: flex-end;
        align-content: flex-end;
    }
    .flexLeft{
        width: 100%;
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
        align-content: flex-start;
    }
    .flexLeft>h4{
        font-weight: bolder;
    }
    .el-row{
        display: flex;
        justify-content: space-between;
        align-content: space-around;
    }
    .disabled{
        opacity: 0.65;
        cursor: not-allowed;
        pointer-events:none;
    }
</style>

