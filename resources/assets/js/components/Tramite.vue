<template>
    <main>
        <header class="page-header">
          <div class="container-fluid">
            <h2 class="no-margin-bottom"> TRAMITE - TARJETA Y PLACA </h2>
          </div>
        </header>

        <section class="forms">
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab01" href="#TabBuscarPedido" role="tab" @click.prevent="tabBuscarPedido" data-toggle="tab">
                                        <i class="fa fa-search"></i> PEDIDOS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="tab02" href="#TabGenerarTramite" role="tab" @click.prevent="tabGenerarTramite" data-toggle="tab">
                                        <i class="fa fa-search"></i> GENERAR TRAMITE
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active show" id="TabBuscarPedido">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="h4">BUSCAR PEDIDOS CANCELADOS.</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="form-horizontal">
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <label class="col-md-4 form-control-label">*Estado</label>
                                                                        <div class="col-md-8 widthFull">
                                                                            <el-select v-model="fillBusquedaPedidos.nidestadotramite"
                                                                                    filterable
                                                                                    clearable
                                                                                    loading-text
                                                                                    placeholder="Seleccione un Estado Tramite">
                                                                                <el-option
                                                                                    v-for="estado in arrayEstadoTramite"
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
                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="buscarMisPedidos(1)">
                                                                        <i class="fa fa-search"></i> Buscar
                                                                    </button>
                                                                    <button type="button" class="btn btn-default btn-corner btn-sm" @click.prevent="limpiarBuscarPedidos()">
                                                                        <i class="fa fa-recycle"></i> Limpiar
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
                                                        <h3 class="h4">BANDEJA PEDIDOS CANCELADOS</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="form-horizontal">
                                                            <div class="col-lg-12">
                                                                <template v-if="arrayPedidosCancelados.length">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-striped table-sm">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Fecha Pedido</th>
                                                                                    <th>N° Pedido</th>
                                                                                    <th>VIN</th>
                                                                                    <th>Nombre Comercial</th>
                                                                                    <th>Año Fabricación</th>
                                                                                    <th>Estado Trámite</th>
                                                                                    <th>Acciones</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="(pedidocancelado, index) in arrayPedidosCancelados" :key="pedidocancelado.nIdSolicitudAutorizacion">
                                                                                    <td v-text="pedidocancelado.dFechaPedido"></td>
                                                                                    <td v-text="pedidocancelado.cNumeroPedido"></td>
                                                                                    <td v-text="pedidocancelado.cNumeroVin"></td>
                                                                                    <td v-text="pedidocancelado.cNombreComercial"></td>
                                                                                    <td v-text="pedidocancelado.nAnioFabricacion"></td>
                                                                                    <td v-text="pedidocancelado.cEstado"></td>
                                                                                    <td>
                                                                                        <a :href="pedidocancelado.cRutaDocumento"
                                                                                            v-if="pedidocancelado.cEstadoTramite !=''"
                                                                                                  target="_blank">
                                                                                            <i class='fa-md fa fa-file'></i>
                                                                                        </a>
                                                                                        <el-checkbox v-model="pedidocancelado.checked"
                                                                                                     @click="pedidocancelado.checked = !pedidocancelado.checked"
                                                                                                     @change="updatePedidoChecked(index, pedidocancelado.checked)">
                                                                                        </el-checkbox>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </template>
                                                                <br>
                                                                <div v-if="contPedidosChecked" class="form-group row">
                                                                    <div class="col-md-9 offset-md-5">
                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="tabGenerarTramite">
                                                                            <i class="fa fa-save"></i> Generar Tramite
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-lg-7">
                                                                        <nav>
                                                                            <ul class="pagination">
                                                                                <li v-if="pagination.current_page > 1" class="page-item">
                                                                                    <a @click.prevent="cambiarPaginaMisPedidos(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                </li>
                                                                                <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                :class="[page==isActived?'active':'']">
                                                                                    <a class="page-link"
                                                                                    href="#" @click.prevent="cambiarPaginaMisPedidos(page)"
                                                                                    v-text="page"></a>
                                                                                </li>
                                                                                <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                    <a @click.prevent="cambiarPaginaMisPedidos(pagination.current_page+1)" class="page-link" href="#">Sig</a>
                                                                                </li>
                                                                            </ul>
                                                                        </nav>
                                                                    </div>
                                                                    <div class="col-lg-5">
                                                                        <div class="datatable-info">Mostrando {{ pagination.from }} a {{ pagination.to }} de {{ pagination.total }} registros</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="TabGenerarTramite">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <ul class="nav nav-tabs">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="tab0201" href="#SubTabGenerarTramite" @click="subtabGenerarTramite" role="tab" data-toggle="tab">
                                                            <i class="fa fa-id-badge"></i> GENERAR TRAMITE
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link disabled" id="tab0202" href="#SubTabBandejaSolicitudes" role="tab" data-toggle="tab">
                                                            <i class="fa fa fa-map-marker"></i>  BANDEJA SOLICITUDES
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link disabled" id="tab0203" href="#SubTabTarjetaPlaca" role="tab" data-toggle="tab">
                                                            <i class="fa fa fa-map-marker"></i>  TRAMITE TARJETA/PLACA
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content">
                                                    <div class="tab-pane fade in active show" id="SubTabGenerarTramite">
                                                        <section class="forms">
                                                            <div class="container-fluid">
                                                                <div class="col-lg-12">
                                                                    <form class="form-horizontal">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Fecha Inicio Tramite</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-date-picker
                                                                                            v-model="fillBusquedaTramite.dFechaInicioTramite"
                                                                                            type="date"
                                                                                            value-format="yyyy-MM-dd"
                                                                                            format="dd/MM/yyyy"
                                                                                            placeholder="dd/mm/aaaa">
                                                                                        </el-date-picker>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Fecha Fin Real Tramite</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-date-picker
                                                                                            v-model="fillBusquedaTramite.dFechaFinRealTramite"
                                                                                            type="date"
                                                                                            value-format="yyyy-MM-dd"
                                                                                            format="dd/MM/yyyy"
                                                                                            placeholder="dd/mm/aaaa">
                                                                                        </el-date-picker>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div class="tab-pane fade" id="SubTabBandejaSolicitudes">
                                                        <section class="forms">
                                                            <div class="container-fluid">
                                                                <div class="col-lg-12">
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div class="tab-pane fade" id="SubTabTarjetaPlaca">
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
                // VARIABLES BUSCAR PEDIDOS
                // =============================================================
                arrayEstadoTramite: [],
                fillBusquedaPedidos: {
                    nidestadotramite: ''
                },
                arrayPedidosCancelados: [],
                arrayPedidosChecked: [],
                contPedidosChecked: false,
                // =============================================================
                // VARIABLES GENERAR TRAMITE
                // =============================================================
                fillBusquedaTramite: {
                    dFechaInicioTramite: '',
                    dFechaFinRealTramite: '',
                    nVehiculos: 0
                },
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
            this.tabBuscarPedido();
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
            // METODOS TAB BUSCAR PEDIDOS
            // =================================================================
            tabBuscarPedido(){
                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass('nav-link active');
                $('#tab02').removeClass('nav-link active');
                $('#tab02').addClass('nav-link disabled');

                $('#TabBuscarPedido').addClass('in active show');
                $('#TabGenerarTramite').removeClass('in active show');
                this.limpiarBuscarPedidos();
                this.llenarEstados();
                this.buscarMisPedidos(1);
            },
            llenarEstados(){
                var url = this.ruta + '/getComision/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110087,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayEstadoTramite = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            limpiarBuscarPedidos(){
                this.fillBusquedaPedidos.nidestadotramite = '';
            },
            buscarMisPedidos(page){
                var url = this.ruta + '/tramite/GetPedidosCanceladosByEstadoTramite';
                axios.get(url, {
                    params: {
                        'nIdEstadoTramite' : this.fillBusquedaPedidos.nidestadotramite,
                        'page' : page
                    }
                }).then(response => {
                    let me = this;
                    let info = response.data.arrayPedidosCancelados;
                    this.arrayPedidosCancelados  = info.data;
                    this.pagination.current_page = info.current_page;
                    this.pagination.total        = info.total;
                    this.pagination.per_page     = info.per_page;
                    this.pagination.last_page    = info.last_page;
                    this.pagination.from         = info.from;
                    this.pagination.to           = info.to;
                    this.$nextTick().then(function () {
                        me.llenarFlagPedidosCancelados();//Enviar Aprobado por defecto
                    })
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarFlagPedidosCancelados(){
                this.arrayPedidosChecked = [];

                this.$nextTick(function () {
                    let me = this;
                    this.arrayPedidosCancelados.map(function(value, key){
                        me.arrayPedidosChecked.push({
                                npedido :   value.cNumeroPedido,
                                estado  :   false,
                        });
                        // me.$set(me.arrayPedidosChecked, key, false);
                    })
                    me.contPedidosChecked = false;
                })
            },
            cambiarPaginaMisPedidos(page){
                this.pagination.current_page=page;
                this.buscarMisPedidos(page);
            },
            updatePedidoChecked(index, pedidocancelado){
                let me = this;
                let data;

                if (pedidocancelado == true) {
                    if (me.arrayPedidosChecked[index].estado != pedidocancelado) {
                        data = {
                            'npedido': me.arrayPedidosCancelados[index].cNumeroPedido,
                            'estado' : pedidocancelado
                        }
                        me.$set(me.arrayPedidosChecked, index, data);
                    }
                } else {
                    if (me.arrayPedidosChecked[index].estado != pedidocancelado) {
                        data = {
                            'npedido': me.arrayPedidosCancelados[index].cNumeroPedido,
                            'estado' : pedidocancelado
                        }
                        me.$set(me.arrayPedidosChecked, index, data);
                    }
                }

                this.verifiededidoChecked();
            },
            //Verifica si existe al menos un check para activar el botón para Generar Tramite
            verifiededidoChecked(){
                let me = this;
                let cont = 0;

                this.arrayPedidosChecked.map(function (x) {
                    if(x.estado == true){
                        cont++;
                    }
                });

                (cont > 0) ? me.contPedidosChecked = true : me.contPedidosChecked = false;

                return this.contPedidosChecked;
            },
            tabGenerarTramite(){
                if(this.validaGenerarTramite()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass('nav-link');
                $('#tab02').removeClass('nav-link disabled');
                $('#tab02').addClass('nav-link active');

                $('#TabBuscarPedido').removeClass('in active show');
                $('#TabGenerarTramite').addClass('in active show');
                this.subtabGenerarTramite();
            },
            validaGenerarTramite(){
                this.error = 0;
                this.mensajeError =[];

                if(this.contPedidosChecked == false){
                    this.mensajeError.push('Debe seleccionar un Pedido');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // =================================================================
            // METODOS TAB GENERAR TRAMITE
            // =================================================================
            // ==================================
            // SUBTAB GENERAR TRAMITE
            // ==================================
            subtabGenerarTramite(){
                $('#tab0201').removeClass('nav-link active');
                $('#tab0201').addClass('nav-link active');
                $('#tab0202').removeClass('nav-link active');
                $('#tab0202').addClass('nav-link disabled');
                $('#tab0203').removeClass('nav-link active');
                $('#tab0203').addClass('nav-link disabled');

                $('#SubTabGenerarTramite').addClass('in active show');
                $('#SubTabBandejaSolicitudes').removeClass('in active show');
                $('#SubTabTarjetaPlaca').removeClass('in active show');
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
                    case "contacto":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.flagBuscarContacto = data;
                                this.modalMisContactos.ntipopersona = 1;
                                this.listarContactos(1);
                                this.accionmodal=3;
                                this.modal = 1;
                                break;
                            }
                            break;
                            case 'asignar':
                            {
                                if(this.modalMisContactos.ntipopersona == 1){
                                    if (this.flagBuscarContacto == 1) {
                                        this.fillBusquedaSolicitud.nidasigcontacto = data['nIdAsignacionContactoVendedor'];
                                        this.fillBusquedaSolicitud.nidcontacto = data['nIdContacto'];
                                        this.fillBusquedaSolicitud.cnombrecontacto = data['cContacto'];
                                    } else {
                                        //Limpiar Asignación contacto cada vez que se asigne
                                        this.limpiarAlAsignarContacto();
                                        this.fillNuevaSolicitud.nidcontacto = data['nIdContacto'];
                                        this.fillNuevaSolicitud.cnombrecontacto = data['cContacto'];
                                        this.llenarReferenciasVehiculo();
                                    }
                                } else {
                                    if (this.flagBuscarContacto == 1) {
                                        this.fillBusquedaSolicitud.nidasigcontacto = data['nIdAsignacionContactoVendedor'];
                                        this.fillBusquedaSolicitud.nidcontacto = data['nIdContacto'];
                                        this.fillBusquedaSolicitud.cnombrecontacto = data['cRazonSocial'];
                                    } else {
                                        //Limpiar Asignación contacto cada vez que se asigne
                                        this.limpiarAlAsignarContacto();
                                        this.fillNuevaSolicitud.nidcontacto = data['nIdContacto'];
                                        this.fillNuevaSolicitud.cnombrecontacto = data['cRazonSocial'];
                                        this.llenarReferenciasVehiculo();
                                    }
                                }
                                this.modalMisContactos.ntipopersona = 1;
                                this.modalMisContactos.cnrodocumento = '';
                                this.modalMisContactos.cfiltrodescripcion = '';
                                this.cerrarModalSolicitud();
                                break;
                            }
                            break;
                        }
                    }
                    break;
                    case "conforme":
                    {
                        switch(accion){
                            case 'abrir':
                            {
                                this.getDetalleSolicitud(data, 1);
                                this.accionmodal=4;
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

</style>


