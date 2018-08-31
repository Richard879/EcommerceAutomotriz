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
                                        <i class="fa fa-list"></i> BUSQUEDA
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="tab02" href="#TabAsignacion" @click="tabAsignacion" role="tab" data-toggle="tab">
                                        <i class="fa fa-list-ol"></i> ASIGNACIÓN
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
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="h4">LISTADO VENDEDORES ASIGNADOS AL JEFE DE VENTAS {{ fillFormularioGeneral.cusuarionombre }} </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="form-horizontal">
                                                            <div class="col-lg-12">
                                                                <template v-if="arrayVendedoresByIdJV.length">
                                                                    <div class="table-responsive barraLateral">
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
                                                                                        <a href="#" @click="asingarVendedorByJefe(vendedor);">
                                                                                            <i class="fa-md fa fa-check-circle" aria-hidden="true"></i>
                                                                                        </a>
                                                                                    </td>
                                                                                    <td v-text="vendedor.cParNombre"></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-7">
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
                                                                            <div class="col-lg-5">
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
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="TabAsignacion">
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
                                                <template v-if="arrayTurnoVendedor.length">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>Seleccione</th>
                                                                    <th>Nombre Turno</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="turno in arrayTurnoVendedor" :key="turno.nIdPar">
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
                    nidturnovendedor: 0,
                    cnombreturno: '',
                    nidvendedor: 0,
                    cvendedornombre: ''
                },
                arrayTurnoVendedor: [],
                arrayVendedoresByIdJV: [],
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
            llenarVentaActiva(){
                var url = this.ruta + '/getObjComercial/getVentaActiva';
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
                        'ngrupoparid' : 110066,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayTurnoVendedor = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            asignarTurno(turno){
                this.fillFormularioGeneral.nidturnovendedor = turno.nIdPar;
                this.fillFormularioGeneral.cnombreturno = turno.cParNombre;
                this.cerrarModal();
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
                if(this.fillFormularioGeneral.nidturnovendedor == 0){
                    this.mensajeError.push('Debe ser seleccionar un turno');
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
            asingarVendedorByJefe(vendedor){
                this.fillFormularioGeneral.nidvendedor = vendedor.nIdPar;
                this.fillFormularioGeneral.cvendedornombre = vendedor.cParNombre;
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
