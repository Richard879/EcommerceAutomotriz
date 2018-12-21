<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
            <div class="container-fluid">
                <h2 class="no-margin-bottom">Cronograma</h2>
            </div>
            </header>

            <template v-if="vistaFormulario">
                <section class="forms">
                    <div class="container-fluid">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4">LISTADO</h3>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Tipo</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="fillParametro.nidtipocronograma" filterable clearable placeholder="SELECCIONE" v-on:change="obtenerCronogramaActivo()">
                                                            <el-option
                                                            v-for="item in arrayTipoCronograma"
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
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Año</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="fillParametro.nidanio" filterable clearable placeholder="SELECCIONE" v-on:change="listarMesesPorAnio()">
                                                            <el-option
                                                            v-for="item in arrayAnios"
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
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Mes</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="fillParametro.nidmes" filterable clearable placeholder="SELECCIONE" >
                                                            <el-option
                                                                v-for="item in arrayMes"
                                                                :key="item.nParDstCodigo"
                                                                :label="item.cParDstNombre"
                                                                :value="item.nParDstCodigo">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Fecha Inicio</label>
                                                    <div class="col-sm-8">
                                                       <el-date-picker
                                                            v-model="fillParametro.dfechainicio"
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
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Fecha Fin</label>
                                                    <div class="col-sm-8">
                                                       <el-date-picker
                                                            v-model="fillParametro.dfechafin"
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
                                            <div class="col-sm-9 offset-sm-5">
                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="activarCronograma()">
                                                    <i class="fa fa-save"></i> Activar
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Cronograma Activo</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="fillParametro.cdetallecronograma" class="form-control form-control-sm" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </template>


            <!-- Show Errors -->
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

        </main>
    </transition>
