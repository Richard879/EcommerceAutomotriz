<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">ALMACENES</h2>
                </div>
            </header>

            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tab01" href="#TabBandejaAlmacenes" @click="tabBandejaAlmacenes" role="tab" data-toggle="tab">
                                            <i class="fa fa-wpforms"></i> BANDEJA DE ALMACENES
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab02" href="#TabConfigurarComision" @click="tabConfiguradorComision" role="tab" data-toggle="tab">
                                            <i class="fa fa-bus"></i> CONFIGURADOR DE ALMACENES/CUENTA
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active show" id="TabBandejaAlmacenes">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">BANDEJA DE ALMACENES</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-md-4 form-control-label">* Localidad</label>
                                                                            <div class="col-md-8 widthFull">
                                                                                <el-select v-model="fillCuenta.nIdLocalidad"
                                                                                        filterable
                                                                                        clearable
                                                                                        loading-text
                                                                                        placeholder="Seleccione una Localidad">
                                                                                    <el-option
                                                                                        v-for="concepto in arrayLocalidad"
                                                                                        :key="concepto.nIdPar"
                                                                                        :label="concepto.cParNombre"
                                                                                        :value="concepto.nIdPar">
                                                                                    </el-option>
                                                                                </el-select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="row">
                                                                            <label class="col-md-4 form-control-label">* Almacen</label>
                                                                            <div class="col-md-8 widthFull">
                                                                                <el-select v-model="fillCuenta.nIdAlmacen"
                                                                                        filterable
                                                                                        clearable
                                                                                        loading-text
                                                                                        placeholder="Seleccione un Almacen">
                                                                                    <el-option
                                                                                        v-for="concepto in arrayAlmacen"
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
                                                                            <label class="col-sm-4 form-control-label">* Codigo Cuenta</label>
                                                                            <div class="col-md-8 widthFull">
                                                                                <input type="text" v-model="fillCuenta.nCodigoCuenta" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-9 offset-md-5">
                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="listarComisiones(1)">
                                                                            <i class="fa fa-search"></i> BUSCAR
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </transition>
</template>

<script>
    export default {
        props:['ruta'],
        data(){
            return {
                fillCuenta: {
                    nIdLocalidad: '',
                    nIdAlmacen: '',
                    nCodigoCuenta: ''
                },
                arrayLocalidad: [],
                arrayAlmacen: [],
                arrayConfigAlmacen: [],
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
        methods: {
            tabBandejaAlmacenes(){
                this.limpiarTabBsqAlmacenes();
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
    .disabled{
        opacity: 0.65;
        cursor: not-allowed;
        border: 2px outset buttonface;
        pointer-events:none;
    }
</style>
