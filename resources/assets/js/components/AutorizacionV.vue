<template>
    <main>
        <header class="page-header">
          <div class="container-fluid">
            <h2 class="no-margin-bottom"> AUOTIZACIÓN</h2>
          </div>
        </header>

        <section class="forms">
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab01" href="#TabMisSolicitudes" role="tab" data-toggle="tab">
                                        <i class="fa fa-search"></i> MIS SOLICITUDES
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab02" href="#TabNuevaSolicitud" @click.prevent="tabNuevaSolicitud" role="tab" data-toggle="tab">
                                        <i class="fa fa-list-alt"></i> NUEVA SOLICITUD
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active show" id="TabMisSolicitudes">
                                </div>
                                <div role="tabpanel" class="tab-pane fade " id="TabNuevaSolicitud">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <ul class="nav nav-tabs">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="tab0201" href="#TabDatosSolictud" @click.prevent="tabDatosSolicitud" role="tab" data-toggle="tab">
                                                            <i class="fa fa-car"></i> DATOS SOLICITUD
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link disabled" id="tab0202" href="#TabDatosVehiculo" role="tab" data-toggle="tab">
                                                            <i class="fa fa fa-user"></i> DATOS VEHÍCULO
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane fade in active show" id="TabDatosSolictud">
                                                        <section class="forms">
                                                            <div class="container-fluid">
                                                                <div class="col-lg-12">
                                                                    <form class="form-horizontal">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* N° de Solicitud</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-input
                                                                                            placeholder="Número de Solicitud"
                                                                                            v-model="fillNuevaSolicitud.cnrosolicitud"
                                                                                            clearable>
                                                                                        </el-input>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">*Fecha</label>
                                                                                    <div class="col-sm-8 widthFull">
                                                                                        <el-date-picker
                                                                                            v-model="fillNuevaSolicitud.dfechasolicitud"
                                                                                            value-format="yyyy-MM-dd"
                                                                                            format="yyyy/MM/dd"
                                                                                            type="date"
                                                                                            placeholder="Seleccionar fecha de solicitud">
                                                                                        </el-date-picker>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Tipo Solicitud</label>
                                                                                    <div class="col-sm-8 widthFull">
                                                                                        <el-select v-model="fillNuevaSolicitud.nidtiposolicitud"
                                                                                                    filterable
                                                                                                    clearable
                                                                                                    placeholder="Seleccione un Tipo de Solicitud">
                                                                                            <el-option
                                                                                            v-for="item in arrayTipoSolicitudes"
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
                                                                            <div class="col-md-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Contacto</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-row>
                                                                                            <div class="input-group">
                                                                                                <el-input placeholder="Seleccione un Contacto" v-model="fillNuevaSolicitud.cnombrecontacto" :disabled="true" class="input-with-select" :clearable="true">
                                                                                                    <el-button slot="append" icon="el-icon-search" @click="abrirModal('contacto','buscar')"></el-button>
                                                                                                </el-input>
                                                                                            </div>

                                                                                            <el-button type="primary" icon="el-icon-circle-plus" circle></el-button>
                                                                                        </el-row>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-md-9 offset-md-5">
                                                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="activarTab0202">
                                                                                    <i class="fa fa-arrow-right"></i> Siguiente
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade in active show" id="TabDatosVehiculo">
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
    </main>
</template>

<script>
    export default {
        props:['ruta'],
        data(){
            return {
                // =============================================================
                // VARIABLES NUEVA SOLICITUD
                // =============================================================
                // ===============================
                // VARIABLES DATOS SOLICITUD
                // ===============================
                fillNuevaSolicitud: {
                    cnrosolicitud: '',
                    dfechasolicitud: '',
                    nidtiposolicitud: '',
                    nidcontacto: '',
                    cnombrecontacto: '',
                },
                arrayTipoSolicitudes: [],
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
            // =================================================================
            // METODOS TAB NUEV SOLICITUD
            // =================================================================
            tabNuevaSolicitud(){
                this.tabDatosSolicitud();
            },
            // ============================
            // SUBTAB DATOS SOLICTIUD
            // ============================
            tabDatosSolicitud(){
                $('#tab0201').removeClass('nav-link active');
                $('#tab0201').addClass('nav-link active');
                $('#tab0202').removeClass('nav-link active');
                $('#tab0202').addClass('nav-link disabled');

                $('#TabDatosSolictud').addClass('in active show');
                $('#TabDatosVehiculo').removeClass('in active show');
                this.llenarComboTipoSolicitud();
            },
            llenarComboTipoSolicitud(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110077
                    }
                }).then(response => {
                    this.arrayTipoSolicitudes = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            activarTab0202(){
                if(this.validarTab0201()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                $('#tab0201').removeClass('nav-link active');
                $('#tab0201').addClass('nav-link');
                $('#tab0202').removeClass('nav-link disabled');
                $('#tab0202').addClass('nav-link active');

                $('#TabDatosSolictud').removeClass('in active show');
                $('#TabDatosVehiculo').addClass('in active show');
            },
            validarTab0201(){
                this.error = 0;
                this.mensajeError =[];

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
                    case "contacto":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=2;
                                this.modal = 1;
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
</style>



