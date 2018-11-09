<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">Reporte Cotización</h2>
                </div>
            </header>

            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h4" v-text="tituloFormulario"></h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal reportes">
                                    <div class="col-md-5">
                                        <div class="col-lg-12" style="max-height: 515px; overflow-x: auto;">
                                            <el-radio-group v-model="vistaFormulario">
                                                <el-radio v-for="(item, index) in arrayReportes" :label="item.nParDstCodigo" :key="index"> {{ item.cNombreDstParametro }} </el-radio>
                                            </el-radio-group>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <template v-if="vistaFormulario == 0">
                                            <el-alert
                                                title="Seleccione un Reporte!!"
                                                type="warning"
                                                :closable="false"
                                                show-icon>
                                            </el-alert>
                                        </template>
                                        <template v-if="vistaFormulario == 1300365">
                                            <section class="forms">
                                                <div class="container-fluid">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h3 class="h4">BUSCAR </h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <form class="form-horizontal">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-5">
                                                                            <div class="block">
                                                                                <el-radio-group v-model="fillBsqReporte01.nIdOp" @change="verificarTipoBsq01">
                                                                                    <el-radio v-for="(item, index) in arrayFlagReporte01" :label="item.value" :key="index"> {{ item.text }} </el-radio>
                                                                                </el-radio-group>
                                                                                <el-checkbox v-model="fillBsqReporte01.porVendedor" @change="verificarPorVendedor01">Por Vendedor</el-checkbox>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-7">
                                                                            <!-- Input Fecha de Periodo -->
                                                                            <el-date-picker
                                                                                v-if="fillBsqReporte01.nIdOp == 1"
                                                                                v-model="fillBsqReporte01.dFechaPeriodo"
                                                                                type="month"
                                                                                value-format="yyyy-MM-dd"
                                                                                format="MM/yyyy"
                                                                                placeholder="Seleccione un Periodo">
                                                                            </el-date-picker>
                                                                            <!-- Input Fecha Exacta -->
                                                                            <el-date-picker
                                                                                v-if="fillBsqReporte01.nIdOp == 2"
                                                                                v-model="fillBsqReporte01.dFechaExacta"
                                                                                type="date"
                                                                                value-format="yyyy-MM-dd"
                                                                                format="dd/MM/yyyy"
                                                                                placeholder="dd/mm/aaaa">
                                                                            </el-date-picker>
                                                                            <br>
                                                                            <!-- Input Bsq Nombre Usuario -->
                                                                            <el-input placeholder="Nombre..."
                                                                                        v-if="fillBsqReporte01.porVendedor == true"
                                                                                        v-model="fillBsqReporte01.cNombreUsuario">
                                                                            </el-input>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6 offset-sm-5">
                                                                            <button type="button" class="btn btn-primary btn-corner btn-sm" @click="cotizacionGenerarReporte01">
                                                                                <i class="fa fa-file-pdf-o"></i> GENERAR REPORTE
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </template>
                                        <template v-if="vistaFormulario == 1300368">
                                            <section class="forms">
                                                <div class="container-fluid">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h3 class="h4">BUSCAR </h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <form @submit.prevent="cotizacionGenerarReporte04" class="form-horizontal">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-5">
                                                                            <div class="block">
                                                                                <el-checkbox v-model="fillBsqReporte04.porVendedor" @change="verificarPorVendedor04">Por Vendedor</el-checkbox>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-7">
                                                                            <!-- Input Bsq Nombre Usuario -->
                                                                            <el-input placeholder="Nombre..."
                                                                                        v-if="fillBsqReporte04.porVendedor == true"
                                                                                        v-model="fillBsqReporte04.cNombreUsuario">
                                                                            </el-input>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6 offset-sm-5">
                                                                            <button type="button" class="btn btn-primary btn-corner btn-sm" @click="cotizacionGenerarReporte04">
                                                                                <i class="fa fa-file-pdf-o"></i> GENERAR REPORTE
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </template>
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
                //=============================================================
                //================== LISTADO SUBREPORETES =====================
                arrayReportes: [],
                //=============================================================
                //================== FORMULARIO SUBREPORTE =====================
                arrayFlagReporte01: [
                    { value: '1', text: 'Por Periodo'},
                    { value: '2', text: 'Por Fecha'}
                ],
                fillBsqReporte01:{
                    nIdOp: '',
                    dFechaPeriodo: '',
                    dFechaExacta : '',
                    porVendedor: false,
                    cNombreUsuario: ''
                },
                fillBsqReporte04: {
                    porVendedor: false,
                    cNombreUsuario: ''
                },
                //==========================================================
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
                tituloFormulario: '',
                accionmodal: 0,
                error: 0,
                errors: [],
                mensajeError: [],
                vistaFormulario: 0
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
        mounted(){
            this.listarReportes();
        },
        methods:{
            listarReportes(){
                var url = this.ruta + '/reporte/GetListSubReportesByReporte';
                axios.get(url, {
                    params: {
                        'nIdPar': 1300364
                    }
                }).then(response => {
                    this.tituloFormulario = "Listado de Reportes de Cotización"
                    this.arrayReportes = response.data;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            // =================================================================
            // REPORTE 01
            // =================================================================
            verificarTipoBsq01(){
                this.fillBsqReporte01.dFechaPeriodo = '';
                this.fillBsqReporte01.dFechaExacta = '';
            },
            verificarPorVendedor01(){
                this.fillBsqReporte01.cNombreUsuario = '';
            },
            cotizacionGenerarReporte01(){
                //======= Valido informacion correcta ==========
                if(this.validarCotizacionGenerarReporte01()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                var config = {
                    responseType: 'blob'
                };
                var url = this.ruta + '/reporte/GetCotizacionGenerarReporte01';
                axios.post(url, {
                    'nIdEmpresa'      :   1300011,
                    'nIdSucursal'     :   sessionStorage.getItem("nIdSucursal"),
                    'dFechaPeriodo'   :   this.fillBsqReporte01.dFechaPeriodo,
                    'dFechaExacta'    :   this.fillBsqReporte01.dFechaExacta,
                    'cNombreUsuario'  :   this.fillBsqReporte01.cNombreUsuario
                }, config).then(response => {
                    //Create a Blob from the PDF Stream
                    const file = new Blob(
                        [response.data],
                        {type: 'application/pdf'}
                    );
                    //Construye la URL del Archivo
                    const fileURL = URL.createObjectURL(file);
                    //Abre la URL en una nueva Ventana
                    window.open(fileURL);
                    this.limpiarFormulario01();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            validarCotizacionGenerarReporte01(){
                let me = this;

                me.error = 0;
                me.mensajeError =[];

                if(!me.fillBsqReporte01.nIdOp && me.fillBsqReporte01.porVendedor == false) {
                    me.mensajeError.push('Debe seleccionar un Criterio de Busqueda');
                }

                if(me.fillBsqReporte01.nIdOp == 1){
                    if(!me.fillBsqReporte01.dFechaPeriodo){
                        me.mensajeError.push('Debe seleccionar un Periodo');
                    }
                }

                if(me.fillBsqReporte01.nIdOp == 2){
                    if(!me.fillBsqReporte01.dFechaExacta){
                        me.mensajeError.push('Debe seleccionar un Fecha Cotización');
                    }
                }

                if(me.fillBsqReporte01.porVendedor == true && !me.fillBsqReporte01.cNombreUsuario){
                    me.mensajeError.push('Debe ingresar un Nombre');
                }

                if(me.mensajeError.length){
                    me.error = 1;
                }
                return me.error;
            },
            limpiarFormulario01(){
                this.fillBsqReporte01.nIdOp = '';
                this.fillBsqReporte01.dFechaPeriodo = '';
                this.fillBsqReporte01.dFechaExacta = '';
                this.fillBsqReporte01.cNombreUsuario = '';
                this.fillBsqReporte01.porVendedor = false;
            },

            // =================================================================
            // REPORTE 04
            // =================================================================
            verificarPorVendedor04(){
                this.fillBsqReporte04.cNombreUsuario = '';
            },
            cotizacionGenerarReporte04(){
                //======= Valido informacion correcta ==========
                if(this.validarCotizacionGenerarReporte04()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                var config = {
                    responseType: 'blob'
                };
                var url = this.ruta + '/reporte/GetPedidoGenerarReporte04';
                axios.post(url, {
                    'nIdEmpresa'      :   1300011,
                    'nIdSucursal'     :   sessionStorage.getItem("nIdSucursal"),
                    'cNombreUsuario'  :   this.fillBsqReporte04.cNombreUsuario
                }, config).then(response => {
                    //Create a Blob from the PDF Stream
                    const file = new Blob(
                        [response.data],
                        {type: 'application/pdf'}
                    );
                    //Construye la URL del Archivo
                    const fileURL = URL.createObjectURL(file);
                    //Abre la URL en una nueva Ventana
                    window.open(fileURL);
                    this.limpiarFormulario04();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            validarCotizacionGenerarReporte04(){
                let me = this;

                me.error = 0;
                me.mensajeError =[];

                if(me.fillBsqReporte04.porVendedor == true && !me.fillBsqReporte04.cNombreUsuario){
                    me.mensajeError.push('Debe ingresar un Nombre');
                }

                if(me.mensajeError.length){
                    me.error = 1;
                }
                return me.error;
            },
            limpiarFormulario04(){
                this.fillBsqReporte04.cNombreUsuario = '';
                this.fillBsqReporte04.porVendedor = false;
            },

            // =================================================================
            // METODOS GENERICOS
            // =================================================================
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "TipoCambioEspecial":
                    {
                        switch(accion){
                            case 'abrir':
                            {

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
                this.limpiarPaginacionModal();
            },
            cerrarModalSinPaginacion(){
                this.modal = 0;
                this.accionmodal = 0;
                this.error = 0;
                this.mensajeError = '';
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
    .reportes{
        display: flex;
        justify-content: center;
    }
    .el-radio{
        margin-bottom: .8rem;
    }
    .el-radio-group{
        display: flex;
        justify-content: center;
        flex-direction: column;
        margin-left: 0.6rem;
    }
    .el-radio+.el-radio{
        margin-left: 0px !important;
    }
</style>


