<template>
    <main>
        <header class="page-header">
          <div class="container-fluid">
            <h2 class="no-margin-bottom">TURNO DE VENTA</h2>
          </div>
        </header>
        <template v-if="vistaFormulario">
            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h4">BUSCAR TURNO DE VENTA</h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Empresa</label>
                                        <div class="col-sm-4">
                                            <input type="text" v-model="cempresa" class="form-control form-control-sm" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Sucursal</label>
                                        <div class="col-sm-4">
                                            <input type="text" v-model="csucursal" class="form-control form-control-sm" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Turno</label>
                                        <div class="col-sm-4">
                                            <select v-model="formTur.nturno" class="form-control form-control-sm">
                                                <option v-for="item in arrayTurno" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Hora Inicio</label>
                                        <div class="col-sm-1">
                                            <input type="text" v-model="formTur.chorainicio" class="form-control form-control-sm" placeholder="00">
                                        </div>:
                                        <div class="col-sm-1">
                                            <input type="text" v-model="formTur.cminuinicio" class="form-control form-control-sm" placeholder="00">
                                        </div>
                                        <div class="col-sm-2">
                                            <select v-model="formTur.nminicio" class="form-control form-control-sm">
                                                <option v-for="item in arrayHoraInicio" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Hora Fin</label>
                                        <div class="col-sm-1">
                                            <input type="text" v-model="formTur.chorafin" class="form-control form-control-sm" placeholder="00">
                                        </div>:
                                        <div class="col-sm-1">
                                            <input type="text" v-model="formTur.cminufin" class="form-control form-control-sm" placeholder="00">
                                        </div>
                                        <div class="col-sm-2">
                                            <select v-model="formTur.nmfin" class="form-control form-control-sm">
                                                <option v-for="item in arrayHoraFin" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-9 offset-sm-3">
                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarTurnoVenta();"><i class="fa fa-search"></i> Buscar</button>
                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="abrirFormulario('turnoventa','registrar')"><i class="fa fa-file-o"></i> Nuevo</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h4">LISTADO</h3>
                            </div>
                            <div class="card-body">
                                <template v-if="arrayTurnoVenta.length">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Sucursal</th>
                                                    <th>Turno</th>
                                                    <th>Hora inicio</th>
                                                    <th>Hora fin</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="turnoventa in arrayTurnoVenta" :key="turnoventa.nIdTurnoVendedor">
                                                    <td v-text="turnoventa.nIdTurnoVendedor"></td>
                                                    <td v-text="turnoventa.cSucursalNombre"></td>
                                                    <td v-text="turnoventa.cTurnoNombre"></td>
                                                    <td v-text="turnoventa.cHoraInicio"></td>
                                                    <td v-text="turnoventa.cHoraFin"></td>
                                                    <td>
                                                        <a href="#" @click="abrirFormulario('turnoventa','actualizar', turnoventa)" data-toggle="tooltip" data-placement="top"
                                                            :title="'Actualizar ' +turnoventa.nIdTurnoVendedor">
                                                            <i class="fa-md fa fa-edit"></i>
                                                        </a>
                                                        <template v-if="turnoventa.cElementoEstado=='A'">
                                                            <a href="#" @click="desactivar(turnoventa.nIdTurnoVendedor)" data-toggle="tooltip" data-placement="top"
                                                            :title="'Desactivar ' +turnoventa.nIdTurnoVendedor">
                                                                <i class="fa-md fa fa-check-square"></i>
                                                            </a>
                                                        </template>
                                                        <template v-else>
                                                            <a href="#" @click="activar(turnoventa.nIdTurnoVendedor)" data-toggle="tooltip" data-placement="top"
                                                            :title="'Activar ' +turnoventa.nIdTurnoVendedor">
                                                                <i :style="'color:red'" class="fa-md fa fa-square"></i>
                                                            </a>
                                                        </template>
                                                    </td>
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
                                                            <a @click.prevent="cambiarPagina(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                        </li>
                                                        <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                        :class="[page==isActived?'active':'']">
                                                            <a class="page-link"
                                                            href="#" @click.prevent="cambiarPagina(page)"
                                                            v-text="page"></a>
                                                        </li>
                                                        <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                            <a @click.prevent="cambiarPagina(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                        </div>
                    </div>
                </div>
            </section>
        </template>
        <template v-else>
            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h4" v-text="tituloFormulario"></h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Empresa</label>
                                        <div class="col-sm-4">
                                            <input type="text" v-model="cempresa" class="form-control form-control-sm" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Sucursal</label>
                                        <div class="col-sm-4">
                                            <input type="text" v-model="csucursal" class="form-control form-control-sm" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Turno</label>
                                        <div class="col-sm-4">
                                            <select v-model="formTur.nturno" class="form-control form-control-sm">
                                                <option v-for="item in arrayTurno" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Hora Inicio</label>
                                        <div class="col-sm-1">
                                            <input type="text" v-model="formTur.chorainicio" class="form-control form-control-sm" placeholder="00">
                                        </div>:
                                        <div class="col-sm-1">
                                            <input type="text" v-model="formTur.cminuinicio" class="form-control form-control-sm" placeholder="00">
                                        </div>
                                        <div class="col-sm-2">
                                            <select v-model="formTur.nminicio" class="form-control form-control-sm">
                                                <option v-for="item in arrayHoraInicio" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Hora Fin</label>
                                        <div class="col-sm-1">
                                            <input type="text" v-model="formTur.chorafin" class="form-control form-control-sm" placeholder="00">
                                        </div>:
                                        <div class="col-sm-1">
                                            <input type="text" v-model="formTur.cminufin" class="form-control form-control-sm" placeholder="00">
                                        </div>
                                        <div class="col-sm-2">
                                            <select v-model="formTur.nmfin" class="form-control form-control-sm">
                                                <option v-for="item in arrayHoraFin" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="button" v-if="accion==1" class="btn btn-success btn-corner btn-sm" @click="registrar()">
                                                <i class="fa fa-save"></i> Registrar
                                            </button>
                                            <button type="button" v-if="accion==2" class="btn btn-secondary btn-corner btn-sm" @click="actualizar()">
                                                <i class="fa fa-save"></i> Actualizar
                                            </button>
                                            <button type="button" class="btn btn-secundary btn-corner btn-sm" @click="cambiarVistaFormulario()">
                                                <i class="fa fa-close"></i> Cancelar
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
    </main>