</template>
<script>
    export default {
        props:['ruta'],
        data(){
            return {
                cempresa: sessionStorage.getItem("cNombreEmpresa"),
                // =============================================================
                // =========== VARIABLES PARAMETRO ===========
                fillParametro:{
                    nidtipocronograma: '',
                    nidanio: '',
                    nidmes: '',
                    cdetallecronograma:'',
                    dfechainicio:'',
                    dfechafin: ''
                },
                arrayTipoCronograma: [],
                arrayAnios: [],
                arrayMes: [],
                arrayParametro: [],
                // =============================================================
                pagination: {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
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
                vistaFormulario: 1
            }
        },
        mounted(){
            this.llenarComboTpoCronograma();
            this.llenarComboAnios();
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
            llenarComboTpoCronograma(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110039
                    }
                }).then(response => {
                    this.arrayTipoCronograma = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboAnios(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110040
                    }
                }).then(response => {
                    this.arrayAnios = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            validarBusqueda(){
                this.error = 0;
                this.mensajeError =[];
                if(this.fillParametro.nidgrupopar == 0 || !this.fillParametro.nidgrupopar){
                    this.mensajeError.push('Debes Seleccionar un Grupo');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            listarMesesPorAnio(){
                /*if(this.validarBusqueda()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }*/
                var url = this.ruta + '/parparametro/GetParParametro';

                axios.get(url, {
                    params: {
                        'nparsrccodigo': this.fillParametro.nidanio,
                        'nparsrcgrupoarametro': 110040,
                        'npardstcodigo': 0,
                        'npardstgrupoarametro': 110041,
                        'opcion' : 1
                    }
                }).then(response => {
                    this.arrayMes = response.data.arrayParParametro;
                }).catch(error => {
                    console.log(error);
                });
            },
            obtenerCronogramaActivo(){
                var url = this.ruta + '/cronograma/GetCronogramaActivoByTipo';

                axios.get(url, {
                    params: {
                        'nidempresa':  parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidgrupopar': 110039,
                        'nidpar': this.fillParametro.nidtipocronograma
                    }
                }).then(response => {
                    if(response.data.arrayCronograma.length)
                    {
                        this.fillParametro.cdetallecronograma = response.data.arrayCronograma[0].cMes + ' - ' + response.data.arrayCronograma[0].cAnio;
                    }
                    else{
                        this.fillParametro.cdetallecronograma = "SIN CRONOGRAMA ACTIVO";
                    }
                }).catch(error => {
                    console.log(error);
                });
            },
            validar(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.fillParametro.nidtipocronograma || this.fillParametro.nidtipocronograma == 0){
                    this.mensajeError.push('Debes Seleccionar un Tipo Cronograma');
                };
                if(!this.fillParametro.nidanio || this.fillParametro.nidanio == 0){
                    this.mensajeError.push('Debes Seleccionar un Año');
                };
                if(!this.fillParametro.nidmes || this.fillParametro.nidmes == 0){
                    this.mensajeError.push('Debes Seleccionar un Mes');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            activarCronograma(){
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                swal({
                    title: 'Estas seguro de activar este Cronograma?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Activar!',
                    cancelButtonText: 'No, cancelar!'
                    }).then((result) => {
                        if (result.value) {
                            var url = this.ruta + '/cronograma/SetActivarCronograma';
                            axios.post(url, {
                                'nIdEmpresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                                'nIdTipoCronograma': this.fillParametro.nidtipocronograma,
                                'nIdAnio': this.fillParametro.nidanio,
                                'nIdMes': this.fillParametro.nidmes
                            }).then(response => {
                                swal(
                                    'Activado!',
                                    'El cronograma fue activado.'
                                );
                                this.obtenerCronogramaActivo();
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                        } else if (result.dismiss === swal.DismissReason.cancel)
                        {
                        }
                    })
            },
            desactivar(parametro){
                swal({
                    title: 'Estas seguro de desactivar este Parámetro?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Desactivar!',
                    cancelButtonText: 'No, cancelar!'
                    }).then((result) => {
                        if (result.value) {
                            var url = this.ruta + '/parametro/desactivar';
                            axios.put(url, {
                                nIdPar: parseInt(parametro.nIdPar)
                            }).then(response => {
                                swal(
                                'Desactivado!',
                                'El registro fue desactivado.'
                                );
                                this.listarParametroByGrupo(1);
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                        } else if (result.dismiss === swal.DismissReason.cancel)
                        {
                        }
                    })
            },
            cerrarModal(){
                //this.accionmodal==1;
                this.modal = 0
                /*this.nombre = '',
                this.descripcion = '',
                this.tituloModal = '',*/
                this.error = 0,
                this.mensajeError = ''
            },
            abrirFormulario(modelo, accion, data){
                switch(modelo){
                    case 'parametro':
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                if(this.validarBusqueda()){
                                    this.accionmodal=1;
                                    this.modal = 1;
                                    return;
                                }

                                this.vistaFormulario = 0;
                                this.accion = 1;
                                this.tituloFormulario = 'NUEVO PARAMETRO';
                                this.limpiarFormulario();
                                this.formParametro.nidgrupopar = this.fillParametro.nidgrupopar;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.vistaFormulario = 0;
                                this.accion = 2;
                                this.limpiarFormulario();
                                this.formParametro.nidpar = data.nIdPar;
                                this.formParametro.nidgrupopar = data.nIdGrupoPar;
                                this.formParametro.cparjerarquia = data.cParJerarquia;
                                this.formParametro.cparnombre = data.cParNombre;
                                this.formParametro.cparabreviatura = data.cParAbreviatura;
                                this.tituloFormulario = 'ACTUALIZAR PARAMETRO';
                                break;
                            }
                        }
                    }
                }
            },
            cambiarVistaFormulario(){
                if(this.accion == 1){
                    this.limpiarFormulario();
                    this.vistaFormulario = 1;
                }else{
                    this.limpiarFormulario();
                    this.vistaFormulario = 1;
                }

            },
            limpiarFormulario(){
                this.formParametro.nidpar = 0,
                this.formParametro.nidgrupopar = '',
                this.formParametro.cparjerarquia = '',
                this.formParametro.cparnombre = '',
                this.formParametro.cparabreviatura = ''
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
    }
</style>
