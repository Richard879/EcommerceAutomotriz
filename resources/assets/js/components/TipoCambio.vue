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
                                                    <input type="number" v-model="fillTipoCambio.fTipoCambioComercial" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Tipo Cambio Compra</label>
                                                <div class="col-sm-8">
                                                    <input type="number" v-model="fillTipoCambio.fTipoCambioCompra" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Tipo Cambio Venta</label>
                                                <div class="col-sm-8">
                                                    <input type="number" v-model="fillTipoCambio.fTipoCambioVenta" class="form-control form-control-sm">
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
    </transition>
</template>

<script>
    export default {
        props:['ruta'],
        data(){
            return {
                fillTipoCambio:{
                    cflagOp: '',
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
                    //Variable bandera para saber si debo registrar o actualizar
                    this.fillTipoCambio.cflagOp = response.data[0].fValorTipoCambioComercial;

                    //Obtengo Tipo Cambio
                    this.fillTipoCambio.dFechaTipoCambio = response.data[0].dFechaTipoCambio;
                    this.fillTipoCambio.fTipoCambioComercial = response.data[0].fValorTipoCambioComercial;
                    this.fillTipoCambio.fTipoCambioCompra = response.data[0].fValorTipoCambioCompra;
                    this.fillTipoCambio.fTipoCambioVenta = response.data[0].fValorTipoCambioVenta;
                    //Parseo a 0 si es ".000"
                    this.fillTipoCambio.fTipoCambioComercial = parseFloat(this.fillTipoCambio.fTipoCambioComercial);
                    this.fillTipoCambio.fTipoCambioCompra = parseFloat(this.fillTipoCambio.fTipoCambioCompra);
                    this.fillTipoCambio.fTipoCambioVenta = parseFloat(this.fillTipoCambio.fTipoCambioVenta);
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
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                //Parseo el Tipo Cambio Bandera
                this.fillTipoCambio.cflagOp = parseFloat(this.fillTipoCambio.cflagOp);
                //Si el Tipo Cambio que viene de SQL es 0 Registrar
                if(this.fillTipoCambio.cflagOp <= 0){
                    this.registrarTipoCambio();
                } else {
                    //Si el Tipo Cambio tiene valor es Actualizar
                    this.actualizarTipoCambio();
                }
            },
            registrarTipoCambio(){
                this.mostrarProgressBar();
                var url = this.ruta + '/tipocambio/SetRegistrarTipoCambio';
                axios.post(url, {
                    'dFechaTipoCambio': this.fillTipoCambio.dFechaTipoCambio,
                    'fTipoCambioComercial': this.fillTipoCambio.fTipoCambioComercial,
                    'fTipoCambioCompra': this.fillTipoCambio.fTipoCambioCompra,
                    'fTipoCambioVenta': this.fillTipoCambio.fTipoCambioVenta
                }).then(response => {
                    if (response.data[0].nFlagMsje == 1) {
                        swal(response.data[0].cMensaje);
                        this.llenarTipoCambio();
                        $("#myBar").hide();
                    } else {
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: response.data[0].cMensaje,
                        })
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
            actualizarTipoCambio(){
                this.mostrarProgressBar();
                var url = this.ruta + '/tipocambio/SetActualizarTipoCambio';
                axios.post(url, {
                    'dFechaTipoCambio': this.fillTipoCambio.dFechaTipoCambio,
                    'fTipoCambioComercial': this.fillTipoCambio.fTipoCambioComercial,
                    'fTipoCambioCompra': this.fillTipoCambio.fTipoCambioCompra,
                    'fTipoCambioVenta': this.fillTipoCambio.fTipoCambioVenta
                }).then(response => {
                    if (response.data[0].nFlagMsje == 1) {
                        swal(response.data[0].cMensaje);
                        this.llenarTipoCambio();
                        $("#myBar").hide();
                    } else {
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Error al Actualizar Tipo de Cambio!',
                        })
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
            validarTipoCambio(){
                let me = this;
                this.error = 0;
                this.mensajeError =[];

                if(this.fillTipoCambio.fTipoCambioComercial == '' || this.fillTipoCambio.fTipoCambioComercial == 0){
                    this.mensajeError.push('Debe ingresar un Tipo Cambio Comercial');
                }
                if(this.fillTipoCambio.fTipoCambioCompra == '' || this.fillTipoCambio.fTipoCambioCompra == 0){
                    this.mensajeError.push('Debe ingresar un Tipo Cambio de Compra');
                }
                if(this.fillTipoCambio.fTipoCambioVenta == '' || this.fillTipoCambio.fTipoCambioVenta == 0){
                    this.mensajeError.push('Debe ingresar un Tipo Cambio de Venta');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // =================================================================
            // MODAL
            // =================================================================
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "pedido":
                    {
                        switch(accion){
                            case 'detalle':
                            {

                            }
                        }
                    }
                    break;
                }
            },
            cerrarModal(){
                this.modal = 0;
                this.accionmodal = 0;
                this.error = 0;
                this.mensajeError = '';
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