</template>
<script>
    export default {
        props:['ruta'],
        data(){
            return {
                cempresa: 'SAISAC',
                csucursal: 'CHICLAYO',
                arrayTurno: [],
                chorainicio:'00',
                cminuinicio:'00',
                arrayHoraInicio:[],
                chorafin:'00',
                cminufin:'00',
                arrayHoraFin:[],
                arrayTurnoVenta: [],
              
                formTur:{
                    cempresa: 'SAISAC',
                    csucursal: 'CHICLAYO',
                    nturno: 0,
                    nminicio:1300153,
                    nmfin:1300153,
                    nidempresa : '',
                    nidsucursal : '',
                },
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
                vistaFormulario: 1
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
        methods:{
            llenarComboTurno(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110060,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayTurno = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboHoraInicio(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110061,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayHoraInicio = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboHoraFin(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110061,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayHoraFin = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            buscarTurnoVenta(){
                this.listarTurnosVenta(1);
            },
            listarTurnosVenta(page){
                var url = this.ruta + '/turnoventa/GetLstTurnoVenta';

                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidsucursal': 1300013,
                        'nidturno' : this.formTur.nturno,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayTurnoVenta = response.data.arrayTurnoVenta.data;
                    this.pagination.current_page =  response.data.arrayTurnoVenta.current_page;
                    this.pagination.total = response.data.arrayTurnoVenta.total;
                    this.pagination.per_page    = response.data.arrayTurnoVenta.per_page;
                    this.pagination.last_page   = response.data.arrayTurnoVenta.last_page;
                    this.pagination.from        = response.data.arrayTurnoVenta.from;
                    this.pagination.to           = response.data.arrayTurnoVenta.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarTurnosVenta(page);
            },
            abrirFormulario(modelo, accion, data =[]){
                switch(modelo){
                    case 'turnoventa':
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.vistaFormulario = 0;
                                this.accion = 1;
                                this.llenarComboTurno();
                                this.llenarComboHoraInicio();
                                this.llenarComboHoraFin();
                                this.tituloFormulario = 'NUEVO TURNO DE VENTA';
                                this.limpiarFormulario();
                                break;
                            }
                            case 'actualizar':
                            {
                                this.vistaFormulario = 0;
                                this.accion = 2;
                                this.llenarComboTpoElemento();
                                this.llenarComboTpoMoneda();
                                this.tituloFormulario = 'ACTUALIZAR ELEMENTO VENTA';
                                this.formTur.nidelemento = data['nIdElemento'];
                                this.formTur.ntpoelemen = data['nIdTipoElemento'];
                                this.formTur.nidproveedor  = data['nIdProveedor'];
                                this.formTur.cproveedornombre = data['cProveedorNombre'];
                                this.formTur.nidmoneda = data['nIdMoneda'];
                                this.formTur.celenombre = data['cElemenNombre'];
                                this.formTur.celecodigoerp = data['cCodigoERP'];
                                this.formTur.felevalorventa = data['fElemenValorVenta'];
                                this.formTur.felevarlorminventa = data['fElemenValorMinimoVenta'];
                                break;
                            }
                        }
                    }
                }
            },
            limpiarFormulario(){
                this.formTur.nidproveedor= 0,
                this.formTur.cproveedornombre=  '',
                this.formTur.ntpoelemen= 0,
                this.formTur.nidmoneda= 0,
                this.formTur.celenombre= '',
                this.formTur.celecodigoerp= '',
                this.formTur.felevalorventa= '',
                this.formTur.felevarlorminventa='',
                this.arrayElementoVenta = []
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
            /*limpiarPaginacion(){
                this.pagination.current_page =  0,
                this.pagination.total = 0,
                this.pagination.per_page = 0,
                this.pagination.last_page = 0,
                this.pagination.from  = 0,
                this.pagination.to = 0
            },*/
            mostrarProgressBar(){
                $("#myBar").show();
                progress();
            }
        },
        mounted(){
            this.llenarComboTurno();
            this.llenarComboHoraInicio();
            this.llenarComboHoraFin();
        }
    }
</script>