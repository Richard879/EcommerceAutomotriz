<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom"> TIPO CAMBIO</h2>
                </div>
            </header>

            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h4">CONFIGURADOR TIPO DE CAMBIO</h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Fecha del Día</label>
                                                <div class="col-sm-8">
                                                    <span v-text="fillTipoCambio.dFechaTipoCambio" class="form-label"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Tipo Cambio Comercial</label>
                                                <div class="col-sm-8">
                                                    <input type="text" :v-model="Number((parseFloat(fillTipoCambio.fTipoCambioComercial)).toFixed(2))" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Tipo Cambio Compra</label>
                                                <div class="col-sm-8">
                                                    <input type="text" v-model="fillTipoCambio.fTipoCambioCompra" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Tipo Cambio Venta</label>
                                                <div class="col-sm-8">
                                                    <input type="text" v-model="fillTipoCambio.fTipoCambioVenta" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-9 offset-sm-5">
                                            <button type="button" class="btn btn-primary btn-corner btn-sm" @click="guardarTipoCambio(1)">
                                                <i class="fa fa-save"></i> Guardar
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
                fillTipoCambio:{
                    dFechaTipoCambio: '',
                    fTipoCambioComercial: 0,
                    fTipoCambioCompra: 0,
                    fTipoCambioVenta: 0
                },
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
                mensajeError: [],
                loading: false
            }
        },
        mounted(){
            this.llenarTipoCambio();
        },
        methods: {
            llenarTipoCambio(){
                var url = this.ruta + '/tipocambio/GetTipoCambioDay';

                axios.get(url).then(response => {
                    console.log(response.data)
                    this.fillTipoCambio.dFechaTipoCambio = response.data[0].dFechaTipoCambio;
                    this.fillTipoCambio.fTipoCambioComercial = response.data[0].fValorTipoCambioComercial;
                    this.fillTipoCambio.fTipoCambioCompra = response.data[0].fValorTipoCambioCompra;
                    this.fillTipoCambio.fTipoCambioVenta = response.data[0].fValorTipoCambioVenta;
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
            guardarTipoCambio(){
                if(this.validarTipoCambio()){
                    return;
                }
            },
            validarTipoCambio(){

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
        text-align: center;
        margin: auto;
    }
</style>
