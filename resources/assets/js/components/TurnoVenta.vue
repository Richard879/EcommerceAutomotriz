<template>
    <transition name="slide-fade" appear>
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
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Editar</div>
                                                                <i @click="abrirFormulario('turnoventa','actualizar', turnoventa)" :style="'color:#796AEE'" class="fa-md fa fa-edit"></i>
                                                            </el-tooltip>&nbsp;
                                                            <template v-if="turnoventa.cTurnoVenEstado=='A'">
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Desactivar</div>
                                                                    <i @click="desactivar(turnoventa.nIdTurnoVendedor)" :style="'color:#796AEE'" class="fa-md fa fa-check-square"></i>
                                                                </el-tooltip>
                                                            </template>
                                                            <template v-else>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Activar</div>
                                                                    <i @click="activar(turnoventa.nIdTurnoVendedor)" :style="'color:red'" class="fa-md fa fa-square"></i>
                                                                </el-tooltip>
                                                            </template>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-7">
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
                                                <div class="col-sm-5">
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
                                                <input type="hidden" v-model="formTur.nidturnovendedor">
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
                                            <div class="col-sm-4">
                                                <el-time-picker
                                                    v-model="formTur.chorainicio"
                                                    value-format="HH:mm"
                                                    :picker-options="{
                                                    format: 'AM/PM'
                                                    }"
                                                    placeholder="Hora Inicio">
                                                </el-time-picker>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 form-control-label">Hora Fin</label>
                                            <div class="col-sm-4">
                                                <el-time-picker
                                                    v-model="formTur.chorafin"
                                                    value-format="HH:mm"
                                                    :picker-options="{
                                                    format: 'AM/PM'
                                                    }"
                                                    placeholder="Hora Fin">
                                                </el-time-picker>
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
    </transition>
</template>
<script>
    export default {
        props:['ruta'],
        data(){
            return {
                cempresa: sessionStorage.getItem("cNombreEmpresa"),
                csucursal: sessionStorage.getItem("cNombreSucursal"),
                arrayTurno: [],
                chorainicio:'00',
                arrayHoraInicio:[],
                chorafin:'00',
                arrayTurnoVenta: [],
                formTur:{
                    nidturnovendedor: 0,
                    nturno: 0,
                    nidempresa : '',
                    nidsucursal : '',
                    chorainicio:'',
                    chorafin:'',
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
            buscarTurnoVenta(){
                this.listarTurnosVenta(1);
            },
            listarTurnosVenta(page){
                var url = this.ruta + '/turnoventa/GetLstTurnoVenta';

                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
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
                                this.tituloFormulario = 'NUEVO TURNO DE VENTA';
                                this.limpiarFormulario();
                                break;
                            }
                            case 'actualizar':
                            {
                                this.vistaFormulario = 0;
                                this.accion = 2;
                                this.llenarComboTurno();
                                this.tituloFormulario = 'ACTUALIZAR TURNO DE VENTA';
                                this.formTur.nidturnovendedor = data['nIdTurnoVendedor'];
                                this.formTur.nturno = data['nIdTurno'];
                                this.formTur.chorainicio = data['cHoraInicio'];
                                this.formTur.chorafin = data['cHoraFin'];
                                break;
                            }
                        }
                    }
                }
            },
            limpiarFormulario(){
                this.formTur.nturno= 0,
                this.formTur.chorainicio= '',
                this.formTur.chorafin= '',
                this.arrayTurnoVenta= []
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
            registrar(){
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/turnoventa/SetTurnoVenta';
                axios.post(url, {
                    nIdEmpresa: parseInt(sessionStorage.getItem("nIdEmpresa")),
                    nIdSucursal: parseInt(sessionStorage.getItem("nIdSucursal")),
                    nIdTurno: parseInt(this.formTur.nturno),
                    cHoraInicio: this.formTur.chorainicio,
                    cHoraFin: this.formTur.chorafin,
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('turno de Venta registrado');
                        this.limpiarFormulario();
                        this.listarTurnosVenta(1);
                        this.vistaFormulario = 1;
                    }
                }).catch(error => {
                    console.log(error);
                });
            },
            validar(){
                this.error = 0;
                this.mensajeError =[];
                if(this.accion == 2 && this.formTur.nidturnovendedor == 0){
                    this.mensajeError.push('No ha seleccionado Turno de venta');
                }
                if(!this.formTur.nturno || this.formTur.nturno == 0){
                    this.mensajeError.push('Debes Ingresar el Turno');
                };
                if(!this.formTur.chorainicio){
                    this.mensajeError.push('Debes Ingresar una Hora de Inicio');
                };
                if(!this.formTur.chorafin){
                    this.mensajeError.push('Debes Ingresar una Hora de Fin');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            activar(nIdTurnoVenta){
                swal({
                    title: 'Estas seguro de activar este turno de venta?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Activar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.value) {
                        var url = this.ruta + '/turnoventa/activar';
                        axios.put(url , {
                            nIdTurnoVenta: nIdTurnoVenta
                        }).then(response => {
                            swal(
                            'Activado!',
                            'El registro fue activado.'
                            );
                            this.listarTurnosVenta(1);
                            this.vistaFormulario = 1;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel){}
                })
            },
            desactivar(nIdTurnoVenta){
                swal({
                    title: 'Estas seguro de desactivar este turno de venta?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Desactivar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.value) {
                        var url = this.ruta + '/turnoventa/desactivar';
                        axios.put(url , {
                            nIdTurnoVenta: nIdTurnoVenta
                        }).then(response => {
                            swal(
                            'Desactivado!',
                            'El registro fue desactivado.'
                            );
                            this.listarTurnosVenta(1);
                            this.vistaFormulario = 1;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel){}
                })
            },
            actualizar(){
                var url = this.ruta + '/turnoventa/UpdTurnoVentaById';
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                axios.post(url, {
                    nIdEmpresa: parseInt(sessionStorage.getItem("nIdEmpresa")),
                    nIdSucursal: parseInt(sessionStorage.getItem("nIdSucursal")),
                    nIdTurnoVendedor: parseInt(this.formTur.nidturnovendedor),
                    nIdTurno: parseInt(this.formTur.nturno),
                    cHoraInicio: this.formTur.chorainicio,
                    cHoraFin: this.formTur.chorafin,
                }).then(response => {
                    swal('Turno de Venta Actualizado');
                    this.limpiarFormulario();
                    this.vistaFormulario = 1;
                    this.listarTurnosVenta(1);
                }).catch(error => {
                    console.log(error);
                });
            },
            mostrarProgressBar(){
                $("#myBar").show();
                progress();
            }
        },
        mounted(){
            this.llenarComboTurno();
        }
    }
</script>
